<?php
/**
 * The template used for displaying page content on home page
 */

$thesod_page_data = array(
	'title' => thesod_get_sanitize_page_title_data(get_the_ID()),
	'effects' => thesod_get_sanitize_page_effects_data(get_the_ID()),
	'slideshow' => thesod_get_sanitize_page_slideshow_data(get_the_ID()),
	'sidebar' => thesod_get_sanitize_page_sidebar_data(get_the_ID())
);
if ($thesod_page_data['effects']['effects_page_scroller']) {
	wp_enqueue_script('thesod-page-scroller');
	$thesod_page_data['effects']['effects_no_bottom_margin'] = true;
	$thesod_page_data['effects']['effects_no_top_margin'] = true;
}
$thesod_no_margins_block = '';
if ($thesod_page_data['effects']['effects_no_bottom_margin']) {
	$thesod_no_margins_block .= ' no-bottom-margin';
}
if ($thesod_page_data['effects']['effects_no_top_margin']) {
	$thesod_no_margins_block .= ' no-top-margin';
}

$thesod_panel_classes = array('panel', 'row');
$thesod_center_classes = 'panel-center';
$thesod_sidebar_classes = '';
if (is_active_sidebar('page-sidebar') && $thesod_page_data['sidebar']['sidebar_position']) {
	$thesod_panel_classes[] = 'panel-sidebar-position-' . $thesod_page_data['sidebar']['sidebar_position'];
	$thesod_panel_classes[] = 'with-sidebar';
	$thesod_center_classes .= ' col-lg-9 col-md-9 col-sm-12';
	if ($thesod_page_data['sidebar']['sidebar_position'] == 'left') {
		$thesod_center_classes .= ' col-md-push-3 col-sm-push-0';
		$thesod_sidebar_classes .= ' col-md-pull-9 col-sm-pull-0';
	}
} else {
	$thesod_center_classes .= ' col-xs-12';
}
if ($thesod_page_data['sidebar']['sidebar_sticky']) {
	$thesod_panel_classes[] = 'panel-sidebar-sticky';
	wp_enqueue_script('thesod-sticky');
}
$thesod_pf_data = array();
if (get_post_type() == 'thesod_pf_item') {
	$thesod_pf_data = thesod_get_sanitize_pf_item_data(get_the_ID());
}
if ($thesod_page_data['slideshow']['slideshow_type']) {
	thesod_slideshow_block(array('slideshow_type' => $thesod_page_data['slideshow']['slideshow_type'], 'slideshow' => $thesod_page_data['slideshow']['slideshow_slideshow'], 'lslider' => $thesod_page_data['slideshow']['slideshow_layerslider'], 'slider' => $thesod_page_data['slideshow']['slideshow_revslider']));
}

echo thesod_page_title();
?>

