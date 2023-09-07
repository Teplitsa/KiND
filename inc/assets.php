<?php
/**
 * Assets
 */

/**
 * Enqueue Style
 */
function kind_enqueue_scripts(){
	// Styles.
	wp_enqueue_style(
		'kind',
		get_template_directory_uri() . '/style.css',
		apply_filters( 'kind_style_deps', array() ),
		kind_theme_version()
	);

	// Scripts.
	wp_enqueue_script(
		'kind',
		get_template_directory_uri() . '/assets/js/scripts.js',
		apply_filters( 'kind_script_deps', array( 'jquery' ) ),
		kind_get_theme_version(),
		true
	);

	$localize_script = array(
		'i18n' => array(
			'a11y' => array(
				'expand'            => esc_attr__( 'Expand child menu', 'kind' ),
				'collapse'          => esc_attr__( 'Collapse child menu', 'kind'),
				'offCanvasIsOpen'   => esc_attr__( 'Off-Canvas is open', 'kind' ),
				'offCanvasIsClosed' => esc_attr__( 'Off-Canvas is closed', 'kind' ),
			),
		),
	);

	if ( is_user_logged_in() ) {
		$localize_script['ajaxurl'] = admin_url( 'admin-ajax.php' );
		$localize_script['nonce']   = wp_create_nonce( 'kind-nonce' );
	}

	wp_localize_script( 'kind', 'kind', $localize_script );

	// Threaded comment reply styles.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) && get_theme_mod( 'post_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'kind_enqueue_scripts' );

/**
 * Enqueue scripts for admin and front
 */
function kind_enqueue_block_assets() {

	$css_dependencies = array(
		'wp-block-library',
	);

	if ( is_admin() ) {
		$css_dependencies[] = 'wp-edit-blocks';
	} else {
		$css_dependencies[] = 'classic-theme-styles';
	}

	wp_enqueue_style(
		'kind-blocks',
		get_template_directory_uri() . '/assets/css/blocks.css',
		apply_filters( 'kind_blocks_style_deps', $css_dependencies ),
		kind_get_theme_version()
	);

	kind_inline_style();

}
add_action( 'enqueue_block_assets', 'kind_enqueue_block_assets' );

/**
 * Enqueue scripts for editor
 */
function kind_enqueue_block_editor_assets() {

	wp_enqueue_style( 'kind-gutenberg', get_template_directory_uri() . '/assets/css/gutenberg.css', kind_get_theme_version() );

	kind_inline_style();

}
add_action( 'enqueue_block_editor_assets', 'kind_enqueue_block_editor_assets' );
