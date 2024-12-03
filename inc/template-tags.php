<?php
/**
 * Custom template tags.
 */

/** HTML with meta information for the current post-date/time and author **/
function kind_posted_on( $post, $args = array() ) {
	$meta = array();
	$sep  = '';

	if ( 'post' == $post->post_type ) {

		$meta[] = "<time class='date'>" . get_the_date( 'd.m.Y', $post ) . '</time>';

		$cat = strip_tags( get_the_term_list( $post->ID, 'category', '<span class="category">', ', ', '</span>' ), '<span>' );

		if ( isset( $args['cat_link'] ) && $args['cat_link'] ) {
			$cat = '<span class="category"><span class="screen-reader-text">' . __( 'Categories', 'kind' ) . ' </span>' . get_the_category_list( ', ', '', $post->ID ) . '</span>';
		}

		if ( has_category( '', $post ) ) {
			$meta[] = $cat;
		}

		$meta = array_filter( $meta );

		$sep = '<span class="sep"></span>';
	} elseif ( 'project' == $post->post_type ) {

		$cat = get_the_term_list( $post->ID, 'project_cat', '<span class="category">', ', ', '</span>' );

		if ( has_term( '', 'project_cat', $post ) ) {
			$meta[] = $cat;
		}
	} elseif ( 'person' == $post->post_type ) {

		$cat = get_the_term_list( $post->ID, 'person_cat', '<span class="category">', ', ', '</span>' );
		if ( ! empty( $cat ) ) {
			$meta[] = $cat;
		}
	} elseif ( 'page' == $post->post_type && is_search() ) {
		$meta[] = "<span class='category'>" . esc_html__( 'Page', 'kind' ) . '</span>';
	}

	return implode( $sep, $meta );
}

/**
 * Icons
 */
function kind_icons() {
	$icons = array(
		'close' => '<svg width="24" height="24" viewBox="0 0 14 14" version="1.1" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
			<path d="M14 1.41L12.59 0 7 5.59 1.41 0 0 1.41 5.59 7 0 12.59 1.41 14 7 8.41 12.59 14 14 12.59 8.41 7 14 1.41z"/>
		</svg>',
		'kind'  => '<svg width="24" height="24" class="kind-icon pic-kind" viewBox="0 0 35 34" version="1.1" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
			<title>' . esc_html__( 'KiND logo', 'kind' ) . '</title>
			<g fill="none" fill-rule="evenodd">
				<path d="M.708 25.664L27.801 3.599c.8.602 1.55 1.268 2.238 1.992L6.323 32.493a18.073 18.073 0 0 1-5.615-6.83z" fill-opacity=".5" fill="#ACACAC" fill-rule="nonzero"/><path d="M11.928.724l22.731 20.78a17.944 17.944 0 0 1-4.234 8.486L7.745 2.558c1.297-.779 2.7-1.399 4.183-1.834z" fill-opacity=".5" fill="#898989" fill-rule="nonzero"/><path d="M22.216 11.67a1.21 1.21 0 1 1-2.42 0 1.21 1.21 0 0 1 2.42 0z" fill="#7A7A7A" fill-rule="nonzero"/><path d="M17.187 2.818A14.97 14.97 0 0 1 27.816 7.22a14.954 14.954 0 0 1 4.404 10.624 14.954 14.954 0 0 1-4.404 10.624 14.97 14.97 0 0 1-10.628 4.403 14.97 14.97 0 0 1-10.629-4.403 14.954 14.954 0 0 1-4.404-10.624A14.954 14.954 0 0 1 6.559 7.22a14.97 14.97 0 0 1 10.628-4.403" stroke="#979797"/>
			</g>
		</svg>',
		'up' => '<svg width="24" height="24" viewBox="0 0 12 8" version="1.1" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
			<path d="M1.41 8L6 3.41 10.59 8 12 6.58l-6-6-6 6L1.41 8z"/>
		</svg>',
	);

	return $icons;

}

function kind_icon( $id, $echo = true ) {
	$icons = kind_icons();

	if ( ! $id ) {
		return;
	}

	if ( ! isset( $icons[ $id ] ) ) {
		return;
	}

	$icon = $icons[ $id ];

	if ( $echo ) {
		echo wp_kses( $icon, 'content' );
	} else {
		return $icon;
	}
}

