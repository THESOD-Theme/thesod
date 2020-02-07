<?php

require_once get_template_directory() . '/plugins/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'thesod_register_required_plugins' );
function thesod_register_required_plugins() {
	$plugins = array(
		array(
			'name' => esc_html__('thesod Theme Elements', 'thesod'),
			'slug' => 'thesod-elements',
			'source' => esc_url('http://democontent.codex-themes.com/plugins/thesod/required/thesod-elements.zip'),
			'required' => true,
			'version' => '',
			'force_activation' => false,
			'force_deactivation' => false,
			'external_url' => '',
		),
		array(
			'name' => esc_html__('LayerSlider WP', 'thesod'),
			'slug' => 'LayerSlider',
			'source' => esc_url('http://democontent.codex-themes.com/plugins/thesod/recommended/layersliderwp.installable.zip'),
			'required' => false,
			'version' => '',
			'force_activation' => false,
			'force_deactivation' => false,
			'external_url' => '',
		),
		array(
			'name' => esc_html__('Revolution Slider', 'thesod'),
			'slug' => 'revslider',
			'source' => esc_url('http://democontent.codex-themes.com/plugins/thesod/recommended/revslider.zip'),
			'required' => false,
			'version' => '',
			'force_activation' => false,
			'force_deactivation' => false,
			'external_url' => '',
		),
		array(
			'name' => esc_html__('Wordpress Page Widgets', 'thesod'),
			'slug' => 'wp-page-widget',
			'required' => false,
		),
		array(
			'name' => esc_html__('WPBakery Visual Composer', 'thesod'),
			'slug' => 'js_composer',
			'source' => esc_url('http://democontent.codex-themes.com/plugins/thesod/required/js_composer.zip'),
			'required' => true,
			'version' => '',
			'force_activation' => false,
			'force_deactivation' => false,
			'external_url' => '',
		),
		array(
			'name' => esc_html__('Contact Form 7', 'thesod'),
			'slug' => 'contact-form-7',
			'required' => false,
		),
		array(
			'name' => esc_html__('MailChimp for WordPress', 'thesod'),
			'slug' => 'mailchimp-for-wp',
			'required' => false,
		),
		array(
			'name' => esc_html__('Easy Forms for MailChimp by YIKES', 'thesod'),
			'slug' => 'yikes-inc-easy-mailchimp-extender',
			'required' => false,
		),
		array(
			'name' => esc_html__('ZillaLikes', 'thesod'),
			'slug' => 'zilla-likes',
			'source' => esc_url('http://democontent.codex-themes.com/plugins/thesod/recommended/zilla-likes.zip'),
			'required' => false,
			'version' => '1.1.1',
			'force_activation' => false,
			'force_deactivation' => false,
			'external_url' => '',
		),
	);

	if(thesod_is_plugin_active('woocommerce/woocommerce.php')) {
		$plugins[] = array(
			'name' => esc_html__('YITH WooCommerce Wishlist', 'thesod'),
			'slug' => 'yith-woocommerce-wishlist',
			'required' => false,
		);
	}

	$config = array(
		'domain' => 'thesod',
		'default_path' => '',
		'parent_slug' => 'admin.php',
		'menu' => 'install-required-plugins',
		'has_notices' => true,
		'is_automatic' => true,
		'message' => '',
		'strings' => array(
			'page_title' => esc_html__( 'Install Plugins', 'thesod' ),
			'menu_title' => esc_html__( 'Install Plugins', 'thesod' ),
			'installing' => esc_html__( 'Installing Plugin: %s', 'thesod' ),
			'oops' => esc_html__( 'Something went wrong with the plugin API.', 'thesod' ),
			'notice_can_install_required' => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'thesod' ),
			'notice_can_install_recommended' => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'thesod' ),
			'notice_cannot_install' => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'thesod' ),
			'notice_can_activate_required' => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'thesod' ),
			'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'thesod' ),
			'notice_cannot_activate' => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'thesod' ),
			'notice_ask_to_update' => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'thesod' ),
			'notice_cannot_update' => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'thesod' ),
			'install_link' => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'thesod' ),
			'activate_link' => _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'thesod' ),
			'return' => esc_html__( 'Return to Required Plugins Installer', 'thesod' ),
			'plugin_activated' => esc_html__( 'Plugin activated successfully.', 'thesod' ),
			'complete' => esc_html__( 'All plugins installed and activated successfully. %s', 'thesod' ),
			'nag_type' => 'updated'
		)
	);

	tgmpa( $plugins, $config );

}

