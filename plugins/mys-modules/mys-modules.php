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
if ( ! defined( 'MYS_PLUGIN_VERSION' ) ) {
	define( 'MYS_PLUGIN_VERSION', '1.0.0' );
}
if ( ! defined( 'MYS_PLUGIN_URL' ) ) {
	define( 'MYS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}
if ( ! defined( 'MYS_PLUGIN_BASE' ) ) {
	define( 'MYS_PLUGIN_BASE', plugin_basename( __FILE__ ) );
}
if ( ! defined( 'MYS_PLUGIN_MODIFIED_SEQUENCE' ) ) {
	define( 'MYS_PLUGIN_MODIFIED_SEQUENCE', (int) get_option('test_modified_sequence') );
}
if ( ! defined( 'MYS_PLUGIN_DUMMY_HISTORY' ) ) {
	define( 'MYS_PLUGIN_DUMMY_HISTORY', (int) get_option('test_dummy_history') );
}
if ( ! defined( 'MYS_PLUGIN_ACTIVATE_SETTINGS' ) ) {
	define( 'MYS_PLUGIN_ACTIVATE_SETTINGS', (int) get_option('test_activate_settings') );
}

//Class File - Admin Pages
require_once( WP_PLUGIN_DIR . '/mys-modules/includes/class-nab-mys.php' );

function run_mys_modules() {
	$mys_plugin = new NAB_MYS_Main();
	$mys_plugin->nab_mys_run();
}

run_mys_modules();

/**
 * Activation Hook
 *
 * Register plugin activation hook.
 *
 * @package MYS Modules
 * @since 1.0.0
 */
add_action( 'activated_plugin', array ('NAB_MYS_Main', 'nab_mys_plugin_activate') );

/**
 * Deactivation Hook
 *
 * Register plugin deactivation hook.
 *
 * @package MYS Modules
 * @since 1.0.0
 */
register_deactivation_hook( __FILE__, array( 'NAB_MYS_Main', 'nab_mys_plugin_deactivate' ) );

//ne_temp remove this before PR.
add_filter( 'http_request_args', 'fergcorp_debug_url_request_args', 10, 2 );
function fergcorp_debug_url_request_args( $r, $url ) {
	$r["timeout"] = 20; //phpcs:ignore

	return $r;
}
