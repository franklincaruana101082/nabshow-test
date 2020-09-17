<?php
require get_stylesheet_directory() . '/vendor/autoload.php';


add_action( 'wp_ajax_nab_db_add_attendee', 'nab_db_add_attendee_callback' );
add_action( 'wp_ajax_nopriv_nab_db_add_attendee', 'nab_db_add_attendee_callback' );

function nab_db_add_attendee_callback() {
	global $wpdb;

	$response       = [];
	$err            = 0;
	$parent_user_id = get_current_user_id();
	$order_id       = filter_input( INPUT_POST, 'attendeeOrderID' );

	if ( ! isset( $_POST['nabNonce'] ) || false === wp_verify_nonce( $_POST['nabNonce'], 'nab-ajax-nonce' ) ) {
		$response['err']     = 1;
		$response['message'] = 'Authentication failed. Please reload the page and try again.';

		wp_send_json( $response, 200 );
		wp_die();
	}

	if ( ! isset( $order_id ) || empty( $order_id ) ) {
		$response['err']     = 1;
		$response['message'] = 'Something went wrong! Please try again!';
		wp_send_json( $response, 200 );

		wp_die();
	}

	// Get quantity for this order
	$order_qty = get_post_meta( $order_id, '_nab_bulk_qty', true );

	if ( ! isset( $order_qty ) || empty( $order_qty ) ) {
		$response['err']     = 1;
		$response['message'] = 'Something went wrong! Please try again!';
		wp_send_json( $response, 200 );

		wp_die();
	}

	// Check if this order has attendees or not
	$attendee_count = nab_get_attendee_count( $order_id );

	$new_attendee_count = $order_qty - $attendee_count;

	if ( $new_attendee_count > 0 ) {

		$file_mimes = array(
			'text/x-comma-separated-values',
			'text/comma-separated-values',
			'application/octet-stream',
			'application/vnd.ms-excel',
			'application/x-csv',
			'text/x-csv',
			'text/csv',
			'application/csv',
			'application/excel',
			'application/vnd.msexcel',
			'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
		);

		if ( isset( $_FILES['file']['name'] ) && in_array( $_FILES['file']['type'], $file_mimes ) ) {

			$input_file      = $_FILES['file']['tmp_name'];
			$input_file_name = $_FILES['file']['name'];

			$input_file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify( $input_file );

			$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader( $input_file_type );

			/**  Advise the Reader that we only want to load cell data  **/
			$reader->setReadDataOnly( true );

			$reader->setReadEmptyCells( false );

			$spreadsheet = $reader->load( $input_file );

			$sheet_data    = $spreadsheet->getActiveSheet()->toArray();
			$sheet_records = count( $sheet_data ) - 1;

			if ( $sheet_records < $new_attendee_count ) {
				$new_attendee_count = $sheet_records;
			}

			if ( ! empty( $sheet_data ) ) {

				for ( $i = 1; $i <= $new_attendee_count; $i ++ ) {
					$first_name = $sheet_data[ $i ][0];
					$last_name  = $sheet_data[ $i ][1];
					$email      = $sheet_data[ $i ][2];

					$insert_attendee_query = $wpdb->prepare( "INSERT INTO {$wpdb->prefix}nab_attendee
								(`parent_user_id`, `order_id`, `status`, `first_name`, `last_name`, `email`)
								VALUES
								(%d, %d, 0, %s, %s, %s)",
						$parent_user_id,
						$order_id,
						$first_name,
						$last_name,
						$email
					);

					$insert_attendee = $wpdb->query( $insert_attendee_query );

					if ( false !== $insert_attendee ) {
						$err = 0;
					} else {
						$err = 1;
					}
				}
			}

			if ( 0 === $err ) {
				$response['err']           = 0;
				$response['total_records'] = $new_attendee_count;
			} else {
				$response['err']     = 1;
				$response['message'] = 'There was an error while inserting book records!';
			}

		} else {
			$response['err']     = 1;
			$response['message'] = 'Please select a valid file!';
		}

	} else {
		$response['err']     = 1;
		$response['message'] = 'All attendees have already been registered.';
	}

	wp_send_json( $response, 200 );

	wp_die();
}

