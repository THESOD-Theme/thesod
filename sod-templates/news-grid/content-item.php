<?php

$thesod_classes = array('portfolio-item');
$thesod_classes = array_merge($thesod_classes, $slugs);

$thesod_image_classes = array('image');
$thesod_caption_classes = array('caption');

if (!isset($portfolio_item_size)) {
	$thesod_post_data = thesod_get_sanitize_page_title_data(get_the_ID());
	$post_item_data = thesod_get_sanitize_post_data(get_the_ID());
	$post_format = get_post_format(get_the_ID());
} else {
	$slugs = array();
	$thesod_post_data = array();
	$post_item_data = array();
}

if (!empty($params['ignore_highlights'])) {
	unset($post_item_data['highlight']);
	unset($post_item_data['highlight_type']);
	unset($post_item_data['highlight_style']);
}

if (!empty($post_item_data['highlight_type'])) {
	$thesod_highlight_type = $post_item_data['highlight_type'];
} else {
	$thesod_highlight_type = 'squared';
}

$alternative_highlight_style_enabled = isset($post_item_data['highlight']) && $post_item_data['highlight'] && $post_item_data['highlight_style'] == 'alternative' && $params['display_titles'] == 'hover';

if ($params['style'] != 'metro') {
	if ($params['layout'] == '1x') {
		$thesod_classes = array_merge($thesod_classes, array('col-xs-12'));
		$thesod_image_classes = array_merge($thesod_image_classes, array('col-sm-5', 'col-xs-12'));
		$thesod_caption_classes = array_merge($thesod_caption_classes, array('col-sm-7', 'col-xs-12'));
	}

	if ($params['layout'] == '2x') {
		if (isset($post_item_data['highlight']) && $post_item_data['highlight'] && empty($params['is_slider']) && $thesod_highlight_type != 'vertical')
			$thesod_classes = array_merge($thesod_classes, array('col-xs-12'));
		else
			$thesod_classes = array_merge($thesod_classes, array('col-sm-6', 'col-xs-12'));
	}

	if ($params['layout'] == '3x') {
		if (isset($post_item_data['highlight']) && $post_item_data['highlight'] && empty($params['is_slider']) && $thesod_highlight_type != 'vertical')
			$thesod_classes = array_merge($thesod_classes, array('col-md-8', 'col-xs-8'));
		else
			$thesod_classes = array_merge($thesod_classes, array('col-md-4', 'col-xs-4'));
	}

	if ($params['layout'] == '4x') {
		if (isset($post_item_data['highlight']) && $post_item_data['highlight'] && empty($params['is_slider']) && $thesod_highlight_type != 'vertical')
			$thesod_classes = array_merge($thesod_classes, array('col-md-6', 'col-sm-8', 'col-xs-8'));
		else
			$thesod_classes = array_merge($thesod_classes, array('col-md-3', 'col-sm-4', 'col-xs-4'));
	}
}

if (isset($post_item_data['highlight']) && $post_item_data['highlight'] && empty($params['is_slider']))
	$thesod_classes[] = 'double-item';

if (isset($post_item_data['highlight']) && $post_item_data['highlight'] && empty($params['is_slider'])) {
	$thesod_classes[] = 'double-item-' . $thesod_highlight_type;
}

if ($alternative_highlight_style_enabled) {
	$thesod_classes[] = 'double-item-style-' . $post_item_data['highlight_style'];
	$thesod_classes[] = 'double-item-style-' . $post_item_data['highlight_style'] . '-' . $thesod_highlight_type;

	if ($thesod_highlight_type == 'squared') {
		$thesod_highlight_type = 'vertical';
	} else {
		$post_item_data['highlight'] = false;
	}
}

