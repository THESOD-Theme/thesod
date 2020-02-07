<?php
/**
 * Template Name: Woocommerce Shop Page
 *
 * @package thesod
 */

$thesod_page_data = get_post_meta(get_the_ID(), 'thesod_page_data', TRUE);
$thesod_slideshow_params = array_merge(array('slideshow_type' => '', 'slideshow_slideshow' => '', 'slideshow_layerslider' => '', 'slideshow_revslider' => ''), $thesod_page_data);

get_header(); ?>

<div id="main-content" class="main-content">

<?php
	if($thesod_slideshow_params['slideshow_type']) {
		thesod_slideshow_block(array('slideshow_type' => $thesod_slideshow_params['slideshow_type'], 'slideshow' => $thesod_slideshow_params['slideshow_slideshow'], 'lslider' => $thesod_slideshow_params['slideshow_layerslider'], 'slider' => $thesod_slideshow_params['slideshow_revslider']));
	}
?>
<?php echo thesod_page_title(); ?>

<?php woocommerce_content(); ?>

<?php
	while ( have_posts() ) : the_post();
		get_template_part( 'content', 'shop' );
	endwhile;
?>

</div><!-- #main-content -->

<?php
get_footer();
