<?php

global $post, $product, $woocommerce_loop;

if (!isset($product_grid_item_size)) {
	$params = $GLOBALS['thesod_grid_params'];
}

if (!isset($product_grid_item_size)) {
	$thesod_product_featured_data = get_post_meta(get_the_ID(), 'thesod_product_featured_data', 1);

	if (empty($params['ignore_highlights']) && !empty($thesod_product_featured_data['highlight_type'])) {
		$thesod_highlight_type = $thesod_product_featured_data['highlight_type'];
	} else {
		$thesod_highlight_type = 'disabled';
	}

	$terms = get_the_terms($post->ID, 'product_cat');
	$slugs = array();
	foreach ($terms as $term) {
		$slugs[] = $term->slug;
	}
} else {
	$slugs = array();
	$thesod_highlight_type = 'disabled';
}

$thesod_classes = array('portfolio-item', 'inline-column', 'product');
$thesod_classes = array_merge($thesod_classes, $slugs);

$thesod_image_classes = array('image');
$thesod_caption_classes = array('caption');

if ($params['style'] != 'metro') {
	if ($params['layout'] == '1x') {
		$thesod_classes = array_merge($thesod_classes, array('col-xs-12'));
		$thesod_image_classes = array_merge($thesod_image_classes, array('col-sm-5', 'col-xs-12'));
		$thesod_caption_classes = array_merge($thesod_caption_classes, array('col-sm-7', 'col-xs-12'));
	}

	if ($params['layout'] == '2x') {
		if ($thesod_highlight_type != 'disabled' && empty($params['is_slider']) && $thesod_highlight_type != 'vertical')
			$thesod_classes = array_merge($thesod_classes, array('col-xs-12'));
		else
			$thesod_classes = array_merge($thesod_classes, array('col-sm-6', 'col-xs-12'));
	}

	if ($params['layout'] == '3x') {
		if ($thesod_highlight_type != 'disabled' && empty($params['is_slider']) && $thesod_highlight_type != 'vertical')
			$thesod_classes = array_merge($thesod_classes, array('col-md-8', 'col-xs-8'));
		else
			$thesod_classes = array_merge($thesod_classes, array('col-md-4', 'col-xs-4'));
	}

	if ($params['layout'] == '4x') {
		if ($thesod_highlight_type != 'disabled' && empty($params['is_slider']) && $thesod_highlight_type != 'vertical')
			$thesod_classes = array_merge($thesod_classes, array('col-md-6', 'col-sm-8', 'col-xs-8'));
		else
			$thesod_classes = array_merge($thesod_classes, array('col-md-3', 'col-sm-4', 'col-xs-4'));
	}
}

if ($thesod_highlight_type != 'disabled' && empty($params['is_slider'])) {
	$thesod_classes[] = 'double-item';
}

if ($thesod_highlight_type != 'disabled' && empty($params['is_slider'])) {
	$thesod_classes[] = 'double-item-' . $thesod_highlight_type;
}

$thesod_size = 'thesod-portfolio-justified';
$thesod_sizes = thesod_image_sizes();
if ($params['layout'] != '1x') {
	if ($params['style'] == 'masonry') {
		$thesod_size = 'thesod-portfolio-masonry';
		if ($thesod_highlight_type != 'disabled' && empty($params['is_slider'])) {
			$thesod_size = 'thesod-portfolio-masonry-double';
		}
	} elseif ($params['style'] == 'metro') {
		$thesod_size = 'thesod-portfolio-metro';
	} else {
		if ($thesod_highlight_type != 'disabled' && empty($params['is_slider'])) {
			$thesod_size = 'thesod-portfolio-double-' . str_replace('%', '',$params['layout']);

			if ( ($params['display_titles'] == 'hover' || $params['hover'] == 'gradient' || $params['hover'] == 'circular') && isset($thesod_sizes[$thesod_size.'-hover'])) {
				$thesod_size .= '-hover';
			}

			if(isset($thesod_sizes[$thesod_size.'-gap-'.$params['gaps_size']])) {
				$thesod_size .= '-gap-'.$params['gaps_size'];
			}

			if ($params['layout'] == '100%' && $params['display_titles'] == 'page') {
				$thesod_size .= '-page';
			}

		}
	}
	if ($thesod_highlight_type != 'disabled' && $params['style'] != 'metro' && empty($params['is_slider']) && $thesod_highlight_type != 'squared') {
		$thesod_size .= '-' . $thesod_highlight_type;
	}
} else {
	$thesod_size = 'thesod-portfolio-1x';
}

