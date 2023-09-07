<?php
/**
 * Template Functions
 */

if ( ! function_exists( 'kind_typography' ) ) {
	/**
	 * Output typography style.
	 *
	 * @param string $field   The field name of kirki.
	 * @param string $type    The type of typography.
	 * @param string $default The default value.
	 */
	function kind_typography( $field, $type, $default = '' ) {
		$value       = $default;
		$field_value = get_theme_mod( $field );
		if ( is_array( $field_value ) && $field_value ) {
			if ( isset( $field_value[ $type ] ) && $field_value[ $type ] ) {
				$value = $field_value[ $type ];
				if ( 'variant' === $type ) {
					// Get font-weight from variant.
					$value = filter_var( $field_value[ $type ], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );
					$value = ( 'regular' === $field_value[ $type ] || 'italic' === $field_value[ $type ] ) ? 400 : absint( $field_value[ $type ] );
				}
			}
		}
		return $value;
	}
}

/**
 * Cyrillic fonts list
 */
if ( ! function_exists( 'kind_cyrillic_fonts' ) ) {
	function kind_cyrillic_fonts() {
		$fonts = array(
			'Alegreya',
			'Alegreya SC',
			'Alegreya Sans',
			'Alegreya Sans SC',
			'Alice',
			'Amatic SC',
			'Andika',
			'Anonymous Pro',
			'Arimo',
			'Arsenal',
			'Bad Script',
			'Balsamiq Sans',
			'Bellota',
			'Bellota Text',
			'Caveat',
			'Comfortaa',
			'Cormorant',
			'Cormorant Garamond',
			'Cormorant Infant',
			'Cormorant SC',
			'Cormorant Unicase',
			'Cousine',
			'Cuprum',
			'Didact Gothic',
			'EB Garamond',
			'El Messiri',
			'Exo 2',
			'Fira Code',
			'Fira Mono',
			'Fira Sans',
			'Fira Sans Condensed',
			'Fira Sans Extra Condensed',
			'Forum',
			'Gabriela',
			'IBM Plex Mono',
			'IBM Plex Sans',
			'IBM Plex Serif',
			'Inter',
			'Istok Web',
			'Jost',
			'Jura',
			'Kelly Slab',
			'Kosugi',
			'Kosugi Maru',
			'Kurale',
			'Ledger',
			'Literata',
			'Lobster',
			'Lora',
			'Manrope',
			'Marck Script',
			'Marmelad',
			'Merriweather',
			'Montserrat',
			'Montserrat Alternates',
			'Mulish',
			'Neucha',
			'Noto Sans',
			'Noto Serif',
			'Nunito',
			'Old Standard TT',
			'Open Sans',
			'Open Sans Condensed',
			'Oranienbaum',
			'Oswald',
			'PT Mono',
			'PT Sans',
			'PT Sans Caption',
			'PT Sans Narrow',
			'PT Serif',
			'PT Serif Caption',
			'Pacifico',
			'Pangolin',
			'Pattaya',
			'Philosopher',
			'Play',
			'Playfair Display',
			'Playfair Display SC',
			'Podkova',
			'Poiret One',
			'Prata',
			'Press Start 2P',
			'Prosto One',
			'Raleway',
			'Roboto',
			'Roboto Condensed',
			'Roboto Mono',
			'Roboto Slab',
			'Rubik',
			'Rubik Mono One',
			'Ruda',
			'Ruslan Display',
			'Russo One',
			'Sawarabi Gothic',
			'Scada',
			'Seymour One',
			'Source Code Pro',
			'Source Sans Pro',
			'Spectral',
			'Spectral SC',
			'Stalinist One',
			'Tenor Sans',
			'Tinos',
			'Ubuntu',
			'Ubuntu Condensed',
			'Ubuntu Mono',
			'Underdog',
			'Viaoda Libre',
			'Vollkorn',
			'Vollkorn SC',
			'Yanone Kaffeesatz',
			'Yeseva One',
		);
		return apply_filters( 'kind_cyrillic_fonts', $fonts );
	}
}

/**
 * Get header type
 */
function kind_get_header_type() {
	$header_type = get_theme_mod( 'header_type', '2' );
	return apply_filters( 'kind_get_header_type', $header_type );
}

/**
 * Detect color scheme.
 *
 * @param mixed $color Color.
 * @param int   $level Detect level.
 */
