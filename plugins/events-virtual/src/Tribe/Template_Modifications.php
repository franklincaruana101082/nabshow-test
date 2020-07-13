<?php
/**
 * Handles template modifications.
 *
 * @since 1.0.0
 *
 * @package Tribe\Events\Virtual
 */

namespace Tribe\Events\Virtual;

use Tribe__Events__Main as Events_Plugin;
use WP_Post;

/**
 * Class Template_Modifications.
 *
 * @since 1.0.0
 *
 * @package Tribe\Events\Virtual
 */
class Template_Modifications {
	/**
	 * Stores the template class used.
	 *
	 * @since 1.0.0
	 *
	 * @var Template
	 */
	protected $template;

	/**
	 * Template_Modifications constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param Template $template An instance of the plugin template handler.
	 */
	public function __construct( Template $template ) {
		$this->template = $template;
	}

	/**
	 * Add the control classes for the views v2 elements
	 *
	 * @since 1.0.0
	 *
	 * @param int|WP_Post $event Post ID or post object.
	 *
	 * @return string[]
	 */
	public function get_body_classes( $event ) {
		$classes = [];
		if ( ! tribe_is_event( $event ) ) {
			return $classes;
		}

		$event = tribe_get_event( $event );

		if ( $event->virtual ) {
			$classes[] = 'tribe-events-virtual-event';
		}

		return $classes;
	}

	/**
	 * Add the control classes for the views v2 elements
	 *
	 * @since 1.0.0
	 *
	 * @param int|WP_Post $event Post ID or post object.
	 *
	 * @return string[]
	 */
	public function get_post_classes( $event ) {
		$classes = [];
		if ( ! tribe_is_event( $event ) ) {
			return $classes;
		}

		$event = tribe_get_event( $event );

		if ( $event->virtual ) {
			$classes[] = 'tribe-events-virtual-event';
		}

		return $classes;
	}

	/**
	 * Include the control markers to the single page.
	 *
	 * @since 1.0.0
	 *
	 * @param string $notices_html  Previously set HTML.
	 *
	 * @return string New Before with the control markers appended.
	 */
	public function add_single_control_mobile_markers( $notices_html ) {
		if ( ! is_singular( Events_Plugin::POSTTYPE ) ) {
			return $notices_html;
		}

		$args     = [
			'event' => tribe_get_event( get_the_ID() ),
		];

		return $this->template->template( 'single/virtual-marker-mobile', $args, false ) . $notices_html;
	}

	/**
	 * Include the control markers to the single page.
	 *
	 * @since 1.0.0
	 *
	 * @param string $schedule  The output HTML.
	 * @param int    $event_id  The post ID of the event we are interested in.
	 *
	 * @return string  New Before with the control markers appended.
	 */
	public function add_single_control_markers( $schedule, $event_id ) {
		if ( ! is_singular( Events_Plugin::POSTTYPE ) ) {
			return $schedule;
		}

		// Bail if this action was already introduced.
		if ( did_action( 'tribe_tickets_ticket_email_top' ) ) {
			return $schedule;
		}

		$event = tribe_get_event( $event_id );

		if ( ! $event->virtual ) {
			return $schedule;
		}

		$args     = [
			'event' => tribe_get_event( get_the_ID() ),
		];

		return $schedule . $this->template->template( 'single/virtual-marker', $args, false );
	}

	/**
	 * Adds Template for Virtual Event.
	 *
	 * @since 1.0.0
	 *
	 * @param string   $file      Complete path to include the PHP File.
	 * @param array    $name      Template name.
	 * @param Template $template  Current instance of the Template.
	 *
	 * @return void  Template render has no return.
	 */
	public function add_virtual_event_marker( $file, $name, $template ) {
		$context = $template->get_values();
		$template->template( 'components/virtual-event', $context );
	}

	/**
	 * Adds video embed to event single.
	 *
	 * @since 1.0.0
	 */
	public function add_event_single_video_embed() {
		// don't show on password protected posts.
		if ( post_password_required() ) {
			return;
		}

		$context  = [
			'event' => tribe_get_event( get_the_ID() ),
		];

		$this->template->template( 'single/video-embed', $context );
	}

	/**
	 * Adds link button to event single outside of details block.
	 *
	 * @since 1.0.0
	 */
	public function add_event_single_non_block_link_button() {
		$block_slug = tribe( 'events.editor.blocks.classic-event-details' )->slug();
		// If we're also rendering the event details block, we don't want to inject this block.
		// @see action_add_event_single_details_block_link_button().
		if ( has_block( "tribe/{$block_slug}", get_the_ID() ) ) {
			return;
		}

		return $this->add_event_single_link_button();
	}

	/**
	 * Adds link button to event single.
	 *
	 * @since 1.0.0
	 */
	public function add_event_single_link_button() {
		// don't show on password protected posts.
		if ( post_password_required() ) {
			return;
		}

		$event = tribe_get_event( get_the_ID() );

		if (
			empty( $event->virtual )
			|| empty( $event->virtual_should_show_embed )
			|| empty( $event->virtual_linked_button )
			|| empty( $event->virtual_url )
		) {
			return;
		}

		/**
		 * Filters whether the link button should open in a new window or not.
		 *
		 * @since 1.0.0
		 *
		 * @param boolean $new_window  Boolean of if link button should open in new window.
		 */
		$new_window = apply_filters( 'tribe_events_virtual_link_button_new_window', false );

		$attrs = [];
		if ( ! empty( $new_window ) ) {
			$attrs['target'] = '_blank';
		}

		$context = [
			'url'   => $event->virtual_url,
			'label' => $event->virtual_linked_button_text,
			'attrs' => $attrs,
		];

		$this->template->template( 'components/link-button', $context );
	}

	/**
	 * Adds Block Template for Virtual Event Marker.
	 *
	 * @since 1.0.1
	 *
	 * @return void  Template render has no return.
	 */
	public function add_single_block_virtual_event_marker() {
		$args = [ 'event' => tribe_get_event( get_the_ID() ) ];

		$this->template->template( 'single/virtual-marker', $args, true );
	}
}