/** == Titles == **/
function kind_section_title() {
	global $wp_query;

	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

	$title = '';
	$css   = '';

	if ( is_category() || is_tag() || is_tax() ) {
		$title = single_term_title( '', false );
		$css   = 'archive';
	} elseif ( is_home() ) {
		$page_count = '';
		if ( is_paged() ) {
			$page_count = '<span class="screen-reader-text"> ' . esc_html__( 'Page', 'kind' ) . ' ' . $paged . '</span>';
		}
		$title = get_theme_mod( 'kind_news_archive_title', esc_html__( 'Blog', 'kind' ) ) . $page_count;
		$css   = 'archive';
	} elseif ( is_post_type_archive( 'leyka_donation' ) ) {
		$title = esc_html__( 'Donations history', 'kind' );
		$css   = 'archive';
	} elseif ( is_post_type_archive( 'project' ) ) {
		$title = kind_get_theme_mod( 'kind_projects_archive_title' );
		if ( $title === false ) {
			$title = esc_html__( 'Our projects', 'kind' );
		}
		$css = 'archive';
	} elseif ( is_post_type_archive( 'leyka_campaign' ) ) {
		if ( isset( $wp_query->query_vars['completed'] ) && $wp_query->query_vars['completed'] == 'true' ) {
			$title = kind_get_theme_mod( 'kind_completed_campaigns_archive_title' );
			if ( $title === false ) {
				$title = esc_html__( 'They alredy got help', 'kind' );
			}
		} else {
			$title = kind_get_theme_mod( 'kind_active_campaigns_archive_title' );
			if ( $title === false ) {
				$title = esc_html__( 'They need help', 'kind' );
			}
		}
		$css = 'archive';
	} elseif ( is_search() ) {
		$title = esc_html__( 'Search results', 'kind' );
		$css   = 'archive search';
	} elseif ( is_404() ) {
		$title = esc_html__( '404: Page not found', 'kind' );
		$css   = 'archive e404';
	}

	echo '<h1 class="section-title ' . esc_attr( $css ) . '">' . wp_kses_post( $title ) . '</h1>';
}

if ( ! function_exists( 'kind_archive_description' ) ) {
	/**
	 * Archive Description
	 */
	function kind_archive_description() {
		if ( get_the_archive_description() ) {
			?>
			<div class="kind-archive-description">
				<?php echo wp_kses_post( get_the_archive_description() ); ?>
			</div>
			<?php
		}
	}
}

/**
 * The Posts Pagination
 */
function kind_posts_pagination( $args = array() ) {

	$args = wp_parse_args(
		$args,
		array(
			'screen_reader_text' => esc_html__( 'Posts navigation', 'kind' ),
			'before_page_number' => '<span class="screen-reader-text"> ' . esc_html__( 'Page', 'kind' ) . ' </span>',
			'prev_text'          => esc_html__( 'Previous', 'kind' ) . '<span class="screen-reader-text"> ' . esc_html__( 'Page', 'kind' ) . '</span>',
			'next_text'          => esc_html__( 'Next', 'kind' ) . '<span class="screen-reader-text"> ' . esc_html__( 'Page', 'kind' ) . '</span>',
			'class'              => 'kind-pagination',
		)
	);

	the_posts_pagination( $args );
}

/** More section **/
function kind_more_section( $posts, $title = '', $type = 'news', $css = '' ) {
	if ( empty( $posts ) ) {
		return;
	}

	if ( $type == 'projects' ) {
		$title = ( empty( $title ) ) ? esc_html__( 'Our projects', 'kind' ) : $title;
	} else {
		$title = ( empty( $title ) ) ? esc_html__( 'Latest news', 'kind' ) : $title;
	}

	$css .= ' related-card-holder';
	?>
<section class="<?php echo esc_attr( $css ); ?>">

	<h3 class="related-title"><?php echo esc_html( $title ); ?></h3>

	<div class="related-cards-loop">
	<?php
	foreach ( $posts as $p ) {
		kind_related_post_link( $p );
	}
	?>
</div>

</section>
	<?php
}

/** Single template helpers **/

/**
 * Get Home Url
 */
function kind_get_home_url() {
	return apply_filters( 'kind_get_home_url', home_url( '/' ) );
}

/**
 * Get logo id
 */
function kind_get_logo_id() {
	$logo_id = false;
	if ( get_theme_mod( 'custom_logo' ) ) {
		$logo_id = get_theme_mod( 'custom_logo' );
	}
	return $logo_id;
}

/**
 * Get footer logo id
 */
function kind_get_footer_logo_id() {
	$logo_id = kind_get_logo_id();
	if ( class_exists( 'Kirki' ) ) {
		$logo_id = get_theme_mod( 'footer_logo_image', $logo_id );
	}
	return $logo_id;
}

/**
 * Get logo url
 */
function kind_get_logo_url() {
	$logo_id = kind_get_logo_id();
	if ( $logo_id ) {
		$logo_url = wp_get_attachment_image_url( $logo_id, 'full', false );
	} else {
		$logo_url = '';
	}
	return $logo_url;
}

