<?php

global $post, $product, $woocommerce_loop;

$params = $GLOBALS['thesod_slider_params'];

$thesod_classes = array('portfolio-item', 'inline-column', 'product');

$gap_size = round(intval($params['gaps_size'])/2);

$thesod_image_classes = array('image');
$thesod_caption_classes = array('caption');

$thesod_sizes = thesod_image_sizes();

if ($params['layout'] == '3x') {
	$thesod_classes = array_merge($thesod_classes, array('col-md-4', 'col-xs-6'));
}

if ($params['layout'] == '2x') {
	$thesod_classes = array_merge($thesod_classes, array('col-md-6', 'col-xs-6'));
}

if ($params['fullwidth_columns'] == '3') {
	$thesod_size = 'thesod-portfolio-carusel-full-3x';
}
if ($params['fullwidth_columns'] == '4') {
	$thesod_size = 'thesod-portfolio-carusel-4x';
}
if ($params['fullwidth_columns'] == '5') {
	$thesod_size = 'thesod-portfolio-carusel-5x';
}
if ($params['fullwidth_columns'] == '6') {
	$thesod_size = 'thesod-portfolio-carusel-5x';
}
if ($params['layout'] == '2x') {
	$thesod_size = 'thesod-portfolio-carusel-2x';
}
if ($params['layout'] == '3x') {
	$thesod_size = 'thesod-portfolio-carusel-3x';
}

if ($params['style'] == 'masonry') {
	$thesod_size .= '-masonry';
}

if ($params['effects_enabled'])
	$thesod_classes[] = 'lazy-loading-item';

$product_hover_image_id = 0;
if ($params['display_titles'] == 'page' && $params['hover'] != 'gradient' && $params['hover'] != 'circular') {
	$gallery = $product->get_gallery_image_ids();
	$has_product_hover = get_post_meta($post->ID, 'thesod_product_disable_hover', true);
	if (isset($gallery[0]) && !$has_product_hover) {
		$product_hover_image_id = $gallery[0];
		$thesod_classes[] = 'image-hover';
	}
}

$rating_count = $product->get_rating_count();
if ($rating_count > 0) {
	$thesod_classes[] = 'has-rating';
}

$product_short_description = $product->get_short_description();
$product_short_description = strip_shortcodes($product_short_description);
$product_short_description = wp_strip_all_tags($product_short_description);
$product_short_description_length = apply_filters( 'excerpt_length', 20 );
$product_short_description_more = apply_filters( 'excerpt_more', ' ' . '[&hellip;]' );
$product_short_description = wp_trim_words($product_short_description, $product_short_description_length, $product_short_description_more);

?>


<div style="padding: <?php echo intval($gap_size); ?>px;" <?php post_class($thesod_classes); ?> <?php if($params['effects_enabled']): ?>data-ll-effect="move-up"<?php endif; ?> data-sort-date="<?php echo get_the_date('U'); ?>">
	<div class="item-separator-box"></div>
	<div class="wrap clearfix">
		<div <?php post_class($thesod_image_classes); ?>>
			<div class="image-inner">
				<?php if (has_post_thumbnail()): ?>
					<?php
						$thesod_sources = array();
						$picture_info = thesod_generate_picture(get_post_thumbnail_id(), $thesod_size, $thesod_sources, array('alt' => get_the_title()), true);
						if ($picture_info && !empty($picture_info['default']) && !empty($picture_info['default'][0]) && $product_hover_image_id) {
							$thesod_hover_size = $thesod_size;
							if ($params['style'] == 'masonry') {
								$thesod_hover_size = $thesod_size . '-' . $picture_info['default'][1] . '-' . $picture_info['default'][2];
								add_filter('thesod_image_sizes', create_function('$sizes', '$size=$sizes["' . $thesod_size . '"]; $size[1]=' . $picture_info['default'][2] . '; $size[2]=true; $sizes["' . $thesod_hover_size . '"]=$size; return $sizes;'));
								$thesod_sources = array();
							}
							thesod_generate_picture($product_hover_image_id, $thesod_hover_size, $thesod_sources, array(
								'alt' => get_the_title(),
								'class' => 'image-hover'
							));
						}
					?>
				<?php endif; ?>
			</div>
			<div class="overlay">
				<div class="overlay-circle"></div>
				<div class="links-wrapper">
					<div class="links">
						<div class="portfolio-icons product-bottom">
							<div class="portfolio-icons-inner clearfix">
								<?php do_action('woocommerce_after_shop_loop_item'); ?>
								<?php if(!$params['disable_socials']): ?>
									<a href="javascript: void(0);" class="icon share"></a>
								<?php endif; ?>
							</div>

							<div class="overlay-line"></div>
							<?php if(!$params['disable_socials']): ?>
								<div class="portfolio-sharing-pane"><?php thesod_socials_sharing(); ?></div>
							<?php endif; ?>
						</div>
						<?php if( ($params['display_titles'] == 'hover' && $params['layout'] != '1x') || $params['hover'] == 'gradient' || $params['hover'] == 'circular'): ?>
							<div class="caption">
								<div class="title title-h4">
									<?php if($params['hover'] != 'default' && $params['hover'] != 'gradient' && $params['hover'] != 'circular') { echo '<span class="light">'; } ?>
									<?php the_title(); ?>
									<?php if($params['hover'] != 'default') { echo '</span>'; } ?>
								</div>
								<div class="description">
									<?php if($product_short_description) : ?><div class="subtitle"><?php echo $product_short_description; ?></div><?php endif; ?>
								</div>
								<div class="product-info clearfix">
									<?php do_action('woocommerce_after_shop_loop_item_title'); ?>
									<?php do_action('woocommerce_before_shop_loop_item_title'); ?>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>
				<?php if($params['display_titles'] == 'page' && $params['hover'] != 'gradient' && $params['hover'] != 'circular'): ?>
					<a href="<?php echo get_permalink(); ?>"></a>
				<?php endif; ?>
			</div>
		</div>
		<?php if( ($params['display_titles'] == 'page' || $params['layout'] == '1x') && $params['hover'] != 'gradient' && $params['hover'] != 'circular'): ?>
			<div <?php post_class($thesod_caption_classes); ?>>
				<div class="product-info clearfix">
					<?php do_action('woocommerce_before_shop_loop_item_title'); ?>
					<div class="title"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></div>
					<?php do_action('woocommerce_after_shop_loop_item_title'); ?>
				</div>
				<div class="product-bottom clearfix">
					<?php do_action('woocommerce_after_shop_loop_item'); ?>
					<?php if(!$params['disable_socials']): ?>
						<div class="post-footer-sharing"><?php thesod_button(array('corner' => 0, 'icon' => 'share', 'size' => 'tiny', 'background_color' => 'transparent', 'extra_class' => 'bottom-product-link'), 1); ?><div class="sharing-popup"><?php thesod_socials_sharing(); ?><svg class="sharing-styled-arrow"><use xlink:href="<?php echo esc_url(get_template_directory_uri() . '/css/post-arrow.svg'); ?>#dec-post-arrow"></use></svg></div></div>
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>
		<div class="product-labels"><?php do_action('woocommerce_shop_loop_item_labels'); ?></div>
	</div>
</div>
