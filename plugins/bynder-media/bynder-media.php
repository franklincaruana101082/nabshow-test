<?php
/**
 * @since             1.0.0
 * @package           bynder-media
 *
 * @wordpress-plugin
 * Plugin Name: The Bynder Media
 * Description: Plugin allows bynder assets to be uploaded and used in WordPress site.
 * Version:           1.0.0
 * Author:            multidots
 * Author URI:        https://www.multidots.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       bynder-media
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Define constants.
define( 'BYNDER_MEDIA_URL', plugin_dir_url( __FILE__ ) );
define( 'BYNDER_MEDIA_DIR', plugin_dir_path( __FILE__ ) );

require_once( BYNDER_MEDIA_DIR . '/includes/class-bynder-media.php' );

$bynder_media = new Bynder_Media();
$bynder_media->bm_init_hook();