/**
 * Get logo image
 */
function kind_get_logo_image() {
	$logo_id = kind_get_logo_id();

	$attr = array(
		'class' => 'site-logo-img',
		'alt'   => get_bloginfo( 'name' ),
	);

	$logo_image = '';
	if ( $logo_id ) {
		$logo_image = wp_get_attachment_image( $logo_id, 'full', false, $attr );
	}
	if ( ! $logo_image ) {
		$logo_image = kind_get_image_markup( kind_get_logo_url(), $attr );
	}

	return $logo_image;
}

/**
 * Get image markup.
 */
function kind_get_image_markup( $url, $attr = array() ) {

	$html      = '';
	$html_attr = '';
	if ( $url ) {
		$html_attr .= ' src="' . esc_url( $url ) . '"';

		foreach ( $attr as $name => $value ) {
			$html_attr .= " $name=" . '"' . $value . '"';
		}

		$html = '<img ' . $html_attr . '>';
	}

	return $html;
}

/**
 * Header Logo
 */
if ( ! function_exists( 'kind_header_logo' ) ) {
	function kind_header_logo() {

		$logo_title = get_theme_mod( 'header_logo_title', get_bloginfo( 'name' ) );
		$logo_desc  = get_theme_mod( 'header_logo_text', get_option( 'blogdescription' ) );

		?>
		<a href="<?php echo esc_url( kind_get_home_url() ); ?>" rel="home" class="kind-header-logo">
			<div class="kind-header-logo__inner">
				<?php
				$logo_id = kind_get_logo_id();

				$logo_url = wp_get_attachment_image_url( $logo_id, 'full', false );

				if ( $logo_url ) {
					$aria_hidden = '';
					if ( $logo_title || $logo_desc ) {
						$aria_hidden = ' aria-hidden="true"';
					}
					?>
					<div class="logo"<?php echo wp_kses_post( $aria_hidden ); ?>>
						<?php echo wp_get_attachment_image( $logo_id, 'full', false, array( 'alt' => get_bloginfo( 'name' ) ) ); ?>
					</div>
				<?php } ?>

				<?php if ( $logo_title || $logo_desc ) { ?>
					<div class="text">
						<?php if ( $logo_title ) { ?>
							<span class="logo-name"><?php echo wp_kses( nl2br( $logo_title ), array( 'br' => array() ) ); ?></span>
						<?php } ?>
						<?php if ( $logo_desc ) { ?>
							<span class="logo-desc"><?php echo wp_kses( nl2br( $logo_desc ), array( 'br' => array() ) ); ?></span>
						<?php } ?>
					</div>
				<?php } ?>

			</div>
		</a>
		<?php
	}
}

/**
 * Header Mobile Toggle
 */
if ( ! function_exists( 'kind_header_mobile_logo' ) ) {
	function kind_header_mobile_logo() {
		?>
		<a href="<?php echo esc_url( kind_get_home_url() ); ?>" rel="home" class="kind-header-mobile-logo">
		<?php
		$logo_id  = kind_get_logo_id();
		$logo_url = wp_get_attachment_image_url( $logo_id, 'full', false );

		if ( $logo_url ) {
			echo wp_get_attachment_image( $logo_id, 'full', false, array( 'alt' => get_bloginfo( 'name' ) ) );
		} elseif ( get_theme_mod( 'header_logo_title' ) ) {
			echo wp_kses_post( get_theme_mod( 'header_logo_title' ) );
		} else {
			bloginfo();
		}
		?>
		</a>
		<?php
	}
}

/**
 * Off-Canvas Logo
 */
if ( ! function_exists( 'kind_offcanvas_logo' ) ) {
	function kind_offcanvas_logo() {

		$logo_title = '<span>' . nl2br( get_theme_mod( 'header_logo_title', get_bloginfo( 'name' ) ) ) . '</span>';
		$logo_id    = kind_get_logo_id();
		$logo_img   = wp_get_attachment_image( $logo_id, 'full', false, array( 'alt' => get_bloginfo( 'name' ) ) );

		$logo = $logo_title;
		if ( $logo_id ) {
			$logo = $logo_img;
		}

		if ( ! $logo ) {
			return;
		}

		?>

		<a href="<?php echo esc_url( kind_get_home_url() ); ?>" rel="home" class="snt-cell" aria-hidden="true" tabindex="-1">
			<span class="logo-name"><?php echo wp_kses_post( $logo ); ?></span>
		</a>

		<?php
	}
}

/**
 * Footer Logo
 */
