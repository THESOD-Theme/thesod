<?php

$thesod_classes = array('portfolio-item');
$thesod_classes = array_merge($thesod_classes, $slugs);

$thesod_image_classes = array('image');
$thesod_caption_classes = array('caption');

if($params['caption_position'] == 'zigzag') {
	$thesod_caption_position = $eo_marker ? 'left' : 'right';
} else {
	$thesod_caption_position = $params['caption_position'];
}

$thesod_portfolio_item_data = thesod_get_sanitize_pf_item_data(get_the_ID());
$thesod_title_data = thesod_get_sanitize_page_title_data(get_the_ID());

if (empty($thesod_portfolio_item_data['types']))
	$thesod_portfolio_item_data['types'] = array();

if (class_exists('thesodGdpr')) {
	$thesod_portfolio_item_data['types'] = thesodGdpr::getInstance()->disallowed_portfolio_type_video($thesod_portfolio_item_data['types']);
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

$thesod_small_image_url = thesod_generate_thumbnail_src(get_post_thumbnail_id(), $thesod_size);
$thesod_large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
$thesod_self_video = '';

$thesod_bottom_line = false;
$thesod_portfolio_button_link = '';
if($thesod_portfolio_item_data['project_link'] || !$params['disable_socials']) {
	$thesod_bottom_line = true;
}

$thesod_classes[] = 'item-animations-not-inited';

?>

<div <?php post_class($thesod_classes); ?> style="padding: <?php echo intval($gap_size); ?>px;" data-sort-date="<?php echo get_the_date('U'); ?>">
	<div class="wrap clearfix">
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
							$thesod_bottom_line = true;
							$thesod_portfolio_button_link = $thesod_link;
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
										$thesod_bottom_line = true;
										$thesod_portfolio_button_link = $thesod_link;
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
						<?php if($params['display_titles'] == 'hover' || $params['hover'] == 'gradient' || $params['hover'] == 'circular'): ?>
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
												<?php echo get_the_date('j F, Y'); ?> <?php if(count($slugs) > 0) { echo esc_html_x('in', 'in categories', 'thesod'); } ?>&nbsp;
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
		<?php if($params['display_titles'] == 'page' && $params['hover'] != 'gradient' && $params['hover'] != 'circular'): ?>
			<div <?php post_class($thesod_caption_classes); ?> style="<?php if ($params['background_color']): ?>background-color: <?php echo esc_attr($params['background_color']) ?>;<?php endif; ?> <?php if ($params['border_color']): ?>border-color: <?php echo esc_attr($params['border_color']) ?>;<?php endif; ?>">
				<div class="caption-sizable-content<?php echo ($thesod_bottom_line ? ' with-bottom-line' : ''); ?>">
					<div class="title title-h3"><span class="light" <?php if ($params['title_color']): ?>style="color: <?php echo esc_attr($params['title_color']) ?>"<?php endif; ?>>
						<?php if(!empty($thesod_portfolio_item_data['overview_title'])) : ?>
							<?php echo $thesod_portfolio_item_data['overview_title']; ?>
						<?php else : ?>
							<?php the_title(); ?>
						<?php endif; ?>
					</span></div>
					<?php if($params['show_info']): ?>
						<div class="info clearfix">
							<div class="caption-separator-line"><?php echo get_the_date('j F, Y'); ?></div><!--
							<?php if($params['likes'] && $params['likes'] != 'false' && function_exists('zilla_likes') ) { echo '--><div class="caption-separator-line-hover"> <span class="sep"></span> <span class="post-meta-likes">';zilla_likes();echo '</span></div><!--'; } ?>
						--></div>
					<?php endif; ?>
					<?php if(has_excerpt()) : ?>
						<div class="subtitle" <?php if ($params['desc_color']): ?>style="color: <?php echo esc_attr($params['desc_color']) ?>"<?php endif; ?>><?php the_excerpt(); ?></div>
					<?php elseif($thesod_title_data['title_excerpt']) : ?>
						<div class="subtitle" <?php if ($params['desc_color']): ?>style="color: <?php echo esc_attr($params['desc_color']) ?>"<?php endif; ?>><?php echo nl2br($thesod_page_data['title_excerpt']); ?></div>
					<?php endif; ?>
					<?php if($params['show_info']): ?>
						<div class="info">
							<?php
								if(count($slugs) > 0) { echo esc_html_x('in', 'in categories', 'thesod'); }
								$thesod_index = 0;
								foreach ($slugs as $thesod_k => $thesod_slug) {
									if (isset($thesod_terms_set[$thesod_slug])) {
										echo ($thesod_index > 0 ? '<span class="portfolio-set-comma">,</span> ': '').' <a data-slug="'.$thesod_terms_set[$thesod_slug]->slug.'">'.$thesod_terms_set[$thesod_slug]->name.'</a>';
										$thesod_index++;
									}
								}
								?>
						</div>
					<?php endif; ?>
					<?php if($params['background_color']): ?>
						<div class="after-overlay" <?php if ($params['background_color']): ?>style="box-shadow: 0 0 30px 75px <?php echo esc_attr($params['background_color']) ?>;"<?php endif; ?>></div>
					<?php endif; ?>
				</div>
				<div class="caption-bottom-line">
					<?php if($thesod_portfolio_item_data['project_link']) { thesod_button(array('size' => 'tiny', 'href' => $thesod_portfolio_item_data['project_link'] , 'text' => ($thesod_portfolio_item_data['project_text'] ? $thesod_portfolio_item_data['project_text'] : __('Launch', 'thesod')), 'extra_class' => 'project-button'), 1); } ?>
					<?php if($thesod_portfolio_button_link) { thesod_button(array('size' => 'tiny', 'text' => __('Details', 'thesod'), 'style' => 'outline', 'href' => get_permalink()), 1); } ?>
					<?php if(!$params['disable_socials']): ?>
						<div class="post-footer-sharing"><?php thesod_button(array('icon' => 'share', 'size' => 'tiny'), 1); ?><div class="sharing-popup"><?php thesod_socials_sharing(); ?><svg class="sharing-styled-arrow"><use xlink:href="<?php echo esc_url(get_template_directory_uri() . '/css/post-arrow.svg'); ?>#dec-post-arrow"></use></svg></div></div>
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>
