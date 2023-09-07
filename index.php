<?php
/**
 * The main template file.
 */

get_header(); ?>

<div class="container heading">
	<?php kind_section_title(); ?>
	<?php kind_archive_description(); ?>
</div>

<?php if ( have_posts() ) { ?>
	<div class="main-content cards-holder listing-bg archive-post-list kind-overflow-visible">
		<div class="container">
			<div class="flex-row start cards-loop">
			<?php
				while ( have_posts() ) {
					the_post();
					get_template_part( 'template-parts/content', 'archive' );
				}
			?>
			</div>
		</div>

		<?php kind_posts_pagination(); ?>

		<?php do_action( 'kind_after_archive_content' ); ?>

	</div>

<?php } else { ?>
	<div class="main-content listing-bg">
		<div class="container">
			<div class="empty-message"><?php esc_html_e( 'Unfortunately, nothing found', 'kind' );?></div>
			<?php get_search_form(); ?>
		</div>
	</div>
<?php }

kind_bottom_blocks();

get_footer();