$thesod_size = 'thesod-portfolio-justified';
$thesod_sizes = thesod_image_sizes();
if ($params['layout'] != '1x') {
	if ($params['style'] == 'masonry') {
		$thesod_size = 'thesod-portfolio-masonry';
		if (isset($post_item_data['highlight']) && $post_item_data['highlight'] && empty($params['is_slider']))
			$thesod_size = 'thesod-portfolio-masonry-double';
	} elseif ($params['style'] == 'metro') {
		$thesod_size = 'thesod-portfolio-metro';
	} else {
		if (isset($post_item_data['highlight']) && $post_item_data['highlight'] && empty($params['is_slider'])) {
			$thesod_size = 'thesod-portfolio-double-' . str_replace('%', '',$params['layout']);

			if ( $params['display_titles'] == 'hover' && isset($thesod_sizes[$thesod_size.'-hover'])) {
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

	if (isset($post_item_data['highlight']) && $post_item_data['highlight'] && $params['style'] != 'metro' && empty($params['is_slider']) && $thesod_highlight_type != 'squared') {
		$thesod_size .= '-' . $thesod_highlight_type;
	}
} else {
	$thesod_size = 'thesod-portfolio-1x';
}

$thesod_classes[] = 'item-animations-not-inited';

$thesod_size = apply_filters('portfolio_size_filter', $thesod_size);

// $thesod_large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
$thesod_self_video = '';

$thesod_sources = array();

$thesod_has_post_thumbnail = has_post_thumbnail(get_the_ID());

if ($params['style'] == 'metro') {
	$thesod_sources = array(
		array('media' => '(min-width: 550px) and (max-width: 1100px)', 'srcset' => array('1x' => 'thesod-portfolio-metro-medium', '2x' => 'thesod-portfolio-metro-retina'))
	);
}

if (!isset($post_item_data['highlight']) || !$post_item_data['highlight'] || !empty($params['is_slider']) ||
		($params['style'] == 'masonry' && isset($post_item_data['highlight']) && $post_item_data['highlight']) && $thesod_highlight_type == 'vertical') {

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

if ($params['hide_categories']) {
	$thesod_classes[] = 'post-hide-categories';
}

if ($params['hide_date']) {
	$thesod_classes[] = 'post-hide-date';
}

$post_excerpt = !has_excerpt() && !empty( $thesod_post_data['title_excerpt'] ) ? $thesod_post_data['title_excerpt'] : preg_replace('%&#x[a-fA-F0-9]+;%', '', apply_filters('the_excerpt', get_the_excerpt()));

$has_comments = comments_open() && !$params['hide_comments'];

$has_likes = function_exists('zilla_likes') && $params['likes'];

if ($params['version'] != 'default' && $params['display_titles'] == 'page' && $params['background_style'] == 'transparent' && ($has_likes || $has_comments || !$params['disable_socials'])) {
	$thesod_classes[] = 'show-caption-border';
}

if ($params['version'] == 'default' && $params['display_titles'] == 'page' && $params['background_style'] == 'transparent') {
	$thesod_classes[] = 'show-caption-border';
}

if (empty($post_excerpt)) {
	$thesod_classes[] = 'post-empty-excerpt';
}


if (!$params['hide_categories']) {
	foreach ($slugs as $thesod_k => $thesod_slug) {
		if (isset($thesod_terms_set[$thesod_slug])) {
			$thesod_classes[] = 'post-has-sets';
			break;
		}
	}
}

if (!$params['hide_author']) {
	$thesod_classes[] = 'post-has-author';
}

if (!function_exists('thesod_news_grid_item_author')) {
	function thesod_news_grid_item_author($params) {
		global $post;

		if ($params['hide_author']) return;

		?>

		<div class="author">
			<?php if (!$params['hide_author_avatar']): ?>
				<span class="author-avatar"><?php echo get_avatar(get_the_author_meta('ID'), 50) ?></span>
			<?php endif; ?>
			<span class="author-name"><?php printf( esc_html__( "By %s", "thesod" ), get_the_author_link() ) ?></span>
		</div>

		<?php
	}
}

if (!function_exists('thesod_news_grid_item_meta')) {
	function thesod_news_grid_item_meta($params, $has_comments, $has_likes) {
		global $post;

		if (!$has_comments && !$has_likes && $params['disable_socials']) return;

		?>

		<div class="grid-post-meta clearfix <?php if ( !$has_likes): ?>without-likes<?php endif; ?>">
			<div class="grid-post-meta-inner">
				<?php if (!$params['disable_socials']): ?>
					<div class="grid-post-share">
						<a href="javascript: void(0);" class="icon share"></a>
					</div>
				<?php endif; ?>

				<div class="grid-post-meta-comments-likes">
					<?php if ($has_comments) : ?>
						<span class="comments-link"><?php comments_popup_link(0, 1, '%'); ?></span>
					<?php endif; ?>

					<?php if( $has_likes ) { echo '<span class="post-meta-likes">';zilla_likes();echo '</span>'; } ?>
				</div>

				<?php if (!$params['disable_socials']): ?>
					<div class="portfolio-sharing-pane"><?php thesod_socials_sharing(); ?></div>
				<?php endif; ?>
			</div>
		</div>

		<?php
	}
}

?>

<?php if (!isset($portfolio_item_size)): ?>
	<div <?php post_class($thesod_classes); ?> style="padding: <?php echo intval($gap_size); ?>px;" data-default-sort="<?php echo intval(get_post()->menu_order); ?>" data-sort-date="<?php echo get_the_date('U'); ?>">
		<?php if ($alternative_highlight_style_enabled): ?>
			<div class="highlight-item-alternate-box">
				<div class="highlight-item-alternate-box-content caption">
					<div class="highlight-item-alternate-box-content-inline">
						<?php if (!$params['hide_date']): ?>
							<div class="post-date"><?php echo get_the_date(); ?></div>
						<?php endif; ?>

						<div class="title">
							<?php the_title('<div class="title-' . ($params['version'] == 'new' ? 'h4' : 'h5') . '">', '</div>'); ?>
						</div>

						<?php if ($params['version'] == 'default' && !$params['hide_categories']): ?>
							<div class="info">
								<?php
									$thesod_index = 0;
									foreach ($slugs as $thesod_k => $thesod_slug)
										if (isset($thesod_terms_set[$thesod_slug])) {
											echo ($thesod_index > 0 ? '<span class="sep"></span> ': '').'<a data-slug="'.$thesod_terms_set[$thesod_slug]->slug.'">'.$thesod_terms_set[$thesod_slug]->name.'</a>';
											$thesod_index++;
										}
								?>
							</div>
						<?php endif; ?>

						<a href="<?php echo esc_url(get_permalink()); ?>" class="portolio-item-link"></a>
					</div>
				</div>
			</div>
			<style>
				<?php if (!empty($post_item_data['highlight_title_left_background'])): ?>
					.news-grid .portfolio-item.post-<?php echo get_the_ID(); ?>.double-item-style-alternative .highlight-item-alternate-box {
						background-color: <?php echo $post_item_data['highlight_title_left_background']; ?>;
					}
				<?php endif; ?>

				<?php if (!empty($post_item_data['highlight_title_left_color'])): ?>
					.news-grid .portfolio-item.post-<?php echo get_the_ID(); ?>.double-item-style-alternative .highlight-item-alternate-box .caption .title,
					.news-grid .portfolio-item.post-<?php echo get_the_ID(); ?>.double-item-style-alternative .highlight-item-alternate-box .caption .title > *,
					.news-grid .portfolio-item.post-<?php echo get_the_ID(); ?>.double-item-style-alternative .highlight-item-alternate-box .caption .post-date,
					.news-grid .portfolio-item.post-<?php echo get_the_ID(); ?>.double-item-style-alternative .highlight-item-alternate-box .caption .info a,
					.news-grid .portfolio-item.post-<?php echo get_the_ID(); ?>.double-item-style-alternative .highlight-item-alternate-box .caption .info .sep {
						color: <?php echo $post_item_data['highlight_title_left_color']; ?> !important;
					}

					.news-grid .portfolio-item.post-<?php echo get_the_ID(); ?>.double-item-style-alternative .highlight-item-alternate-box .caption .info .sep {
						border-left-color: <?php echo $post_item_data['highlight_title_left_color']; ?>;
					}
				<?php endif; ?>

				<?php if (!empty($post_item_data['highlight_title_right_background'])): ?>
					.news-grid .portfolio-item.post-<?php echo get_the_ID(); ?>.double-item-style-alternative.right-item .highlight-item-alternate-box {
						background-color: <?php echo $post_item_data['highlight_title_right_background']; ?>;
					}
				<?php endif; ?>

				<?php if (!empty($post_item_data['highlight_title_right_color'])): ?>
					.news-grid .portfolio-item.post-<?php echo get_the_ID(); ?>.double-item-style-alternative.right-item .highlight-item-alternate-box .caption .title,
					.news-grid .portfolio-item.post-<?php echo get_the_ID(); ?>.double-item-style-alternative.right-item .highlight-item-alternate-box .caption .title > *,
					.news-grid .portfolio-item.post-<?php echo get_the_ID(); ?>.double-item-style-alternative.right-item .highlight-item-alternate-box .caption .post-date,
					.news-grid .portfolio-item.post-<?php echo get_the_ID(); ?>.double-item-style-alternative.right-item .highlight-item-alternate-box .caption .info a,
					.news-grid .portfolio-item.post-<?php echo get_the_ID(); ?>.double-item-style-alternative.right-item .highlight-item-alternate-box .caption .info .sep {
						color: <?php echo $post_item_data['highlight_title_right_color']; ?> !important;
					}

					.news-grid .portfolio-item.post-<?php echo get_the_ID(); ?>.double-item-style-alternative.right-item .highlight-item-alternate-box .caption .info .sep {
						border-left-color: <?php echo $post_item_data['highlight_title_right_color']; ?>;
					}
				<?php endif; ?>
			</style>
		<?php endif; ?>

		<div class="wrap clearfix">
			<div <?php post_class($thesod_image_classes); ?>>
				<div class="image-inner">
					<?php if ($params['style'] == 'justified'): ?>
						<?php thesod_generate_picture('thesod_TRANSPARENT_IMAGE', $thesod_size, array(), array('alt' => get_the_title())); ?>
					<?php endif; ?>

					<?php if ($params['style'] == 'metro' && ($post_format == 'video' || $post_format == 'audio')): ?>
						<?php thesod_generate_picture('thesod_TRANSPARENT_IMAGE', 'thesod-news-grid-metro-video', array(), array('alt' => get_the_title())); ?>
					<?php endif; ?>

					<?php if ($params['style'] == 'metro' && $post_format == 'quote'): ?>
						<?php thesod_generate_picture('thesod_TRANSPARENT_IMAGE', 'thesod-portfolio-metro-retina', array(), array('alt' => get_the_title())); ?>
					<?php endif; ?>

					<?php
						if (!isset($portfolio_item_size)) {
							if ($post_format == 'video' && $thesod_has_post_thumbnail) {
								echo '<div class="post-featured-content"><a href="' . esc_url(get_permalink(get_the_ID())) . '">';
								thesod_post_picture($thesod_size, $thesod_sources, array('class' => 'img-responsive', 'alt' => get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true)));
								echo '</a></div>';
							} else {
								echo thesod_get_post_featured_content(get_the_ID(), $thesod_size, false, $thesod_sources);
							}
						}
					?>
				</div>

				<?php if (($post_format != 'video' || $thesod_has_post_thumbnail) && $post_format != 'audio' && $post_format != 'quote' && $post_format != 'gallery'): ?>
					<div class="overlay">
						<div class="overlay-circle"></div>
						<?php if (!isset($portfolio_item_size) && $post_format == 'video' && $thesod_has_post_thumbnail && !empty($post_item_data['video'])): ?>
							<?php
								switch ($post_item_data['video_type']) {
									case 'youtube':
										$thesod_video_link = '//www.youtube.com/embed/' . $post_item_data['video'] . '?autoplay=1';
										$thesod_video_class = 'youtube';
										break;

									case 'vimeo':
										$thesod_video_link = '//player.vimeo.com/video/' . $post_item_data['video'] . '?autoplay=1';
										$thesod_video_class = 'vimeo';
										break;

									default:
										$thesod_video_link = $post_item_data['video'];
										$thesod_video_class = 'self_video';
								}
							?>
							<a href="<?php echo esc_url($thesod_video_link); ?>" class="news-video-icon <?php echo $thesod_video_class; ?>"></a>
						<?php endif; ?>

						<div class="links-wrapper">
							<div class="links">
								<div class="caption">
									<a href="<?php echo esc_url(get_permalink()); ?>" class="portolio-item-link"></a>

									<?php if ($post_format != 'video'): ?>
										<?php if ($params['display_titles'] == 'page' && $params['version'] == 'new'): ?>
											<div class="portfolio-icons">
												<a href="javascript: void(0);" class="icon self-link"></a>
											</div>

											<?php if (!$params['hide_categories'] && $post_format != 'quote'): ?>
												<div class="info">
													<?php
														$thesod_index = 0;
														foreach ($slugs as $thesod_k => $thesod_slug)
															if (isset($thesod_terms_set[$thesod_slug])) {
																echo ($thesod_index > 0 ? '<span class="sep"></span> ': '').'<a data-slug="'.$thesod_terms_set[$thesod_slug]->slug.'">'.$thesod_terms_set[$thesod_slug]->name.'</a>';
																$thesod_index++;
															}
													?>
												</div>
											<?php endif; ?>
										<?php endif; ?>

										<?php if ($params['version'] == 'default' && $params['display_titles'] == 'page'): ?>
											<?php if (!$alternative_highlight_style_enabled && ($params['hover'] == 'gradient' || $params['hover'] == 'circular')): ?>
												<div class="gradient-top-box">
											<?php endif; ?>

											<?php if ($has_comments || $has_likes): ?>
												<div class="grid-post-meta <?php if ( !$has_likes): ?>without-likes<?php endif; ?>">
													<?php if ($has_comments) : ?>
														<span class="comments-link"><?php comments_popup_link(0, 1, '%'); ?></span>
													<?php endif; ?>
													<?php if( $has_likes ) { echo '<span class="post-meta-likes">';zilla_likes();echo '</span>'; } ?>
												</div>
											<?php endif; ?>

											<div class="description <?php if ( empty($post_excerpt) ): ?>empty-excerpt<?php endif; ?>">
												<?php if (!empty($post_excerpt)): ?>
													<div class="subtitle">
														<?php echo $post_excerpt; ?>
													</div>
												<?php endif; ?>
											</div>

											<div class="post-author-outer">
												<?php thesod_news_grid_item_author($params); ?>
											</div>

											<?php if (!$alternative_highlight_style_enabled && ($params['hover'] == 'gradient' || $params['hover'] == 'circular')): ?>
												</div>
											<?php endif; ?>
										<?php endif; ?>
									<?php endif; ?>

									<?php if ($params['version'] == 'default' && $params['display_titles'] == 'hover'): ?>
										<div class="slide-content">
											<div class="slide-content-visible">
												<?php if ($params['hover'] == 'vertical-sliding'): ?>
													<?php thesod_news_grid_item_meta($params, $has_comments, $has_likes); ?>
												<?php endif; ?>

												<?php if (($params['hover'] == 'gradient' || $params['hover'] == 'vertical-sliding') && !$params['hide_date']): ?>
													<div class="post-date"><?php echo get_the_date(); ?></div>
												<?php endif; ?>

												<div class="title">
													<?php the_title('<div class="title-' . (isset($post_item_data['highlight']) && $post_item_data['highlight'] && $params['style'] != 'metro' && empty($params['is_slider']) && $thesod_highlight_type == 'squared' ? 'h4' : 'h5') .'">', '</div>'); ?>
												</div>

												<?php if ($params['hover'] == 'zooming-blur'): ?>
													<?php thesod_news_grid_item_author($params); ?>
												<?php endif; ?>

												<?php if ($params['hover'] == 'zooming-blur'): ?>
													<?php if (!empty($post_excerpt)): ?>
														<div class="description">
															<div class="subtitle">
																<?php echo $post_excerpt; ?>
															</div>
														</div>
													<?php endif; ?>
												<?php endif; ?>

												<?php if (!$params['hide_categories'] && ($params['hover'] == 'circular' || $params['hover'] == 'zooming-blur' || $params['hover'] == 'vertical-sliding')): ?>
													<div class="info">
														<?php
															$thesod_index = 0;
															foreach ($slugs as $thesod_k => $thesod_slug)
																if (isset($thesod_terms_set[$thesod_slug])) {
																	echo ($thesod_index > 0 ? '<span class="sep"></span> ': '').'<a data-slug="'.$thesod_terms_set[$thesod_slug]->slug.'">'.$thesod_terms_set[$thesod_slug]->name.'</a>';
																	$thesod_index++;
																}
														?>
													</div>
												<?php endif; ?>

												<?php if (($params['hover'] == 'default' || $params['hover'] == 'circular' || $params['hover'] == 'horizontal-sliding') && !$params['hide_date']): ?>
													<div class="post-date"><?php echo get_the_date(); ?></div>
												<?php endif; ?>

												<?php if ($params['hover'] == 'default' || $params['hover'] == 'horizontal-sliding'): ?>
													<?php thesod_news_grid_item_meta($params, $has_comments, $has_likes); ?>
												<?php endif; ?>
											</div>

											<div class="slide-content-hidden">
												<?php if ($params['hover'] == 'default' || $params['hover'] == 'horizontal-sliding'): ?>
													<?php thesod_news_grid_item_author($params); ?>
												<?php endif; ?>

												<?php if ($params['hover'] == 'gradient' || $params['hover'] == 'circular' || $params['hover'] == 'zooming-blur'): ?>
													<?php thesod_news_grid_item_meta($params, $has_comments, $has_likes); ?>
												<?php endif; ?>

												<?php if (($params['hover'] == 'zooming-blur') && !$params['hide_date']): ?>
													<div class="post-date"><?php echo get_the_date(); ?></div>
												<?php endif; ?>

												<?php if ($params['hover'] != 'zooming-blur'): ?>
													<?php if (!empty($post_excerpt)): ?>
														<div class="description">
															<div class="subtitle">
																<?php echo $post_excerpt; ?>
															</div>
														</div>
													<?php endif; ?>
												<?php endif; ?>

												<?php if (!$params['hide_categories'] && ($params['hover'] == 'default' || $params['hover'] == 'gradient' || $params['hover'] == 'horizontal-sliding')): ?>
													<div class="info">
														<?php
															$thesod_index = 0;
															foreach ($slugs as $thesod_k => $thesod_slug)
																if (isset($thesod_terms_set[$thesod_slug])) {
																	echo ($thesod_index > 0 ? '<span class="sep"></span> ': '').'<a data-slug="'.$thesod_terms_set[$thesod_slug]->slug.'">'.$thesod_terms_set[$thesod_slug]->name.'</a>';
																	$thesod_index++;
																}
														?>
													</div>
												<?php endif; ?>

												<?php if ($params['hover'] == 'gradient' || $params['hover'] == 'circular' || $params['hover'] == 'vertical-sliding'): ?>
													<?php thesod_news_grid_item_author($params); ?>
												<?php endif; ?>
											</div>
										</div>
									<?php endif; ?>

									<?php if ($params['version'] == 'new' && $params['display_titles'] == 'hover'): ?>
										<div class="slide-content">
											<div class="slide-content-visible">
												<?php if (($params['hover'] == 'default' || $params['hover'] == 'gradient' || $params['hover'] == 'circular') && !$params['hide_date']): ?>
													<div class="post-date"><?php echo get_the_date(); ?></div>
												<?php endif; ?>

												<?php if ($params['hover'] == 'zooming-blur'): ?>
													<?php thesod_news_grid_item_author($params); ?>
													<?php thesod_news_grid_item_meta($params, $has_comments, $has_likes); ?>
												<?php endif; ?>

												<?php if ($params['hover'] == 'vertical-sliding' || $params['hover'] == 'horizontal-sliding'): ?>
													<?php thesod_news_grid_item_author($params); ?>
												<?php endif; ?>

												<div class="title">
													<?php the_title('<div class="title-' . (isset($post_item_data['highlight']) && $post_item_data['highlight'] && $params['style'] != 'metro' && empty($params['is_slider']) && $thesod_highlight_type == 'squared' ? 'h4' : 'h5') .'">', '</div>'); ?>
												</div>

												<?php if ($params['hover'] == 'default'): ?>
													<?php thesod_news_grid_item_author($params); ?>
												<?php endif; ?>

												<?php if (!$params['hide_categories'] && ($params['hover'] == 'gradient' || $params['hover'] == 'circular')): ?>
													<div class="info">
														<?php
															$thesod_index = 0;
															foreach ($slugs as $thesod_k => $thesod_slug)
																if (isset($thesod_terms_set[$thesod_slug])) {
																	echo ($thesod_index > 0 ? '<span class="sep"></span> ': '').'<a data-slug="'.$thesod_terms_set[$thesod_slug]->slug.'">'.$thesod_terms_set[$thesod_slug]->name.'</a>';
																	$thesod_index++;
																}
														?>
													</div>
												<?php endif; ?>
											</div>

											<div class="slide-content-hidden">
												<?php if ($params['hover'] == 'gradient' || $params['hover'] == 'circular'): ?>
													<?php thesod_news_grid_item_author($params); ?>
												<?php endif; ?>

												<?php if ($params['hover'] == 'vertical-sliding'): ?>
													<?php thesod_news_grid_item_author($params); ?>

													<?php if (!$params['hide_author']): ?>
														<div class="overlay-line"></div>
													<?php endif; ?>

													<?php thesod_news_grid_item_meta($params, $has_comments, $has_likes); ?>
												<?php endif; ?>

												<?php if ($params['hover'] == 'horizontal-sliding'): ?>
													<?php if (!$params['hide_author']): ?>
														<div class="overlay-line"></div>
													<?php endif; ?>
												<?php endif; ?>

												<?php if (!$params['hide_categories'] && $params['hover'] == 'horizontal-sliding'): ?>
													<div class="info">
														<?php
															$thesod_index = 0;
															foreach ($slugs as $thesod_k => $thesod_slug)
																if (isset($thesod_terms_set[$thesod_slug])) {
																	echo ($thesod_index > 0 ? '<span class="sep"></span> ': '').'<a data-slug="'.$thesod_terms_set[$thesod_slug]->slug.'">'.$thesod_terms_set[$thesod_slug]->name.'</a>';
																	$thesod_index++;
																}
														?>
													</div>
												<?php endif; ?>

												<?php if (!empty($post_excerpt)): ?>
													<div class="description">
														<div class="subtitle">
															<?php echo $post_excerpt; ?>
														</div>
													</div>
												<?php endif; ?>

												<?php if (($params['hover'] == 'zooming-blur' || $params['hover'] == 'vertical-sliding') && !$params['hide_date']): ?>
													<div class="post-date"><?php echo get_the_date(); ?></div>
												<?php endif; ?>

												<?php if ($params['hover'] == 'gradient' || $params['hover'] == 'circular' || $params['hover'] == 'horizontal-sliding'): ?>
													<?php thesod_news_grid_item_meta($params, $has_comments, $has_likes); ?>
												<?php endif; ?>
											</div>
										</div>

										<?php if (!$params['hide_categories'] && ($params['hover'] != 'horizontal-sliding' && $params['hover'] != 'gradient'  && $params['hover'] != 'circular')): ?>
											<div class="info">
												<?php
													$thesod_index = 0;
													foreach ($slugs as $thesod_k => $thesod_slug)
														if (isset($thesod_terms_set[$thesod_slug])) {
															echo ($thesod_index > 0 ? '<span class="sep"></span> ': '').'<a data-slug="'.$thesod_terms_set[$thesod_slug]->slug.'">'.$thesod_terms_set[$thesod_slug]->name.'</a>';
															$thesod_index++;
														}
												?>
											</div>
										<?php endif; ?>

										<?php if ($params['hover'] == 'default'): ?>
											<?php thesod_news_grid_item_meta($params, $has_comments, $has_likes); ?>
										<?php endif; ?>

										<?php if ($params['hover'] == 'horizontal-sliding' && !$params['hide_date']): ?>
											<div class="post-date"><?php echo get_the_date(); ?></div>
										<?php endif; ?>

									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				<?php endif; ?>
			</div>

			<?php if ( $params['display_titles'] == 'page' && $post_format != 'quote'): ?>
				<div <?php post_class($thesod_caption_classes); ?>>

					<?php if ($params['version'] == 'new' && (!$params['hide_date'] || !$params['hide_author'])): ?>
						<div class="post-author-date">
							<?php thesod_news_grid_item_author($params); ?>
					<?php endif; ?>

					<?php if (!$params['hide_date']): ?>
						<?php if ($params['version'] == 'new' && !$params['hide_author']): ?>
							<div class="post-author-date-separator">-</div>
						<?php endif; ?>
						<div class="post-date"><?php echo get_the_date(); ?></div>
					<?php endif; ?>

					<?php if ($params['version'] == 'new' && (!$params['hide_date'] || !$params['hide_author'])): ?>
						</div>
					<?php endif; ?>

					<div class="title">
						<?php the_title('<div class="title-h' . ($params['version'] == 'new' ? 4 : 6) . '"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></div>'); ?>
					</div>

					<?php if ($params['version'] == 'default' && !$params['hide_categories'] && $post_format != 'quote'): ?>
						<div class="info">
							<?php
								$thesod_index = 0;
								foreach ($slugs as $thesod_k => $thesod_slug)
									if (isset($thesod_terms_set[$thesod_slug])) {
										echo ($thesod_index > 0 ? '<span class="sep"></span> ': '').'<a data-slug="'.$thesod_terms_set[$thesod_slug]->slug.'">'.$thesod_terms_set[$thesod_slug]->name.'</a>';
										$thesod_index++;
									}
							?>
						</div>
					<?php endif; ?>

					<?php if ($params['version'] == 'new' && (!empty($post_excerpt) || $has_comments || $has_likes || !$params['disable_socials'])): ?>
						<?php if (!empty($post_excerpt)): ?>
							<div class="description">
								<?php echo $post_excerpt; ?>
							</div>
						<?php endif; ?>

						<?php if ($has_comments || $has_likes || !$params['disable_socials']): ?>
							<div class="grid-post-meta clearfix <?php if ( !$has_likes): ?>without-likes<?php endif; ?>">
								<div class="grid-post-meta-inner">
									<?php if (!$params['disable_socials']): ?>
										<div class="grid-post-share">
											<a href="javascript: void(0);" class="icon share"></a>
										</div>
										<div class="portfolio-sharing-pane"><?php thesod_socials_sharing(); ?></div>
									<?php endif; ?>

									<div class="grid-post-meta-comments-likes">
										<?php if ($has_comments) : ?>
											<span class="comments-link"><?php comments_popup_link(0, 1, '%'); ?></span>
										<?php endif; ?>

										<?php if( $has_likes ) { echo '<span class="post-meta-likes">';zilla_likes();echo '</span>'; } ?>
									</div>
								</div>
							</div>
						<?php endif; ?>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
<?php else: ?>
	<div <?php post_class($thesod_classes); ?>>
	</div>
<?php endif; ?>
