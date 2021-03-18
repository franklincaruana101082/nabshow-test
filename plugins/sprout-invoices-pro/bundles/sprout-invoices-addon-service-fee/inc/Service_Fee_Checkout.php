<?php

/**
 * SI_Service_Fee Controller
 *
 * @package Sprout_Invoice
 * @subpackage SI_Service_Fee
 */
class SI_Service_Fee_Checkout extends SI_Service_Fee {

	public static function init() {

		// add fee on checkout
		add_action( 'si_checkout_action_'.SI_Checkouts::PAYMENT_PAGE, array( __CLASS__, 'maybe_add_processing_fee_from_checkout' ), -100, 1 );

		// failed checkout, remove the fee
		add_action( 'checkout_failed', array( __CLASS__, 'remove_processing_fee_from_checkout' ) );

		// Stripe compatible
		if ( class_exists( 'SA_Stripe' ) && 'true' == get_option( SA_Stripe::MODAL_JS_OPTION )  ) {
			add_filter( 'si_stripe_js_data_attributes', array( __CLASS__, 'adjust_stripe_total' ), 10, 2 );
			add_action( 'payment_complete', array( __CLASS__, 'add_fee_after_stripe_payment' ) );
		}

		add_action( 'si_default_theme_payment_options_desc', array( __CLASS__, 'add_service_fee_info_to_payment_options' ) );
		add_action( 'si_doc_line_items', array( __CLASS__, 'add_service_fee_info_to_below_balance' ), 100 );
	}

	public static function maybe_add_processing_fee_from_checkout( SI_Checkouts $checkout ) {
		$invoice = $checkout->get_invoice();
		$payment_processor = get_class( $checkout->get_processor() );

		$ach = false;
		if ( isset( $checkout->cache['bank_routing'] ) ) {
			$ach = true;
		}

		$service_fee = self::get_service_fee( $payment_processor );
		if ( ! (float) $service_fee ) {
			self::remove_processing_fee_from_checkout( $checkout );
			return;
		}

		// remove fee if exists.
		self::maybe_remove_processing_fee( $invoice );

		$fee_total = $invoice->get_calculated_total( false ) * ( $service_fee / 100 ); //

		$processor_options = $checkout->get_processor()->checkout_options();
		$label = ( isset( $processor_options['label'] ) && '' !== $processor_options['label'] ) ? $processor_options['label'] : 'Payment' ;
		self::add_service_fee( $invoice, $fee_total, sprintf( __( '%s Service Fee', 'sprout-invoices' ), $label ) );

	}

	////////////
	// Stripe //
	////////////



	public static function remove_processing_fee_from_checkout( $checkout ) {
		if ( ! is_a( $checkout, 'SI_Checkouts' ) ) {
			$checkout = SI_Checkouts::get_instance();
		}
		$invoice = $checkout->get_invoice();

		self::maybe_remove_processing_fee( $invoice );
	}

	public static function adjust_stripe_total( $data_attributes = array() ) {
		$invoice_id = get_the_id();
		$invoice = SI_Invoice::get_instance( $invoice_id );

		$fees = $invoice->get_fees();
		if ( isset( $fees['payment_service_fee'] ) ) {
			return;
		}

		$fee_total = self::get_stripe_fee_total( $invoice );

		$subtotal = ( si_has_invoice_deposit( $invoice->get_id() ) ) ? $invoice->get_deposit() : $invoice->get_balance();

		$payment_amount = $subtotal + $fee_total;

		$payment_in_cents = ( round( $payment_amount, 2 ) * 100 );
		$data_attributes['amount'] = $payment_in_cents;

		return $data_attributes;
	}

	public static function get_stripe_fee_total( $invoice ) {
		$service_fee = self::get_service_fee( 'SA_Stripe' );

		// remove fee if exists.
		self::maybe_remove_processing_fee( $invoice );

		$amount = ( si_has_invoice_deposit( $invoice->get_id() ) ) ? $invoice->get_deposit() : $invoice->get_balance();
		$fee_total = floatval( $amount * ( $service_fee / 100 ) );

		return $fee_total;
	}

	public static function add_fee_after_stripe_payment( SI_Payment $payment ) {

		if ( $payment->get_payment_method() !== SA_Stripe::PAYMENT_METHOD ) {
			return;
		}

		if ( 'true' !== get_option( SA_Stripe::MODAL_JS_OPTION ) ) {
			return;
		}

		$invoice_id = $payment->get_invoice_id();
		$invoice = SI_Invoice::get_instance( $invoice_id );

		$fees = $invoice->get_fees();
		if ( isset( $fees['payment_service_fee'] ) ) {
			return;
		}

		$fee_total = self::get_stripe_fee_total( $invoice );
		self::add_service_fee( $invoice, $fee_total, __( 'Credit Card Service Fee', 'sprout-invoices' ) );

	}


