<?php

/**
 * Time_Tracking_Toggl Controller
 *
 * @package Sprout_Invoice
 * @subpackage Time_Tracking_Toggl
 */
class Zapier_Controller extends SI_Controller {
	const RECORD = 'si_zapier_zap';
	const SENTASNEW = '_si_zapier_sent_as_new';

	public static function init() {
		add_action( 'save_post', array( __CLASS__, 'save_invoice' ), 10, 2 );
		add_action( 'save_post', array( __CLASS__, 'save_estimate' ), 10, 2 );

		add_action( 'si_doc_generation_complete', array( __CLASS__, 'doc_created' ) );

		add_action( 'future_to_publish', array( __CLASS__, 'scheduled_post' ) );

		add_action( 'doc_status_changed',  array( __CLASS__, 'send_accepted_estimate' ), 0 );
		add_action( 'si_new_payment',  array( __CLASS__, 'send_payment_notification' ) );

		// add_action( 'admin_init',  array( __CLASS__, 'test' ) );
	}

	public static function test() {
		$data = array();
		$data['target_url'] = 'https://zapier.com/hooks/standard/6s1g1DxMC04RIh2UxwgwmTjDzzrE5prx/';
		self::new_zap( (object) $data, 'new_invoice' );
	}

	//////////////////////////
	// Callbacks to Zapier //
	//////////////////////////


	public static function save_invoice( $post_id, $post ) {
		if ( $post->post_type != SI_Invoice::POST_TYPE ) {
			return;
		}

		if ( $post->post_status == 'auto-draft' || isset( $_GET['bulk_edit'] )  ) {
			return;
		}

		// ignore revisions
		if ( wp_is_post_autosave( $post_id ) ) {
			return;
		}

		if ( doing_action( 'si_doc_generation_start' ) ) {
			return;
		}

		if ( did_action( 'zapier_send_invoice' ) ) {
			return;
		}

		$sent_before = get_post_meta( $post_id, self::SENTASNEW, true );

		$action = ( '' == $sent_before ) ? 'new_invoice' : 'updated_invoice' ;
		self::send_invoice( $post_id, $action );
		do_action( 'zapier_send_invoice', $post_id, $action );

		if ( 'new_invoice' === $action ) {
			add_post_meta( $post_id, self::SENTASNEW, current_time( 'timestamp' ) );
		}
	}

	public static function save_estimate( $post_id, $post ) {
		if ( $post->post_type != SI_Estimate::POST_TYPE ) {
			return;
		}

		if ( $post->post_status == 'auto-draft' || isset( $_GET['bulk_edit'] )  ) {
			return;
		}

		// ignore revisions
		if ( wp_is_post_autosave( $post_id ) ) {
			return;
		}

		if ( doing_action( 'si_doc_generation_start' ) ) {
			return;
		}

		if ( did_action( 'zapier_send_invoice' ) ) {
			return;
		}

		$sent_before = get_post_meta( $post_id, self::SENTASNEW, true );

		$action = ( '' == $sent_before ) ? 'new_estimate' : 'updated_estimate' ;
		self::send_estimate( $post_id, $action );
		do_action( 'zapier_send_estimate', $post_id, $action );

		if ( 'new_estimate' === $action ) {
			add_post_meta( $post_id, self::SENTASNEW, current_time( 'timestamp' ) );
		}
	}

	public static function doc_created( $doc ) {
		if ( is_a( $doc, 'SI_Invoice' ) ) {
			self::send_invoice( $doc->get_id(), 'new_invoice' );
		}
		if ( is_a( $doc, 'SI_Estimate' ) ) {
			self::send_estimate( $doc->get_id(), 'new_estimate' );
		}

	}

	public static function scheduled_post( $post ) {
		switch ( $post->post_type ) {

			case SI_Estimate::POST_TYPE:
				self::new_estimate( $post->ID, $post );
				break;

			case SI_Invoice::POST_TYPE:
				self::new_invoice( $post->ID, $post );
				break;

			default:
				break;
		}
	}

	public static function send_payment_notification( SI_Payment $payment ) {
		if ( $payment->get_status() === SI_Payment::STATUS_VOID ) {
			return;
		}
		$invoice_id = $payment->get_invoice_id();
		$invoice = SI_Invoice::get_instance( $invoice_id );
		if ( ! is_a( $invoice, 'SI_Invoice' ) ) {
			return;
		}

		$payment_data = self::payment_data( $payment );
		self::send_invoice( $invoice->get_id(), 'invoice_received_payment', $payment_data );
	}

	public static function send_accepted_estimate( $estimate ) {
		if ( ! is_a( $estimate, 'SI_Estimate' ) ) {
			return;
		}
		// Check if status changed was to approved.
		if ( $estimate->get_status() != SI_Estimate::STATUS_APPROVED ) {
			return;
		}

		self::send_estimate( $estimate->get_id(), 'accepted_estimate' );
	}

	///////////////////////
	// Send object data //
	///////////////////////


