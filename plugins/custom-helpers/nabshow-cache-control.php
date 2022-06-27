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

// Load the VIP Vary_Cache class
require_once WPMU_PLUGIN_DIR . '/cache/class-vary-cache.php';

require WP_PLUGIN_DIR . '/custom-helpers/url-env-cache-control-helper/class-url-cache-control.php';

require_once WPMU_PLUGIN_DIR . '/misc.php';

use Automattic\VIP\Cache\Vary_Cache;

class NabshowCacheControl extends Vary_Cache{

	public function __construct() {
		// Register the `nabshow` group
		self::register_group( 'nabshow' );
		$this->init_enqueue_scripts();
	}

	public function init_enqueue_scripts() {

		add_action( 'wp_logout', [ $this, 'nabshow_logout_user_func' ] );
		add_action( 'wp_login', [ $this, 'nabshow_login_user_func' ] );

		add_action( 'init', [ $this, 'nabshow_init_func' ] );

	}

	public function nabshow_login_user_func( $user ) {
		
		$is_user_in_nabshow = self::is_user_in_group_segment( 'nabshow', 'yes' );
		if ( $is_user_in_nabshow ) {

		}
	}

	public function nabshow_logout_user_func( $user ) {
		
		$is_user_in_nabshow = self::is_user_in_group_segment( 'nabshow', 'yes' );
		if ( $is_user_in_nabshow ) {

		}

	}

	public function nabshow_init_func() {
		// phpcs:ignore WordPress.Security.NonceVerification.Missing
		$is_user_in_nabshow = self::is_user_in_group_segment( 'nabshow', 'yes' );
		if( empty($is_user_in_nabshow) ){

			if(is_user_logged_in()) self::enable_encryption();

			self::set_group_for_user( 'nabshow', 'yes' );
			// Redirect back to the same page (per the POST-REDIRECT-GET pattern).
			// Please note the use of the `vip_vary_cache_did_send_headers` action.
			add_action( 'vip_vary_cache_did_send_headers', function() {
				wp_safe_redirect( add_query_arg( '' ) );
				exit;
			} );
		}
	}
}
new NabshowCacheControl();
