<?php
/**
 * Inline Styles
 */

/**
 * Add inline styles
 */
function kind_inline_style() {

	$main_color        = get_theme_mod( 'kind_main_color', '#d30a6a' );
	$main_color_active = get_theme_mod( 'kind_main_color_active', '#ab0957' );

	$kind_page_bg_color      = get_theme_mod( 'site_background', '#ffffff' );
	$kind_page_bg_color_dark = kind_color_luminance( $kind_page_bg_color, - 0.2 );

	$kind_font_family_base     = '"Raleway", Arial, sans-serif';
	$kind_font_family_headings = '"Raleway", Arial, sans-serif';

	// Base typography.
	if ( get_theme_mod( 'font_base', true ) && class_exists( 'Kirki' ) ) {
		$kind_color_base       = kind_typography( 'font_base', 'color', '#4d606a' );
		$kind_font_family_base = '"' . kind_typography( 'font_base', 'font-family', 'Raleway' ) . '"';
		$kind_font_weight_base = kind_typography( 'font_base', 'variant', '500' );
		$kind_font_size_base   = kind_typography( 'font_base', 'font-size', '18px' );
	} else {
		$kind_color_base = get_theme_mod( 'text_color', '#4d606a' );
		$kind_font_weight_base = '500';
		$kind_font_size_base   = '18px';
	}
	$kind_font_style_base = kind_typography( 'font_base', 'font-style', 'normal' );

	$kind_page_text_color_light = kind_color_luminance( $kind_color_base, 2 );

	// Heading typography.
	if ( get_theme_mod( 'font_headings' ) && class_exists( 'Kirki' ) ) {
		$kind_headings_color       = kind_typography( 'font_headings', 'color', '#183343' );
		$kind_font_family_headings = '"' . kind_typography( 'font_headings', 'font-family', 'Raleway' ) . '"';
		$kind_font_weight_headings = kind_typography( 'font_headings', 'variant', '700' );
	} else {
		$kind_headings_color       = get_theme_mod( 'headings_color', '#183343' );
		$kind_font_weight_headings = 700;
	}
	$kind_font_style_headings = kind_typography( 'font_headings', 'font-style', 'normal' );

	$kind_font_size_menu = get_theme_mod( 'header_menu_size', '18px' );

	$custom_css = ':root {
	--kind-color-main:         ' . $main_color . ';
	--kind-color-main-active:    ' . $main_color_active . ';

	--kind-page-bg-color:        ' . $kind_page_bg_color . ';
	--kind-page-bg-color-dark:   ' . $kind_page_bg_color_dark . ';

	--kind-page-text-color-light:  ' . $kind_page_text_color_light . ';

	--kind-color-base:       ' . $kind_color_base . ';
	--kind-font-family-base: ' . $kind_font_family_base . ';
	--kind-font-weight-base: ' . $kind_font_weight_base . ';
	--kind-font-size-base:   ' . $kind_font_size_base . ';
	--kind-font-style-base:  ' . $kind_font_style_base . ';

	--kind-color-headings:       ' . $kind_headings_color . ';
	--kind-font-family-headings: ' . $kind_font_family_headings . ';
	--kind-font-weight-headings: ' . $kind_font_weight_headings . ';
	--kind-font-style-headings:  ' . $kind_font_style_headings . ';

	--kind-font-size-menu: ' . $kind_font_size_menu . ';

	--kind-completed-project-color: ' . get_theme_mod( 'projects_completed_color', $kind_color_base ) . ';
	--kind-completed-project-opacity: ' . get_theme_mod( 'projects_completed_opacity', '0.8' ) . ';
}';

	$custom_css = apply_filters( 'kind_inline_style', $custom_css );

	wp_add_inline_style( 'kind', $custom_css );
	if ( is_admin() ) {
		wp_add_inline_style( 'kind-blocks', $custom_css );
	}
}
add_action( 'wp_enqueue_scripts', 'kind_inline_style', 40 );


