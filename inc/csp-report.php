<?php
/**
 * CSP violation reports
 *
 * Endpoint for the Content-Security-Policy(-Report-Only) header:
 *   report-uri https://www.ia-grp.com/wp-json/iag/v1/csp-report
 *
 * Direct PHP files in the theme folder are blocked by the server (403), so reports
 * go through the REST API. Each report is appended as one JSON line to
 * <application root>/private_html/csp-reports.log, which is not web-accessible
 * (download it via SFTP). No IP addresses are stored.
 */

const IT_CSP_MAX_BODY = 65536;   // bytes per request
const IT_CSP_MAX_LOG  = 5242880; // log size; further reports are dropped until the log is cleared

add_action( 'rest_api_init', 'it_csp_register_route' );
function it_csp_register_route() {
	register_rest_route(
		'iag/v1',
		'/csp-report',
		array(
			'methods'             => 'POST',
			'callback'            => 'it_csp_store_report',
			'permission_callback' => '__return_true', // browsers send reports anonymously
		)
	);
}

/**
 * Browsers send "application/csp-report" (report-uri) or "application/reports+json"
 * (Reporting API), which WordPress does not parse, so the raw body is decoded here.
 */
function it_csp_store_report( WP_REST_Request $request ) {
	$body = $request->get_body();

	if ( '' === $body || strlen( $body ) > IT_CSP_MAX_BODY ) {
		return new WP_REST_Response( null, 400 );
	}

	$report = json_decode( $body, true );

	if ( ! is_array( $report ) ) {
		return new WP_REST_Response( null, 400 );
	}

	$dir  = dirname( untrailingslashit( ABSPATH ) ) . '/private_html';
	$file = $dir . '/csp-reports.log';

	if ( ! is_dir( $dir ) || ! is_writable( $dir ) ) {
		return new WP_REST_Response( null, 500 );
	}

	clearstatcache( true, $file );
	if ( file_exists( $file ) && filesize( $file ) >= IT_CSP_MAX_LOG ) {
		return new WP_REST_Response( null, 204 );
	}

	$entry = array(
		'time'       => gmdate( 'c' ),
		'user_agent' => substr( (string) $request->get_header( 'user_agent' ), 0, 300 ),
		'report'     => $report,
	);

	file_put_contents( $file, wp_json_encode( $entry, JSON_UNESCAPED_SLASHES ) . "\n", FILE_APPEND | LOCK_EX );

	return new WP_REST_Response( null, 204 );
}