add_action( 'admin_init', 'thesod_updater_plugin_load' );
function thesod_updater_plugin_load() {
	if ( ! class_exists( 'TGM_Updater' ) ) {
		require get_template_directory() . '/plugins/class-tgm-updater.php';
	}
	
	if(thesod_is_plugin_active('LayerSlider/layerslider.php')) {
		$plugin_data = get_plugin_data(trailingslashit(WP_PLUGIN_DIR).'LayerSlider/layerslider.php');
		$args = array(
			'plugin_name' => esc_html__('LayerSlider WP', 'thesod'),
			'plugin_slug' => 'LayerSlider',
			'plugin_path' => 'LayerSlider/layerslider.php',
			'plugin_url'  => trailingslashit( WP_PLUGIN_URL ) . 'LayerSlider',
			'remote_url'  => esc_url('http://democontent.codex-themes.com/plugins/thesod/recommended/layerslider.json'),
			'version'     => $plugin_data['Version'],
			'key'         => ''
		);
		$tgm_updater = new TGM_Updater( $args );
	}
	if(thesod_is_plugin_active('revslider/revslider.php')) {
		$plugin_data = get_plugin_data(trailingslashit(WP_PLUGIN_DIR).'revslider/revslider.php');
		$args = array(
			'plugin_name' => esc_html__('Revolution Slider', 'thesod'),
			'plugin_slug' => 'revslider',
			'plugin_path' => 'revslider/revslider.php',
			'plugin_url'  => trailingslashit( WP_PLUGIN_URL ) . 'revslider',
			'remote_url'  => esc_url('http://democontent.codex-themes.com/plugins/thesod/recommended/revslider.json'),
			'version'     => $plugin_data['Version'],
			'key'         => ''
		);
		$tgm_updater = new TGM_Updater( $args );
	}
	if(thesod_is_plugin_active('js_composer/js_composer.php')) {
		$plugin_data = get_plugin_data(trailingslashit(WP_PLUGIN_DIR).'js_composer/js_composer.php');
		$args = array(
			'plugin_name' => esc_html__('WPBakery Visual Composer', 'thesod'),
			'plugin_slug' => 'js_composer',
			'plugin_path' => 'js_composer/js_composer.php',
			'plugin_url'  => trailingslashit( WP_PLUGIN_URL ) . 'js_composer',
			'remote_url'  => esc_url('http://democontent.codex-themes.com/plugins/thesod/required/js_composer.json'),
			'version'     => $plugin_data['Version'],
			'key'         => ''
		);
		$tgm_updater = new TGM_Updater( $args );
	}
}

function thesod_get_purchase() {
	if(!defined('ENVATO_HOSTED_SITE')) {
		$theme_options = get_option('thesod_theme_options');
		if($theme_options && isset($theme_options['purchase_code'])) {
			return $theme_options['purchase_code'];
		}
	} else {
		return 'envato_hosted:'.(defined('SUBSCRIPTION_CODE') ? SUBSCRIPTION_CODE : '');
	}
	return false;
}

add_action( 'vc_before_init', 'thesod_vcSetAsTheme' );
function thesod_vcSetAsTheme() {
	//vc_set_as_theme();
}

if(function_exists('layerslider_set_as_theme')) layerslider_set_as_theme();

