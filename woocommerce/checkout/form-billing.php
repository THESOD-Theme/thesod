<?php
/**
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version 3.6.0
 * @global WC_Checkout $checkout
 */

defined( 'ABSPATH' ) || exit;

$thesod_checkout_type = thesod_get_option('checkout_type', 'multi-step');


?>
<div class="woocommerce-billing-fields clearfix">
	<?php if ( wc_ship_to_billing_address_only() && WC()->cart->needs_shipping() ) : ?>

		<h2><span class="light"><?php esc_html_e( 'Billing &amp; Shipping', 'woocommerce' ); ?></span></h2>

	<?php else : ?>

		<h2><span class="light"><?php esc_html_e( 'Billing details', 'woocommerce' ); ?></span></h2>

	<?php endif; ?>

	<?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>

    <div class="woocommerce-billing-fields__field-wrapper">
		<?php
		$fields = $checkout->get_checkout_fields( 'billing' );

		foreach ( $fields as $key => $field ) {
			woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
		}
		?>
    </div>



	<?php if ( $thesod_checkout_type == 'one-page' && ! is_user_logged_in() && $checkout->is_registration_enabled() ) : ?>
		<div class="woocommerce-account-fields">
			<?php if ( ! $checkout->is_registration_required() ) : ?>

				<p class="form-row form-row-wide create-account-checkbox">
					<input class="input-checkbox sod-checkbox" id="createaccount" <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true) ?> type="checkbox" name="createaccount" value="1" />
					<label for="createaccount" class="checkbox"><?php _e( 'Create an account?', 'woocommerce' ); ?></label>
				</p>

			<?php endif; ?>

			<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

			<?php if ( $checkout->get_checkout_fields( 'account' ) ) : ?>

				<div class="create-account">
					<p class="form-row create-account-notice">
						<?php _e( 'Create an account by entering the information below. If you are a returning customer please login at the top of the page.', 'thegem' ); ?>
					</p>

					<?php foreach ( $checkout->get_checkout_fields( 'account' )  as $key => $field ) : ?>
						<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
					<?php endforeach; ?>
					<div class="clear"></div>
				</div>

			<?php endif; ?>

			<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>
		</div>
	<?php endif; ?>

	<?php do_action('woocommerce_after_checkout_billing_form', $checkout ); ?>
</div>

<?php if ( $thesod_checkout_type == 'multi-step' && ! is_user_logged_in() && $checkout->is_registration_enabled() ) : ?>
	<div class="create-account-popup">
		<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

		<h2><span class="light"><?php _e( 'Register', 'thegem' ); ?></span></h2>

		<div class="create-account-inner clearfix">
			<p class="create-account-notice">
				<?php _e( 'Create an account by entering the information below. If you are a returning customer please login at the top of the page.', 'thegem' ); ?>
			</p>
			<?php if( $checkout->get_checkout_fields( 'account' ) ) : ?>
				<?php foreach ( $checkout->get_checkout_fields( 'account' )  as $key => $field ) : ?>
					<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
				<?php endforeach; ?>
			<?php endif; ?>
			<div class="clear"></div>
			<div class="create-account-popup-bottom clearfix">
				<?php if ( ! $checkout->is_registration_required() ) : ?>
					<p class="form-row form-row-wide create-account-checkbox">
						<input class="input-checkbox sod-checkbox" id="createaccount" <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true) ?> type="checkbox" name="createaccount" value="1" /> <label for="createaccount" class="checkbox"><?php esc_html_e( 'Create an account?', 'woocommerce' ); ?></label>
					</p>
				<?php endif; ?>

				<?php
					thesod_button(array(
						'tag' => 'button',
						'text' => esc_html__( 'Register', 'thegem' ),
						'style' => 'outline',
						'size' => 'medium',
						'extra_class' => 'checkout-create-account-button',
						'attributes' => array(
							'type' => 'button',
						)
					), true);
				?>
			</div>
		</div>

		<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>
	</div>
<?php endif; ?>
