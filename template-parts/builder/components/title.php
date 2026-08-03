<?php
$class     = isset( $args['class'] ) ? $args['class'] : '';
$title     = get_sub_field( 'module_title' );
$tag       = ! empty( get_sub_field( 'module_title_tag' ) ) ? get_sub_field( 'module_title_tag' ) : 'h2'; // possible values: h1-h6, span
if ( $title ) {
	echo sprintf( '<%s class="module-header__title %s">%s</%s>',
		esc_attr( $tag ),
		esc_attr( $class ),
		wp_kses_post( $title ),
		esc_attr( $tag )
	);
} ?>