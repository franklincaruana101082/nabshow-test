<?php

/**
 * Subscription_Invoices Controller
 *
 * @package Sprout_Invoice
 * @subpackage Subscription_Payments
 */
class Subscription_Invoices extends SI_Subscription_Payments {

	public static function init() {

		add_action( 'si_paypal_recurring_payment_profile_created', array( __CLASS__, 'set_payment_receipt_schedule' ) );

		add_action( 'si_stripe_recurring_payment_profile_created', array( __CLASS__, 'set_payment_receipt_schedule' ) );

		add_action( 'admin_init', array( __CLASS__, 'manually_create_paid_invoice' ) );

		add_action( self::CRON_HOOK, array( __CLASS__, 'create_invoice_receipts' ) );

	}

	public static function set_payment_receipt_schedule( $payment_id ) {
		$payment = SI_Payment::get_instance( $payment_id );
		if ( ! $payment->is_active() ) {
			return;
		}

		$invoice_id = $payment->get_invoice_id();

		self::schedule_next_receipt( $invoice_id, current_time( 'timestamp' ) );
	}


	/////////////////////
	// Scheduled Task //
	/////////////////////

	public static function create_invoice_receipts() {

		if ( doing_action( 'si_create_invoice_receipts' ) ) {
			return;
		}

		do_action( 'si_create_invoice_receipts', current_time( 'timestamp' ) );

		$tonight = strtotime( 'tomorrow', current_time( 'timestamp' ) ) - 1;

		$tonight = apply_filters( 'si_create_invoice_receipts_upto', $tonight );

		$args = array(
			'post_type' => SI_Invoice::POST_TYPE,
			'post_status' => array_keys( SI_Invoice::get_statuses() ),
			'posts_per_page' => -1,
			'fields' => 'ids',
			'meta_query' => array(
				'relation' => 'AND',
				array(
					'key' => self::$meta_keys['has_subscription'],
					'value' => 1,
					'compare' => '=',
					),
				array(
					'key' => self::$meta_keys['next_time'],
					'value' => array(
							strtotime( 'Last year' ),
							$tonight,
							),
					'compare' => 'BETWEEN',
					),
				array(
					'key' => self::$meta_keys['cloned_from'],
					'compare' => 'NOT EXISTS',
					)
				),
		);
		$invoice_ids = get_posts( $args );

		foreach ( $invoice_ids as $invoice_id ) {

			$invoice = SI_Invoice::get_instance( $invoice_id );

			$next_check = (int) $invoice->get_post_meta( self::$meta_keys['next_time'] );
			if ( ! $next_check || ( $next_check > $tonight ) ) {
				continue;
			}

			$recurring_payment = SI_Payment_Processors::get_recurring_payment( $invoice );
			if ( ! $recurring_payment ) {
				continue;
			}
			// check if sub is active in order to create a paid invoice.
			// TODO may not create the last invoice if term is up and this generation is after.
			if ( $recurring_payment->is_active( true ) ) {
				self::create_paid_invoice_and_payment( $invoice );
			} else {
				// cancel
				$recurring_payment->cancel();
			}
		}
	}

	////////////////////
	// Create Reciept //
	////////////////////

	public static function manually_create_paid_invoice() {

		if ( ! isset( $_GET['manually_create_paid_receipt'] ) ) {
			return;
		}

		if ( ! current_user_can( 'edit_sprout_invoices' ) ) {
			self::redirect_from_manual_creation();
		}

		$post_id = $_GET['manually_create_paid_receipt'];
		if ( SI_Invoice::POST_TYPE !== get_post_type( $post_id ) ) {
			self::redirect_from_manual_creation();
		}

		$invoice = SI_Invoice::get_instance( $post_id );
		self::create_paid_invoice_and_payment( $invoice );

		self::redirect_from_manual_creation();
	}

	public static function redirect_from_manual_creation() {
		wp_redirect( remove_query_arg( 'manually_create_paid_receipt' ) );
		exit();
	}

	public static function create_paid_invoice_and_payment( SI_Invoice $invoice ) {
		$invoice_id = $invoice->get_id();

		$receipt_id = self::clone_post( $invoice_id, SI_Invoice::STATUS_PAID, SI_Invoice::POST_TYPE );
		$receipt = SI_Invoice::get_instance( $receipt_id );

		// Issue date is today.
		$receipt->set_issue_date( time() );
		$receipt->set_due_date( time() );

		// adjust the clone time for the next receipt
		self::schedule_next_receipt( $invoice_id, current_time( 'timestamp' ) );

		self::set_parent( $receipt_id, $invoice_id );

		// payment amount is the balance of the cloned invoice.
		$receipt->reset_totals();
		$payment_amount = $receipt->get_calculated_total();

		// Create a payment
		SI_Admin_Payment::create_admin_payment( $receipt_id, $payment_amount, '', 'Now', __( 'This payment was automatically added to settle a subscription payment.', 'sprout-invoices' ) );

		do_action( 'si_subscription_invoice_receipt_created', $invoice_id, $receipt_id );
	}


	public static function schedule_next_receipt( $invoice_id = 0, $time = 0 ) {
		$invoice = SI_Invoice::get_instance( $invoice_id );
		if ( ! is_a( $invoice, 'SI_Invoice' ) ) {
			return 0;
		}

		$start_time = 0;
		if ( ! $start_time ) {
			$start_time = current_time( 'timestamp' );
		}

		$frequency = self::get_term( $invoice_id );

		switch ( $frequency ) {
			case 'day':
				$the_next_time = strtotime( '+1 Day', $start_time );
				break;
			case 'week':
				$the_next_time = strtotime( '+1 Week', $start_time );
				break;
			case 'month':
				$the_next_time = strtotime( '+1 Month', $start_time );
				break;
			case 'year':
				$the_next_time = strtotime( '+1 Year', $start_time );
				break;

			default:
				$the_next_time = 0;
				break;
		}

		$is_sub = self::has_subscription_payment( $invoice_id );
		if ( ! $is_sub ) {
			$the_next_time = 0;
		}

		$invoice->save_post_meta( array(
			self::$meta_keys['next_time'] => $the_next_time,
		) );
		return $the_next_time;
	}

	public static function reset_payment_generation( $invoice_id = 0, $the_next_time = 0 ) {
		if ( ! $the_next_time ) {
			return 0;
		}
		$invoice = SI_Invoice::get_instance( $invoice_id );
		if ( ! is_a( $invoice, 'SI_Invoice' ) ) {
			return 0;
		}
		$the_next_time = strtotime( $the_next_time );
		$invoice->save_post_meta( array(
			self::$meta_keys['next_time'] => $the_next_time,
		) );
	}
}
