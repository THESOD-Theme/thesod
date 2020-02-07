<?php
/**
 * Checkout coupon form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-coupon.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.4
 */

defined( 'ABSPATH' ) || exit;

if ( ! wc_coupons_enabled() ) { // @codingStandardsIgnoreLine.
	return;
}

$thesod_checkout_type = thesod_get_option('checkout_type', 'multi-step');

if ( empty( WC()->cart->applied_coupons ) ) {
	$info_message = apply_filters( 'woocommerce_checkout_coupon_message', __( 'Have a coupon?', 'woocommerce' ) . ' <a href="#" class="showcoupon">' . __( 'Click here to enter your code', 'woocommerce' ) . '</a>' );
	if ($thesod_checkout_type == 'multi-step') {
		echo '<div class="checkout-notice checkout-coupon-notice">' . $info_message . '</div>';
	}
	if ($thesod_checkout_type == 'one-page') {
		echo '<div class="checkout-notice checkout-coupon-notice">' . $info_message . '</div>';
	}
}
?>

<form class="checkout_coupon woocommerce-form-coupon" method="post" style="display:none">
	<input type="text" name="coupon_code" class="input-text coupon-code" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" id="coupon_code" value="" />
	<?php
		thesod_button(array(
			'tag' => 'button',
			'text' => esc_html__( 'Apply coupon', 'woocommerce' ),
			'style' => 'outline',
			'size' => 'small',
			'attributes' => array(
				'name' => 'apply_coupon',
				'value' => esc_attr__( 'Apply coupon', 'woocommerce' ),
				'type' => 'submit',
			)
		), true);
	?>
</form>
