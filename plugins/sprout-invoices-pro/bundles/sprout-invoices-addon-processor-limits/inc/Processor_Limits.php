<?php

/**
 * SI_Processor_Limits Controller
 *
 * @package Sprout_Invoice
 * @subpackage SI_Processor_Limits
 */
class SI_Processor_Limits extends SI_Controller {
	const OPTION_PRE = 'si_processor_limits_';

	public static function init() {

		// settings
		require_once( 'Processor_Limits_Settings.php' );
		SI_Processor_Limits_Settings::init();

		// views and messaging
		require_once( 'Processor_Limits_Billings.php' );
		SI_Processor_Limits_Billings::init();

		// views and messaging
		require_once( 'Processor_Limits_Views.php' );
		SI_Processor_Limits_Views::init();

		// Do the work!
		add_filter( 'si_payment_options', array( __CLASS__, 'limit_processors' ), 0, 2 );

	}

	public static function limit_processors( $processor_options = array() ) {

		$payment_amount = ( si_has_invoice_deposit() ) ? si_get_invoice_deposit() : si_get_invoice_balance();

		if ( $payment_amount < 0.01 ) {
			return array();
		}

		$enabled_processors = SI_Payment_Processors::enabled_processors();
		foreach ( $enabled_processors as $class ) {

			if ( method_exists( $class, 'get_instance' ) ) {

				$payment_processor = call_user_func( array( $class, 'get_instance' ) );
				$slug = $payment_processor->get_slug();

				if ( isset( $processor_options[ $slug ] ) ) {

					$min = (float) self::get_payment_limit( $class );
					$max = (float) self::get_payment_limit( $class, false );

					if ( method_exists( $payment_processor, 'bank_supported' ) && $payment_processor->bank_supported() ) {

						$achmin = (float) self::get_payment_limit( $class, true, true );
						$achmax = (float) self::get_payment_limit( $class, false, true );

						// use the less restrictive since Sprout Billings
						// will have to be handled individually
						$min = ( $min > $achmin ) ? $achmin : $min ;
						$max = ( $max < $achmax || 0 == $achmax ) ? $achmax : $max ;

					}

					if ( $payment_amount < $min ) {
						unset( $processor_options[ $slug ] );
					}

					if ( 0.00 < $max && $payment_amount > $max ) {
						unset( $processor_options[ $slug ] );
					}
				}
			}
		}

		return $processor_options;
	}



	public static function get_payment_limit( $class = '', $min = true, $ach = false ) {
		if ( is_object( $class ) ) {
			$class = get_class( $class );
		}
		$min_or_max = ( $min ) ? '_min' : '_max' ;
		$isach = ( $ach ) ? '_ach' : '' ;
		$option = get_option( self::OPTION_PRE . $class . $isach . $min_or_max, 0 );
		return $option;
	}

	public static function get_payment_limits() {

		$limits = array();
		$payment_gateways = SI_Payment_Processors::get_registered_processors();
		foreach ( $payment_gateways as $class => $label ) {
			$limits[ $class ] = array(
					'label' => $label,
					'min' => self::get_payment_limit( $class ),
					'max' => self::get_payment_limit( $class, false ),
				);
		}
		return $limits;
	}
}
