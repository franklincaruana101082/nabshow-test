<?php

/**
 * SI_Service_Fee Controller
 *
 * @package Sprout_Invoice
 * @subpackage SI_Service_Fee
 */
class SI_Service_Fee_Settings extends SI_Service_Fee {

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
		$settings['si_service_fee_settings'] = array(
				'title' => __( 'Service Fee Options', 'sprout-invoices' ),
				'weight' => 300,
				// 'tab' => SI_Payment_Processors::get_settings_page( false ),
				'settings' => array(),
			);

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

			$settings['si_service_fee_settings']['settings'][ self::OPTION_PRE . $class ] = array(
					'label' => sprintf( __( '%s Service Fee', 'sprout-invoices' ), $label ),
					'option' => array(
						'type' => 'text',
						'default' => self::get_service_fee( $class ),
						'attributes' => array( 'class' => 'small-text' ),
						'description' => __( 'Percentage based on subtotal (before tax & discounts).' ),
					),
				);

			if ( method_exists( $payment_processor, 'bank_supported' ) && $payment_processor->bank_supported() ) {

				if ( 'SA_Stripe_Profiles' === $class || 'SA_Stripe' === $class  ) {
					$settings['si_service_fee_settings']['settings'][ self::OPTION_ACH_PRE . $class ] = array(
						'label' => sprintf( __( 'Plaid Service Fee', 'sprout-invoices' ), $label ),
						'option' => array(
							'type' => 'text',
							'default' => self::get_service_fee( $class, false ),
							'attributes' => array( 'class' => 'small-text', 'disabled' => 'disabled' ),
							'description' => __( 'Service fees for Plaid are not supported, instead the Stripe service fee is added.' ),
						),
					);
				} else {
					$settings['si_service_fee_settings']['settings'][ self::OPTION_ACH_PRE . $class ] = array(
						'label' => sprintf( __( '%s ACH Service Fee', 'sprout-invoices' ), $label ),
						'option' => array(
							'type' => 'text',
							'default' => self::get_service_fee( $class, true ),
							'attributes' => array( 'class' => 'small-text' ),
							'description' => __( 'Percentage based on subtotal (before tax & discounts).' ),
						),
					);
				}
			}
		}
		return $settings;
	}
}
