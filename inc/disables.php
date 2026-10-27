<?php
/**
 * WordPress core features the theme does not use (one file per feature): comment out a require to keep the feature
 *
 * @package _iag
 */

require IT_DIR . '/inc/disables/admin-bar.php';
require IT_DIR . '/inc/disables/auto-updates.php';
require IT_DIR . '/inc/disables/basic.php';
require IT_DIR . '/inc/disables/comments.php';
require IT_DIR . '/inc/disables/dashboard-widgets.php';
require IT_DIR . '/inc/disables/emoji.php';
require IT_DIR . '/inc/disables/gutenberg.php';
require IT_DIR . '/inc/disables/jquery-migrate.php'; // checked: no front-end plugin or theme code needs jQuery Migrate
//require IT_DIR . '/inc/disables/theme-plugin-editor.php';
require IT_DIR . '/inc/disables/wp-embeds.php';
require IT_DIR . '/inc/disables/xmlrpc.php';
