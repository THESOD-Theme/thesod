<?php
/**
 * The template for displaying the footer
 */

?>

		</div><!-- #main -->
		<div id="lazy-loading-point"></div>

		<footer class="custom-footer">
			<div class="container">
				<?php
					while ( have_posts() ) : the_post();
						the_content();
					endwhile;
				?>
			</div>
		</footer>

	</div><!-- #page -->

	<?php if(thesod_get_option('header_layout') == 'perspective') : ?>
		</div><!-- #perspective -->
	<?php endif; ?>

	<?php wp_footer(); ?>
</body>
</html>
