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
			$inserted_records = 0;

			/*if ( $sheet_records < $new_attendee_count ) {
				$new_attendee_count = $sheet_records;
			}*/

			if ( ! empty( $sheet_data ) ) {

				$attendee_emails = nab_get_order_attendees_email_list( $order_id );

				for ( $i = 1; $i <= $sheet_records; $i ++ ) {

					$first_name = trim( $sheet_data[ $i ][0] );
					$last_name  = trim( $sheet_data[ $i ][1] );
					$email      = sanitize_email( $sheet_data[ $i ][2] );

					if ( ! empty( $email ) && ! in_array( $email, $attendee_emails, true) && is_email( $email ) ) {

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

							$attendee_count++;

							$err 				= 0;
							$attendee_emails[] 	= $email;

							$inserted_records++;

						} else {
							$err = 1;
						}

						if ( $attendee_count >= $order_qty ) {
							break;
						}
					}
				}
			}

			if ( 0 === $err ) {
				$response['err']           = 0;
				$response['total_records'] = $inserted_records;
			} else {
				$response['err']     = 1;
				$response['message'] = 'There was an error while inserting records!';
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
					update_user_meta( $new_user_id, 'billing_last_name', $user['last_name'] );

					// update status to 1 in DB
					$wpdb->query( $wpdb->prepare( "UPDATE {$wpdb->prefix}nab_attendee SET `status` = 1, `modified`= '%s', `wp_user_id` = %d, `child_order_id` = %d WHERE `id` = %d",
						date( 'Y-m-d H:i:s' ), $new_user_id, $new_order_id, $attendee['id'] ) );
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

	$res      = [];
	if ( ! isset( $_GET['nabNonce'] ) || false === wp_verify_nonce( $_GET['nabNonce'], 'nab-ajax-nonce' ) ) {
		$res['err']     = 1;
		$res['message'] = 'Authentication failed. Please reload the page and try again.';

		wp_send_json( $res, 200 );
	}

	$order_id = filter_input( INPUT_GET, 'orderId' );

	if ( ! isset( $order_id ) || empty( $order_id ) ) {
		$res['err']     = 1;
		$res['message'] = 'Something went wrong! Please try again';

		wp_send_json( $res, 200 );
	}

	// Get Attendees
	$attendees_query = $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}nab_attendee WHERE `order_id` = %d AND `status` = 1 ", $order_id );
	$attendees       = $wpdb->get_results( $attendees_query, ARRAY_A );

	if ( ! empty( $attendees ) ) {
		$res['attendees'] = [];
		foreach ( $attendees as $attendee ) {
			$attendee_user               = [];
			$attendee_user['id']         = $attendee['id'];
			$attendee_user['first_name'] = $attendee['first_name'];
			$attendee_user['last_name']  = $attendee['last_name'];
			$attendee_user['email']      = $attendee['email'];
			$attendee_user['order_id']   = $attendee['child_order_id'];
			array_push( $res['attendees'], $attendee_user );
		}
	}

	$res[ 'is_attendee' ] = nab_is_all_attendee_added( $order_id );

	$res['err'] = 0;

	wp_send_json( $res, 200 );
}

add_action( 'wp_ajax_nab_custom_update_cart', 'nab_custom_update_cart_cb' );
add_action( 'wp_ajax_nopriv_nab_custom_update_cart', 'nab_custom_update_cart_cb' );

function nab_custom_update_cart_cb() {

	$res = [];
	if( isset( $_POST['is_bulk'] ) && 'yes' === filter_input( INPUT_POST, 'is_bulk') ) {
		if( isset( $_POST['qty'] ) && ! empty( $_POST['qty'] ) ) {
			$qty = filter_input( INPUT_POST, 'qty');
			$is_bulk = 'yes';
		} else {
			$qty = 1;
			$is_bulk = 'no';
		}
	} else {
		$is_bulk = 'no';
		$qty = 1;
	}

	if ( ! WC()->cart->is_empty() ) {
		$temp = [];

		foreach ( WC()->cart->get_cart() as $cart_item_key => $values ) {
			$values['quantity'] = $qty;
			$values['nab_qty']  = $qty;
			$values['nab_bulk_order'] = $is_bulk;
			$temp[ $cart_item_key ] = $values;

			// update cocart
			nab_update_cocart_item( $cart_item_key, $qty );
		}

		WC()->cart->set_cart_contents( $temp );

		wc_add_notice( __( 'Cart updated.', 'woocommerce' ), apply_filters( 'woocommerce_cart_updated_notice_type', 'success' ) );

		ob_start();
		echo do_shortcode( '[woocommerce_cart]' );

		$res['cart_content'] = ob_get_clean();
		$res['err'] = 0;
	} else {
		$res['err'] = 1;
	}

	wp_send_json( $res, 200 );

}

add_action( 'wp_ajax_remove_attendee', 'nab_remove_attendee' );
add_action( 'wp_ajax_nopriv_remove_attendee', 'nab_remove_attendee' );

function nab_remove_attendee() {
	global $wpdb;

	$res      = [];
	if ( ! isset( $_POST['nabNonce'] ) || false === wp_verify_nonce( $_POST['nabNonce'], 'nab-ajax-nonce' ) ) {
		$res['err']     = 1;
		$res['message'] = 'Authentication failed. Please reload the page and try again.';

		wp_send_json( $res, 200 );
	}

	$primary_id 		= filter_input( INPUT_POST, 'pID' );
	$order_id   		= filter_input( INPUT_POST, 'oID' );
	$parent_order_id 	= filter_input( INPUT_POST, 'parentOrderId', FILTER_SANITIZE_NUMBER_INT );

	if ( ! isset( $primary_id ) || empty( $primary_id ) || ! isset( $order_id ) || empty( $order_id ) ) {
		$res['err']     = 1;
		$res['message'] = 'Something went wrong! Please try again';

		wp_send_json( $res, 200 );
	}

	//update purchased product user meta
	nab_update_product_in_user_meta( $order_id, 'completed', 'draft' );

	// Delete this order
	$remove_attendee = wp_delete_post( $order_id, true );

	if( ! empty( $remove_attendee ) ) {
		// Remove from attendee table as well
		$wpdb->delete( $wpdb->prefix . 'nab_attendee', array( 'id' => $primary_id ) );
		$res['err']     = 0;
		$res['message'] = 'Attendee removed successfully.';

		$res[ 'is_attendee' ] = nab_is_all_attendee_added( $parent_order_id );
	} else {
		$res['err']     = 1;
		$res['message'] = 'Attendee could not be deleted. Please reload the page and try again.';
	}

	wp_send_json( $res, 200 );

}

