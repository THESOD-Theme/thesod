<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 */

$thesod_use_custom = get_post(thesod_get_option('404_page'));

$thesod_q = new WP_Query(array('page_id' => thesod_get_option('404_page')));

get_header(); ?>

<div id="main-content" class="main-content">

<?php if(thesod_get_option('404_page') && $thesod_use_custom && $thesod_q->have_posts()) : $thesod_q->the_post(); ?>

<?php
	get_template_part( 'content', 'page' );
?>

<?php else : ?>
<?php echo thesod_page_title(); ?>

<div class="block-content">
	<div class="container">
		<div class="entry-content page-content content-none">
			<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'thesod' ); ?></p>
			<?php add_filter( 'get_search_form', 'thesod_serch_form_nothing_found' ); get_search_form(); remove_filter( 'get_search_form', 'thesod_serch_form_nothing_found' ); ?>
		</div><!-- .entry-content -->
	</div>
</div>
<?php endif; ?>

</div><!-- #main-content -->

<?php
get_footer();