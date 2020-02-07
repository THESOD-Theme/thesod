<?php

	$thesod_post_data = thesod_get_sanitize_page_title_data(get_the_ID());

	$item_colors = isset($params['item_colors']) ? $params['item_colors'] : array();

	$thesod_categories = get_the_category();
	$thesod_categories_list = array();
	foreach($thesod_categories as $thesod_category) {
		$thesod_categories_list[] = '<a href="'.esc_url(get_category_link( $thesod_category->term_id )).'" title="'.esc_attr( sprintf( __( "View all posts in %s", "thesod" ), $thesod_category->name ) ).'">'.$thesod_category->cat_name.'</a>';
	}

	$thesod_classes = array();
	$thesod_sources = array();
	$thesod_featured_content = '';
	$has_content_gallery = get_post_format(get_the_ID()) == 'gallery';

	if(is_sticky() && !is_paged()) {
		$thesod_classes = array_merge($thesod_classes, array('sticky'));
		$thesod_featured_content = thesod_get_post_featured_content(get_the_ID(), 'thesod-blog-masonry-sticky');
	} else {
		$thesod_post_gallery_size = 'thesod-blog-masonry';
		if ($has_content_gallery) {
			if ($blog_style == '100%') {
				$thesod_post_gallery_size = 'thesod-blog-masonry-100';
			} elseif ($blog_style == '2x') {
				$thesod_post_gallery_size = 'thesod-blog-masonry-2x';
			} elseif ($blog_style == '3x') {
				$thesod_post_gallery_size = 'thesod-blog-masonry-3x';
			} elseif ($blog_style == '4x') {
				$thesod_post_gallery_size = 'thesod-blog-masonry-4x';
			}
		}

		if (has_post_thumbnail() && !$has_content_gallery) {
			if ($blog_style == '100%') {
				$thesod_sources = array(
					array('media' => '(max-width: 600px)', 'srcset' => array('1x' => 'thesod-blog-masonry', '2x' => 'thesod-blog-masonry')),
					array('media' => '(max-width: 992px)', 'srcset' => array('1x' => 'thesod-blog-masonry-100-medium', '2x' => 'thesod-blog-masonry')),
					array('media' => '(max-width: 1100px)', 'srcset' => array('1x' => 'thesod-blog-masonry-100-small', '2x' => 'thesod-blog-masonry')),
					array('media' => '(max-width: 1920px)', 'srcset' => array('1x' => 'thesod-blog-masonry-100', '2x' => 'thesod-blog-masonry'))
				);
			} elseif ($blog_style == '2x') {
				$thesod_sources = array(
					array('media' => '(max-width: 600px)', 'srcset' => array('1x' => 'thesod-blog-masonry', '2x' => 'thesod-blog-masonry')),
					array('media' => '(max-width: 992px)', 'srcset' => array('1x' => 'thesod-blog-masonry-100-medium', '2x' => 'thesod-blog-masonry')),
					array('media' => '(max-width: 1920px)', 'srcset' => array('1x' => 'thesod-blog-masonry-100', '2x' => 'thesod-blog-masonry'))
				);
			} elseif ($blog_style == '3x') {
				$thesod_sources = array(
					array('media' => '(max-width: 600px)', 'srcset' => array('1x' => 'thesod-blog-masonry', '2x' => 'thesod-blog-masonry')),
					array('media' => '(max-width: 992px)', 'srcset' => array('1x' => 'thesod-blog-masonry-100-medium', '2x' => 'thesod-blog-masonry')),
					array('media' => '(max-width: 1920px)', 'srcset' => array('1x' => 'thesod-blog-masonry-100', '2x' => 'thesod-blog-masonry'))
				);
			} elseif ($blog_style == '4x') {
				$thesod_sources = array(
					array('media' => '(max-width: 600px)', 'srcset' => array('1x' => 'thesod-blog-masonry', '2x' => 'thesod-blog-masonry')),
					array('media' => '(max-width: 992px)', 'srcset' => array('1x' => 'thesod-blog-masonry-100-medium', '2x' => 'thesod-blog-masonry')),
					array('media' => '(max-width: 1920px)', 'srcset' => array('1x' => 'thesod-blog-masonry-4x', '2x' => 'thesod-blog-masonry'))
				);
			}
		}
		$thesod_featured_content = thesod_get_post_featured_content(get_the_ID(), $has_content_gallery ? $thesod_post_gallery_size : 'thesod-blog-masonry', false, $thesod_sources);
	}

	if(empty($thesod_featured_content)) {
		$thesod_classes[] = 'no-image';
	}

	if ($blog_style == '2x') {
		if (is_sticky() && !is_paged())
			$thesod_classes = array_merge($thesod_classes, array('col-lg-12', 'col-md-12', 'col-sm-12', 'col-xs-12'));
		else
			$thesod_classes = array_merge($thesod_classes, array('col-lg-6', 'col-md-6', 'col-sm-6', 'col-xs-12'));
	}

	if ($blog_style == '3x') {
		if (is_sticky() && !is_paged())
			$thesod_classes = array_merge($thesod_classes, array('col-lg-8', 'col-md-8', 'col-sm-6', 'col-xs-12'));
		else
			$thesod_classes = array_merge($thesod_classes, array('col-lg-4', 'col-md-4', 'col-sm-6', 'col-xs-6'));
	}

	if ($blog_style == '4x' || $blog_style == '100%') {
		if (is_sticky() && !is_paged())
			$thesod_classes = array_merge($thesod_classes, array('col-lg-6', 'col-md-6', 'col-sm-12', 'col-xs-12'));
		else
			$thesod_classes = array_merge($thesod_classes, array('col-lg-3', 'col-md-3', 'col-sm-6', 'col-xs-6'));
	}

	$thesod_classes[] = 'item-animations-not-inited';

	if (!empty($item_colors['masonsy_background_transparent'])) {
		$thesod_classes = array_merge($thesod_classes, array('item-transparent-background'));
		$item_colors['background_color'] = 'transparent';
	}

	?>

