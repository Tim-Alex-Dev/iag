<?php
/**
 * Disabling some WordPress core features to improve performance and security
 *
 * @package _it_start
 */

require IT_DIR . '/inc/disables/admin-bar.php';
require IT_DIR . '/inc/disables/auto-updates.php';
require IT_DIR . '/inc/disables/basic.php';
require IT_DIR . '/inc/disables/block-widgets.php';
//require IT_DIR . '/inc/disables/comments.php';
require IT_DIR . '/inc/disables/dashboard-widgets.php';
require IT_DIR . '/inc/disables/emoji.php';
require IT_DIR . '/inc/disables/gutenberg.php';
require IT_DIR . '/inc/disables/jpsharing-auto-append.php';
//require IT_DIR . '/inc/disables/theme-plugin-editor.php';
require IT_DIR . '/inc/disables/wp-embeds.php';
require IT_DIR . '/inc/disables/xmlrpc.php';