function kind_detect_color_scheme( $color, $level = 190 ) {
	// Set alpha channel.
	$alpha = 1;

	$rgba = array( 255, 255, 255 );

	// Trim color.
	$color = trim( $color );

	// If HEX format.
	if ( isset( $color[0] ) && '#' === $color[0] ) {
		// Remove '#' from start.
		$color = str_replace( '#', '', trim( $color ) );

		if ( 3 === strlen( $color ) ) {
			$color = $color[0] . $color[0] . $color[1] . $color[1] . $color[2] . $color[2];
		}

		$rgba[0] = hexdec( substr( $color, 0, 2 ) );
		$rgba[1] = hexdec( substr( $color, 2, 2 ) );
		$rgba[2] = hexdec( substr( $color, 4, 2 ) );

	} elseif ( preg_match_all( '#\((([^()]+|(?R))*)\)#', $color, $color_reg ) ) {
		// Convert RGB or RGBA.
		$rgba = explode( ',', implode( ' ', $color_reg[1] ) );

		if ( array_key_exists( '3', $rgba ) ) {
			$alpha = (float) $rgba['3'];
		}
	}

	// Apply alpha channel.
	foreach ( $rgba as $key => $channel ) {
		$rgba[ $key ] = str_pad( $channel + ceil( ( 255 - $channel ) * ( 1 - $alpha ) ), 2, '0', STR_PAD_LEFT );
	}

	// Set default scheme.
	$scheme = 'default';

	// Get brightness.
	$brightness = ( ( $rgba[0] * 299 ) + ( $rgba[1] * 587 ) + ( $rgba[2] * 114 ) ) / 1000;

	// If color gray.
	if ( $brightness < $level ) {
		$scheme = 'inverse';
	}

	return $scheme;
}

/** Colors managemnt for theme **/
function kind_get_deault_main_color() {
	return '#f43724'; // may depends on test content set somehow
}

function kind_get_main_color() {
	return kind_get_theme_color( 'kind_main_color' );
}

function kind_get_theme_color( $color_name ) {
	$main_color = get_theme_mod( $color_name );
	
	if ( empty( $main_color ) ) {
		$main_color = kind_get_deault_main_color();
	}
	
	return $main_color;
}

/**
 * Lightens/darkens a given colour (hex format), returning the altered colour in hex format.7
 * @param str $hex Colour as hexadecimal (with or without hash);
 * @percent float $percent Decimal ( 0.2 = lighten by 20%(), -0.4 = darken by 40%() )
 * @return str Lightened/Darkend colour as hexadecimal (with hash);
 * 
 * https://gist.github.com/stephenharris/5532899
 */
function kind_color_luminance( $hex, $percent ) {

	// validate hex string
	$hex = preg_replace( '/[^0-9a-f]/i', '', $hex );
	$new_hex = '#';
	
	if ( strlen( $hex ) < 6 ) {
		$hex = $hex[0] + $hex[0] + $hex[1] + $hex[1] + $hex[2] + $hex[2];
	}
	
	if ( $percent > 0 ) {
		for ( $i = 0; $i <= 5; $i++ ) {
			if ( ! $hex[$i] ) {
				$hex[$i] = 1;
			}
		}
	}

	// convert to decimal and change luminosity
	for ( $i = 0; $i < 3; $i++ ) {
		$dec = hexdec( substr( $hex, $i * 2, 2 ) );
		$dec = min( max( 0, $dec + $dec * $percent ), 255 );
		$new_hex .= str_pad( dechex( $dec ), 2, 0, STR_PAD_LEFT );
	}
	
	return $new_hex;
}

/**
 * Create scheme css class.
 *
 * @param mixed $color Color.
 * @param int   $echo display or return.
 */
function kind_scheme_class( $color = '', $echo = true ) {
	$scheme = kind_detect_color_scheme( $color );
	if ( 'inverse' === $scheme ) {
		$scheme_class = 'kind-scheme-' . $scheme;
		if ( true === $echo ) {
			echo esc_attr( $scheme_class );
		} else {
			return $scheme_class;
		}
	}
}

/**
 * Get theme data.
 *
 * @param object $data Data.
 */
function kind_get_theme_data( $data ) {
	$theme = wp_get_theme( get_template() );

	return $theme->get( $data );
}

/**
 * Get theme version.
 */
function kind_get_theme_version() {
	$theme = wp_get_theme( get_template() );

	return kind_get_theme_data( 'Version' );
}

/**
 * Get post by title
 */
function kind_get_post_by_title( $title = null, $post_type = 'page' ) {
	if ( ! $title ) {
		return;
	}
	$query = new WP_Query(
		array(
			'post_type'              => $post_type,
			'title'                  => $title,
			'posts_per_page'         => 1,
			'update_post_term_cache' => false,
			'update_post_meta_cache' => false,
			'ignore_sticky_posts' => true,
			'post_status'         => 'inherit',
		)
	);

	if ( ! empty( $query->post ) ) {
		$post_by_title = $query->post;
	} else {
		$post_by_title = null;
	}

	return $post_by_title;
}

