<?php

/**
 * SI_Partial_Payments_Admin Controller
 *
 * @package Sprout_Invoice
 * @subpackage SI_Partial_Payments_Admin
 */
class SI_Partial_Payments_Admin extends SI_Partial_Payments {

	public static function init() {

		add_action( 'admin_init', array( __CLASS__, 'register_meta_boxes' ) );

	}

	public static function register_meta_boxes() {
		// estimate specific
		$args = array(
			'si_partial_payments' => array(
				'title' => __( 'Deposits and Partial Payments', 'sprout-invoices' ),
				'show_callback' => array( __CLASS__, 'show_meta_box' ),
				'save_callback' => array( __CLASS__, 'save_meta_box' ),
				'context' => 'normal',
				'priority' => 'high',
				'weight' => 0,
				'save_priority' => PHP_INT_MAX - 50,
			),
		);
		do_action( 'sprout_meta_box', $args, SI_Invoice::POST_TYPE );
	}

	public static function show_meta_box( $post, $metabox ) {
		$invoice = SI_Invoice::get_instance( $post->ID );
		$status = $invoice->get_status();

		if ( in_array( $status, array( SI_Invoice::STATUS_PAID, SI_Invoice::STATUS_ARCHIVED, SI_Invoice::STATUS_WO ) )	) {
			printf( __( 'Based on the status this invoice has no payments due.', 'sprout-invoices' ) );
			return;
		}

		self::load_addon_view( 'admin/meta-boxes/partial-payments', array(
				'invoice_id' => $post->ID,
				'fields' => self::admin_fields( $invoice ),
		), false );

	}

	public static function admin_fields( $invoice ) {
		$fields = array();

		$doc_id = $invoice->get_id();

		$deposit = $invoice->get_deposit( true );

		$client_set_min = self::get_client_set_min( $doc_id );
		$new_due_date = self::get_extend_due_date( $doc_id );

		$fields['deposit'] = array(
			'weight' => 1,
			'label' => __( 'Deposit / Amount Due', 'sprout-invoices' ),
			'type' => 'input',
			'default' => ( $deposit > 0.00 ) ? $deposit : '',
			'attributes' => array( 'class' => 'small-input' ),
			'description' => __( 'Amount that is due now. Leave blank if invoice balance should be used instead.', 'sprout-invoices' ),
		);

		$fields['extend_due_date'] = array(
			'weight' => 10,
			'label' => __( 'New Due Date', 'sprout-invoices' ),
			'type' => 'date',
			'default' => date_i18n( 'Y-m-d', $new_due_date ),
			'placeholder' => ' ',
			'description' => __( 'Set the due date for the balance after the deposit is paid. Needs to be after original due date.', 'sprout-invoices' ),
		);

		$fields['client_set_min'] = array(
			'weight' => 20,
			'label' => __( 'Set Payment Minimum', 'sprout-invoices' ),
			'type' => 'input',
			'default' => ( $client_set_min > 0.00 ) ? $client_set_min : '',
			'attributes' => array( 'class' => 'small-input' ),
			'description' => __( 'Minimum payment amount allowed. Does not override the deposit total, although this must be lower.', 'sprout-invoices' ),
		);

		$fields = apply_filters( 'si_partial_payments_fields', $fields );
		uasort( $fields, array( __CLASS__, 'sort_by_weight' ) );
		return $fields;
	}

	public static function save_meta_box( $post_id, $post, $callback_args, $invoice_id = null ) {

		$invoice = si_get_doc_object( $post_id );

		$deposit = ( isset( $_POST['sa_partial_payments_deposit'] ) ) ? $_POST['sa_partial_payments_deposit'] : '' ;

		$invoice->set_deposit( (float) $deposit );

		$min = ( isset( $_POST['sa_partial_payments_client_set_min'] ) ) ? $_POST['sa_partial_payments_client_set_min'] : '' ;
		// min payment shouldn't be more than the deposit amount.
		if ( is_numeric( $deposit ) && $deposit > 0.00 && $deposit < $min ) {
			$min = $deposit;
		}
		self::set_client_set_min( $post_id, (float) $min );

		$date = ( isset( $_POST['sa_partial_payments_extend_due_date'] ) ) ? strtotime( $_POST['sa_partial_payments_extend_due_date'] ) : '' ;
		self::set_extend_due_date( $post_id, $date );

	}
}
