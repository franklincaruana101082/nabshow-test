<?php

/**
 * SI_Payment_Terms_Defaults Controller
 *
 * Creates the admin interferace to create defaults.
 *
 * @package SI_Payment_Terms_Defaults
 * @subpackage SI_Payment_Terms_Admin
 */
class SI_Payment_Terms_Defaults extends SI_Payment_Terms_Admin {
	const HIDDEN_DOC_ID_OPTION = 'si_payment_terms_default_invoice';
	const AJAX_ACTION = 'si_payment_term_import';

	public static function init() {

		if ( is_admin() ) {

			// Register Settings
			add_filter( 'si_settings', array( __CLASS__, 'register_settings' ) );
		}

		// AJAX table view override
		add_action( 'si_payment_terms_table_view', array( __CLASS__, 'maybe_override_table_view' ) );

		// add a meta box
		add_action( 'si_payment_terms_callback', array( get_class(), 'ajax_callback' ) );

		// import button
		add_action( 'si_payment_terms_log_button', array( __CLASS__, 'import_button' ) );
	}

	public static function import_button() {
		$sorted_payment_terms = self::get_sorted_payment_terms( self::get_hidden_doc_id() );

		if ( 1 > count( $sorted_payment_terms ) ) {
			?>
				<a href="<?php echo admin_url( 'admin.php?page=sprout-invoices-settings#addons' ) ?>" id="create_default_terms" class="si_admin_button si_muted" style="margin-left: 10px;"><?php _e( 'Create Default Fees', 'sprout-invoices' ) ?></a>
			<?php
		} else {
			?>
				<button href="javascript:void(0)" id="import_default_terms" class="si_admin_button si_muted" style="margin-left: 10px;"><?php _e( 'Import Default Fees', 'sprout-invoices' ) ?></button>
			<?php
		}
	}


	public static function ajax_callback() {
		if ( 'import_terms' !== $_REQUEST['maybe'] ) {
			return;
		}

		$sorted_payment_terms = self::get_sorted_payment_terms( self::get_hidden_doc_id() );
		foreach ( $sorted_payment_terms as $data ) {
			$data['doc_id'] = $_REQUEST['doc_id'];
			$data['time'] = strtotime( '+' . $data['duein'] . ' days', current_time( 'timestamp' ) );
			$new_payment_term = SI_Payment_Term::new_payment_term( $data );
		}

		wp_send_json_success( array( 'message' => __( 'Payment Terms Imported!', 'sprout-invoices' ) ) );

	}

	public static function get_hidden_doc_id() {
		$hidden_doc_id = get_option( self::HIDDEN_DOC_ID_OPTION, 0 );
		if ( $hidden_doc_id ) {
			$doc = si_get_doc_object( $hidden_doc_id );
			if ( ! is_a( $doc, 'SI_Invoice' ) ) {
				$hidden_doc_id = 0;
			}
		}

		if ( ! $hidden_doc_id ) {
			//$hidden_doc_id = SI_Invoice::create_invoice( $args, 'hidden' );
			$hidden_doc_id = wp_insert_post( array(
				'post_status' => 'hidden',
				'post_type' => 'sa_invoice',
				'post_title' => 'Default Payment Terms (IGNORE THIS POST)',
			) );
			update_option( self::HIDDEN_DOC_ID_OPTION, $hidden_doc_id );
		}

		return $hidden_doc_id;
	}

	public static function register_settings( $settings = array() ) {
		// Settings
		$settings['si_default_payment_terms_settings'] = array(
				'title' => __( 'Default Payment Terms', 'sprout-invoices' ),
				'weight' => 300,
				'tab' => 'addons',
				'settings' => array(
					'si_default_payment_terms' => array(
						'option' => array(
							'type' => 'bypass',
							'output' => self::payment_terms_admin(),
							'description' => __( 'Create a set of default payment terms that will be added to your invoices automatically.', 'sprout-invoices' ),
						),
					),
				),
		);
		return $settings;
	}

	public static function payment_terms_admin() {
		// remove SB messaging
		remove_action( 'si_payment_terms_metabox_start', array( 'SI_Payment_Terms_Billings', 'add_message_below_term_options' ) );

		// trick
		$doc_id = self::get_hidden_doc_id();

		$sorted_payment_terms = self::get_sorted_payment_terms( $doc_id );

		$view = self::load_addon_view_to_string( 'admin/payment-terms/defaults', array(
			'doc_id' => $doc_id,
			'sorted_payment_terms' => $sorted_payment_terms,
		), true );

		// option to save
		$fields = self::default_fee_creation_fields( $doc_id );
		$view .= self::load_addon_view_to_string( 'admin/payment-terms/default-term-options', array(
			'doc_id' => $doc_id,
			'fields' => $fields,
		), true );

		return $view;
	}

	public static function default_fee_creation_fields( $doc_id = 0 ) {
		$fields = self::fee_creation_fields( $doc_id );

		unset( $fields['time'] );
		unset( $fields['recurring'] );
		unset( $fields['complete'] );

		$fields['duein'] = array(
			'weight' => 10,
			'label' => __( 'Due in Days', 'sprout-invoices' ),
			'type' => 'number',
			'default' => 14,
			'description' => __( 'Number of days from the creation of the invoice that this payment is due.', 'sprout-invoices' ),
		);

		$fields = apply_filters( 'si_default_fees_entry_form_fields', $fields );
		uasort( $fields, array( __CLASS__, 'sort_by_weight' ) );
		return $fields;
	}

	public static function maybe_override_table_view() {

		if ( ! current_user_can( 'edit_sprout_invoices' ) ) {
			wp_send_json_error( array( 'message' => 'User cannot create new posts!' ) );
		}

		$doc_id = 0;
		if ( isset( $_REQUEST['doc_id'] ) ) {
			$doc_id = $_REQUEST['doc_id'];
		}

		if ( ! $doc_id || $doc_id != self::get_hidden_doc_id() ) {
			// stop trying to override, silently
			return;
		}

		// remove SB messaging
		remove_action( 'si_payment_terms_metabox_start', array( 'SI_Payment_Terms_Billings', 'add_message_below_term_options' ) );

		$sorted_payment_terms = self::get_sorted_payment_terms( $doc_id );

		$view = self::load_addon_view_to_string( 'admin/payment-terms/defaults', array(
			'doc_id' => $doc_id,
			'sorted_payment_terms' => $sorted_payment_terms,
		), true );

		wp_send_json_success( array( 'view' => $view ) );
	}
}
