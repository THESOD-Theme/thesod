<?php

global $post, $product, $woocommerce_loop;

$params = $GLOBALS['thesod_grid_params'];

$terms = get_the_terms($post->ID, 'product_cat');
$slugs = array();
foreach ($terms as $term) {
	$slugs[] = $term->slug;
}

$thesod_classes = array('portfolio-item', 'inline-column', 'product', 'portfolio-1x-' . $params['layout_version'] . '-item');
$thesod_classes = array_merge($thesod_classes, $slugs);

$thesod_image_classes = array('image');
$thesod_caption_classes = array('caption');

if($params['caption_position'] == 'zigzag') {
	$thesod_caption_position = 'right';
} else {
	$thesod_caption_position = $params['caption_position'];
}

$thesod_classes = array_merge($thesod_classes, array('col-xs-12'));

if($params['display_titles'] == 'page' && $params['hover'] != 'gradient' && $params['hover'] != 'circular') {
	if($params['layout_version'] == 'fullwidth') {
		$thesod_image_classes = array_merge($thesod_image_classes, array('col-md-8', 'col-xs-12'));
		$thesod_caption_classes = array_merge($thesod_caption_classes, array('col-md-4', 'col-xs-12'));
		if($thesod_caption_position == 'left') {
			$thesod_image_classes = array_merge($thesod_image_classes, array('col-md-push-4'));
			$thesod_caption_classes = array_merge($thesod_caption_classes, array('col-md-pull-8'));
		}
	} else {
		$thesod_image_classes = array_merge($thesod_image_classes, array('col-md-7', 'col-xs-12'));
		$thesod_caption_classes = array_merge($thesod_caption_classes, array('col-md-5', 'col-xs-12'));
		if($thesod_caption_position == 'left') {
			$thesod_image_classes = array_merge($thesod_image_classes, array('col-md-push-5'));
			$thesod_caption_classes = array_merge($thesod_caption_classes, array('col-md-pull-7'));
		}
	}
}

$thesod_size = 'thesod-portfolio-1x';
if($params['display_titles'] == 'hover' || $params['hover'] == 'gradient' || $params['hover'] == 'circular') {
	$thesod_size .= '-hover';
} else {
	$thesod_size .= $params['layout_version'] == 'sidebar' ? '-sidebar' : '';
}

$thesod_bottom_line = false;
if(!$params['disable_socials']) {
	$thesod_bottom_line = true;
}

$thesod_classes[] = 'item-animations-not-inited';

$gap_size = round(intval($params['gaps_size'])/2);

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

<div <?php post_class($thesod_classes); ?> style="padding: <?php echo intval($gap_size); ?>px;" data-sort-date="<?php echo get_the_date('U'); ?>">
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
						<?php if($params['display_titles'] == 'hover' || $params['hover'] == 'gradient' || $params['hover'] == 'circular'): ?>
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
		<?php if($params['display_titles'] == 'page' && $params['hover'] != 'gradient' && $params['hover'] != 'circular'): ?>
			<div <?php post_class($thesod_caption_classes); ?>>
				<div class="caption-sizable-content<?php echo ($thesod_bottom_line ? ' with-bottom-line' : ''); ?>">
					<div class="title title-h3">
						<a href="<?php echo get_permalink(); ?>"><span class="light"><?php the_title(); ?></span></a>
					</div>
					<div class="product-info clearfix">
						<?php do_action('woocommerce_before_shop_loop_item_title'); ?>
						<?php do_action('woocommerce_after_shop_loop_item_title'); ?>
					</div>
					<?php if($product_short_description) : ?><div class="subtitle"><?php echo $product_short_description; ?></div><?php endif; ?>
				</div>
				<div class="caption-bottom-line">
					<div class="product-bottom">
						<?php do_action('woocommerce_after_shop_loop_item'); ?>
						<?php if(!$params['disable_socials']): ?>
							<div class="post-footer-sharing"><?php thesod_button(array('corner' => 0, 'icon' => 'share', 'size' => 'tiny', 'background_color' => 'transparent', 'extra_class' => 'bottom-product-link'), 1); ?><div class="sharing-popup"><?php thesod_socials_sharing(); ?><svg class="sharing-styled-arrow"><use xlink:href="<?php echo esc_url(get_template_directory_uri() . '/css/post-arrow.svg'); ?>#dec-post-arrow"></use></svg></div></div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php endif; ?>
		<div class="product-labels"><?php do_action('woocommerce_shop_loop_item_labels'); ?></div>
	</div>
</div>
