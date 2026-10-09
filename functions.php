<?php
/**
 * Theme constants and modules (inc/)
 *
 * @package _iag
 */

define( 'IT_DIR', get_template_directory() );
define( 'IT_URL', get_template_directory_uri() );
define( 'IT_CSS', IT_URL . '/dist/css/' );
define( 'IT_JS', IT_URL . '/dist/js/' );
define( 'IT_IMG', IT_URL . '/dist/img/' );

require IT_DIR . '/inc/after-theme-setup.php'; // theme supports, menus, small front-end filters
require IT_DIR . '/inc/acf.php'; // ACF options page, Page Builder layout previews
require IT_DIR . '/inc/custom-post-type.php'; // Expert, Leadership, Resource + taxonomies
require IT_DIR . '/inc/disables.php'; // WordPress features the theme does not use
require IT_DIR . '/inc/editor.php'; // classic editor formats and colors
require IT_DIR . '/inc/help-func.php'; // template helpers
require IT_DIR . '/inc/login.php'; // login screen
require IT_DIR . '/inc/scripts-styles.php'; // scripts and styles
require IT_DIR . '/inc/seo.php'; // Source archives pagination, security headers
require IT_DIR . '/inc/svg-support.php'; // safe SVG uploads
require IT_DIR . '/inc/walker.php'; // header mega menu walker
