<?php
/**
 * thesod Mega Menu Walker class.
 *
 */

/**
 * Create HTML list of nav menu input items.
 *
 * @package WordPress
 * @since 3.0.0
 * @uses Walker_Nav_Menu
 */
class thesod_Edit_Mega_Menu_Walker extends Walker_Nav_Menu {
	/**
	 * Starts the list before the elements are added.
	 *
	 * @see Walker_Nav_Menu::start_lvl()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   Not used.
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {}

	/**
	 * Ends the list of after the elements are added.
	 *
	 * @see Walker_Nav_Menu::end_lvl()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   Not used.
	 */
	function end_lvl( &$output, $depth = 0, $args = array() ) {}

	/**
	 * Start the element output.
	 *
	 * @see Walker_Nav_Menu::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Menu item data object.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   Not used.
	 * @param int    $id     Not used.
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $_wp_nav_menu_max_depth;
		$_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

		ob_start();
		$item_id = esc_attr( $item->ID );
		$removed_args = array(
			'action',
			'customlink-tab',
			'edit-menu-item',
			'menu-item',
			'page-tab',
			'_wpnonce',
		);

		$original_title = '';
		if ( 'taxonomy' == $item->type ) {
			$original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
			if ( is_wp_error( $original_title ) )
				$original_title = false;
		} elseif ( 'post_type' == $item->type ) {
			$original_object = get_post( $item->object_id );
			if ( $original_object ) {
				$original_title = get_the_title( $original_object->ID );
			}
		}

		$classes = array(
			'menu-item menu-item-depth-' . $depth,
			'menu-item-' . esc_attr( $item->object ),
			'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
		);

		$title = $item->title;

		if ( ! empty( $item->_invalid ) ) {
			$classes[] = 'menu-item-invalid';
			/* translators: %s: title of menu item which is invalid */
			$title = sprintf( esc_html__( '%s (Invalid)', 'thesod' ), $item->title );
		} elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
			$classes[] = 'pending';
			/* translators: %s: title of menu item in draft status */
			$title = sprintf( esc_html__('%s (Pending)', 'thesod'), $item->title );
		}

		$title = ( ! isset( $item->label ) || '' == $item->label ) ? $title : $item->label;

		$submenu_text = '';
		if ( 0 == $depth )
			$submenu_text = 'style="display: none;"';

		if (!isset($item->thesod_mega_menu))
			$item->thesod_mega_menu = $menu_item->thesod_mega_menu_default;

		$mega_menu_container_classes = array( 'thesod-megamenu-fields' );
		if ( $item->thesod_mega_menu['enable'] ) {
			$classes[] = 'field-thesod-megamenu-enabled';
		}

		$mega_menu_container_classes = implode( ' ', $mega_menu_container_classes );

		?>
		<li id="menu-item-<?php echo esc_attr($item_id); ?>" class="<?php echo esc_attr(implode(' ', $classes )); ?>">
			<dl class="menu-item-bar">
				<dt class="menu-item-handle">
					<span class="item-title"><span class="menu-item-title"><?php echo esc_html( $title ); ?></span> <span class="is-submenu" <?php echo $submenu_text; ?>><?php esc_html_e( 'sub item', 'thesod' ); ?></span></span>
					<span class="item-controls">
						<span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
						<span class="item-order hide-if-js">
							<a href="<?php
								echo esc_url(wp_nonce_url(
									add_query_arg(
										array(
											'action' => 'move-up-menu-item',
											'menu-item' => $item_id,
										),
										remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
									),
									'move-menu_item'
								));
							?>" class="item-move-up"><abbr title="<?php esc_attr_e('Move up', 'thesod'); ?>">&#8593;</abbr></a>
							|
							<a href="<?php
								echo esc_url(wp_nonce_url(
									add_query_arg(
										array(
											'action' => 'move-down-menu-item',
											'menu-item' => $item_id,
										),
										remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
									),
									'move-menu_item'
								));
							?>" class="item-move-down"><abbr title="<?php esc_attr_e('Move down', 'thesod'); ?>">&#8595;</abbr></a>
						</span>
						<a class="item-edit" id="edit-<?php echo esc_attr($item_id); ?>" title="<?php esc_attr_e('Edit Menu Item', 'thesod'); ?>" href="<?php
							echo esc_url(( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) ));
						?>"><?php esc_html_e( 'Edit Menu Item', 'thesod' ); ?></a>
					</span>
				</dt>
			</dl>

			<div class="menu-item-settings wp-clearfix" id="menu-item-settings-<?php echo esc_attr($item_id); ?>">
				<?php if( 'custom' == $item->type ) : ?>
					<p class="field-url description description-wide">
						<label for="edit-menu-item-url-<?php echo esc_attr($item_id); ?>">
							<?php esc_html_e( 'URL', 'thesod' ); ?><br />
							<input type="text" id="edit-menu-item-url-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
						</label>
					</p>
				<?php endif; ?>
				<p class="description description-thin">
					<label for="edit-menu-item-title-<?php echo esc_attr($item_id); ?>">
						<?php esc_html_e( 'Navigation Label', 'thesod' ); ?><br />
						<input type="text" id="edit-menu-item-title-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
					</label>
				</p>
				<p class="description description-thin">
					<label for="edit-menu-item-attr-title-<?php echo esc_attr($item_id); ?>">
						<?php esc_html_e( 'Title Attribute', 'thesod' ); ?><br />
						<input type="text" id="edit-menu-item-attr-title-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
					</label>
				</p>
				<p class="field-link-target description">
					<label for="edit-menu-item-target-<?php echo esc_attr($item_id); ?>">
						<input type="checkbox" id="edit-menu-item-target-<?php echo esc_attr($item_id); ?>" value="_blank" name="menu-item-target[<?php echo esc_attr($item_id); ?>]"<?php checked( $item->target, '_blank' ); ?> />
						<?php esc_html_e( 'Open link in a new window/tab', 'thesod' ); ?>
					</label>
				</p>
				<p class="field-css-classes description description-thin">
					<label for="edit-menu-item-classes-<?php echo esc_attr($item_id); ?>">
						<?php esc_html_e( 'CSS Classes (optional)', 'thesod' ); ?><br />
						<input type="text" id="edit-menu-item-classes-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
					</label>
				</p>
				<p class="field-xfn description description-thin">
					<label for="edit-menu-item-xfn-<?php echo esc_attr($item_id); ?>">
						<?php esc_html_e( 'Link Relationship (XFN)', 'thesod' ); ?><br />
						<input type="text" id="edit-menu-item-xfn-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
					</label>
				</p>
				<p class="field-description description description-wide">
					<label for="edit-menu-item-description-<?php echo esc_attr($item_id); ?>">
						<?php esc_html_e( 'Description', 'thesod' ); ?><br />
						<textarea id="edit-menu-item-description-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo esc_attr($item_id); ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
						<span class="description"><?php esc_html_e('The description will be displayed in the menu if the current theme supports it.', 'thesod'); ?></span>
					</label>
				</p>

				<div class="wrapper-thesod-mobile-clickable" style="clear: both;">
					<p class="field-thesod-mobile-clickable">
						<label for="edit-thesod-mobile-clickable-<?php echo esc_attr($item_id); ?>">
							<input id="edit-thesod-mobile-clickable-<?php echo esc_attr($item_id); ?>" type="checkbox" class="thesod-edit-thesod-mobile-clickable" name="thesod_mobile_clickable[<?php echo esc_attr($item_id); ?>]" <?php checked( $item->thesod_mobile_clickable ); ?>/>
							<?php esc_html_e( 'Make clickable on mobile', 'thesod' ); ?>
						</label>
					</p>
				</div>

				<!-- thesod Mega Menu Start -->

				<div class="<?php echo esc_attr( $mega_menu_container_classes ); ?>" style="clear: both;">

                    <p class="field-thesod-megamenu-icon description">
                        <label for="edit-thesod_mega_menu_icon-<?php echo esc_attr($item_id); ?>">
                            <?php esc_html_e( 'Icon', 'thesod' ); ?><br />
                            <input id="edit-thesod_mega_menu_icon-<?php echo esc_attr($item_id); ?>" class="thesod-edit-menu-item-icon" type="text" name="thesod_mega_menu_icon[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_html( $item->thesod_mega_menu['icon']); ?>"/><br />
                            <span class="description">
								<?php esc_html_e('Enter icon code', 'thesod'); ?>:
								<a class="sod-icon-info sod-icon-info-fontawesome" href="<?php echo esc_url(thesod_user_icons_info_link('fontawesome')); ?>" onclick="tb_show('<?php esc_attr_e('Icons info', 'thesod'); ?>', this.href+'?TB_iframe=true'); return false;"><?php esc_html_e('Show FontAwesome Icon Codes', 'thesod'); ?></a>
							</span>
                        </label>
                    </p>

					<!-- first level -->
					<p class="field-thesod-megamenu-enable">
						<label for="edit-thesod_mega_menu_enable-<?php echo esc_attr($item_id); ?>">
							<input id="edit-thesod_mega_menu_enable-<?php echo esc_attr($item_id); ?>" type="checkbox" class="thesod-edit-menu-item-icon-enable" name="thesod_mega_menu_enable[<?php echo esc_attr($item_id); ?>]" <?php checked( $item->thesod_mega_menu['enable'] ); ?>/>
							<?php _e( 'Enable Mega Menu', 'thesod' ); ?>
						</label>
					</p>

					<p class="field-thesod-megamenu-style description">
						<label for="edit-thesod_mega_menu_style-<?php echo esc_attr($item_id); ?>">
							<?php _e( 'Mega Menu Style', 'thesod' ); ?><br />
							<select name="thesod_mega_menu_style[<?php echo esc_attr($item_id); ?>]" id="edit-thesod_mega_menu_style-<?php echo esc_attr($item_id); ?>">
    							<?php foreach( $item->thesod_mega_menu_styles_values as $value=>$title): ?>
    								<option value="<?php echo esc_attr($value); ?>" <?php selected($value, $item->thesod_mega_menu['style']); ?>><?php echo esc_html($title); ?></option>
    							<?php endforeach; ?>
    						</select>
						</label>
					</p>

					<p class="field-thesod-megamenu-masonry">
						<label for="edit-thesod_mega_menu_masonry-<?php echo esc_attr($item_id); ?>">
							<input id="edit-thesod_mega_menu_masonry-<?php echo esc_attr($item_id); ?>" type="checkbox" class="thesod-edit-menu-item-icon-mega-masonry" name="thesod_mega_menu_masonry[<?php echo esc_attr($item_id); ?>]" <?php checked( $item->thesod_mega_menu['masonry'] ); ?>/>
							<?php esc_html_e( 'Mega Menu Masonry Style', 'thesod' ); ?>
						</label>
					</p>

                    <p class="field-thesod-megamenu-columns description">
                        <label for="edit-thesod_mega_menu_columns-<?php echo esc_attr($item_id); ?>">
    						<?php esc_html_e( 'Number of columns: ', 'thesod' ); ?><br />
    						<select name="thesod_mega_menu_columns[<?php echo esc_attr($item_id); ?>]" for="edit-thesod_mega_menu_columns-<?php echo esc_attr($item_id); ?>">
    							<?php foreach( $item->thesod_mega_menu_columns_values as $value=>$title): ?>
    								<option value="<?php echo esc_attr($value); ?>" <?php selected($value, $item->thesod_mega_menu['columns']); ?>><?php echo esc_html($title); ?></option>
    							<?php endforeach; ?>
    						</select>
                        </label>
					</p>

					<p class="field-thesod-megamenu-image description">
						<label for="edit-thesod_mega_menu_image-<?php echo esc_attr($item_id); ?>">
							<?php esc_html_e( 'Background image', 'thesod' ); ?><br />
							<input id="edit-thesod_mega_menu_image-<?php echo esc_attr($item_id); ?>" class= "thesod-edit-menu-item-image picture-select" type="text" name="thesod_mega_menu_image[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_html( $item->thesod_mega_menu['image'] ); ?>"/>
							<button class="picture-select-button"><?php esc_html_e( 'Select', 'thesod' ); ?></button>
						</label>
					</p>

                    <p class="field-thesod-megamenu-image-position description">
                        <label for="edit-thesod_mega_menu_image_position-<?php echo esc_attr($item_id); ?>">
                            <?php esc_html_e( 'Position: ', 'thesod' ); ?><br />
                            <select name="thesod_mega_menu_image_position[<?php echo esc_attr($item_id); ?>]" for="edit-thesod_mega_menu_image_position-<?php echo esc_attr($item_id); ?>">
                                <?php foreach( $item->thesod_mega_menu_image_position_values as $value=>$title): ?>
                                    <option value="<?php echo esc_attr($value); ?>" <?php selected($value, $item->thesod_mega_menu['image_position']); ?>><?php echo esc_html($title); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </label>
                    </p>

					<fieldset class="fieldset-thesod-megamenu-padding">
						<legend><?php esc_html_e( 'Padding: ', 'thesod' ); ?></legend>

						<p class="field-thesod-megamenu-padding-left description description-thin">
							<label for="edit-thesod_mega_menu_padding_left-<?php echo esc_attr($item_id); ?>">
								<?php esc_html_e( 'Left', 'thesod' ); ?><br />
								<input id="edit-thesod_mega_menu_padding_left-<?php echo esc_attr($item_id); ?>" class="thesod-edit-menu-item-padding-left" type="text" name="thesod_mega_menu_padding_left[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_html( $item->thesod_mega_menu['padding_left'] ); ?>"/>
							</label>
						</p>

						<p class="field-thesod-megamenu-padding-right description description-thin">
							<label for="edit-thesod_mega_menu_padding_right-<?php echo esc_attr($item_id); ?>">
								<?php esc_html_e( 'Right', 'thesod' ); ?><br />
								<input id="edit-thesod_mega_menu_padding_right-<?php echo esc_attr($item_id); ?>" class="thesod-edit-menu-item-padding-right" type="text" name="thesod_mega_menu_padding_right[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_html( $item->thesod_mega_menu['padding_right'] ); ?>"/>
							</label>
						</p>

						<p class="field-thesod-megamenu-padding-top description description-thin">
							<label for="edit-thesod_mega_menu_padding_top-<?php echo esc_attr($item_id); ?>">
								<?php esc_html_e( 'Top', 'thesod' ); ?><br />
								<input id="edit-thesod_mega_menu_padding_top-<?php echo esc_attr($item_id); ?>" class="thesod-edit-menu-item-padding-top" type="text" name="thesod_mega_menu_padding_top[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_html( $item->thesod_mega_menu['padding_top'] ); ?>"/>
							</label>
						</p>

						<p class="field-thesod-megamenu-padding-bottom description description-thin">
							<label for="edit-thesod_mega_menu_padding_bottom-<?php echo esc_attr($item_id); ?>">
								<?php esc_html_e( 'Bottom', 'thesod' ); ?><br />
								<input id="edit-thesod_mega_menu_padding_bottom-<?php echo esc_attr($item_id); ?>" class="thesod-edit-menu-item-padding-bottom" type="text" name="thesod_mega_menu_padding_bottom[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_html( $item->thesod_mega_menu['padding_bottom'] ); ?>"/>
							</label>
						</p>
						<br class="clear" />
					</fieldset>

					<!-- second level -->
                    <p class="field-thesod-megamenu-width description">
                        <label for="edit-thesod_mega_menu_width-<?php echo esc_attr($item_id); ?>">
                            <?php esc_html_e( 'Column width', 'thesod' ); ?><br />
                            <input id="edit-thesod_mega_menu_width-<?php echo esc_attr($item_id); ?>" class= "thesod-edit-menu-item-width" type="text" name="thesod_mega_menu_width[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_html( $item->thesod_mega_menu['width'] ); ?>"/>
                        </label>
                    </p>

                    <p class="field-thesod-megamenu-not-link">
                        <label for="edit-thesod_mega_menu_not_link-<?php echo esc_attr($item_id); ?>">
                            <input id="edit-thesod_mega_menu_not_link-<?php echo esc_attr($item_id); ?>" type="checkbox" class="thesod-edit-menu-item-not-link" name="thesod_mega_menu_not_link[<?php echo esc_attr($item_id); ?>]" <?php checked( $item->thesod_mega_menu['not_link'] ); ?>/>
                            <?php esc_html_e( 'Don\'t link', 'thesod' ); ?>
                        </label>
                    </p>

                    <p class="field-thesod-megamenu-not-show">
                        <label for="edit-thesod_mega_menu_not_show-<?php echo esc_attr($item_id); ?>">
                            <input id="edit-thesod_mega_menu_not_show-<?php echo esc_attr($item_id); ?>" type="checkbox" class="thesod-edit-menu-item-not-show" name="thesod_mega_menu_not_show[<?php echo esc_attr($item_id); ?>]" <?php checked( $item->thesod_mega_menu['not_show'] ); ?>/>
                            <?php esc_html_e( 'Don\'t show', 'thesod' ); ?>
                        </label>
                    </p>

                    <p class="field-thesod-megamenu-new-row">
                        <label for="edit-thesod_mega_menu_new_row-<?php echo esc_attr($item_id); ?>">
                            <input id="edit-thesod_mega_menu_new_row-<?php echo esc_attr($item_id); ?>" type="checkbox" class="thesod-edit-menu-item-new-root" name="thesod_mega_menu_new_row[<?php echo esc_attr($item_id); ?>]" <?php checked( $item->thesod_mega_menu['new_row'] ); ?>/>
                            <?php esc_html_e( 'This item should start a new row', 'thesod' ); ?>
                        </label>
                    </p>

					<!-- third level -->
                    <p class="field-thesod-megamenu-label description">
                        <label for="edit-thesod_mega_menu_label-<?php echo esc_attr($item_id); ?>">
                            <?php esc_html_e( 'Label', 'thesod' ); ?><br />
                            <input id="edit-thesod_mega_menu_label-<?php echo esc_attr($item_id); ?>" class= "thesod-edit-menu-item-label" type="text" name="thesod_mega_menu_label[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_html( $item->thesod_mega_menu['label'] ); ?>"/>
                        </label>
                    </p>

				</div>

				<!-- thesod Mega Menu End -->

				<p class="field-move hide-if-no-js description description-wide">
					<label>
						<span><?php esc_html_e( 'Move', 'thesod' ); ?></span>
						<a href="#" class="menus-move-up"><?php esc_html_e( 'Up one', 'thesod' ); ?></a>
						<a href="#" class="menus-move-down"><?php esc_html_e( 'Down one', 'thesod' ); ?></a>
						<a href="#" class="menus-move-left"></a>
						<a href="#" class="menus-move-right"></a>
						<a href="#" class="menus-move-top"><?php esc_html_e( 'To the top', 'thesod' ); ?></a>
					</label>
				</p>

				<div class="menu-item-actions description-wide submitbox">
					<?php if( 'custom' != $item->type && $original_title !== false ) : ?>
						<p class="link-to-original">
							<?php printf( esc_html__('Original: %s', 'thesod'), '<a href="' . esc_url(esc_attr( $item->url )) . '">' . esc_html( $original_title ) . '</a>' ); ?>
						</p>
					<?php endif; ?>
					<a class="item-delete submitdelete deletion" id="delete-<?php echo esc_attr($item_id); ?>" href="<?php
					echo esc_url(wp_nonce_url(
						add_query_arg(
							array(
								'action' => 'delete-menu-item',
								'menu-item' => $item_id,
							),
							admin_url( 'nav-menus.php' )
						),
						'delete-menu_item_' . $item_id
					)); ?>"><?php esc_html_e( 'Remove', 'thesod' ); ?></a> <span class="meta-sep hide-if-no-js"> | </span> <a class="item-cancel submitcancel hide-if-no-js" id="cancel-<?php echo esc_attr($item_id); ?>" href="<?php echo esc_url( add_query_arg( array( 'edit-menu-item' => $item_id, 'cancel' => time() ), admin_url( 'nav-menus.php' ) ) );
						?>#menu-item-settings-<?php echo esc_attr($item_id); ?>"><?php esc_html_e('Cancel', 'thesod'); ?></a>
				</div>

				<input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr($item_id); ?>" />
				<input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
				<input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
				<input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
				<input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
				<input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
			</div><!-- .menu-item-settings-->
			<ul class="menu-item-transport"></ul>
		<?php
		$output .= ob_get_clean();
	}

}
