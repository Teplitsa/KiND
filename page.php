<?php
/**
 * The template for displaying all pages.
 *
 * @package KiND
 */

get_header();

if ( kind_is_page_title() ) { ?>
<div class="page-header">
	<div class="container">
		<div class="text-column">

			<?php if ( wp_get_post_parent_id( $post ) ) { ?>
				<div class="page-crumb">
					<a href="<?php the_permalink( wp_get_post_parent_id( $post ) ); ?>">
						<?php echo esc_html( get_the_title( wp_get_post_parent_id( $post ) ) ); ?>
					</a>
				</div>
			<?php } ?>

			<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>

			<?php if ( has_excerpt() ) { ?>
				<div class="page-intro">
					<?php the_excerpt(); ?>
				</div>
			<?php } ?>

		</div>
	</div>
</div>
<?php } ?>

<div class="page-content container">

	<?php if ( has_post_thumbnail() && kind_is_page_title() ) { ?>
		<div class="flex-row entry-preview-single centered">
			<div class="flex-cell flex-md-10">
				<?php kind_single_post_thumbnail( get_the_ID(), 'full', 'standard' ); ?>
			</div>
		</div>
	<?php } ?>

	<div class="entry-content the-content text-column">
		<?php
		while ( have_posts() ) :
			the_post();
			the_content();

			wp_link_pages(
				array(
					'before'   => '<nav class="page-links" aria-label="' . esc_attr__( 'Page', 'kind' ) . '">',
					'after'    => '</nav>',
					/* translators: %: Page number. */
					'pagelink' => esc_html__( 'Page %', 'kind' ),
				)
			);
		endwhile;
		?>
	</div>

</div>

<?php
get_footer();
