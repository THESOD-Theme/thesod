<?php

$thesod_classes = array('portfolio-item');
$thesod_classes = array_merge($thesod_classes, $slugs);

$thesod_image_classes = array('image');
$thesod_caption_classes = array('caption');

if (!isset($portfolio_item_size)) {
	$thesod_portfolio_item_data = get_post_meta(get_the_ID(), 'thesod_portfolio_item_data', 1);
} else {
	$thesod_portfolio_item_data = array();
}

if (!empty($thesod_portfolio_item_data['highlight_type'])) {
	$thesod_highlight_type = $thesod_portfolio_item_data['highlight_type'];
} else {
	$thesod_highlight_type = 'squared';
}

if (empty($thesod_portfolio_item_data['types']))
	$thesod_portfolio_item_data['types'] = array();

if (class_exists('thesodGdpr')) {
	$thesod_portfolio_item_data['types'] = thesodGdpr::getInstance()->disallowed_portfolio_type_video($thesod_portfolio_item_data['types']);
}

if ($params['style'] != 'metro') {
	if ($params['layout'] == '1x') {
		$thesod_classes = array_merge($thesod_classes, array('col-xs-12'));
		$thesod_image_classes = array_merge($thesod_image_classes, array('col-sm-5', 'col-xs-12'));
		$thesod_caption_classes = array_merge($thesod_caption_classes, array('col-sm-7', 'col-xs-12'));
	}

	if ($params['layout'] == '2x') {
		if (isset($thesod_portfolio_item_data['highlight']) && $thesod_portfolio_item_data['highlight'] && empty($params['is_slider']) && $thesod_highlight_type != 'vertical')
			$thesod_classes = array_merge($thesod_classes, array('col-xs-12'));
		else
			$thesod_classes = array_merge($thesod_classes, array('col-sm-6', 'col-xs-12'));
	}

	if ($params['layout'] == '3x') {
		if (isset($thesod_portfolio_item_data['highlight']) && $thesod_portfolio_item_data['highlight'] && empty($params['is_slider']) && $thesod_highlight_type != 'vertical')
			$thesod_classes = array_merge($thesod_classes, array('col-md-8', 'col-xs-8'));
		else
			$thesod_classes = array_merge($thesod_classes, array('col-md-4', 'col-xs-4'));
	}

	if ($params['layout'] == '4x') {
		if (isset($thesod_portfolio_item_data['highlight']) && $thesod_portfolio_item_data['highlight'] && empty($params['is_slider']) && $thesod_highlight_type != 'vertical')
			$thesod_classes = array_merge($thesod_classes, array('col-md-6', 'col-sm-8', 'col-xs-8'));
		else
			$thesod_classes = array_merge($thesod_classes, array('col-md-3', 'col-sm-4', 'col-xs-4'));
	}
}

if (isset($thesod_portfolio_item_data['highlight']) && $thesod_portfolio_item_data['highlight'] && empty($params['is_slider']))
	$thesod_classes[] = 'double-item';

if (isset($thesod_portfolio_item_data['highlight']) && $thesod_portfolio_item_data['highlight'] && empty($params['is_slider'])) {
	$thesod_classes[] = 'double-item-' . $thesod_highlight_type;
}