	public static function send_invoice( $invoice_id = 0, $event = '', $payment_data = array() ) {
		if ( $event == '' ) {
			return;
		}
		$invoice = SI_Invoice::get_instance( $invoice_id );
		if ( ! is_a( $invoice, 'SI_Invoice' ) ) {
			return;
		}
		$zaps = self::get_zaps_by_event( $event );
		if ( empty( $zaps ) ) {
			$all_zaps = self::get_all_zaps();
			return;
		}
		$data = self::invoice_data( $invoice );
		$data = array_merge( $data, array( 'payment' => $payment_data ) );
		Zapier_API::send_zaps( $zaps, $data );
	}

	public static function send_estimate( $estimate_id = 0, $event = '' ) {
		if ( $event == '' ) {
			return;
		}
		$estimate = SI_Estimate::get_instance( $estimate_id );
		if ( ! is_a( $estimate, 'SI_Estimate' ) ) {
			return;
		}
		$zaps = self::get_zaps_by_event( $event );
		if ( empty( $zaps ) ) {
			return;
		}
		$data = self::estimate_data( $estimate );
		Zapier_API::send_zaps( $zaps, $data );
	}

	public static function get_send_payment( $payment_id = 0, $event = '' ) {
		if ( $event == '' ) {
			return;
		}
		$payment = SI_Payment::get_instance( $payment_id );
		if ( ! is_a( $payment, 'SI_Payment' ) ) {
			return;
		}
		$zaps = self::get_zaps_by_event( $event );
		if ( empty( $zaps ) ) {
			return;
		}
		$data = self::payment_data( $payment );
		return $data;
		//Zapier_API::send_zaps( $zaps, $data );
	}

	public static function send_client( $client_id = 0, $event = '' ) {
		if ( $event == '' ) {
			return;
		}
		$client = SI_Payment::get_instance( $client_id );
		if ( ! is_a( $client, 'SI_Client' ) ) {
			return;
		}
		$zaps = self::get_zaps_by_event( $event );
		if ( empty( $zaps ) ) {
			return;
		}
		$data = self::client_data( $client );
		Zapier_API::send_zaps( $zaps, $data );
	}

	///////////
	// Data //
	///////////

	public static function estimate_data( SI_Estimate $estimate ) {
		$estimate_data = array(
			'title' => $estimate->get_title(),
			'id' => $estimate->get_id(),
			'edit_url' => get_edit_post_link( $estimate->get_id() ),
			'estimate_id' => $estimate->get_estimate_id(),
			'invoice_id' => $estimate->get_invoice_id(),
			'client_id' => $estimate->get_client_id(),
			'client_data' => array(),
			'status' => $estimate->get_status(),
			'issue_date' => date( DATE_ISO8601, $estimate->get_issue_date() ),
			'expiration_date' => date( DATE_ISO8601, $estimate->get_expiration_date() ),
			'po_number' => $estimate->get_po_number(),
			'discount' => $estimate->get_discount(),
			'tax' => $estimate->get_tax(),
			'tax2' => $estimate->get_tax2(),
			'currency' => $estimate->get_currency(),
			'fees' => $estimate->get_fees(),
			'total' => $estimate->get_total(),
			'subtotal' => $estimate->get_subtotal(),
			'calculated_total' => $estimate->get_calculated_total(),
			'project_id' => $estimate->get_project_id(),
			'terms' => $estimate->get_terms(),
			'notes' => $estimate->get_notes(),
			'line_items' => self::format_line_items( $estimate ),
			'user_id' => $estimate->get_user_id(),
			'permalink' => get_permalink( $estimate->get_id() ),
			);
		if ( $estimate->get_client_id() ) {
			$client = SI_Client::get_instance( $estimate->get_client_id() );
			if ( is_a( $client, 'SI_Client' ) ) {
				$estimate_data['client_data'] = self::client_data( $client );
			}
		}
		return $estimate_data;
	}

	public static function invoice_data( SI_Invoice $invoice ) {
		$invoice_data = array(
			'title' => $invoice->get_title(),
			'id' => $invoice->get_id(),
			'edit_url' => get_edit_post_link( $invoice->get_id() ),
			'invoice_id' => $invoice->get_invoice_id(),
			'status' => $invoice->get_status(),
			'balance' => $invoice->get_balance(),
			'deposit' => $invoice->get_deposit(),
			'issue_date' => date( DATE_ISO8601, $invoice->get_issue_date() ),
			'estimate_id' => $invoice->get_estimate_id(),
			'due_date' => date( DATE_ISO8601, $invoice->get_due_date() ),
			'expiration_date' => date( DATE_ISO8601, $invoice->get_expiration_date() ),
			'client_id' => $invoice->get_client_id(),
			'client_data' => array(),
			'po_number' => $invoice->get_po_number(),
			'discount' => $invoice->get_discount(),
			'tax' => $invoice->get_tax(),
			'tax2' => $invoice->get_tax2(),
			'currency' => $invoice->get_currency(),
			'fees' => $invoice->get_fees(),
			'total' => $invoice->get_total(),
			'subtotal' => $invoice->get_subtotal(),
			'calculated_total' => $invoice->get_calculated_total(),
			'project_id' => $invoice->get_project_id(),
			'terms' => $invoice->get_terms(),
			'notes' => $invoice->get_notes(),
			'line_items' => self::format_line_items( $invoice ),
			'user_id' => $invoice->get_user_id(),
			'payment_ids' => $invoice->get_payments(),
			'permalink' => get_permalink( $invoice->get_id() ),
			);
		if ( $invoice->get_client_id() ) {
			$client = SI_Client::get_instance( $invoice->get_client_id() );
			if ( is_a( $client, 'SI_Client' ) ) {
				$invoice_data['client_data'] = self::client_data( $client );
			}
		}
		return $invoice_data;
	}

