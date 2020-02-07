<?php
	$thesod_item = get_post($attachment_id);

	if (!$thesod_item) {
		return;
	}

	$thesod_highlight = (bool) get_post_meta($thesod_item->ID, 'highlight', true);
	$thesod_highligh_type = get_post_meta($thesod_item->ID, 'highligh_type', true);
	if (!$thesod_highligh_type) {
		$thesod_highligh_type = 'squared';
	}
	$thesod_attachment_link = get_post_meta($thesod_item->ID, 'attachment_link', true);
	$thesod_single_icon = true;

	if (!empty($thesod_attachment_link)) {
		$thesod_single_icon = false;
	}

	if ($params['type'] == 'grid') {
		$thesod_size = 'thesod-gallery-justified';
		if ($thesod_highlight) {
			$thesod_size = 'thesod-gallery-justified-double';
			if ($params['layout'] == '4x')
				$thesod_size = 'thesod-gallery-justified-double-4x';
		}
		if ($params['style'] == 'masonry')
			if ($thesod_highlight)
				$thesod_size = 'thesod-gallery-masonry-double';
			else
				$thesod_size = 'thesod-gallery-masonry';

		if ($params['layout'] == '100%')
			$thesod_size .= '-100';

		if ($params['style'] == 'metro')
			$thesod_size = 'thesod-gallery-metro';

		if ($thesod_highlight && $params['style'] != 'metro' && $thesod_highligh_type != 'squared') {
			$thesod_size .= '-' . $thesod_highligh_type;
		}
		if ($params['layout'] == '2x') {
			$thesod_size = 'thesod-gallery-' . $params['style'];
		}
	} else {
		$thesod_size = 'thesod-container';
		$thesod_thumb_image_url = wp_get_attachment_image_src($thesod_item->ID, 'thesod-post-thumb');
	}

	$thesod_full_image_url = wp_get_attachment_image_src($thesod_item->ID, 'full');

	$thesod_classes = array('gallery-item');

	if ($params['type'] == 'grid' && $params['style'] != 'metro' && $params['layout'] == '2x') {
		$thesod_classes = array_merge($thesod_classes, array('col-lg-6', 'col-md-6', 'col-sm-6', 'col-xs-12'));
	}

	if ($params['type'] == 'grid' && $params['style'] != 'metro' && $params['layout'] == '3x') {
		if ($thesod_highlight && $thesod_highligh_type != 'vertical')
			$thesod_classes = array_merge($thesod_classes, array('col-lg-8', 'col-md-8', 'col-sm-12', 'col-xs-12'));
		else
			$thesod_classes = array_merge($thesod_classes, array('col-lg-4', 'col-md-4', 'col-sm-6', 'col-xs-6'));
	}

	if ($params['type'] == 'grid' && $params['style'] != 'metro' && $params['layout'] == '4x') {
		if ($thesod_highlight && $thesod_highligh_type != 'vertical')
			$thesod_classes = array_merge($thesod_classes, array('col-lg-6', 'col-md-6', 'col-sm-8', 'col-xs-12'));
		else
			$thesod_classes = array_merge($thesod_classes, array('col-lg-3', 'col-md-3', 'col-sm-4', 'col-xs-6'));
	}

	if ($params['type'] == 'grid' && $params['style'] != 'metro' && $thesod_highlight)
		$thesod_classes[] = 'double-item';

	if ($params['type'] == 'grid' && $params['style'] != 'metro' && $thesod_highlight && $thesod_highligh_type != 'squared') {
		$thesod_classes[] = 'double-item-' . $thesod_highligh_type;
	}

	$thesod_wrap_classes = $params['item_style'];

	if ($params['type'] == 'grid')
		$thesod_classes[] = 'item-animations-not-inited';

	$thesod_sources = array();

	if ($params['type'] == 'grid') {
		if ($params['style'] == 'metro') {
			$thesod_sources = array(
				array('media' => '(min-width: 550px) and (max-width: 1100px)', 'srcset' => array('1x' => 'thesod-gallery-metro-medium', '2x' => 'thesod-gallery-metro-retina'))
			);
		}

		if (!$thesod_highlight) {
			$retina_size = $params['style'] == 'justified' ? $thesod_size : 'thesod-gallery-masonry-double';

			if ($params['layout'] == '100%') {
				if ($params['style'] == 'justified' || $params['style'] == 'masonry') {
					switch ($params['fullwidth_columns']) {
						case '4':
							$thesod_sources = array(
								array('media' => '(max-width: 550px)', 'srcset' => array('1x' => 'thesod-gallery-' . $params['style'] . '-2x-500', '2x' => $retina_size)),
								array('media' => '(max-width: 992px)', 'srcset' => array('1x' => 'thesod-gallery-' . $params['style'] . '-fullwidth-5x', '2x' => $retina_size)),
								array('media' => '(max-width: 1032px)', 'srcset' => array('1x' => 'thesod-gallery-' . $params['style'] . '-4x-small', '2x' => $retina_size)),
								array('media' => '(max-width: 1180px)', 'srcset' => array('1x' => 'thesod-gallery-' . $params['style'] . '-4x', '2x' => $retina_size)),
								array('media' => '(max-width: 1280px)', 'srcset' => array('1x' => 'thesod-gallery-' . $params['style'] . '-5x', '2x' => $retina_size)),
								array('media' => '(max-width: 1495px)', 'srcset' => array('1x' => 'thesod-gallery-' . $params['style'] . '-fullwidth-5x', '2x' => $retina_size)),
								array('media' => '(max-width: 1575px)', 'srcset' => array('1x' => 'thesod-gallery-' . $params['style'] . '-3x', '2x' => $retina_size)),
								array('media' => '(max-width: 1920px)', 'srcset' => array('1x' => 'thesod-gallery-' . $params['style'] . '-fullwidth-4x', '2x' => $retina_size)),
							);
							break;

						case '5':
							$thesod_sources = array(
								array('media' => '(max-width: 550px)', 'srcset' => array('1x' => 'thesod-gallery-' . $params['style'] . '-2x-500', '2x' => $retina_size)),
								array('media' => '(min-width: 992px) and (max-width: 1175px)', 'srcset' => array('1x' => 'thesod-gallery-' . $params['style'] . '-4x', '2x' => $retina_size)),
								array('media' => '(min-width: 1495px) and (max-width: 1680px)', 'srcset' => array('1x' => 'thesod-gallery-' . $params['style'] . '-fullwidth-4x', '2x' => $retina_size)),
								array('media' => '(max-width: 1920px)', 'srcset' => array('1x' => 'thesod-gallery-' . $params['style'] . '-fullwidth-5x', '2x' => $retina_size))
							);
							break;
					}
				}
			} else {
				if ($params['style'] == 'justified' || $params['style'] == 'masonry') {
					switch ($params['layout']) {
						case '2x':
							$thesod_sources = array(
								array('media' => '(max-width: 550px)', 'srcset' => array('1x' => 'thesod-gallery-' . $params['style'] . '-2x-500', '2x' => $retina_size)),
								array('media' => '(max-width: 1920px)', 'srcset' => array('1x' => 'thesod-gallery-' . $params['style'] . '-2x', '2x' => $retina_size))
							);
							break;

						case '3x':
							$thesod_sources = array(
								array('media' => '(max-width: 550px)', 'srcset' => array('1x' => 'thesod-gallery-' . $params['style'] . '-2x-500', '2x' => $retina_size)),
								array('media' => '(max-width: 1920px)', 'srcset' => array('1x' => 'thesod-gallery-' . $params['style'] . '-3x', '2x' => $retina_size))
							);
							break;

						case '4x':
							$thesod_sources = array(
								array('media' => '(max-width: 550px)', 'srcset' => array('1x' => 'thesod-gallery-' . $params['style'] . '-2x-500', '2x' => $retina_size)),
								array('media' => '(max-width: 1100px)', 'srcset' => array('1x' => 'thesod-gallery-' . $params['style'] . '-3x', '2x' => $retina_size)),
								array('media' => '(max-width: 1920px)', 'srcset' => array('1x' => 'thesod-gallery-' . $params['style'] . '-4x', '2x' => $retina_size))
							);
							break;
					}
				}
			}
		} else {
			$retina_size = $thesod_size;
			if ($params['layout'] == '100%') {
				if ($params['style'] == 'justified' || $params['style'] == 'masonry') {
					switch ($params['fullwidth_columns']) {
						case '4':
							$thesod_sources = array(
								array('media' => '(max-width: 700px),(min-width: 825px) and (max-width: 992px),(min-width: 1095px) and (max-width: 1495px)', 'srcset' => array('1x' => 'thesod-gallery-' . $params['style'] . '-double-100-' . $thesod_highligh_type . '-5', '2x' => $retina_size)),
								array('media' => '(min-width: 700px) and (max-width: 825px),(min-width: 992px) and (max-width: 1095px)', 'srcset' => array('1x' => 'thesod-gallery-' . $params['style'] . '-double-100-' . $thesod_highligh_type . '-6', '2x' => $retina_size)),
								array('media' => '(max-width: 1920px)', 'srcset' => array('1x' => 'thesod-gallery-' . $params['style'] . '-double-100-' . $thesod_highligh_type . '-4', '2x' => $retina_size))
							);
							break;

						case '5':
							$thesod_sources = array(
								array('media' => '(max-width: 700px),(min-width: 825px) and (max-width: 992px),(min-width: 1095px) and (max-width: 1495px),(max-width: 1920px)', 'srcset' => array('1x' => 'thesod-gallery-' . $params['style'] . '-double-100-' . $thesod_highligh_type . '-5', '2x' => $retina_size)),
								array('media' => '(min-width: 700px) and (max-width: 825px),(min-width: 992px) and (max-width: 1095px)', 'srcset' => array('1x' => 'thesod-gallery-' . $params['style'] . '-double-100-' . $thesod_highligh_type . '-6', '2x' => $retina_size)),
								array('media' => '(max-width: 1680px)', 'srcset' => array('1x' => 'thesod-gallery-' . $params['style'] . '-double-100-' . $thesod_highligh_type . '-4', '2x' => $retina_size)),
							);
							break;
					}
				}
			} else {
				if ($params['style'] == 'justified' || $params['style'] == 'masonry') {
					switch ($params['layout']) {
						case '2x':
							$thesod_sources = array(
								array('media' => '(max-width: 550px)', 'srcset' => array('1x' => 'thesod-gallery-' . $params['style'] . '-2x-500', '2x' => $retina_size)),
								array('media' => '(max-width: 1920px)', 'srcset' => array('1x' => 'thesod-gallery-' . $params['style'] . '-2x', '2x' => $retina_size))
							);
							break;

						case '4x':
							$thesod_sources = array(
								array('media' => '(max-width: 550px)', 'srcset' => array('1x' => 'thesod-gallery-' . $params['style'] . '-double-4x', '2x' => $retina_size)),
								array('media' => '(max-width: 1920px)', 'srcset' => array('1x' => 'thesod-gallery-' . $params['style'] . '-double-4x-' . $thesod_highligh_type, '2x' => $retina_size))
							);
							break;
					}
				}
			}
		}
	}


