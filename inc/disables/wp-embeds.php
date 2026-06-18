<?php
/**
 * Disable wp-embed.js
 */
function it_wpembed_deregister_scripts() {
	wp_dequeue_script( 'wp-embed' );
}
add_action( 'wp_footer', 'it_wpembed_deregister_scripts' );
