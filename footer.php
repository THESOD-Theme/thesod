<?php
/**
 * The template for displaying the footer
 */

	$id = is_singular() ? get_the_ID() : 0;
	if(is_404() && get_post(thesod_get_option('404_page'))) {
		$id = thesod_get_option('404_page');
	}
	if((is_post_type_archive('product') || is_tax('product_cat') || is_tax('product_tag')) && function_exists('wc_get_page_id')) {
		$id = wc_get_page_id('shop');
	}
	$effects_params = thesod_get_sanitize_page_effects_data($id);
	$header_params = thesod_get_sanitize_page_header_data($id);
	if(is_tax() || is_category() || is_tag()) {
		$thesod_term_id = get_queried_object()->term_id;
		$effects_params = thesod_theme_options_get_page_settings('blog');
		$header_params = thesod_theme_options_get_page_settings('blog');
		if(get_term_meta($thesod_term_id , 'thesod_taxonomy_custom_page_options', true)) {
			$effects_params = thesod_get_sanitize_page_effects_data($thesod_term_id, array(), 'term');
			$header_params = thesod_get_sanitize_page_header_data($thesod_term_id, array(), 'term');
		}
	}
	if($effects_params['effects_parallax_footer']) {
		wp_enqueue_script('thesod-parallax-footer');
	}
?>

		</div><!-- #main -->
		<div id="lazy-loading-point"></div>

		<?php if(!$effects_params['effects_page_scroller'] && !$effects_params['effects_hide_footer']) : ?>
			<?php if($effects_params['effects_parallax_footer']) : ?><div class="parallax-footer"><?php endif; ?>
			<?php
				$thesod_custom_footer = get_post(thesod_get_option('custom_footer'));
				$thesod_q = new WP_Query(array('p' => thesod_get_option('custom_footer'), 'post_type' => 'thesod_footer', 'post_status' => 'private'));
				if($header_params['footer_custom']) {
					$thesod_custom_footer = get_post($header_params['footer_custom']);
					$thesod_q = new WP_Query(array('p' => $header_params['footer_custom'], 'post_type' => 'thesod_footer', 'post_status' => 'private'));
				}
				if((thesod_get_option('custom_footer') || $header_params['footer_custom']) && $thesod_custom_footer && $thesod_q->have_posts()) : $thesod_q->the_post(); ?>
				<footer class="custom-footer"><div class="container"><?php the_content(); ?></div></footer>
			<?php wp_reset_postdata(); endif; ?>
			<?php if(is_active_sidebar('footer-widget-area') && !thesod_get_option('footer_widget_area_hide') && !$header_params['footer_hide_widget_area']) : ?>
			<footer id="colophon" class="site-footer" role="contentinfo">
				<div class="container">
					<?php get_sidebar('footer'); ?>
				</div>
			</footer><!-- #colophon -->
			<?php endif; ?>

			<?php if(thesod_get_option('footer_active') && !$header_params['footer_hide_default']) : ?>

			<footer id="footer-nav" class="site-footer">
				<div class="container"><div class="row">

					<div class="col-md-3 col-md-push-9">
						<?php
							$socials_icons = array();
							$thesod_socials_icons = thesod_socials_icons_list();
							foreach(array_keys($thesod_socials_icons) as $icon) {
								$socials_icons[$icon] = thesod_get_option($icon.'_active');
								thesod_additionals_socials_enqueue_style($icon);
							}
							if(in_array(1, $socials_icons)) : ?>
							<div id="footer-socials"><div class="socials inline-inside socials-colored<?php echo (thesod_get_option('socials_colors_footer') ? '-hover' : ''); ?>">
									<?php foreach($socials_icons as $name => $active) : ?>
										<?php if($active) : ?>
											<a href="<?php echo esc_url(thesod_get_option($name . '_link')); ?>" target="_blank" title="<?php echo esc_attr($thesod_socials_icons[$name]); ?>" class="socials-item"><i class="socials-item-icon <?php echo esc_attr($name); ?>"></i></a>
										<?php endif; ?>
									<?php endforeach; ?>
									<?php do_action('thesod_footer_socials'); ?>
							</div></div><!-- #footer-socials -->
						<?php endif; ?>
					</div>

					<div class="col-md-6">
						<?php if(has_nav_menu('footer')) : ?>
						<nav id="footer-navigation" class="site-navigation footer-navigation centered-box" role="navigation">
							<?php wp_nav_menu(array('theme_location' => 'footer', 'menu_id' => 'footer-menu', 'menu_class' => 'nav-menu styled clearfix inline-inside', 'container' => false, 'depth' => 1, 'walker' => new thesod_walker_footer_nav_menu)); ?>
						</nav>
						<?php endif; ?>
					</div>

					<div class="col-md-3 col-md-pull-9"><div class="footer-site-info"><?php echo wp_kses_post(do_shortcode(nl2br(stripslashes(thesod_get_option('footer_html'))))); ?></div></div>

				</div></div>
			</footer><!-- #footer-nav -->
			<?php endif; ?>
			<?php if($effects_params['effects_parallax_footer']) : ?></div><!-- .parallax-footer --><?php endif; ?>

		<?php endif; ?>
	</div><!-- #page -->

	<?php if(thesod_get_option('header_layout') == 'perspective') : ?>
		</div><!-- #perspective -->
	<?php endif; ?>

	<?php wp_footer(); ?>
</body>
</html>
