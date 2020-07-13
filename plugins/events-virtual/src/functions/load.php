<?php
/**
 * Provides functions to handle the loading operations of the plugin.
 *
 * The functions are defined in the global namespace to allow easier loading in the main plugin file.
 *
 * @since 1.0.0
 */

/**
 * Shows a message to indicate the plugin cannot be loaded due to missing requirements.
 *
 * @since 1.0.0
 */
function tribe_events_virtual_show_fail_message() {
	if ( ! current_user_can( 'activate_plugins' ) ) {
		return;
	}

	$lang_dir = dirname( EVENTS_VIRTUAL_FILE ) . '/lang';

	$mopath = trailingslashit( $lang_dir );
	$domain = 'events-virtual';

	// If we don't have Common classes load the old fashioned way.
	if ( ! class_exists( 'Tribe__Main' ) ) {
		load_plugin_textdomain( $domain, false, $mopath );
	} else {
		// This will load `wp-content/languages/plugins` files first.
		Tribe__Main::instance()->load_text_domain( $domain, $mopath );
	}

	$url = 'plugin-install.php?tab=plugin-information&plugin=the-events-calendar&TB_iframe=true';

	$message = sprintf(
		'%1s <a href="%2s" class="thickbox" title="%3s">%3$s</a>.',
		esc_html__(
			'To begin using Virtual Events, please install the latest version of',
			'events-virtual'
		),
		esc_url( $url ),
		esc_html__( 'The Events Calendar', 'events-virtual' )
	);

	// The message HTML is escaped in the line above.
	// phpcs:ignore
	echo '<div class="error"><p>' . $message . '</p></div>';
}

/**
 * Register and load the service provider for loading the plugin.
 *
 * The function will detect the presence of Common and TEC and decline to load if not found.
 *
 * @since 1.0.0
 *
 * @return bool Whether the plugin did load successfully or not.
 */
function tribe_events_virtual_preload() {
	if ( ! (
		function_exists( 'tribe_register_provider' )
		&& class_exists( 'Tribe__Abstract_Plugin_Register' )
	) ) {
		// Loaded in single site or not network-activated in a multisite installation.
		add_action( 'admin_notices', 'tribe_events_virtual_show_fail_message' );
		// Network-activated in a multisite installation.
		add_action( 'network_admin_notices', 'tribe_events_virtual_show_fail_message' );
		// Prevent loading of the plugin if common is loaded (better safe than sorry).
		remove_action( 'tribe_common_loaded', 'tribe_events_virtual_load' );

		return false;
	}

	return true;
}

/**
 * Register and load the service provider for loading the plugin.
 *
 * @since 1.0.0
 */
function tribe_events_virtual_load() {
	tribe_register_provider( \Tribe\Events\Virtual\Plugin::class );
}

/**
 * Handles the removal of PUE-related options when the plugin is uninstalled.
 *
 * @since 1.0.0
 */
function tribe_events_virtual_uninstall() {
	$slug = 'events_virtual';

	delete_option( 'pue_install_key_' . $slug );
	delete_option( 'pu_dismissed_upgrade_' . $slug );
}
