<?php
/**
 * Handles the registration of Zoom as a meetings provider.
 *
 * @since   1.0.0
 *
 * @package Tribe\Events\Virtual\Meetings
 */

namespace Tribe\Events\Virtual\Meetings;

use Tribe\Events\Virtual\Event_Meta as Event_Meta;
use Tribe\Events\Virtual\Meetings\Zoom\Event_Meta as Zoom_Meta;
use Tribe\Events\Virtual\Meetings\Zoom\Meetings;
use Tribe\Events\Virtual\Meetings\Zoom\OAuth;
use Tribe\Events\Virtual\Meetings\Zoom\Password;
use Tribe\Events\Virtual\Meetings\Zoom\Template_Modifications;
use Tribe\Events\Virtual\Plugin;
use Tribe\Events\Virtual\Traits\With_String_Routing;

/**
 * Class Zoom_Provider
 *
 * @since   1.0.0
 *
 * @package Tribe\Events\Virtual\Meetings
 */
class Zoom_Provider extends Meeting_Provider {

	use With_String_Routing;

	/**
	 * The slug of this provider.
	 *
	 * @since 1.0.0
	 */
	const SLUG = 'zoom';

	/**
	 * {@inheritDoc}
	 */
	public function get_slug() {
		return self::SLUG;
	}

	/**
	 * An array of string routes to redirect incoming requests using the `With_String_Router` trait.
	 *
	 * @since 1.0.0
	 *
	 * @var array<string,array>
	 */
	protected $string_routes = [
		'zoom' => [
			'oauth'   => [
				'authorize'    => [ OAuth::class, 'handle_auth_request' ],
				'deauthorize' => [ OAuth::class, 'handle_deauth_request' ],
			],
			'meeting' => [
				'create' => [ Meetings::class, 'ajax_create' ],
				'remove' => [ Meetings::class, 'ajax_remove' ],
			],
		],
	];

	/**
	 * Registers the bindings, actions and filters required by the Zoom API meetings provider to work.
	 *
	 * @since 1.0.0
	 */
	public function register() {
		// Register this providers in the container to allow calls on it, e.g. to check if enabled.
		$this->container->singleton( 'events-virtual.meetings.zoom', self::class );
		$this->container->singleton( self::class, self::class );

		if ( ! $this->is_enabled() ) {
			return;
		}

		add_filter( 'tribe_addons_tab_fields', [ $this, 'filter_addons_tab_fields' ] );

		// Filter event object properties to add the ones related to Zoom meetings for virtual events.
		add_action( 'tribe_events_virtual_add_event_properties', [ $this, 'add_event_properties' ] );

		add_action( 'tribe_events_virtual_metabox_save', [ $this, 'on_metabox_save' ], 10, 2 );

		add_action( 'save_post_tribe_events', [ $this, 'on_post_save' ], 10, 3 );

		add_action(
			'wp_ajax_events_virtual_meetings_zoom_autosave_client_keys',
			[ Zoom\OAuth::class, 'ajax_credentials_save' ]
		);

		if ( is_admin() && tribe_context()->is( 'events_virtual_request' ) ) {
			add_filter( 'admin_init', [ $this, 'on_admin_init' ] );
		}

		add_filter(
			'tribe_events_virtual_meetings_zoom_meeting_password',
			[ $this, 'filter_zoom_password' ],
			10,
			2
		);

		add_filter(
			'tribe_events_virtual_video_source_placeholder_text',
			[ $this, 'zoom_link_placeholder_text' ],
			10,
			2
		);

		add_filter(
			'tribe_events_virtual_display_embed_video_hidden',
			[ $this, 'filter_display_embed_video_hidden' ],
			10,
			2
		);

		add_filter(
			'tribe_events_virtual_video_source_virtual_url',
			[ $this, 'filter_video_source_virtual_url' ],
			10,
			2
		);

		add_filter(
			'tribe_events_virtual_video_source_virtual_url_disabled',
			[ $this, 'filter_video_source_virtual_url_disabled' ],
			10,
			2
		);

		$this->hook_templates();
		$this->enqueue_assets();
	}

	/**
	 * Filters the fields in the Events > Settings > APIs tab to add the ones provided by the extension.
	 *
	 * @since 1.0.0
	 *
	 * @param array<string,array> $fields The current fields.
	 *
	 * @return array<string,array> The fields, as updated by the settings.
	 */
	public function filter_addons_tab_fields( $fields ) {
		if ( ! is_array( $fields ) ) {
			return $fields;
		}

		return tribe( Zoom\Settings::class )->add_fields( $fields );
	}

	/**
	 * Fires on the initialization of the admin area to handle request for the plugin.
	 *
	 * The method will also clean up the request URI to remove the request slug query argument.
	 *
	 * @since 1.0.0
	 */
	public function on_admin_init() {
		if ( $this->route( tribe_context()->get( 'events_virtual_request' ) ) ) {
			// Remove the query arguments from the `$_SERVER['REQUEST_URI']` to avoid issues.
			if ( isset( $_SERVER['REQUEST_URI'] ) ) {
				$_SERVER['REQUEST_URI'] = remove_query_arg(
					[
						Plugin::$request_slug,
					],
					$_SERVER['REQUEST_URI']
				);
			}
		}
	}

