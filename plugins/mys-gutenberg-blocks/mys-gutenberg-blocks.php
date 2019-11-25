<?php
/**
 * Plugin Name: MYS Gutenberg Blocks
 * Plugin URI:  https://nabshow.com
 * Description: This plugin adds custom gutenberg blocks using Map Your Show (MYS) Data.
 * Version:     1.0.0
 * Author:      Multidots
 * Author URI:  multidots.com
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: mys-gutenberg-blocks
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

require_once( plugin_dir_path( __FILE__ ) . 'class-mys-gutenberg-blocks.php' );

require_once( plugin_dir_path( __FILE__ ) . 'includes/class-mysgb-ajax-handler.php' );

register_activation_hook( __FILE__, array( 'MYSGutenbergBlocks', 'mysgb_plugin_activation' ) );

$MYSGutenbergBlocks = new MYSGutenbergBlocks();
$MYSGutenbergBlocks->mysgb_init_hook();