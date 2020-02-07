<?php
/**
 * Checkout login form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

if ( is_user_logged_in() || 'no' === get_option( 'woocommerce_enable_checkout_login_reminder' ) ) {
	return;
}

$thesod_checkout_type = thesod_get_option('checkout_type', 'multi-step');

if ($thesod_checkout_type == 'one-page') {
	echo '<div id="checkout-login-popup" class="woocommerce" style="display: none;"><div class="checkout-login">';
}
?>

<h2><span class="light"><?php echo apply_filters( 'woocommerce_checkout_login_message', esc_html__( 'Existing customer', 'thegem' ) ); ?></span></h2>

<?php
	woocommerce_login_form(
		array(
			'message'  => '',
			'redirect' => wc_get_page_permalink( 'checkout' ),
			'hidden'   => false
		)
	);

	if ($thesod_checkout_type == 'one-page') {
		echo '</div></div>';
	}

	if ($thesod_checkout_type == 'one-page') {
		$info_message = apply_filters( 'woocommerce_checkout_login_message', __( 'Returning customer?', 'woocommerce' ) . ' <a href="#" class="checkout-show-login-popup">' . __( 'Click here to login', 'woocommerce' ) . '</a>' );
		echo '<div class="checkout-notice checkout-login-notice">' . $info_message . '</div>';
	}

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
