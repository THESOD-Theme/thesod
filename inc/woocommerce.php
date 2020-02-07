<?php

function thesod_woocommerce_scripts() {
	if(thesod_is_plugin_active('woocommerce/woocommerce.php')) {
		wp_enqueue_style('thesod-woocommerce-minicart', get_template_directory_uri() . '/css/thesod-woocommerce-minicart.css');

		wp_register_style('thesod-woocommerce', get_template_directory_uri() . '/css/thesod-woocommerce.css');
		wp_register_style('thesod-woocommerce1', get_template_directory_uri() . '/css/thesod-woocommerce1.css');
		wp_register_style('thesod-woocommerce-temp', get_template_directory_uri() . '/css/thesod-woocommerce-temp.css');
		wp_register_style('thesod-woocommerce-custom', get_template_directory_uri() . '/css/thesod-woocommerce-custom.css');

		if (thesod_is_woocommerce_page() || thesod_is_wishlist_page()) {
			thesod_enqueue_woocommerce_styles();
		}
		if ( thesod_is_wishlist_page()) {
			wp_enqueue_style('yith-wcwl-user-main');
		}

		wp_register_script('thesod-checkout', get_template_directory_uri() . '/js/thesod-checkout.js', array('jquery'));
		wp_register_script('thesod-woocommerce', get_template_directory_uri() . '/js/thesod-woocommerce.js', array('jquery', 'thesod-gallery'), '', true);
		wp_localize_script('thesod-woocommerce', 'thesod_woo_data', array(
			'ajax_url' => esc_url(admin_url('admin-ajax.php')),
			'ajax_nonce' => wp_create_nonce('product_quick_view_ajax_security'),
		));
		if(is_woocommerce()) {
			wp_enqueue_script('thesod-woocommerce');
			if (thesod_get_option('products_pagination', 'normal') == 'scroll') {
				wp_enqueue_script('thesod-scroll-monitor');
			}

			if (in_array(thesod_get_option('products_pagination', 'normal'), array('more', 'scroll'))) {
				wp_enqueue_style('thesod-animations');
				wp_enqueue_script('thesod-items-animations');
			}

		}
	}
}
add_action('wp_enqueue_scripts', 'thesod_woocommerce_scripts');

function thesod_enqueue_woocommerce_styles() {
	wp_enqueue_style('thesod-woocommerce');
	wp_enqueue_style('thesod-woocommerce1');
	wp_enqueue_style('thesod-woocommerce-temp');
	wp_enqueue_style('thesod-woocommerce-custom');
}

function thesod_is_woocommerce_page() {
	return function_exists('is_woocommerce') && (is_woocommerce() || is_cart() || is_checkout() || is_account_page() || is_product_category());
}

function thesod_is_wishlist_page() {
	return (function_exists('yith_wcwl_is_wishlist') && yith_wcwl_is_wishlist()) || (function_exists('yith_wcwl_is_wishlist_page') && yith_wcwl_is_wishlist_page());
}

add_action('add_meta_boxes', 'thesod_add_product_settings_boxes');
function thesod_add_product_settings_boxes() {
	add_meta_box('thesod_product_description_meta_box', esc_html__('Product Description', 'thesod'), 'thesod_product_description_settings_box', 'product', 'normal', 'high');
	add_meta_box('thesod_product_hover_meta_box', esc_html__('Product Hover', 'thesod'), 'thesod_product_hover_settings_box', 'product', 'side', 'high');
}

function thesod_product_description_settings_box($post) {
	wp_nonce_field('thesod_product_description_settings_box', 'thesod_product_description_settings_box_nonce');
	$product_description = get_post_meta($post->ID, 'thesod_product_description', true);
?>
<div class="inside">
	<?php wp_editor(htmlspecialchars_decode($product_description), 'thesod_product_description', array(
			'textarea_name' => 'thesod_product_description',
			'quicktags' => array('buttons' => 'em,strong,link'),
			'tinymce' => array(
				'theme_advanced_buttons1' => 'bold,italic,strikethrough,separator,bullist,numlist,separator,blockquote,separator,justifyleft,justifycenter,justifyright,separator,link,unlink,separator,undo,redo,separator',
				'theme_advanced_buttons2' => '',
			),
			'editor_css' => '<style>#wp-excerpt-editor-container .wp-editor-area{height:175px; width:100%;}</style>'
		)); ?>
</div>
<?php
}
function thesod_product_hover_settings_box($post) {
	wp_nonce_field('thesod_product_hover_settings_box', 'thesod_product_hover_settings_box_nonce');
	$product_hover = get_post_meta($post->ID, 'thesod_product_disable_hover', true);
?>
<div class="inside">
	<input name="thesod_product_disable_hover" type="checkbox" id="thesod_product_disable_hover" value="1" <?php checked($product_hover, 1); ?> />
	<label for="thesod_product_disable_hover"><?php esc_html_e('Disable hover with alternative product image', 'thesod'); ?></label>
</div>
<?php
}

function thesod_save_product_data($post_id) {
	if(!isset($_POST['thesod_product_description_settings_box_nonce']) || !isset($_POST['thesod_product_hover_settings_box_nonce'])) {
		return;
	}
	if(!wp_verify_nonce($_POST['thesod_product_description_settings_box_nonce'], 'thesod_product_description_settings_box') || !wp_verify_nonce($_POST['thesod_product_hover_settings_box_nonce'], 'thesod_product_hover_settings_box')) {
		return;
	}

	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}

	if(isset($_POST['post_type']) && $_POST['post_type'] == 'product') {
		if(!current_user_can('edit_page', $post_id)) {
			return;
		}
	} else {
		if(!current_user_can('edit_post', $post_id)) {
			return;
		}
	}
	if(isset($_POST['thesod_product_description'])) {
		update_post_meta($post_id, 'thesod_product_description', $_POST['thesod_product_description']);
	}

	update_post_meta($post_id, 'thesod_product_disable_hover', isset($_POST['thesod_product_disable_hover']));
}
add_action('save_post', 'thesod_save_product_data');

