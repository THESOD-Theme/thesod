<?php
/**
 * External product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/external.php.
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

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="cart" action="<?php echo esc_url( $product_url ); ?>" method="get">
	<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
		<?php thesod_button(array(
			'tag' => 'button',
			'text' => esc_html( $button_text ),
			'icon' => 'cart',
			'background_color' => thesod_get_option('styled_elements_color_1'),
			'hover_background_color' => thesod_get_option('button_background_hover_color'),
			'attributes' => array(
				'type' => 'submit',
				'class' => 'single_add_to_cart_button button alt',
			),
		), 1); ?>
	<?php do_action('thesod_woocommerce_after_add_to_cart_button'); ?>
	<?php wc_query_string_form_fields( $product_url ); ?>

	<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
</form>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
