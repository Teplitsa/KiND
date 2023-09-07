<?php
/**
 * Editor functions
 */

function kind_color_palette() {

	$colors = array(
		array(
			'name'  => esc_html__( 'White', 'kind' ),
			'slug'  => 'white',
			'color' => '#ffffff',
		),
		array(
			'name'  => esc_html__( 'Black', 'kind' ),
			'slug'  => 'black',
			'color' => '#000000',
		),
		array(
			'name'  => esc_html__( 'Light Grey', 'kind' ),
			'slug'  => 'light-grey',
			'color' => '#f7f8f8',
		),
		array(
			'name'  => esc_html( 'Light Blue', 'kind' ),
			'slug'  => 'light-blue',
			'color' => '#f5fafe',
		),
		array(
			'name'  => esc_html( 'Main', 'kind' ),
			'slug'  => 'main',
			'color' => get_theme_mod( 'kind_main_color', '#d30a6a' ),
		),
		array(
			'name' => esc_html( 'Base', 'kind' ),
			'slug' => 'base',
			'color' => ( '#4d606a' != kind_typography( 'font_base', 'color' ) ? kind_typography( 'font_base', 'color' ) : '#4d606a' ),
		),
	);

	return apply_filters( 'kind_color_palette', $colors );
}

/**
 * Register block core/table underline style
 */
if ( function_exists( 'register_block_style' ) ) {
	register_block_style(
		'core/table',
		array(
			'name'  => 'underline',
			'label' => esc_html__( 'Underline', 'kind' ),
		)
	);
}
