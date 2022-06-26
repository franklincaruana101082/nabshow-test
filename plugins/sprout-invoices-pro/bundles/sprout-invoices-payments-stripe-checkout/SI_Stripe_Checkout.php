<?php

class SI_Stripe_Checkout extends SI_Offsite_Processors {
	const MODE_TEST = 'test';
	const MODE_LIVE = 'live';

	const API_SECRET_KEY_OPTION      = 'si_stripe_secret_key';
	const API_SECRET_KEY_TEST_OPTION = 'si_stripe_secret_key_test';
	const API_PUB_KEY_OPTION         = 'si_stripe_pub_key';
	const API_PUB_KEY_TEST_OPTION    = 'si_stripe_pub_key_test';

	const CANCEL_URL_OPTION = 'si_stripe_cancel_url';
	const RETURN_URL_OPTION = 'si_stripe_return_url';

	const STRIPE_CHECKOUT_CUSTOMER_KEY_USER_META = 'si_stripe_customer_id_v1';

	const API_MODE_OPTION      = 'si_stripe_mode';
	const CURRENCY_CODE_OPTION = 'si_stripe_currency';

	const PAYMENT_METHOD = 'Credit (Stripe Checkout)';
	const PAYMENT_SLUG   = 'stripe_checkout';

	// webhooks
	const API_QUERY_VAR = 'si_stripe_checkout';

	protected static $instance;
	protected static $api_mode = self::MODE_TEST;

	private static $api_secret_key;
	private static $api_secret_key_test;
	private static $api_pub_key;
	private static $api_pub_key_test;
	private static $cancel_url = '';

	private static $currency_code = 'usd';

