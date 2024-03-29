<?php
/**
 * Handles hooking all the actions and filters used by the module.
 *
 * To remove a filter:
 * ```php
 *  remove_filter( 'some_filter', [ tribe( Tribe\Events\Virtual\Hooks::class ), 'some_filtering_method' ] );
 *  remove_filter( 'some_filter', [ tribe( 'events-virtual.hooks' ), 'some_filtering_method' ] );
 * ```
 *
 * To remove an action:
 * ```php
 *  remove_action( 'some_action', [ tribe( Tribe\Events\Virtual\Hooks::class ), 'some_method' ] );
 *  remove_action( 'some_action', [ tribe( 'events-virtual.hooks' ), 'some_method' ] );
 * ```
 *
 * @since   1.0.0
 *
 * @package Tribe\Events\Virtual;
 */

namespace Tribe\Events\Virtual;

use Tribe\Events\Virtual\Meetings\Zoom_Provider;
use Tribe__Context as Context;
use Tribe__Events__Main as Events_Plugin;
use Tribe__Template as Template;
use Tribe\Events\Virtual\Email as Email;
use WP_Post;

/**
 * Class Hooks.
 *
 * @since   1.0.0
 *
 * @package Tribe\Events\Virtual;
 */
class Hooks extends \tad_DI52_ServiceProvider {

	/**
	 * Binds and sets up implementations.
	 *
	 * @since 1.0.0
	 */
	public function register() {
		$this->container->singleton( static::class, $this );
		$this->container->singleton( 'events-virtual.hooks', $this );

		$this->add_actions();
		$this->add_filters();
		$this->add_meetings_support();
	}

