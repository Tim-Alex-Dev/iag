<?php
/**
 * Customise login screen
 *
 * @link https://codex.wordpress.org/Customizing_the_Login_Form
 *
 * @package _it_start
 */

/**
 * Changing the logo link from wordpress.org to root domain
 */
function it_login_url() {
	return home_url();
}

add_filter( 'login_headerurl', 'it_login_url' );

/**
 * Changing the alt text on the logo to show your site name
 */
function it_login_title() {
	return get_option( 'blogname' );
}

add_filter( 'login_headertext', 'it_login_title' );

/**
 * Styles for login page
 */
function it_login_stylesheet() {
	wp_enqueue_style( 'it-login', IT_CSS . 'login.css' );
}

add_action( 'login_enqueue_scripts', 'it_login_stylesheet' );
