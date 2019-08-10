<?php
/**
 * Plugin Name: Map Your Show Modules
 * Plugin URI:  https://nabshow.com
 * Description: Includes NABShow LV modules as Gutenberg Blocks and their Required Post Types which are dependent on Map Your Show (MYS) API.
 * Version:     1.0.0
 * Author:      Multidots
 * Author URI:  multidots.com
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Basic plugin definitions
 *
 * @package MYS Modules
 * @since 1.0.0
 */
if ( ! defined( 'MYS_PLUGIN_URL' ) ) {
	define( 'MYS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}
if ( ! defined( 'MYS_PLUGIN_DIR' ) ) {
	define( 'MYS_PLUGIN_DIR', dirname( __FILE__ ) );
}
if ( ! defined( 'MYS_PLUGIN_DIR_PATH' ) ) {
	define( 'MYS_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
}
if ( ! defined( 'MYS_PLUGIN_BASENAME' ) ) {
	define( 'MYS_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
}
if ( ! defined( 'MYS_PLUGIN_API' ) ) {
	define( 'MYS_PLUGIN_API', 'https://api.mapyourshow.com/mysRest/v2/' );
}

/**
 * Activation Hook
 *
 * Register plugin activation hook.
 *
 * @package MYS Modules
 * @since 1.0.0
 */
register_activation_hook( __FILE__, 'mys_modules_install' );

/**
 * Plugin Setup (On Activation)
 *
 * @package MYS Modules
 * @since 1.0.0
 */
/*function mys_modules_install() {

	add_option( 'nab_mys_show_wizard', "1" );

	//ne_temp below code for wizard test
	//update_option('nab_mys_show_wizard', 1);
	//update_option( 'nab_mys_credentials_valid', 'no' );


	delete_option( 'nab_mys_credentials_valid' );
	exit( wp_redirect( admin_url( 'admin.php?page=mys-login' ) ) );


}*/
/*update_option('nab_mys_show_wizard', 0);
update_option( 'nab_mys_credentials_valid', 'yes' );*/
function cyb_activation_redirect( $plugin ) {

	delete_option( 'nab_mys_credentials_valid' );
	update_option( 'nab_mys_show_wizard', 1 );

	if ( $plugin == plugin_basename( __FILE__ ) ) {
		wp_redirect( esc_url( admin_url( 'admin.php?page=mys-login' ) ) );
		exit();
	}
}

add_action( 'activated_plugin', 'cyb_activation_redirect' );


/**
 * Deactivation Hook
 *
 * Register plugin deactivation hook.
 *
 * @package MYS Modules
 * @since 1.0.0
 */
register_deactivation_hook( __FILE__, 'mys_modules_uninstall' );

/**
 * Plugin Setup (On Deactivation)
 *
 * @package MYS Modules
 * @since 1.0.0
 */
function mys_modules_uninstall() {

	//Delete a MYS API Token from Transient Cache
	delete_transient( 'nab_mys_token' );

	delete_option( 'nab_mys_show_wizard' );

}

//Class File - Admin Page
require_once( MYS_PLUGIN_DIR . '/includes/admin/class-nab-mys-page.php' );

//Class File - Endpoints
require_once( MYS_PLUGIN_DIR . '/includes/admin/class-nab-mys-endpoints.php' );

//Class File - Scripts & Styles
require_once( MYS_PLUGIN_DIR . '/includes/class-nab-scripts.php' );

//Register MYS Dependent Post Types
require_once( MYS_PLUGIN_DIR . '/includes/nab-post-types.php' );

/**
 * Temporarily Setting Custom Timeout for the HTTP request to prevent 500 errors of MYS Responses.
 *
 * @param $timeout_value Default Timeout (i.e. 5 seconds)
 *
 * @return int Allowed Custom Timeout in Seconds
 */
/*function sar_custom_http_request_timeout( $timeout_value ) {
	return 20; // 30 seconds. Too much for production, only for testing.
}
add_filter( 'http_request_timeout', 'sar_custom_http_request_timeout', 9999 );*/

add_filter( 'acf/settings/remove_wp_meta_box', '__return_false' );
