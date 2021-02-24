<?php

/**
 * SI_Payment_Terms_Fees Controller
 *
 * Allows for interest to be added.
 *
 * @package SI_Payment_Terms
 * @subpackage SI_Payment_Terms_Fees
 */
class SI_Payment_Terms_Interest extends SI_Payment_Terms {
	const RATE_META = '_si_interest_rate';
	const DATE_META = '_si_interest_date';
	const INTEREST_LOGS = '_si_interest_balance_logs_v2';

	public static function init() {
		add_action( 'si_payment_terms_option_end', array( __CLASS__, 'add_interest_option' ) );
		add_action( 'si_payment_terms_save_meta_box_callback', array( __CLASS__, 'save_interest_options' ) );

		add_filter( 'si_doc_fees', array( __CLASS__, 'maybe_add_interest_fee' ), 10, 2 );

		// execute before the main delete fee, nothing will be returned.
		add_action( 'wp_ajax_si_delete_fee',  array( get_class(), 'maybe_delete_fee' ), 0, 0 );

		if ( self::DEBUG ) {
			add_action( 'init', array( __CLASS__, 'maybe_log_interest_fee' ) );
		} else {
			add_action( self::CRON_HOOK, array( __CLASS__, 'maybe_log_interest_fee' ) );
		}

	}

	public static function get_doc_interest( $doc_id = 0 ) {
		$interest = get_post_meta( $doc_id, self::RATE_META, true );
		return $interest;
	}

	public static function set_doc_interest( $doc_id = 0, $interest = 0.00 ) {
		update_post_meta( $doc_id, self::RATE_META, (float) $interest );
		return $interest;
	}

	public static function get_doc_interest_date( $doc_id = 0 ) {
		$interest_date = get_post_meta( $doc_id, self::DATE_META, true );
		return $interest_date;
	}

	public static function set_doc_interest_date( $doc_id = 0, $interest_date = 0.00 ) {
		update_post_meta( $doc_id, self::DATE_META, $interest_date );
		return $interest_date;
	}

	public static function get_doc_interest_logs( $doc_id = 0 ) {
		$interest_logs = get_post_meta( $doc_id, self::INTEREST_LOGS, true );
		return $interest_logs;
	}

	public static function set_doc_interest_logs( $doc_id = 0, $interest_logs = array() ) {
		update_post_meta( $doc_id, self::INTEREST_LOGS, $interest_logs );
		return $interest_logs;
	}

	public static function maybe_delete_fee() {
		$doc_id = (int) $_REQUEST['doc_id'];

		$interest_added = self::get_doc_interest_logs( $doc_id );
		if ( empty( $interest_added ) ) {
			return;
		}

		$fee_id = $_REQUEST['fee_id'];
		$fee_date = str_replace( 'interest_fee_', '', $fee_id );

		if ( '' === $fee_date ) {
			return;
		}

		unset( $interest_added[ $fee_date ] );
		self::set_doc_interest_logs( $doc_id, $interest_added );
	}

	public static function save_interest_options( $post_id = 0 ) {
		$interest = ( isset( $_POST['sa_fees_interest_rate'] ) ) ? $_POST['sa_fees_interest_rate'] : 0 ;
		$interest_date = ( isset( $_POST['sa_fees_interest_date'] ) ) ? $_POST['sa_fees_interest_date'] : 0 ;

		if ( $interest ) {
			self::set_doc_interest( $post_id, $interest );
		}

		if ( $interest_date ) {
			self::set_doc_interest_date( $post_id, $interest_date );
		}

	}

	public static function add_interest_option( $doc_id = 0 ) {
		$interest = self::get_doc_interest( $doc_id );
		$interest_date = self::get_doc_interest_date( $doc_id );

		$view = self::load_addon_view_to_string( 'admin/payment-terms/interest-option', array(
			'doc_id' => $doc_id,
			'interest' => $interest,
			'interest_date' => $interest_date,
			'day_selection' => self::day_of_month_selection(),
		), true );
		print $view;
	}

	public static function day_of_month_selection() {
		$selection_array = array();
		foreach ( range( 1, 31 ) as $number ) {
			$selection_array[ $number ] = sa_day_ordinal_formatter( $number );
		}
		return apply_filters( 'si_payment_terms_day_options',
			$selection_array + array( '32' => __( 'Last Day of Month', 'sprout-invoices' ) )
		);
	}

	public static function maybe_log_interest_fee() {
		$args = array(
			'post_type' => SI_Invoice::POST_TYPE,
			'posts_per_page' => -1,
			'fields' => 'ids',
			'post_status' => 'any',
			'meta_query' => array(
				array(
					'key' => self::RATE_META,
					'compare' => 'EXISTS',
					),
				),
		);

		$invoices_with_interest = get_posts( $args );

		$current_time = current_time( 'timestamp' );

		foreach ( $invoices_with_interest as $invoice_id ) {

			$invoice = SI_Invoice::get_instance( $invoice_id );

			if ( ! is_a( $invoice, 'SI_Invoice' ) ) {
				continue;
			}

			$interest_date = (int) self::get_doc_interest_date( $invoice_id );

			if ( $interest_date < 1 ) {
				continue;
			}

			$todays_date = (int) date( 'j', $current_time );

			// Make sure the interest is not added on the date
			$issue_date = (int) date( 'j', $invoice->get_issue_date() );
			if ( $todays_date === $issue_date ) {
				continue;
			}

				// if the interest date then add interest
			if ( $todays_date === $interest_date ) {
				self::log_interest( $invoice_id );
				continue;
			}

			$last_day_of_month = (int) date( 't', $current_time );

			// if today is the last day of the month, and interest date is past that day log the interest.
			if ( $last_day_of_month === $todays_date && $interest_date > $todays_date ) {
				self::log_interest( $invoice_id );
			}
			continue;
		}
	}

	public static function log_interest( $invoice_id = 0 ) {
		$today = strtotime( 'today', current_time( 'timestamp' ) );

		$interest_added = self::get_doc_interest_logs( $invoice_id );

		if ( ! is_array( $interest_added ) ) {
			$interest_added = array();
		}

		// already logged
		if ( in_array( $today, array_keys( $interest_added ) ) ) {
			return;
		}

		$balance = si_get_invoice_balance( $invoice_id );

		if ( $balance < 0.01 ) {
			return;
		}

		$interest = self::get_doc_interest( $invoice_id ) / 100;
		$fee_total = $balance * $interest;
		$interest_added[ $today ] = $fee_total;

		$interest_data = array( 'interest' => $interest, 'fee_total' => $fee_total, 'balance_before' => $balance );

		do_action( 'si_interest_fee_logged', $invoice_id, $interest_data );
		self::set_doc_interest_logs( $invoice_id, $interest_added );
	}

	public static function maybe_add_interest_fee( $fees, $doc ) {
		$doc_id = $doc->get_id();
		$interest_added = self::get_doc_interest_logs( $doc_id );

		if ( empty( $interest_added ) ) {
			return $fees;
		}

		$i = 0;
		foreach ( $interest_added as $date => $fee_total ) {

			if ( $fee_total < 0.01 ) {
				continue;
			}

			$fees[ 'interest_fee_'  . $date ] = array(
				'label' => apply_filters( 'si_interest_fee_description', sprintf( __( '%s Interest Fee', 'sprout-invoices' ), date( 'F', $date ) ), $doc ),
				'always_show' => apply_filters( 'si_interest_fee_always_show', true ),
				'total' => (float) $fee_total,
				'weight' => (int) sprintf( '26.%d', $i ),
			);

			$i++;
		}

		return $fees;

	}
}
