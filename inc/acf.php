<?php
/**
 * ACF Options page
 *
 * @link https://www.advancedcustomfields.com/resources/options-page/
 */
if ( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page( 'Theme Settings' );
}

/**
 * ACF Extended: Page Builder layout thumbnails (dist/img/acfe-thumbnails/{layout}.jpg)
 *
 * @link https://wpsocket.com/plugin/acf-extended/faq/
 */
global $ACFE_SECTION_BUILDERS;
$ACFE_SECTION_BUILDERS = array(
	// existing flexible content layouts:
	'hero',
	'partnership',
	'faq',
	'counter',
	'contact_form',
	'follow',
	'latest_resources',
	'simple_blocks',
	'testimonials',
	'stars',
	'banner',
	'cta',
	'simple_content',
	'simple_slider',
	'simple_table',
	'cells',
	'media',
	'locations',
);

if ( $ACFE_SECTION_BUILDERS && count( $ACFE_SECTION_BUILDERS ) > 0 && is_admin() ) {
	foreach ( $ACFE_SECTION_BUILDERS as $layout ) {
		add_filter( 'acfe/flexible/thumbnail/layout=' . $layout, 'acf_flexible_layout_thumbnail', 10, 3 );
	}
}
function acf_flexible_layout_thumbnail( $thumbnail, $field, $layout ) {
	$layout_name = $layout['name'];
	$path        = IT_IMG . 'acfe-thumbnails/' . $layout_name . '.jpg'; // recommended image size: 400x320px

	return $path;
}

/**
 * Disable ACFE Modules that not needed
 */
add_action( 'acfe/init', 'it_acfe_modules' );
function it_acfe_modules() {
	acf_update_setting( 'acfe/modules/ui', false );
	acf_update_setting( 'acfe/modules/taxonomies', false );
	acf_update_setting( 'acfe/modules/post_types', false );
	acf_update_setting( 'acfe/modules/author', false );
	acf_update_setting( 'acfe/modules/block_types', false );
	acf_update_setting( 'acfe/modules/forms', false );
	acf_update_setting( 'acfe/modules/multilang', false );
	acf_update_setting( 'acfe/modules/options', false );
	acf_update_setting( 'acfe/modules/options_pages', false );
	acf_update_setting( 'acfe/modules/categories', false );
}