add_filter('woocommerce_enqueue_styles', '__return_false');

function thesod_loop_shop_columns($count) {
	$item_data = array(
		'sidebar_position' => '',
	);
	$item_data = thesod_get_post_data($item_data, 'page', wc_get_page_id('shop'));
	$sidebar_position = thesod_check_array_value(array('', 'left', 'right'), $item_data['sidebar_position'], '');
	if(is_active_sidebar('shop-sidebar') && $sidebar_position) {
		return 3;
	}
	return 4;
}
add_filter('loop_shop_columns', 'thesod_loop_shop_columns');

function thesod_woocommerce_single_product_gallery() {
	global $post, $product;
	wp_enqueue_style('thesod-hovers');
	wp_enqueue_script('thesod-gallery');
	$attachments_ids = array();
	if(has_post_thumbnail()) {
		$attachments_ids = array(get_post_thumbnail_id());
	}
	$attachments_ids = array_merge($attachments_ids, $product->get_gallery_image_ids());
	if('variable' === $product->get_type()) {
		foreach($product->get_available_variations() as $variation) {
			if(has_post_thumbnail($variation['variation_id'])) {
				$thumbnail_id = get_post_thumbnail_id($variation['variation_id']);
				if(!in_array($thumbnail_id, $attachments_ids)) {
					$attachments_ids[] = $thumbnail_id;
				}
			}
		}
	}
	if(empty($attachments_ids)) return ;
	$gallery_uid = uniqid();
	echo '<div class="preloader"><div class="preloader-spin"></div></div>';
	echo '<div class="sod-gallery sod-gallery-hover-default">';
	foreach($attachments_ids as $attachments_id) {
		if(thesod_get_option('woocommerce_activate_images_sizes')) {
			$thumb_image_url = thesod_get_thumbnail_src($attachments_id, 'thesod-product-thumbnail');
			$preview_image_url = thesod_get_thumbnail_src($attachments_id, 'thesod-product-single');
		} else {
			$thumb_image_url = wp_get_attachment_image_src($attachments_id, apply_filters('single_product_small_thumbnail_size', 'shop_thumbnail'));
			$preview_image_url = wp_get_attachment_image_src($attachments_id, apply_filters('single_product_large_thumbnail_size', 'shop_single'));
		}
		$full_image_url = wp_get_attachment_image_src($attachments_id, 'full');
		?>
<div class="sod-gallery-item" data-image-id="<?php echo esc_attr($attachments_id); ?>">
	<div class="sod-gallery-item-image">
		<a href="<?php echo esc_url($preview_image_url[0]); ?>" data-fancybox-group="product-gallery-<?php echo esc_attr($gallery_uid); ?>" data-full-image-url="<?php echo esc_url($full_image_url[0]); ?>">
			<svg width="20" height="10"><path d="M 0,10 Q 9,9 10,0 Q 11,9 20,10" /></svg>
			<img src="<?php echo esc_url($thumb_image_url[0]); ?>" alt="" class="img-responsive">
		</a>
	</div>
</div>
<?php
	}
	echo '</div>';
}

function thesod_woocommerce_single_product_quick_view_gallery() {
	global $post, $product;
	wp_enqueue_style('thesod-hovers');
	wp_enqueue_script('thesod-gallery');
	$attachments_ids = array();
	if(has_post_thumbnail()) {
		$attachments_ids = array(get_post_thumbnail_id());
	}
	$attachments_ids = array_merge($attachments_ids, $product->get_gallery_image_ids());
	if('variable' === $product->get_type()) {
		foreach($product->get_available_variations() as $variation) {
			if(has_post_thumbnail($variation['variation_id'])) {
				$thumbnail_id = get_post_thumbnail_id($variation['variation_id']);
				if(!in_array($thumbnail_id, $attachments_ids)) {
					$attachments_ids[] = $thumbnail_id;
				}
			}
		}
	}
	if(empty($attachments_ids)) return ;
	$gallery_uid = uniqid();
	echo '<div class="preloader"><div class="preloader-spin"></div></div>';
	echo '<div class="sod-simple-gallery sod-quick-view-gallery sod-gallery-hover-default responsive">';
	foreach($attachments_ids as $attachments_id) {
		$preview_image_url = wp_get_attachment_image_src($attachments_id, apply_filters('single_product_large_thumbnail_size', 'shop_single'));
		?>
<div class="sod-gallery-item">
	<div class="sod-gallery-item-image">
		<img src="<?php echo esc_url($preview_image_url[0]); ?>" alt="" class="img-responsive">
	</div>
</div>
<?php
	}
	echo '</div>';
}

function thesod_woocommerce_single_product_page_content() {
	$vc_show_content = false;
	if(thesod_is_plugin_active('js_composer/js_composer.php')) {
		global $vc_manager;
		if($vc_manager->mode() == 'admin_frontend_editor' || $vc_manager->mode() == 'admin_page' || $vc_manager->mode()== 'page_editable') {
			$vc_show_content = true;
		}
	}
	if(get_the_content() || $vc_show_content) {
?>
<div class="product-content entry-content"><?php the_content(); ?></div>
<?php
	}
}

function thesod_woocommerce_output_related_products_args($args) {
	$args['posts_per_page'] = 6;
	$args['columns'] = 6;
	return $args;
}
add_filter('woocommerce_output_related_products_args', 'thesod_woocommerce_output_related_products_args');

function thesod_loop_shop_per_page() {
	$pc = !empty($_REQUEST['product_count']) && intval($_REQUEST['product_count']) > 0 ? intval($_REQUEST['product_count']) : 12;
	return $pc;
}
add_filter('loop_shop_per_page', 'thesod_loop_shop_per_page', 15);