if ( ! function_exists( 'kind_footer_logo' ) ) {
	function kind_footer_logo() {

		if ( get_theme_mod( 'footer_logo', true ) ) {

			$logo_title = get_theme_mod( 'footer_logo_title', get_theme_mod( 'header_logo_title', get_bloginfo( 'name' ) ) );
			$logo_desc  = get_theme_mod( 'footer_logo_text', get_theme_mod( 'header_logo_text', get_bloginfo( 'description' ) ) );
			$logo_id    = kind_get_footer_logo_id();
			$logo_url   = wp_get_attachment_image_url( $logo_id, 'full', false );
			?>

			<a href="<?php echo esc_url( kind_get_home_url() ); ?>" class="kind-footer-logo">
				<span class="kind-footer-logo__inner">
					<?php
					if ( $logo_url ) {

						$aria_hidden = '';
						if ( $logo_title || $logo_desc ) {
							$aria_hidden = ' aria-hidden="true"';
						}
						?>
						<span class="kind-footer-logo__image"<?php echo wp_kses_post( $aria_hidden ); ?>>
						<?php echo wp_get_attachment_image( $logo_id, 'full', false, array( 'alt' => get_bloginfo( 'name' ) ) ); ?>
						</span>
					<?php } ?>

					<?php if ( $logo_title || $logo_desc ) { ?>
						<span class="kind-footer-logo__text">
							<?php if ( $logo_title ) { ?>
								<span class="logo-name"><?php echo wp_kses( nl2br( $logo_title ), array( 'br' => array() ) ); ?></span>
							<?php } ?>
							<?php if ( $logo_desc ) { ?>
								<span class="logo-desc"><?php echo wp_kses( nl2br( $logo_desc ), array( 'br' => array() ) ); ?></span>
							<?php } ?>
						</span>
					<?php } ?>

				</span>
			</a>

			<?php
		}
	}
}

/**
 * Site Search Toggle
 */
function kind_search_toggle() {
	if ( get_theme_mod( 'header_search', true ) ) {
		?>
		<button class="kind-search-toggle" type="button" aria-label="<?php esc_attr_e( 'Open search', 'kind' ); ?>">
			<svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path fill-rule="evenodd" clip-rule="evenodd" d="M2 8.5C2 5.191 4.691 2.5 8 2.5C11.309 2.5 14 5.191 14 8.5C14 11.809 11.309 14.5 8 14.5C4.691 14.5 2 11.809 2 8.5ZM17.707 16.793L14.312 13.397C15.365 12.043 16 10.346 16 8.5C16 4.089 12.411 0.5 8 0.5C3.589 0.5 0 4.089 0 8.5C0 12.911 3.589 16.5 8 16.5C9.846 16.5 11.543 15.865 12.897 14.812L16.293 18.207C16.488 18.402 16.744 18.5 17 18.5C17.256 18.5 17.512 18.402 17.707 18.207C18.098 17.816 18.098 17.184 17.707 16.793Z" fill="currentColor"/>
			</svg>
		</button>
		<?php
	}
}

/**
 * Site Search
 */
function kind_header_search() {
	if ( get_theme_mod( 'header_search', true ) ) {
		?>
	<div class="kind-search" tabindex="-1">
		<div class="kind-search__inner">
			<div class="kind-container">
				<?php get_search_form(); ?>
			</div>
		</div>
		<button class="kind-search-close" aria-label="<?php esc_attr_e( 'Close search', 'kind' ); ?>"></button>
	</div>
		<?php
	}
}

/**
 * Off-Canvas Toggle
 */
function kind_offcanvas_toggle( $is_active = true ) {
	if ( ! $is_active ) {
		return;
	}
	?>
	<button class="kind-offcanvas-toggle" aria-label="<?php esc_attr_e( 'Open Off-Canvas', 'kind' ); ?>">
		<span></span>
		<span></span>
		<span></span>
	</button>
	<?php
}

/**
 * Off-Canvas Close
 */
function kind_offcanvas_close() {
	?>
	<button class="trigger-button close kind-offcanvas-close" aria-label="<?php esc_attr_e( 'Close Off-Canvas', 'kind' ); ?>">
		<?php kind_icon( 'close' ); ?>
	</button>
	<?php
}

/**
 * Header Button
 */
function kind_header_button() {
	if ( get_theme_mod( 'header_button', true ) && get_theme_mod( 'header_button_text' ) ) {
		$link = get_theme_mod( 'header_button_link' );
		$text = get_theme_mod( 'header_button_text', esc_html__( 'Button text', 'kind' ) );
		if ( $text ) {
			?>
			<a href="<?php echo esc_url( $link ); ?>" role="button" class="kind-button kind-button-sm">
				<?php echo esc_html( $text ); ?>
			</a>
			<?php
		}
	}
}

