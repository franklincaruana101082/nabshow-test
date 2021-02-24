<?php

/**
 * SI_Service_Fee Controller
 *
 * @package Sprout_Invoice
 * @subpackage SI_Service_Fee
 */
class SI_Service_Fee extends SI_Controller {
	const OPTION_PRE = 'si_service_fee_';
	const OPTION_ACH_PRE = 'si_service_fee_ach_';

	public static function init() {

		//
		add_action( 'save_post', array( __CLASS__, 'maybe_add_service_fee_auto' ), 10, 2 );

	}

	public static function get_service_fee( $class = '', $ach = false ) {
		if ( is_object( $class ) ) {
			$class = get_class( $class );
		}
		$option_pre = ( ! $ach ) ? self::OPTION_PRE : self::OPTION_ACH_PRE ;
		$option = get_option( $option_pre . $class, 0 );
		return $option;
	}

	public static function get_service_fees() {

		$fees = array();
		$payment_gateways = SI_Payment_Processors::get_registered_processors();
		foreach ( $payment_gateways as $class => $label ) {
			$fees[ $class ] = array(
					'label' => $label,
					'fee' => self::get_service_fee( $class ),
				);
		}
		return $fees;
	}

	public static function maybe_add_service_fee_auto( $post_id, $post ) {
		if ( $post->post_status == 'auto-draft' ) {
			return;
		}
		if ( $post->post_type !== SI_Invoice::POST_TYPE ) {
			return;
		}

		$invoice = SI_Invoice::get_instance( $post_id );

		$enabled_gateways = SI_Payment_Processors::doc_enabled_processors( $post_id );

		// Don't allow for multiple service fees, or a fee to be added based on an existing fee that will be overriden.
		// Example, recurring invoice with a fee is duplicated, then the new fee is based on the total including the old fee.
		self::maybe_remove_processing_fee( $invoice );

		// Don't autoamtically add a fee if more than one option
		if ( 1 < count( $enabled_gateways ) ) {
			return;
		}

		$class = array_values( $enabled_gateways )[0];

		$service_fee = self::get_service_fee( $class );
		$fee_total = $invoice->get_calculated_total( false ) * ( $service_fee / 100 );

		self::add_service_fee( $invoice, $fee_total );
	}

	public static function add_service_fee( SI_Invoice $invoice, $fee_total = 0.00, $label = '' ) {
		if ( $fee_total < 0.00 ) {
			return;
		}

		if ( apply_filters( 'si_bypass_add_service_fee', false, $invoice ) ) {
			return;
		}

		// don't add a fee for an invoice that has been paid already
		if ( $invoice->get_status() == SI_Invoice::STATUS_PAID ) {
			return;
		}

		$fees = $invoice->get_fees();

		// remove the previous fee, i.e reset with new fee
		unset( $fees['payment_service_fee'] );

		$fees['payment_service_fee'] = array(
			'label' => ( '' === $label ) ? __( 'Payment Service Fee', 'sprout-invoices' ) : $label,
			'always_show' => true,
			'delete_option' => true,
			'total' => (float) $fee_total,
			'weight' => 26,
		);

		$invoice->save_post_meta( array(
			'_fees' => $fees,
		) );
		$invoice->reset_totals();
	}

	public static function maybe_remove_processing_fee( SI_Invoice $invoice ) {
		// don't remove a fee for an invoice that has been paid already
		if ( $invoice->get_status() == SI_Invoice::STATUS_PAID ) {
			return;
		}

		$fees = $invoice->remove_fee( 'payment_service_fee' );

	}
}
