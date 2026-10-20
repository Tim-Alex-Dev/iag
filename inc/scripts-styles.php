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

// Front end: jQuery in the footer, not a render-blocking script in <head> (jQuery Migrate is off: inc/disables/jquery-migrate.php)
add_action( 'wp_enqueue_scripts', function () {
	wp_scripts()->add_data( 'jquery', 'group', 1 );
	wp_scripts()->add_data( 'jquery-core', 'group', 1 );
}, 1 );

/**
 * Analytics and marketing tags (Google Analytics 4, Microsoft Clarity, HubSpot tracking). Their queues (gtag, clarity)
 * start in <head> at once, the scripts themselves load on the first user interaction (mouse, touch, key, scroll):
 * they no longer compete with the first render and the main thread on page load (Lighthouse TBT / LCP).
 */
function it_third_party_tags() {
	$ga4_id     = 'G-VPPRV7J2ZE';
	$clarity_id = 'xbzyzucf2o';
	$hubspot_id = '144692094';

	$scripts = [
		[ 'src' => 'https://www.googletagmanager.com/gtag/js?id=' . $ga4_id ],
		[ 'src' => 'https://www.clarity.ms/tag/' . $clarity_id ],
		[ 'src' => 'https://js-eu1.hs-scripts.com/' . $hubspot_id . '.js', 'id' => 'hs-script-loader' ],
	];

	$js = <<<'JS'
window.dataLayer = window.dataLayer || [];
function gtag() { dataLayer.push(arguments); }
gtag('js', new Date());
gtag('config', '%1$s');
window.clarity = window.clarity || function () { (window.clarity.q = window.clarity.q || []).push(arguments); };
(function (scripts) {
	var events = ['mousemove', 'pointerdown', 'touchstart', 'keydown', 'scroll', 'wheel'];
	var load = function () {
		events.forEach(function (event) { window.removeEventListener(event, load, {passive: true}); });
		scripts.forEach(function (item) {
			var script = document.createElement('script');
			script.async = true;
			script.src = item.src;
			if (item.id) { script.id = item.id; }
			document.head.appendChild(script);
		});
	};
	events.forEach(function (event) { window.addEventListener(event, load, {once: true, passive: true}); });
})(%2$s);
JS;

	wp_print_inline_script_tag( sprintf( $js, esc_js( $ga4_id ), wp_json_encode( $scripts, JSON_UNESCAPED_SLASHES ) ), [ 'id' => 'it-third-party-tags' ] );
}

add_action( 'wp_head', 'it_third_party_tags', 20 );

add_action( 'admin_enqueue_scripts', function () {
	wp_enqueue_style( 'admin-styles', IT_CSS . 'admin-styles.css', [], it_asset_ver( 'css/admin-styles.css' ) );
	wp_enqueue_script( 'admin-js', IT_JS . 'admin.js', [ 'jquery' ], it_asset_ver( 'js/admin.js' ), true );
	wp_localize_script( 'admin-js', 'wpAdminSettings', [
		'nonce' => wp_create_nonce( 'ajax-admin-nonce' ), // the admin AJAX URL is the global `ajaxurl` of WordPress
	] );
}, 99 );
