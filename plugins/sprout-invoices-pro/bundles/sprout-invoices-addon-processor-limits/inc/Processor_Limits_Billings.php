<?php

/**
 * SI_Processor_Limits Controller
 *
 * @package Sprout_Invoice
 * @subpackage SI_Processor_Limits
 */
class SI_Processor_Limits_Billings extends SI_Processor_Limits {

	public static function init() {
		add_action( 'si_credit_card_payment_fields', array( __CLASS__, 'maybe_remove_checking' ), 0 );

		add_filter( 'si_auto_billing_card_selection', array( __CLASS__, 'maybe_remove_cc' ) );
	}

	public static function maybe_remove_checking() {

		if ( doing_action( 'si_checkout_action_'.SI_Checkouts::PAYMENT_PAGE ) ) {
			return;
		}

		$payment_amount = ( si_has_invoice_deposit() ) ? si_get_invoice_deposit() : si_get_invoice_balance();

		$enabled_processors = SI_Payment_Processors::enabled_processors();
		foreach ( $enabled_processors as $class ) {

			if ( method_exists( $class, 'get_instance' ) ) {

				$payment_processor = call_user_func( array( $class, 'get_instance' ) );
				$slug = $payment_processor->get_slug();

				if ( method_exists( $payment_processor, 'bank_supported' ) && $payment_processor->bank_supported() ) {

					$min = (float) self::get_payment_limit( $class, true, true );
					$max = (float) self::get_payment_limit( $class, false, true );

					if ( $payment_amount < $min ) {
						remove_action( 'si_credit_card_payment_fields', array( 'SI_Sprout_Billings_Checkout', 'add_checking_info' ) );
					}

					if ( 0.00 < $max && $payment_amount > $max ) {
						remove_action( 'si_credit_card_payment_fields', array( 'SI_Sprout_Billings_Checkout', 'add_checking_info' ) );
					}
				}
			}
		}
	}

	public static function maybe_remove_cc( $fields = array() ) {

		if ( doing_action( 'si_checkout_action_'.SI_Checkouts::PAYMENT_PAGE ) ) {
			return $fields;
		}

		$payment_amount = ( si_has_invoice_deposit() ) ? si_get_invoice_deposit() : si_get_invoice_balance();

		$enabled_processors = SI_Payment_Processors::enabled_processors();
		foreach ( $enabled_processors as $class ) {

			if ( method_exists( $class, 'get_instance' ) ) {

				$payment_processor = call_user_func( array( $class, 'get_instance' ) );
				$slug = $payment_processor->get_slug();

				if ( $payment_processor->is_cc_processor( $class ) ) {

					$min = (float) self::get_payment_limit( $class, true );
					$max = (float) self::get_payment_limit( $class, false );

					if ( $payment_amount < $min ) {
						return array();
					}

					if ( 0.00 < $max && $payment_amount > $max ) {
						return array();
					}
				}
			}
		}

		return $fields;
	}
}
