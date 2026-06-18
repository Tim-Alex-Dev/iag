<?php
/**
 * General recommended updates
 *
 * @package _iag
 */

/**
 * Remove WordPress version from head tag
 */
remove_action( 'wp_head', 'wp_generator' );
