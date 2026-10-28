<?php
/**
 * Scripts and styles
 *
 * @package _iag
 */

// Version of a built file (path relative to dist/) = its modification time: browsers reload it only after a new build
function it_asset_ver( $file ) {
	$path = IT_DIR . '/dist/' . ltrim( $file, '/' );

	return file_exists( $path ) ? filemtime( $path ) : wp_get_theme()->get( 'Version' );
}

function it_scripts() {
	wp_enqueue_style( 'theme-styles', IT_CSS . 'main.css', [], it_asset_ver( 'css/main.css' ) );

	wp_enqueue_script( 'theme-js', IT_JS . 'main.js', [ 'jquery' ], it_asset_ver( 'js/main.js' ), true );
	wp_localize_script( 'theme-js', 'itSettings', [
		'ajaxUrl' => admin_url( 'admin-ajax.php' ),
		'nonce'   => wp_create_nonce( 'ajax-nonce' ),
		'jsUrl'   => IT_JS, // where the on-demand modules are (dist/js/), see assets/js/public-path.js
	] );
}

add_action( 'wp_enqueue_scripts', 'it_scripts' );

// Fonts of the first screen (h1 = Avenir Heavy, text = Avenir Book) start downloading with the CSS, not after it
add_action( 'wp_head', function () {
	foreach ( [ 'Avenir-Heavy', 'Avenir-Book' ] as $font ) {
		printf( '<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n", esc_url( IT_URL . '/dist/fonts/' . $font . '.woff2' ) );
	}
}, 1 );

// CookieYes banner script deferred (runs after the HTML is parsed, still before DOMContentLoaded): no render-blocking
// script in <head>. Safe while it blocks nothing itself: the tracking tags (GA4, Clarity, HubSpot, RB2B) are loaded only
// after consent by the cookie consent helper in header.php.
add_action( 'wp_enqueue_scripts', function () {
	if ( wp_script_is( 'cookie-law-info', 'registered' ) ) {
		wp_script_add_data( 'cookie-law-info', 'strategy', 'defer' );
	}
}, 20 );

// Front end: jQuery in the footer, not a render-blocking script in <head> (jQuery Migrate is off: inc/disables/jquery-migrate.php)
add_action( 'wp_enqueue_scripts', function () {
	wp_scripts()->add_data( 'jquery', 'group', 1 );
	wp_scripts()->add_data( 'jquery-core', 'group', 1 );
}, 1 );

add_action( 'admin_enqueue_scripts', function () {
	wp_enqueue_style( 'admin-styles', IT_CSS . 'admin-styles.css', [], it_asset_ver( 'css/admin-styles.css' ) );
	wp_enqueue_script( 'admin-js', IT_JS . 'admin.js', [ 'jquery' ], it_asset_ver( 'js/admin.js' ), true );
	wp_localize_script( 'admin-js', 'wpAdminSettings', [
		'nonce' => wp_create_nonce( 'ajax-admin-nonce' ), // the admin AJAX URL is the global `ajaxurl` of WordPress
	] );
}, 99 );
