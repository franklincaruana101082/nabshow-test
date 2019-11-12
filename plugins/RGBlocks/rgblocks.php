<?php
/**
 * Plugin Name: RGBlocks
 * Version: 1.0
 * Author: Multidots
 * Author URI: https://profiles.wordpress.org/dots
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: rgblocks
 *
 * Description: A beautiful collection of Ready-to-use Gutenberg blocks containing multiple elements which makes it easy for you to create better and awesome content.
 *
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin admin area. This file also includes all of the dependencies used by the plugin, registers the activation and deactivation functions, and defines a function that starts the plugin.
 *
 * @link: http://www.multidots.com/
 * @since: 1.0.0
 * @package: RGBlocks
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! defined( 'RGBLOCKS_VERSION' ) ) {
	define( 'RGBLOCKS_VERSION', '1.1' ); // Version of plugin.
}
if ( ! defined( 'RGBLOCKS_DIR' ) ) {
	define( 'RGBLOCKS_DIR', dirname( __FILE__ ) ); // Plugin dir.
}
if ( ! defined( 'RGBLOCKS_URL' ) ) {
	define( 'RGBLOCKS_URL', plugin_dir_url( __FILE__ ) ); // Plugin url.
}
if ( ! defined( 'RGBLOCKS_PLUGIN_BASENAME' ) ) {
	define( 'RGBLOCKS_PLUGIN_BASENAME', plugin_basename( __FILE__ ) ); // Plugin base name.
}

/**
 * Function to setup the plugin text domain.
 */
function rgblocks_load_text_domain() {

	global $wp_version;

	// Set filter for plugin's languages directory.
	$rgblocks_language_dir = dirname( plugin_basename( __FILE__ ) ) . '/languages/';
	$rgblocks_language_dir = apply_filters( 'rgblocks_languages_directory', $rgblocks_language_dir );

	// Traditional WordPress plugin locale filter.
	$get_locale = get_locale();

	if ( $wp_version >= 4.7 ) {
		$get_locale = get_user_locale();
	}

	// Traditional WordPress plugin locale filter.
	$locale = apply_filters( 'plugin_locale', $get_locale, 'rgblocks' );
	$mofile = sprintf( '%1$s-%2$s.mo', 'rgblocks', $locale );

	// Setup paths to current locale file.
	$mofile_global = WP_LANG_DIR . '/plugins/' . basename( RGBLOCKS_DIR ) . '/' . $mofile;

	if ( file_exists( $mofile_global ) ) {

		// Look in global /wp-content/languages/plugin-name folder.
		load_textdomain( 'rgblocks', $mofile_global );
	} else {

		// Load the default language files.
		load_plugin_textdomain( 'rgblocks', false, $rgblocks_language_dir );
	}
}

add_action( 'plugins_loaded', 'rgblocks_load_text_domain' );

/**
 * Function runs on plugin installation.
 */
function rgblocks_install() {
}

register_activation_hook( __FILE__, 'rgblocks_install' );

/**
 * Functions runs when uninstall the plugin.
 */
function rgblocks_uninstall() {
}

register_deactivation_hook( __FILE__, 'rgblocks_uninstall' );

// Admin Class File.
require_once( dirname( __FILE__ ) . '/includes/class.rgblocks-admin.php' );


add_action( 'rest_api_init', 'rgblocks_register_require_rest_route' );

/**
 * Register custom REST API route
 */
function rgblocks_register_require_rest_route() {

	require_once( dirname( __FILE__ ) . '/includes/class.rgblocks-rest-api.php' );

	$rgblocks_rest_api = new RGBlocks_REST_API();
	$rgblocks_rest_api->rgblocks_init_rest_route();
}