add_action( 'wp_ajax_get_edit_attendee', 'nab_get_edit_attendee_ajax_callback' );
add_action( 'wp_ajax_nopriv_get_edit_attendee', 'nab_get_edit_attendee_ajax_callback' );

function nab_get_edit_attendee_ajax_callback() {

	$response = array();

	$nab_nonce 	= filter_input( INPUT_POST, 'nabNonce', FILTER_SANITIZE_STRING );
	$primary_id	= filter_input( INPUT_POST, 'pID', FILTER_SANITIZE_NUMBER_INT );

	//verify nonce
	if ( ! isset( $nab_nonce ) || false === wp_verify_nonce( $nab_nonce, 'nab-ajax-nonce' ) ) {

		$response[ 'err' ]     	= 1;
		$response[ 'message' ]	= 'Authentication failed. Please reload the page and try again.';

		wp_send_json( $response, 200 );
	}

	//Check primary id is empty
	if ( ! isset( $primary_id ) || empty( $primary_id ) ) {

		$response[ 'err' ]     	= 1;
		$response[ 'message' ]	= 'Something went wrong! Please try again';

		wp_send_json( $response, 200 );
	}

	// Get attendee details
	$attendee_details = nab_get_order_attendee_details( $primary_id );

	// Return attendee details if details found otherwise return error.
	if ( is_array( $attendee_details ) && count( $attendee_details ) > 0 ) {

		$response[ 'err' ]			= 0;
		$response[ 'first_name' ]	= $attendee_details[ 'first_name' ];
		$response[ 'last_name' ]	= $attendee_details[ 'last_name' ];
		$response[ 'email' ]		= $attendee_details[ 'email' ];
		$response[ 'uid' ]			= $attendee_details[ 'wp_user_id' ];

	} else {

		$response[ 'err' ]     	= 1;
		$response[ 'message' ]	= 'Something went wrong! Please try again';
	}

	wp_send_json( $response, 200 );

	wp_die();
}

add_action( 'wp_ajax_update_attendee_details', 'nab_update_attendee_details_ajax_callback' );
add_action( 'wp_ajax_nopriv_update_attendee_details', 'nab_update_attendee_details_ajax_callback' );

function nab_update_attendee_details_ajax_callback() {

	global $wpdb;

	$response = array();

	$nab_nonce 	= filter_input( INPUT_POST, 'nabNonce', FILTER_SANITIZE_STRING );
	$primary_id	= filter_input( INPUT_POST, 'pID', FILTER_SANITIZE_NUMBER_INT );
	$user_id	= filter_input( INPUT_POST, 'uID', FILTER_SANITIZE_NUMBER_INT );
	$first_name	= filter_input( INPUT_POST, 'fname', FILTER_SANITIZE_STRING );
	$last_name	= filter_input( INPUT_POST, 'lname', FILTER_SANITIZE_STRING );

	//verify nonce
	if ( ! isset( $nab_nonce ) || false === wp_verify_nonce( $nab_nonce, 'nab-ajax-nonce' ) ) {

		$response[ 'err' ]     	= 1;
		$response[ 'message' ]	= 'Authentication failed. Please reload the page and try again.';

		wp_send_json( $response, 200 );
	}

	// check input values are empty.
	if ( ( ! isset( $primary_id ) || empty( $primary_id ) ) || ( ! isset( $user_id ) || empty( $user_id ) ) || ( ! isset( $first_name ) || empty( $first_name ) ) || ( ! isset( $last_name ) || empty( $last_name ) ) ) {

		$response[ 'err' ]     	= 1;
		$response[ 'message' ]	= 'Something went wrong! Please try again';

		wp_send_json( $response, 200 );
	}

	// Update custom table record
	$wpdb->query( $wpdb->prepare( "UPDATE {$wpdb->prefix}nab_attendee SET `first_name`= '%s', `last_name` = %s WHERE `id` = %d", $first_name, $last_name, $primary_id ) );

	// Update WC billing user meta
	update_user_meta( $user_id, 'billing_first_name', $first_name );
	update_user_meta( $user_id, 'billing_last_name', $last_name );

	// Update WP user
	wp_update_user([
		'ID' => $user_id,
		'first_name' => $first_name,
		'last_name' => $last_name,
	]);

	$response[ 'err' ]     	= 0;
	$response[ 'message' ]	= 'Attendee details update successfully.';

	wp_send_json( $response, 200 );

	wp_die();
}

add_action( 'wp_ajax_change_attendee_order_details', 'nab_change_attendee_order_details_ajax_callback' );
add_action( 'wp_ajax_nopriv_change_attendee_order_details', 'nab_change_attendee_order_details_ajax_callback' );

