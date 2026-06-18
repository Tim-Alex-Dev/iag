<?php
/**
 * General recommended updates
 *
 * @package _it_start
 */

/**
 * Remove WordPress version from head tag
 */
remove_action( 'wp_head', 'wp_generator' );