	public static function get_instance() {
		if ( ! ( isset( self::$instance ) && is_a( self::$instance, __CLASS__ ) ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private static function is_test() {
		return self::MODE_TEST === self::$api_mode;
	}

	public function get_payment_method() {
		return self::PAYMENT_METHOD;
	}

	public function get_slug() {
		return self::PAYMENT_SLUG;
	}

	public static function returned_from_offsite() {
		return ( isset( $_GET[ self::PAYMENT_SLUG ] ) );
	}

	public static function register() {
		// Register processor
		self::add_payment_processor( __CLASS__, __( 'Stripe Checkout', 'sprout-invoices' ) );

		if ( ! self::is_active() ) {
			return;
		}

		self::register_query_var( self::PAYMENT_SLUG, [ __CLASS__, 'maybe_back_from_stripe' ] );

		add_action( 'si_settings_saved', [ get_class(), 'maybe_create_hook_endpoint' ] );

		self::register_query_var( self::API_QUERY_VAR, [ __CLASS__, 'webhook_listener' ] );

		// Add Recurring button
		add_action( 'recurring_payments_profile_info', [ __CLASS__, 'stripe_profile_link' ] );
	}

	public static function public_name() {
		return __( 'Credit Card', 'sprout-invoices' );
	}

	public static function checkout_options() {
		$option['purchase_button_callback'] = [ __CLASS__, 'payment_button' ];
		return $option;
	}

	protected function __construct() {
		parent::__construct();
		self::$api_mode      = get_option( self::API_MODE_OPTION, self::MODE_TEST );
		self::$currency_code = get_option( self::CURRENCY_CODE_OPTION, 'usd' );

		self::$api_secret_key      = get_option( self::API_SECRET_KEY_OPTION, '' );
		self::$api_secret_key_test = get_option( self::API_SECRET_KEY_TEST_OPTION, '' );
		self::$api_pub_key         = get_option( self::API_PUB_KEY_OPTION, '' );
		self::$api_pub_key_test    = get_option( self::API_PUB_KEY_TEST_OPTION, '' );

		self::$cancel_url = get_option( self::CANCEL_URL_OPTION, add_query_arg( [ 'stripe_checkout' => 'cancelled' ], home_url( '/' ) ) );
		if ( self::$cancel_url === '' ) {
			$url = add_query_arg( [ 'stripe_checkout' => 'cancelled' ], home_url( '/' ) );
			update_option( self::CANCEL_URL_OPTION, $url );
			self::$cancel_url = esc_url_raw( $url );
		}
	}


	/**
	 * Hooked on init add the settings page and options.
	 */
	public static function register_settings( $settings = [] ) {
		// Settings
		$settings['payments'] = [
			'si_stripe_settings' => [
				'title'    => __( 'Stripe Checkout Settings', 'sprout-invoices' ),
				'weight'   => 200,
				'settings' => [
					self::API_MODE_OPTION            => [
						'label'  => __( 'Mode', 'sprout-invoices' ),
						'option' => [
							'type'    => 'select',
							'options' => [
								self::MODE_LIVE => __( 'Live', 'sprout-invoices' ),
								self::MODE_TEST => __( 'Test', 'sprout-invoices' ),
							],
							'default' => self::$api_mode,
						],
					],
					self::API_SECRET_KEY_OPTION      => [
						'label'  => __( 'Live Secret Key', 'sprout-invoices' ),
						'option' => [
							'type'    => 'text',
							'default' => self::$api_secret_key,
						],
					],
					self::API_PUB_KEY_OPTION         => [
						'label'  => __( 'Live Publishable Key', 'sprout-invoices' ),
						'option' => [
							'type'    => 'text',
							'default' => self::$api_pub_key,
						],
					],
					self::API_SECRET_KEY_TEST_OPTION => [
						'label'  => __( 'Test Secret Key', 'sprout-invoices' ),
						'option' => [
							'type'    => 'text',
							'default' => self::$api_secret_key_test,
						],
					],
					self::API_PUB_KEY_TEST_OPTION    => [
						'label'  => __( 'Test Publishable Key', 'sprout-invoices' ),
						'option' => [
							'type'    => 'text',
							'default' => self::$api_pub_key_test,
						],
					],
					self::CURRENCY_CODE_OPTION       => [
						'label'  => __( 'Currency Code', 'sprout-invoices' ),
						'option' => [
							'type'       => 'text',
							'default'    => self::$currency_code,
							'attributes' => [ 'class' => 'small-text' ],
						],
					],
				],
			],
		];
		return $settings;
	}

	private static function load_sdk() {
		if ( ! class_exists( 'Stripe' ) ) {
			require_once 'inc/sdk/init.php';
		} else {
			do_action( 'si_error', __CLASS__ . '::' . __FUNCTION__ . ' - the Stripe class is already included.', null );
		}
		try {
			// Setup the API
			$key = ( self::is_test() ) ? self::$api_secret_key_test : self::$api_secret_key;

			\Stripe\Stripe::setAppInfo(
				'Sprout Invoices',
				self::SI_VERSION,
				'https://sproutinvoices.com/sprout-invoices/',
				'pp_partner_DL3bDXVUCYCNPQ'
			);

			\Stripe\Stripe::setApiKey( $key );
		} catch ( Exception $e ) {
			self::set_error_messages( $e->getMessage() );
			return false;
		}
	}

	public static function payment_button( $invoice_id = 0 ) {
		$pub_key = ( self::is_test() ) ? self::$api_pub_key_test : self::$api_pub_key;

		$session = self::create_session( $invoice_id );

		$view = self::load_addon_view(
			'button',
			[
				'pubkey'     => $pub_key,
				'session_id' => $session,
			],
			true 
		);
		print $view;
	}

	public static function create_session( $invoice_id = 0 ) {
		if ( ! $invoice_id ) {
			$invoice_id = get_the_id();
		}
		$invoice = SI_Invoice::get_instance( $invoice_id );

		$payment_amount = ( si_has_invoice_deposit( $invoice->get_id() ) ) ? $invoice->get_deposit() : $invoice->get_balance();

		$user       = si_who_is_paying( $invoice );
		$user_email = ( $user ) ? $user->user_email : '';

		self::load_sdk();

		// create new payment if none was found
		$payment_id = self::check_for_old_sessions( $invoice );
		if ( ! $payment_id ) {
			// create a pending payment as the checkout session
			$payment_id = SI_Payment::new_payment(
				[
					'payment_method' => self::PAYMENT_METHOD,
					'invoice'        => $invoice->get_id(),
					'amount'         => $payment_amount,
					'data'           => [
						'live'         => ( self::$api_mode == self::MODE_LIVE ),
						'api_response' => 'Stripe Checkout',
					],
				],
				SI_Payment::STATUS_VOID 
			);
		}

		if ( si_is_invoice_recurring( $invoice ) ) {
			$plan_id = self::create_recurring_payment_plan( $invoice );

			$create = [
				'client_reference_id'  => $payment_id,
				'customer_email'       => $user_email,
				'payment_method_types' => [ 'card' ],
				'subscription_data'    => [
					'items' => [
						[
							'plan' => $plan_id,
						],
					],
				],
				'success_url'          => add_query_arg( [ self::PAYMENT_SLUG => $payment_id ], get_permalink( $invoice_id ) ),
				'cancel_url'           => add_query_arg(
					[
						self::PAYMENT_SLUG => $payment_id,
						'cancelled'        => 'true',
					],
					get_permalink( $invoice_id ) 
				),
			];
		} else {
			$session_line_items       = self::get_line_item_array( $invoice );
			$session_line_items_total = self::get_line_item_array( $invoice, true );

			// if the line items don't add up to the payment total
			// use the basic line items instead.
			if ( $session_line_items_total !== $payment_amount ) {
				$session_line_items = self::get_basic_line_item_array( $invoice );
			}

			$create = [
				'client_reference_id'  => $payment_id,
				'customer_email'       => $user_email,
				'payment_method_types' => [ 'card' ],
				'line_items'           => $session_line_items,
				'success_url'          => add_query_arg( [ self::PAYMENT_SLUG => $payment_id ], get_permalink( $invoice_id ) ),
				'cancel_url'           => add_query_arg(
					[
						self::PAYMENT_SLUG => $payment_id,
						'cancelled'        => 'true',
					],
					get_permalink( $invoice_id ) 
				),
			];
		}

		$result = \Stripe\Checkout\Session::create( apply_filters( 'si_stripe_checkout_session_create', $create, $invoice ) );

		return $result->id;
	}

	public static function check_for_old_sessions( SI_Invoice $invoice ) {
		$invoice_id     = $invoice->get_id();
		$payment_amount = ( si_has_invoice_deposit( $invoice->get_id() ) ) ? $invoice->get_deposit() : $invoice->get_balance();

		$args   = [
			'post_type'        => SI_Payment::POST_TYPE,
			'post_status'      => 'void',
			'meta_key'         => '_payment_invoice',
			'meta_value'       => $invoice_id,
			'posts_per_page'   => -1,
			'fields'           => 'ids',
			'si_bypass_filter' => true,
		];
		$result = get_posts( $args );

		if ( ! is_array( $result ) || empty( $result ) ) {
			return false;
		}

		foreach ( $result as $payment_id ) {
			$payment             = SI_Payment::get_instance( $payment_id );
			$reusable_payment_id = $payment_id;

			if ( $payment->get_payment_method() !== self::PAYMENT_METHOD ) {
				self::delete_payment( $payment_id );
				$reusable_payment_id = false;
				continue;
			}

			if ( $payment_amount !== $payment->get_amount() ) {
				self::delete_payment( $payment_id );
				$reusable_payment_id = false;
				continue;
			}
		}

		return $reusable_payment_id;
	}

	/**
	 * Process a payment
	 *
	 * @param SI_Checkouts $checkout
	 * @param SI_Invoice   $invoice
	 * @return SI_Payment|bool false if the payment failed, otherwise a Payment object
	 */
	public function process_payment( SI_Checkouts $checkout, SI_Invoice $invoice ) {
		// unused
	}

	public static function maybe_back_from_stripe() {
		if ( self::returned_from_offsite() && ! is_numeric( $_GET[ self::PAYMENT_SLUG ] ) ) {
			return false;
		}

		$payment_id = $_GET[ self::PAYMENT_SLUG ];

		if ( isset( $_GET['cancelled'] ) && 'true' == $_GET['cancelled'] ) {
			self::set_message( __( 'Payment Cancelled', 'sprout-invoices' ), self::MESSAGE_STATUS_INFO );

			self::delete_payment( $payment_id );

			wp_redirect( remove_query_arg( [ self::PAYMENT_SLUG, 'cancelled' ] ) );
			exit();

			return false;
		}

		$payment = SI_Payment::get_instance( $payment_id );

		if ( ! is_a( $payment, 'SI_Payment' ) ) {
			self::set_message( __( 'Payment Invalid', 'sprout-invoices' ), self::MESSAGE_STATUS_INFO );
			wp_redirect( remove_query_arg( self::PAYMENT_SLUG ) );
			exit();
		}

		$invoice_id = $payment->get_invoice_id();
		$invoice    = SI_Invoice::get_instance( $invoice_id );

		// Messaging
		if ( $payment->get_status() === SI_Payment::STATUS_PENDING ) {
			if ( $invoice->get_balance() < 0.01 ) {
				self::set_message( __( 'Payment Pending', 'sprout-invoices' ), self::MESSAGE_STATUS_INFO );
			} else {
				self::set_message( sprintf( __( 'Pending Payment Received. Current Balance: %s', 'sprout-invoices' ), sa_get_formatted_money( $invoice->get_balance() ) ), self::MESSAGE_STATUS_INFO );
			}
		} else {
			if ( $invoice->get_balance() < 0.01 ) {
				self::set_message( __( 'Payment Received & Invoice Paid!', 'sprout-invoices' ), self::MESSAGE_STATUS_INFO );
			} else {
				self::set_message( sprintf( __( 'Partial Payment Received. Current Balance: %s', 'sprout-invoices' ), sa_get_formatted_money( $invoice->get_balance() ) ), self::MESSAGE_STATUS_INFO );
			}
		}

		wp_redirect( remove_query_arg( self::PAYMENT_SLUG ) );
		exit();
	}

	public static function complete_payment( $payment_id, $data ) {
		$payment = SI_Payment::get_instance( $payment_id );
		if ( ! is_a( $payment, 'SI_Payment' ) ) {
			return false;
		}

		if ( $payment->get_payment_method() !== self::PAYMENT_METHOD ) {
			return false;
		}

		// already updated
		if ( $payment->get_status() === SI_Payment::STATUS_COMPLETE ) {
			return true;
		}

		$payment->set_data( $data );

		do_action( 'payment_authorized', $payment );
		$payment->set_status( SI_Payment::STATUS_COMPLETE );
		do_action( 'payment_complete', $payment );
		return true;
	}

	public static function delete_payment( $payment_id ) {
		wp_delete_post( $payment_id, true );
		return true;
	}

	public static function get_basic_line_item_array( SI_Invoice $invoice ) {
		$payment_amount = ( si_has_invoice_deposit( $invoice->get_id() ) ) ? $invoice->get_deposit() : $invoice->get_balance();

		$session_line_items   = [];
		$session_line_items[] = [
			'name'        => sprintf( __( '%s Invoice Payment', 'sprout-invoices' ), get_bloginfo( 'name' ) ),
			'description' => html_entity_decode( strip_tags( $invoice->get_title() ), ENT_QUOTES, 'UTF-8' ),
			'amount'      => self::convert_money_to_cents( $payment_amount, $invoice ),
			'currency'    => self::get_currency_code( $invoice->get_id() ),
			'quantity'    => 1,
		];

		return $session_line_items;
	}

	public static function get_line_item_array( SI_Invoice $invoice, $return_total_tally = false ) {
		$invoice_id = $invoice->get_id();

		$session_line_items = [];
		$total_tally        = 0.00;

		// Handle Deposits
		$deposit_amount = $invoice->get_deposit();
		if ( 0.00 < $deposit_amount ) {
			$payment_amount = self::convert_money_to_cents( $invoice->get_deposit(), $invoice );

			if ( $return_total_tally ) {
				return $payment_amount;
			}

			$adjustmnet_amount    = $invoice->get_deposit() - $total_tally;
			$session_line_items[] = [
				'name'        => __( 'Deposit', 'sprout-invoices' ),
				'description' => html_entity_decode( strip_tags( $invoice->get_title() ), ENT_QUOTES, 'UTF-8' ),
				'amount'      => $payment_amount,
				'currency'    => self::get_currency_code( $invoice->get_id() ),
				'quantity'    => 1,
			];

			return $session_line_items;
		}

		$payments_total = $invoice->get_payments_total( false );
		if ( $payments_total > 0 ) {
			return false;
		}

		$discount = $invoice->get_discount_total();
		if ( $discount > 0.00 ) {
			return false;
		}

		$line_items = $invoice->get_line_items();
		foreach ( $line_items as $position => $data ) {
			$children            = si_line_item_get_children( $data['key'], $line_items );
			$is_parent_line_item = ( ! empty( $children ) ) ? true : false;
			if ( $is_parent_line_item ) {
				continue;
			}

			$item_type = ( isset( $data['type'] ) && '' !== $data['type'] ) ? $data['type'] : SI_Line_Items::get_default_type();

			if ( $data['total'] ) {
				$session_line_items[] = [
					'name'        => apply_filters( 'si_stripe_checkout_line_item_name', sprintf( __( '%2$s - %1$s', 'sprout-invoices' ), number_format( (float) $position, 1, '.', '' ), ucfirst( $item_type ) ), $data, $invoice ),
					'description' => html_entity_decode( strip_tags( $data['desc'] ), ENT_QUOTES, 'UTF-8' ),
					'amount'      => self::convert_money_to_cents( $data['rate'] * $data['qty'], $invoice ),
					'currency'    => self::get_currency_code( $invoice->get_id() ),
					'quantity'    => 1,
				];
				$total_tally         += si_get_number_format( $data['rate'] * $data['qty'] );
			}

			if ( floatval( $data['total'] ) !== floatval( $data['rate'] * $data['qty'] ) ) {
				$session_line_items[] = [
					'name'        => apply_filters( 'si_stripe_checkout_line_adjustment_item_name', sprintf( __( 'Adjustment: %2$s - %1$s', 'sprout-invoices' ), number_format( (float) $position, 1, '.', '' ), ucfirst( $item_type ) ), $data, $invoice_id ),
					'description' => html_entity_decode( strip_tags( $data['desc'] ), ENT_QUOTES, 'UTF-8' ),
					'amount'      => self::convert_money_to_cents( $data['total'] - $data['rate'] * $data['qty'], $invoice ),
					'currency'    => self::get_currency_code( $invoice->get_id() ),
					'quantity'    => 1,
				];
				$total_tally         += $data['total'] - $data['rate'] * $data['qty'];
			}
		}

		$fees = $invoice->get_fees_total();
		if ( $fees > 0.00 ) {
			$session_line_items[] = [
				'name'     => apply_filters( 'si_stripe_checkout_line_fees_adjustment_item_name', sprintf( __( 'Additional Invoice Fees', 'sprout-invoices' ), number_format( (float) $position, 1, '.', '' ), ucfirst( $item_type ) ), $data, $invoice_id ),
				'amount'   => self::convert_money_to_cents( $fees, $invoice ),
				'currency' => self::get_currency_code( $invoice->get_id() ),
				'quantity' => 1,
			];

			$total_tally += $fees;
		}

		if ( $return_total_tally ) {
			return $total_tally;
		}

		return $session_line_items;
	}

	// 
	// Webhooks //
	// 

	public static function webhook_listener() {
		if ( ! isset( $_REQUEST[ self::API_QUERY_VAR ] ) ) {
			return;
		}

		self::load_sdk();

		$payload = @file_get_contents( 'php://input' );
		$event   = null;

		try {
			$event = \Stripe\Event::constructFrom( json_decode( $payload, true ) );
		} catch ( \UnexpectedValueException $e ) {

			// Invalid payload
			http_response_code( 400 );
			exit();
		}

		// Handle the event
		switch ( $event->type ) {
			case 'checkout.session.completed':
				$session_object = $event->data->object;
				$payment_id     = $session_object->client_reference_id;

				self::maybe_create_recurring_payment( $payment_id, $session_object );

				$success = self::complete_payment( $payment_id, $session_object );

				if ( $success ) {
					http_response_code( 200 );
					exit();
				}

				break;

			default:
				// Unexpected event type
		}
		http_response_code( 400 );
		exit();
	}

	public static function get_webhook_url() {
		return add_query_arg( [ self::API_QUERY_VAR => 'callback' ], home_url() );
	}

	public static function maybe_create_hook_endpoint() {
		self::load_sdk();
		$endpoints = \Stripe\WebhookEndpoint::all( [ 'limit' => 100 ] );

		$out_webhooks_count = 0;
		if ( isset( $endpoints->data ) && ! empty( $endpoints->data ) ) {
			foreach ( $endpoints->data as $key => $endpoint ) {
				if ( self::get_webhook_url() == $endpoint->url ) {
					$out_webhooks_count++;

					if ( $out_webhooks_count > 1 ) {
						$endpoint = \Stripe\WebhookEndpoint::retrieve( $endpoint->id );
						$endpoint->delete();
					}
				}
			}
		}

		if ( $out_webhooks_count < 1 ) {
			$endpoint = \Stripe\WebhookEndpoint::create(
				[
					'url'            => self::get_webhook_url(),
					'enabled_events' => [ 'checkout.session.completed' ],
				]
			);
		}
	}

	// 
	// Recurring //
	// 

	/**
	 * Create the recurring payment profile.
	 */
	private static function create_recurring_payment_plan( SI_Invoice $invoice ) {
		self::load_sdk();

		try {
			$invoice_id = $invoice->get_id();
			$term       = SI_Subscription_Payments::get_term( $invoice_id ); // day, week, month, or year
			$duration   = (int) SI_Subscription_Payments::get_duration( $invoice_id );
			$price      = SI_Subscription_Payments::get_renew_price( $invoice_id );

			$plan_id = $invoice_id . self::convert_money_to_cents( sprintf( '%0.2f', $price ), $invoice );
			$name    = get_the_title( $invoice_id );

			$plan_args = [
				'product'  => [
					'name' => $name,
					'id'   => $invoice_id,
				],
				'nickname' => sprintf( __( 'Invoice: %s', 'sprout-invoices' ), $name ),
				'amount'   => self::convert_money_to_cents( sprintf( '%0.2f', $price ), $invoice ),
				'currency' => self::get_currency_code( $invoice_id ),
				'interval' => $term,
				'id'       => $plan_id,
			];
			// Recurring Plan the customer will be changed to.
			$plan = \Stripe\Plan::create( apply_filters( 'si_stripe_plan_args', $plan_args, $invoice ) );
			do_action( 'si_log', __CLASS__ . '::' . __FUNCTION__ . ' - Stripe PLAN Response', $plan );

			do_action( 'si_stripe_recurring_payment_plan_created', $plan );

			return $plan_id;
		} catch ( Exception $e ) {
			if ( 'resource_already_exists' === $e->jsonBody['error']['code'] ) {
				return $plan_id;
			}

			self::set_error_messages( $e->getMessage() );
			return false;
		}
	}

	public static function maybe_create_recurring_payment( $payment_id = 0, $data ) {
		$payment    = SI_Payment::get_instance( $payment_id );
		$invoice_id = $payment->get_invoice_id();
		$invoice    = SI_Invoice::get_instance( $invoice_id );
		$user       = si_who_is_paying( $invoice );

		if ( ! si_is_invoice_recurring( $invoice ) ) {
			return;
		}

		if ( ! isset( $data->subscription ) || '' == $data->subscription ) {
			return;
		}

		$subscribe = [
			'customer_id'     => $data->customer,
			'subscription_id' => $data->subscription,
			'amount'          => $data->display_items[0]->amount,
			'plan'            => $data->display_items[0]->plan->id,
			'email'           => $data->customer_email,
			'data'            => $data,
		];

		// Payment
		$payment_id = SI_Payment::new_payment(
			[
				'payment_method' => self::PAYMENT_METHOD,
				'invoice'        => $invoice_id,
				'amount'         => $data->display_items[0]->amount,
				'data'           => [
					'live'         => ( self::MODE_LIVE === self::$api_mode ),
					'api_response' => $subscribe,
				],
			],
			SI_Payment::STATUS_RECURRING 
		);

		do_action( 'si_stripe_recurring_payment_profile_created', $payment_id );
	}



	public function verify_recurring_payment( SI_Payment $payment ) {
		$invoice_id = $payment->get_invoice_id();
		if ( ! $invoice_id ) {
			return;
		}
		$invoice = SI_Invoice::get_instance( $invoice_id );

		$data = $payment->get_data();
		if ( ! isset( $data['api_response']['customer_id'] ) || ! isset( $data['api_response']['subscription_id'] ) ) {
			return false;
		}
		$status = self::get_subscription_status( $data['api_response']['customer_id'], $data['api_response']['subscription_id'] );

		do_action( 'si_verify_recurring_payment_status', $status, $payment );

		if ( 'active' != $status ) {
			$payment->set_status( SI_Payment::STATUS_CANCELLED );
		}

		return $status;
	}

	public static function get_subscription_status( $customer_id, $subscription_id ) {
		$status = false;
		try {
			self::load_sdk();
			$customer = \Stripe\Customer::retrieve( $customer_id );
			if ( isset( $customer->subscriptions ) ) {
				$subscription = $customer->subscriptions->retrieve( $subscription_id );
				$status       = $subscription->status;
			}
		} catch ( Exception $e ) {
			// do nothing
		}
		return $status;
	}

	public function cancel_recurring_payment( SI_Invoice $invoice ) {
		$payment = self::get_recurring_payment( $invoice );
		if ( ! $payment ) {
			return;
		}
		$data = $payment->get_data();
		if ( ! isset( $data['api_response']['subscription_id'] ) || ! isset( $data['api_response']['customer_id'] ) ) {
			return false;
		}
		try {
			self::load_sdk();
			$customer     = \Stripe\Customer::retrieve( $data['api_response']['customer_id'] );
			$subscription = $customer->subscriptions->retrieve( $data['api_response']['subscription_id'] );
			$subscription->cancel();
		} catch ( Exception $e ) {
			$status = false;
		}
		do_action( 'si_cancelled_recurring_payment', $subscription, $invoice );
	}

	public static function stripe_profile_link( $payment ) {
		if ( $payment->get_payment_method() !== self::PAYMENT_METHOD ) {
			return;
		}
		$data = $payment->get_data();

		if ( isset( $data['api_response']['subscription_id'] ) && isset( $data['api_response']['customer_id'] ) ) {
			$status = self::get_subscription_status( $data['api_response']['customer_id'], $data['api_response']['subscription_id'] );

			printf( __( '<b>Current Payment Status:</b> <code>%s</code>', 'sprout-invoices' ), $status );
			echo ' &mdash; ';
			_e( 'Stripe Subscription ID: ', 'sprout-invoices' );
			if ( isset( $data['live'] ) && ! $data['live'] ) {
				printf( '<a class="payment_profile_link" href="https://dashboard.stripe.com/test/customers/%s" target="_blank">%s</a>', $data['api_response']['customer_id'], $data['api_response']['subscription_id'] );
			} else {
				printf( '<a class="payment_profile_link" href="https://dashboard.stripe.com/customers/%s" target="_blank">%s</a>', $data['api_response']['customer_id'], $data['api_response']['subscription_id'] );
			}
		}
	}

	// 
	// Utility //
	// 


	private static function convert_money_to_cents( $value, $invoice ) {
		if ( ! apply_filters( 'si_convert_money_to_cents_for_stripe', true, $invoice ) ) {
			return (float) $value;
		}
		// strip out commas
		$value = preg_replace( '/\,/i', '', $value );
		// strip out all but numbers, dash, and dot
		$value = preg_replace( '/([^0-9\.\-])/i', '', $value );
		// make sure we are dealing with a proper number now, no +.4393 or 3...304 or 76.5895,94
		if ( ! is_numeric( $value ) ) {
			return 0.00;
		}
		// convert to a float explicitly
		$value = (float) $value;
		return round( $value, 2 ) * 100;
	}

	private static function convert_cents_to_money( $value, $invoice ) {
		if ( ! apply_filters( 'si_convert_money_to_cents_for_stripe', true, $invoice ) ) {
			return (float) $value;
		}
		// strip out commas
		$value = preg_replace( '/\,/i', '', $value );
		// strip out all but numbers, dash, and dot
		$value = preg_replace( '/([^0-9\.\-])/i', '', $value );
		// make sure we are dealing with a proper number now, no +.4393 or 3...304 or 76.5895,94
		if ( ! is_numeric( $value ) ) {
			return 0.00;
		}
		// convert to a float explicitly
		return number_format( floatval( $value / 100 ), 2 );
	}


	private static function get_currency_code( $invoice_id ) {
		return apply_filters( 'si_currency_code', self::$currency_code, $invoice_id, self::PAYMENT_METHOD );
	}

	/**
	 * Grabs error messages from a response and displays them to the user
	 *
	 * @param array $response
	 * @param bool  $display
	 * @return void
	 */
	private static function set_error_messages( $message, $display = true ) {
		if ( $display ) {
			self::set_message( $message, self::MESSAGE_STATUS_ERROR );
		} else {
			do_action( 'si_error', __CLASS__ . '::' . __FUNCTION__ . ' - error message from stripe', $message );
		}
	}

	public static function load_addon_view( $view, $args, $allow_theme_override = true ) {
		add_filter( 'si_views_path', [ __CLASS__, 'addons_view_path' ] );
		$view = self::load_view( $view, $args, $allow_theme_override );
		remove_filter( 'si_views_path', [ __CLASS__, 'addons_view_path' ] );
		return $view;
	}

	public static function load_addon_view_to_string( $view, $args, $allow_theme_override = true ) {
		ob_start();
		self::load_addon_view( $view, $args, $allow_theme_override );
		return ob_get_clean();
	}

	public static function addons_view_path() {
		return SA_ADDON_STRIPE_CHECKOUT_PATH . '/views/';
	}
}
SI_Stripe_Checkout::register();
