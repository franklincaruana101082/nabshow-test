<?php
/**
 * Plugin Name: Custom MapYourShow Plugin
 * Plugin URI:  https://nabshow.com
 * Description: Pull the API for Session, Speaker, Track, Sponsor/Partner, Exhibitor and Exhibitor Category data from MapYourShow (MYS), including the creation of associated Gutenberg Blocks and Custom Post Types.
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
if ( ! defined( 'MYS_PLUGIN_DIR_PATH' ) ) {
	define( 'MYS_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
}
if ( ! defined( 'MYS_PLUGIN_BASENAME' ) ) {
	define( 'MYS_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
}

/**
 * Activation Hook
 *
 * Register plugin activation hook.
 *
 * @package MYS Modules
 * @since 1.0.0
 */
function mys_modules_install( $plugin ) {

	delete_option( 'nab_mys_credentials_valid' );
	update_option( 'nab_mys_show_wizard', 1 );

	if ( $plugin === plugin_basename( __FILE__ ) ) {
		wp_redirect( esc_url( admin_url( 'admin.php?page=mys-login' ) ) );
		exit();
	}
}

add_action( 'activated_plugin', 'mys_modules_install' );


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

//Class File - Admin Pages
require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/class-nab-mys-page.php' );

//Class File - DataBase Queries
require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/class-nab-mys-db.php' );

//Class File - Endpoints
require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/class-nab-mys-endpoints.php' );

//Class File - Exhibitors
require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/class-nab-mys-exhibitors.php' );

//Class File - Scripts & Styles
require_once( WP_PLUGIN_DIR . '/mys-modules/includes/class-nab-scripts.php' );

//Register MYS Dependent Post Types
require_once( WP_PLUGIN_DIR . '/mys-modules/includes/nab-post-types.php' );

//Develop Tracks Custom Fields
require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/class-nab-mys-tracks.php' );





add_filter( 'mime_types', 'wpse_mime_types' );
function wpse_mime_types( $existing_mimes ) {
	// Add csv to the list of allowed mime types
	$existing_mimes['csv'] = 'text/csv';

	return $existing_mimes;
}


ini_set('display_errors', 1);
error_reporting(E_ALL);