function nab_change_attendee_order_details_ajax_callback() {

	global $wpdb;

	$response = array();

	$nab_nonce 	= filter_input( INPUT_POST, 'nabNonce', FILTER_SANITIZE_STRING );
	$primary_id	= filter_input( INPUT_POST, 'pID', FILTER_SANITIZE_NUMBER_INT );
	$order_id	= filter_input( INPUT_POST, 'oID', FILTER_SANITIZE_NUMBER_INT );
	$first_name	= filter_input( INPUT_POST, 'fname', FILTER_SANITIZE_STRING );
	$last_name	= filter_input( INPUT_POST, 'lname', FILTER_SANITIZE_STRING );
	$email		= filter_input( INPUT_POST, 'email', FILTER_SANITIZE_STRING );

	//verify nonce
	if ( ! isset( $nab_nonce ) || false === wp_verify_nonce( $nab_nonce, 'nab-ajax-nonce' ) ) {

		$response[ 'err' ]     	= 1;
		$response[ 'message' ]	= 'Authentication failed. Please reload the page and try again.';

		wp_send_json( $response, 200 );
	}

	// check input values are empty.
	if ( ( ! isset( $email ) || empty( $email ) ) || ( ! isset( $primary_id ) || empty( $primary_id ) ) || ( ! isset( $order_id ) || empty( $order_id ) ) || ( ! isset( $first_name ) || empty( $first_name ) ) || ( ! isset( $last_name ) || empty( $last_name ) ) ) {

		$response[ 'err' ]     	= 1;
		$response[ 'message' ]	= 'Something went wrong! Please try again';

		wp_send_json( $response, 200 );
	}

	// Get attendee details
	$attendee_details = nab_get_order_attendee_details( $primary_id );

	// Check email already exist or not
	if ( nab_is_order_attendee_exist( $email, $attendee_details[ 'order_id' ] ) ) {

		$response[ 'err' ]     = 1;
		$response[ 'message' ] = 'Attendee not updated. Email address already exist.';

		wp_send_json( $response, 200 );

		wp_die();
	}

	//update purchased product user meta
	nab_update_product_in_user_meta( $order_id, 'completed', 'draft' );

	// Delete this order
	$remove_attendee = wp_delete_post( $order_id, true );

	if ( ! empty( $remove_attendee ) ) {

		// Remove from attendee table as well
		$wpdb->delete( $wpdb->prefix . 'nab_attendee', array( 'id' => $primary_id ) );

		$parent_user_id 	= $attendee_details[ 'parent_user_id' ];
		$parent_order_id	= $attendee_details[ 'order_id' ];
		$user 				= array( 'user_email' => $email, 'first_name' => $first_name, 'last_name' => $last_name );

		// check if this user already exist in system or not
		if ( email_exists( $email ) ) {

			$existing_user   = email_exists( $email );
			$new_user_id     = $existing_user;
			$current_site_id = ( is_multisite() ) ? get_current_blog_id() : 1;

			if ( false === is_user_member_of_blog( $new_user_id, $current_site_id ) ) {

				$existing_user_obj  = get_userdata( $existing_user );
				$existing_user_role = ( isset( $existing_user_obj->roles ) && ! empty( $existing_user_obj->roles ) ) ? $existing_user_obj->roles[0] : 'customer';

				add_user_to_blog( $current_site_id, $existing_user, $existing_user_role );
			}

		} else {

			// Create new user
			$user[ 'user_pass' ]	= wp_generate_password();
			$user[ 'user_login' ]	= wc_create_new_customer_username( $user[ 'user_email' ], array(
						'first_name' => $user[ 'first_name' ],
						'last_name'  => $user[ 'last_name' ],
					)
				);


			$user[ 'role' ]	= 'customer';
			$new_user		= wp_insert_user( $user );

			if ( is_wp_error( $new_user ) ) {

				$response[ 'err' ]		= 1;
				$response[ 'message' ] 	= $user[ 'user_email' ] . ' - Error inserting new attendee.';
				$new_user_id 			= 0;

			} else {
				$new_user_id      = $new_user;
				$new_user_created = 1;
			}
		}

		if ( ! empty( $new_user_id ) && 0 !== $new_user_id ) {

			// Get Original order details
			$order = wc_get_order( $parent_order_id );

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

				// set order meta
				update_post_meta( $new_order_id, '_nab_bulk_child', 'yes' );
				update_post_meta( $new_order_id, '_nab_bulk_parent_order', $parent_order_id );

				$order_address               	= $order->get_address();
				$order_address[ 'first_name' ] 	= $first_name;
				$order_address[ 'last_name' ]  	= $last_name;
				$order_address[ 'email' ]      	= $email;

				// Set billing address to order
				$new_order->set_address( $order_address, 'billing' );
				$new_order->calculate_totals();
				$new_order->update_status( "completed" );

				// Update WC billing details
				update_user_meta( $new_user_id, 'billing_first_name', $first_name );
				update_user_meta( $new_user_id, 'billing_last_name', $last_name );

				// Insert user details in the custom attendee table
				$insert_attendee_query = $wpdb->prepare( "INSERT INTO {$wpdb->prefix}nab_attendee
										(`parent_user_id`, `order_id`, `status`, `first_name`, `last_name`, `email`, `wp_user_id`, `child_order_id`)
										VALUES
										(%d, %d, 1, %s, %s, %s, %d, %d)",
								$parent_user_id,
								$parent_order_id,
								$first_name,
								$last_name,
								$email,
								$new_user_id,
								$new_order_id
							);
				$insert_attendee = $wpdb->query( $insert_attendee_query );


				if ( false !== $insert_attendee ) {

					$response[ 'err' ]     		= 0;
					$response[ 'message' ] 		= 'Attendee updated successfully.';
					$response[ 'oid' ]			= $new_order_id;
					$response[ 'pid' ]			= nab_get_attendee_primary_id_by_order_id( $new_order_id );
					$response[ 'is_attendee' ]	= nab_is_all_attendee_added( $parent_order_id );

				} else {

					$response[ 'err' ]     = 1;
					$response[ 'message' ] = 'Attendee can not added to the custom table. Please reload the page and try again.';
				}

				// Sent an email if new user created
				if ( 1 === $new_user_created ) {
					do_action( 'nab_bulk_user_registration', $new_order_id, $new_user_id, $user[ 'user_pass' ] );
				}

			} else {

				$response[ 'err' ]     = 1;
				$response[ 'message' ] = $user['user_email'] . ' - Error creating order for new attendee.';
			}
		} else {

			$response[ 'err' ]     = 1;
			$response[ 'message' ] = 'Attendee deleted but can\'t create new attendee' . $user[ 'user_email' ];
		}

	} else {

		$response[ 'err' ]     = 1;
		$response[ 'message' ] = 'Existing attendee can not deleted. Please reload the page and try again.';
	}

	wp_send_json( $response, 200 );

	wp_die();
}