function kind_header_inline_style( $css ){

	// Logo Typography.
	$header_logo_font = '';
	if ( get_theme_mod( 'font_logo' ) && class_exists( 'Kirki' ) ) {
		if ( true !== get_theme_mod( 'font_logo_default' ) ) {
			$kind_font_family_logo = '"' . kind_typography( 'font_logo', 'font-family', 'Raleway' ) . '"';
			$kind_font_weight_logo = kind_typography( 'font_logo', 'variant', '700' );
			$kind_font_style_logo  = kind_typography( 'font_logo', 'font-style', 'normal' );
			$kind_font_size_logo   = kind_typography( 'font_logo', 'font-size', '22px' );

	$header_logo_font = '
	--kind-font-family-logo: ' . $kind_font_family_logo . ';
	--kind-font-weight-logo: ' . $kind_font_weight_logo . ';
	--kind-font-style-logo:  ' . $kind_font_style_logo . ';
	--kind-font-size-logo:  ' . $kind_font_size_logo . ';
	';
		}
	}

$css .= '
:root {
	--kind-header-height: ' . get_theme_mod( 'header_height', '124px' ) . ';
	--kind-header-background: ' . get_theme_mod( 'header_background', '#ffffff' ) . ';
}
.kind-header-logo {
	--kind-color-logo: ' . get_theme_mod( 'header_logo_color', '#183343' ) . ';
	--kind-color-logo-desc: ' . get_theme_mod( 'header_logo_desc_color', '#4d606a' ) . ';
	' . $header_logo_font . '
}
.kind-header-nav {
	--kind-color-menu: ' . get_theme_mod( 'header_menu_color', '#4d606a' ) . ';
	--kind-color-menu-hover: ' . get_theme_mod( 'header_menu_color_hover', '#dd1400' ) . ';
}

';
	return $css;
}
add_filter( 'kind_inline_style', 'kind_header_inline_style' );


function kind_footer_inline_style( $css ){

	$footer_logo_font = '';
	if ( get_theme_mod( 'font_footer_logo' ) && class_exists( 'Kirki' ) ) {
		if ( true !== get_theme_mod( 'font_footer_logo_default' ) ) {
			$kind_font_family_logo = '"' . kind_typography( 'font_footer_logo', 'font-family', 'Raleway' ) . '"';
			$kind_font_weight_logo = kind_typography( 'font_footer_logo', 'variant', '700' );
			$kind_font_style_logo  = kind_typography( 'font_footer_logo', 'font-style', 'normal' );
			$kind_font_size_logo   = kind_typography( 'font_footer_logo', 'font-size', '22px' );

	$footer_logo_font = '
	--kind-font-family-logo: ' . $kind_font_family_logo . ';
	--kind-font-weight-logo: ' . $kind_font_weight_logo . ';
	--kind-font-style-logo:  ' . $kind_font_style_logo . ';
	--kind-font-size-logo:  ' . $kind_font_size_logo . ';
	';
		}
	}

$css .= '
:root {
	--kind-footer-background: ' . get_theme_mod( 'footer_background', '#f7f8f8' ) . ';
	--kind-footer-heading-color: ' . get_theme_mod( 'footer_heading_color', '#183343' ) . ';
	--kind-footer-color: ' . get_theme_mod( 'footer_color', '#4d606a' ) . ';
	--kind-footer-link-color: ' . get_theme_mod( 'footer_color_link', '#d30a6a' ) . ';
	--kind-footer-link-color-hover: ' . get_theme_mod( 'footer_color_link_hover', '#ab0957' ) . ';
}
.kind-footer {
	--kind-footersocial-color: ' . get_theme_mod( 'footer_color_social', '#183343' ) . ';
	--kind-footersocial-color-hover: ' . get_theme_mod( 'footer_color_social_hover', '#4d606a' ) . ';
}
.kind-footer-logo {
	--kind-color-logo: ' . get_theme_mod( 'footer_logo_color', '#183343' ) . ';
	--kind-color-logo-desc: ' . get_theme_mod( 'footer_logo_desc_color', '#4d606a' ) . ';
	' . $footer_logo_font . '
}
';
	return $css;
}
add_filter( 'kind_inline_style', 'kind_footer_inline_style' );
