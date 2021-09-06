<?php
/**
 * Plugin Name: Segment Events Tracking
 * Plugin URI: https://www.multidots.com/
 * Description: Tracks the site activity and sends it to Segment.com
 * Version: 1.0
 * Author: Multidots
 * Author URI: https://www.multidots.com/
 * Developer: Multidots
 * Developer URI: https://www.multidots.com/
 * Text Domain: segment-events-tracking
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */

 // Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once WP_PLUGIN_DIR . '/' . dirname( plugin_basename( __FILE__ ) ) . '/include/class-segment-event-db.php';
require_once WP_PLUGIN_DIR . '/' . dirname( plugin_basename( __FILE__ ) ) . '/include/class-segment-event-tracking.php';