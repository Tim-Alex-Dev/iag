<?php
/**
 * IT Starter functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package _iag
 */

add_filter( 'wpcf7_autop_or_not', '__return_false' );
add_filter( 'wpcf7_load_css', '__return_false' );

define( 'IT_DIR', get_template_directory() );
define( 'IT_URL', get_template_directory_uri() );
define( 'IT_DIST', get_template_directory_uri() . '/dist/' );
define( 'IT_CSS', get_template_directory_uri() . '/dist/css/' );
define( 'IT_JS', get_template_directory_uri() . '/dist/js/' );
define( 'IT_IMG', get_template_directory_uri() . '/dist/img/' );
define( 'JUST_PIXEL', 'data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==' );

require IT_DIR . '/inc/after-theme-setup.php'; // all hooks that needs to be done on after_theme_setup
require IT_DIR . '/inc/acf.php'; // ACF related functions
require IT_DIR . '/inc/ajax.php'; // AJAX functions
require IT_DIR . '/inc/custom-post-type.php'; // Custom post types
require IT_DIR . '/inc/disables.php'; // Disable of extra unwanted features
require IT_DIR . '/inc/editor.php'; // Editor functions
require IT_DIR . '/inc/help-func.php'; // Helper functions
require IT_DIR . '/inc/lazy-load.php'; // Images and iframes lazyload
require IT_DIR . '/inc/login.php'; // Login screen customisation
require IT_DIR . '/inc/scripts-styles.php'; // Scripts and styles enqueue | dequeue
require IT_DIR . '/inc/svg-support.php'; // Adds support for SVG upload
require IT_DIR . '/inc/widgets.php'; // Sidebars and widgets
require IT_DIR . '/inc/walker.php'; // Custom Menu Walker

if ( class_exists( 'WooCommerce' ) ) {
	require IT_DIR . '/inc/woo.php'; // Woocommerce functions
}
