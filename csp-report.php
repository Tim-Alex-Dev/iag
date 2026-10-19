<?php
/**
 * CSP violation report endpoint.
 *
 * Receives Content-Security-Policy(-Report-Only) violation reports from browsers
 * and appends them, one JSON object per line, to a log file that is NOT web-accessible.
 *
 * Endpoint (after deploy):
 *   https://www.ia-grp.com/wp-content/themes/iag/csp-report.php
 *
 * Log file (Cloudways app root, outside public_html):
 *   private_html/csp-reports.log   (download via SFTP)
 *
 * Safeguards: POST only, request body capped at 64 KB, log capped at 5 MB
 * (further reports are dropped until the log is rotated or deleted).
 */

const IAG_CSP_MAX_BODY = 65536;
const IAG_CSP_MAX_LOG  = 5242880;

if ( 'POST' !== ( $_SERVER['REQUEST_METHOD'] ?? '' ) ) {
	http_response_code( 405 );
	header( 'Allow: POST' );
	exit;
}

$iag_csp_body = file_get_contents( 'php://input', false, null, 0, IAG_CSP_MAX_BODY + 1 );

if ( false === $iag_csp_body || '' === $iag_csp_body || strlen( $iag_csp_body ) > IAG_CSP_MAX_BODY ) {
	http_response_code( 400 );
	exit;
}

$iag_csp_report = json_decode( $iag_csp_body, true );

if ( ! is_array( $iag_csp_report ) ) {
	http_response_code( 400 );
	exit;
}

// theme dir -> themes -> wp-content -> public_html -> application root.
$iag_csp_dir = dirname( __DIR__, 4 ) . '/private_html';
$iag_csp_log = $iag_csp_dir . '/csp-reports.log';

if ( ! is_dir( $iag_csp_dir ) || ! is_writable( $iag_csp_dir ) ) {
	http_response_code( 500 );
	exit;
}

clearstatcache( true, $iag_csp_log );
if ( file_exists( $iag_csp_log ) && filesize( $iag_csp_log ) >= IAG_CSP_MAX_LOG ) {
	http_response_code( 204 );
	exit;
}

$iag_csp_entry = array(
	'time'       => gmdate( 'c' ),
	'user_agent' => substr( (string) ( $_SERVER['HTTP_USER_AGENT'] ?? '' ), 0, 300 ),
	'report'     => $iag_csp_report,
);

file_put_contents(
	$iag_csp_log,
	json_encode( $iag_csp_entry, JSON_UNESCAPED_SLASHES ) . "\n",
	FILE_APPEND | LOCK_EX
);

http_response_code( 204 );
