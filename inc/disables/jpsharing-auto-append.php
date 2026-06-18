<?php
/**
 * Disable auto append of sharing buttons after content and excerpt
 *
 * @package _it_start
 */

add_action( 'init', 'it_disable_jpsharing_append' );
/**
 * Remove filters of jpsharing
 *
 * @return void
 */
function it_disable_jpsharing_append() {
	remove_filter( 'the_content', 'sharing_display', 19 );
	remove_filter( 'the_excerpt', 'sharing_display', 19 );
}
