<?php
/**
 * Template Name: Woocommerce
 * The Woocommerce template file
 * @package thesod
 */

	if (isset($_GET['thesod_products_ajax'])) {
		remove_all_actions('woocommerce_before_shop_loop');
		remove_all_actions('woocommerce_after_shop_loop');
		remove_all_actions('woocommerce_archive_description');

		echo '<div data-paged="' . get_query_var( 'paged' ) . '">';
		woocommerce_content();
		echo '</div>';
		exit;
	}

	$thesod_item_data = array(
		'sidebar_position' => '',
		'sidebar_sticky' => '',
		'effects_no_bottom_margin' => 0,
		'effects_no_top_margin' => 0,
		'slideshow_type' => '',
		'slideshow_slideshow' => '',
		'slideshow_layerslider' => '',
		'slideshow_revslider' => '',
	);
	$thesod_page_id = wc_get_page_id('shop');
	if(is_product()) {
		$thesod_page_id = get_the_ID();
	}
	$thesod_item_data = thesod_get_post_data($thesod_item_data, 'page', $thesod_page_id);

	if(is_tax()) {
		$thesod_term_id = get_queried_object()->term_id;
		if(get_term_meta($thesod_term_id , 'thesod_taxonomy_custom_page_options', true)) {
			$thesod_item_data = thesod_get_post_data($thesod_item_data, 'page', $thesod_term_id, 'term');
		}
	}

	$thesod_no_margins_block = '';
	if($thesod_item_data['effects_no_bottom_margin']) {
		$thesod_no_margins_block .= ' no-bottom-margin';
	}
	if($thesod_item_data['effects_no_top_margin']) {
		$thesod_no_margins_block .= ' no-top-margin';
	}

	$thesod_sidebar_stiky = $thesod_item_data['sidebar_sticky'] ? 1 : 0;
	$thesod_sidebar_position = thesod_check_array_value(array('', 'left', 'right'), $thesod_item_data['sidebar_position'], '');
	$thesod_panel_classes = array('panel', 'row');
	$thesod_center_classes = 'panel-center';
	$thesod_sidebar_classes = '';

	if(is_active_sidebar('shop-sidebar') && $thesod_sidebar_position) {
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

	get_header();

	if($thesod_sidebar_stiky) {
		$thesod_panel_classes[] = 'panel-sidebar-sticky';
		wp_enqueue_script('thesod-sticky');
	}

?>

<div id="main-content" class="main-content">

<?php
	if($thesod_item_data['slideshow_type'] && !is_search()) {
		thesod_slideshow_block(array('slideshow_type' => $thesod_item_data['slideshow_type'], 'slideshow' => $thesod_item_data['slideshow_slideshow'], 'lslider' => $thesod_item_data['slideshow_layerslider'], 'slider' => $thesod_item_data['slideshow_revslider']));
	}
?>

<?php echo thesod_page_title(); ?>
	<div class="block-content<?php echo esc_attr($thesod_no_margins_block); ?>">
		<div class="container">
			<div class="<?php echo esc_attr(implode(' ', $thesod_panel_classes)); ?>">
				<div class="<?php echo esc_attr($thesod_center_classes); ?>">
					<?php woocommerce_content(); ?>
				</div>

				<?php
					if(is_active_sidebar('shop-sidebar') && $thesod_sidebar_position) {
						echo '<div class="sidebar col-lg-3 col-md-3 col-sm-12'.esc_attr($thesod_sidebar_classes).' '.esc_attr($thesod_sidebar_position).'" role="complementary">';
						get_sidebar('shop');
						echo '</div><!-- .sidebar -->';
					}
				?>
			</div>
			<?php if(is_product()) {
				do_action('thesod_woocommerce_after_single_product');
			} ?>
		</div>
	</div>
	<?php get_sidebar('shop-bottom'); ?>
</div><!-- #main-content -->

<?php
get_footer();
