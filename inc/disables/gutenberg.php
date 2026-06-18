<?php
/**
 * Disable gutenberg stuff
 *
 * @package _it_start
 */

/**
 * Disable Gutenberg block styles
 */
add_action( 'wp_enqueue_scripts', 'it_remove_block_css', 100 );
function it_remove_block_css() {
	wp_dequeue_style( 'wp-block-library' );
}

add_action( 'init', 'custom_wp_remove_global_css' );
function custom_wp_remove_global_css() {
	remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
	remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );
}

add_filter('use_block_editor_for_post', '__return_false', 10);
