<?php

require get_template_directory() . '/inc/template-tags.php';

require get_template_directory() . '/inc/options.php';
require get_template_directory() . '/inc/content.php';
require get_template_directory() . '/inc/post-types/init.php';
require get_template_directory() . '/inc/woocommerce.php';
require get_template_directory() . '/inc/megamenu/megamenu.class.php';
require get_template_directory() . '/inc/megamenu/megamenu-walker.class.php';
require get_template_directory() . '/inc/image-generator/image-editor.class.php';
require get_template_directory() . '/inc/image-generator/image-generator.php';

require get_template_directory() . '/inc/pagespeed/pagespeed.class.php';

require get_template_directory() . '/plugins/plugins.php';

require_once ABSPATH . "wp-admin" . '/includes/file.php';

if ( ! isset( $content_width ) ) {
	$content_width = 1170;
}

if(!function_exists('thesod_setup')) :
function thesod_setup() {
	load_theme_textdomain('thesod', get_template_directory() . '/languages');
	add_theme_support('automatic-feed-links');
	add_theme_support('post-thumbnails');
	add_theme_support('woocommerce');
	add_theme_support('title-tag');
	set_post_thumbnail_size(672, 372, true);
	add_image_size('thesod-post-thumb', 256, 256, true);
	add_image_size('thesod-custom-product-categories', 766, 731, true);
	register_nav_menus(array(
		'primary' => esc_html__('Top primary menu', 'thesod'),
		'footer'  => esc_html__('Footer menu', 'thesod'),
		'top_area' => esc_html__('Top area menu', 'thesod'),
	));
	add_theme_support('html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	));
	add_theme_support('post-formats', array(
		'image', 'video', 'audio', 'quote', 'gallery',
	));
	add_theme_support('featured-content', array(
		'featured_content_filter' => 'thesod_get_featured_posts',
		'max_posts' => 6,
	));
	add_filter('use_default_gallery_style', '__return_false');

	function thesod_jpeg_quality() { return 80; }
	add_filter( 'jpeg_quality', 'thesod_jpeg_quality', 10, 2 );

	if(!get_option('thesod_theme_options')) {
		update_option('thesod_theme_options', thesod_first_install_settings());
		delete_option('thesod_activation');
	}
	$thesod_theme = wp_get_theme(wp_get_theme()->get('Template'));
	if(version_compare($thesod_theme->get('Version'), thesod_get_option('theme_version')) > 0) {
		thesod_version_update_options();
	}
	if(!get_option('pw_options')) {
		$pw_options = array(
			'donation' => 'yes',
			'customize_by_default' => 'yes',
			'post_types' => array('post', 'page', 'thesod_pf_item', 'thesod_news', 'product'),
			'sidebars' => array('page-sidebar', 'footer-widget-area', 'shop-sidebar'),
		);
		update_option('pw_options', $pw_options);
	}
	if(!get_option('shop_catalog_image_size')) {
		update_option('shop_catalog_image_size', array('width' => 522, 'height' => 652, 'crop' => 1));
	}
	if(!get_option('shop_single_image_size')) {
		update_option('shop_single_image_size', array('width' => 564, 'height' => 744, 'crop' => 1));
	}
	if(!get_option('shop_thumbnail_image_size')) {
		update_option('shop_thumbnail_image_size', array('width' => 160, 'height' => 160, 'crop' => 1));
	}
	if(!get_option('wpb_js_content_types')) {
		update_option('wpb_js_content_types', array('post', 'page', 'product', 'thesod_news', 'thesod_pf_item', 'thesod_footer', 'thesod_title'));
	}
	$thesod_theme = wp_get_theme('thesod');
	update_option('zilla_likes_settings', array_merge(get_option('zilla_likes_settings', array()), array('disable_css' => 1)));
	$lscode = get_option( 'layerslider-purchase-code', '' );
	$lsactivated = get_option( 'layerslider-authorized-site', false );
	if( $lsactivated && empty( $lscode ) ) {
		delete_option( 'layerslider-authorized-site' );
	}
	if(!get_option('wpb_js_js_composer_purchase_code')) {
		update_option('wpb_js_js_composer_purchase_code', 1);
	}
	update_option('revslider-valid-notice', 'false');
	$megamenu = new thesod_Mega_Menu();
	add_filter('attachment_fields_to_edit', 'thesod_attachment_extra_fields', 10, 2);
	add_filter('attachment_fields_to_save', 'thesod_attachment_extra_fields_save', 10, 2);

	add_theme_support('editor-styles');
	add_editor_style('css/style-editor.css');

	$custom_css_name = get_option('thesod_custom_css_filename');;
	if(!file_exists(get_stylesheet_directory() . '/css/'.$custom_css_name.'.css')) {
		thesod_generate_empty_custom_css();
	}

}
endif;
add_action('after_setup_theme', 'thesod_setup');

if (!function_exists('thesod_init_callback')) {
	function thesod_init_callback() {
		TGM_PageSpeed::activate();
	}
	add_action('init', 'thesod_init_callback');
}

//thesod MENU

add_action( 'admin_menu', 'thesod_admin_menu');
function thesod_admin_menu() {
	$page = add_menu_page(esc_html__('thesod','thesod'), esc_html__('thesod','thesod'), 'edit_theme_options', 'thesod-theme-options', 'thesod_theme_options_page', '', '3.1');
}

function thesod_admin_menu_additional_links() {
	global $submenu;
	$submenu['thesod-theme-options'][] = array(esc_html__('Support Center', 'thesod'), 'edit_theme_options', esc_url('https://codexthemes.ticksy.com/'));
	$submenu['thesod-theme-options'][] = array(esc_html__('Documentation', 'thesod'), 'edit_theme_options', esc_url('http://codex-themes.com/thesod/documentation/'));
}
add_action('admin_menu', 'thesod_admin_menu_additional_links', 50);

function thesod_theme_option_admin_notice() {
	if(isset($_GET['page']) && $_GET['page'] == 'thesod-theme-options') {
		$wp_upload_dir = wp_upload_dir();
		$upload_logos_dir = $wp_upload_dir['basedir'] . '/thesod-logos';
		if(!wp_mkdir_p($upload_logos_dir)) {
?>
<div class="error">
	<p><?php esc_html_e('Upload directory cannot be created. Check your permissions.', 'thesod'); ?></p>
</div>
<?php
		}
	}
}
add_action('admin_notices', 'thesod_theme_option_admin_notice');

function thesod_attachment_extra_fields($fields, $post) {
	$attachment_link = get_post_meta($post->ID, 'attachment_link', true);
	$fields['attachment_link'] = array(
		'input' => 'html',
		'html' => '<input type="text" id="attachments-' . $post->ID . '-attachment_link" style="width: 500px;" name="attachments[' . $post->ID . '][attachment_link]" value="' . esc_attr( $attachment_link ) . '" />',
		'label' => esc_html__('Link', 'thesod'),
		'value' => $attachment_link
	);

	$highligh = (bool) get_post_meta($post->ID, 'highlight', true);
	$fields['highlight'] = array(
		'input' => 'html',
		'html' => '<input type="checkbox" id="attachments-' . $post->ID . '-highlight" name="attachments[' . $post->ID . '][highlight]" value="1"' . ($highligh ? ' checked="checked"' : '') . ' />',
		'label' => esc_html__('Show as Highlight?', 'thesod'),
		'value' => $highligh
	);

	$highligh_type = get_post_meta($post->ID, 'highligh_type', true);
	if (!$highligh_type) {
		$highligh_type = 'squared';
	}
	$fields['highligh_type'] = array(
		'input' => 'html',
		'html' => '<select id="attachments-' . $post->ID . '-highligh_type" name="attachments[' . $post->ID . '][highligh_type]"><option value="squared" ' . ($highligh_type == 'squared' ? ' selected="selected"' : '') . '>Squared</option><option value="horizontal" ' . ($highligh_type == 'horizontal' ? ' selected="selected"' : '') . '>Horizontal</option><option value="vertical" ' . ($highligh_type == 'vertical' ? ' selected="selected"' : '') . '>Vertical</option></select>',
		'label' => esc_html__('Highlight Type', 'thesod'),
		'value' => $highligh_type
	);

	return $fields;
}

function thesod_attachment_extra_fields_save($post, $attachment) {
	update_post_meta($post['ID'], 'highlight', isset($attachment['highlight']));
	update_post_meta($post['ID'], 'attachment_link', $attachment['attachment_link']);
	update_post_meta($post['ID'], 'highligh_type', $attachment['highligh_type']);
	return $post;
}

/* SIDEBAR & WIDGETS */

function thesod_count_widgets($sidebar_id) {

	global $_wp_sidebars_widgets, $sidebars_widgets;
	if(!is_admin()) {
		if(empty($_wp_sidebars_widgets))
			$_wp_sidebars_widgets = get_option('sidebars_widgets', array());
		$sidebars_widgets = $_wp_sidebars_widgets;
	} else {
		$sidebars_widgets = get_option('sidebars_widgets', array());
	}
	if(is_array($sidebars_widgets) && isset($sidebars_widgets['array_version']))
		unset($sidebars_widgets['array_version']);

	$sidebars_widgets = apply_filters('sidebars_widgets', $sidebars_widgets);

	if(isset($sidebars_widgets[$sidebar_id])) {
		return count($sidebars_widgets[$sidebar_id]);
	}
	return 0;
}

function thesod_dynamic_sidebar_params($params) {
	$footer_widgets_class = 'col-md-4 col-sm-6 col-xs-12';
	if(thesod_count_widgets('footer-widget-area') >= 4) {
		$footer_widgets_class = 'col-md-3 col-sm-6 col-xs-12';
	}
	if(thesod_count_widgets('footer-widget-area') == 2) {
		$footer_widgets_class = 'col-sm-6 col-xs-12';
	}
	if(thesod_count_widgets('footer-widget-area') == 1) {
		$footer_widgets_class = 'col-xs-12';
	}
	$footer_widgets_class .= ' count-'.thesod_count_widgets('footer-widget-area');
	$params[0]['before_widget'] = str_replace('thesod__footer-widget-class__thesod', esc_attr($footer_widgets_class), $params[0]['before_widget']);
	return $params;
}
add_filter('dynamic_sidebar_params', 'thesod_dynamic_sidebar_params');

function thesod_sidebar_init() {
	register_sidebar(array(
		'name'		  => esc_html__('Main Page Sidebar', 'thesod'),
		'id'			=> 'page-sidebar',
		'description'   => esc_html__('Main sidebar that appears on the left.', 'thesod'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	));
	register_sidebar(array(
		'name'		  => esc_html__('VC Page Sidebar 01', 'thesod'),
		'id'			=> 'page-sidebar-1',
		'description'   => esc_html__('Main sidebar that appears on the left.', 'thesod'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	));
	register_sidebar(array(
		'name'		  => esc_html__('VC Page Sidebar 02', 'thesod'),
		'id'			=> 'page-sidebar-2',
		'description'   => esc_html__('Main sidebar that appears on the left.', 'thesod'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	));
	register_sidebar(array(
		'name'		  => esc_html__('Footer Widget Area', 'thesod'),
		'id'			=> 'footer-widget-area',
		'description'   => esc_html__('Footer Widget Area.', 'thesod'),
		'before_widget' => '<div id="%1$s" class="widget inline-column thesod__footer-widget-class__thesod %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
	register_sidebar(array(
		'name' => esc_html__('Shop sidebar', 'thesod'),
		'id' => 'shop-sidebar',
		'description' => esc_html__('Appears on posts and pages except the optional Front Page template, which has its own widgets', 'thesod'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'name' => esc_html__('Shop widget area', 'thesod'),
		'id' => 'shop-widget-area',
		'description' => esc_html__('Appears on posts and pages except the optional Front Page template, which has its own widgets', 'thesod'),
		'before_widget' => '<section id="%1$s" class="widget inline-column col-md-4 col-sm-6 col-xs-12 %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h4 class="widget-title shop-widget-title">',
		'after_title' => '</h4>',
	));
}
add_action('widgets_init', 'thesod_sidebar_init');

function thesod_scripts() {
	wp_enqueue_script('thesod-fullwidth-optimizer', get_template_directory_uri() . '/js/thesod-fullwidth-loader.js', false, false, false);
	wp_enqueue_script( 'html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );
	wp_register_script('jquery-dlmenu', get_template_directory_uri() . '/js/jquery.dlmenu.js', array('jquery'), false, true);

	if (thesod_get_option('mobile_menu_layout') == 'default') {
		wp_enqueue_script('jquery-dlmenu');
	}

	wp_enqueue_script('thesod-menu-init-script', get_template_directory_uri() . '/js/thesod-menu_init.js', array('jquery'), false, true);
	wp_localize_script('thesod-menu-init-script', 'thesod_dlmenu_settings', array(
		'backLabel' => esc_html__('Back', 'thesod'),
		'showCurrentLabel' => esc_html__('Show this page', 'thesod')
	));

	wp_enqueue_style('thesod-preloader', get_template_directory_uri() . '/css/thesod-preloader.css');

	$icons_loading_css = "
		body:not(.compose-mode) .sod-icon-style-gradient span,
		body:not(.compose-mode) .sod-icon .sod-icon-half-1,
		body:not(.compose-mode) .sod-icon .sod-icon-half-2 {
			opacity: 0 !important;
			}";
	wp_add_inline_style('thesod-preloader', $icons_loading_css);

	wp_enqueue_style('thesod-reset', get_template_directory_uri() . '/css/thesod-reset.css');
	wp_enqueue_style('thesod-grid', get_template_directory_uri() . '/css/thesod-grid.css');
	if(get_stylesheet() === get_template()) {
		wp_enqueue_style('thesod-style', get_stylesheet_uri(), array('thesod-reset', 'thesod-grid'));
	} else {
		wp_enqueue_style('thesod-style', get_template_directory_uri().'/style.css', array('thesod-reset', 'thesod-grid'));
		wp_enqueue_style('thesod-child-style', get_stylesheet_uri(), array('thesod-style'));
	}

	if (thesod_get_option('header_layout') == 'perspective') {
		wp_enqueue_style('thesod-layout-perspective', get_template_directory_uri() . '/css/thesod-layout-perspective.css');
	}

	wp_enqueue_style('thesod-header', get_template_directory_uri() . '/css/thesod-header.css');
	wp_enqueue_style('thesod-widgets', get_template_directory_uri() . '/css/thesod-widgets.css');
	wp_register_style('thesod-animations', get_template_directory_uri() . '/css/thesod-itemsAnimations.css');
	wp_enqueue_style('thesod-new-css', get_template_directory_uri() . '/css/thesod-new-css.css');
	wp_enqueue_style('perevazka-css-css', get_template_directory_uri() . '/css/thesod-perevazka-css.css');
	if($fonts_url = thesod_google_fonts_url()) {
		wp_enqueue_style( 'thesod-google-fonts', $fonts_url);
	}
	$custom_css_name = thesod_get_custom_css_filename();
	if(file_exists(get_stylesheet_directory() . '/css/'.$custom_css_name.'.css')) {
		wp_enqueue_style('thesod-custom', get_stylesheet_directory_uri() . '/css/'.$custom_css_name.'.css', array('thesod-style'));
	} elseif(file_exists(get_template_directory_uri() . '/css/'.$custom_css_name.'.css')) {
		wp_enqueue_style('thesod-custom', get_template_directory_uri() . '/css/'.$custom_css_name.'.css', array('thesod-style'));
	} else {
		wp_enqueue_style('thesod-custom', get_template_directory_uri() . '/css/custom.css', array('thesod-style'));
	}
	wp_deregister_style('wp-mediaelement');
	wp_register_style('wp-mediaelement', get_template_directory_uri() . '/css/wp-mediaelement.css', array('mediaelement'));

	if(is_rtl()) {
		wp_enqueue_style( 'thesod-rtl', get_template_directory_uri() . '/css/rtl.css');
	}

	if(is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply', array(), false, true);
	}

	wp_enqueue_style('js_composer_front');
	wp_enqueue_script('svg4everybody', get_template_directory_uri() . '/js/svg4everybody.js', false, false, true);
	wp_enqueue_script('thesod-form-elements', get_template_directory_uri() . '/js/thesod-form-elements.js', array('jquery'), false, true);
	wp_enqueue_script('jquery-easing', get_template_directory_uri() . '/js/jquery.easing.js', array('jquery'), false, true);

	wp_register_script('thesod-mediaelement', get_template_directory_uri() . '/js/thesod-mediaelement.js', array('jquery', 'mediaelement'), false, true);
	wp_enqueue_script('thesod-header', get_template_directory_uri() . '/js/thesod-header.js', array('jquery'), false, true);
	wp_register_script('jquery-touchSwipe', get_template_directory_uri() . '/js/jquery.touchSwipe.min.js', array('jquery'), false, true);
	wp_register_script('jquery-carouFredSel', get_template_directory_uri() . '/js/jquery.carouFredSel.js', array('jquery', 'jquery-touchSwipe'), false, true);
	wp_register_script('thesod-gallery', get_template_directory_uri() . '/js/thesod-gallery.js', array('jquery', 'jquery-carouFredSel', 'thesod-scroll-monitor'), false, true);
	wp_register_style('odometr', get_template_directory_uri() . '/css/odometer-theme-default.css');
	wp_register_script('odometr', get_template_directory_uri() . '/js/odometer.js', array('jquery'), false, true);
	wp_register_script('thesod-related-products-carousel', get_template_directory_uri() . '/js/thesod-related-products-carousel.js', array('jquery', 'jquery-carouFredSel'), false, true);
	wp_register_script('thesod-related-posts-carousel', get_template_directory_uri() . '/js/thesod-related-posts-carousel.js', array('jquery', 'jquery-carouFredSel'), false, true);
	wp_register_script('thesod-sticky', get_template_directory_uri() . '/js/thesod-sticky.js', array('jquery'), false, true);
	wp_register_script('thesod-items-animations', get_template_directory_uri() . '/js/thesod-itemsAnimations.js', array('jquery'), false, true);
	wp_register_style('thesod-blog', get_template_directory_uri() . '/css/thesod-blog.css', array('mediaelement', 'wp-mediaelement'));
	wp_register_style('thesod-additional-blog', get_template_directory_uri() . '/css/thesod-additional-blog.css');
	wp_enqueue_style('thesod-additional-blog-1', get_template_directory_uri() . '/css/thesod-additional-blog-1.css');
	wp_register_style('thesod-hovers', get_template_directory_uri() . '/css/thesod-hovers.css');
	wp_register_style('thesod-hovers-default', get_template_directory_uri() . '/css/hovers/thesod-hovers-default.css');
	wp_register_style('thesod-hovers-zooming-blur', get_template_directory_uri() . '/css/hovers/thesod-hovers-zooming-blur.css');
	wp_register_style('thesod-hovers-horizontal-sliding', get_template_directory_uri() . '/css/hovers/thesod-hovers-horizontal-sliding.css');
	wp_register_style('thesod-hovers-vertical-sliding', get_template_directory_uri() . '/css/hovers/thesod-hovers-vertical-sliding.css');
	wp_register_style('thesod-hovers-gradient', get_template_directory_uri() . '/css/hovers/thesod-hovers-gradient.css');
	wp_register_style('thesod-hovers-circular', get_template_directory_uri() . '/css/hovers/thesod-hovers-circular.css');
	wp_register_style('thesod-blog-timeline-new', get_template_directory_uri() . '/css/thesod-blog-timeline-new.css');
	wp_register_style('icons-elegant', get_template_directory_uri() . '/css/icons-elegant.css');
	wp_register_style('icons-material', get_template_directory_uri() . '/css/icons-material.css');
	wp_register_style('icons-fontawesome', get_template_directory_uri() . '/css/icons-fontawesome.css');
	wp_register_style('thesod-quickfinders', get_template_directory_uri() . '/css/thesod-quickfinders.css');
	wp_register_style('thesod-quickfinders-vertical', get_template_directory_uri() . '/css/thesod-quickfinders-vertical.css');

	if (!thesod_get_option('disable_smooth_scroll')) {
		wp_enqueue_script('SmoothScroll', get_template_directory_uri() . '/js/SmoothScroll.js', array(), false, true);
	}

	/* Lazy Loading */
	wp_register_script('thesod-lazy-loading', get_template_directory_uri() . '/js/thesod-lazyLoading.js', array(), false, true);
	wp_register_style('thesod-lazy-loading-animations', get_template_directory_uri() . '/css/thesod-lazy-loading-animations.css');
	// wp_enqueue_script('jquery-transform', get_template_directory_uri() . '/js/jquery.transform.js', array(), false, true);
	// wp_enqueue_script('jquery-effects-drop', array(), false, true);


	wp_enqueue_script('thesod-scripts', get_template_directory_uri() . '/js/functions.js', array('jquery', 'thesod-form-elements'), false, true);
	if(thesod_get_option('custom_js')) {
		wp_add_inline_script('thesod-menu-init-script', stripslashes(thesod_get_option('custom_js')), 'before');
	}

	if (thesod_get_option('tracking_js')) {
		$is_show_tracking_js = true;

		if (class_exists('thesodGdpr') && !thesodGdpr::getInstance()->is_allow_consent(thesodGdpr::CONSENT_NAME_TRACKING)) {
			$is_show_tracking_js = false;
		}

		if ($is_show_tracking_js) {
			add_action('wp_head', 'thesod_get_tracking_js', 10);
			function thesod_get_tracking_js() {
				echo stripslashes(thesod_get_option('tracking_js'));
			}
		}
	}

	wp_enqueue_script('jquery-mousewheel', get_template_directory_uri() . '/js/fancyBox/jquery.mousewheel.pack.js', array(), false, true);
	wp_enqueue_script('jquery-fancybox', get_template_directory_uri() . '/js/fancyBox/jquery.fancybox.min.js', array(), false, true);
	wp_enqueue_script('fancybox-init-script', get_template_directory_uri() . '/js/fancyBox/jquery.fancybox-init.js', array('jquery-mousewheel', 'jquery-fancybox'), false, true);
	wp_enqueue_style('jquery-fancybox', get_template_directory_uri() . '/js/fancyBox/jquery.fancybox.min.css');

	wp_enqueue_style('thesod-vc_elements', get_template_directory_uri() . '/css/thesod-vc_elements.css');

	wp_register_script('thesod-blog-core', get_template_directory_uri() . '/js/thesod-blog-core.js', array('jquery', 'thesod-mediaelement', 'thesod-scroll-monitor', 'thesod-gallery', 'thesod-items-animations'), '', true);
	wp_register_script('thesod-blog', get_template_directory_uri() . '/js/thesod-blog.js', array('thesod-blog-core'), '', true);
	wp_register_script('thesod-blog-isotope', get_template_directory_uri() . '/js/thesod-blog-isotope.js', array('isotope-js', 'thesod-blog-core'), '', true);

	wp_register_script('imagesloaded', get_template_directory_uri() . '/js/imagesloaded.min.js', array('jquery'), '', true);
	wp_register_script('isotope-js', get_template_directory_uri() . '/js/isotope.min.js', array('jquery'), '', true);
	wp_register_script('thesod-scroll-monitor', get_template_directory_uri() . '/js/thesod-scrollMonitor.js', array(), '', true);
	wp_register_script('wheel-indicator', get_template_directory_uri() . '/js/wheel-indicator.js', array(), '', true);
	wp_register_script('thesod-page-scroller', get_template_directory_uri() . '/js/thesod-page-scroller.js', array('jquery', 'wheel-indicator', 'jquery-touchSwipe'), false, true);
	wp_register_script('thesod-parallax-footer', get_template_directory_uri() . '/js/thesod-parallax-footer.js', array('jquery'), false, true);
	if(is_404() && get_post(thesod_get_option('404_page')) && $page_404_inline_style = get_post_meta(thesod_get_option('404_page'), '_wpb_shortcodes_custom_css', true).get_post_meta(thesod_get_option('404_page'), '_wpb_post_custom_css', true)) {
		wp_add_inline_style('thesod-custom', strip_tags($page_404_inline_style));
	}
	$custom_footer_post_id = 0;
	if(thesod_get_option('custom_footer') && get_post(thesod_get_option('custom_footer'))) {
		$custom_footer_post_id = thesod_get_option('custom_footer');
	}
	$id = is_singular() ? get_the_ID() : 0;
	$header_params = thesod_get_sanitize_page_header_data($id);
	if(is_tax() || is_category() || is_tag()) {
		$thesod_term_id = get_queried_object()->term_id;
		$header_params = thesod_theme_options_get_page_settings('blog');
		if(get_term_meta($thesod_term_id , 'thesod_taxonomy_custom_page_options', true)) {
			$header_params = thesod_get_sanitize_page_header_data($thesod_term_id, array(), 'term');
		}
	}
	if($header_params['footer_custom'] && get_post($header_params['footer_custom'])) {
		$custom_footer_post_id = $header_params['footer_custom'];
	}
	if(get_post($custom_footer_post_id) && $custom_footer_inline_style = get_post_meta($custom_footer_post_id, '_wpb_shortcodes_custom_css', true).get_post_meta($custom_footer_post_id, '_wpb_post_custom_css', true)) {
		wp_add_inline_style('thesod-custom', strip_tags($custom_footer_inline_style));
	}

	$custom_title_post_id = 0;
	$id = is_singular() ? get_the_ID() : 0;
	$title_params = thesod_get_sanitize_page_title_data($id);
	if(is_tax() || is_category() || is_tag()) {
		$thesod_term_id = get_queried_object()->term_id;
		$title_params = thesod_theme_options_get_page_settings('blog');
		if(get_term_meta($thesod_term_id , 'thesod_taxonomy_custom_page_options', true)) {
			$title_params = thesod_get_sanitize_page_title_data($thesod_term_id, array(), 'term');
		}
	}
	if($title_params['title_style'] == 2 && $title_params['title_template'] && get_post($title_params['title_template'])) {
		$custom_title_post_id = $title_params['title_template'];
	}
	if($title_params['title_style'] == 2 && get_post($custom_title_post_id) && $custom_title_inline_style = get_post_meta($custom_title_post_id, '_wpb_shortcodes_custom_css', true).get_post_meta($custom_title_post_id, '_wpb_post_custom_css', true)) {
		wp_add_inline_style('thesod-custom', strip_tags($custom_title_inline_style));
	}

	if(thesod_is_plugin_active('woocommerce/woocommerce.php')) {
		if(is_shop() && get_post(wc_get_page_id('shop')) && $page_shop_inline_style = get_post_meta(wc_get_page_id('shop'), '_wpb_shortcodes_custom_css', true)) {
			wp_add_inline_style('thesod-custom', strip_tags($page_shop_inline_style));
		}
	}
}
add_action('wp_enqueue_scripts', 'thesod_scripts', 5);

function thesod_admin_scripts_init() {
	$jQuery_ui_theme = 'ui-no-theme';
	wp_enqueue_style('jquery-ui-no-theme', get_template_directory_uri() . '/css/jquery-ui/' . $jQuery_ui_theme . '/jquery-ui.css');
	wp_enqueue_script('thickbox');
	wp_enqueue_style('thickbox');
	wp_enqueue_script('media-upload');
	wp_enqueue_style('thesod-admin-styles', get_template_directory_uri() . '/css/thesod-admin.css', array(), '1.2');
	wp_enqueue_script('color-picker', get_template_directory_uri() . '/js/colorpicker/js/colorpicker.js');
	wp_enqueue_style('color-picker', get_template_directory_uri() . '/js/colorpicker/css/colorpicker.css');
	global $pagenow;
	wp_register_script('jquery-fancybox', get_template_directory_uri() . '/js/fancyBox/jquery.fancybox.min.js', array('jquery'));
	wp_register_style('jquery-fancybox', get_template_directory_uri() . '/js/fancyBox/jquery.fancybox.min.css');
	if($pagenow == 'themes.php' || $pagenow == 'update-core.php') {
		wp_enqueue_script('jquery-fancybox');
		wp_enqueue_style('jquery-fancybox');
	}
	wp_enqueue_script('thesod-admin-functions', get_template_directory_uri() . '/js/thesod-admin_functions.js', array('jquery'), '1.1');
	wp_localize_script('thesod-admin-functions', 'thesod_admin_functions_data', array(
		'ajax_url' => esc_url(admin_url('admin-ajax.php')),
		'ajax_nonce' => wp_create_nonce('ajax_security'),
	));
	wp_enqueue_script('thesod_page_settings-script', get_template_directory_uri() . '/js/thesod-page_meta_box_settings.js', array('jquery'));
	wp_register_script('thesod_js_composer_js_custom_views', get_template_directory_uri() . '/js/thesod-composer-custom-views.js', array( 'wpb_js_composer_js_view' ), '', true );
	wp_register_style('icons-elegant', get_template_directory_uri() . '/css/icons-elegant.css');
	wp_register_style('icons-material', get_template_directory_uri() . '/css/icons-material.css');
	wp_register_style('icons-fontawesome', get_template_directory_uri() . '/css/icons-fontawesome.css');
	wp_register_style('icons-arrows', get_template_directory_uri() . '/css/icons-arrows.css');

	wp_enqueue_script('thesod-icons-picker', get_template_directory_uri() . '/js/thesod-icons-picker.js', array('jquery'), '', true);
	wp_localize_script('thesod-icons-picker', 'thesod_iconsPickerData', array(
		'buttonTitle' => esc_html__('Select icon', 'thesod'),
		'ajax_url' => esc_url(admin_url('admin-ajax.php')),
		'ajax_nonce' => wp_create_nonce('ajax_security'),
	));
}
add_action('admin_enqueue_scripts', 'thesod_admin_scripts_init');


function thesod_vc_frontend_editor_enqueue_js_css() {
	wp_enqueue_style('icons-elegant', get_template_directory_uri() . '/css/icons-elegant.css');
	wp_enqueue_style('icons-material', get_template_directory_uri() . '/css/icons-material.css');
	wp_enqueue_style('icons-fontawesome', get_template_directory_uri() . '/css/icons-fontawesome.css');
	wp_enqueue_style('icons-arrows', get_template_directory_uri() . '/css/icons-arrows.css');

	if(thesod_icon_userpack_enabled()) {
		wp_enqueue_style('icons-userpack', get_stylesheet_directory_uri() . '/css/icons-userpack.css');
	}
	wp_enqueue_script('thesod-vc-editor-init', get_template_directory_uri() . '/js/thesod-vc-editor-init.js', array(), false, true );
}
add_action( 'vc_frontend_editor_enqueue_js_css', 'thesod_vc_frontend_editor_enqueue_js_css' );

/* OPEN GRAPH TAGS START */

function thesod_open_graph() {
	global $post;

	if (thesod_get_option('disable_og_tags') == 1) {
		return;
	}

	$og_description_length = 300;

	$output = "\n";

	if (is_singular(array('post', 'thesod_news', 'thesod_pf_item', 'product'))) {
		// title
		$og_title = esc_attr(strip_tags(stripslashes($post->post_title)));

		// description
		$og_description = trim($post->post_excerpt) != '' ? trim($post->post_excerpt) : trim($post->post_content);
		$og_description = esc_attr( strip_tags( strip_shortcodes( stripslashes( $og_description ) ) ) );
		$og_description = preg_replace('%\s+%', ' ', $og_description);
		if ($og_description_length)
			$og_description = substr( $og_description, 0, $og_description_length );
		if ($og_description == '')
			$og_description = $og_title;


		// site name
		$og_site_name = get_bloginfo('name');

		// type
		$og_type = 'article';

		// url
		$og_url = get_permalink();

		// image
		$og_image = '';
		$attachment_id = get_post_thumbnail_id($post->ID);
		if ($attachment_id) {
			$post_image = thesod_generate_thumbnail_src($attachment_id, 'thesod-blog-timeline-large');
			if ($post_image && $post_image[0]) {
				$og_image = $post_image[0];
			}
		}


		// Open Graph output
		$output .= '<meta property="og:title" content="'.trim(esc_attr($og_title)).'"/>'."\n";

		$output .= '<meta property="og:description" content="'.trim(esc_attr($og_description)).'"/>'."\n";

		$output .= '<meta property="og:site_name" content="'.trim(esc_attr($og_site_name)).'"/>'."\n";

		$output .= '<meta property="og:type" content="'.trim(esc_attr($og_type)).'"/>'."\n";

		$output .= '<meta property="og:url" content="'.trim(esc_attr($og_url)).'"/>'."\n";

		if (trim($og_image) != '')
			$output .= '<meta property="og:image" content="'.trim(esc_attr($og_image)).'"/>'."\n";

		// Google Plus output
		$output .= "\n";
		$output .= '<meta itemprop="name" content="'.trim(esc_attr($og_title)).'"/>'."\n";

		$output .= '<meta itemprop="description" content="'.trim(esc_attr($og_description)).'"/>'."\n";

		if (trim($og_image) != '')
			$output .= '<meta itemprop="image" content="'.trim(esc_attr($og_image)).'"/>'."\n";
	}

	echo $output;
}

add_action('wp_head', 'thesod_open_graph', 9999);

function thesod_open_graph_namespace($output) {
	if (!stristr($output,'xmlns:og')) {
		$output = $output . ' xmlns:og="http://ogp.me/ns#"';
	}
	if (!stristr($output,'xmlns:fb')) {
		$output=$output . ' xmlns:fb="http://ogp.me/ns/fb#"';
	}
	return $output;
}

add_filter('language_attributes', 'thesod_open_graph_namespace',9999);

/* OPEN GRAPH TAGS FINISH */

/* FONTS */

function thesod_additionals_fonts() {
	$thesod_fonts = apply_filters('thesod_additional_fonts', array());
	$thesod_fonts[] = array(
	'font_name' => 'Montserrat UltraLight',
	'font_url_eot' => get_template_directory_uri() . '/fonts/montserrat-ultralight.eot',
	'font_url_svg' => get_template_directory_uri() . '/fonts/montserrat-ultralight.svg',
	'font_svg_id' => 'montserratultra_light',
	'font_url_ttf' => get_template_directory_uri() . '/fonts/montserrat-ultralight.ttf',
	'font_url_woff' => get_template_directory_uri() . '/fonts/montserrat-ultralight.woff',
	);
	$user_fonts = get_option('thesod_additionals_fonts');
	if(is_array($user_fonts)) {
		return array_merge($user_fonts, $thesod_fonts);
	}

	return $thesod_fonts;
}

add_action('template_redirect', 'thesod_redirect_subpage');
function thesod_redirect_subpage() {
	global $post;

	$effects_params = thesod_get_sanitize_page_effects_data(get_the_ID());
	if ($effects_params['redirect_to_subpage']) {
		define('DONOTCACHEPAGE', 1);
		$pagekids = get_pages("child_of=".$post->ID."&sort_column=menu_order");
		if (count($pagekids) > 0) {
			$firstchild = $pagekids[0];
			wp_redirect(get_permalink($firstchild->ID));
		}
	}
}

add_action('init', 'thesod_google_fonts_load_file');
function thesod_google_fonts_load_file() {
	global $thesod_fontsFamilyArray, $thesod_fontsFamilyArrayFull;
	$thesod_fontsFamilyArray = array();
	$thesod_fontsFamilyArrayFull = array();
	$additionals_fonts = thesod_additionals_fonts();
	foreach($additionals_fonts as $additionals_font) {
		$thesod_fontsFamilyArray[$additionals_font['font_name']] = $additionals_font['font_name'];
		$thesod_fontsFamilyArrayFull[$additionals_font['font_name']] = array('family' => $additionals_font['font_name'], 'variants' => array('regular'), 'subsets' => array());
	}
	$thesod_fontsFamilyArray = array_merge($thesod_fontsFamilyArray, array(
		'Arial' => 'Arial',
		'Courier' => 'Courier',
		'Courier New' => 'Courier New',
		'Georgia' => 'Georgia',
		'Helvetica' => 'Helvetica',
		'Palatino' => 'Palatino',
		'Times New Roman' => 'Times New Roman',
		'Trebuchet MS' => 'Trebuchet MS',
		'Verdana' => 'Verdana'
	));
	$thesod_fontsFamilyArrayFull = array_merge($thesod_fontsFamilyArrayFull, array(
		'Arial' => array('family' => 'Arial', 'variants' => array('regular', 'italic', '700', '700italic'), 'subsets' => array()),
		'Courier' => array('family' => 'Courier', 'variants' => array('regular', 'italic', '700', '700italic'), 'subsets' => array()),
		'Courier New' => array('family' => 'Courier New', 'variants' => array('regular', 'italic', '700', '700italic'), 'subsets' => array()),
		'Georgia' => array('family' => 'Georgia', 'variants' => array('regular', 'italic', '700', '700italic'), 'subsets' => array()),
		'Helvetica' => array('family' => 'Helvetica', 'variants' => array('regular', 'italic', '700', '700italic'), 'subsets' => array()),
		'Palatino' => array('family' => 'Palatino', 'variants' => array('regular', 'italic', '700', '700italic'), 'subsets' => array()),
		'Times New Roman' => array('family' => 'Times New Roman', 'variants' => array('regular', 'italic', '700', '700italic'), 'subsets' => array()),
		'Trebuchet MS' => array('family' => 'Trebuchet MS', 'variants' => array('regular', 'italic', '700', '700italic'), 'subsets' => array()),
		'Verdana' => array('family' => 'Verdana', 'variants' => array('regular', 'italic', '700', '700italic'), 'subsets' => array()),
	));
	$fontsList = false;
	$font_json_file = file_get_contents(get_template_directory() . '/fonts/webfonts.json');
	if($font_json_file !== false) {
		$fontsList = json_decode($font_json_file);
	}
	if(is_object($fontsList) && isset($fontsList->kind) && $fontsList->kind == 'webfonts#webfontList' && isset($fontsList->items) && is_array($fontsList->items)) {
		foreach($fontsList->items as $item) {
			if(is_object($item) && isset($item->kind) && $item->kind == 'webfonts#webfont' && isset($item->family) && is_string($item->family)) {
				$thesod_fontsFamilyArray[$item->family] = $item->family;
				$thesod_fontsFamilyArrayFull[$item->family] = array(
					'family' => $item->family,
					'variants' => $item->variants,
					'subsets' => $item->subsets,
				);
			}
		}
	}
}

function thesod_fonts_list($full = false) {
	global $thesod_fontsFamilyArray, $thesod_fontsFamilyArrayFull;
	if($full) {
		return $thesod_fontsFamilyArrayFull;
	} else {
		return $thesod_fontsFamilyArray;
	}
}

function thesod_google_fonts_url() {
	if (class_exists('thesodGdpr')) {
		if (!thesodGdpr::getInstance()->is_allow_consent(thesodGdpr::CONSENT_NAME_GOOGLE_FONTS)) {
			return false;
		}
	}

	$options = thesod_get_theme_options();
	$fontsList = thesod_fonts_list(true);
	$fontElements = array_keys($options['fonts']['subcats']);
	$exclude_array = array('Arial', 'Courier', 'Courier New', 'Georgia', 'Helvetica', 'Palatino', 'Times New Roman', 'Trebuchet MS', 'Verdana');
	$additionals_fonts = thesod_additionals_fonts();
	foreach($additionals_fonts as $additionals_font) {
		$exclude_array[] = $additionals_font['font_name'];
	}
	$fonts = array();
	$variants = array();
	$subsets = array();
	foreach($fontElements as $element) {
		if(($font = thesod_get_option($element.'_family')) && !in_array($font, $exclude_array) && isset($fontsList[$font])) {
			$font = $fontsList[$font];
			if(thesod_get_option($element.'_sets')) {
				$font['subsets'] = thesod_get_option($element.'_sets');
			} else {
				$font['subsets'] = implode(',',$font['subsets']);
			}
			if(thesod_get_option($element.'_style')) {
				$font['variants'] = thesod_get_option($element.'_style');
			} else {
				$font['variants'] = 'regular';
			}

			if(!in_array($font['family'], $fonts))
				$fonts[] = $font['family'];

			if(!isset($variants[$font['family']]))
				$variants[$font['family']] = array();

			$tmp = explode(',', $font['variants']);
			foreach ($tmp as $v) {
				if(!in_array($v, $variants[$font['family']]))
					$variants[$font['family']][] = $v;
			}

			$tmp = explode(',', $font['subsets']);
			foreach ($tmp as $v) {
				if(!in_array($v, $subsets))
					$subsets[] = $v;
			}
		}
	}
	if(count($fonts) > 0) {
		$inc_fonts = '';
		foreach ($fonts as $k=>$v) {
			if('off' !== _x( 'on', $v.' font: on or off', 'thesod' )) {
				if($k > 0)
					$inc_fonts .= '|';
				$inc_fonts .= $v;
				if(!empty($variants[$v]))
					$inc_fonts .= ':'.implode(',', $variants[$v]);
			}
		}
		$query_args = array(
		'family' => urlencode($inc_fonts),
		'subset' => urlencode(implode(',', $subsets)),
		);
		$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
		return esc_url_raw( $fonts_url );
	}
	return false;
}

function thesod_custom_fonts() {
	$options = thesod_get_theme_options();
	$fontElements = array_keys($options['fonts']['subcats']);
	$additionals_fonts = thesod_additionals_fonts();
	$fonts_array = array();
	foreach($additionals_fonts as $additionals_font) {
		$fonts_array[] = $additionals_font['font_name'];
		$fonts_arrayFull[$additionals_font['font_name']] = $additionals_font;
	}
	$exclude_array = array();
	foreach($fontElements as $element) {
		if(($font = thesod_get_option($element.'_family')) && in_array($font, $fonts_array) && !in_array($font, $exclude_array)) {
			$exclude_array[] = $font;
?>

@font-face {
	font-family: '<?php echo sanitize_text_field($fonts_arrayFull[$font]['font_name']); ?>';
	src: url('<?php echo esc_url($fonts_arrayFull[$font]['font_url_eot']); ?>');
	src: url('<?php echo esc_url($fonts_arrayFull[$font]['font_url_eot']); ?>?#iefix') format('embedded-opentype'),
		url('<?php echo esc_url($fonts_arrayFull[$font]['font_url_woff']); ?>') format('woff'),
		url('<?php echo esc_url($fonts_arrayFull[$font]['font_url_ttf']); ?>') format('truetype'),
		url('<?php echo esc_url($fonts_arrayFull[$font]['font_url_svg'].'#'.$fonts_arrayFull[$font]['font_svg_id']); ?>') format('svg');
		font-weight: normal;
		font-style: normal;
}

<?php
		}
	}
}

add_action('wp_ajax_thesod_get_font_data', 'thesod_get_font_data');
function thesod_get_font_data() {
	if(is_array($_REQUEST['fonts'])) {
		$result = array();
		$fontsList = thesod_fonts_list(true);
		foreach ($_REQUEST['fonts'] as $font)
			if(isset($fontsList[$font]))
				$result[$font] = $fontsList[$font];
		echo json_encode($result);
		exit;
	}
	die(-1);
}

/* META BOXES */

if(!function_exists('thesod_print_select_input')) {
function thesod_print_select_input($values = array(), $value = '', $name = '', $id = '') {
	if(!is_array($values)) {
		$values = array();
	}
?>
	<select name="<?php echo esc_attr($name) ?>" id="<?php echo esc_attr($id); ?>" class="thesod-combobox">
		<?php foreach($values as $key => $title) : ?>
			<option value="<?php echo esc_attr($key); ?>" <?php selected($key, $value); ?>><?php echo esc_html($title); ?></option>
		<?php endforeach; ?>
	</select>
<?php
}
}

if(!function_exists('thesod_print_checkboxes')) {
function thesod_print_checkboxes($values = array(), $value = array(), $name = '', $id_prefix = '', $after = '') {
	if(!is_array($values)) {
		$values = array();
	}
	if(!is_array($value)) {
		$value = array();
	}
?>
	<?php foreach($values as $key => $title) : ?>
		<input name="<?php echo esc_attr($name); ?>" type="checkbox" id="<?php echo esc_attr($id_prefix.'-'.$key); ?>" value="<?php echo esc_attr($key); ?>" <?php checked(in_array($key, $value), 1); ?> />
		<label for="<?php echo esc_attr($id_prefix.'-'.$key); ?>"><?php echo esc_html($title); ?></label>
		<?php echo $after; ?>
	<?php endforeach; ?>
<?php
}
}

/* PLUGINS */

if(!function_exists('thesod_is_plugin_active')) {
	function thesod_is_plugin_active($plugin) {
		include_once(ABSPATH . 'wp-admin/includes/plugin.php');
		return is_plugin_active($plugin);
	}
}

/* DROPDOWN MENU */

class thesod_walker_primary_nav_menu extends Walker_Nav_Menu {
	function start_lvl(&$output, $depth = 0, $args = array()) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"sub-menu dl-submenu styled\">\n";
	}
}

class thesod_walker_footer_nav_menu extends Walker_Nav_Menu {
	function start_lvl(&$output, $depth = 0, $args = array()) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"sub-menu styled\">\n";
	}
}

function thesod_add_menu_item_classes($classes, $item) {
	$one_pager = false;
	if(is_singular()) {
		$effects_params = thesod_get_sanitize_page_effects_data(get_the_ID());
		$one_pager = $effects_params['effects_one_pager'];
	}
	if((is_post_type_archive('product') || is_tax('product_cat') || is_tax('product_tag')) && function_exists('wc_get_page_id')) {
		$page_id = wc_get_page_id('shop');
		$effects_params = thesod_get_sanitize_page_effects_data($page_id);
		$one_pager = $effects_params['effects_one_pager'];
	}
	if(!empty($item->current_item_ancestor) || !empty($item->current_item_parent)) {
		$classes[] = 'menu-item-current';
	}
	if(!empty($item->current) && !$one_pager) {
		$classes[] = 'menu-item-active';
	}
	return $classes;
}
add_filter('nav_menu_css_class', 'thesod_add_menu_item_classes', 10, 2);

function thesod_add_menu_parent_class($items) {
	$parents = array();
	foreach($items as $item) {
		if($item->menu_item_parent && $item->menu_item_parent > 0) {
			$parents[] = $item->menu_item_parent;
		}
	}
	foreach($items as $item) {
		if(in_array($item->ID, $parents)) {
			$item->classes[] = 'menu-item-parent';
		}
	}
	return $items;
}
add_filter('wp_nav_menu_objects', 'thesod_add_menu_parent_class');

function thesod_get_data($data = array(), $param = '', $default = '', $prefix = '', $suffix = '') {
	if(is_array($data) && !empty($data[$param])) {
		return $prefix.(nl2br($data[$param])).$suffix;
	}
	if(!empty($default)) {
		return $prefix.$default.$suffix;
	}
	return $default;
}

if(!function_exists('thesod_check_array_value')) {
function thesod_check_array_value($array = array(), $value = '', $default = '') {
	if(in_array($value, $array)) {
		return $value;
	}
	return $default;
}
}

/* PAGE TITLE */

function thesod_title($sep = '&raquo;', $display = true, $seplocation = '') {
	global $wpdb, $wp_locale;

	$m = get_query_var('m');
	$year = get_query_var('year');
	$monthnum = get_query_var('monthnum');
	$day = get_query_var('day');
	$search = get_query_var('s');
	$title = '';

	$t_sep = '%WP_TITILE_SEP%'; // Temporary separator, for accurate flipping, if necessary

	// If there is a post
	if(is_single() || is_page()) {
		$title = single_post_title('', false);
	}

	// If there's a post type archive
	if(is_post_type_archive()) {
		$post_type = get_query_var('post_type');
		if(is_array($post_type))
			$post_type = reset($post_type);
		$post_type_object = get_post_type_object($post_type);
		if(! $post_type_object->has_archive)
			$title = post_type_archive_title('', false);
	}

	// If there's a category or tag
	if(is_category() || is_tag()) {
		$title = single_term_title('', false);
	}

	// If there's a taxonomy
	if(is_tax()) {
		$term = get_queried_object();
		if($term) {
			$tax = get_taxonomy($term->taxonomy);
			$title = single_term_title('', false);
		}
	}

	// If there's an author
	if(is_author()) {
		$author = get_queried_object();
		if($author)
			$title = $author->display_name;
	}

	// Post type archives with has_archive should override terms.
	if(is_post_type_archive() && $post_type_object->has_archive)
		$title = post_type_archive_title('', false);

	// If there's a month
	if(is_archive() && !empty($m)) {
		$my_year = substr($m, 0, 4);
		$my_month = $wp_locale->get_month(substr($m, 4, 2));
		$my_day = intval(substr($m, 6, 2));
		$title = $my_year . ($my_month ? $t_sep . $my_month : '') . ($my_day ? $t_sep . $my_day : '');
	}

	// If there's a year
	if(is_archive() && !empty($year)) {
		$title = $year;
		if(!empty($monthnum))
			$title .= $t_sep . $wp_locale->get_month($monthnum);
		if(!empty($day))
			$title .= $t_sep . zeroise($day, 2);
	}

	// If it's a search
	if(is_search()) {
		/* translators: 1: separator, 2: search phrase */
		$title = sprintf(wp_kses(__('<span class="light">Search Results</span> <span class="highlight">"%1$s"</span>', 'thesod'), array('span' => array('class' => array()))), strip_tags($search));
	}

	// If it's a 404 page
	if(is_404()) {
		$title = esc_html__('Page not found', 'thesod');
		if(get_post(thesod_get_option('404_page'))) {
			$title = get_the_title(thesod_get_option('404_page'));
		}
	}

	$prefix = '';
	if(!empty($title))
		$prefix = " $sep ";

 	// Determines position of the separator and direction of the breadcrumb
	if('right' == $seplocation) { // sep on right, so reverse the order
		$title_array = explode($t_sep, $title);
		$title_array = array_reverse($title_array);
		$title = implode(" $sep ", $title_array) . $prefix;
	} else {
		$title_array = explode($t_sep, $title);
		$title = $prefix . implode(" $sep ", $title_array);
	}

	/**
	 * Filter the text of the page title.
	 *
	 * @since 2.0.0
	 *
	 * @param string $title	   Page title.
	 * @param string $sep		 Title separator.
	 * @param string $seplocation Location of the separator (left or right).
	 */
	$title = apply_filters('thesod_title', $title, $sep, $seplocation);

	// Send it out
	if($display)
		echo $title;
	else
		return $title;
}
if(!function_exists('thesod_page_title')) {
	function thesod_page_title()
	{
		$output = '';
		$title_class = '';
		$css_style = '';
		$css_style_title = '';
		$css_title_margin = '';
		$css_style_excerpt = '';
		$video_bg = '';
		$title_style = 1;
		$page_data = array();
		$parallax_bg = '';
		$xlarge = '';
		$excerpt = '';
		$rich_title = '';
		ob_start();
		gem_breadcrumbs();
		$breadcrumbs = '<div class="breadcrumbs-container"><div class="container">' . ob_get_clean() . '</div></div>';
		$alignment = 'center';
		if (is_singular() || is_tax() || is_category() || is_tag() || is_search() || is_archive() || is_post_type_archive('product') || is_tax('product_cat') || is_tax('product_tag') || (is_404() && get_post(thesod_get_option('404_page')))) {
			$post_id = 0;
			if (is_post_type_archive('product') || is_tax('product_cat') || is_tax('product_tag')) {
				$post_id = wc_get_page_id('shop');
			} elseif (is_404() && get_post(thesod_get_option('404_page'))) {
				$post_id = thesod_get_option('404_page');
			} elseif (is_singular()) {
				global $post;
				$post_id = $post->ID;
			}
			$page_data = thesod_get_sanitize_page_title_data($post_id);
			if (is_archive() && !$post_id) {
				$page_data = thesod_theme_options_get_page_settings('blog');
			}
			if (is_tax() || is_category() || is_tag()) {
				$thesod_term_id = get_queried_object()->term_id;
				if (get_term_meta($thesod_term_id, 'thesod_taxonomy_custom_page_options', true)) {
					$page_data = thesod_get_sanitize_page_title_data($thesod_term_id, array(), 'term');
				} else if (!is_tax('product_cat') && !is_tax('product_tag')) {
					$page_data = thesod_theme_options_get_page_settings('blog');
				}
			}

			if (is_search() && get_option('thesod_options_page_settings_search')) {
				$page_data = thesod_theme_options_get_page_settings('search');
			}
			$title_style = $page_data['title_style'];
			$xlarge = $page_data['title_xlarge'];
			if ($page_data['title_rich_content'] && $page_data['title_content']) {
				$rich_title = wpautop(do_shortcode(wp_kses_post($page_data['title_content'])));
			}
			if ($page_data['title_background_image']) {
				$css_style .= 'background-image: url(' . $page_data['title_background_image'] . ');';
				$title_class = 'has-background-image';
			}
			$parallax_bg = $page_data['title_background_parallax'];
			if ($page_data['title_background_color']) {
				$css_style .= 'background-color: ' . $page_data['title_background_color'] . ';';
			}
			if ($page_data['title_padding_top'] >= 0) {
				$css_style .= 'padding-top: ' . $page_data['title_padding_top'] . 'px;';
			}
			if ($page_data['title_padding_bottom'] >= 0) {
				$css_style .= 'padding-bottom: ' . $page_data['title_padding_bottom'] . 'px;';
			}
			$video_bg = thesod_video_background($page_data['title_video_type'], $page_data['title_video_background'], $page_data['title_video_aspect_ratio'], $page_data['title_menu_on_video'], $page_data['title_video_overlay_color'], $page_data['title_video_overlay_opacity'], $page_data['title_video_poster']);
			if ($page_data['title_text_color']) {
				$css_style_title .= 'color: ' . $page_data['title_text_color'] . ';';
			}
			if ($page_data['title_title_width'] > 0) {
				$css_style_title .= 'max-width: ' . $page_data['title_title_width'] . 'px;';
			}
			if ($page_data['title_excerpt_text_color']) {
				$css_style_excerpt .= 'color: ' . $page_data['title_excerpt_text_color'] . ';';
			}
			if ($page_data['title_excerpt_width'] > 0) {
				$css_style_excerpt .= 'max-width: ' . $page_data['title_excerpt_width'] . 'px;';
			}
			if ($page_data['title_top_margin']) {
				$css_title_margin .= 'margin-top: ' . $page_data['title_top_margin'] . 'px;';
			}
			if ($page_data['title_excerpt_top_margin']) {
				$css_style_excerpt .= 'margin-top: ' . $page_data['title_excerpt_top_margin'] . 'px;';
			}
			if ($page_data['title_alignment']) {
				$alignment = $page_data['title_alignment'];
			}
			if ($page_data['title_icon']) {
				$icon_data = array();
				foreach ($page_data as $key => $val) {
					if (strpos($key, 'title_icon') === 0) {
						$icon_data[str_replace('title_icon', 'icon', $key)] = $val;
					}
				}
				if (function_exists('thesod_build_icon_shortcode')) {
					$output .= '<div class="page-title-icon">' . do_shortcode(thesod_build_icon_shortcode($icon_data)) . '</div>';
				}
			}
			$excerpt = nl2br($page_data['title_excerpt']);
			if ($page_data['title_breadcrumbs'] || thesod_get_option('global_hide_breadcrumbs')) {
				$breadcrumbs = '';
			}
		}
		if (is_search() && !get_option('thesod_options_page_settings_search')) {
			$alignment = 'left';
			$icon_data = array(
				'icon_pack' => 'material',
				'icon' => 'f3de',
				'icon_color' => '#ffffff',
				'icon_size' => 'xlarge',
			);
			if (function_exists('thesod_build_icon_shortcode')) {
				$output .= '<div class="page-title-icon">' . do_shortcode(thesod_build_icon_shortcode($icon_data)) . '</div>';
			}
		}

		if ((is_tax() || is_category() || is_tag()) && !is_tax('product_cat') && !is_tax('product_tag')) {
			if (empty($excerpt)) {
				$term = get_queried_object();
				$excerpt = $term->description;
			}
		}

		$output .= '<div class="page-title-title" style="' . esc_attr($css_title_margin) . '">' . ($rich_title ? $rich_title : '<h1 style="' . esc_attr($css_style_title) . '"' . ($xlarge ? 'class="title-xlarge"' : '') . '>' . thesod_title('', false) . '</' . ($title_style == '2' ? 'h2' : 'h1') . '>') . '</div>';
		if ($excerpt) {
			$output .= '<div class="page-title-excerpt styled-subtitle" style="' . esc_attr($css_style_excerpt) . '">' . $excerpt . '</div>';
		}
		if($title_style == 2 && !empty($page_data['title_template']) && get_post($page_data['title_template']) && !(defined('WPB_VC_VERSION') && (vc_is_frontend_editor() || vc_is_page_editable()))) {
			global $thesod_page_title_template_data;
			$thesod_page_title_template_data = $page_data;
			$thesod_page_title_template_data['main_title'] = thesod_title('', false);
			$thesod_page_title_template_data['breadcrumbs_output'] = $breadcrumbs;
			ob_start();
			get_template_part('title-template');
			$output = ob_get_clean();
			return $output;
		} elseif ($title_style) {
			if ($parallax_bg) {
				wp_enqueue_script('thesod-parallax-vertical');
			}
			return '<div id="page-title" class="page-title-block page-title-alignment-' . esc_attr($alignment) . ' page-title-style-' . esc_attr($title_style) . ' ' . esc_attr($title_class) . ($parallax_bg ? ' page-title-parallax-background' : '') . '" style="' . esc_attr($css_style) . '">' . $video_bg . '<div class="container">' . $output . '</div>' . $breadcrumbs . '</div>';
		}
		return false;
	}
}

function thesod_post_type_archive_title($label, $post_type) {
	if($post_type == 'product') {
		$shop_page_id = wc_get_page_id('shop');
		$page_title = get_the_title($shop_page_id);
		return $page_title;
	}
	return $label;
}
add_filter('post_type_archive_title', 'thesod_post_type_archive_title', 10, 2);

add_filter('woocommerce_show_page_title', '__return_false');

/* EXCERPT */

function thesod_excerpt_length($length) {
	return thesod_get_option('excerpt_length') ? intval(thesod_get_option('excerpt_length')) : 20;
}
add_filter('excerpt_length', 'thesod_excerpt_length');

function thesod_excerpt_more($more) {
	return '...';
}
add_filter('excerpt_more', 'thesod_excerpt_more');

/* EDITOR */

add_action('admin_init', 'thesod_admin_init');
function thesod_admin_init() {
	add_filter('tiny_mce_before_init', 'thesod_init_editor');
	add_filter('mce_buttons_2', 'thesod_mce_buttons_2');
}

function thesod_mce_buttons_2($buttons) {
	array_unshift($buttons, 'styleselect');
	return $buttons;
}

if(!function_exists('thesod_init_editor')) {
	function thesod_init_editor($settings) {
		$style_formats = array(
			array(
				'title' => esc_html__('Styled Subtitle', 'thesod'),
				'block' => 'div',
				'classes' => 'styled-subtitle'
			),
			array(
				'title' => esc_html__('Title H1', 'thesod'),
				'block' => 'div',
				'classes' => 'title-h1'
			),
			array(
				'title' => esc_html__('Title H2', 'thesod'),
				'block' => 'div',
				'classes' => 'title-h2'
			),
			array(
				'title' => esc_html__('Title H3', 'thesod'),
				'block' => 'div',
				'classes' => 'title-h3'
			),
			array(
				'title' => esc_html__('Title H4', 'thesod'),
				'block' => 'div',
				'classes' => 'title-h4'
			),
			array(
				'title' => esc_html__('Title H5', 'thesod'),
				'block' => 'div',
				'classes' => 'title-h5'
			),
			array(
				'title' => esc_html__('Title H6', 'thesod'),
				'block' => 'div',
				'classes' => 'title-h6'
			),
			array(
				'title' => esc_html__('XLarge Title', 'thesod'),
				'block' => 'div',
				'classes' => 'title-xlarge'
			),
			array(
				'title' => esc_html__('Letter-spacing Title', 'thesod'),
				'inline' => 'span',
				'classes' => 'letter-spacing'
			),
			array(
				'title' => esc_html__('Light Title', 'thesod'),
				'inline' => 'span',
				'classes' => 'light'
			),
			array(
				'title' => esc_html__('Body small', 'thesod'),
				'block' => 'div',
				'classes' => 'small-body'
			),
		);
		$settings['wordpress_adv_hidden'] = false;
		$settings['style_formats'] = json_encode($style_formats);
		return $settings;
	}
}
/* SOCIALS */

function thesod_socials_icons_list() {
	return apply_filters('thesod_socials_icons_list', array(
		'facebook' => 'Facebook', 'linkedin' => 'LinkedIn', 'twitter' => 'Twitter', 'instagram' => 'Instagram',
		'pinterest' => 'Pinterest', 'stumbleupon' => 'StumbleUpon', 'rss' => 'RSS',
		'vimeo' => 'Vimeo', 'youtube' => 'YouTube', 'flickr' => 'Flickr', 'tumblr' => 'Tumblr',
		'wordpress' => 'WordPress', 'dribbble' => 'Dribbble', 'deviantart' => 'DeviantArt', 'share' => 'Share',
		'myspace' => 'Myspace', 'skype' => 'Skype', 'picassa' => 'Picassa', 'googledrive' => 'Google Drive',
		'blogger' => 'Blogger', 'spotify' => 'Spotify', 'delicious' => 'Delicious', 'telegram' => 'Telegram',
		'vk' => 'VK', 'whatsapp' => 'WhatsApp', 'viber' => 'Viber', 'ok' => 'OK', 'reddit' => 'Reddit',
		'slack' => 'Slack', 'askfm' => 'ASKfm', 'meetup' => 'Meetup', 'weibo' => 'Weibo', 'qzone' => 'Qzone',
	));
}
if(!function_exists('thesod_print_socials')) {
	function thesod_print_socials($type = '')
	{
		$socials_icons = array();
		$thesod_socials_icons = thesod_socials_icons_list();
		foreach (array_keys($thesod_socials_icons) as $icon) {
			thesod_additionals_socials_enqueue_style($icon);
			$socials_icons[$icon] = thesod_get_option($icon . '_active');
		}

		if (in_array(1, $socials_icons)) {
			?>
			<div class="socials inline-inside">
				<?php foreach ($socials_icons as $name => $active) : ?>
					<?php if ($active) : ?>
						<a class="socials-item" href="<?php echo esc_url(thesod_get_option($name . '_link')); ?>"
						   target="_blank" title="<?php echo esc_attr($thesod_socials_icons[$name]); ?>"><i
									class="socials-item-icon <?php echo esc_attr($name); ?> <?php echo($type ? 'social-item-' . $type : ''); ?>"></i></a>
					<?php endif; ?>
				<?php endforeach; ?>
				<?php do_action('thesod_print_socials'); ?>

			</div>
			<?php
		}
	}
}

/* PAGINATION */

function thesod_pagination($query = false) {
	if(!$query) {
		$query = $GLOBALS['wp_query'];
	}
	if($query->max_num_pages < 2) {
		return;
	}

	$paged		= (get_query_var('paged')) ? get_query_var('paged') : ((get_query_var('page')) ? get_query_var('page') : 1);
	$pagenum_link = html_entity_decode(get_pagenum_link());
	$query_args   = array();
	$url_parts	= explode('?', $pagenum_link);

	if(isset($url_parts[1])) {
		wp_parse_str($url_parts[1], $query_args);
	}

	$pagenum_link = remove_query_arg(array_keys($query_args), $pagenum_link);
	$pagenum_link = trailingslashit($pagenum_link) . '%_%';

	$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos($pagenum_link, 'index.php') ? 'index.php/' : '';
	$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit('page/%#%', 'paged') : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links(array(
		'base'	 => $pagenum_link,
		'format'   => $format,
		'total'	=> $query->max_num_pages,
		'current'  => $paged,
		'mid_size' => 1,
		'add_args' => array_map('urlencode', $query_args),
		'prev_text' => '',
		'next_text' => '',
	));

	if($links) :

	?>
	<div class="sod-pagination"><div class="sod-pagination-links">
		<?php echo $links; ?>
	</div></div><!-- .pagination -->
	<?php
	endif;
}

if(!function_exists('hex_to_rgb')) {
	function hex_to_rgb($color) {
		if(strpos($color, '#') === 0) {
			$color = substr($color, 1);
			if(strlen($color) == 3) {
				return array(hexdec($color[0]), hexdec($color[1]), hexdec($color[2]));
			} elseif(strlen($color) == 6) {
				return array(hexdec(substr($color, 0, 2)), hexdec(substr($color, 2, 2)), hexdec(substr($color, 4, 2)));
			}
		}
		return $color;
	}
}

function thesod_admin_bar_site_menu($wp_admin_bar) {
	if(! is_user_logged_in())
		return;
	if(! is_user_member_of_blog() && ! is_super_admin())
		return;

	$wp_admin_bar->add_menu(array(
		'id' => 'thesod-theme-options',
		'title' => esc_html__('Theme Options', 'thesod'),
		'href' => esc_url(admin_url('admin.php?page=thesod-theme-options')),
	));
	$wp_admin_bar->add_menu(array(
		'id'	=> 'thesod-support-center',
		'title' => esc_html__('Support Center', 'thesod'),
		'href'  => esc_url('https://codexthemes.ticksy.com/'),
		'meta' => array(
			'target' => '_blank',
		)
	));
	$wp_admin_bar->add_menu(array(
		'id'	=> 'thesod-documentation',
		'title' => esc_html__('Documentation', 'thesod'),
		'href'  => esc_url('http://codex-themes.com/thesod/documentation/'),
		'meta' => array(
			'target' => '_blank',
		)
	));
}
add_action('admin_bar_menu', 'thesod_admin_bar_site_menu', 100);

function thesod_wp_toolbar_css_admin() {
	if(is_admin_bar_showing()){
		wp_enqueue_style( 'thesod_wp_toolbar_css', get_template_directory_uri() . '/css/thesod-wp-toolbar-link.css','','', 'screen' );
	}
}
add_action( 'admin_enqueue_scripts', 'thesod_wp_toolbar_css_admin' );
add_action( 'wp_enqueue_scripts', 'thesod_wp_toolbar_css_admin' );

if(!function_exists('thesod_user_icons_info_link')) {
function thesod_user_icons_info_link($pack = '') {
	return esc_url(apply_filters('thesod_user_icons_info_link', get_template_directory_uri().'/fonts/icons-list-'.$pack.'.html', $pack));
}
}

/* THUMBNAILS */

function thesod_post_thumbnail($size = 'thesod-post-thumb', $dummy = true, $class='img-responsive img-circle', $attr = '') {
	if (empty($attr)) {
		$attr = array();
	}
	$attr = array_merge($attr, array('class' => $class));

	if (!empty($attr['srcset']) && is_array($attr['srcset'])) {
		$srcset_condtions = array();
		foreach ($attr['srcset'] as $condition => $condition_size) {
			$condition_size_image = thesod_generate_thumbnail_src(get_post_thumbnail_id(), $condition_size, false);
			if ($condition_size_image) {
				$srcset_condtions[] = esc_url($condition_size_image[0]) . ' ' . $condition;
			}
		}
		$attr['srcset'] = implode(', ', $srcset_condtions);
		$attr['sizes'] = '100vw';
	}

	if(has_post_thumbnail()) {
		the_post_thumbnail($size, $attr);
	} elseif($dummy) {
		echo '<span class="sod-dummy '.esc_attr($class).'"></span>';
	}
}

function thesod_attachment_url($attachcment, $size = 'full') {
	if((int)$attachcment > 0 && ($image_url = wp_get_attachment_url($attachcment, $size)) !== false) {
		return $image_url;
	}
	return false;
}

function thesod_generate_thumbnail_src_old($attachment_id, $size) {
	static $thesod_src_cache = array();

	if (!empty($thesod_src_cache[$attachment_id][$size])) {
		return $thesod_src_cache[$attachment_id][$size];
	}

	if(in_array($size, array_keys(thesod_image_sizes()))) {
		$filepath = get_attached_file($attachment_id);
		$thumbFilepath = $filepath;
		$image = wp_get_image_editor($filepath);
		if(!is_wp_error($image) && $image) {
			$thumbFilepath = $image->generate_filename($size);
			if(!file_exists($thumbFilepath)) {
				$thesod_image_sizes = thesod_image_sizes();
				if(!is_wp_error($image) && isset($thesod_image_sizes[$size])) {
					$image->resize($thesod_image_sizes[$size][0], $thesod_image_sizes[$size][1], $thesod_image_sizes[$size][2]);
					$image = $image->save($image->generate_filename($size));
					do_action('thesod_thumbnail_generated', array('/'._wp_relative_upload_path($thumbFilepath)));
				} else {
					$thumbFilepath = $filepath;
				}
			}
		}
		$image = wp_get_image_editor($thumbFilepath);
		if(!is_wp_error($image) && $image) {
			$upload_dir = wp_upload_dir();
			$sizes = $image->get_size();
			$result = array($upload_dir['baseurl'].'/'._wp_relative_upload_path($thumbFilepath), $sizes['width'], $sizes['height']);
			$thesod_src_cache[$attachment_id][$size] = $result;
			return $result;
		}
	}
	$result = wp_get_attachment_image_src($attachment_id, $size);
	$thesod_src_cache[$attachment_id][$size] = $result;
	return $result;
}

function thesod_get_thumbnail_image($attachment_id, $size, $icon = false, $attr = '') {
	$html = '';
	$image = thesod_generate_thumbnail_src($attachment_id, $size, $icon);
	if($image) {
		list($src, $width, $height) = $image;
		$hwstring = image_hwstring($width, $height);
		if(is_array($size))
			$size = join('x', $size);
		$attachment = get_post($attachment_id);
		$default_attr = array(
			'src' => $src,
			'class' => "attachment-$size",
			'alt' => trim(strip_tags(get_post_meta($attachment_id, '_wp_attachment_image_alt', true))),
		);
		if(empty($default_attr['alt']))
			$default_attr['alt'] = trim(strip_tags($attachment->post_excerpt));
		if(empty($default_attr['alt']))
			$default_attr['alt'] = trim(strip_tags($attachment->post_title));

		$attr = wp_parse_args($attr, $default_attr);
		$attr = apply_filters('wp_get_attachment_image_attributes', $attr, $attachment);
		$attr = array_map('esc_attr', $attr);
		$html = rtrim("<img $hwstring");
		foreach ($attr as $name => $value) {
			$html .= " $name=" . '"' . $value . '"';
		}
		$html .= ' />';
	}

	return $html;
}

function thesod_get_the_post_thumbnail($html, $post_id, $post_thumbnail_id, $size, $attr) {
	if(in_array($size, array_keys(thesod_image_sizes()))) {
		if($post_thumbnail_id) {
			do_action('begin_fetch_post_thumbnail_html', $post_id, $post_thumbnail_id, $size);
			if(in_the_loop())
				update_post_thumbnail_cache();
			$html = thesod_get_thumbnail_image($post_thumbnail_id, $size, false, $attr);
			do_action('end_fetch_post_thumbnail_html', $post_id, $post_thumbnail_id, $size);
		} else {
			$html = '';
		}
	}
	return $html;
}
add_filter('post_thumbnail_html', 'thesod_get_the_post_thumbnail', 10, 5);

function thesod_image_sizes() {
	return apply_filters('thesod_image_sizes', array(
		'thesod-post-thumb-large' => array(256, 256, true),
		'thesod-post-thumb-medium' => array(128, 128, true),
		'thesod-post-thumb-small' => array(80, 80, true),

		'thesod-portfolio-justified' => array(844, 767, true),

		'thesod-portfolio-justified-2x' => array(644, 585, true),
		'thesod-portfolio-justified-2x-500' => array(605, 550, true),
		'thesod-portfolio-justified-3x' => array(429, 390, true),
		'thesod-portfolio-justified-4x' => array(321, 292, true),
		'thesod-portfolio-justified-fullwidth-4x' => array(509, 463, true),
		'thesod-portfolio-justified-fullwidth-5x' => array(407, 370, true),

		'thesod-portfolio-masonry-2x' => array(644, 0, true),
		'thesod-portfolio-masonry-2x-500' => array(605, 0, true),
		'thesod-portfolio-masonry-3x' => array(429, 0, true),
		'thesod-portfolio-masonry-4x' => array(321, 0, true),
		'thesod-portfolio-masonry-fullwidth-4x' => array(509, 0, true),
		'thesod-portfolio-masonry-fullwidth-5x' => array(407, 0, true),

		'thesod-gallery-justified-2x' => array(644, 585, true),
		'thesod-gallery-justified-2x-500' => array(605, 550, true),
		'thesod-gallery-justified-3x' => array(429, 390, true),
		'thesod-gallery-justified-4x' => array(321, 292, true),
		'thesod-gallery-justified-5x' => array(347, 316, true),
		'thesod-gallery-justified-4x-small' => array(279, 254, true),
		'thesod-gallery-justified-fullwidth-4x' => array(509, 463, true),
		'thesod-gallery-justified-fullwidth-5x' => array(407, 370, true),
		'thesod-gallery-justified-double-4x-set' => array(671, 610, true),
		'thesod-gallery-justified-double-4x-set-horizontal' => array(671, 305, true),
		'thesod-gallery-justified-double-4x-set-vertical' => array(336, 671, true),

		'thesod-gallery-masonry-2x' => array(644, 0, true),
		'thesod-gallery-masonry-2x-500' => array(605, 0, true),
		'thesod-gallery-masonry-3x' => array(429, 0, true),
		'thesod-gallery-masonry-4x' => array(321, 0, true),
		'thesod-gallery-masonry-5x' => array(347, 0, true),
		'thesod-gallery-masonry-4x-small' => array(279, 0, true),
		'thesod-gallery-masonry-fullwidth-4x' => array(509, 0, true),
		'thesod-gallery-masonry-fullwidth-5x' => array(407, 0, true),

		'thesod-blog-masonry-3x' => array(360, 0, true),
		'thesod-blog-masonry-3x-450' => array(450, 0, true),
		'thesod-blog-masonry-3x-600' => array(600, 0, true),

		'thesod-blog-default-large' => array(1170, 540, true),
		'thesod-blog-default-medium' => array(780, 360, true),
		'thesod-blog-default-small' => array(520, 240, true),
		'thesod-blog-timeline' => array(440, 0, true),
		'thesod-blog-timeline-small' => array(370, 0, true),
		'thesod-blog-timeline-large' => array(720, 0, true),
		'thesod-blog-default' => array(1170, 540, true),
		'thesod-blog-justified' => array(640, 480, true),
		'thesod-blog-justified-3x' => array(360, 270, true),
		'thesod-blog-justified-3x-small' => array(320, 240, true),
		'thesod-blog-justified-4x' => array(220, 165, true),
		'thesod-blog-justified-sticky' => array(1280, 960, true),
		'thesod-blog-masonry-100' => array(380, 0, true),
		'thesod-blog-masonry-100-medium' => array(450, 0, true),
		'thesod-blog-masonry-100-small' => array(230, 0, true),
		'thesod-blog-masonry' => array(640, 0, true),
		'thesod-blog-masonry-4x' => array(258, 0, true),
		'thesod-blog-masonry-sticky' => array(1280, 0, true),
		'thesod-blog-compact' => array(366, 296, true),
		'thesod-blog-slider-fullwidth' => array(1170, 525, true),
		'thesod-blog-slider-halfwidth' => array(564, 525, true),

		'thesod-portfolio-double-2x' => array(1287, 1170, true),

		'thesod-portfolio-double-3x' => array(843, 934, true),
		'thesod-portfolio-double-3x-gap-0' => array(858, 948, true),
		'thesod-portfolio-double-3x-gap-18' => array(851, 942, true),
		'thesod-portfolio-double-3x-hover' => array(843, 766, true),
		'thesod-portfolio-double-3x-hover-gap-0' => array(858, 780, true),
		'thesod-portfolio-double-3x-hover-gap-18' => array(851, 774, true),

		'thesod-portfolio-double-4x' => array(620, 732, true),
		'thesod-portfolio-double-4x-gap-0' => array(644, 753, true),
		'thesod-portfolio-double-4x-gap-18' => array(634, 744, true),
		'thesod-portfolio-double-4x-hover' => array(620, 563 , true),
		'thesod-portfolio-double-4x-hover-gap-0' => array(643, 584, true),
		'thesod-portfolio-double-4x-hover-gap-18' => array(634, 575, true),

		'thesod-portfolio-double-100' => array(1056, 960, true),
		'thesod-portfolio-double-100-page' => array(1017, 1094, true),

		'thesod-portfolio-double-100-page-horizontal' => array(1017, 463, true),
		'thesod-portfolio-double-100-page-vertical' => array(602, 1094, true),

		'thesod-portfolio-double-100-horizontal' => array(1284, 585, true),

		'thesod-portfolio-double-2x-horizontal' => array(1287, 585, true),

		'thesod-portfolio-double-3x-horizontal' => array(843, 362, true),
		'thesod-portfolio-double-3x-gap-0-horizontal' => array(843, 390, true),
		'thesod-portfolio-double-3x-gap-18-horizontal' => array(843, 378, true),
		'thesod-portfolio-double-3x-hover-horizontal' => array(843, 362, true),
		'thesod-portfolio-double-3x-hover-gap-0-horizontal' => array(843, 390, true),
		'thesod-portfolio-double-3x-hover-gap-18-horizontal' => array(843, 378, true),

		'thesod-portfolio-double-4x-horizontal' => array(868, 366, true),
		'thesod-portfolio-double-4x-gap-0-horizontal' => array(868, 409, true),
		'thesod-portfolio-double-4x-gap-18-horizontal' => array(868, 391, true),
		'thesod-portfolio-double-4x-hover-horizontal' => array(868, 366, true),
		'thesod-portfolio-double-4x-hover-gap-0-horizontal' => array(868, 409, true),
		'thesod-portfolio-double-4x-hover-gap-18-horizontal' => array(868, 391, true),

		'thesod-portfolio-double-100-vertical' => array(602, 1500, true),

		'thesod-portfolio-double-2x-vertical' => array(644, 1172, true),

		'thesod-portfolio-double-3x-vertical' => array(518, 1212, true),
		'thesod-portfolio-double-3x-gap-0-vertical' => array(558, 1229, true),
		'thesod-portfolio-double-3x-gap-18-vertical' => array(540, 1222, true),
		'thesod-portfolio-double-3x-hover-vertical' => array(518, 995, true),
		'thesod-portfolio-double-3x-hover-gap-0-vertical' => array(558, 1013, true),
		'thesod-portfolio-double-3x-hover-gap-18-vertical' => array(540, 1005, true),

		'thesod-portfolio-double-4x-vertical' => array(373, 952, true),
		'thesod-portfolio-double-4x-gap-0-vertical' => array(380, 983, true),
		'thesod-portfolio-double-4x-gap-18-vertical' => array(399, 965, true),
		'thesod-portfolio-double-4x-hover-vertical' => array(373, 952, true),
		'thesod-portfolio-double-4x-hover-gap-0-vertical' => array(418, 760, true),
		'thesod-portfolio-double-4x-hover-gap-18-vertical' => array(399, 748, true),

		'thesod-portfolio-1x' => array(858, 420, true),
		'thesod-portfolio-1x-sidebar' => array(751, 500, true),
		'thesod-portfolio-1x-hover' => array(1287, 567, true),

		'thesod-portfolio-metro' => array(0, 500, false),
		'thesod-portfolio-metro-medium' => array(0, 300, false),
		'thesod-portfolio-metro-retina' => array(0, 1000, false),

		'thesod-portfolio-masonry' => array(754, 0, false),
		'thesod-portfolio-masonry-double' => array(1508, 0, false),

		'thesod-portfolio-masonry-double-horizontal' => array(1508, 0, false),
		'thesod-portfolio-masonry-double-vertical' => array(754, 0, false),

		'thesod-gallery-justified' => array(660, 600, true),
		'thesod-gallery-justified-double' => array(880, 800, true),
		'thesod-gallery-justified-double-horizontal' => array(880, 400, true),
		'thesod-gallery-justified-double-vertical' => array(440, 870, true),

		'thesod-gallery-justified-100' => array(660, 600, true),
		'thesod-gallery-justified-double-100' => array(1320, 1200, true),
		'thesod-gallery-justified-double-100-horizontal' => array(1320, 600, true),
		'thesod-gallery-justified-double-100-vertical' => array(660, 1200, true),

		'thesod-gallery-justified-double-100-horizontal-4' => array(1019, 464, true),
		'thesod-gallery-justified-double-100-horizontal-5' => array(814, 371, true),
		'thesod-gallery-justified-double-100-horizontal-6' => array(594, 271, true),
		'thesod-gallery-justified-double-100-squared-4' => array(1019, 927, true),
		'thesod-gallery-justified-double-100-squared-5' => array(814, 741, true),
		'thesod-gallery-justified-double-100-squared-6' => array(594, 541, true),
		'thesod-gallery-justified-double-100-vertical-4' => array(510, 928, true),
		'thesod-gallery-justified-double-100-vertical-5' => array(407, 742, true),
		'thesod-gallery-justified-double-100-vertical-6' => array(297, 542, true),

		'thesod-gallery-masonry-double-100-horizontal-4' => array(1019, 0, true),
		'thesod-gallery-masonry-double-100-horizontal-5' => array(814, 0, true),
		'thesod-gallery-masonry-double-100-horizontal-6' => array(594, 0, true),
		'thesod-gallery-masonry-double-100-squared-4' => array(1019, 0, true),
		'thesod-gallery-masonry-double-100-squared-5' => array(814, 0, true),
		'thesod-gallery-masonry-double-100-squared-6' => array(594, 0, true),
		'thesod-gallery-masonry-double-100-vertical-4' => array(510, 0, true),
		'thesod-gallery-masonry-double-100-vertical-5' => array(407, 0, true),
		'thesod-gallery-masonry-double-100-vertical-6' => array(297, 0, true),

		'thesod-gallery-justified-double-4x' => array(766, 697, true),
		'thesod-gallery-justified-double-4x-squared' => array(766, 697, true),
		'thesod-gallery-justified-double-4x-horizontal' => array(766, 349, true),
		'thesod-gallery-justified-double-4x-vertical' => array(383, 697, true),

		'thesod-gallery-masonry-double-4x-squared' => array(766, 0, true),
		'thesod-gallery-masonry-double-4x-horizontal' => array(766, 0, true),
		'thesod-gallery-masonry-double-4x-vertical' => array(383, 0, true),

		'thesod-gallery-masonry' => array(660, 0, false),
		'thesod-gallery-masonry-double' => array(880, 0, false),
		'thesod-gallery-masonry-double-4x' => array(766, 0, true),
		'thesod-gallery-masonry-double-horizontal' => array(880, 0, false),
		'thesod-gallery-masonry-double-vertical' => array(440, 0, false),

		'thesod-gallery-masonry-100' => array(660, 0, false),
		'thesod-gallery-masonry-double-100' => array(1320, 0, false),
		'thesod-gallery-masonry-double-100-horizontal' => array(1320, 0, false),
		'thesod-gallery-masonry-double-100-vertical' => array(660, 0, false),

		'thesod-gallery-metro' => array(0, 500, false),
		'thesod-gallery-metro-medium' => array(0, 300, false),
		'thesod-gallery-metro-retina' => array(0, 1000, false),
		'thesod-gallery-fullwidth' => array(1170, 540, true),
		'thesod-gallery-sidebar' => array(867, 540, true),
		'thesod-gallery-simple' => array(522, 700, true),
		'thesod-gallery-simple-1x' => array(261, 350, true),
		'thesod-person' => array(400, 400, true),
		'thesod-person-80' => array(80, 80, true),
		'thesod-person-160' => array(160, 160, true),
		'thesod-person-240' => array(240, 240, true),
		'thesod-testimonial' => array(400, 400, true),
		'thesod-news-carousel' => array(144, 144, true),
		'thesod-portfolio-carusel-2x' => array(644, 395, true),
		'thesod-portfolio-carusel-3x' => array(473, 290, true),
		'thesod-portfolio-carusel-4x' => array(580, 370, true),
		'thesod-portfolio-carusel-5x' => array(465, 298, true),
		'thesod-portfolio-carusel-full-3x' => array(704, 450, true),
		'thesod-portfolio-carusel-2x-masonry' => array(644, 0, true),
		'thesod-portfolio-carusel-3x-masonry' => array(473, 0, true),
		'thesod-portfolio-carusel-4x-masonry' => array(580, 0, true),
		'thesod-portfolio-carusel-5x-masonry' => array(465, 0, true),
		'thesod-portfolio-carusel-full-3x-masonry' => array(704, 0, true),
		'thesod-widget-column-1x' => array(80, 80, true),
		'thesod-widget-column-2x' => array(160, 160, true),
		'thesod-product-catalog' => array(thesod_get_option('woocommerce_catalog_image_width'), thesod_get_option('woocommerce_catalog_image_height'), true),
		'thesod-product-single' => array(thesod_get_option('woocommerce_product_image_width'), thesod_get_option('woocommerce_product_image_height'), true),
		'thesod-product-thumbnail' => array(thesod_get_option('woocommerce_thumbnail_image_width'), thesod_get_option('woocommerce_thumbnail_image_height'), true),

		'thesod-news-grid-metro-video' => array(1245, 700, true),

        'thesod-featured-post-slide' => array(1170, 0, false),
        'thesod-featured-post-slide-fullwidth' => array(1920, 0, false),
	));
}

function thesod_remove_generate_thumbnails($metadata, $attachment_id) {
	$filepath = get_attached_file($attachment_id);
	if (!$filepath) {
		return $metadata;
	}

	$regenerated = get_option(thesod_get_image_regenerated_option_key());
	$regenerated = !empty($regenerated) ? (array) $regenerated : array();

	$image_editor = new thesod_Dummy_WP_Image_Editor($filepath);
	foreach (thesod_image_sizes() as $key => $val) {
		$thumb_filepath = $image_editor->generate_filename($key);
		if (file_exists($thumb_filepath)) {
			unlink($thumb_filepath);
		}
	}

	$regenerated[$attachment_id] = time();
	update_option(thesod_get_image_regenerated_option_key(), $regenerated);

	return $metadata;
}
add_filter('wp_generate_attachment_metadata', 'thesod_remove_generate_thumbnails', 10, 2);

/* FOOTER */

function thesod_is_effects_disabled() {
	$effects_disabled = false;
	if(is_home()) {
		$effects_disabled = thesod_get_option('home_effects_disabled', false);
	} else {
		global $post;
		if(is_object($post)) {
			$thesod_page_data = get_post_meta($post->ID, 'thesod_page_data', true);
		} elseif((is_post_type_archive('product') || is_tax('product_cat') || is_tax('product_tag')) && function_exists('wc_get_page_id')) {
			$thesod_page_data = get_post_meta(wc_get_page_id('shop'), 'thesod_page_data', true);
		} else {
			$thesod_page_data = null;
		}

		if($thesod_page_data) {
			$effects_disabled = isset($thesod_page_data['effects_disabled']) ? (bool) $thesod_page_data['effects_disabled'] : false;
		}
	}
	return $effects_disabled;
}

function thesod_print_head_script() {
	$effects_disabled = thesod_is_effects_disabled();

	wp_enqueue_script('thesod-settings-init', get_template_directory_uri() . '/js/thesod-settings-init.js', false, false, false);
	wp_localize_script('thesod-settings-init', 'gemSettings', array(
		'isTouch' => false,
		'forcedLasyDisabled' => $effects_disabled,
		'tabletPortrait' => thesod_get_option('menu_appearance_tablet_portrait') == 'responsive',
		'tabletLandscape' => thesod_get_option('menu_appearance_tablet_landscape') == 'responsive',
		'topAreaMobileDisable' => thesod_get_option('top_area_disable_mobile') == 'responsive',
		'parallaxDisabled' => false,
		'fillTopArea' => false,
		'themePath' => get_template_directory_uri(),
		'rootUrl' => get_site_url(),
		'mobileEffectsEnabled' => thesod_get_option('enable_mobile_lazy_loading') == 1,
		'isRTL' => is_rtl()
	));
}
add_action('wp_enqueue_scripts', 'thesod_print_head_script', 1);


/* FONTS MANAGER */

/* Create fonts manager page */
add_action( 'admin_menu', 'thesod_fonts_manager_add_page', 30);
function thesod_fonts_manager_add_page() {
	$page = add_submenu_page('thesod-theme-options', esc_html__('Self-Hosted Fonts','thesod'), esc_html__('Self-Hosted Fonts','thesod'), 'edit_theme_options', 'fonts-manager', 'thesod_fonts_manager_page');
	add_action('load-' . $page, 'thesod_fonts_manager_page_prepend');
}

/* Admin theme page scripts & css */
function thesod_fonts_manager_page_prepend() {
	wp_enqueue_media();
	wp_enqueue_script('thesod-file-selector', get_template_directory_uri() . '/js/thesod-file-selector.js');
	wp_enqueue_script('thesod-font-manager', get_template_directory_uri() . '/js/thesod-font-manager.js');
}

/* Build admin theme page form */
function thesod_fonts_manager_page(){
	$additionals_fonts = get_option('thesod_additionals_fonts');

	$fallback_fonts_elements_list = array();
	$thesod_get_theme_options = thesod_get_theme_options();
	foreach ($thesod_get_theme_options['fonts']['subcats'] as $key=>$item) {
		$fallback_fonts_elements_list[$key]['title'] = $item['title'];
		$font_only = true;
		foreach ($item['options'] as $k=>$option) {
			if (preg_match('/font_size/', $k)) {
				$fallback_fonts_elements_list[$key]['font_size'] = thesod_get_option($k);
				$font_only = false;
			}

			if (preg_match('/line_height/', $k)) {
				$fallback_fonts_elements_list[$key]['line_height'] = thesod_get_option($k);
				$font_only = false;
			}

			$fallback_fonts_elements_list[$key]['only_font'] = $font_only;
		}
	}
?>

<div class="wrap ui-no-theme">
	<h2><?php esc_html_e('Self-Hosted Fonts', 'thesod'); ?></h2>
	<p><?php esc_html_e('Here you can upload your own font files or google font files on your own server to use it in your website directly. After adding the font files the corresponding fonts will be available for selection in "Fonts" section of Theme Options.', 'thesod'); ?></p>

	<div id="fonts-manager-wrap">
		<div class="font-pane-template">
			<div class="remove"><a href="javascript:void(0);"><?php esc_html_e('Remove', 'thesod'); ?></a></div>
			<?php $field_pfx = 'fonts[{{i}}]'; ?>
			<div class="field">
				<div class="label"><label for=""><?php esc_html_e('Font name', 'thesod'); ?></label></div>
				<div class="input"><input type="text" name="<?php echo $field_pfx; ?>[font_name]" value="" class="field-font-name" /></div>
			</div>
			<div class="field">
				<div class="label"><label for=""><?php esc_html_e('Font file EOT url', 'thesod'); ?></label></div>
				<div class="file_url"><input type="text" name="<?php echo $field_pfx; ?>[font_url_eot]" value="" data-type="application/vnd.ms-fontobject" /></div>
			</div>
			<div class="field">
				<div class="label"><label for=""><?php esc_html_e('Font file SVG url', 'thesod'); ?></label></div>
				<div class="file_url"><input type="text" name="<?php echo $field_pfx; ?>[font_url_svg]" value="" data-type="image/svg+xml" /></div>
			</div>
			<div class="field">
				<div class="label"><label for=""><?php esc_html_e('ID inside SVG', 'thesod'); ?></label></div>
				<div class="input"><input type="text" name="<?php echo $field_pfx; ?>[font_svg_id]" value="" /></div>
			</div>
			<div class="field">
				<div class="label"><label for=""><?php esc_html_e('Font file TTF url', 'thesod'); ?></label></div>
				<div class="file_url"><input type="text" name="<?php echo $field_pfx; ?>[font_url_ttf]" value="" data-type="application/x-font-ttf" /></div>
			</div>
			<div class="field">
				<div class="label"><label for=""><?php esc_html_e('Font file WOFF url', 'thesod'); ?></label></div>
				<div class="file_url"><input type="text" name="<?php echo $field_pfx; ?>[font_url_woff]" value="" data-type="application/x-font-woff" /></div>
			</div>

			<?php if (class_exists('thesodGdpr')): ?>
				<div class="field field-fallback-fonts">
					<div class="field-fallback-checkbox">
						<input type="hidden" name="<?php echo $field_pfx; ?>[font_is_fallback]" value="">
						<input type="checkbox" class="input-checkbox-is-fallback">
						<label for=""><?php esc_html_e('Use as a fallback font for privacy settings.', 'thesod'); ?></label>
					</div>
					<p><?php esc_html_e('if google fonts are disabled by website visitor in privacy preferences', 'thesod'); ?></p>

					<div class="fallback-fonts-elements-box hide">
						<div class="fallback-fonts-elements-add">
							<select>
								<option value=""></option>
								<?php foreach ($fallback_fonts_elements_list as $k=>$v): ?>
									<option value="<?php echo $k; ?>"
											<?php echo ($v['only_font'] ? 'data-font-only="'.$v['only_font'].'"':''); ?>
											<?php echo (!empty($v['font_size']) ? 'data-font-size="'.$v['font_size'].'"':''); ?>
											<?php echo (!empty($v['line_height']) ? 'data-line-height="'.$v['line_height'].'"':''); ?>
											><?php echo $v['title']; ?></option>
								<?php endforeach; ?>
							</select>
							<button class="button" type="button">+</button>
						</div>
						<div class="fallback-fonts-elements-items-box">
							<?php $field_el_pfx = 'fonts[{{i}}][font_fallback_elements][{{el}}]'; ?>
							<div class="fallback-fonts-elements-item">
								<div class="fallback-fonts-elements-item-header">
									<div class="fallback-fonts-elements-item-title">
										<label></label>
										<input type="hidden" name="<?php echo $field_el_pfx; ?>[name]">
									</div>
									<button type="button" class="button"><?php esc_html_e('Remove', 'thesod'); ?></button>
								</div>
								<div class="fallback-fonts-elements-item-body">
									<div class="fallback-fonts-elements-item-field">
										<label for=""><?php esc_html_e('Font Size', 'thesod'); ?></label>
										<div class="fixed-number">
											<input class="fonts-elements-item-font-size" name="<?php echo $field_el_pfx; ?>[font_size]" value="14" data-min-value="10" data-max-value="100" type="number">
										</div>
									</div>
									<div class="fallback-fonts-elements-item-field">
										<label for=""><?php esc_html_e('Line Height', 'thesod'); ?></label>
										<div class="fixed-number">
											<input class="fonts-elements-item-line-height" name="<?php echo $field_el_pfx; ?>[line_height]" value="25" data-min-value="10" data-max-value="150" type="number">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>

		<form id="fonts-manager-form" method="POST" enctype="multipart/form-data">
			<div class="fonts-manager-form-fields">
		<?php if(is_array($additionals_fonts)) : ?>
					<?php foreach($additionals_fonts as $key_font=>$font) : ?>
						<div class="font-pane" data-item="<?php echo $key_font; ?>">
					<div class="remove"><a href="javascript:void(0);"><?php esc_html_e('Remove', 'thesod'); ?></a></div>
							<?php $field_pfx = 'fonts['.$key_font.']'; ?>
					<div class="field">
						<div class="label"><label for=""><?php esc_html_e('Font name', 'thesod'); ?></label></div>
								<div class="input"><input type="text" name="<?php echo $field_pfx; ?>[font_name]" value="<?php echo esc_attr($font['font_name']); ?>" class="field-font-name" /></div>
					</div>
					<div class="field">
						<div class="label"><label for=""><?php esc_html_e('Font file EOT url', 'thesod'); ?></label></div>
								<div class="file_url"><input type="text" name="<?php echo $field_pfx; ?>[font_url_eot]" value="<?php echo esc_attr($font['font_url_eot']); ?>" data-type="application/vnd.ms-fontobject" /></div>
					</div>
					<div class="field">
						<div class="label"><label for=""><?php esc_html_e('Font file SVG url', 'thesod'); ?></label></div>
								<div class="file_url"><input type="text" name="<?php echo $field_pfx; ?>[font_url_svg]" value="<?php echo esc_attr($font['font_url_svg']); ?>" data-type="image/svg+xml" /></div>
					</div>
					<div class="field">
						<div class="label"><label for=""><?php esc_html_e('ID inside SVG', 'thesod'); ?></label></div>
								<div class="input"><input type="text" name="<?php echo $field_pfx; ?>[font_svg_id]" value="<?php echo esc_attr($font['font_svg_id']); ?>" /></div>
					</div>
					<div class="field">
						<div class="label"><label for=""><?php esc_html_e('Font file TTF url', 'thesod'); ?></label></div>
								<div class="file_url"><input type="text" name="<?php echo $field_pfx; ?>[font_url_ttf]" value="<?php echo esc_attr($font['font_url_ttf']); ?>" data-type="application/x-font-ttf" /></div>
					</div>
					<div class="field">
						<div class="label"><label for=""><?php esc_html_e('Font file WOFF url', 'thesod'); ?></label></div>
								<div class="file_url"><input type="text" name="<?php echo $field_pfx; ?>[font_url_woff]" value="<?php echo esc_attr($font['font_url_woff']); ?>" data-type="application/x-font-woff" /></div>
					</div>

							<?php if (class_exists('thesodGdpr')): ?>
								<div class="field field-fallback-fonts">
									<div class="field-fallback-checkbox">
										<?php $font_is_fallback = !empty($font['font_is_fallback']) ? $font['font_is_fallback'] : null;  ?>
										<input type="hidden" name="<?php echo $field_pfx; ?>[font_is_fallback]" value="<?php echo esc_attr($font_is_fallback); ?>">
										<input type="checkbox" class="input-checkbox-is-fallback" <?php checked(esc_attr($font_is_fallback)); ?>>
										<label for=""><?php esc_html_e('Use as a fallback font for privacy settings.', 'thesod'); ?></label>
									</div>
									<p><?php esc_html_e('if google fonts are disabled by website visitor in privacy preferences', 'thesod'); ?></p>

									<div class="fallback-fonts-elements-box <?php echo (empty($font['font_is_fallback']) ? 'hide' : ''); ?>">
										<div class="fallback-fonts-elements-add">
											<select>
												<option value=""></option>
												<?php foreach ($fallback_fonts_elements_list as $k=>$v): ?>
													<option value="<?php echo $k; ?>"
														<?php echo ($v['only_font'] ? 'data-font-only="'.$v['only_font'].'"':''); ?>
														<?php echo (!empty($v['font_size']) ? 'data-font-size="'.$v['font_size'].'"':''); ?>
														<?php echo (!empty($v['line_height']) ? 'data-line-height="'.$v['line_height'].'"':''); ?>
													><?php echo $v['title']; ?></option>
												<?php endforeach; ?>
											</select>
											<button class="button" type="button">+</button>
										</div>
										<div class="fallback-fonts-elements-items-box">
											<?php if (!empty($font['font_fallback_elements'])): ?>
												<?php foreach ($font['font_fallback_elements'] as $el_key=>$fallback_element): ?>
													<?php $field_el_pfx = $field_pfx.'[font_fallback_elements]['.$el_key.']'; ?>
													<div class="fallback-fonts-elements-item" data-id="<?php echo esc_attr($fallback_element['name']); ?>">
														<div class="fallback-fonts-elements-item-header">
															<div class="fallback-fonts-elements-item-title">
																<label><?php echo esc_attr($fallback_fonts_elements_list[$fallback_element['name']]['title']) ?></label>
																<input type="hidden" name="<?php echo $field_el_pfx; ?>[name]" value="<?php echo esc_attr($fallback_element['name']); ?>">
															</div>
															<button type="button" class="button"><?php esc_html_e('Remove', 'thesod'); ?></button>
														</div>
														<?php if (!empty($fallback_element['font_size']) && !empty($fallback_element['line_height'])): ?>
															<div class="fallback-fonts-elements-item-body">
																<div class="fallback-fonts-elements-item-field">
																	<label for=""><?php esc_html_e('Font Size', 'thesod'); ?></label>
																	<div class="fixed-number">
																		<input type="number" name="<?php echo $field_el_pfx; ?>[font_size]" value="<?php echo esc_attr($fallback_element['font_size']); ?>" data-min-value="10" data-max-value="100">
																	</div>
																</div>
																<div class="fallback-fonts-elements-item-field">
																	<label for=""><?php esc_html_e('Line Height', 'thesod'); ?></label>
																	<div class="fixed-number">
																		<input type="number" name="<?php echo $field_el_pfx; ?>[line_height]" value="<?php echo esc_attr($fallback_element['line_height']); ?>" data-min-value="10" data-max-value="150">
																	</div>
																</div>
															</div>
														<?php endif; ?>
													</div>
												<?php endforeach; ?>
											<?php endif; ?>
										</div>
									</div>
								</div>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
			<div class="add-new"><a href="javascript:void(0);"><?php esc_html_e('Upload new font file', 'thesod'); ?></a></div>
			<div class="submit"><button name="action" value="save" type="submit" class="button button-primary"><?php esc_html_e('Save', 'thesod'); ?></button></div>
	</form>
	</div>
</div>

<?php
}

/* Update fonts manager */
add_action('admin_menu', 'thesod_fonts_manager_update');
function thesod_fonts_manager_update() {
	if(isset($_GET['page']) && $_GET['page'] == 'fonts-manager') {
		if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'save') {
			if(isset($_REQUEST['fonts']) && is_array($_REQUEST['fonts'])) {
				$fonts = $_REQUEST['fonts'];

				foreach($fonts as $key=>&$font) {
					if(!$font['font_name']) {
						unset($fonts[$key]);
					}

					if (!$font['font_is_fallback']) {
						unset($font['font_fallback_elements']);
					}
				}
				update_option('thesod_additionals_fonts', $fonts);
			} else {
				update_option('thesod_additionals_fonts', array());
			}

			wp_redirect(esc_url(admin_url('admin.php?page=fonts-manager')));
		}
	}
}

/* SOCIALS MANAGER */

/* Create fonts manager page */
add_action( 'admin_menu', 'thesod_socials_manager_add_page');
function thesod_socials_manager_add_page() {
	$page = add_submenu_page(NULL, esc_html__('Add new social network','thesod'), '', 'edit_theme_options', 'socials-manager', 'thesod_socials_manager_page');
	add_action('load-' . $page, 'thesod_socials_manager_page_prepend');
}

/* Admin theme page scripts & css */
function thesod_socials_manager_page_prepend() {
	wp_enqueue_script('thesod-font-manager', get_template_directory_uri() . '/js/thesod-socials-manager.js');
}

/* Build admin theme page form */
function thesod_socials_manager_page(){
	add_thickbox();
	wp_enqueue_style('icons-elegant');
	wp_enqueue_style('icons-material');
	wp_enqueue_style('icons-fontawesome');
	wp_enqueue_style('icons-userpack');
	wp_enqueue_script('thesod-icons-picker');
	$additionals_socials = get_option('thesod_additionals_socials');
?>
<div class="wrap">

	<h2><?php esc_html_e('Add new social network', 'thesod'); ?></h2>
	<p><?php esc_html_e('Here you can add new social networks, which are not included per default in thesod\'s theme options. Define ID, name, icon pack, icon and color. By clicking on "Save" this network will appear in "Theme Options - Contacts & Socials".', 'thesod'); ?></p>
	<p><?php esc_html_e('By clicking on "Save" these networks will be added to the list of social networks available for teams, top area, footer, social network widget etc.', 'thesod'); ?></p>

	<form id="socials-manager-form" method="POST">
		<div class="social-pane empty" style="display: none;">
			<div class="remove"><a href="javascript:void(0);"><?php esc_html_e('Remove', 'thesod'); ?></a></div>
			<div class="field">
				<div class="label"><label for=""><?php esc_html_e('Social network ID', 'thesod'); ?></label></div>
				<div class="input"><input type="text" name="socials[id][]" value="" /></div>
			</div>
			<div class="field">
				<div class="label"><label for=""><?php esc_html_e('Social network name', 'thesod'); ?></label></div>
				<div class="input"><input type="text" name="socials[name][]" value="" /></div>
			</div>
			<div class="field">
				<div class="label"><label for=""><?php esc_html_e('Icon pack', 'thesod'); ?></label></div>
				<div class="icon-pack-select"><?php thesod_print_select_input(thesod_icon_packs_select_array(), '', 'socials[icon_pack][]', ''); ?></div>
			</div>
			<div class="field">
				<div class="label"><label for=""><?php esc_html_e('Default icon', 'thesod'); ?></label></div>
				<div class="input"><input type="text" name="socials[icon][]" value="" class="icons-picker" data-iconpack="elegant" /></div>
			</div>
			<div class="field">
				<div class="label"><label for=""><?php esc_html_e('Rounded icon', 'thesod'); ?></label></div>
				<div class="input"><input type="text" name="socials[rounded_icon][]" value="" class="icons-picker" data-iconpack="elegant" /></div>
			</div>
			<div class="field">
				<div class="label"><label for=""><?php esc_html_e('Squared icon', 'thesod'); ?></label></div>
				<div class="input"><input type="text" name="socials[squared_icon][]" value="" class="icons-picker" data-iconpack="elegant" /></div>
			</div>
			<div class="field">
				<div class="label"><label for=""><?php esc_html_e('Color', 'thesod'); ?></label></div>
				<div class="input"><input type="text" name="socials[color][]" value="" class="color-picker" /></div>
			</div>
		</div>
		<?php if(is_array($additionals_socials)) : ?>
			<?php foreach($additionals_socials as $additionals_social) : ?>
				<div class="social-pane">
					<div class="remove"><a href="javascript:void(0);"><?php esc_html_e('Remove', 'thesod'); ?></a></div>
					<div class="field">
						<div class="label"><label for=""><?php esc_html_e('Social network ID', 'thesod'); ?></label></div>
						<div class="input"><input type="text" name="socials[id][]" value="<?php echo esc_attr($additionals_social['id']); ?>" /></div>
					</div>
					<div class="field">
						<div class="label"><label for=""><?php esc_html_e('Social network name', 'thesod'); ?></label></div>
						<div class="input"><input type="text" name="socials[name][]" value="<?php echo esc_attr($additionals_social['name']); ?>" /></div>
					</div>
					<div class="field">
						<div class="label"><label for=""><?php esc_html_e('Icon pack', 'thesod'); ?></label></div>
						<div class="icon-pack-select"><?php thesod_print_select_input(thesod_icon_packs_select_array(), $additionals_social['icon_pack'], 'socials[icon_pack][]', ''); ?></div>
					</div>
					<div class="field">
						<div class="label"><label for=""><?php esc_html_e('Default icon', 'thesod'); ?></label></div>
						<div class="input"><input type="text" name="socials[icon][]" value="<?php echo esc_attr($additionals_social['icon']); ?>" class="icons-picker" data-iconpack="<?php echo esc_attr($additionals_social['icon_pack']); ?>" /></div>
					</div>
					<div class="field">
						<div class="label"><label for=""><?php esc_html_e('Rounded icon', 'thesod'); ?></label></div>
						<div class="input"><input type="text" name="socials[rounded_icon][]" value="<?php echo esc_attr($additionals_social['rounded_icon']); ?>" class="icons-picker" data-iconpack="<?php echo esc_attr($additionals_social['icon_pack']); ?>" /></div>
					</div>
					<div class="field">
						<div class="label"><label for=""><?php esc_html_e('Squared icon', 'thesod'); ?></label></div>
						<div class="input"><input type="text" name="socials[squared_icon][]" value="<?php echo esc_attr($additionals_social['squared_icon']); ?>" class="icons-picker" data-iconpack="<?php echo esc_attr($additionals_social['icon_pack']); ?>" /></div>
					</div>
					<div class="field">
						<div class="label"><label for=""><?php esc_html_e('Color', 'thesod'); ?></label></div>
						<div class="input"><input type="text" name="socials[color][]" value="<?php echo esc_attr($additionals_social['color']); ?>" class="color-picker" /></div>
					</div>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
		<div class="add-new"><a href="javascript:void(0);"><?php esc_html_e('+ Add new', 'thesod'); ?></a></div>
		<div class="submit"><button name="action" value="save"><?php esc_html_e('Save', 'thesod'); ?></button></div>
	</form>

</div>

<?php
}

/* Update socials manager */
add_action('admin_menu', 'thesod_socials_manager_update');
function thesod_socials_manager_update() {
	if(isset($_GET['page']) && $_GET['page'] == 'socials-manager') {
		if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'save') {
			if(isset($_REQUEST['socials']['id']) && is_array($_REQUEST['socials']['id'])) {
				$socials = array();
				foreach($_REQUEST['socials']['id'] as $key => $value) {
					$socials[$key] = array(
						'id' => sanitize_title($value),
						'name' => !empty($_REQUEST['socials']['name'][$key]) ? esc_html($_REQUEST['socials']['name'][$key]) : '',
						'icon_pack' => !empty($_REQUEST['socials']['icon_pack'][$key]) ? thesod_check_array_value(array('elegant', 'material', 'fontawesome', 'userpack'), $_REQUEST['socials']['icon_pack'][$key], 'elegant') : 'elegant',
						'icon' => !empty($_REQUEST['socials']['icon'][$key]) ? esc_html($_REQUEST['socials']['icon'][$key]) : '',
						'rounded_icon' => !empty($_REQUEST['socials']['rounded_icon'][$key]) ? esc_html($_REQUEST['socials']['rounded_icon'][$key]) : '',
						'squared_icon' => !empty($_REQUEST['socials']['squared_icon'][$key]) ? esc_html($_REQUEST['socials']['squared_icon'][$key]) : '',
						'color' => !empty($_REQUEST['socials']['color'][$key]) ? esc_html($_REQUEST['socials']['color'][$key]) : '',
					);
				}
				foreach($socials as $key => $social) {
					if(!$social['id']) {
						unset($socials[$key]);
					}
				}
				update_option('thesod_additionals_socials', $socials);
			}
			wp_redirect(esc_url(admin_url('?page=socials-manager')));
		}
	}
}

/* Add icons to list */
function thesod_socials_icons_list_additionals($socials) {
	return array_merge($socials, thesod_additionals_socials_list('names'));
}
add_filter('thesod_socials_icons_list', 'thesod_socials_icons_list_additionals');

function thesod_additionals_socials_list($array_type = 'full') {
	$socials = array();
	$additionals_socials = get_option('thesod_additionals_socials');
	if(!empty($additionals_socials) && is_array($additionals_socials)) {
		foreach($additionals_socials as $social) {
			if(!empty($social['id'])) {
				if($array_type == 'names') {
					$socials[$social['id']] = $social['name'];
				} elseif($array_type == 'ids') {
					$socials[] = $social['id'];
				} else {
					$socials[$social['id']] = array(
						'name' => !empty($social['name']) ? esc_html($social['name']) : '',
						'icon_pack' => !empty($social['icon_pack']) ? thesod_check_array_value(array('elegant', 'material', 'fontawesome', 'userpack'), $social['icon_pack'], 'elegant') : 'elegant',
						'icon' => !empty($social['icon']) ? esc_html($social['icon']) : '',
						'rounded_icon' => !empty($social['rounded_icon']) ? esc_html($social['rounded_icon']) : '',
						'squared_icon' => !empty($social['squared_icon']) ? esc_html($social['squared_icon']) : '',
						'color' => !empty($social['color']) ? esc_html($social['color']) : '',
					);
				}
			}
		}
	}
	return $socials;
}

function thesod_additionals_socials_enqueue_style($social) {
	if(in_array($social, thesod_additionals_socials_list('ids'))) {
		$additionals_socials = thesod_additionals_socials_list('full');
		$social_data = $additionals_socials[$social];
		wp_enqueue_style('icons-'.$social_data['icon_pack']);
	}
}

function thesod_get_social_font_family($selected) {
	$fonts_array = array(
		'elegant' => 'ElegantIcons',
		'material' => 'MaterialDesignIcons',
		'fontawesome' => 'FontAwesome',
		'userpack' => 'UserPack',
	);
	$font_family = isset($fonts_array[$selected]) ? $fonts_array[$selected] : 'ElegantIcons';
	return $font_family;
}

/* LAYERSLIDER SKIN */

if(thesod_is_plugin_active('LayerSlider/layerslider.php') && class_exists('LS_Sources')) {
	LS_Sources::addSkins(get_template_directory().'/ls_skin/');
}

/* JS Composer colums new grid */

function thesod_vc_base_register_front_css() {
	wp_register_style('thesod_js_composer_front', get_template_directory_uri() . '/css/thesod-js_composer_columns.css', array('js_composer_front'));
	add_action('wp_enqueue_scripts', 'thesod_vc_enqueueStyle_columns');
}
add_action('vc_base_register_front_css', 'thesod_vc_base_register_front_css');

function thesod_vc_enqueueStyle_columns() {
	$post = get_post();
	if(is_404() && get_post(thesod_get_option('404_page'))) {
		$post = get_post(thesod_get_option('404_page'));
	}
	if($post && preg_match( '/vc_row/', $post->post_content)) {
		wp_enqueue_style('thesod_js_composer_front');
	}
}

/* JS Composer scripts */

function thesod_additional_js_composer_backend_scripts() {
	wp_register_script('thesod-vc-backend-js', get_template_directory_uri() . '/js/thesod-js-composer-backend.js', array('vc-backend-actions-js'), '', true);
}
add_action( 'add_meta_boxes', 'thesod_additional_js_composer_backend_scripts', 6);

function thesod_vc_backend_editor_enqueue_js_css() {
	wp_enqueue_script('thesod-vc-backend-js');
}
add_action( 'vc_backend_editor_enqueue_js_css', 'thesod_vc_backend_editor_enqueue_js_css');

function check_add_breadcrumbs_woocommerce_shop() {
	if(  function_exists ( "is_woocommerce" ) && is_woocommerce()){
			return true;
	}
	$woocommerce_keys   =   array ( "woocommerce_shop_page_id" ,
									"woocommerce_terms_page_id" ,
									"woocommerce_cart_page_id" ,
									"woocommerce_checkout_page_id" ,
									"woocommerce_pay_page_id" ,
									"woocommerce_thanks_page_id" ,
									"woocommerce_myaccount_page_id" ,
									"woocommerce_edit_address_page_id" ,
									"woocommerce_view_order_page_id" ,
									"woocommerce_change_password_page_id" ,
									"woocommerce_logout_page_id" ,
									"woocommerce_lost_password_page_id" ) ;
	foreach ( $woocommerce_keys as $wc_page_id ) {
		if ( get_the_ID () == get_option ( $wc_page_id , 0 ) ) {
				return true ;
		}
	}
	return false;
}

/*breadcrumbs*/
if(!function_exists('gem_breadcrumbs')) {
	function gem_breadcrumbs()
	{
		$text['home'] = esc_html__('Home', 'thesod');
		$text['category'] = esc_html__('Blog Category', 'thesod');
		$text['search'] = esc_html__('Search Results', 'thesod');
		$text['tag'] = esc_html__('Tag', 'thesod');
		$text['author'] = esc_html__('Posts by', 'thesod');
		$text['404'] = esc_html__('404', 'thesod');
		$text['page'] = '%s';
		$text['cpage'] = esc_html__('Comment %s', 'thesod');

		$delimiter = '<span class="bc-devider"></span>';
		$delim_before = '<span class="divider">';
		$delim_after = '</span>';
		$show_home_link = 1;
		$show_on_home = 0;
		$show_title = 1;
		$show_current = 1;
		$before = '<span class="current">';
		$after = '</span>';


		global $post;
		$home_link = home_url('/');
		$link_before = '<span>';
		$link_after = '</span>';
		$link_attr = ' itemprop="url"';
		$link_in_before = '<span itemprop="title">';
		$link_in_after = '</span>';
		$link = $link_before . '<a href="%1$s"' . $link_attr . '>' . $link_in_before . '%2$s' . $link_in_after . '</a>' . $link_after;
		$frontpage_id = get_option('page_on_front');
		$thisPostID = get_the_ID();
		$parent_id = wp_get_post_parent_id($thisPostID);
		$delimiter = ' ' . $delim_before . $delimiter . $delim_after . ' ';

		if (is_home() || is_front_page()) {

			if ($show_on_home == 1) echo '<div class="breadcrumbs"><a href="' . esc_url($home_link) . '">' . $text['home'] . '</a></div>';

		} else {

			echo '<div class="breadcrumbs">';
			if ($show_home_link == 1) echo sprintf($link, esc_url($home_link), $text['home']);

			if (is_category()) {
				$cat = get_category(get_query_var('cat'), false);

				if ($cat->parent != 0) {
					$cats = get_category_parents($cat->parent, TRUE, $delimiter);
					$cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
					$cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr . '>' . $link_in_before . '$2' . $link_in_after . '</a>' . $link_after, $cats);
					if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
					if ($show_home_link == 1) echo $delimiter;
					echo $cats;
				}

				if (get_query_var('paged')) {
					$cat = $cat->cat_ID;
					echo $delimiter . sprintf($link, get_category_link($cat), get_cat_name($cat)) . $delimiter . $before . sprintf($text['page'], get_query_var('paged')) . $after;
				} else {
					if ($show_current == 1) echo $delimiter . $before . sprintf($text['category'], single_cat_title('', false)) . $after;
				}

			} elseif (is_search()) {
				if ($show_home_link == 1) echo $delimiter;
				echo $before . sprintf($text['search'], get_search_query()) . $after;
			} elseif (is_day()) {
				if ($show_home_link == 1) echo $delimiter;
				echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
				echo sprintf($link, get_month_link(get_the_time('Y'), get_the_time('m')), get_the_time('F')) . $delimiter;
				echo $before . get_the_time('d') . $after;

			} elseif (is_month()) {
				if ($show_home_link == 1) echo $delimiter;
				echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
				echo $before . get_the_time('F') . $after;

			} elseif (is_year()) {
				if ($show_home_link == 1) echo $delimiter;
				echo $before . get_the_time('Y') . $after;

			} elseif (is_single() && !is_attachment()) {
				if ($show_home_link == 1) echo $delimiter;
				if (get_post_type() != 'post') {
					$post_type = get_post_type_object(get_post_type());
					$slug = $post_type->rewrite;
					$post_type = get_post_type_object(get_post_type());
					if (get_post_type() == 'product') {
						echo sprintf($link, get_permalink(get_option('woocommerce_shop_page_id', 0)), esc_html__('Shop', 'thesod'));
					} elseif (get_post_type() == 'thesod_pf_item' && thesod_get_option('portfolio_archive_page') && $page = get_page(thesod_get_option('portfolio_archive_page'))) {
						printf($link, get_permalink($page->ID), $page->post_title);
					} elseif ($post_type->has_archive) {
						$slug = $post_type->rewrite;
						printf($link, trailingslashit($home_link) . $slug['slug'] . '/', $post_type->labels->singular_name);
					} else {
						echo $link_before . $link_in_before . $post_type->labels->singular_name . $link_in_after . $link_after;
					}
					if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;
				} else {
					$cat = get_the_category();
					$cat = $cat[0];
					$cats = get_category_parents($cat, TRUE, $delimiter);
					if ($show_current == 0 || get_query_var('cpage')) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
					$cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr . '>' . $link_in_before . '$2' . $link_in_after . '</a>' . $link_after, $cats);
					if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
					echo $cats;
					if (get_query_var('cpage')) {
						echo $delimiter . sprintf($link, get_permalink(), get_the_title()) . $delimiter . $before . sprintf($text['cpage'], get_query_var('cpage')) . $after;
					} else {
						if ($show_current == 1) echo $before . get_the_title() . $after;
					}

				}


// custom post type

			} elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404() && have_posts()) {
				$post_type = get_post_type_object(get_post_type());
				if (get_query_var('paged')) {
					echo $delimiter . sprintf($link, get_post_type_archive_link($post_type->name), $post_type->label) . $delimiter . $before . sprintf($text['page'], get_query_var('paged')) . $after;
				} else {

					if ($show_current == 1) echo $delimiter . $before . $post_type->label . $after;
				}
			} elseif (is_attachment()) {
				if ($show_home_link == 1) echo $delimiter;
				$parent = get_post($parent_id);
				$cat = get_the_category($parent->ID);
				$cat = $cat[0];
				if ($cat) {
					$cats = get_category_parents($cat, TRUE, $delimiter);
					$cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr . '>' . $link_in_before . '$2' . $link_in_after . '</a>' . $link_after, $cats);
					if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
					echo $cats;
				}
				printf($link, get_permalink($parent), $parent->post_title);
				if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;

			} elseif (is_page() && !$parent_id) {
				if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;

			} elseif (is_page() && $parent_id) {
				if ($show_home_link == 1) echo $delimiter;
				if ($parent_id != $frontpage_id) {
					$breadcrumbs = array();
					while ($parent_id) {
						$page = get_page($parent_id);
						if ($parent_id != $frontpage_id) {
							$breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
						}
						$parent_id = $page->post_parent;
					}
					$breadcrumbs = array_reverse($breadcrumbs);
					for ($i = 0; $i < count($breadcrumbs); $i++) {
						echo $breadcrumbs[$i];
						if ($i != count($breadcrumbs) - 1) echo $delimiter;
					}
				}
				if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;

			} elseif (is_tag()) {
				if ($show_current == 1) echo $delimiter . $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

			} elseif (is_author()) {
				if ($show_home_link == 1) echo $delimiter;
				global $author;
				$author = get_userdata($author);
				echo $before . sprintf($text['author'], $author->display_name) . $after;

			} elseif (is_404()) {
				if ($show_home_link == 1) echo $delimiter;
				echo $before . $text['404'] . $after;
			} elseif (has_post_format() && !is_singular()) {
				if ($show_home_link == 1) echo $delimiter;
				echo get_post_format_string(get_post_format());
			}

			echo '</div><!-- .breadcrumbs -->';

		}
	}
}


function thesod_default_avatar ($avatar_defaults) {
	$myavatar = get_template_directory_uri() . '/images/default-avatar.png';
	$avatar_defaults[$myavatar] = esc_html__('The Gem Avatar', 'thesod');
	$myavatar2 = get_template_directory_uri() . '/images/avatar-1.jpg';
	$avatar_defaults[$myavatar2] = esc_html__('The Gem Avatar 2', 'thesod');
	return $avatar_defaults;
}
add_filter( 'avatar_defaults', 'thesod_default_avatar' );


/* ADDITIONL MENU ITEMS */
function thesod_menu_item_search($items, $args){
	if($args->theme_location == 'primary' && thesod_get_option('header_layout') !== 'overlay' && !thesod_get_option('hide_search_icon')) {
		$items .= '<li class="menu-item menu-item-search"><a href="#"></a><div class="minisearch"><form role="search" id="searchform" class="sf" action="'. esc_url( home_url( '/' ) ) .'" method="GET"><input id="searchform-input" class="sf-input" type="text" placeholder="'.esc_html__('Search...', 'thesod').'" name="s"><span class="sf-submit-icon"></span><input id="searchform-submit" class="sf-submit" type="submit" value=""></form></div></li>';
	}
	return $items;
}
add_filter('wp_nav_menu_items', 'thesod_menu_item_search', 10, 2);

function thesod_menu_item_hamburger_widget($items, $args){
	if($args->theme_location == 'primary' && thesod_get_option('header_layout') == 'fullwidth_hamburger'){

		ob_start();
		thesod_print_socials('rounded');
		$socials = ob_get_clean();

		$items .= '<li class="menu-item menu-item-widgets"><div class="vertical-minisearch"><form role="search" id="searchform" class="sf" action="'. esc_url( home_url( '/' ) ) .'" method="GET"><input id="searchform-input" class="sf-input" type="text" placeholder="'.esc_html__('Search...', 'thesod').'" name="s"><span class="sf-submit-icon"></span><input id="searchform-submit" class="sf-submit" type="submit" value=""></form></div><div class="menu-item-socials socials-colored">'. $socials .'</div></li>';
	}
	return $items;
}
add_filter('wp_nav_menu_items', 'thesod_menu_item_hamburger_widget', 100, 2);

function thesod_mobile_menu_item_widget($items, $args){
	if($args->theme_location == 'primary' && in_array(thesod_get_option('mobile_menu_layout'), array('slide-horizontal', 'slide-vertical'))){

		ob_start();
		thesod_print_socials();
		$socials = ob_get_clean();

		$items .= '<li class="menu-item menu-item-widgets mobile-only"><div class="menu-item-socials">'. $socials .'</div></li>';
	}
	return $items;
}
add_filter('wp_nav_menu_items', 'thesod_mobile_menu_item_widget', 100, 2);

/* PAGE SCROLLER */

function thesod_page_scroller_disable_scroll_top_button($value) {
	if(is_singular()) {
		$page_effects = thesod_get_sanitize_page_effects_data(get_the_ID());
		if($page_effects['effects_page_scroller']) {
			return true;
		}
	}
	return $value;
}
add_filter('thesod_option_disable_scroll_top_button', 'thesod_page_scroller_disable_scroll_top_button');

/* PRINT LOGO */
if(!function_exists('thesod_print_logo')) {
	function thesod_print_logo($header_light = '', $echo = true)
	{
		ob_start();
		?>
		<div class="site-logo" style="width:<?php echo esc_attr(thesod_get_option('logo_width')); ?>px;">
			<a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
				<?php if (thesod_get_option('logo')) : ?>
					<span class="logo"><?php thesod_get_logo_img(esc_url(thesod_get_option('logo' . $header_light)), intval(thesod_get_option('logo_width')), 'default') ?><?php if (thesod_get_option('small_logo_light') && $header_light) : ?><?php thesod_get_logo_img(esc_url(thesod_get_option('small_logo_light')), intval(thesod_get_option('small_logo_width')), 'small light') ?><?php endif; ?><?php if (thesod_get_option('small_logo')) : ?><?php thesod_get_logo_img(esc_url(thesod_get_option('small_logo')), intval(thesod_get_option('small_logo_width')), 'small') ?><?php endif; ?></span>
				<?php else : ?>
					<?php bloginfo('name'); ?>
				<?php endif; ?>
			</a>
		</div>
		<?php
		$output = ob_get_clean();
		if ($echo) {
			echo $output;
		}
		return $output;
	}
}


function thesod_get_logo_img($url, $width, $class = '', $echo = 1) {
	$logo = '<img src="'.esc_url(thesod_get_logo_url($url, $width, 1)).'" srcset="'.esc_url(thesod_get_logo_url($url, $width, 1)).' 1x,'.esc_url(thesod_get_logo_url($url, $width, 2)).' 2x,'.esc_url(thesod_get_logo_url($url, $width, 3)).' 3x" alt="'.esc_attr(get_bloginfo( 'name', 'display' )).'" style="width:'.esc_attr($width).'px;"'.($class ? ' class="'.esc_attr($class).'"' : '').'/>';
	$logo = apply_filters('thesod_get_logo_img', $logo, $url, $width, $class);
	if($echo) {
		echo $logo;
	}
	return $logo;
}

function thesod_get_logo_url($url, $width, $ratio = 1) {
	$logo_url = $url;
	$logo_url = apply_filters('thesod_get_logo_url', $url, $width, $ratio);
	if($logo_url != $url) {
		return $logo_url;
	}
	$wp_upload_dir = wp_upload_dir();
	$upload_logos_dir = $wp_upload_dir['basedir'] . '/thesod-logos';
	$upload_logos_url = $wp_upload_dir['baseurl'] . '/thesod-logos';
	$file = explode('.', $url);
	$extention = $file[count($file)-1];
	$logo_filename = 'logo_'.md5($url).'_'.$ratio.'x.'.$extention;
	$logo_filepath = $upload_logos_dir.'/'.$logo_filename;
	if(file_exists($logo_filepath)) {
		return $upload_logos_url.'/'.$logo_filename;
	}

	if(!wp_mkdir_p($upload_logos_dir)) {
		return $logo_url;
	}

	$local_file = false;
	$temp_file = '';
	if(strpos($url, home_url('/')) === 0) {
		$temp_file = ABSPATH . str_replace(home_url('/'), '', $url);
		if(file_exists($temp_file)) {
			$local_file = true;
		} else {
			return $logo_url;
		}
	}
	if(!$local_file) {
		require_once(ABSPATH . 'wp-admin/includes/file.php');
		$temp_file = download_url($url);
		if(is_wp_error($temp_file)) {
			return $logo_url;
		}
	}
	$temp_logo_filepath = $upload_logos_dir.'/temp_logo_file.'.$extention;
	$move_new_file = @copy($temp_file, $temp_logo_filepath);
	if(!$local_file) {
		unlink($temp_file);
	}
	if($move_new_file === false) {
		return $logo_url;
	};
	$image = wp_get_image_editor($temp_logo_filepath);
	if(!is_wp_error($image) && $image) {
		$image->resize($width*$ratio, 0, false);
		$image->set_quality(100);
		$image->save($logo_filepath);
		unlink($temp_logo_filepath);
		return $upload_logos_url.'/'.$logo_filename;
	}
	return $logo_url;
}

/* Hamburger fix */

function thesod_vertical_fix_logo_position($value) {
	if(($value == 'menu_center' || $value == 'center') && in_array(thesod_get_option('header_layout'), array('fullwidth_hamburger', 'vertical', 'overlay', 'perspective'))) {
		return 'left';
	}
	return $value;
}
add_filter('thesod_option_logo_position', 'thesod_vertical_fix_logo_position');

/* Boxed fix */

function thesod_vertical_fix_page_layout_style($value) {
	if($value == 'boxed' && (thesod_get_option('header_layout') == 'fullwidth_hamburger' || thesod_get_option('header_layout') == 'vertical')) {
		return 'fullwidth';
	}
	return $value;
}
add_filter('thesod_option_page_layout_style', 'thesod_vertical_fix_page_layout_style');


/* 404 Sidebar fix */

function thesod_fix_404_pw_filter_widgets($sidebars_widgets) {
	if(is_404() && get_post(thesod_get_option('404_page'))) {
		$post = get_post(thesod_get_option('404_page'));
		if (isset($post->ID)) {
			$enable_customize = get_post_meta($post->ID, '_customize_sidebars', true);
			$_sidebars_widgets = get_post_meta($post->ID, '_sidebars_widgets', true);
		}
		if (isset($enable_customize) && $enable_customize == 'yes' && !empty($_sidebars_widgets)) {
			if (is_array($_sidebars_widgets) && isset($_sidebars_widgets['array_version']))
				unset($_sidebars_widgets['array_version']);
			$sidebars_widgets = wp_parse_args($_sidebars_widgets, $sidebars_widgets);
		}
	}
	return $sidebars_widgets;
}
add_filter('sidebars_widgets', 'thesod_fix_404_pw_filter_widgets');

/* USER ICON PACK */

if(!function_exists('thesod_icon_userpack_enabled')) {
function thesod_icon_userpack_enabled() {
	return apply_filters('thesod_icon_userpack_enabled', false);
}
}

if(!function_exists('thesod_icon_packs_select_array')) {
function thesod_icon_packs_select_array() {
	$packs = array('elegant' => esc_html__('Elegant', 'thesod'), 'material' => esc_html__('Material Design', 'thesod'), 'fontawesome' => esc_html__('FontAwesome', 'thesod'));
	if(thesod_icon_userpack_enabled()) {
		$packs['userpack'] = esc_html__('UserPack', 'thesod');
	}
	return $packs;
}
}

if(!function_exists('thesod_icon_packs_infos')) {
function thesod_icon_packs_infos() {
	ob_start();
?>
<?php esc_html_e('Enter icon code', 'thesod'); ?>.
<a class="sod-icon-info sod-icon-info-elegant" href="<?php echo esc_url(thesod_user_icons_info_link('elegant')); ?>" onclick="tb_show('<?php esc_attr_e('Icons info', 'thesod'); ?>', this.href+'?TB_iframe=true'); return false;"><?php esc_html_e('Show Elegant Icon Codes', 'thesod'); ?></a>
<a class="sod-icon-info sod-icon-info-material" href="<?php echo esc_url(thesod_user_icons_info_link('material')); ?>" onclick="tb_show('<?php esc_attr_e('Icons info', 'thesod'); ?>', this.href+'?TB_iframe=true'); return false;"><?php esc_html_e('Show Material Design Icon Codes', 'thesod'); ?></a>
<a class="sod-icon-info sod-icon-info-fontawesome" href="<?php echo esc_url(thesod_user_icons_info_link('fontawesome')); ?>" onclick="tb_show('<?php esc_attr_e('Icons info', 'thesod'); ?>', this.href+'?TB_iframe=true'); return false;"><?php esc_html_e('Show FontAwesome Icon Codes', 'thesod'); ?></a>
<?php if(thesod_icon_userpack_enabled()) : ?>
<a class="sod-icon-info sod-icon-info-userpack" href="<?php echo esc_url(thesod_user_icons_info_link('userpack')); ?>" onclick="tb_show('<?php esc_attr_e('Icons info', 'thesod'); ?>', this.href+'?TB_iframe=true'); return false;"><?php esc_html_e('Show UserPack Icon Codes', 'thesod'); ?></a>
<?php endif; ?>
<?php
	return ob_get_clean();
}
}


/* BODY CLASS */

function thesod_body_class($classes) {
	$page_id = is_singular() ? get_the_ID() : 0;
	if(is_404() && get_post(thesod_get_option('404_page'))) {
		$page_id = thesod_get_option('404_page');
	}
	if((is_post_type_archive('product') || is_tax('product_cat') || is_tax('product_tag')) && function_exists('wc_get_page_id')) {
		$page_id = wc_get_page_id('shop');
	}
	$effects_params = thesod_get_sanitize_page_effects_data($page_id);
	$body_classes = array();
	if(is_home() && thesod_get_option('home_content_enabled')) {
		$body_classes[] = 'home-constructor';
	}
	if($effects_params['effects_page_scroller']) {
		$body_classes[] = 'page-scroller';
		if($effects_params['effects_page_scroller_mobile']) {
			$body_classes[] = 'page-scroller-mobile';
		}
	}
	if($effects_params['effects_one_pager']) {
		$body_classes[] = 'one-pager';
	}
	if (thesod_is_effects_disabled()) {
		$body_classes[] = 'thesod-effects-disabled';
	}
	return array_merge($classes, $body_classes);
}
add_filter('body_class', 'thesod_body_class');


/* SEACRH FORMS */
if(!function_exists('thesod_serch_form_vertical_header')) {
	function thesod_serch_form_vertical_header($form)
	{
		return '<div class="vertical-minisearch"><form role="search" id="searchform" class="sf" action="' . esc_url(home_url('/')) . '" method="GET"><input id="searchform-input" class="sf-input" type="text" placeholder="' . esc_html__('Search...', 'thesod') . '" name="s"><span class="sf-submit-icon"></span><input id="searchform-submit" class="sf-submit" type="submit" value=""></form></div>';
	}
}

function thesod_serch_form_nothing_found($form){
	ob_start();
?>
<form role="search" method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<table><tr>
		<td><input type="text" value="<?php echo get_search_query(); ?>" name="s" placeholder="<?php esc_html_e('Search...', 'thesod'); ?>" /></td>
		<td><?php thesod_button(array(
			'tag' => 'button',
			'text' => __('Search', 'thesod'),
			'size' => 'medium',
			'corner' => 3,
			'extra_class' => 'searchform-submit',
			'attributes' => array('type' => 'submit', 'value' => __('Search', 'thesod')),
		), 1); ?></td>
	</tr></table>
</form>
<?php
	$form = ob_get_clean();
	return $form;
}


/* MEJS SETTINGS */

function thesod_mejs_settings($mejs_settings) {
	$mejs_settings['hideVideoControlsOnLoad'] = true;
	$mejs_settings['audioVolume'] = 'vertical';
	return $mejs_settings;
}
add_filter('mejs_settings', 'thesod_mejs_settings');


/* OVERLAY MENU */

add_action('wp', 'thesod_remove_language_switcher');
function thesod_remove_language_switcher() {
	global $icl_language_switcher;
	if(thesod_get_option('header_layout') === 'overlay' && !empty($icl_language_switcher)) {
		remove_action( 'wp_nav_menu_items', array( $icl_language_switcher, 'wp_nav_menu_items_filter' ) );
	}
}

add_filter('thesod_option_menu_appearance_tablet_portrait', 'thesod_menu_overlay_appearance');
add_filter('thesod_option_menu_appearance_tablet_landscape', 'thesod_menu_overlay_appearance');
function thesod_menu_overlay_appearance($value) {
	if(thesod_get_option('header_layout') === 'overlay') {
		return 'default';
	}
	return $value;
}

function thesod_before_nav_menu_callback() {
	echo '<button class="menu-toggle dl-trigger">' . esc_html('Primary Menu', 'thesod') . '<span class="menu-line-1"></span><span class="menu-line-2"></span><span class="menu-line-3"></span></button>';

	if (thesod_get_option('header_layout') == 'fullwidth_hamburger' || thesod_get_option('header_layout') == 'overlay') {
		echo '<div class="hamburger-group'.(thesod_get_option('hamburger_menu_icon_size') ? ' hamburger-size-small' : '').(thesod_get_option('hamburger_menu_cart_position') ? ' hamburger-with-cart' : '').'">';
		if(thesod_get_option('hamburger_menu_cart_position') && !thesod_get_option('hide_card_icon') && !thesod_get_option('catalog_view') && thesod_is_plugin_active('woocommerce/woocommerce.php')) {
			global $woocommerce;
			$count = thesod_get_option('cart_label_count') ? $woocommerce->cart->cart_contents_count : sizeof(WC()->cart->get_cart());
			ob_start();
			woocommerce_mini_cart();
			$minicart = ob_get_clean();
			$items = '<div class="hamburger-minicart"><a href="'.esc_url(get_permalink(wc_get_page_id('cart'))).'" class="minicart-menu-link ' . ($count == 0 ? 'empty' : '') . '">' . '<span class="minicart-item-count">' . $count . '</span>' . '</a><div class="minicart'.(thesod_get_option('logo_position', 'left') === 'left' ? ' invert' : '').'"><div class="widget_shopping_cart_content">'.$minicart.'</div></div></div>';
			echo $items;
		}

		if (thesod_get_option('header_layout') == 'fullwidth_hamburger') {
			echo '<button class="hamburger-toggle">' . esc_html('Primary Menu', 'thesod') . '<span class="menu-line-1"></span><span class="menu-line-2"></span><span class="menu-line-3"></span></button>';
		}

		if (thesod_get_option('header_layout') == 'overlay') {
			echo '<button class="overlay-toggle '.(thesod_get_option('hamburger_menu_icon_size') ? ' toggle-size-small' : '').'">' . esc_html('Primary Menu', 'thesod') . '<span class="menu-line-1"></span><span class="menu-line-2"></span><span class="menu-line-3"></span></button>';
		}

		echo '</div>';
	}

	if (thesod_get_option('header_layout') == 'overlay' || thesod_get_option('mobile_menu_layout') == 'overlay') {
		echo '<div class="overlay-menu-wrapper"><div class="overlay-menu-table"><div class="overlay-menu-row"><div class="overlay-menu-cell">';
	}

	if (thesod_get_option('header_layout') == 'perspective') {
		echo '<button class="perspective-toggle'.(thesod_get_option('hamburger_menu_icon_size') ? ' toggle-size-small' : '').'">' . esc_html('Primary Menu', 'thesod') . '<span class="menu-line-1"></span><span class="menu-line-2"></span><span class="menu-line-3"></span></button>';
	}

	if (thesod_get_option('mobile_menu_layout') == 'slide-horizontal') {
		echo '<div class="mobile-menu-slide-wrapper left"><button class="mobile-menu-slide-close"></button>';
	}

	if (thesod_get_option('mobile_menu_layout') == 'slide-vertical') {
		echo '<div class="mobile-menu-slide-wrapper top"><button class="mobile-menu-slide-close"></button>';
	}
}
add_action('thesod_before_nav_menu', 'thesod_before_nav_menu_callback');

function thesod_after_nav_menu_callback() {
	if (thesod_get_option('header_layout') == 'overlay' || thesod_get_option('mobile_menu_layout') == 'overlay') {
		echo '</div></div></div></div>';
	}

	if (thesod_get_option('mobile_menu_layout') == 'slide-horizontal') {
		echo '</div>';
	}

	if (thesod_get_option('mobile_menu_layout') == 'slide-vertical') {
		echo '</div>';
	}
}
add_action('thesod_after_nav_menu', 'thesod_after_nav_menu_callback');

function thesod_before_header_callback() {
	if (thesod_get_option('header_layout') == 'overlay' || thesod_get_option('mobile_menu_layout') == 'overlay') {
		echo '<div class="menu-overlay"></div>';
	}
}
add_action('thesod_before_header', 'thesod_before_header_callback');

function thesod_option_mobile_menu_layout_default($value) {
	if (!$value) {
		$value = 'default';
	}
	return $value;
}
add_filter('thesod_option_mobile_menu_layout', 'thesod_option_mobile_menu_layout_default');

function thesod_nav_menu_class_callback($classes) {
	if (thesod_get_option('mobile_menu_layout') == 'default') {
		$classes .= ' dl-menu';
	}
	return $classes;
}
add_filter('thesod_nav_menu_class', 'thesod_nav_menu_class_callback');

function thesod_before_perspective_nav_menu_callback() {
	if (thesod_get_option('mobile_menu_layout') == 'overlay') {
		echo '<div class="overlay-menu-wrapper"><div class="overlay-menu-table"><div class="overlay-menu-row"><div class="overlay-menu-cell">';
	}

	if (thesod_get_option('mobile_menu_layout') == 'slide-horizontal') {
		echo '<div class="mobile-menu-slide-wrapper left"><button class="mobile-menu-slide-close"></button>';
	}

	if (thesod_get_option('mobile_menu_layout') == 'slide-vertical') {
		echo '<div class="mobile-menu-slide-wrapper top"><button class="mobile-menu-slide-close"></button>';
	}

	echo '<button class="perspective-menu-close'.(thesod_get_option('hamburger_menu_icon_size') ? ' toggle-size-small' : '').'"></button>';
}
add_action('thesod_before_perspective_nav_menu', 'thesod_before_perspective_nav_menu_callback');

function thesod_after_perspective_nav_menu_callback() {
	if (thesod_get_option('mobile_menu_layout') == 'overlay') {
		echo '</div></div></div></div>';
	}

	if (thesod_get_option('mobile_menu_layout') == 'slide-horizontal') {
		echo '</div>';
	}

	if (thesod_get_option('mobile_menu_layout') == 'slide-vertical') {
		echo '</div>';
	}

	?>
	<div class="vertical-menu-item-widgets">
		<?php
			add_filter( 'get_search_form', 'thesod_serch_form_vertical_header' );
			get_search_form();
			remove_filter( 'get_search_form', 'thesod_serch_form_vertical_header' );
		?>
		<div class="menu-item-socials socials-colored"><?php thesod_print_socials('rounded'); ?></div>
	</div>
	<?php
}
add_action('thesod_after_perspective_nav_menu', 'thesod_after_perspective_nav_menu_callback');

function thesod_perspective_menu_buttons_callback() {
	echo '<div id="perspective-menu-buttons" class="primary-navigation">';

	echo '<div class="hamburger-group'.(thesod_get_option('hamburger_menu_icon_size') ? ' hamburger-size-small' : '').(thesod_get_option('hamburger_menu_cart_position') ? ' hamburger-with-cart' : '').'">';
	if(thesod_get_option('hamburger_menu_cart_position') && !thesod_get_option('hide_card_icon') && !thesod_get_option('catalog_view') && thesod_is_plugin_active('woocommerce/woocommerce.php')) {
		global $woocommerce;
		$count = thesod_get_option('cart_label_count') ? $woocommerce->cart->cart_contents_count : sizeof(WC()->cart->get_cart());
		ob_start();
		woocommerce_mini_cart();
		$minicart = ob_get_clean();
		$items = '<div class="hamburger-minicart"><a href="'.esc_url(get_permalink(wc_get_page_id('cart'))).'" class="minicart-menu-link ' . ($count == 0 ? 'empty' : '') . '">' . '<span class="minicart-item-count">' . $count . '</span>' . '</a><div class="minicart'.(thesod_get_option('logo_position', 'left') === 'left' ? ' invert' : '').'"><div class="widget_shopping_cart_content">'.$minicart.'</div></div></div>';
		echo $items;
	}
	echo '<button class="perspective-toggle'.(thesod_get_option('hamburger_menu_icon_size') ? ' toggle-size-small' : '').'">' . esc_html('Primary Menu', 'thesod') . '<span class="menu-line-1"></span><span class="menu-line-2"></span><span class="menu-line-3"></span></button>';
	echo '<button class="menu-toggle dl-trigger">' . esc_html('Primary Menu', 'thesod') . '<span class="menu-line-1"></span><span class="menu-line-2"></span><span class="menu-line-3"></span></button>';
	echo '</div>';

	echo '</div>';
}
add_action('thesod_perspective_menu_buttons', 'thesod_perspective_menu_buttons_callback');

function thesod_get_site_icon_url($url, $size, $blog_id) {
	$custom_icon = thesod_get_option('favicon');
	if(!empty($custom_icon)) {
		return $custom_icon;
	};
	return $url;
}
add_filter( 'get_site_icon_url', 'thesod_get_site_icon_url', 10, 3 );

function thesod_get_footers_list() {
	$footers = array('' => __('Default', 'thesod'));
	$footers_list = get_posts(array(
		'post_type' => 'thesod_footer',
		'numberposts' => -1,
		'post_status' => 'any'
	));
	foreach ($footers_list as $footer) {
		$footers[$footer->ID] = $footer->post_title . ' (ID = ' . $footer->ID . ')';
	}
	return $footers;
}

function thesod_get_titles_list() {
	$titles_list = get_posts(array(
		'post_type' => 'thesod_title',
		'numberposts' => -1,
		'post_status' => 'any'
	));
	$titles = array();
	foreach ($titles_list as $title) {
		$titles[$title->ID] = $title->post_title . ' (ID = ' . $title->ID . ')';
	}
	return $titles;
}

function thesod_get_custom_css_filename() {
	$name = get_option('thesod_custom_css_filename');
	if($name && file_exists(get_stylesheet_directory() . '/css/'.$name.'.css')) {
		return $name;
	}
	return 'custom';
}

function thesod_generate_custom_css_filename() {
	return 'custom-'.wp_generate_password(8, false);
}

function thesod_save_custom_css_filename($name) {
	update_option('thesod_custom_css_filename', $name);
}

function thesod_gutenberg_can_edit_post($can_edit, $post ) {
	if ( ! defined( 'GUTENBERG_VERSION' ) || ! defined( 'WPB_VC_VERSION' )) {
		return $can_edit;
	}
	global $pagenow;
	if($can_edit && $pagenow == 'post.php' || $pagenow == 'post-new.php') {
		$can_edit = isset( $_GET['gutenberg-editor']);
	}
	return $can_edit;
}
add_filter('gutenberg_can_edit_post', 'thesod_gutenberg_can_edit_post', 10, 2);

function thesod_gutenberg_add_edit_link_filters() {
	if ( ! defined( 'GUTENBERG_VERSION' ) || ! defined( 'WPB_VC_VERSION' )) {
		return ;
	}
	remove_filter( 'page_row_actions', 'gutenberg_add_edit_link', 10 );
	remove_filter( 'post_row_actions', 'gutenberg_add_edit_link', 10 );
	add_filter( 'page_row_actions', 'thesod_gutenberg_add_edit_link', 10, 2 );
	add_filter( 'post_row_actions', 'thesod_gutenberg_add_edit_link', 10, 2 );
}
add_action( 'admin_init', 'thesod_gutenberg_add_edit_link_filters', 11 );

function thesod_gutenberg_add_edit_link( $actions, $post ) {
	if ( ! defined( 'GUTENBERG_VERSION' ) || ! defined( 'WPB_VC_VERSION' )) {
		return $actions;
	}
	if ( 'wp_block' === $post->post_type ) {
		unset( $actions['edit'] );
		unset( $actions['inline hide-if-no-js'] );
		return $actions;
	}
	if ( ! gutenberg_can_edit_post( $post ) ) {
		return $actions;
	}
	$edit_url = get_edit_post_link( $post->ID, 'raw' );
	$edit_url = add_query_arg( 'gutenberg-editor', '', $edit_url );

	// Build the classic edit action. See also: WP_Posts_List_Table::handle_row_actions().
	$title	   = _draft_or_post_title( $post->ID );
	$edit_action = array(
		'classic' => sprintf(
			'<a href="%s" aria-label="%s">%s</a>',
			esc_url( $edit_url ),
			esc_attr(
				sprintf(
					/* translators: %s: post title */
					__( 'Edit &#8220;%s&#8221; in the gutenberg editor', 'thesod' ),
					$title
				)
			),
			__( 'Gutenberg Editor', 'thesod' )
		),
	);

	// Insert the Classic Edit action after the Edit action.
	$edit_offset = array_search( 'edit', array_keys( $actions ), true );
	$actions	 = array_merge(
		array_slice( $actions, 0, $edit_offset + 1 ),
		$edit_action,
		array_slice( $actions, $edit_offset + 1 )
	);
	return $actions;
}

function thesod_gutenberg_replace_default_add_new_button() {
	if ( ! defined( 'GUTENBERG_VERSION' ) || ! defined( 'WPB_VC_VERSION' )) {
		return ;
	}
	global $typenow;

	if ( ! gutenberg_can_edit_post_type( $typenow ) ) {
		return;
	}

	?>
	<script type="text/javascript">
		document.addEventListener( 'DOMContentLoaded', function() {
			var buttons = document.getElementsByClassName( 'split-page-title-action' ),
				button = buttons.item( 0 );

			if ( ! button ) {
				return;
			}
			var gutenberg_button = button.getElementsByClassName('dropdown').item( 0 ).childNodes[0];
			var url = gutenberg_button.href;
			var urlHasParams = ( -1 !== url.indexOf( '?' ) );
			var gutenbergUrl = url + ( urlHasParams ? '&' : '?' ) + 'gutenberg-editor';
			gutenberg_button.href = gutenbergUrl;
		} );
	</script>
	<?php
}
add_action( 'admin_print_scripts-edit.php', 'thesod_gutenberg_replace_default_add_new_button', 11 );

function thesod_admin_url_gutenberg_replace($url, $path, $blog_id) {
	if(defined('WPB_VC_VERSION') && substr_count($path, 'post-new.php')) {
		$parsed_path = wp_parse_url($path);
		$query_data = array();
		if(!empty($parsed_path['query'])) {
			parse_str($parsed_path['query'], $query_data);
		}
		$post_type = !empty($query_data['post_type']) ? $query_data['post_type'] : 'post';
		if(vc_check_post_type($post_type)) {
			$url = add_query_arg('classic-editor', '', $url);
		}
	}
	return $url;
}
add_filter( 'admin_url', 'thesod_admin_url_gutenberg_replace', 10, 3);

function thesod_vc_base_register_admin_js() {
	$localize = visual_composer()->getEditorsLocale();
	$localize['main_button_title'] = esc_html__( 'Switch to Page Builder', 'thesod' );
	wp_localize_script( 'vc-backend-actions-js', 'i18nLocale', $localize );
}
add_action( 'vc_base_register_admin_js', 'thesod_vc_base_register_admin_js');

function thesod_get_contact_font_family($selected) {
	$fonts_array = array(
		'elegant' => 'ElegantIcons',
		'material' => 'MaterialDesignIcons',
		'fontawesome' => 'FontAwesome',
		'userpack' => 'UserPack',
	);
	$font_family = isset($fonts_array[$selected]) ? $fonts_array[$selected] : 'ElegantIcons';
	return $font_family;
}

if (!function_exists('thesod_lazy_loading_enqueue')) {
	function thesod_lazy_loading_enqueue() {
		wp_enqueue_script('thesod-lazy-loading');
		wp_enqueue_style('thesod-lazy-loading-animations');
	}
}

function thesod_save_instagram_image($remote_url) {
	$hash = sha1($remote_url);
	$cache_key = 'thesod_instagram_image_' . $hash;

	$cached_url = get_option($cache_key);
	if ($cached_url) {
		return $cached_url;
	}

	$url = str_replace('//', 'https://', $remote_url);
	$cleared_url = preg_replace('%\?.*$%', '', $url);

	if (!preg_match('%\.(.*)$%', basename($cleared_url), $match)) {
		return $remote_url;
	}

	$file = array(
		'name' => $hash . '.' . $match[1],
		'tmp_name' => download_url($url)
	);

	if (is_wp_error($file['tmp_name'])) {
		@unlink($file['tmp_name']);
		return $remote_url;
	}

	$upload_dir = wp_get_upload_dir();

	if (!@copy($file['tmp_name'], $upload_dir['path'] . '/' . $file['name'])) {
		@unlink($file['tmp_name']);
		return $remote_url;
	}

	@unlink($file['tmp_name']);

	$local_url = $upload_dir['url'] . '/' . $file['name'];

	update_option($cache_key, $local_url, 'no');

	return $local_url;
}