$thesod_size = 'thesod-portfolio-justified';
$thesod_sizes = thesod_image_sizes();
if ($params['layout'] != '1x') {
	if ($params['style'] == 'masonry') {
		$thesod_size = 'thesod-portfolio-masonry';
		if (isset($thesod_portfolio_item_data['highlight']) && $thesod_portfolio_item_data['highlight'] && empty($params['is_slider']))
			$thesod_size = 'thesod-portfolio-masonry-double';
	} elseif ($params['style'] == 'metro') {
		$thesod_size = 'thesod-portfolio-metro';
	} else {
		if (isset($thesod_portfolio_item_data['highlight']) && $thesod_portfolio_item_data['highlight'] && empty($params['is_slider'])) {
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

	if (isset($thesod_portfolio_item_data['highlight']) && $thesod_portfolio_item_data['highlight'] && $params['style'] != 'metro' && empty($params['is_slider']) && $thesod_highlight_type != 'squared') {
		$thesod_size .= '-' . $thesod_highlight_type;
	}
} else {
	$thesod_size = 'thesod-portfolio-1x';
}

$thesod_classes[] = 'item-animations-not-inited';

$thesod_size = apply_filters('portfolio_size_filter', $thesod_size);

if (!isset($portfolio_item_size)) {
	$thesod_large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
	$thesod_self_video = '';
}

$thesod_sources = array();

if ($params['style'] == 'metro') {
	$thesod_sources = array(
		array('media' => '(min-width: 550px) and (max-width: 1100px)', 'srcset' => array('1x' => 'thesod-portfolio-metro-medium', '2x' => 'thesod-portfolio-metro-retina'))
	);
}

if (!isset($thesod_portfolio_item_data['highlight']) || !$thesod_portfolio_item_data['highlight'] || !empty($params['is_slider']) ||
		($params['style'] == 'masonry' && isset($thesod_portfolio_item_data['highlight']) && $thesod_portfolio_item_data['highlight']) && $thesod_highlight_type == 'vertical') {

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

?>

<?php if (!isset($portfolio_item_size)): ?>
	<div <?php post_class($thesod_classes); ?> style="padding: <?php echo intval($gap_size); ?>px;" data-default-sort="<?php echo intval(get_post()->menu_order); ?>" data-sort-date="<?php echo get_the_date('U'); ?>">
		<div class="wrap clearfix" style="border-bottom-color: <?php echo esc_attr($params['border_color']) ?>">
			<div <?php post_class($thesod_image_classes); ?>>
				<div class="image-inner">
					<?php thesod_post_picture($thesod_size, $thesod_sources, array('alt' => get_the_title())); ?>
				</div>
				<div class="overlay">
					<div class="overlay-circle"></div>
					<?php if (count($thesod_portfolio_item_data['types']) == 1 && $params['disable_socials']): ?>
						<?php
							$thesod_ptype = reset($thesod_portfolio_item_data['types']);
							if($thesod_ptype['type'] == 'full-image') {
								$thesod_link = $thesod_large_image_url[0];
							} elseif($thesod_ptype['type'] == 'self-link') {
								$thesod_link = get_permalink();
							} elseif($thesod_ptype['type'] == 'youtube') {
								$thesod_link = '//www.youtube.com/embed/'.$thesod_ptype['link'].'?autoplay=1';
							} elseif($thesod_ptype['type'] == 'vimeo') {
								$thesod_link = '//player.vimeo.com/video/'.$thesod_ptype['link'].'?autoplay=1';
							} else {
								$thesod_link = $thesod_ptype['link'];
							}
							if(!$thesod_link) {
								$thesod_link = '#';
							}
							if($thesod_ptype['type'] == 'self_video') {
								$thesod_self_video = $thesod_ptype['link'];
								wp_enqueue_style('wp-mediaelement');
								wp_enqueue_script('thesod-mediaelement');
							}

						?>
						<a href="<?php echo esc_url($thesod_link); ?>" target="<?php echo esc_attr($thesod_ptype['link_target']); ?>" class="portolio-item-link <?php echo esc_attr($thesod_ptype['type']); ?> <?php if($thesod_ptype['type'] == 'full-image') echo 'fancy'; ?>"></a>
					<?php endif; ?>
					<div class="links-wrapper">
						<div class="links">
							<div class="portfolio-icons">
								<?php foreach($thesod_portfolio_item_data['types'] as $thesod_ptype): ?>
									<?php
										if($thesod_ptype['type'] == 'full-image') {
											$thesod_link = $thesod_large_image_url[0];
										} elseif($thesod_ptype['type'] == 'self-link') {
											$thesod_link = get_permalink();
										} elseif($thesod_ptype['type'] == 'youtube') {
											$thesod_link = '//www.youtube.com/embed/'.$thesod_ptype['link'].'?autoplay=1';
										} elseif($thesod_ptype['type'] == 'vimeo') {
											$thesod_link = '//player.vimeo.com/video/'.$thesod_ptype['link'].'?autoplay=1';
										} else {
											$thesod_link = $thesod_ptype['link'];
										}
										if(!$thesod_link) {
											$thesod_link = '#';
										}
										if($thesod_ptype['type'] == 'self_video') {
											$thesod_self_video = $thesod_ptype['link'];
											wp_enqueue_style('wp-mediaelement');
											wp_enqueue_script('thesod-mediaelement');
										}
									?>
									<a href="<?php echo esc_url($thesod_link); ?>" target="<?php echo esc_attr($thesod_ptype['link_target']); ?>" class="icon <?php echo esc_attr($thesod_ptype['type']); ?> <?php if($thesod_ptype['type'] == 'full-image' && (count($thesod_portfolio_item_data['types']) > 1 || !$params['disable_socials'])) echo 'fancy'; ?>"></a>
								<?php endforeach; ?>
								<?php if(!$params['disable_socials']): ?>
									<a href="javascript: void(0);" class="icon share"></a>
								<?php endif; ?>

								<div class="overlay-line"></div>
								<?php if(!$params['disable_socials']): ?>
									<div class="portfolio-sharing-pane"><?php thesod_socials_sharing(); ?></div>
								<?php endif; ?>
							</div>
							<?php if( ($params['display_titles'] == 'hover' && $params['layout'] != '1x') || $params['hover'] == 'gradient' || $params['hover'] == 'circular'): ?>
								<div class="caption">
									<div class="title title-h4">
										<?php if($params['hover'] != 'default' && $params['hover'] != 'gradient' && $params['hover'] != 'circular') { echo '<span class="light">'; } ?>
										<?php if(!empty($thesod_portfolio_item_data['overview_title'])) : ?>
											<?php echo $thesod_portfolio_item_data['overview_title']; ?>
										<?php else : ?>
											<?php the_title(); ?>
										<?php endif; ?>
										<?php if($params['hover'] != 'default') { echo '</span>'; } ?>
									</div>
									<div class="description">
										<?php if(has_excerpt()) : ?><div class="subtitle"><?php the_excerpt(); ?></div><?php endif; ?>
										<?php if($params['show_info']): ?>
											<div class="info">
												<?php if($params['layout'] == '1x'): ?>
													<?php echo get_the_date('j F, Y'); ?>&nbsp;
													<?php
														foreach ($slugs as $thesod_k => $thesod_slug)
															if (isset($thesod_terms_set[$thesod_slug]))
																echo '<a data-slug="'.$thesod_terms_set[$thesod_slug]->slug.'">'.$thesod_terms_set[$thesod_slug]->name.'</a>';
													?>
												<?php else: ?>
													<?php echo get_the_date('j F, Y'); ?> <?php if(count($slugs) > 0): ?>in<?php endif; ?>&nbsp;
													<?php
														$thesod_index = 0;
														foreach ($slugs as $thesod_k => $thesod_slug)
															if (isset($thesod_terms_set[$thesod_slug])) {
																echo ($thesod_index > 0 ? '<span class="portfolio-set-comma">,</span> ': '').'<a data-slug="'.$thesod_terms_set[$thesod_slug]->slug.'">'.$thesod_terms_set[$thesod_slug]->name.'</a>';
																$thesod_index++;
															}
													?>
												<?php endif; ?>
											</div>
										<?php endif ?>
									</div>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
			<?php if( ($params['display_titles'] == 'page' || $params['layout'] == '1x') && $params['hover'] != 'gradient' && $params['hover'] != 'circular'): ?>
				<div <?php post_class($thesod_caption_classes); ?> <?php if ($params['background_color']): ?>style="background-color: <?php echo esc_attr($params['background_color']) ?>"<?php endif; ?>>
					<div class="title" <?php if ($params['title_color']): ?>style="color: <?php echo esc_attr($params['title_color']) ?>"<?php endif; ?>>
						<?php if(!empty($thesod_portfolio_item_data['overview_title'])) : ?>
							<?php echo $thesod_portfolio_item_data['overview_title']; ?>
						<?php else : ?>
							<?php the_title(); ?>
						<?php endif; ?>
					</div>
					<div class="caption-separator" <?php if ($params['separator_color']): ?>style="background-color: <?php echo esc_attr($params['separator_color']) ?>"<?php endif; ?>></div>
					<?php if(has_excerpt()) : ?><div class="subtitle" <?php if ($params['desc_color']): ?>style="color: <?php echo esc_attr($params['desc_color']) ?>"<?php endif; ?>><?php the_excerpt(); ?></div><?php endif; ?>
					<?php if($params['show_info']): ?>
						<div class="info">
							<?php if($params['layout'] == '1x'): ?>
								<?php echo get_the_date('j F, Y'); ?>&nbsp;
								<?php
									foreach ($slugs as $thesod_k => $thesod_slug)
										if (isset($thesod_terms_set[$thesod_slug]))
											echo '<span class="separator">|</span><a data-slug="'.$thesod_terms_set[$thesod_slug]->slug.'">'.$thesod_terms_set[$thesod_slug]->name.'</a>';
								?>
							<?php else: ?>
								<?php echo get_the_date('j F, Y'); ?> <?php if(count($slugs) > 0): ?>in<?php endif; ?>&nbsp;
								<?php
									$thesod_index = 0;
									foreach ($slugs as $thesod_k => $thesod_slug)
										if (isset($thesod_terms_set[$thesod_slug])) {
											echo ($thesod_index > 0 ? '<span class="sep"></span> ': '').'<a data-slug="'.$thesod_terms_set[$thesod_slug]->slug.'">'.$thesod_terms_set[$thesod_slug]->name.'</a>';
											$thesod_index++;
										}
								?>
							<?php endif; ?>
						</div>
					<?php endif; ?>
					<?php if($params['likes'] && $params['likes'] != 'false' && function_exists('zilla_likes')) { echo '<div class="portfolio-likes'.($params['show_info'] ? '' : ' visible').'">';zilla_likes();echo '</div>'; } ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
<?php else: ?>
	<div <?php post_class($thesod_classes); ?>>
	</div>
<?php endif; ?>
