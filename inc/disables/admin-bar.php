<?php
/**
 * Admin Bar modifications
 *
 * @package _it_start
 */

add_action( 'wp_before_admin_bar_render', 'it_clear_admin_bar' );
/**
 * Remove WP logo
 */
function it_clear_admin_bar() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu( 'wp-logo' );
}
