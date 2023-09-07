<?php
/**
 * The template for displaying the footer.
 */

?>

</main>

<footer class="kind-footer">

	<?php if ( get_theme_mod( 'footer_social', true ) || get_theme_mod( 'footer_logo', true ) ) { ?>
		<div class="bottom-bar">
			<div class="kind-container">
				<div class="flex-row align-bottom">
					<div class="flex-cell flex-md-6">
						<?php kind_footer_logo(); ?>
					</div>

					<div class="flex-cell flex-md-6 links-right">
						<?php
						if ( get_theme_mod( 'footer_social', true ) ) {
							kind_social_links();
						}
						?>
					</div>

				</div>
			</div>
		</div>
	<?php } ?>

	<div class="kind-container">

		<?php if ( get_theme_mod( 'footer_about' ) || get_theme_mod( 'footer_policy' ) || has_nav_menu( 'footer' ) || has_nav_menu( 'footer_secondary' ) ) { ?>
			<div class="widget-area">

				<?php if ( get_theme_mod( 'footer_about' ) ) { ?>
					<div class="widget-bottom widget-bottom-about">
						<?php if ( get_theme_mod( 'footer_about_title' ) ) { ?>
							<h2 class="widget-title"><?php echo esc_html( get_theme_mod( 'footer_about_title', __( 'About Us', 'kind' ) ) ); ?></h2>
						<?php } ?>
						<div class="textwidget">
							<?php echo do_shortcode( wpautop( get_theme_mod( 'footer_about' ) ) ); ?>
						</div>
					</div>
				<?php } ?>

				<?php
				if ( has_nav_menu( 'footer' ) ) {
					$before = '<h2 class="widget-title">' . wp_get_nav_menu_name( 'footer' ) . '</h2>';
					wp_nav_menu(
						array(
							'theme_location'       => 'footer',
							'container'            => 'div',
							'container_class'      => 'widget-bottom widget-bottom-menu',
							'container_aria_label' => esc_attr__( 'Footer menu', 'kind' ),
							'depth'                => 1,
							'items_wrap'           => $before . '<ul class="%2$s">%3$s</ul>',
						)
					);
				}
				?>

				<?php
				if ( has_nav_menu( 'footer_secondary' ) ) {
					$before = '<h2 class="widget-title">' . wp_get_nav_menu_name( 'footer_secondary' ) . '</h2>';
					wp_nav_menu(
						array(
							'theme_location'       => 'footer_secondary',
							'container'            => 'div',
							'container_class'      => 'widget-bottom widget-bottom-menu',
							'container_aria_label' => esc_attr__( 'Footer menu', 'kind' ),
							'depth'                => 1,
							'items_wrap'           => $before . '<ul class="%2$s">%3$s</ul>',
						)
					);
				}
				?>

				<?php if ( get_theme_mod( 'footer_policy' ) ) { ?>
					<div class="widget-bottom widget-bottom-policy">
						<?php if ( get_theme_mod( 'footer_policy_title' ) ) { ?>
							<h2 class="widget-title"><?php echo esc_html( get_theme_mod( 'footer_policy_title', __( 'Security policy', 'kind' ) ) ); ?></h2>
						<?php } ?>
						<div class="textwidget">
							<?php echo do_shortcode( wpautop( get_theme_mod( 'footer_policy' ) ) ); ?>
						</div>
					</div>
				<?php } ?>

			</div>
		<?php } ?>

		<?php if ( get_theme_mod( 'footer_copyright', true ) || get_theme_mod( 'footer_creator', true ) ) { ?>
			<div class="hr"></div>

			<div class="flex-row footer-credits align-center">

				<div class="flex-cell flex-sm-8 flex-md-6">
					<?php if ( get_theme_mod( 'footer_copyright', true ) ) { ?>
						<div class="copy">
							<?php echo do_shortcode( wp_kses_post( get_theme_mod( 'footer_copyright_text', kind_footer_copyright() ) ) ); ?>
						</div>
					<?php } ?>
				</div>

				<?php if ( get_theme_mod( 'footer_creator', true ) ) { ?>
					<div class="flex-cell flex-sm-4 flex-md-6">
						<div class="kind-brand">
							<?php
								$content = str_replace( '{theme-credit}', kind_footer_poweredby(), get_theme_mod( 'footer_creator' ) );
								echo do_shortcode( $content );
							?>
						</div>
					</div>
				<?php } ?>

			</div>
		<?php } ?>

	</div>

</footer>

<?php do_action( 'kind_before_wp_footer' ); ?>

<?php wp_footer(); ?>

</body>
</html>