?>





<li
	<?php if ($params['gaps_size']): ?>style="padding: <?php echo($params['gaps_size'] / 2);?>px"<?php endif;?>

	<?php post_class($thesod_classes); ?>>
	<div class="wrap <?php if($params['type'] == 'grid' && $params['item_style'] != ''): ?> sod-wrapbox-style-<?php echo esc_attr($thesod_wrap_classes); ?><?php endif; ?>">
		<?php if($params['type'] == 'grid' && $params['item_style'] == '11'): ?>
			<div class="sod-wrapbox-inner"><div class="shadow-wrap">
		<?php endif; ?>
		<div class="overlay-wrap">
			<div class="image-wrap <?php if($params['type'] == 'grid' && $params['item_style'] == '11'): ?>img-circle<?php endif; ?>">
				<?php
					$thesod_attrs = array('alt' => get_post_meta($thesod_item->ID, '_wp_attachment_image_alt', true));
					if ($params['type'] == 'slider') {
						$thesod_attrs['data-thumb-url'] = esc_url($thesod_thumb_image_url[0]);
					}
					thesod_generate_picture($thesod_item->ID, $thesod_size, $thesod_sources, $thesod_attrs);
				?>
			</div>
			<div class="overlay <?php if($params['type'] == 'grid' && $params['item_style'] == '11'): ?>img-circle<?php endif; ?>">
				<div class="overlay-circle"></div>
				<?php if($thesod_single_icon): ?>
					<a href="<?php echo esc_url($thesod_full_image_url[0]); ?>" class="gallery-item-link fancy-gallery" data-fancybox="gallery-<?php echo esc_attr($gallery_uid); ?>">
						<span class="slide-info">
							<?php if(!empty($thesod_item->post_excerpt)) : ?>
								<span class="slide-info-title">
									<?php echo $thesod_item->post_excerpt; ?>
								</span>
								<?php if(!empty($thesod_item->post_content)) : ?>
									<span class="slide-info-summary">
										<?php echo $thesod_item->post_content; ?>
									</span>
								<?php endif; ?>
							<?php endif; ?>
						</span>
					</a>
				<?php endif; ?>
				<div class="overlay-content">
					<div class="overlay-content-center">
						<div class="overlay-content-inner">
							<a href="<?php echo esc_url($thesod_full_image_url[0]); ?>" class="icon photo <?php if(!$thesod_single_icon): ?>fancy-gallery<?php endif; ?>" <?php if(!$thesod_single_icon): ?>data-fancybox="gallery-<?php echo esc_attr($gallery_uid); ?>"<?php endif; ?> >

								<?php if(!$thesod_single_icon): ?>
									<span class="slide-info">
										<?php if(!empty($thesod_item->post_excerpt)) : ?>
											<span class="slide-info-title ">
												<?php echo $thesod_item->post_excerpt; ?>
											</span>
											<?php if(!empty($thesod_item->post_content)) : ?>
												<span class="slide-info-summary">
													<?php echo $thesod_item->post_content; ?>
												</span>
											<?php endif; ?>
										<?php endif; ?>
									</span>
								<?php endif; ?>
							</a>

							<?php if (!empty($thesod_attachment_link)): ?>
								<a href="<?php echo esc_url($thesod_attachment_link); ?>" target="_blank" class="icon link"></a>
							<?php endif; ?>
							<div class="overlay-line"></div>
							<?php if(!empty($thesod_item->post_excerpt)) : ?>
								<div class="title">
									<?php echo $thesod_item->post_excerpt; ?>
								</div>
							<?php endif; ?>
							<?php if(!empty($thesod_item->post_content)) : ?>
								<div class="subtitle">
									<?php echo $thesod_item->post_content; ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php if($params['type'] == 'grid' && $params['item_style'] == '11'): ?>
			</div></div>
		<?php endif; ?>
	</div>
	<?php if ($params['style']  == 'metro' &&  $params['item_style']):?><?php endif;?>
</li>
