<?php
/**
 * The template for displaying the 404 template.
 *
 * @package KiND
 */

get_header();
?>

<div class="page-header">
	<div class="container">
		<div class="text-column">
			<h1 class="page-title"><?php esc_html_e( 'Error 404', 'kind' ); ?></h1>
			<div class="page-intro"><?php esc_html_e( 'Page not found', 'kind' ); ?></div>
		</div>
	</div>
</div>

<div class="page-content err404-content">
	<div class="container">
		<div class="the-content text-column err-404-text">
			<p><?php esc_html_e( 'Unfortunately this page has been removed or never exists. Please, use the search field to find the information you need or visit the homepage.', 'kind' ); ?>
		</div>
	</div>
	<div class="widget-full widget_search search-holder">
		<?php get_search_form(); ?>
	</div>
</div>

<?php
get_footer();
