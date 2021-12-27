<?php

/**
 *
 * @package SI
 * @subpackage Payment SI_Offsite_Processors
 */
class SA_Zelle extends SI_Offsite_Processors {
	const MODE_LIVE = 'production';
	const ZELLE_EMAIL = 'si_sc_zelle_email';
	const ZELLE_PHONE = 'si_sc_zelle_phone';
	const PAYMENT_METHOD = 'Zelle';
	const PAYMENT_SLUG = 'sc';

	protected static $instance;
	private static $zellemail = '';
	private static $zellephone = '';

	public static function get_instance() {
		if ( ! ( isset( self::$instance ) && is_a( self::$instance, __CLASS__ ) ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function get_payment_method() {
		return self::PAYMENT_METHOD;
	}

	public function get_slug() {
		return self::PAYMENT_SLUG;
	}

	public static function register() {
		self::add_payment_processor( __CLASS__, __( 'Zelle' , 'sprout-invoices' ) );
	}


	public static function public_name() {
		return __( 'Zelle' , 'sprout-invoices' );
	}

	public static function checkout_options() {
		$option = array(
			'icons' => array(
				SI_URL . '/resources/front-end/img/zelle.png',
				),
			'label' => __( 'Zelle' , 'sprout-invoices' ),
			'accepted_cards' => array(
				'visa',
				//'mastercard',
				//'amex',
				// 'diners',
				//'discover',
				// 'jcb',
				// 'maestro'
				),
			);
		return apply_filters( 'si_sp_checkout_options', $option );
	}

	protected function __construct() {
		parent::__construct();
		self::$zellemail = get_option( self::ZELLE_EMAIL, '' );

		self::$zellephone = get_option( self::ZELLE_PHONE, '' );

		add_action( 'si_checkout_action_'.SI_Checkouts::PAYMENT_PAGE, array( $this, 'send_offsite' ), 0, 1 );

		// Remove pages
		add_filter( 'si_checkout_pages', array( $this, 'remove_checkout_pages' ) );
	}

	/**
	 * The review page is unnecessary
	 *
	 * @param array   $pages
	 * @return array
	 */
	public function remove_checkout_pages( $pages ) {
		unset( $pages[ SI_Checkouts::REVIEW_PAGE ] );
		return $pages;
	}

	/**
	 * Hooked on init add the settings page and options.
	 *
	 */
	public static function register_settings( $settings = array() ) {
		// Settings
		$settings['payments'] = array(
			'si_zelle_settings' => array(
				'title' => __( 'Zelle' , 'sprout-invoices' ),
				'weight' => 200,
				'settings' => array(

					self::ZELLE_EMAIL => array(
						'label' => __( 'Zelle Email', 'sprout-invoices' ),
						'option' => array(
							'type' => 'text',
							'default' => self::$zellemail,
							'description' => __( 'Email Tied to Zelle Account', 'sprout-invoices' ),
							),
						),
					
					self::ZELLE_PHONE => array(
						'label' => __( 'Zelle Phone', 'sprout-invoices' ),
						'option' => array(
							'type' => 'text',
							'default' => self::$zellephone,
							'description' => __( 'Primary phone Tied to Zelle Account', 'sprout-invoices' ),
							),
						),
					


				),
			),

		);
		return $settings;
	}

	/**
	 * Instead of redirecting to the SIcheckout page,
	 * set up the Express Checkout transaction and redirect there
	 *
	 * @param SI_Carts $cart
	 * @return void
	 */
	public function send_offsite( SI_Checkouts $checkout ) {
		// Check to see if the payment processor being used is for this payment processor
		if ( ! is_a( $checkout->get_processor(), __CLASS__ ) ) { 
			return;
		}




		$checkout_complete_url = $checkout->checkout_complete_url( self::PAYMENT_SLUG )
		?>
		<html>
			<head>
			 <style type="text/css">
				.zelle_button {
					background-color: #4CAF50; /* Green */
  					border: none;
					color: white;
					padding: 15px 32px;
					text-align: center;
					text-decoration: none;
					display: inline-block;
					font-size: 16px;
				}
				.zelle_email {
					border: none;
					width: 360px;
					height: 55px;
					font-size: large;
				}
				.zelle_phone {
					border: none;
					width: 360px;
					height: 55px;
					font-size: large;
				}
				label {
					border: none;
					font-size: large;
					color: white;
				}
				body {
					margin: auto;
					top: 0;
					left: 0;
					width: 50%;
   				 	height: 100%;
					text-align: center;
					padding: 100px;
					background: linear-gradient( #9700FF 30%, #fff 50%);
				}
			 </style>
			</head>
			<body >
				<script src="https://www.zellepay.com/get-started"></script>
				
				<form action='' method='post'>
					<label for="zellemail">Primary Zelle Email</label></br></br>
					<input type='text' class="zelle_email" name='zellemail' value='<?php echo self::$zellemail ?>' readonly/></br></br>

					<label for="zellephone">Primary Zelle Phone</label></br></br>
					<input type='text' class="zelle_phone" name='zellephone' value='<?php echo self::$zellephone ?>' readonly/></br></br>
					
					<label for="zelleguide"></label></br></br>
					<input class="zelle_button" type="button" value="Zelle Getting started Guide" onclick="window.open('https://www.zellepay.com/get-started', '_blank'); return false;" />
				</form>
			</body>
		</html>
		<?php



		//$invoice = $checkout->get_invoice();
		//$payment_amount = ( si_has_invoice_deposit( $invoice->get_id() ) ) ? $invoice->get_deposit() : $invoice->get_balance();
		echo '';
		//
		//wp_redirect( '' );
		exit();
	}

	/**
	 * Process a payment
	 *
	 * @param SI_Checkouts $checkout
	 * @param SI_Invoice $invoice
	 * @return SI_Payment|bool false if the payment failed, otherwise a Payment object
	 */
	public function process_payment( SI_Checkouts $checkout, SI_Invoice $invoice ) {
		// Nothing, since the user is not returned.
	}
}
SA_Zelle::register();
