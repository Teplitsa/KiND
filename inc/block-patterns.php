<?php
/**
 * Block Patterns
 *
 * @package KiND
 */

/**
 * Register Block Pattern Category.
 */
function kind_register_block_pattern_category() {
	register_block_pattern_category(
		'kind',
		array( 'label' => esc_html__( 'KiND', 'kind' ) )
	);
}
add_action( 'init', 'kind_register_block_pattern_category' );

/**
 * Register Block Patterns.
 */
function kind_register_block_pattern() {

	// Hero Section.
	register_block_pattern(
		'kind/hero-section',
		array(
			'title'         => esc_html__( 'Hero section', 'kind' ),
			'categories'    => array( 'kind' ),
			'viewportWidth' => 1440,
			'blockTypes'    => array( 'core/cover' ),
			'content'       => '<!-- wp:cover {"minHeight":600,"customGradient":"linear-gradient(0deg,rgb(255,255,255) 16%,rgb(254,213,216) 100%)","isDark":false,"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","right":"var:preset|spacing|50","bottom":"var:preset|spacing|60","left":"var:preset|spacing|50"}}}} -->
				<div class="wp-block-cover alignfull is-light" style="padding-top:var(--wp--preset--spacing--60);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--60);padding-left:var(--wp--preset--spacing--50);min-height:600px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-100 has-background-dim has-background-gradient" style="background:linear-gradient(0deg,rgb(255,255,255) 16%,rgb(254,213,216) 100%)"></span><div class="wp-block-cover__inner-container"><!-- wp:columns {"verticalAlignment":"center","align":"wide"} -->
				<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center"} -->
				<div class="wp-block-column is-vertically-aligned-center"><!-- wp:heading {"textColor":"black","fontSize":"large"} -->
				<h2 class="wp-block-heading has-black-color has-text-color has-large-font-size">' . esc_html_x( 'KiND – Accessibility-Focused Theme for Media and Non-Profits', 'Theme starter content', 'kind' ) . '</h2>
				<!-- /wp:heading -->
				<!-- wp:paragraph {"textColor":"black"} -->
				<p class="has-black-color has-text-color">' . esc_html_x( 'The KiND theme is a user-friendly tool that allows NGOs and media organizations to create professional websites without the need for coding skills or prior experience.', 'Theme starter content', 'kind' ) . '</p>
				<!-- /wp:paragraph -->

				<!-- wp:buttons -->
				<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"main","style":{"spacing":{"padding":{"top":"var:preset|spacing|20","right":"var:preset|spacing|50","bottom":"var:preset|spacing|20","left":"var:preset|spacing|50"}},"border":{"radius":"7px"},"typography":{"fontStyle":"normal","fontWeight":"600","textTransform":"uppercase","fontSize":"18px"}}} -->
				<div class="wp-block-button has-custom-font-size" style="font-size:18px;font-style:normal;font-weight:600;text-transform:uppercase"><a class="wp-block-button__link has-main-background-color has-background wp-element-button" style="border-radius:7px;padding-top:var(--wp--preset--spacing--20);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--20);padding-left:var(--wp--preset--spacing--50)">' . esc_html_x( 'Get Started', 'Theme starter content', 'kind' ) . '</a></div>
				<!-- /wp:button --></div>
				<!-- /wp:buttons --></div>
				<!-- /wp:column -->

				<!-- wp:column {"verticalAlignment":"center"} -->
				<div class="wp-block-column is-vertically-aligned-center"><!-- wp:image {"id":52,"sizeSlug":"full","linkDestination":"none","className":"is-style-default"} -->
				<figure class="wp-block-image size-full is-style-default"><img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/figure.png" alt="" class="wp-image-52"/></figure>
					<!-- /wp:image --></div>
					<!-- /wp:column --></div>
					<!-- /wp:columns --></div></div>
					<!-- /wp:cover -->',
		)
	);

	// Columns with text.
	register_block_pattern(
		'ind/columns-with-text',
		array(
			'title'         => esc_html__( 'Columns with text', 'kind' ),
			'categories'    => array( 'kind' ),
			'viewportWidth' => 1440,
			'blockTypes'    => array( 'core/columns' ),
			'content'       => '<!-- wp:columns {"verticalAlignment":"top","align":"wide"} -->
					<div class="wp-block-columns alignwide are-vertically-aligned-top"><!-- wp:column {"verticalAlignment":"top"} -->
					<div class="wp-block-column is-vertically-aligned-top"><!-- wp:heading {"level":3} -->
					<h3>' . esc_html_x( 'Feel the Power of Open Source Theme', 'Theme starter content', 'kind' ) . '</h3>
					<!-- /wp:heading -->

					<!-- wp:paragraph -->
					<p>' . esc_html_x( 'Enjoy the freedom to use and customize the theme. If you want to give back – feel welcome to contribute to KiND’s ongoing development.', 'Theme starter content', 'kind' ) . '</p>
					<!-- /wp:paragraph --></div>
					<!-- /wp:column -->

					<!-- wp:column {"verticalAlignment":"top"} -->
					<div class="wp-block-column is-vertically-aligned-top"><!-- wp:heading {"level":3} -->
					<h3>' . esc_html_x( 'Built for Media Outlets and Non-Profits', 'Theme starter content', 'kind' ) . '</h3>
					<!-- /wp:heading -->

					<!-- wp:paragraph -->
					<p>' . esc_html_x( 'KiND is purpose-built for non-profits and media outlets, offering tailored features and functions that cater specifically to their unique needs and requirements.', 'Theme starter content', 'kind' ) . '</p>
					<!-- /wp:paragraph --></div>
					<!-- /wp:column -->

					<!-- wp:column {"verticalAlignment":"top"} -->
					<div class="wp-block-column is-vertically-aligned-top"><!-- wp:heading {"level":3} -->
					<h3>' . esc_html_x( 'No Coding Skills Required', 'Theme starter content', 'kind' ) . '</h3>
					<!-- /wp:heading -->

					<!-- wp:paragraph -->
					<p>' . esc_html_x( 'Enjoy the simplicity of KiND\'s low code / no code approach, eliminating the need for programming expertise. Focus on the content, not on technicalities.', 'Theme starter content', 'kind' ) . '</p>
					<!-- /wp:paragraph --></div>
					<!-- /wp:column --></div>
					<!-- /wp:columns -->',
		)
	);
}
add_action( 'init', 'kind_register_block_pattern' );
