<?php
$class     = isset( $args['class'] ) ? $args['class'] : 'h2';
$title     = get_sub_field( 'module_title' );
$tag       = ! empty( get_sub_field( 'module_title_tag' ) ) ? get_sub_field( 'module_title_tag' ) : 'h2'; // possible values: h1-h6, span
$alignment = get_sub_field( 'module_title_alignment' ) ? get_sub_field( 'module_title_alignment' ) : 'left'; // possible values: left, center, right
if ( $title ) {
	echo sprintf( '<%s class="%s c-title text-%s">%s</%s>',
		esc_attr( $tag ),
		esc_attr( $class ),
		esc_attr( $alignment ),
		wp_kses_post( $title ),
		esc_attr( $tag )
	);
} ?>