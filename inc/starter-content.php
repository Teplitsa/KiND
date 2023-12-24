<?php
/**
 * Starter Content
 */
function kind_get_starter_content() {

	// Define and register starter content to showcase the theme on new sites.
	$starter_content = array(

		// Specify the core-defined pages to create and add custom thumbnails to some of them.
		'posts'      => array(
			'front' => array(
				'post_type'    => 'page',
				'post_title'   => esc_html_x( 'Create your website with blocks', 'Theme starter content', 'kind' ),
				'post_content' => '
				<!-- wp:cover {"minHeight":600,"customGradient":"linear-gradient(0deg,rgb(255,255,255) 16%,rgb(254,213,216) 100%)","isDark":false,"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","right":"var:preset|spacing|50","bottom":"var:preset|spacing|60","left":"var:preset|spacing|50"}}}} -->
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
					<!-- /wp:cover -->

					<!-- wp:spacer {"height":50} -->
					<div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
					<!-- /wp:spacer -->

					<!-- wp:columns {"verticalAlignment":"top","align":"wide"} -->
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
					<!-- /wp:columns -->

					<!-- wp:spacer -->
					<div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>
					<!-- /wp:spacer -->',
				'template'     => 'templates/template-noheader.php',
			),
			'about',
			'contact',
			'blog',
		),

		// Default to a static front page and assign the front and posts pages.
		'options'    => array(
			'show_on_front'   => 'page',
			'page_on_front'   => '{{front}}',
			'page_for_posts'  => '{{blog}}',
			'blogdescription' => esc_html_x( 'Theme for Media and Non-Profits', 'Theme starter content', 'kind' ),
		),

		// Starter Theme Mods.
		'theme_mods' => array(
			'header_logo_text'      => esc_html_x( 'Theme for Media and Non-Profits', 'Theme starter content', 'kind' ),
			'header_button_text'    => esc_html_x( 'Get Started', 'Theme starter content', 'kind' ),
			'offcanvas_button_text' => esc_html_x( 'Get Started', 'Theme starter content', 'kind' ),
			'footer_about_title'    => esc_html_x( 'About Us', 'Theme starter content', 'kind' ),
			'footer_about'          => implode(
				'',
				array(
					'<strong>' . esc_html_x( 'Address', 'Theme starter content', 'kind' ) . "</strong>\n",
					esc_html_x( '123 Main Street', 'Theme starter content', 'kind' ) . "\n",
					esc_html_x( 'New York, NY 10001', 'Theme starter content', 'kind' ) . "\n\n",
					'<strong>' . esc_html_x( 'Hours', 'Theme starter content', 'kind' ) . "</strong>\n",
					esc_html_x( 'Monday&ndash;Friday: 9:00AM&ndash;5:00PM', 'Theme starter content', 'kind' ) . "\n",
					esc_html_x( 'Saturday &amp; Sunday: 11:00AM&ndash;3:00PM', 'Theme starter content', 'kind' ),
				)
			),
			'footer_policy_title'   => esc_html_x( 'About This Site', 'Theme starter content', 'kind' ),
			'footer_policy'         => esc_html_x( 'This may be a good place to introduce yourself and your site or include some credits.', 'Theme starter content', 'kind' ),
		),

		// Set up nav menus for each of the two areas registered in the theme.
		'nav_menus'  => array(
			// Assign a menu to the "primary" location.
			'primary'          => array(
				'name'  => esc_html__( 'Primary menu', 'kind' ),
				'items' => array(
					'link_home',
					'page_about',
					'page_blog',
					'page_contact',
				),
			),

			// Assign a menu to the "footer" location.
			'footer'           => array(
				'name'  => esc_html__( 'Footer menu', 'kind' ),
				'items' => array(
					'link_home',
					'page_about',
					'page_blog',
					'page_contact',
				),
			),

			// Assign a menu to the "footer_secondary" location.
			'footer_secondary' => array(
				'name'  => esc_html__( 'Secondary menu', 'kind' ),
				'items' => array(
					'link_facebook',
					'link_twitter',
					'link_instagram',
					'link_youtube',
				),
			),
		),
	);

	/**
	 * Filters the array of starter content.
	 */
	return apply_filters( 'kind_get_starter_content', $starter_content );
}
