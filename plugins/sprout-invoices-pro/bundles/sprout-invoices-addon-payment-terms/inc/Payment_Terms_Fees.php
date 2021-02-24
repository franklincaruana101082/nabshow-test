<?php

/**
 * SI_Payment_Terms_Fees Controller
 *
 * Handles the any fees assocaited with a payment term, e.g. if the payment is late.
 *
 * @package SI_Payment_Terms
 * @subpackage SI_Payment_Terms_Fees
 */
class SI_Payment_Terms_Fees extends SI_Payment_Terms {

	public static function init() {

		// Shipping fee, great example of a fee
		add_filter( 'si_doc_fees', array( __CLASS__, 'add_term_fee' ), 10, 2 );

		// hook into payment, check what terms are available to mark as complete. Don't remove a fee if the time is passed.
		add_action( 'si_new_payment',  array( __CLASS__, 'maybe_complete_terms' ) );

		add_action( 'pre_si_invoice_view', array( __CLASS__, 'show_message_about_term_due' ), 20, 1 );

	}


	public static function show_message_about_term_due() {

		if ( apply_filters( 'si_payment_terms_remove_messages', false ) ) {
			return;
		}

		$doc_id = get_the_id();
		$doc = si_get_doc_object( $doc_id );
		$payment_terms = self::get_sorted_payment_terms( $doc_id );

		if ( empty( $payment_terms ) ) {
			return;
		}

		$fee_messages = array();
		foreach ( $payment_terms as $data ) {
			$term_id = $data['term_id'];

			if ( ! isset( $data['fee'] ) || '' === $data['fee'] ) {
				continue;
			}

			// Zero fee if marked as complete
			if ( isset( $data['complete'] ) && 'true' == $data['complete'] ) {
				continue;
			}

			$fee_total = (float) 0.00;
			if ( isset( $data['percentage'] ) && 'true' == $data['percentage'] ) {
				$fee_total = $doc->get_subtotal() * ( $data['fee'] / 100 );
			} else {
				$fee_total = $data['fee'];
			}

			// Remove the fee total if not due.
			$payment_due_end_of_day = (int) strtotime( 'tomorrow', $data['time'] ) - 1;
			if ( current_time( 'timestamp' ) < (int) $payment_due_end_of_day ) {
				self::set_message( sprintf( __( '<b>Payment Due before %s:</b> %s', 'sprout-invoices' ), date_i18n( get_option( 'date_format' ), $data['time'] ), apply_filters( 'si_payment_term_description', $data['title'], $data ) ), self::MESSAGE_STATUS_INFO );
			} else {
				self::set_message( sprintf( __( '<b>Payment Past Due:</b> %2$s (%1$s)', 'sprout-invoices' ), date_i18n( get_option( 'date_format' ), $data['time'] ), apply_filters( 'si_payment_term_description', $data['title'], $data ) ), self::MESSAGE_STATUS_ERROR );
			}
		}
	}

	public static function add_term_fee( $fees, $doc ) {
		$doc_id = $doc->get_id();

		$payment_terms = self::get_sorted_payment_terms( $doc_id );

		if ( empty( $payment_terms ) ) {
			return $fees;
		}

		if ( is_a( $doc, 'SI_Invoice' ) ) {
			// create recurring terms if the invoice is not yet paid.
			if ( SI_Invoice::STATUS_PAID != $doc->get_status() ) {
				$payment_terms = self::maybe_create_new_payment_term_from_recurring( $payment_terms );
			}
		}

		$i = 0;
		foreach ( $payment_terms as $data ) {
			$term_id = $data['term_id'];

			if ( '' === $data['fee'] ) {
				continue;
			}

			$fee_total = (float) 0.00;
			if ( 'true' == $data['percentage'] ) {
				$fee_total = $doc->get_subtotal() * ( $data['fee'] / 100 );
			} else {
				$fee_total = $data['fee'];
			}

			// Zero fee if marked as complete
			if ( 'true' == $data['complete'] ) {
				$fee_total = (float) 0.00;
			}

			// Remove the fee total
			$payment_due_end_of_day = (int) strtotime( 'tomorrow', $data['time'] ) - 1;
			if ( current_time( 'timestamp' ) < (int) $payment_due_end_of_day ) {
				$fee_total = (float) 0.00;
			}

			$fee_total = apply_filters( 'si_calculate_a_term_fee', $fee_total, $term_id, $doc_id );

			if ( ! apply_filters( 'si_show_all_payment_terms', true ) && $fee_total === 0.00 ) {
				continue;
			}

			$fees[ 'term_fee_' . $i ] = array(
				'label' => ( '' != $data['title'] ) ? apply_filters( 'si_payment_term_description', $data['title'], $data ) : __( 'Payment Past Due', 'sprout-invoices' ),
				'always_show' => true,
				'total' => (float) $fee_total,
				'weight' => (int) sprintf( '25.%d', $i ),
			);

			$i++;

		}
		return $fees;
	}

