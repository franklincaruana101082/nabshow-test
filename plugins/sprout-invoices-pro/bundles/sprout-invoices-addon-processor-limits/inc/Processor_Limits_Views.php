<?php

/**
 * SI_Processor_Limits Controller
 *
 * @package Sprout_Invoice
 * @subpackage SI_Processor_Limits
 */
class SI_Processor_Limits_Views extends SI_Processor_Limits {

	public static function init() {
		add_action( 'si_partial_payments_preheading', array( __CLASS__, 'add_message' ) );
	}

	public static function add_message() {
		$enabled_processors = SI_Payment_Processors::enabled_processors();
		if ( 3 < count( $enabled_processors ) ) {
			return;
		}
		ob_start();

		foreach ( $enabled_processors as $class ) {

			if ( method_exists( $class, 'get_instance' ) ) {

				$payment_processor = call_user_func( array( $class, 'get_instance' ) );
				$slug = $payment_processor->get_slug();

				$min = (float) self::get_payment_limit( $class, true );
				$max = (float) self::get_payment_limit( $class, false );
				$name = $payment_processor->public_name();

				if ( method_exists( $payment_processor, 'bank_supported' ) && $payment_processor->bank_supported() ) {

					$achmin = (float) self::get_payment_limit( $class, true, true );
					$achmax = (float) self::get_payment_limit( $class, false, true );

					$achname = __( 'Checking', 'sprout-invoices' );

					self::message( $achmin, $achmax, $achname );
				}

				self::message( $min, $max, $name );

			}
		}
		$view = ob_get_clean();

		print apply_filters( 'si_processor_limits_message', $view );
	}

	public static function message( $min = 0.00, $max = 0.00, $name = 'Credit Card' ) {
		if ( 'Credit Card' === $name ) {
			$name = 'a Credit Card';
		}
		if ( $max > 0.00 && $min > 0.00 ) {
			?>
				<p class="sa-message info"><?php printf( __( 'Payment amount must be between %s-%s to use %s', 'sprout-invoices' ), sa_get_formatted_money( $min ), sa_get_formatted_money( $max ), $name ) ?></p>
			<?php
		} elseif ( $min > 0.00 ) {
			?>
				<p class="sa-message info"><?php printf( __( 'Payment amount must be more than %s to use %s', 'sprout-invoices' ), sa_get_formatted_money( $min ), $name ) ?></p>
			<?php
		} elseif ( $max > 0.00 && $max < apply_filters( 'si_processor_limits_fake_max', 100000 ) ) {
			?>
				<p class="sa-message info"><?php printf( __( 'Payment amount must be less than %s to use %s', 'sprout-invoices' ), sa_get_formatted_money( $max ), $name ) ?></p>
			<?php
		}
	}
}