add_action( 'wp_ajax_add_attendee_order_details', 'nab_add_attendee_order_details_ajax_callback' );
add_action( 'wp_ajax_nopriv_add_attendee_order_details', 'nab_add_attendee_order_details_ajax_callback' );

function nab_add_attendee_order_details_ajax_callback() {

	global $wpdb;

	$response = array();

	$nab_nonce 	= filter_input( INPUT_POST, 'nabNonce', FILTER_SANITIZE_STRING );
	$order_id	= filter_input( INPUT_POST, 'orderId', FILTER_SANITIZE_NUMBER_INT );
	$first_name	= filter_input( INPUT_POST, 'fname', FILTER_SANITIZE_STRING );
	$last_name	= filter_input( INPUT_POST, 'lname', FILTER_SANITIZE_STRING );
	$email		= filter_input( INPUT_POST, 'email', FILTER_SANITIZE_STRING );

	//verify nonce
	if ( ! isset( $nab_nonce ) || false === wp_verify_nonce( $nab_nonce, 'nab-ajax-nonce' ) ) {

		$response[ 'err' ]     	= 1;
		$response[ 'message' ]	= 'Authentication failed. Please reload the page and try again.';

		wp_send_json( $response, 200 );

		wp_die();
	}

	// check input values are empty.
	if ( ( ! isset( $email ) || empty( $email ) ) || ( ! isset( $order_id ) || empty( $order_id ) ) || ( ! isset( $first_name ) || empty( $first_name ) ) || ( ! isset( $last_name ) || empty( $last_name ) ) ) {

		$response[ 'err' ]     	= 1;
		$response[ 'message' ]	= 'Something went wrong! Please try again';

		wp_send_json( $response, 200 );

		wp_die();
	}

	// Get quantity for this order
	$order_qty = get_post_meta( $order_id, '_nab_bulk_qty', true );

	if ( ! isset( $order_qty ) || empty( $order_qty ) ) {

		$response[ 'err' ]     = 1;
		$response[ 'message' ] = 'Something went wrong! Please try again!';

		wp_send_json( $response, 200 );

		wp_die();
	}

	if ( nab_is_order_attendee_exist( $email, $order_id ) ) {

		$response[ 'err' ]     = 1;
		$response[ 'message' ] = 'Attendee email address already exist.';

		wp_send_json( $response, 200 );

		wp_die();
	}

	// Check if this order has attendees or not
	$attendee_count = nab_get_attendee_count( $order_id );

	$new_attendee_count = $order_qty - $attendee_count;

	if ( $new_attendee_count > 0 ) {

		$parent_user_id = 1;

		// Get parent user id
		$attendees_query = $wpdb->prepare( "SELECT `parent_user_id` FROM {$wpdb->prefix}nab_attendee WHERE `order_id` = %d LIMIT 1", $order_id );
		$attendees       = $wpdb->get_results( $attendees_query, ARRAY_A );

		// Set attendee primary id from the DB result if not empty array
		if ( is_array( $attendees ) && count( $attendees ) > 0 ) {

			$parent_user_id = $attendees[0]['parent_user_id'];
		}

		$parent_order_id	= $order_id;
		$user 				= array( 'user_email' => $email, 'first_name' => $first_name, 'last_name' => $last_name );

		// check if this user already exist in system or not
		if ( email_exists( $email ) ) {

			$existing_user   = email_exists( $email );
			$new_user_id     = $existing_user;
			$current_site_id = ( is_multisite() ) ? get_current_blog_id() : 1;

			if ( false === is_user_member_of_blog( $new_user_id, $current_site_id ) ) {

				$existing_user_obj  = get_userdata( $existing_user );
				$existing_user_role = ( isset( $existing_user_obj->roles ) && ! empty( $existing_user_obj->roles ) ) ? $existing_user_obj->roles[0] : 'customer';

				add_user_to_blog( $current_site_id, $existing_user, $existing_user_role );
			}

		} else {

			// Create new user
			$user[ 'user_pass' ]	= wp_generate_password();
			$user[ 'user_login' ]	= wc_create_new_customer_username( $user[ 'user_email' ], array(
						'first_name' => $user[ 'first_name' ],
						'last_name'  => $user[ 'last_name' ],
					)
				);

			$user[ 'role' ]	= 'customer';
			$new_user		= wp_insert_user( $user );

			if ( is_wp_error( $new_user ) ) {

				$response[ 'err' ]		= 1;
				$response[ 'message' ] 	= $user[ 'user_email' ] . ' - Error inserting new attendee.';
				$new_user_id 			= 0;

			} else {
				$new_user_id      = $new_user;
				$new_user_created = 1;
			}
		}

		if ( ! empty( $new_user_id ) && 0 !== $new_user_id ) {

			// Get Original order details
			$order = wc_get_order( $parent_order_id );

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

				// set order meta
				update_post_meta( $new_order_id, '_nab_bulk_child', 'yes' );
				update_post_meta( $new_order_id, '_nab_bulk_parent_order', $parent_order_id );

				$order_address               	= $order->get_address();
				$order_address[ 'first_name' ] 	= $first_name;
				$order_address[ 'last_name' ]  	= $last_name;
				$order_address[ 'email' ]      	= $email;

				// Set billing address to order
				$new_order->set_address( $order_address, 'billing' );
				$new_order->calculate_totals();
				$new_order->update_status( "completed" );

				// Update WC billing details
				update_user_meta( $new_user_id, 'billing_first_name', $first_name );
				update_user_meta( $new_user_id, 'billing_last_name', $last_name );

				// Insert user details in the custom attendee table
				$insert_attendee_query = $wpdb->prepare( "INSERT INTO {$wpdb->prefix}nab_attendee
										(`parent_user_id`, `order_id`, `status`, `first_name`, `last_name`, `email`, `wp_user_id`, `child_order_id`)
										VALUES
										(%d, %d, 1, %s, %s, %s, %d, %d)",
								$parent_user_id,
								$parent_order_id,
								$first_name,
								$last_name,
								$email,
								$new_user_id,
								$new_order_id
							);
				$insert_attendee = $wpdb->query( $insert_attendee_query );


				if ( false !== $insert_attendee ) {

					$response[ 'err' ]     		= 0;
					$response[ 'message' ] 		= 'Attendee added successfully.';
					$response[ 'oid' ]			= $new_order_id;
					$response[ 'pid' ]			= nab_get_attendee_primary_id_by_order_id( $new_order_id );
					$response[ 'is_attendee' ]	= ( $attendee_count + 1 ) >= $order_qty ? true : false;

				} else {

					$response[ 'err' ]     = 1;
					$response[ 'message' ] = 'Attendee can not added to the custom table. Please reload the page and try again.';
				}

				// Sent an email if new user created
				if ( 1 === $new_user_created ) {
					do_action( 'nab_bulk_user_registration', $new_order_id, $new_user_id, $user[ 'user_pass' ] );
				}

			} else {

				$response[ 'err' ]     = 1;
				$response[ 'message' ] = $user['user_email'] . ' - Error creating order for new attendee.';
			}
		} else {

			$response[ 'err' ]     = 1;
			$response[ 'message' ] = 'Error during add new attendee - ' . $user[ 'user_email' ];
		}

	} else {

		$response[ 'err' ]     = 1;
		$response[ 'message' ] = 'All attendees have already been registered.';
	}

	wp_send_json( $response, 200 );

	wp_die();
}