/**
 * Off-Canvas Button
 */
function kind_offcanvas_button() {
	if ( get_theme_mod( 'offcanvas_button', true ) && get_theme_mod( 'offcanvas_button_text' ) ) {
		?>
		<div class="kind-offcanvas-section kind-offcanvas-button">
			<?php
			$link = get_theme_mod( 'offcanvas_button_link' );
			$text = get_theme_mod( 'offcanvas_button_text', esc_html__( 'Button text', 'kind' ) );
			if ( $text ) {
				?>
				<a href="<?php echo esc_url( $link ); ?>" role="button" class="kind-button kind-button-sm">
					<?php echo esc_html( $text ); ?>
				</a>
				<?php
			}
			?>
		</div>
		<?php
	}
}

/**
 * Header Additional Button Markup
 */
function kind_header_additional_button_markup() {
	$link = get_theme_mod( 'header_additional_button_link' );
	$text = get_theme_mod( 'header_additional_button_text' );
	if ( $text ) {
		?>
		<a href="<?php echo esc_url( $link ); ?>" role="button" class="kind-button kind-button-outline kind-button-sm">
			<?php echo esc_html( $text ); ?>
		</a>
		<?php
	}
}

/**
 * Header Additional Button
 */
function kind_header_additional_button() {
	if ( get_theme_mod( 'header_additional_button', true ) ) {
		kind_header_additional_button_markup();
	}
}

/**
 * Off-Canvas Additional Button
 */
function kind_offcanvas_additional_button() {
	if ( get_theme_mod( 'offcanvas_additional_button', true ) ) {
		?>
		<div class="kind-offcanvas-section kind-offcanvas-button">
			<?php kind_header_additional_button_markup(); ?>
		</div>
		<?php
	}
}

/**
 * Header Mobile Button
 */
function kind_header_mobile_button() {
	if ( get_theme_mod( 'header_button', true ) && get_theme_mod( 'header_button_text' ) ) {
		$link = get_theme_mod( 'header_button_link' );
		$text = get_theme_mod( 'header_button_text', esc_html__( 'Button text', 'kind' ) );
		if ( $text ) {
			?>
			<a href="<?php echo esc_url( $link ); ?>" role="button" class="kind-button kind-button-xs">
				<?php echo esc_html( $text ); ?>
			</a>
			<?php
		}
	}
}

/**
 * Header Nav Menu
 */
function kind_header_nav_menu() {
	if ( get_theme_mod( 'header_menu', true ) ) {
		if ( has_nav_menu( 'primary' ) ) {
			wp_nav_menu(
				array(
					'theme_location'       => 'primary',
					'container'            => 'nav',
					'container_class'      => 'kind-header-nav',
					'container_aria_label' => esc_attr__( 'Primary menu', 'kind' ),
					'depth'                => 7,
					'menu_class'           => 'menu kind-nav-menu',
				)
			);
		}
	}
}

if ( ! function_exists( 'kind_breadcrumbs' ) ) {
	/**
	 * Breadcrumbs
	 */
	function kind_breadcrumbs() {
		if ( function_exists( 'yoast_breadcrumb' ) ) {

			yoast_breadcrumb( '<div class="knd-breadcrumbs">', '</div>' );

		} elseif ( function_exists( 'rank_math_the_breadcrumbs' ) ) {

			$rank_math_args = array(
				'wrap_before' => '<div class="kind-breadcrumbs">',
				'wrap_after'  => '</div>',
			);
			rank_math_the_breadcrumbs( $rank_math_args );

		}
	}
}
add_action( 'kind_entry_header', 'kind_breadcrumbs' );

if ( ! function_exists( 'kind_entry_tags' ) ) {
	/**
	 * Entry Tags
	 */
	function kind_entry_tags() {

		if ( ! is_singular( array( 'post', 'project' ) ) ) {
			return;
		}

		$post_type = get_post_type( get_the_ID() );

		if ( ! get_theme_mod( $post_type . '_tags', true ) ) {
			return;
		}

		echo get_the_term_list(
			get_the_ID(),
			esc_attr( $post_type ) . '_tag',
			'<div class="single-post-terms tags-line">',
			', ',
			'</div>'
		);
	}
}

