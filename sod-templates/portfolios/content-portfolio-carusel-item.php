<?php

$thesod_classes = array('portfolio-item');
$thesod_classes = array_merge($thesod_classes, $slugs);

$thesod_image_classes = array('image');
$thesod_caption_classes = array('caption');

$thesod_portfolio_item_data = get_post_meta(get_the_ID(), 'thesod_portfolio_item_data', 1);
$thesod_sizes = thesod_image_sizes();

if (empty($thesod_portfolio_item_data['types']))
	$thesod_portfolio_item_data['types'] = array();

if (class_exists('thesodGdpr')) {
	$thesod_portfolio_item_data['types'] = thesodGdpr::getInstance()->disallowed_portfolio_type_video($thesod_portfolio_item_data['types']);
}

if ($params['style'] != 'metro') {
	if ($params['layout'] == '3x') {

		if (isset($thesod_portfolio_item_data['highlight']) && $thesod_portfolio_item_data['highlight'] && empty($params['is_slider']))
			$thesod_classes = array_merge($thesod_classes, array('col-md-8', 'col-xs-12'));
		else
			$thesod_classes = array_merge($thesod_classes, array('col-md-4', 'col-xs-6'));
	}
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
	if ($params['layout'] == '3x') {
		$thesod_size = 'thesod-portfolio-carusel-3x';
	}





if (isset($thesod_portfolio_item_data['highlight']) && $thesod_portfolio_item_data['highlight'] && empty($params['is_slider']))
	$thesod_classes[] = 'double-item';



if ($params['effects_enabled'])
	$thesod_classes[] = 'lazy-loading-item';

$thesod_small_image_url = thesod_generate_thumbnail_src(get_post_thumbnail_id(), $thesod_size);
$thesod_large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
$thesod_self_video = '';

?>


<div style="padding: <?php echo intval($gap_size); ?>px;" <?php post_class($thesod_classes); ?> <?php if($params['effects_enabled']): ?>data-ll-effect="move-up"<?php endif; ?> data-sort-date="<?php echo get_the_date('U'); ?>">
	<div class="wrap clearfix" style="border-bottom-color: <?php echo esc_attr($params['bottom_border_color']) ?>">
		<div <?php post_class($thesod_image_classes); ?>>
			<div class="image-inner">
				<img src="<?php echo esc_url($thesod_small_image_url[0]); ?>" width="<?php echo esc_attr($thesod_small_image_url[1]); ?>" height="<?php echo esc_attr($thesod_small_image_url[2]); ?>" alt="<?php the_title(); ?>" />
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
