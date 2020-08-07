<?php
/**
 * Handles the rendering of the Classic Editor controls.
 *
 * @since   1.0.0
 *
 * @package Tribe\Events\Virtual\Meetings\Zoom
 */

namespace Tribe\Events\Virtual\Meetings\Zoom;

use Tribe\Events\Virtual\Admin_Template;
use Tribe\Events\Virtual\Event_Meta as Virtual_Meta;
use Tribe\Events\Virtual\Meetings\Zoom\Event_Meta as Zoom_Meta;
use Tribe\Events\Virtual\Metabox;

/**
 * Class Classic_Editor
 *
 * @since   1.0.0
 *
 * @package Tribe\Events\Virtual\Meetings\Zoom
 */
class Classic_Editor {
	/**
	 * The URLs handler for the integration.
	 *
	 * @since 1.0.0
	 *
	 * @var Url
	 */
	protected $url;

	/**
	 * The template handler instance.
	 *
	 * @since 1.0.0
	 *
	 * @var Admin_Template
	 */
	protected $template;

	/**
	 * An instance of the Zoom API handler.
	 *
	 * @since 1.0.0
	 *
	 * @var Api
	 */
	protected $api;

	/**
	 * Classic_Editor constructor.
	 *
	 * @param Url            $url      The URLs handler for the integration.
	 * @param Api            $api      An instance of the Zoom API handler.
	 * @param Admin_Template $template An instance of the Template class to handle the rendering of admin views.
	 */
	public function __construct( Url $url, Api $api, Admin_Template $template ) {
		$this->url = $url;
		$this->api = $api;
		$this->template = $template;
	}

	/**
	 * Renders, echoing to the page, the Zoom API meeting generator controls.
	 *
	 * @since 1.0.0
	 *
	 * @param null|\WP_Post|int $post The post object or ID of the event to generate the controls for, or `null` to use
	 *                                the global post object.
	 * @param bool              $echo Whether to echo the template contents to the page (default) or to return it.
	 *
	 * @return string The template contents, if not rendered to the page.
	 */
	public function render_meeting_link_generator( $post = null, $echo = true ) {
		$post = tribe_get_event( get_post( $post ) );

		if ( ! $post instanceof \WP_Post ) {
			return '';
		}

		// Make sure to apply the Zoom properties to the event.
		Zoom_Meta::add_event_properties( $post );

		if ( $this->api->is_authorized() ) {

			$prefix   = Virtual_Meta::$prefix;
			$join_url = tribe( Password::class )->get_zoom_meeting_link( $post );

			$remove_link_url   = $this->url->to_remove_meeting_link( $post );
			$remove_link_label = _x(
				'Remove Zoom link',
				'The label for the admin UI control that allows removing the Zoom Meeting link from the event.',
				'events-virtual'
			);

			if ( ! empty( $join_url ) ) {
				return $this->template->template(
					'virtual-metabox/zoom/details',
					[
						'event'             => $post,
						'details_title'     => _x(
							'Zoom Link',
							'Title of the details box shown for a generated Zoom Meeting link in the backend.',
							'events-virtual'
						),
						'remove_link_url'   => $remove_link_url,
						'remove_link_label' => $remove_link_label,
						'id_label'          => _x(
							'ID: ',
							'The label used to prefix a Zoom Meeting ID in the backend.',
							'events-virtual'
						),
						'phone_numbers'     => array_filter(
							(array) get_post_meta( $post->ID, $prefix . 'zoom_global_dial_in_numbers', true )
						),
					],
					$echo
				);
			}

			return $this->template->template(
				'virtual-metabox/zoom/controls',
				[
					'event'               => $post,
					'is_authorized'       => true,
					'offer_or_label'      => _x(
						'or',
						'The lowercase "or" label used to offer the creation of a Zoom Meetings API link.',
						'events-virtual'
					),
					'generate_link_label' => _x(
						'Generate Zoom Link',
						'Label for the button to generate a Zoom meeting link in the event classic editor UI.',
						'events-virtual'
					),
					'generate_link_url'   => $this->url->to_generate_meeting_link( $post ),
				],
				$echo
			);
		}

		return $this->template->template(
			'virtual-metabox/zoom/controls',
			[
				'event'               => $post,
				'is_authorized'       => false,
				'offer_or_label'      => _x(
					'or',
					'The lowercase "or" label used to offer the creation of a Zoom Meetings API link.',
					'events-virtual'
				),
				'generate_link_label' => $this->get_connect_to_zoom_label(),
				'generate_link_url'   => Settings::admin_url(),
			],
			$echo
		);
	}

