<?php
/*
* Plugin Name: Custom Cache Control, Environment Manage, Url Verify Helpers
* Plugin URI: https://plugin-site.example.com
* Description: Custom Cache Control, Environment Manage, Url Verify Helpers
* Version:     1.0.0
* Author: Frank-Codev
* Author URI:  codev.com
* License:     GPL2
* License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
require_once WPMU_PLUGIN_DIR . '/misc.php';
require WP_PLUGIN_DIR . '/custom-helpers/url-env-cache-control-helper/class-url-cache-control.php';

// Load the VIP Vary_Cache class
require_once WPMU_PLUGIN_DIR . '/cache/class-vary-cache.php';


use Automattic\VIP\Cache\Vary_Cache;

class NabshowCacheControl extends Vary_Cache {
	function __construct() {
		// Register the `nabshow` group
		self::register_group( 'nabshow' );
		$this->init_enqueue_scripts();
	}

	function init_enqueue_scripts() {
		add_action(
			'init',
			function() {
				// phpcs:ignore WordPress.Security.NonceVerification.Missing
				$is_user_in_nabshow = self::is_user_in_group_segment( 'nabshow', 'yes' );
				if ( ! $is_user_in_nabshow ) {
					self::set_group_for_user( 'nabshow', 'yes' );

					// Redirect back to the same page (per the POST-REDIRECT-GET pattern).
					// Please note the use of the `vip_vary_cache_did_send_headers` action.
					add_action( 'vip_vary_cache_did_send_headers', function() {
						wp_safe_redirect( add_query_arg( '' ) );
						exit;
					} );
				}
			}
		);

		add_filter(
			'the_content',
			function( $content ) {
				$is_user_in_beta = self::is_user_in_group_segment( 'nabshow', 'yes' );
				if ( $is_user_in_beta ) {
					$user = wp_get_current_user();
					if ( empty( $user->ID ) ) {
						$user = UrlCacheControl::RetreiveSetCurrentUser();
					}
				}
			}
		);

		if ( is_admin() ) {
			add_action(
				'admin_init',
				function() {
					$is_user_in_nabshow = self::is_user_in_group_segment( 'nabshow', 'yes' );
					if ( ! $is_user_in_nabshow ) {
						self::set_group_for_user( 'nabshow', 'yes' );
					}
				}
			);
		}
	}
}

new NabshowCacheControl();
