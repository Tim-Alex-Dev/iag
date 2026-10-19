<?php
/**
 * CSP Violation Report Endpoint
 * 
 * Receives Content-Security-Policy violation reports and logs them.
 * Reports are saved to wp-content/csp-reports.log
 * 
 * Usage: Add this to your CSP header:
 * Content-Security-Policy-Report-Only: ... report-uri https://www.ia-grp.com/wp-content/themes/flavor/csp-report.php
 */

// Only accept POST requests with JSON content
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method not allowed');
}

// Get the raw POST data
$data = file_get_contents('php://input');

if (empty($data)) {
    http_response_code(400);
    exit('No data received');
}

// Validate it's JSON
$json = json_decode($data, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(400);
    exit('Invalid JSON');
}

// Log file path (outside web root would be better, but this works for WordPress)
$log_file = dirname(__FILE__) . '/../../csp-reports.log';

// Format the log entry
$log_entry = [
    'timestamp' => date('Y-m-d H:i:s'),
    'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
    'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown',
    'report' => $json
];

// Append to log file
$result = file_put_contents(
    $log_file,
    json_encode($log_entry) . "\n",
    FILE_APPEND | LOCK_EX
);

if ($result === false) {
    http_response_code(500);
    exit('Failed to write log');
}

// Return 204 No Content (standard response for report endpoints)
http_response_code(204);
