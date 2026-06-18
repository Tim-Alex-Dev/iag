<?php
/**
 * Editor modification
 *
 * @link https://codex.wordpress.org/TinyMCE_Custom_Styles
 *
 * @package _it_start
 */

/**
 * Registers an editor stylesheet for the theme.
 */
add_action( 'admin_init', 'it_wpdocs_theme_add_editor_styles' );
function it_wpdocs_theme_add_editor_styles() {
	add_editor_style( IT_CSS . 'editor-styles.css' );
}

// Add TinyMCE style formats.
add_filter( 'mce_buttons_2', 'it_tiny_mce_style_formats' );
function it_tiny_mce_style_formats( $styles ) {
	array_unshift( $styles, 'styleselect' );

	return $styles;
}

add_filter( 'tiny_mce_before_init', 'it_tiny_mce_before_init_formats' );
function it_tiny_mce_before_init_formats( $settings ) {

	// Define the style_formats array
	$style_formats = [
		[
			'title' => 'Titles',
			'items' => [
				[
					'title'    => 'H1',
					'selector' => 'p,h1,h2,h3,h4,h5,h6',
					'classes'  => 'h1',
				],
				[
					'title'    => 'H2',
					'selector' => 'p,h1,h2,h3,h4,h5,h6',
					'classes'  => 'h2',
				],
				[
					'title'    => 'H3',
					'selector' => 'p,h1,h2,h3,h4,h5,h6',
					'classes'  => 'h3',
				],
				[
					'title'    => 'H4',
					'selector' => 'p,h1,h2,h3,h4,h5,h6',
					'classes'  => 'h4',
				],
				[
					'title'    => 'H5',
					'selector' => 'p,h1,h2,h3,h4,h5,h6',
					'classes'  => 'h5',
				],
				[
					'title'    => 'H6',
					'selector' => 'p,h1,h2,h3,h4,h5,h6',
					'classes'  => 'h6',
				],
			]
		],
		[
			'title' => 'Text',
			'items' => [
				[
					'title'    => 'Text (lg)',
					'selector' => 'p,h1,h2,h3,h4,h5,h6',
					'classes'  => 'text-lg',
				],
				[
					'title'    => 'Text (sm)',
					'selector' => 'p,h1,h2,h3,h4,h5,h6',
					'classes'  => 'text-sm',
				],
			],
		],
		[
			'title' => 'Buttons',
			'items' => [
				[
					'title'    => 'Button (primary)',
					'selector' => 'a',
					'classes'  => 'btn',
					'wrapper'  => false,
				],
				[
					'title'    => 'Button (outline)',
					'selector' => 'a',
					'classes'  => 'btn btn-outline',
					'wrapper'  => false,
				],
				[
					'title'    => 'Button Group',
					'classes'  => 'btn-group', // custom admin styles for this class added in editor-style.scss
					'selector' => 'p',
				],
			]
		],
		[
			'title' => 'Lists',
			'items' => [
				[
					'title'    => 'List (checked)',
					'classes'  => 'list-check',
					'selector' => 'ul',
					'wrapper'  => false,
				],
				[
					'title'    => 'List (dotted)',
					'classes'  => 'list-dot',
					'selector' => 'ul',
					'wrapper'  => false,
				],
				[
					'title'    => 'List (numbered)',
					'classes'  => 'list-number',
					'selector' => 'ol',
					'wrapper'  => false,
				],
			]
		],
	];

	if ( isset( $settings['style_formats'] ) ) {
		$orig_style_formats = json_decode( $settings['style_formats'], true );
		$style_formats      = array_merge( $orig_style_formats, $style_formats );
	}

	$settings['style_formats'] = json_encode( $style_formats );

	return $settings;
}

/**
 * Add custom colors to TinyMCE editor text color selector
 */
add_filter( 'tiny_mce_before_init', 'it_tiny_mce_before_init_colors' );
function it_tiny_mce_before_init_colors( $init ) {
	// By using the same array keys as the default values you'll override (replace) them
	$custom_colors = [
		'Black'   => '000',
		'White'   => 'fff',
		'Grey'    => 'ccc',
		'Primary' => 'b91c1c'
	];

	$textcolor_map = [];
	foreach ( $custom_colors as $name => $color ) {
		$textcolor_map[] = "\"$color\", \"$name\"";
	}

	if ( ! empty( $textcolor_map ) ) {
		$init['textcolor_map']  = '[' . implode( ', ', $textcolor_map ) . ']';
		$init['textcolor_rows'] = 6; // expand color grid to 6 rows
	}

	return $init;
}
