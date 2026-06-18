<?php
/**
 * Disable XMLRPC
 *
 * @package _iag
 */
add_filter( 'xmlrpc_enabled', '__return_false' );
