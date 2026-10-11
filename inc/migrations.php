<?php
/**
 * One-off data migrations, run by hand with WP-CLI (nothing runs on its own).
 *
 * wp iag migrate-simple-content --dry-run
 * wp iag migrate-simple-content
 *
 * @package _iag
 */

if ( ! defined( 'WP_CLI' ) || ! WP_CLI ) {
	return;
}

/**
 * Simple Content: moves the old single block (fields stored directly in the module)
 * into row 1 of the "Content List" repeater (`content_list`).
 *
 * Safe to run twice: modules that already have rows are skipped. Old values are left
 * in the database, unused. Revisions are not touched. Back up the database first.
 */
function it_migrate_simple_content( $args, $assoc_args ) {
	global $wpdb;

	$dry_run = isset( $assoc_args['dry-run'] );
	$prefix_label = $dry_run ? '[DRY RUN] ' : '';

	$group = json_decode( (string) file_get_contents( IT_DIR . '/acf-json/group_6a857bd17a6d3.json' ), true );
	if ( ! $group ) {
		WP_CLI::error( 'Cannot read acf-json/group_6a857bd17a6d3.json' );
	}

	$repeater_key = '';
	$sub_keys     = [];
	foreach ( $group['fields'] as $field ) {
		if ( $field['type'] === 'repeater' && $field['name'] === 'content_list' ) {
			$repeater_key = $field['key'];
			foreach ( $field['sub_fields'] as $sub ) {
				if ( $sub['name'] ) {
					$sub_keys[ $sub['name'] ] = $sub['key'];
				}
			}
		}
	}
	if ( ! $repeater_key ) {
		WP_CLI::error( 'Repeater content_list not found in the field group JSON. Deploy the theme first.' );
	}

	$old_fields = [ 'content_type', 'media_type', 'media_orientation', 'text_content', 'module_link', 'module_image', 'module_video', 'video_banner', 'video_title', 'embed_video' ];

	$post_ids = $wpdb->get_col(
		"SELECT DISTINCT p.ID FROM {$wpdb->postmeta} m JOIN {$wpdb->posts} p ON p.ID = m.post_id
		 WHERE m.meta_key = 'builder' AND m.meta_value LIKE '%simple_content%'
		 AND p.post_type <> 'revision' AND p.post_status <> 'trash' ORDER BY p.ID"
	);

	$migrated = 0;
	$skipped  = 0;
	WP_CLI::log( $prefix_label . count( $post_ids ) . ' posts contain a Simple Content module.' );

	foreach ( $post_ids as $post_id ) {
		$layouts = maybe_unserialize( get_post_meta( $post_id, 'builder', true ) );
		if ( ! is_array( $layouts ) ) {
			continue;
		}

		foreach ( $layouts as $i => $layout ) {
			if ( $layout !== 'simple_content' ) {
				continue;
			}

			$prefix = "builder_{$i}_";
			$title  = get_the_title( $post_id );

			if ( (int) get_post_meta( $post_id, $prefix . 'content_list', true ) > 0 ) {
				WP_CLI::log( "  skip   post $post_id \"$title\" layout #$i: repeater already has rows" );
				$skipped++;
				continue;
			}

			$row     = [];
			$has_any = false;
			foreach ( $old_fields as $name ) {
				$value        = get_post_meta( $post_id, $prefix . $name, true );
				$row[ $name ] = $value;
				if ( $value !== '' && $value !== null && $value !== [] ) {
					$has_any = true;
				}
			}
			if ( ! $has_any || $row['content_type'] === '' ) {
				WP_CLI::log( "  skip   post $post_id \"$title\" layout #$i: no old block content" );
				$skipped++;
				continue;
			}

			// the module sits in a cloned field group: sub-field keys are stored as "<clone key>_<field key>"
			$ref          = (string) get_post_meta( $post_id, '_' . $prefix . 'color_theme', true );
			$clone_key    = strpos( $ref, '_field_' ) !== false ? substr( $ref, 0, strpos( $ref, '_field_' ) ) : '';
			$repeater_ref = $clone_key ? $clone_key . '_' . $repeater_key : $repeater_key;

			WP_CLI::log( '  ' . ( $dry_run ? 'would ' : '' ) . "migrate post $post_id \"$title\" layout #$i: type={$row['content_type']}, media=" . ( $row['media_type'] ?: '-' ) );
			if ( $dry_run ) {
				continue;
			}

			update_post_meta( $post_id, $prefix . 'content_list', 1 );
			update_post_meta( $post_id, '_' . $prefix . 'content_list', $repeater_ref );
			foreach ( $old_fields as $name ) {
				update_post_meta( $post_id, $prefix . 'content_list_0_' . $name, $row[ $name ] );
				update_post_meta( $post_id, '_' . $prefix . 'content_list_0_' . $name, $sub_keys[ $name ] );
			}
			clean_post_cache( $post_id );
			$migrated++;
		}
	}

	WP_CLI::success( $prefix_label . "$migrated migrated, $skipped skipped." );
}

WP_CLI::add_command( 'iag migrate-simple-content', 'it_migrate_simple_content' );
