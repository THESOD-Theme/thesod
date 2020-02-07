<?php
	$thesod_page_id = is_singular() ? get_the_ID() : 0;
	$thesod_shop_page = 0;
	if(is_404() && get_post(thesod_get_option('404_page'))) {
		$thesod_page_id = thesod_get_option('404_page');
	}
	if((is_post_type_archive('product') || is_tax('product_cat') || is_tax('product_tag')) && function_exists('wc_get_page_id')) {
		$thesod_page_id = wc_get_page_id('shop');
		$thesod_shop_page = 1;
	}
	$thesod_header_params = thesod_get_sanitize_page_header_data($thesod_page_id);
	$thesod_effects_params = thesod_get_sanitize_page_effects_data($thesod_page_id);
	if(is_archive() && !$thesod_shop_page) {
		$thesod_header_params = thesod_theme_options_get_page_settings('blog');
		$thesod_effects_params = thesod_theme_options_get_page_settings('blog');
	}
	if(!$thesod_shop_page && is_tax() || is_category() || is_tag()) {
		$thesod_term_id = get_queried_object()->term_id;
		if(get_term_meta($thesod_term_id , 'thesod_taxonomy_custom_page_options', true)) {
			$thesod_header_params = thesod_get_sanitize_page_header_data($thesod_term_id, array(), 'term');
			$thesod_effects_params = thesod_get_sanitize_page_effects_data($thesod_term_id, array(), 'term');
		}
	}
	if($thesod_effects_params['effects_page_scroller']) {
		$thesod_header_params['header_hide_top_area'] = true;
		$thesod_header_params['header_transparent'] = true;
	}
	$thesod_header_light = $thesod_header_params['header_menu_logo_light'] ? '_light' : '';
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<?php wp_head(); ?>
</head>

<?php
	$thesod_preloader_data = thesod_get_sanitize_page_preloader_data($thesod_page_id);
	if(is_tax() || is_category() || is_tag()) {
		$thesod_term_id = get_queried_object()->term_id;
		if(get_term_meta($thesod_term_id , 'thesod_taxonomy_custom_page_options', true)) {
			$thesod_preloader_data = thesod_get_sanitize_page_header_data($thesod_term_id, array(), 'term');
		}
	}
?>

<body <?php body_class(); ?>>

<?php do_action('gem_before_page_content'); ?>

<?php if ( thesod_get_option('enable_page_preloader') || ( $thesod_preloader_data && !empty($thesod_preloader_data['enable_page_preloader']) ) ) : ?>
	<div id="page-preloader"><div class="page-preloader-spin"></div></div>
	<?php do_action('gem_after_page_preloader'); ?>
<?php endif; ?>

<?php if(thesod_get_option('header_layout') == 'perspective') : ?>
	<div id="thesod-perspective" class="thesod-perspective effect-moveleft">
		<div class="thesod-perspective-menu-wrapper <?php echo ($thesod_header_params['header_menu_logo_light'] ? ' header-colors-light' : ''); ?> mobile-menu-layout-<?php echo esc_attr(thesod_get_option('mobile_menu_layout', 'default')); ?>">
			<nav id="primary-navigation" class="site-navigation primary-navigation perspective-navigation vertical right" role="navigation">
				<?php do_action('thesod_before_perspective_nav_menu'); ?>
				<?php wp_nav_menu(array('theme_location' => 'primary', 'menu_id' => 'primary-menu', 'menu_class' => apply_filters( 'thesod_nav_menu_class', 'nav-menu styled no-responsive' ), 'container' => false, 'walker' => new thesod_Mega_Menu_Walker)); ?>
				<?php do_action('thesod_after_perspective_nav_menu'); ?>
			</nav>
		</div>
<?php endif; ?>