function thesod_woocommerce_product_per_page_select() {
	$products_per_page_items = array(12,24,48);
	$pc = !empty($_REQUEST['product_count']) && intval($_REQUEST['product_count']) > 0 ? intval($_REQUEST['product_count']) : 12;
?>
<div class="woocommerce-select-count">
	<select id="products-per-page" name="products_per_page" class="sod-combobox" onchange="window.location.href=jQuery(this).val();">
		<?php foreach($products_per_page_items as $products_per_page_item) : ?>
			<option value="<?php echo esc_url(add_query_arg('product_count', $products_per_page_item)); ?>" <?php selected($pc, $products_per_page_item); ?>><?php printf(esc_html__('Show %d On Page', 'thesod'), $products_per_page_item); ?></option>
		<?php endforeach; ?>
	</select>
</div>
<?php
}

function thesod_woocommerce_before_shop_content() {
	echo '<div class="products-list">';
}
function thesod_woocommerce_after_shop_content() {
	echo '</div><!-- .products-list -->';
}

function thesod_woocommerce_before_shop_loop_start() {
	echo '<div class="before-products-list rounded-corners clearfix">';
}
function thesod_woocommerce_before_shop_loop_end() {
	echo '</div>';
}
function thesod_woocommerce_single_product_navigation() {
?>
<div class="block-navigation">
	<?php if($post = get_previous_post()) : ?>
		<div class="block-product-navigation-prev">
			<?php thesod_button(array(
				'text' => __('Prev', 'thesod'),
				'href' => get_permalink($post->ID),
				'style' => 'outline',
				'size' => 'tiny',
				'position' => 'left',
				'icon' => 'prev',
				'border_color' => thesod_get_option('button_background_basic_color'),
				'text_color' => thesod_get_option('button_background_basic_color'),
				'hover_background_color' => thesod_get_option('button_background_basic_color'),
				'hover_text_color' => thesod_get_option('button_outline_text_hover_color'),
			), 1); ?>
		</div>
	<?php endif; ?>
	<?php if($post = get_next_post()) : ?>
		<div class="block-product-navigation-next">
			<?php thesod_button(array(
				'text' => __('Next', 'thesod'),
				'href' => get_permalink($post->ID),
				'style' => 'outline',
				'size' => 'tiny',
				'position' => 'right',
				'icon' => 'next',
				'icon_position' => 'right',
				'border_color' => thesod_get_option('button_background_basic_color'),
				'text_color' => thesod_get_option('button_background_basic_color'),
				'hover_background_color' => thesod_get_option('button_background_basic_color'),
				'hover_text_color' => thesod_get_option('button_outline_text_hover_color'),
			), 1); ?>
		</div>
	<?php endif; ?>
</div><!-- .block-product-navigation-prev -->
<?php
}

function thesod_product_quick_view_navigation() {
?>
<div class="product-quick-view-navigation">
	<?php if($post = get_previous_post()) : ?>
		<?php thesod_button(array(
			'style' => 'outline',
			'size' => 'tiny',
			'icon' => 'prev',
			'border_color' => thesod_get_option('button_background_basic_color'),
			'text_color' => thesod_get_option('button_background_basic_color'),
			'hover_background_color' => thesod_get_option('button_background_basic_color'),
			'hover_text_color' => thesod_get_option('button_outline_text_hover_color'),
			'attributes' => array(
				'data-product-id' => $post->ID
			)
		), 1); ?>
	<?php endif; ?>
	<?php if($post = get_next_post()) : ?>
		<?php thesod_button(array(
			'style' => 'outline',
			'size' => 'tiny',
			'icon' => 'next',
			'icon_position' => 'right',
			'border_color' => thesod_get_option('button_background_basic_color'),
			'text_color' => thesod_get_option('button_background_basic_color'),
			'hover_background_color' => thesod_get_option('button_background_basic_color'),
			'hover_text_color' => thesod_get_option('button_outline_text_hover_color'),
			'attributes' => array(
				'data-product-id' => $post->ID
			)
		), 1); ?>
	<?php endif; ?>
</div>
<?php
}

function thesod_woocommerce_show_product_loop_featured_flash() {
	global $post, $product;
	if($product->is_featured()) {
		echo apply_filters('woocommerce_featured_flash', '<span class="new-label title-h6">' . esc_html__( 'New', 'thesod' ) . '</span>', $post, $product);
	}
}

function thesod_woocommerce_show_product_loop_out_of_stock_flash() {
	global $post, $product;
	if(!$product->is_in_stock()) {
		echo apply_filters('woocommerce_out_of_stock_flash', '<span class="out-of-stock-label title-h6">' . wp_kses(__('Out <span class="small">of stock</span>', 'thesod'), array('span' => array('class' => array()))) . '</span>', $post, $product);
	}
}

function thesod_woocommerce_after_shop_loop_item_link() {
	global $post, $product;
	echo '<a href="'.esc_url(get_the_permalink()).'" class="bottom-product-link"></a>';
}

