<?php
/*
Plugin Name: The Events Calendar: Virtual Events
Description: Virtual Events is an add-on to The Events Calendar suite of products that optimizes your calendar, tickets, and email notifications for virtual events.
Version: 1.0.2
Author: Modern Tribe, Inc.
Author URI: http://m.tri.be/20
Text Domain: events-virtual
License: GPLv2 or later
*/

/*
Copyright 2010-2012 by Modern Tribe Inc and the contributors

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/


define( 'EVENTS_VIRTUAL_FILE', __FILE__ );

// Load the required php min version functions.
require_once dirname( EVENTS_VIRTUAL_FILE ) . '/src/functions/php-min-version.php';

// Load Composer autoload file only if we've not included this file already.
require_once dirname( EVENTS_VIRTUAL_FILE ) . '/vendor/autoload.php';

/**
 * Verifies if we need to warn the user about min PHP version and bail to avoid fatal errors.
 */
if ( tribe_is_not_min_php_version() ) {
	tribe_not_php_version_textdomain( 'events-virtual', EVENTS_VIRTUAL_FILE );

	/**
	 * Include the plugin name into the correct place.
	 *
	 * @since  1.0.1
	 *
	 * @param  array $names current list of names.
	 *
	 * @return array List of names after adding Events Virtual.
	 */
	function tribe_events_virtual_not_php_version_plugin_name( $names ) {
		$names['events-virtual'] = esc_html__( 'Events Virtual', 'events-virtual' );
		return $names;
	}

	add_filter( 'tribe_not_php_version_names', 'tribe_events_virtual_not_php_version_plugin_name' );

	if ( ! has_filter( 'admin_notices', 'tribe_not_php_version_notice' ) ) {
		add_action( 'admin_notices', 'tribe_not_php_version_notice' );
	}

	return false;
}

// Include the file that defines the functions handling the plugin load operations.
require_once __DIR__ . '/src/functions/load.php';

// Add a second action to handle the case where Common is not loaded, we still want to let the user know what is happening.
add_action( 'plugins_loaded', 'tribe_events_virtual_preload', 50 );

// Loads after common is already properly loaded.
add_action( 'tribe_common_loaded', 'tribe_events_virtual_load' );

add_action( 'plugins_loaded', 'nab_event_remove_plugin_filter' );
function nab_event_remove_plugin_filter() {
	nab_remove_class_hook( 'tribe-events-save-options', 'Tribe__Tickets__Cache__Central', 'reset_all_filter_passthru' );
}

function nab_remove_class_hook( $tag, $class_name = '', $method_name = '', $priority = 10 ) {
    global $wp_filter;
    $is_hook_removed = false;
    if ( ! empty( $wp_filter[ $tag ]->callbacks[ $priority ] ) ) {
	    $methods     = wp_list_pluck( $wp_filter[ $tag ]->callbacks[ $priority ], 'function' );
	    $found_hooks = ! empty( $methods ) ? wp_list_filter( $methods, array( 1 => $method_name ) ) : array();
	    foreach( $found_hooks as $hook_key => $hook ) {
	    	if ( ! empty( $hook[0] ) && is_object( $hook[0] ) && get_class( $hook[0] ) === $class_name ) {
	    		$wp_filter[ $tag ]->remove_filter( $tag, $hook, $priority );
	    		$is_hook_removed = true;
	    	}
	    }
    }
    return $is_hook_removed;
}