add_action( 'wp_ajax_insert_new_attendee', 'insert_new_attendee_callback' );
add_action( 'wp_ajax_nopriv_insert_new_attendee', 'insert_new_attendee_callback' );

function insert_new_attendee_callback() {
	global $wpdb;

	$res              = [];
	$order_id         = filter_input( INPUT_POST, 'attendeeOrderID' );
	$current_index    = filter_input( INPUT_POST, 'currentIndex' );
	$offset           = ( isset( $current_index ) ) ? 10 * $current_index : 0;
	$failed           = [];
	$skipped          = 0;
	$skipped_msg      = [];
	$added_attendee   = 0;
	$new_user_created = 0;

	// Get Attendees to add
	$get_attendees_query = $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}nab_attendee WHERE `status` = 0 AND `order_id` = %d ORDER BY `id` DESC LIMIT 10", $order_id );
	$attendee_data       = $wpdb->get_results( $get_attendees_query, ARRAY_A );

	if ( ! empty( $attendee_data ) ) {

		foreach ( $attendee_data as $attendee ) {
			$user               = [];
			$user['first_name'] = $attendee['first_name'];
			$user['last_name']  = $attendee['last_name'];
			$user['user_email'] = $attendee['email'];

			if ( empty( $user['user_email'] ) ) {
				$skipped       = 1;
				$skipped_msg[] = 'Attendees with missing email field found. Kindly try adding email and upload again.';

				continue;
			}

			// check if this user already exist in system or not
			if ( email_exists( $user['user_email'] ) ) {
				$existing_user   = email_exists( $user['user_email'] );
				$new_user_id     = $existing_user;
				$current_site_id = ( is_multisite() ) ? get_current_blog_id() : 1;
				if ( false === is_user_member_of_blog( $new_user_id, $current_site_id ) ) {
					$existing_user_obj  = get_userdata( $existing_user );
					$existing_user_role = ( isset( $existing_user_obj->roles ) && ! empty( $existing_user_obj->roles ) ) ? $existing_user_obj->roles[0] : 'customer';
					add_user_to_blog( $current_site_id, $existing_user, $existing_user_role );
				}
			} else {
				// Create new user
				$user['user_pass']  = wp_generate_password();
				$user['user_login'] = wc_create_new_customer_username( $user['user_email'], array(
					'first_name' => $user['first_name'],
					'last_name'  => $user['last_name'],
				) );
				$user['role']       = 'customer';
				$new_user           = wp_insert_user( $user );

				if ( is_wp_error( $new_user ) ) {
					$failed[]    = $user['user_email'] . ' - Error inserting new attendee.';
					$new_user_id = 0;

					// update status in DB
					$wpdb->query( $wpdb->prepare( "UPDATE {$wpdb->prefix}nab_attendee SET `status` = 2, `modified`= '%s' WHERE `id` = %d",
						date( 'Y-m-d H:i:s' ), $attendee['id'] ) );
				} else {
					$new_user_id      = $new_user;
					$new_user_created = 1;
				}
			}

			if ( ! empty( $new_user_id ) ) {

				// Get Original order details
				$order = wc_get_order( $order_id );

				// Create new order for this user
				$new_order = wc_create_order( array( 'customer_id' => $new_user_id ) );

				if ( ! is_wp_error( $new_order ) ) {
					$order_items = $order->get_items();

					// Set products to order
					foreach ( $order_items as $item ) {
						$new_order->add_product( wc_get_product( $item->get_product_id() ), 1, array(
							'subtotal' => 0,
							'total'    => 0,
						) );
					}

					$new_order_id = $new_order->get_order_number();
					update_post_meta( $new_order_id, '_nab_bulk_child', 'yes' );
					update_post_meta( $new_order_id, '_nab_bulk_parent_order', $order_id );

					$order_address               = $order->get_address();
					$order_address['first_name'] = $user['first_name'];
					$order_address['last_name']  = $user['last_name'];
					$order_address['email']      = $user['user_email'];

					// Set billing address to order
					$new_order->set_address( $order_address, 'billing' );
					$new_order->calculate_totals();
					$new_order->update_status( "completed" );

					update_user_meta( $new_user_id, 'billing_first_name', $user['first_name'] );
					update_user_meta( $new_user_id, 'billing_last_name', $user['first_name'] );

					// update status to 1 in DB
					$wpdb->query( $wpdb->prepare( "UPDATE {$wpdb->prefix}nab_attendee SET `status` = 1, `modified`= '%s', `wp_user_id` = %d WHERE `id` = %d",
						date( 'Y-m-d H:i:s' ), $new_user_id, $attendee['id'] ) );
					$added_attendee ++;

					if ( 1 === $new_user_created ) {
						do_action( 'nab_bulk_user_registration', $new_order_id, $new_user_id, $user['user_pass'] );
					}
				} else {
					$failed[] = $user['user_email'] . ' - Error creating order for new attendee.';
				}
			}
		}
	} else {
		$failed[] = 'Something went wrong! Please try again!';
	}

	if ( ! empty( $failed ) ) {
		$res['err'] = 1;
		$res['msg'] = $failed;
	} else {
		$res['err'] = 0;
	}
	$res['skipped']        = $skipped;
	$skipped_msg           = array_unique( $skipped_msg );
	$res['skipped_msg']    = $skipped_msg;
	$res['added_attendee'] = $added_attendee;

	if ( isset( $_POST['isLast'] ) && 'yes' === $_POST['isLast'] ) {
		$res['totalAddedAttendees'] = nab_get_attendee_count( $order_id );
	}

	wp_send_json( $res, 200 );
}

