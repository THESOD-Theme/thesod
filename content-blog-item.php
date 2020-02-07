<?php

$thesod_blog_style = isset($thesod_blog_style) ? $thesod_blog_style : 'default';

$thesod_post_data = thesod_get_sanitize_page_title_data(get_the_ID());

$params = isset($params) ? $params : array(
	'hide_author' => 0,
	'hide_comments' => 0,
	'hide_date' => 0,
	'hide_likes' => 0,
);

if (is_archive() && (thesod_get_option('blog_hide_date_in_blog_cat'))) {
	$params =  array('hide_date' => 1);
}

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

$thesod_featured_content = thesod_get_post_featured_content(get_the_ID());
if(empty($thesod_featured_content)) {
	$thesod_classes[] = 'no-image';
}

$thesod_classes[] = 'item-animations-not-inited';

?>

<article id="post-<?php the_ID(); ?>" <?php post_class($thesod_classes); ?><?php echo (!empty($item_colors['background_color']) ? ' style="background-color: '.esc_attr($item_colors['background_color']).'"' : ''); ?>>
	<?php if(get_post_format() == 'quote' && $thesod_featured_content) : ?>
		<?php echo $thesod_featured_content; ?>
	<?php else : ?>
		<?php
		if(!is_single() && is_sticky() && !is_paged()) {
			echo '<div class="sticky-label">&#xe61a;</div>';
		}
		?>

		<div class="item-post-container">
			<div class="item-post clearfix">

				<?php if($thesod_featured_content) : ?>
					<div class="post-image"><?php echo $thesod_featured_content; ?></div>
				<?php endif; ?>

				<?php if(!empty($item_colors['background_color'])) : ?><div class="item-background-wrapper"><?php endif; ?>
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
							<?php if($thesod_categories): ?>
								<?php if(!$params['hide_author']) : ?><span class="sep"></span> <?php endif; ?><span class="post-meta-categories"><?php echo implode(' <span class="sep"></span> ', $thesod_categories_list); ?></span>
							<?php endif ?>
						</div>
					</div><!-- .entry-meta -->
				</div>

				<div class="post-title">
					<?php the_title('<'.(is_sticky() && !is_paged() ? 'h2' : 'h3').' class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark"'.(!empty($item_colors['post_title_color']) ? ' style="color: '.esc_attr($item_colors['post_title_color']).'"' : '').(!empty($item_colors['post_title_hover_color']) ? ' onmouseenter="jQuery(this).data(\'color\', this.style.color);this.style.color=\''.esc_attr($item_colors['post_title_hover_color']).'\';" onmouseleave="this.style.color=jQuery(this).data(\'color\');"' : '').'><span class="entry-title-date">'.(!$params['hide_date'] ? get_the_date('d M').': ' : '').'</span><span class="light">', '</span></a></'.(is_sticky() && !is_paged() ? 'h2' : 'h3').'>'); ?>
				</div>

				<div class="post-text"<?php echo (!empty($item_colors['post_excerpt_color']) ? ' style="color: '.esc_attr($item_colors['post_excerpt_color']).'"' : ''); ?>>
					<div class="summary">
						<?php if (!has_excerpt() && !empty( $thesod_post_data['title_excerpt'] ) ): ?>
							<?php echo $thesod_post_data['title_excerpt']; ?>
						<?php else: ?>
							<?php echo preg_replace('%&#x[a-fA-F0-9]+;%', '', apply_filters('the_excerpt', get_the_excerpt())); ?>
						<?php endif; ?>
					</div>
				</div>

				<div class="post-footer">
					<div class="post-footer-sharing"><?php thesod_button(array('icon' => 'share', 'size' => (is_sticky() && !is_paged() ? 'medium' : 'tiny'), 'background_color' => (!empty($item_colors['sharing_button_color']) ? $item_colors['sharing_button_color'] : ''), 'text_color' => (!empty($item_colors['sharing_button_icon_color']) ? $item_colors['sharing_button_icon_color'] : '')), 1); ?><div class="sharing-popup"><?php thesod_socials_sharing(); ?><svg class="sharing-styled-arrow"><use xlink:href="<?php echo esc_url(get_template_directory_uri() . '/css/post-arrow.svg'); ?>#dec-post-arrow"></use></svg></div></div>
					<div class="post-read-more"><?php thesod_button(array('href' => get_the_permalink(), 'style' => 'outline', 'text' => __('Read More', 'thesod'), 'size' => (is_sticky() && !is_paged() ? 'medium' : 'tiny')), 1); ?></div>
				</div>
				<?php if(!empty($item_colors['background_color'])) : ?></div><?php endif; ?>
			</div>
		</div>
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