if ( ! function_exists( 'kind_entry_related' ) ) {
	/**
	 * Entry Related
	 */
	function kind_entry_related() {

		$post_type = get_post_type( get_the_ID() );

		if ( ! get_theme_mod( $post_type . '_related', true ) ) {
			return;
		}

		if ( 'post' === $post_type ) {
			$cat    = get_the_terms( get_the_ID(), 'category' );
			$pquery = new WP_Query(
				array(
					'post_type'      => 'post',
					'posts_per_page' => 5,
					'post__not_in'   => array( get_the_ID() ),
					'tax_query'      => array(
						array(
							'taxonomy' => 'category',
							'field'    => 'id',
							'terms'    => ( isset( $cat[0] ) ) ? $cat[0]->term_id : array(),
						),
					),
				)
			);

			if ( ! $pquery->have_posts() ) {
				$pquery = new WP_Query(
					array(
						'post_type'      => 'post',
						'posts_per_page' => 5,
						'post__not_in'   => array( get_the_ID() ),
					)
				);
			}

			kind_more_section( $pquery->posts, get_theme_mod( 'post_related_title', __( 'Related posts', 'kind' ) ), 'news', 'addon' );

		} elseif ( 'project' === $post_type ) {
			$pquery = new WP_Query(
				array(
					'post_type'      => 'project',
					'posts_per_page' => 5,
					'post__not_in'   => array( get_the_ID() ),
					'orderby'        => 'rand',
				)
			);

			if ( $pquery->have_posts() ) {
				kind_more_section( $pquery->posts, get_theme_mod( 'project_related_title', __( 'Related projects', 'kind' ) ), 'projects', 'addon' );
			}
		}
	}
}

if ( ! function_exists( 'kind_bottom_blocks' ) ) {
	/**
	 * Bottom Blocks
	 */
	function kind_bottom_blocks() {
		if ( ! defined( 'KIND_ADDONS_VER' ) ) {
			return;
		}

		if ( is_singular( 'post' ) && get_theme_mod( 'post_bottom_block' ) ) {
			$block_name = get_theme_mod( 'post_bottom_block' );
			$block      = get_page_by_path( $block_name, OBJECT, 'wp_block' );
			if ( $block ) {
				$content = $block->post_content;
				$content = apply_filters( 'the_content', $content );
				$content = str_replace( ']]>', ']]&gt;', $content );
				?>
				<div class="kind-signle-after-content">
					<div class="container entry-content the-content">
						<?php echo wp_kses_post( $content ); ?>
					</div>
				</div>
				<?php
			}
		}

		if ( is_singular( 'project' ) && get_theme_mod( 'project_bottom_block' ) ) {
			$block_name = get_theme_mod( 'project_bottom_block' );
			$block      = get_page_by_path( $block_name, OBJECT, 'wp_block' );
			if ( $block ) {
				$content = $block->post_content;
				$content = apply_filters( 'the_content', $content );
				$content = str_replace( ']]>', ']]&gt;', $content );
				?>
				<div class="kind-signle-after-content">
					<div class="container entry-content the-content">
						<?php echo wp_kses_post( $content ); ?>
					</div>
				</div>
				<?php
			}
		}

		if ( ( is_home() || is_category() || is_tag() ) && get_theme_mod( 'archive_bottom_block' ) ) {
			$block_name = get_theme_mod( 'archive_bottom_block' );
			$block      = get_page_by_path( $block_name, OBJECT, 'wp_block' );
			if ( $block ) {
				$content = $block->post_content;
				$content = apply_filters( 'the_content', $content );
				$content = str_replace( ']]>', ']]&gt;', $content );
				?>
				<div class="kind-archive-sidebar">
					<div class="container entry-content the-content">
						<?php echo wp_kses_post( $content ); ?>
					</div>
				</div>
				<?php
			}
		}

		if ( ( is_post_type_archive( 'project' ) || is_tax( 'project_tag' ) ) && get_theme_mod( 'projects_bottom_block' ) ) {
			$block_name = get_theme_mod( 'projects_bottom_block' );
			$block      = get_page_by_path( $block_name, OBJECT, 'wp_block' );
			if ( $block ) {
				$content = $block->post_content;
				$content = apply_filters( 'the_content', $content );
				$content = str_replace( ']]>', ']]&gt;', $content );
				?>
				<div class="kind-archive-sidebar">
					<div class="container entry-content the-content">
						<?php echo wp_kses_post( $content ); ?>
					</div>
				</div>
				<?php
			}
		}
	}
}

if ( ! function_exists( 'kind_screen_reader_alert' ) ) {
	/**
	 * Screen Reader Alert
	 */
	function kind_screen_reader_alert() {

		?>
		<span class="screen-reader-text kind-screen-reader-alert" role="alert"></span>
		<?php
	}
}

if ( ! function_exists( 'kind_button_totop' ) ) {
	/**
	 * Scroll To Top Button
	 */
	function kind_button_totop() {
		if ( get_theme_mod( 'button_totop', true ) ) {
			?>
			<a href="#" aria-hidden="true" tabindex="-1" class="kind-to-top">
				<?php kind_icon( 'up' ); ?>
			</a>
			<?php
		}
	}
}