	public static function maybe_create_new_payment_term_from_recurring( $payment_terms = array() ) {

		$all_dates = wp_list_pluck( $payment_terms, 'time' );
		$new_term_created = false;
		foreach ( $payment_terms as $data ) {

			if ( isset( $data['recurring'] ) && 'false' != $data['recurring'] ) {

				// See if the due date has passed
				$payment_due_end_of_day = (int) strtotime( 'tomorrow', $data['time'] ) - 1;
				if ( current_time( 'timestamp' ) < (int) $payment_due_end_of_day ) {
					// the due date is still in the past, so skip
					continue;
				}

				$same_day_next_month = __sameday_next_month( $data['time'] );
				if ( ! in_array( $same_day_next_month, $all_dates ) ) {

					// set to the doc_id
					$new_term_created = $data['doc_id'];

					$args = array(
						'time' => $same_day_next_month,
						'post_date' => (int) current_time( 'timestamp' ),
					);
					$data = wp_parse_args( $args, $data );
					$new_payment_term = SI_Payment_Term::new_payment_term( $data );
				}
			}
		}

		// process this again just in case another needs to be created.
		if ( $new_term_created ) {
			$payment_terms = self::get_sorted_payment_terms( $new_term_created );
			$payment_terms = self::maybe_create_new_payment_term_from_recurring( $payment_terms );
		}

		return $payment_terms;
	}


	public static function maybe_complete_terms( SI_Payment $payment ) {
		if ( $payment->get_status() === SI_Payment::STATUS_VOID ) {
			return;
		}
		$payment_id = $payment->get_id();
		$paid = $payment->get_amount();

		$invoice_id = $payment->get_invoice_id();
		$invoice = SI_Invoice::get_instance( $invoice_id );
		if ( ! is_a( $invoice, 'SI_Invoice' ) ) {
			return;
		}

		$payment_terms = self::get_sorted_payment_terms( $invoice_id );

		if ( empty( $payment_terms ) ) {
			return;
		}

		$paid_tally = (float) $paid;
		foreach ( $payment_terms as $data ) {

			// If payment is due
			if ( ! isset( $data['balance'] ) ) {
				continue;
			}

			$payment_due = floatval( $data['balance'] );
			$term_id = $data['term_id'];

			// Don't complete a fee if the time is passed.
			// If the payment due date is before this payment, don't accept it (or mark it complete).
			$payment_due_end_of_day = (int) strtotime( 'tomorrow', $data['time'] ) - 1;
			if ( current_time( 'timestamp' ) > (int) $payment_due_end_of_day ) {
				continue;
			}

			// If what was paid is less than what is due.
			if ( $paid_tally < $payment_due ) {
				continue;
			}

			// Mark payment term complete
			SI_Payment_Term::mark_term_complete( $term_id, $payment_id );

			// Subtract amount due, with what was paid, in case the amount paid covers multiple terms
			$paid_tally = $paid_tally - $payment_due;
		}

	}
}
