<?php
/**
 * The template for displaying the header layout type 1
 */
?>

<header class="kind-header">
	<div class="kind-container-fluid">
		<div class="kind-header__inner kind-header__inner-desktop">
			<div class="kind-header__col kind-col-left">
				<?php
				kind_header_logo();
				if ( get_theme_mod( 'header_custom_text' ) ) {
					?>
						<div class="kind-header-text"><?php echo wp_kses_post( get_theme_mod( 'header_custom_text' ) ); ?></div>
					<?php
				}
				?>
			</div>
			<div class="kind-header__col kind-col-right">
				<div class="kind-header-contacts">
					<?php if ( get_theme_mod( 'header_address' ) ) { ?>
						<div class="kind-header-address"><?php echo wp_kses_post( nl2br( get_theme_mod( 'header_address' ) ) ); ?></div>
					<?php } ?>
					<?php if ( get_theme_mod( 'header_email' ) ) { ?>
						<a href="mailto:<?php echo esc_attr( get_theme_mod( 'header_email' ) ); ?>" class="kind-header-email"><?php echo esc_html( get_theme_mod( 'header_email' ) ); ?></a>
					<?php } ?>
					<?php if ( get_theme_mod( 'header_phone' ) ) { ?>
						<div class="kind-header-phone"><?php echo esc_html( get_theme_mod( 'header_phone' ) ); ?></div>
					<?php } ?>
				</div>
				<?php
					if ( get_theme_mod( 'header_social' ) ) {
						kind_social_links();
					}
					kind_header_button();
					kind_offcanvas_toggle( get_theme_mod( 'header_offcanvas', false ) );
				?>
			</div>
		</div>
		<?php get_template_part( 'template-parts/navbar-mobile' ); ?>
	</div>
	<?php
		kind_header_search();
		get_template_part( 'template-parts/offcanvas' );
	?>
</header>