	/**
	 * Renders, echoing to the page, the Zoom API meeting display controls.
	 *
	 * @since 1.0.0
	 *
	 * @param null|\WP_Post|int $post The post object or ID of the event to generate the controls for, or `null` to use
	 *                                the global post object.
	 * @param bool              $echo Whether to echo the template contents to the page (default) or to return it.
	 *
	 * @return string The template contents, if not rendered to the page.
	 */
	public function render_classic_display_controls( $post = null, $echo = true ) {
		return $this->template->template(
			'virtual-metabox/zoom/display',
			[
				'event'      => $post,
				'metabox_id' => Metabox::$id,
			],
			$echo
		);
	}

	/**
	 * Renders the error details shown to the user when a Zoom Meeting link generation fails.
	 *
	 * @since 1.0.0
	 *
	 * @param int|\WP_Post $event      The event ID or object.
	 * @param string       $error_body The error details in human-readable form. This can contain HTML
	 *                                 tags (e.g. links).
	 * @param bool         $echo       Whether to echo the template to the page or not.
	 *
	 * @return string The rendered template contents.
	 */
	public function render_meeting_generation_error_details( $event = null, $error_body = null, $echo = true ) {
		$event = $event instanceof \WP_Post ? $event : get_post();

		$is_authorized = $this->api->is_authorized();

		$remove_link_url   = $this->url->to_remove_meeting_link( $event );
		$remove_link_label = _x(
			'Remove Zoom link',
			'The label for the admin UI control that allows removing the Zoom Meeting link from the event.',
			'events-virtual'
		);

		$link_url   = $is_authorized
			? $this->url->to_generate_meeting_link( $event )
			: Settings::admin_url();
		$link_label = $is_authorized
			? _x( 'Try again', 'The label of the button to try and generate a Zoom Meeting link again.',
				'events-virtual' )
			: $this->get_connect_to_zoom_label();

		if ( null === $error_body ) {
			$error_body = $this->get_unknown_error_message();
		}
		$error_body = wpautop( $error_body );

		return $this->template->template(
			'virtual-metabox/zoom/meeting-link-error-details',
			[
				'remove_link_url'   => $remove_link_url,
				'remove_link_label' => $remove_link_label,
				'is_authorized'     => $is_authorized,
				'error_body'        => $error_body,
				'link_url'          => $link_url,
				'link_label'        => $link_label,
			],
			$echo
		);
	}

	/**
	 * Returns the localized, but not HTML-escaped, message to set up the Zoom integration.
	 *
	 * @since 1.0.0
	 *
	 * @return string The localized, but not HTML-escaped, message to set up the Zoom integration.
	 */
	protected function get_connect_to_zoom_label() {
		return _x(
			'Set up Zoom integration',
			'Label for the link to set up the Zoom integration in the event classic editor UI.',
			'events-virtual'
		);
	}

	/**
	 * Returns the generic message to indicate an error to perform an action in the context of the Zoom API
	 * integration.
	 *
	 * @since 1.0.0
	 *
	 * @return string The error message, unescaped.
	 */
	protected function get_unknown_error_message() {
		return _x(
			'Unknown error',
			'A message to indicate an unknown error happened while interacting with the Zoom API integration.',
			'events-virtual'
		);
	}
}
