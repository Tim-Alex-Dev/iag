<?php
/**
 * Include scripts and styles into theme
 *
 * @link https://developer.wordpress.org/reference/functions/wp_register_style/
 * @link https://developer.wordpress.org/reference/functions/wp_register_script/
 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_style/
 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_script/
 * @link https://developer.wordpress.org/reference/functions/wp_dequeue_style/
 * @link https://developer.wordpress.org/reference/functions/wp_dequeue_script/
 *
 * @package _it_start
 */


/**
 * Enqueue scripts and styles.
 */
function it_scripts() {
	$ver = time(); // time() - value for development, '1.0.0' - format for production

	/**
	 * Global Styles
	 */
	wp_enqueue_style( 'theme-styles', IT_CSS . 'main.css', [], $ver );

	/**
	 * Global JavaScript
	 */
	wp_enqueue_script( 'theme-js', IT_JS . 'main.js', [ 'jquery' ], $ver, true );
	wp_localize_script( 'theme-js', 'wpApiSettings', [
		'ajaxUrl' => admin_url( 'admin-ajax.php' ),
		'nonce'    => wp_create_nonce( 'ajax-nonce' )
	] );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'it_scripts' );

// Enqueue admin scripts
add_action( 'admin_enqueue_scripts', function () {
	wp_enqueue_style( 'admin-styles', IT_CSS . 'admin-styles.css' );
	wp_enqueue_script( 'admin-js', IT_JS . 'admin.js' );
	wp_localize_script( 'admin-js', 'wpAdminSettings', [
		// WP already has global variable 'ajaxurl' for backend
		'nonce' => wp_create_nonce( 'ajax-admin-nonce' )
	] );
}, 99 );
