<?php

get_header();

$thesod_panel_classes = array('panel', 'row');

if(is_active_sidebar('page-sidebar')) {
	$thesod_panel_classes[] = 'panel-sidebar-position-right';
	$thesod_panel_classes[] = 'with-sidebar';
	$thesod_center_classes = 'col-lg-9 col-md-9 col-sm-12';
} else {
	$thesod_center_classes = 'col-xs-12';
}

?>

<div id="main-content" class="main-content">

<?php

if(thesod_get_option('home_content_enabled')) :

	thesod_home_content_builder();

else :

	wp_enqueue_style('thesod-blog');
	wp_enqueue_style('thesod-additional-blog');
	wp_enqueue_style('thesod-blog-timeline-new');
	wp_enqueue_script('thesod-scroll-monitor');
	wp_enqueue_script('thesod-items-animations');
	wp_enqueue_script('thesod-blog');
	wp_enqueue_script('thesod-gallery');

?>

	<div class="block-content">
		<div class="container">
			<div class="<?php echo esc_attr(implode(' ', $thesod_panel_classes)); ?>">
				<div class="<?php echo esc_attr($thesod_center_classes); ?>">
				<?php
					if ( have_posts() ) {

						if(!is_singular()) { echo '<div class="blog blog-style-default item-animation-disabled">'; }

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
					if(is_active_sidebar('page-sidebar')) {
						echo '<div class="sidebar col-lg-3 col-md-3 col-sm-12" role="complementary">';
						get_sidebar('page');
						echo '</div><!-- .sidebar -->';
					}
				?>
			</div>
		</div><!-- .container -->
	</div><!-- .block-content -->

<?php endif; ?>

</div><!-- #main-content -->

<?php

get_footer();