add_action( 'wp_ajax_nab_member_search_filter', 'nab_member_search_filter_callback' );
add_action( 'wp_ajax_nopriv_nab_member_search_filter', 'nab_member_search_filter_callback' );

function nab_member_search_filter_callback() {

	check_ajax_referer( 'nab-ajax-nonce', 'nabNonce' );

	$final_result 	= array();
	$result_user	= array();

	$page_number	= filter_input( INPUT_POST, 'page_number', FILTER_SANITIZE_NUMBER_INT );
	$post_limit		= filter_input( INPUT_POST, 'post_limit', FILTER_SANITIZE_NUMBER_INT );
	$connected		= filter_input( INPUT_POST, 'connected', FILTER_SANITIZE_STRING );
	$search_term	= filter_input( INPUT_POST, 'search_term', FILTER_SANITIZE_STRING );
	$company		= filter_input( INPUT_POST, 'company', FILTER_SANITIZE_STRING );
	$orderby		= filter_input( INPUT_POST, 'orderby', FILTER_SANITIZE_STRING );

	$user_logged_in = false;
	$logged_user_id	= 0;

	if ( is_user_logged_in() ) {

		$user_logged_in = true;
		$logged_user_id = get_current_user_id();
	}

	$members_filter = array(
		'page' 		=> $page_number,
		'per_page' 	=> $post_limit,
		'type'		=> $orderby,
	);

	if ( ! empty( $search_term ) ) {
		$members_filter[ 'search_terms' ] = $search_term;
	}

	if ( ! empty( $company ) ) {

		$members_filter[ 'meta_key' ] 	= 'attendee_company';
		$members_filter[ 'meta_value' ] = $company;
	}

	if ( ! empty( $connected ) && 'yes' === $connected ) {

		$members_filter[ 'user_id' ] = $logged_user_id;

	} else if ( ! empty( $connected ) && 'no' === $connected ) {

		$friend_list_ids = friends_get_friend_user_ids( $logged_user_id );

		if ( is_array( $friend_list_ids ) && count( $friend_list_ids ) > 0 ) {
			$members_filter[ 'exclude' ]	=	$friend_list_ids;
		}

	}

	$total_users 	= 0;
	$total_pages	= 0;

	if ( bp_has_members( $members_filter ) ) {

		global $members_template;

		$total_users	= $members_template->total_member_count;
		$total_pages	= ceil( $total_users / $post_limit );
		$cnt 			= 0;

		$current_user_id = get_current_user_id();

		while ( bp_members() ) {

			bp_the_member();

			$member_user_id	= bp_get_member_user_id();
			$is_friend		= friends_check_friendship_status( $current_user_id, $member_user_id );
			$user_full_name = get_the_author_meta( 'first_name', $member_user_id ) . ' ' . get_the_author_meta( 'last_name', $member_user_id );

			if ( empty( trim( $user_full_name ) ) ) {

				$user_full_name = bp_get_member_name();
			}

			$company 		= get_user_meta( $member_user_id, 'attendee_company', true );
			$title 		= get_user_meta( $member_user_id, 'attendee_title', true );
			$user_images 	= nab_amplify_get_user_images( $member_user_id );

			$user_avatar = '<img src="' . $user_images[ 'profile_picture' ] . '" />';

			$result_user[ $cnt ][ 'cover_img' ] = $user_images[ 'banner_image' ];
			$result_user[ $cnt ][ 'name' ] 		= html_entity_decode( $user_full_name );
			$result_user[ $cnt ][ 'company' ] 	= html_entity_decode( $company );
			$result_user[ $cnt ][ 'title' ] 	= html_entity_decode( $title );
			$result_user[ $cnt ][ 'avatar']		= $user_avatar;
			$result_user[ $cnt ][ 'link']		= bp_get_member_permalink();

			$action_button = nab_amplify_bp_get_friendship_button( $member_user_id );
			$result_user[ $cnt ][ 'action_button' ] = $action_button;

			if ( $is_friend && 'is_friend' === $is_friend ) {
				$cancel_friendship_button = nab_amplify_bp_get_cancel_friendship_button( $member_user_id );
				$result_user[ $cnt ][ 'cancel_friendship_button' ] = $cancel_friendship_button;
			}

			if ( 0 === $page_number % 2 && ( 4 === $cnt + 1 || 12 === $cnt + 1 ) ) {

				$result_user[ $cnt ][ 'banner' ] = nab_get_search_result_ad();

			} else if ( 0 !== $page_number % 2 && 8 === $cnt + 1 ) {

				$result_user[ $cnt ][ 'banner' ] = nab_get_search_result_ad();
			}

			$cnt++;
		}
	}

	$final_result[ 'next_page_number' ] = $page_number + 1;
	$final_result[ 'total_page' ]       = $total_pages;
	$final_result[ 'total_user' ]		= $total_users;
	$final_result[ 'result_user' ]      = $result_user;

	echo wp_json_encode( $final_result );

	wp_die();
}

