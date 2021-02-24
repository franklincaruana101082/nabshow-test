<?php

function si_get_invoice_payment_terms_amount_due( $invoice_id = 0 ) {
	if ( ! $invoice_id ) {
		$invoice_id	= get_the_ID();
	}

	$past_due = (float) si_get_invoice_payment_terms_amount_past_due( $invoice_id );
	$almost_due = (float) si_get_next_invoice_payment_term_amount_due( $invoice_id );

	$total_due = $almost_due + $past_due;

	if ( ! is_a( $invoice_id, 'SI_Invoice' ) ) {
		$invoice = si_get_doc_object( $invoice_id );
	}

	if ( ! is_a( $invoice, 'SI_Invoice' ) ) {
		return $total_due;
	}
	if ( $invoice->get_calculated_total() < $total_due ) {
		return $invoice->get_calculated_total();
	}

	return $total_due;
}

function si_get_invoice_payment_terms( $invoice_id = 0 ) {
	if ( ! $invoice_id ) {
		$invoice_id	= get_the_ID();
	}
	$payment_terms = SI_Payment_Terms::get_sorted_payment_terms( $invoice_id );
	return $payment_terms;
}

function si_get_invoice_payment_terms_amount_past_due( $invoice_id = 0 ) {
	if ( ! $invoice_id ) {
		$invoice_id	= get_the_ID();
	}

	$invoice = si_get_doc_object( $invoice_id );

	$total = (float) 0.00;

	$payment_terms = si_get_invoice_payment_terms( $invoice_id );
	if ( empty( $payment_terms ) ) {
		return $total;
	}

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
		$payment_due_end_of_day = (int) strtotime( 'tomorrow', $data['time'] ) - 1;
		if ( current_time( 'timestamp' ) > (int) $payment_due_end_of_day ) {
			if ( isset( $data['percentage'] ) && 'true' == $data['percentage'] ) {
				$fee_total = $invoice->get_subtotal() * ( $data['fee'] / 100 );
			} else {
				$fee_total = $data['fee'];
			}
			$fee_total = $fee_total + $data['balance'];
		}

		$total = $total + $fee_total;
	}
	return $total;
}

function si_get_next_invoice_payment_term_info( $invoice_id = 0 ) {
	if ( ! $invoice_id ) {
		$invoice_id	= get_the_ID();
	}
	$payment_terms = si_get_invoice_payment_terms( $invoice_id );
	if ( empty( $payment_terms ) ) {
		return array();
	}

	// terms are sorted by date
	// simplly find the next payment term due
	foreach ( $payment_terms as $data ) {

		if ( ! isset( $data['fee'] ) || '' === $data['fee'] ) {
			continue;
		}

		// Zero fee if marked as complete
		if ( isset( $data['complete'] ) && 'true' == $data['complete'] ) {
			continue;
		}

		$payment_due_end_of_day = (int) strtotime( 'tomorrow', $data['time'] ) - 1;
		if ( current_time( 'timestamp' ) > (int) $payment_due_end_of_day ) {
			continue;
		}

		return $data;
	}
}

function si_get_next_invoice_payment_term_due_date( $invoice_id = 0 ) {
	if ( ! $invoice_id ) {
		$invoice_id	= get_the_ID();
	}
	$term = si_get_next_invoice_payment_term_info( $invoice_id );
	if ( ! isset( $term['time'] ) ) {
		return false;
	}
	return date_i18n( get_option( 'date_format' ), $term['time'] );
}

function si_get_next_invoice_payment_term_amount_due( $invoice_id = 0 ) {
	if ( ! $invoice_id ) {
		$invoice_id	= get_the_ID();
	}
	$term = si_get_next_invoice_payment_term_info( $invoice_id );
	if ( empty( $term ) ) {
		return false;
	}
	$fee_total = (float) 0.00;
	if ( isset( $term['percentage'] ) && 'true' == $term['percentage'] ) {
		$invoice = si_get_doc_object( $invoice_id );
		$fee_total = $invoice->get_subtotal() * ( $term['balance'] / 100 );
	} else {
		$fee_total = $term['balance'];
	}
	return $fee_total;
}
