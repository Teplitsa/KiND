<?php
/**
 * Customizer options
 */

function kind_customize_register( $wp_customize ) {

	$wp_customize->add_section( 'colors', 
		array(
			'title'       => esc_html__( 'Colors', 'kind' ),
			'priority'    => 21,
			'capability'  => 'edit_theme_options',
		)
	);

	$wp_customize->add_setting( 'site_background',
		array(
			'default'    => '#ffffff',
			'capability' => 'edit_theme_options',
			'transport'  => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'site_background',
		array(
			'label'    => esc_html__( 'Site Background Color', 'kind' ), 
			'settings' => 'site_background',
			'section'  => 'colors',
		)
	) );

	$wp_customize->add_setting( 'kind_main_color',
		array(
			'default'    => '#d30a6a',
			'capability' => 'edit_theme_options',
			'transport'  => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'kind_main_color',
		array(
			'label'       => esc_html__( 'Buttons and links color', 'kind' ),
			'description' => esc_html__( 'Also used in other decorative elements', 'kind' ),
			'settings'    => 'kind_main_color',
			'section'     => 'colors',
		)
	) );

	$wp_customize->add_setting( 'kind_main_color_active',
		array(
			'default'    => '#ab0957',
			'capability' => 'edit_theme_options',
			'transport'  => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'kind_main_color_active',
		array(
			'label'       => esc_html__( 'Buttons and links color hover', 'kind' ),
			'description' => esc_html__( 'Also used in other active elements', 'kind' ),
			'settings' => 'kind_main_color_active',
			'section'  => 'colors',
		)
	) );

	// Content text color
	$wp_customize->add_setting( 'text_color',
		array(
			'default'    => '#4d606a',
			'capability' => 'edit_theme_options',
			'transport'  => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'text_color',
		array(
			'label'       => esc_html__( 'Content text color', 'kind' ),
			'settings' => 'text_color',
			'section'  => 'colors',
		)
	) );

	// Content heading color
	$wp_customize->add_setting( 'headings_color',
		array(
			'default'    => '#183343',
			'capability' => 'edit_theme_options',
			'transport'  => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'headings_color',
		array(
			'label'       => esc_html__( 'Content headings color', 'kind' ),
			'settings' => 'headings_color',
			'section'  => 'colors',
		)
	) );

	// Header section
	$wp_customize->add_section( 'header',
		array(
			'title'       => esc_html__( 'Header', 'kind' ),
			'priority'    => 22,
			'capability'  => 'edit_theme_options',
		)
	);

	// Header button label
	$wp_customize->add_setting( 'header_button_text',
		array(
			'capability' => 'edit_theme_options',
			'transport'  => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'header_button_text',
		array(
			'type' => 'text',
			'label'       => esc_html__( 'Button Label', 'kind' ),
			'settings' => 'header_button_text',
			'section'  => 'header',
		)
	);

	// Header button url
	$wp_customize->add_setting( 'header_button_link',
		array(
			'capability' => 'edit_theme_options',
			'transport'  => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'header_button_link',
		array(
			'type' => 'text',
			'label'       => esc_html__( 'Button URL', 'kind' ),
			'settings' => 'header_button_link',
			'section'  => 'header',
		)
	);

	// Footer section
	$wp_customize->add_section( 'footer',
		array(
			'title'       => esc_html__( 'Footer', 'kind' ),
			'priority'    => 23,
		)
	);

	// Description title
	$wp_customize->add_setting( 'footer_about_title',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'footer_about_title',
		array(
			'type' => 'text',
			'label'       => esc_html__( 'Description title', 'kind' ),
			'settings' => 'footer_about_title',
			'section'  => 'footer',
		)
	);

	// Description text
	$wp_customize->add_setting( 'footer_about',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'sanitize_callback' => 'wp_kses_post',
		)
	);

	$wp_customize->add_control(
		'footer_about',
		array(
			'type' => 'textarea',
			'label'       => esc_html__( 'Security policy text', 'kind' ),
			'settings' => 'footer_about',
			'section'  => 'footer',
		)
	);

	// Security policy title
	$wp_customize->add_setting( 'footer_policy_title',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'footer_policy_title',
		array(
			'type' => 'text',
			'label'       => esc_html__( 'Security policy title', 'kind' ),
			'settings' => 'footer_policy_title',
			'section'  => 'footer',
		)
	);

	// Security policy text
	$wp_customize->add_setting( 'footer_policy',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'sanitize_callback' => 'wp_kses_post',
		)
	);

	$wp_customize->add_control(
		'footer_policy',
		array(
			'type'     => 'textarea',
			'label'    => esc_html__( 'Security policy text', 'kind' ),
			'settings' => 'footer_policy',
			'section'  => 'footer',
		)
	);

	// Copyright
	$wp_customize->add_setting( 'footer_copyright_text',
		array(
			'capability' => 'edit_theme_options',
			'transport'  => 'refresh',
			'default'    => kind_footer_copyright(),
			'sanitize_callback' => 'wp_kses_post',
		)
	);

	$wp_customize->add_control(
		'footer_copyright_text',
		array(
			'type' => 'textarea',
			'label'       => esc_html__( 'Copyright', 'kind' ),
			'settings' => 'footer_copyright_text',
			'section'  => 'footer',
		)
	);

	// Powered by
	$wp_customize->add_setting( 'footer_creator',
		array(
			'capability' => 'edit_theme_options',
			'transport'  => 'refresh',
			'default'    => '{theme-credit}',
			'sanitize_callback' => 'wp_kses_post',
		)
	);

	$wp_customize->add_control(
		'footer_creator',
		array(
			'type' => 'textarea',
			'label'       => esc_html__( 'Powered by', 'kind' ),
			'settings' => 'footer_creator',
			'section'  => 'footer',
		)
	);

	// General panel
	$wp_customize->add_panel( 'general',
		array(
			'title'       => esc_html__( 'General', 'kind' ),
			'priority'    => 24,
		)
	);

	$wp_customize->add_section( 'socials',
		array(
			'title'       => esc_html__( 'Social Links', 'kind' ),
			'priority'    => 1,
			'panel'    => 'general',
		)
	);

	// Social links
	foreach ( kind_get_social_media_supported() as $id => $label ) {
		// Social link item
		$wp_customize->add_setting( 'kind_social_' . $id,
			array(
				'capability' => 'edit_theme_options',
				'transport'  => 'refresh',
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control(
			'kind_social_' . $id,
			array(
				'type' => 'text',
				'label'       => esc_attr( $label ),
				'settings' => 'kind_social_' . $id,
				'section'  => 'socials',
			)
		);
	}

}
add_action( 'customize_register', 'kind_customize_register' );

/**
 * Fix widgets error on customize page
 */
if( is_customize_preview() && ! current_theme_supports( 'widgets' ) ) {
	add_theme_support( 'widgets' );
}