<div class="block-content<?php echo esc_attr($thesod_no_margins_block); ?>">
	<div class="container<?php if (get_post_type() == 'thesod_pf_item' && $thesod_pf_data['fullwidth']) {
		echo '-fullwidth';
	} ?>">
		<div class="<?php echo esc_attr(implode(' ', $thesod_panel_classes)); ?>">

			<div class="<?php echo esc_attr($thesod_center_classes); ?>">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<div class="entry-content post-content">
						<?php
						if ((get_post_type() == 'post' || get_post_type() == 'thesod_news') && $thesod_featured_content = thesod_get_post_featured_content(get_the_ID(), 'thesod-blog-default', true)) {
							wp_enqueue_style('thesod-blog');
							echo '<div class="blog-post-image centered-box">';
							echo $thesod_featured_content;
							echo '</div>';
						}
						?>

						    <?php if (get_post_type() == 'post'):
							$thesod_categories = get_the_category();
							$thesod_categories_list = array();
							foreach ($thesod_categories as $thesod_category) {
								$thesod_categories_list[] = '<a href="' . esc_url(get_category_link($thesod_category->term_id)) . '" title="' . esc_attr(sprintf(__("View all posts in %s", "thesod"), $thesod_category->name)) . '">' . $thesod_category->cat_name . '</a>';
							}
							$print_block = false;
							ob_start();
							?>

							<div class="post-meta date-color">
								<div class="entry-meta single-post-meta clearfix sod-post-date">
									<div class="post-meta-right">

										<?php if (comments_open() && !thesod_get_option('blog_hide_comments')) : $print_block = true; ?>
											<span class="comments-link"><?php comments_popup_link(0, 1, '%'); ?></span>
										<?php endif; ?>
										<?php if (comments_open() && !thesod_get_option('blog_hide_comments') && function_exists('zilla_likes') && !thesod_get_option('blog_hide_likes')): ?>
											<span class="sep"></span><?php endif; ?>
										<?php if (function_exists('zilla_likes') && !thesod_get_option('blog_hide_likes')) {
											$print_block = true;
											echo '<span class="post-meta-likes">';
											zilla_likes();
											echo '</span>';
										} ?>
										<?php if (!thesod_get_option('blog_hide_navigation')) : $print_block = true; ?>
											<span class="post-meta-navigation">
												<?php previous_post_link('<span class="post-meta-navigation-prev" title="' . esc_attr__('Previous post', 'thesod') . '">%link</span>', '&#xe636;', true); ?>
												<?php if (!empty($thesod_categories[0])) : ?><span
														class="post-meta-category-link"><a
															href="<?php echo esc_url(apply_filters('thesod_blog_category_link', get_category_link($thesod_categories[0]->term_id))); ?>">&#xe620;</a>
													</span><?php endif; ?>
												<?php next_post_link('<span class="post-meta-navigation-next" title="' . esc_attr__('Next post', 'thesod') . '">%link</span>', '&#xe634;', true); ?>
											</span>
										<?php endif ?>
									</div>
									<div class="post-meta-left">
										<?php if (!thesod_get_option('blog_hide_author')) : $print_block = true; ?>
											<span class="post-meta-author"><?php printf(esc_html__('By %s', 'thesod'), get_the_author_link()) ?></span>
										<?php endif ?>
										<?php if ($thesod_categories && !thesod_get_option('blog_hide_categories')) : $print_block = true; ?>
											<?php if (!thesod_get_option('blog_hide_author')): ?><span
													class="sep"></span> <?php endif ?><span
													class="post-meta-categories"><?php echo implode(' <span class="sep"></span> ', $thesod_categories_list); ?></span>
										<?php endif ?>
										<?php if (!thesod_get_option('blog_hide_date')) : $print_block = true; ?>
											<?php if (!thesod_get_option('blog_hide_author') || $thesod_categories && !thesod_get_option('blog_hide_categories')) : ?>
												<span class="sep"></span> <?php endif ?><span
													class="post-meta-date"><?php the_date(); ?></span>
										<?php endif ?>
									</div>
								</div><!-- .entry-meta -->
							</div>
							<?php
							$post_block_print = ob_get_clean();
							if ($print_block) {
								echo $post_block_print;
							}
						endif;
						?>

						<?php if (get_post_type() == 'thesod_pf_item') :
							$thesod_categories = get_the_terms(get_the_ID(), 'thesod_portfolios');
							$thesod_categories_list = array();
							if ($thesod_categories) {
								foreach ($thesod_categories as $thesod_category) {
									$thesod_categories_list[] = '<span class="sod-date-color">' . $thesod_category->name . '</span>';
								}
							}
							?>

							<div class="post-meta date-color">
								<div class="entry-meta single-post-meta clearfix sod-post-date">
									<div class="post-meta-right">
										<?php if (!thesod_get_option('portfolio_hide_top_navigation')): ?>
											<span class="post-meta-navigation">
												<?php previous_post_link('<span class="post-meta-navigation-prev" title="' . esc_attr__('Previous post', 'thesod') . '">%link</span>', '&#xe603;', false, '', 'thesod_portfolios'); ?>
												<?php if ($thesod_pf_data['back_url']) : ?><span
														class="post-meta-category-link"><a
															href="<?php echo esc_url($thesod_pf_data['back_url']); ?>">&#xe66d;</a>
													</span><?php endif; ?>
												<?php next_post_link('<span class="post-meta-navigation-next" title="' . esc_attr__('Next post', 'thesod') . '">%link</span>', '&#xe601;', false, '', 'thesod_portfolios'); ?>
											</span>
										<?php endif ?>
									</div>
									<div class="post-meta-left">
										<?php if (!thesod_get_option('portfolio_hide_date')): ?>
											<span class="post-meta-date"><?php the_date(); ?></span>
										<?php endif ?>
										<?php if ($thesod_categories && !thesod_get_option('portfolio_hide_sets')): ?>
											<?php if (!thesod_get_option('portfolio_hide_date')): ?><span
													class="sep"></span> <?php endif ?><span
													class="post-meta-categories"><?php echo implode(' <span class="sep"></span> ', $thesod_categories_list); ?></span>
										<?php endif ?>
										<?php if (function_exists('zilla_likes') && !thesod_get_option('portfolio_hide_likes')) {
											if (!thesod_get_option('portfolio_hide_date') || $thesod_categories && !thesod_get_option('portfolio_hide_sets')): ?><span
												class="sep"></span> <?php endif;
											echo '<span class="post-meta-likes">';
											zilla_likes();
											echo '</span>';
										} ?>
									</div>
								</div><!-- .entry-meta -->
							</div>
						<?php endif ?>

						<?php
						the_content();
						wp_link_pages(array(
							'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__('Pages:', 'thesod') . '</span>',
							'after' => '</div>',
							'link_before' => '<span>',
							'link_after' => '</span>',
						));
						?>
					</div><!-- .entry-content -->

					<?php if (get_post_type() == 'post') {
						if(!thesod_get_option('blog_hide_tags')) {
							echo get_the_tag_list('<div class="post-tags-list date-color">', '', '</div>');
						}
						if(!thesod_get_option('blog_hide_socials')) {
							thesod_socials_sharing();
						}
					} ?>

					<?php if (get_post_type() == 'post') {
						thesod_author_info(get_the_ID(), true);
					} ?>

					<?php if (get_post_type() == 'post' && !thesod_get_option('blog_hide_realted')) {
						thesod_related_posts();
					} ?>

					<?php if (get_post_type() == 'thesod_pf_item') : ?>
						<div class="portfolio-item-page-bottom clearfix">
							<?php if (!thesod_get_option('portfolio_hide_socials')) : ?>
								<div class="<?php if (!thesod_get_option('socials_colors_posts')) : ?>socials-colored <?php endif; ?>socials-rounded<?php if (get_post_type() == 'thesod_pf_item' && $thesod_pf_data['fullwidth']) {
									echo ' centered-box';
								} ?>">
									<?php thesod_socials_sharing(); ?>
								</div>
							<?php endif; ?>
							<?php if ($thesod_pf_data['project_link']) {
								thesod_button(array('size' => 'tiny', 'href' => $thesod_pf_data['project_link'], 'position' => $thesod_pf_data['fullwidth'] ? 'center' : 'right', 'text' => ($thesod_pf_data['project_text'] ? $thesod_pf_data['project_text'] : __('Go to project', 'thesod')), 'extra_class' => 'project-button'), 1);
							} ?>
						</div>
						<?php if (!thesod_get_option('portfolio_hide_bottom_navigation')): ?>
							<div class="block-divider sod-default-divider"></div>
							<div class="block-navigation<?php if (get_post_type() == 'thesod_pf_item' && $thesod_pf_data['fullwidth']) {
								echo ' centered-box';
							} ?>">
								<?php if ($thesod_nav_post = get_previous_post(true, '', 'thesod_portfolios')) : ?>
									<?php thesod_button(array(
										'text' => __('Prev', 'thesod'),
										'href' => get_permalink($thesod_nav_post->ID),
										'style' => 'outline',
										'size' => 'tiny',
										'position' => $thesod_pf_data['fullwidth'] ? 'inline' : 'left',
										'icon' => 'prev',
										'border_color' => thesod_get_option('button_background_hover_color'),
										'text_color' => thesod_get_option('button_background_hover_color'),
										'hover_background_color' => thesod_get_option('button_background_hover_color'),
										'hover_text_color' => thesod_get_option('button_outline_text_hover_color'),
										'extra_class' => 'block-portfolio-navigation-prev'
									), 1); ?>
								<?php endif; ?>
								<?php if ($thesod_nav_post = get_next_post(true, '', 'thesod_portfolios')) : ?>
									<?php thesod_button(array(
										'text' => __('Next', 'thesod'),
										'href' => get_permalink($thesod_nav_post->ID),
										'style' => 'outline',
										'size' => 'tiny',
										'position' => $thesod_pf_data['fullwidth'] ? 'inline' : 'right',
										'icon' => 'next',
										'icon_position' => 'right',
										'border_color' => thesod_get_option('button_background_hover_color'),
										'text_color' => thesod_get_option('button_background_hover_color'),
										'hover_background_color' => thesod_get_option('button_background_hover_color'),
										'hover_text_color' => thesod_get_option('button_outline_text_hover_color'),
										'extra_class' => 'block-portfolio-navigation-next'
									), 1); ?>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					<?php endif; ?>

					<?php
					if (comments_open() || get_comments_number()) {
						comments_template();
					}
					?>

				</article><!-- #post-## -->

			</div>

			<?php
			if (is_active_sidebar('page-sidebar') && $thesod_page_data['sidebar']['sidebar_position']) {
				echo '<div class="sidebar col-lg-3 col-md-3 col-sm-12' . esc_attr($thesod_sidebar_classes) . '" role="complementary">';
				get_sidebar('page');
				echo '</div><!-- .sidebar -->';
			}
			?>

		</div>

	</div>
</div><!-- .block-content -->
