<?php
/**
 * Theme functions and definitions
 *
 * @package KiND
 */

/**
 * Theme Setup
 */
function kind_setup() {

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/**
	 * Register Nav Menus locations.
	 */
	register_nav_menus(
		array(
			'primary'          => esc_html__( 'Primary menu', 'kind' ),
			'footer'           => esc_html__( 'Footer menu', 'kind' ),
			'footer_secondary' => esc_html__( 'Footer secondary menu', 'kind' ),
		)
	);

	/**
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script',
			'style',
			'navigation-widgets',
		)
	);

	// Add support post thumbnails.
	add_theme_support( 'post-thumbnails' );

	// Add support custom logo.
	add_theme_support( 'custom-logo' );

	// Add support for responsive embeds.
	add_theme_support( 'responsive-embeds' );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Add support custom-spacing.
	add_theme_support( 'custom-spacing' );

	add_theme_support( 'experimental-link-color' );

	add_theme_support( 'custom-line-height' );

	add_theme_support( 'wp-block-styles' );

	// Editor Color Palette.
	add_theme_support( 'editor-color-palette', kind_color_palette() );

	/*
	* Adds starter content to highlight the theme on fresh sites.
	* This is done conditionally to avoid loading the starter content on every
	* page load, as it is a one-off operation only needed once in the customizer.
	*/
	if ( is_customize_preview() ) {
		require_once get_template_directory() . '/inc/starter-content.php';
		add_theme_support( 'starter-content', kind_get_starter_content() );
	}

	// Editor style.
	add_editor_style( array( 'assets/css/editor.css' ) );

	// Set content-width.
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 800;
	}
}
add_action( 'after_setup_theme', 'kind_setup' );

/**
 * Get Theme Version
 */
function kind_theme_version() {
	$theme  = wp_get_theme();
	$parent = $theme->parent();

	if ( $parent ) {
		$version = $parent->get( 'Version' );
		return $version;
	}

	$version = $theme->get( 'Version' );

	return apply_filters( 'kind_get_theme_version', $version );
}

/**
* Assets.
*/
require_once get_template_directory() . '/inc/assets.php';

/**
 * Template functions
 */
require_once get_template_directory() . '/inc/template-functions.php';

/**
 * Custom template tags
 */
require_once get_template_directory() . '/inc/template-tags.php';

/**
 * Block Patterns
 */
require_once get_template_directory() . '/inc/block-patterns.php';

/**
 * Nav Menu
 */
require_once get_template_directory() . '/inc/nav-menu.php';

/**
 * Customizer
 */
require_once get_template_directory() . '/inc/customizer.php';

/**
 * Inline Styles
 */
require_once get_template_directory() . '/inc/inline-styles.php';

/**
 * Editor
 */
require_once get_template_directory() . '/inc/editor.php';