	/**
	 * Adds the actions required by the plugin.
	 *
	 * @since 1.0.0
	 */
	protected function add_actions() {
		add_action( 'init', [ $this, 'on_init' ] );
		add_action( 'tribe_after_location_details', [ $this, 'render_metabox' ], 5 );
		add_action( 'add_meta_boxes', [ $this, 'on_add_meta_boxes' ], 15 );
		add_action( 'save_post_' . Events_Plugin::POSTTYPE, [ $this, 'on_save_post' ], 15, 3 );
		add_action( 'wp_ajax_tribe_events_virtual_check_oembed', [ $this, 'ajax_test_embed_url' ] );

		// Latest Past View.
		add_action(
			'tribe_template_after_include:events/v2/latest-past/event/venue',
			[ $this, 'action_add_virtual_event_marker' ],
			15,
			3
		);

		// List View.
		add_action(
			'tribe_template_after_include:events/v2/list/event/venue',
			[ $this, 'action_add_virtual_event_marker' ],
			15,
			3
		);

		// Day View.
		add_action(
			'tribe_template_after_include:events/v2/day/event/venue',
			[ $this, 'action_add_virtual_event_marker' ],
			15,
			3
		);

		// Month View.
		add_action(
			'tribe_template_after_include:events/v2/month/calendar-body/day/calendar-events/calendar-event/date/featured',
			[ $this, 'action_add_virtual_event_marker' ],
			15,
			3
		);

		add_action(
			'tribe_template_after_include:events/v2/month/calendar-body/day/calendar-events/calendar-event/tooltip/date/featured',
			[ $this, 'action_add_virtual_event_marker' ],
			15,
			3
		);

		add_action(
			'tribe_template_after_include:events/v2/month/calendar-body/day/multiday-events/multiday-event/bar/featured',
			[ $this, 'action_add_virtual_event_marker' ],
			15,
			3
		);

		add_action(
			'tribe_template_after_include:events/v2/month/mobile-events/mobile-day/mobile-event/title',
			[ $this, 'action_add_virtual_event_marker' ],
			15,
			3
		);

		// Photo View.
		add_action(
			'tribe_template_before_include:events-pro/v2/photo/event/date-time',
			[ $this, 'action_add_virtual_event_marker' ],
			20,
			3
		);

		// Map View.
		add_action(
			'tribe_template_after_include:events-pro/v2/map/event-cards/event-card/event/venue',
			[ $this, 'action_add_virtual_event_marker' ],
			15,
			3
		);

		add_action(
			'tribe_template_after_include:events-pro/v2/map/event-cards/event-card/tooltip/venue',
			[ $this, 'action_add_virtual_event_marker' ],
			15,
			3
		);

		// Week View.
		add_action(
			'tribe_template_after_include:events-pro/v2/week/mobile-events/day/event/venue',
			[ $this, 'action_add_virtual_event_marker' ],
			15,
			3
		);

		add_action(
			'tribe_template_after_include:events-pro/v2/week/grid-body/events-day/event/date/featured',
			[ $this, 'action_add_virtual_event_marker' ],
			15,
			3
		);

		add_action(
			'tribe_template_after_include:events-pro/v2/week/grid-body/events-day/event/tooltip/date/featured',
			[ $this, 'action_add_virtual_event_marker' ],
			15,
			3
		);

		add_action(
			'tribe_template_after_include:events-pro/v2/week/grid-body/multiday-events-day/multiday-event/bar/featured',
			[ $this, 'action_add_virtual_event_marker' ],
			15,
			3
		);

		// Event Single.
		add_action(
			'tribe_events_single_event_after_the_content',
			[ $this, 'action_add_event_single_video_embed' ],
			15,
			0
		);

		add_action(
			'tribe_events_single_meta_details_section_end',
			[ $this, 'action_add_event_single_details_block_link_button' ],
			15,
			0
		);

		add_action(
			'tribe_template_before_include:events-virtual/single/video-embed',
			[ $this, 'action_add_oembed_filter' ],
			15,
			3
		);

		add_action(
			'tribe_template_after_include:events-virtual/single/video-embed',
			[ $this, 'action_remove_oembed_filter' ],
			15,
			3
		);

		// Event Single Blocks.

		add_action(
			'tribe_template_before_include:events/blocks/event-datetime',
			[ $this, 'action_add_block_virtual_event_marker' ]
		);

		add_action(
			'tribe_template_after_include:events/blocks/event-datetime',
			[
				$this,
				'action_add_event_single_video_embed',
			],
			10
		);

		add_action(
			'tribe_template_after_include:events/blocks/event-datetime',
			[
				$this,
				'action_add_event_single_link_button',
			],
			15
		);

		/**
		 * Future proofing for when Event Tickets adds the Action.
		 *
		 * @todo @Camwyn make sure this works once that hook is in place.
		 */
		add_action(
			'tribe_tickets_ticket_email_after_details',
			[ $this, 'action_ticket_email_after_details' ],
			10,
			2
		);

		add_action(
			'tribe_events_pro_shortcode_tribe_events_before_assets',
			[ $this, 'action_include_assets' ]
		);
	}

	/**
	 * Adds the filters required by the plugin.
	 *
	 * @since 1.0.0
	 */
	protected function add_filters() {
		add_filter( 'tribe_template_origin_namespace_map', [ $this, 'filter_add_template_origin_namespace' ], 15 );
		add_filter( 'tribe_template_path_list', [ $this, 'filter_template_path_list' ], 15, 2 );
		add_filter( 'tribe_the_notices', [ $this, 'filter_include_single_control_mobile_markers' ], 15 );
		add_filter( 'tribe_events_event_schedule_details', [ $this, 'include_single_control_desktop_markers' ], 10, 2 );
		add_filter( 'tribe_json_ld_event_object', [ $this, 'filter_json_ld_modifiers' ], 15, 3 );
		add_filter( 'tribe_rest_event_data', [ $this, 'filter_rest_event_data' ], 10, 2 );
		add_filter( 'post_class', [ $this, 'filter_add_post_class' ], 15, 3 );
		add_filter( 'body_class', [ $this, 'filter_add_body_class' ], 10 );

		// Filter event object properties to add the ones related to virtual events.
		add_filter( 'tribe_get_event', [ $this, 'filter_tribe_get_event' ], 10 );

		// Add the plugin locations to the Context.
		add_filter( 'tribe_context_locations', [ $this, 'filter_context_locations' ] );

		/**
		 * Currently in place to make sure we have backwards compatibility for when the hook was not in place.
		 *
		 * @todo @Camwyn  Kill this when the tribe_tickets_ticket_email_after_details action is in place in ET.
		 */
		add_filter( 'tribe_tickets_get_template_part_content', [ $this, 'filter_ticket_email_content' ], 10, 6 );
	}

