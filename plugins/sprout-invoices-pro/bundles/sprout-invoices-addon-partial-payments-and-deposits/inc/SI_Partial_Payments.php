<?php

/**
 * SI_Partial_Payments Controller
 *
 * @package Sprout_Invoice
 * @subpackage SI_Partial_Payments
 */
class SI_Partial_Payments extends SI_Controller {
	const TEMP_META_KEY = '_temp_payment_amount';
	const AJAX_ACTION = 'si_set_temp_payment_amount';
	const REDIRECTED_QV = 'payment_amount_updated';

	protected static $meta_keys = array(
		'client_set_min' => '_si_client_set_payment', // int
		'extend_due_date' => '_si_extend_due_date', // int
	);

	public static function init() {

		// maybe change deposit amount if min was paid
		add_action( 'processed_payment', array( __CLASS__, 'maybe_change_deposit_amount' ), 10, 2 );

		// Change deposit amount
		add_filter( 'si_get_invoice_deposit', array( __CLASS__, 'maybe_change_deposit_to_temp' ), 10, 2 );

		// AJAX
		add_action( 'wp_ajax_' . self::AJAX_ACTION, array( get_class(), 'maybe_set_temp_payment_amount' ) );
		add_action( 'wp_ajax_nopriv_' . self::AJAX_ACTION, array( get_class(), 'maybe_set_temp_payment_amount' ) );
	}

	/**
	 * Check if temp payment amount is set, if not use the existing depsoit setting. Also, don't allow for an over payment.
	 * @param  float     $deposit
	 * @param  SI_Invoice $invoice
	 * @return float
	 */
	public static function maybe_change_deposit_to_temp( $deposit, SI_Invoice $invoice ) {
		$invoice_id = $invoice->get_id();
		$temp_payment_amount = (float) self::get_temp_payment_amount( $invoice_id );

		if ( 0.01 > $temp_payment_amount ) {
			return $deposit;
		}

		$deposit = round( $temp_payment_amount, 2 );
		$balance = $invoice->get_balance();
		if ( $deposit > $balance ) { // check if deposit is more than what's due.
			$deposit = floatval( $balance );
		}

		return round( (float) $deposit, 2 );
	}

	public static function maybe_change_deposit_amount( SI_Payment $payment, SI_Checkouts $checkout ) {
		$invoice_id = $payment->get_invoice_id();
		$invoice = SI_Invoice::get_instance( $invoice_id );
		$deposit_amount = (float) $invoice->get_deposit( true );
		$payment_amount = (float) $payment->get_amount();

		if ( $payment_amount >= $deposit_amount ) {
			// Reset the deposit since the payment made covers it.
			$new_deposit = '';
			self::maybe_change_due_date( $invoice );
		}

		if ( $payment_amount < $deposit_amount ) {
			// redue the deposit
			$new_deposit = $deposit_amount - $payment_amount;
		}

		$invoice->set_deposit( $new_deposit );
	}

	public static function maybe_change_due_date( $invoice ) {

		$extend_due_date = (int) $invoice->get_post_meta( self::$meta_keys['extend_due_date'] );

		if ( $extend_due_date ) {
			return;
		}

		$invoice->set_due_date( $extend_due_date );
	}

	//////////
	// AJAX //
	//////////

	public static function maybe_set_temp_payment_amount() {
		$nonce = $_REQUEST['nonce'];
		if ( ! wp_verify_nonce( $nonce, self::NONCE ) ) {
			wp_send_json_error( array( 'message' => __( 'Not going to fall for it!', 'sprout-invoices' ) ) );
		}

		if ( ! isset( $_REQUEST['invoice_id'] ) || ! isset( $_REQUEST['payment_amount'] ) ) {
			wp_send_json_error( array( 'message' => __( 'Missing critical info!', 'sprout-invoices' ) ) );
		}

		// attempt the charge
		$invoice_id = $_REQUEST['invoice_id'];
		$payment_amount = $_REQUEST['payment_amount'];
		$redirect = self::set_temp_payment_amount( $invoice_id, $payment_amount );

		if ( $redirect ) {
			$redirect_url = add_query_arg( array( self::REDIRECTED_QV => true ), get_permalink( $invoice_id ) );
			wp_send_json_success( array( 'redirect' => true, 'redirect_url' => $redirect_url ) );
		}

		wp_send_json_success( array( 'message' => sprintf( __( 'Payment amount updated: %s', 'sprout-invoices' ), sa_get_formatted_money( $payment_amount ) ) ) );
	}

