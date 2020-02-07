<?php

	$thesod_post_data = thesod_get_sanitize_page_title_data(get_the_ID());

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

	$thesod_classes[] = 'item-animations-not-inited';
	$thesod_classes[] = 'clearfix';

?>

<article id="post-<?php the_ID(); ?>" <?php post_class($thesod_classes); ?>>
	<div class="sod-news-item-left">
		<div class="sod-news-item-image">
			<a href="<?php echo esc_url(get_permalink()); ?>"><?php thesod_post_thumbnail('thesod-news-carousel'); ?></a>
		</div>
	</div>


	<div class="sod-news-item-right">
		<div class="sod-news-item-right-conteiner">
		<?php the_title('<div class="sod-news-item-title"><a href="'.esc_url(get_permalink()).'">', '</a></div>'); ?>

			<?php if(has_excerpt()) : ?>
				<div class='sod-news_title-excerpt'>
					<?php the_excerpt(); ?>
				</div>
			<?php else : ?>
				<div class='sod-news_title_excerpt'>
					<?php
						$thesod_item_title_data = thesod_get_sanitize_page_title_data(get_the_ID());

						echo $thesod_item_title_data['title_excerpt'];
					?>
				</div>
			<?php endif; ?>
		</div>
		<div  class="sod-news-item-meta">
			<div class="sod-news-item-date small-body"><?php echo get_the_date(); ?></div>
			<div class="sod-news-zilla-likes">
				<?php if( function_exists('zilla_likes') && !$params['hide_likes'] ) { echo '<span class="post-meta-likes">';zilla_likes();echo '</span>'; } ?>
				<?php if(comments_open() && !$params['hide_comments'] ): ?>
					<span class="comments-link"><?php comments_popup_link(0, 1, '%'); ?></span>
				<?php endif; ?>
			</div>
		</div>

	</div>
</article><!-- #post-<?php the_ID(); ?> -->
