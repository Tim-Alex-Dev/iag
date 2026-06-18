<?php
/**
 * Disable XMLRPC
 *
 * @package _it_start
 */
add_filter( 'xmlrpc_enabled', '__return_false' );
