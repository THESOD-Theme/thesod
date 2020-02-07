<header class="page-header">
	<h1 class="page-title"><?php echo wp_kses(__( '<span class="light">Nothing</span> Found', 'thesod' ), array('span' => array('class' => array()))); ?></h1>
</header>

<div class="page-content content-none">
	<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

	<p><?php printf( wp_kses(__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'thesod' ), array('a' => array('href' => array()))), esc_url(admin_url( 'post-new.php' )) ); ?></p>

	<?php elseif ( is_search() ) : ?>
		<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'thesod' ); ?></p>
	<?php else : ?>
		<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'thesod' ); ?></p>
	<?php endif; ?>
	<?php add_filter( 'get_search_form', 'thesod_serch_form_nothing_found' ); get_search_form(); remove_filter( 'get_search_form', 'thesod_serch_form_nothing_found' ); ?>

</div><!-- .page-content -->
