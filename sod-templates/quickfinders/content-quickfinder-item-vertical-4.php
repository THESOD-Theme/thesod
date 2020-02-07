<?php
	$params = empty($params) ? array() : $params;
	$params = array_merge(array(
		'box_border_color' => '',
	), $params);
	$thesod_item_data = thesod_get_sanitize_qf_item_data(get_the_ID());

	$thesod_quickfinder_effect = 'quickfinder-item-effect-';
	if($thesod_item_data['icon_border_color'] && $thesod_item_data['icon_background_color']) {
		$thesod_quickfinder_effect .= 'border-reverse border-reverse-with-background';
	} elseif($thesod_item_data['icon_border_color']) {
		$thesod_quickfinder_effect .= 'border-reverse';
	} elseif($thesod_item_data['icon_background_color']) {
		$thesod_quickfinder_effect .= 'background-reverse';
	} else {
		$thesod_quickfinder_effect .= 'scale';
	}

	if(!$thesod_item_data['icon'] && has_post_thumbnail()) {
		$thesod_quickfinder_effect = 'quickfinder-item-effect-image-scale';
	}

	$thesod_icon_shortcode = thesod_build_icon_shortcode($thesod_item_data);

	$thesod_link_start = '<span class="quickfinder-item-link ' . ($thesod_item_data['icon_shape'] == 'circle' ? 'img-circle' : 'rounded-corners') .'">';
	$thesod_link_end = '</span>';
	if($thesod_link = thesod_get_data($thesod_item_data, 'link')) {
		$thesod_link_start = '<a href="'.esc_url($thesod_link).'" class="quickfinder-item-link ' . ($thesod_item_data['icon_shape'] == 'circle' ? 'img-circle' : 'rounded-corners') .'" target="'.esc_attr(thesod_get_data($thesod_item_data, 'link_target')).'">';
		$thesod_link_end = '</a>';
	}
	$thesod_title_text_color = '';
	if( !empty($thesod_item_data['title_text_color'])){
		$thesod_title_text_color = 'style="color: '. $thesod_item_data['title_text_color'] .';"';
	}
	$thesod_description_text_color = '';
	if( !empty($thesod_item_data['description_text_color'])){
		$thesod_description_text_color = 'style="color: '. $thesod_item_data['description_text_color'] .'
		;"';
	}
	if($thesod_item_data['icon_shape'] == 'hexagon'){
		switch ( $thesod_item_data['icon_size'] ) {
			case 'small':
				$thesod_border_indent = '30.5px';
				$thesod_min_height = '100px';
				break;
			case 'medium':
				$thesod_border_indent = '46.5px';
				$thesod_min_height = '150px';
				break;
			case 'large':
				$thesod_border_indent = '91.5px';
				$thesod_min_height = '270px';
				break;
			case 'xlarge':
				$thesod_border_indent = '135px';
				$thesod_min_height = '320px';
				break;
		}
	} else {
		switch ( $thesod_item_data['icon_size'] ) {
			case 'small':
				$thesod_border_indent = '26px';
				$thesod_min_height = '100px';
				break;
			case 'medium':
				$thesod_border_indent = '41.5px';
				$thesod_min_height = '150px';
				break;
			case 'large':
				$thesod_border_indent = '80.5px';
				$thesod_min_height = '270px';
				break;
			case 'xlarge':
				$thesod_border_indent = '121.5px';
				$thesod_min_height = '320px';
				break;
		}
	}

