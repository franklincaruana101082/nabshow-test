<?php

/**
 * SI_Processor_Limits Controller
 *
 * @package Sprout_Invoice
 * @subpackage SI_Processor_Limits
 */
class SI_Processor_Limits_Settings extends SI_Processor_Limits {

	public static function init() {

		// settings
		add_filter( 'si_payment_settings', array( __CLASS__, 'register_options' ) );

	}

	/**
	 * Hooked on init add the settings page and options.
	 *
	 */
	public static function register_options( $settings = array() ) {
		// Settings

		$enabled_gateways = SI_Payment_Processors::enabled_processors();
		$payment_gateways = SI_Payment_Processors::get_registered_processors();

		foreach ( $payment_gateways as $class => $label ) {
			if ( ! in_array( $class, $enabled_gateways ) ) {
				continue;
			}

			if ( ! method_exists( $class, 'get_instance' ) ) {
				continue;
			}

			$payment_processor = call_user_func( array( $class, 'get_instance' ) );

			$settings[ 'si_processor_limits_settings' . $class ] = array(
				'title' => sprintf( __( '%s Limits', 'sprout-invoices' ), $label ),
				'weight' => 250,
				// 'tab' => SI_Payment_Processors::get_settings_page( false ),
				'settings' => array(),
			);

			$settings[ 'si_processor_limits_settings' . $class ]['settings'][ self::OPTION_PRE . $class . '_min' ] = array(
					'label' => sprintf( __( 'Minimum Payment Amount', 'sprout-invoices' ), $label ),
					'option' => array(
						'type' => 'text',
						'default' => self::get_payment_limit( $class ),
						'attributes' => array( 'class' => 'small-text' ),
						'description' => __( 'This payment processor will not show unless the payment total is at least this amount.' ),
					),
				);

			$settings[ 'si_processor_limits_settings' . $class ]['settings'][ self::OPTION_PRE . $class . '_max' ] = array(
					'label' => sprintf( __( 'Max Payment Amount', 'sprout-invoices' ), $label ),
					'option' => array(
						'type' => 'text',
						'default' => self::get_payment_limit( $class, false ),
						'attributes' => array( 'class' => 'small-text' ),
						'description' => __( 'The payment process will not be available if the payment total is over this amount. For no maximum use an extremely high number, e.g. 10000000.' ),
					),
				);

			if ( method_exists( $payment_processor, 'bank_supported' ) && $payment_processor->bank_supported() ) {

				$settings[ 'si_processor_limits_settings' . $class ]['settings'][ self::OPTION_PRE . $class . '_ach_min' ] = array(
						'label' => sprintf( __( 'Minimum ACH Payment Amount', 'sprout-invoices' ), $label ),
						'option' => array(
							'type' => 'text',
							'default' => self::get_payment_limit( $class, true, true ),
							'attributes' => array( 'class' => 'small-text' ),
							'description' => __( 'This payment processor will not show unless the payment total is at least this amount.' ),
						),
					);

				$settings[ 'si_processor_limits_settings' . $class ]['settings'][ self::OPTION_PRE . $class . '_ach_max' ] = array(
						'label' => sprintf( __( 'Max ACH Payment Amount', 'sprout-invoices' ), $label ),
						'option' => array(
							'type' => 'text',
							'default' => self::get_payment_limit( $class, false, true ),
							'attributes' => array( 'class' => 'small-text' ),
							'description' => __( 'The payment process will not be available if the payment total is over this amount. For no maximum use an extremely high number, e.g. 10000000.' ),
						),
					);
			}
		}
		return $settings;
	}

	public static function settings_label( $label = '' ) {
		return sprintf( __( '%s Limits', 'sprout-invoices' ), $label );
	}
}
