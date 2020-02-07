<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;
wp_enqueue_script('thesod-woocommerce');

wc_print_notices();
?>

<div class="woocommerce-before-cart clearfix"><?php do_action( 'woocommerce_before_cart' ); ?></div>

<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
<?php do_action( 'woocommerce_before_cart_table' ); ?>

<div class="sod-table"><table class="shop_table cart woocommerce-cart-form__contents" cellspacing="0">
	<thead>
		<tr>
			<th class="product-remove">&nbsp;</th>
			<th class="product-name" colspan="2"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
			<th class="product-price"><?php esc_html_e( 'Price', 'woocommerce' ); ?></th>
			<th class="product-quantity"><?php esc_html_e( 'Quantity', 'woocommerce' ); ?></th>
			<th class="product-subtotal"><?php esc_html_e( 'Total', 'woocommerce' ); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php do_action( 'woocommerce_before_cart_contents' ); ?>

		<?php
		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
				?>
					<tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

					<td class="product-remove">
						<?php
							echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								'woocommerce_cart_item_remove_link',
								sprintf(
									'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&#xe619;</a>',
									esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
									esc_html__( 'Remove this item', 'woocommerce' ),
									esc_attr( $product_id ),
									esc_attr( $_product->get_sku() )
								),
								$cart_item_key
							);
						?>
					</td>

					<td class="product-thumbnail">
						<?php
							$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

								if ( ! $product_permalink ) {
							echo $thumbnail; // PHPCS: XSS ok.
							} else {
							printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
							}
						?>
					</td>

					<td class="product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
						<div class="product-title"><?php
							if ( ! $product_permalink ) {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
							} else {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
							}

							do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );
						?></div>
						<div class="product-meta"><?php

						// Meta data.
						echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

						// Backorder notification.
							if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
							}
						?></div>
					</td>

						<td class="product-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
						<?php
							echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
						?>
					</td>

						<td class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
						<?php
							if ( $_product->is_sold_individually() ) {
								$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
							} else {
								$product_quantity = woocommerce_quantity_input( array(
									'input_name'  => "cart[{$cart_item_key}][qty]",
									'input_value' => $cart_item['quantity'],
									'max_value'   => $_product->get_max_purchase_quantity(),
									'min_value'   => '0',
									'product_name'  => $_product->get_name(),
								), $_product, false );
							}

							echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
						?>
					</td>

						<td class="product-subtotal" data-title="<?php esc_attr_e( 'Total', 'woocommerce' ); ?>">
						<?php
							echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
						?>
					</td>
				</tr>
				<?php
			}
		}
		?>

		<?php do_action( 'woocommerce_cart_contents' ); ?>

		<tr>
			<td colspan="6" class="actions">

					<?php if ( wc_coupons_enabled() ) { ?>
					<div class="coupon">
						<input type="text" name="coupon_code" class="input-text coupon-code" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" />
						<?php
							thesod_button(array(
								'tag' => 'button',
								'text' => esc_html__( 'Apply coupon', 'woocommerce' ),
								'style' => 'outline',
								'size' => 'medium',
								'attributes' => array(
									'name' => 'apply_coupon',
									'value' => esc_attr__( 'Apply coupon', 'woocommerce' ),
									'type' => 'submit',
								)
							), true);
						?>

						<?php do_action('woocommerce_cart_coupon'); ?>
					</div>
				<?php } ?>

				<div class="submit-buttons">
					<?php
						thesod_button(array(
							'tag' => 'button',
							'text' => esc_html__( 'Update cart', 'woocommerce' ),
							'size' => 'medium',
							'extra_class' => 'update-cart',
							'attributes' => array(
								'name' => 'update_cart',
								'value' => esc_attr__( 'Update cart', 'woocommerce' ),
								'type' => 'submit',
							)
						), true);
					?>
					<?php
						thesod_button(array(
							'tag' => 'a',
							'href' => esc_url( wc_get_checkout_url() ),
							'text' => esc_html__( 'Checkout', 'woocommerce' ),
							'size' => 'medium',
							'extra_class' => 'checkout-button-button',
							'attributes' => array(
								'class' => 'checkout-button button alt wc-forward'
							)
						), true);
					?>

					<?php do_action( 'woocommerce_cart_actions' ); ?>
				</div>

				<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
			</td>
		</tr>

		<?php do_action( 'woocommerce_after_cart_contents' ); ?>
	</tbody>
</table></div>

<?php do_action( 'woocommerce_after_cart_table' ); ?>
</form>

<form class="woocommerce-cart-form responsive" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">

