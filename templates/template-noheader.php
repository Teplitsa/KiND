<?php
/**
 * Template Name: Template no header
 * Template Post Type: page
 */
get_header(); ?>

<div class="page-content container">
	<div class="entry-content the-content text-column">
		<?php
		while ( have_posts() ) :
			the_post();
			the_content();
		endwhile;
		?>
	</div>
</div>

<?php
get_footer();
