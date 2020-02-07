<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

$sidebar_data = thesod_get_sanitize_page_sidebar_data(get_the_ID());
$sidebar_position = thesod_check_array_value(array('', 'left', 'right'), $sidebar_data['sidebar_position'], '');
$left_classes = 'col-sm-6 col-xs-12';
$right_classes = 'col-sm-6 col-xs-12';
if(is_active_sidebar('shop-sidebar') && $sidebar_position) {
	$left_classes = 'col-sm-5 col-xs-12';
	$right_classes = 'col-sm-7 col-xs-12';
}

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class('', $product); ?>>

    <div class="single-product-content row<?php if ( thesod_get_option('catalog_view') ) { echo ' catalog-view'; } ?>">
        <div class="single-product-content-left <?php echo $left_classes; ?>">
			<?php do_action('thesod_woocommerce_single_product_left'); ?>
        </div>

        <div class="single-product-content-right <?php echo $right_classes; ?>">
			<?php do_action('thesod_woocommerce_single_product_right'); ?>
        </div>

    </div>

    <div class="single-product-content-bottom">
		<?php do_action('thesod_woocommerce_single_product_bottom'); ?>
    </div>

</div><!-- #product-<?php the_ID(); ?> -->
