<?php

function thesod_get_image_regenerated_option_key() {
	return 'thesod_image_regenerated';
}

function thesod_get_attachment_relative_path( $file ) {
	$dirname = dirname( $file );
	$uploads = wp_upload_dir();

	if ( '.' === $dirname ) {
		return '';
	}

	return str_replace($uploads['basedir'], '', $dirname);
}

if(!function_exists('thesod_generate_thumbnail_src')) {

	function thesod_generate_thumbnail_src($attachment_id, $size) {
		$data = thesod_image_cache_get($attachment_id, $size);
		if ($data) {
			return $data;
		}

		$data = thesod_get_thumbnail_src($attachment_id, $size);
		thesod_image_cache_set($attachment_id, $size, $data);
		return $data;
	}

	function thesod_get_thumbnail_src($attachment_id, $size) {
		$thesod_image_sizes = thesod_image_sizes();

		if(isset($thesod_image_sizes[$size])) {
			$attachment_path = get_attached_file($attachment_id);
			if (!$attachment_path || !file_exists($attachment_path)) {
				$default_img = wp_get_attachment_image_src($attachment_id, $thesod_image_sizes[$size]);
				if(is_array($default_img)) {
					$default_img['not_generated'] = true;
				}
				return $default_img;
			}

			$dummy_image_editor = new thesod_Dummy_WP_Image_Editor($attachment_path);
			$attachment_thumb_path = $dummy_image_editor->generate_filename($size);
			$attachment_thumb_path = apply_filters('thesod_attachment_thumbnail_path', $attachment_thumb_path, $attachment_id);

			if (!file_exists($attachment_thumb_path)) {
				$image_editor = wp_get_image_editor($attachment_path);
				if (!is_wp_error($image_editor) && !is_wp_error($image_editor->resize($thesod_image_sizes[$size][0], $thesod_image_sizes[$size][1], $thesod_image_sizes[$size][2]))) {
					$attachment_resized = $image_editor->save($attachment_thumb_path);
					if (!is_wp_error($attachment_resized) && $attachment_resized) {
						do_action('thesod_thumbnail_generated', array('/'._wp_relative_upload_path($attachment_thumb_path)));
						return thesod_build_image_result($attachment_resized['path'], $attachment_resized['width'], $attachment_resized['height']);
					} else {
						return thesod_build_image_data($attachment_path);
					}
				} else {
					return thesod_build_image_data($attachment_path);
				}
			}
			return thesod_build_image_data($attachment_thumb_path);
		}
		return wp_get_attachment_image_src($attachment_id, $size);
	}

	function thesod_build_image_data($path) {
		$editor = new thesod_Dummy_WP_Image_Editor($path);
		$size = $editor->get_size();
		if (!$size) {
			return null;
		}
		return thesod_build_image_result($path, $size['width'], $size['height']);
	}

	function thesod_image_cache_get($attachment_id, $size) {
		global $thesod_image_src_cache, $thesod_image_regenerated;

		if (!$thesod_image_src_cache) {
			$thesod_image_src_cache = array();
		}

		if (isset($thesod_image_regenerated[$attachment_id]) &&
				isset($thesod_image_src_cache[$attachment_id][$size]['time']) &&
				$thesod_image_regenerated[$attachment_id] >= $thesod_image_src_cache[$attachment_id][$size]['time']) {
			return false;
		}

		if (!empty($thesod_image_src_cache[$attachment_id][$size])) {
			$data = $thesod_image_src_cache[$attachment_id][$size];
			unset($data['time']);
			return $data;
		}
		return false;
	}

	function thesod_image_cache_set($attachment_id, $size, $data) {
		global $thesod_image_src_cache, $thesod_image_src_cache_changed;

		if (!$thesod_image_src_cache) {
			$thesod_image_src_cache = array();
		}

		$data['time'] = time();
		$thesod_image_src_cache[$attachment_id][$size] = $data;
		$thesod_image_src_cache_changed = true;
	}

	function thesod_build_image_result($file, $width, $height) {
		$uploads = wp_upload_dir();
		$url = trailingslashit( $uploads['baseurl'] . thesod_get_attachment_relative_path( $file ) ) . basename( $file );
		return array($url, $width, $height);
	}

	function thesod_get_image_cache_option_key_prefix() {
		return 'thesod_image_cache_';
	}

	function thesod_get_image_cache_option_key($url = '') {
		$url = preg_replace('%\?.*$%', '', empty($url) ? $_SERVER['REQUEST_URI'] : $url);
		return thesod_get_image_cache_option_key_prefix() . sha1($url);
	}

	function thesod_image_generator_cache_init() {
		global $thesod_image_src_cache, $thesod_image_src_cache_changed, $thesod_image_regenerated;

		$thesod_image_regenerated = get_option(thesod_get_image_regenerated_option_key());
		$thesod_image_regenerated = !empty($thesod_image_regenerated) ? (array) $thesod_image_regenerated : array();

		$cache = get_option(thesod_get_image_cache_option_key());
		$thesod_image_src_cache = !empty($cache) ? (array) $cache : array();

		$uploads = wp_upload_dir();

		foreach ($thesod_image_src_cache as $attachment_id => $sizes) {
			if (!is_array($sizes)) {
				continue;
			}
			foreach ($sizes as $size => $size_data) {
				if (!is_array($size_data) || empty($size_data[0])) {
					continue;
				}
				$thesod_image_src_cache[$attachment_id][$size][0] = (empty($size_data['not_generated']) ? $uploads['baseurl'] : '') . $size_data[0];
			}
		}
		$thesod_image_src_cache_changed = false;
	}
	add_action('init', 'thesod_image_generator_cache_init');

	function thesod_image_generator_cache_save() {
		global $thesod_image_src_cache, $thesod_image_src_cache_changed;

		if (is_404() || !isset($thesod_image_src_cache_changed) || !$thesod_image_src_cache_changed) {
			return;
		}

		$uploads = wp_upload_dir();

		foreach ($thesod_image_src_cache as $attachment_id => $sizes) {
			if (!is_array($sizes)) {
				continue;
			}
			foreach ($sizes as $size => $size_data) {
				if (!is_array($size_data) || empty($size_data[0])) {
					continue;
				}
				$thesod_image_src_cache[$attachment_id][$size][0] = str_replace($uploads['baseurl'], '', $size_data[0]);
			}
		}

		update_option(thesod_get_image_cache_option_key(), $thesod_image_src_cache, 'no');
	}
	add_action('wp_footer', 'thesod_image_generator_cache_save', 9999);

	function thesod_thumbnails_generator_page_row_actions($actions, $post) {
		if ( current_user_can( 'manage_options' ) ) {
			$actions = array_merge( $actions, array(
					'thesod_flush_post_thumbnails_cache' => sprintf( '<a href="%s">' . __( 'Purge Thumbnails Cache', 'thesod' ) . '</a>', wp_nonce_url( sprintf( 'admin.php?page=thesod-thumbnails&thesod_flush_post_thumbnails_cache&post_id=%d', $post->ID ), 'thesod-thumbnails-cache-flush' ) )
				) );
		}
		return $actions;
	}
	add_filter('page_row_actions', 'thesod_thumbnails_generator_page_row_actions', 0, 2);
	add_filter('post_row_actions', 'thesod_thumbnails_generator_page_row_actions', 0, 2);

	function thesod_theme_add_thumbnails_generator_page() {
		add_submenu_page(null, esc_html__('thesod thumbnails','thesod'), esc_html__('thesod thumbnails','thesod'), 'manage_options', 'thesod-thumbnails', 'thesod_thumbnails_generator_page');
	}
	add_action('admin_menu', 'thesod_theme_add_thumbnails_generator_page', 50);

	function thesod_thumbnails_generator_page() {
		global $wpdb;

		if ($_GET['page'] != 'thesod-thumbnails') {
			exit;
		}

		if (isset($_GET['thesod_flush_post_thumbnails_cache'])) {
			if (!empty($_GET['post_id']) && $url=get_permalink($_GET['post_id'])) {
				if (wp_verify_nonce($_GET['_wpnonce'], 'thesod-thumbnails-cache-flush')) {
					$option_key = thesod_get_image_cache_option_key(str_replace(home_url(), '', $url));
					delete_option($option_key);
					thesod_thumbnails_generator_redirect(array(
						'thesod_note' => 'flush-success'
					));
				} {
					thesod_thumbnails_generator_redirect(array(
						'thesod_note' => 'nonce-error'
					));
				}
			} else {
				thesod_thumbnails_generator_redirect(array(
					'thesod_note' => 'empty-post'
				));
			}
		}

		if (isset($_GET['thesod_flush_thumbnails_cache'])) {
			if (wp_verify_nonce($_GET['_wpnonce'], 'thesod-thumbnails-cache-flush-all')) {
				$prefix = thesod_get_image_cache_option_key_prefix();
				$wpdb->query("DELETE FROM `{$wpdb->options}` WHERE `option_name` LIKE '%{$prefix}%'");
				thesod_thumbnails_generator_redirect(array(
					'thesod_note' => 'flush-all-success'
				));
			} else {
				thesod_thumbnails_generator_redirect(array(
					'thesod_note' => 'nonce-error'
				));
			}
		}
	}
	add_action('load-admin_page_thesod-thumbnails', 'thesod_thumbnails_generator_page');

	function thesod_admin_bar_thumbnails_generator($wp_admin_bar) {
		if (!is_user_logged_in() || (!is_user_member_of_blog() && !is_super_admin())) {
			return;
		}

		$wp_admin_bar->add_menu(array(
			'id'	=> 'thesod-thumbnails-generator',
			'title' => 'Purge All Thumbnails Cache',
			'href'  => esc_url(admin_url(wp_nonce_url('admin.php?page=thesod-thumbnails&thesod_flush_thumbnails_cache', 'thesod-thumbnails-cache-flush-all'))),
		));
	}
	//add_action('admin_bar_menu', 'thesod_admin_bar_thumbnails_generator', 101);

	function thesod_thumbnails_generator_redirect($params = array()) {
		if (!empty($_SERVER['HTTP_REFERER'])) {
			$url = $_SERVER['HTTP_REFERER'];
		} else {
			$url = '/wp-admin/index.php';
		}
		$url = add_query_arg($params, $url);
		@header( 'Location: ' . $url );
		exit;
	}

	function thesod_thumbnails_generator_notes() {
		$notes = array(
			'flush-success' => array(
				'class' => 'updated',
				'notice' => __( 'Cached post thumbnails have been deleted successfully!', 'thesod' )
			),
			'flush-all-success' => array(
				'class' => 'updated',
				'notice' => __( 'All cached thumbnails have been deleted successfully!', 'thesod' )
			),
			'nonce-error' => array(
				'class' => 'error',
				'notice' => __( 'Nonce verification is faield!', 'thesod' )
			),
			'empty-post' => array(
				'class' => 'error',
				'notice' => __( 'Post not found', 'thesod' )
			)
		);

		if (!empty($_GET['thesod_note']) && !empty($notes[$_GET['thesod_note']])) {
			?>
			<div class="<?php echo $notes[$_GET['thesod_note']]['class']; ?>">
				<p><?php echo $notes[$_GET['thesod_note']]['notice']; ?></p>
			</div>
			<?php
		}
	}
	add_action('admin_notices', 'thesod_thumbnails_generator_notes');

}

?>
