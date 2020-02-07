<?php
/**
 * The template for displaying product widget entries.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-widget-product.php.
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.5
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

if ( ! is_a( $product, 'WC_Product' ) ) {
	return;
}

?>
<li<?php if ( thesod_get_option('catalog_view') ) { echo ' class="catalog-view"'; } ?>>
	<?php do_action( 'woocommerce_widget_product_item_start', $args ); ?>
	<?php woocommerce_show_product_loop_sale_flash(); ?>
	<div class="sod-products-image">
		<a href="<?php echo esc_url( $product->get_permalink() ); ?>">
		<?php echo $product->get_image(); // PHPCS:Ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</a>
	</div>
	<div class="sod-products-content">
		<div class="sod-products-title">
			<a href="<?php echo esc_url( $product->get_permalink() ); ?>" title="<?php echo esc_attr( $product->get_name() ); ?>">
				<?php echo wp_kses_post( $product->get_name() );  ?>
			</a>
		</div>
		<?php if ( ! empty( $show_rating ) ) : ?>
			<div class="sod-products-rating"><?php echo wc_get_rating_html( $product->get_average_rating() ); // PHPCS:Ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
		<?php endif; ?>
		<?php if ( !thesod_get_option('catalog_view') ) : ?>
			<div class="sod-products-price styled-subtitle"><?php echo $product->get_price_html(); ?></div>
		<?php endif; ?>
	</div>
	<?php do_action( 'woocommerce_widget_product_item_end', $args ); ?>
</li>
