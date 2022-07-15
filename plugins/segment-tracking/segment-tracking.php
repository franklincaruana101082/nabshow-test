<?php
/**
 * Plugin Name: Segment Tracking
 * Plugin URI: https://nabshow.com/
 * Description: Sends track events to Segment asynchronously
 * Version: 1.0
 * Author: NAB
 * Author URI: https://nabshow.com/
 * Developer: NAB
 * Developer URI: https://nabshow.com/
 * Text Domain: segment-tracking
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */

 // Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once WP_PLUGIN_DIR . '/' . dirname( plugin_basename( __FILE__ ) ) . '/include/class-segment-tracking-db.php';
require_once WP_PLUGIN_DIR . '/' . dirname( plugin_basename( __FILE__ ) ) . '/include/class-segment-tracking.php';