if ( ! function_exists( 'kind_block_post_title' ) ) {
	/**
	 * Block post title
	 */
	function kind_block_post_title( $options = array() ) {
		if ( $options['title'] === false ) {
			return;
		}

		$title_class = 'kind-block-post-title';

		if ( isset( $options['titleFontWeight'] ) && $options['titleFontWeight'] != 'bold' ) {
			$title_class .= ' kind-font-weight-' . $options['titleFontWeight'];
		}

		$title = sprintf( the_title( '<h3 class="' . esc_attr( $title_class ) . '"><a href="%s">', '</a></h3>', false ), get_the_permalink() );

		return $title;
	}
}

if ( ! function_exists( 'kind_block_post_author' ) ) {
	/**
	 * Block post author
	 */
	function kind_block_post_author( $options = array() ) {
		if ( $options['author'] === false ) {
			return;
		}

		$avatar = '';
		if ( $options['avatar'] !== false ) {
			$avatar = get_avatar( get_the_author_meta( 'ID' ), '28' );
		}

		$author = '<div class="kind-block-post-author">
			<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" rel="author">
				' . $avatar . '
				' . get_the_author() . '
			</a>
		</div>';

		return $author;
	}
}

if ( ! function_exists( 'kind_block_post_date' ) ) {
	/**
	 * Block post date
	 */
	function kind_block_post_date( $options = array() ) {
		if ( $options['date'] === false ) {
			return;
		}

		$date_format = 'd.m.Y';
		if ( isset( $options['dateFormat'] ) ) {
			$date_format = $options['dateFormat'];
		}

		$date = get_the_time( $date_format );
		if ( $date_format === 'relative' ) {
			$date = human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) . ' ' . esc_html__( 'ago', 'kind' );
		}

		$post_date = '<time datetime="' . get_post_time( DATE_W3C ) . '" class="kind-block-post-date">' . esc_html( $date ) . '</time>';

		return $post_date;
	}
}

if ( ! function_exists( 'kind_block_post_excerpt' ) ) {
	/**
	 * Block post date
	 */
	function kind_block_post_excerpt( $options = array() ) {
		if ( $options['excerpt'] === false ) {
			return;
		}

		$length  = $options['excerptLength'];
		$excerpt = wp_strip_all_tags( get_the_excerpt() );

		if ( ! has_excerpt() ) {
			$excerpt = wp_trim_words( $excerpt, $length );
		}

		$excerpt = '<div class="kind-block-post-excerpt">' . esc_html( $excerpt ) . '</div>';

		return $excerpt;
	}
}

if ( ! function_exists( 'kind_block_post_thumbnail' ) ) {
	/**
	 * Block post thumbnail
	 */
	function kind_block_post_thumbnail( $options = array() ) {
		if ( $options['thumbnail'] === false && $options['thumbnail_link'] === true ) {
			return;
		}

		$image_size = 'post-thumbnail';
		if ( isset( $options['imageSize'] ) && $options['imageSize'] ) {
			$image_size = $options['imageSize'];
		}

		$thumbnail = '';
		if ( $options['thumbnail'] !== false ) {
			$thumbnail = get_the_post_thumbnail(
				null,
				$image_size,
				array(
					'alt'         => wp_trim_words( get_the_title(), 5 ),
					'aria-hidden' => 'true',
				)
			);
		}

		$link_start = '<span>';
		$link_end   = '</span>';
		if ( isset( $options['thumbnail_link'] ) && $options['thumbnail_link'] === true ) {
			if ( ! has_post_thumbnail() ) {
				return;
			}

			$link_start = '<a href="' . get_the_permalink() . '">';
			$link_end   = '</a>';
		}

		$orientation_class = '';
		if ( $options['layout'] !== 'type-3' ) {
			$orientation_class = ' kind-ratio-' . $options['imageOrientation'];
		}

		$thumbnail = '<div class="kind-block-featured-image' . $orientation_class . '">
			' . $link_start . '
				' . $thumbnail . '
			' . $link_end . '
		</div>';

		return $thumbnail;
	}
}

if ( ! function_exists( 'kind_block_post_category' ) ) {
	/**
	 * Block post category
	 */
	function kind_block_post_category( $options = array() ) {
		if ( $options['category'] === false ) {
			return;
		}

		$category = '<div class="kind-block-post-category">' . get_the_category_list( '&nbsp;&nbsp; ' ) . '</div>';

		return $category;
	}
}

