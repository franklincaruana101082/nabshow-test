<?php
/**
 * Keyholder class that provides keys and some default values related to Virtual Events custom fields.
 *
 * @since   1.0.0
 *
 * @package Tribe\Events\Virtual
 */

namespace Tribe\Events\Virtual;

/**
 * Class Event_Meta.
 *
 * @since   1.0.0
 *
 * @package Tribe\Events\Virtual
 */
class Event_Meta {

	/**
	 * Meta key for virtual field.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public static $key_virtual = '_tribe_events_is_virtual';

	/**
	 * Meta key for virtual url field.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public static $key_virtual_url = '_tribe_events_virtual_url';

	/**
	 * Meta key to enable display embed video.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public static $key_embed_video = '_tribe_events_virtual_embed_video';

	/**
	 * Meta key to enable display of linked button.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public static $key_linked_button = '_tribe_events_virtual_linked_button';

	/**
	 * Meta key for linked button text field.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public static $key_linked_button_text = '_tribe_events_virtual_linked_button_text';

	/**
	 * Meta key for when to show the embed.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public static $key_show_embed_at = '_tribe_events_virtual_show_embed_at';

	/**
	 * Meta value to show the embed immediately.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public static $value_show_embed_now = 'immediately';

	/**
	 * Meta value to show the embed on event start.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public static $value_show_embed_start = 'at-start';

	/**
	 * Meta key for showing virtual indicators on single events.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public static $key_show_on_event = '_tribe_events_virtual_show_on_event';

	/**
	 * Meta key for showing virtual indicator on v2 Views.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public static $key_show_on_views = '_tribe_events_virtual_show_on_views';

	/**
	 * Meta key for showing virtual indicators on single events.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public static $key_rsvp_email_link = '_tribe_events_virtual_rsvp_email_link';

	/**
	 * Meta key for showing virtual indicator on v2 Views.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public static $key_ticket_email_link = '_tribe_events_virtual_ticket_email_link';

	/**
	 * All the meta keys, in a set.
	 *
	 * @since 1.0.0
	 *
	 * @var array<string>
	 */
	public static $virtual_event_keys = [
		'_tribe_events_is_virtual',
		'_tribe_events_virtual_embed_video',
		'_tribe_events_virtual_linked_button_text',
		'_tribe_events_virtual_linked_button',
		'_tribe_events_virtual_show_embed_at',
		'_tribe_events_virtual_show_on_event',
		'_tribe_events_virtual_show_on_views',
		'_tribe_events_virtual_url',
		'_tribe_events_virtual_rsvp_email_link',
		'_tribe_events_virtual_ticket_email_link',
	];

	/**
	 * The prefix used to mark the meta saved by the plugin.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public static $prefix = '_tribe_events_';

	/**
	 * Returns the default text to be used for the linked button.
	 *
	 * @since 1.0.0
	 *
	 * @return string The default, localized, text to be used from the linked button text.
	 */
	public static function linked_button_default_text() {
		return _x(
			'Watch',
			'Default label of the virtual event URL call-to-action link.',
			'events-virtual'
		);
	}

	/**
	 * Returns the default text to be used for the linked button.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Post|null $event The event we're editing.
	 *
	 * @return string The localized, placeholder text to be used for the video source input.
	 */
	public static function get_video_source_text( $event = null ) {
		if ( is_null( $event ) ) {
			$event = tribe_get_event();
		}

		$text = _x(
			'Enter URL for Youtube, Facebook, etc.',
			'Default placeholder text for the virtual event URL input.',
			'events-virtual'
		);

		/**
		 * Allows filtering of the default placeholder text for the URL field.
		 *
		 * @since 1.0.0
		 *
		 * @param string $text The current placeholder text.
		 */
		return apply_filters(
			'tribe_events_virtual_video_source_placeholder_text',
			$text,
			$event
		);
	}
}
