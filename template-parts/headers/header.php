<?php
/**
 * The template for displaying the header layout type 2
 */
?>

<header class="kind-header">
	<div class="kind-container-fluid">
		<div class="kind-header__inner kind-header__inner-desktop">
			<div class="kind-header__col kind-col-left">
				<?php kind_header_logo(); ?>
			</div>
			<div class="kind-header__col kind-col-right">
				<?php
					kind_header_nav_menu();
					if ( get_theme_mod( 'header_social' ) ) {
						kind_social_links();
					}
					kind_search_toggle();
					kind_header_additional_button();
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
