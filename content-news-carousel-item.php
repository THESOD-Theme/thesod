<?php

$thesod_classes = array('sod-news-item');

if ($params['effects_enabled'])
	$thesod_classes[] = 'lazy-loading-item';

?>
<article id="post-<?php the_ID(); ?>" <?php post_class($thesod_classes); ?> <?php if(!empty($params['effects_enabled'])): ?>data-ll-effect="drop-bottom"<?php endif; ?> >
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
				<?php if( function_exists('zilla_likes') ) { echo '<span class="post-meta-likes">';zilla_likes();echo '</span>'; } ?>
				<?php if(comments_open()): ?>
					<span class="comments-link"><?php comments_popup_link(0, 1, '%'); ?></span>
				<?php endif; ?>
			</div>
		</div>

	</div>


</article>