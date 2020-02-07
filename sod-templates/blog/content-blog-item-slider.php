<?php

	$thesod_slider_style = isset($thesod_slider_style) ? $thesod_slider_style : 'fullwidth';

	$thesod_post_data = thesod_get_sanitize_page_title_data(get_the_ID());

	$item_colors = isset($params['item_colors']) ? $params['item_colors'] : array();

	$params = isset($params) ? $params : array(
		'hide_author' => 0,
		'hide_comments' => 0,
		'hide_date' => 0,
	);

	$thesod_classes = array();

	if(is_sticky() && !is_paged()) {
		$thesod_classes = array_merge($thesod_classes, array('sticky'));
	}

	if(has_post_thumbnail()) {
		$thesod_classes[] = 'no-image';
	}

	$thesod_classes[] = 'clearfix';

?>

<article id="post-<?php the_ID(); ?>" <?php post_class($thesod_classes); ?>>
	<div class="sod-slider-item-image">
		<a href="<?php echo esc_url(get_permalink()); ?>"><?php thesod_post_thumbnail('thesod-blog-slider-'.$thesod_slider_style, true, 'img-responsive'); ?></a>
	</div>
	<div class="sod-slider-item-overlay"<?php echo (!empty($item_colors['background_color']) ? ' style="background-color: '.esc_attr($item_colors['background_color']).'"' : ''); ?>>
		<div class="sod-compact-item-content">
			<div class="post-title">
				<?php the_title('<h5 class="entry-title reverse-link-color"><a href="' . esc_url(get_permalink()) . '" rel="bookmark"'.(!empty($item_colors['post_title_color']) ? ' style="color: '.esc_attr($item_colors['post_title_color']).'"' : '').(!empty($item_colors['post_title_hover_color']) ? ' onmouseenter="jQuery(this).data(\'color\', this.style.color);this.style.color=\''.esc_attr($item_colors['post_title_hover_color']).'\';" onmouseleave="this.style.color=jQuery(this).data(\'color\');"' : '').'>'.(!$params['hide_date'] ? get_the_date('d M').': ' : '').'<span class="light">', '</span></a></h5>'); ?>
			</div>
			<div class="post-text date-color">
				<div class="summary"<?php echo (!empty($item_colors['post_excerpt_color']) ? ' style="color: '.esc_attr($item_colors['post_excerpt_color']).'"' : ''); ?>>
					<?php if ( !has_excerpt() && !empty( $thesod_post_data['title_excerpt'] ) ): ?>
						<?php echo wpautop($thesod_post_data['title_excerpt']); ?>
					<?php else: ?>
						<?php echo preg_replace('%&#x[a-fA-F0-9]+;%', '', apply_filters('the_excerpt', get_the_excerpt())); ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="post-meta date-color">
			<div class="entry-meta clearfix sod-post-date">
				<div class="post-meta-right">
					<?php if(comments_open() && !$params['hide_comments'] ): ?>
						<span class="comments-link"><?php comments_popup_link(0, 1, '%'); ?></span>
					<?php endif; ?>
					<?php if(comments_open() && !$params['hide_comments'] && function_exists('zilla_likes') && !$params['hide_likes']): ?><span class="sep"></span><?php endif; ?>
					<?php if( function_exists('zilla_likes') && !$params['hide_likes'] ) { echo '<span class="post-meta-likes">';zilla_likes();echo '</span>'; } ?>
				</div>
				<div class="post-meta-left">
					<?php if(!$params['hide_author']) : ?><span class="post-meta-author"><?php printf( esc_html__( "By %s", "thesod" ), get_the_author_link() ) ?></span><?php endif; ?>
				</div>
			</div><!-- .entry-meta -->
		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