	/**
	 * Registers the meeting providers.
	 *
	 * @since 1.0.0
	 */
	protected function add_meetings_support() {
		if ( ! Plugin::meetings_enabled() ) {
			return;
		}

		$this->container->register( Zoom_Provider::class );
	}

	/**
	 * Add the control classes for the views v2 elements
	 *
	 * @since 1.0.0
	 *
	 * @param string|array<string> $classes Space-separated string or array of class names to add to the class list.
	 * @param array<string>        $class   An array of additional class names added to the post.
	 * @param int|\WP_Post         $post    Post ID or post object.
	 *
	 * @return array<string> The filtered post classes.
	 */
	public function filter_add_post_class( $classes, $class, $post ) {
		$new_classes = $this->container->make( Template_Modifications::class )->get_post_classes( $post );

		return array_merge( $classes, $new_classes );
	}

	/**
	 * Add the control classes for the views v2 elements
	 *
	 * @since 1.0.0
	 *
	 * @param string|array<string> $classes Space-separated string or array of class names to add to the class list.
	 *
	 * @return array<string> The filtered post body classes.
	 */
	public function filter_add_body_class( $classes ) {
		global $post;
		$new_classes = $this->container->make( Template_Modifications::class )->get_body_classes( $post );

		return array_merge( $classes, $new_classes );
	}

	/**
	 * Includes Pro into the path namespace mapping, allowing for a better namespacing when loading files.
	 *
	 * @since 1.0.0
	 *
	 * @param array $namespace_map Indexed array containing the namespace as the key and path to `strpos`.
	 *
	 * @return array  Namespace map after adding Pro to the list.
	 */
	public function filter_add_template_origin_namespace( $namespace_map ) {
		/* @var $plugin Plugin */
		$plugin                        = tribe( Plugin::class );
		$namespace_map[ Plugin::SLUG ] = $plugin->plugin_path;

		return $namespace_map;
	}

	/**
	 * Filters the list of folders TEC will look up to find templates to add the ones defined by PRO.
	 *
	 * @since 1.0.0
	 *
	 * @param array    $folders  The current list of folders that will be searched template files.
	 * @param Template $template Which template instance we are dealing with.
	 *
	 * @return array The filtered list of folders that will be searched for the templates.
	 */
	public function filter_template_path_list( array $folders, Template $template ) {
		/* @var $plugin Plugin */
		$plugin = tribe( Plugin::class );
		$path   = (array) rtrim( $plugin->plugin_path, '/' );

		// Pick up if the folder needs to be added to the public template path.
		$folder = [ 'src/views' ];

		if ( ! empty( $folder ) ) {
			$path = array_merge( $path, $folder );
		}

		$folders[ Plugin::SLUG ] = [
			'id'        => Plugin::SLUG,
			'namespace' => Plugin::SLUG,
			'priority'  => 10,
			'path'      => implode( DIRECTORY_SEPARATOR, $path ),
		];

		return $folders;
	}

	/**
	 * Modifiers to the JSON LD object we use.
	 *
	 * @since 1.0.0
	 *
	 * @param object  $data The JSON-LD object.
	 * @param array   $args The arguments used to get data.
	 * @param WP_Post $post The post object.
	 *
	 * @return object JSON LD object after modifications.
	 */
	public function filter_json_ld_modifiers( $data, $args, $post ) {
		return $this->container->make( JSON_LD::class )->modify_virtual_event( $data, $args, $post );
	}

	/**
	 * Filters event REST data to include new fields.
	 *
	 * @since 1.0.0
	 *
	 * @param array   $data  The event data array.
	 * @param WP_Post $event The post object.
	 *
	 * @return array The event data array after modification.
	 */
	public function filter_rest_event_data( $data, $event ) {
		return array_merge(
			$data,
			$this->container->make( Models\Event::class )->get_rest_properties( $event )
		);
	}

