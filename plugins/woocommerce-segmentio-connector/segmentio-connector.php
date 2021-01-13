<?php
/**
 * Plugin Name: WooCommerce Segment.com Connector
 * Plugin URI: https://woocommerce.com/products/segment-io-integration/
 * Description: Tracks WooCommerce's activity and sends it to Segment.com
 * Version: 1.9.3
 * Author: StoreApps
 * Author URI: https://www.storeapps.org/
 * Developer: StoreApps
 * Developer URI: https://www.storeapps.org/
 * Requires at least: 4.9.0
 * Tested up to: 5.5.3
 * WC requires at least: 2.5.0
 * WC tested up to: 4.7.1
 * Text Domain: woocommerce-segmentio-connector
 * Domain Path: /languages/
 * Woo: 272216:2cb3304ba665da511f420f271e30b244
 * Copyright (c) 2014-2020 WooCommerce, StoreApps All rights reserved.
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 *
 * @package woocommerce-segmentio-connector
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Required functions
 */
if ( ! function_exists( 'woothemes_queue_update' ) ) {
	require_once 'woo-includes/woo-functions.php';
}

/**
 * Plugin updates
 */
woothemes_queue_update( plugin_basename( __FILE__ ), '2cb3304ba665da511f420f271e30b244', '272216' );

if ( is_woocommerce_active() ) {

	/**
	 * Activation hook
	 */
	register_activation_hook( __FILE__, 'wc_segmentio_connector_activate' );

	/**
	 * Deactivation hook
	 */
	register_deactivation_hook( __FILE__, 'wc_segmentio_connector_deactivate' );

	/**
	 * Perform action on activation
	 */
	function wc_segmentio_connector_activate() {
		// segmentio/analytics-wordpress.php
		if ( ! function_exists( 'is_plugin_active' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}
		if ( is_plugin_active( 'segmentio/analytics-wordpress.php' ) ) {
			deactivate_plugins( 'segmentio/analytics-wordpress.php', false );
		}
		$google_analytics_settings = get_option( 'woocommerce_google_analytics_settings' );
		if ( ! empty( $google_analytics_settings['ga_id'] ) ) {
			update_option( 'temp_woocommerce_google_analytics_settings', $google_analytics_settings['ga_id'] );
			$google_analytics_settings['ga_id'] = '';
			update_option( 'woocommerce_google_analytics_settings', $google_analytics_settings );
		}
	}

	/**
	 * Perform action on deactivation
	 */
	function wc_segmentio_connector_deactivate() {
		$temp_woocommerce_google_analytics_settings = get_option( 'temp_woocommerce_google_analytics_settings' );
		if ( ! empty( $temp_woocommerce_google_analytics_settings ) ) {
			$google_analytics_settings          = get_option( 'woocommerce_google_analytics_settings' );
			$google_analytics_settings['ga_id'] = $temp_woocommerce_google_analytics_settings;
			update_option( 'woocommerce_google_analytics_settings', $google_analytics_settings );
		}
	}

	/**
	 * Load Segment.com connector
	 */
	add_action( 'plugins_loaded', 'wc_segmentio_connector_init' );

	/**
	 * Initialize Segment.com connector
	 */
	function wc_segmentio_connector_init() {
		require_once 'includes/class-wc-compatibility.php';
		if ( ! class_exists( 'WC_SegmentIo_Connector' ) ) {
			require_once WP_PLUGIN_DIR . '/' . dirname( plugin_basename( __FILE__ ) ) . '/includes/class-wc-segmentio-connector.php';
		}
	}

	/**
	 * Integrate Segment.com connector
	 *
	 * @param [array] Available WooCommerc Integration
	 * @return [array] WooCommerce Integration including Segment.com connector
	 */
	function add_segmentio_connector( $integrations ) {
		array_unshift( $integrations, 'WC_SegmentIo_Connector' );
		return $integrations;
	}

	/**
	 * Add Segment.com connector to WooCommerce Integration
	 */
	add_action( 'woocommerce_integrations', 'add_segmentio_connector' );

}