function thesod_woocommerce_single_variation_add_to_cart_button() {
	global $product;
	?>
	<div class="woocommerce-variation-add-to-cart variations_button">
		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
		<?php do_action( 'woocommerce_before_add_to_cart_quantity' ); ?>
		<?php woocommerce_quantity_input( array( 'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : 1 ) ); ?>
		<?php thesod_button(array(
			'tag' => 'button',
			'text' => esc_html($product->single_add_to_cart_text()),
			'icon' => 'cart',
			'background_color' => thesod_get_option('styled_elements_color_1'),
			'hover_background_color' => thesod_get_option('button_background_hover_color'),
			'attributes' => array('type' => 'submit', 'class' => 'single_add_to_cart_button button alt'),
		), 1); ?>
		<?php do_action('thesod_woocommerce_after_add_to_cart_button'); ?>
		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
		<input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
		<input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
		<input type="hidden" name="variation_id" class="variation_id" value="" />
	</div>
	<?php
}

function thesod_woocommerce_back_to_shop_button() {
	thesod_button(array(
		'href' => get_permalink(wc_get_page_id('shop')),
		'style' => 'outline',
		'size' => 'tiny',
		'position' => 'right',
		'icon' => 'prev',
		'border_color' => thesod_get_option('button_background_basic_color'),
		'text_color' => thesod_get_option('button_background_basic_color'),
		'hover_background_color' => thesod_get_option('button_background_basic_color'),
		'hover_text_color' => thesod_get_option('button_outline_text_hover_color'),
		'extra_class' => 'back-to-shop-button'
	), 1);
}

function thesod_woocommerce_rating_separator() {
	echo '<div class="rating-divider"></div>';
}

function thesod_woocommerce_size_guide() {
	global $product;
	$product_size_guide_data = thesod_get_sanitize_product_size_guide_data($product->get_id());
	$size_guide_image = thesod_get_option('size_guide_image');
	if($product_size_guide_data['disable']) {
		$size_guide_image = '';
	} elseif($product_size_guide_data['custom'] && $product_size_guide_data['custom_image']) {
		$size_guide_image = $product_size_guide_data['custom_image'];
	}
?>
	<?php if($size_guide_image) : ?>
		<div class="size-guide"><a href="<?php echo esc_url($size_guide_image); ?>" class="fancybox"><?php esc_html_e('Size guide', 'thesod'); ?></a></div>
	<?php endif; ?>
<?php
}

function thesod_yith_wcwl_add_to_wishlist_button() {
	global $product;

	if( ! isset( $product ) ){
		$product = ( isset( $atts['product_id'] ) ) ? wc_get_product( $atts['product_id'] ) : false;
	}

	$label_option = get_option( 'yith_wcwl_add_to_wishlist_text' );
	$label = apply_filters( 'yith_wcwl_button_label', $label_option );
	$browse_wishlist = get_option( 'yith_wcwl_browse_wishlist_text' );

	$default_wishlists = is_user_logged_in() ? YITH_WCWL()->get_wishlists( array( 'is_default' => true ) ) : false;

	if( ! empty( $default_wishlists ) ){
		$default_wishlist = $default_wishlists[0]['ID'];
	}
	else{
		$default_wishlist = false;
	}

	$exists = YITH_WCWL()->is_product_in_wishlist( $product->get_id(), $default_wishlist );

	$wishlist_url = YITH_WCWL()->get_wishlist_url();
	$product_type = $product->get_type();

	$disable_wishlist = false;
	$available_multi_wishlist = false;
?>

<div class="yith-wcwl-add-to-wishlist add-to-wishlist-<?php echo esc_attr($product->get_id()); ?>">
	<?php if(!($disable_wishlist && ! is_user_logged_in())): ?>
		<?php
			thesod_button(array(
				'style' => 'outline',
				'text' => $label,
				'href' => esc_url(add_query_arg('add_to_wishlist', $product->get_id())),
				'text_color' => thesod_get_option('button_background_basic_color'),
				'border_color' => thesod_get_option('button_background_basic_color'),
				'hover_text_color' => thesod_get_option('button_outline_text_hover_color'),
				'hover_background_color' => thesod_get_option('button_background_basic_color'),
				'hover_border_color' => thesod_get_option('button_background_basic_color'),
				'icon' => 'add-to-wishlist',
				'attributes' => array(
					'data-product-type' => $product_type,
					'data-product-id' => $product->get_id(),
					'rel' => 'nofollow',
					'class' => 'add_to_wishlist',
				),
				'extra_class' => 'yith-wcwl-add-button '.(($exists && ! $available_multi_wishlist) ? 'hide': 'show'),
			),1);
		?>

		<?php
			thesod_button(array(
				'style' => 'outline',
				'text' => apply_filters('yith-wcwl-browse-wishlist-label', $browse_wishlist),
				'href' => esc_url($wishlist_url),
				'text_color' => thesod_get_option('button_background_basic_color'),
				'border_color' => thesod_get_option('button_background_basic_color'),
				'hover_text_color' => thesod_get_option('button_outline_text_hover_color'),
				'hover_background_color' => thesod_get_option('button_background_basic_color'),
				'hover_border_color' => thesod_get_option('button_background_basic_color'),
				'icon' => 'browse-wishlist',
				'attributes' => array(
					'rel' => 'nofollow',
				),
				'extra_class' => 'yith-wcwl-wishlistaddedbrowse hide',
			),1);
		?>

		<?php
			thesod_button(array(
				'style' => 'outline',
				'text' => apply_filters('yith-wcwl-browse-wishlist-label', $browse_wishlist),
				'href' => esc_url($wishlist_url),
				'text_color' => thesod_get_option('button_background_basic_color'),
				'border_color' => thesod_get_option('button_background_basic_color'),
				'hover_text_color' => thesod_get_option('button_outline_text_hover_color'),
				'hover_background_color' => thesod_get_option('button_background_basic_color'),
				'hover_border_color' => thesod_get_option('button_background_basic_color'),
				'icon' => 'browse-wishlist',
				'attributes' => array(
					'rel' => 'nofollow',
				),
				'extra_class' => 'yith-wcwl-wishlistexistsbrowse '.(($exists && ! $available_multi_wishlist) ? 'show' : 'hide'),
			),1);
		?>
		<div class="yith-wcwl-wishlistaddresponse"></div>
	<?php else: ?>
		<?php
			thesod_button(array(
				'style' => 'outline',
				'text' => $label,
				'href' => esc_url(add_query_arg(array('wishlist_notice' => 'true', 'add_to_wishlist' => $product->get_id()), get_permalink(wc_get_page_id('myaccount')))),
				'text_color' => thesod_get_option('button_background_basic_color'),
				'border_color' => thesod_get_option('button_background_basic_color'),
				'hover_text_color' => thesod_get_option('button_outline_text_hover_color'),
				'hover_background_color' => thesod_get_option('button_background_basic_color'),
				'hover_border_color' => thesod_get_option('button_background_basic_color'),
				'icon' => 'wishlist',
				'attributes' => array(
					'data-product-type' => $product_type,
					'rel' => 'nofollow',
					'class' => 'add_to_wishlist',
				),
				'extra_class' => 'yith-wcwl-add-button '.(($exists && !$available_multi_wishlist) ? 'hide': 'show'),
			),1);
		?>
	<?php endif; ?>

</div>
<?php
}

function thesod_woocommerce_template_loop_product_hover_thumbnail() {
	global $post, $product;
	$gallery = $product->get_gallery_image_ids();
	$product_hover = get_post_meta($post->ID, 'thesod_product_disable_hover', true);
	$output = '<span class="woo-product-overlay"></span>';
	if(isset($gallery[0]) && !$product_hover) {
		if(thesod_get_option('woocommerce_activate_images_sizes')) {
			$image = thesod_get_thumbnail_image($gallery[0], 'thesod-product-catalog', false, array( 'class' => "attachment woo-product-hover"));
		} else {
			$image = wp_get_attachment_image($gallery[0], 'shop_catalog', false, array( 'class' => "attachment woo-product-hover"));
		}
		if(!empty($image)) $output = $image;
	}
	echo $output;
}

function thesod_woocommerce_template_loop_product_quick_view() {
	global $post, $product;
	if(thesod_get_option('product_quick_view')) {
		wp_enqueue_script( 'wc-single-product' );
		wp_enqueue_script( 'wc-add-to-cart-variation' );
		echo '<span class="quick-view-button title-h6" data-product-id="'.$post->ID.'">'.esc_html__('Quick View', 'thesod').'</span>';
	}
}


function thesod_woocommerce_template_loop_category_title($category) {
	echo '<div class="category-overlay">';
	echo '<h6 class="category-title">'.$category->name.'</h6>';
	echo '<div class="category-overlay-separator"></div>';
	echo '<div class="category-count">'.sprintf(esc_html(_n('%s item', '%s items', $category->count, 'thesod')), $category->count).'</div>';
	echo '</div>';
}

remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description', 10 );
add_action( 'woocommerce_after_shop_loop', 'thesod_woocommerce_after_shop_content', 15);
add_action( 'woocommerce_after_shop_loop', 'woocommerce_taxonomy_archive_description', 15 );
add_action( 'woocommerce_after_shop_loop', 'woocommerce_product_archive_description', 15 );

remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_output_all_notices', 10 );
add_action( 'woocommerce_before_checkout_form', 'woocommerce_output_all_notices', 5 );

remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
add_action('woocommerce_before_shop_loop', 'thesod_woocommerce_before_shop_content', 4);
add_action('woocommerce_before_shop_loop', 'thesod_woocommerce_before_shop_loop_start', 11);
add_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 15);
add_action('woocommerce_before_shop_loop', 'woocommerce_breadcrumb', 20);
add_action('woocommerce_before_shop_loop', 'thesod_woocommerce_product_per_page_select', 30);
add_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 40);
add_action('woocommerce_before_shop_loop', 'thesod_woocommerce_before_shop_loop_end', 45);

remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);

remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
add_action('woocommerce_shop_loop_item_labels', 'woocommerce_show_product_loop_sale_flash', 5);
add_action('woocommerce_shop_loop_item_labels', 'thesod_woocommerce_show_product_loop_featured_flash', 10);
add_action('woocommerce_shop_loop_item_labels', 'thesod_woocommerce_show_product_loop_out_of_stock_flash', 10);
add_action('woocommerce_shop_loop_item_image', 'woocommerce_template_loop_product_thumbnail', 10);
add_action('woocommerce_shop_loop_item_image', 'thesod_woocommerce_template_loop_product_hover_thumbnail', 15);
add_action('woocommerce_shop_loop_item_image', 'thesod_woocommerce_template_loop_product_quick_view', 40);
add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);

add_action('woocommerce_after_shop_loop_item', 'thesod_woocommerce_after_shop_loop_item_link', 15);
if(function_exists('thesod_is_plugin_active') && !thesod_get_option('catalog_view') && defined( 'YITH_WCWL' )) {
	add_action('woocommerce_after_shop_loop_item', function() { echo do_shortcode( "[yith_wcwl_add_to_wishlist]" ); }, 20);
}

add_action('thesod_woocommerce_single_product_left', 'thesod_woocommerce_single_product_gallery', 5);
add_action('thesod_woocommerce_single_product_left', 'thesod_socials_sharing', 10);
add_action('thesod_woocommerce_single_product_left', 'woocommerce_template_single_meta', 15);

add_action('thesod_woocommerce_single_product_quick_view_left', 'thesod_woocommerce_single_product_quick_view_gallery', 5);

add_action('thesod_woocommerce_single_product_right', 'thesod_woocommerce_back_to_shop_button', 5);
add_action('thesod_woocommerce_single_product_right', 'woocommerce_template_single_title', 10);
add_action('thesod_woocommerce_single_product_right', 'woocommerce_template_single_rating', 20);
add_action('thesod_woocommerce_single_product_right', 'thesod_woocommerce_rating_separator', 25);
add_action('thesod_woocommerce_single_product_right', 'woocommerce_template_single_price', 30);
add_action('thesod_woocommerce_single_product_right', 'woocommerce_template_single_excerpt', 35);
add_action('thesod_woocommerce_single_product_right', 'woocommerce_template_single_add_to_cart', 45);
add_action('thesod_woocommerce_single_product_right', 'thesod_woocommerce_size_guide', 50);

