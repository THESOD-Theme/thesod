<?php

get_header(); ?>

<div id="main-content" class="main-content">
	<div id="page-title" class="page-title-block custom-page-title custom-page-title-editable">
		<div class="container custom-page-title-content">
			<?php
				while ( have_posts() ) : the_post();
					the_content();
				endwhile;
			?>
		</div>
	</div>
	<div class="block-content">
		<div class="container">
			<div class="panel row">
				<div class="col-xs-12">
				</div>
			</div>
		</div><!-- .container -->
	</div><!-- .block-content -->
</div><!-- #main-content -->

<?php
get_footer();