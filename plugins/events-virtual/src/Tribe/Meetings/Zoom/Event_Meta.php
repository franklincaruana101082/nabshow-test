<?php
/**
 * Handles the post meta related to Zoom Meetings.
 *
 * @since   1.0.0
 *
 * @package Tribe\Events\Virtual\Meetings\Zoom
 */

namespace Tribe\Events\Virtual\Meetings\Zoom;

use Tribe\Events\Virtual\Event_Meta as Virtual_Event_Meta;
use Tribe\Events\Virtual\Meetings\Zoom_Provider;
use Tribe__Utils__Array as Arr;

/**
 * Class Event_Meta
 *
 * @since   1.0.0
 *
 * @package Tribe\Events\Virtual\Meetings\Zoom
 */
class Event_Meta {

	/**
	 * Removes the Zoom Meeting meta from a post.
	 *
	 * @since 1.0.0
	 *
	 * @param int|\WP_Post $post The event post ID or object.
	 */
	public static function delete_meeting_meta( $post ) {
		$event = tribe_get_event( $post );

		if ( ! $event instanceof \WP_Post ) {
			return false;
		}

		$zoom_meta = static::get_post_meta( $event );

		foreach ( array_keys( $zoom_meta ) as $meta_key ) {
			delete_post_meta( $event->ID, $meta_key );
		}

		return true;
	}

	/**
	 * Returns an event post meta related to Zoom Meetings.
	 *
	 * @since 1.0.0
	 *
	 * @param int|\WP_Post $post The event post ID or object.
	 *
	 * @return array The Zoom Meeting post meta or an empty array if not found or not an event.
	 */
	public static function get_post_meta( $post ) {
		$event = tribe_get_event( $post );

		if ( ! $event instanceof \WP_Post ) {
			return [];
		}

		$all_meta = get_post_meta( $event->ID );

		$prefix = Virtual_Event_Meta::$prefix . 'zoom_';

		return Arr::flatten(
			array_filter(
				$all_meta,
				static function ( $meta_key ) use ( $prefix ) {
					return 0 === strpos( $meta_key, $prefix );
				},
				ARRAY_FILTER_USE_KEY
			)
		);
	}

	/**
	 * Adds Zoom Meeting related properties to an event post object.
	 *
	 * @since 1.0.0
	 *
	 * @param \WP_Post $event The event post object, as decorated by the `tribe_get_event` function.
	 *
	 * @return \WP_Post The decorated event post object, with Zoom related properties added to it.
	 */
	public static function add_event_properties( \WP_Post $event ) {
		$prefix                        = Virtual_Event_Meta::$prefix;
		$event->zoom_meeting_id        = get_post_meta( $event->ID, $prefix . 'zoom_meeting_id', true );
		$event->zoom_join_url          = tribe( Password::class )->get_zoom_meeting_link( $event );
		$event->zoom_join_instructions = get_post_meta( $event->ID, $prefix . 'zoom_join_instructions', true );
		$event->zoom_display_details   = get_post_meta( $event->ID, $prefix . 'zoom_display_details', true );

		$dial_in_numbers = array_filter(
			(array) get_post_meta( $event->ID, $prefix . 'zoom_global_dial_in_numbers', true )
		);

		$compact_phone_number = static function ( $phone_number ) {
			return trim( str_replace( ' ', '', $phone_number ) );
		};

		$event->zoom_global_dial_in_number = count( $dial_in_numbers )
			? array_keys( $dial_in_numbers )[0]
			: '';

		$event->zoom_global_dial_in_numbers = [];
		foreach ( $dial_in_numbers as $phone_number => $country ) {
			$event->zoom_global_dial_in_numbers[] = [
				'country' => $country,
				'compact' => $compact_phone_number( $phone_number ),
				'visual'  => $phone_number,
			];
		}

		if ( ! empty( $event->zoom_join_url ) ) {
			// An event that has a Zoom Meeting assigned should be considered virtual.
			$event->virtual                  = true;
			$event->virtual_meeting          = true;
			$event->virtual_meeting_url      = $event->zoom_join_url;
			$event->virtual_meeting_provider = tribe( Zoom_Provider::class )->get_slug();

			// Override the virtual url if no zoom details and linked button is checked.
			if (
				empty( $event->zoom_display_details )
				&& ! empty( $event->virtual_linked_button )
			) {
				$event->virtual_url = $event->virtual_meeting_url;
			} else {
				// Set virtual url to null if Zoom Meeting is connected to the event.
				$event->virtual_url = null;
			}
		}

		return $event;
	}

	/**
	 * Parses and Saves the data from a metabox update request.
	 *
	 * @since 1.0.0
	 *
	 * @param int                 $post_id The post ID of the post the date is being saved for.
	 * @param array<string,mixed> $data    The data to save, directly from the metabox.
	 */
	public function save_metabox_data( $post_id, array $data ) {
		$prefix = Virtual_Event_Meta::$prefix;

		$join_url = get_post_meta( $post_id, $prefix . 'zoom_join_url', true );

		// An event that has a Zoom Meeting link should always be considered virtual, let's ensure that.
		if ( ! empty( $join_url ) ) {
			update_post_meta( $post_id, Virtual_Event_Meta::$key_virtual, true );
		}

		$map    = [
			'meetings-zoom-display-details' => $prefix . 'zoom_display_details',
		];
		foreach ( $map as $data_key => $meta_key ) {
			$value = Arr::get( $data, 'meetings-zoom-display-details', false );
			if ( ! empty( $value ) ) {
				update_post_meta( $post_id, $meta_key, $value );
			} else {
				delete_post_meta( $post_id, $meta_key );
			}
		}
	}
}