add_action( 'wp_ajax_nab_product_search_filter', 'nab_product_search_filter_callback' );
add_action( 'wp_ajax_nopriv_nab_product_search_filter', 'nab_product_search_filter_callback' );

function nab_product_search_filter_callback() {

	check_ajax_referer( 'nab-ajax-nonce', 'nabNonce' );

	$final_result 	= array();
	$result_post	= array();

	$page_number	= filter_input( INPUT_POST, 'page_number', FILTER_SANITIZE_NUMBER_INT );
	$post_limit		= filter_input( INPUT_POST, 'post_limit', FILTER_SANITIZE_NUMBER_INT );
	$search_term	= filter_input( INPUT_POST, 'search_term', FILTER_SANITIZE_STRING );
	$category		= filter_input( INPUT_POST, 'category', FILTER_SANITIZE_STRING );
	$orderby		= filter_input( INPUT_POST, 'orderby', FILTER_SANITIZE_STRING );
	$order			= 'title' === $orderby ? 'ASC' : 'DESC';

	$product_args = array(
		'post_type' 		=> 'product',
		'paged'				=> $page_number,
		'post_status'		=> 'publish',
		'posts_per_page' 	=> $post_limit,
		's'					=> $search_term,
	);

	if ( 'popularity' === $orderby ) {

		$product_args[ 'meta_key' ] = 'total_sales';
		$product_args[ 'orderby' ] 	= 'meta_value_num';
		$product_args[ 'order' ]	= $order;

	} else if ( 'relevance' === $orderby ) {

		$product_args[ 'custom_order' ] = 'relevance';

	} else {

		$product_args[ 'orderby' ] 	= $orderby;
		$product_args[ 'order' ]	= $order;
	}

	if ( ! empty( $category ) ) {

		$product_args[ 'tax_query' ] = array(
				array(
					'taxonomy' => 'product_cat',
					'field'    => 'slug',
					'terms'    => $category,
				)
			);
	}

	$product_query = new WP_Query( $product_args );

	$total_pages 	= $product_query->max_num_pages;
	$total_products = $product_query->found_posts;

	if ( $product_query->have_posts() ) {

		$cnt 				= 0;
		$current_user_id 	= is_user_logged_in() ? get_current_user_id() : '';
		$bookmark_products	= ! empty( $current_user_id ) ? get_user_meta( $current_user_id, 'nab_customer_product_bookmark', true ) : '';

		while ( $product_query->have_posts() ) {

			$product_query->the_post();

			$thumbnail_url 	= has_post_thumbnail() ? get_the_post_thumbnail_url() : nab_placeholder_img();

			$result_post[ $cnt ][ 'thumbnail' ] = $thumbnail_url;
			$result_post[ $cnt ][ 'link' ] 		= get_the_permalink();
			$result_post[ $cnt ][ 'title' ] 	= html_entity_decode( get_the_title() );

			// bookmark product
			if ( ! empty( $current_user_id ) ) {

				$product_id			= get_the_ID();
				$bookmark_class    	= 'fa fa-bookmark-o amp-bookmark user-bookmark-action';
				$bookmark_tooltip  	= 'Add to Bookmarks';

				if ( ! empty( $bookmark_products ) && is_array( $bookmark_products ) && in_array( (string) $product_id, $bookmark_products, true ) ) {

					$bookmark_class     .= ' bookmark-fill';
					$bookmark_tooltip	= 'Remove from Bookmarks';
				}

				$result_post[ $cnt ][ 'bookmark_class' ] 	= $bookmark_class;
				$result_post[ $cnt ][ 'bookmark_tooltip' ] 	= $bookmark_tooltip;
				$result_post[ $cnt ][ 'bookmark_id' ]		= $product_id;
			}

			if ( 0 === $page_number % 2 && ( 4 === $cnt + 1 || 12 === $cnt + 1 ) ) {

				$result_post[ $cnt ][ 'banner' ] = nab_get_search_result_ad();

			} else if ( 8 === $cnt + 1 ) {

				$result_post[ $cnt ][ 'banner' ] = nab_get_search_result_ad();
			}

			$cnt++;
		}

	}
	wp_reset_postdata();

	$final_result[ 'next_page_number' ] = $page_number + 1;
	$final_result[ 'total_page' ]       = $total_pages;
	$final_result[ 'total_product' ]	= $total_products;
	$final_result[ 'result_post' ]      = $result_post;

	echo wp_json_encode( $final_result );

	wp_die();
}

add_action( 'wp_ajax_nab_content_search_filter', 'nab_content_search_filter_callback' );
add_action( 'wp_ajax_nopriv_nab_content_search_filter', 'nab_content_search_filter_callback' );

