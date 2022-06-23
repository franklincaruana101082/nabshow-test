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
require_once( WPMU_PLUGIN_DIR . '/misc.php' );
require(WP_PLUGIN_DIR . '/custom-helpers/url-env-cache-control-helper/class-url-cache-control.php');


// Load the VIP Vary_Cache class
require_once( WPMU_PLUGIN_DIR . '/cache/class-vary-cache.php' );


/**
 * Commands to manage automatic event execution
 */
use Automattic\VIP\Cache\Vary_Cache;

 class NabshowCacheControl extends Vary_Cache{
    function __construct()
    {
		// Register the `nabshow` group
		self::register_group( 'nabshow' );
		$this->init_enqueue_scripts();
	}

	function init_enqueue_scripts(){

		add_action( 'wp_logout', function() {
			do_action('wpcom_vip_check_for_404_and_remove_cache_headers', 'wp_add_header_no_cache');
		});

		add_action( 'init', function() {
			// phpcs:ignore WordPress.Security.NonceVerification.Missing
			$is_user_in_nabshow = self::is_user_in_group_segment( 'nabshow', 'yes' );
			if ( !$is_user_in_nabshow ) {
				self::set_group_for_user( 'nabshow', 'yes' );
			}

			// if( !is_user_logged_in() ) do_action('reloadAndReAuth', 'vip_vary_cache_did_send_headers');

			// do_action('qm/debug', is_user_logged_in());
			if( !is_user_logged_in() ) do_action('wp_send_co','wp_add_header_max_age');

		} );

		add_filter('set_current_user', function( $user ) {

			$is_user_in_nabshow = self::is_user_in_group_segment( 'nabshow', 'yes' );
			if ( !$is_user_in_nabshow ) {
				self::set_group_for_user( 'nabshow', 'yes' );
			}

			// if( !is_user_logged_in() ) $this->reloadAndReAuth();

			// do_action('qm/debug', is_user_logged_in());
			if( !is_user_logged_in() ) do_action('wp_send_co','wp_add_header_max_age');

			return $user;
		});

		add_filter( 'the_content', function( $content ) {
			$is_user_in_beta = self::is_user_in_group_segment( 'beta', 'yes' );
			if ( $is_user_in_beta ) {
				$user = wp_get_current_user();
				if(empty($user->ID)){
					$user = UrlCacheControl::RetreiveUser();
				}


			}

			// do_action('qm/debug', is_user_logged_in());



			return $content;
		} );
	}

	// function reloadAndReAuth(){

	// 	$user = UrlCacheControl::RetreiveUser();

	// 	do_action('wp_set_auth_cookie', $user->ID, true );

	// 	wp_admin_init();
	// 	wp_init();
	// 	// do_action('wp_add_header_max_age', 'admin_init');
	// 	// do_action('wp_add_header_max_age', 'wp');
	// 	// do_action('wp_add_header_no_cache', 'admin_init');
	// 	// do_action('wp_add_header_no_cache', 'wp');
	// 	// add_action('wp_add_header_max_age', 'admin_init');
	// 	// add_action('wp_add_header_max_age', 'wp');
	// }
}

new NabshowCacheControl();
