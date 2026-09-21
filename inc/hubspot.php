<?php

/**
 * IAG HubSpot integration.
 */

defined( 'ABSPATH' ) || exit;


/**
 * Send successful CF7 submissions to HubSpot.
 */
add_action( 'wpcf7_mail_sent', 'iag_cf7_send_to_hubspot' );

function iag_cf7_send_to_hubspot( $contact_form ) {

	// Only sync CF7 form #1381.
	if ( (int) $contact_form->id() !== 1381 ) {
		return;
	}

	if ( ! defined( 'IAG_HUBSPOT_ACCESS_TOKEN' ) ) {
		error_log( 'HubSpot: access token is not defined.' );
		return;
	}

	$submission = WPCF7_Submission::get_instance();

	if ( ! $submission ) {
		return;
	}

	$data = $submission->get_posted_data();

	$email = sanitize_email( $data['your-email'] ?? '' );

	if ( ! $email ) {
		return;
	}

	$properties = [
		'email'     => $email,
		'firstname' => sanitize_text_field( $data['your-first-name'] ?? '' ),
		'lastname'  => sanitize_text_field( $data['your-last-name'] ?? '' ),
		'phone'     => sanitize_text_field( $data['your-phone'] ?? '' ),
		'company'   => sanitize_text_field( $data['your-company'] ?? '' ),
	];

	// Don't overwrite existing HubSpot data with empty optional fields.
	$properties = array_filter(
		$properties,
		static function ( $value ) {
			return $value !== '';
		}
	);

	iag_hubspot_upsert_contact( $email, $properties );
}


/**
 * Create a new HubSpot contact or update an existing one.
 */
function iag_hubspot_upsert_contact( $email, array $properties ) {

	$token = IAG_HUBSPOT_ACCESS_TOKEN;

	/*
	 * STEP 1:
	 * Search HubSpot for an existing contact with this email.
	 */
	$search_response = wp_remote_post(
		'https://api.hubapi.com/crm/v3/objects/contacts/search',
		[
			'headers' => [
				'Authorization' => 'Bearer ' . $token,
				'Content-Type'  => 'application/json',
			],
			'body' => wp_json_encode(
				[
					'filterGroups' => [
						[
							'filters' => [
								[
									'propertyName' => 'email',
									'operator'     => 'EQ',
									'value'        => $email,
								],
							],
						],
					],
					'properties' => [ 'email' ],
					'limit'      => 1,
				]
			),
			'timeout' => 15,
		]
	);

	if ( is_wp_error( $search_response ) ) {
		error_log(
			'HubSpot contact search failed: ' .
			$search_response->get_error_message()
		);

		return false;
	}

	$search_status = wp_remote_retrieve_response_code( $search_response );

	$search_body = json_decode(
		wp_remote_retrieve_body( $search_response ),
		true
	);

	if ( $search_status !== 200 ) {
		error_log(
			'HubSpot contact search returned HTTP ' .
			$search_status . ': ' .
			wp_remote_retrieve_body( $search_response )
		);

		return false;
	}


	/*
	 * STEP 2:
	 * Contact exists → update it.
	 */
	if ( ! empty( $search_body['results'][0]['id'] ) ) {

		$contact_id = $search_body['results'][0]['id'];

		$response = wp_remote_request(
			'https://api.hubapi.com/crm/v3/objects/contacts/' . rawurlencode( $contact_id ),
			[
				'method' => 'PATCH',

				'headers' => [
					'Authorization' => 'Bearer ' . $token,
					'Content-Type'  => 'application/json',
				],

				'body' => wp_json_encode(
					[
						'properties' => $properties,
					]
				),

				'timeout' => 15,
			]
		);

	/*
	 * STEP 3:
	 * Contact doesn't exist → create it.
	 */
	} else {

		$response = wp_remote_post(
			'https://api.hubapi.com/crm/v3/objects/contacts',
			[
				'headers' => [
					'Authorization' => 'Bearer ' . $token,
					'Content-Type'  => 'application/json',
				],

				'body' => wp_json_encode(
					[
						'properties' => $properties,
					]
				),

				'timeout' => 15,
			]
		);
	}


	/*
	 * STEP 4:
	 * Check HubSpot response.
	 */
	if ( is_wp_error( $response ) ) {

		error_log(
			'HubSpot contact sync failed: ' .
			$response->get_error_message()
		);

		return false;
	}

	$status = wp_remote_retrieve_response_code( $response );

	if ( $status < 200 || $status >= 300 ) {

		error_log(
			'HubSpot contact sync returned HTTP ' .
			$status . ': ' .
			wp_remote_retrieve_body( $response )
		);

		return false;
	}

	return true;
}