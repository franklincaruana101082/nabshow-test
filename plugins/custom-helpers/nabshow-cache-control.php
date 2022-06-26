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

// Load the VIP Vary_Cache class
require_once WPMU_PLUGIN_DIR . '/cache/class-vary-cache.php';

require WP_PLUGIN_DIR . '/custom-helpers/url-env-cache-control-helper/class-url-cache-control.php';

require WP_PLUGIN_DIR . '/user-switching/user-switching.php';

/**
 * Commands to manage automatic event execution
 */
use Automattic\VIP\Cache\Vary_Cache;

 class NabshowCacheControl extends Vary_Cache{
	private $user_switching = null;

    function __construct()
    {
		// Register the `nabshow` group
		self::register_group( 'nabshow-2022' );
		$this->init_enqueue_scripts();
	}

	function init_enqueue_scripts() {
		add_action( 'init', [ $this, 'nabshow_init_func' ] );

		add_filter( 'the_content', [ $this, 'nabshow_get_content' ] );

		add_action( 'wp_login', array( $this, 'nabshow_login_user_func' ) );

		add_action( 'wp_logout', array( $this, 'nabshow_logout_user_func') );

		add_action( 'admin_init', [ $this, 'nabshow_admin_init_func' ] );
	}

	public function nabshow_login_user_func( $user ) {
		$is_user_in_beta = self::is_user_in_group_segment( 'nabshow-2022', 'yes' );
		if ( $is_user_in_beta ) {
			if ( empty( $user->ID ) ) {
				$user = UrlCacheControl::RetreiveSetCurrentUser();
			}

			// if ( !empty( $user->ID ) ) {
				// do_action( 'switch_to_user', $user->ID );
			// }
			// error_log("logged in ".json_encode($user));
			// error_log("is_user_in_beta ".$is_user_in_beta);
			// 	do_action( 'switch_to_user', $user->ID );
			// }
		}
	}

	public function nabshow_logout_user_func( $user ) {
		$is_user_in_beta = self::is_user_in_group_segment( 'nabshow-2022', 'yes' );
		if ( $is_user_in_beta ) {
		}

		user_switching_clear_olduser_cookie();
		error_log(json_encode($user));
		error_log($is_user_in_beta);
		self::unload();
		error_log(json_encode($user));
		error_log($is_user_in_beta);

		}
	}

	public function nabshow_admin_init_func() {
		if ( is_admin() ) {
			$is_user_in_nabshow = self::is_user_in_group_segment( 'nabshow-2022', 'yes' );
			if ( ! $is_user_in_nabshow ) {
				self::set_group_for_user( 'nabshow-2022', 'yes' );
			}
			// $user_id = get_current_user_id();
			// if(!empty($user_id)) do_action( 'switch_to_user', $user_id );
		}
	}

	public function nabshow_init_func() {
		// phpcs:ignore WordPress.Security.NonceVerification.Missing
		$is_user_in_nabshow = self::is_user_in_group_segment( 'nabshow-2022', 'yes' );
		if ( ! $is_user_in_nabshow ) {
			self::set_group_for_user( 'nabshow-2022', 'yes' );

			// Redirect back to the same page (per the POST-REDIRECT-GET pattern).
			// Please note the use of the `vip_vary_cache_did_send_headers` action.
			add_action( 'vip_vary_cache_did_send_headers', function() {
				wp_safe_redirect( add_query_arg( [''] ) );
				exit;
			} );
		}
	}

	public function nabshow_get_content( $content ) {
		$is_user_in_beta = self::is_user_in_group_segment( 'nabshow-2022', 'yes' );
		if ( $is_user_in_beta ) {
			$user = wp_get_current_user();
			if ( empty( $user->ID ) ) {
				$user = UrlCacheControl::RetreiveSetCurrentUser();
			}
		}
		return $content;
	}
}
new NabshowCacheControl();