	/**
	 * Renders the metabox template.
	 *
	 * @since 1.0.0
	 *
	 * @param int $post_id  The post ID of the event we are interested in.
	 *
	 * @return void Action hook with no return.
	 */
	public function render_metabox( $post_id ) {
		echo $this->container->make( Metabox::class )->render_template( $post_id ); /* phpcs:ignore */
	}

	/**
	 * Register the metabox fields in the correct action.
	 *
	 * @since 1.0.0
	 *
	 * @return void Action hook with no return.
	 */
	public function on_init() {
		$this->container->make( Metabox::class )->register_fields();
	}

	/**
	 * Registers the plugin meta box for Blocks Editor support.
	 *
	 * @since 1.0.0
	 *
	 * @return void Action hook with no return.
	 */
	public function on_add_meta_boxes() {
		$this->container->make( Metabox::class )->register_blocks_editor_legacy();
	}

	/**
	 * Register the metabox fields in the correct action.
	 *
	 * @since 1.0.0
	 *
	 * @param int     $post_id Which post ID we are dealing with when saving.
	 * @param WP_Post $post    WP Post instance we are saving.
	 * @param boolean $update  If we are updating the post or not.
	 *
	 * @return void Action hook with no return.
	 */
	public function on_save_post( $post_id, $post, $update ) {
		$this->container->make( Metabox::class )->save( $post_id, $post, $update );
	}

	/**
	 * Include the Virtual Events URL anchor for the archive pages.
	 *
	 * @since 1.0.0
	 *
	 * @param string   $file     Complete path to include the PHP File.
	 * @param array    $name     Template name.
	 * @param Template $template Current instance of the Template.
	 *
	 * @return void  Template render has no return.
	 */
	public function action_add_virtual_event_marker( $file, $name, $template ) {
		$this->container->make( Template_Modifications::class )
						->add_virtual_event_marker( $file, $name, $template );
	}

	/**
	 * Include the Virtual Events URL anchor for the single event block.
	 *
	 * @since 1.0.1
	 *
	 * @return void  Template render has no return.
	 */
	public function action_add_block_virtual_event_marker() {
		$this->container->make( Template_Modifications::class )
						->add_single_block_virtual_event_marker();
	}

	/**
	 * Include the video embed for event single.
	 *
	 * @since 1.0.0
	 */
	public function action_add_event_single_video_embed() {
		$this->container->make( Template_Modifications::class )
						->add_event_single_video_embed();
	}

	/**
	 * Include the link button for event single.
	 *
	 * @since 1.0.0
	 */
	public function action_add_event_single_link_button() {
		$this->container->make( Template_Modifications::class )
						->add_event_single_non_block_link_button();
	}

	/**
	 * Include the link button for event single details block.
	 *
	 * @since 1.0.0
	 */
	public function action_add_event_single_details_block_link_button() {
		$this->container->make( Template_Modifications::class )
						->add_event_single_link_button();
	}

	/**
	 * Add the oEmbed filter before the video embed template.
	 *
	 * @since 1.0.0
	 *
	 * @param string   $file     Complete path to include the PHP File.
	 * @param array    $name     Template name.
	 * @param Template $template Current instance of the Template.
	 */
	public function action_add_oembed_filter( $file, $name, $template ) {
		add_filter( 'oembed_dataparse', [ $this, 'filter_make_oembed_responsive' ], 10, 3 );
	}

	/**
	 * Remove the oEmbed filter after the video embed template.
	 *
	 * @since 1.0.0
	 *
	 * @param string   $file     Complete path to include the PHP File.
	 * @param array    $name     Template name.
	 * @param Template $template Current instance of the Template.
	 */
	public function action_remove_oembed_filter( $file, $name, $template ) {
		remove_filter( 'oembed_dataparse', [ $this, 'filter_make_oembed_responsive' ], 10, 3 );
	}