add_action('thesod_woocommerce_single_product_quick_view_right', 'woocommerce_template_single_title', 10);
add_action('thesod_woocommerce_single_product_quick_view_right', 'woocommerce_template_single_rating', 20);
add_action('thesod_woocommerce_single_product_quick_view_right', 'thesod_woocommerce_rating_separator', 25);
add_action('thesod_woocommerce_single_product_quick_view_right', 'woocommerce_template_single_price', 30);
add_action('thesod_woocommerce_single_product_quick_view_right', 'woocommerce_template_single_excerpt', 35);
add_action('thesod_woocommerce_single_product_quick_view_right', 'woocommerce_template_single_add_to_cart', 45);
add_action('thesod_woocommerce_single_product_quick_view_right', 'woocommerce_template_single_meta', 55);
add_action('thesod_woocommerce_single_product_quick_view_bottom', 'thesod_product_quick_view_navigation', 10);

if(function_exists('thesod_is_plugin_active') && thesod_is_plugin_active('yith-woocommerce-wishlist/init.php')) {
	add_action('thesod_woocommerce_after_add_to_cart_button', 'thesod_yith_wcwl_add_to_wishlist_button');
}

remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20 );
add_action( 'woocommerce_single_variation', 'thesod_woocommerce_single_variation_add_to_cart_button', 20 );

add_action('thesod_woocommerce_single_product_bottom', 'woocommerce_output_product_data_tabs', 5);
add_action('thesod_woocommerce_single_product_bottom', 'thesod_woocommerce_single_product_navigation', 10);
add_action('thesod_woocommerce_single_product_bottom', 'thesod_woocommerce_single_product_page_content', 15);

add_action('thesod_woocommerce_after_single_product', 'woocommerce_output_related_products', 5);

remove_action( 'woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title', 10 );
add_action( 'woocommerce_shop_loop_subcategory_title', 'thesod_woocommerce_template_loop_category_title', 10 );

remove_action( 'woocommerce_review_before_comment_meta', 'woocommerce_review_display_rating', 10 );
remove_action( 'woocommerce_review_meta', 'woocommerce_review_display_meta', 10 );

function thesod_cart_menu($items, $args) {
	if(thesod_is_plugin_active('woocommerce/woocommerce.php') && $args->theme_location == 'primary' && !thesod_get_option('hide_card_icon')) {
		global $woocommerce;

		$count = thesod_get_option('cart_label_count') ? $woocommerce->cart->cart_contents_count : sizeof(WC()->cart->get_cart());

		ob_start();
		woocommerce_mini_cart();
		$minicart = ob_get_clean();
		$items .= '<li class="menu-item menu-item-cart not-dlmenu"><a href="'.esc_url(get_permalink(wc_get_page_id('cart'))).'" class="minicart-menu-link ' . ($count == 0 ? 'empty' : '') . '">' . '<span class="minicart-item-count">' . $count . '</span>' . '</a><div class="minicart"><div class="widget_shopping_cart_content">'.$minicart.'</div></div></li>';
	}
	return $items;
}
add_filter('wp_nav_menu_items', 'thesod_cart_menu', 11, 2);

function thesod_woocommerce_placeholder_img($val, $size, $dimensions) {
	return '<span class="product-dummy-wrapper" style="max-width: '.$dimensions['width'].'px;"><span class="product-dummy" style="padding-bottom: '.($dimensions['height']*100/$dimensions['width']).'%;"></span></span>';
}
add_filter('woocommerce_placeholder_img', 'thesod_woocommerce_placeholder_img', 10, 3);

function thesod_cart_short_info() {
	global $woocommerce;
	echo '<div class="cart-short-info">'.sprintf(wp_kses(__('You Have <span class="items-count">%d Items</span> In Your Cart', 'thesod'), array('span' => array('class' => array()))), $woocommerce->cart->cart_contents_count).'</div>';
}
add_action('woocommerce_before_cart', 'thesod_cart_short_info', 15);
add_action('woocommerce_before_cart', 'woocommerce_breadcrumb', 10);

function thesod_cart_items_html_output() {
	thesod_cart_short_info();
	die(-1);
}
add_action('wp_ajax_thesod_cart_items_html', 'thesod_cart_items_html_output');
add_action('wp_ajax_nopriv_thesod_cart_items_html', 'thesod_cart_items_html_output');

function thesod_wc_add_to_cart_message($message, $products) {
	$titles = array();
	$count  = 0;

	$show_qty = true;

	if ( ! is_array( $products ) ) {
		$products = array( $products => 1 );
		$show_qty = false;
	}

	if ( ! $show_qty ) {
		$products = array_fill_keys( array_keys( $products ), 1 );
	}

	foreach ( $products as $product_id => $qty ) {
		$titles[] = ( $qty > 1 ? absint( $qty ) . ' &times; ' : '' ) . sprintf( _x( '&ldquo;%s&rdquo;', 'Item name in quotes', 'woocommerce' ), strip_tags( get_the_title( $product_id ) ) );
		$count += $qty;
	}

	$titles = array_filter( $titles );

	$added_text = sprintf( _n( '%s has been added to your cart.', '%s have been added to your cart.', $count, 'woocommerce' ), wc_format_list_of_items( $titles ) );

	// Output success messages
	if ( 'yes' === get_option( 'woocommerce_cart_redirect_after_add' ) ) {
		$return_to = apply_filters( 'woocommerce_continue_shopping_redirect', wc_get_raw_referer() ? wp_validate_redirect( wc_get_raw_referer(), false ) : wc_get_page_permalink( 'shop' ) );

		$message = sprintf('<div class="cart-added"><div class="cart-added-text">%s</div><div class="cart-added-button"><a href="%s" class="sod-button button wc-forward">%s</a></div></div>', $added_text, esc_url($return_to), esc_html__('Continue shopping', 'woocommerce'));

	} else {

		$message = sprintf('<div class="cart-added"><div class="cart-added-text">%s</div><div class="cart-added-button"><a href="%s" class="sod-button button wc-forward">%s</a></div></div>', $added_text, esc_url(wc_get_page_permalink( 'cart' )), esc_html__('View cart', 'woocommerce'));

	}

	return $message;
}
add_filter('wc_add_to_cart_message_html', 'thesod_wc_add_to_cart_message', 10, 2);

