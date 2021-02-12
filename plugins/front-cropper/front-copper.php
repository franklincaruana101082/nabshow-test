<?php
/**
 * @since             1.0.0
 * @package           front-cropper
 *
 * @wordpress-plugin
 * Plugin Name: The Front Cropper
 * Description: Plugin that crops images from front side.
 * Version:           1.0.0
 * Author:            multidots
 * Author URI:        https://www.multidots.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       front-cropper
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Define constants.
define( 'FRONT_CROPPER_URL', plugin_dir_url( __FILE__ ) );
define( 'FRONT_CROPPER_DIR', plugin_dir_path( __FILE__ ) );

require_once( FRONT_CROPPER_DIR . '/includes/class-front-cropper.php' );

$front_cropper = new Front_Cropper();
$front_cropper->fc_init_hook();
