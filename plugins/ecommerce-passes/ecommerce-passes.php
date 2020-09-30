<?php
/**
 * Plugin Name: Amplify Ecommerce Integration
 * Plugin URI:  https://www.multidots.com/
 * Description: This plugins allow to get products from parent site.
 * Version:     1.0.0
 * Author:      Multidots
 * Author URI:  multidots.com
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: ecommerce-passes
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Define constants.
define( 'EP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'EP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'EP_COOKIE_BASE_DOMAIN', '.go-vip.net' );

require_once( plugin_dir_path( __FILE__ ) . 'inc/class-ecommerce-passes.php' );

$ecommerce_passes = new Ecommerce_Passes();
$ecommerce_passes->ep_init_hook();
