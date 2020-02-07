<?php
/**
 * Pagination - Show numbered pagination for catalog pages
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/pagination.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version 3.3.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $wp_query;

$total   = isset( $total ) ? $total : wc_get_loop_prop( 'total_pages' );
$current = isset( $current ) ? $current : wc_get_loop_prop( 'current_page' );
$base    = isset( $base ) ? $base : esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) );
$format  = isset( $format ) ? $format : '';

if ( $total <= 1 ) {
	return;
}

$pagination_type = thesod_get_option('products_pagination', 'normal');

if (in_array($pagination_type, array('more', 'scroll'))) {
	$pagination_uid = substr( md5(rand()), 0, 7);
	wp_localize_script('thesod-woocommerce', 'thesod_woo_pagination_data_' . $pagination_uid, array(
		'base' => $base,
		'current'      => max( 1, $current ),
		'total'        => $total
	));
}

?>

<?php if ($pagination_type == 'normal'): ?>
	<div class="sod-pagination woocommerce-pagination centered-box">
		<?php
		echo paginate_links( apply_filters( 'woocommerce_pagination_args', array( // WPCS: XSS ok.
				'base'         => $base,
				'format'       => $format,
				'add_args'     => false,
				'current'      => max( 1, $current ),
				'total'        => $total,
				'prev_text'    => '&larr;',
				'next_text'    => '&rarr;',
				'type'         => 'plain',
				'end_size'     => 3,
				'mid_size'     => 3,
			) ) );
		?>
	</div>
<?php endif; ?>

<?php if ($pagination_type == 'more'): ?>
	<div class="sod-product-load-more" data-pagination-base="<?php echo esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ); ?>" data-pagination-total="<?php echo $wp_query->max_num_pages; ?>" data-pagination-current="<?php echo max( 1, get_query_var( 'paged' ) ); ?>">
		<div class="inner">
			<?php thesod_button(array_merge(array('text' => __('Load More', 'thegem'), 'size' => 'medium', 'corner' => 25, 'separator' => 'load-more'), array('tag' => 'button')), 1); ?>
		</div>
	</div>
<?php endif; ?>

<?php if ($pagination_type == 'scroll'): ?>
	<div class="sod-product-scroll-pagination" data-pagination-base="<?php echo esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ); ?>" data-pagination-total="<?php echo $wp_query->max_num_pages; ?>" data-pagination-current="<?php echo max( 1, get_query_var( 'paged' ) ); ?>">
	</div>
<?php endif; ?>
