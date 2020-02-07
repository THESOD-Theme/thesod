<?php
	$thesod_item_data = thesod_get_sanitize_testimonial_data(get_the_ID());

	$thesod_testimonial_size = 'thesod-person';
	switch ($params['image_size']) {
		case 'size-small':
			$thesod_testimonial_size .= '-80';
			break;

		case 'size-medium':
			$thesod_testimonial_size .= '-160';
			break;

		case 'size-large':
			$thesod_testimonial_size .= '-160';
			break;

		case 'size-xlarge':
			$thesod_testimonial_size .= '-240';
			break;
	}
?>

<?php

    $quote_block = '';
    if ($params['quote_color']) {
        $quote_block = '<span style="color: '.$params['quote_color'].' " class="custom-color-blockqute-mark">&#xe60c;</span>';
    }

    ?>

<div id="post-<?php the_ID(); ?>" <?php post_class('sod-testimonial-item'); ?>>
	<?php if($thesod_item_data['link']) : ?><a href="<?php echo esc_url($thesod_item_data['link']); ?>" target="<?php echo esc_attr($thesod_item_data['link_target']); ?>"><?php endif; ?>
		<div class="sod-testimonial-wrapper  <?php if($params['quote_color']) : ?> quote-color-added <?php endif; ?>">
			<div class="sod-testimonial-image">
				<?php thesod_post_thumbnail($thesod_testimonial_size, false, 'img-responsive img-circle', array('srcset' => array('2x' => 'thesod-testimonial'))); ?>
			</div>
			<div class="sod-testimonial-content">

				<?php echo thesod_get_data($thesod_item_data, 'name', '', '<div class="sod-testimonial-name" '.($params['name_color'] ? 'style="color: '.esc_attr($params['name_color']).'"' : '').'>', '</div>'); ?>
				<?php echo thesod_get_data($thesod_item_data, 'company', '', '<div class="sod-testimonial-company" '.($params['company_color'] ? 'style="color: '.esc_attr($params['company_color']).'"' : '').'>', '</div>'); ?>
				<?php echo thesod_get_data($thesod_item_data, 'position', '', '<div class="sod-testimonial-position" '.($params['position_color'] ? 'style="color: '.esc_attr($params['position_color']).'"' : '').'>', '</div>'); ?>

				<div class="sod-testimonial-text" <?php if($params['text_color']) : ?>style="color: <?php echo $params['text_color'] ?>"<?php endif; ?>>
					<?php the_content(); ?>
                    <?php if($params['style'] == 'style2' ) {echo $quote_block;}?>

                </div>
			</div>
            <?php if($params['style'] == 'style1' ) {echo $quote_block;}?>

	</div>

	<?php if($thesod_item_data['link']) : ?></a><?php endif; ?>
</div>

