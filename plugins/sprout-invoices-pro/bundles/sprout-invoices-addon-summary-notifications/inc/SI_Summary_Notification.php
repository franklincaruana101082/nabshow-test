<?php

/**
 * Dashboard Notifications Controller
 *
 * @package Sprout_Invoice
 */
class SI_Summary_Notification extends SI_Notifications {


	public static function init() {
		add_filter( 'si_invoice_notifications_manually_send', array( __CLASS__, 'add_to_manual_send' ), 20 );
		add_filter( 'si_estimate_notifications_manually_send', array( __CLASS__, 'add_to_est_manual_send' ), 20 );
		add_filter( 'si_send_notification_data', array( __CLASS__, 'add_records_data_to_notification_data' ), 10, 2 );

		// register notifications
		add_filter( 'sprout_notifications', array( __CLASS__, 'register_notifications' ), 100 );

		add_filter( 'sprout_notification_shortcodes', array( __CLASS__, 'add_notification_shortcode' ), 100 );
		add_filter( 'sprout_notifications', array( __CLASS__, 'add_notification_shortcode_compatibility' ), 100 );
	}

	////////////////////
	// Notifications //
	////////////////////

	public static function register_notifications( $notifications = array() ) {
		$default_notifications = array(
				// Lead Generation
				'client_summary' => array(
					'name' => __( 'Client Summary', 'sprout-invoices' ),
					'description' => __( 'Customize the email sent to the client summarizing open invoices and esitmates.', 'sprout-invoices' ),
					'shortcodes' => array( 'date', 'name', 'first_name', 'username', 'dashboard_link', 'summary', 'client_name', 'client_edit_url', 'client_address', 'client_company_website' ),
					'default_title' => sprintf( __( '%s: Your Summary', 'sprout-invoices' ), get_bloginfo( 'name' ) ),
					'default_content' => self::default_summary_notification(),
				),
			);
		return array_merge( $notifications, $default_notifications );
	}

	public static function add_notification_shortcode_compatibility( $notifications = array() ) {
		foreach ( $notifications as $key => $data ) {
			if ( ! in_array( $key, array( 'reminder_payment', 'final_payment', 'deposit_payment', 'send_invoice', 'send_estimate', 'user_notification' ) ) ) { // don't show for admin notifications
				$notifications[ $key ]['shortcodes'] = array_merge( $notifications[ $key ]['shortcodes'], array( 'client_invoice_summary', 'client_estimate_summary' ) );
			}
		}
		return $notifications;
	}

	public static function add_notification_shortcode( $default_shortcodes = array() ) {
		$new_shortcodes = array(
			'client_invoice_summary' => array(
				'description' => __( 'Used to provide the client with a summary of open invoices.', 'sprout-invoices' ),
				'callback' => array( __CLASS__, 'shortcode_invoice_summary' ),
			),
			'client_estimate_summary' => array(
				'description' => __( 'Used to provide the client with a summary of open estimates.', 'sprout-invoices' ),
				'callback' => array( __CLASS__, 'shortcode_estimate_summary' ),
			),
		);
		return array_merge( $new_shortcodes, $default_shortcodes );
	}

	public static function shortcode_invoice_summary( $atts, $content, $code, $data ) {
		if ( ! isset( $data['records']['invoices'] ) ) {
			return '';
		}
		if ( empty( $data['records']['invoices'] ) ) {
			return '';
		}
		$maybe_html_postfix = '';
		if ( SI_Notifications_Control::html_notifications() ) {
			$maybe_html_postfix = '-html';
		}
		$content = self::load_addon_view_to_string( 'shortcodes/invoice-summary' . $maybe_html_postfix, array(
				'invoices' => $data['records']['invoices'],
		), true );
		return $content;
	}

	public static function shortcode_estimate_summary( $atts, $content, $code, $data ) {
		if ( ! isset( $data['records']['estimates'] ) ) {
			return '';
		}
		if ( empty( $data['records']['estimates'] ) ) {
			return '';
		}
		$maybe_html_postfix = '';
		if ( SI_Notifications_Control::html_notifications() ) {
			$maybe_html_postfix = '-html';
		}
		$content = self::load_addon_view_to_string( 'shortcodes/estimate-summary' . $maybe_html_postfix, array(
				'estimates' => $data['records']['estimates'],
		), true );
		return $content;
	}

	public static function default_summary_notification() {
		$maybe_html_postfix = '';
		if ( class_exists( 'SI_HTML_Notifications' ) ) {
			$maybe_html_postfix = '-html';
		}
		$content = self::load_addon_view_to_string( 'notifications/client-summary' . $maybe_html_postfix, array(), true );
		return $content;
	}

	public static function add_to_manual_send( $manual = array() ) {
		$manual['client_summary'] = __( 'Client Summary', 'sprout-invoices' );
		return $manual;
	}

	public static function add_to_est_manual_send( $manual = array() ) {
		$manual['client_summary'] = __( 'Client Summary', 'sprout-invoices' );
		return $manual;
	}

	public static function add_records_data_to_notification_data( $data = array(), $notification_name = '' ) {
		if ( 'client_summary' != $notification_name ) {
			return $data;
		}
		if ( ! isset( $data['client'] ) ) {
			return $data;
		}

		$client = $data['client'];

		if ( ! is_a( $client, 'SI_Client' ) ) {
			return $data;
		}

		$records = array();
		$records['invoices'] = SI_Summary_Notification_Control::get_clients_open_invoices( $client );
		$records['estimates'] = SI_Summary_Notification_Control::get_clients_open_estimates( $client );

		$data['records'] = $records;
		return $data;
	}

	/////////////
	// Utility //
	/////////////


	public static function load_addon_view( $view, $args, $allow_theme_override = true ) {
		add_filter( 'si_views_path', array( __CLASS__, 'addons_view_path' ) );
		$view = self::load_view( $view, $args, $allow_theme_override );
		remove_filter( 'si_views_path', array( __CLASS__, 'addons_view_path' ) );
		return $view;
	}

	public static function load_addon_view_to_string( $view, $args, $allow_theme_override = true ) {
		ob_start();
		self::load_addon_view( $view, $args, $allow_theme_override );
		return ob_get_clean();
	}

	public static function addons_view_path() {
		return SA_ADDON_CLIENT_SUMMARY_NOTIFICATION_PATH . '/views/';
	}
}