	///////////
	// Meta //
	///////////


	public static function get_transient_key( $invoice_id ) {
		return self::TEMP_META_KEY . $invoice_id;
	}

	public static function get_temp_payment_amount( $invoice_id = 0 ) {
		$payment_amount = get_site_transient( self::get_transient_key( $invoice_id ) );
		return (float) $payment_amount;
	}

	public static function set_temp_payment_amount( $invoice_id = 0, $payment_amount = 0.00 ) {
		$payment_amount = round( (float) $payment_amount, 2 );
		set_site_transient( self::get_transient_key( $invoice_id ), $payment_amount, 60 * 60 ); // expire in an hour
		return (float) $payment_amount;
	}

	public static function can_client_set_min( $doc_id = 0 ) {
		$doc = si_get_doc_object( $doc_id );
		if ( ! is_object( $doc ) ) {
			return 0;
		}
		$min = self::get_client_set_min( $doc_id );
		$balance = $doc->get_balance();
		if ( $min >= $balance ) { // check if min is more than what's due.
			return false;
		}
		return $min > 0.01;
	}

	public static function get_client_set_min( $doc_id = 0 ) {
		$doc = si_get_doc_object( $doc_id );
		if ( ! is_object( $doc ) ) {
			return 0;
		}
		$min = $doc->get_post_meta( self::$meta_keys['client_set_min'] );
		return floatval( $min );
	}

	public static function set_client_set_min( $doc_id = 0, $min = 0.00 ) {
		$doc = si_get_doc_object( $doc_id );
		if ( ! is_object( $doc ) ) {
			return 0;
		}

		$deposit = floatval( $doc->get_deposit() );
		if ( $deposit > 0.01 && $deposit < floatval( $min ) ) {
			$min = $deposit;
		}

		$doc->save_post_meta( array(
			self::$meta_keys['client_set_min'] => floatval( $min ),
		) );
		return floatval( $min );
	}

	public static function get_extend_due_date( $doc_id = 0 ) {
		$doc = si_get_doc_object( $doc_id );
		if ( ! is_object( $doc ) ) {
			return 0;
		}
		$new_due_date = (int) $doc->get_post_meta( self::$meta_keys['extend_due_date'] );
		$due_date = $doc->get_due_date();
		if ( $new_due_date < $due_date ) {
			$new_due_date = $due_date;
		}
		return $new_due_date;
	}

	public static function set_extend_due_date( $doc_id = 0, $date = 0 ) {
		$doc = si_get_doc_object( $doc_id );
		if ( ! is_object( $doc ) ) {
			return 0;
		}
		$doc->save_post_meta( array(
			self::$meta_keys['extend_due_date'] => $date,
		) );
		return $date;
	}

	//////////////
	// Utility //
	//////////////

	public static function load_addon_view( $view, $args, $allow_theme_override = true ) {
		add_filter( 'si_views_path', array( __CLASS__, 'addons_view_path' ) );
		$view = self::load_view( $view, $args, $allow_theme_override );
		remove_filter( 'si_views_path', array( __CLASS__, 'addons_view_path' ) );
		return $view;
	}

	protected static function load_addon_view_to_string( $view, $args, $allow_theme_override = true ) {
		ob_start();
		self::load_addon_view( $view, $args, $allow_theme_override );
		return ob_get_clean();
	}

	public static function addons_view_path() {
		return SA_ADDON_PARTIAL_PAYMENTS_PATH . '/views/';
	}
}
