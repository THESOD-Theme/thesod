<?php
$thesod_panel_classes = array('panel', 'row');

if(is_active_sidebar('page-sidebar')) {
	$thesod_panel_classes[] = 'panel-sidebar-position-right';
	$thesod_panel_classes[] = 'with-sidebar';
	$thesod_center_classes = 'col-lg-9 col-md-9 col-sm-12';
} else {
	$thesod_center_classes = 'col-xs-12';
}

get_header(); ?>

<div id="main-content" class="main-content">

<?php
	$thesod_no_margins_block = '';
	if(is_tax() || is_category() || is_tag() || is_archive()) {
		$thesod_term_id = get_queried_object() ? get_queried_object()->term_id : 0;
		$thesod_page_data = array(
			'title' => thesod_theme_options_get_page_settings('blog'),
			'effects' => thesod_theme_options_get_page_settings('blog'),
			'slideshow' => thesod_theme_options_get_page_settings('blog'),
			'sidebar' => thesod_theme_options_get_page_settings('blog')
		);
		if(get_term_meta($thesod_term_id , 'thesod_taxonomy_custom_page_options', true)) {
			$thesod_page_data = array(
				'title' => thesod_get_sanitize_page_title_data($thesod_term_id, array(), 'term'),
				'effects' => thesod_get_sanitize_page_effects_data($thesod_term_id, array(), 'term'),
				'slideshow' => thesod_get_sanitize_page_slideshow_data($thesod_term_id, array(), 'term'),
				'sidebar' => thesod_get_sanitize_page_sidebar_data($thesod_term_id, array(), 'term')
			);
		}

		if($thesod_page_data['effects']['effects_no_bottom_margin']) {
			$thesod_no_margins_block .= ' no-bottom-margin';
		}
		if($thesod_page_data['effects']['effects_no_top_margin']) {
			$thesod_no_margins_block .= ' no-top-margin';
		}

		$thesod_panel_classes = array('panel', 'row');
		$thesod_center_classes = 'panel-center';
		$thesod_sidebar_classes = '';

		if(is_active_sidebar('page-sidebar') && $thesod_page_data['sidebar']['sidebar_position']) {
			$thesod_panel_classes[] = 'panel-sidebar-position-'.$thesod_page_data['sidebar']['sidebar_position'];
			$thesod_panel_classes[] = 'with-sidebar';
			$thesod_center_classes .= ' col-lg-9 col-md-9 col-sm-12';
			if($thesod_page_data['sidebar']['sidebar_position'] == 'left') {
				$thesod_center_classes .= ' col-md-push-3 col-sm-push-0';
				$thesod_sidebar_classes .= ' col-md-pull-9 col-sm-pull-0';
			}
		} else {
			$thesod_center_classes .= ' col-xs-12';
		}
		if($thesod_page_data['sidebar']['sidebar_sticky']) {
			$thesod_panel_classes[] = 'panel-sidebar-sticky';
			wp_enqueue_script('thesod-sticky');
		}
		if($thesod_page_data['slideshow']['slideshow_type']) {
			thesod_slideshow_block(array('slideshow_type' => $thesod_page_data['slideshow']['slideshow_type'], 'slideshow' => $thesod_page_data['slideshow']['slideshow_slideshow'], 'lslider' => $thesod_page_data['slideshow']['slideshow_layerslider'], 'slider' => $thesod_page_data['slideshow']['slideshow_revslider']));
		}
	}
	echo thesod_page_title();
?>

	<div class="block-content<?php echo esc_attr($thesod_no_margins_block); ?>">
		<div class="container">
			<div class="<?php echo esc_attr(implode(' ', $thesod_panel_classes)); ?>">
				<div class="<?php echo esc_attr($thesod_center_classes); ?>">
				<?php
					if ( have_posts() ) {

						if(!is_singular()) {
							wp_enqueue_style('thesod-blog');
							wp_enqueue_style('thesod-additional-blog');
							wp_enqueue_style('thesod-blog-timeline-new');
							wp_enqueue_script('thesod-scroll-monitor');
							wp_enqueue_script('thesod-items-animations');
							wp_enqueue_script('thesod-blog');
							wp_enqueue_script('thesod-gallery');
							echo '<div class="blog blog-style-default">';
						}

						while ( have_posts() ) : the_post();

							get_template_part( 'content', 'blog-item' );

						endwhile;

						if(!is_singular()) { thesod_pagination(); echo '</div>'; }

					} else {
						get_template_part( 'content', 'none' );
					}
				?>
				</div>
				<?php
					if(is_active_sidebar('page-sidebar') && !empty($thesod_page_data['sidebar']['sidebar_position'])) {
						echo '<div class="sidebar col-lg-3 col-md-3 col-sm-12'.esc_attr($thesod_sidebar_classes).'" role="complementary">';
						get_sidebar('page');
						echo '</div><!-- .sidebar -->';
					}
				?>
			</div>
		</div><!-- .container -->
	</div><!-- .block-content -->
</div><!-- #main-content -->

<?php
get_footer();
