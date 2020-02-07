<?php

	$thesod_post_data = thesod_get_sanitize_page_title_data(get_the_ID());

	$thesod_post_item_data = thesod_get_sanitize_post_data(get_the_ID());

	$item_colors = isset($params['item_colors']) ? $params['item_colors'] : array();

	$thesod_categories = get_the_category();
	$thesod_categories_list = array();
	foreach($thesod_categories as $thesod_category) {
		$thesod_categories_list[] = '<a href="'.esc_url(get_category_link( $thesod_category->term_id )).'" title="'.esc_attr( sprintf( __( "View all posts in %s", "thesod" ), $thesod_category->name ) ).'">'.$thesod_category->cat_name.'</a>';
	}

	$thesod_classes = array();

	if(is_sticky() && !is_paged()) {
		$thesod_classes = array_merge($thesod_classes, array('sticky', 'default-background'));
	}

	$has_content_gallery = get_post_format(get_the_ID()) == 'gallery';
	$thesod_post_sources = array();
	if (has_post_thumbnail() && !$has_content_gallery) {
		if (is_active_sidebar('page-sidebar')) {
			$thesod_post_sources = array(
				array('media' => '(min-width: 992px) and (max-width: 1080px)', 'srcset' => array('1x' => 'thesod-blog-default-small', '2x' => 'thesod-blog-default-large')),
				array('media' => '(max-width: 992px), (min-width: 1080px) and (max-width: 1920px)', 'srcset' => array('1x' => 'thesod-blog-default-medium', '2x' => 'thesod-blog-default-large'))
			);
		} else {
			$thesod_post_sources = array(
				array('media' => '(max-width: 1075px)', 'srcset' => array('1x' => 'thesod-blog-default-medium', '2x' => 'thesod-blog-default-large')),
				array('media' => '(max-width: 1920px)', 'srcset' => array('1x' => 'thesod-blog-default-large', '2x' => 'thesod-blog-default-large')),
			);
		}
	}

	$thesod_featured_content = thesod_get_post_featured_content(get_the_ID(), $has_content_gallery ? 'thesod-blog-multi-author' : 'thesod-blog-default-large', false, $thesod_post_sources);
	if(empty($thesod_featured_content)) {
		$thesod_classes[] = 'no-image';
	}

	$thesod_classes[1] = '';

	$thesod_link = get_permalink();

	$thesod_user_id = get_post(get_the_ID());
	$thesod_post_author_id = $thesod_user_id->post_author;

	$thesod_classes[] = 'item-animations-not-inited';

	if(!empty($item_colors['time_line_color'])) {
		$thesod_classes[] = 'custom-vertical-line';
	}
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class($thesod_classes); ?>>
		<?php if(!empty($item_colors['time_line_color'])) : ?><div class="vertical-line" style="background-color: <?php echo $item_colors['time_line_color']; ?>"></div><?php endif; ?>
		<div class="item-post-container">
			<div class="post-item clearfix"<?php echo (!empty($item_colors['background_color']) ? ' style="background-color: '.esc_attr($item_colors['background_color']).'"' : ''); ?>>
				<?php
					if(!is_single() && is_sticky()) {
						echo '<div class="sticky-label">&#xe61a;</div>';
					}
				?>
				<div class="post-info-wrap">
					<div class="post-info">
						<div class="post-avatar"<?php echo (!empty($item_colors['time_line_color']) ? ' style="border-color: '.esc_attr($item_colors['time_line_color']).'"' : ''); ?>><?php echo get_avatar($thesod_post_author_id, 128) ?></div>
						<div class="post-date-wrap"<?php echo (!empty($item_colors['time_line_color']) ? ' style="background-color: '.esc_attr($item_colors['time_line_color']).'"' : ''); ?>>
							<div class="post-time"<?php echo (!empty($item_colors['time_color']) ? ' style="color: '.esc_attr($item_colors['time_color']).'"' : ''); ?>><?php echo get_the_date('H:i') ?></div>
							<div class="post-date"<?php echo (!empty($item_colors['date_color']) ? ' style="color: '.esc_attr($item_colors['date_color']).'"' : ''); ?>><?php echo get_the_date('d M') ?></div>
						</div>
					</div>
				</div>
				<svg class="wrap-style"<?php echo (!empty($item_colors['background_color']) ? ' style="fill: '.esc_attr($item_colors['background_color']).'"' : ''); ?>>
					<use xlink:href="<?php echo esc_url(get_template_directory_uri() . '/css/post-arrow.svg'); ?>#dec-post-arrow"></use>
				</svg>
				<div class="post-text-wrap">
					<?php if($thesod_featured_content): ?>
						<div class="post-image"><?php echo $thesod_featured_content; ?></div>
					<?php endif; ?>
					<div class="post-meta date-color">
						<div class="entry-meta clearfix sod-post-date">
							<div class="post-meta-left">
								<span class="post-meta-author"><?php printf( esc_html__( "By %s", "thesod" ), get_the_author_link() ) ?></span>
								<?php if($thesod_categories): ?>
									<span class="sep"></span><span class="post-meta-categories"><?php echo implode(' <span class="sep"></span> ', $thesod_categories_list); ?></span>
								<?php endif ?>
							</div>
							<div class="post-meta-right">
							<?php if(comments_open()): ?>
								<span class="comments-link"><?php comments_popup_link(0, 1, '%'); ?></span>
							<?php endif; ?>
							<?php if(comments_open() && function_exists('zilla_likes')): ?><span class="sep"></span><?php endif; ?>
							<?php if( function_exists('zilla_likes') ) { echo '<span class="post-meta-likes">';zilla_likes();echo '</span>'; } ?>
							</div>
						</div><!-- .entry-meta -->
					</div>
					<div class="post-title"><?php the_title('<'.(is_sticky() && !is_paged() ? 'h2' : 'h3').' class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark"'.(!empty($item_colors['post_title_color']) ? ' style="color: '.esc_attr($item_colors['post_title_color']).'"' : '').(!empty($item_colors['post_title_hover_color']) ? ' onmouseenter="jQuery(this).data(\'color\', this.style.color);this.style.color=\''.esc_attr($item_colors['post_title_hover_color']).'\';" onmouseleave="this.style.color=jQuery(this).data(\'color\');"' : '').'>'.get_the_date('d M').': <span class="light">', '</span></a></'.(is_sticky() && !is_paged() ? 'h2' : 'h3').'>'); ?></div>
					<div class="post-content"<?php echo (!empty($item_colors['post_excerpt_color']) ? ' style="color: '.esc_attr($item_colors['post_excerpt_color']).'"' : ''); ?>>
						<div class="summary">
							<?php if ( !has_excerpt() && !empty( $thesod_post_data['title_excerpt'] ) ): ?>
								<?php echo $thesod_post_data['title_excerpt']; ?>
							<?php else: ?>
								<?php echo preg_replace('%&#x[a-fA-F0-9]+;%', '', apply_filters('the_excerpt', get_the_excerpt())); ?>
							<?php endif; ?>
						</div>
					</div>
					<div class="post-misc">
						<div class="post-links">
							<div class="post-footer-sharing"><?php thesod_button(array('icon' => 'share', 'size' => (is_sticky() && !is_paged() ? 'medium' : 'tiny'), 'background_color' => (!empty($item_colors['sharing_button_color']) ? $item_colors['sharing_button_color'] : ''), 'text_color' => (!empty($item_colors['sharing_button_icon_color']) ? $item_colors['sharing_button_icon_color'] : '')), 1); ?><div class="sharing-popup"><?php thesod_socials_sharing(); ?><svg class="sharing-styled-arrow"><use xlink:href="<?php echo esc_url(get_template_directory_uri() . '/css/post-arrow.svg'); ?>#dec-post-arrow"></use></svg></div></div>
							<div class="post-read-more"><?php thesod_button(array('href' => get_the_permalink(), 'style' => 'outline', 'text' => __('Read More', 'thesod'), 'size' => (is_sticky() && !is_paged() ? 'medium' : 'tiny')), 1); ?></div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</article><!-- #post-<?php the_ID(); ?> -->