function thesod_upgrader_pre_download($reply, $package, $upgrader) {
	if(strpos($package, 'democontent.codex-themes.com') !== false && strpos($package, 'envato-wordpress-toolkit') === false) {
		if(!thesod_get_purchase()) {
			if(!defined('ENVATO_HOSTED_SITE')) {
				return new WP_Error('thesod_purchase_empty', sprintf(wp_kses(__('Purchase code verification failed. <a href="%s" target="_blank">Activate thesod</a>', 'thesod'), array('a' => array('href' => array(), 'target' => array()))),esc_url(admin_url('admin.php?page=thesod-theme-options#activation'))));
			}
		}
		$response_p = wp_remote_get(add_query_arg(array('code' => thesod_get_purchase(), 'site_url' => get_site_url()), 'http://democontent.codex-themes.com/av_validate_code'.(defined('ENVATO_HOSTED_SITE') ? '_envato' : '').'.php'), array('timeout' => 20));
		if(is_wp_error($response_p)) {
			return new WP_Error('thesod_connection_failed', esc_html__('Some troubles with connecting to thesod server.', 'thesod'));
		}
		$rp_data = json_decode($response_p['body'], true);
		if(!(is_array($rp_data) && isset($rp_data['result']) && $rp_data['result'] && isset($rp_data['item_id']) && $rp_data['item_id'] === '16061685')) {
			if(!defined('ENVATO_HOSTED_SITE')) {
				return new WP_Error('thesod_purchase_error', sprintf(wp_kses(__('Purchase code verification failed. <a href="%s" target="_blank">Activate thesod</a>', 'thesod'), array('a' => array('href' => array(), 'target' => array()))), esc_url(admin_url('admin.php?page=thesod-theme-options#activation'))));
			}
		}
	}
	return $reply;
}
add_filter('upgrader_pre_download', 'thesod_upgrader_pre_download', 10, 3);

function thesod_pre_set_site_transient_update_themes( $transient ) {

	$response = wp_remote_get('http://democontent.codex-themes.com/plugins/thesod/theme/theme.json', array('timeout' => 5));
	if ( is_wp_error( $response ) ) {
		return $transient;
	}

	$body = wp_remote_retrieve_body($response);
	$data = json_decode($body, 1);
	if ( ! isset( $data['new_version'] ) ) {
		return $transient;
	}

	$new_version = $data['new_version'];

	// Save update info if there are newer version.
	$theme = wp_get_theme('thesod');
	if ( version_compare( $theme->get( 'Version' ), $new_version, '<' ) ) {
		$transient->response[ 'thesod' ] = array(
			'theme' => 'thesod',
			'new_version' => $new_version,
			'url' => $data['changelog'],
			'package' => $data['package'],
		);
	}

	return $transient;
}
add_filter('pre_set_site_transient_update_themes', 'thesod_pre_set_site_transient_update_themes', 10, 3);

add_action('wp_ajax_thesod_theme_update_confirm', 'thesod_theme_update_confirm_content');
function thesod_theme_update_confirm_content() {
?>
<div class="fancybox-content thesod-theme-update-fancybox-content">
	<div class="thesod-theme-update-confirm-content">
		<div class="ttucc-title"><img src="<?php echo get_template_directory_uri(); ?>/images/admin-images/ttucc-title.png" alt="#" /></div>
		<div class="ttucc-description"><?php esc_html_e('Before updating, it would be better if you make a backup of your current theme files (via FTP). Also please note: if you have done any code modifications directly in parent’s theme source files, this changes may be overwritten. We recommend to use thesod child theme for any code modifications and customizations in order to ensure all further updates without any issues.', 'thesod'); ?></div>
		<div class="ttucc-confirm">
			<div class="ttucc-confirm-checkbox">
				<label for="thesod-update-confirm-checkbox"><input type="checkbox" name="confirm" id="thesod-update-confirm-checkbox" value="1" /><?php esc_html_e('I have read this notice and agree to proceed', 'thesod'); ?></label>
			</div>
			<div class="ttucc-confirm-button">
				<button id="thesod-update-confirm-button" disabled="disabled"><?php esc_html_e('Proceed with update', 'thesod'); ?></button>
			</div>
		</div>
	</div>
</div>
<?php
	die(-1);
}