if ( ! function_exists( 'kind_block_post_meta' ) ) {
	/**
	 * Block post meta
	 */
	function kind_block_post_meta( $options = array() ) {
		if ( $options['author'] === false && $options['date'] === false ) {
			return;
		}

		$post_meta = '<div class="kind-block-post-meta">
			' . kind_block_post_author( $options ) . '
			' . kind_block_post_date( $options ) . '
		</div>';

		return $post_meta;
	}
}

/** == Posts elements == **/
function kind_post_card( WP_Post $cpost ) {
	$pl = get_permalink( $cpost );
	?>
<article <?php post_class( 'flex-cell flex-md-6 flex-lg-4 tpl-post', $cpost ); ?>>
	<a href="<?php echo esc_url( $pl ); ?>" class="thumbnail-link">
		<div class="entry-preview"><?php echo kind_post_thumbnail( $cpost->ID, 'post-thumbnail' ); ?></div>
		<div class="entry-data">
			<h2 class="entry-title"><?php echo get_the_title( $cpost ); ?></h2>
		</div>
		<div class="entry-meta"><?php echo strip_tags( kind_posted_on( $cpost ), '<span><time>' ); ?></div>
	</a>
</article>
	<?php
}

function kind_related_post_card( WP_Post $cpost ) {
	$pl = get_permalink( $cpost );
	?>

<article <?php post_class( 'flex-cell flex-md-6 tpl-related-post', $cpost ); ?>>
	<a href="<?php echo esc_url( $pl ); ?>" class="entry-link">
		<div class="entry-preview"><?php echo kind_post_thumbnail( $cpost->ID, 'post-thumbnail' ); ?></div>
		<div class="entry-data">
			<h2 class="entry-title"><?php echo get_the_title( $cpost ); ?></h2>
		</div>
	<?php if ( 'project' != $cpost->post_type ) { ?>
		<div class="entry-meta"><?php echo strip_tags( kind_posted_on( $cpost ), '<span><time>' ); ?></div>
	<?php } ?>
	</a>
</article>
	<?php
}

function kind_related_post_link( WP_Post $cpost ) {
	$pl = get_permalink( $cpost );
	?>
<a href="<?php echo esc_url( $pl ); ?>" class="entry-link"><?php echo get_the_title( $cpost ); ?></h4></a>
	<?php
}

/** Excerpt **/
function kind_get_post_excerpt( $cpost, $l = 30, $force_l = false ) {
	if ( is_int( $cpost ) ) {
		$cpost = get_post( $cpost );
	}

	$e = ( ! empty( $cpost->post_excerpt ) ) ? $cpost->post_excerpt : wp_trim_words(
		strip_shortcodes( $cpost->post_content ),
		$l
	);
	if ( $force_l ) {
		$e = wp_trim_words( $e, $l );
	}

	return $e;
}

/** Deafult thumbnail for posts **/
function kind_post_thumbnail( $post_id, $size = 'post-thumbnail' ) {
	$thumb = get_the_post_thumbnail( $post_id, $size );

	return $thumb;
}

function kind_post_thumbnail_src( $post_id, $size = 'post-thumbnail' ) {
	$src = get_the_post_thumbnail_url( $post_id, $size );

	return $src;
}

function kind_single_post_thumbnail( $post_id, $size = 'post-thumbnail', $post_format = 'standard' ) {
	$thumb_id = get_post_thumbnail_id( $post_id );
	if ( ! $thumb_id ) {
		return;
	}

	$thumb = get_post( $thumb_id );
	$cap   = ( ! empty( $thumb->post_excerpt ) ) ? $thumb->post_excerpt : get_post_meta(
		$thumb_id,
		'_wp_attachment_image_alt',
		true
	); // to_do: make this real

	if ( $post_format == 'standard' ) {
		?>
	<figure class="wp-caption alignnone">
		<?php echo wp_get_attachment_image( $thumb_id, $size ); ?>
		<?php if ( ! empty( $cap ) ) { ?>
			<figcaption class="wp-caption-text"><?php echo apply_filters( 'kind_the_title', $cap ); ?></figcaption>
		<?php } ?>
	</figure>
		<?php
	} elseif ( $post_format == 'introimg' ) {
		?>
	<figure class="introimg-figure">
		<div class="introimg">
			<div class="tpl-pictured-bg" style="background-image: url(<?php echo get_the_post_thumbnail_url( $post_id, $size ); ?>);" ></div>
		</div>
		<?php if ( ! empty( $cap ) ) { ?>
			<figcaption class="wp-caption-text"><?php echo apply_filters( 'kind_the_title', $cap ); ?></figcaption>
		<?php } ?>
	</figure>
		<?php
	}
}
