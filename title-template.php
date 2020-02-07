<?php
	global $thesod_page_title_template_data;
	$thesod_use_custom = get_post($thesod_page_title_template_data['title_template']);
	$thesod_q = new WP_Query(array('p' => $thesod_page_title_template_data['title_template'], 'post_type' => 'thesod_title', 'post_status' => 'private'));
?>
<div id="page-title" class="page-title-block custom-page-title">
	<div class="container">
		<?php if($thesod_page_title_template_data['title_template'] && $thesod_use_custom && $thesod_q->have_posts()) : $thesod_q->the_post(); ?>
			<?php the_content(); ?>
		<?php wp_reset_postdata(); endif; ?>
	</div>
	<div class="page-title-alignment-<?php echo $thesod_page_title_template_data['title_alignment']; ?>"><?php echo $thesod_page_title_template_data['breadcrumbs_output']; ?></div>
</div>