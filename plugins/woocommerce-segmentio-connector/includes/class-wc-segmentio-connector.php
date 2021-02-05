<?php
/**
 * Segment.com Integration
 *
 * Allows tracking events on your store & sending it to Segment.com
 *
 * @extends     WC_Integration
 * @version     1.1.3
 * @package     woocommerce-segmentio-connector/includes/
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WC_SegmentIo_Connector extends WC_Integration {

	/**
	 * @var string $version
	 */
	public $version = '1.9.3';

	/**
	 * @var string $api_key
	 */
	public $api_key;

	/**
	 * @var string $plugin_dirname
	 */
	public $plugin_dirname;

	/**
	 * @var array $event_names
	 */
	public $event_names = array();

	/**
	 * Constructor
	 */
	public function __construct() {

		// Integration unique id.
		$this->id = 'woosegmentioconnector';
		// Integration title.
		$this->method_title       = __( 'Segment.com Connector', 'woocommerce-segmentio-connector' );
		$this->method_description = __( 'Segment.com Connector lets you send your analytics data to any service you want, without you having to integrate with each one individually.', 'woocommerce-segmentio-connector' );

		$this->plugin_dirname = dirname( dirname( plugin_basename( __FILE__ ) ) );

		// Initialize form fields.
		$this->init_form_fields();

		// Initialize settings, load predifined settings.
		$this->init_settings();
		$this->api_key = ( ! empty( $_POST[ 'woocommerce_' . $this->id . '_api_key' ] ) ) ? sanitize_text_field( $_POST[ 'woocommerce_' . $this->id . '_api_key' ] ) : $this->settings['api_key'];

		if ( is_admin() ) {
			add_filter( 'woocommerce_settings_api_sanitized_fields_' . $this->id, array( $this, 'process_admin_options_fields' ) );
			add_action( 'woocommerce_update_options_integration_' . $this->id, array( $this, 'process_admin_options' ) );
			add_filter( 'plugin_action_links_' . $this->plugin_dirname . '/segmentio-connector.php', array( $this, 'plugin_action_links' ), 10, 2 );

		}

		if ( ! empty( $this->api_key ) ) {

			$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

			/**
			 * Hook to log any activity in your store
			 *
			 * Other plugins can use this hook to log  events generated from them
			 *
			 * @param [string] Name of the event (required)
			 * @param [array] Additioanl data for that event (optional)
			 * @param [int] Current user id (optional)
			 * @param [array] Current user data (optional)
			 */
			add_action( 'woocommerce_segmentio_connector_log_activity', array( $this, 'woocommerce_segmentio_connector_log_activity' ), 10, 4 );

			add_filter( 'woocommerce_segmentio_connector_identify_user', array( $this, 'intercom_segmentio_connector_identify_user' ), 10, 2 );

			$this->event_action = array(
				'signing_up'         => array(
					array(
						'action'   => 'register_form',
						'function' => array( $this, 'signing_up' ),
						'priority' => 10,
						'args'     => 1,
					),
				),
				'signed_up'          => array(
					array(
						'action'   => 'user_register',
						'function' => array( $this, 'signed_up' ),
						'priority' => 10,
						'args'     => 1,
					),
				),
				'signed_in'          => array(
					array(
						'action'   => 'wp_login',
						'function' => array( $this, 'signed_in' ),
						'priority' => 10,
						'args'     => 2,
					),
				),
				'signed_out'         => array(
					array(
						'action'   => 'wp_logout',
						'function' => array( $this, 'signed_out' ),
						'priority' => 10,
						'args'     => 1,
					),
				),
				'viewed_account'     => array(
					array(
						'action'   => 'woocommerce_after_my_account',
						'function' => array( $this, 'viewed_account' ),
						'priority' => 10,
						'args'     => 1,
					),
				),
				'password_changed'   => array(
					array(
						'action'   => 'woocommerce_customer_reset_password',
						'function' => array( $this, 'password_changed' ),
						'priority' => 10,
						'args'     => 1,
					),
					array(
						'action'   => 'profile_update',
						'function' => array( $this, 'password_changed' ),
						'priority' => 10,
						'args'     => 1,
					),
				),
				'address_updated'    => array(
					array(
						'action'   => 'woocommerce_customer_save_address',
						'function' => array( $this, 'address_updated' ),
						'priority' => 10,
						'args'     => 1,
					),
				),
				'track_posts'        => array(
					array(
						'action'   => 'wp_footer',
						'function' => array( $this, 'track_posts' ),
						'priority' => 10,
						'args'     => 1,
					),
				),
				'track_pages'        => array(
					array(
						'action'   => 'wp_footer',
						'function' => array( $this, 'track_pages' ),
						'priority' => 10,
						'args'     => 1,
					),
				),
				'track_archives'     => array(
					array(
						'action'   => 'wp_footer',
						'function' => array( $this, 'track_archives' ),
						'priority' => 10,
						'args'     => 1,
					),
				),
				'track_searches'     => array(
					array(
						'action'   => 'wp_footer',
						'function' => array( $this, 'track_searches' ),
						'priority' => 10,
						'args'     => 1,
					),
				),
				'viewed_product'     => array(
					array(
						'action'   => 'woocommerce_after_single_product',
						'function' => array( $this, 'viewed_product' ),
						'priority' => 10,
						'args'     => 1,
					),
				),
				'added_to_cart'      => array(
					array(
						'action'   => 'woocommerce_add_to_cart',
						'function' => array( $this, 'added_to_cart' ),
						'priority' => 10,
						'args'     => 6,
					),
					array(
						'action'   => 'wp_ajax_nopriv_woocommerce_add_to_cart',
						'function' => array( $this, 'ajax_added_to_cart' ),
						'priority' => 0,
						'args'     => 1,
					),
					array(
						'action'   => 'wp_ajax_woocommerce_add_to_cart',
						'function' => array( $this, 'ajax_added_to_cart' ),
						'priority' => 0,
						'args'     => 1,
					),
				),
				'removed_from_cart'  => array(
					array(
						'action'   => 'woocommerce_remove_cart_item',
						'function' => array( $this, 'removed_from_cart' ),
						'priority' => 10,
						'args'     => 1,
					),
					array(
						'action'   => 'woocommerce_before_cart_item_quantity_zero',
						'function' => array( $this, 'removed_from_cart' ),
						'priority' => 10,
						'args'     => 1,
					),
				),
				'viewed_cart'        => array(
					array(
						'action'   => 'woocommerce_after_cart_contents',
						'function' => array( $this, 'viewed_cart' ),
						'priority' => 10,
						'args'     => 1,
					),
					array(
						'action'   => 'woocommerce_cart_is_empty',
						'function' => array( $this, 'viewed_cart' ),
						'priority' => 10,
						'args'     => 1,
					),
				),
				'coupon_applied'     => array(
					array(
						'action'   => 'woocommerce_applied_coupon',
						'function' => array( $this, 'ajax_coupon_applied' ),
						'priority' => 10,
						'args'     => 1,
					),
					array(
						'action'   => 'wp_ajax_nopriv_woocommerce_apply_coupon',
						'function' => array( $this, 'ajax_coupon_applied' ),
						'priority' => 10,
						'args'     => 1,
					),
					array(
						'action'   => 'wp_ajax_woocommerce_apply_coupon',
						'function' => array( $this, 'ajax_coupon_applied' ),
						'priority' => 10,
						'args'     => 1,
					),
					array(
						'action'   => 'init',
						'function' => array( $this, 'coupon_applied' ),
						'priority' => 25,
						'args'     => 1,
					),
				),
				'checkout_started'   => array(
					array(
						'action'   => 'woocommerce_after_checkout_form',
						'function' => array( $this, 'checkout_started' ),
						'priority' => 10,
						'args'     => 1,
					),
				),
				'estimated_shipping' => array(
					array(
						'action'   => 'init',
						'function' => array( $this, 'estimated_shipping' ),
						'priority' => 25,
						'args'     => 1,
					),
				),
				'payment_started'    => array(
					array(
						'action'   => 'after_woocommerce_pay',
						'function' => array( $this, 'payment_started' ),
						'priority' => 10,
						'args'     => 1,
					),
				),
				'completed_purchase' => array(
					array(
						'action'   => 'woocommerce_checkout_order_processed',
						'function' => array( $this, 'completed_purchase' ),
						'priority' => 10,
						'args'     => 1,
					),
				),
				'viewed_order'       => array(
					array(
						'action'   => 'woocommerce_view_order',
						'function' => array( $this, 'viewed_order' ),
						'priority' => 10,
						'args'     => 1,
					),
				),
				'tracked_order'      => array(
					array(
						'action'   => 'init',
						'function' => array( $this, 'tracked_order' ),
						'priority' => 25,
						'args'     => 1,
					),
				),
				'file_downloaded'    => array(
					array(
						'action'   => 'woocommerce_download_product',
						'function' => array( $this, 'file_downloaded' ),
						'priority' => 10,
						'args'     => 6,
					),
				),
				'reordered'          => array(
					array(
						'action'   => 'widgets_init',
						'function' => array( $this, 'reordered' ),
						'priority' => 0,
						'args'     => 1,
					),
				),
				'order_cancelled'    => array(
					array(
						'action'   => 'widgets_init',
						'function' => array( $this, 'order_cancelled' ),
						'priority' => 0,
						'args'     => 1,
					),
				),
				'commented'          => array(
					array(
						'action'   => 'comment_post',
						'function' => array( $this, 'wrote_review_or_commented' ),
						'priority' => 10,
						'args'     => 1,
					),
				),
				'wrote_review'       => array(
					array(
						'action'   => 'comment_post',
						'function' => array( $this, 'wrote_review_or_commented' ),
						'priority' => 10,
						'args'     => 1,
					),
				),

			);

			foreach ( $this->event_action as $event => $actions ) {
				if ( ! empty( $this->event_names[ $event ] ) ) {
					foreach ( $actions as $action ) {
						if ( ! has_action( $action['action'], $action['function'] ) ) {
							add_action( $action['action'], $action['function'], $action['priority'], $action['args'] );
						}
					}
				}
			}

			add_action( 'wp_footer', array( $this, 'track_events_from_woocommerce_endpoints' ) );
			add_action( 'wp_footer', array( $this, 'send_event_data_store_in_session' ) );

		}

	}

	/**
	 * To handle WC compatibility related function call from appropriate class
	 *
	 * @param $function_name string
	 * @param $arguments array of arguments passed while calling $function_name
	 * @return result of function call
	 */
	public function __call( $function_name, $arguments = array() ) {
		if ( ! is_callable( 'Segmentio_Connector_WC_Compatibility', $function_name ) ) {
			return;
		}

		if ( ! empty( $arguments ) ) {
			return call_user_func_array( 'Segmentio_Connector_WC_Compatibility::' . $function_name, $arguments );
		} else {
			return call_user_func( 'Segmentio_Connector_WC_Compatibility::' . $function_name );
		}
	}

	/**
	 * Function to track WooCommerce newly added endpoints
	 */
	public function track_events_from_woocommerce_endpoints() {
		if ( empty( $_SERVER['REQUEST_URI'] ) ) {
			return;
		}
		$url = parse_url( $_SERVER['REQUEST_URI'] );
		if ( empty( $url['query'] ) ) {
			return;
		}
		$all_woocommerce_endpoints = $this->get_all_woocommerce_endpoints();

		$current_endpoint = '';
		foreach ( $all_woocommerce_endpoints as $woocommerce_endpoint ) {
			if ( $woocommerce_endpoint && strpos( $url['query'], $woocommerce_endpoint ) !== false ) {
				$current_endpoint = $woocommerce_endpoint;
				break;
			}
		}
		if ( ! empty( $current_endpoint ) ) {
			$endpoint_id = array_search( $current_endpoint, $all_woocommerce_endpoints, true );
			$event_name  = '';
			switch ( $endpoint_id ) {

				case 'woocommerce_checkout_pay_endpoint':
					$event_name = __( 'Payment started', 'woocommerce-segmentio-connector' );
					break;

				case 'woocommerce_checkout_order_received_endpoint':
					$event_name = __( 'Order received', 'woocommerce-segmentio-connector' );
					break;

				case 'woocommerce_myaccount_add_payment_method_endpoint':
					$event_name = __( 'Add payment method', 'woocommerce-segmentio-connector' );
					break;

				case 'woocommerce_myaccount_view_order_endpoint':
					$event_name = __( 'Viewed order', 'woocommerce-segmentio-connector' );
					break;

				case 'woocommerce_myaccount_edit_account_endpoint':
					$event_name = __( 'Edit account', 'woocommerce-segmentio-connector' );
					break;

				case 'woocommerce_myaccount_edit_address_endpoint':
					$event_name = __( 'Edit address', 'woocommerce-segmentio-connector' );
					break;

				case 'woocommerce_myaccount_lost_password_endpoint':
					$event_name = __( 'Lost password', 'woocommerce-segmentio-connector' );
					break;

				case 'woocommerce_logout_endpoint':
					$event_name = __( 'Logged out', 'woocommerce-segmentio-connector' );
					break;

			}
			if ( ! empty( $event_name ) ) {
				do_action( 'woocommerce_segmentio_connector_log_activity', $event_name );
			}
		}
	}

	/**
	 * Function to track WooCommerce newly added endpoints
	 *
	 * @global wpdb $wpdb
	 * @return array $all_woocommerce_endpoints
	 */
	public function get_all_woocommerce_endpoints() {
		global $wpdb;
		$all_woocommerce_endpoints = array();
		$results                   = $wpdb->get_results( "SELECT option_name, option_value FROM {$wpdb->prefix}options WHERE option_name LIKE 'woocommerce_%_endpoint'", 'ARRAY_A' );
		foreach ( $results as $result ) {
			$all_woocommerce_endpoints[ $result['option_name'] ] = $result['option_value'];
		}
		return $all_woocommerce_endpoints;
	}

	/**
	 * Method to track events & send data to Segment.com
	 *
	 * @param [string] Name of the event (required)
	 * @param [array] Additioanl data for that event (optional)
	 * @param [int] Current user id (optional)
	 * @param [array] Current user data (optional)
	 */
	public function woocommerce_segmentio_connector_log_activity( $event_name = '', $event_data = array(), $user_id = '', $user_data = array() ) {

		if ( empty( $event_name ) ) {
			return;
		}

		$user = wp_get_current_user();
		if ( isset( $this->settings['track_user_roles_event_name'] ) && $user->user_level >= $this->settings['track_user_roles_event_name'] ) {
			return;
		}

		if ( empty( $user_id ) && ! empty( $user->ID ) ) {
			$user_id = $user->ID;
		}

		if ( ! empty( $user_id ) && empty( $user_data ) ) {

			$identify = $this->get_current_user_identify();

			$billing_country_code  = ( ! empty( $user_data['billing_country'] ) ) ? $user_data['billing_country'] : get_user_meta( $user_id, 'billing_country', true );
			$shipping_country_code = ( ! empty( $user_data['shipping_country'] ) ) ? $user_data['shipping_country'] : get_user_meta( $user_id, 'shipping_country', true );
			$billing_state_code    = ( ! empty( $user_data['billing_state'] ) ) ? $user_data['billing_state'] : get_user_meta( $user_id, 'billing_state', true );
			$shipping_state_code   = ( ! empty( $user_data['shipping_state'] ) ) ? $user_data['shipping_state'] : get_user_meta( $user_id, 'shipping_state', true );

			$user_data = array(
				'registered_date'     => ( ! empty( $user_data['registered_date'] ) ) ? $user_data['registered_date'] : ( ! empty( $user->data->user_registered ) ? $user->data->user_registered : '' ),
				'user_role'           => ( ! empty( $user_data['user_role'] ) ) ? $user_data['user_role'] : ( ! empty( $user->roles ) ? reset( $user->roles ) : '' ),
				'first_name'          => ( ! empty( $user_data['first_name'] ) ) ? $user_data['first_name'] : trim( get_user_meta( $user_id, 'first_name', true ) ),
				'last_name'           => ( ! empty( $user_data['last_name'] ) ) ? $user_data['last_name'] : trim( get_user_meta( $user_id, 'last_name', true ) ),
				'paid_customer'       => ( ! empty( $user_data['paid_customer'] ) ) ? $user_data['paid_customer'] : ( get_user_meta( $user_id, 'paying_customer', true ) == 1 ? 'yes' : 'no' ),
				'order_count'         => ( ! empty( $user_data['order_count'] ) ) ? $user_data['order_count'] : get_user_meta( $user_id, '_order_count', true ),
				'billing_first_name'  => ( ! empty( $user_data['billing_first_name'] ) ) ? $user_data['billing_first_name'] : get_user_meta( $user_id, 'billing_first_name', true ),
				'billing_last_name'   => ( ! empty( $user_data['billing_last_name'] ) ) ? $user_data['billing_last_name'] : get_user_meta( $user_id, 'billing_last_name', true ),
				'billing_company'     => ( ! empty( $user_data['billing_company'] ) ) ? $user_data['billing_company'] : get_user_meta( $user_id, 'billing_company', true ),
				'billing_address_1'   => ( ! empty( $user_data['billing_address_1'] ) ) ? $user_data['billing_address_1'] : get_user_meta( $user_id, 'billing_address_1', true ),
				'billing_address_2'   => ( ! empty( $user_data['billing_address_2'] ) ) ? $user_data['billing_address_2'] : get_user_meta( $user_id, 'billing_address_2', true ),
				'billing_city'        => ( ! empty( $user_data['billing_city'] ) ) ? $user_data['billing_city'] : get_user_meta( $user_id, 'billing_city', true ),
				'billing_state'       => ( isset( WC()->countries->states[ $billing_country_code ][ $billing_state_code ] ) && WC()->countries->states[ $billing_country_code ][ $billing_state_code ] != '' ) ? WC()->countries->states[ $billing_country_code ][ $billing_state_code ] : $billing_state_code,
				'billing_country'     => ( isset( WC()->countries->countries[ $billing_country_code ] ) && WC()->countries->countries[ $billing_country_code ] != '' ) ? WC()->countries->countries[ $billing_country_code ] : $billing_country_code,
				'billing_postcode'    => ( ! empty( $user_data['billing_postcode'] ) ) ? $user_data['billing_postcode'] : get_user_meta( $user_id, 'billing_postcode', true ),
				'billing_email'       => ( ! empty( $user_data['billing_email'] ) ) ? $user_data['billing_email'] : get_user_meta( $user_id, 'billing_email', true ),
				'billing_phone'       => ( ! empty( $user_data['billing_phone'] ) ) ? $user_data['billing_phone'] : get_user_meta( $user_id, 'billing_phone', true ),
				'shipping_first_name' => ( ! empty( $user_data['shipping_first_name'] ) ) ? $user_data['shipping_first_name'] : get_user_meta( $user_id, 'shipping_first_name', true ),
				'shipping_last_name'  => ( ! empty( $user_data['shipping_last_name'] ) ) ? $user_data['shipping_last_name'] : get_user_meta( $user_id, 'shipping_last_name', true ),
				'shipping_company'    => ( ! empty( $user_data['shipping_company'] ) ) ? $user_data['shipping_company'] : get_user_meta( $user_id, 'shipping_company', true ),
				'shipping_address_1'  => ( ! empty( $user_data['shipping_address_1'] ) ) ? $user_data['shipping_address_1'] : get_user_meta( $user_id, 'shipping_address_1', true ),
				'shipping_address_2'  => ( ! empty( $user_data['shipping_address_2'] ) ) ? $user_data['shipping_address_2'] : get_user_meta( $user_id, 'shipping_address_2', true ),
				'shipping_city'       => ( ! empty( $user_data['shipping_city'] ) ) ? $user_data['shipping_city'] : get_user_meta( $user_id, 'shipping_city', true ),
				'shipping_state'      => ( isset( WC()->countries->states[ $shipping_country_code ][ $shipping_state_code ] ) && WC()->countries->states[ $shipping_country_code ][ $shipping_state_code ] != '' ) ? WC()->countries->states[ $shipping_country_code ][ $shipping_state_code ] : $shipping_state_code,
				'shipping_country'    => ( isset( WC()->countries->countries[ $shipping_country_code ] ) && WC()->countries->countries[ $shipping_country_code ] != '' ) ? WC()->countries->countries[ $shipping_country_code ] : $shipping_country_code,
				'shipping_postcode'   => ( ! empty( $user_data['shipping_postcode'] ) ) ? $user_data['shipping_postcode'] : get_user_meta( $user_id, 'shipping_postcode', true ),
			);

			if ( ! empty( $identify['traits'] ) ) {
				$user_data = array_merge( $identify['traits'], $user_data );
			}
		}

		if ( empty( $user_id ) && ! is_user_logged_in() ) {
			$ip        = str_replace( '.', '_', $_SERVER['REMOTE_ADDR'] );
			$user_id   = $ip;
			$user_data = array_merge(
				(array) $user_data, array(
					'ip_address' => $_SERVER['REMOTE_ADDR'],
					'visit_time' => date_i18n( 'D, d M Y H:i:s' ),
				)
			);
		}

		$segmentio_event_data = array();
		if ( WC()->session ) {
			$segmentio_event_data = WC()->session->get( 'segmentio_session_event_data' );
		}

		if ( empty( $segmentio_event_data ) || ! is_array( $segmentio_event_data ) ) {
			$segmentio_event_data = array();
		}

		$data = array(
			'api_key'    => $this->api_key,
			'async'      => get_option( '_wc_segmentio_async_load', 'yes' ),
			'event'      => $event_name,
			'properties' => (object) $event_data,
			'user_id'    => ( ! empty( $user_id ) ) ? $user_id : ( ( isset( $user->user_email ) && $user->user_email != '' ) ? $user->user_email : '' ),
			'traits'     => $user_data,
			'options'    => (object) array(
				'context' => array(
					'library' => array(
						'name'    => 'analytics-woocommerce',
						'version' => $this->version,
					),
				),
			),
			'logged_in'  => ( is_user_logged_in() ) ? 1 : 0,
		);

		if ( is_user_logged_in() && ! empty( $identify['options']['Intercom'] ) ) { // for intercom
			$data['user_id'] = ( isset( $user->user_email ) && $user->user_email != '' ) ? $user->user_email : $user_id;
		}

		$data = apply_filters( 'woocommerce_segmentio_connector_event_data', $data );

		$segmentio_event_data[] = $data;

		if ( WC()->session ) {
			WC()->session->set( 'segmentio_session_event_data', $segmentio_event_data );
		}

		$segmentio_event_data = ( WC()->session ) ? WC()->session->get( 'segmentio_session_event_data' ) : array();
	}

	/**
	 * Function to identify user for intercom integration
	 *
	 * @param array                  $identify
	 * @param WC_SegmentIo_Connector $segmentio_connector
	 * @return array $identify
	 */
	public function intercom_segmentio_connector_identify_user( $identify, $segmentio_connector ) {

		$user_email = ( ! empty( $identify['user_id'] ) ) ? $identify['user_id'] : '';

		if ( is_email( $user_email ) && ! empty( $segmentio_connector->settings['intercom_api_secret'] ) ) {

			$identify['options'] = isset( $identify['options'] ) ? $identify['options'] : array();

			$identify['options']['Intercom'] = array(
				// 'userHash' => hash( 'sha256', $segmentio_connector->settings['intercom_api_secret'] . $user_email )
				'userHash' => hash( 'sha256', $user_email ),
			);
		}

		return $identify;
	}

	/**
	 * Method to fill Segment.com connectore's setting fields with saved values in database
	 *
	 * @param [array] Event's name & their label
	 * @return [array] Event's name & their label with updated values
	 */
	public function process_admin_options_fields( $args ) {
		if ( isset( $this->event_names ) && count( $this->event_names ) > 0 ) {
			foreach ( $this->event_names as $event_name => $event_label ) {
				if ( ! empty( $event_label ) ) {
					$args[ $event_name ] = $event_label;
				}
			}
		}
		return $args;
	}

	/**
	 * Method to identify user & collect data associated with this user
	 *
	 * @access private
	 * @return [array] User's details
	 */
	private function get_current_user_identify() {
		$user      = wp_get_current_user();
		$commenter = array_filter( wp_get_current_commenter() );

		if ( is_user_logged_in() && $user ) {
			$identify = array(
				'user_id' => $user->user_email,
				'traits'  => array(
					'username'  => $user->user_login,
					'email'     => $user->user_email,
					'name'      => $user->display_name,
					'firstName' => $user->user_firstname,
					'lastName'  => $user->user_lastname,
					'url'       => $user->user_url,
				),
			);
		} elseif ( $commenter ) {
			$identify = array(
				'user_id' => $commenter['comment_author_email'],
				'traits'  => array(
					'email' => $commenter['comment_author_email'],
					'name'  => $commenter['comment_author'],
					'url'   => $commenter['comment_author_url'],
				),
			);
		} else {
			return false;
		}

		$identify['traits'] = array_filter( $identify['traits'] );

		/**
		 * Let other 3rd party developer modify user's identity
		 */

		return apply_filters( 'woocommerce_segmentio_connector_identify_user', $identify, $this );
	}

	/**
	 * Track if user is signing up
	 */
	public function signing_up() {
		if ( $this->not_page_reload() ) {
			do_action( 'woocommerce_segmentio_connector_log_activity', $this->event_names['signing_up'] );
		}
	}

	/**
	 * Track if user has signed up
	 */
	public function signed_up() {
		$identify = $this->get_current_user_identify();
		do_action( 'woocommerce_segmentio_connector_log_activity', $this->event_names['signed_up'], array(), $identify['user_id'], $identify['traits'] );
	}

	/**
	 * Track if user is loged in
	 */
	public function signed_in( $user_login, $user ) {
		$identify = $this->get_current_user_identify();
		do_action( 'woocommerce_segmentio_connector_log_activity', $this->event_names['signed_in'], array(), $identify['user_id'], $identify['traits'] );
	}

	/**
	 * Track if user has signed out
	 */
	public function signed_out() {
		do_action( 'woocommerce_segmentio_connector_log_activity', $this->event_names['signed_out'] );
	}

	/**
	 * Track if user viewed his account
	 */
	public function viewed_account() {
		do_action( 'woocommerce_segmentio_connector_log_activity', $this->event_names['viewed_account'] );
	}

	/**
	 * Track if password changed
	 *
	 * @param [int] User id
	 */
	public function password_changed( $user_id ) {

		if ( empty( $_POST['password_1'] ) && empty( $_POST['pass1'] ) ) {
			return;
		}

		do_action( 'woocommerce_segmentio_connector_log_activity', $this->event_names['password_changed'] );
	}

	/**
	 * Track if address is updated
	 *
	 * @param [int] User id
	 */
	public function address_updated( $user_id ) {
		do_action( 'woocommerce_segmentio_connector_log_activity', $this->event_names['address_updated'] );
	}

	/**
	 *  Track if user saw a post
	 */
	public function track_posts() {
		if ( is_woocommerce() ) {
			return;
		}
		if ( is_single() && ! is_attachment() ) {
			$event      = __( 'Viewed ' . ucfirst( get_post_type() ), 'woocommerce-segmentio-connector' );
			$properties = array(
				'title'    => single_post_title( '', false ),
				'category' => single_cat_title( '', false ),
			);
			do_action( 'woocommerce_segmentio_connector_log_activity', $event, $properties );
		}
	}

	/**
	 * Track if user visited a page
	 */
	public function track_pages() {
		if ( is_woocommerce() ) {
			return;
		}
		if ( is_front_page() ) {
			$event = __( 'Viewed Home Page', 'woocommerce-segmentio-connector' );
		} elseif ( is_page() ) {
			$event = __( 'Viewed ' . single_post_title( '', false ) . ' Page', 'woocommerce-segmentio-connector' );
		}
		if ( empty( $event ) ) {
			return;
		}
		do_action( 'woocommerce_segmentio_connector_log_activity', $event );
	}

	/**
	 * Track if user visited an archive page
	 */
	public function track_archives() {
		$properties = array();
		if ( is_woocommerce() ) {
			if ( is_shop() ) {
				$event              = __( 'Viewed product archive page', 'woocommerce-segmentio-connector' );
				$properties['name'] = __( 'Products', 'woocommerce-segmentio-connector' );
			} elseif ( is_product_category() ) {
				$event = __( 'Viewed product category page', 'woocommerce-segmentio-connector' );
				if ( ! empty( $_REQUEST['product_cat'] ) ) {
					$product_category = get_term_by( 'slug', $_REQUEST['product_cat'], 'product_cat', 'ARRAY_A' );
					if ( ! empty( $product_category ) ) {
						$properties['category'] = ( ! empty( $product_category['name'] ) ) ? $product_category['name'] : $product_category['slug'];
						$properties['name']     = __( 'Product Category', 'woocommerce-segmentio-connector' );
					}
				}
			} elseif ( is_product_tag() ) {
				$event = __( 'Viewed product tag page', 'woocommerce-segmentio-connector' );
				if ( ! empty( $_REQUEST['product_tag'] ) ) {
					$product_tag = get_term_by( 'slug', $_REQUEST['product_tag'], 'product_tag', 'ARRAY_A' );
					if ( ! empty( $product_tag ) ) {
						$properties['tag']  = ( ! empty( $product_tag['name'] ) ) ? $product_tag['name'] : $product_tag['slug'];
						$properties['name'] = __( 'Product Tag', 'woocommerce-segmentio-connector' );
					}
				}
			}
		} else {
			if ( is_author() ) {
				$author               = get_queried_object();
				$event                = __( 'Viewed Author Page', 'woocommerce-segmentio-connector' );
				$properties['author'] = $author->display_name;
				$properties['name']   = __( 'Author', 'woocommerce-segmentio-connector' );
			} elseif ( is_tag() ) {
				$event              = __( 'Viewed Tag Page', 'woocommerce-segmentio-connector' );
				$properties['tag']  = single_tag_title( '', false );
				$properties['name'] = __( 'Tag', 'woocommerce-segmentio-connector' );
			} elseif ( is_category() ) {
				$event                  = __( 'Viewed Category Page', 'woocommerce-segmentio-connector' );
				$properties['category'] = single_cat_title( '', false );
				$properties['name']     = __( 'Category', 'woocommerce-segmentio-connector' );
			} elseif ( is_home() ) {
				$event                  = __( 'Viewed blog archive page', 'woocommerce-segmentio-connector' );
				$properties['name']     = __( 'Blog Archive', 'woocommerce-segmentio-connector' );
			} else {
				$event = '';
			}
		}
		$properties['path']     = substr( $_SERVER['REQUEST_URI'], 0, strpos( $_SERVER['REQUEST_URI'], '?' ) );
		$properties['referrer'] = isset( $_SERVER['HTTP_REFERER'] ) ? sanitize_text_field( wp_unslash( $_SERVER['HTTP_REFERER'] ) ) : '';
		$properties['search']   = substr( $_SERVER['REQUEST_URI'], strpos( $_SERVER['REQUEST_URI'], '?' ) );
		$properties['url']      = ( is_ssl() ? 'https' : 'http' ) . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		if ( empty( $event ) ) {
			return;
		}
		do_action( 'woocommerce_segmentio_connector_log_activity', $event, $properties );
	}

	/**
	 * Track if user performs a search
	 */
	public function track_searches() {
		$properties = array();
		if ( is_search() ) {
			$event      = __( 'Viewed Search Page', 'woocommerce-segmentio-connector' );
			$properties = array( 'query' => get_query_var( 's' ) );
		} else {
			$event = '';
		}
		if ( empty( $event ) ) {
			return;
		}
		do_action( 'woocommerce_segmentio_connector_log_activity', $event, $properties );
	}

	/**
	 * Track if user saw a product
	 */
	public function viewed_product() {
		if ( $this->not_page_reload() ) {
			$event      = $this->event_names['viewed_product'];
			$properties = array(
				'name' => get_the_title(),
			);
			if ( is_singular( 'product' ) ) {
				$product    = wc_get_product( get_queried_object_id() );
				$product_id = ( $this->is_wc_gte_30() ) ? $product->get_id() : $product->id;
				$properties = array(
					'id'       => $product_id,
					'sku'      => $product->get_sku(),
					'name'     => html_entity_decode( $product->get_formatted_name() ),
					'price'    => $product->get_price(),
					'currency' => get_woocommerce_currency(),
					'category' => html_entity_decode( implode( ', ', wp_list_pluck( wc_get_product_terms( $product_id, 'product_cat' ), 'name' ) ) ),
				);
			}
			do_action( 'woocommerce_segmentio_connector_log_activity', $event, $properties );
		}
	}

	/**
	 * Track if user added a product to cart
	 *
	 * @param [string] Unique id of the item in cart
	 * @param [int] Product id
	 * @param [int] Product's quantity
	 * @param [int] Variation's id
	 * @param [array] Variation data
	 * @param [array] Additioanl data related to this item
	 */
	public function added_to_cart( $cart_item_key, $product_id, $quantity, $variation_id, $variation, $cart_item_data ) {

		if ( isset( $_POST['action'] ) ) {
			return;
		}

		$product = ( empty( $variation_id ) ) ? wc_get_product( $product_id ) : wc_get_product( $variation_id );

		$product_id = ( $this->is_wc_gte_30() ) ? $product->get_id() : $product->id;

		$properties = array();

		if ( $product ) {
			$properties = array(
				'id'       => ( empty( $variation_id ) ) ? $product_id : $variation_id,
				'sku'      => $product->get_sku(),
				'name'     => html_entity_decode( $product->get_formatted_name() ),
				'price'    => $product->get_price(),
				'quantity' => $quantity,
				'currency' => get_woocommerce_currency(),
				'category' => html_entity_decode( implode( ', ', wp_list_pluck( wc_get_product_terms( $product_id, 'product_cat' ), 'name' ) ) ),
			);

		}

		do_action( 'woocommerce_segmentio_connector_log_activity', $this->event_names['added_to_cart'], $properties );

	}

	/**
	 * Track if the product is added through ajax
	 */
	public function ajax_added_to_cart() {

		$product_id = ( empty( $_REQUEST['variation_id'] ) ) ? (int) apply_filters( 'woocommerce_add_to_cart_product_id', $_REQUEST['product_id'] ) : (int) apply_filters( 'woocommerce_add_to_cart_product_id', $_REQUEST['variation_id'] );

		$passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, 1 );

		if ( $passed_validation ) {
			$product    = wc_get_product( $product_id );
			$product_id = ( $this->is_wc_gte_30() ) ? $product->get_id() : $product->id;
			$properties = array();
			if ( $product ) {
				$properties = array(
					'id'       => $product_id,
					'sku'      => $product->get_sku(),
					'name'     => html_entity_decode( $product->get_formatted_name() ),
					'price'    => $product->get_price(),
					'quantity' => 1,
					'currency' => get_woocommerce_currency(),
					'category' => html_entity_decode( implode( ', ', wp_list_pluck( wc_get_product_terms( $product_id, 'product_cat' ), 'name' ) ) ),
				);

			}
			do_action( 'woocommerce_segmentio_connector_log_activity', $this->event_names['added_to_cart'], $properties );
		}
	}

	/**
	 * Track if a product is removed from cart
	 *
	 * @param [string] Unique id of the product in cart
	 */
	public function removed_from_cart( $cart_item_key ) {

		if ( ! is_object( WC()->cart ) ) {
			return;
		}

		$items     = WC()->cart->get_cart();
		$cart_item = $items[ $cart_item_key ];

		$product_id = ( empty( $cart_item['variation_id'] ) ) ? $cart_item['product_id'] : $cart_item['variation_id'];
		$product    = wc_get_product( $product_id );
		$product_id = ( $this->is_wc_gte_30() ) ? $product->get_id() : $product->id;
		$properties = array();

		if ( $product ) {
			$properties = array(
				'id'       => $product_id,
				'sku'      => $product->get_sku(),
				'name'     => html_entity_decode( $product->get_formatted_name() ),
				'price'    => $product->get_price(),
				'quantity' => 0,
				'currency' => get_woocommerce_currency(),
				'category' => html_entity_decode( implode( ', ', wp_list_pluck( wc_get_product_terms( $product_id, 'product_cat' ), 'name' ) ) ),
			);

		}

		do_action( 'woocommerce_segmentio_connector_log_activity', $this->event_names['removed_from_cart'], $properties );
	}

	/**
	 * Get properties of cart or order to track
	 *
	 * @param mixed $cart_or_order
	 */
	public function get_properties_from_cart_order( $cart_or_order = false ) {

		$properties = array();

		if ( $cart_or_order instanceof WC_Cart ) {

			$cart_items = $cart_or_order->get_cart();
			$items      = array();

			foreach ( $cart_items as $cart_item_key => $cart_item ) {

				$product    = ( empty( $cart_item['variation_id'] ) ) ? wc_get_product( $cart_item['product_id'] ) : wc_get_product( $cart_item['variation_id'] );
				$product_id = ( $this->is_wc_gte_30() ) ? $product->get_id() : $product->id;

				if ( $product ) {

					$items[] = array(
						'id'       => $product_id,
						'sku'      => $product->get_sku(),
						'name'     => html_entity_decode( $product->get_formatted_name() ),
						'price'    => $product->get_price(),
						'quantity' => $cart_item['quantity'],
						'currency' => get_woocommerce_currency(),
						'category' => html_entity_decode( implode( ', ', wp_list_pluck( wc_get_product_terms( $product_id, 'product_cat' ), 'name' ) ) ),
					);

				}
			}

			$revenue = $cart_or_order->total - $cart_or_order->tax_total - $cart_or_order->shipping_tax_total - $cart_or_order->shipping_total;
			if ( $revenue < 0 ) {
				$revenue = 0;
			}

			$properties['total']    = $cart_or_order->total;
			$properties['revenue']  = $revenue;
			$properties['shipping'] = $cart_or_order->shipping_total;
			$properties['tax']      = $cart_or_order->tax_total + $cart_or_order->shipping_tax_total;
			$properties['discount'] = $cart_or_order->get_total_discount();
			$properties['coupon']   = $cart_or_order->get_applied_coupons();
			$properties['products'] = $items;

		} elseif ( $cart_or_order instanceof WC_Order ) {

			if ( 'failed' !== $cart_or_order->get_status() ) {

				$order_items = $cart_or_order->get_items();
				$items       = array();

				foreach ( $order_items as $order_item_id => $order_item ) {

					$product = $cart_or_order->get_product_from_item( $order_item );

					if ( $product ) {

						$items[] = array(
							'id'       => ( empty( $order_item['variation_id'] ) ) ? $order_item['product_id'] : $order_item['variation_id'],
							'sku'      => $product->get_sku(),
							'name'     => html_entity_decode( $product->get_formatted_name() ),
							'price'    => $order_item['line_subtotal'],
							'quantity' => $order_item['qty'],
							'category' => html_entity_decode( implode( ', ', wp_list_pluck( wc_get_product_terms( $order_item['product_id'], 'product_cat' ), 'name' ) ) ),
						);

					}
				}

				$revenue = $cart_or_order->get_total() - $cart_or_order->get_total_tax() - $cart_or_order->get_total_shipping();
				if ( $revenue < 0 ) {
					$revenue = 0;
				}

				$properties['orderId']         = $cart_or_order->get_order_number();
				$properties['total']           = $cart_or_order->get_total();
				$properties['revenue']         = $revenue;
				$properties['shipping']        = $cart_or_order->get_total_shipping();
				$properties['tax']             = $cart_or_order->get_total_tax();
				$properties['discount']        = $cart_or_order->get_total_discount();
				$properties['coupon']          = ( $this->is_wc_gte_37() ) ? $cart_or_order->get_coupon_codes() : $cart_or_order->get_used_coupons();
				$properties['products']        = $items;
				$properties['status']          = $cart_or_order->get_status();
				$properties['currency']        = ( $this->is_wc_gte_30() ) ? $cart_or_order->get_currency() : $cart_or_order->get_order_currency();
				$properties['shipping_method'] = $cart_or_order->get_shipping_method();
				$properties['refund']          = $cart_or_order->get_refunds();

			}
		}

		return $properties;

	}

	/**
	 * Track if cart is viewed
	 */
	public function viewed_cart() {
		if ( $this->not_page_reload() ) {
			if ( ! is_object( WC()->cart ) ) {
				return;
			}

			$cart       = WC()->cart;
			$properties = $this->get_properties_from_cart_order( $cart );

			do_action( 'woocommerce_segmentio_connector_log_activity', $this->event_names['viewed_cart'], $properties );
		}
	}

	/**
	 * Track if coupon is applied throguh ajax
	 */
	public function ajax_coupon_applied() {
		if ( ! empty( $_REQUEST['coupon_code'] ) ) {
			$coupon = new WC_Coupon( stripslashes( trim( $_REQUEST['coupon_code'] ) ) );
			if ( $coupon->is_valid() ) {
				if ( $this->is_wc_gte_30() ) {
					$coupon_data = $coupon->get_data();
					$coupon_code = $coupon_data['code'];
				} else {
					$coupon_code = $coupon->code;
				}
				do_action( 'woocommerce_segmentio_connector_log_activity', $this->event_names['coupon_applied'], array( 'coupon' => $coupon_code ) );
			}
		}
	}

	/**
	 * Track if coupon is applied
	 */
	public function coupon_applied() {
		if ( ! empty( $_POST['apply_coupon'] ) && ! empty( $_POST['coupon_code'] ) ) {
			$coupon = new WC_Coupon( stripslashes( trim( $_POST['coupon_code'] ) ) );
			if ( $coupon->is_valid() && ! empty( $this->event_names['coupon_applied'] ) ) {
				if ( $this->is_wc_gte_30() ) {
					$coupon_data = $coupon->get_data();
					$coupon_code = $coupon_data['code'];
				} else {
					$coupon_code = $coupon->code;
				}
				do_action( 'woocommerce_segmentio_connector_log_activity', $this->event_names['coupon_applied'], array( 'coupon' => $coupon_code ) );
			}
		}
	}

	/**
	 * Track if user started with checkout
	 */
	public function checkout_started() {
		if ( $this->not_page_reload() ) {
			if ( ! is_object( WC()->cart ) ) {
				return;
			}

			$cart       = WC()->cart;
			$properties = $this->get_properties_from_cart_order( $cart );

			do_action( 'woocommerce_segmentio_connector_log_activity', $this->event_names['checkout_started'], $properties );
		}
	}

	/**
	 * Track if user calculated shipping
	 */
	public function estimated_shipping() {
		if ( ! empty( $_POST['calc_shipping'] ) && ! empty( $_POST['calc_shipping_country'] ) && ! empty( $this->event_names['estimated_shipping'] ) ) {
			do_action( 'woocommerce_segmentio_connector_log_activity', $this->event_names['estimated_shipping'], array( 'country' => $_POST['calc_shipping_country'] ) );
		}
	}

	/**
	 * Track if payment process started
	 */
	public function payment_started() {
		if ( $this->not_page_reload() ) {
			do_action( 'woocommerce_segmentio_connector_log_activity', $this->event_names['payment_started'] );
		}
	}

	/**
	 * Track if user completed the purchase
	 *
	 * @param [int] Generated order's id
	 */
	public function completed_purchase( $order_id ) {
		$order      = wc_get_order( $order_id );
		$properties = $this->get_properties_from_cart_order( $order );

		do_action( 'woocommerce_segmentio_connector_log_activity', $this->event_names['completed_purchase'], $properties );
	}

	/**
	 * Track if user viewed an order
	 *
	 * @param [int] Viewed order's id
	 */
	public function viewed_order( $order_id ) {
		$order      = wc_get_order( $order_id );
		$properties = $this->get_properties_from_cart_order( $order );

		do_action( 'woocommerce_segmentio_connector_log_activity', $this->event_names['viewed_order'], $properties );
	}

	/**
	 * Track if user tracked an order
	 */
	public function tracked_order() {
		if ( ! empty( $_POST['track'] ) && ! empty( $_POST['orderid'] ) && ! empty( $_POST['order_email'] ) && ! empty( $this->event_names['tracked_order'] ) ) {
			$order      = wc_get_order( $_POST['orderid'] );
			$properties = $this->get_properties_from_cart_order( $order );

			do_action( 'woocommerce_segmentio_connector_log_activity', $this->event_names['tracked_order'] );
		}
	}

	/**
	 * Track if a file is downloaded
	 *
	 * @param [string] Customer's email
	 * @param [string] Unique order key
	 * @param [int] Product id
	 * @param [int] User's id
	 * @param [string] Unique download key
	 * @param [int] Order id
	 */
	public function file_downloaded( $email, $order_key, $product_id, $user_id, $download_id, $order_id ) {
		$properties = array(
			'order_id'    => $order_id,
			'product'     => get_the_title( $product_id ),
			'email'       => $email,
			'download_id' => $download_id,
		);
		do_action( 'woocommerce_segmentio_connector_log_activity', $this->event_names['file_downloaded'], $properties );
	}

	/**
	 * Track if an order is ordered again
	 */
	public function reordered() {
		if ( ! empty( $this->event_names['reordered'] ) && ! empty( $_GET['order_again'] ) ) {
			do_action( 'woocommerce_segmentio_connector_log_activity', $this->event_names['reordered'] );
		}
	}

	/**
	 *  Track if an order is cancelled
	 */
	public function order_cancelled() {
		if ( isset( $_GET['cancel_order'] ) && isset( $_GET['order'] ) && isset( $_GET['order_id'] ) && ! empty( $this->event_names['order_cancelled'] ) ) {
			$order      = wc_get_order( $_GET['order_id'] );
			$properties = $this->get_properties_from_cart_order( $order );

			do_action( 'woocommerce_segmentio_connector_log_activity', $this->event_names['order_cancelled'], $properties );
		}
	}

	/**
	 * Track if user has commented or written a review
	 */
	public function wrote_review_or_commented() {

		$type = get_post_type();

		if ( $type == 'product' && ! empty( $this->event_names['wrote_review'] ) ) {
			do_action( 'woocommerce_segmentio_connector_log_activity', $this->event_names['wrote_review'], array( 'product name' => get_the_title() ) );
		} elseif ( ( $type == 'post' || $type == 'page' ) && ! empty( $this->event_names['commented'] ) ) {
			do_action( 'woocommerce_segmentio_connector_log_activity', $this->event_names['commented'], array( 'post title' => get_the_title() ) );
		}
	}

	/**
	 * Flag to check page reload
	 *
	 * @access private
	 * @return int
	 */
	private function not_page_reload() {
		return 1;
	}

	/**
	 * Method to collect event names & labels for Segment.com connectors setting
	 */
	public function init_form_fields() {

		$default_event_names = array(
			'signing_up'         => __( 'Registration form', 'woocommerce-segmentio-connector' ),
			'signed_up'          => __( 'New user registered', 'woocommerce-segmentio-connector' ),
			'signed_in'          => __( 'Logged in', 'woocommerce-segmentio-connector' ),
			'signed_out'         => __( 'Logged out', 'woocommerce-segmentio-connector' ),
			'viewed_account'     => __( 'Viewed account', 'woocommerce-segmentio-connector' ),
			'password_changed'   => __( 'Password changed', 'woocommerce-segmentio-connector' ),
			'address_updated'    => __( 'Address updated', 'woocommerce-segmentio-connector' ),
			'track_posts'        => __( 'Track post', 'woocommerce-segmentio-connector' ),
			'track_pages'        => __( 'Track page', 'woocommerce-segmentio-connector' ),
			'track_archives'     => __( 'Track archive', 'woocommerce-segmentio-connector' ),
			'track_searches'     => __( 'Track search', 'woocommerce-segmentio-connector' ),
			'viewed_product'     => __( 'Product Viewed', 'woocommerce-segmentio-connector' ),
			'added_to_cart'      => __( 'Product Added', 'woocommerce-segmentio-connector' ),
			'removed_from_cart'  => __( 'Product Removed', 'woocommerce-segmentio-connector' ),
			'viewed_cart'        => __( 'Cart Viewed', 'woocommerce-segmentio-connector' ),
			'coupon_applied'     => __( 'Coupon applied', 'woocommerce-segmentio-connector' ),
			'checkout_started'   => __( 'Checkout Started', 'woocommerce-segmentio-connector' ),
			'estimated_shipping' => __( 'Calculated shipping', 'woocommerce-segmentio-connector' ),
			'payment_started'    => __( 'Payment Info Entered', 'woocommerce-segmentio-connector' ),
			'completed_purchase' => __( 'Order Completed', 'woocommerce-segmentio-connector' ),
			'viewed_order'       => __( 'Order Viewed', 'woocommerce-segmentio-connector' ),
			'tracked_order'      => __( 'Tracked order', 'woocommerce-segmentio-connector' ),
			'file_downloaded'    => __( 'File downloaded', 'woocommerce-segmentio-connector' ),
			'reordered'          => __( 'Re-ordered', 'woocommerce-segmentio-connector' ),
			'order_cancelled'    => __( 'Order cancelled', 'woocommerce-segmentio-connector' ),
			'commented'          => __( 'Commented', 'woocommerce-segmentio-connector' ),
			'wrote_review'       => __( 'Reviewed product', 'woocommerce-segmentio-connector' ),
			'pay'                => __( 'Pay', 'woocommerce-segmentio-connector' ),
			'order_received'     => __( 'Order received', 'woocommerce-segmentio-connector' ),
			'add_payment_method' => __( 'Add payment method', 'woocommerce-segmentio-connector' ),
			'view_order'         => __( 'View order', 'woocommerce-segmentio-connector' ),
			'edit_account'       => __( 'Edit account', 'woocommerce-segmentio-connector' ),
			'edit_address'       => __( 'Edit address', 'woocommerce-segmentio-connector' ),
			'lost_password'      => __( 'Lost password', 'woocommerce-segmentio-connector' ),
			'logout'             => __( 'Logout', 'woocommerce-segmentio-connector' ),
		);

		$this->event_names = apply_filters( 'wc_segmentio_event_names', $default_event_names );

		$default_form_fields = array(
			'api_settings_section'        => array(
				'title'       => __( 'API settings', 'woocommerce-segmentio-connector' ),
				'description' => __( 'Enter your Write/API key to start tracking.', 'woocommerce-segmentio-connector' ),
				'type'        => 'title',
				'default'     => '',
			),
			'api_key'                     => array(
				'title'       => __( 'Write/API key', 'woocommerce-segmentio-connector' ),
				'description' => __( 'Log into your Segment account and go to Sources. Select a source to get Write/API key. Leave blank to disable tracking.', 'woocommerce-segmentio-connector' ),
				'type'        => 'text',
				'default'     => '',
			),
			'user_roles_section'          => array(
				'title'       => __( 'User roles', 'woocommerce-segmentio-connector' ),
				'description' => __( 'Configurations for user role.', 'woocommerce-segmentio-connector' ),
				'type'        => 'title',
				'default'     => '',
			),
			'track_user_roles_event_name' => array(
				'title'       => __( 'Users to Ignore', 'woocommerce-segmentio-connector' ),
				'description' => __( 'Users of the role you select and higher will be ignored.', 'woocommerce-segmentio-connector' ),
				'type'        => 'select',
				'default'     => '11',
				'options'     => array(
					'11' => __( 'No One', 'woocommerce-segmentio-connector' ),
					'8'  => __( 'Administrators and Up', 'woocommerce-segmentio-connector' ),
					'5'  => __( 'Editors and Up', 'woocommerce-segmentio-connector' ),
					'2'  => __( 'Authors and Up', 'woocommerce-segmentio-connector' ),
					'1'  => __( 'Contributors and Up', 'woocommerce-segmentio-connector' ),
					'0'  => __( 'Everyone!', 'woocommerce-segmentio-connector' ),
				),
			),
			'intercom_api_secret'         => array(
				'title'       => __( 'Intercom API secret', 'woocommerce-segmentio-connector' ),
				'description' => __( 'Enter your Intercom API key here to use Secure Mode. Your Intercom API key is found in Intercom’s secure mode setup guide.', 'woocommerce-segmentio-connector' ),
				'type'        => 'text',
				'default'     => '',
			),
			'default_event_names_section' => array(
				'title'       => __( 'Event names currently being tracked', 'woocommerce-segmentio-connector' ),
				'description' => __( implode( '<br>', $this->event_names ), 'woocommerce-segmentio-connector' ),
				'type'        => 'title',
				'default'     => '',
			),
		);

		$this->form_fields = $default_form_fields;
	}

	/**
	 * Validate Api Key Field.
	 *
	 * Make sure the data is escaped correctly, etc.
	 *
	 * @param  string      $key Field key
	 * @param  string|null $value Posted Value
	 * @return string
	 */
	public function validate_api_key_field( $key, $value ) {
		$value = is_null( $value ) ? '' : $value;
		return wp_kses_post( trim( stripslashes( $value ) ) );
	}

	/**
	 * Validate Track User Roles Event Name Field.
	 *
	 * Make sure the data is escaped correctly, etc.
	 *
	 * @param  string      $key Field key
	 * @param  string|null $value Posted Value
	 * @return string
	 */
	public function validate_track_user_roles_event_name_field( $key, $value ) {
		$value = is_null( $value ) ? '' : $value;
		return wc_clean( stripslashes( $value ) );
	}

	/**
	 * Validate Intercom Api Secret Field.
	 *
	 * Make sure the data is escaped correctly, etc.
	 *
	 * @param  string      $key Field key
	 * @param  string|null $value Posted Value
	 * @return string
	 */
	public function validate_intercom_api_secret_field( $key, $value ) {
		$value = is_null( $value ) ? '' : $value;
		return wp_kses_post( trim( stripslashes( $value ) ) );
	}

	/**
	 * Method to generate HTML form for displaying Segment.com connectors form fields
	 *
	 * @param [string] Identification of form elements
	 * @param [string|array] values of form fields
	 * @return [string] Output string in HTML format
	 */
	public function generate_section_html( $key, $data ) {
		$html = '';

		if ( isset( $data['title'] ) && $data['title'] != '' ) {
			$title = $data['title'];
		} else {
			$title = '';
		}
		$data['class'] = ( isset( $data['class'] ) ) ? $data['class'] : '';
		$data['css']   = ( isset( $data['css'] ) ) ? $data['css'] : '';

		$html .= '<tr valign="top">' . "\n";
		$html .= '<th scope="row" colspan="2">';
		$html .= '<h3 style="margin:0;">' . $data['title'] . '</h3>';
		if ( $data['description'] ) {
			$html .= '<p>' . $data['description'] . '</p>';
		}
		$html .= '</th>' . "\n";
		$html .= '</tr>' . "\n";

		return $html;
	}

	/**
	 * Add link for configuration of Segment.com connector
	 *
	 * @param [array] Available actions
	 * @param [string] Plugin's file to identify plugin
	 * @return [array] Array fo plugin manage link with links
	 */
	public function plugin_action_links( $actions, $plugin_file ) {

		$args         = array(
			'page'    => 'wc-settings',
			'tab'     => 'integration',
			'section' => $this->id,
		);
		$settings_url = add_query_arg( $args, admin_url( 'admin.php' ) );

		$action_links = array(
			'settings' => '<a target="_blank" href="' . esc_url( $settings_url ) . '">' . __( 'Settings', 'woocommerce-segmentio-connector' ) . '</a>',
			'docs'     => '<a target="_blank" href="' . esc_url( 'https://docs.woocommerce.com/document/segment-io-connector/' ) . '">' . __( 'Docs', 'woocommerce-segmentio-connector' ) . '</a>',
			'support'  => '<a target="_blank" href="' . esc_url( 'https://woocommerce.com/my-account/create-a-ticket/' ) . '">' . __( 'Support', 'woocommerce-segmentio-connector' ) . '</a>',
			'review'   => '<a target="_blank" href="' . esc_url( 'https://woocommerce.com/products/segment-io-integration/#comments' ) . '">' . __( 'Review', 'woocommerce-segmentio-connector' ) . '</a>',
		);

		return array_merge( $action_links, $actions );

	}

	/**
	 * Send event's data stored in session to Segment.com
	 */
	public function send_event_data_store_in_session() {

		$segmentio_session_event_data = WC()->session->get( 'segmentio_session_event_data' );

		if ( empty( $segmentio_session_event_data ) ) {
			return;
		}

		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		if ( ! wp_script_is( 'segmentio_connector' ) ) {
			wp_enqueue_script( 'segmentio_connector', plugins_url( $this->plugin_dirname . '/assets/js/segmentio' . $suffix . '.js' ), array(), get_bloginfo( 'version' ), true );
		}

		if ( ! wp_script_is( 'segmentio_actions' ) ) {
			wp_enqueue_script( 'segmentio_actions', plugins_url( $this->plugin_dirname . '/assets/js/segmentio-actions.js' ), array( 'segmentio_connector' ), get_bloginfo( 'version' ), true );
		}

		$js = '';
		foreach ( $segmentio_session_event_data as $data ) {
			$js .= "wooSegmentioSendData('" . addslashes( wp_json_encode( $data ) ) . "');
					";
		}

		wc_enqueue_js( $js );

		WC()->session->set( 'segmentio_session_event_data', '' );

	}

}
