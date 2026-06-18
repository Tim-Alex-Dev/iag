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
 * AFC Extended thumbnails
 *
 * @link https://wpsocket.com/plugin/acf-extended/faq/
 */
global $ACFE_SECTION_BUILDERS;
$ACFE_SECTION_BUILDERS = array(
	// existing flexible content layouts:
	//'hero',   // example
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
 * Add Google Map API key
 */
function it_acf_init() {
	$google_maps_api_key = get_field( 'google_maps_api_key', 'option' );
	if ( $google_maps_api_key ) {
		acf_update_setting( 'google_api_key', $google_maps_api_key );
	}
}

add_action( 'acf/init', 'it_acf_init' );

/**
 * Sanitize Anchor ID field before saving
 */
add_action( 'acf/save_post', 'it_acf_sanitize_anchor_id' );
function it_acf_sanitize_anchor_id( $post_id ) {

	$builder = get_field( 'builder', $post_id );
	if ( ! empty( $builder ) ) {
		foreach ( $builder as $k => $row ) {
			if ( $row['acf_fc_layout'] === 'anchor' ) {
				$value     = $row['anchor_id'];
				$new_value = sanitize_title( $value );
				update_post_meta( $post_id, 'builder_' . $k . '_anchor_id', $new_value );
			}
		}
	}
}

/**
 * Disable ACFE Modules that not needed
 */
add_action('acfe/init', 'it_acfe_modules');
function it_acfe_modules(){
	acf_update_setting('acfe/modules/ui', false);
	acf_update_setting('acfe/modules/taxonomies', false);
	acf_update_setting('acfe/modules/post_types', false);
	acf_update_setting('acfe/modules/author', false);
	acf_update_setting('acfe/modules/block_types', false);
	acf_update_setting('acfe/modules/forms', false);
	acf_update_setting('acfe/modules/multilang', false);
	acf_update_setting('acfe/modules/options', false);
	acf_update_setting('acfe/modules/options_pages', false);
	acf_update_setting('acfe/modules/categories', false);
}
