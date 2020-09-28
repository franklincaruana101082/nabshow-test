<?php
/**
 * Plugin Name: Zoom Purchased
 * Plugin URI:  https://www.multidots.com/
 * Description: This plugins generates zoom links for user who purchases content.
 * Version:     1.0.0
 * Author:      Multidots
 * Author URI:  multidots.com
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: zoom-purchased
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}



// Define constants.
define( 'ZP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'ZP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

require_once( plugin_dir_path( __FILE__ ) . 'inc/class-zoom-purchased.php' );

$zoom_purchased = new Zoom_Purchased();
$zoom_purchased->zp_init_hook();
