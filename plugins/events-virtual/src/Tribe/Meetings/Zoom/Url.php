<?php
/**
 * Manages the Zoom URLs for the plugin.
 *
 * @since   1.0.0
 *
 * @package Tribe\Events\Virtual\Meetings\Zoom
 */

namespace Tribe\Events\Virtual\Meetings\Zoom;

use Tribe\Events\Virtual\Plugin;

/**
 * Class Url
 *
 * @since   1.0.0
 *
 * @package Tribe\Events\Virtual\Meetings\Zoom
 */
class Url {
	/**
	 * The base URL that should be used to authorize the Zoom App.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 *
	 * @link  https://marketplace.zoom.us/docs/guides/auth/oauth
	 */
	public static $authorize_url = 'https://zoom.us/oauth/authorize';

	/**
	 * The base URL that should be used to authorize the Zoom App.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 *
	 * @link  https://marketplace.zoom.us/docs/guides/auth/oauth
	 */
	public static $revoke_url = 'https://zoom.us/oauth/revoke';

	/**
	 * The current Zoom API handler instance.
	 *
	 * @since 1.0.0
	 *
	 * @var Api
	 */
	protected $api;

	/**
	 * An instance of the API OAuth handler.
	 *
	 * @since 1.0.0
	 *
	 * @var OAuth
	 */
	protected $oauth;

	/**
	 * Url constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param Api   $api   An instance of the Zoom API handler.
	 * @param OAuth $oauth An instance of the API OAuth handler.
	 */
	public function __construct( Api $api, OAuth $oauth ) {
		$this->api   = $api;
		$this->oauth = $oauth;
	}

	/**
	 * Returns the URL to disconnect from the Zoom API.
	 *
	 * The current version (2.0) of Zoom API does not provide a de-authorization endpoint, as such the best way to
	 * disconnect the application is to de-authorize its access token.
	 *
	 * @since 1.0.0
	 *
	 * @param string $current_url The URL to return to after a successful disconnection.
	 *
	 * @return string The URL to disconnect from the Zoom API.
	 *
	 * @link  https://marketplace.zoom.us/docs/guides/auth/oauth#revoking
	 */
	public function to_disconnect( $current_url = null ) {
		return add_query_arg( [
			Plugin::$request_slug => 'zoom|oauth|deauthorize|' . wp_create_nonce( OAuth::$deauthorize_nonce_action ),
		], Settings::admin_url() );
	}

	/**
	 * Returns the URL to authorize the use of the Zoom API.
	 *
	 * @since 1.0.0
	 *
	 * @return string The request URL.
	 *
	 * @link  https://marketplace.zoom.us/docs/guides/auth/oauth
	 */
	public function to_authorize() {
		return add_query_arg( [
			'response_type' => 'code',
			'redirect_uri'  => esc_url( $this->oauth->authorize_url() ),
			'client_id'     => $this->api->client_id(),
		],
			self::$authorize_url
		);
	}

	/**
	 * Returns the URL that should be used to generate a Zoom API meeting link.
	 *
	 * @since 1.0.0
	 *
	 * @param \WP_Post|null $post A post object to generate the meeting for.
	 *
	 * @return string The URL to generate the Zoom Meeting.
	 */
	public function to_generate_meeting_link( \WP_Post $post ) {
		$nonce = wp_create_nonce( Meetings::$create_action );

		return add_query_arg( [
			'action'              => 'ev_zoom_meetings_create',
			Plugin::$request_slug => 'zoom|meeting|create|' . $nonce,
			'post_id'             => $post->ID,
			'_ajax_nonce'         => $nonce,
		], admin_url( 'admin-ajax.php' ) );
	}

	/**
	 * Returns the URL that should be used to remove an event Zoom Meeting URL.
	 *
	 * @since 1.0.0
	 *
	 * @param \WP_Post $post A post object to remove the meeting from.
	 *
	 * @return string The URL to remove the Zoom Meeting.
	 */
	public function to_remove_meeting_link( \WP_Post $post ) {
		$nonce = wp_create_nonce( Meetings::$remove_action );

		return add_query_arg(
			[
				'action'              => 'ev_zoom_meetings_remove',
				Plugin::$request_slug => 'zoom|meeting|remove|' . $nonce,
				'post_id'             => $post->ID,
				'_ajax_nonce'         => $nonce,
			],
			admin_url( 'admin-ajax.php' )
		);
	}
}