function thesod_product_add_page_settings_boxes() {
	add_meta_box('thesod_page_title', esc_html__('Page Title', 'thesod'), 'thesod_page_title_settings_box', 'product', 'normal', 'high');
	add_meta_box('thesod_page_sidebar', esc_html__('Page Sidebar', 'thesod'), 'thesod_page_sidebar_settings_box', 'product', 'normal', 'high');
}
add_action('add_meta_boxes', 'thesod_product_add_page_settings_boxes');

function thesod_save_product_page_data($post_id) {
	if(
		!isset($_POST['thesod_page_title_settings_box_nonce']) ||
		!isset($_POST['thesod_page_sidebar_settings_box_nonce'])
	) {
		return;
	}
	if(
		!wp_verify_nonce($_POST['thesod_page_title_settings_box_nonce'], 'thesod_page_title_settings_box') ||
		!wp_verify_nonce($_POST['thesod_page_sidebar_settings_box_nonce'], 'thesod_page_sidebar_settings_box')
	) {
		return;
	}

	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}

	if(isset($_POST['post_type']) && in_array($_POST['post_type'], array('product'))) {
		if(!current_user_can('edit_page', $post_id)) {
			return;
		}
	} else {
		if(!current_user_can('edit_post', $post_id)) {
			return;
		}
	}

	if(!isset($_POST['thesod_page_data']) || !is_array($_POST['thesod_page_data'])) {
		return;
	}

	$page_data = array_merge(
		thesod_get_sanitize_page_title_data(0, $_POST['thesod_page_data']),
		thesod_get_sanitize_page_sidebar_data(0, $_POST['thesod_page_data'])
	);
	update_post_meta($post_id, 'thesod_page_data', $page_data);
}
add_action('save_post', 'thesod_save_product_page_data');


function thesod_product_tabs($tabs = array()) {
		global $product, $post;
		// Description tab - shows product content
		if (get_post_meta($post->ID, 'thesod_product_description', true)) {
			$tabs['description'] = array(
				'title'	=> esc_html__( 'Description', 'woocommerce' ),
				'priority' => 10,
				'callback' => 'woocommerce_product_description_tab'
			);
		} elseif(isset($tabs['description'])) {
			unset($tabs['description']);
		}

		return $tabs;
}
add_filter('woocommerce_product_tabs', 'thesod_product_tabs', 11);

function thesod_woocommerce_subcategory_thumbnail( $category ) {
	$small_thumbnail_size = apply_filters( 'single_category_small_thumbnail_size', 'shop_catalog' );
	$thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true);
	$image = '';

	if ( $thumbnail_id ) {
		if(thesod_get_option('woocommerce_activate_images_sizes')) {
			$image = thesod_get_thumbnail_src( $thumbnail_id, 'thesod-product-catalog' );
		} else {
			$image = wp_get_attachment_image_src( $thumbnail_id, $small_thumbnail_size );
		}
		global $thesod_product_categories_images;
		if($thesod_product_categories_images) {
			$image = wp_get_attachment_image_src( $thumbnail_id, 'thesod-custom-product-categories');
		}
	}

	if ( $image ) {
		$image[0] = str_replace( ' ', '%20', $image[0] );
		echo '<img src="' . esc_url( $image[0] ) . '" width="'.esc_attr($image[1]).'" height="'.esc_attr($image[2]).'" alt="' . esc_attr( $category->name ) . '" class="img-responsive" />';
	} else {
		if(thesod_get_option('woocommerce_activate_images_sizes')) {
			echo wc_placeholder_img(array(thesod_get_option('woocommerce_catalog_image_width'), thesod_get_option('woocommerce_catalog_image_height'), 1));
		} else {
			echo wc_placeholder_img($small_thumbnail_size);
		}
	}
}
remove_action('woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail', 10);
add_action('woocommerce_before_subcategory_title', 'thesod_woocommerce_subcategory_thumbnail', 10);

add_filter('woocommerce_add_to_cart_fragments', 'gem_woocommerce_header_dropdown_cart_fragment');

function gem_woocommerce_header_dropdown_cart_fragment( $fragments ) {
	global $woocommerce;

	$count = thesod_get_option('cart_label_count') ? $woocommerce->cart->cart_contents_count : sizeof(WC()->cart->get_cart());
	$fragments['a.minicart-menu-link'] = '<a href="'.esc_url(get_permalink(wc_get_page_id('cart'))).'" class="minicart-menu-link ' . ($count == 0 ? 'empty' : '') . '"><span class="minicart-item-count">'.$count.'</span></a>';
	return $fragments;
}

function thesod_single_product_small_thumbnail_size($size) {
	global $thesod_product_categories_images;
	if($thesod_product_categories_images) {
		return 'thesod-custom-product-categories';
	}
	return $size;
}
add_filter( 'single_category_small_thumbnail_size', 'thesod_single_product_small_thumbnail_size' );

function thesod_woocommerce_get_image_size_categories($size) {
	$size = array(
		'width'  => '1170',
		'height' => '1117',
		'crop'   => 1
	);
	return $size;
}
add_filter( 'woocommerce_get_image_size_thesod-custom-product-categories', 'thesod_woocommerce_get_image_size_categories' );