	/**
	 * Renders the Zoom API link generation UI and controls, depending on the current state.
	 *
	 * @since 1.0.0
	 *
	 * @param string           $file        The path to the template file, unused.
	 * @param string           $entry_point The name of the template entry point, unused.
	 * @param \Tribe__Template $template    The current template instance.
	 */
	public function render_classic_meeting_link_ui( $file, $entry_point, \Tribe__Template $template ) {
		$this->container->make( Zoom\Classic_Editor::class )
		                ->render_meeting_link_generator( $template->get( 'post' ) );
	}

	/**
	 * Renders the Zoom API controls related to the display of the Zoom Meeting link.
	 *
	 * @since 1.0.0
	 *
	 * @param string           $file        The path to the template file, unused.
	 * @param string           $entry_point The name of the template entry point, unused.
	 * @param \Tribe__Template $template    The current template instance.
	 */
	public function render_classic_display_controls( $file, $entry_point, \Tribe__Template $template ) {
		$this->container->make( Zoom\Classic_Editor::class )
						->render_classic_display_controls( $template->get( 'post' ) );
	}

	/**
	 * Filters the object returned by the `tribe_get_event` function to add to it properties related to Zoom meetings.
	 *
	 * @since 1.0.0
	 *
	 * @param \WP_Post $event The events post object to be modified.
	 *
	 * @return \WP_Post The original event object decorated with properties related to virtual events.
	 */
	public function add_event_properties( $event ) {
		if ( ! $event instanceof \WP_Post ) {
			// We should only act on event posts, else bail.
			return $event;
		}

		return $this->container->make( Zoom_Meta::class )->add_event_properties( $event );
	}

	/**
	 * Hooks the template required for the integration to work.
	 *
	 * @since 1.0.0
	 */
	protected function hook_templates() {
		// Metabox.
		add_action(
			'tribe_template_entry_point:events-virtual/admin-views/virtual-metabox/container/video-source:before_li_close',
			[ $this, 'render_classic_meeting_link_ui' ],
			10,
			3
		);

		add_action(
			'tribe_template_entry_point:events-virtual/admin-views/virtual-metabox/container/display:before_ul_close',
			[ $this, 'render_classic_display_controls' ],
			10,
			3
		);

		// @todo remove this work-around once common#1380 is released.
		if ( stripos( PHP_OS, 'win' ) === 0 ) {
			// On Windows the template entrypoint name will not be built correctly, here we deal with it.
			add_action(
				'tribe_template_entry_point:admin-views/virtual-metabox/container/video-source:before_li_close',
				[ $this, 'render_classic_meeting_link_ui' ],
				10,
				3
			);
			add_action(
				'tribe_template_entry_point:admin-views/virtual-metabox/container/display:before_ul_close',
				[ $this, 'render_classic_display_controls' ],
				10,
				3
			);
		}

		// Email Templates.
		add_filter(
			'tribe_events_virtual_ticket_email_template',
			[
				$this,
				'maybe_change_email_template',
			],
			10,
			2
		);

		// Event Single.
		add_action(
			'tribe_events_single_event_after_the_content',
			[ $this, 'action_add_event_single_zoom_details' ],
			15,
			0
		);

		// Event Single - Blocks.
		add_action(
			'tribe_template_after_include:events/blocks/event-datetime',
			[ $this, 'action_add_event_single_zoom_details' ],
			20,
			0
		);
	}

	/**
	 * Enqueues the assets required by the integration.
	 *
	 * @since 1.0.0
	 */
	protected function enqueue_assets() {
		tribe_asset(
			tribe( Plugin::class ),
			'tribe-events-virtual-zoom-admin-js',
			'events-virtual-zoom-admin.js',
			[ 'jquery' ],
			'admin_enqueue_scripts',
			[
				'localize' => [
					'name' => 'tribe_events_virtual_placeholder_strings',
					'data' => [
						'video' => Event_Meta::get_video_source_text(),
						'zoom'  => self::get_zoom_link_placeholder_text(),
					],
				],
			]
		);

		tribe_asset(
			tribe( Plugin::class ),
			'tribe-events-virtual-zoom-admin-style',
			'events-virtual-zoom-admin.css',
			[],
			'admin_enqueue_scripts'
		);

		tribe_asset(
			tribe( Plugin::class ),
			'tribe-events-virtual-zoom-settings-js',
			'events-virtual-zoom-settings.js',
			[ 'jquery' ],
			'admin_enqueue_scripts'
		);
	}

	/**
	 * Handles the save operations of the Classic Editor VE Metabox.
	 *
	 * @since 1.0.0
	 *
	 * @param int                 $post_id The post ID of the event currently being saved.
	 * @param array<string,mixed> $data    The data currently being saved.
	 */
	public function on_metabox_save( $post_id, $data ) {
		$post = get_post( $post_id );
		if ( ! $post instanceof \WP_Post && is_array( $data ) ) {
			return;
		}

		$this->container->make( Zoom_Meta::class )->save_metabox_data( $post_id, $data );
	}

