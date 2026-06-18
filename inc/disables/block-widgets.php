<?php
/**
 * Restoring the classic Widgets Editor
 */
function it_theme_support() {
	remove_theme_support( 'widgets-block-editor' );
}
add_action( 'after_setup_theme', 'it_theme_support' );
