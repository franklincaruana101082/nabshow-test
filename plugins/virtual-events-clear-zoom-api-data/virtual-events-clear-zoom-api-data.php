<?php
/**
 * Plugin Name: Virtual Events - Remove Zoom API data
 * Description: Remove Virtual Events plugin Zoom API data on activation, this plugin has no UI or settings. You can
 * deactivate it immediately.
 */

function ve_zoom_api_clear_data() {
	$calendar_options = (array) get_option( 'tribe_events_calendar_options', [] );

	$to_delete                = [
		'tribe_zoom_client_id',
		'tribe_zoom_client_secret',
		'tribe_zoom_auth_code',
		'tribe_zoom_refresh_token',
	];
	$updated_calendar_options = array_diff_key( $calendar_options, array_flip( $to_delete ) );

	$removed = false;

	if ( $calendar_options !== $updated_calendar_options ) {
		update_option( 'tribe_events_calendar_options', $updated_calendar_options );
		$removed = true;
	}

	if ( function_exists( 'tribe_transient_notice' ) ) {
		if ( $removed ) {
			$message = 'Virtual Events Zoom API data removed.';
		} else {
			$message = 'Virtual Events Zoom API data not removed; it might have not been there before.';
		}

		$html = sprintf( '<p>%s</p>', esc_html( $message ) );
		tribe_transient_notice( 've_zoom_api_clear_data', $html, [ 'type' => 'success' ], 10 );
	}
}

register_activation_hook( __FILE__, 've_zoom_api_clear_data' );