	/**
	 * Handles updating Zoom meetings on post save.
	 *
	 * @since 1.0.2
	 *
	 * @param int     $post_id The post ID.
	 * @param WP_Post $post    The post object.
	 * @param bool    $update  Whether this is an existing post being updated or not.
	 * @return void
	 */
	public function on_post_save( $post_id, $post, $update ) {
		if ( ! $update ) {
			return;
		}

		$event = tribe_get_event( $post_id );

		$this->container->make( Meetings::class )->update( $event );
	}

	/**
	 * Get authorized field template.
	 *
	 * @since 1.0.0
	 *
	 * @param Api $api An instance of the Zoom API handler.
	 * @param Url $url An instance of the URL handler.
	 *
	 * @return void
	 */
	public function zoom_api_authorize_fields( $api, $url ) {
		$this->container->make( Template_Modifications::class )->add_zoom_api_authorize_fields( $api, $url );
	}

	/**
	 * Conditionally inject content into ticket email templates.
	 *
	 * @since 1.0.0
	 *
	 * @param string $template The template path, relative to src/views.
	 * @param array  $args     The template arguments.
	 *
	 * @return string
	 */
	public function maybe_change_email_template( $template, $args ) {
		// Just in case.
		$event = tribe_get_event( $args['event'] );

		if ( empty( $event ) ) {
			return $template;
		}

		if (
			empty( $event->virtual )
			|| empty( $event->virtual_meeting )
			|| tribe( self::class )->get_slug() !== $event->virtual_meeting_provider
		) {
			return $template;
		}

		$template = 'zoom/email/ticket-email-zoom-details';

		return $template;
	}

	/**
	 * Include the zoom details for event single.
	 *
	 * @since 1.0.0
	 */
	public function action_add_event_single_zoom_details() {
		$template_modifications = $this->container->make( Template_Modifications::class );
		$template_modifications->add_event_single_zoom_details();
	}

	/**
	 * Filters the password for the Zoom Meeting.
	 *
	 * @since 1.0.2
	 *
	 * @param null|string|int $password     The password for the Zoom meeting.
	 * @param array           $requirements An array of password requirements from Zoom.
	 */
	public function filter_zoom_password( $password, $requirements ) {
		return $this->container->make( Password::class )->filter_zoom_password( $password, $requirements );
	}

	/**
	 * Adds placeholder text for Zoom links.
	 *
	 * @since 1.0.0
	 *
	 * @param string        $text  The placeholder text.
	 * @param \WP_Post|null $event The events post object we're editing.
	 *
	 * @return string The placeholder text.
	 */
	public static function zoom_link_placeholder_text( $text, $event ) {
		if (
			empty( $event->virtual_meeting )
			|| tribe( self::class )->get_slug() !== $event->virtual_meeting_provider
		) {
			return $text;
		}

		return self::get_zoom_link_placeholder_text();
	}

	/**
	 * Get default placeholder text and filter it.
	 *
	 * @since 1.0.0
	 *
	 * @return string The placeholder text.
	 */
	public static function get_zoom_link_placeholder_text() {
		$text = __( 'Zoom link generated', 'events-virtual' );

		/**
		 * Allows filtering of the placeholder text for when Zoom overrides the URL field.
		 *
		 * @since 1.0.0
		 *
		 * @param string $text The current placeholder text.
		 */
		return apply_filters(
			'tribe_events_virtual_zoom_link_placeholder_text',
			$text
		);
	}

	/**
	 * Filters whether embed video control is hidden.
	 *
	 * @param boolean $is_hidden Whether the embed video control is hidden.
	 * @param WP_Post $event     The event object.
	 *
	 * @return boolean Whether the embed video control is hidden.
	 */
	public function filter_display_embed_video_hidden( $is_hidden, $event ) {
		return $event->virtual_meeting && tribe( self::class )->get_slug() === $event->virtual_meeting_provider;
	}

	/**
	 * Filters the video source virtual url.
	 *
	 * @param string  $virtual_url The virtual url.
	 * @param WP_Post $event       The event object.
	 *
	 * @return string The filtered virtual url.
	 */
	public function filter_video_source_virtual_url( $virtual_url, $event ) {
		if (
			empty( $event->virtual_meeting )
			|| tribe( self::class )->get_slug() !== $event->virtual_meeting_provider
		) {
			return $virtual_url;
		}

		return '';
	}

	/**
	 * Filters whether the video source virtual url is disabled.
	 *
	 * @param boolean $is_disabled Whether the video source virtual url is disabled.
	 * @param WP_Post $event       The event object.
	 *
	 * @return boolean Whether the video source virtual url is disabled.
	 */
	public function filter_video_source_virtual_url_disabled( $is_disabled, $event ) {
		return $event->virtual_meeting && tribe( self::class )->get_slug() === $event->virtual_meeting_provider;
	}
}
