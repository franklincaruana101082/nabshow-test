<?php
/**
 * Plugin Name: Home Headliner Block
 * Description: Home Headliner Block is for drawing attention to something special at the top of the homepage.
 * Author: Matt Spaanem
 * Author URI: https://spaanem.com/
 * Version: 1.0.0
 * License: GPL2+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.txt
 *
 * @package CGB
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Block Initializer.
 */
require_once plugin_dir_path( __FILE__ ) . 'src/init.php';