	///////////
	// theme //
	///////////

	public static function add_service_fee_info_to_payment_options() {
		$doc_id = get_the_id();

		$enabled_gateways = SI_Payment_Processors::doc_enabled_processors( $doc_id );

		if ( count( $enabled_gateways ) < 2 ) { // a fee is auto added if there's only one option
			return;
		}

		$payment_gateways = SI_Payment_Processors::get_registered_processors();

		ob_start();

		foreach ( $payment_gateways as $class => $label ) {
			if ( ! in_array( $class, $enabled_gateways ) ) {
				continue;
			}

			if ( ! method_exists( $class, 'get_instance' ) ) {
				continue;
			}

			$payment_processor = call_user_func( array( $class, 'get_instance' ) );

			$service_fee = self::get_service_fee( $class );
			if ( 0.001 > $service_fee ) {
				continue;
			}
			if ( SI_Payment_Processors::is_cc_processor( $class ) ) {

				if ( method_exists( $payment_processor, 'bank_supported' ) && $payment_processor->bank_supported() ) {
					if ( 'SA_Stripe_Profiles' === $class || 'SA_Stripe' === $class  ) {
						self::message( 'Credit Card or Bank Transfer', $service_fee );
					} else {
						$service_fee = self::get_service_fee( $class, true );
						self::message( 'Bank Transfer', $service_fee );
					}
				} else {
					self::message( 'Credit Card', $service_fee );
				}
			} else {
				$label = str_replace( array( '(onsite submission)', 'Payments Standard' ), array( '', '' ), $label );
				self::message( $label, $service_fee );
			}
		}

		$view = ob_get_clean();

		print apply_filters( 'si_processor_fees_messaging', $view );
	}

	public static function message( $label = '', $fee = 0.00 ) {
		if ( 0.00 < $fee ) {
			?>
				<p class="sa-message info"><?php printf( __( 'A payment fee of %1$s%% will be added to any %2$s payment.', 'sprout-invoices' ), $fee, $label ) ?></p>
			<?php
		} else {
			?>
				<p class="sa-message info"><?php printf( __( 'No payment fee will be added to any %1$s payment.', 'sprout-invoices' ), $label ) ?></p>
			<?php
		}
	}

	public static function add_service_fee_info_to_below_balance() {
		$doc_id = get_the_id();

		$enabled_gateways = SI_Payment_Processors::doc_enabled_processors( $doc_id );

		if ( count( $enabled_gateways ) < 2 ) { // a fee is auto added if there's only one option
			return;
		}

		$payment_gateways = SI_Payment_Processors::get_registered_processors();

		$fee_labels = array();
		foreach ( $payment_gateways as $class => $label ) {
			if ( ! in_array( $class, $enabled_gateways ) ) {
				continue;
			}

			if ( ! method_exists( $class, 'get_instance' ) ) {
				continue;
			}

			$payment_processor = call_user_func( array( $class, 'get_instance' ) );

			$service_fee = self::get_service_fee( $class );
			if ( 0.001 > $service_fee ) {
				continue;
			}
			if ( SI_Payment_Processors::is_cc_processor( $class ) ) {

				if ( 'SA_Stripe_Profiles' === $class || 'SA_Stripe' === $class  ) {
					$fee_labels[] = sprintf( __( '%1$s%% with a <b>Credit Card or Bank</b> Payment', 'sprout-invoices' ), $service_fee );
				} else {
					$fee_labels[] = sprintf( __( '%1$s%% with a <b>Credit Card</b> Payment', 'sprout-invoices' ), $service_fee );
				}

				if ( method_exists( $payment_processor, 'bank_supported' ) && $payment_processor->bank_supported() ) {
					$service_fee = self::get_service_fee( $class, true );

					if ( 0.00 < $service_fee ) {
						$fee_labels[] = sprintf( __( '%1$s%% with a <b>Bank Transfer</b>', 'sprout-invoices' ), $service_fee );
					}
				}
			} else {
				$fee_labels[] = sprintf( __( '%1$s%% with a <b>%2$s</b> Payment', 'sprout-invoices' ), $service_fee, str_replace( array( '(onsite submission)', 'Payments Standard' ), array( '', '' ), $label ) );
			}
		}
		if ( empty( $fee_labels ) ) {
			return;
		}

		$last_label = count( $fee_labels ) - 1;

		$fee_labels[ $last_label ] = __( 'or ', 'sprout-invoices' ) . $fee_labels[ $last_label ];

		_e( '<p class="service_fee_message">These payment options will include a service fee:', 'sprout-invoices' ); // paragraph closed below
		printf( '<br/>%s.</p>', implode( ', ', $fee_labels ) );

	}
}