<article id="post-<?php the_ID(); ?>" <?php post_class($thesod_classes); ?>>
	<?php if (isset($params['effects_enabled']) && $params['effects_enabled']): ?>
		<div class="item-lazy-scroll-wrap">
	<?php endif; ?>

	<?php if(get_post_format() == 'quote' && $thesod_featured_content) : ?>
		<?php echo $thesod_featured_content; ?>
	<?php else : ?>
		<?php
			if(!is_single() && is_sticky() && !is_paged()) {
				echo '<div class="sticky-label">&#xe61a;</div>';
			}
		?>
		<?php if($thesod_featured_content): ?>
			<div class="post-image"><?php echo $thesod_featured_content; ?></div>
		<?php endif; ?>
		<div class="description"<?php echo (!empty($item_colors['background_color']) ? ' style="background-color: '.esc_attr($item_colors['background_color']).'"' : ''); ?>>
			<div class="post-meta-conteiner">
				<?php if(!$params['hide_author']) : ?><span class="post-meta-author"><?php printf( esc_html__( "By %s", "thesod" ), get_the_author_link() ) ?></span><?php endif; ?>

				<div class="post-meta-right">
					<?php if(comments_open() && !$params['hide_comments']) : ?>
						<span class="comments-link"><?php comments_popup_link(0, 1, '%'); ?></span>
					<?php endif; ?>
					<?php if( function_exists('zilla_likes') && !$params['hide_likes'] ) { echo '<span class="post-meta-likes">';zilla_likes();echo '</span>'; } ?>

				</div>
			</div>
			<div class="post-title">
				<?php the_title('<div class="entry-title title-h4"><a href="' . esc_url(get_permalink()) . '" rel="bookmark"'.(!empty($item_colors['post_title_color']) ? ' style="color: '.esc_attr($item_colors['post_title_color']).'"' : '').(!empty($item_colors['post_title_hover_color']) ? ' onmouseenter="jQuery(this).data(\'color\', this.style.color);this.style.color=\''.esc_attr($item_colors['post_title_hover_color']).'\';" onmouseleave="this.style.color=jQuery(this).data(\'color\');"' : '').'>'.(!$params['hide_date'] ? get_the_date('d M').': ' : '').'<span class="light">', '</span></a></div>'); ?>
			</div>

			<div class="post-text"<?php echo (!empty($item_colors['post_excerpt_color']) ? ' style="color: '.esc_attr($item_colors['post_excerpt_color']).'"' : ''); ?>>
				<div class="summary">
					<?php if ( !has_excerpt() && !empty( $thesod_post_data['title_excerpt'] ) ): ?>
						<?php echo $thesod_post_data['title_excerpt']; ?>
					<?php else: ?>
						<?php echo preg_replace('%&#x[a-fA-F0-9]+;%', '', apply_filters('the_excerpt', get_the_excerpt())); ?>
					<?php endif; ?>
				</div>
			</div>
			<div class="info clearfix">

				<div class="post-footer-sharing"><?php thesod_button(array('icon' => 'share', 'size' => (is_sticky() && !is_paged() ? 'medium' : 'tiny'), 'background_color' => (!empty($item_colors['sharing_button_color']) ? $item_colors['sharing_button_color'] : ''), 'text_color' => (!empty($item_colors['sharing_button_icon_color']) ? $item_colors['sharing_button_icon_color'] : '')), 1); ?><div class="sharing-popup"><?php thesod_socials_sharing(); ?><svg class="sharing-styled-arrow"><use xlink:href="<?php echo esc_url(get_template_directory_uri() . '/css/post-arrow.svg'); ?>#dec-post-arrow"></use></svg></div></div>

				<div class="post-read-more"><?php thesod_button(array('href' => get_the_permalink(), 'style' => 'outline', 'text' => __('Read More', 'thesod'), 'size' => (is_sticky() && !is_paged() ? 'medium' : 'tiny')), 1); ?></div>
			</div>
		</div>
	<?php endif; ?>

	<?php if (isset($params['effects_enabled']) && $params['effects_enabled']): ?>
		</div>
	<?php endif; ?>
</article>