?>
<div id="post-<?php the_ID(); ?>" <?php if($params['effects_enabled']) echo ' data-ll-finish-delay="200" '; ?> <?php post_class(array( 'quickfinder-item', $quickfinder_item_rotation, $thesod_quickfinder_effect, $thesod_item_data['icon_size'], $params['effects_enabled'] ? 'lazy-loading' : '')); ?>>
	<?php if($quickfinder_style == 'vertical-4' && $quickfinder_item_rotation == 'odd') : ?>
		<div class="quickfinder-item-info-wrapper">
			<?php if($quickfinder_style == 'vertical-4') : ?>
				<div class="connector" style="border-color: <?php echo $connector_color; ?>; right: -<?php echo $thesod_border_indent;?>;"></div>

			<?php endif; ?>
			<div class="quickfinder-item-info <?php if($params['effects_enabled']): ?>lazy-loading-item<?php endif; ?>" <?php if($params['effects_enabled']): ?>data-ll-item-delay="200" data-ll-effect="fading"<?php endif; ?>>
				<div style="display: block; min-height: 250px;">
					<?php the_title('<div class="quickfinder-item-title" '. $thesod_title_text_color .'>', '</div>'); ?>
					<?php echo thesod_get_data($thesod_item_data, 'description', '', '<div class="quickfinder-item-text" '.$thesod_description_text_color.'>', '</div>'); ?>
				</div>
			</div>
			<?php if($thesod_item_data['link']) : ?>
				<a href="<?php echo esc_url($thesod_item_data['link']); ?>" target="<?php echo esc_attr($thesod_item_data['link_target']); ?>" class="quickfinder-item-link"></a>
			<?php endif; ?>
		</div>
	<?php endif; ?>

		<div class="quickfinder-item-image">
			<div class="quickfinder-item-image-content<?php if($params['effects_enabled']): ?> lazy-loading-item<?php endif; ?>" <?php if($params['effects_enabled']): ?>data-ll-item-delay="0" data-ll-effect="clip"<?php endif; ?>>
				<?php if($thesod_item_data['icon']) : ?>
					<div class="quickfinder-item-image-wrapper">
						<?php echo do_shortcode($thesod_icon_shortcode); ?>
						</div>
				<?php else : ?>
					<div class="quickfinder-item-image-wrapper quickfinder-item-picture quickfinder-item-image-shape-<?php echo $thesod_item_data['icon_shape'] ?>" style="<?php echo $thesod_icon_css_style; ?>">
						<?php thesod_post_thumbnail('thesod-person', true, ' quickfinder-img-size-'.$thesod_item_data['icon_size'], thesod_quickfinder_srcset($thesod_item_data)); ?>
					</div>
				<?php endif; ?>
				<?php if($thesod_item_data['link']) : ?>
					<a href="<?php echo esc_url($thesod_item_data['link']); ?>" target="<?php echo esc_attr($thesod_item_data['link_target']); ?>" class="quickfinder-item-link"></a>
				<?php endif; ?>
			</div>
		</div>

	<?php if($quickfinder_style != 'vertical-4' || $quickfinder_item_rotation == 'even') : ?>
		<div class="quickfinder-item-info-wrapper">
			<?php if($quickfinder_style == 'vertical-4') : ?>
				<div class="connector" style="border-color: <?php echo esc_attr($connector_color); ?>; left: -<?php echo $thesod_border_indent;?>;"></div>
			<?php endif; ?>
			<div class="quickfinder-item-info <?php if($params['effects_enabled']): ?>lazy-loading-item<?php endif; ?>" <?php if($params['effects_enabled']): ?>data-ll-item-delay="200" data-ll-effect="fading"<?php endif; ?>>
				<div style="display: block; min-height: 250px;">
				<?php the_title('<div class="quickfinder-item-title"  '.$thesod_title_text_color.'>', '</div>'); ?>
				<?php echo thesod_get_data($thesod_item_data, 'description', '', '<div class="quickfinder-item-text" '.$thesod_description_text_color.'>', '</div>'); ?>
				</div>
			</div>
			<?php if($thesod_item_data['link']) : ?>
				<a href="<?php echo esc_url($thesod_item_data['link']); ?>" target="<?php echo esc_attr($thesod_item_data['link_target']); ?>" class="quickfinder-item-link"></a>
			<?php endif; ?>
		</div>
	<?php endif; ?>
</div>
