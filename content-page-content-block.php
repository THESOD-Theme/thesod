<?php
/**
 * The template used for displaying page content on home page
 */

	$thesod_item_data = array(
		'sidebar_position' => '',
		'sidebar_sticky' => '',
	);
	$thesod_item_data = thesod_get_post_data($thesod_item_data, 'page', get_the_ID());
	$thesod_sidebar_position = thesod_check_array_value(array('', 'left', 'right'), $thesod_item_data['sidebar_position'], '');
	$thesod_sidebar_stiky = $thesod_item_data['sidebar_sticky'] ? 1 : 0;
	$thesod_panel_classes = array('panel', 'row');
	$thesod_center_classes = 'panel-center';
	$thesod_sidebar_classes = '';
	if(is_active_sidebar('page-sidebar') && $thesod_sidebar_position) {
		$thesod_panel_classes[] = 'panel-sidebar-position-'.$thesod_sidebar_position;
		$thesod_panel_classes[] = 'with-sidebar';
		$thesod_center_classes .= ' col-lg-9 col-md-9 col-sm-12';
		if($thesod_sidebar_position == 'left') {
			$thesod_center_classes .= ' col-md-push-3 col-sm-push-0';
			$thesod_sidebar_classes .= ' col-md-pull-9 col-sm-pull-0';
		}
	} else {
		$thesod_center_classes .= ' col-xs-12';
	}
	if($thesod_sidebar_stiky) {
		$thesod_panel_classes[] = 'panel-sidebar-sticky';
		wp_enqueue_script('thesod-sticky');
	}
?>

<div class="container">
	<div class="<?php echo esc_attr(implode(' ', $thesod_panel_classes)); ?>">

		<div class="<?php echo esc_attr($thesod_center_classes); ?>">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<div class="entry-content">
					<?php
						the_content();
						wp_link_pages( array(
							'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'thesod' ) . '</span>',
							'after'       => '</div>',
							'link_before' => '<span>',
							'link_after'  => '</span>',
						) );
					?>
				</div><!-- .entry-content -->

			</article><!-- #post-## -->
		</div>

			<?php
				if(is_active_sidebar('page-sidebar') && $thesod_sidebar_position) {
					echo '<div class="sidebar col-lg-3 col-md-3 col-sm-12'.esc_attr($thesod_sidebar_classes).'" role="complementary">';
					get_sidebar('page');
					echo '</div><!-- .sidebar -->';
				}
			?>

	</div>
</div>
