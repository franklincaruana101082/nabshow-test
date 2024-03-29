<?php
/**
 * @var array $settings List of display settings.
 */

// Determine if ET was installed at version 4.12.2+.
$should_default_to_on = ! tribe_installed_before( 'Tribe__Tickets__Main', '5.0' );

$settings = Tribe__Main::array_insert_before_key( 'tribe-form-content-end', $settings, [
	'rsvp-display-title'         => [
		'type' => 'html',
		'html' => '<h3>' . __( 'Registrations Display Settings', 'event-tickets' ) . '</h3>',
	],
	'rsvp-display-description'   => [
		'type' => 'html',
		'html' => '<p>' . __( 'The settings below control the display of your Registrations.', 'event-tickets' ) . '</p>',
	],
	'tickets_rsvp_use_new_views' => [
		'type'            => 'checkbox_bool',
		'label'           => __( 'Enable New Registration Experience', 'event-tickets' ),
		'tooltip'         => __( 'This setting will render the new front-end designs (styling) and user-flow for the Registration experience.', 'event-tickets' ),
		'validation_type' => 'boolean',
		'default'         => $should_default_to_on,
	],
] );