	public static function format_line_items( $doc ) {
		$line_items = array_values( $doc->get_line_items() );
		foreach ( $line_items as $key => $values ) {
			foreach ( $values as $type => $value ) {
				if ( 'desc' === $type ) {
					$line_items[ $key ]['html_desc'] = $value;
					$line_items[ $key ]['desc'] = wp_strip_all_tags( $value );
				}
			}
		}
		return $line_items;
	}

	public static function payment_data( SI_Payment $payment ) {
		$payment_data = array(
			'title' => $payment->get_title(),
			'id' => $payment->get_id(),
			'status' => $payment->get_status(),
			'payment_method' => $payment->get_payment_method(),
			'amount' => $payment->get_amount(),
			'invoice_id' => $payment->get_invoice_id(),
			'data' => $payment->get_data(),
			);
		$invoice = SI_Invoice::get_instance( $payment->get_invoice_id() );
		if ( is_a( $invoice, 'SI_Invoice' ) ) {
			$payment_data['invoice_data'] = self::invoice_data( $invoice );
		}
		return $payment_data;
	}

	public static function client_data( SI_Client $client ) {
		$emails = array();
		$associated_users = $client->get_associated_users();
		if ( ! empty( $associated_users ) ) {
			foreach ( $associated_users as $user_id ) {
				$user = get_userdata( $user_id );
				if ( $user ) {
					$emails[] = $user->user_email;
				}
			}
		}
		$client_data = array(
			'company_name' => $client->get_title(),
			'address' => $client->get_address(),
			'user_ids' => $associated_users,
			'user_email' => ( is_array( $emails ) && ! is_null( $emails[0] ) ) ? $emails[0] : '',
			'user_emails' => $emails,
			'phone' => $client->get_phone(),
			'website' => $client->get_website(),
			'estimate_ids' => $client->get_invoices(),
			'invoice_ids' => $client->get_estimates(),
			'payment_ids' => $client->get_payments(),
			'id' => $client->get_id(),
			'edit_url' => get_edit_post_link( $client->get_id() ),
			);
		return $client_data;
	}

	public static function project_data( SI_Project $project ) {
		$project_data = array();
		return $project_data;
	}

	//////////////
	// Records //
	//////////////

	/**
	 * Create a zap entry
	 * @param  array $data
	 * @return int
	 */
	public static function new_zap( $data = array(), $event = '' ) {
		if ( ! isset( $data->target_url ) ) {
			return;
		}
		if ( $event == '' ) {
			if ( isset( $data->event ) ) {
				$event = $data->event;
			}
		}
		$id = SI_Internal_Records::new_record(
			$data,
			self::RECORD,
			-1,
		$event );

		$zap = SI_Record::get_instance( $id );
		$zap->set_excerpt( $data->target_url );
		return $id;
	}

	public static function get_zap( $zap_id = 0 ) {
		$record = SI_Record::get_instance( $zap_id );
		if ( ! is_a( $record, 'SI_Record' ) ) {
			$record = 0;
		}
		return $record;
	}

	public static function delete_zap( $zap_id = 0 ) {
		$zap = SI_Record::get_instance( $zap_id );
		if ( is_a( $zap, 'SI_Record' ) ) {
			wp_delete_post( $zap_id, true );
		}
	}

	public static function get_all_zaps() {
		return SI_Record::get_records_by_type( self::RECORD );
	}

	public static function get_zap_target_url( $zap_id = 0 ) {
		$zap = SI_Record::get_instance( $zap_id );
		if ( ! is_a( $zap, 'SI_Record' ) ) {
			return;
		}
		return $zap->get_excerpt();
	}

	public static function get_zap_by_target_url( $target_url = '' ) {
		global $wpdb;
		$post_id = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_type = %s AND post_excerpt = %s", SI_Record::POST_TYPE, $target_url ) );
		return $post_id;
	}

	public static function get_zaps_by_event( $event = '' ) {
		global $wpdb;
		$post_ids = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_type = %s AND post_title = %s", SI_Record::POST_TYPE, $event ) );
		return $post_ids;
	}
}
