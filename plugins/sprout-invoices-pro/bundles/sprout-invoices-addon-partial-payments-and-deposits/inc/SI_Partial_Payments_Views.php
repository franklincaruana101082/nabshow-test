<?php

/**
 * SI_Partial_Payments_Views Controller
 *
 * @package Sprout_Invoice
 * @subpackage SI_Partial_Payments_Views
 */
class SI_Partial_Payments_Views extends SI_Partial_Payments {

	public static function init() {

		add_action( 'si_default_theme_pre_payment_options', array( __CLASS__, 'default_payment_options_view' ), 100 );

		// og and slate themes
		add_action( 'si_doc_actions_pre', array( __CLASS__, 'add_payment_update_button' ), 100 );
		add_action( 'si_invoice_outer_doc_wrap', array( __CLASS__, 'add_payment_options_view' ), 100 );

	}

	public static function add_payment_update_button() {
		if ( ! SI_Invoice::is_invoice_query() ) {
			return;
		}

		if ( isset( $_GET[ self::REDIRECTED_QV ] ) ) {
			return;
		}

		$invoice_id = get_the_ID();

		if ( ! self::can_client_set_min( $invoice_id ) ) {
			return;
		}

		$payment_amount = ( si_has_invoice_deposit( $invoice_id, true ) ) ? si_get_invoice_deposit( $invoice_id, true ) : si_get_invoice_balance( $invoice_id );

		$text = ( ! si_has_invoice_deposit( $invoice_id, true ) ) ? sprintf( __( 'Make Payment', 'sprout-invoices' ), sa_get_formatted_money( $payment_amount ) ) : sprintf( __( 'Change Payment Amount: %s', 'sprout-invoices' ), sa_get_formatted_money( $payment_amount ) );

		$button = ( ! si_has_invoice_deposit( $invoice_id, true ) ) ? sprintf( '<a href="%s" id="change_payment_amount" class="button primary_button si_change_payment_amount" rel="nofollow">%s</a>', 'javascript:void(0)', $text ) : sprintf( '<a href="%s" id="change_payment_amount" class="button  change_payment_amount" rel="nofollow">%s</a>', 'javascript:void(0)', $text );

		print apply_filters( 'si_change_payment_amount_button', $button );
	}

	public static function add_payment_options_view() {
		if ( ! SI_Invoice::is_invoice_query() ) {
			return;
		}

		if ( isset( $_GET[ self::REDIRECTED_QV ] ) ) {
			self::load_addon_view( 'theme/original/invoice/payment-amount-modified', array() );
			return;
		}

		$invoice_id = get_the_ID();

		if ( ! self::can_client_set_min( $invoice_id ) ) {
			return;
		}

		$invoice = SI_Invoice::get_instance( $invoice_id );
		$balance = $invoice->get_balance();
		$deposit = $invoice->get_deposit();
		$unfiltered_deposit = $invoice->get_deposit( true );
		$min_payment = self::get_client_set_min( $invoice_id );
		$temp_payment_amount = self::get_temp_payment_amount( $invoice_id );

		self::load_addon_view( 'theme/original/invoice/partial-payment-options', array(
			'min_payment' => $min_payment,
			'max_payment' => $balance,
			'balance' => $balance,
			'temp_payment_amount' => $temp_payment_amount, // should be deposit
			'deposit' => $deposit,
			'unfiltered_deposit' => $unfiltered_deposit,
		) );
	}

	public static function default_payment_options_view() {
		if ( ! SI_Invoice::is_invoice_query() ) {
			return;
		}

		if ( isset( $_GET[ self::REDIRECTED_QV ] ) ) {
			self::load_addon_view( 'theme/default/invoice/payment-amount-modified', array() );
			return;
		}

		$invoice_id = get_the_ID();

		if ( ! self::can_client_set_min( $invoice_id ) ) {
			return;
		}

		$invoice = SI_Invoice::get_instance( $invoice_id );
		$balance = $invoice->get_balance();
		$deposit = $invoice->get_deposit();
		$unfiltered_deposit = $invoice->get_deposit( true );
		$min_payment = self::get_client_set_min( $invoice_id );
		$temp_payment_amount = self::get_temp_payment_amount( $invoice_id );

		self::load_addon_view( 'theme/default/invoice/partial-payment-options', array(
			'min_payment' => $min_payment,
			'max_payment' => $balance,
			'balance' => $balance,
			'temp_payment_amount' => $temp_payment_amount, // should be deposit
			'deposit' => $deposit,
			'unfiltered_deposit' => $unfiltered_deposit,
		) );
	}
}
