<?php
/**
 * Plugin Name: Ecommerce Passes
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

require_once( plugin_dir_path( __FILE__ ) . 'inc/class-ecommerce-passes.php' );

$ecommerce_passes = new Ecommerce_Passes();
$ecommerce_passes->ep_init_hook();