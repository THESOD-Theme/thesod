<?php

get_header(); ?>

<div id="main-content" class="main-content">

<?php

	$thesod_page_data = array(
		'title' => thesod_theme_options_get_page_settings('search'),
		'effects' => thesod_theme_options_get_page_settings('search'),
		'slideshow' => thesod_theme_options_get_page_settings('search'),
		'sidebar' => thesod_theme_options_get_page_settings('search'),
	);
	if($thesod_page_data['effects']['effects_page_scroller']) {
		wp_enqueue_script('thesod-page-scroller');
		$thesod_page_data['effects']['effects_no_bottom_margin'] = true;
		$thesod_page_data['effects']['effects_no_top_margin'] = true;
	}
	$thesod_no_margins_block = '';
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
	echo thesod_page_title();
?>

	<div class="block-content<?php echo esc_attr($thesod_no_margins_block); ?>">
		<div class="container">
			<div class="<?php echo esc_attr(implode(' ', $thesod_panel_classes)); ?>">
				<div class="<?php echo esc_attr($thesod_center_classes); ?>">
				<?php
					if ( have_posts() ) {

						if(!is_singular()) {
							$blog_style = '3x';
							$params = array(
								'hide_author' => false,
								'hide_date' => true,
								'hide_comments' => true,
								'hide_likes' => true
							);
							wp_enqueue_style('thesod-blog');
							wp_enqueue_style('thesod-additional-blog');
							wp_enqueue_style('thesod-animations');
							wp_enqueue_script('thesod-blog-isotope');
							echo '<div class="preloader"><div class="preloader-spin"></div></div>';
							echo '<div class="blog blog-style-3x blog-style-masonry">';
						}

						while ( have_posts() ) : the_post();

							include(locate_template(array('sod-templates/blog/content-blog-item-masonry.php', 'content-blog-item.php')));

						endwhile;

						if(!is_singular()) { echo '</div>'; thesod_pagination(); }

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
