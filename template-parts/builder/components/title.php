<?php
/**
 * Module title: fields module_title + module_title_tag of the current module row. $args['class']: extra class
 */
$title   = get_sub_field( 'module_title' );
$tag     = get_sub_field( 'module_title_tag' );
$tag     = in_array( $tag, [ 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'span' ], true ) ? $tag : 'h2';
$classes = trim( 'module-header__title ' . ( $args['class'] ?? '' ) );

if ( $title ) {
	printf( '<%1$s class="%2$s">%3$s</%1$s>', tag_escape( $tag ), esc_attr( $classes ), wp_kses_post( $title ) );
}