	/**
	 * Use old filter and regex to inject virtual event data.
	 *
	 * @TODO @stephen: Kill this when the tribe_tickets_ticket_email_after_details action is in place in ET.
	 *
	 * @since 1.0.0
	 *
	 * @param string $html            The current HTML.
	 * @param string $unused_template The Template file, which is a relative path from the Folder we are dealing with.
	 * @param string $unused_file     Complete path to include the PHP File.
	 * @param string $slug            Slug for this template.
	 * @param string $unused_name     Template name.
	 * @param array  $data            The Data that will be used on this template.
	 *
	 * @return string $html            The final HTML
	 */
	public function filter_ticket_email_content( $html, $unused_template, $unused_file, $slug, $unused_name, $data ) {
		return $this->container->make( Email::class )
			->filter_ticket_email_content( $html, $slug, $data );
	}

	/**
	 * Include the video embed for event single.
	 *
	 * @since 1.0.0
	 *
	 * @param array   $ticket The ticket data.
	 * @param WP_Post $event  The post object.
	 */
	public function action_ticket_email_after_details( $ticket, $event ) {
		$this->container->make( Email::class )
			->insert_virtual_info_into_ticket_email( $ticket, $event );
	}

	/**
	 * Include the control markers for the single pages.
	 *
	 * @since 1.0.0
	 *
	 * @param string $notices_html Previously set HTML.
	 *
	 * @return string  Before event html with the new markers.
	 */
	public function filter_include_single_control_mobile_markers( $notices_html ) {
		$event = tribe_get_event( get_the_ID() );

		if ( ! $event->virtual ) {
			return;
		}

		$template_modifications = $this->container->make( Template_Modifications::class );

		return $template_modifications->add_single_control_mobile_markers( $notices_html );
	}

	/**
	 * Include the control markers for the single pages.
	 *
	 * @since 1.0.0
	 *
	 * @param string $schedule  The output HTML.
	 * @param int    $event_id  The post ID of the event we are interested in.
	 *
	 * @return string The output HTML.
	 */
	public function include_single_control_desktop_markers( $schedule, $event_id ) {
		return $this->container->make( Template_Modifications::class )->add_single_control_markers( $schedule, $event_id );
	}

	/**
	 * Filters the object returned by the `tribe_get_event` function to add to it properties related to virtual events.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Post $post The events post object to be modified.
	 *
	 * @return \WP_Post The original event object decorated with properties related to virtual events.
	 */
	public function filter_tribe_get_event( $post ) {
		if ( ! $post instanceof WP_Post ) {
			// We should only act on event posts, else bail.
			return $post;
		}

		return $this->container->make( Models\Event::class )->add_properties( $post );
	}

	/**
	 * Add, to the Context, the locations used by the plugin.
	 *
	 * @since 1.0.0
	 *
	 * @param array<string,array> $context_locations The current Context locations.
	 *
	 * @return array<string,array> The updated Context locations.
	 */
	public function filter_context_locations( array $context_locations ) {
		$context_locations['events_virtual_data'] = [
			'read' => [
				Context::REQUEST_VAR => [ Metabox::$id ],
			],
		];

		$context_locations['events_virtual_request'] = [
			'read' => [
				Context::REQUEST_VAR => [ Plugin::$request_slug, 'state' ],
			],
		];

		return $context_locations;
	}

	/**
	 * Filters the oEmbed HTML to make it responsive.
	 *
	 * @since 1.0.0
	 *
	 * @param string $html The returned oEmbed HTML.
	 * @param object $data A data object result from an oEmbed provider.
	 * @param string $url  The URL of the content to be embedded.
	 *
	 * @return string  The filtered oEmbed HTML.
	 */
	public function filter_make_oembed_responsive( $html, $data, $url ) {
		return $this->container->make( OEmbed::class )->make_oembed_responsive( $html, $data, $url );
	}

	/**
	 * Ajax function to test an oembed link for "embeddability".
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function ajax_test_embed_url() {
		$this->container->make( OEmbed::class )->ajax_test_oembed_url();
	}

	/**
	 * Enqueue assets when we call a PRO shortcode.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function action_include_assets() {
		return $this->container->make( Assets::class )->load_on_shortcode();
	}
}
