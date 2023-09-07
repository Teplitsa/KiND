<?php
/**
 * The template for displaying all single posts.
 */

$cpost = get_queried_object();

get_header();
?>

<div class="main-content single-post-section">

	<div class="container">

		<div class="flex-row entry-header-single centered">

			<div class="flex-cell flex-md-10">
				<?php do_action( 'kind_entry_header' ); ?>
				<div class="entry-meta"><?php echo kind_posted_on( $cpost ); ?></div>
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				<?php if ( get_theme_mod( 'post_social_shares', true ) && function_exists( 'kind_social_share_no_js' ) ) { ?>
					<div class="mobile-sharing hide-on-medium"><?php echo kind_social_share_no_js(); ?></div>
				<?php } ?>
			</div>

		</div>

		<?php if ( has_post_thumbnail() ) { ?>
			<div class="flex-row entry-preview-single centered">
				<div class="flex-cell flex-md-10">
					<?php kind_single_post_thumbnail( $cpost->ID, 'full', 'standard' ); ?>
				</div>
			</div>
		<?php } ?>

		<div class="flex-row entry-content-single">

			<div class="flex-cell flex-md-1 hide-upto-medium"></div>

			<div class="flex-cell flex-md-1 single-sharing-col hide-upto-medium">
				<?php if ( function_exists( 'kind_social_share_no_js' ) ) { ?>
					<?php if ( get_post_type() === 'project' ) { ?>
						<?php if ( get_theme_mod( 'project_social_shares', true ) ) { ?>
							<div id="kind_sharing" class="regular-sharing">
								<?php echo kind_social_share_no_js();?>
							</div>
						<?php } ?>
					<?php } else { ?>
						<?php if ( get_theme_mod( 'post_social_shares', true ) ) { ?>
							<div id="kind_sharing" class="regular-sharing">
								<?php echo kind_social_share_no_js();?>
							</div>
						<?php } ?>
					<?php } ?>
				<?php } ?>
			</div>

			<main class="flex-cell flex-md-8">

				<?php if ( has_excerpt() ) { ?>
					<div class="entry-lead">
						<?php echo wpautop( $post->post_excerpt ); ?>
					</div>
				<?php } ?>

				<div class="entry-content the-content">
					<?php
					while ( have_posts() ) :
						the_post();
						the_content();
					endwhile;
					?>
				</div>

				<?php kind_entry_tags(); ?>

				<?php kind_entry_related(); ?>

				<?php
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
				?>
			</main>

			<div class="flex-cell flex-md-2 hide-upto-medium"></div>

		</div>

	</div><!-- .container -->
</div><!-- .main-content -->

<?php kind_bottom_blocks(); ?>

<?php
get_footer();