if ( ! function_exists('kind_social_links') ) {
	/**
	 * Socila links and sharing
	 */
	function kind_social_links( $atts = array(), $echo = true ) {

		$classes = isset( $atts['class'] ) ? $atts['class'] : '';

		$social_links = array();

		foreach( kind_get_social_media_supported() as $id => $label ) {

			$link = esc_url( get_theme_mod( 'kind_social_' . $id ) );
			if( $link ) {
				$social_links[ $id ] = array( 'label' => $label, 'link' => $link );
			}

		}

		$default_socials = array();

		if( $social_links ) {
			foreach( $social_links as $id => $data ) {
				$default_socials[] = array(
					'network' => $id,
					'label'   => $data['label'],
					'url'     => $data['link'],
				);
			}
		}

		$kind_social = get_theme_mod( 'kind_social', $default_socials );

		ob_start();

		if ( $kind_social ) {
			?>
				<ul class="kind-social-links <?php echo esc_attr( $classes ); ?>">
					<?php
					foreach( $kind_social as $setting ) {

						$icon = '<svg class="svg-icon">
							<title>' . esc_html( $setting['label'] ) . '</title>
							<use xlink:href="#icon-' . esc_attr( $setting['network'] ) . '" />
						</svg>';

						if ( ! $setting['network'] && $setting['image'] ) {
							$icon = '<div class="image-icon-mask"><div class="image-icon" style="--hms-social-icon:url(' . wp_get_attachment_image_url( $setting['image'] ) . ')"></div></div>';
						} else if ( ! $setting['network'] ) {
							$icon = '';
						}

						if ( $icon ) {
						?>
						<li class="<?php echo esc_attr( $setting['network'] );?>">
							<a href="<?php echo esc_url( $setting['url'] );?>" target="_blank" aria-label="<?php echo esc_attr( $setting['label'] );?>">
								<?php echo $icon; ?>
								<span><?php echo esc_html( $setting['label'] ); ?></span>
							</a>
						</li>
						<?php
						}
					}
					?>
				</ul>

			<?php 
		}

		$out = ob_get_contents();
		ob_end_clean();

		if( $echo ) {
			echo $out;
		} else {
			return $out;
		}

	}
}

/**
 * Get information about available image sizes
 */
function kind_get_image_sizes( $size = '' ) {
	$wp_additional_image_sizes = wp_get_additional_image_sizes();

	$sizes = array();
	$get_intermediate_image_sizes = get_intermediate_image_sizes();

	// Create the full array with sizes and crop info
	foreach( $get_intermediate_image_sizes as $_size ) {
		if ( in_array( $_size, array( 'thumbnail', 'medium', 'large' ) ) ) {
			$sizes[ $_size ]['width'] = get_option( $_size . '_size_w' );
			$sizes[ $_size ]['height'] = get_option( $_size . '_size_h' );
			$sizes[ $_size ]['crop'] = (bool) get_option( $_size . '_crop' );
		} elseif ( isset( $wp_additional_image_sizes[ $_size ] ) ) {
			$sizes[ $_size ] = array( 
				'width' => $wp_additional_image_sizes[ $_size ]['width'],
				'height' => $wp_additional_image_sizes[ $_size ]['height'],
				'crop' =>  $wp_additional_image_sizes[ $_size ]['crop']
			);
		}
	}

	// Get only 1 size if found
	if ( $size ) {
		if( isset( $sizes[ $size ] ) ) {
			return $sizes[ $size ];
		} else {
			return false;
		}
	}
	return $sizes;
}

/**
 * Is active page title
 */
function kind_is_page_title(){
	return apply_filters( 'kind_is_page_title', '__return_true' );
}

/**
 * Get social links
 */
if ( ! function_exists( 'kind_get_social_media_supported') ) {
	function kind_get_social_media_supported() {
		return array(
			'facebook'  => esc_html__( 'Facebook', 'kind' ),
			'instagram' => esc_html__( 'Instagram', 'kind' ),
			'twitter'   => esc_html__( 'Twitter', 'kind' ),
			'telegram'  => esc_html__( 'Telegram', 'kind' ),
			'youtube'   => esc_html__( 'YouTube', 'kind' ),
			'tiktok'    => esc_html__( 'TikTok', 'kind' ),
		);
	}
}

/**
 * Footer copyright
 */
function kind_footer_copyright() {

	$content = esc_html( sprintf( __( '© Copyright %s %s · All rights reserved.', 'kind' ), gmdate( 'Y' ), get_bloginfo( 'name' ),  ) );

	return $content;
}

/**
 * Footer Powered by
 */
function kind_footer_poweredby() {

	$content = '<a href="https://kndwp.org/" target="_blank">
		<div class="support">' . esc_html__( 'Powered by KiND', 'kind' ) . '</div>
		<div class="kind-banner">
			<svg class="kind-icon pic-kind">
				<title>' . esc_html__( 'KiND logo', 'kind' ) . '</title>
				<use xlink:href="#pic-kind" />
			</svg>
		</div>
	</a>';

	return $content;
}