add_action( 'wp_ajax_get_order_attendees', 'get_order_attendees_callback' );
add_action( 'wp_ajax_nopriv_get_order_attendees', 'get_order_attendees_callback' );

function get_order_attendees_callback() {
	global $wpdb;

	if ( ! isset( $_GET['nabNonce'] ) || false === wp_verify_nonce( $_GET['nabNonce'], 'nab-ajax-nonce' ) ) {
		$res['err']     = 1;
		$res['message'] = 'Authentication failed. Please reload the page and try again.';

		wp_send_json( $res, 200 );
		wp_die();
	}

	$res      = [];
	$order_id = filter_input( INPUT_GET, 'orderId' );

	if ( ! isset( $order_id ) || empty( $order_id ) ) {
		$res['err']     = 1;
		$res['message'] = 'Something went wrong! Please try again';

		wp_send_json( $res, 200 );
		wp_die();
	}

	// Get Attendees
	$attendees_query = $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}nab_attendee WHERE `order_id` = %d AND `status` = 1 ", $order_id );
	$attendees       = $wpdb->get_results( $attendees_query, ARRAY_A );

	if ( ! empty( $attendees ) ) {
		$res['attendees'] = [];
		foreach ( $attendees as $attendee ) {
			$attendee_user               = [];
			$attendee_user['first_name'] = $attendee['first_name'];
			$attendee_user['last_name']  = $attendee['last_name'];
			$attendee_user['email']      = $attendee['email'];
			array_push( $res['attendees'], $attendee_user );
		}
	}

	$res['err'] = 0;

	wp_send_json( $res, 200 );
	wp_die();
}



add_action( 'wp_ajax_nab_custom_update_cart', 'nab_custom_update_cart_cb' );
add_action( 'wp_ajax_nopriv_nab_custom_update_cart', 'nab_custom_update_cart_cb' );

function nab_custom_update_cart_cb() {
	$qty = filter_input( INPUT_POST, 'qty');
	$temp = [];

	foreach ( WC()->cart->get_cart() as $cart_item_key => $values ) {
		
		$values['quantity'] = $qty;
		$values['nab_qty']  = $qty;
		$temp[ $cart_item_key ] = $values;

	}

	WC()->cart->set_cart_contents( $temp );
	
	 // Refresh the page
    echo do_shortcode( '[woocommerce_cart]' );
    die();
}