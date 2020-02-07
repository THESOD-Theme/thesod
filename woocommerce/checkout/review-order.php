<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$thesod_checkout_type = thesod_get_option('checkout_type', 'multi-step');
?>
	<table class="shop_table woocommerce-checkout-review-order-table">
		<thead class="no-responsive">
			<tr>
				<th class="product-name" <?php if ($thesod_checkout_type == 'multi-step'): ?>colspan="2"<?php endif; ?>><?php _e( 'Product', 'woocommerce' ); ?></th>
				<?php if ($thesod_checkout_type == 'multi-step'): ?>
					<th class="product-quantity"><?php _e( 'Quantity', 'woocommerce' ); ?></th>
				<?php endif; ?>
				<th class="product-total"><?php _e( 'Total', 'woocommerce' ); ?></th>
			</tr>
		</thead>
		<tbody class="no-responsive">
			<?php
				do_action( 'woocommerce_review_order_before_cart_contents' );

				foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
					$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

					if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
						?>
						<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
							<?php if ($thesod_checkout_type == 'multi-step'): ?>
								<td class="product-thumbnail">
									<?php
										$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

										if ( ! $_product->is_visible() ) {
											echo $thumbnail;
										} else {
											printf( '<a href="%s">%s</a>', esc_url( $_product->get_permalink( $cart_item ) ), $thumbnail );
										}
									?>
								</td>
							<?php endif; ?>
							<td class="product-name">
								<div class="product-title">
												<?php echo apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ); ?>
												<span>x <?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity',$cart_item['quantity'], $cart_item, $cart_item_key ); ?></span>
											</div>
											<div class="product-meta">
												<?php echo wc_get_formatted_cart_item_data( $cart_item ); ?>
											</div>
							</td>
							<?php if ($thesod_checkout_type == 'multi-step'): ?>
								<td class="product-quantity checkout-product-quantity">
									<?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', ' <div class="center">' . $cart_item['quantity'] . '</div>', $cart_item, $cart_item_key ); ?>
								</td>
							<?php endif; ?>
							<td class="product-total">
								<?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?>
							</td>
						</tr>
						<?php
					}
				}

				do_action( 'woocommerce_review_order_after_cart_contents' );
			?>
		</tbody>

		<tbody class="responsive">
			<tr><td colspan="<?php if ($thesod_checkout_type == 'multi-step'): ?>4<?php endif; ?><?php if ($thesod_checkout_type == 'one-page'): ?>2<?php endif; ?>">
				<table>
					<thead>
						<tr>
							<th class="product-name"><?php _e( 'Product', 'woocommerce' ); ?></th>
							<th class="product-total"><?php _e( 'Total', 'woocommerce' ); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php
							do_action( 'woocommerce_review_order_before_cart_contents' );

							foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
								$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

								if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
									?>
									<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
										<td class="product-name">
											<div class="product-title">
												<?php echo apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ); ?>
												<span>x <?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity',$cart_item['quantity'], $cart_item, $cart_item_key ); ?></span>
											</div>
											<div class="product-meta">
												<?php echo wc_get_formatted_cart_item_data( $cart_item ); ?>
											</div>
										</td>
										<td class="product-total">
											<?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?>
										</td>
									</tr>
									<?php
								}
							}

							do_action( 'woocommerce_review_order_after_cart_contents' );
						?>
					</tbody>
				</table>
			</td>



		<tfoot>
			<tr>
				<td class="shop-table-footer-total" colspan="<?php if ($thesod_checkout_type == 'multi-step'): ?>4<?php endif; ?><?php if ($thesod_checkout_type == 'one-page'): ?>2<?php endif; ?>">
					<table class="shop_table woocommerce-checkout-payment-total">
						<tr class="cart-subtotal">
							<th><?php _e( 'Subtotal', 'woocommerce' ); ?></th>
							<td><?php wc_cart_totals_subtotal_html(); ?></td>
						</tr>

						<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
							<tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
								<th><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
								<td><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
							</tr>
						<?php endforeach; ?>

						<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

							<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

							<?php wc_cart_totals_shipping_html(); ?>

							<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

						<?php endif; ?>

						<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
							<tr class="fee">
								<th><?php echo esc_html( $fee->name ); ?></th>
								<td><?php wc_cart_totals_fee_html( $fee ); ?></td>
							</tr>
						<?php endforeach; ?>

		<?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
			<?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
								<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
									<tr class="tax-rate tax-rate-<?php echo sanitize_title( $code ); ?>">
										<th><?php echo esc_html( $tax->label ); ?></th>
										<td><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
									</tr>
								<?php endforeach; ?>
							<?php else : ?>
								<tr class="tax-total">
									<th><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></th>
									<td><?php wc_cart_totals_taxes_total_html(); ?></td>
								</tr>
							<?php endif; ?>
						<?php endif; ?>

						<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

						<tr class="order-total">
							<th><?php _e( 'Total', 'woocommerce' ); ?></th>
							<td><?php wc_cart_totals_order_total_html(); ?></td>
						</tr>

						<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>
					</table>
				</td>
			</tr>
		</tfoot>
	</table>