$thesod_classes[] = 'item-animations-not-inited';

$thesod_size = apply_filters('portfolio_size_filter', $thesod_size);

$thesod_sources = array();

if ($params['style'] == 'metro') {
	$thesod_sources = array(
		array('media' => '(min-width: 550px) and (max-width: 1100px)', 'srcset' => array('1x' => 'thesod-portfolio-metro-medium', '2x' => 'thesod-portfolio-metro-retina'))
	);
}

if ($thesod_highlight_type == 'disabled' || !empty($params['is_slider']) ||
		($params['style'] == 'masonry' && $thesod_highlight_type != 'disabled') && $thesod_highlight_type == 'vertical') {

	$retina_size = $params['style'] == 'justified' ? $thesod_size : 'thesod-portfolio-masonry-double';

	if ($params['layout'] == '100%') {
		if ($params['style'] == 'justified' || $params['style'] == 'masonry') {
			switch ($params['fullwidth_columns']) {
				case '4':
					$thesod_sources = array(
						array('media' => '(max-width: 550px)', 'srcset' => array('1x' => 'thesod-portfolio-' . $params['style'] . '-2x-500', '2x' => $retina_size)),
						array('media' => '(min-width: 1280px) and (max-width: 1495px)', 'srcset' => array('1x' => 'thesod-portfolio-' . $params['style'] . '-fullwidth-5x', '2x' => $retina_size)),
						array('media' => '(max-width: 1920px)', 'srcset' => array('1x' => 'thesod-portfolio-' . $params['style'] . '-fullwidth-4x', '2x' => $retina_size))
					);
					break;

				case '5':
					$thesod_sources = array(
						array('media' => '(max-width: 550px)', 'srcset' => array('1x' => 'thesod-portfolio-' . $params['style'] . '-2x-500', '2x' => $retina_size)),
						array('media' => '(min-width: 1495px) and (max-width: 1680px), (min-width: 550px) and (max-width: 1280px)', 'srcset' => array('1x' => 'thesod-portfolio-' . $params['style'] . '-fullwidth-4x', '2x' => $retina_size)),
						array('media' => '(min-width: 1680px) and (max-width: 1920px), (min-width: 1280px) and (max-width: 1495px)', 'srcset' => array('1x' => 'thesod-portfolio-' . $params['style'] . '-fullwidth-5x', '2x' => $retina_size))
					);
					break;

				case '6':
					$thesod_sources = array(
						array('media' => '(max-width: 550px)', 'srcset' => array('1x' => 'thesod-portfolio-' . $params['style'] . '-2x-500', '2x' => $retina_size)),
						array('media' => '(min-width: 1495px) and (max-width: 1680px), (min-width: 550px) and (max-width: 1280px)', 'srcset' => array('1x' => 'thesod-portfolio-' . $params['style'] . '-fullwidth-4x', '2x' => $retina_size)),
						array('media' => '(min-width: 1680px) and (max-width: 1920px), (min-width: 1280px) and (max-width: 1495px)', 'srcset' => array('1x' => 'thesod-portfolio-' . $params['style'] . '-fullwidth-5x', '2x' => $retina_size))
					);
					break;
			}
		}
	} else {
		if ($params['style'] == 'justified' || $params['style'] == 'masonry') {
			switch ($params['layout']) {
				case '2x':
					$thesod_sources = array(
						array('media' => '(max-width: 550px)', 'srcset' => array('1x' => 'thesod-portfolio-' . $params['style'] . '-2x-500', '2x' => $retina_size)),
						array('media' => '(max-width: 1920px)', 'srcset' => array('1x' => 'thesod-portfolio-' . $params['style'] . '-2x', '2x' => $retina_size))
					);
					break;

				case '3x':
					$thesod_sources = array(
						array('media' => '(max-width: 550px)', 'srcset' => array('1x' => 'thesod-portfolio-' . $params['style'] . '-2x-500', '2x' => $retina_size)),
						array('media' => '(max-width: 1920px)', 'srcset' => array('1x' => 'thesod-portfolio-' . $params['style'] . '-3x', '2x' => $retina_size))
					);
					break;

				case '4x':
					$thesod_sources = array(
						array('media' => '(max-width: 550px)', 'srcset' => array('1x' => 'thesod-portfolio-' . $params['style'] . '-2x-500', '2x' => $retina_size)),
						array('media' => '(max-width: 1100px)', 'srcset' => array('1x' => 'thesod-portfolio-' . $params['style'] . '-3x', '2x' => $retina_size)),
						array('media' => '(max-width: 1920px)', 'srcset' => array('1x' => 'thesod-portfolio-' . $params['style'] . '-4x', '2x' => $retina_size))
					);
					break;
			}
		}
	}
}