function thesod_woocommerce_account_menu_item_classes($classes, $endpoint) {
	if(in_array('is-active', $classes)) {
		$classes[] = 'current-menu-ancestor';
	}
	return $classes;
}
add_filter('woocommerce_account_menu_item_classes', 'thesod_woocommerce_account_menu_item_classes', 10, 2);

function thesod_product_quick_view_output() {
	$nonce = empty($_REQUEST['ajax_nonce']) ? '' : $_REQUEST['ajax_nonce'];
	$product_id = empty($_REQUEST['product_id']) ? '' : $_REQUEST['product_id'];

	if(!wp_verify_nonce($nonce, 'product_quick_view_ajax_security' )) {
		die(-1);
	}

	$args = array(
		'posts_per_page'	  => 1,
		'post_type'		   => 'product',
		'post_status'		 => 'publish',
		'ignore_sticky_posts' => 1,
		'no_found_rows'	   => 1,
	);

	if ( isset( $product_id ) ) {
		$args['p'] = absint( $product_id );
	}

	$single_product = new WP_Query( $args );

	$preselected_id = '0';

	ob_start();

	while ( $single_product->have_posts() ) :
		$single_product->the_post();
		?>

		<div class="single-product" data-product-page-preselected-id="<?php echo esc_attr( $preselected_id ); ?>">

			<?php wc_get_template_part( 'content', 'single-product-quick-view' ); ?>

		</div>

	<?php endwhile; // end of the loop.

	wp_reset_postdata();
$time2= time();
	echo '<div class="woocommerce">' . ob_get_clean() . '</div>';

	die(-1);
}
add_action('wp_ajax_thesod_product_quick_view', 'thesod_product_quick_view_output');
add_action('wp_ajax_nopriv_thesod_product_quick_view', 'thesod_product_quick_view_output');

function thesod_catalog_view() {
	if(thesod_get_option('catalog_view')) {
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
		remove_action('thesod_woocommerce_single_product_right', 'woocommerce_template_single_price', 30);
		remove_action('thesod_woocommerce_single_product_right', 'woocommerce_template_single_add_to_cart', 45);
		remove_action('thesod_woocommerce_single_product_quick_view_right', 'woocommerce_template_single_price', 30);
		remove_action('thesod_woocommerce_single_product_quick_view_right', 'woocommerce_template_single_add_to_cart', 45);
		remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);

		remove_action('thesod_woocommerce_single_product_left', 'thesod_socials_sharing', 10);
		remove_action('thesod_woocommerce_single_product_left', 'woocommerce_template_single_meta', 15);

		add_action('thesod_woocommerce_single_product_right', 'thesod_socials_sharing', 65);
		add_action('thesod_woocommerce_single_product_right', 'woocommerce_template_single_meta', 70);

		remove_action('wp_nav_menu_items', 'thesod_cart_menu', 11);

	}
}
add_action('init', 'thesod_catalog_view');
add_action('wp', 'thesod_catalog_view');

function thesod_woocommerce_form_field_args_callback($args, $key, $value) {
	if (stripos($key, 'shipping_') === 0) {
		$args['autofocus'] = false;
	}
	return $args;
}
add_filter('woocommerce_form_field_args', 'thesod_woocommerce_form_field_args_callback', 10, 3);

function thesod_woocommerce_loop_add_to_cart_link($link, $product) {
	if (strripos($link, 'add_to_cart_button') === false) {
		return '';
	}
	return $link;
}
add_filter('woocommerce_loop_add_to_cart_link', 'thesod_woocommerce_loop_add_to_cart_link', 10, 2);

function thesod_woocommerce_structured_data() {
	if(isset($GLOBALS['woocommerce']) && isset($GLOBALS['woocommerce']->structured_data)) {
		add_action('thesod_woocommerce_single_product_right', array($GLOBALS['woocommerce']->structured_data, 'generate_product_data'), 60);
	}
}
add_action('init', 'thesod_woocommerce_structured_data');

function thesod_single_product_archive_thumbnail_size($size) {
	if(thesod_get_option('woocommerce_activate_images_sizes')) {
		return 'thesod-product-catalog';
	}
	return $size;
}
add_filter( 'single_product_archive_thumbnail_size', 'thesod_single_product_archive_thumbnail_size' );
add_filter( 'subcategory_archive_thumbnail_size', 'thesod_single_product_archive_thumbnail_size' );

function thesod_woocommerce_get_image_size_thumbnail($size) {
	if(thesod_get_option('woocommerce_activate_images_sizes')) {
		return array(
			'width' => thesod_get_option('woocommerce_thumbnail_image_width'),
			'height' => thesod_get_option('woocommerce_thumbnail_image_height'),
			'crop' => 1,
		);
	}
	return $size;
}
add_filter( 'woocommerce_get_image_size_thumbnail', 'thesod_woocommerce_get_image_size_thumbnail' );

function thesod_woocommerce_product_get_image( $image, $product, $size, $attr, $placeholder, $image_o) {
	if(thesod_get_option('woocommerce_activate_images_sizes') && $size == 'thesod-product-catalog') {
		if ( $product->get_image_id() ) {
			$image = thesod_get_thumbnail_image($product->get_image_id(), $size, false, $attr);
		} elseif ( $product->get_parent_id() ) {
			$parent_product = wc_get_product( $product->get_parent_id() );
			$image = $parent_product->get_image( $size, $attr, $placeholder );
		} elseif ( $placeholder ) {
			$image = wc_placeholder_img( $size );
		} else {
			$image = '';
		}
	}
	return $image;
}
add_filter( 'woocommerce_product_get_image', 'thesod_woocommerce_product_get_image', 10, 6);
