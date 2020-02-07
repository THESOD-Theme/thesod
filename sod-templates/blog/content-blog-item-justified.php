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
	$has_content_gallery = get_post_format(get_the_ID()) == 'gallery';

	if(is_sticky() && !is_paged()) {
		$thesod_classes = array_merge($thesod_classes, array('sticky'));
		$thesod_featured_content = thesod_get_post_featured_content(get_the_ID(), 'thesod-blog-justified-sticky');
	} else {
		$thesod_post_gallery_size = 'thesod-blog-justified';
		if ($has_content_gallery) {
			if ($blog_style == 'justified-2x') {
				$thesod_post_gallery_size = 'thesod-blog-justified-2x';
			} elseif ($blog_style == 'justified-3x') {
				$thesod_post_gallery_size = 'thesod-blog-justified-3x';
			} elseif ($blog_style == 'justified-4x') {
				$thesod_post_gallery_size = 'thesod-blog-justified-4x';
			}
		}

		if (has_post_thumbnail() && !$has_content_gallery) {
			if ($blog_style == 'justified-2x') {
				$thesod_sources = array(
					array('media' => '(max-width: 992px)', 'srcset' => array('1x' => 'thesod-blog-justified', '2x' => 'thesod-blog-justified')),
					array('media' => '(max-width: 1100px)', 'srcset' => array('1x' => 'thesod-blog-justified-3x-small', '2x' => 'thesod-blog-justified')),
					array('media' => '(max-width: 1920px)', 'srcset' => array('1x' => 'thesod-blog-justified-3x', '2x' => 'thesod-blog-justified'))
				);
			} elseif ($blog_style == 'justified-3x') {
				$thesod_sources = array(
					array('media' => '(max-width: 992px)', 'srcset' => array('1x' => 'thesod-blog-justified', '2x' => 'thesod-blog-justified')),
					array('media' => '(max-width: 1100px)', 'srcset' => array('1x' => 'thesod-blog-justified-3x-small', '2x' => 'thesod-blog-justified')),
					array('media' => '(max-width: 1920px)', 'srcset' => array('1x' => 'thesod-blog-justified-3x', '2x' => 'thesod-blog-justified'))
				);
			} elseif ($blog_style == 'justified-4x') {
				$thesod_sources = array(
					array('media' => '(max-width: 600px)', 'srcset' => array('1x' => 'thesod-blog-justified', '2x' => 'thesod-blog-justified')),
					array('media' => '(max-width: 992px)', 'srcset' => array('1x' => 'thesod-blog-justified-4x', '2x' => 'thesod-blog-justified')),
					array('media' => '(max-width: 1125px)', 'srcset' => array('1x' => 'thesod-blog-justified-3x-small', '2x' => 'thesod-blog-justified')),
					array('media' => '(max-width: 1920px)', 'srcset' => array('1x' => 'thesod-blog-justified-4x', '2x' => 'thesod-blog-justified'))
				);
			}
		}

		$thesod_featured_content = thesod_get_post_featured_content(get_the_ID(), $has_content_gallery ? $thesod_post_gallery_size : 'thesod-blog-justified', false, $thesod_sources);
	}

	if ($blog_style == 'justified-2x'){
		if (is_sticky() && !is_paged())
			$thesod_classes = array_merge($thesod_classes, array('col-lg-12', 'col-md-12', 'col-sm-12', 'col-xs-12', 'inline-column'));
		else
			$thesod_classes = array_merge($thesod_classes, array('col-lg-6', 'col-md-6', 'col-sm-6', 'col-xs-12', 'inline-column'));
	} elseif ($blog_style == 'justified-3x'){
		if (is_sticky() && !is_paged())
			$thesod_classes = array_merge($thesod_classes, array('col-lg-8', 'col-md-8', 'col-sm-6', 'col-xs-12', 'inline-column'));
		else
			$thesod_classes = array_merge($thesod_classes, array('col-lg-4', 'col-md-4', 'col-sm-6', 'col-xs-6', 'inline-column'));
	} elseif ($blog_style == 'justified-4x'){
		if (is_sticky() && !is_paged())
			$thesod_classes = array_merge($thesod_classes, array('col-lg-6', 'col-md-6', 'col-sm-12', 'col-xs-12', 'inline-column'));
		else
			$thesod_classes = array_merge($thesod_classes, array('col-lg-3', 'col-md-3', 'col-sm-6', 'col-xs-6', 'inline-column'));
	}

	if(is_sticky() && !is_paged() && empty($thesod_featured_content)) {
		$thesod_classes[] = 'no-image';
	}

	$thesod_classes[] = 'item-animations-not-inited';

	if (!empty($item_colors['justified_background_transparent'])) {
		$thesod_classes = array_merge($thesod_classes, array('item-transparent-background'));
		$item_colors['background_color'] = 'transparent';
	}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class($thesod_classes); ?>>
	<?php if(get_post_format() == 'quote' && $thesod_featured_content) : ?>
		<?php echo $thesod_featured_content; ?>
	<?php else : ?>
		<div class="post-content-wrapper" style="<?php echo (!empty($item_colors['background_color']) ? 'background-color: '.esc_attr($item_colors['background_color']).';' : ''); ?><?php echo (!empty($item_colors['border_color']) ? 'border-color: '.esc_attr($item_colors['border_color']).';' : ''); ?>">
		<?php
			if(!is_single() && is_sticky() && !is_paged()) {
				echo '<div class="sticky-label">&#xe61a;</div>';
			}
		?>
		<?php if($thesod_featured_content): ?>
			<div class="post-image"><?php echo $thesod_featured_content; ?></div>
		<?php endif; ?>
		<div class="description">
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
				<?php the_title('<div class="entry-title title-h4"><a href="' . esc_url(get_permalink()) . '" rel="bookmark"'.(!empty($item_colors['post_title_color']) ? ' style="color: '.esc_attr($item_colors['post_title_color']).(!empty($item_colors['post_title_hover_color']) ? ' onmouseenter="jQuery(this).data(\'color\', this.style.color);this.style.color=\''.esc_attr($item_colors['post_title_hover_color']).'\';" onmouseleave="this.style.color=jQuery(this).data(\'color\');"' : '').'"' : '').'>'.(!$params['hide_date'] ? get_the_date('d M').': ' : '').'<span class="light">', '</span></a></div>'); ?>
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
	</div>
<?php endif; ?>
</article>