function thesod_update_notice() {
	if ( !current_user_can('update_themes' ) )
		return false;
	if ( !isset($themes_update) )
		$themes_update = get_site_transient('update_themes');
	if ( isset($themes_update->response['thesod']) ) {
		$update = $themes_update->response['thesod'];
		$theme = wp_prepare_themes_for_js( array( wp_get_theme('thesod') ) );
		$details_url = add_query_arg(array(), $update['url']);
		$update_url = wp_nonce_url( admin_url( 'update.php?action=upgrade-theme&amp;theme=' . urlencode( 'thesod' ) ), 'upgrade-theme_thesod' );
		if(isset($theme[0]) && isset($theme[0]['hasUpdate']) && $theme[0]['hasUpdate']) {
			wp_enqueue_script('jquery-fancybox');
			wp_enqueue_style('jquery-fancybox');
			echo '<div class="thesod-update-notice notice notice-warning is-dismissible">';
			echo '<p>'.sprintf(wp_kses(__('There is a new version of thesod theme available. Your current version is <strong>%s</strong>. Update to <strong>%s</strong>.', 'thesod'), array('strong' => array())), $theme[0]['version'], $update['new_version']).'</p>';
			echo '<p>'.sprintf(wp_kses(__('<strong><a href="%s" class="thesod-view-details-link">View update details</a></strong> or <strong><a href="%s" class="thesod-update-link">Update now</a></strong>.', 'thesod'), array('strong' => array(), 'a' => array('href' => array(), 'class' => array()))), $details_url, $update_url).'</p>';
			echo '</div>';
		}
	}
}
add_action('admin_notices', 'thesod_update_notice');

function thesod_plugins_update_notice() {
	if ( !current_user_can('update_plugins' ) )
		return false;
	$plugins = get_site_transient('update_plugins');
	$thesod_plugins = array(
		'thesod-elements/thesod-elements.php',
		'thesod-import/thesod-import.php',
		'thesod-importer/thesod-importer.php',
		'LayerSlider/layerslider.php',
		'revslider/revslider.php',
		'js_composer/js_composer.php',
	);
	if ( isset($plugins->response) && is_array($plugins->response) ) {
		wp_enqueue_script('jquery-fancybox');
		wp_enqueue_style('jquery-fancybox');
		$plugins_ids = array_keys( $plugins->response );
		foreach ( $plugins_ids as $plugin_file ) {
			if(in_array($plugin_file, $thesod_plugins)) {
				$plugin_data = get_plugin_data(trailingslashit(WP_PLUGIN_DIR).$plugin_file);
				$plugin_update = $plugins->response[$plugin_file];
				echo '<div class="thesod-update-notice notice notice-warning is-dismissible">';
				echo '<p>'.sprintf(wp_kses(__('There is a new version of <strong>%s</strong> plugin available. Your current version is <strong>%s</strong>. Update to <strong>%s</strong>.', 'thesod'), array('strong' => array())), $plugin_data['Name'], $plugin_data['Version'], $plugin_update->new_version).'</p>';
				echo '<p>'.sprintf(wp_kses(__('<strong><a href="%s">Update now</a></strong>.', 'thesod'), array('strong' => array(), 'a' => array('href' => array()))), esc_url(admin_url('update-core.php'))).'</p>';
				echo '</div>';
			}
		}
	}
}
add_action('admin_notices', 'thesod_plugins_update_notice');

function thesod_tgmpa_admin_menu_args($args) {
	$args['parent_slug'] = 'thesod-theme-options';
	return $args;
}
add_filter('tgmpa_admin_menu_args', 'thesod_tgmpa_admin_menu_args');