function nab_content_search_filter_callback() {

	check_ajax_referer( 'nab-ajax-nonce', 'nabNonce' );

	$final_result 	= array();
	$result_post	= array();

	$page_number	= filter_input( INPUT_POST, 'page_number', FILTER_SANITIZE_NUMBER_INT );
	$post_limit		= filter_input( INPUT_POST, 'post_limit', FILTER_SANITIZE_NUMBER_INT );
	$search_term	= filter_input( INPUT_POST, 'search_term', FILTER_SANITIZE_STRING );
	$orderby		= filter_input( INPUT_POST, 'orderby', FILTER_SANITIZE_STRING );
	$order			= 'title' === $orderby ? 'ASC' : 'DESC';

	$all_post_types = nab_get_search_post_types();

	$content_args = array(
		'post_type' 		=> $all_post_types,
		'paged'				=> $page_number,
		'post_status'		=> 'publish',
		'posts_per_page' 	=> $post_limit,
		's'					=> $search_term,
	);

	if ( 'relevance' === $orderby ) {

		$content_args[ 'custom_order' ] = 'relevance';

	} else {

		$content_args[ 'orderby' ] 	= $orderby;
		$content_args[ 'order' ]	= $order;
	}

	$content_query = new WP_Query( $content_args );

	$total_pages 	= $content_query->max_num_pages;
	$total_content = $content_query->found_posts;

	if ( $content_query->have_posts() ) {

		$cnt = 0;

		while ( $content_query->have_posts() ) {

			$content_query->the_post();

			$thumbnail_url 	= has_post_thumbnail() ? get_the_post_thumbnail_url() : nab_placeholder_img();

			$result_post[ $cnt ][ 'thumbnail' ] = $thumbnail_url;
			$result_post[ $cnt ][ 'link' ] 		= get_the_permalink();
			$result_post[ $cnt ][ 'title' ] 	= html_entity_decode( get_the_title() );

			if ( 0 === $page_number % 2 && ( 4 === $cnt + 1 || 12 === $cnt + 1 ) ) {

				$result_post[ $cnt ][ 'banner' ] = nab_get_search_result_ad();

			} else if ( 8 === $cnt + 1 ) {

				$result_post[ $cnt ][ 'banner' ] = nab_get_search_result_ad();
			}

			$cnt++;
		}

	}
	wp_reset_postdata();

	$final_result[ 'next_page_number' ] = $page_number + 1;
	$final_result[ 'total_page' ]       = $total_pages;
	$final_result[ 'total_content' ]	= $total_content;
	$final_result[ 'result_post' ]      = $result_post;

	echo wp_json_encode( $final_result );

	wp_die();
}

add_action( 'wp_ajax_nab_update_member_bookmark', 'nab_update_member_bookmark_callback' );
add_action( 'wp_ajax_nopriv_nab_update_member_bookmark', 'nab_update_member_bookmark_callback' );

function nab_update_member_bookmark_callback() {

	check_ajax_referer( 'nab-ajax-nonce', 'nabNonce' );

	$final_result 	= array( 'success' => false );

	$item_id		= filter_input( INPUT_POST, 'item_id', FILTER_SANITIZE_NUMBER_INT );
	$bm_action		= filter_input( INPUT_POST, 'bm_action', FILTER_SANITIZE_STRING );

	if ( is_user_logged_in() && ! empty( $item_id ) && ! empty( $bm_action ) ) {

		$current_user_id 	= get_current_user_id();
		$bookmark_products 	= get_user_meta( $current_user_id, 'nab_customer_product_bookmark', true );

		if ( 'add' === strtolower( $bm_action ) ) {

			if ( ! empty( $bookmark_products ) && is_array( $bookmark_products ) && ! in_array( $item_id, $bookmark_products, true ) ) {

				$bookmark_products[] 		= $item_id;
				$final_result[ 'success' ]	= true;

			} else if ( empty( $bookmark_products ) ) {

				$bookmark_products 			= array( $item_id );
				$final_result[ 'success' ]	= true;
			}

			if ( $final_result[ 'success' ] ) {

				update_user_meta( $current_user_id, 'nab_customer_product_bookmark', $bookmark_products );

				$final_result[ 'tooltip' ] = 'Remove from Bookmarks';
			}

		} else if ( 'remove' === strtolower( $bm_action ) ) {

			if ( ! empty( $bookmark_products ) && is_array( $bookmark_products ) && in_array( $item_id, $bookmark_products, true ) ) {

				if ( ( $key = array_search( $item_id, $bookmark_products ) ) !== false ) {

					unset( $bookmark_products[ $key ] );

					update_user_meta( $current_user_id, 'nab_customer_product_bookmark', $bookmark_products );

					$final_result[ 'success' ]	= true;
					$final_result[ 'tooltip' ] 	= 'Add to Bookmarks';
				}
			}
		}
	}

	echo wp_json_encode( $final_result );

	wp_die();
}

add_action( 'wp_ajax_nab_member_bookmark_list', 'nab_member_bookmark_list_callback' );
add_action( 'wp_ajax_nopriv_nab_member_bookmark_list', 'nab_member_bookmark_list_callback' );