<?php do_action( 'woocommerce_before_cart_table' ); ?>

<?php
foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
	$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
	$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

	if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
		?>

		<div class="cart-item cart_item rounded-corners shadow-box">
			<table class="shop_table cart"><tbody><tr>
				<td class="product-thumbnail">
					<?php
						$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

						if ( ! $product_permalink )
							echo $thumbnail;
						else
							printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail );
					?>
				</td>

				<td class="product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
					<div class="product-title"><?php
						if ( ! $product_permalink ) {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
							} else {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
						}

						do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );
						?></div>
					<div class="product-meta"><?php
						// Meta data
						echo wc_get_formatted_cart_item_data( $cart_item );

						// Backorder notification.
							if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
							}
					?></div>
				</td>

				<td class="product-remove">
					<?php
							echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								'woocommerce_cart_item_remove_link',
								sprintf(
									'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&#xe619;</a>',
									esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
									esc_html__( 'Remove this item', 'woocommerce' ),
									esc_attr( $product_id ),
									esc_attr( $_product->get_sku() )
								),
								$cart_item_key
							);
					?>
				</td>
			</tr></tbody></table>
			<div class="sod-table"><table class="shop_table cart">
				<thead>
					<tr>
						<th class="product-price"><?php esc_html_e( 'Price', 'woocommerce' ); ?></th>
						<th class="product-quantity"><?php esc_html_e( 'Quantity', 'woocommerce' ); ?></th>
						<th class="product-subtotal"><?php esc_html_e( 'Total', 'woocommerce' ); ?></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="product-price">
							<?php
								echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
							?>
						</td>

						<td class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
							<?php
								if ( $_product->is_sold_individually() ) {
									$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
								} else {
									$product_quantity = woocommerce_quantity_input( array(
										'input_name'  => "cart[{$cart_item_key}][qty]",
										'input_value' => $cart_item['quantity'],
										'max_value'   => $_product->get_max_purchase_quantity(),
										'min_value'   => '0',
										'product_name'  => $_product->get_name(),
									), $_product, false );
								}

							echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
							?>
						</td>

						<td class="product-subtotal" data-title="<?php esc_attr_e( 'Total', 'woocommerce' ); ?>">
							<?php
								echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
							?>
						</td>
					</tr>
				</tbody>
			</table></div>
		</div>
		<?php
	}
}

?>

<div class="actions">
	<?php if ( wc_coupons_enabled() ) { ?>
		<div class="coupon shadow-box rounded-corners centered-box">

			<input type="text" name="coupon_code" class="input-text coupon-code" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'thegem' ); ?>" />
			<?php
				thesod_button(array(
					'tag' => 'button',
					'text' => esc_html__( 'Apply coupon', 'woocommerce' ),
					'style' => 'outline',
					'size' => 'medium',
					'attributes' => array(
						'name' => 'apply_coupon',
						'value' => esc_attr__( 'Apply', 'woocommerce' ),
						'type' => 'submit',
					)
				), true);
			?>

			<?php do_action('woocommerce_cart_coupon'); ?>

		</div>

	<?php } ?>

	<div class="submit-buttons centered-box">
		<?php
			thesod_button(array(
				'tag' => 'button',
				'text' => esc_html__( 'Update cart', 'woocommerce' ),
				'size' => 'medium',
				'extra_class' => 'update-cart',
				'attributes' => array(
					'name' => 'update_cart',
					'value' => esc_attr__( 'Update cart', 'woocommerce' ),
					'type' => 'submit',
				)
			), true);
		?>
		<?php
			thesod_button(array(
				'tag' => 'a',
				'href' => esc_url( wc_get_checkout_url() ),
				'text' => esc_html__( 'Checkout', 'woocommerce' ),
				'size' => 'medium',
				'extra_class' => 'checkout-button-button',
				'attributes' => array(
					'class' => 'checkout-button button alt wc-forward'
				)
			), true);
		?>

		<?php do_action( 'woocommerce_cart_actions' ); ?>
	</div>
	<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>

</div>

<?php do_action( 'woocommerce_after_cart_table' ); ?>

</form>

<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

<div class="cart-collaterals">

	<div class="row">
		<div class="col-md-6 col-sm-12">
			<?php woocommerce_shipping_calculator(); ?>
		</div>
		<div class="col-md-6 col-sm-12">
			<?php woocommerce_cart_totals(); ?>
		</div>
	</div>

</div>

<?php woocommerce_cross_sell_display(6, 6); ?>

<?php do_action( 'woocommerce_after_cart' ); ?>
