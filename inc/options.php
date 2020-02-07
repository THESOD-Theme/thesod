<?php

function thesod_get_theme_options() {
	$options = array(
		'general' => array(
			'title' => __('General', 'thesod'),
			'subcats' => array(
				'theme_layout' => array(
					'title' => __('Theme Layout', 'thesod'),
					'options' => array(
						'page_layout_style' => array(
							'title' => __('Page Layout Style', 'thesod'),
							'type' => 'select',
							'items' => array(
								'fullwidth' => __('Fullwidth Layout', 'thesod'),
								'boxed' => __('Boxed Layout', 'thesod'),
							),
							'default' => 'fullwidth',
							'description' => __('Select theme layout style', 'thesod'),
						),
						'page_paddings' => array(
							'title' => __('Fullwidth With Page Paddings', 'thesod'),
							'type' => 'group',
							'options' => array(
								'page_padding_top' => array(
									'title' => __('Top (px)', 'thesod'),
									'type' => 'fixed-number',
									'min' => 0,
									'max' => 200,
									'default' => 0,
								),
								'page_padding_bottom' => array(
									'title' => __('Bottom (px)', 'thesod'),
									'type' => 'fixed-number',
									'min' => 0,
									'max' => 200,
									'default' => 0,
								),
								'page_padding_left' => array(
									'title' => __('Left (px)', 'thesod'),
									'type' => 'fixed-number',
									'min' => 0,
									'max' => 200,
									'default' => 0,
								),
								'page_padding_right' => array(
									'title' => __('Right (px)', 'thesod'),
									'type' => 'fixed-number',
									'min' => 0,
									'max' => 200,
									'default' => 0,
								),
							),
						),
						'disable_scroll_top_button' => array(
							'title' => __('Disable "Scroll To Top" Button', 'thesod'),
							'description' => __('Disable on-scroll "to the top" button', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'disable_uppercase_font' => array(
							'title' => __('Disable uppercase font', 'thesod'),
							'description' => __('Disable uppercase style for main menu items, headings etc. across the whole website', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'disable_smooth_scroll' => array(
							'title' => __('Disable "Smooth Scroll"', 'thesod'),
							'description' => __('Disable "Smooth Scroll" effect for vertical scrolling', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'enable_page_preloader' => array(
							'title' => __('Enable Page Preloader', 'thesod'),
							'description' => __('Enable page preloader for the whole website', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
					),
				),
				'identity' => array(
					'title' => __('Identity', 'thesod'),
					'options' => array(
						'logo_width' => array(
							'title' => __('Desktop Logo Width For Non-Retina Screens', 'thesod'),
							'type' => 'fixed-number',
							'min' => 0,
							'max' => 1200,
							'default' => 100,
							'description' => __('On our demo website we use 164 pix. logo', 'thesod'),
						),
						'small_logo_width' => array(
							'title' => __('Mobile Logo Width For Non-Retina Screens', 'thesod'),
							'type' => 'fixed-number',
							'min' => 0,
							'max' => 1200,
							'default' => 100,
							'description' => __('On our demo website we use 132 pix. logo', 'thesod'),
						),
						'logo' => array(
							'title' => __('Desktop Logo', 'thesod'),
							'type' => 'image',
							'default' => get_template_directory_uri() . '/images/default-logo.png',
							'description' => __('Upload your logo for desktop screens here. Pls note: if you wish to achieve best quality on retina screens, your logo size should be 3 times larger as the size you have set in "Desktop Logo Width For Non-Retina Screens". On our demo website we use 164 x 3 = 492 pix', 'thesod'),
						),
						'small_logo' => array(
							'title' => __('Small Size & Mobile logo', 'thesod'),
							'type' => 'image',
							'default' => get_template_directory_uri() . '/images/default-logo-small.png',
							'description' => __('Upload your logo for mobile screens here. Pls note: if you wish to achieve best quality on retina mobile screens, your logo size should be 3 times larger as the size you have set in "Mobile Logo Width For Non-Retina Screens". On our demo website we use 132 x 3 = 396 pix', 'thesod'),
						),
						'logo_light' => array(
							'title' => __('Light Desktop Logo', 'thesod'),
							'type' => 'image',
							'default' => get_template_directory_uri() . '/images/default-logo-light.png',
							'description' => __('Here you can upload a light version of your desktop logo to be used on dark header backgrounds. Pls note: if you wish to achieve best quality on retina screens, your logo size should be 3 times larger as the size you have set in "Desktop Logo Width For Non-Retina Screens". On our demo website we use 164 x 3 = 492 pix', 'thesod'),
						),
						'small_logo_light' => array(
							'title' => __('Light Small Size & Mobile logo', 'thesod'),
							'type' => 'image',
							'default' => get_template_directory_uri() . '/images/default-logo.png',
							'description' => __('Here you can upload a light version of your mobile logo to be used on dark header backgrounds. Pls note: if you wish to achieve best quality on retina screens, your logo size should be 3 times larger as the size you have set in "Mobile Logo Width For Non-Retina Screens". On our demo website we use 132 x 3 = 396 pix', 'thesod'),
						),
						'favicon' => array(
							'title' => __('Favicon', 'thesod'),
							'type' => 'image',
							'default' => get_template_directory_uri() . '/images/favicon.ico',
							'description' => __('Upload or select file for your favicon', 'thesod'),
						),
					),
				),
				'advanced' => array(
					'title' => __('Advanced', 'thesod'),
					'options' => array(
						'preloader_style' => array(
							'title' => __('Preloader Style', 'thesod'),
							'type' => 'select',
							'items' => array(
								'preloader-1' => __('Preloader 1', 'thesod'),
								'preloader-2' => __('Preloader 2', 'thesod'),
								'preloader-3' => __('Preloader 3', 'thesod'),
								'preloader-4' => __('Preloader 4', 'thesod'),
							),
							'default' => 'preloader-1',
							'description' => __('Choose preloader you wish to use on your website', 'thesod'),
						),
						'custom_css' => array(
							'title' => __('Custom CSS', 'thesod'),
							'type' => 'textarea',
							'description' => __('Type your custom css here, which you would like to add to theme\'s css (or overwrite it)', 'thesod'),
						),
						'custom_js' => array(
							'title' => __('Custom JS', 'thesod'),
							'type' => 'textarea',
							'description' => __('Type your custom javascript here, which you would like to add to theme\'s js', 'thesod'),
						),
						'tracking_js' => array(
							'title' => __('Tracking', 'thesod'),
							'type' => 'textarea',
							'description' => __('Google Analytics, Google Tag Manager, Facebook Pixel etc.', 'thesod'),
						),
						'portfolio_rewrite_slug' => array(
							'title' => __('Portfolio post type rewrite slug', 'thesod'),
							'type' => 'input',
							'description' => sprintf(__('Here you can define your own slug to appear as part of portfolio\'s URL. By default /pf/ is used.<br><b>IMPORTANT:</b> after changing this slugs, please visit <a href="%s">"Permalink Settings"</a> page and click on "Save changes".', 'thesod'), admin_url('options-permalink.php')),
						),
						'portfolio_archive_page' => array(
							'title' => __(' Parent page for portfolio items', 'thesod'),
							'type' => 'input',
							'description' => __('Here you can define the main parent page for your portfolio items. This feature is useful for defining your breadcrumb structure on portfolio pages.', 'thesod'),
							'type' => 'select',
							'items' => thesod_get_pages_list(),
							'default' => '',
						),
						'news_rewrite_slug' => array(
							'title' => __('News post type rewrite slug', 'thesod'),
							'type' => 'input',
							'description' => sprintf(__('Here you can define your own slug to appear as part of news URL. By default /news/ is used.<br><b>IMPORTANT:</b> after changing this slugs, please visit <a href="%s">"Permalink Settings"</a> page and click on "Save changes".', 'thesod'), admin_url('options-permalink.php')),
						),
						'disable_og_tags' => array(
							'title' => __('Deactivate thesod\'s Open Graph Tags', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'activate_news_posttype' => array(
							'title' => __('Activate "News" post type', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
							'description' => __('Additional custom post type, similar to blog posts. This post type can be used to manage news on the website separately to your blog and blog posts.', 'thesod'),
						),
						'activate_nivoslider' => array(
							'title' => __('Activate NivoSlider', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
							'description' => sprintf(__('Additional simple slider, which can be used to insert slideshows into your pages. Learn more in our <a href="%s" target="_blank">documentation</a>', 'thesod'), esc_url('https://codex-themes.com/thesod/documentation/')),
						),
						'purge_thumbnails' => array(
							'html' => '<div class="description">'.esc_html__('In case you will delete any image thumbnails (portfolio grids, products, galleries etc.) from your hosting, you need to click this button to clear the thumbnails cache in the database in order to be able to regenerate new thumbnails.', 'thesod').'</div><div><a href="'.esc_url(admin_url(wp_nonce_url('admin.php?page=thesod-thumbnails&thesod_flush_thumbnails_cache', 'thesod-thumbnails-cache-flush-all'))).'">'.esc_html__('Purge All Thumbnails Cache', 'thesod').'</a></div>',
							'type' => 'html-block',
						),
					),
				),
				'additional' => array(
					'title' => __('Additional Settings', 'thesod'),
					'options' => array(
						'404_page' => array(
							'title' => __('Custom 404 Page', 'thesod'),
							'type' => 'select',
							'items' => thesod_get_pages_list(),
							'default' => '',
						),
						'enable_mobile_lazy_loading' => array(
							'title' => __('Enabe Lazy Loading Animations On Mobiles', 'thesod'),
							'description' => __('Enabe Lazy Loading Animations On Mobiles', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
					),
				),
				'pagespeed' => array(
					'title' => __('Pagespeed Optimization', 'thesod'),
					'options' => array(
						'pagespeed_lazy_images_desktop_enable' => array(
							'title' => __('Activate image loading optimization (for desktops)', 'thesod'),
							'description' => __('All images on a webpage will start loading only by nearing the desktop device viewport', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'pagespeed_lazy_images_mobile_enable' => array(
							'title' => __('Activate image loading optimization (for mobiles)', 'thesod'),
							'description' => __('All images on a webpage will start loading only by nearing the mobile device viewport', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'pagespeed_lazy_images_visibility_offset' => array(
							'title' => __('"Start loading" distance to viewport (in px)', 'thesod'),
							'type' => 'input',
							'description' => __('The distance to a device\'s viewport in pixel, when the images should start loading (i.e. buffering zone)', 'thesod'),
						),
						'pagespeed_lazy_images_page_cache_enabled' => array(
							'title' => __('Does your website use any caching plugins?', 'thesod'),
							'description' => __('Select this in case your website uses any of caching plugins like WP Super Cache, W3 Total Cache etc', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
					),
				),
			),
		),

		'header' => array(
			'title' => __('Menu &amp; Header', 'thesod'),
			'subcats' => array(
				'general' => array(
					'title' => __('Main Menu &amp; Header Area', 'thesod'),
					'options' => array(
						'disable_fixed_header' => array(
							'title' => __('Disable Fixed Header', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'global_hide_breadcrumbs' => array(
							'title' => __('Hide Breadcrumbs', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'sticky_header_on_mobile' => array(
							'title' => __('Sticky Header On Mobile', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'hide_search_icon' => array(
							'title' => __('Hide Search Icon', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'header_layout' => array(
							'title' => __('Main Menu & Header Layout ', 'thesod'),
							'type' => 'select',
							'items' => array(
								'default' => __('Horizontal', 'thesod'),
								'fullwidth' => __('100% Width', 'thesod'),
								'fullwidth_hamburger' => __('100% Width & Hamburger Menu', 'thesod'),
								'vertical' => __('Vertical', 'thesod'),
								'overlay' => __('Overlay', 'thesod'),
								'perspective' => __('Perspective', 'thesod'),
							),
							'description' => __('Choose the layout for displaying your main menu and website header.', 'thesod'),
						),
						'header_style' => array(
							'title' => __('Main Menu & Header Style', 'thesod'),
							'type' => 'select',
							'items' => array(
								'1' => __('Light Main Menu & Dark Submenu', 'thesod'),
								'2' => __('Elegant Font Light Menu', 'thesod'),
								'3' => __('Light Main Menu & Light Submenu', 'thesod'),
								'4' => __('Dark Main Menu & Dark Submenu', 'thesod'),
							),
							'description' => __('Choose the style / colors for displaying your main menu and website header.', 'thesod'),
						),
						'mobile_menu_layout' => array(
							'title' => __('Mobile Menu Layout', 'thesod'),
							'type' => 'select',
							'items' => array(
								'default' => __('Default layout', 'thesod'),
								'overlay' => __('Overlay layout', 'thesod'),
								'slide-horizontal' => __('Slide Left layout', 'thesod'),
								'slide-vertical' => __('Slide Top layout', 'thesod'),
							),
							'description' => __('Choose the layout for displaying your mobile menu.', 'thesod'),
						),
						'mobile_menu_layout_style' => array(
							'title' => __('Mobile Menu Layout Style', 'thesod'),
							'type' => 'select',
							'items' => array(
								'light' => __('Light', 'thesod'),
								'dark' => __('Dark', 'thesod'),
							),
							'description' => __('Choose the layout style for displaying your mobile menu.', 'thesod'),
						),
						'logo_position' => array(
							'title' => __('Logo Alignment', 'thesod'),
							'type' => 'select',
							'items' => array(
								'left' => __('Left', 'thesod'),
								'right' => __('Right', 'thesod'),
								'center' => __('Centered Above Main Menu', 'thesod'),
								'menu_center' => __('Centered In Main Menu', 'thesod'),
							),
							'default' => 'left',
							'description' => __('Select position of your logo in website header', 'thesod'),
						),
						'menu_appearance_tablet_portrait' => array(
							'title' => __('Menu appearance on tablets (portrait orientation)', 'thesod'),
							'type' => 'select',
							'items' => array(
								'responsive' => __('Responsive', 'thesod'),
								'centered' => __('Centered', 'thesod'),
								'default' => __('Default', 'thesod'),
							),
							'default' => 'responsive',
							'description' => __('Select the menu appearance style on tablet screens in portrait orientation', 'thesod'),
						),
						'menu_appearance_tablet_landscape' => array(
							'title' => __('Menu appearance on tablets (landscape orientation)', 'thesod'),
							'type' => 'select',
							'items' => array(
								'responsive' => __('Responsive', 'thesod'),
								'centered' => __('Centered', 'thesod'),
								'default' => __('Default', 'thesod'),
							),
							'default' => 'default',
							'description' => __('Select the menu appearance style on tablet screens in landscape orientation', 'thesod'),
						),
						'hamburger_menu_icon_size' => array(
							'title' => __('Hamburger Icon Style', 'thesod'),
							'type' => 'select',
							'items' => array(
								'' => __('Default', 'thesod'),
								'1' => __('Small', 'thesod'),
							),
						),
					),
				),
				'top_area' => array(
					'title' => __('Top Area', 'thesod'),
					'options' => array(
						'top_area_style' => array(
							'title' => __('Top Area Style', 'thesod'),
							'type' => 'select',
							'items' => array(
								'0' => __('Disabled', 'thesod'),
								'1' => __('Light Background', 'thesod'),
								'2' => __('Dark Background', 'thesod'),
								'3' => __('Anthracite Background', 'thesod'),
							),
							'description' => __('Select the style of top area (contacts & socials bar above main menu and logo) or disable it', 'thesod'),
						),
						'top_area_alignment' => array(
							'title' => __('Top Area Alignment', 'thesod'),
							'type' => 'select',
							'items' => array(
								'left' => __('Left', 'thesod'),
								'right' => __('Right', 'thesod'),
								'center' => __('Centered', 'thesod'),
								'justified' => __('Justified', 'thesod'),
							),
							'description' => __('Select content alignment in the top area of your website', 'thesod'),
						),
						'top_area_contacts' => array(
							'title' => __('Show Contacts', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
							'description' => __('By activating this option your contact data will be displayed in top area of your website. You can edit your contact data in "Contacts & Socials" section of Theme Options', 'thesod'),
						),
						'top_area_socials' => array(
							'title' => __('Show Socials', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
							'description' => __('By activating this option the links to your social profiles will be displayed in top area of your website. You can edit your social profiles in "Contacts & Socials" section of Theme Options', 'thesod'),
						),
						'top_area_button_text' => array(
							'title' => __('Top Area Button Text', 'thesod'),
							'type' => 'input',
							'default' => '',
							'description' => __('Here you can activate and name the button to be displayed in top area. Leave blank if you don\'t wish to use a button in top area.', 'thesod'),
						),
						'top_area_button_link' => array(
							'title' => __('Top Area Button Link', 'thesod'),
							'type' => 'input',
							'default' => '',
							'description' => __('Here you can enter the link for your top area button.', 'thesod'),
						),
						'top_area_disable_fixed' => array(
							'title' => __('Disable Fixed Top Area', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'top_area_disable_mobile' => array(
							'title' => __('Disable Top Area For Mobiles', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'top_area_disable_tablet' => array(
							'title' => __('Disable Top Area For Tablets', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
					),
				),

			),
		),

		'fonts' => array(
			'title' => __('Fonts', 'thesod'),
			'subcats' => array(
/*				'google_fonts' => array(
					'title' => __('Google Fonts', 'thesod'),
					'options' => array(
						'google_fonts_file' => array(
							'title' => __('Google Fonts File', 'thesod'),
							'type' => 'file',
							'description' => __('Upload or select you own google fonts file if you would like to use a different version than the theme\'s default', 'thesod'),
						),
					),
				),*/
				'main_menu_font' => array(
					'title' => __('Main Menu Font', 'thesod'),
					'options' => array(
						'main_menu_font_family' => array(
							'title' => __('Font Family', 'thesod'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thesod'),
						),
						'main_menu_font_style' => array(
							'title' => __('Font Style', 'thesod'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thesod'),
						),
						'main_menu_font_sets' => array(
							'title' => __('Font Sets', 'thesod'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thesod'),
							'default' => 'latin,latin-ext'
						),
						'main_menu_font_size' => array(
							'title' => __('Font Size', 'thesod'),
							'description' => __('Select the font size', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 18,
						),
						'main_menu_line_height' => array(
							'title' => __('Line Height', 'thesod'),
							'description' => __('Select the line height', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'submenu_font' => array(
					'title' => __('Submenu Font', 'thesod'),
					'options' => array(
						'submenu_font_family' => array(
							'title' => __('Font Family', 'thesod'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thesod'),
						),
						'submenu_font_style' => array(
							'title' => __('Font Style', 'thesod'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thesod'),
						),
						'submenu_font_sets' => array(
							'title' => __('Font Sets', 'thesod'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thesod'),
							'default' => 'latin,latin-ext'
						),
						'submenu_font_size' => array(
							'title' => __('Font Size', 'thesod'),
							'description' => __('Select the font size', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 12,
						),
						'submenu_line_height' => array(
							'title' => __('Line Height', 'thesod'),
							'description' => __('Select the line height', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'overlay_menu_font' => array(
					'title' => __('Overlay Menu Font', 'thesod'),
					'options' => array(
						'overlay_menu_font_family' => array(
							'title' => __('Font Family', 'thesod'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thesod'),
						),
						'overlay_menu_font_style' => array(
							'title' => __('Font Style', 'thesod'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thesod'),
						),
						'overlay_menu_font_sets' => array(
							'title' => __('Font Sets', 'thesod'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thesod'),
							'default' => 'latin,latin-ext'
						),
						'overlay_menu_font_size' => array(
							'title' => __('Font Size', 'thesod'),
							'description' => __('Select the font size', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 12,
						),
						'overlay_menu_line_height' => array(
							'title' => __('Line Height', 'thesod'),
							'description' => __('Select the line height', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'mobile_menu_font' => array(
					'title' => __('Mobile Menu Font', 'thesod'),
					'options' => array(
						'mobile_menu_font_family' => array(
							'title' => __('Font Family', 'thesod'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thesod'),
						),
						'mobile_menu_font_style' => array(
							'title' => __('Font Style', 'thesod'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thesod'),
						),
						'mobile_menu_font_sets' => array(
							'title' => __('Font Sets', 'thesod'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thesod'),
							'default' => 'latin,latin-ext'
						),
						'mobile_menu_font_size' => array(
							'title' => __('Font Size', 'thesod'),
							'description' => __('Select the font size', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 12,
						),
						'mobile_menu_line_height' => array(
							'title' => __('Line Height', 'thesod'),
							'description' => __('Select the line height', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					)
				),
				'styled_subtitle_font' => array(
					'title' => __('Styled Subtitle Font', 'thesod'),
					'options' => array(
						'styled_subtitle_font_family' => array(
							'title' => __('Font Family', 'thesod'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thesod'),
						),
						'styled_subtitle_font_style' => array(
							'title' => __('Font Style', 'thesod'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thesod'),
						),
						'styled_subtitle_font_sets' => array(
							'title' => __('Font Sets', 'thesod'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thesod'),
							'default' => 'latin,latin-ext'
						),
						'styled_subtitle_font_size' => array(
							'title' => __('Font Size', 'thesod'),
							'description' => __('Select the font size', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 29,
						),
						'styled_subtitle_line_height' => array(
							'title' => __('Line Height', 'thesod'),
							'description' => __('Select the line height', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
						'styled_subtitle_custom_responsive_fonts' => array(
							'title' => __('Use manual settings for mobiles and tablets', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'styled_subtitle_custom_responsive_fonts_group' => array(
							'type' => 'hidden-group',
							'options' => array(
								'styled_subtitle_font_size_tablet' => array(
									'title' => __('Font Size for Tablets', 'thesod'),
									'description' => __('Select the font size', 'thesod'),
									'type' => 'fixed-number',
									'min' => 10,
									'max' => 100,
									'default' => 18,
								),
								'styled_subtitle_line_height_tablet' => array(
									'title' => __('Line Height for Tablets', 'thesod'),
									'description' => __('Select the line height', 'thesod'),
									'type' => 'fixed-number',
									'min' => 10,
									'max' => 150,
									'default' => 29,
								),
								'styled_subtitle_font_size_mobile' => array(
									'title' => __('Font Size for Mobiles', 'thesod'),
									'description' => __('Select the font size', 'thesod'),
									'type' => 'fixed-number',
									'min' => 10,
									'max' => 100,
									'default' => 18,
								),
								'styled_subtitle_line_height_mobile' => array(
									'title' => __('Line Height for Mobiles', 'thesod'),
									'description' => __('Select the line height', 'thesod'),
									'type' => 'fixed-number',
									'min' => 10,
									'max' => 150,
									'default' => 29,
								),
							),
						),

					),
				),
				'h1_font' => array(
					'title' => __('H1 Font', 'thesod'),
					'options' => array(
						'h1_font_family' => array(
							'title' => __('Font Family', 'thesod'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thesod'),
						),
						'h1_font_style' => array(
							'title' => __('Font Style', 'thesod'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thesod'),
						),
						'h1_font_sets' => array(
							'title' => __('Font Sets', 'thesod'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thesod'),
							'default' => 'latin,latin-ext'
						),
						'h1_font_size' => array(
							'title' => __('Font Size', 'thesod'),
							'description' => __('Select the font size', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 29,
						),
						'h1_line_height' => array(
							'title' => __('Line Height', 'thesod'),
							'description' => __('Select the line height', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
						'h1_custom_responsive_fonts' => array(
							'title' => __('Use manual settings for mobiles and tablets', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'h1_custom_responsive_fonts_group' => array(
							'type' => 'hidden-group',
							'options' => array(
								'h1_font_size_tablet' => array(
									'title' => __('Font Size for Tablets', 'thesod'),
									'description' => __('Select the font size', 'thesod'),
									'type' => 'fixed-number',
									'min' => 10,
									'max' => 100,
									'default' => 18,
								),
								'h1_line_height_tablet' => array(
									'title' => __('Line Height for Tablets', 'thesod'),
									'description' => __('Select the line height', 'thesod'),
									'type' => 'fixed-number',
									'min' => 10,
									'max' => 150,
									'default' => 29,
								),
								'h1_font_size_mobile' => array(
									'title' => __('Font Size for Mobiles', 'thesod'),
									'description' => __('Select the font size', 'thesod'),
									'type' => 'fixed-number',
									'min' => 10,
									'max' => 100,
									'default' => 18,
								),
								'h1_line_height_mobile' => array(
									'title' => __('Line Height for Mobiles', 'thesod'),
									'description' => __('Select the line height', 'thesod'),
									'type' => 'fixed-number',
									'min' => 10,
									'max' => 150,
									'default' => 29,
								),
							),
						),
					),
				),
				'h2_font' => array(
					'title' => __('H2 Font', 'thesod'),
					'options' => array(
						'h2_font_family' => array(
							'title' => __('Font Family', 'thesod'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thesod'),
						),
						'h2_font_style' => array(
							'title' => __('Font Style', 'thesod'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thesod'),
						),
						'h2_font_sets' => array(
							'title' => __('Font Sets', 'thesod'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thesod'),
							'default' => 'latin,latin-ext'
						),
						'h2_font_size' => array(
							'title' => __('Font Size', 'thesod'),
							'description' => __('Select the font size', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 25,
						),
						'h2_line_height' => array(
							'title' => __('Line Height', 'thesod'),
							'description' => __('Select the line height', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
						'h2_custom_responsive_fonts' => array(
							'title' => __('Use manual settings for mobiles and tablets', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'h2_custom_responsive_fonts_group' => array(
							'type' => 'hidden-group',
							'options' => array(
								'h2_font_size_tablet' => array(
									'title' => __('Font Size for Tablets', 'thesod'),
									'description' => __('Select the font size', 'thesod'),
									'type' => 'fixed-number',
									'min' => 10,
									'max' => 100,
									'default' => 18,
								),
								'h2_line_height_tablet' => array(
									'title' => __('Line Height for Tablets', 'thesod'),
									'description' => __('Select the line height', 'thesod'),
									'type' => 'fixed-number',
									'min' => 10,
									'max' => 150,
									'default' => 29,
								),
								'h2_font_size_mobile' => array(
									'title' => __('Font Size for Mobiles', 'thesod'),
									'description' => __('Select the font size', 'thesod'),
									'type' => 'fixed-number',
									'min' => 10,
									'max' => 100,
									'default' => 18,
								),
								'h2_line_height_mobile' => array(
									'title' => __('Line Height for Mobiles', 'thesod'),
									'description' => __('Select the line height', 'thesod'),
									'type' => 'fixed-number',
									'min' => 10,
									'max' => 150,
									'default' => 29,
								),
							),
						),
					),
				),
				'h3_font' => array(
					'title' => __('H3 Font', 'thesod'),
					'options' => array(
						'h3_font_family' => array(
							'title' => __('Font Family', 'thesod'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thesod'),
						),
						'h3_font_style' => array(
							'title' => __('Font Style', 'thesod'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thesod'),
						),
						'h3_font_sets' => array(
							'title' => __('Font Sets', 'thesod'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thesod'),
							'default' => 'latin,latin-ext'
						),
						'h3_font_size' => array(
							'title' => __('Font Size', 'thesod'),
							'description' => __('Select the font size', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 23,
						),
						'h3_line_height' => array(
							'title' => __('Line Height', 'thesod'),
							'description' => __('Select the line height', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
						'h3_custom_responsive_fonts' => array(
							'title' => __('Use manual settings for mobiles and tablets', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'h3_custom_responsive_fonts_group' => array(
							'type' => 'hidden-group',
							'options' => array(
								'h3_font_size_tablet' => array(
									'title' => __('Font Size for Tablets', 'thesod'),
									'description' => __('Select the font size', 'thesod'),
									'type' => 'fixed-number',
									'min' => 10,
									'max' => 100,
									'default' => 18,
								),
								'h3_line_height_tablet' => array(
									'title' => __('Line Height for Tablets', 'thesod'),
									'description' => __('Select the line height', 'thesod'),
									'type' => 'fixed-number',
									'min' => 10,
									'max' => 150,
									'default' => 29,
								),
								'h3_font_size_mobile' => array(
									'title' => __('Font Size for Mobiles', 'thesod'),
									'description' => __('Select the font size', 'thesod'),
									'type' => 'fixed-number',
									'min' => 10,
									'max' => 100,
									'default' => 18,
								),
								'h3_line_height_mobile' => array(
									'title' => __('Line Height for Mobiles', 'thesod'),
									'description' => __('Select the line height', 'thesod'),
									'type' => 'fixed-number',
									'min' => 10,
									'max' => 150,
									'default' => 29,
								),
							),
						),
					),
				),
				'h4_font' => array(
					'title' => __('H4 Font', 'thesod'),
					'options' => array(
						'h4_font_family' => array(
							'title' => __('Font Family', 'thesod'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thesod'),
						),
						'h4_font_style' => array(
							'title' => __('Font Style', 'thesod'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thesod'),
						),
						'h4_font_sets' => array(
							'title' => __('Font Sets', 'thesod'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thesod'),
							'default' => 'latin,latin-ext'
						),
						'h4_font_size' => array(
							'title' => __('Font Size', 'thesod'),
							'description' => __('Select the font size', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 21,
						),
						'h4_line_height' => array(
							'title' => __('Line Height', 'thesod'),
							'description' => __('Select the line height', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
						'h4_custom_responsive_fonts' => array(
							'title' => __('Use manual settings for mobiles and tablets', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'h4_custom_responsive_fonts_group' => array(
							'type' => 'hidden-group',
							'options' => array(
								'h4_font_size_tablet' => array(
									'title' => __('Font Size for Tablets', 'thesod'),
									'description' => __('Select the font size', 'thesod'),
									'type' => 'fixed-number',
									'min' => 10,
									'max' => 100,
									'default' => 18,
								),
								'h4_line_height_tablet' => array(
									'title' => __('Line Height for Tablets', 'thesod'),
									'description' => __('Select the line height', 'thesod'),
									'type' => 'fixed-number',
									'min' => 10,
									'max' => 150,
									'default' => 29,
								),
								'h4_font_size_mobile' => array(
									'title' => __('Font Size for Mobiles', 'thesod'),
									'description' => __('Select the font size', 'thesod'),
									'type' => 'fixed-number',
									'min' => 10,
									'max' => 100,
									'default' => 18,
								),
								'h4_line_height_mobile' => array(
									'title' => __('Line Height for Mobiles', 'thesod'),
									'description' => __('Select the line height', 'thesod'),
									'type' => 'fixed-number',
									'min' => 10,
									'max' => 150,
									'default' => 29,
								),
							),
						),
					),
				),
				'h5_font' => array(
					'title' => __('H5 Font', 'thesod'),
					'options' => array(
						'h5_font_family' => array(
							'title' => __('Font Family', 'thesod'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thesod'),
						),
						'h5_font_style' => array(
							'title' => __('Font Style', 'thesod'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thesod'),
						),
						'h5_font_sets' => array(
							'title' => __('Font Sets', 'thesod'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thesod'),
							'default' => 'latin,latin-ext'
						),
						'h5_font_size' => array(
							'title' => __('Font Size', 'thesod'),
							'description' => __('Select the font size', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 19,
						),
						'h5_line_height' => array(
							'title' => __('Line Height', 'thesod'),
							'description' => __('Select the line height', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
						'h5_custom_responsive_fonts' => array(
							'title' => __('Use manual settings for mobiles and tablets', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'h5_custom_responsive_fonts_group' => array(
							'type' => 'hidden-group',
							'options' => array(
								'h5_font_size_tablet' => array(
									'title' => __('Font Size for Tablets', 'thesod'),
									'description' => __('Select the font size', 'thesod'),
									'type' => 'fixed-number',
									'min' => 10,
									'max' => 100,
									'default' => 18,
								),
								'h5_line_height_tablet' => array(
									'title' => __('Line Height for Tablets', 'thesod'),
									'description' => __('Select the line height', 'thesod'),
									'type' => 'fixed-number',
									'min' => 10,
									'max' => 150,
									'default' => 29,
								),
								'h5_font_size_mobile' => array(
									'title' => __('Font Size for Mobiles', 'thesod'),
									'description' => __('Select the font size', 'thesod'),
									'type' => 'fixed-number',
									'min' => 10,
									'max' => 100,
									'default' => 18,
								),
								'h5_line_height_mobile' => array(
									'title' => __('Line Height for Mobiles', 'thesod'),
									'description' => __('Select the line height', 'thesod'),
									'type' => 'fixed-number',
									'min' => 10,
									'max' => 150,
									'default' => 29,
								),
							),
						),
					),
				),
				'h6_font' => array(
					'title' => __('H6 Font', 'thesod'),
					'options' => array(
						'h6_font_family' => array(
							'title' => __('Font Family', 'thesod'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thesod'),
						),
						'h6_font_style' => array(
							'title' => __('Font Style', 'thesod'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thesod'),
						),
						'h6_font_sets' => array(
							'title' => __('Font Sets', 'thesod'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thesod'),
							'default' => 'latin,latin-ext'
						),
						'h6_font_size' => array(
							'title' => __('Font Size', 'thesod'),
							'description' => __('Select the font size', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 17,
						),
						'h6_line_height' => array(
							'title' => __('Line Height', 'thesod'),
							'description' => __('Select the line height', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
						'h6_custom_responsive_fonts' => array(
							'title' => __('Use manual settings for mobiles and tablets', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'h6_custom_responsive_fonts_group' => array(
							'type' => 'hidden-group',
							'options' => array(
								'h6_font_size_tablet' => array(
									'title' => __('Font Size for Tablets', 'thesod'),
									'description' => __('Select the font size', 'thesod'),
									'type' => 'fixed-number',
									'min' => 10,
									'max' => 100,
									'default' => 18,
								),
								'h6_line_height_tablet' => array(
									'title' => __('Line Height for Tablets', 'thesod'),
									'description' => __('Select the line height', 'thesod'),
									'type' => 'fixed-number',
									'min' => 10,
									'max' => 150,
									'default' => 29,
								),
								'h6_font_size_mobile' => array(
									'title' => __('Font Size for Mobiles', 'thesod'),
									'description' => __('Select the font size', 'thesod'),
									'type' => 'fixed-number',
									'min' => 10,
									'max' => 100,
									'default' => 18,
								),
								'h6_line_height_mobile' => array(
									'title' => __('Line Height for Mobiles', 'thesod'),
									'description' => __('Select the line height', 'thesod'),
									'type' => 'fixed-number',
									'min' => 10,
									'max' => 150,
									'default' => 29,
								),
							),
						),
					),
				),
				'xlarge_title_font' => array(
					'title' => __('XLarge Title Font', 'thesod'),
					'options' => array(
						'xlarge_title_font_family' => array(
							'title' => __('Font Family', 'thesod'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thesod'),
						),
						'xlarge_title_font_style' => array(
							'title' => __('Font Style', 'thesod'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thesod'),
						),
						'xlarge_title_font_sets' => array(
							'title' => __('Font Sets', 'thesod'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thesod'),
							'default' => 'latin,latin-ext'
						),
						'xlarge_title_font_size' => array(
							'title' => __('Font Size', 'thesod'),
							'description' => __('Select the font size', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 17,
						),
						'xlarge_title_line_height' => array(
							'title' => __('Line Height', 'thesod'),
							'description' => __('Select the line height', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
						'xlarge_custom_responsive_fonts' => array(
							'title' => __('Use manual settings for mobiles and tablets', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'xlarge_custom_responsive_fonts_group' => array(
							'type' => 'hidden-group',
							'options' => array(
								'xlarge_font_size_tablet' => array(
									'title' => __('Font Size for Tablets', 'thesod'),
									'description' => __('Select the font size', 'thesod'),
									'type' => 'fixed-number',
									'min' => 10,
									'max' => 100,
									'default' => 18,
								),
								'xlarge_line_height_tablet' => array(
									'title' => __('Line Height for Tablets', 'thesod'),
									'description' => __('Select the line height', 'thesod'),
									'type' => 'fixed-number',
									'min' => 10,
									'max' => 150,
									'default' => 29,
								),
								'xlarge_font_size_mobile' => array(
									'title' => __('Font Size for Mobiles', 'thesod'),
									'description' => __('Select the font size', 'thesod'),
									'type' => 'fixed-number',
									'min' => 10,
									'max' => 100,
									'default' => 18,
								),
								'xlarge_line_height_mobile' => array(
									'title' => __('Line Height for Mobiles', 'thesod'),
									'description' => __('Select the line height', 'thesod'),
									'type' => 'fixed-number',
									'min' => 10,
									'max' => 150,
									'default' => 29,
								),
							),
						),
					),
				),
				'light_title_font' => array(
					'title' => __('Light Title Font', 'thesod'),
					'options' => array(
						'light_title_font_family' => array(
							'title' => __('Font Family', 'thesod'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thesod'),
						),
						'light_title_font_style' => array(
							'title' => __('Font Style', 'thesod'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thesod'),
						),
						'light_title_font_sets' => array(
							'title' => __('Font Sets', 'thesod'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thesod'),
							'default' => 'latin,latin-ext'
						),
					),
				),
				'body_font' => array(
					'title' => __('Body Font', 'thesod'),
					'options' => array(
						'body_font_family' => array(
							'title' => __('Font Family', 'thesod'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thesod'),
						),
						'body_font_style' => array(
							'title' => __('Font Style', 'thesod'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thesod'),
						),
						'body_font_sets' => array(
							'title' => __('Font Sets', 'thesod'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thesod'),
							'default' => 'latin,latin-ext'
						),
						'body_font_size' => array(
							'title' => __('Font Size', 'thesod'),
							'description' => __('Select the font size', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 14,
						),
						'body_line_height' => array(
							'title' => __('Line Height', 'thesod'),
							'description' => __('Select the line height', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'title_excerpt_font' => array(
					'title' => __('Title Excerpt Font', 'thesod'),
					'options' => array(
						'title_excerpt_font_family' => array(
							'title' => __('Font Family', 'thesod'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thesod'),
						),
						'title_excerpt_font_style' => array(
							'title' => __('Font Style', 'thesod'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thesod'),
						),
						'title_excerpt_font_sets' => array(
							'title' => __('Font Sets', 'thesod'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thesod'),
							'default' => 'latin,latin-ext'
						),
						'title_excerpt_font_size' => array(
							'title' => __('Font Size', 'thesod'),
							'description' => __('Select the font size', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 29,
						),
						'title_excerpt_line_height' => array(
							'title' => __('Line Height', 'thesod'),
							'description' => __('Select the line height', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
						'title_excerpt_custom_responsive_fonts' => array(
							'title' => __('Use manual settings for mobiles and tablets', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'title_excerpt_custom_responsive_fonts_group' => array(
							'type' => 'hidden-group',
							'options' => array(
								'title_excerpt_font_size_tablet' => array(
									'title' => __('Font Size for Tablets', 'thesod'),
									'description' => __('Select the font size', 'thesod'),
									'type' => 'fixed-number',
									'min' => 10,
									'max' => 100,
									'default' => 18,
								),
								'title_excerpt_line_height_tablet' => array(
									'title' => __('Line Height for Tablets', 'thesod'),
									'description' => __('Select the line height', 'thesod'),
									'type' => 'fixed-number',
									'min' => 10,
									'max' => 150,
									'default' => 29,
								),
								'title_excerpt_font_size_mobile' => array(
									'title' => __('Font Size for Mobiles', 'thesod'),
									'description' => __('Select the font size', 'thesod'),
									'type' => 'fixed-number',
									'min' => 10,
									'max' => 100,
									'default' => 18,
								),
								'title_excerpt_line_height_mobile' => array(
									'title' => __('Line Height for Mobiles', 'thesod'),
									'description' => __('Select the line height', 'thesod'),
									'type' => 'fixed-number',
									'min' => 10,
									'max' => 150,
									'default' => 29,
								),
							),
						),
					),
				),
				'widget_title_font' => array(
					'title' => __('Widget Title Font', 'thesod'),
					'options' => array(
						'widget_title_font_family' => array(
							'title' => __('Font Family', 'thesod'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thesod'),
						),
						'widget_title_font_style' => array(
							'title' => __('Font Style', 'thesod'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thesod'),
						),
						'widget_title_font_sets' => array(
							'title' => __('Font Sets', 'thesod'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thesod'),
							'default' => 'latin,latin-ext'
						),
						'widget_title_font_size' => array(
							'title' => __('Font Size', 'thesod'),
							'description' => __('Select the font size', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 14,
						),
						'widget_title_line_height' => array(
							'title' => __('Line Height', 'thesod'),
							'description' => __('Select the line height', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'button_font' => array(
					'title' => __('Button Font', 'thesod'),
					'options' => array(
						'button_font_family' => array(
							'title' => __('Font Family', 'thesod'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thesod'),
						),
						'button_font_style' => array(
							'title' => __('Font Style', 'thesod'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thesod'),
						),
						'button_font_sets' => array(
							'title' => __('Font Sets', 'thesod'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thesod'),
							'default' => 'latin,latin-ext'
						),
					),
				),
				'button_thin_font' => array(
					'title' => __('Button Thin Font', 'thesod'),
					'options' => array(
						'button_thin_font_family' => array(
							'title' => __('Font Family', 'thesod'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thesod'),
						),
						'button_thin_font_style' => array(
							'title' => __('Font Style', 'thesod'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thesod'),
						),
						'button_thin_font_sets' => array(
							'title' => __('Font Sets', 'thesod'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thesod'),
							'default' => 'latin,latin-ext'
						),
					),
				),
				'portfolio_title_font' => array(
					'title' => __('Portfolio Title Font', 'thesod'),
					'options' => array(
						'portfolio_title_font_family' => array(
							'title' => __('Font Family', 'thesod'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thesod'),
						),
						'portfolio_title_font_style' => array(
							'title' => __('Font Style', 'thesod'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thesod'),
						),
						'portfolio_title_font_sets' => array(
							'title' => __('Font Sets', 'thesod'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thesod'),
							'default' => 'latin,latin-ext'
						),
						'portfolio_title_font_size' => array(
							'title' => __('Font Size', 'thesod'),
							'description' => __('Select the font size', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 16,
						),
						'portfolio_title_line_height' => array(
							'title' => __('Line Height', 'thesod'),
							'description' => __('Select the line height', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'portfolio_description_font' => array(
					'title' => __('Portfolio Description Font', 'thesod'),
					'options' => array(
						'portfolio_description_font_family' => array(
							'title' => __('Font Family', 'thesod'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thesod'),
						),
						'portfolio_description_font_style' => array(
							'title' => __('Font Style', 'thesod'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thesod'),
						),
						'portfolio_description_font_sets' => array(
							'title' => __('Font Sets', 'thesod'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thesod'),
							'default' => 'latin,latin-ext'
						),
						'portfolio_description_font_size' => array(
							'title' => __('Font Size', 'thesod'),
							'description' => __('Select the font size', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 16,
						),
						'portfolio_description_line_height' => array(
							'title' => __('Line Height', 'thesod'),
							'description' => __('Select the line height', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'quickfinder_title_font' => array(
					'title' => __('Quickfinder Title Font (Bold Style)', 'thesod'),
					'options' => array(
						'quickfinder_title_font_family' => array(
							'title' => __('Font Family', 'thesod'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thesod'),
						),
						'quickfinder_title_font_style' => array(
							'title' => __('Font Style', 'thesod'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thesod'),
						),
						'quickfinder_title_font_sets' => array(
							'title' => __('Font Sets', 'thesod'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thesod'),
							'default' => 'latin,latin-ext'
						),
						'quickfinder_title_font_size' => array(
							'title' => __('Font Size', 'thesod'),
							'description' => __('Select the font size', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 16,
						),
						'quickfinder_title_line_height' => array(
							'title' => __('Line Height', 'thesod'),
							'description' => __('Select the line height', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'quickfinder_title_thin_font' => array(
					'title' => __('Quickfinder Title Font (Thin Style)', 'thesod'),
					'options' => array(
						'quickfinder_title_thin_font_family' => array(
							'title' => __('Font Family', 'thesod'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thesod'),
						),
						'quickfinder_title_thin_font_style' => array(
							'title' => __('Font Style', 'thesod'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thesod'),
						),
						'quickfinder_title_thin_font_sets' => array(
							'title' => __('Font Sets', 'thesod'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thesod'),
							'default' => 'latin,latin-ext'
						),
						'quickfinder_title_thin_font_size' => array(
							'title' => __('Font Size', 'thesod'),
							'description' => __('Select the font size', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 16,
						),
						'quickfinder_title_thin_line_height' => array(
							'title' => __('Line Height', 'thesod'),
							'description' => __('Select the line height', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'quickfinder_description_font' => array(
					'title' => __('Quickfinder Description Font', 'thesod'),
					'options' => array(
						'quickfinder_description_font_family' => array(
							'title' => __('Font Family', 'thesod'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thesod'),
						),
						'quickfinder_description_font_style' => array(
							'title' => __('Font Style', 'thesod'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thesod'),
						),
						'quickfinder_description_font_sets' => array(
							'title' => __('Font Sets', 'thesod'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thesod'),
							'default' => 'latin,latin-ext'
						),
						'quickfinder_description_font_size' => array(
							'title' => __('Font Size', 'thesod'),
							'description' => __('Select the font size', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 16,
						),
						'quickfinder_description_line_height' => array(
							'title' => __('Line Height', 'thesod'),
							'description' => __('Select the line height', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'gallery_title_font' => array(
					'title' => __('Gallery Title Font', 'thesod'),
					'options' => array(
						'gallery_title_font_family' => array(
							'title' => __('Font Family', 'thesod'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thesod'),
						),
						'gallery_title_font_style' => array(
							'title' => __('Font Style', 'thesod'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thesod'),
						),
						'gallery_title_font_sets' => array(
							'title' => __('Font Sets', 'thesod'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thesod'),
							'default' => 'latin,latin-ext'
						),
						'gallery_title_font_size' => array(
							'title' => __('Font Size', 'thesod'),
							'description' => __('Select the font size', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 16,
						),
						'gallery_title_line_height' => array(
							'title' => __('Line Height', 'thesod'),
							'description' => __('Select the line height', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'gallery_title_bold_font' => array(
					'title' => __('Gallery Title Font (Bold Style)', 'thesod'),
					'options' => array(
						'gallery_title_bold_font_family' => array(
							'title' => __('Font Family', 'thesod'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thesod'),
						),
						'gallery_title_bold_font_style' => array(
							'title' => __('Font Style', 'thesod'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thesod'),
						),
						'gallery_title_bold_font_sets' => array(
							'title' => __('Font Sets', 'thesod'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thesod'),
							'default' => 'latin,latin-ext'
						),
						'gallery_title_bold_font_size' => array(
							'title' => __('Font Size', 'thesod'),
							'description' => __('Select the font size', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 16,
						),
						'gallery_title_bold_line_height' => array(
							'title' => __('Line Height', 'thesod'),
							'description' => __('Select the line height', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'gallery_description_font' => array(
					'title' => __('Gallery Description Font', 'thesod'),
					'options' => array(
						'gallery_description_font_family' => array(
							'title' => __('Font Family', 'thesod'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thesod'),
						),
						'gallery_description_font_style' => array(
							'title' => __('Font Style', 'thesod'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thesod'),
						),
						'gallery_description_font_sets' => array(
							'title' => __('Font Sets', 'thesod'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thesod'),
							'default' => 'latin,latin-ext'
						),
						'gallery_description_font_size' => array(
							'title' => __('Font Size', 'thesod'),
							'description' => __('Select the font size', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 16,
						),
						'gallery_description_line_height' => array(
							'title' => __('Line Height', 'thesod'),
							'description' => __('Select the line height', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'testimonial_font' => array(
					'title' => __('Testimonials Quoted Text', 'thesod'),
					'options' => array(
						'testimonial_font_family' => array(
							'title' => __('Font Family', 'thesod'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thesod'),
						),
						'testimonial_font_style' => array(
							'title' => __('Font Style', 'thesod'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thesod'),
						),
						'testimonial_font_sets' => array(
							'title' => __('Font Sets', 'thesod'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thesod'),
							'default' => 'latin,latin-ext'
						),
						'testimonial_font_size' => array(
							'title' => __('Font Size', 'thesod'),
							'description' => __('Select the font size', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 16,
						),
						'testimonial_line_height' => array(
							'title' => __('Line Height', 'thesod'),
							'description' => __('Select the line height', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'counter_font' => array(
					'title' => __('Counter Numbers', 'thesod'),
					'options' => array(
						'counter_font_family' => array(
							'title' => __('Font Family', 'thesod'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thesod'),
						),
						'counter_font_style' => array(
							'title' => __('Font Style', 'thesod'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thesod'),
						),
						'counter_font_sets' => array(
							'title' => __('Font Sets', 'thesod'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thesod'),
							'default' => 'latin,latin-ext'
						),
						'counter_font_size' => array(
							'title' => __('Font Size', 'thesod'),
							'description' => __('Select the font size', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 16,
						),
						'counter_line_height' => array(
							'title' => __('Line Height', 'thesod'),
							'description' => __('Select the line height', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
						'counter_custom_responsive_fonts' => array(
							'title' => __('Use manual settings for mobiles and tablets', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'counter_custom_responsive_fonts_group' => array(
							'type' => 'hidden-group',
							'options' => array(
								'counter_font_size_tablet' => array(
									'title' => __('Font Size for Tablets', 'thesod'),
									'description' => __('Select the font size', 'thesod'),
									'type' => 'fixed-number',
									'min' => 10,
									'max' => 100,
									'default' => 18,
								),
								'counter_line_height_tablet' => array(
									'title' => __('Line Height for Tablets', 'thesod'),
									'description' => __('Select the line height', 'thesod'),
									'type' => 'fixed-number',
									'min' => 10,
									'max' => 150,
									'default' => 29,
								),
								'counter_font_size_mobile' => array(
									'title' => __('Font Size for Mobiles', 'thesod'),
									'description' => __('Select the font size', 'thesod'),
									'type' => 'fixed-number',
									'min' => 10,
									'max' => 100,
									'default' => 18,
								),
								'counter_line_height_mobile' => array(
									'title' => __('Line Height for Mobiles', 'thesod'),
									'description' => __('Select the line height', 'thesod'),
									'type' => 'fixed-number',
									'min' => 10,
									'max' => 150,
									'default' => 29,
								),
							),
						),
					),
				),
				'tabs_title_font' => array(
					'title' => __('Title Font for Tabs, Tours & Accordions (Bold Style)', 'thesod'),
					'options' => array(
						'tabs_title_font_family' => array(
							'title' => __('Font Family', 'thesod'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thesod'),
						),
						'tabs_title_font_style' => array(
							'title' => __('Font Style', 'thesod'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thesod'),
						),
						'tabs_title_font_sets' => array(
							'title' => __('Font Sets', 'thesod'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thesod'),
							'default' => 'latin,latin-ext'
						),
						'tabs_title_font_size' => array(
							'title' => __('Font Size', 'thesod'),
							'description' => __('Select the font size', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 16,
						),
						'tabs_title_line_height' => array(
							'title' => __('Line Height', 'thesod'),
							'description' => __('Select the line height', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'tabs_title_thin_font' => array(
					'title' => __('Title Font for Tabs, Tours & Accordions (Thin Style)', 'thesod'),
					'options' => array(
						'tabs_title_thin_font_family' => array(
							'title' => __('Font Family', 'thesod'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thesod'),
						),
						'tabs_title_thin_font_style' => array(
							'title' => __('Font Style', 'thesod'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thesod'),
						),
						'tabs_title_thin_font_sets' => array(
							'title' => __('Font Sets', 'thesod'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thesod'),
							'default' => 'latin,latin-ext'
						),
						'tabs_title_thin_font_size' => array(
							'title' => __('Font Size', 'thesod'),
							'description' => __('Select the font size', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 16,
						),
						'tabs_title_thin_line_height' => array(
							'title' => __('Line Height', 'thesod'),
							'description' => __('Select the line height', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'woocommerce_price_font' => array(
					'title' => __('WooCommerce Product Category Price', 'thesod'),
					'options' => array(
						'woocommerce_price_font_family' => array(
							'title' => __('Font Family', 'thesod'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thesod'),
						),
						'woocommerce_price_font_style' => array(
							'title' => __('Font Style', 'thesod'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thesod'),
						),
						'woocommerce_price_font_sets' => array(
							'title' => __('Font Sets', 'thesod'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thesod'),
							'default' => 'latin,latin-ext'
						),
						'woocommerce_price_font_size' => array(
							'title' => __('Font Size', 'thesod'),
							'description' => __('Select the font size', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 16,
						),
						'woocommerce_price_line_height' => array(
							'title' => __('Line Height', 'thesod'),
							'description' => __('Select the line height', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'slideshow_title_font' => array(
					'title' => __('NivoSlider Title Font', 'thesod'),
					'options' => array(
						'slideshow_title_font_family' => array(
							'title' => __('Font Family', 'thesod'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thesod'),
						),
						'slideshow_title_font_style' => array(
							'title' => __('Font Style', 'thesod'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thesod'),
						),
						'slideshow_title_font_sets' => array(
							'title' => __('Font Sets', 'thesod'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thesod'),
							'default' => 'latin,latin-ext'
						),
						'slideshow_title_font_size' => array(
							'title' => __('Font Size', 'thesod'),
							'description' => __('Select the font size', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 16,
						),
						'slideshow_title_line_height' => array(
							'title' => __('Line Height', 'thesod'),
							'description' => __('Select the line height', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'slideshow_description_font' => array(
					'title' => __('NivoSlider Description Font', 'thesod'),
					'options' => array(
						'slideshow_description_font_family' => array(
							'title' => __('Font Family', 'thesod'),
							'type' => 'font-select',
							'description' => __('Select font family you would like to use. On the top of the fonts list you\'ll find web safe fonts', 'thesod'),
						),
						'slideshow_description_font_style' => array(
							'title' => __('Font Style', 'thesod'),
							'type' => 'font-style',
							'description' => __('Select font style for your font', 'thesod'),
						),
						'slideshow_description_font_sets' => array(
							'title' => __('Font Sets', 'thesod'),
							'type' => 'font-sets',
							'description' => __('Type in or load additional font sets which you would like to use with your chosen google font (latin-ext is loaded by default)', 'thesod'),
							'default' => 'latin,latin-ext'
						),
						'slideshow_description_font_size' => array(
							'title' => __('Font Size', 'thesod'),
							'description' => __('Select the font size', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 16,
						),
						'slideshow_description_line_height' => array(
							'title' => __('Line Height', 'thesod'),
							'description' => __('Select the line height', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
			),
		),

		'colors' => array(
			'title' => __('Colors', 'thesod'),
			'subcats' => array(
				'background_main_colors' => array(
					'title' => __('Background And Main Colors', 'thesod'),
					'options' => array(
						'basic_outer_background_color' => array(
							'title' => __('Background Color For Boxed Layouts &amp; Perspective Menu', 'thesod'),
							'type' => 'color',
							'description' => __('Select website\'s backround color in boxed layout and perspective menu', 'thesod'),
						),
						'top_background_color' => array(
							'title' => __('Main Menu &amp; Header Area Background', 'thesod'),
							'type' => 'color',
							'description' => __('Background color for the website\'s header area with main menu and logo', 'thesod'),
						),
						'main_background_color' => array(
							'title' => __('Main Content Background Color', 'thesod'),
							'type' => 'color',
							'description' => __('Main background color for pages, blog posts, portfolio &amp; shop items. It is also used as background for certain blog list styles, portfolio overviews, team items and tables. Additionally this color is used as text font color for text elements published on dark backgrounds, like footer on our demo website.', 'thesod'),
						),
						'styled_elements_background_color' => array(
							'title' => __('Styled Element Background Color', 'thesod'),
							'type' => 'color',
							'description' => __('After the main content background color this is a second most important background color for the website. It is used as background for following widgets: submenu, diagrams, project info, recent posts & comments, testimonials & teams. Also it is used as item\'s background color in grid overviews of blog posts and portfolio items; in testimonial, team and tables shortcodes as well as in background of sticky posts.', 'thesod'),
						),
						'styled_elements_color_1' => array(
							'title' => __('Styled Element Color 1', 'thesod'),
							'type' => 'color',
							'description' => __('This color is used mainly as font text color of some widget elements, some elements like teams, testimonials, blog items. It is also used as background color for the label of sticky post in blogs', 'thesod'),
						),
						'styled_elements_color_2' => array(
							'title' => __('Styled Element Color 2', 'thesod'),
							'type' => 'color',
							'description' => __('Background color for a few widget elements.', 'thesod'),
						),
						'styled_elements_color_3' => array(
							'title' => __('Styled Element Color 3', 'thesod'),
							'type' => 'color',
							'description' => __('This color is used for following elements: likes icon and markers in widget headings ', 'thesod'),
						),
						'styled_elements_color_4' => array(
							'title' => __('Styled Element Color 4', 'thesod'),
							'type' => 'color',
							'description' => __('This color is used for following elements: woocommerce buttons', 'thesod'),
						),
						'divider_default_color' => array(
							'title' => __('Divider Default Color', 'thesod'),
							'type' => 'color',
							'description' => __('Default color for dividers used in theme: content dividers, widget dividers, blog & news posts dividers etc.', 'thesod'),
						),
						'box_border_color' => array(
							'title' => __('Box Border & Sharing Icons In Blog Posts', 'thesod'),
							'type' => 'color',
							'description' => __('Color used as default border color in box elements in main content and sidebar widgets. Also this color is used as font color for social sharing icons in blog posts.', 'thesod'),
						),
					),
				),
				'menu_colors' => array(
					'title' => __('Menu Colors', 'thesod'),
					'options' => array(
						'main_menu_level1_color' => array(
							'title' => __('Level 1 Text Color', 'thesod'),
							'type' => 'color',
						),
						'main_menu_level1_background_color' => array(
							'title' => __('Level 1 Background Color', 'thesod'),
							'type' => 'color',
						),
						'main_menu_level1_hover_color' => array(
							'title' => __('Level 1 Hover Text Color', 'thesod'),
							'type' => 'color',
						),
						'main_menu_level1_hover_background_color' => array(
							'title' => __('Level 1 Hover Background Color', 'thesod'),
							'type' => 'color',
						),
						'main_menu_level1_active_color' => array(
							'title' => __('Level 1 Active Text Color', 'thesod'),
							'type' => 'color',
						),
						'main_menu_level1_active_background_color' => array(
							'title' => __('Level 1 Active Background Color', 'thesod'),
							'type' => 'color',
						),
						'main_menu_level2_color' => array(
							'title' => __('Level 2 Text Color', 'thesod'),
							'type' => 'color',
						),
						'main_menu_level2_background_color' => array(
							'title' => __('Level 2 Background Color', 'thesod'),
							'type' => 'color',
						),
						'main_menu_level2_hover_color' => array(
							'title' => __('Level 2 Hover Text Color', 'thesod'),
							'type' => 'color',
						),
						'main_menu_level2_hover_background_color' => array(
							'title' => __('Level 2 Hover Background Color', 'thesod'),
							'type' => 'color',
						),
						'main_menu_level2_active_color' => array(
							'title' => __('Level 2 Active Text Color', 'thesod'),
							'type' => 'color',
						),
						'main_menu_level2_active_background_color' => array(
							'title' => __('Level 2 Active Background Color', 'thesod'),
							'type' => 'color',
						),
						'main_menu_mega_column_title_color' => array(
							'title' => __('Mega Menu Column Titles Text Color', 'thesod'),
							'type' => 'color',
						),
						'main_menu_mega_column_title_hover_color' => array(
							'title' => __('Mega Menu Column Titles Hover Text Color', 'thesod'),
							'type' => 'color',
						),
						'main_menu_mega_column_title_active_color' => array(
							'title' => __('Mega Menu Column Titles Active Text Color', 'thesod'),
							'type' => 'color',
						),
						'main_menu_level3_color' => array(
							'title' => __('Level 3+ Text Color', 'thesod'),
							'type' => 'color',
						),
						'main_menu_level3_background_color' => array(
							'title' => __('Level 3+ Background Color', 'thesod'),
							'type' => 'color',
						),
						'main_menu_level3_hover_color' => array(
							'title' => __('Level 3+ Hover Text Color', 'thesod'),
							'type' => 'color',
						),
						'main_menu_level3_hover_background_color' => array(
							'title' => __('Level 3+ Hover Background Color', 'thesod'),
							'type' => 'color',
						),
						'main_menu_level3_active_color' => array(
							'title' => __('Level 3+ Active Text Color', 'thesod'),
							'type' => 'color',
						),
						'main_menu_level3_active_background_color' => array(
							'title' => __('Level 3+ Active Background Color', 'thesod'),
							'type' => 'color',
						),
						'main_menu_level1_light_color' => array(
							'title' => __('Level 1 Light Text Color', 'thesod'),
							'type' => 'color',
						),
						'main_menu_level1_light_hover_color' => array(
							'title' => __('Level 1 Hover Light Text Color', 'thesod'),
							'type' => 'color',
						),
						'main_menu_level1_light_active_color' => array(
							'title' => __('Level 1 Active Light Text Color', 'thesod'),
							'type' => 'color',
						),
						'main_menu_level2_border_color' => array(
							'title' => __('Level 2+ Border Color', 'thesod'),
							'type' => 'color',
						),
						'mega_menu_icons_color' => array(
							'title' => __('Mega Menu Icons Color', 'thesod'),
							'type' => 'color',
						),
						'overlay_menu_background_color' => array(
							'title' => __('Overlay Menu Background Color', 'thesod'),
							'type' => 'color',
						),
						'overlay_menu_color' => array(
							'title' => __('Overlay Menu Text Color', 'thesod'),
							'type' => 'color',
						),
						'overlay_menu_hover_color' => array(
							'title' => __('Overlay Menu Hover Text Color', 'thesod'),
							'type' => 'color',
						),
						'overlay_menu_active_color' => array(
							'title' => __('Overlay Menu Active Text Color', 'thesod'),
							'type' => 'color',
						),
						'hamburger_menu_icon_color' => array(
							'title' => __('Hamburger Icon Color', 'thesod'),
							'type' => 'color',
						),
						'hamburger_menu_icon_light_color' => array(
							'title' => __('Hamburger Icon Light Color', 'thesod'),
							'type' => 'color',
						),
					),
				),
				'mobile_menu_colors' => array(
					'title' => __('Mobile Menu Colors', 'thesod'),
					'options' => array(
						'mobile_menu_button_color' => array(
							'title' => __('Mobile Menu Button Color', 'thesod'),
							'type' => 'color',
						),
						'mobile_menu_button_light_color' => array(
							'title' => __('Mobile Menu Button Light Color', 'thesod'),
							'type' => 'color',
						),
						'mobile_menu_background_color' => array(
							'title' => __('Menu Background Color', 'thesod'),
							'type' => 'color',
						),
						'mobile_menu_level1_color' => array(
							'title' => __('Level 1 Text Color', 'thesod'),
							'type' => 'color',
						),
						'mobile_menu_level1_background_color' => array(
							'title' => __('Level 1 Background Color', 'thesod'),
							'type' => 'color',
						),
						'mobile_menu_level1_active_color' => array(
							'title' => __('Level 1 Active Text Color', 'thesod'),
							'type' => 'color',
						),
						'mobile_menu_level1_active_background_color' => array(
							'title' => __('Level 1 Active Background Color', 'thesod'),
							'type' => 'color',
						),
						'mobile_menu_level2_color' => array(
							'title' => __('Level 2 Text Color', 'thesod'),
							'type' => 'color',
						),
						'mobile_menu_level2_background_color' => array(
							'title' => __('Level 2 Background Color', 'thesod'),
							'type' => 'color',
						),
						'mobile_menu_level2_active_color' => array(
							'title' => __('Level 2 Active Text Color', 'thesod'),
							'type' => 'color',
						),
						'mobile_menu_level2_active_background_color' => array(
							'title' => __('Level 2 Active Background Color', 'thesod'),
							'type' => 'color',
						),
						'mobile_menu_level3_color' => array(
							'title' => __('Level 3+ Text Color', 'thesod'),
							'type' => 'color',
						),
						'mobile_menu_level3_background_color' => array(
							'title' => __('Level 3+ Background Color', 'thesod'),
							'type' => 'color',
						),
						'mobile_menu_level3_active_color' => array(
							'title' => __('Level 3+ Active Text Color', 'thesod'),
							'type' => 'color',
						),
						'mobile_menu_level3_active_background_color' => array(
							'title' => __('Level 3+ Active Background Color', 'thesod'),
							'type' => 'color',
						),
						'mobile_menu_border_color' => array(
							'title' => __('Border Color', 'thesod'),
							'type' => 'color',
						),
						'mobile_menu_social_icon_color' => array(
							'title' => __('Social Icon Color', 'thesod'),
							'type' => 'color',
						),
						'mobile_menu_hide_color' => array(
							'title' => __('Hide Menu Button Color', 'thesod'),
							'type' => 'color',
						),
					),
				),
				'top_area_colors' => array(
					'title' => __('Top Area Colors', 'thesod'),
					'options' => array(
						'top_area_background_color' => array(
							'title' => __('Top Area Background Color', 'thesod'),
							'type' => 'color',
							'description' => __('Background color for the selected style of top area (contacts & socials bar above main menu and logo). You can select from different top area styles in "Header -> Top Area"', 'thesod'),
						),
						'top_area_border_color' => array(
							'title' => __('Top Area Border Color', 'thesod'),
							'type' => 'color',
						),
						'top_area_separator_color' => array(
							'title' => __('Top Area Separator Color', 'thesod'),
							'type' => 'color',
						),
						'top_area_text_color' => array(
							'title' => __('Top Area Text Color', 'thesod'),
							'type' => 'color',
							'description' => __('Main font color for text used in top area', 'thesod'),
						),
						'top_area_link_color' => array(
							'title' => __('Top Area Link Text Color', 'thesod'),
							'type' => 'color',
							'description' => __('Color of the links used in top area', 'thesod'),
						),
						'top_area_link_hover_color' => array(
							'title' => __('Top Area Link Hover Text Color', 'thesod'),
							'type' => 'color',
							'description' => __('Color for links hovers used in top area', 'thesod'),
						),
						'top_area_button_text_color' => array(
							'title' => __('Top Area Button Text Color', 'thesod'),
							'type' => 'color',
							'description' => __('Font color for the button in top area (if used)', 'thesod'),
						),
						'top_area_button_background_color' => array(
							'title' => __('Top Area Button Background Color', 'thesod'),
							'type' => 'color',
							'description' => __('Background color for the button in top area (if used)', 'thesod'),
						),
						'top_area_button_hover_text_color' => array(
							'title' => __('Top Area Button Hover Text Color', 'thesod'),
							'type' => 'color',
							'description' => __('Font hover color for the button in top area (if used)', 'thesod'),
						),
						'top_area_button_hover_background_color' => array(
							'title' => __('Top Area Button Hover Background Color', 'thesod'),
							'type' => 'color',
							'description' => __('Background hover color for the button in top area (if used)', 'thesod'),
						),
					),
				),
				'footer_colors' => array(
					'title' => __('Footer Area Colors', 'thesod'),
					'options' => array(
						'footer_background_color' => array(
							'title' => __('Footer Background Color', 'thesod'),
							'type' => 'color',
							'description' => __('Background color of the footer area with copyrights and socials at the bottom of the website.', 'thesod'),
						),
						'footer_text_color' => array(
							'title' => __('Footer Text Color', 'thesod'),
							'type' => 'color',
						),
						'footer_menu_color' => array(
							'title' => __('Footer menu font color', 'thesod'),
							'type' => 'color',
							'description' => __('Font color of footer menu', 'thesod'),
						),
						'footer_menu_hover_color' => array(
							'title' => __('Footer menu hover font color', 'thesod'),
							'type' => 'color',
							'description' => __('Font color of hover item in footer menu', 'thesod'),
						),
						'footer_menu_separator_color' => array(
							'title' => __('Footer menu separator color', 'thesod'),
							'type' => 'color',
							'description' => __('Color of a separator-line between menu items in footer', 'thesod'),
						),
						'footer_top_border_color' => array(
							'title' => __('Footer top border color', 'thesod'),
							'type' => 'color',
							'description' => __('Color of the border, separating website’s footer and footer widgetised area', 'thesod'),
						),
						'footer_widget_area_background_color' => array(
							'title' => __('Footer Widgetised Area Background Color', 'thesod'),
							'type' => 'color',
							'description' => __('Background color for widgetised area in footer', 'thesod'),
						),
						'footer_widget_title_color' => array(
							'title' => __('Footer Widget Title Color', 'thesod'),
							'type' => 'color',
							'description' => __('Font color of widget titles used in footer widgetised area', 'thesod'),
						),
						'footer_widget_text_color' => array(
							'title' => __('Footer Widget Text Color', 'thesod'),
							'type' => 'color',
							'description' => __('Font color of text used in widgets in footer widgetised area', 'thesod'),
						),
						'footer_widget_link_color' => array(
							'title' => __('Footer Widget Link Color', 'thesod'),
							'type' => 'color',
							'description' => __('Font color of links in widgets used in footer widgetised area', 'thesod'),
						),
						'footer_widget_hover_link_color' => array(
							'title' => __('Footer Widget Hover Link Color', 'thesod'),
							'type' => 'color',
							'description' => __('Hover color for links used in widgets in footer widgetised area', 'thesod'),
						),
						'footer_widget_active_link_color' => array(
							'title' => __('Footer Widget Active Link Color', 'thesod'),
							'type' => 'color',
							'description' => __('Color for active links used in widgets in footer widgetised area', 'thesod'),
						),
						'footer_widget_triangle_color' => array(
							'title' => __('Widget\'s title triangle color ', 'thesod'),
							'type' => 'color',
							'description' => __('Color of the small triangle label after the widget\'s title in footer', 'thesod'),
						),
					),
				),
				'text_colors' => array(
					'title' => __('Text Colors', 'thesod'),
					'options' => array(
						'body_color' => array(
							'title' => __('Body Color', 'thesod'),
							'type' => 'color',
						),
						'h1_color' => array(
							'title' => __('H1 Color', 'thesod'),
							'type' => 'color',
						),
						'h2_color' => array(
							'title' => __('H2 Color', 'thesod'),
							'type' => 'color',
						),
						'h3_color' => array(
							'title' => __('H3 Color', 'thesod'),
							'type' => 'color',
						),
						'h4_color' => array(
							'title' => __('H4 Color', 'thesod'),
							'type' => 'color',
						),
						'h5_color' => array(
							'title' => __('H5 Color', 'thesod'),
							'type' => 'color',
						),
						'h6_color' => array(
							'title' => __('H6 Color', 'thesod'),
							'type' => 'color',
						),
						'link_color' => array(
							'title' => __('Link Color', 'thesod'),
							'type' => 'color',
						),
						'hover_link_color' => array(
							'title' => __('Hover Link Color', 'thesod'),
							'type' => 'color',
						),
						'active_link_color' => array(
							'title' => __('Active Link Color', 'thesod'),
							'type' => 'color',
						),
						'copyright_text_color' => array(
							'title' => __('Copyright Text Color', 'thesod'),
							'type' => 'color',
						),
						'copyright_link_color' => array(
							'title' => __('Copyright Link Color', 'thesod'),
							'type' => 'color',
						),
						'title_bar_background_color' => array(
							'title' => __('Title Bar Default Background', 'thesod'),
							'type' => 'color',
						),
						'title_bar_text_color' => array(
							'title' => __('Title Bar Default Font', 'thesod'),
							'type' => 'color',
						),
						'date_filter_subtitle_color' => array(
							'title' => __('Date, Filter & Team Subtitle Color', 'thesod'),
							'type' => 'color',
						),
						'system_icons_font' => array(
							'title' => __('System Icons Font', 'thesod'),
							'type' => 'color',
						),
						'system_icons_font_2' => array(
							'title' => __('System Icons Font 2', 'thesod'),
							'type' => 'color',
						),
					),
				),
				'button_colors' => array(
					'title' => __('Button Colors', 'thesod'),
					'options' => array(
						'button_text_basic_color' => array(
							'title' => __('Basic Text Color', 'thesod'),
							'type' => 'color',
							'description' => __('Font color for the text used in default flat buttons. Note: you can freely customise your buttons inside your content using "Button" shortcode in Visual Composer', 'thesod'),
						),
						'button_text_hover_color' => array(
							'title' => __('Hover Text Color', 'thesod'),
							'type' => 'color',
							'description' => __('Hover font color for the text used in default flat buttons. Note: you can freely customise your buttons inside your content using "Button" shortcode in Visual Composer', 'thesod'),
						),
						'button_background_basic_color' => array(
							'title' => __('Basic Background Color', 'thesod'),
							'type' => 'color',
							'description' => __('Background color for default flat buttons. Note: you can freely customise your buttons inside your content using "Button" shortcode in Visual Composer', 'thesod'),
						),
						'button_background_hover_color' => array(
							'title' => __('Hover Background Color', 'thesod'),
							'type' => 'color',
							'description' => __('Hover background color for default flat buttons. Note: you can freely customise your buttons inside your content using "Button" shortcode in Visual Composer', 'thesod'),
						),
						'button_outline_text_basic_color' => array(
							'title' => __('Basic Outline Text Color', 'thesod'),
							'type' => 'color',
							'description' => __('Font color for the text used in default outlined buttons. Note: you can freely customise your buttons inside your content using "Button" shortcode in Visual Composer', 'thesod'),
						),
						'button_outline_text_hover_color' => array(
							'title' => __('Hover Outline Text Color', 'thesod'),
							'type' => 'color',
							'description' => __('Hover font color for the text used in default outlined buttons. Note: you can freely customise your buttons inside your content using "Button" shortcode in Visual Composer', 'thesod'),
						),
						'button_outline_border_basic_color' => array(
							'title' => __('Basic Outline Border Color', 'thesod'),
							'type' => 'color',
							'description' => __('Border color used in default outlined buttons. Note: you can freely customise your buttons inside your content using "Button" shortcode in Visual Composer', 'thesod'),
						),
					),
				),
				'widgets_colors' => array(
					'title' => __('Widgets Colors', 'thesod'),
					'options' => array(
						'widget_title_color' => array(
							'title' => __('Widget Title Color', 'thesod'),
							'type' => 'color',
							'description' => __('Font color of widget titles used in sidebars', 'thesod'),
						),
						'widget_link_color' => array(
							'title' => __('Widget Link Color', 'thesod'),
							'type' => 'color',
							'description' => __('Font color of links in widgets used in sidebars', 'thesod'),
						),
						'widget_hover_link_color' => array(
							'title' => __('Widget Hover Link Color', 'thesod'),
							'type' => 'color',
							'description' => __('Hover color for links used in sidebar widgets', 'thesod'),
						),
						'widget_active_link_color' => array(
							'title' => __('Widget Active Link Color', 'thesod'),
							'type' => 'color',
							'description' => __('Color for active links used in sidebar widgets', 'thesod'),
						),
					),
				),
				'portfolio_colors' => array(
					'title' => __('Portfolio Colors', 'thesod'),
					'options' => array(
						'portfolio_title_color' => array(
							'title' => __('Portfolio Overview Title Text', 'thesod'),
							'type' => 'color',
							'description' => __('Choose portfolio item\'s title color for grid-style portfolio overviews', 'thesod'),
						),
						'portfolio_description_color' => array(
							'title' => __('Portfolio Overview Description Text', 'thesod'),
							'type' => 'color',
							'description' => __('Choose portfolio item\'s description color for grid-style portfolio overviews', 'thesod'),
						),
						'portfolio_date_color' => array(
							'title' => __('Portfolio Date Color', 'thesod'),
							'type' => 'color',
							'description' => __('Font color for showing the date in portfolio overviews', 'thesod'),
						),
						'portfolio_arrow_color' => array(
							'title' => __('Portfolio Slider Arrow Font Color', 'thesod'),
							'type' => 'color',
						),
						'portfolio_arrow_hover_color' => array(
							'title' => __('Portfolio Slider Arrow Font Color on Hover', 'thesod'),
							'type' => 'color',
						),
						'portfolio_arrow_background_color' => array(
							'title' => __('Portfolio Slider Arrow Background Color', 'thesod'),
							'type' => 'color',
						),
						'portfolio_arrow_background_hover_color' => array(
							'title' => __('Portfolio Slider Arrow Background on Hover', 'thesod'),
							'type' => 'color',
						),
						'portfolio_sorting_controls_color' => array(
							'title' => __('Sorting Controls Font Color', 'thesod'),
							'type' => 'color',
						),
						'portfolio_sorting_background_color' => array(
							'title' => __('Sorting Controls Background', 'thesod'),
							'type' => 'color',
						),
						'portfolio_sorting_switch_color' => array(
							'title' => __('Sorting Controls Switch', 'thesod'),
							'type' => 'color',
						),
						'portfolio_sorting_separator_color' => array(
							'title' => __('Separator', 'thesod'),
							'type' => 'color',
						),
						'portfolio_filter_button_color' => array(
							'title' => __('Filter Button Font Color', 'thesod'),
							'type' => 'color',
						),
						'portfolio_filter_button_background_color' => array(
							'title' => __('Filter Button Background', 'thesod'),
							'type' => 'color',
						),
						'portfolio_filter_button_hover_color' => array(
							'title' => __('Filter Button Font Color on Hover', 'thesod'),
							'type' => 'color',
						),
						'portfolio_filter_button_hover_background_color' => array(
							'title' => __('Filter Button Background on Hover', 'thesod'),
							'type' => 'color',
						),
						'portfolio_filter_button_active_color' => array(
							'title' => __('Active Filter Button Font Color', 'thesod'),
							'type' => 'color',
						),
						'portfolio_filter_button_active_background_color' => array(
							'title' => __('Active Filter Button Background', 'thesod'),
							'type' => 'color',
						),
					),
				),
				'gallery_colors' => array(
					'title' => __('Slideshow, Gallery And Image Box Colors', 'thesod'),
					'options' => array(
						'gallery_caption_background_color' => array(
							'title' => __('Gallery Lightbox Caption Background', 'thesod'),
							'type' => 'color',
							'description' => __('Select background color for image description in image lightbox (zoomed view)', 'thesod'),
						),
						'gallery_title_color' => array(
							'title' => __('Gallery Lightbox Title Text', 'thesod'),
							'type' => 'color',
							'description' => __('Choose title color for image description in gallery in image lightbox (zoomed view)', 'thesod'),
						),
						'gallery_description_color' => array(
							'title' => __('Gallery Lightbox Description Text', 'thesod'),
							'type' => 'color',
							'description' => __('Select text color for image description in image lightbox (zoomed view)', 'thesod'),
						),
						'slideshow_arrow_background' => array(
							'title' => __('Slideshow Arrow Background', 'thesod'),
							'type' => 'color',
							'description' => __('Background color for the arrows in Layerslider, Revolution & Nivo Slider slideshows', 'thesod'),
						),
						'slideshow_arrow_hover_background' => array(
							'title' => __('Slideshow Arrow Hover Background', 'thesod'),
							'type' => 'color',
							'description' => __('Hover background color for the arrows in Layerslider, Revolution & Nivo Slider slideshows', 'thesod'),
						),
						'slideshow_arrow_color' => array(
							'title' => __('Slideshow Arrow Font', 'thesod'),
							'type' => 'color',
							'description' => __('Font color for the arrows in Layerslider, Revolution & Nivo Slider slideshows', 'thesod'),
						),
						'sliders_arrow_color' => array(
							'title' => __('Sliders Arrow Font', 'thesod'),
							'type' => 'color',
							'description' => __('Font color for the arrows in content sliders (not in Layeslider, Revolution or Nivo Sliders)', 'thesod'),
						),
						'sliders_arrow_background_color' => array(
							'title' => __('Sliders Arrow Background', 'thesod'),
							'type' => 'color',
							'description' => __('Backround color for the arrows in content sliders (not in Layeslider, Revolution or Nivo Sliders)', 'thesod'),
						),
						'sliders_arrow_hover_color' => array(
							'title' => __('Sliders Arrow Hover Font', 'thesod'),
							'type' => 'color',
							'description' => __('Hover font color for the arrows in content sliders (not in Layeslider, Revolution or Nivo Sliders)', 'thesod'),
						),
						'sliders_arrow_background_hover_color' => array(
							'title' => __('Sliders Arrow Hover Background', 'thesod'),
							'type' => 'color',
							'description' => __('Hover background color for the arrows in content sliders (not in Layeslider, Revolution or Nivo Sliders)', 'thesod'),
						),
						'hover_effect_default_color' => array(
							'title' => __('"Cyan Breeze" Hover Color', 'thesod'),
							'type' => 'color',
						),
						'hover_effect_zooming_blur_color' => array(
							'title' => __('"Zooming White" Hover Color', 'thesod'),
							'type' => 'color',
						),
						'hover_effect_horizontal_sliding_color' => array(
							'title' => __('"Horizontal Sliding" Hover Color', 'thesod'),
							'type' => 'color',
						),
						'hover_effect_vertical_sliding_color' => array(
							'title' => __('"Vertical Sliding" Hover Color', 'thesod'),
							'type' => 'color',
						),
					),
				),
				'quickfinder_colors' => array(
					'title' => __('Quickfinder Colors', 'thesod'),
					'options' => array(
						'quickfinder_title_color' => array(
							'title' => __('Quickfinder Title Text', 'thesod'),
							'type' => 'color',
							'description' => __('Font color for the default quickfinder titles. Note: you can freely customise your quickfinders inside your content using "Quickfinder" shortcode in Visual Composer', 'thesod'),
						),
						'quickfinder_description_color' => array(
							'title' => __('Quickfinder Description Text', 'thesod'),
							'type' => 'color',
							'description' => __('Font color for the default quickfinder description. Note: you can freely customise your quickfinders inside your content using "Quickfinder" shortcode in Visual Composer', 'thesod'),
						),
					),
				),
				'testimonial_colors' => array(
					'title' => __('Testimonial colors', 'thesod'),
					'options' => array(
						'testimonial_arrow_color' => array(
							'title' => __('Slider Arrow Font Color', 'thesod'),
							'type' => 'color',
						),
						'testimonial_arrow_hover_color' => array(
							'title' => __('Slider Arrow Font Color on Hover', 'thesod'),
							'type' => 'color',
						),
						'testimonial_arrow_background_color' => array(
							'title' => __('Slider Arrow Background Color', 'thesod'),
							'type' => 'color',
						),
						'testimonial_arrow_background_hover_color' => array(
							'title' => __('Slider Arrow Background Color on Hover', 'thesod'),
							'type' => 'color',
						),
					),
				),
				'bullets_pager_colors' => array(
					'title' => __('Bullets, Icons, Dropcaps & Pagination', 'thesod'),
					'options' => array(
						'bullets_symbol_color' => array(
							'title' => __('Bullets Symbol', 'thesod'),
							'type' => 'color',
							'description' => __('This color is used in bullets in navigation & menu widgets as well as as font color for icons in contact widget', 'thesod'),
						),
						'icons_symbol_color' => array(
							'title' => __('Icons Font', 'thesod'),
							'type' => 'color',
							'description' => __('Default font color for icons. Note: using icons shortcodes in Visual Composer you can freely customise your icons as you wish', 'thesod'),
						),
						'icons_portfolio_gallery_hover_color' => array(
							'title' => __('Icons In Portfolio & Gallery Hovers', 'thesod'),
							'type' => 'color',
							'description' => __('Font color for icons, used in portfolio & gallery hovers. By default the main website\'s background color is used', 'thesod'),
						),
						'pagination_basic_color' => array(
							'title' => __('Pagination Basic', 'thesod'),
							'type' => 'color',
							'description' => __('Font color for numbers in classic pagination', 'thesod'),
						),
						'pagination_basic_background_color' => array(
							'title' => __('Pagination Basic Background', 'thesod'),
							'type' => 'color',
							'description' => __('Background color for numbers in classic pagination', 'thesod'),
						),
						'pagination_hover_color' => array(
							'title' => __('Pagination Hover', 'thesod'),
							'type' => 'color',
							'description' => __('Hover color for classic pagination', 'thesod'),
						),
						'pagination_active_color' => array(
							'title' => __('Pagination Active', 'thesod'),
							'type' => 'color',
							'description' => __('Active color  for classic pagination', 'thesod'),
						),
						'mini_pagination_color' => array(
							'title' => __('Slider Mini-Pagination (Not Active)', 'thesod'),
							'type' => 'color',
						),
						'mini_pagination_active_color' => array(
							'title' => __('Slider Mini-Pagination (Active)', 'thesod'),
							'type' => 'color',
						),
						'blockquote_icon_testimonials' => array(
							'title' => __('Color of blockquotes icon in testimonials', 'thesod'),
							'type' => 'color',
						),
						'blockquote_icon_blockquotes' => array(
							'title' => __('Color of blockquotes icon in blockquotes element', 'thesod'),
							'type' => 'color',
						),
					),
				),
				'socials_colors' => array(
					'title' => __('Social Icons Colors', 'thesod'),
					'options' => array(
						'socials_colors_top_area' => array(
							'title' => __('Social Icons in Top Area', 'thesod'),
							'type' => 'color',
							'description' => __('Color of social icons used in top area', 'thesod'),
						),
						'socials_colors_footer' => array(
							'title' => __('Social Icons in Footer', 'thesod'),
							'type' => 'color',
							'description' => __('Color of social icons used in website\'s footer', 'thesod'),
						),
						'socials_colors_posts' => array(
							'title' => __('Social Icons on Pages, Posts, Portfolio Items', 'thesod'),
							'type' => 'color',
							'description' => __('Color of social icons used on pages, blog posts and portfolio items', 'thesod'),
						),
						'socials_colors_woocommerce' => array(
							'title' => __('Social Icons on WooCommerce Pages', 'thesod'),
							'type' => 'color',
							'description' => __('Color of social icons used on WooCommerce pages', 'thesod'),
						),
					),
				),
				'contact_form' => array(
				),
				'form_colors' => array(
					'title' => __('Other Forms', 'thesod'),
					'options' => array(
						'form_elements_background_color' => array(
							'title' => __('Background', 'thesod'),
							'type' => 'color',
						),
						'form_elements_text_color' => array(
							'title' => __('Font', 'thesod'),
							'type' => 'color',
						),
						'form_elements_border_color' => array(
							'title' => __('Border', 'thesod'),
							'type' => 'color',
						),
					),
				),
				'breadcrumbs_color' => array(
					'title' => __('Breadcrumbs', 'thesod'),
					'options' => array(
						'breadcrumbs_default_color' => array(
							'title' => __('Breadcrumbs Color', 'thesod'),
							'type' => 'color',
						),
						'breadcrumbs_active_color' => array(
							'title' => __('Breadcrumbs Active Item Color', 'thesod'),
							'type' => 'color',
						),
						'breadcrumbs_hover_color' => array(
							'title' => __('Breadcrumbs Hover Color', 'thesod'),
							'type' => 'color',
						),
					),
				),
				'preloader_color' => array(
					'title' => __('Preloader Colors', 'thesod'),
					'options' => array(
						'preloader_page_background' => array(
							'title' => __('Page Preloader Background Colors', 'thesod'),
							'type' => 'color',
						),
						'preloader_line_1' => array(
							'title' => __('Preloader line 1', 'thesod'),
							'type' => 'color',
						),
						'preloader_line_2' => array(
							'title' => __('Preloader line 2', 'thesod'),
							'type' => 'color',
						),
						'preloader_line_3' => array(
							'title' => __('Preloader line 3', 'thesod'),
							'type' => 'color',
						),
					),
				),
			),
		),

		'backgrounds' => array(
			'title' => __('Backgrounds', 'thesod'),
			'subcats' => array(
				'backgrounds_images' => array(
					'title' => __('Background Images', 'thesod'),
					'options' => array(
						'basic_outer_background_image' => array(
							'title' => __('Background for Boxed Layout', 'thesod'),
							'type' => 'image',
							'description' => __('Select or upload image file for website\'s backround in boxed layout', 'thesod'),
						),
						'basic_outer_background_image_select' => array(
							'title' => __('Background Patterns for Boxed Layout', 'thesod'),
							'type' => 'image-select',
							'target' => 'basic_outer_background_image',
							'items' => array(
								0 => 'low_contrast_linen',
								1 => 'mochaGrunge',
								2 => 'bedge_grunge',
								3 => 'solid',
								4 => 'concrete_wall',
								5 => 'dark_circles',
								6 => 'debut_dark',
							),
						),
						'top_background_image' => array(
							'title' => __('Main Menu & Header Area Background', 'thesod'),
							'type' => 'image',
							'description' => __('Select or upload background image file for the website\'s header area with main menu and logo', 'thesod'),
						),
						'top_area_background_image' => array(
							'title' => __('Top Area Background', 'thesod'),
							'type' => 'image',
							'description' => __('Select or upload background image file for the selected style of top area (contacts & socials bar above main menu and logo). You can select from different top area styles in "Header -> Top Area"', 'thesod'),
						),
						'main_background_image' => array(
							'title' => __('Main Content Background', 'thesod'),
							'type' => 'image',
							'description' => __('Select or upload image file for website\'s main content background', 'thesod'),
						),
						'footer_background_image' => array(
							'title' => __('Footer Background', 'thesod'),
							'type' => 'image',
							'description' => __('Select or upload background image file for the footer area with copyrights and socials at the bottom of the website.', 'thesod'),
						),
						'footer_widget_area_background_image' => array(
							'title' => __(' Footer Widgetised Area Background Image', 'thesod'),
							'type' => 'image',
							'description' => __('Select or upload background image file for widgetised area in footer', 'thesod'),
						),
					),
				),
			),
		),

		'slideshow' => array(
			'title' => __('NivoSlider Options', 'thesod'),
			'subcats' => array(
				'slideshow_options' => array(
					'title' => __('NivoSlider Options', 'thesod'),
					'options' => array(
						'slider_effect' => array(
							'title' => __('Effect', 'thesod'),
							'type' => 'select',
							'items' => array(
								'random' => 'random',
								'fold' => 'fold',
								'fade' => 'fade',
								'sliceDown' => 'sliceDown',
								'sliceDownRight' => 'sliceDownRight',
								'sliceDownLeft' => 'sliceDownLeft',
								'sliceUpRight' => 'sliceUpRight',
								'sliceUpLeft' => 'sliceUpLeft',
								'sliceUpDown' => 'sliceUpDown',
								'sliceUpDownLeft' => 'sliceUpDownLeft',
								'fold' => 'fold',
								'fade' => 'fade',
								'boxRandom' => 'boxRandom',
								'boxRain' => 'boxRain',
								'boxRainReverse' => 'boxRainReverse',
								'boxRainGrow' => 'boxRainGrow',
								'boxRainGrowReverse' => 'boxRainGrowReverse',
							),
						),
						'slider_slices' => array(
							'title' => __('Slices', 'thesod'),
							'type' => 'fixed-number',
							'min' => 1,
							'max' => 20,
							'default' => 15,
						),
						'slider_boxCols' => array(
							'title' => __('Box Cols', 'thesod'),
							'type' => 'fixed-number',
							'min' => 1,
							'max' => 10,
							'default' => 8,
						),
						'slider_boxRows' => array(
							'title' => __('Box Rows', 'thesod'),
							'type' => 'fixed-number',
							'min' => 1,
							'max' => 10,
							'default' => 4,
						),
						'slider_animSpeed' => array(
							'title' => __('Animation Speed ( x 100 milliseconds )', 'thesod'),
							'type' => 'fixed-number',
							'min' => 1,
							'max' => 50,
							'default' => 5,
						),
						'slider_pauseTime' => array(
							'title' => __('Pause Time ( x 1000 milliseconds )', 'thesod'),
							'type' => 'fixed-number',
							'min' => 1,
							'max' => 20,
							'default' => 3,
						),
						'slider_directionNav' => array(
							'title' => __('Direction Navigation', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'slider_controlNav' => array(
							'title' => __('Control Navigation', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
					),
				),
			),
		),

		'blog' => array(
			'title' => __('Blog & Portfolio', 'thesod'),
			'subcats' => array(
				'blog_options' => array(
					'title' => __('Blog Post & News Settings', 'thesod'),
					'options' => array(
						'show_author' => array(
							'title' => __('Show author info', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'excerpt_length' => array(
							'title' => __('Excerpt lenght', 'thesod'),
							'type' => 'fixed-number',
							'min' => 1,
							'max' => 150,
							'default' => 20,
						),
						'blog_hide_author' => array(
							'title' => __('Hide author name', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'blog_hide_date' => array(
							'title' => __('Hide date', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'blog_hide_date_in_blog_cat' => array(
							'title' => __('Hide date in blog categories', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'blog_hide_categories' => array(
							'title' => __('Hide categories', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'blog_hide_tags' => array(
							'title' => __('Hide tags', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'blog_hide_comments' => array(
							'title' => __('Hide comments icon', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'blog_hide_likes' => array(
							'title' => __('Hide likes', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'blog_hide_navigation' => array(
							'title' => __('Hide posts navigation', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'blog_hide_socials' => array(
							'title' => __('Hide social sharing', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'blog_hide_realted' => array(
							'title' => __('Hide related posts', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
					),
				),
				'portfolio_options' => array(
					'title' => __('Portfolio Page Settings', 'thesod'),
					'options' => array(
						'portfolio_hide_date' => array(
							'title' => __('Hide date', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'portfolio_hide_sets' => array(
							'title' => __('Hide portfolio sets', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'portfolio_hide_likes' => array(
							'title' => __('Hide likes', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'portfolio_hide_top_navigation' => array(
							'title' => __('Hide posts top navigation', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'portfolio_hide_bottom_navigation' => array(
							'title' => __('Hide posts bottom navigation', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'portfolio_hide_socials' => array(
							'title' => __('Hide social sharing', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
					),
				),
			),
		),

		'footer' => array(
			'title' => __('Footer', 'thesod'),
			'subcats' => array(
				'footer_options' => array(
					'title' => __('Footer Options', 'thesod'),
					'options' => array(
						'footer_active' => array(
							'title' => __('Activate default footer', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'footer_html' => array(
							'title' => __('Footer Text', 'thesod'),
							'type' => 'textarea',
						),
						'custom_footer' => array(
							'title' => __('Custom Footer', 'thesod'),
							'type' => 'select',
							'items' => thesod_get_footers_list(),
							'default' => '',
						),
						'footer_widget_area_hide' => array(
							'title' => __('Hide footer widget area', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
					),
				),
			),
		),

		'socials' => array(
			'title' => __('Contacts & Socials', 'thesod'),
			'subcats' => array(
				'contacts' => array(
					'title' => __('Contacts', 'thesod'),
					'options' => array(
						'contacts_address' => array(
							'title' => __('Address', 'thesod'),
							'type' => 'input',
							'default' => '',
						),
						'contacts_phone' => array(
							'title' => __('Phone', 'thesod'),
							'type' => 'input',
							'default' => '',
						),
						'contacts_fax' => array(
							'title' => __('Fax', 'thesod'),
							'type' => 'input',
							'default' => '',
						),
						'contacts_email' => array(
							'title' => __('Email', 'thesod'),
							'type' => 'input',
							'default' => '',
						),
						'contacts_website' => array(
							'title' => __('Website', 'thesod'),
							'type' => 'input',
							'default' => '',
						),
					),
				),
				'top_area_contacts' => array(
					'title' => __('Top Area Contacts', 'thesod'),
					'options' => array(
						'top_area_contacts_address_group' => array(
							'title' => __('Address', 'thesod'),
							'type' => 'group',
							'options' => array(
								'top_area_contacts_address' => array(
									'title' => __('Text', 'thesod'),
									'type' => 'input',
									'default' => '',
								),
								'top_area_contacts_address_icon_color' => array(
									'title' => __('Icon Color', 'thesod'),
									'type' => 'color',
								),
								'top_area_contacts_address_icon_pack' => array(
									'title' => __('Icon Pack', 'thesod'),
									'type' => 'select',
									'items' => thesod_icon_packs_select_array(),
									'default' => 'elegant',
								),
								'top_area_contacts_address_icon' => array(
									'title' => __('Icon', 'thesod'),
									'type' => 'icon',
									'default' => '',
								),
							),
						),
						'top_area_contacts_phone_group' => array(
							'title' => __('Phone', 'thesod'),
							'type' => 'group',
							'options' => array(
								'top_area_contacts_phone' => array(
									'title' => __('Text', 'thesod'),
									'type' => 'input',
									'default' => '',
								),
								'top_area_contacts_phone_icon_color' => array(
									'title' => __('Icon Color', 'thesod'),
									'type' => 'color',
								),
								'top_area_contacts_phone_icon_pack' => array(
									'title' => __('Icon Pack', 'thesod'),
									'type' => 'select',
									'items' => thesod_icon_packs_select_array(),
									'default' => 'elegant',
								),
								'top_area_contacts_phone_icon' => array(
									'title' => __('Icon', 'thesod'),
									'type' => 'icon',
									'default' => '',
								),
							),
						),
						'top_area_contacts_fax_group' => array(
							'title' => __('Fax', 'thesod'),
							'type' => 'group',
							'options' => array(
								'top_area_contacts_fax' => array(
									'title' => __('Text', 'thesod'),
									'type' => 'input',
									'default' => '',
								),
								'top_area_contacts_fax_icon_color' => array(
									'title' => __('Icon Color', 'thesod'),
									'type' => 'color',
								),
								'top_area_contacts_fax_icon_pack' => array(
									'title' => __('Icon Pack', 'thesod'),
									'type' => 'select',
									'items' => thesod_icon_packs_select_array(),
									'default' => 'elegant',
								),
								'top_area_contacts_fax_icon' => array(
									'title' => __('Icon', 'thesod'),
									'type' => 'icon',
									'default' => '',
								),
							),
						),
						'top_area_contacts_email_group' => array(
							'title' => __('Email', 'thesod'),
							'type' => 'group',
							'options' => array(
								'top_area_contacts_email' => array(
									'title' => __('Text', 'thesod'),
									'type' => 'input',
									'default' => '',
								),
								'top_area_contacts_email_icon_color' => array(
									'title' => __('Icon Color', 'thesod'),
									'type' => 'color',
								),
								'top_area_contacts_email_icon_pack' => array(
									'title' => __('Icon Pack', 'thesod'),
									'type' => 'select',
									'items' => thesod_icon_packs_select_array(),
									'default' => 'elegant',
								),
								'top_area_contacts_email_icon' => array(
									'title' => __('Icon', 'thesod'),
									'type' => 'icon',
									'default' => '',
								),
							),
						),
						'top_area_contacts_website_group' => array(
							'title' => __('Website', 'thesod'),
							'type' => 'group',
							'options' => array(
								'top_area_contacts_website' => array(
									'title' => __('Text', 'thesod'),
									'type' => 'input',
									'default' => '',
								),
								'top_area_contacts_website_icon_color' => array(
									'title' => __('Icon Color', 'thesod'),
									'type' => 'color',
								),
								'top_area_contacts_website_icon_pack' => array(
									'title' => __('Icon Pack', 'thesod'),
									'type' => 'select',
									'items' => thesod_icon_packs_select_array(),
									'default' => 'elegant',
								),
								'top_area_contacts_website_icon' => array(
									'title' => __('Icon', 'thesod'),
									'type' => 'icon',
									'default' => '',
								),
							),
						),
					),
				),
				'socials_options' => array(
					'title' => __('Socials', 'thesod'),
					'options' => array_merge(thesod_generate_socials_icons_options(), array(
						'socials_add_new' => array(
							'html' => '<a href="'.esc_url(admin_url('?page=socials-manager')).'">'.esc_html__('Add new social network', 'thesod').'</a>',
							'type' => 'html-block',
						),
						'show_social_icons' => array(
							'title' => __('Display Links For Sharing Posts On Social Networks', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
					))
				),
			),
		),
	);

	if(defined('WPCF7_VERSION') || defined('YIKES_MC_VERSION') || defined('MC4WP_VERSION')) {
		$options['colors']['subcats']['contact_form'] = array(
			'title' => __('Contact Form 7 & Mailchimp Forms', 'thesod'),
			'options' => array()
		);
		if(defined('WPCF7_VERSION')) {
			$options['colors']['subcats']['contact_form']['options'] = array_merge($options['colors']['subcats']['contact_form']['options'], array(
				'contact_form_light_colors' => array(
					'title' => __('Contact Form Light', 'thesod'),
					'type' => 'group',
					'options' => array(
						'contact_form_light_custom_styles' => array(
							'title' => __('Use Custom Styles', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'contact_form_light_custom_styles_group' => array(
							'type' => 'hidden-group',
							'options' => array(
								'contact_form_light_input_color' => array(
									'title' => __('Input Font Color', 'thesod'),
									'type' => 'color',
								),
								'contact_form_light_input_background_color' => array(
									'title' => __('Input Background Color', 'thesod'),
									'type' => 'color',
								),
								'contact_form_light_input_border_color' => array(
									'title' => __('Input Border Color', 'thesod'),
									'type' => 'color',
								),
								'contact_form_light_input_placeholder_color' => array(
									'title' => __('Input Placeholder Font Color', 'thesod'),
									'type' => 'color',
								),
								'contact_form_light_input_icon_color' => array(
									'title' => __('Input Icon Color', 'thesod'),
									'type' => 'color',
								),
								'contact_form_light_label_color' => array(
									'title' => __('Label Font Color', 'thesod'),
									'type' => 'color',
								),
								'contact_form_light_button_style' => array(
									'title' => __('Button Style', 'thesod'),
									'type' => 'select',
									'items' => array(
										'flat' => __('Flat', 'thesod'),
										'outline' => __('Outline', 'thesod'),
									),
									'default' => 'flat',
								),
								'contact_form_light_button_position' => array(
									'title' => __('Button Position', 'thesod'),
									'type' => 'select',
									'items' => array(
										'fullwidth' => __('Fullwidth', 'thesod'),
										'left' => __('Left', 'thesod'),
										'right' => __('Right', 'thesod'),
										'center' => __('Center', 'thesod'),
									),
									'default' => 'fullwidth',
								),
								'contact_form_light_button_size' => array(
									'title' => __('Button Size', 'thesod'),
									'type' => 'select',
									'items' => array(
										'tiny' => __('Tiny', 'thesod'),
										'small' => __('Small', 'thesod'),
										'medium' => __('Medium', 'thesod'),
										'large' => __('Large', 'thesod'),
										'giant' => __('Giant', 'thesod'),
									),
									'default' => 'small',
								),
								'contact_form_light_button_text_weight' => array(
									'title' => __('Button Text Weight', 'thesod'),
									'type' => 'select',
									'items' => array(
										'normal' => __('Normal', 'thesod'),
										'thin' => __('Thin', 'thesod'),
									),
									'default' => 'normal',
								),
								'contact_form_light_button_border' => array(
									'title' => __('Button Border Width', 'thesod'),
									'type' => 'select',
									'items' => array(0, 1, 2, 3, 4, 5, 6),
									'default' => 0,
								),
								'contact_form_light_button_corner' => array(
									'title' => __('Button Border Radius', 'thesod'),
									'type' => 'fixed-number',
									'min' => 0,
									'max' => 50,
									'default' => 3,
								),
								'contact_form_light_button_no_uppercase' => array(
									'title' => __('Button No Uppercase', 'thesod'),
									'type' => 'checkbox',
									'value' => 1,
									'default' => 0,
								),
								'contact_form_light_button_empty' => array(
									'type' => 'group-empty',
								),
								'contact_form_light_button_text_color' => array(
									'title' => __('Button Text Color', 'thesod'),
									'type' => 'color',
								),
								'contact_form_light_button_hover_text_color' => array(
									'title' => __('Button Hover Text Color', 'thesod'),
									'type' => 'color',
								),
								'contact_form_light_button_background_color' => array(
									'title' => __('Button Backround Color', 'thesod'),
									'type' => 'color',
								),
								'contact_form_light_button_hover_background_color' => array(
									'title' => __('Button Hover Backround Color', 'thesod'),
									'type' => 'color',
								),
								'contact_form_light_button_border_color' => array(
									'title' => __('Button Border Color', 'thesod'),
									'type' => 'color',
								),
								'contact_form_light_button_hover_border_color' => array(
									'title' => __('Button Hover Border Color', 'thesod'),
									'type' => 'color',
								),
							),
						),
					),
				),
				'contact_form_dark_colors' => array(
					'title' => __('Contact Form dark', 'thesod'),
					'type' => 'group',
					'options' => array(
						'contact_form_dark_custom_styles' => array(
							'title' => __('Use Custom Styles', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'contact_form_dark_custom_styles_group' => array(
							'type' => 'hidden-group',
							'options' => array(
								'contact_form_dark_input_color' => array(
									'title' => __('Input Font Color', 'thesod'),
									'type' => 'color',
								),
								'contact_form_dark_input_background_color' => array(
									'title' => __('Input Background Color', 'thesod'),
									'type' => 'color',
								),
								'contact_form_dark_input_border_color' => array(
									'title' => __('Input Border Color', 'thesod'),
									'type' => 'color',
								),
								'contact_form_dark_input_placeholder_color' => array(
									'title' => __('Input Placeholder Font Color', 'thesod'),
									'type' => 'color',
								),
								'contact_form_dark_input_icon_color' => array(
									'title' => __('Input Icon Color', 'thesod'),
									'type' => 'color',
								),
								'contact_form_dark_label_color' => array(
									'title' => __('Label Font Color', 'thesod'),
									'type' => 'color',
								),
								'contact_form_dark_button_style' => array(
									'title' => __('Button Style', 'thesod'),
									'type' => 'select',
									'items' => array(
										'flat' => __('Flat', 'thesod'),
										'outline' => __('Outline', 'thesod'),
									),
									'default' => 'flat',
								),
								'contact_form_dark_button_position' => array(
									'title' => __('Button Position', 'thesod'),
									'type' => 'select',
									'items' => array(
										'fullwidth' => __('Fullwidth', 'thesod'),
										'left' => __('Left', 'thesod'),
										'right' => __('Right', 'thesod'),
										'center' => __('Center', 'thesod'),
									),
									'default' => 'fullwidth',
								),
								'contact_form_dark_button_size' => array(
									'title' => __('Button Size', 'thesod'),
									'type' => 'select',
									'items' => array(
										'tiny' => __('Tiny', 'thesod'),
										'small' => __('Small', 'thesod'),
										'medium' => __('Medium', 'thesod'),
										'large' => __('Large', 'thesod'),
										'giant' => __('Giant', 'thesod'),
									),
									'default' => 'small',
								),
								'contact_form_dark_button_text_weight' => array(
									'title' => __('Button Text Weight', 'thesod'),
									'type' => 'select',
									'items' => array(
										'normal' => __('Normal', 'thesod'),
										'thin' => __('Thin', 'thesod'),
									),
									'default' => 'normal',
								),
								'contact_form_dark_button_border' => array(
									'title' => __('Button Border Width', 'thesod'),
									'type' => 'select',
									'items' => array(0, 1, 2, 3, 4, 5, 6),
									'default' => 0,
								),
								'contact_form_dark_button_corner' => array(
									'title' => __('Button Border Radius', 'thesod'),
									'type' => 'fixed-number',
									'min' => 0,
									'max' => 50,
									'default' => 3,
								),
								'contact_form_dark_button_no_uppercase' => array(
									'title' => __('Button No Uppercase', 'thesod'),
									'type' => 'checkbox',
									'value' => 1,
									'default' => 0,
								),
								'contact_form_dark_button_empty' => array(
									'type' => 'group-empty',
								),
								'contact_form_dark_button_text_color' => array(
									'title' => __('Button Text Color', 'thesod'),
									'type' => 'color',
								),
								'contact_form_dark_button_hover_text_color' => array(
									'title' => __('Button Hover Text Color', 'thesod'),
									'type' => 'color',
								),
								'contact_form_dark_button_background_color' => array(
									'title' => __('Button Backround Color', 'thesod'),
									'type' => 'color',
								),
								'contact_form_dark_button_hover_background_color' => array(
									'title' => __('Button Hover Backround Color', 'thesod'),
									'type' => 'color',
								),
								'contact_form_dark_button_border_color' => array(
									'title' => __('Button Border Color', 'thesod'),
									'type' => 'color',
								),
								'contact_form_dark_button_hover_border_color' => array(
									'title' => __('Button Hover Border Color', 'thesod'),
									'type' => 'color',
								),
							),
						),
					),
				),
			));
		}
		if(defined('YIKES_MC_VERSION') || defined('MC4WP_VERSION')) {
			$options['colors']['subcats']['contact_form']['options'] = array_merge($options['colors']['subcats']['contact_form']['options'], array(
				'mailchimp_content_colors' => array(
					'title' => __('MailChimp inside Content', 'thesod'),
					'type' => 'group',
					'options' => array(
						'mailchimp_content_custom_styles' => array(
							'title' => __('Use Custom Styles', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'mailchimp_content_custom_styles_group' => array(
							'type' => 'hidden-group',
							'options' => array(
								'mailchimp_content_input_color' => array(
									'title' => __('Input Font Color', 'thesod'),
									'type' => 'color',
								),
								'mailchimp_content_input_background_color' => array(
									'title' => __('Input Background Color', 'thesod'),
									'type' => 'color',
								),
								'mailchimp_content_input_border_color' => array(
									'title' => __('Input Border Color', 'thesod'),
									'type' => 'color',
								),
								'mailchimp_content_input_placeholder_color' => array(
									'title' => __('Input Placeholder Font Color', 'thesod'),
									'type' => 'color',
								),
								'mailchimp_content_text_color' => array(
									'title' => __('Font Color', 'thesod'),
									'type' => 'color',
								),
								'mailchimp_content_label_color' => array(
									'title' => __('Label Font Color', 'thesod'),
									'type' => 'color',
								),
								'mailchimp_content_button_text_color' => array(
									'title' => __('Button Text Color', 'thesod'),
									'type' => 'color',
								),
								'mailchimp_content_button_hover_text_color' => array(
									'title' => __('Button Hover Text Color', 'thesod'),
									'type' => 'color',
								),
								'mailchimp_content_button_background_color' => array(
									'title' => __('Button Backround Color', 'thesod'),
									'type' => 'color',
								),
								'mailchimp_content_button_hover_background_color' => array(
									'title' => __('Button Hover Backround Color', 'thesod'),
									'type' => 'color',
								),
							),
						),
					),
				),

				'mailchimp_sidebars_colors' => array(
					'title' => __('MailChimp inside Sidebars', 'thesod'),
					'type' => 'group',
					'options' => array(
						'mailchimp_sidebars_custom_styles' => array(
							'title' => __('Use Custom Styles', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'mailchimp_sidebars_custom_styles_group' => array(
							'type' => 'hidden-group',
							'options' => array(
								'mailchimp_sidebars_background_color' => array(
									'title' => __('Background Color', 'thesod'),
									'type' => 'color',
								),
								'mailchimp_sidebars_input_color' => array(
									'title' => __('Input Font Color', 'thesod'),
									'type' => 'color',
								),
								'mailchimp_sidebars_input_background_color' => array(
									'title' => __('Input Background Color', 'thesod'),
									'type' => 'color',
								),
								'mailchimp_sidebars_input_border_color' => array(
									'title' => __('Input Border Color', 'thesod'),
									'type' => 'color',
								),
								'mailchimp_sidebars_input_placeholder_color' => array(
									'title' => __('Input Placeholder Font Color', 'thesod'),
									'type' => 'color',
								),
								'mailchimp_sidebars_text_color' => array(
									'title' => __('Font Color', 'thesod'),
									'type' => 'color',
								),
								'mailchimp_sidebars_label_color' => array(
									'title' => __('Label Font Color', 'thesod'),
									'type' => 'color',
								),
								'mailchimp_sidebars_button_text_color' => array(
									'title' => __('Button Text Color', 'thesod'),
									'type' => 'color',
								),
								'mailchimp_sidebars_button_hover_text_color' => array(
									'title' => __('Button Hover Text Color', 'thesod'),
									'type' => 'color',
								),
								'mailchimp_sidebars_button_background_color' => array(
									'title' => __('Button Backround Color', 'thesod'),
									'type' => 'color',
								),
								'mailchimp_sidebars_button_hover_background_color' => array(
									'title' => __('Button Hover Backround Color', 'thesod'),
									'type' => 'color',
								),
							),
						),
					),
				),

				'mailchimp_footer_colors' => array(
					'title' => __('MailChimp inside Footer', 'thesod'),
					'type' => 'group',
					'options' => array(
						'mailchimp_footer_custom_styles' => array(
							'title' => __('Use Custom Styles', 'thesod'),
							'type' => 'checkbox',
							'value' => 1,
							'default' => 0,
						),
						'mailchimp_footer_custom_styles_group' => array(
							'type' => 'hidden-group',
							'options' => array(
								'mailchimp_footer_background_color' => array(
									'title' => __('Background Color', 'thesod'),
									'type' => 'color',
								),
								'mailchimp_footer_input_color' => array(
									'title' => __('Input Font Color', 'thesod'),
									'type' => 'color',
								),
								'mailchimp_footer_input_background_color' => array(
									'title' => __('Input Background Color', 'thesod'),
									'type' => 'color',
								),
								'mailchimp_footer_input_border_color' => array(
									'title' => __('Input Border Color', 'thesod'),
									'type' => 'color',
								),
								'mailchimp_footer_input_placeholder_color' => array(
									'title' => __('Input Placeholder Font Color', 'thesod'),
									'type' => 'color',
								),
								'mailchimp_footer_text_color' => array(
									'title' => __('Font Color', 'thesod'),
									'type' => 'color',
								),
								'mailchimp_footer_label_color' => array(
									'title' => __('Label Font Color', 'thesod'),
									'type' => 'color',
								),
								'mailchimp_footer_button_text_color' => array(
									'title' => __('Button Text Color', 'thesod'),
									'type' => 'color',
								),
								'mailchimp_footer_button_hover_text_color' => array(
									'title' => __('Button Hover Text Color', 'thesod'),
									'type' => 'color',
								),
								'mailchimp_footer_button_background_color' => array(
									'title' => __('Button Backround Color', 'thesod'),
									'type' => 'color',
								),
								'mailchimp_footer_button_hover_background_color' => array(
									'title' => __('Button Hover Backround Color', 'thesod'),
									'type' => 'color',
								),
							),
						),
					),
				),
			));
		}
	}

	if(thesod_is_plugin_active('woocommerce/woocommerce.php')) {
		$options['general']['subcats']['woocommerce'] = array(
			'title' => __('WooCommerce Settings', 'thesod'),
			'options' => array(
				'size_guide_image' => array(
					'title' => __('Size Guide Image', 'thesod'),
					'type' => 'image',
					'description' => __('Upload your size guide image here', 'thesod'),
				),
				'product_quick_view' => array(
					'title' => __('Quick view', 'thesod'),
					'type' => 'checkbox',
					'value' => 1,
					'default' => 0,
					'description' => __('Enable product quick view', 'thesod'),
				),
				'products_pagination' => array(
					'title' => __('Products pagination', 'thesod'),
					'type' => 'select',
					'items' => array(
						'normal' => __('Normal', 'thesod'),
						'more' => __('Load More', 'thesod'),
						'scroll' => __('Infinite Scroll', 'thesod')
					),
					'default' => 'normal',
					'description' => __('WooCommerce products pagination type', 'thesod')
				),
				'catalog_view' => array(
					'title' => __('Enable catalog mode', 'thesod'),
					'type' => 'checkbox',
					'value' => 1,
					'default' => 0,
					'description' => __('Enable catalog mode. This will disable Add To Cart buttons / Checkout and Shopping cart.', 'thesod'),
				),

				'hide_card_icon' => array(
					'title' => __('Hide Card Icon', 'thesod'),
					'type' => 'checkbox',
					'value' => 1,
					'default' => 0,
				),
				'checkout_type' => array(
					'title' => __('Checkout Page', 'thesod'),
					'type' => 'select',
					'items' => array(
						'multi-step' => __('Multi-Step Checkout', 'thesod'),
						'one-page' => __('One-Page Checkout', 'thesod')
					),
					'default' => 'multi-step',
					'description' => __('WooCommerce checkout view', 'thesod')
				),
				'hamburger_menu_cart_position' => array(
					'title' => __('Cart Icon Position For Hamburger Menu', 'thesod'),
					'type' => 'select',
					'items' => array(
						'' => __('Visible In Menu Bar', 'thesod'),
						'1' => __('Visible On-Top Near Hamburger Icon', 'thesod'),
					),
				),
				'cart_label_count' => array(
					'title' => __('Product amount label (cart icon)', 'thesod'),
					'type' => 'select',
					'items' => array(
						'0' => __('Show Positions Amount', 'thesod'),
						'1' => __('Show Total Product Amount', 'thesod'),
					),
				),
				'woocommerce_activate_images_sizes' => array(
					'title' => __('Activate thesod\'s Product Image Settings', 'thesod'),
					'type' => 'checkbox',
					'value' => 1,
					'default' => 0,
					//'description' => __('Use custom image sizes for woocommerce products instead ', 'thesod'),
				),
				'woocommerce_catalog_image' => array(
					'title' => __('WooCommerce Catalog Image Size', 'thesod'),
					'type' => 'group',
					'options' => array(
						'woocommerce_catalog_image_width' => array(
							'title' => __('Width', 'thesod'),
							'type' => 'fixed-number',
							'min' => 0,
							'max' => 1000,
							'default' => 0,
						),
						'woocommerce_catalog_image_height' => array(
							'title' => __('Height', 'thesod'),
							'type' => 'fixed-number',
							'min' => 0,
							'max' => 1000,
							'default' => 0,
						),
					),
				),
				'woocommerce_product_image' => array(
					'title' => __('WooCommerce Single Product Image Size', 'thesod'),
					'type' => 'group',
					'options' => array(
						'woocommerce_product_image_width' => array(
							'title' => __('Width', 'thesod'),
							'type' => 'fixed-number',
							'min' => 0,
							'max' => 1000,
							'default' => 0,
						),
						'woocommerce_product_image_height' => array(
							'title' => __('Height', 'thesod'),
							'type' => 'fixed-number',
							'min' => 0,
							'max' => 1000,
							'default' => 0,
						),
					),
				),
				'woocommerce_thumbnail_image' => array(
					'title' => __('WooCommerce Product Thumbnails Image Size', 'thesod'),
					'type' => 'group',
					'options' => array(
						'woocommerce_thumbnail_image_width' => array(
							'title' => __('Width', 'thesod'),
							'type' => 'fixed-number',
							'min' => 0,
							'max' => 1000,
							'default' => 0,
						),
						'woocommerce_thumbnail_image_height' => array(
							'title' => __('Height', 'thesod'),
							'type' => 'fixed-number',
							'min' => 0,
							'max' => 1000,
							'default' => 0,
						),
					),
				),
			)
		);

		$options['fonts']['subcats']['woocommerce_fonts'] = array(
			'title' => __('WooCommerce Fonts', 'thesod'),
			'options' => array(

				'product_title_listing_font' => array(
					'title' => __('Product Title (Listings & Grids)', 'thesod'),
					'type' => 'group',
					'options' => array(
						'product_title_listing_font_family' => array(
							'title' => __('Font Family', 'thesod'),
							'type' => 'font-select',
						),
						'product_title_listing_font_style' => array(
							'title' => __('Font Style', 'thesod'),
							'type' => 'font-style',
						),
						'product_title_listing_font_sets' => array(
							'title' => __('Font Sets', 'thesod'),
							'type' => 'font-sets',
							'default' => 'latin,latin-ext'
						),
						'product_title_listing_font_size' => array(
							'title' => __('Font Size', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 16,
						),
						'product_title_listing_line_height' => array(
							'title' => __('Line Height', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),

				'product_title_page_font' => array(
					'title' => __('Product Title (Product Page)', 'thesod'),
					'type' => 'group',
					'options' => array(
						'product_title_page_font_family' => array(
							'title' => __('Font Family', 'thesod'),
							'type' => 'font-select',
						),
						'product_title_page_font_style' => array(
							'title' => __('Font Style', 'thesod'),
							'type' => 'font-style',
						),
						'product_title_page_font_sets' => array(
							'title' => __('Font Sets', 'thesod'),
							'type' => 'font-sets',
							'default' => 'latin,latin-ext'
						),
						'product_title_page_font_size' => array(
							'title' => __('Font Size', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 16,
						),
						'product_title_page_line_height' => array(
							'title' => __('Line Height', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'product_title_widget_font' => array(
					'title' => __('Product Title (Widget)', 'thesod'),
					'type' => 'group',
					'options' => array(
						'product_title_widget_font_family' => array(
							'title' => __('Font Family', 'thesod'),
							'type' => 'font-select',
						),
						'product_title_widget_font_style' => array(
							'title' => __('Font Style', 'thesod'),
							'type' => 'font-style',
						),
						'product_title_widget_font_sets' => array(
							'title' => __('Font Sets', 'thesod'),
							'type' => 'font-sets',
							'default' => 'latin,latin-ext'
						),
						'product_title_widget_font_size' => array(
							'title' => __('Font Size', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 16,
						),
						'product_title_widget_line_height' => array(
							'title' => __('Line Height', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'product_title_cart_font' => array(
					'title' => __('Product Title (Cart)', 'thesod'),
					'type' => 'group',
					'options' => array(
						'product_title_cart_font_family' => array(
							'title' => __('Font Family', 'thesod'),
							'type' => 'font-select',
						),
						'product_title_cart_font_style' => array(
							'title' => __('Font Style', 'thesod'),
							'type' => 'font-style',
						),
						'product_title_cart_font_sets' => array(
							'title' => __('Font Sets', 'thesod'),
							'type' => 'font-sets',
							'default' => 'latin,latin-ext'
						),
						'product_title_cart_font_size' => array(
							'title' => __('Font Size', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 16,
						),
						'product_title_cart_line_height' => array(
							'title' => __('Line Height', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),

				'product_price_listing_font' => array(
					'title' => __('Product Price (Listings & Grids)', 'thesod'),
					'type' => 'group',
					'options' => array(
						'product_price_listing_font_family' => array(
							'title' => __('Font Family', 'thesod'),
							'type' => 'font-select',
						),
						'product_price_listing_font_style' => array(
							'title' => __('Font Style', 'thesod'),
							'type' => 'font-style',
						),
						'product_price_listing_font_sets' => array(
							'title' => __('Font Sets', 'thesod'),
							'type' => 'font-sets',
							'default' => 'latin,latin-ext'
						),
						'product_price_listing_font_size' => array(
							'title' => __('Font Size', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 16,
						),
						'product_price_listing_line_height' => array(
							'title' => __('Line Height', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'product_price_page_font' => array(
					'title' => __('Product Price (Product Page)', 'thesod'),
					'type' => 'group',
					'options' => array(
						'product_price_page_font_family' => array(
							'title' => __('Font Family', 'thesod'),
							'type' => 'font-select',
						),
						'product_price_page_font_style' => array(
							'title' => __('Font Style', 'thesod'),
							'type' => 'font-style',
						),
						'product_price_page_font_sets' => array(
							'title' => __('Font Sets', 'thesod'),
							'type' => 'font-sets',
							'default' => 'latin,latin-ext'
						),
						'product_price_page_font_size' => array(
							'title' => __('Font Size', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 16,
						),
						'product_price_page_line_height' => array(
							'title' => __('Line Height', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'product_price_widget_font' => array(
					'title' => __('Product Price (Widget)', 'thesod'),
					'type' => 'group',
					'options' => array(
						'product_price_widget_font_family' => array(
							'title' => __('Font Family', 'thesod'),
							'type' => 'font-select',
						),
						'product_price_widget_font_style' => array(
							'title' => __('Font Style', 'thesod'),
							'type' => 'font-style',
						),
						'product_price_widget_font_sets' => array(
							'title' => __('Font Sets', 'thesod'),
							'type' => 'font-sets',
							'default' => 'latin,latin-ext'
						),
						'product_price_widget_font_size' => array(
							'title' => __('Font Size', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 16,
						),
						'product_price_widget_line_height' => array(
							'title' => __('Line Height', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
				'product_price_cart_font' => array(
					'title' => __('Product Price (Cart)', 'thesod'),
					'type' => 'group',
					'options' => array(
						'product_price_cart_font_family' => array(
							'title' => __('Font Family', 'thesod'),
							'type' => 'font-select',
						),
						'product_price_cart_font_style' => array(
							'title' => __('Font Style', 'thesod'),
							'type' => 'font-style',
						),
						'product_price_cart_font_sets' => array(
							'title' => __('Font Sets', 'thesod'),
							'type' => 'font-sets',
							'default' => 'latin,latin-ext'
						),
						'product_price_cart_font_size' => array(
							'title' => __('Font Size', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 100,
							'default' => 16,
						),
						'product_price_cart_line_height' => array(
							'title' => __('Line Height', 'thesod'),
							'type' => 'fixed-number',
							'min' => 10,
							'max' => 150,
							'default' => 18,
						),
					),
				),
			)
		);
		$options['colors']['subcats']['woocommerce_colors'] = array(
			'title' => __('WooCommerce Colors', 'thesod'),
			'options' => array(
				'product_title_listing_color' => array(
					'title' => __('Product Title (Listings & Grids)', 'thesod'),
					'type' => 'color',
				),
				'product_title_page_color' => array(
					'title' => __('Product Title (Product Page)', 'thesod'),
					'type' => 'color',
				),
				'product_title_widget_color' => array(
					'title' => __('Product Title (Widget)', 'thesod'),
					'type' => 'color',
				),
				'product_title_cart_color' => array(
					'title' => __('Product Title (Cart)', 'thesod'),
					'type' => 'color',
				),
				'product_price_listing_color' => array(
					'title' => __('Product Price (Listings & Grids)', 'thesod'),
					'type' => 'color',
				),
				'product_price_page_color' => array(
					'title' => __('Product Price (Product Page)', 'thesod'),
					'type' => 'color',
				),
				'product_price_widget_color' => array(
					'title' => __('Product Price (Widget)', 'thesod'),
					'type' => 'color',
				),
				'product_price_cart_color' => array(
					'title' => __('Product Price (Cart)', 'thesod'),
					'type' => 'color',
				),
				'product_separator_listing_color' => array(
					'title' => __('Product Separator (Listings & Grids)', 'thesod'),
					'type' => 'color',
				),
				'cart_table_header_color' => array(
					'title' => __(' Cart & checkout table titles', 'thesod'),
					'type' => 'color',
				),
				'cart_table_header_background_color' => array(
					'title' => __('Cart & checkout table header background', 'thesod'),
					'type' => 'color',
				),
				'cart_form_labels_color' => array(
					'title' => __('Cart & checkout form labels', 'thesod'),
					'type' => 'color',
				),
				'checkout_step_title_color' => array(
					'title' => __('Checkout inactive step title', 'thesod'),
					'type' => 'color',
				),
				'checkout_step_background_color' => array(
					'title' => __('Checkout inactive step background', 'thesod'),
					'type' => 'color',
				),
				'checkout_step_title_active_color' => array(
					'title' => __('Checkout active step title', 'thesod'),
					'type' => 'color',
				),
				'checkout_step_background_active_color' => array(
					'title' => __('Checkout active step background', 'thesod'),
					'type' => 'color',
				),
			)
		);

	} else {

		$options['general']['subcats']['woocommerce'] = array(
			'title' => __('WooCommerce Settings', 'thesod'),
			'hidden' => true,
			'options' => array(
				'size_guide_image' => array( 'type' => 'hidden', ),
				'product_quick_view' => array( 'type' => 'hidden', ),
				'products_pagination' => array( 'type' => 'hidden', ),
				'catalog_view' => array( 'type' => 'hidden', ),
				'checkout_type' => array( 'type' => 'hidden', ),
				'hamburger_menu_cart_position' => array( 'type' => 'hidden', ),
				'product_title_listing_font_family' => array( 'type' => 'hidden', ),
				'product_title_listing_font_style' => array( 'type' => 'hidden', ),
				'product_title_listing_font_sets' => array( 'type' => 'hidden', ),
				'product_title_listing_font_size' => array( 'type' => 'hidden', ),
				'product_title_listing_line_height' => array( 'type' => 'hidden', ),
				'product_title_page_font_family' => array( 'type' => 'hidden', ),
				'product_title_page_font_style' => array( 'type' => 'hidden', ),
				'product_title_page_font_sets' => array( 'type' => 'hidden', ),
				'product_title_page_font_size' => array( 'type' => 'hidden', ),
				'product_title_page_line_height' => array( 'type' => 'hidden', ),
				'product_title_widget_font_family' => array( 'type' => 'hidden', ),
				'product_title_widget_font_style' => array( 'type' => 'hidden', ),
				'product_title_widget_font_sets' => array( 'type' => 'hidden', ),
				'product_title_widget_font_size' => array( 'type' => 'hidden', ),
				'product_title_widget_line_height' => array( 'type' => 'hidden', ),
				'product_title_cart_font_family' => array( 'type' => 'hidden', ),
				'product_title_cart_font_style' => array( 'type' => 'hidden', ),
				'product_title_cart_font_sets' => array( 'type' => 'hidden', ),
				'product_title_cart_font_size' => array( 'type' => 'hidden', ),
				'product_title_cart_line_height' => array( 'type' => 'hidden', ),
				'product_price_listing_font_family' => array( 'type' => 'hidden', ),
				'product_price_listing_font_style' => array( 'type' => 'hidden', ),
				'product_price_listing_font_sets' => array( 'type' => 'hidden', ),
				'product_price_listing_font_size' => array( 'type' => 'hidden', ),
				'product_price_listing_line_height' => array( 'type' => 'hidden', ),
				'product_price_page_font_family' => array( 'type' => 'hidden', ),
				'product_price_page_font_style' => array( 'type' => 'hidden', ),
				'product_price_page_font_sets' => array( 'type' => 'hidden', ),
				'product_price_page_font_size' => array( 'type' => 'hidden', ),
				'product_price_page_line_height' => array( 'type' => 'hidden', ),
				'product_price_widget_font_family' => array( 'type' => 'hidden', ),
				'product_price_widget_font_style' => array( 'type' => 'hidden', ),
				'product_price_widget_font_sets' => array( 'type' => 'hidden', ),
				'product_price_widget_font_size' => array( 'type' => 'hidden', ),
				'product_price_widget_line_height' => array( 'type' => 'hidden', ),
				'product_price_cart_font_family' => array( 'type' => 'hidden', ),
				'product_price_cart_font_style' => array( 'type' => 'hidden', ),
				'product_price_cart_font_sets' => array( 'type' => 'hidden', ),
				'product_price_cart_font_size' => array( 'type' => 'hidden', ),
				'product_price_cart_line_height' => array( 'type' => 'hidden', ),
				'product_title_listing_color' => array( 'type' => 'hidden', ),
				'product_title_page_color' => array( 'type' => 'hidden', ),
				'product_title_widget_color' => array( 'type' => 'hidden', ),
				'product_title_cart_color' => array( 'type' => 'hidden', ),
				'product_price_listing_color' => array( 'type' => 'hidden', ),
				'product_price_page_color' => array( 'type' => 'hidden', ),
				'product_price_widget_color' => array( 'type' => 'hidden', ),
				'product_price_cart_color' => array( 'type' => 'hidden', ),
				'product_separator_listing_color' => array( 'type' => 'hidden', ),
			)
		);
	}

	if(!thesod_get_option('activate_nivoslider')) {
		unset($options['slideshow']);
	}

	return $options;
}

function thesod_generate_socials_icons_options () {
	$options = array();
	foreach(thesod_socials_icons_list() as $icon => $title) {
		$options[$icon.'_active'] = array(
			'title' => sprintf(__('Activate %s Icon', 'thesod'), $title),
			'type' => 'checkbox',
			'value' => 1,
			'default' => 0,
		);
	}
	foreach(thesod_socials_icons_list() as $icon => $title) {
		$options[$icon.'_link'] = array(
			'title' => sprintf(__('%s Link', 'thesod'), $title),
			'type' => 'input',
			'default' => '#',
		);
	}
	return $options;
}

if(!function_exists('thesod_get_current_language')) {
function thesod_get_current_language() {
	if(thesod_is_plugin_active('sitepress-multilingual-cms/sitepress.php') && defined('ICL_LANGUAGE_CODE') && ICL_LANGUAGE_CODE) {
		return ICL_LANGUAGE_CODE;
	}
	if(thesod_is_plugin_active('polylang/polylang.php') && pll_current_language('slug')) {
		return pll_current_language('slug');
	}
	return false;
}
}

if(!function_exists('thesod_get_default_language')) {
function thesod_get_default_language() {
	if(thesod_is_plugin_active('sitepress-multilingual-cms/sitepress.php')) {
		global $sitepress;
		if(is_object($sitepress) && $sitepress->get_default_language()) {
			return $sitepress->get_default_language();
		}
	}
	if(thesod_is_plugin_active('polylang/polylang.php') && pll_default_language('slug')) {
		return pll_default_language('slug');
	}
	return false;
}
}

function thesod_get_option_element($oname = '', $option = array(), $default = NULL) {
	if($default !== NULL) {
		$option['default'] = $default;
	}

	if(!isset($option['default'])) {
		$option['default'] = '';
	}

	$ml_options = array('footer_html', 'top_area_button_text', 'top_area_button_link', 'contacts_address', 'contacts_phone', 'contacts_fax', 'contacts_email', 'contacts_website', 'top_area_contacts_address', 'top_area_contacts_phone', 'top_area_contacts_fax', 'top_area_contacts_email', 'top_area_contacts_website');
	if(in_array($oname, $ml_options) && is_array($option['default'])) {
		if(thesod_get_current_language()) {
			if(isset($option['default'][thesod_get_current_language()])) {
				$option['default'] = $option['default'][thesod_get_current_language()];
			} elseif(thesod_get_default_language() && isset($option['default'][thesod_get_default_language()])) {
				$option['default'] = $option['default'][thesod_get_default_language()];
			} else {
				$option['default'] = '';
			}
		}else {
			$option['default'] = reset($option['default']);
		}
	}

	$option['default'] = stripslashes($option['default']);

	if($option['type'] == 'hidden') {
		$output = '<input type="hidden" id="'.esc_attr($oname).'" name="theme_options['.esc_attr($oname).']"';
		if(isset($option['default'])) {
			$output .= ' value="'.esc_attr($option['default']).'"';
		}
		$output .= '/>';
		return $output;
	}

	$output = '<div class="'.esc_attr('option '.$oname.'_field').'">';

	if(isset($option['type'])) {

		if(isset($option['description'])) {
			$output .= '<div class="description">'.wp_kses($option['description'], array('b' => array(), 'br' => array(), 'a' => array('href' => array()))).'</div>';
		}

		$output .= '<div class="label"><label for="'.esc_attr($oname).'">'.esc_html(isset($option['title']) ? $option['title'] : '').'</label></div><div class="'.esc_attr($option['type']).'">';
		switch ($option['type']) {

		case 'input':
			$output .= '<input id="'.esc_attr($oname).'" name="theme_options['.esc_attr($oname).']"';
			if(isset($option['default'])) {
				$output .= ' value="'.esc_attr($option['default']).'"';
			}
			$output .= '/>';
			break;

		case 'icon':
			$output .= '<input id="'.esc_attr($oname).'" class="icons-picker" name="theme_options['.esc_attr($oname).']"';
			if(isset($option['default'])) {
				$output .= ' value="'.esc_attr($option['default']).'"';
			}
			$output .= '/>';
			break;

		case 'image':
			$output .= '<input id="'.esc_attr($oname).'" name="theme_options['.esc_attr($oname).']"';
			if(isset($option['default'])) {
				$output .= ' value="'.esc_attr($option['default']).'"';
			}
			$output .= '/>';
			break;

		case 'image-select':
			$skins = array('light', 'dark');
			foreach($skins as $skin) {
				foreach($option['items'] as $item) {
					$output .= '<a data-target="'.esc_attr($option['target']).'" href="'.esc_url(get_template_directory_uri().'/images/backgrounds/patterns/'.$skin.'/'.$item.'.jpg').'"><img alt="#" src="'.esc_url(get_template_directory_uri().'/images/backgrounds/patterns/'.$skin.'/'.$item.'-thumb.jpg').'"/></a>';
				}
				$output .= '<span class="clear"></span>';
			}
			break;

		case 'file':
			$output .= '<input id="'.esc_attr($oname).'" name="theme_options['.esc_attr($oname).']"';
			if(isset($option['default'])) {
				$output .= ' value="'.esc_attr($option['default']).'"';
			}
			$output .= '/>';
			break;

		case 'font-select':
			$selected = isset($option['default']) ? $option['default'] : '';
			$fontsList = thesod_fonts_list();
			$output .= '<select id="'.esc_attr($oname).'" name="theme_options['.esc_attr($oname).']">';
			foreach($fontsList as $val => $item) {
				$output .= '<option value="'.esc_attr($val).'"';
				if($val == $selected) {
					$output .= ' selected';
				}
				$output .= '>'.esc_html($item).'</option>';
			}
			$output .= '</select>';
			break;

		case 'font-style':
			$selected = isset($option['default']) ? $option['default'] : '';
			$output .= '<select id="'.esc_attr($oname).'" name="theme_options['.esc_attr($oname).']" data-value="'.esc_attr($selected).'"></select>';
			break;

		case 'font-sets':
			$output .= '<input id="'.esc_attr($oname).'" name="theme_options['.esc_attr($oname).']"';
			if(isset($option['default'])) {
				$output .= ' data-value="'.esc_attr($option['default']).'"';
			}
			$output .= '/>';
			break;

		case 'fixed-number':
			$min = isset($option['min']) ? $option['min'] : 1;
			$max = isset($option['max']) ? $option['max'] : $min+1;
			$default = isset($option['default']) ? $option['default'] : $min;
			$output .= '<input id="'.esc_attr($oname).'" name="theme_options['.esc_attr($oname).']" value="'.esc_attr($default).'" data-min-value="'.esc_attr($min).'" data-max-value="'.esc_attr($max).'"/>';
			break;

		case 'color':
			$output .= '<input id="'.esc_attr($oname).'" name="theme_options['.esc_attr($oname).']"';
			if(isset($option['default'])) {
				$output .= ' value="'.esc_attr($option['default']).'"';
			}
			$output .= ' class="color-select"/>';
			break;

		case 'textarea':
			$output .= '<textarea id="'.esc_attr($oname).'" name="theme_options['.esc_attr($oname).']" cols="100" rows="15">';
			if(isset($option['default'])) {
				$output .= esc_textarea($option['default']);
			}
			$output .= '</textarea>';
			break;

		case 'select':
			$selected = isset($option['default']) ? $option['default'] : '';
			$output .= '<select id="'.esc_attr($oname).'" name="theme_options['.esc_attr($oname).']">';
			foreach($option['items'] as $val => $item) {
				$output .= '<option value="'.$val.'"';
				if($val == $selected) {
					$output .= ' selected';
				}
				$output .= '>'.$item.'</option>';
			}
			$output .= '</select>';
			break;

		default:
			$output .= '<input id="'.esc_attr($oname).'" name="theme_options['.esc_attr($oname).']"';
			if(isset($option['default'])) {
				$output .= ' value="'.esc_attr($option['default']).'"';
			}
			$output .= '/>';
		}

		$output .= '</div>';

		if($option['type'] == 'checkbox') {
			$output = '<div class="option checkbox-option '.esc_attr($oname).'_field">'.(isset($option['description']) ? '<div class="description checkbox-description">'.wp_kses($option['description'], array('b' => array(), 'br' => array(), 'a' => array('href' => array(), 'target' => array()))).'</div>' : '').'<div class="checkbox"><input id="'.esc_attr($oname).'" name="theme_options['.esc_attr($oname).']" type="checkbox" value="'.esc_attr($option['value']).'"';
			if($option['default'] == $option['value']) {
				$output .= ' checked';
			}
			$output .= '> <label for="'.esc_attr($oname).'">'.esc_html($option['title']).'</label></div>';
		}

		if($option['type'] == 'group') {
			$options_values = get_option('thesod_theme_options');
			$output = '<div class="option group-option '.esc_attr($oname).'_field">'.(isset($option['description']) ? '<div class="description group-description">'.esc_html($option['description']).'</div>' : '');
			$output .= '<div class="label"><label for="'.esc_attr($oname).'">'.esc_html($option['title']).'</label></div><div class="'.esc_attr($option['type']).'">';
			foreach($option['options'] as $goname => $goption) {
				$output .= thesod_get_option_element($goname, $goption, isset($options_values[$goname]) ? $options_values[$goname] : NULL);
			}
			$output .= '</div>';
		}

		if($option['type'] == 'group-empty') {
			$output = '<div class="option group-empty-block '.esc_attr($oname).'_field">';
		}

		if($option['type'] == 'html-block') {
			$output = '<div class="option html-block '.esc_attr($oname).'_field">'.$option['html'];
		}

		if($option['type'] == 'hidden-group') {
			$options_values = get_option('thesod_theme_options');
			$output = '<div id="'.esc_attr($oname).'" class="hidden-group-option '.esc_attr($oname).'_field">';
			$output .= '<div class="'.esc_attr($option['type']).'">';
			foreach($option['options'] as $goname => $goption) {
				$output .= thesod_get_option_element($goname, $goption, isset($options_values[$goname]) ? $options_values[$goname] : NULL);
			}
			$output .= '</div>';
		}

		$output .= '<div class="clear"></div></div>';
	}

	return $output;
}

function thesod_get_pages_list() {
	$pages = array('' => __('Default', 'thesod'));
	$pages_list = get_pages();
	foreach ($pages_list as $page) {
		$pages[$page->ID] = $page->post_title . ' (ID = ' . $page->ID . ')';
	}
	return $pages;
}

function thesod_color_skin_defaults($skin = 'light') {
	$skin_defaults = apply_filters('thesod_default_skins_options', array(
		'light' => array(
			'main_menu_font_family' => 'Montserrat',
			'main_menu_font_style' => '700',
			'main_menu_font_sets' => '',
			'main_menu_font_size' => '14',
			'main_menu_line_height' => '25',
			'submenu_font_family' => 'Source Sans Pro',
			'submenu_font_style' => 'regular',
			'submenu_font_sets' => '',
			'submenu_font_size' => '16',
			'submenu_line_height' => '20',
			'overlay_menu_font_family' => 'Montserrat',
			'overlay_menu_font_style' => '700',
			'overlay_menu_font_sets' => '',
			'overlay_menu_font_size' => '32',
			'overlay_menu_line_height' => '64',
			'mobile_menu_font_family' => 'Source Sans Pro',
			'mobile_menu_font_style' => 'regular',
			'mobile_menu_font_sets' => '',
			'mobile_menu_font_size' => '16',
			'mobile_menu_line_height' => '20',
			'styled_subtitle_font_family' => 'Source Sans Pro',
			'styled_subtitle_font_style' => '300',
			'styled_subtitle_font_sets' => '',
			'styled_subtitle_font_size' => '24',
			'styled_subtitle_line_height' => '37',
			'styled_subtitle_font_size_tablet' => '24',
			'styled_subtitle_line_height_tablet' => '37',
			'styled_subtitle_font_size_mobile' => '24',
			'styled_subtitle_line_height_mobile' => '37',
			'h1_font_family' => 'Montserrat',
			'h1_font_style' => '700',
			'h1_font_sets' => '',
			'h1_font_size' => '50',
			'h1_line_height' => '69',
			'h1_font_size_tablet' => '36',
			'h1_line_height_tablet' => '53',
			'h1_font_size_mobile' => '28',
			'h1_line_height_mobile' => '42',
			'h2_font_family' => 'Montserrat',
			'h2_font_style' => '700',
			'h2_font_sets' => '',
			'h2_font_size' => '36',
			'h2_line_height' => '53',
			'h2_font_size_tablet' => '28',
			'h2_line_height_tablet' => '42',
			'h2_font_size_mobile' => '24',
			'h2_line_height_mobile' => '38',
			'h3_font_family' => 'Montserrat',
			'h3_font_style' => '700',
			'h3_font_sets' => '',
			'h3_font_size' => '28',
			'h3_line_height' => '42',
			'h3_font_size_tablet' => '24',
			'h3_line_height_tablet' => '38',
			'h3_font_size_mobile' => '24',
			'h3_line_height_mobile' => '38',
			'h4_font_family' => 'Montserrat',
			'h4_font_style' => '700',
			'h4_font_sets' => '',
			'h4_font_size' => '24',
			'h4_line_height' => '38',
			'h4_font_size_tablet' => '24',
			'h4_line_height_tablet' => '38',
			'h4_font_size_mobile' => '24',
			'h4_line_height_mobile' => '38',
			'h5_font_family' => 'Montserrat',
			'h5_font_style' => '700',
			'h5_font_sets' => '',
			'h5_font_size' => '19',
			'h5_line_height' => '30',
			'h5_font_size_tablet' => '19',
			'h5_line_height_tablet' => '30',
			'h5_font_size_mobile' => '19',
			'h5_line_height_mobile' => '30',
			'h6_font_family' => 'Montserrat',
			'h6_font_style' => '700',
			'h6_font_sets' => '',
			'h6_font_size' => '16',
			'h6_line_height' => '25',
			'h6_font_size_tablet' => '16',
			'h6_line_height_tablet' => '25',
			'h6_font_size_mobile' => '16',
			'h6_line_height_mobile' => '25',
			'xlarge_title_font_family' => 'Montserrat',
			'xlarge_title_font_style' => '700',
			'xlarge_title_font_sets' => 'latin,latin-ext',
			'xlarge_title_font_size' => '80',
			'xlarge_title_line_height' => '90',
			'xlarge_font_size_tablet' => '50',
			'xlarge_line_height_tablet' => '69',
			'xlarge_font_size_mobile' => '36',
			'xlarge_line_height_mobile' => '53',
			'light_title_font_family' => 'Montserrat UltraLight',
			'light_title_font_style' => 'regular',
			'light_title_font_sets' => '',
			'body_font_family' => 'Source Sans Pro',
			'body_font_style' => 'regular',
			'body_font_sets' => '',
			'body_font_size' => '16',
			'body_line_height' => '25',
			'title_excerpt_font_family' => 'Source Sans Pro',
			'title_excerpt_font_style' => '300',
			'title_excerpt_font_sets' => '',
			'title_excerpt_font_size' => '24',
			'title_excerpt_line_height' => '37',
			'title_excerpt_font_size_tablet' => '24',
			'title_excerpt_line_height_tablet' => '37',
			'title_excerpt_font_size_mobile' => '24',
			'title_excerpt_line_height_mobile' => '37',
			'widget_title_font_family' => 'Montserrat',
			'widget_title_font_style' => '700',
			'widget_title_font_sets' => '',
			'widget_title_font_size' => '19',
			'widget_title_line_height' => '30',
			'button_font_family' => 'Montserrat',
			'button_font_style' => '700',
			'button_font_sets' => 'latin',
			'button_thin_font_family' => 'Montserrat UltraLight',
			'button_thin_font_style' => 'regular',
			'button_thin_font_sets' => '',
			'portfolio_title_font_family' => 'Montserrat',
			'portfolio_title_font_style' => '700',
			'portfolio_title_font_sets' => '',
			'portfolio_title_font_size' => '16',
			'portfolio_title_line_height' => '24',
			'portfolio_description_font_family' => 'Source Sans Pro',
			'portfolio_description_font_style' => 'regular',
			'portfolio_description_font_sets' => '',
			'portfolio_description_font_size' => '16',
			'portfolio_description_line_height' => '24',
			'quickfinder_title_font_family' => 'Montserrat',
			'quickfinder_title_font_style' => '700',
			'quickfinder_title_font_sets' => 'latin',
			'quickfinder_title_font_size' => '24',
			'quickfinder_title_line_height' => '38',
			'quickfinder_title_thin_font_family' => 'Montserrat UltraLight',
			'quickfinder_title_thin_font_style' => 'regular',
			'quickfinder_title_thin_font_sets' => 'latin,latin-ext',
			'quickfinder_title_thin_font_size' => '24',
			'quickfinder_title_thin_line_height' => '38',
			'quickfinder_description_font_family' => 'Source Sans Pro',
			'quickfinder_description_font_style' => 'regular',
			'quickfinder_description_font_sets' => '',
			'quickfinder_description_font_size' => '16',
			'quickfinder_description_line_height' => '25',
			'gallery_title_font_family' => 'Montserrat UltraLight',
			'gallery_title_font_style' => 'regular',
			'gallery_title_font_sets' => '',
			'gallery_title_font_size' => '24',
			'gallery_title_line_height' => '30',
			'gallery_title_bold_font_family' => 'Montserrat',
			'gallery_title_bold_font_style' => '700',
			'gallery_title_bold_font_sets' => 'latin,latin-ext',
			'gallery_title_bold_font_size' => '24',
			'gallery_title_bold_line_height' => '31',
			'gallery_description_font_family' => 'Source Sans Pro',
			'gallery_description_font_style' => '300',
			'gallery_description_font_sets' => '',
			'gallery_description_font_size' => '17',
			'gallery_description_line_height' => '24',
			'testimonial_font_family' => 'Source Sans Pro',
			'testimonial_font_style' => '300',
			'testimonial_font_sets' => '',
			'testimonial_font_size' => '24',
			'testimonial_line_height' => '36',
			'counter_font_family' => 'Montserrat',
			'counter_font_style' => '700',
			'counter_font_sets' => '',
			'counter_font_size' => '50',
			'counter_line_height' => '69',
			'counter_font_size_tablet' => '36',
			'counter_line_height_tablet' => '53',
			'counter_font_size_mobile' => '36',
			'counter_line_height_mobile' => '53',
			'tabs_title_font_family' => 'Montserrat',
			'tabs_title_font_style' => '700',
			'tabs_title_font_sets' => 'latin,latin-ext',
			'tabs_title_font_size' => '16',
			'tabs_title_line_height' => '25',
			'tabs_title_thin_font_family' => 'Montserrat UltraLight',
			'tabs_title_thin_font_style' => 'regular',
			'tabs_title_thin_font_sets' => 'latin,latin-ext',
			'tabs_title_thin_font_size' => '16',
			'tabs_title_thin_line_height' => '25',
			'woocommerce_price_font_family' => 'Montserrat',
			'woocommerce_price_font_style' => 'regular',
			'woocommerce_price_font_sets' => '',
			'woocommerce_price_font_size' => '26',
			'woocommerce_price_line_height' => '36',
			'slideshow_title_font_family' => 'Montserrat',
			'slideshow_title_font_style' => '700',
			'slideshow_title_font_sets' => '',
			'slideshow_title_font_size' => '50',
			'slideshow_title_line_height' => '69',
			'slideshow_description_font_family' => 'Source Sans Pro',
			'slideshow_description_font_style' => 'regular',
			'slideshow_description_font_sets' => '',
			'slideshow_description_font_size' => '16',
			'slideshow_description_line_height' => '25',
			'product_title_listing_font_family' => 'Montserrat',
			'product_title_listing_font_style' => '700',
			'product_title_listing_font_sets' => 'latin,latin-ext',
			'product_title_listing_font_size' => '16',
			'product_title_listing_line_height' => '25',
			'product_title_page_font_family' => 'Montserrat UltraLight',
			'product_title_page_font_style' => 'regular',
			'product_title_page_font_sets' => 'latin,latin-ext',
			'product_title_page_font_size' => '28',
			'product_title_page_line_height' => '42',
			'product_title_widget_font_family' => 'Source Sans Pro',
			'product_title_widget_font_style' => 'regular',
			'product_title_widget_font_sets' => 'latin,latin-ext',
			'product_title_widget_font_size' => '16',
			'product_title_widget_line_height' => '25',
			'product_title_cart_font_family' => 'Source Sans Pro',
			'product_title_cart_font_style' => 'regular',
			'product_title_cart_font_sets' => 'latin,latin-ext',
			'product_title_cart_font_size' => '16',
			'product_title_cart_line_height' => '25',
			'product_price_listing_font_family' => 'Source Sans Pro',
			'product_price_listing_font_style' => 'regular',
			'product_price_listing_font_sets' => 'latin,latin-ext',
			'product_price_listing_font_size' => '16',
			'product_price_listing_line_height' => '25',
			'product_price_page_font_family' => 'Source Sans Pro',
			'product_price_page_font_style' => '300',
			'product_price_page_font_sets' => 'latin,latin-ext',
			'product_price_page_font_size' => '36',
			'product_price_page_line_height' => '36',
			'product_price_widget_font_family' => 'Source Sans Pro',
			'product_price_widget_font_style' => '300',
			'product_price_widget_font_sets' => 'latin,latin-ext',
			'product_price_widget_font_size' => '20',
			'product_price_widget_line_height' => '30',
			'product_price_cart_font_family' => 'Source Sans Pro',
			'product_price_cart_font_style' => '300',
			'product_price_cart_font_sets' => 'latin,latin-ext',
			'product_price_cart_font_size' => '24',
			'product_price_cart_line_height' => '30',
			'basic_outer_background_color' => '#f0f3f2',
			'top_background_color' => '#ffffff',
			'main_background_color' => '#ffffff',
			'styled_elements_background_color' => '#f4f6f7',
			'styled_elements_color_1' => '#00bcd4',
			'styled_elements_color_2' => '#99a9b5',
			'styled_elements_color_3' => '#f44336',
			'styled_elements_color_4' => '#393d50',
			'divider_default_color' => '#dfe5e8',
			'box_border_color' => '#dfe5e8',
			'main_menu_level1_color' => '#3c3950',
			'main_menu_level1_background_color' => '',
			'main_menu_level1_hover_color' => '#00bcd4',
			'main_menu_level1_hover_background_color' => '',
			'main_menu_level1_active_color' => '#3c3950',
			'main_menu_level1_active_background_color' => '#3c3950',
			'main_menu_level2_color' => '#5f727f',
			'main_menu_level2_background_color' => '#f4f6f7',
			'main_menu_level2_hover_color' => '#3c3950',
			'main_menu_level2_hover_background_color' => '#ffffff',
			'main_menu_level2_active_color' => '#3c3950',
			'main_menu_level2_active_background_color' => '#ffffff',
			'main_menu_mega_column_title_color' => '#3c3950',
			'main_menu_mega_column_title_hover_color' => '#00bcd4',
			'main_menu_mega_column_title_active_color' => '#00bcd4',
			'main_menu_level3_color' => '#5f727f',
			'main_menu_level3_background_color' => '#ffffff',
			'main_menu_level3_hover_color' => '#ffffff',
			'main_menu_level3_hover_background_color' => '#494c64',
			'main_menu_level3_active_color' => '#00bcd4',
			'main_menu_level3_active_background_color' => '#ffffff',
			'main_menu_level1_light_color' => '#ffffff',
			'main_menu_level1_light_hover_color' => '#00bcd4',
			'main_menu_level1_light_active_color' => '#ffffff',
			'main_menu_level2_border_color' => '#dfe5e8',
			'mega_menu_icons_color' => '',
			'overlay_menu_background_color' => '#212331',
			'overlay_menu_color' => '#ffffff',
			'overlay_menu_hover_color' => '#00bcd4',
			'overlay_menu_active_color' => '#00bcd4',
			'hamburger_menu_icon_color' => '',
			'hamburger_menu_icon_light_color' => '',
			'mobile_menu_button_color' => '',
			'mobile_menu_button_light_color' => '',
			'mobile_menu_background_color' => '',
			'mobile_menu_level1_color' => '#5f727f',
			'mobile_menu_level1_background_color' => '#f4f6f7',
			'mobile_menu_level1_active_color' => '#3c3950',
			'mobile_menu_level1_active_background_color' => '#ffffff',
			'mobile_menu_level2_color' => '#5f727f',
			'mobile_menu_level2_background_color' => '#f4f6f7',
			'mobile_menu_level2_active_color' => '#3c3950',
			'mobile_menu_level2_active_background_color' => '#ffffff',
			'mobile_menu_level3_color' => '#5f727f',
			'mobile_menu_level3_background_color' => '#f4f6f7',
			'mobile_menu_level3_active_color' => '#3c3950',
			'mobile_menu_level3_active_background_color' => '#ffffff',
			'mobile_menu_border_color' => '#dfe5e8',
			'mobile_menu_social_icon_color' => '',
			'mobile_menu_hide_color' => '',
			'top_area_background_color' => '#f4f6f7',
			'top_area_border_color' => '#00bcd4',
			'top_area_separator_color' => '#dfe5e8',
			'top_area_text_color' => '#5f727f',
			'top_area_link_color' => '#5f727f',
			'top_area_link_hover_color' => '#00bcd4',
			'top_area_button_text_color' => '#ffffff',
			'top_area_button_background_color' => '#494c64',
			'top_area_button_hover_text_color' => '#ffffff',
			'top_area_button_hover_background_color' => '#00bcd4',
			'footer_background_color' => '#181828',
			'footer_text_color' => '#99a9b5',
			'footer_menu_color' => '',
			'footer_menu_hover_color' => '',
			'footer_menu_separator_color' => '',
			'footer_top_border_color' => '',
			'footer_widget_area_background_color' => '#212331',
			'footer_widget_title_color' => '#feffff',
			'footer_widget_text_color' => '#99a9b5',
			'footer_widget_link_color' => '#99a9b5',
			'footer_widget_hover_link_color' => '#00bcd4',
			'footer_widget_active_link_color' => '#00bcd4',
			'footer_widget_triangle_color' => '',
			'body_color' => '#5f727f',
			'h1_color' => '#3c3950',
			'h2_color' => '#3c3950',
			'h3_color' => '#3c3950',
			'h4_color' => '#3c3950',
			'h5_color' => '#3c3950',
			'h6_color' => '#3c3950',
			'link_color' => '#00bcd4',
			'hover_link_color' => '#384554',
			'active_link_color' => '#00bcd4',
			'copyright_text_color' => '#99a9b5',
			'copyright_link_color' => '#00bcd4',
			'title_bar_background_color' => '#333144',
			'title_bar_text_color' => '#ffffff',
			'date_filter_subtitle_color' => '#99a9b5',
			'system_icons_font' => '#99a3b0',
			'system_icons_font_2' => '#b6c6c9',
			'button_text_basic_color' => '#ffffff',
			'button_text_hover_color' => '#ffffff',
			'button_background_basic_color' => '#b6c6c9',
			'button_background_hover_color' => '#3c3950',
			'button_outline_text_basic_color' => '#00bcd4',
			'button_outline_text_hover_color' => '#ffffff',
			'button_outline_border_basic_color' => '#00bcd4',
			'widget_title_color' => '#3c3950',
			'widget_link_color' => '#5f727f',
			'widget_hover_link_color' => '#00bcd4',
			'widget_active_link_color' => '#384554',
			'portfolio_title_color' => '#5f727f',
			'portfolio_description_color' => '#5f727f',
			'portfolio_date_color' => '#99a9b5',
			'portfolio_arrow_color' => '',
			'portfolio_arrow_hover_color' => '',
			'portfolio_arrow_background_color' => '',
			'portfolio_arrow_background_hover_color' => '',
			'portfolio_sorting_controls_color' => '',
			'portfolio_sorting_background_color' => '',
			'portfolio_sorting_switch_color' => '',
			'portfolio_sorting_separator_color' => '',
			'portfolio_filter_button_color' => '',
			'portfolio_filter_button_background_color' => '',
			'portfolio_filter_button_hover_color' => '',
			'portfolio_filter_button_hover_background_color' => '',
			'portfolio_filter_button_active_color' => '',
			'portfolio_filter_button_active_background_color' => '',
			'gallery_caption_background_color' => '#000000',
			'gallery_title_color' => '#ffffff',
			'gallery_description_color' => '#ffffff',
			'slideshow_arrow_background' => '#394050',
			'slideshow_arrow_hover_background' => '#00bcd4',
			'slideshow_arrow_color' => '#ffffff',
			'sliders_arrow_color' => '#3c3950',
			'sliders_arrow_background_color' => '#b6c6c9',
			'sliders_arrow_hover_color' => '#ffffff',
			'sliders_arrow_background_hover_color' => '#00bcd4',
			'hover_effect_default_color' => '#00bcd4',
			'hover_effect_zooming_blur_color' => '#ffffff',
			'hover_effect_horizontal_sliding_color' => '#46485c',
			'hover_effect_vertical_sliding_color' => '#f44336',
			'quickfinder_title_color' => '#4c5867',
			'quickfinder_description_color' => '#5f727f',
			'testimonial_arrow_color' => '',
			'testimonial_arrow_hover_color' => '',
			'testimonial_arrow_background_color' => '',
			'testimonial_arrow_background_hover_color' => '',
			'bullets_symbol_color' => '#5f727f',
			'icons_symbol_color' => '#91a0ac',
			'icons_portfolio_gallery_hover_color' => '#ffffff',
			'pagination_basic_color' => '#99a9b5',
			'pagination_basic_background_color' => '#ffffff',
			'pagination_hover_color' => '#00bcd4',
			'pagination_active_color' => '#3c3950',
			'mini_pagination_color' => '#b6c6c9',
			'mini_pagination_active_color' => '#00bcd4',
			'blockquote_icon_testimonials' => '',
			'blockquote_icon_blockquotes' => '',
			'socials_colors_top_area' => '',
			'socials_colors_footer' => '',
			'socials_colors_posts' => '',
			'socials_colors_woocommerce' => '',
			'contact_form_light_input_color' => '',
			'contact_form_light_input_background_color' => '',
			'contact_form_light_input_border_color' => '',
			'contact_form_light_input_placeholder_color' => '',
			'contact_form_light_input_icon_color' => '',
			'contact_form_light_label_color' => '',
			'contact_form_light_button_style' => 'flat',
			'contact_form_light_button_position' => 'fullwidth',
			'contact_form_light_button_size' => 'small',
			'contact_form_light_button_text_weight' => 'normal',
			'contact_form_light_button_border' => '0',
			'contact_form_light_button_corner' => '3',
			'contact_form_light_button_text_color' => '',
			'contact_form_light_button_hover_text_color' => '',
			'contact_form_light_button_background_color' => '',
			'contact_form_light_button_hover_background_color' => '',
			'contact_form_light_button_border_color' => '',
			'contact_form_light_button_hover_border_color' => '',
			'contact_form_dark_input_color' => '',
			'contact_form_dark_input_background_color' => '',
			'contact_form_dark_input_border_color' => '',
			'contact_form_dark_input_placeholder_color' => '',
			'contact_form_dark_input_icon_color' => '',
			'contact_form_dark_label_color' => '',
			'contact_form_dark_button_style' => 'flat',
			'contact_form_dark_button_position' => 'fullwidth',
			'contact_form_dark_button_size' => 'small',
			'contact_form_dark_button_text_weight' => 'normal',
			'contact_form_dark_button_border' => '0',
			'contact_form_dark_button_corner' => '3',
			'contact_form_dark_button_text_color' => '',
			'contact_form_dark_button_hover_text_color' => '',
			'contact_form_dark_button_background_color' => '',
			'contact_form_dark_button_hover_background_color' => '',
			'contact_form_dark_button_border_color' => '',
			'contact_form_dark_button_hover_border_color' => '',
			'mailchimp_content_input_color' => '',
			'mailchimp_content_input_background_color' => '',
			'mailchimp_content_input_border_color' => '',
			'mailchimp_content_input_placeholder_color' => '',
			'mailchimp_content_text_color' => '',
			'mailchimp_content_label_color' => '',
			'mailchimp_content_button_text_color' => '',
			'mailchimp_content_button_hover_text_color' => '',
			'mailchimp_content_button_background_color' => '',
			'mailchimp_content_button_hover_background_color' => '',
			'mailchimp_sidebars_background_color' => '',
			'mailchimp_sidebars_input_color' => '',
			'mailchimp_sidebars_input_background_color' => '',
			'mailchimp_sidebars_input_border_color' => '',
			'mailchimp_sidebars_input_placeholder_color' => '',
			'mailchimp_sidebars_text_color' => '',
			'mailchimp_sidebars_label_color' => '',
			'mailchimp_sidebars_button_text_color' => '',
			'mailchimp_sidebars_button_hover_text_color' => '',
			'mailchimp_sidebars_button_background_color' => '',
			'mailchimp_sidebars_button_hover_background_color' => '',
			'mailchimp_footer_background_color' => '',
			'mailchimp_footer_input_color' => '',
			'mailchimp_footer_input_background_color' => '',
			'mailchimp_footer_input_border_color' => '',
			'mailchimp_footer_input_placeholder_color' => '',
			'mailchimp_footer_text_color' => '',
			'mailchimp_footer_label_color' => '',
			'mailchimp_footer_button_text_color' => '',
			'mailchimp_footer_button_hover_text_color' => '',
			'mailchimp_footer_button_background_color' => '',
			'mailchimp_footer_button_hover_background_color' => '',
			'form_elements_background_color' => '#f4f6f7',
			'form_elements_text_color' => '#3c3950',
			'form_elements_border_color' => '#dfe5e8',
			'breadcrumbs_default_color' => '',
			'breadcrumbs_active_color' => '',
			'breadcrumbs_hover_color' => '',
			'preloader_page_background' => '',
			'preloader_line_1' => '',
			'preloader_line_2' => '',
			'preloader_line_3' => '',
			'product_title_listing_color' => '#5f727f',
			'product_title_page_color' => '#3c3950',
			'product_title_widget_color' => '#5f727f',
			'product_title_cart_color' => '#00bcd4',
			'product_price_listing_color' => '#00bcd4',
			'product_price_page_color' => '#3c3950',
			'product_price_widget_color' => '#3c3950',
			'product_price_cart_color' => '#3c3950',
			'product_separator_listing_color' => '#000000',
			'cart_table_header_color' => '',
			'cart_table_header_background_color' => '',
			'cart_form_labels_color' => '',
			'checkout_step_title_color' => '',
			'checkout_step_background_color' => '',
			'checkout_step_title_active_color' => '',
			'checkout_step_background_active_color' => '',
			'basic_outer_background_image' => '',
			'top_background_image' => '',
			'top_area_background_image' => '',
			'main_background_image' => '',
			'footer_background_image' => '',
			'footer_widget_area_background_image' => '',
		)
	));
	if($skin) {
		return $skin_defaults[$skin];
	}
	return $skin_defaults;
}

function thesod_first_install_settings() {
	return apply_filters('thesod_default_theme_options', array(
		'page_layout_style' => 'fullwidth',
		'page_padding_top' => '0',
		'page_padding_bottom' => '0',
		'page_padding_left' => '0',
		'page_padding_right' => '0',
		'disable_smooth_scroll' => '1',
		'logo_width' => '164',
		'small_logo_width' => '132',
		'logo' => get_template_directory_uri() . '/images/default-logo.png',
		'small_logo' => get_template_directory_uri() . '/images/default-logo-small.png',
		'logo_light' => get_template_directory_uri() . '/images/default-logo-light.png',
		'small_logo_light' => get_template_directory_uri() . '/images/default-logo-light-small.png',
		'favicon' => get_template_directory_uri() . '/images/favicon.ico',
		'preloader_style' => 'preloader-4',
		'custom_css' => '',
		'custom_js' => '',
		'portfolio_rewrite_slug' => '',
		'news_rewrite_slug' => '',
		'404_page' => '',
		'pagespeed_lazy_images_visibility_offset' => '',
		'size_guide_image' => '',
		'products_pagination' => 'normal',
		'checkout_type' => 'multi-step',
		'hamburger_menu_cart_position' => '',
		'cart_label_count' => '0',
		'woocommerce_activate_images_sizes' => '1',
		'woocommerce_catalog_image_width' => '522',
		'woocommerce_catalog_image_height' => '652',
		'woocommerce_product_image_width' => '564',
		'woocommerce_product_image_height' => '744',
		'woocommerce_thumbnail_image_width' => '160',
		'woocommerce_thumbnail_image_height' => '160',
		'header_layout' => 'default',
		'header_style' => '3',
		'mobile_menu_layout' => 'default',
		'mobile_menu_layout_style' => 'light',
		'logo_position' => 'left',
		'menu_appearance_tablet_portrait' => 'responsive',
		'menu_appearance_tablet_landscape' => 'centered',
		'hamburger_menu_icon_size' => '',
		'top_area_style' => '1',
		'top_area_alignment' => 'left',
		'top_area_contacts' => '1',
		'top_area_socials' => '1',
		'top_area_button_text' => 'Join Now',
		'top_area_button_link' => '#',
		'top_area_disable_fixed' => '1',
		'top_area_disable_mobile' => '1',
		'main_menu_font_family' => 'Montserrat',
		'main_menu_font_style' => '700',
		'main_menu_font_sets' => '',
		'main_menu_font_size' => '14',
		'main_menu_line_height' => '25',
		'submenu_font_family' => 'Source Sans Pro',
		'submenu_font_style' => 'regular',
		'submenu_font_sets' => '',
		'submenu_font_size' => '16',
		'submenu_line_height' => '20',
		'overlay_menu_font_family' => 'Montserrat',
		'overlay_menu_font_style' => '700',
		'overlay_menu_font_sets' => '',
		'overlay_menu_font_size' => '32',
		'overlay_menu_line_height' => '64',
		'mobile_menu_font_family' => 'Source Sans Pro',
		'mobile_menu_font_style' => 'regular',
		'mobile_menu_font_sets' => '',
		'mobile_menu_font_size' => '16',
		'mobile_menu_line_height' => '20',
		'styled_subtitle_font_family' => 'Source Sans Pro',
		'styled_subtitle_font_style' => '300',
		'styled_subtitle_font_sets' => '',
		'styled_subtitle_font_size' => '24',
		'styled_subtitle_line_height' => '37',
		'styled_subtitle_font_size_tablet' => '24',
		'styled_subtitle_line_height_tablet' => '37',
		'styled_subtitle_font_size_mobile' => '24',
		'styled_subtitle_line_height_mobile' => '37',
		'h1_font_family' => 'Montserrat',
		'h1_font_style' => '700',
		'h1_font_sets' => '',
		'h1_font_size' => '50',
		'h1_line_height' => '69',
		'h1_font_size_tablet' => '36',
		'h1_line_height_tablet' => '53',
		'h1_font_size_mobile' => '28',
		'h1_line_height_mobile' => '42',
		'h2_font_family' => 'Montserrat',
		'h2_font_style' => '700',
		'h2_font_sets' => '',
		'h2_font_size' => '36',
		'h2_line_height' => '53',
		'h2_font_size_tablet' => '28',
		'h2_line_height_tablet' => '42',
		'h2_font_size_mobile' => '24',
		'h2_line_height_mobile' => '38',
		'h3_font_family' => 'Montserrat',
		'h3_font_style' => '700',
		'h3_font_sets' => '',
		'h3_font_size' => '28',
		'h3_line_height' => '42',
		'h3_font_size_tablet' => '24',
		'h3_line_height_tablet' => '38',
		'h3_font_size_mobile' => '24',
		'h3_line_height_mobile' => '38',
		'h4_font_family' => 'Montserrat',
		'h4_font_style' => '700',
		'h4_font_sets' => '',
		'h4_font_size' => '24',
		'h4_line_height' => '38',
		'h4_font_size_tablet' => '24',
		'h4_line_height_tablet' => '38',
		'h4_font_size_mobile' => '24',
		'h4_line_height_mobile' => '38',
		'h5_font_family' => 'Montserrat',
		'h5_font_style' => '700',
		'h5_font_sets' => '',
		'h5_font_size' => '19',
		'h5_line_height' => '30',
		'h5_font_size_tablet' => '19',
		'h5_line_height_tablet' => '30',
		'h5_font_size_mobile' => '19',
		'h5_line_height_mobile' => '30',
		'h6_font_family' => 'Montserrat',
		'h6_font_style' => '700',
		'h6_font_sets' => '',
		'h6_font_size' => '16',
		'h6_line_height' => '25',
		'h6_font_size_tablet' => '16',
		'h6_line_height_tablet' => '25',
		'h6_font_size_mobile' => '16',
		'h6_line_height_mobile' => '25',
		'xlarge_title_font_family' => 'Montserrat',
		'xlarge_title_font_style' => '700',
		'xlarge_title_font_sets' => 'latin,latin-ext',
		'xlarge_title_font_size' => '80',
		'xlarge_title_line_height' => '90',
		'xlarge_font_size_tablet' => '50',
		'xlarge_line_height_tablet' => '69',
		'xlarge_font_size_mobile' => '36',
		'xlarge_line_height_mobile' => '53',
		'light_title_font_family' => 'Montserrat UltraLight',
		'light_title_font_style' => 'regular',
		'light_title_font_sets' => '',
		'body_font_family' => 'Source Sans Pro',
		'body_font_style' => 'regular',
		'body_font_sets' => '',
		'body_font_size' => '16',
		'body_line_height' => '25',
		'title_excerpt_font_family' => 'Source Sans Pro',
		'title_excerpt_font_style' => '300',
		'title_excerpt_font_sets' => '',
		'title_excerpt_font_size' => '24',
		'title_excerpt_line_height' => '37',
		'title_excerpt_font_size_tablet' => '24',
		'title_excerpt_line_height_tablet' => '37',
		'title_excerpt_font_size_mobile' => '24',
		'title_excerpt_line_height_mobile' => '37',
		'widget_title_font_family' => 'Montserrat',
		'widget_title_font_style' => '700',
		'widget_title_font_sets' => '',
		'widget_title_font_size' => '19',
		'widget_title_line_height' => '30',
		'button_font_family' => 'Montserrat',
		'button_font_style' => '700',
		'button_font_sets' => 'latin',
		'button_thin_font_family' => 'Montserrat UltraLight',
		'button_thin_font_style' => 'regular',
		'button_thin_font_sets' => '',
		'portfolio_title_font_family' => 'Montserrat',
		'portfolio_title_font_style' => '700',
		'portfolio_title_font_sets' => '',
		'portfolio_title_font_size' => '16',
		'portfolio_title_line_height' => '24',
		'portfolio_description_font_family' => 'Source Sans Pro',
		'portfolio_description_font_style' => 'regular',
		'portfolio_description_font_sets' => '',
		'portfolio_description_font_size' => '16',
		'portfolio_description_line_height' => '24',
		'quickfinder_title_font_family' => 'Montserrat',
		'quickfinder_title_font_style' => '700',
		'quickfinder_title_font_sets' => 'latin',
		'quickfinder_title_font_size' => '24',
		'quickfinder_title_line_height' => '38',
		'quickfinder_title_thin_font_family' => 'Montserrat UltraLight',
		'quickfinder_title_thin_font_style' => 'regular',
		'quickfinder_title_thin_font_sets' => 'latin,latin-ext',
		'quickfinder_title_thin_font_size' => '24',
		'quickfinder_title_thin_line_height' => '38',
		'quickfinder_description_font_family' => 'Source Sans Pro',
		'quickfinder_description_font_style' => 'regular',
		'quickfinder_description_font_sets' => '',
		'quickfinder_description_font_size' => '16',
		'quickfinder_description_line_height' => '25',
		'gallery_title_font_family' => 'Montserrat UltraLight',
		'gallery_title_font_style' => 'regular',
		'gallery_title_font_sets' => '',
		'gallery_title_font_size' => '24',
		'gallery_title_line_height' => '30',
		'gallery_title_bold_font_family' => 'Montserrat',
		'gallery_title_bold_font_style' => '700',
		'gallery_title_bold_font_sets' => 'latin,latin-ext',
		'gallery_title_bold_font_size' => '24',
		'gallery_title_bold_line_height' => '31',
		'gallery_description_font_family' => 'Source Sans Pro',
		'gallery_description_font_style' => '300',
		'gallery_description_font_sets' => '',
		'gallery_description_font_size' => '17',
		'gallery_description_line_height' => '24',
		'testimonial_font_family' => 'Source Sans Pro',
		'testimonial_font_style' => '300',
		'testimonial_font_sets' => '',
		'testimonial_font_size' => '24',
		'testimonial_line_height' => '36',
		'counter_font_family' => 'Montserrat',
		'counter_font_style' => '700',
		'counter_font_sets' => '',
		'counter_font_size' => '50',
		'counter_line_height' => '69',
		'counter_font_size_tablet' => '36',
		'counter_line_height_tablet' => '53',
		'counter_font_size_mobile' => '36',
		'counter_line_height_mobile' => '53',
		'tabs_title_font_family' => 'Montserrat',
		'tabs_title_font_style' => '700',
		'tabs_title_font_sets' => 'latin,latin-ext',
		'tabs_title_font_size' => '16',
		'tabs_title_line_height' => '25',
		'tabs_title_thin_font_family' => 'Montserrat UltraLight',
		'tabs_title_thin_font_style' => 'regular',
		'tabs_title_thin_font_sets' => 'latin,latin-ext',
		'tabs_title_thin_font_size' => '16',
		'tabs_title_thin_line_height' => '25',
		'woocommerce_price_font_family' => 'Montserrat',
		'woocommerce_price_font_style' => 'regular',
		'woocommerce_price_font_sets' => '',
		'woocommerce_price_font_size' => '26',
		'woocommerce_price_line_height' => '36',
		'slideshow_title_font_family' => 'Montserrat',
		'slideshow_title_font_style' => '700',
		'slideshow_title_font_sets' => '',
		'slideshow_title_font_size' => '50',
		'slideshow_title_line_height' => '69',
		'slideshow_description_font_family' => 'Source Sans Pro',
		'slideshow_description_font_style' => 'regular',
		'slideshow_description_font_sets' => '',
		'slideshow_description_font_size' => '16',
		'slideshow_description_line_height' => '25',
		'product_title_listing_font_family' => 'Montserrat',
		'product_title_listing_font_style' => '700',
		'product_title_listing_font_sets' => 'latin,latin-ext',
		'product_title_listing_font_size' => '16',
		'product_title_listing_line_height' => '25',
		'product_title_page_font_family' => 'Montserrat UltraLight',
		'product_title_page_font_style' => 'regular',
		'product_title_page_font_sets' => 'latin,latin-ext',
		'product_title_page_font_size' => '28',
		'product_title_page_line_height' => '42',
		'product_title_widget_font_family' => 'Source Sans Pro',
		'product_title_widget_font_style' => 'regular',
		'product_title_widget_font_sets' => 'latin,latin-ext',
		'product_title_widget_font_size' => '16',
		'product_title_widget_line_height' => '25',
		'product_title_cart_font_family' => 'Source Sans Pro',
		'product_title_cart_font_style' => 'regular',
		'product_title_cart_font_sets' => 'latin,latin-ext',
		'product_title_cart_font_size' => '16',
		'product_title_cart_line_height' => '25',
		'product_price_listing_font_family' => 'Source Sans Pro',
		'product_price_listing_font_style' => 'regular',
		'product_price_listing_font_sets' => 'latin,latin-ext',
		'product_price_listing_font_size' => '16',
		'product_price_listing_line_height' => '25',
		'product_price_page_font_family' => 'Source Sans Pro',
		'product_price_page_font_style' => '300',
		'product_price_page_font_sets' => 'latin,latin-ext',
		'product_price_page_font_size' => '36',
		'product_price_page_line_height' => '36',
		'product_price_widget_font_family' => 'Source Sans Pro',
		'product_price_widget_font_style' => '300',
		'product_price_widget_font_sets' => 'latin,latin-ext',
		'product_price_widget_font_size' => '20',
		'product_price_widget_line_height' => '30',
		'product_price_cart_font_family' => 'Source Sans Pro',
		'product_price_cart_font_style' => '300',
		'product_price_cart_font_sets' => 'latin,latin-ext',
		'product_price_cart_font_size' => '24',
		'product_price_cart_line_height' => '30',
		'basic_outer_background_color' => '#f0f3f2',
		'top_background_color' => '#ffffff',
		'main_background_color' => '#ffffff',
		'styled_elements_background_color' => '#f4f6f7',
		'styled_elements_color_1' => '#00bcd4',
		'styled_elements_color_2' => '#99a9b5',
		'styled_elements_color_3' => '#f44336',
		'styled_elements_color_4' => '#393d50',
		'divider_default_color' => '#dfe5e8',
		'box_border_color' => '#dfe5e8',
		'main_menu_level1_color' => '#3c3950',
		'main_menu_level1_background_color' => '',
		'main_menu_level1_hover_color' => '#00bcd4',
		'main_menu_level1_hover_background_color' => '',
		'main_menu_level1_active_color' => '#3c3950',
		'main_menu_level1_active_background_color' => '#3c3950',
		'main_menu_level2_color' => '#5f727f',
		'main_menu_level2_background_color' => '#f4f6f7',
		'main_menu_level2_hover_color' => '#3c3950',
		'main_menu_level2_hover_background_color' => '#ffffff',
		'main_menu_level2_active_color' => '#3c3950',
		'main_menu_level2_active_background_color' => '#ffffff',
		'main_menu_mega_column_title_color' => '#3c3950',
		'main_menu_mega_column_title_hover_color' => '#00bcd4',
		'main_menu_mega_column_title_active_color' => '#00bcd4',
		'main_menu_level3_color' => '#5f727f',
		'main_menu_level3_background_color' => '#ffffff',
		'main_menu_level3_hover_color' => '#ffffff',
		'main_menu_level3_hover_background_color' => '#494c64',
		'main_menu_level3_active_color' => '#00bcd4',
		'main_menu_level3_active_background_color' => '#ffffff',
		'main_menu_level1_light_color' => '#ffffff',
		'main_menu_level1_light_hover_color' => '#00bcd4',
		'main_menu_level1_light_active_color' => '#ffffff',
		'main_menu_level2_border_color' => '#dfe5e8',
		'mega_menu_icons_color' => '',
		'overlay_menu_background_color' => '#212331',
		'overlay_menu_color' => '#ffffff',
		'overlay_menu_hover_color' => '#00bcd4',
		'overlay_menu_active_color' => '#00bcd4',
		'hamburger_menu_icon_color' => '',
		'hamburger_menu_icon_light_color' => '',
		'mobile_menu_button_color' => '',
		'mobile_menu_button_light_color' => '',
		'mobile_menu_background_color' => '',
		'mobile_menu_level1_color' => '#5f727f',
		'mobile_menu_level1_background_color' => '#f4f6f7',
		'mobile_menu_level1_active_color' => '#3c3950',
		'mobile_menu_level1_active_background_color' => '#ffffff',
		'mobile_menu_level2_color' => '#5f727f',
		'mobile_menu_level2_background_color' => '#f4f6f7',
		'mobile_menu_level2_active_color' => '#3c3950',
		'mobile_menu_level2_active_background_color' => '#ffffff',
		'mobile_menu_level3_color' => '#5f727f',
		'mobile_menu_level3_background_color' => '#f4f6f7',
		'mobile_menu_level3_active_color' => '#3c3950',
		'mobile_menu_level3_active_background_color' => '#ffffff',
		'mobile_menu_border_color' => '#dfe5e8',
		'mobile_menu_social_icon_color' => '',
		'mobile_menu_hide_color' => '',
		'top_area_background_color' => '#f4f6f7',
		'top_area_border_color' => '#00bcd4',
		'top_area_separator_color' => '#dfe5e8',
		'top_area_text_color' => '#5f727f',
		'top_area_link_color' => '#5f727f',
		'top_area_link_hover_color' => '#00bcd4',
		'top_area_button_text_color' => '#ffffff',
		'top_area_button_background_color' => '#494c64',
		'top_area_button_hover_text_color' => '#ffffff',
		'top_area_button_hover_background_color' => '#00bcd4',
		'footer_background_color' => '#181828',
		'footer_text_color' => '#99a9b5',
		'footer_menu_color' => '',
		'footer_menu_hover_color' => '',
		'footer_menu_separator_color' => '',
		'footer_top_border_color' => '',
		'footer_widget_area_background_color' => '#212331',
		'footer_widget_title_color' => '#feffff',
		'footer_widget_text_color' => '#99a9b5',
		'footer_widget_link_color' => '#99a9b5',
		'footer_widget_hover_link_color' => '#00bcd4',
		'footer_widget_active_link_color' => '#00bcd4',
		'footer_widget_triangle_color' => '',
		'body_color' => '#5f727f',
		'h1_color' => '#3c3950',
		'h2_color' => '#3c3950',
		'h3_color' => '#3c3950',
		'h4_color' => '#3c3950',
		'h5_color' => '#3c3950',
		'h6_color' => '#3c3950',
		'link_color' => '#00bcd4',
		'hover_link_color' => '#384554',
		'active_link_color' => '#00bcd4',
		'copyright_text_color' => '#99a9b5',
		'copyright_link_color' => '#00bcd4',
		'title_bar_background_color' => '#333144',
		'title_bar_text_color' => '#ffffff',
		'date_filter_subtitle_color' => '#99a9b5',
		'system_icons_font' => '#99a3b0',
		'system_icons_font_2' => '#b6c6c9',
		'button_text_basic_color' => '#ffffff',
		'button_text_hover_color' => '#ffffff',
		'button_background_basic_color' => '#b6c6c9',
		'button_background_hover_color' => '#3c3950',
		'button_outline_text_basic_color' => '#00bcd4',
		'button_outline_text_hover_color' => '#ffffff',
		'button_outline_border_basic_color' => '#00bcd4',
		'widget_title_color' => '#3c3950',
		'widget_link_color' => '#5f727f',
		'widget_hover_link_color' => '#00bcd4',
		'widget_active_link_color' => '#384554',
		'portfolio_title_color' => '#5f727f',
		'portfolio_description_color' => '#5f727f',
		'portfolio_date_color' => '#99a9b5',
		'portfolio_arrow_color' => '',
		'portfolio_arrow_hover_color' => '',
		'portfolio_arrow_background_color' => '',
		'portfolio_arrow_background_hover_color' => '',
		'portfolio_sorting_controls_color' => '',
		'portfolio_sorting_background_color' => '',
		'portfolio_sorting_switch_color' => '',
		'portfolio_sorting_separator_color' => '',
		'portfolio_filter_button_color' => '',
		'portfolio_filter_button_background_color' => '',
		'portfolio_filter_button_hover_color' => '',
		'portfolio_filter_button_hover_background_color' => '',
		'portfolio_filter_button_active_color' => '',
		'portfolio_filter_button_active_background_color' => '',
		'gallery_caption_background_color' => '#000000',
		'gallery_title_color' => '#ffffff',
		'gallery_description_color' => '#ffffff',
		'slideshow_arrow_background' => '#394050',
		'slideshow_arrow_hover_background' => '#00bcd4',
		'slideshow_arrow_color' => '#ffffff',
		'sliders_arrow_color' => '#3c3950',
		'sliders_arrow_background_color' => '#b6c6c9',
		'sliders_arrow_hover_color' => '#ffffff',
		'sliders_arrow_background_hover_color' => '#00bcd4',
		'hover_effect_default_color' => '#00bcd4',
		'hover_effect_zooming_blur_color' => '#ffffff',
		'hover_effect_horizontal_sliding_color' => '#46485c',
		'hover_effect_vertical_sliding_color' => '#f44336',
		'quickfinder_title_color' => '#4c5867',
		'quickfinder_description_color' => '#5f727f',
		'testimonial_arrow_color' => '',
		'testimonial_arrow_hover_color' => '',
		'testimonial_arrow_background_color' => '',
		'testimonial_arrow_background_hover_color' => '',
		'bullets_symbol_color' => '#5f727f',
		'icons_symbol_color' => '#91a0ac',
		'icons_portfolio_gallery_hover_color' => '#ffffff',
		'pagination_basic_color' => '#99a9b5',
		'pagination_basic_background_color' => '#ffffff',
		'pagination_hover_color' => '#00bcd4',
		'pagination_active_color' => '#3c3950',
		'mini_pagination_color' => '#b6c6c9',
		'mini_pagination_active_color' => '#00bcd4',
		'blockquote_icon_testimonials' => '',
		'blockquote_icon_blockquotes' => '',
		'socials_colors_top_area' => '',
		'socials_colors_footer' => '',
		'socials_colors_posts' => '',
		'socials_colors_woocommerce' => '',
		'contact_form_light_input_color' => '',
		'contact_form_light_input_background_color' => '',
		'contact_form_light_input_border_color' => '',
		'contact_form_light_input_placeholder_color' => '',
		'contact_form_light_input_icon_color' => '',
		'contact_form_light_label_color' => '',
		'contact_form_light_button_style' => 'flat',
		'contact_form_light_button_position' => 'fullwidth',
		'contact_form_light_button_size' => 'small',
		'contact_form_light_button_text_weight' => 'normal',
		'contact_form_light_button_border' => '0',
		'contact_form_light_button_corner' => '3',
		'contact_form_light_button_text_color' => '',
		'contact_form_light_button_hover_text_color' => '',
		'contact_form_light_button_background_color' => '',
		'contact_form_light_button_hover_background_color' => '',
		'contact_form_light_button_border_color' => '',
		'contact_form_light_button_hover_border_color' => '',
		'contact_form_dark_input_color' => '',
		'contact_form_dark_input_background_color' => '',
		'contact_form_dark_input_border_color' => '',
		'contact_form_dark_input_placeholder_color' => '',
		'contact_form_dark_input_icon_color' => '',
		'contact_form_dark_label_color' => '',
		'contact_form_dark_button_style' => 'flat',
		'contact_form_dark_button_position' => 'fullwidth',
		'contact_form_dark_button_size' => 'small',
		'contact_form_dark_button_text_weight' => 'normal',
		'contact_form_dark_button_border' => '0',
		'contact_form_dark_button_corner' => '3',
		'contact_form_dark_button_text_color' => '',
		'contact_form_dark_button_hover_text_color' => '',
		'contact_form_dark_button_background_color' => '',
		'contact_form_dark_button_hover_background_color' => '',
		'contact_form_dark_button_border_color' => '',
		'contact_form_dark_button_hover_border_color' => '',
		'mailchimp_content_input_color' => '',
		'mailchimp_content_input_background_color' => '',
		'mailchimp_content_input_border_color' => '',
		'mailchimp_content_input_placeholder_color' => '',
		'mailchimp_content_text_color' => '',
		'mailchimp_content_label_color' => '',
		'mailchimp_content_button_text_color' => '',
		'mailchimp_content_button_hover_text_color' => '',
		'mailchimp_content_button_background_color' => '',
		'mailchimp_content_button_hover_background_color' => '',
		'mailchimp_sidebars_background_color' => '',
		'mailchimp_sidebars_input_color' => '',
		'mailchimp_sidebars_input_background_color' => '',
		'mailchimp_sidebars_input_border_color' => '',
		'mailchimp_sidebars_input_placeholder_color' => '',
		'mailchimp_sidebars_text_color' => '',
		'mailchimp_sidebars_label_color' => '',
		'mailchimp_sidebars_button_text_color' => '',
		'mailchimp_sidebars_button_hover_text_color' => '',
		'mailchimp_sidebars_button_background_color' => '',
		'mailchimp_sidebars_button_hover_background_color' => '',
		'mailchimp_footer_background_color' => '',
		'mailchimp_footer_input_color' => '',
		'mailchimp_footer_input_background_color' => '',
		'mailchimp_footer_input_border_color' => '',
		'mailchimp_footer_input_placeholder_color' => '',
		'mailchimp_footer_text_color' => '',
		'mailchimp_footer_label_color' => '',
		'mailchimp_footer_button_text_color' => '',
		'mailchimp_footer_button_hover_text_color' => '',
		'mailchimp_footer_button_background_color' => '',
		'mailchimp_footer_button_hover_background_color' => '',
		'form_elements_background_color' => '#f4f6f7',
		'form_elements_text_color' => '#3c3950',
		'form_elements_border_color' => '#dfe5e8',
		'breadcrumbs_default_color' => '',
		'breadcrumbs_active_color' => '',
		'breadcrumbs_hover_color' => '',
		'preloader_page_background' => '',
		'preloader_line_1' => '',
		'preloader_line_2' => '',
		'preloader_line_3' => '',
		'product_title_listing_color' => '#5f727f',
		'product_title_page_color' => '#3c3950',
		'product_title_widget_color' => '#5f727f',
		'product_title_cart_color' => '#00bcd4',
		'product_price_listing_color' => '#00bcd4',
		'product_price_page_color' => '#3c3950',
		'product_price_widget_color' => '#3c3950',
		'product_price_cart_color' => '#3c3950',
		'product_separator_listing_color' => '#000000',
		'cart_table_header_color' => '',
		'cart_table_header_background_color' => '',
		'cart_form_labels_color' => '',
		'checkout_step_title_color' => '',
		'checkout_step_background_color' => '',
		'checkout_step_title_active_color' => '',
		'checkout_step_background_active_color' => '',
		'basic_outer_background_image' => '',
		'top_background_image' => '',
		'top_area_background_image' => '',
		'main_background_image' => '',
		'footer_background_image' => '',
		'footer_widget_area_background_image' => '',
		'slider_effect' => 'random',
		'slider_slices' => '15',
		'slider_boxCols' => '8',
		'slider_boxRows' => '4',
		'slider_animSpeed' => '5',
		'slider_pauseTime' => '20',
		'slider_directionNav' => '1',
		'slider_controlNav' => '1',
		'show_author' => '1',
		'excerpt_length' => '20',
		'footer_active' => '1',
		'footer_html' => array(
			'en' => '2019 &copy; Copyrights CodexThemes',
		),
		'custom_footer' => '',
		'contacts_address' => '908 New Hampshire Avenue #100, Washington, DC 20037, United States',
		'contacts_phone' => '+1 916-875-2235',
		'contacts_fax' => '+1 916-875-2235',
		'contacts_email' => 'info@domain.tld',
		'contacts_website' => 'www.codex-themes.com',
		'top_area_contacts_address' => '19th Ave New York, NY 95822, USA',
		'top_area_contacts_address_icon_color' => '',
		'top_area_contacts_address_icon_pack' => 'elegant',
		'top_area_contacts_address_icon' => '',
		'top_area_contacts_phone' => '',
		'top_area_contacts_phone_icon_color' => '',
		'top_area_contacts_phone_icon_pack' => 'elegant',
		'top_area_contacts_phone_icon' => '',
		'top_area_contacts_fax' => '',
		'top_area_contacts_fax_icon_color' => '',
		'top_area_contacts_fax_icon_pack' => 'elegant',
		'top_area_contacts_fax_icon' => '',
		'top_area_contacts_email' => '',
		'top_area_contacts_email_icon_color' => '',
		'top_area_contacts_email_icon_pack' => 'elegant',
		'top_area_contacts_email_icon' => '',
		'top_area_contacts_website' => '',
		'top_area_contacts_website_icon_color' => '',
		'top_area_contacts_website_icon_pack' => 'elegant',
		'top_area_contacts_website_icon' => '',
		'twitter_active' => '1',
		'facebook_active' => '1',
		'linkedin_active' => '1',
		'googleplus_active' => '1',
		'instagram_active' => '1',
		'pinterest_active' => '1',
		'youtube_active' => '1',
		'twitter_link' => '#',
		'facebook_link' => '#',
		'linkedin_link' => '#',
		'googleplus_link' => '#',
		'stumbleupon_link' => '#',
		'rss_link' => '#',
		'vimeo_link' => '#',
		'instagram_link' => '#',
		'pinterest_link' => '#',
		'youtube_link' => '#',
		'flickr_link' => '#',
		'show_social_icons' => '1',
	));
}

/* Update new options */
function thesod_version_update_options() {
	$newOptions = apply_filters('thesod_version_update_options_array', array (
		'3.0.0' => array(
			'page_padding_top' => 0,
			'page_padding_bottom' => 0,
			'page_padding_left' => 0,
			'page_padding_right' => 0,
			'mobile_menu_font_family' => 'Source Sans Pro',
			'mobile_menu_font_style' => 'regular',
			'mobile_menu_font_sets' => '',
			'mobile_menu_font_size' => '16',
			'mobile_menu_line_height' => '20',
			'styled_elements_color_4' => '#393d50',
			'mobile_menu_background_color' => '',
			'mobile_menu_level1_color' => '#5f727f',
			'mobile_menu_level1_background_color' => '#f4f6f7',
			'mobile_menu_level1_active_color' => '#3c3950',
			'mobile_menu_level1_active_background_color' => '#ffffff',
			'mobile_menu_level2_color' => '#5f727f',
			'mobile_menu_level2_background_color' => '#f4f6f7',
			'mobile_menu_level2_active_color' => '#3c3950',
			'mobile_menu_level2_active_background_color' => '#ffffff',
			'mobile_menu_level3_color' => '#5f727f',
			'mobile_menu_level3_background_color' => '#f4f6f7',
			'mobile_menu_level3_active_color' => '#3c3950',
			'mobile_menu_level3_active_background_color' => '#ffffff',
			'mobile_menu_border_color' => '#dfe5e8',
			'mobile_menu_social_icon_color' => '',
			'mobile_menu_hide_color' => '',
			'product_title_listing_font_family' => 'Montserrat',
			'product_title_listing_font_style' => '700',
			'product_title_listing_font_sets' => 'latin,latin-ext',
			'product_title_listing_font_size' => '16',
			'product_title_listing_line_height' => '25',
			'product_title_page_font_family' => 'Montserrat UltraLight',
			'product_title_page_font_style' => 'regular',
			'product_title_page_font_sets' => 'latin,latin-ext',
			'product_title_page_font_size' => '28',
			'product_title_page_line_height' => '42',
			'product_title_widget_font_family' => 'Source Sans Pro',
			'product_title_widget_font_style' => 'regular',
			'product_title_widget_font_sets' => 'latin,latin-ext',
			'product_title_widget_font_size' => '16',
			'product_title_widget_line_height' => '25',
			'product_title_cart_font_family' => 'Source Sans Pro',
			'product_title_cart_font_style' => 'regular',
			'product_title_cart_font_sets' => 'latin,latin-ext',
			'product_title_cart_font_size' => '16',
			'product_title_cart_line_height' => '25',
			'product_price_listing_font_family' => 'Source Sans Pro',
			'product_price_listing_font_style' => 'regular',
			'product_price_listing_font_sets' => 'latin,latin-ext',
			'product_price_listing_font_size' => '16',
			'product_price_listing_line_height' => '25',
			'product_price_page_font_family' => 'Source Sans Pro',
			'product_price_page_font_style' => '300',
			'product_price_page_font_sets' => 'latin,latin-ext',
			'product_price_page_font_size' => '36',
			'product_price_page_line_height' => '36',
			'product_price_widget_font_family' => 'Source Sans Pro',
			'product_price_widget_font_style' => '300',
			'product_price_widget_font_sets' => 'latin,latin-ext',
			'product_price_widget_font_size' => '20',
			'product_price_widget_line_height' => '30',
			'product_price_cart_font_family' => 'Source Sans Pro',
			'product_price_cart_font_style' => '300',
			'product_price_cart_font_sets' => 'latin,latin-ext',
			'product_price_cart_font_size' => '24',
			'product_price_cart_line_height' => '30',
			'product_title_listing_color' => '#5f727f',
			'product_title_page_color' => '#3c3950',
			'product_title_widget_color' => '#5f727f',
			'product_title_cart_color' => '#00bcd4',
			'product_price_listing_color' => '#00bcd4',
			'product_price_page_color' => '#3c3950',
			'product_price_widget_color' => '#3c3950',
			'product_price_cart_color' => '#3c3950',
			'product_separator_listing_color' => '#000000',
		),
		'3.1.0' => array(
			'woocommerce_activate_images_sizes' => '1',
			'woocommerce_catalog_image_width' => '522',
			'woocommerce_catalog_image_height' => '652',
			'woocommerce_product_image_width' => '564',
			'woocommerce_product_image_height' => '744',
			'woocommerce_thumbnail_image_width' => '160',
			'woocommerce_thumbnail_image_height' => '160',
		),
		'3.8.4' => array(
			'title_excerpt_font_family' => 'Source Sans Pro',
			'title_excerpt_font_style' => '300',
			'title_excerpt_font_sets' => '',
			'title_excerpt_font_size' => '24',
			'title_excerpt_line_height' => '37',
			'title_excerpt_font_size_tablet' => '24',
			'title_excerpt_line_height_tablet' => '37',
			'title_excerpt_font_size_mobile' => '24',
			'title_excerpt_line_height_mobile' => '37',
		)
	));
	$theme_options = get_option('thesod_theme_options');
	$thesod_theme = wp_get_theme(wp_get_theme()->get('Template'));
	foreach($newOptions as $version => $values) {
		if(version_compare($version, thesod_get_option('theme_version')) > 0) {
			foreach($values as $optionName => $value) {
				$theme_options[$optionName] = $value;
			}
		}
	}
	$theme_options['theme_version'] = $thesod_theme->get('Version');
	update_option('thesod_theme_options', $theme_options);
}

/* Create admin theme page */
function thesod_theme_add_page() {
	$page = add_submenu_page('thesod-theme-options',esc_html__('thesod Theme Options','thesod'), esc_html__('Theme Options','thesod'), 'edit_theme_options', 'thesod-theme-options', 'thesod_theme_options_page');
}
add_action( 'admin_menu', 'thesod_theme_add_page');

function thesod_activation_google_fonts() {
	$fonts_url = '';
	$fonts = array();
	$subsets = 'latin,latin-ext';
	if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'thesod' ) ) {
		$fonts[] = 'Montserrat:700';
	}
	if ( 'off' !== _x( 'on', 'Source Sans Pro font: on or off', 'thesod' ) ) {
		$fonts[] = 'Source Sans Pro:300,400';
	}
	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), '//fonts.googleapis.com/css' );
	}

	return $fonts_url;
}

function thesod_theme_options_admin_enqueue_scripts($hook) {
	if($hook != 'toplevel_page_thesod-theme-options') return;
	wp_enqueue_media();
	wp_enqueue_style('thesod-activation-google-fonts', thesod_activation_google_fonts());
	wp_enqueue_script('thesod-form-elements', get_template_directory_uri() . '/js/thesod-form-elements.js', array('jquery'), false, true);
	wp_enqueue_script('thesod-image-selector', get_template_directory_uri() . '/js/thesod-image-selector.js', array('jquery'));
	wp_enqueue_script('thesod-file-selector', get_template_directory_uri() . '/js/thesod-file-selector.js', array('jquery'));
	wp_enqueue_script('thesod-font-options', get_template_directory_uri() . '/js/thesod-font-options.js', array('jquery'));
	wp_enqueue_script('thesod-theme-options', get_template_directory_uri() . '/js/thesod-theme_options.js', array('jquery-ui-position', 'jquery-ui-tabs', 'jquery-ui-slider', 'jquery-ui-accordion', 'jquery-ui-draggable', 'jquery-ui-droppable', 'jquery-ui-sortable'));
	wp_localize_script('thesod-theme-options', 'theme_options_object',array(
		'ajax_url' => esc_url(admin_url( 'admin-ajax.php' )),
		'security' => wp_create_nonce('ajax_security'),
		'text1' => esc_html__('Get all from font.', 'thesod'),
		'thesod_color_skin_defaults' => json_encode(thesod_color_skin_defaults()),
		'text2' => esc_html__('et colors, backgrounds and fonts options to default?', 'thesod'),
		'text3' => esc_html__('Update backup data?', 'thesod'),
		'text4' => esc_html__('Restore settings from backup data?', 'thesod'),
		'text5' => esc_html__('Import settings?', 'thesod'),
	));
}
add_action('admin_enqueue_scripts', 'thesod_theme_options_admin_enqueue_scripts');

/* Build admin theme page form */
function thesod_theme_options_page(){
	if(isset($_REQUEST['action']) && isset($_REQUEST['theme_options'])) {
		thesod_theme_update_options();
	}
	if(isset($_REQUEST['action']) && in_array($_REQUEST['action'], array('save', 'reset', 'restore', 'import'))) {
		if(thesod_generate_custom_css() === 'generate_css_continue') {
			return ;
		}
	}
	$jQuery_ui_theme = 'ui-no-theme';
	$options = thesod_get_theme_options();
	$options_values = get_option('thesod_theme_options');
	$thesod_theme = wp_get_theme(wp_get_theme()->get('Template'));
	//wp_enqueue_code_editor( array( 'type' => 'text/html' ) );
?>
<div class="wrap">
	<div class="theme-title">		
		<img class="left-part" src="<?php echo esc_url(get_template_directory_uri().'/images/admin-images/theme-options-title-left.png'); ?>" alt="Theme Options. thesod Business." />
		<div style="clear: both;"></div>
	</div>
	<form id="theme-options-form" method="POST">
		<?php wp_nonce_field('thesod-theme-options'); ?>
		<input type="hidden" name="theme_options[theme_version]" value="<?php echo $thesod_theme->get('Version'); ?>" />
		<div class="option-wrap <?php echo esc_attr($jQuery_ui_theme); ?>">
			<div class="submit_buttons"><button name="action" value="save"><?php esc_html_e( 'Save Changes', 'thesod' ); ?></button></div>
			<div id="categories">
				<?php if(count($options) > 0) : ?>
					<ul class="styled">
						<?php foreach($options as $name => $category) : ?>
							<?php if(isset($category['subcats']) && count($category['subcats']) > 0) : ?>
								<li><a href="<?php echo esc_url('#'.$name); ?>" style="background-image: url('<?php echo esc_url(get_template_directory_uri().'/images/admin-images/'.$name.'_icon.png'); ?>');"><?php print esc_html($category['title']); ?></a></li>
							<?php endif; ?>
						<?php endforeach; ?>						
					</ul>
				<?php endif; ?>

				<?php if(count($options) > 0) : ?>
					<?php foreach($options as $name => $category) : ?>
						<?php if(isset($category['subcats']) && count($category['subcats']) > 0) : ?>
							<div id="<?php echo esc_attr($name); ?>">
								<div class="subcategories">

									<?php foreach($category['subcats'] as $sname => $subcat) : ?>
										<?php if(count($subcat) > 0) : ?>
											<div id="<?php echo esc_attr($sname); ?>"<?php echo (isset($subcat['hidden']) ? ' style="display: none;"' : ''); ?>>
												<h3><?php echo esc_html($subcat['title']); ?></h3>
												<div class="inside">
													<?php foreach($subcat['options'] as $oname => $option) : ?>
														<?php echo thesod_get_option_element($oname, $option, isset($options_values[$oname]) ? $options_values[$oname] : NULL); ?>
													<?php endforeach; ?>
												</div>
											</div>
										<?php endif; ?>
									<?php endforeach; ?>

									<?php if($name === 'general') : ?>
										<div id="default_page_settings">
											<h3><?php esc_html_e('Default page options for new pages, posts & portfolio items', 'thesod'); ?></h3>
											<div class="inside">
												<?php thesod_theme_options_page_settings_block('default'); ?>
											</div>
										</div>
										<div id="blog_page_settings">
											<h3><?php esc_html_e('Default page options for blog list', 'thesod'); ?></h3>
											<div class="inside">
												<?php thesod_theme_options_page_settings_block('blog'); ?>
											</div>
										</div>
										<div id="search_page_settings">
											<h3><?php esc_html_e('Default page options for search results', 'thesod'); ?></h3>
											<div class="inside">
												<?php thesod_theme_options_page_settings_block('search'); ?>
											</div>
										</div>
									<?php endif; ?>

								</div>
							</div>
						<?php endif; ?>
					<?php endforeach; ?>

					<div id="backup">
						<div class="subcategories">
								<div id="backup_theme_options">
									<h3><?php esc_html_e('Backup and Restore Theme Settings', 'thesod'); ?></h3>
									<div class="inside">
										<div class="option backup_restore_settings">
											<p><?php esc_html_e('If you would like to experiment with the settings of your theme and don\'t want to loose your previous settings, use the "Backup Settings"-button to backup your current theme options. You can restore these options later using the button "Restore Settings".', 'thesod'); ?></p>
											<?php if($backup = get_option('thesod_theme_options_backup')) : ?>
												<p><b><?php esc_html_e('Last backup', 'thesod'); ?>: <?php echo date('Y-m-d H:i', $backup['date']) ?></b></p>
											<?php else : ?>
												<p><b><?php esc_html_e('Last backup', 'thesod'); ?>: <?php esc_html_e('No backups yet', 'thesod'); ?></b></p>
											<?php endif; ?>
											<div class="backups-buttons">
												<button name="action" value="backup"><?php esc_html_e( 'Backup Settings', 'thesod' ); ?></button>
												<button name="action" value="restore"><?php esc_html_e( 'Restore Settings', 'thesod' ); ?></button>
											</div>
										</div>
										<div class="option import_settings">
											<p><?php esc_html_e('In order to apply the settings of another thesod theme used in a different install just copy and paste the settings in the text box and click on "Import Settings".', 'thesod'); ?></p>
											<div class="textarea">
												<textarea name="import_settings" cols="100" rows="8"><?php if($settings = get_option('thesod_theme_options')) { echo json_encode($settings); } ?></textarea>
											</div>
											<p>&nbsp;</p>
											<div class="backups-buttons">
												<button name="action" value="import"><?php esc_html_e( 'Import Settings', 'thesod' ); ?></button>
											</div>
										</div>
									</div>
								</div>
						</div>
					</div>

					<?php if(!defined('ENVATO_HOSTED_SITE')) : ?><div id="activation">
						<div class="activation-header">
							<img src="<?php echo get_template_directory_uri(); ?>/images/admin-images/activation-title.png" alt="thesod"/>
							<h4><?php esc_html_e( 'Welcome to thesod - Creative Multi-Purpose WordPress Theme', 'thesod' ); ?></h4>
						</div>
						<div class="activation-container">
							<p class="styled-subtitle"><?php esc_html_e( 'Thank you for purchasing thesod! Would you like to import our awesome demos and take advantage of our amazing features? Please activate your copy of thesod:', 'thesod' ); ?></p>
							<div class="activation-field">
								<table><tr>
									<td><input type="text" class="activation-input" name="theme_options[purchase_code]" placeholder="<?php esc_html_e( 'Enter purchase code, e.g. cb0e057f-a05d-4758-b314-024db98eff85', 'thesod' ); ?>" value="<?php echo esc_attr(thesod_get_option('purchase_code')); ?>" /></td>
									<td><button class="activation-submit" name="action" value="activation"><?php esc_html_e( 'Activate', 'thesod' ); ?></button></td>
								</tr></table>
								<?php if(get_option('thesod_activation')) : ?>
									<p class="activation-result activation-result-success"><?php esc_html_e('Thank you, your purchase code is valid. thesod has been activated.', 'thesod'); ?></p>
								<?php else : ?>
									<p class="activation-result activation-result-hidden"></p>
								<?php endif; ?>
								<script type="text/javascript">
									(function($) {
										$('#activation .activation-submit').click(function(e) {
											e.preventDefault();
											$.ajax({
												url: '<?php echo esc_url(admin_url('admin-ajax.php')); ?>',
												data: { action: 'thesod_submit_activation', purchase_code: $('#activation .activation-input').val()},
												method: 'POST',
												timeout: 30000
											}).done(function(msg) {
												$('#activation .activation-result').html('');
												$('#activation .activation-result + .activation-plugin-button').remove();
												$('#activation .activation-result').removeClass('activation-result-hidden activation-result-success activation-result-failure');
												msg = jQuery.parseJSON(msg);
												if(msg.status) {
													$('#activation .activation-result').addClass('activation-result-success');
												} else {
													$('#activation .activation-result').addClass('activation-result-failure');
												}
												$('#activation .activation-result').html(msg.message);
												if(msg.button) {
													$('#activation .activation-result').after(msg.button);
												}
											}).fail(function() {
												$('#activation .activation-result').html('');
												$('#activation .activation-result').removeClass('activation-result-hidden');
												$('#activation .activation-result').addClass('activation-result-failure');
												$('#activation .activation-result').text('<?php esc_html_e('Ajax error. Try again...', 'thesod'); ?>');
											});
										});
										$('#activation .activation-input').keydown(function(e) {
											if (e.keyCode == 13) {
												$('#activation .activation-submit').trigger('click');
												e.preventDefault();
											}
										});
									})(jQuery);
								</script>
							</div>
							<div class="activation-purchase-image">
								<a href="https://themeforest.net/downloads"><img src="<?php echo get_template_directory_uri(); ?>/images/admin-images/activation-purchase-image.jpg" alt="thesod"/></a>
							</div>
							<div class="activation-help-links">
								<a href="http://codex-themes.com/thesod/documentation/"><img src="<?php echo get_template_directory_uri(); ?>/images/admin-images/activation-help-doc.jpg"></a>
								<a href="http://codexthemes.ticksy.com/"><img src="<?php echo get_template_directory_uri(); ?>/images/admin-images/activation-help-support.jpg"></a>
								<a href="http://codex-themes.com/thesod/documentation/video-tutorials/"><img src="<?php echo get_template_directory_uri(); ?>/images/admin-images/activation-help-video.jpg"></a>
							</div>
							<div class="activation-rate-block">
								<h4><?php esc_html_e( 'RATE thesod', 'thesod' ); ?></h4>
								<p><?php printf(wp_kses(__( 'Please don’t forget to rate thesod and leave a nice review, it means a lot for us and our theme.<br />Simply log in into your Themeforest, go to <a href="%s">Downloads section</a> and click 5 stars next to the thesod WordPress theme as shown on screenshot below:', 'thesod' ), array('br' => array(), 'a' => array('href' => array()))), esc_url('https://themeforest.net/downloads')); ?></p>
								<div class="activation-rate-image">
									<a href="https://themeforest.net/downloads"><img src="<?php echo get_template_directory_uri(); ?>/images/admin-images/activation-rate-image.jpg" alt="thesod"/></a>
								</div>
							</div>
						</div>
					</div><?php endif; ?>

				<?php endif; ?>

			</div>
			<div class="submit_buttons"><button name="action" value="reset"><?php esc_html_e( 'Reset Style Settings', 'thesod' ); ?></button><button name="action" value="save"><?php esc_html_e( 'Save Changes', 'thesod' ); ?></button></div>
		</div>
	</form>
	<script type="text/javascript">
(function($) {
	$(function() {
		var options_dependencies = {
			header_layout: [
				{
					values: ['fullwidth_hamburger'],
					data: {
						main_menu_font_family: 'Montserrat',
						main_menu_font_style: '700',
						top_background_color: '#212331',
						main_menu_level1_color: '#3c3950',
						main_menu_level1_background_color: '',
						main_menu_level1_hover_color: '#00bcd4',
						main_menu_level1_hover_background_color: '',
						main_menu_level1_active_color: '#00bcd4',
						main_menu_level1_active_background_color: '',
						main_menu_level2_color: '#5f727f',
						main_menu_level2_background_color: '#f4f6f7',
						main_menu_level2_hover_color: '#3c3950',
						main_menu_level2_hover_background_color: '#ffffff',
						main_menu_level2_active_color: '#3c3950',
						main_menu_level2_active_background_color: '#ffffff',
						main_menu_mega_column_title_color: '#3c3950',
						main_menu_mega_column_title_hover_color: '#00bcd4',
						main_menu_mega_column_title_active_color: '#00bcd4',
						main_menu_level3_color: '#5f727f',
						main_menu_level3_background_color: '#ffffff',
						main_menu_level3_hover_color: '#ffffff',
						main_menu_level3_hover_background_color: '#494c64',
						main_menu_level3_active_color: '#00bcd4',
						main_menu_level3_active_background_color: '#ffffff',
						main_menu_level2_border_color: '#dfe5e8'
					}
				},
				{
					values: ['vertical'],
					data: {
						main_menu_font_family: 'Montserrat',
						main_menu_font_style: '700',
						top_background_color: '#ffffff',
						main_menu_level1_color: '#3c3950',
						main_menu_level1_background_color: '',
						main_menu_level1_hover_color: '#00bcd4',
						main_menu_level1_hover_background_color: '',
						main_menu_level1_active_color: '#00bcd4',
						main_menu_level1_active_background_color: '#f4f6f7',
						main_menu_level2_color: '#99a9b5',
						main_menu_level2_background_color: '#212331',
						main_menu_level2_hover_color: '#ffffff',
						main_menu_level2_hover_background_color: '#393d4f',
						main_menu_level2_active_color: '#ffffff',
						main_menu_level2_active_background_color: '#393d4f',
						main_menu_mega_column_title_color: '#3c3950',
						main_menu_mega_column_title_hover_color: '#00bcd4',
						main_menu_mega_column_title_active_color: '#00bcd4',
						main_menu_level3_color: '#99a9b5',
						main_menu_level3_background_color: '#393d50',
						main_menu_level3_hover_color: '#ffffff',
						main_menu_level3_hover_background_color: '#494c64',
						main_menu_level3_active_color: '#00bcd4',
						main_menu_level3_active_background_color: '#393d50',
						main_menu_level2_border_color: '#494660'
					}
				},
				{
					values: ['perspective'],
					data: {
						basic_outer_background_color: '#b9b8be'
					}
				}
			],
			header_style: [
				{
					values: ['1'],
					data: {
						main_menu_font_family: 'Montserrat',
						main_menu_font_style: '700',
						top_background_color: '#ffffff',
						main_menu_level1_color: '#3c3950',
						main_menu_level1_background_color: '',
						main_menu_level1_hover_color: '#00bcd4',
						main_menu_level1_hover_background_color: '#',
						main_menu_level1_active_color: '#00bcd4',
						main_menu_level1_active_background_color: '#f4f6f7',
						main_menu_level2_color: '#99a9b5',
						main_menu_level2_background_color: '#212331',
						main_menu_level2_hover_color: '#ffffff',
						main_menu_level2_hover_background_color: '#393d4f',
						main_menu_level2_active_color: '#ffffff',
						main_menu_level2_active_background_color: '#393d4f',
						main_menu_mega_column_title_color: '#ffffff',
						main_menu_mega_column_title_hover_color: '#00bcd4',
						main_menu_mega_column_title_active_color: '#00bcd4',
						main_menu_level3_color: '#99a9b5',
						main_menu_level3_background_color: '#393d50',
						main_menu_level3_hover_color: '#ffffff',
						main_menu_level3_hover_background_color: '#494c64',
						main_menu_level3_active_color: '#00bcd4',
						main_menu_level3_active_background_color: '#393d50',
						main_menu_level2_border_color: '#494660',
						main_menu_level1_light_color: '#ffffff',
						main_menu_level1_light_hover_color: '#00bcd4',
						main_menu_level1_light_active_color: '#00bcd4',
						overlay_menu_background_color: '#212331',
						overlay_menu_color: '#ffffff',
						overlay_menu_hover_color: '#00bcd4',
						overlay_menu_active_color: '#00bcd4'
					}
				},
				{
					values: ['2'],
					data: {
						main_menu_font_family: 'Source Sans Pro',
						main_menu_font_style: 'regular',
						top_background_color: '#ffffff',
						main_menu_level1_color: '#5f727f',
						main_menu_level1_background_color: '',
						main_menu_level1_hover_color: '#00bcd4',
						main_menu_level1_hover_background_color: '',
						main_menu_level1_active_color: '#00bcd4',
						main_menu_level1_active_background_color: '',
						main_menu_level2_color: '#5f727f',
						main_menu_level2_background_color: '#f4f6f7',
						main_menu_level2_hover_color: '#3c3950',
						main_menu_level2_hover_background_color: '#ffffff',
						main_menu_level2_active_color: '#3c3950',
						main_menu_level2_active_background_color: '#ffffff',
						main_menu_mega_column_title_color: '#5f727f',
						main_menu_mega_column_title_hover_color: '#00bcd4',
						main_menu_mega_column_title_active_color: '#00bcd4',
						main_menu_level3_color: '#5f727f',
						main_menu_level3_background_color: '#ffffff',
						main_menu_level3_hover_color: '#ffffff',
						main_menu_level3_hover_background_color: '#494c64',
						main_menu_level3_active_color: '#00bcd4',
						main_menu_level3_active_background_color: '#ffffff',
						main_menu_level2_border_color: '#dfe5e8',
						main_menu_level1_light_color: '#ffffff',
						main_menu_level1_light_hover_color: '#00bcd4',
						main_menu_level1_light_active_color: '#00bcd4',
						overlay_menu_background_color: '#ffffff',
						overlay_menu_color: '#212331',
						overlay_menu_hover_color: '#00bcd4',
						overlay_menu_active_color: '#00bcd4'
					}
				},
				{
					values: ['3'],
					data: {
						main_menu_font_family: 'Montserrat',
						main_menu_font_style: '700',
						top_background_color: '#ffffff',
						main_menu_level1_color: '#3c3950',
						main_menu_level1_background_color: '',
						main_menu_level1_hover_color: '#00bcd4',
						main_menu_level1_hover_background_color: '',
						main_menu_level1_active_color: '#3c3950',
						main_menu_level1_active_background_color: '#3c3950',
						main_menu_level2_color: '#5f727f',
						main_menu_level2_background_color: '#f4f6f7',
						main_menu_level2_hover_color: '#3c3950',
						main_menu_level2_hover_background_color: '#ffffff',
						main_menu_level2_active_color: '#3c3950',
						main_menu_level2_active_background_color: '#ffffff',
						main_menu_mega_column_title_color: '#3c3950',
						main_menu_mega_column_title_hover_color: '#00bcd4',
						main_menu_mega_column_title_active_color: '#00bcd4',
						main_menu_level3_color: '#5f727f',
						main_menu_level3_background_color: '#ffffff',
						main_menu_level3_hover_color: '#ffffff',
						main_menu_level3_hover_background_color: '#494c64',
						main_menu_level3_active_color: '#00bcd4',
						main_menu_level3_active_background_color: '#ffffff',
						main_menu_level2_border_color: '#dfe5e8',
						main_menu_level1_light_color: '#ffffff',
						main_menu_level1_light_hover_color: '#00bcd4',
						main_menu_level1_light_active_color: '#ffffff',
						overlay_menu_background_color: '#ffffff',
						overlay_menu_color: '#212331',
						overlay_menu_hover_color: '#00bcd4',
						overlay_menu_active_color: '#00bcd4'
					}
				},
				{
					values: ['4'],
					data: {
						main_menu_font_family: 'Montserrat',
						main_menu_font_style: '700',
						top_background_color: '#212331',
						main_menu_level1_color: '#99a9b5',
						main_menu_level1_background_color: '',
						main_menu_level1_hover_color: '#00bcd4',
						main_menu_level1_hover_background_color: '',
						main_menu_level1_active_color: '#ffffff',
						main_menu_level1_active_background_color: '#ffffff',
						main_menu_level2_color: '#99a9b5',
						main_menu_level2_background_color: '#393d50',
						main_menu_level2_hover_color: '#ffffff',
						main_menu_level2_hover_background_color: '#212331',
						main_menu_level2_active_color: '#ffffff',
						main_menu_level2_active_background_color: '#212331',
						main_menu_mega_column_title_color: '#ffffff',
						main_menu_mega_column_title_hover_color: '#00bcd4',
						main_menu_mega_column_title_active_color: '#00bcd4',
						main_menu_level3_color: '#99a9b5',
						main_menu_level3_background_color: '#212331',
						main_menu_level3_hover_color: '#ffffff',
						main_menu_level3_hover_background_color: '#131121',
						main_menu_level3_active_color: '#00bcd4',
						main_menu_level3_active_background_color: '#212331',
						main_menu_level2_border_color: '#494c64',
						main_menu_level1_light_color: '#ffffff',
						main_menu_level1_light_hover_color: '#00bcd4',
						main_menu_level1_light_active_color: '#ffffff',
						overlay_menu_background_color: '#212331',
						overlay_menu_color: '#ffffff',
						overlay_menu_hover_color: '#00bcd4',
						overlay_menu_active_color: '#00bcd4'
					}
				}
			],
			top_area_style: [
				{
					values: ['1'],
					data: {
						top_area_background_color: '#f4f6f7',
						top_area_border_color: '#00bcd4',
						top_area_separator_color: '#dfe5e8',
						top_area_text_color: '#5f727f',
						top_area_link_color: '#5f727f',
						top_area_link_hover_color: '#00bcd4',
						top_area_button_text_color: '#ffffff',
						top_area_button_background_color: '#494c64',
						top_area_button_hover_text_color: '#ffffff',
						top_area_button_hover_background_color: '#00bcd4',
						top_area_icons_color: '#5f727f'
					}
				},
				{
					values: ['2'],
					data: {
						top_area_background_color: '#212331',
						top_area_border_color: '#474b61',
						top_area_separator_color: '#51546c',
						top_area_text_color: '#99a9b5',
						top_area_link_color: '#99a9b5',
						top_area_link_hover_color: '#ffffff',
						top_area_button_text_color: '#ffffff',
						top_area_button_background_color: '#00bcd4',
						top_area_button_hover_text_color: '#ffffff',
						top_area_button_hover_background_color: '#46485c',
						top_area_icons_color: '#99a9b5'
					}
				},
				{
					values: ['3'],
					data: {
						top_area_background_color: '#393d50',
						top_area_border_color: '#00bcd4',
						top_area_separator_color: '#494c64',
						top_area_text_color: '#99a9b5',
						top_area_link_color: '#99a9b5',
						top_area_link_hover_color: '#ffffff',
						top_area_button_text_color: '#ffffff',
						top_area_button_background_color: '#99a9b5',
						top_area_button_hover_text_color: '#ffffff',
						top_area_button_hover_background_color: '#00bcd4',
						top_area_icons_color: '#99a9b5'
					}
				}
			],
			mobile_menu_layout_style: [
				{
					values: ['light'],
					condition: function(optionValue, itemValue) {
						return $('#mobile_menu_layout').val() == 'default';
					},
					data: {
						mobile_menu_font_family: 'Source Sans Pro',
						mobile_menu_font_style: 'regular',
						mobile_menu_font_sets: '',
						mobile_menu_font_size: '16',
						mobile_menu_line_height: '20',
						mobile_menu_background_color: '',
						mobile_menu_level1_color: '#5f727f',
						mobile_menu_level1_background_color: '#f4f6f7',
						mobile_menu_level1_active_color: '#3c3950',
						mobile_menu_level1_active_background_color: '#ffffff',
						mobile_menu_level2_color: '#5f727f',
						mobile_menu_level2_background_color: '#f4f6f7',
						mobile_menu_level2_active_color: '#3c3950',
						mobile_menu_level2_active_background_color: '#ffffff',
						mobile_menu_level3_color: '#5f727f',
						mobile_menu_level3_background_color: '#f4f6f7',
						mobile_menu_level3_active_color: '#3c3950',
						mobile_menu_level3_active_background_color: '#ffffff',
						mobile_menu_border_color: '#dfe5e8',
						mobile_menu_social_icon_color: '',
						mobile_menu_hide_color: ''
					}
				},
				{
					values: ['dark'],
					condition: function(optionValue, itemValue) {
						return $('#mobile_menu_layout').val() == 'default';
					},
					data: {
						mobile_menu_font_family: 'Source Sans Pro',
						mobile_menu_font_style: 'regular',
						mobile_menu_font_sets: '',
						mobile_menu_font_size: '16',
						mobile_menu_line_height: '20',
						mobile_menu_background_color: '',
						mobile_menu_level1_color: '#99a9b5',
						mobile_menu_level1_background_color: '#212331',
						mobile_menu_level1_active_color: '#ffffff',
						mobile_menu_level1_active_background_color: '#181828',
						mobile_menu_level2_color: '#99a9b5',
						mobile_menu_level2_background_color: '#212331',
						mobile_menu_level2_active_color: '#ffffff',
						mobile_menu_level2_active_background_color: '#181828',
						mobile_menu_level3_color: '#99a9b5',
						mobile_menu_level3_background_color: '#212331',
						mobile_menu_level3_active_color: '#3c3950',
						mobile_menu_level3_active_background_color: '#181828',
						mobile_menu_border_color: '#494c64',
						mobile_menu_social_icon_color: '',
						mobile_menu_hide_color: ''
					}
				},
				{
					values: ['light'],
					condition: function(optionValue, itemValue) {
						return $('#mobile_menu_layout').val() == 'overlay';
					},
					data: {
						mobile_menu_font_family: 'Montserrat',
						mobile_menu_font_style: '700',
						mobile_menu_font_sets: '',
						mobile_menu_font_size: '24',
						mobile_menu_line_height: '48',
						mobile_menu_background_color: '#ffffff',
						mobile_menu_level1_color: '#212331',
						mobile_menu_level1_background_color: '',
						mobile_menu_level1_active_color: '#00bcd4',
						mobile_menu_level1_active_background_color: '',
						mobile_menu_level2_color: '#212331',
						mobile_menu_level2_background_color: '',
						mobile_menu_level2_active_color: '#00bcd4',
						mobile_menu_level2_active_background_color: '',
						mobile_menu_level3_color: '#212331',
						mobile_menu_level3_background_color: '',
						mobile_menu_level3_active_color: '#00bcd4',
						mobile_menu_level3_active_background_color: '',
						mobile_menu_border_color: '',
						mobile_menu_social_icon_color: '',
						mobile_menu_hide_color: '#00bcd4'
					}
				},
				{
					values: ['dark'],
					condition: function(optionValue, itemValue) {
						return $('#mobile_menu_layout').val() == 'overlay';
					},
					data: {
						mobile_menu_font_family: 'Montserrat',
						mobile_menu_font_style: '700',
						mobile_menu_font_sets: '',
						mobile_menu_font_size: '24',
						mobile_menu_line_height: '48',
						mobile_menu_background_color: '#212331',
						mobile_menu_level1_color: '#ffffff',
						mobile_menu_level1_background_color: '',
						mobile_menu_level1_active_color: '#00bcd4',
						mobile_menu_level1_active_background_color: '',
						mobile_menu_level2_color: '#ffffff',
						mobile_menu_level2_background_color: '',
						mobile_menu_level2_active_color: '#00bcd4',
						mobile_menu_level2_active_background_color: '',
						mobile_menu_level3_color: '#ffffff',
						mobile_menu_level3_background_color: '',
						mobile_menu_level3_active_color: '#00bcd4',
						mobile_menu_level3_active_background_color: '',
						mobile_menu_border_color: '',
						mobile_menu_social_icon_color: '',
						mobile_menu_hide_color: '#00bcd4'
					}
				},
				{
					values: ['light'],
					condition: function(optionValue, itemValue) {
						return $('#mobile_menu_layout').val() == 'slide-horizontal' || $('#mobile_menu_layout').val() == 'slide-vertical';
					},
					data: {
						mobile_menu_font_family: 'Source Sans Pro',
						mobile_menu_font_style: 'regular',
						mobile_menu_font_sets: '',
						mobile_menu_font_size: '16',
						mobile_menu_line_height: '20',
						mobile_menu_background_color: '#ffffff',
						mobile_menu_level1_color: '#5f727f',
						mobile_menu_level1_background_color: '#dfe5e8',
						mobile_menu_level1_active_color: '#3c3950',
						mobile_menu_level1_active_background_color: '#dfe5e8',
						mobile_menu_level2_color: '#5f727f',
						mobile_menu_level2_background_color: '#f0f3f2',
						mobile_menu_level2_active_color: '#3c3950',
						mobile_menu_level2_active_background_color: '#f0f3f2',
						mobile_menu_level3_color: '#5f727f',
						mobile_menu_level3_background_color: '#ffffff',
						mobile_menu_level3_active_color: '#ffffff',
						mobile_menu_level3_active_background_color: '#494c64',
						mobile_menu_border_color: '#dfe5e8',
						mobile_menu_social_icon_color: '#99a9b5',
						mobile_menu_hide_color: '#3c3950'
					}
				},
				{
					values: ['dark'],
					condition: function(optionValue, itemValue) {
						return $('#mobile_menu_layout').val() == 'slide-horizontal' || $('#mobile_menu_layout').val() == 'slide-vertical';
					},
					data: {
						mobile_menu_font_family: 'Source Sans Pro',
						mobile_menu_font_style: 'regular',
						mobile_menu_font_sets: '',
						mobile_menu_font_size: '16',
						mobile_menu_line_height: '20',
						mobile_menu_background_color: '#212331',
						mobile_menu_level1_color: '#99a9b5',
						mobile_menu_level1_background_color: '#212331',
						mobile_menu_level1_active_color: '#ffffff',
						mobile_menu_level1_active_background_color: '#212331',
						mobile_menu_level2_color: '#99a9b5',
						mobile_menu_level2_background_color: '#393d4f',
						mobile_menu_level2_active_color: '#ffffff',
						mobile_menu_level2_active_background_color: '#393d4f',
						mobile_menu_level3_color: '#99a9b5',
						mobile_menu_level3_background_color: '#494c64',
						mobile_menu_level3_active_color: '#3c3950',
						mobile_menu_level3_active_background_color: '#00bcd4',
						mobile_menu_border_color: '#494c64',
						mobile_menu_social_icon_color: '#99a9b5',
						mobile_menu_hide_color: '#ffffff'
					}
				}
			],
			mobile_menu_layout: [
				{
					values: ['%ALL%'],
					action: function() {
						$('#mobile_menu_layout_style').trigger('change');
					}
				}
			]
		}

		$.each(options_dependencies, function(i, values) {
			$('#'+i).change(function() {
				var optionValue = $(this).val();
				$.each(values, function(valueItemIndex, valueItem) {
					if ((valueItem.values.indexOf('%ALL%') != -1 || valueItem.values.indexOf(optionValue) != -1) && (typeof valueItem.condition !== "function" || valueItem.condition(optionValue, valueItem.value))) {
						if (typeof valueItem.action === "function") {
							valueItem.action();
						}
						if (valueItem.data != undefined) {
							$.each(valueItem.data, function(item, value) {
								$('#'+item).val(value).trigger('change');
							});
						}
					}
				});
			});
		});

		if($('#page_layout_style').val() !== 'fullwidth') {
			$('.page_paddings_field').hide();
		}

		$('#page_layout_style').change(function() {
			if($(this).val() !== 'fullwidth') {
				$('.page_paddings_field').hide();
			} else {
				$('.page_paddings_field').show();
			}
		});

		$('.option .icon .icons-picker').each(function() {
			var $field = $(this);
			var fid = $field.attr('id');
			var $packField = $('#'+fid+'_pack');
			$packField.change(function() {
				$field.data('iconpack', $(this).val());
			}).trigger('change');
		});

		$('.hidden-group-option').each(function() {
			var $field = $(this);
			var fid = $field.attr('id');
			var depOptionFieldId = fid.replace('_group', '');
			var $depOptionField = $('#'+depOptionFieldId);
			$depOptionField.change(function() {
				if($depOptionField.is(':checked')) {
					$field.show();
				} else {
					$field.hide();
				}
			}).trigger('change');
		});

/*		var $button1 = $('<button>Code Editor Toogle</button>').insertBefore($('#custom_css'));
		var editor1 = '';
		$button1.click(function(e) {
			e.preventDefault();
			if($button1.data('editor') == 1) {
				editor1.toTextArea();
				$button1.data('editor', 0);
			} else {
				editor1 = wp.CodeMirror.fromTextArea( $('#custom_css').get(0), {
					lineNumbers: true,
					mode: 'css'
				} );
				$button1.data('editor', 1);
			}
		});

		var $button2 = $('<button>Code Editor Toogle</button>').insertBefore($('#custom_js'));
		var editor2 = '';
		$button2.click(function(e) {
			e.preventDefault();
			if($button2.data('editor') == 1) {
				editor2.toTextArea();
				$button2.data('editor', 0);
			} else {
				editor2 = wp.CodeMirror.fromTextArea( $('#custom_js').get(0), {
					lineNumbers: true,
					mode: 'javascript'
				} );
				$button2.data('editor', 1);
			}
		});*/

	});
})(jQuery);
</script>
<?php if(!get_option('thesod_print_google_code')) : update_option('thesod_print_google_code', 1); ?>
<!-- Google Code for Remarketing Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 972114099;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "awXFCNfd8GkQs5HFzwM";
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/972114099/?label=awXFCNfd8GkQs5HFzwM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
<?php endif; ?>
</div>
<?php
}

/* Update theme options */
function thesod_theme_update_options() {
	if(check_admin_referer('thesod-theme-options')) {
		if(isset($_REQUEST['action']) && isset($_REQUEST['theme_options'])) {
			if($_REQUEST['action'] == 'save') {
				$theme_options = $_REQUEST['theme_options'];
				if(thesod_get_current_language()) {
					$ml_options = array('footer_html', 'top_area_button_text', 'top_area_button_link', 'contacts_address', 'contacts_phone', 'contacts_fax', 'contacts_email', 'contacts_website', 'top_area_contacts_address', 'top_area_contacts_phone', 'top_area_contacts_fax', 'top_area_contacts_email', 'top_area_contacts_website');
					foreach ($ml_options as $ml_option) {
						$value = thesod_get_option($ml_option, false, true);
						if(!is_array($value)) {
							if(thesod_get_default_language()) {
								$value = array(thesod_get_default_language() => $value);
							}
						}
						$value[thesod_get_current_language()] = $theme_options[$ml_option];
						$theme_options[$ml_option] = $value;
					}
				}
				thesod_check_activation($theme_options);
				update_option('thesod_theme_options', $theme_options);
				if(!empty($_REQUEST['thesod_page_data_options_default'])) {
					thesod_theme_options_set_page_settings('default', $_REQUEST['thesod_page_data_options_default']);
				}
				if(!empty($_REQUEST['thesod_page_data_options_blog'])) {
					thesod_theme_options_set_page_settings('blog', $_REQUEST['thesod_page_data_options_blog']);
				}
				if(!empty($_REQUEST['thesod_page_data_options_search'])) {
					thesod_theme_options_set_page_settings('search', $_REQUEST['thesod_page_data_options_search']);
				}
			} elseif($_REQUEST['action'] == 'reset') {
				if($options = get_option('thesod_theme_options')) {
					if(!($skin = thesod_get_option('page_color_style'))) {
						$skin = 'light';
					}
					$defaults = thesod_color_skin_defaults($skin);
					$newOptions = array();
					foreach($defaults as $key => $val) {
						$newOptions[$key] = $val;
					}
					$options = array_merge($options, $newOptions);
					thesod_check_activation($options);
					update_option('thesod_theme_options', $options);
				}

			} elseif($_REQUEST['action'] == 'backup') {
				if($settings = get_option('thesod_theme_options')) {
					update_option('thesod_theme_options_backup', array('date' => time(), 'settings' => json_encode($settings)));
				}
			} elseif($_REQUEST['action'] == 'restore') {
				if($settings = get_option('thesod_theme_options_backup')) {
					thesod_check_activation($options);
					update_option('thesod_theme_options', json_decode($settings['settings'], true));
				}
			} elseif($_REQUEST['action'] == 'import') {
				thesod_check_activation($theme_options);
				update_option('thesod_theme_options', json_decode(stripslashes($_REQUEST['import_settings']), true));
			} elseif($_REQUEST['action'] == 'activation' && isset($_REQUEST['theme_options']['purchase_code'])) {
				$theme_options = get_option('thesod_theme_options');
				$theme_options['purchase_code'] = $_REQUEST['theme_options']['purchase_code'];
				thesod_check_activation($theme_options);
				update_option('thesod_theme_options', $theme_options);
			}
		}
	}
}

/* Get theme option*/
if(!function_exists('thesod_get_option')) {
function thesod_get_option($name, $default = false, $ml_full = false) {
	$options = get_option('thesod_theme_options');
	if(isset($options[$name])) {
		$ml_options = array('footer_html', 'top_area_button_text', 'top_area_button_link', 'contacts_address', 'contacts_phone', 'contacts_fax', 'contacts_email', 'contacts_website', 'top_area_contacts_address', 'top_area_contacts_phone', 'top_area_contacts_fax', 'top_area_contacts_email', 'top_area_contacts_website');
		if(in_array($name, $ml_options) && is_array($options[$name]) && !$ml_full) {
			if(thesod_get_current_language()) {
				if(isset($options[$name][thesod_get_current_language()])) {
					$options[$name] = $options[$name][thesod_get_current_language()];
				} elseif(thesod_get_default_language() && isset($options[$name][thesod_get_default_language()])) {
					$options[$name] = $options[$name][thesod_get_default_language()];
				} else {
					$options[$name] = '';
				}
			}else {
				$options[$name] = reset($options[$name]);
			}
		}
		return apply_filters('thesod_option_'.$name, $options[$name]);
	}
	return apply_filters('thesod_option_'.$name, $default);
}
}

function thesod_generate_custom_css() {
	ob_start();
	thesod_custom_fonts();
	require get_template_directory() . '/inc/custom-css.php';
	if(file_exists(get_stylesheet_directory() . '/inc/custom-css.php') && get_stylesheet_directory() != get_template_directory()) {
		require get_stylesheet_directory() . '/inc/custom-css.php';
	}
	$custom_css = ob_get_clean();
	ob_start();
	require get_template_directory() . '/inc/style-editor-css.php';
	$editor_css = ob_get_clean();
	$action = array('action');
	$url = wp_nonce_url('admin.php?page=thesod-theme-options','thesod-theme-options');
	if (false === ($creds = request_filesystem_credentials($url, '', false, get_stylesheet_directory() . '/css/', $action) ) ) {
		return 'generate_css_continue';
	}
	if(!WP_Filesystem($creds)) {
		request_filesystem_credentials($url, '', true, get_stylesheet_directory() . '/css/', $action);
		return 'generate_css_continue';
	}
	global $wp_filesystem;
	$old_name = thesod_get_custom_css_filename();
	$new_name = thesod_generate_custom_css_filename();
	if(!$wp_filesystem->put_contents($wp_filesystem->find_folder(get_stylesheet_directory()) . 'css/'.$new_name.'.css', $custom_css)) {
		update_option('thesod_genearte_css_error', '1');
?>
	<div class="error">
		<p><?php printf(esc_html__('thesod\'s styles cannot be customized because file "%s" cannot be modified. Please check your server\'s settings. Then click "Save Changes" button.', 'thesod'), get_stylesheet_directory() . '/css/custom.css'); ?></p>
	</div>
<?php
	} else {
		$wp_filesystem->put_contents($wp_filesystem->find_folder(get_template_directory()) . 'css/style-editor.css', $editor_css);
		if($old_name != 'custom') {
			$wp_filesystem->delete($wp_filesystem->find_folder(get_stylesheet_directory()) . 'css/'.$old_name.'.css', $custom_css);
		}
		thesod_save_custom_css_filename($new_name);
		delete_option('thesod_genearte_css_error');
		delete_option('thesod_generate_empty_custom_css_fail');
	}
}

function thesod_genearte_css_error() {
	if(isset($_GET['page']) && $_GET['page'] == 'thesod-theme-options' && get_option('thesod_genearte_css_error')) {
?>
	<div class="error">
		<p><?php printf(esc_html__('thesod\'s styles cannot be customized because file "%s" cannot be modified. Please check your server\'s settings. Then click "Save Changes" button.', 'thesod'), get_stylesheet_directory() . '/css/custom.css'); ?></p>
	</div>
<?php
	}
}
add_action('admin_notices', 'thesod_genearte_css_error');

function thesod_activate() {
	global $pagenow;
	if(is_admin() && 'themes.php' == $pagenow && isset($_GET['activated'])) {
		wp_redirect(admin_url('admin.php?page=thesod-theme-options#activation'));
		exit;
	}
}
add_action('after_setup_theme', 'thesod_activate', 11);

add_action('wp_ajax_thesod_submit_activation', 'thesod_submit_activation');
function thesod_submit_activation() {
	delete_option('thesod_activation');
	if(!empty($_REQUEST['purchase_code'])) {
		$theme_options = get_option('thesod_theme_options');
		$theme_options['purchase_code'] = $_REQUEST['purchase_code'];
		update_option('thesod_theme_options', $theme_options);
		$response_p = wp_remote_get(add_query_arg(array('code' => $_REQUEST['purchase_code'], 'site_url' => get_site_url()), esc_url('http://democontent.codex-themes.com/av_validate_code.php')), array('timeout' => 20));

		if(is_wp_error($response_p)) {
			echo json_encode(array('status' => 0, 'message' => esc_html__('Some troubles with connecting to thesod server.', 'thesod')));
		} else {
			$rp_data = json_decode($response_p['body'], true);
			if(is_array($rp_data) && isset($rp_data['result']) && $rp_data['result'] && isset($rp_data['item_id']) && $rp_data['item_id'] === '16061685') {
				$plugin_button_html = '<div class="activation-plugin-button">'.wp_kses(sprintf(__('<a href="%s">Begin installing plugins</a>', 'thesod'), admin_url('admin.php?page=install-required-plugins')), array('a' => array('href' => array(), 'class' => array()))).'</div>';
				echo json_encode(array('status' => 1, 'message' => esc_html__('Thank you, your purchase code is valid. thesod has been activated.', 'thesod'), 'button' => $plugin_button_html));
				update_option('thesod_activation', 1);
			} else {
				echo json_encode(array('status' => 0, 'message' => isset($rp_data['message']) ? $rp_data['message'] : esc_html__('The purchase code you have entered is not valid. thesod has not been activated.', 'thesod')));
			}
		}
	} else {
		echo json_encode(array('status' => 0, 'message' => esc_html__('Purchase code is empty.', 'thesod')));
	}
	die(-1);
}

function thesod_check_activation($theme_options) {
	if(get_option('thesod_activation')) {
		if(empty($theme_options['purchase_code'])) {
			delete_option('thesod_activation');
		} elseif($theme_options['purchase_code'] !== thesod_get_option('purchase_code')) {
			delete_option('thesod_activation');

			$response_p = wp_remote_get(add_query_arg(array('code' => $theme_options['purchase_code'], 'site_url' => get_site_url()), esc_url('http://democontent.codex-themes.com/av_validate_code.php')), array('timeout' => 20));
			if(!is_wp_error($response_p)) {
				$rp_data = json_decode($response_p['body'], true);
				if(is_array($rp_data) && isset($rp_data['result']) && $rp_data['result'] && isset($rp_data['item_id']) && $rp_data['item_id'] === '16061685') {
					update_option('thesod_activation', 1);
				}
			}
		}
	} elseif(!empty($theme_options['purchase_code'])) {
		$response_p = wp_remote_get(add_query_arg(array('code' => $theme_options['purchase_code'], 'site_url' => get_site_url()), esc_url('http://democontent.codex-themes.com/av_validate_code.php')), array('timeout' => 20));
		if(!is_wp_error($response_p)) {
			$rp_data = json_decode($response_p['body'], true);
			if(is_array($rp_data) && isset($rp_data['result']) && $rp_data['result'] && isset($rp_data['item_id']) && $rp_data['item_id'] === '16061685') {
				update_option('thesod_activation', 1);
			}
		}
	}
}

function thesod_activation_notice() {
	if(empty( $_COOKIE['thesod_activation'] )) return ;
	if(get_option('thesod_activation')) return ;
	if(defined('ENVATO_HOSTED_SITE') && thesod_get_purchase()) return ;
?>
<style>
	.thesod_license-activation-notice {
		position: relative;
	}
</style>
<script type="text/javascript">
(function ( $ ) {
	var setCookie = function ( c_name, value, exdays ) {
		var exdate = new Date();
		exdate.setDate( exdate.getDate() + exdays );
		var c_value = encodeURIComponent( value ) + ((null === exdays) ? "" : "; expires=" + exdate.toUTCString());
		document.cookie = c_name + "=" + c_value;
	};
	$( document ).on( 'click.thesod-notice-dismiss', '.thesod-notice-dismiss', function ( e ) {
		e.preventDefault();
		var $el = $( this ).closest('#thesod_license-activation-notice' );
		$el.fadeTo( 100, 0, function () {
			$el.slideUp( 100, function () {
				$el.remove();
			} );
		} );
		setCookie( 'thesod_activation', '1', 30 );
	} );
})( window.jQuery );
</script>
<?php
	if(!defined('ENVATO_HOSTED_SITE')) {
		echo '<div class="updated thesod_license-activation-notice" id="thesod_license-activation-notice"><p>' . sprintf( wp_kses(__( 'Welcome to thesod! Would you like to import our awesome demos and take advantage of our amazing features? Please <a href="%s">activate</a> your copy of thesod.', 'thesod' ), array('a' => array('href' => array()))), esc_url(admin_url('admin.php?page=thesod-theme-options#activation')) ) . '</p>' . '<button type="button" class="notice-dismiss thesod-notice-dismiss"><span class="screen-reader-text">' . __( 'Dismiss this notice.', 'default' ) . '</span></button></div>';
	} else {
		echo '<div class="updated thesod_license-activation-notice" id="thesod_license-activation-notice"><p>' . sprintf( wp_kses(__( 'Welcome to thesod! Would you like to import our awesome demos and take advantage of our amazing features? led. Please install "Envato WordPress Toolkit" plugin and fill <a href="%s">Envato "User Account Information"</a>.', 'thesod' ), array('a' => array('href' => array()))), esc_url(admin_url('admin.php?page=envato-wordpress-toolkit')) ) . '</p>' . '<button type="button" class="notice-dismiss thesod-notice-dismiss"><span class="screen-reader-text">' . __( 'Dismiss this notice.', 'default' ) . '</span></button></div>';
	}
}
add_action('admin_notices', 'thesod_activation_notice');

function thesod_theme_options_page_settings_block($type = 'default') {
	ob_start();
	$meta_box_funcs = array();
	$meta_box_funcs['thesod_page_title_settings_box'] = esc_html__('Page Title', 'thesod');
	$meta_box_funcs['thesod_page_header_settings_box'] = esc_html__('Page Header', 'thesod');
	$meta_box_funcs['thesod_page_sidebar_settings_box'] = esc_html__('Page Sidebar', 'thesod');
	if(thesod_is_plugin_active('thesod-elements/thesod-elements.php')) {
		$meta_box_funcs['thesod_page_slideshow_settings_box'] = esc_html__('Page Slideshow', 'thesod');
	}
	$meta_box_funcs['thesod_page_effects_settings_box'] = esc_html__('Additional Options', 'thesod');
	$meta_box_funcs['thesod_page_preloader_settings_box'] = esc_html__('Page Preloader', 'thesod');
	echo '<div id="thesod-custom-page-options-boxes">';
	foreach($meta_box_funcs as $func => $title) {
		echo '<div class="postbox theme-options-page-settings-box">';
		echo '<h3 class="hndle">'.$title.'</h3>';
		echo '<div class="inside">';
		call_user_func($func, 0, $type);
		echo '</div>';
		echo '</div>';
	}
	echo '</div>';
	$block = ob_get_clean();
	$block = str_replace(array('thesod_page_data', ' for="page_', ' id="page_', '$(\'#page_', '$(\'#wp-page_','hidden-by-title-style-'), array('thesod_page_data_options_'.$type, ' for="page_'.$type.'_', ' id="page_'.$type.'_', '$(\'#page_'.$type.'_', '$(\'#wp-page_'.$type.'_', 'options_'.$type.'_hidden-by-title-style-'), $block);
	$block = str_replace(array('id="page_'.$type.'_'.$type.'_'), array('id="page_'.$type.'_'), $block);
	echo $block;
}

function thesod_theme_options_get_page_settings($type) {
	$page_data = array_merge(
		thesod_get_sanitize_page_title_data(0, get_option('thesod_options_page_settings_'.$type), $type),
		thesod_get_sanitize_page_header_data(0, get_option('thesod_options_page_settings_'.$type), $type),
		thesod_get_sanitize_page_effects_data(0, get_option('thesod_options_page_settings_'.$type), $type),
		thesod_get_sanitize_page_preloader_data(0, get_option('thesod_options_page_settings_'.$type), $type),
		thesod_get_sanitize_page_slideshow_data(0, get_option('thesod_options_page_settings_'.$type), $type),
		thesod_get_sanitize_page_sidebar_data(0, get_option('thesod_options_page_settings_'.$type), $type)
	);
	return array_map('stripslashes', $page_data);
}

function thesod_theme_options_set_page_settings($type, $data) {
	$page_data = array_merge(
		thesod_get_sanitize_page_title_data(0, $data),
		thesod_get_sanitize_page_header_data(0, $data),
		thesod_get_sanitize_page_effects_data(0, $data),
		thesod_get_sanitize_page_preloader_data(0, $data),
		thesod_get_sanitize_page_slideshow_data(0, $data),
		thesod_get_sanitize_page_sidebar_data(0, $data)
	);
	update_option('thesod_options_page_settings_'.$type, $page_data);
}

function thesod_generate_empty_custom_css() {
	ob_start();
	thesod_custom_fonts();
	require get_template_directory() . '/inc/custom-css.php';
	if(file_exists(get_stylesheet_directory() . '/inc/custom-css.php') && get_stylesheet_directory() != get_template_directory()) {
		require get_stylesheet_directory() . '/inc/custom-css.php';
	}
	$custom_css = ob_get_clean();
	ob_start();
	require get_template_directory() . '/inc/style-editor-css.php';
	$editor_css = ob_get_clean();
	$action = array('action');
	$url = wp_nonce_url('admin.php?page=thesod-theme-options','thesod-theme-options');
	if(WP_Filesystem()) {
		global $wp_filesystem;
		$old_name = thesod_get_custom_css_filename();
		$new_name = thesod_generate_custom_css_filename();
		if(!$wp_filesystem->put_contents($wp_filesystem->find_folder(get_stylesheet_directory()) . 'css/'.$new_name.'.css', $custom_css) && get_option('thesod_custom_css_filename')) {
			update_option('thesod_generate_empty_custom_css_fail', 1);
		} else {
			$wp_filesystem->put_contents($wp_filesystem->find_folder(get_template_directory()) . 'css/style-editor.css', $editor_css);
			if($old_name != 'custom') {
				$wp_filesystem->delete($wp_filesystem->find_folder(get_stylesheet_directory()) . 'css/'.$old_name.'.css', $custom_css);
			}
			thesod_save_custom_css_filename($new_name);
			delete_option('thesod_generate_empty_custom_css_fail');
		}
	} elseif(get_option('thesod_custom_css_filename')) {
		update_option('thesod_generate_empty_custom_css_fail', 1);
	}
}

function thesod_generate_empty_custom_css_notice() {
	if(get_option('thesod_generate_empty_custom_css_fail', 0) && get_current_screen()->id != 'toplevel_page_thesod-theme-options') {
?>
	<div class="error">
		<form id="thesod-generate-empty-form" method="post" action="<?php echo esc_url(admin_url('admin.php?page=thesod-theme-options')); ?>"><input type="hidden" name="action" value="save"/></form>
		<p><?php printf(wp_kses(__('WARNING: custom.css file is missing in your thesod installation. Custom.css is important for proper functioning of thesod. <a href="#" onclick="document.getElementById(\'thesod-generate-empty-form\').submit(); return false;">Please regenerate it now.</a> All your settings will remain, this action will not affect your setup.', 'thesod'), array('a' => array('href' => array(), 'onclick' => array(''))))); ?></p>
	</div>
<?php
	}
}
add_action('admin_notices', 'thesod_generate_empty_custom_css_notice');
