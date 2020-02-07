<?php
$thesod_item_data = thesod_get_sanitize_client_data(get_the_ID());
$thesod_item_data['link'] = $thesod_item_data['link'] ? $thesod_item_data['link'] : '#';
$thesod_classes = array('sod-client-item');
if (!empty($params['effects_enabled'])) {
	$thesod_classes[] = 'lazy-loading-item';
}

?>

<div id="post-<?php the_ID(); ?>" <?php post_class($thesod_classes); ?> <?php if(!$params['widget']) : ?>style="width: <?php echo esc_attr(100/$cols); ?>%;"<?php endif; ?> <?php if(!empty($params['effects_enabled'])): ?>data-ll-effect="drop-bottom"<?php endif; ?>>
	<a href="<?php echo esc_url($thesod_item_data['link']); ?>" target="<?php echo esc_attr($thesod_item_data['link_target']); ?>" class="gscale">
		<?php
		if($params['widget']) {
			$thesod_small_image_url = thesod_generate_thumbnail_src(get_post_thumbnail_id(), 'thesod-widget-column-1x');
			$thesod_small_image_url_2x = thesod_generate_thumbnail_src(get_post_thumbnail_id(), 'thesod-widget-column-2x');
			echo '<img src="'.esc_url($thesod_small_image_url[0]).'" srcset="'.esc_attr($thesod_small_image_url_2x[0]).' 2x" width="'.esc_attr($thesod_small_image_url[1]).'" alt="'.get_the_title().'" class="img-responsive"/>';
		} else {
			thesod_post_thumbnail('thesod-person', true, 'img-responsive');
		}
		?>
	</a>
</div>