function nab_member_bookmark_list_callback() {

	check_ajax_referer( 'nab-ajax-nonce', 'nabNonce' );

	$final_result 	= array();
	$result_post	= array();

	$page_number	= filter_input( INPUT_POST, 'page_number', FILTER_SANITIZE_NUMBER_INT );
	$post_limit		= filter_input( INPUT_POST, 'post_limit', FILTER_SANITIZE_NUMBER_INT );
	$user_id		= filter_input( INPUT_POST, 'item_id', FILTER_SANITIZE_NUMBER_INT );
	$total_pages	= 0;

	$member_bookmarks = get_user_meta( $user_id, 'nab_customer_product_bookmark', true );

	if ( ! empty( $member_bookmarks ) && is_array( $member_bookmarks ) && count( $member_bookmarks ) > 0 ) {

		$bookmark_query_args = array(
			'post_type'         => 'product',
			'posts_per_page'    => 12,
			'post_status'       => 'publish',
			'paged'				=> $page_number,
			'post__in'          => $member_bookmarks
		);

		$bookmark_query = new WP_Query( $bookmark_query_args );

		$total_pages 	= $bookmark_query->max_num_pages;

		if ( $bookmark_query->have_posts() ) {

			$bookmark_img   = nab_placeholder_img();
			$cnt            = 0;

			while ( $bookmark_query->have_posts() ) {

				$bookmark_query->the_post();

				$bookmark_thumbnail = has_post_thumbnail() ? get_the_post_thumbnail_url() : $bookmark_img;
				$bookmark_link      = get_the_permalink();
				$bookmark_title		= get_the_title();

				$result_post[ $cnt ][ 'thumbnail' ] = $bookmark_thumbnail;
				$result_post[ $cnt ][ 'link' ] 		= $bookmark_link;
				$result_post[ $cnt ][ 'title' ] 	= html_entity_decode( $bookmark_title );

				if ( 0 === $page_number % 2 && ( 4 === $cnt + 1 || 12 === $cnt + 1 ) ) {

					$result_post[ $cnt ][ 'banner' ] = nab_get_search_result_ad();

				} else if ( 8 === $cnt + 1 ) {

					$result_post[ $cnt ][ 'banner' ] = nab_get_search_result_ad();
				}

				$cnt++;
			}
		}
		wp_reset_postdata();
	}

	$final_result[ 'next_page_number' ] = $page_number + 1;
	$final_result[ 'total_page' ]       = $total_pages;
	$final_result[ 'result_post' ]      = $result_post;

	echo wp_json_encode( $final_result );

	wp_die();
}

add_action( 'wp_ajax_nab_member_event_list', 'nab_member_event_list_callback' );
add_action( 'wp_ajax_nopriv_nab_member_event_list', 'nab_member_event_list_callback' );

function nab_member_event_list_callback() {

	check_ajax_referer( 'nab-ajax-nonce', 'nabNonce' );

	$final_result 	= array();
	$result_post	= array();

	$page_number	= filter_input( INPUT_POST, 'page_number', FILTER_SANITIZE_NUMBER_INT );
	$post_limit		= filter_input( INPUT_POST, 'post_limit', FILTER_SANITIZE_NUMBER_INT );
	$user_id		= filter_input( INPUT_POST, 'item_id', FILTER_SANITIZE_NUMBER_INT );
	$total_pages	= 0;

	$customer_products = nab_get_customer_purchased_product( $user_id );

	if ( is_array( $customer_products ) && count( $customer_products ) > 0 ) {

		$product_ids_regex  = '"' . implode('"|"', $customer_products ) . '"';
		$current_date   	= current_time('Ymd');

		$query_args = array(
			'post_type'         => 'event-shows',
			'posts_per_page'    => $post_limit,
			'paged'				=> $page_number,
			'post_status'       => 'publish',
			'meta_key'          => 'wc_pay_per_post_product_ids',
			'meta_value'        => $product_ids_regex,
			'meta_compare'      => 'REGEXP',
			'meta_query'        => array (
				array(
					'key'       => 'show_end_date',
					'value'     => $current_date,
					'compare'   => '<',
					'type'      => 'DATE'
				)
			)
		);

		$purchased_events = new WP_Query( $query_args );

		$total_pages 	= $purchased_events->max_num_pages;

		if ( $purchased_events->have_posts() ) {

			$event_default_img  = nab_placeholder_img();
            $cnt				= 0;

			while ( $purchased_events->have_posts() ) {

				$purchased_events->the_post();

				$event_id	= get_the_ID();
				$event_img	= has_post_thumbnail() ? get_the_post_thumbnail_url() : $event_default_img;
				$event_date	= get_field( 'show_date', $event_id );
				$event_url	= get_field( 'show_url', $event_id );

				$result_post[ $cnt ][ 'thumbnail' ] = $event_img;
				$result_post[ $cnt ][ 'date' ] 		= $event_date;
				$result_post[ $cnt ][ 'link' ] 		= $event_url;
				$result_post[ $cnt ][ 'title' ] 	= html_entity_decode( get_the_title() );

				if ( 0 === $page_number % 2 && ( 4 === $cnt + 1 || 12 === $cnt + 1 ) ) {

					$result_post[ $cnt ][ 'banner' ] = nab_get_search_result_ad();

				} else if ( 8 === $cnt + 1 ) {

					$result_post[ $cnt ][ 'banner' ] = nab_get_search_result_ad();
				}

				$cnt++;
			}
		}
		wp_reset_postdata();
	}

	$final_result[ 'next_page_number' ] = $page_number + 1;
	$final_result[ 'total_page' ]       = $total_pages;
	$final_result[ 'result_post' ]      = $result_post;

	echo wp_json_encode( $final_result );

	wp_die();
}

add_action( 'wp_ajax_nab_get_friend_button', 'nab_get_friend_button_callback' );
add_action( 'wp_ajax_nopriv_nab_get_friend_button', 'nab_get_friend_button_callback' );

function nab_get_friend_button_callback() {

	check_ajax_referer( 'nab-ajax-nonce', 'nabNonce' );

	$final_result 	= array();
	$member_id		= filter_input( INPUT_POST, 'item_id', FILTER_SANITIZE_NUMBER_INT );

	if ( ! empty( $member_id ) ) {

		$final_result[ 'success' ] = true;
		$final_result[ 'content' ] = nab_amplify_bp_get_friendship_button( $member_id, false );

	} else {

		$final_result[ 'success' ] = false;
		$final_result[ 'content' ] = '';
	}

	echo wp_json_encode( $final_result );

	wp_die();
}
