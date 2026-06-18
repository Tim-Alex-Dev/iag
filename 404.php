<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package _it_start
 */

get_header();
?>

<div class="container">

	<section class="not-found">
		<h1 class="h3 not-found__title"><?php esc_html_e( 'Page not found.', '_it_start' ); ?></h1>
		<p class="not-found__text"><?php esc_html_e( 'Sorry, the page you were looking for doesn\'t exist or has been moved.', '_it_start' ); ?></p>
		<a href="<?php echo home_url('/') ?>" class="btn btn-primary"><?php esc_html_e( 'Back to homepage', '_it_start' ); ?></a>
	</section>

</div>

<?php
get_footer();