if ($params['layout'] != '1x' && $thesod_highlight_type == 'horizontal') {
	$thesod_sources = array(
		array('media' => '(max-width: 550px)', 'srcset' => array('1x' => 'thesod-portfolio-' . $params['style'] . '-2x-500', '2x' => 'thesod-portfolio-' . $params['style']))
	);
}

$gap_size = round(intval($params['gaps_size'])/2);

if (!isset($product_grid_item_size)) {
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
}

?>

<?php if (!isset($product_grid_item_size)): ?>
	<div <?php post_class($thesod_classes); ?> style="padding: <?php echo intval($gap_size); ?>px;" data-default-sort="<?php echo intval(get_post()->menu_order); ?>" data-sort-date="<?php echo get_the_date('U'); ?>">
		<div class="item-separator-box"></div>
		<div class="wrap clearfix">
			<div <?php post_class($thesod_image_classes); ?>>
				<div class="image-inner">
					<?php if (has_post_thumbnail()): ?>
						<?php
							$picture_info = thesod_generate_picture(get_post_thumbnail_id(), $thesod_size, $thesod_sources, array('alt' => get_the_title()), true);
							if ($picture_info && !empty($picture_info['default']) && !empty($picture_info['default'][0]) && $product_hover_image_id) {
								$thesod_hover_size = $thesod_size;
								if ($params['style'] == 'masonry') {
									$thesod_hover_size = $thesod_size . '-' . $picture_info['default'][1] . '-' . $picture_info['default'][2];
									global $thesod_size_template_global, $picture_info_template_global, $thesod_hover_size_template_global;
									$thesod_size_template_global = $thesod_size;
									$picture_info_template_global = $picture_info;
									$thesod_hover_size_template_global = $thesod_hover_size;
									add_filter('thesod_image_sizes', function($sizes) {global $thesod_size_template_global, $picture_info_template_global, $thesod_hover_size_template_global; $size=$sizes[$thesod_size_template_global]; $size[1]=$picture_info_template_global['default'][2]; $size[2]=true; $sizes[$thesod_hover_size_template_global]=$size; return $sizes; });
									$thesod_sources = array();
								}
								if ($params['style'] == 'metro') {
									$thesod_hover_size = $thesod_size . '-' . $picture_info['default'][1] . '-' . $picture_info['default'][2];
									global $thesod_size_template_global, $picture_info_template_global, $thesod_hover_size_template_global;
									$thesod_size_template_global = $thesod_size;
									$picture_info_template_global = $picture_info;
									$thesod_hover_size_template_global = $thesod_hover_size;
									add_filter('thesod_image_sizes', function($sizes) {global $thesod_size_template_global, $picture_info_template_global, $thesod_hover_size_template_global; $size=$sizes[$thesod_size_template_global]; $size[0]=$picture_info_template_global['default'][1]; $size[2]=true; $sizes[$thesod_hover_size_template_global]=$size; return $sizes; });
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
<?php else: ?>
	<div <?php post_class($thesod_classes); ?>>
	</div>
<?php endif; ?>
