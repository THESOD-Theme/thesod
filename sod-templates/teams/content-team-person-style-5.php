<?php
	$thesod_item_data = thesod_get_sanitize_team_person_data(get_the_ID());
	$thesod_link_start = '';
	$thesod_link_end = '';
	$thesod_image_start = '';
	$thesod_image_end = '';
	if($thesod_link = thesod_get_data($thesod_item_data, 'link')) {
		$thesod_link_start = '<a class="team-person-link" href="'.esc_url($thesod_link).'" target="'.esc_attr(thesod_get_data($thesod_item_data, 'link_target')).'">';
		$thesod_link_end = '</a>';
		$thesod_image_start = '<span>';
		$thesod_image_end = '</span>';
	}
	$thesod_grid_class = '';
	if($params['columns'] == '1') {
		$thesod_grid_class = 'col-xs-12';
	} elseif($params['columns'] == '2') {
		$thesod_grid_class = 'col-sm-6 col-xs-12';
	} elseif($params['columns'] == '3') {
		$thesod_grid_class = 'col-md-4 col-sm-6 col-xs-12';
	} else {
		$thesod_grid_class = 'col-md-3 col-sm-6 col-xs-12';
	}
	$thesod_email_link = thesod_get_data($thesod_item_data, 'email', '', '<div class="team-person-email"><a '.($params['mail_color'] ? 'style="color: '.esc_attr($params['mail_color']).'"' : '').' href="mailto:', '">'.$thesod_item_data['email'].'</a></div>');
	if($thesod_item_data['hide_email']) {
		$thesod_email = explode('@', $thesod_item_data['email']);
		if(count($thesod_email) == 2) {
			$thesod_email_link = '<div class="team-person-email"><a '.($params['mail_color'] ? 'style="color: '.esc_attr($params['mail_color']).'"' : '').' href="#" class="hidden-email" data-name="'.esc_attr($thesod_email[0]).'" data-domain="'.esc_attr($thesod_email[1]).'">'.esc_html__('Send Message', 'thesod').'</a></div>';
		}
	}
	$thesod_socials_block = '';
	foreach(thesod_team_person_socials_list() as $thesod_key => $thesod_value) {
		if($thesod_item_data['social_link_'.$thesod_key]) {
			$protocol = $thesod_key === 'skype' ? array('skype') : '';
			thesod_additionals_socials_enqueue_style($thesod_key);
			$thesod_socials_block .= '<a '.($params['socials_color'] ? 'style="color: '.esc_attr($params['socials_color']).'"' : '').'  title="'.esc_attr($thesod_value).'" target="_blank" href="'.esc_url($thesod_item_data['social_link_'.$thesod_key], $protocol).'" class="socials-item"><i class="socials-item-icon social-item-rounded '.esc_attr($thesod_key).'"></i></a>';
		}
	}
	$socials_list = thesod_socials_icons_list();
	foreach($thesod_item_data['additional_social_links'] as $thesod_social) {
		$thesod_socials_block .= '<a '.($params['socials_color'] ? 'style="color: '.esc_attr($params['socials_color']).'"' : '').' title="'.esc_attr($socials_list[$thesod_social['social']]).'" target="_blank" href="'.esc_url($thesod_social['link']).'" class="socials-item"><i class="socials-item-icon social-item-rounded '.esc_attr($thesod_social['social']).'"></i></a>';
	}
?>

<div class="<?php echo esc_attr($thesod_grid_class); ?> inline-column">
	<div id="post-<?php the_ID(); ?>" <?php post_class(array('team-person', 'centered-box', 'default-background')); ?> <?php if ($params['background_color']): ?>style="background-color: <?php echo $params['background_color'] ?>"<?php endif; ?>><div class="team-person-hover">
		<?php if(has_post_thumbnail()) : ?>
			<div class="team-person-image">
				<?php
					$thesod_sources = array(
						array('srcset' => array('2x' => 'thesod-person'))
					);
					if ($params['columns'] == 4) {
						$thesod_sources = array(
							array('media' => '(max-width: 1000px)', 'srcset' => array('1x' => 'thesod-person-240', '2x' => 'thesod-person')),
							array('media' => '(max-width: 1920px)', 'srcset' => array('1x' => 'thesod-person-160', '2x' => 'thesod-person'))
						);
					}

					echo $thesod_image_start;
					echo '<span class="image-hover" '.($params['image_border_color'] ? 'style="border-color: '.esc_attr($params['image_border_color']).'"' : '').'>';
					thesod_post_picture('thesod-person', $thesod_sources, array('class' => 'img-responsive'), false);
					echo '</span>';
					echo $thesod_image_end;
				?>
			</div>
		<?php endif; ?>
		<div class="team-person-info">
			<?php echo thesod_get_data($thesod_item_data, 'name', '', '<div class="team-person-name '.(in_array($params['columns'], array(1,2)) ? 'title-h4' : 'title-h5').'" '.($params['name_color'] ? 'style="color: '.esc_attr($params['name_color']).'"' : '').'>', '</div>'); ?>
			<?php echo thesod_get_data($thesod_item_data, 'position', '', '<div class="team-person-position date-color" '.($params['position_color'] ? 'style="color: '.esc_attr($params['position_color']).'"' : '').'>', '</div>'); ?>
			<?php if(get_the_content()) : ?>
				<div class="team-person-description"<?php if ($params['desc_color']): ?> style="color: <?php echo esc_attr($params['desc_color']); ?>"<?php endif; ?>><?php the_content(); ?></div>
			<?php endif; ?>
			<?php if(!empty($thesod_item_data['phone'])) : ?>
				<div class="team-person-phone styled-subtitle"><a href="<?php echo esc_url('tel:'.$thesod_item_data['phone']); ?>"<?php echo ($params['tel_color'] ? ' style="color: '.esc_attr($params['tel_color']).'"' : ''); ?>><?php echo esc_html($thesod_item_data['phone']); ?></a></div>
			<?php endif; ?>
			<?php echo $thesod_email_link; ?>
		</div>
		<?php if($thesod_socials_block) : ?><div class="socials team-person-socials socials-colored-hover"><?php echo $thesod_socials_block; ?></div><?php endif; ?>
	</div><?php echo $thesod_link_start.$thesod_link_end; ?></div>
</div>
