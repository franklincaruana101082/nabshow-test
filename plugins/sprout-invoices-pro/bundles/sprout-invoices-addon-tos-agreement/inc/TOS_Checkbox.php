<?php

/**
 * SI_Goldrush_Addon_Loader Controller
 *
 * @package Sprout_Invoice
 * @subpackage SI_Processor_Limits
 */
class SI_TOS_Checkbox extends SI_Controller {
	const INPUT = 'sa_billing_tos_agreeeement';
	const OPTION = 'si_billing_tos_agreeeement';
	private static $tos_text;

	public static function init() {

		// text
		self::$tos_text = get_option( self::OPTION, 'Before making a payment you must agree to our TOS...' );

		// Register Settings
		add_filter( 'si_payment_settings', array( __CLASS__, 'register_settings' ) );

		// view
		add_action( 'si_credit_card_payment_controls', array( __CLASS__, 'add_checkbox' ) );

		// validation
		add_filter( 'si_validate_credit_card_cc', array( __CLASS__, 'check_tos_agreement' ), 200 );

	}

	public static function register_settings( $settings = array() ) {
		// Settings
		$settings['si_tos_checkbox_settings'] = array(
				'title' => __( 'Terms of Service', 'sprout-invoices' ),
				'weight' => 300,
				'tab' => 'payments',
				'settings' => array(
					self::OPTION => array(
						'label' => __( 'TOS Agreement Text', 'sprout-invoices' ),
						'option' => array(
							'type' => 'wysiwyg',
							'default' => self::$tos_text,
							'description' => __( 'The agreement text for the TOS checkbox at checkout.', 'sprout-invoices' ),
						),
					),
				),
		);
		return $settings;
	}


	public static function add_checkbox() {
		self::load_addon_view( 'checkout/tos-agreement', array(
				'input_name' => self::INPUT,
				'tos_text' => self::$tos_text,
				'default_tos' => apply_filters( 'si_tos_agreement_check_by_default', false ),
		) );
	}

	public static function check_tos_agreement( $valid = true ) {
		if ( ! isset( $_POST[ self::INPUT ] ) ) {
			self::set_message( __( 'Terms of Service Agreement is Required .', 'sprout-invoices' ), self::MESSAGE_STATUS_ERROR );
			$valid = false;
		}
		return $valid;
	}

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
		return SA_ADDON_TOS_AGREEMENT_PATH . '/views/';
	}
}