<div id="page" class="layout-<?php echo esc_attr(thesod_get_option('page_layout_style', 'fullwidth')); ?><?php echo esc_attr(thesod_get_option('header_layout') == 'vertical' ? ' vertical-header' : '') ; ?> header-style-<?php echo esc_attr(thesod_get_option('header_layout') == 'vertical' || thesod_get_option('header_layout') == 'fullwidth_hamburger' ? 'vertical' : thesod_get_option('header_style')); ?>">

	<?php if(!thesod_get_option('disable_scroll_top_button')) : ?>
		<a href="#page" class="scroll-top-button"></a>
	<?php endif; ?>

	<?php if(!$thesod_effects_params['effects_hide_header']) : ?>

		<?php if(thesod_get_option('top_area_style') && !$thesod_header_params['header_hide_top_area'] && (thesod_get_option('header_layout') == 'vertical' && thesod_get_option('header_layout') != 'fullwidth_hamburger' || thesod_get_option('top_area_disable_fixed')) && !($thesod_header_params['header_transparent'] && $thesod_header_params['header_top_area_transparent'])) : ?>
			<?php get_template_part('top_area'); ?>
		<?php endif; ?>

		<div id="site-header-wrapper"  class="<?php  echo $thesod_header_params['header_transparent'] ? 'site-header-wrapper-transparent' : ''; ?> <?php echo thesod_get_option('sticky_header_on_mobile') ? ' sticky-header-on-mobile' : ''; ?>" >

			<?php if(thesod_get_option('header_layout') == 'fullwidth_hamburger') : ?><div class="hamburger-overlay"></div><?php endif; ?>

			<?php do_action('thesod_before_header'); ?>

			<header id="site-header" class="site-header<?php echo (thesod_get_option('disable_fixed_header') || thesod_get_option('header_layout') == 'vertical' ? '' : ' animated-header'); ?><?php echo thesod_get_option('header_on_slideshow') ? ' header-on-slideshow' : ''; ?> mobile-menu-layout-<?php echo esc_attr(thesod_get_option('mobile_menu_layout', 'default')); ?>" role="banner">
				<?php if(thesod_get_option('header_layout') == 'vertical') : ?><button class="vertical-toggle"><?php esc_html_e('Primary Menu', 'thesod'); ?><span class="menu-line-1"></span><span class="menu-line-2"></span><span class="menu-line-3"></span></button><?php endif; ?>
				<?php if(thesod_get_option('top_area_style') && !$thesod_header_params['header_hide_top_area'] && (!thesod_get_option('top_area_disable_fixed') || $thesod_header_params['header_transparent'] && $thesod_header_params['header_top_area_transparent']) && thesod_get_option('header_layout') != 'vertical' && thesod_get_option('header_layout') != 'fullwidth_hamburger') : ?>
					<?php if($thesod_header_params['header_top_area_transparent']) : ?><div class="transparent-header-background<?php echo thesod_get_option('top_area_disable_fixed') ? ' top-area-scroll-hide' : ''; ?>" style="background-color: rgba(<?php echo esc_attr(implode(', ', hex_to_rgb(thesod_get_option('top_area_background_color')))); ?>, <?php echo intval($thesod_header_params['header_top_area_opacity'])/100; ?>);"><?php endif; ?>
					<?php get_template_part('top_area'); ?>
					<?php if($thesod_header_params['header_top_area_transparent']) : ?></div><?php endif; ?>
				<?php endif; ?>

				<?php if($thesod_header_params['header_transparent']) : ?><div class="transparent-header-background" style="background-color: rgba(<?php echo esc_attr(implode(', ', hex_to_rgb(thesod_get_option('top_background_color')))); ?>, <?php echo intval($thesod_header_params['header_opacity'])/100; ?>);"><?php endif; ?>
				<div class="container<?php echo (thesod_get_option('header_layout') == 'fullwidth' || thesod_get_option('header_layout') == 'fullwidth_hamburger' || thesod_get_option('header_layout') == 'overlay' || thesod_get_option('header_layout') == 'perspective' ? ' container-fullwidth' : ''); ?>">
					<div class="header-main logo-position-<?php echo esc_attr(thesod_get_option('logo_position', 'left')); ?><?php echo ($thesod_header_params['header_menu_logo_light'] ? ' header-colors-light' : ''); ?> header-layout-<?php echo esc_attr(thesod_get_option('header_layout')); ?> header-style-<?php echo esc_attr(thesod_get_option('header_layout') == 'vertical' || thesod_get_option('header_layout') == 'fullwidth_hamburger' ? 'vertical' : thesod_get_option('header_style')); ?>">
						<?php if(thesod_get_option('logo_position', 'left') != 'right') : ?>
							<div class="site-title">
								<?php thesod_print_logo($thesod_header_light); ?>
							</div>
							<?php if(has_nav_menu('primary')) : ?>
								<?php if(thesod_get_option('header_layout') != 'perspective') : ?>
									<nav id="primary-navigation" class="site-navigation primary-navigation" role="navigation">
										<?php do_action('thesod_before_nav_menu'); ?>
										<?php wp_nav_menu(array('theme_location' => 'primary', 'menu_id' => 'primary-menu', 'menu_class' => apply_filters( 'thesod_nav_menu_class', 'nav-menu styled no-responsive' ), 'container' => false, 'walker' => new thesod_Mega_Menu_Walker)); ?>
										<?php do_action('thesod_after_nav_menu'); ?>
									</nav>
								<?php else: ?>
									<?php do_action('thesod_perspective_menu_buttons'); ?>
								<?php endif; ?>
							<?php endif; ?>
						<?php else : ?>
							<?php if(has_nav_menu('primary')) : ?>
								<?php if(thesod_get_option('header_layout') != 'perspective') : ?>
									<nav id="primary-navigation" class="site-navigation primary-navigation" role="navigation">
										<?php do_action('thesod_before_nav_menu'); ?>
										<?php wp_nav_menu(array('theme_location' => 'primary', 'menu_id' => 'primary-menu', 'menu_class' => apply_filters( 'thesod_nav_menu_class', 'nav-menu styled no-responsive' ), 'container' => false, 'walker' => new thesod_Mega_Menu_Walker)); ?>
										<?php do_action('thesod_after_nav_menu'); ?>
									</nav>
								<?php else: ?>
									<?php do_action('thesod_perspective_menu_buttons'); ?>
								<?php endif; ?>
							<?php endif; ?>
							<div class="site-title">
								<?php thesod_print_logo($thesod_header_light); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
				<?php if($thesod_header_params['header_transparent']) : ?></div><?php endif; ?>
			</header><!-- #site-header -->
			<?php if(thesod_get_option('header_layout') == 'vertical') : ?>
				<div class="vertical-menu-item-widgets">
					<?php
						add_filter( 'get_search_form', 'thesod_serch_form_vertical_header' );
						get_search_form();
						remove_filter( 'get_search_form', 'thesod_serch_form_vertical_header' );
					?>
					<div class="menu-item-socials socials-colored"><?php thesod_print_socials('rounded'); ?></div></div>
			<?php endif; ?>
		</div><!-- #site-header-wrapper -->

	<?php endif; ?>

	<div id="main" class="site-main">
