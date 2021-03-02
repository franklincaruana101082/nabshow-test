<?php
require get_stylesheet_directory() . '/vendor/autoload.php';

// Ajax to show connection request popup.
add_action("wp_ajax_nab_bp_connecton_request_popup", "nab_bp_connecton_request_popup");
add_action("wp_ajax_nopriv_nab_bp_connecton_request_popup", "nab_bp_connecton_request_popup");

/**
 * Ajax to show connection request popup.
 */
function nab_bp_connecton_request_popup()
{

	ob_start();

	require_once get_template_directory() . '/inc/nab-connection-popup.php';

	$popup_html = ob_get_clean();

	wp_send_json($popup_html, 200);

	wp_die();
}

// Ajax to show connection request popup.
add_action("wp_ajax_nab_bp_send_connection_message", "nab_bp_send_connection_message");
add_action("wp_ajax_nopriv_nab_bp_send_connection_message", "nab_bp_send_connection_message");

/**
 * Ajax to send connection request message.
 */
function nab_bp_send_connection_message()
{

	$message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);
	$member_id = filter_input(INPUT_POST, 'memberID', FILTER_SANITIZE_NUMBER_INT);

	$current_user_id = get_current_user_id();

	$connection_messages = get_user_meta($current_user_id, 'connection_messages', true);
	$connection_messages = $connection_messages ? $connection_messages : array();
	$connection_messages[$member_id] = $message;

	update_user_meta($current_user_id, 'connection_messages', $connection_messages);
	wp_die();
}

add_action('wp_ajax_nab_db_add_attendee', 'nab_db_add_attendee_callback');
add_action('wp_ajax_nopriv_nab_db_add_attendee', 'nab_db_add_attendee_callback');

function nab_db_add_attendee_callback()
{
	global $wpdb;

	$response       = [];
	$err            = 0;
	$parent_user_id = get_current_user_id();
	$order_id       = filter_input(INPUT_POST, 'attendeeOrderID');

	if (!isset($_POST['nabNonce']) || false === wp_verify_nonce($_POST['nabNonce'], 'nab-ajax-nonce')) {
		$response['err']     = 1;
		$response['message'] = 'Authentication failed. Please reload the page and try again.';

		wp_send_json($response, 200);
		wp_die();
	}

	if (!isset($order_id) || empty($order_id)) {
		$response['err']     = 1;
		$response['message'] = 'Something went wrong! Please try again!';
		wp_send_json($response, 200);

		wp_die();
	}

	// Get quantity for this order
	$order_qty = get_post_meta($order_id, '_nab_bulk_qty', true);

	if (!isset($order_qty) || empty($order_qty)) {
		$response['err']     = 1;
		$response['message'] = 'Something went wrong! Please try again!';
		wp_send_json($response, 200);

		wp_die();
	}

	// Check if this order has attendees or not
	$attendee_count = nab_get_attendee_count($order_id);

	$new_attendee_count = $order_qty - $attendee_count;

	if ($new_attendee_count > 0) {

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

		if (isset($_FILES['file']['name']) && in_array($_FILES['file']['type'], $file_mimes)) {

			$input_file      = $_FILES['file']['tmp_name'];
			$input_file_name = $_FILES['file']['name'];

			$input_file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($input_file);

			$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($input_file_type);

			/**  Advise the Reader that we only want to load cell data  **/
			$reader->setReadDataOnly(true);

			$reader->setReadEmptyCells(false);

			$spreadsheet = $reader->load($input_file);

			$sheet_data    = $spreadsheet->getActiveSheet()->toArray();
			$sheet_records = count($sheet_data) - 1;
			$inserted_records = 0;

			/*if ( $sheet_records < $new_attendee_count ) {
				$new_attendee_count = $sheet_records;
			}*/

			if (!empty($sheet_data)) {

				$attendee_emails = nab_get_order_attendees_email_list($order_id);

				for ($i = 1; $i <= $sheet_records; $i++) {

					$first_name = trim($sheet_data[$i][0]);
					$last_name  = trim($sheet_data[$i][1]);
					$email      = sanitize_email($sheet_data[$i][2]);

					if (!empty($email) && !in_array($email, $attendee_emails, true) && is_email($email)) {

						$insert_attendee_query = $wpdb->prepare(
							"INSERT INTO {$wpdb->prefix}nab_attendee
									(`parent_user_id`, `order_id`, `status`, `first_name`, `last_name`, `email`)
									VALUES
									(%d, %d, 0, %s, %s, %s)",
							$parent_user_id,
							$order_id,
							$first_name,
							$last_name,
							$email
						);

						$insert_attendee = $wpdb->query($insert_attendee_query);

						if (false !== $insert_attendee) {

							$attendee_count++;

							$err 				= 0;
							$attendee_emails[] 	= $email;

							$inserted_records++;
						} else {
							$err = 1;
						}

						if ($attendee_count >= $order_qty) {
							break;
						}
					}
				}
			}

			if (0 === $err) {
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

	wp_send_json($response, 200);

	wp_die();
}

add_action('wp_ajax_insert_new_attendee', 'insert_new_attendee_callback');
add_action('wp_ajax_nopriv_insert_new_attendee', 'insert_new_attendee_callback');

function insert_new_attendee_callback()
{
	global $wpdb;

	$res              = [];
	$order_id         = filter_input(INPUT_POST, 'attendeeOrderID');
	$current_index    = filter_input(INPUT_POST, 'currentIndex');
	$offset           = (isset($current_index)) ? 10 * $current_index : 0;
	$failed           = [];
	$skipped          = 0;
	$skipped_msg      = [];
	$added_attendee   = 0;
	$new_user_created = 0;

	// Get Attendees to add
	$get_attendees_query = $wpdb->prepare("SELECT * FROM {$wpdb->prefix}nab_attendee WHERE `status` = 0 AND `order_id` = %d ORDER BY `id` DESC LIMIT 10", $order_id);
	$attendee_data       = $wpdb->get_results($get_attendees_query, ARRAY_A);

	if (!empty($attendee_data)) {

		foreach ($attendee_data as $attendee) {
			$user               = [];
			$user['first_name'] = $attendee['first_name'];
			$user['last_name']  = $attendee['last_name'];
			$user['user_email'] = $attendee['email'];

			if (empty($user['user_email'])) {
				$skipped       = 1;
				$skipped_msg[] = 'Attendees with missing email field found. Kindly try adding email and upload again.';

				continue;
			}

			// check if this user already exist in system or not
			if (email_exists($user['user_email'])) {
				$existing_user   = email_exists($user['user_email']);
				$new_user_id     = $existing_user;
				$current_site_id = (is_multisite()) ? get_current_blog_id() : 1;
				if (false === is_user_member_of_blog($new_user_id, $current_site_id)) {
					$existing_user_obj  = get_userdata($existing_user);
					$existing_user_role = (isset($existing_user_obj->roles) && !empty($existing_user_obj->roles)) ? $existing_user_obj->roles[0] : 'customer';
					add_user_to_blog($current_site_id, $existing_user, $existing_user_role);
				}
			} else {
				// Create new user
				$user['user_pass']  = wp_generate_password();
				$user['user_login'] = wc_create_new_customer_username($user['user_email'], array(
					'first_name' => $user['first_name'],
					'last_name'  => $user['last_name'],
				));
				$user['role']       = 'customer';
				$new_user           = wp_insert_user($user);

				if (is_wp_error($new_user)) {
					$failed[]    = $user['user_email'] . ' - Error inserting new attendee.';
					$new_user_id = 0;

					// update status in DB
					$wpdb->query($wpdb->prepare(
						"UPDATE {$wpdb->prefix}nab_attendee SET `status` = 2, `modified`= '%s' WHERE `id` = %d",
						date('Y-m-d H:i:s'),
						$attendee['id']
					));
				} else {
					$new_user_id      = $new_user;
					$new_user_created = 1;
				}
			}

			if (!empty($new_user_id)) {

				// Get Original order details
				$order = wc_get_order($order_id);

				// Create new order for this user
				$new_order = wc_create_order(array('customer_id' => $new_user_id));

				if (!is_wp_error($new_order)) {
					$order_items = $order->get_items();

					// Set products to order
					foreach ($order_items as $item) {
						$new_order->add_product(wc_get_product($item->get_product_id()), 1, array(
							'subtotal' => 0,
							'total'    => 0,
						));
					}

					$new_order_id = $new_order->get_order_number();
					update_post_meta($new_order_id, '_nab_bulk_child', 'yes');
					update_post_meta($new_order_id, '_nab_bulk_parent_order', $order_id);

					$order_address               = $order->get_address();
					$order_address['first_name'] = $user['first_name'];
					$order_address['last_name']  = $user['last_name'];
					$order_address['email']      = $user['user_email'];

					// Set billing address to order
					$new_order->set_address($order_address, 'billing');
					$new_order->calculate_totals();
					$new_order->update_status("completed");

					update_user_meta($new_user_id, 'billing_first_name', $user['first_name']);
					update_user_meta($new_user_id, 'billing_last_name', $user['last_name']);

					// update status to 1 in DB
					$wpdb->query($wpdb->prepare(
						"UPDATE {$wpdb->prefix}nab_attendee SET `status` = 1, `modified`= '%s', `wp_user_id` = %d, `child_order_id` = %d WHERE `id` = %d",
						date('Y-m-d H:i:s'),
						$new_user_id,
						$new_order_id,
						$attendee['id']
					));
					$added_attendee++;

					if (1 === $new_user_created) {
						do_action('nab_bulk_user_registration', $new_order_id, $new_user_id, $user['user_pass']);
					}
				} else {
					$failed[] = $user['user_email'] . ' - Error creating order for new attendee.';
				}
			}
		}
	} else {
		$failed[] = 'Something went wrong! Please try again!';
	}

	if (!empty($failed)) {
		$res['err'] = 1;
		$res['msg'] = $failed;
	} else {
		$res['err'] = 0;
	}
	$res['skipped']        = $skipped;
	$skipped_msg           = array_unique($skipped_msg);
	$res['skipped_msg']    = $skipped_msg;
	$res['added_attendee'] = $added_attendee;

	if (isset($_POST['isLast']) && 'yes' === $_POST['isLast']) {
		$res['totalAddedAttendees'] = nab_get_attendee_count($order_id);
	}

	wp_send_json($res, 200);
}

add_action('wp_ajax_get_order_attendees', 'get_order_attendees_callback');
add_action('wp_ajax_nopriv_get_order_attendees', 'get_order_attendees_callback');

function get_order_attendees_callback()
{
	global $wpdb;

	$res      = [];
	if (!isset($_GET['nabNonce']) || false === wp_verify_nonce($_GET['nabNonce'], 'nab-ajax-nonce')) {
		$res['err']     = 1;
		$res['message'] = 'Authentication failed. Please reload the page and try again.';

		wp_send_json($res, 200);
	}

	$order_id = filter_input(INPUT_GET, 'orderId');

	if (!isset($order_id) || empty($order_id)) {
		$res['err']     = 1;
		$res['message'] = 'Something went wrong! Please try again';

		wp_send_json($res, 200);
	}

	// Get Attendees
	$attendees_query = $wpdb->prepare("SELECT * FROM {$wpdb->prefix}nab_attendee WHERE `order_id` = %d AND `status` = 1 ", $order_id);
	$attendees       = $wpdb->get_results($attendees_query, ARRAY_A);

	if (!empty($attendees)) {
		$res['attendees'] = [];
		foreach ($attendees as $attendee) {
			$attendee_user               = [];
			$attendee_user['id']         = $attendee['id'];
			$attendee_user['first_name'] = $attendee['first_name'];
			$attendee_user['last_name']  = $attendee['last_name'];
			$attendee_user['email']      = $attendee['email'];
			$attendee_user['order_id']   = $attendee['child_order_id'];
			array_push($res['attendees'], $attendee_user);
		}
	}

	$res['is_attendee'] = nab_is_all_attendee_added($order_id);

	$res['err'] = 0;

	wp_send_json($res, 200);
}

add_action('wp_ajax_nab_custom_update_cart', 'nab_custom_update_cart_cb');
add_action('wp_ajax_nopriv_nab_custom_update_cart', 'nab_custom_update_cart_cb');

function nab_custom_update_cart_cb()
{

	$res = [];
	if (isset($_POST['is_bulk']) && 'yes' === filter_input(INPUT_POST, 'is_bulk')) {
		if (isset($_POST['qty']) && !empty($_POST['qty'])) {
			$qty = filter_input(INPUT_POST, 'qty');
			$is_bulk = 'yes';
		} else {
			$qty = 1;
			$is_bulk = 'no';
		}
	} else {
		$is_bulk = 'no';
		$qty = 1;
	}

	if (!WC()->cart->is_empty()) {
		$temp = [];

		foreach (WC()->cart->get_cart() as $cart_item_key => $values) {
			$values['quantity'] = $qty;
			$values['nab_qty']  = $qty;
			$values['nab_bulk_order'] = $is_bulk;
			$temp[$cart_item_key] = $values;

			// update cocart
			nab_update_cocart_item($cart_item_key, $qty);
		}

		WC()->cart->set_cart_contents($temp);

		wc_add_notice(__('Cart updated.', 'woocommerce'), apply_filters('woocommerce_cart_updated_notice_type', 'success'));

		ob_start();
		echo do_shortcode('[woocommerce_cart]');

		$res['cart_content'] = ob_get_clean();
		$res['err'] = 0;
	} else {
		$res['err'] = 1;
	}

	wp_send_json($res, 200);
}

add_action('wp_ajax_remove_attendee', 'nab_remove_attendee');
add_action('wp_ajax_nopriv_remove_attendee', 'nab_remove_attendee');

function nab_remove_attendee()
{
	global $wpdb;

	$res      = [];
	if (!isset($_POST['nabNonce']) || false === wp_verify_nonce($_POST['nabNonce'], 'nab-ajax-nonce')) {
		$res['err']     = 1;
		$res['message'] = 'Authentication failed. Please reload the page and try again.';

		wp_send_json($res, 200);
	}

	$primary_id 		= filter_input(INPUT_POST, 'pID');
	$order_id   		= filter_input(INPUT_POST, 'oID');
	$parent_order_id 	= filter_input(INPUT_POST, 'parentOrderId', FILTER_SANITIZE_NUMBER_INT);

	if (!isset($primary_id) || empty($primary_id) || !isset($order_id) || empty($order_id)) {
		$res['err']     = 1;
		$res['message'] = 'Something went wrong! Please try again';

		wp_send_json($res, 200);
	}

	//update purchased product user meta
	nab_update_product_in_user_meta($order_id, 'completed', 'draft');

	// Delete this order
	$remove_attendee = wp_delete_post($order_id, true);

	if (!empty($remove_attendee)) {
		// Remove from attendee table as well
		$wpdb->delete($wpdb->prefix . 'nab_attendee', array('id' => $primary_id));
		$res['err']     = 0;
		$res['message'] = 'Attendee removed successfully.';

		$res['is_attendee'] = nab_is_all_attendee_added($parent_order_id);
	} else {
		$res['err']     = 1;
		$res['message'] = 'Attendee could not be deleted. Please reload the page and try again.';
	}

	wp_send_json($res, 200);
}

add_action('wp_ajax_get_edit_attendee', 'nab_get_edit_attendee_ajax_callback');
add_action('wp_ajax_nopriv_get_edit_attendee', 'nab_get_edit_attendee_ajax_callback');

function nab_get_edit_attendee_ajax_callback()
{

	$response = array();

	$nab_nonce 	= filter_input(INPUT_POST, 'nabNonce', FILTER_SANITIZE_STRING);
	$primary_id	= filter_input(INPUT_POST, 'pID', FILTER_SANITIZE_NUMBER_INT);

	//verify nonce
	if (!isset($nab_nonce) || false === wp_verify_nonce($nab_nonce, 'nab-ajax-nonce')) {

		$response['err']     	= 1;
		$response['message']	= 'Authentication failed. Please reload the page and try again.';

		wp_send_json($response, 200);
	}

	//Check primary id is empty
	if (!isset($primary_id) || empty($primary_id)) {

		$response['err']     	= 1;
		$response['message']	= 'Something went wrong! Please try again';

		wp_send_json($response, 200);
	}

	// Get attendee details
	$attendee_details = nab_get_order_attendee_details($primary_id);

	// Return attendee details if details found otherwise return error.
	if (is_array($attendee_details) && count($attendee_details) > 0) {

		$response['err']			= 0;
		$response['first_name']	= $attendee_details['first_name'];
		$response['last_name']	= $attendee_details['last_name'];
		$response['email']		= $attendee_details['email'];
		$response['uid']			= $attendee_details['wp_user_id'];
	} else {

		$response['err']     	= 1;
		$response['message']	= 'Something went wrong! Please try again';
	}

	wp_send_json($response, 200);

	wp_die();
}

add_action('wp_ajax_update_attendee_details', 'nab_update_attendee_details_ajax_callback');
add_action('wp_ajax_nopriv_update_attendee_details', 'nab_update_attendee_details_ajax_callback');

function nab_update_attendee_details_ajax_callback()
{

	global $wpdb;

	$response = array();

	$nab_nonce 	= filter_input(INPUT_POST, 'nabNonce', FILTER_SANITIZE_STRING);
	$primary_id	= filter_input(INPUT_POST, 'pID', FILTER_SANITIZE_NUMBER_INT);
	$user_id	= filter_input(INPUT_POST, 'uID', FILTER_SANITIZE_NUMBER_INT);
	$first_name	= filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_STRING);
	$last_name	= filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_STRING);

	//verify nonce
	if (!isset($nab_nonce) || false === wp_verify_nonce($nab_nonce, 'nab-ajax-nonce')) {

		$response['err']     	= 1;
		$response['message']	= 'Authentication failed. Please reload the page and try again.';

		wp_send_json($response, 200);
	}

	// check input values are empty.
	if ((!isset($primary_id) || empty($primary_id)) || (!isset($user_id) || empty($user_id)) || (!isset($first_name) || empty($first_name)) || (!isset($last_name) || empty($last_name))) {

		$response['err']     	= 1;
		$response['message']	= 'Something went wrong! Please try again';

		wp_send_json($response, 200);
	}

	// Update custom table record
	$wpdb->query($wpdb->prepare("UPDATE {$wpdb->prefix}nab_attendee SET `first_name`= '%s', `last_name` = %s WHERE `id` = %d", $first_name, $last_name, $primary_id));

	// Update WC billing user meta
	update_user_meta($user_id, 'billing_first_name', $first_name);
	update_user_meta($user_id, 'billing_last_name', $last_name);

	// Update WP user
	wp_update_user([
		'ID' => $user_id,
		'first_name' => $first_name,
		'last_name' => $last_name,
	]);

	$response['err']     	= 0;
	$response['message']	= 'Attendee details update successfully.';

	wp_send_json($response, 200);

	wp_die();
}

add_action('wp_ajax_change_attendee_order_details', 'nab_change_attendee_order_details_ajax_callback');
add_action('wp_ajax_nopriv_change_attendee_order_details', 'nab_change_attendee_order_details_ajax_callback');

function nab_change_attendee_order_details_ajax_callback()
{

	global $wpdb;

	$response = array();

	$nab_nonce 	= filter_input(INPUT_POST, 'nabNonce', FILTER_SANITIZE_STRING);
	$primary_id	= filter_input(INPUT_POST, 'pID', FILTER_SANITIZE_NUMBER_INT);
	$order_id	= filter_input(INPUT_POST, 'oID', FILTER_SANITIZE_NUMBER_INT);
	$first_name	= filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_STRING);
	$last_name	= filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_STRING);
	$email		= filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);

	//verify nonce
	if (!isset($nab_nonce) || false === wp_verify_nonce($nab_nonce, 'nab-ajax-nonce')) {

		$response['err']     	= 1;
		$response['message']	= 'Authentication failed. Please reload the page and try again.';

		wp_send_json($response, 200);
	}

	// check input values are empty.
	if ((!isset($email) || empty($email)) || (!isset($primary_id) || empty($primary_id)) || (!isset($order_id) || empty($order_id)) || (!isset($first_name) || empty($first_name)) || (!isset($last_name) || empty($last_name))) {

		$response['err']     	= 1;
		$response['message']	= 'Something went wrong! Please try again';

		wp_send_json($response, 200);
	}

	// Get attendee details
	$attendee_details = nab_get_order_attendee_details($primary_id);

	// Check email already exist or not
	if (nab_is_order_attendee_exist($email, $attendee_details['order_id'])) {

		$response['err']     = 1;
		$response['message'] = 'Attendee not updated. Email address already exist.';

		wp_send_json($response, 200);

		wp_die();
	}

	//update purchased product user meta
	nab_update_product_in_user_meta($order_id, 'completed', 'draft');

	// Delete this order
	$remove_attendee = wp_delete_post($order_id, true);

	if (!empty($remove_attendee)) {

		// Remove from attendee table as well
		$wpdb->delete($wpdb->prefix . 'nab_attendee', array('id' => $primary_id));

		$parent_user_id 	= $attendee_details['parent_user_id'];
		$parent_order_id	= $attendee_details['order_id'];
		$user 				= array('user_email' => $email, 'first_name' => $first_name, 'last_name' => $last_name);

		// check if this user already exist in system or not
		if (email_exists($email)) {

			$existing_user   = email_exists($email);
			$new_user_id     = $existing_user;
			$current_site_id = (is_multisite()) ? get_current_blog_id() : 1;

			if (false === is_user_member_of_blog($new_user_id, $current_site_id)) {

				$existing_user_obj  = get_userdata($existing_user);
				$existing_user_role = (isset($existing_user_obj->roles) && !empty($existing_user_obj->roles)) ? $existing_user_obj->roles[0] : 'customer';

				add_user_to_blog($current_site_id, $existing_user, $existing_user_role);
			}
		} else {

			// Create new user
			$user['user_pass']	= wp_generate_password();
			$user['user_login']	= wc_create_new_customer_username($user['user_email'], array(
				'first_name' => $user['first_name'],
				'last_name'  => $user['last_name'],
			));


			$user['role']	= 'customer';
			$new_user		= wp_insert_user($user);

			if (is_wp_error($new_user)) {

				$response['err']		= 1;
				$response['message'] 	= $user['user_email'] . ' - Error inserting new attendee.';
				$new_user_id 			= 0;
			} else {
				$new_user_id      = $new_user;
				$new_user_created = 1;
			}
		}

		if (!empty($new_user_id) && 0 !== $new_user_id) {

			// Get Original order details
			$order = wc_get_order($parent_order_id);

			// Create new order for this user
			$new_order = wc_create_order(array('customer_id' => $new_user_id));

			if (!is_wp_error($new_order)) {

				$order_items = $order->get_items();

				// Set products to order
				foreach ($order_items as $item) {
					$new_order->add_product(wc_get_product($item->get_product_id()), 1, array(
						'subtotal' => 0,
						'total'    => 0,
					));
				}

				$new_order_id = $new_order->get_order_number();

				// set order meta
				update_post_meta($new_order_id, '_nab_bulk_child', 'yes');
				update_post_meta($new_order_id, '_nab_bulk_parent_order', $parent_order_id);

				$order_address               	= $order->get_address();
				$order_address['first_name'] 	= $first_name;
				$order_address['last_name']  	= $last_name;
				$order_address['email']      	= $email;

				// Set billing address to order
				$new_order->set_address($order_address, 'billing');
				$new_order->calculate_totals();
				$new_order->update_status("completed");

				// Update WC billing details
				update_user_meta($new_user_id, 'billing_first_name', $first_name);
				update_user_meta($new_user_id, 'billing_last_name', $last_name);

				// Insert user details in the custom attendee table
				$insert_attendee_query = $wpdb->prepare(
					"INSERT INTO {$wpdb->prefix}nab_attendee
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
				$insert_attendee = $wpdb->query($insert_attendee_query);


				if (false !== $insert_attendee) {

					$response['err']     		= 0;
					$response['message'] 		= 'Attendee updated successfully.';
					$response['oid']			= $new_order_id;
					$response['pid']			= nab_get_attendee_primary_id_by_order_id($new_order_id);
					$response['is_attendee']	= nab_is_all_attendee_added($parent_order_id);
				} else {

					$response['err']     = 1;
					$response['message'] = 'Attendee can not added to the custom table. Please reload the page and try again.';
				}

				// Sent an email if new user created
				if (1 === $new_user_created) {
					do_action('nab_bulk_user_registration', $new_order_id, $new_user_id, $user['user_pass']);
				}
			} else {

				$response['err']     = 1;
				$response['message'] = $user['user_email'] . ' - Error creating order for new attendee.';
			}
		} else {

			$response['err']     = 1;
			$response['message'] = 'Attendee deleted but can\'t create new attendee' . $user['user_email'];
		}
	} else {

		$response['err']     = 1;
		$response['message'] = 'Existing attendee can not deleted. Please reload the page and try again.';
	}

	wp_send_json($response, 200);

	wp_die();
}

add_action('wp_ajax_add_attendee_order_details', 'nab_add_attendee_order_details_ajax_callback');
add_action('wp_ajax_nopriv_add_attendee_order_details', 'nab_add_attendee_order_details_ajax_callback');

function nab_add_attendee_order_details_ajax_callback()
{

	global $wpdb;

	$response = array();

	$nab_nonce 	= filter_input(INPUT_POST, 'nabNonce', FILTER_SANITIZE_STRING);
	$order_id	= filter_input(INPUT_POST, 'orderId', FILTER_SANITIZE_NUMBER_INT);
	$first_name	= filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_STRING);
	$last_name	= filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_STRING);
	$email		= filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);

	//verify nonce
	if (!isset($nab_nonce) || false === wp_verify_nonce($nab_nonce, 'nab-ajax-nonce')) {

		$response['err']     	= 1;
		$response['message']	= 'Authentication failed. Please reload the page and try again.';

		wp_send_json($response, 200);

		wp_die();
	}

	// check input values are empty.
	if ((!isset($email) || empty($email)) || (!isset($order_id) || empty($order_id)) || (!isset($first_name) || empty($first_name)) || (!isset($last_name) || empty($last_name))) {

		$response['err']     	= 1;
		$response['message']	= 'Something went wrong! Please try again';

		wp_send_json($response, 200);

		wp_die();
	}

	// Get quantity for this order
	$order_qty = get_post_meta($order_id, '_nab_bulk_qty', true);

	if (!isset($order_qty) || empty($order_qty)) {

		$response['err']     = 1;
		$response['message'] = 'Something went wrong! Please try again!';

		wp_send_json($response, 200);

		wp_die();
	}

	if (nab_is_order_attendee_exist($email, $order_id)) {

		$response['err']     = 1;
		$response['message'] = 'Attendee email address already exist.';

		wp_send_json($response, 200);

		wp_die();
	}

	// Check if this order has attendees or not
	$attendee_count = nab_get_attendee_count($order_id);

	$new_attendee_count = $order_qty - $attendee_count;

	if ($new_attendee_count > 0) {

		$parent_user_id = 1;

		// Get parent user id
		$attendees_query = $wpdb->prepare("SELECT `parent_user_id` FROM {$wpdb->prefix}nab_attendee WHERE `order_id` = %d LIMIT 1", $order_id);
		$attendees       = $wpdb->get_results($attendees_query, ARRAY_A);

		// Set attendee primary id from the DB result if not empty array
		if (is_array($attendees) && count($attendees) > 0) {

			$parent_user_id = $attendees[0]['parent_user_id'];
		}

		$parent_order_id	= $order_id;
		$user 				= array('user_email' => $email, 'first_name' => $first_name, 'last_name' => $last_name);

		// check if this user already exist in system or not
		if (email_exists($email)) {

			$existing_user   = email_exists($email);
			$new_user_id     = $existing_user;
			$current_site_id = (is_multisite()) ? get_current_blog_id() : 1;

			if (false === is_user_member_of_blog($new_user_id, $current_site_id)) {

				$existing_user_obj  = get_userdata($existing_user);
				$existing_user_role = (isset($existing_user_obj->roles) && !empty($existing_user_obj->roles)) ? $existing_user_obj->roles[0] : 'customer';

				add_user_to_blog($current_site_id, $existing_user, $existing_user_role);
			}
		} else {

			// Create new user
			$user['user_pass']	= wp_generate_password();
			$user['user_login']	= wc_create_new_customer_username($user['user_email'], array(
				'first_name' => $user['first_name'],
				'last_name'  => $user['last_name'],
			));

			$user['role']	= 'customer';
			$new_user		= wp_insert_user($user);

			if (is_wp_error($new_user)) {

				$response['err']		= 1;
				$response['message'] 	= $user['user_email'] . ' - Error inserting new attendee.';
				$new_user_id 			= 0;
			} else {
				$new_user_id      = $new_user;
				$new_user_created = 1;
			}
		}

		if (!empty($new_user_id) && 0 !== $new_user_id) {

			// Get Original order details
			$order = wc_get_order($parent_order_id);

			// Create new order for this user
			$new_order = wc_create_order(array('customer_id' => $new_user_id));

			if (!is_wp_error($new_order)) {

				$order_items = $order->get_items();

				// Set products to order
				foreach ($order_items as $item) {
					$new_order->add_product(wc_get_product($item->get_product_id()), 1, array(
						'subtotal' => 0,
						'total'    => 0,
					));
				}

				$new_order_id = $new_order->get_order_number();

				// set order meta
				update_post_meta($new_order_id, '_nab_bulk_child', 'yes');
				update_post_meta($new_order_id, '_nab_bulk_parent_order', $parent_order_id);

				$order_address               	= $order->get_address();
				$order_address['first_name'] 	= $first_name;
				$order_address['last_name']  	= $last_name;
				$order_address['email']      	= $email;

				// Set billing address to order
				$new_order->set_address($order_address, 'billing');
				$new_order->calculate_totals();
				$new_order->update_status("completed");

				// Update WC billing details
				update_user_meta($new_user_id, 'billing_first_name', $first_name);
				update_user_meta($new_user_id, 'billing_last_name', $last_name);

				// Insert user details in the custom attendee table
				$insert_attendee_query = $wpdb->prepare(
					"INSERT INTO {$wpdb->prefix}nab_attendee
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
				$insert_attendee = $wpdb->query($insert_attendee_query);


				if (false !== $insert_attendee) {

					$response['err']     		= 0;
					$response['message'] 		= 'Attendee added successfully.';
					$response['oid']			= $new_order_id;
					$response['pid']			= nab_get_attendee_primary_id_by_order_id($new_order_id);
					$response['is_attendee']	= ($attendee_count + 1) >= $order_qty ? true : false;
				} else {

					$response['err']     = 1;
					$response['message'] = 'Attendee can not added to the custom table. Please reload the page and try again.';
				}

				// Sent an email if new user created
				if (1 === $new_user_created) {
					do_action('nab_bulk_user_registration', $new_order_id, $new_user_id, $user['user_pass']);
				}
			} else {

				$response['err']     = 1;
				$response['message'] = $user['user_email'] . ' - Error creating order for new attendee.';
			}
		} else {

			$response['err']     = 1;
			$response['message'] = 'Error during add new attendee - ' . $user['user_email'];
		}
	} else {

		$response['err']     = 1;
		$response['message'] = 'All attendees have already been registered.';
	}

	wp_send_json($response, 200);

	wp_die();
}

add_action('wp_ajax_nab_get_search_filter_state', 'nab_get_search_filter_state_callback');
add_action('wp_ajax_nopriv_nab_get_search_filter_state', 'nab_get_search_filter_state_callback');

function nab_get_search_filter_state_callback() {

	check_ajax_referer('nab-ajax-nonce', 'nabNonce');

	$final_result 	= array();
	$country		= filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING);

	$countries_obj  		= new WC_Countries();
	$default_country        = ! empty( $country ) ? $country : $countries_obj->get_base_country();
	$default_county_states  = $countries_obj->get_states( $default_country );

	$final_result[ 'states' ] = $default_county_states;

	echo wp_json_encode( $final_result );

	wp_die();

}

add_action('wp_ajax_nab_member_search_filter', 'nab_member_search_filter_callback');
add_action('wp_ajax_nopriv_nab_member_search_filter', 'nab_member_search_filter_callback');

function nab_member_search_filter_callback()
{

	check_ajax_referer('nab-ajax-nonce', 'nabNonce');

	$final_result 	= array();
	$result_user	= array();

	$page_number	= filter_input(INPUT_POST, 'page_number', FILTER_SANITIZE_NUMBER_INT);
	$post_limit		= filter_input(INPUT_POST, 'post_limit', FILTER_SANITIZE_NUMBER_INT);
	$connected		= filter_input(INPUT_POST, 'connected', FILTER_SANITIZE_STRING);
	$search_term	= filter_input(INPUT_POST, 'search_term', FILTER_SANITIZE_STRING);
	$company		= filter_input(INPUT_POST, 'company', FILTER_SANITIZE_STRING);
	$job_title		= filter_input(INPUT_POST, 'job_title', FILTER_SANITIZE_STRING);
	$country		= filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING);
	$state			= filter_input(INPUT_POST, 'state', FILTER_SANITIZE_STRING);
	$city			= filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
	$orderby		= filter_input(INPUT_POST, 'orderby', FILTER_SANITIZE_STRING);

	$user_logged_in = false;
	$logged_user_id	= 0;

	if (is_user_logged_in()) {

		$user_logged_in = true;
		$logged_user_id = get_current_user_id();
	}

	$members_filter = array(
		'page' 		=> $page_number,
		'per_page' 	=> $post_limit,
		'type'		=> $orderby,
	);

	if (!empty($search_term)) {
		$members_filter['search_terms'] = $search_term;
	}

	$wp_user_ids 	= array();
	$meta_result	= true;

	if ( ! empty( $company ) || ! empty( $job_title ) || ! empty( $country ) || ! empty( $state ) || ! empty( $city ) ) {

		$user_query_args = array( 'fields' => 'ID' );

		$meta_query_args = array( 'relation' => 'OR' );

		if ( ! empty( $company ) ) {

			$meta_query_args[] = array(
				'key' 		=> 'attendee_company',
				'value'		=> $company,
				'compare'	=> 'LIKE'
			);
		}

		if ( ! empty( $job_title ) ) {

			$meta_query_args[] = array(
				'key' 		=> 'attendee_title',
				'value'		=> $job_title,
				'compare'	=> 'LIKE'
			);
		}

		if ( ! empty( $country ) ) {

			$meta_query_args[] = array(
				'key' 		=> 'user_country',
				'value'		=> $country
			);
		}

		if ( ! empty( $state ) ) {

			$meta_query_args[] = array(
				'key' 		=> 'user_state',
				'value'		=> $state
			);
		}

		if ( ! empty( $city ) ) {

			$meta_query_args[] = array(
				'key' 		=> 'user_city',
				'value'		=> $city
			);
		}

		if ( count( $meta_query_args ) > 2 ) {

			$meta_query_args[ 'relation' ] = 'AND';
		}

		$user_query_args[ 'meta_query' ] = $meta_query_args;

		$user_query = new WP_User_Query( $user_query_args );

		$wp_user_ids = $user_query->get_results();

		if ( count( $wp_user_ids ) === 0 ) {

			$meta_result = false;
		}
	}

	// if (!empty($company)) {

	// 	$members_filter['meta_key'] 	= 'attendee_company';
	// 	$members_filter['meta_value']	= $company;
	// }

	if (!empty($connected) && 'yes' === $connected) {

		$members_filter['user_id'] = $logged_user_id;
	} else if (!empty($connected) && 'no' === $connected) {

		$friend_list_ids = friends_get_friend_user_ids($logged_user_id);

		if (is_array($friend_list_ids) && count($friend_list_ids) > 0) {
			$members_filter['exclude']	= $friend_list_ids;
		}
	}

	$total_users 	= 0;
	$total_pages	= 0;

	if ( $meta_result ) {

		if ( count( $wp_user_ids ) > 0 ) {

			$members_filter[ 'include' ] = $wp_user_ids;
		}

		if (bp_has_members($members_filter)) {

			global $members_template;

			$total_users	= $members_template->total_member_count;
			$total_pages	= ceil($total_users / $post_limit);
			$cnt 			= 0;

			$current_user_id = get_current_user_id();

			while (bp_members()) {

				bp_the_member();

				$member_user_id	= bp_get_member_user_id();
				$is_friend		= friends_check_friendship_status($current_user_id, $member_user_id);
				$user_full_name = get_the_author_meta('first_name', $member_user_id) . ' ' . get_the_author_meta('last_name', $member_user_id);
				if (empty(trim($user_full_name))) {					
					$user_full_name = bp_get_member_name();
				}

				$company 		= get_user_meta($member_user_id, 'attendee_company', true);
				$title 		= get_user_meta($member_user_id, 'attendee_title', true);
				$user_images 	= nab_amplify_get_user_images($member_user_id);

				$user_avatar = '<img src="' . $user_images['profile_picture'] . '" />';

				$result_user[$cnt]['cover_img'] = $user_images['banner_image'];
				$result_user[$cnt]['name'] 		= html_entity_decode($user_full_name);
				$result_user[$cnt]['company'] 	= html_entity_decode($company);
				$result_user[$cnt]['title'] 	= html_entity_decode($title);
				$result_user[$cnt]['avatar']		= $user_avatar;
				$result_user[$cnt]['link']		= bp_get_member_permalink();

				$action_button = nab_amplify_bp_get_friendship_button($member_user_id);
				$result_user[$cnt]['action_button'] = $action_button;

				if ($is_friend && 'is_friend' === $is_friend) {
					$cancel_friendship_button = nab_amplify_bp_get_cancel_friendship_button($member_user_id);
					$result_user[$cnt]['cancel_friendship_button'] = $cancel_friendship_button;
				}

				if (0 === $page_number % 2 && (5 === $cnt + 1 || 15 === $cnt + 1)) {

					$result_user[$cnt]['banner'] = nab_get_search_result_ad();
				} else if (0 !== $page_number % 2 && 10 === $cnt + 1) {

					$result_user[$cnt]['banner'] = nab_get_search_result_ad();
				}

				$cnt++;
			}
		}
	}

	$final_result['next_page_number']	= $page_number + 1;
	$final_result['total_page']			= $total_pages;
	$final_result['total_user']			= $total_users;
	$final_result['result_user']		= $result_user;

	echo wp_json_encode($final_result);

	wp_die();
}

//Ajax for company search.
add_action('wp_ajax_nab_company_search_filter', 'nab_company_search_filter_callback');
add_action('wp_ajax_nopriv_nab_company_search_filter', 'nab_company_search_filter_callback');

/**
 * Company search result filter ajax.
 */
function nab_company_search_filter_callback()
{

	check_ajax_referer('nab-ajax-nonce', 'nabNonce');

	$final_result 	= array();
	$result_post	= array();

	$page_number		= filter_input(INPUT_POST, 'page_number', FILTER_SANITIZE_NUMBER_INT);
	$post_limit			= filter_input(INPUT_POST, 'post_limit', FILTER_SANITIZE_NUMBER_INT);
	$search_term		= filter_input(INPUT_POST, 'search_term', FILTER_SANITIZE_STRING);
	$product_category	= filter_input(INPUT_POST, 'product_category', FILTER_SANITIZE_STRING);
	$orderby			= filter_input(INPUT_POST, 'orderby', FILTER_SANITIZE_STRING);
	$order				= 'title' === $orderby ? 'ASC' : 'DESC';

	$company_args = array(
		'post_type' 		=> 'company',
		'paged'				=> $page_number,
		'post_status'		=> 'publish',
		'posts_per_page' 	=> $post_limit,
		's'					=> $search_term,
	);

	$meta_query_args = array( 'relation' => 'AND' );

	if (!empty($search_term)) {

		$get_search_term_id = get_term_by('name', $search_term, 'company-product-category');

		if ($get_search_term_id) {

			$company_args['_meta_company_term'] = $get_search_term_id->term_id;

			if ('meta' === $orderby) {
				$company_args['_meta_company_order']	= true;
			}
		}
	} else {
		$meta_query_args[] = array(
			array(
				'key' 		=> 'company_user_id',
				'value'		=> '',
				'compare'	=> '!='
			)
		);
	}

	if (!empty($product_category)) {

		$meta_query_args[] = array(

			array(
				'key' 		=> 'product_categories',
				'value'		=> '"' . $product_category . '"',
				'compare'	=> 'LIKE'
			)
		);
	}

	if ( count( $meta_query_args ) > 1 ) {
		$company_args['meta_query'] = $meta_query_args;
	}

	if (!isset($company_args['_meta_company_order'])) {

		if ('meta' === $orderby) {

			$company_args['meta_key']	= 'member_level_num';
			$company_args['orderby']	= 'meta_value_num';
			$company_args['order']		= 'DESC';
		} elseif ('date' !== $orderby) {

			$company_args['orderby'] 	= $orderby;
			$company_args['order']		= $order;
		}
	}

	$company_query = new WP_Query($company_args);

	$total_pages 	= $company_query->max_num_pages;
	$total_company	= nab_get_total_company_count();

	if ($company_query->have_posts()) {

		$cnt 					= 0;
		$default_company_cover 	= get_template_directory_uri() . '/assets/images/search-box-cover.png';
		$user_logged_in			= is_user_logged_in();
		$current_user_id		= $user_logged_in ? get_current_user_id() : '';
		$default_company_pic	= get_template_directory_uri() . '/assets/images/amplify-featured.png';

		while ($company_query->have_posts()) {

			$company_query->the_post();

			$cover_image        = get_field('cover_image');
			$profile_picture    = get_field('profile_picture');
			$cover_image        = !empty($cover_image) ? $cover_image['url'] : $default_company_cover;
			$featured_image     = nab_amplify_get_featured_image( get_the_ID(), false );
			$profile_picture    = $featured_image;
			$company_url		= get_the_permalink();
			$company_poc		= get_field('point_of_contact');

			$result_post[$cnt]['cover_img'] = $cover_image;
			$result_post[$cnt]['link'] 		= $company_url;
			$result_post[$cnt]['title'] 	= html_entity_decode(get_the_title());

			if ( $profile_picture ) {
				$result_post[$cnt]['profile'] 	= $profile_picture;
			} else {
				$result_post[$cnt]['no_pic']	= html_entity_decode(mb_strimwidth(get_the_title(), 0, 20, '...'));
			}

			ob_start();

?>
			<div class="search-actions">
				<a href="<?php echo esc_url($company_url); ?>" class="button">View</a>
			</div>
			<?php
			if ($company_poc !== '' && !empty($company_poc)) {
				if ($user_logged_in) {
					?>
			   <div id="send-private-message" class="generic-button poc-msg-btn">
				   <a href="javascript:void(0);" class="button add" data-comp-id="<?php echo esc_attr(get_the_ID()); ?>">Message Rep</a>
			   </div>
		   <?php
				} else {
					$current_url = home_url(add_query_arg(null, null));
					$current_url = str_replace('amplify/amplify', 'amplify', $current_url); ?>
			   <div class="generic-button">
				   <a href="<?php echo esc_url(add_query_arg(array('r' => $current_url), wc_get_page_permalink('myaccount'))); ?>" class="button">Message Rep</a>
			   </div>
	   <?php
				}
			}

			$button = ob_get_clean();

			$result_post[$cnt]['button'] = $button;

			if (0 === $page_number % 2 && (5 === $cnt + 1 || 15 === $cnt + 1)) {

				$result_post[$cnt]['banner'] = nab_get_search_result_ad();
			} else if (0 !== $page_number % 2 && 10 === $cnt + 1) {

				$result_post[$cnt]['banner'] = nab_get_search_result_ad();
			}

			$cnt++;
		}
	}
	wp_reset_postdata();

	$final_result['next_page_number'] = $page_number + 1;
	$final_result['total_page']       = $total_pages;
	$final_result['total_company']	= $total_company;
	$final_result['result_post']      = $result_post;

	echo wp_json_encode($final_result);

	wp_die();
}

//Ajax for company product search.
add_action('wp_ajax_nab_company_product_search_filter', 'nab_company_product_search_filter_callback');
add_action('wp_ajax_nopriv_nab_company_product_search_filter', 'nab_company_product_search_filter_callback');

/**
 * Company product search result filter ajax.
 */
function nab_company_product_search_filter_callback()
{

	check_ajax_referer('nab-ajax-nonce', 'nabNonce');

	$final_result 	= array();
	$result_post	= array();

	$page_number		= filter_input(INPUT_POST, 'page_number', FILTER_SANITIZE_NUMBER_INT);
	$post_limit			= filter_input(INPUT_POST, 'post_limit', FILTER_SANITIZE_NUMBER_INT);
	$search_term		= filter_input(INPUT_POST, 'search_term', FILTER_SANITIZE_STRING);
	$product_category	= filter_input(INPUT_POST, 'product_category', FILTER_SANITIZE_STRING);
	$orderby			= filter_input(INPUT_POST, 'orderby', FILTER_SANITIZE_STRING);
	$order				= 'title' === $orderby ? 'ASC' : 'DESC';

	$company_prod_args = array(
		'post_type' 		=> 'company-products',
		'paged'				=> $page_number,
		'post_status'		=> 'publish',
		'posts_per_page' 	=> $post_limit,
		's'					=> $search_term
	);

	if (!empty($search_term)) {

		$category_search_array = array();

		$get_search_term_id = get_term_by('name', $search_term, 'company-product-category');

		if ($get_search_term_id) {

			$category_search_array[]	= $get_search_term_id->term_id;
		}

		$get_search_product_tag	= get_term_by('name', $search_term, 'company-product-tag');

		if ($get_search_product_tag) {

			$category_search_array[]	= $get_search_product_tag->term_id;
		}

		if (count($category_search_array) > 0) {

			$company_prod_args['_tax_search'] = $category_search_array;
		}
	}

	if (!empty($product_category)) {

		$company_prod_args['tax_query'] = array(

			array(
				'taxonomy' 	=> 'company-product-category',
				'field'		=> 'slug',
				'terms'		=> $product_category
			)
		);
	}

	if ('date' !== $orderby) {

		$company_prod_args['orderby'] = $orderby;
		$company_prod_args['order']	= $order;
	}

	$company_prod_query = new WP_Query($company_prod_args);

	$total_pages 	= $company_prod_query->max_num_pages;
	$total_products = $company_prod_query->found_posts;

	if ($company_prod_query->have_posts()) {

		$cnt 				= 0;
		$current_user_id 	= is_user_logged_in() ? get_current_user_id() : '';
		$bookmark_products	= !empty($current_user_id) ? get_user_meta($current_user_id, 'nab_customer_product_bookmark', true) : '';
		
		while ($company_prod_query->have_posts()) {
			
			$company_prod_query->the_post();
			$product_medias 	= get_field('product_media', get_the_ID());
			$thumbnail_url = '';

			if (!empty($product_medias[0]['product_media_file'])) {
				$thumbnail_url = $product_medias[0]['product_media_file']['url'];
			} else {
				$thumbnail_url =  !empty($thumbnail_url) ?  $thumbnail_url : nab_product_company_placeholder_img();
			}
			$company_id			= get_field('nab_selected_company_id', get_the_ID());
			$product_company	= !empty($company_id) ? get_the_title($company_id) : '';

			$result_post[$cnt]['thumbnail'] = $thumbnail_url;
			$result_post[$cnt]['link'] 		= get_the_permalink();
			$result_post[$cnt]['title'] 	= html_entity_decode(get_the_title());
			$result_post[$cnt]['company'] 	= $product_company;

			// bookmark product
			if (!empty($current_user_id)) {

				$product_id			= get_the_ID();
				$bookmark_class    	= 'fa fa-bookmark-o amp-bookmark user-bookmark-action';
				$bookmark_tooltip  	= 'Add to Bookmarks';

				if (!empty($bookmark_products) && is_array($bookmark_products) && in_array((string) $product_id, $bookmark_products, true)) {

					$bookmark_class     .= ' bookmark-fill';
					$bookmark_tooltip	= 'Remove from Bookmarks';
				}

				$result_post[$cnt]['bookmark_class'] 	= $bookmark_class;
				$result_post[$cnt]['bookmark_tooltip'] 	= $bookmark_tooltip;
				$result_post[$cnt]['bookmark_id']		= $product_id;
			}

			if (0 === $page_number % 2 && (5 === $cnt + 1 || 15 === $cnt + 1)) {

				$result_post[$cnt]['banner'] = nab_get_search_result_ad();
			} else if (0 !== $page_number % 2 && 10 === $cnt + 1) {

				$result_post[$cnt]['banner'] = nab_get_search_result_ad();
			}

			$cnt++;
		}
	}
	wp_reset_postdata();

	$final_result['next_page_number'] = $page_number + 1;
	$final_result['total_page']       = $total_pages;
	$final_result['total_product']	= $total_products;
	$final_result['result_post']      = $result_post;

	echo wp_json_encode($final_result);

	wp_die();
}

add_action('wp_ajax_nab_product_search_filter', 'nab_product_search_filter_callback');
add_action('wp_ajax_nopriv_nab_product_search_filter', 'nab_product_search_filter_callback');

function nab_product_search_filter_callback()
{

	check_ajax_referer('nab-ajax-nonce', 'nabNonce');

	$final_result 	= array();
	$result_post	= array();

	$page_number	= filter_input(INPUT_POST, 'page_number', FILTER_SANITIZE_NUMBER_INT);
	$post_limit		= filter_input(INPUT_POST, 'post_limit', FILTER_SANITIZE_NUMBER_INT);
	$search_term	= filter_input(INPUT_POST, 'search_term', FILTER_SANITIZE_STRING);
	$category		= filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING);
	$orderby		= filter_input(INPUT_POST, 'orderby', FILTER_SANITIZE_STRING);
	$order			= 'title' === $orderby ? 'ASC' : 'DESC';

	$product_args = array(
		'post_type' 		=> 'product',
		'paged'				=> $page_number,
		'post_status'		=> 'publish',
		'posts_per_page' 	=> $post_limit,
		's'					=> $search_term,
	);

	if ('popularity' === $orderby) {

		$product_args['meta_key'] = 'total_sales';
		$product_args['orderby'] 	= 'meta_value_num';
		$product_args['order']	= $order;
	} else if ('relevance' === $orderby) {

		$product_args['custom_order'] = 'relevance';
	} else {

		$product_args['orderby'] 	= $orderby;
		$product_args['order']	= $order;
	}

	$tax_query_args = array( 'relation' => 'AND' );

	$tax_query_args[] = array(
		'taxonomy' => 'product_visibility',
		'field'    => 'slug',
		'terms'    => array( 'exclude-from-search' ),
		'operator' => 'NOT IN',
	);

	if (!empty($category)) {

		$tax_query_args[] = array(
			'taxonomy' => 'product_cat',
			'field'    => 'slug',
			'terms'    => $category,
		);
	}

	$product_args['tax_query'] = $tax_query_args;

	$product_query = new WP_Query($product_args);

	$total_pages 	= $product_query->max_num_pages;
	$total_products = $product_query->found_posts;

	if ($product_query->have_posts()) {

		$cnt 				= 0;
		$current_user_id 	= is_user_logged_in() ? get_current_user_id() : '';
		$bookmark_products	= !empty($current_user_id) ? get_user_meta($current_user_id, 'nab_customer_product_bookmark', true) : '';

		while ($product_query->have_posts()) {

			$product_query->the_post();

			$thumbnail_url     = nab_amplify_get_featured_image( get_the_ID(), true, nab_product_company_placeholder_img() );

			$result_post[$cnt]['thumbnail'] = $thumbnail_url;
			$result_post[$cnt]['link'] 		= get_the_permalink();
			$result_post[$cnt]['title'] 	= html_entity_decode(get_the_title());

			// bookmark product
			if (!empty($current_user_id)) {

				$product_id			= get_the_ID();
				$bookmark_class    	= 'fa fa-bookmark-o amp-bookmark user-bookmark-action';
				$bookmark_tooltip  	= 'Add to Bookmarks';

				if (!empty($bookmark_products) && is_array($bookmark_products) && in_array((string) $product_id, $bookmark_products, true)) {

					$bookmark_class     .= ' bookmark-fill';
					$bookmark_tooltip	= 'Remove from Bookmarks';
				}

				$result_post[$cnt]['bookmark_class'] 	= $bookmark_class;
				$result_post[$cnt]['bookmark_tooltip'] 	= $bookmark_tooltip;
				$result_post[$cnt]['bookmark_id']		= $product_id;
			}

			if (0 === $page_number % 2 && (5 === $cnt + 1 || 15 === $cnt + 1)) {

				$result_post[$cnt]['banner'] = nab_get_search_result_ad();
			} else if (0 !== $page_number % 2 && 10 === $cnt + 1) {

				$result_post[$cnt]['banner'] = nab_get_search_result_ad();
			}

			$cnt++;
		}
	}
	wp_reset_postdata();

	$final_result['next_page_number'] = $page_number + 1;
	$final_result['total_page']       = $total_pages;
	$final_result['total_product']	= $total_products;
	$final_result['result_post']      = $result_post;

	echo wp_json_encode($final_result);

	wp_die();
}

add_action('wp_ajax_nab_event_search_filter', 'nab_event_search_filter_callback');
add_action('wp_ajax_nopriv_nab_event_search_filter', 'nab_event_search_filter_callback');

function nab_event_search_filter_callback()
{

	check_ajax_referer('nab-ajax-nonce', 'nabNonce');

	$final_result 	= array();
	$result_post	= array();

	$page_number	= filter_input(INPUT_POST, 'page_number', FILTER_SANITIZE_NUMBER_INT);
	$post_limit		= filter_input(INPUT_POST, 'post_limit', FILTER_SANITIZE_NUMBER_INT);
	$search_term	= filter_input(INPUT_POST, 'search_term', FILTER_SANITIZE_STRING);
	$event_type		= filter_input(INPUT_POST, 'event_type', FILTER_SANITIZE_STRING);

	$event_args		= array(
		'post_type'			=> 'tribe_events',
		'posts_per_page'	=> $post_limit,
		'paged'				=> $page_number,
		'post_status'		=> 'publish',
		's'					=> $search_term,
		'meta_key'			=> '_EventStartDate',
		'orderby'			=> 'meta_value',
		'order'				=> 'ASC'
	);

	if ('previous' === $event_type || 'upcoming' === $event_type) {

		$current_date   = current_time('Y-m-d');
		$compare		= 'previous' === $event_type ? '<' : '>=';

		$event_args['meta_query'] = array(

			array(
				'key' 		=> '_EventEndDate',
				'value'		=> $current_date,
				'compare'	=> $compare,
				'type'		=> 'DATE'
			)
		);
	}

	$event_query = new WP_Query($event_args);

	$total_pages 		= $event_query->max_num_pages;
	$total_event		= $event_query->found_posts;
	$current_site_url	= get_site_url();

	if ($event_query->have_posts()) {

		$cnt = 0;

		while ($event_query->have_posts()) {

			$event_query->the_post();

			$event_post_id		= get_the_ID();
			$thumbnail_url      = nab_amplify_get_featured_image( $event_post_id, true, nab_product_company_placeholder_img() );
			$event_start_date   = get_post_meta($event_post_id, '_EventStartDate', true);
			$event_end_date     = get_post_meta($event_post_id, '_EventEndDate', true);
			$website_link 		= get_post_meta(get_the_ID(), '_EventURL', true);
			$website_link		= !empty($website_link) ? trim($website_link) : get_the_permalink();
			$target				= 0 === strpos($website_link, $current_site_url) ? '_self' : '_blank';
			$event_date			= date_format(date_create($event_start_date), 'l, F j');
			$event_month		= date_format(date_create($event_start_date), 'F');
			$event_day			= date_format(date_create($event_start_date), 'j');
			$final_date         = $event_start_date;

			if (!empty($event_start_date) && !empty($event_end_date)) {

				if (date_format(date_create($event_start_date), 'Ymd') !== date_format(date_create($event_end_date), 'Ymd')) {

					$event_date .= ' - ' . date_format(date_create($event_end_date), 'l, F j');
					$final_date = $event_end_date;
				}
			}

			$final_date     = date_format( date_create( $final_date ), 'Ymd' );
			$current_date   = current_time('Ymd');
			$opening_date   = new DateTime( $final_date );
			$current_date   = new DateTime( $current_date );

			if ( $opening_date < $current_date ) {
				$result_post[$cnt]['past_event'] = true;
			}

			$result_post[$cnt]['thumbnail'] 	= $thumbnail_url;
			$result_post[$cnt]['title'] 		= html_entity_decode(get_the_title());
			$result_post[$cnt]['link']			= $website_link;
			$result_post[$cnt]['target']		= $target;
			$result_post[$cnt]['event_date']	= $event_date;
			$result_post[$cnt]['event_month']	= $event_month;
			$result_post[$cnt]['event_day'] 	= $event_day;

			if (0 === $page_number % 2 && (5 === $cnt + 1 || 15 === $cnt + 1)) {

				$result_post[$cnt]['banner'] = nab_get_search_result_ad();
			} else if (0 !== $page_number % 2 && 10 === $cnt + 1) {

				$result_post[$cnt]['banner'] = nab_get_search_result_ad();
			}

			$cnt++;
		}
	}
	wp_reset_postdata();

	$final_result['next_page_number'] 	= $page_number + 1;
	$final_result['total_page']       	= $total_pages;
	$final_result['total_event']		= $total_event;
	$final_result['result_post']      	= $result_post;

	echo wp_json_encode($final_result);

	wp_die();
}

add_action('wp_ajax_nab_content_search_filter', 'nab_content_search_filter_callback');
add_action('wp_ajax_nopriv_nab_content_search_filter', 'nab_content_search_filter_callback');

function nab_content_search_filter_callback()
{

	check_ajax_referer('nab-ajax-nonce', 'nabNonce');

	$final_result 	= array();
	$result_post	= array();

	$page_number	= filter_input(INPUT_POST, 'page_number', FILTER_SANITIZE_NUMBER_INT);
	$post_limit		= filter_input(INPUT_POST, 'post_limit', FILTER_SANITIZE_NUMBER_INT);
	$search_term	= filter_input(INPUT_POST, 'search_term', FILTER_SANITIZE_STRING);
	$orderby		= filter_input(INPUT_POST, 'orderby', FILTER_SANITIZE_STRING);
	$community		= filter_input(INPUT_POST, 'community', FILTER_SANITIZE_STRING);
	$subject		= filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
	$content_type	= filter_input(INPUT_POST, 'content_type', FILTER_SANITIZE_STRING);
	$order			= 'title' === $orderby ? 'ASC' : 'DESC';

	$all_post_types = nab_get_search_post_types();

	if ( isset( $content_type ) && ! empty ( $content_type ) ) {

		if ( 'other' === $content_type && ( $key = array_search( 'articles', $all_post_types ) ) !== false ) {
			unset( $all_post_types[ $key ] );
		} else {
			$all_post_types = $content_type;
		}
	}

	$content_args = array(
		'post_type' 		=> $all_post_types,
		'paged'				=> $page_number,
		'post_status'		=> 'publish',
		'posts_per_page' 	=> $post_limit,
		's'					=> $search_term,
	);

	if (!empty($search_term)) {
		$content_args['_meta_search'] = true;
	}

	if ('relevance' === $orderby) {

		$content_args['custom_order'] = 'relevance';
	} else {

		$content_args['orderby'] 	= $orderby;
		$content_args['order']		= $order;
	}

	$meta_query_args = array(
		'relation' => 'AND',
		array(
			'relation'	=> 'OR',
			array(
				'key'		=> '_yoast_wpseo_meta-robots-noindex',
				'value'		=> 'completely',
				'compare'	=> 'NOT EXISTS'
			),
			array(
				'key'		=> '_yoast_wpseo_meta-robots-noindex',
				'value'		=> '1',
				'compare'	=> '!='
			)
		),
	);

	if ( ! empty( $community ) ) {
		$meta_query_args[] = array(
			'key'		=> 'community',
			'value'		=> '"' . $community . '"',
			'compare'	=> 'LIKE'
		);
	}

	if ( ! empty( $subject ) ) {
		$meta_query_args[] = array(
			'key'		=> 'content_subject',
			'value'		=> '"' . $subject . '"',
			'compare'	=> 'LIKE'
		);
	}

	$content_args[ 'meta_query' ] = $meta_query_args;

	$content_query = new WP_Query($content_args);

	$total_pages 		= $content_query->max_num_pages;
	$total_content		= $content_query->found_posts;
	$current_site_url	= get_site_url();

	if ($content_query->have_posts()) {

		$cnt = 0;

		while ($content_query->have_posts()) {

			$content_query->the_post();

			$thumbnail_url  = nab_amplify_get_featured_image( get_the_ID() );

			$result_post[$cnt]['thumbnail'] = $thumbnail_url;
			$result_post[$cnt]['title'] 	= html_entity_decode(get_the_title());

			if ('tribe_events' === get_post_type()) {

				$website_link 	= get_post_meta(get_the_ID(), '_EventURL', true);
				$website_link	= !empty($website_link) ? trim($website_link) : '#';
				$target			= 0 === strpos($website_link, $current_site_url) ? '_self' : '_blank';

				$result_post[$cnt]['link']		= $website_link;
				$result_post[$cnt]['target']	= $target;
			} else {

				$result_post[$cnt]['link']	= get_the_permalink();
			}

			if (0 === $page_number % 2 && (5 === $cnt + 1 || 15 === $cnt + 1)) {

				$result_post[$cnt]['banner'] = nab_get_search_result_ad();
			} else if (0 !== $page_number % 2 && 10 === $cnt + 1) {

				$result_post[$cnt]['banner'] = nab_get_search_result_ad();
			}

			$cnt++;
		}
	}
	wp_reset_postdata();

	$final_result['next_page_number'] = $page_number + 1;
	$final_result['total_page']       = $total_pages;
	$final_result['total_content']	= $total_content;
	$final_result['result_post']      = $result_post;

	echo wp_json_encode($final_result);

	wp_die();
}

add_action('wp_ajax_nab_update_member_bookmark', 'nab_update_member_bookmark_callback');
add_action('wp_ajax_nopriv_nab_update_member_bookmark', 'nab_update_member_bookmark_callback');

function nab_update_member_bookmark_callback()
{

	check_ajax_referer('nab-ajax-nonce', 'nabNonce');

	$final_result 	= array('success' => false);

	$item_id		= filter_input(INPUT_POST, 'item_id', FILTER_SANITIZE_NUMBER_INT);
	$bm_action		= filter_input(INPUT_POST, 'bm_action', FILTER_SANITIZE_STRING);

	if (is_user_logged_in() && !empty($item_id) && !empty($bm_action)) {

		$current_user_id 	= get_current_user_id();
		$bookmark_products 	= get_user_meta($current_user_id, 'nab_customer_product_bookmark', true);

		if ('add' === strtolower($bm_action)) {

			if (!empty($bookmark_products) && is_array($bookmark_products) && !in_array($item_id, $bookmark_products, true)) {

				$bookmark_products[] 		= $item_id;
				$final_result['success']	= true;
			} else if (empty($bookmark_products)) {

				$bookmark_products 			= array($item_id);
				$final_result['success']	= true;
			}

			if ($final_result['success']) {

				update_user_meta($current_user_id, 'nab_customer_product_bookmark', $bookmark_products);

				$final_result['tooltip'] = 'Remove from Bookmarks';
				do_action( 'nab_bookmark_added', $item_id, $current_user_id );
			}
		} else if ('remove' === strtolower($bm_action)) {

			if (!empty($bookmark_products) && is_array($bookmark_products) && in_array($item_id, $bookmark_products, true)) {

				if (($key = array_search($item_id, $bookmark_products)) !== false) {

					unset($bookmark_products[$key]);

					update_user_meta($current_user_id, 'nab_customer_product_bookmark', $bookmark_products);

					$final_result['success']	= true;
					$final_result['tooltip'] 	= 'Add to Bookmarks';
				}
			}
		}
	}

	echo wp_json_encode($final_result);

	wp_die();
}

add_action('wp_ajax_nab_member_bookmark_list', 'nab_member_bookmark_list_callback');
add_action('wp_ajax_nopriv_nab_member_bookmark_list', 'nab_member_bookmark_list_callback');

function nab_member_bookmark_list_callback()
{

	check_ajax_referer('nab-ajax-nonce', 'nabNonce');

	$final_result 	= array();
	$result_post	= array();

	$page_number	= filter_input(INPUT_POST, 'page_number', FILTER_SANITIZE_NUMBER_INT);
	$post_limit		= filter_input(INPUT_POST, 'post_limit', FILTER_SANITIZE_NUMBER_INT);
	$user_id		= filter_input(INPUT_POST, 'item_id', FILTER_SANITIZE_NUMBER_INT);
	$total_pages	= 0;

	$member_bookmarks = get_user_meta($user_id, 'nab_customer_product_bookmark', true);

	if (!empty($member_bookmarks) && is_array($member_bookmarks) && count($member_bookmarks) > 0) {

		$bookmark_query_args = array(
			'post_type'         => array('product', 'company-products', 'articles'),
			'posts_per_page'    => $post_limit,
			'post_status'       => 'publish',
			'paged'				=> $page_number,
			'post__in'          => $member_bookmarks
		);

		$bookmark_query = new WP_Query($bookmark_query_args);

		$total_pages 	= $bookmark_query->max_num_pages;

		if ($bookmark_query->have_posts()) {

			$bookmark_img   = nab_placeholder_img();
			$cnt            = 0;

			while ($bookmark_query->have_posts()) {

				$bookmark_query->the_post();

				$bookmark_thumbnail = nab_amplify_get_featured_image( get_the_ID(), true, $bookmark_img );
				$bookmark_link      = get_the_permalink();
				$bookmark_title		= get_the_title();

				$result_post[$cnt]['thumbnail'] = $bookmark_thumbnail;
				$result_post[$cnt]['link'] 		= $bookmark_link;
				$result_post[$cnt]['title'] 	= html_entity_decode($bookmark_title);

				if (0 === $page_number % 2 && (5 === $cnt + 1 || 15 === $cnt + 1)) {

					$result_post[$cnt]['banner'] = nab_get_search_result_ad();
				} else if (0 !== $page_number % 2 && 10 === $cnt + 1) {

					$result_post[$cnt]['banner'] = nab_get_search_result_ad();
				}

				$cnt++;
			}
		}
		wp_reset_postdata();
	}

	$final_result['next_page_number'] = $page_number + 1;
	$final_result['total_page']       = $total_pages;
	$final_result['result_post']      = $result_post;

	echo wp_json_encode($final_result);

	wp_die();
}

add_action('wp_ajax_nab_member_event_list', 'nab_member_event_list_callback');
add_action('wp_ajax_nopriv_nab_member_event_list', 'nab_member_event_list_callback');

function nab_member_event_list_callback()
{

	check_ajax_referer('nab-ajax-nonce', 'nabNonce');

	$final_result 	= array();
	$result_post	= array();

	$page_number	= filter_input(INPUT_POST, 'page_number', FILTER_SANITIZE_NUMBER_INT);
	$post_limit		= filter_input(INPUT_POST, 'post_limit', FILTER_SANITIZE_NUMBER_INT);
	$user_id		= filter_input(INPUT_POST, 'item_id', FILTER_SANITIZE_NUMBER_INT);
	$total_pages	= 0;

	$customer_products = nab_get_customer_purchased_product($user_id);

	if (is_array($customer_products) && count($customer_products) > 0) {

		$product_ids_regex  = '"' . implode('"|"', $customer_products) . '"';
		$current_date   	= current_time('Ymd');

		$query_args = array(
			'post_type'         => 'event-shows',
			'posts_per_page'    => $post_limit,
			'paged'				=> $page_number,
			'post_status'       => 'publish',
			'meta_key'          => 'wc_pay_per_post_product_ids',
			'meta_value'        => $product_ids_regex,
			'meta_compare'      => 'REGEXP',
			'meta_query'        => array(
				array(
					'key'       => 'show_end_date',
					'value'     => $current_date,
					'compare'   => '<',
					'type'      => 'DATE'
				)
			)
		);

		$purchased_events = new WP_Query($query_args);

		$total_pages 	= $purchased_events->max_num_pages;

		if ($purchased_events->have_posts()) {

			$event_default_img  = nab_product_company_placeholder_img();
			$cnt				= 0;

			while ($purchased_events->have_posts()) {

				$purchased_events->the_post();

				$event_id	= get_the_ID();
				$event_img  = nab_amplify_get_featured_image( $event_id, true, $event_default_img );
				$event_date	= get_field('show_date', $event_id);
				$event_url	= get_field('show_url', $event_id);

				$result_post[$cnt]['thumbnail'] = $event_img;
				$result_post[$cnt]['date'] 		= $event_date;
				$result_post[$cnt]['link'] 		= $event_url;
				$result_post[$cnt]['title'] 	= html_entity_decode(get_the_title());

				if (0 === $page_number % 2 && (5 === $cnt + 1 || 15 === $cnt + 1)) {

					$result_post[$cnt]['banner'] = nab_get_search_result_ad();
				} else if (0 !== $page_number % 2 && 10 === $cnt + 1) {

					$result_post[$cnt]['banner'] = nab_get_search_result_ad();
				}

				$cnt++;
			}
		}
		wp_reset_postdata();
	}

	$final_result['next_page_number'] = $page_number + 1;
	$final_result['total_page']       = $total_pages;
	$final_result['result_post']      = $result_post;

	echo wp_json_encode($final_result);

	wp_die();
}

add_action('wp_ajax_nab_get_friend_button', 'nab_get_friend_button_callback');
add_action('wp_ajax_nopriv_nab_get_friend_button', 'nab_get_friend_button_callback');

function nab_get_friend_button_callback()
{

	check_ajax_referer('nab-ajax-nonce', 'nabNonce');

	$final_result 	= array();
	$member_id		= filter_input(INPUT_POST, 'item_id', FILTER_SANITIZE_NUMBER_INT);

	if (!empty($member_id)) {

		$final_result['success'] = true;
		$final_result['content'] = nab_amplify_bp_get_friendship_button($member_id, false);
	} else {

		$final_result['success'] = false;
		$final_result['content'] = '';
	}

	echo wp_json_encode($final_result);

	wp_die();
}

add_action('wp_ajax_nab_user_claim_company', 'nab_user_claim_company_callback');
add_action('wp_ajax_nopriv_nab_user_claim_company', 'nab_user_claim_company_callback');

function nab_user_claim_company_callback()
{

	check_ajax_referer('nab-ajax-nonce', 'nabNonce');

	$final_result	= array();
	$company_id		= filter_input(INPUT_POST, 'item_id', FILTER_SANITIZE_NUMBER_INT);
	$company_post	= get_post($company_id);

	if (is_user_logged_in() && !empty($company_post) && 'publish' === $company_post->post_status && 'company' === $company_post->post_type) {

		$final_result['success'] 	= true;
		$admin_email				= 'kvelez@nab.org';
		$current_user				= wp_get_current_user();

		$user_full_name	= $current_user->user_firstname . ' ' . $current_user->user_lastname;

		if (empty(trim($user_full_name))) {

			$user_full_name = $current_user->display_name;
		}

		$headers = "From: NAB Amplify <noreply@nabshow.com>\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

		$subject = 'User Claim ' . $company_post->post_title . ' Page';

		ob_start();
		?>
		<html>

		<body>
			<p>Hello Kiana,</p>
			<p>The following user has claimed the <a href="<?php echo esc_url(get_the_permalink($company_post->ID)); ?>"><?php echo esc_html($company_post->post_title); ?></a> Page.</p>
			<table>
				<tr>
					<th>User Name:</th>
					<td><?php echo esc_html($user_full_name); ?></td>
				</tr>
				<tr>
					<th>User Email:</th>
					<td><?php echo esc_html($current_user->user_email); ?></td>
				</tr>
			</table>
		</body>

		</html>
<?php

		$message = ob_get_clean();

		wp_mail($admin_email, $subject, $message, $headers);
	} else {

		$final_result['success'] = false;
	}

	echo wp_json_encode($final_result);

	wp_die();
}

// Ajax to show Message request popup.
add_action("wp_ajax_nab_bp_message_request_popup", "nab_bp_message_request_popup");
add_action("wp_ajax_nopriv_nab_bp_message_request_popup", "nab_bp_message_request_popup");

/**
 * Ajax to show Message request popup.
 */
function nab_bp_message_request_popup()
{

	ob_start();

	$company_id = filter_input(INPUT_POST, 'company_id', FILTER_SANITIZE_NUMBER_INT);
	$post_type = filter_input(INPUT_POST, 'post_type', FILTER_SANITIZE_STRING);
	$post_id = filter_input(INPUT_POST, 'post_id', FILTER_SANITIZE_NUMBER_INT);
	$member_id = filter_input(INPUT_POST, 'member_id', FILTER_SANITIZE_NUMBER_INT);
	$action = 'poc';
	$message_html = nab_get_wp_editor('', 'nab-xconnection-message', array('media_buttons' => true,'teeny' => true, 'quicktags' => false, 'tinymce' => array('toolbar1' => 'bold,italic,strikethrough,bullist,numlist,blockquote,hr,alignleft,aligncenter,alignright,link,unlink', 'content_css' => get_template_directory_uri() . '/assets/css/nab-front-tinymce.css')));

	if ($post_type === 'company-products') {
		$point_of_contact   = get_field('product_point_of_contact', $post_id);
	} else {
		$point_of_contact   = get_field('point_of_contact', $company_id);
	}

	if ($member_id) {
		$point_of_contact = $member_id;
		$action = 'mmu';
	}

	$user_fullname = nab_get_author_fullname($point_of_contact);


	$user_images = nab_amplify_get_user_images($point_of_contact);

	$user_job_title = get_user_meta($point_of_contact, 'attendee_title', true);


	require_once get_template_directory() . '/inc/nab-message-popup.php';

	$popup_html = ob_get_clean();

	wp_send_json($popup_html, 200);

	wp_die();
}


// Ajax to show connection request popup.
add_action("wp_ajax_nab_bp_send_message", "nab_bp_send_message");
add_action("wp_ajax_nopriv_nab_bp_send_message", "nab_bp_send_message");

/**
 * Ajax to send message.
 */
function nab_bp_send_message()
{
	global $bp;
	check_ajax_referer('nab-ajax-nonce', 'nabNonce');

	$post_id = filter_input(INPUT_POST, 'post_id', FILTER_SANITIZE_STRING);
	$message = filter_input(INPUT_POST, 'message', FILTER_UNSAFE_RAW);
	$recipient  = filter_input(INPUT_POST, 'send_to', FILTER_SANITIZE_STRING);
	$subject = 'Private message';
	$current_user_id = get_current_user_id();


	$response = array(
		'feedback' => __('Your message could not be sent. Please try again.', 'buddypress'),
		'type'     => 'error',
	);



	// Validate subject and message content
	if (empty($message)) {

		$response['feedback'] = __('Your message was not sent. Please enter some content.', 'buddypress');
		wp_send_json_error($response);
	}

	// Validate subject and message content
	if (empty($current_user_id)) {

		$response['feedback'] = __('Please login to send a message', 'buddypress');
		wp_send_json_error($response);
	}


	// Attempt to send the message.
	$send = messages_new_message(array(
		'recipients' => $recipient,
		'sender_id' => $current_user_id,
		'subject'    => $subject,
		'content'    => $message,
		'error_type' => 'wp_error',
	));

	// Send the message.
	if (true === is_int($send)) {
		if ( isset( $post_id ) && ! empty( $post_id ) ) {
			do_action( 'nab_message_send', $recipient, $current_user_id, $post_id );
		}
		wp_send_json_success(array(
			'feedback' => __('Message successfully sent.', 'buddypress'),
			'type'     => 'success',
		));

		// Message could not be sent.
	} else {
		$response['feedback'] = $send->get_error_message();

		wp_send_json_error($response);
	}
}

// Ajax to show featured block request popup.
add_action("wp_ajax_nab_edit_feature_block_popup", "nab_edit_feature_block_popup");
add_action("wp_ajax_nopriv_nab_edit_feature_block_popup", "nab_edit_feature_block_popup");

function nab_edit_feature_block_popup()
{

	$company_id      = filter_input(INPUT_POST, 'company_id', FILTER_SANITIZE_NUMBER_INT);
	$block_data = array();
	$block_data['company_id'] = $company_id;
	$block_data['bg_image'] = get_field('feature_background_image', $company_id);
	$block_data['play_image'] = get_field('feature_icon_image', $company_id);
	$block_data['headline'] =  get_field('feature_status', $company_id) ?  get_field('feature_status', $company_id) : '';
	$block_data['title'] =  get_field('feature_title', $company_id) ?  get_field('feature_title', $company_id) : '';
	$block_data['author'] = get_field('feature_author', $company_id) ? get_field('feature_author', $company_id) : '';
	$block_data['description'] = get_field('feature_desc', $company_id) ? get_field('feature_desc', $company_id) : '';
	$block_data['button_label'] = get_field('feature_button_text', $company_id) ?  get_field('feature_button_text', $company_id) : '';
	$block_data['button_link'] = get_field('feature_button_url', $company_id) ? get_field('feature_button_url', $company_id) : '';
	$block_data['bg_color'] = get_field('feature_bg_color', $company_id) ? get_field('feature_bg_color', $company_id) : '';
	$block_data['title_color'] = get_field('feature_title_color', $company_id) ? get_field('feature_title_color', $company_id) : '';
	$block_data['status_color'] = get_field('feature_status_color', $company_id) ? get_field('feature_status_color', $company_id) : '';
	$block_data['author_color'] = get_field('feature_author_color', $company_id) ? get_field('feature_author_color', $company_id) : '';
	$block_data['desc_color'] = get_field('feature_description_color', $company_id) ? get_field('feature_description_color', $company_id) : '';
	$block_data['play_link'] = get_field('feature_play_link', $company_id) ? get_field('feature_play_link', $company_id) : '';
	$block_data['reactions'] = get_field('feature_enable_reaction', $company_id) ? get_field('feature_enable_reaction', $company_id) : '0';
	$block_data['button'] = get_field('feature_enable_button', $company_id) ? get_field('feature_enable_button', $company_id) : '0';
	$block_data['button_target'] = get_field('feature_button_target', $company_id) ? get_field('feature_button_target', $company_id) : '0';





	require_once get_template_directory() . '/inc/nab-edit-feature-block.php';


	wp_die();
}


add_action("wp_ajax_nab_edit_feature_block", "nab_edit_feature_block");
add_action("wp_ajax_nopriv_nab_edit_feature_block", "nab_edit_feature_block");

function nab_edit_feature_block()
{
	$response = array();
	$company_id      = filter_input(INPUT_POST, 'company_id', FILTER_SANITIZE_NUMBER_INT);
	$company_admins = get_field('company_user_id', $company_id);
	$current_logged_user = get_current_user_id();
	$nab_featured_block_headline       = 'Featured';
	$nab_featured_block_title       = strip_tags(filter_input(INPUT_POST, 'nab_featured_block_title', FILTER_SANITIZE_STRING));
	$nab_featured_block_posted_by       = strip_tags(filter_input(INPUT_POST, 'nab_featured_block_posted_by', FILTER_SANITIZE_STRING));
	$nab_featured_block_description       = strip_tags(filter_input(INPUT_POST, 'nab_featured_block_description', FILTER_SANITIZE_STRING));
	$nab_featured_block_button_label       = strip_tags(filter_input(INPUT_POST, 'nab_featured_block_button_label', FILTER_SANITIZE_STRING));
	$nab_featured_block_button_link      = strip_tags(filter_input(INPUT_POST, 'nab_featured_block_button_link', FILTER_SANITIZE_STRING));
	$nab_featured_bg_color      = '#000000';
	$nab_featured_status_color      = '#e5018b';
	$nab_featured_title_color      = '#ffffff';
	$nab_featured_author_color      = '#fdd80f';
	$nab_featured_desc_color      = '#ffffff';
	$nab_featured_block_play_link      = '';
	$nab_feature_block_reaction      = 1;
	$nab_feature_block_button      = 1;
	$nab_feature_block_link_target      = 1;
	$nab_featured_block_remove_attachment = explode(',', filter_input(INPUT_POST, 'nab_featured_block_remove_attachment', FILTER_SANITIZE_STRING));
	/*Check if current user is company admin */
	if (get_post_type($company_id) == 'company' && !in_array($current_logged_user, $company_admins)) {
		$response['feedback'] = 'Sorry! You dont have permission!';
		wp_send_json_error($response);
	}

	$existing_title = get_field( 'feature_title', $company_id );
	if ( empty( $existing_title ) && ! empty( $nab_featured_block_title ) ) {
		do_action( 'nab_featured_block_added', $company_id, $nab_featured_block_title );
	}

	update_field('feature_status', $nab_featured_block_headline, $company_id);
	update_field('feature_title', $nab_featured_block_title, $company_id);
	update_field('feature_author', $nab_featured_block_posted_by, $company_id);
	update_field('feature_desc', $nab_featured_block_description, $company_id);
	update_field('feature_button_text', $nab_featured_block_button_label, $company_id);
	update_field('feature_button_url', $nab_featured_block_button_link, $company_id);
	update_field('feature_status_color', $nab_featured_status_color, $company_id);
	update_field('feature_title_color', $nab_featured_title_color, $company_id);
	update_field('feature_author_color', $nab_featured_author_color, $company_id);
	update_field('feature_description_color', $nab_featured_desc_color, $company_id);
	update_field('feature_bg_color', $nab_featured_bg_color, $company_id);
	update_field('feature_play_link', $nab_featured_block_play_link, $company_id);
	update_field('feature_enable_reaction', $nab_feature_block_reaction, $company_id);
	update_field('feature_enable_button', $nab_feature_block_button, $company_id);
	update_field('feature_button_target', $nab_feature_block_link_target, $company_id);

	if (!empty($nab_featured_block_remove_attachment)) {
		if (in_array('play_image', $nab_featured_block_remove_attachment)) {
			update_field('feature_icon_image', 0, $company_id);
		}
		if (in_array('bg_image', $nab_featured_block_remove_attachment)) {
			update_field('feature_background_image', 0, $company_id);
		}
	}

	$dependencies_loaded = 0;
	foreach ($_FILES as $file_key => $file_details) {

		if (0 === $dependencies_loaded) {
			// These files need to be included as dependencies when on the front end.
			require_once ABSPATH . 'wp-admin/includes/image.php';
			require_once ABSPATH . 'wp-admin/includes/file.php';
			require_once ABSPATH . 'wp-admin/includes/media.php';
			$dependencies_loaded = 1;
		}

		// Let WordPress handle the upload.
		$attachment_id = media_handle_upload($file_key, 0);

		if (!is_wp_error($attachment_id)) {
			// update in meta
			if ($file_key === 'nab_product_play_image') {
				update_field('feature_icon_image', $attachment_id, $company_id);
			} else {
				update_field('feature_background_image', $attachment_id, $company_id);
			}
		}
	}




	wp_send_json_success(array(
		'feedback' => __('Featured Block Updated!', 'buddypress'),
		'type'     => 'success',
	));






	wp_die();
}

function replace_between($str, $needle_start, $needle_end, $replacement)
{
	$pos = strpos($str, $needle_start);
	$start = $pos === false ? 0 : $pos + strlen($needle_start);

	$pos = strpos($str, $needle_end, $start);
	$end = $start === false ? strlen($str) : $pos;

	return substr_replace($str, $replacement,  $start, $end - $start);
}

// Ajax for get city for search page filter
add_action( 'wp_ajax_nab_get_search_city', 'nab_get_search_city_callback' );
add_action( 'wp_ajax_nopriv_nab_get_search_city', 'nab_get_search_city_callback' );

function nab_get_search_city_callback() {

	$search_key	= filter_input( INPUT_GET, 'q', FILTER_SANITIZE_STRING );
	$country	= filter_input( INPUT_GET, 'country', FILTER_SANITIZE_STRING );
	$state		= filter_input( INPUT_GET, 'state', FILTER_SANITIZE_STRING );

	$final_result	= [];

	if ( isset( $search_key ) && ! empty( $search_key ) ) {

		$user_args	= array( 'fields' => 'ID' );

		$meta_query_args = array( 'relation' => 'AND' );

		$meta_query_args[] = array(
			'key' => 'user_city',
			'value' => $search_key,
			'compare' => 'LIKE'
		);

		if ( ! empty( $country ) || ! empty( $state ) ) {

			if ( ! empty( $country ) ) {

				$meta_query_args[] = array(
					'key' => 'user_country',
					'value' => $country
				);
			}

			if ( ! empty( $state ) ) {

				$meta_query_args[] = array(
					'key' => 'user_state',
					'value' => $state
				);
			}
		}

		$user_args[ 'meta_query' ] = $meta_query_args;

		$user_query		= new WP_User_Query( $user_args );
		$found_users	= $user_query->get_results();

		if ( ! empty( $found_users ) && is_array( $found_users ) ) {

			foreach ( $found_users as $current_user_id ) {

				$user_city = get_user_meta( $current_user_id, 'user_city', true );


				if ( ! empty( $user_city ) && ! in_array( $user_city, $final_result, true ) ) {
					$final_result[] = $user_city;
				}
			}
		}
	}

	echo wp_json_encode( $final_result );

	wp_die();

}

// Ajax for get user for product point of contact
add_action('wp_ajax_nab_product_point_of_contact', 'nab_product_point_of_contact_callback');
add_action('wp_ajax_nopriv_nab_product_point_of_contact', 'nab_product_point_of_contact_callback');

function nab_product_point_of_contact_callback()
{

	$search_key 	= filter_input(INPUT_GET, 'q', FILTER_SANITIZE_STRING);
	$final_result	= [];

	if (isset($search_key) && !empty($search_key)) {

		$search_key		= '*' . $search_key . '*';
		$user_query		= new WP_User_Query(array('search' => $search_key));
		$found_users	= $user_query->get_results();

		if (!empty($found_users)) {

			foreach ($found_users as $current_user) {

				$user_name		= $current_user->user_login;
				$user_full_name	= get_user_meta($current_user->ID, 'first_name', true) . ' ' . get_user_meta($current_user->ID, 'last_name', true);

				if (!empty(trim($user_full_name))) {
					$user_name .= ' (' . $user_full_name . ')';
				}

				$final_result[] = array($current_user->ID, $user_name);
			}
		}
	}

	echo wp_json_encode($final_result);
	wp_die();
}

// Ajax to show company admin added popup.
add_action("wp_ajax_nab_add_company_admin_popup", "nab_add_company_admin_popup");
add_action("wp_ajax_nopriv_nab_add_company_admin_popup", "nab_add_company_admin_popup");

/**
 * Ajax to show connection request popup.
 */
function nab_add_company_admin_popup()
{


	$company_id      = filter_input(INPUT_POST, 'company_id', FILTER_SANITIZE_NUMBER_INT);
	$company_title   = get_the_title($company_id);

	ob_start();

	require_once get_template_directory() . '/inc/nab-company-admin-url-popup.php';

	$popup_html = ob_get_clean();

	wp_send_json($popup_html, 200);

	wp_die();
}

add_action('wp_ajax_upload_temp_csv', 'upload_temp_csv');
add_action('wp_ajax_nopriv_upload_temp_csv', 'upload_temp_csv');

function upload_temp_csv()
{

	$temp = get_temp_dir();

	$upload_dir = wp_get_upload_dir()['basedir'];

	wp_mkdir_p($upload_dir . '/csv_import/');

	$file_path = $upload_dir . '/csv_import/nab_import_company.csv';

	$csv_content = file_get_contents($_FILES[0]['tmp_name']);

	file_put_contents($file_path, $csv_content);

	if (isset($_FILES[0]['name'])) {

		if (0 < $_FILES[0]['error']) {
			wp_send_json_success(array(
				'feedback' => __('Error during file upload' . $_FILES[0]['error'], 'buddypress'),
				'type'     => 'error',
			));
		} else {

			wp_send_json_success(array(
				'feedback' => __('File successfully uploaded', 'buddypress'),
				'type'     => 'success',
			));
		}
	}
	exit;
}

if (class_exists('WP_Batch')) {

	/**
	 * Class MY_Example_Batch
	 */
	class NAB_Company_Import_Batch_ajax extends WP_Batch
	{



		/**
		 * Unique identifier of each batch
		 * @var string
		 */
		public $id = 'nab_import_companies_ajax';


		/**
		 * Describe the batch
		 * @var string
		 */
		public $title = 'Import Companies';

		/**
		 * To setup the batch data use the push() method to add WP_Batch_Item instances to the queue.
		 *
		 * Note: If the operation of obtaining data is expensive, cache it to avoid slowdowns.
		 *
		 * @return void
		 */
		public function setup()
		{


			$upload_dir = wp_get_upload_dir()['basedir'];

			$csv_path = $upload_dir . '/csv_import/nab_import_company.csv';

			if (file_exists($csv_path)) {


				// Add the CSV data in the processing queue
				$rows   = array_map('str_getcsv', file($csv_path));

				$input_file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($csv_path);

				$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($input_file_type);

				/**  Advise the Reader that we only want to load cell data  **/
				$reader->setReadDataOnly(true);

				$reader->setReadEmptyCells(false);

				$spreadsheet = $reader->load($csv_path);

				$sheet_data    = $spreadsheet->getActiveSheet()->toArray();



				// Loop over the data and add every row to the queue
				foreach ($sheet_data as $key => $row) {
					if ($key !== 0) {
						$row_data = array(
							'item_no' => $key,
							'title' => $row[0],
							'content' => $row[1],
							'about' => $row[2],
							'featured_cat' => $row[3],
							'street_line_1' => $row[4],
							'street_line_2' => $row[5],
							'street_line_3' => $row[6],
							'city' => $row[7],
							'state' => $row[8],
							'zip' => $row[9],
							'country' => $row[10],
							'website' => $row[14],
							'member_level' => $row[11],
							'tagline' => $row[12],
							'salesforce' => $row[13],
							'website' => $row[14],
							'instagram' => $row[15],
							'linkedin' => $row[16],
							'facebook' => $row[17],
							'twitter' => $row[18],
							'youtube' => $row[19],


						);
						$unique_id  = md5($row[0]);
						$this->push(new WP_Batch_Item($unique_id, $row_data));
					}
				}
			}
		}

		/**
		 * Handles processing of batch item. One at a time.
		 *
		 * In order to work it correctly you must return values as follows:
		 *
		 * - TRUE - If the item was processed successfully.
		 * - WP_Error instance - If there was an error. Add message to display it in the admin area.
		 *
		 * @param WP_Batch_Item $item
		 *
		 * @return bool|\WP_Error
		 */
		public function process($item)
		{

			// get post data
			$item_no = $item->get_value('item_no');
			$title = $item->get_value('title');
			$content = $item->get_value('content');
			$about = $item->get_value('about');
			$featured_cat = explode(',', $item->get_value('featured_cat'));
			$street_line_1 = $item->get_value('street_line_1');
			$street_line_2 = $item->get_value('street_line_2');
			$street_line_3 = $item->get_value('street_line_3');
			$city = $item->get_value('city');
			$state_province = $item->get_value('state');
			$zip_Postal = $item->get_value('zip');
			$country = $item->get_value('country');
			$website = $item->get_value('website');
			$member_level_check = strtolower($item->get_value('member_level'));
			$member_level = $item->get_value('member_level');
			$company_Tagline = $item->get_value('tagline');
			$salesforce_ID = $item->get_value('salesforce');
			$website_URl = $item->get_value('website');
			$instagram_URl = $item->get_value('instagram');
			$linkedin_URl = $item->get_value('linkedin');
			$facebook_URl = $item->get_value('facebook');
			$twitter_URl = $item->get_value('twitter');
			$youtube_URl = $item->get_value('youtube');

			// Create post object
			$post_data = array(
				'post_title'    => $title,
				'post_content'  => $content,
				'post_status'   => 'publish',
				'post_type' => 'company'
			);

			$fount_post = post_exists($title, '', '', '');

			// Return WP_Error if the item processing failed (In our case we simply skip author with user id 5)
			if ($fount_post) {
				return new WP_Error(302, $title . " Post already exists!");
			}
			if (empty($title)) {
				return new WP_Error(302, "Title/data not provided for item number so skipped item " . $item_no);
			}
			// Insert the post into the database
			$import_post_id = wp_insert_post($post_data);
			if (!is_wp_error($import_post_id)) {

				// Import the featured product categories

				$import_featured_cat = [];

				$num_member_level_array = array(
					'standard'  => 1,
					'plus'      => 2,
					'premium'   => 3,
				);

				foreach ($featured_cat as $cat) {

					$term = term_exists($cat, 'company-product-category');

					if ($term == 0 && $term == null) {
						$term = wp_insert_term(
							$cat,   // the term
							'company-product-category' // the taxonomy
						);
						if (!is_wp_error($term)) {
							$import_featured_cat[] = $term['term_id'];
						}
					} else {
						$import_featured_cat[] = $term['term_id'];
					}
				}

				if (!empty($import_featured_cat)) {

					$this->import_meta('product_categories', $import_featured_cat, $import_post_id);
				}


				$this->import_meta('about_company', $about, $import_post_id);


				$field_key = 'field_5fa3e84f3fa46';
				$values = array(
					'_street_line_1'    =>   $street_line_1,
					'street_line_2' =>   $street_line_2,
					'street_line_3' =>   $street_line_3,
					'city' =>   $city,
					'state' =>   $state_province,
					'zipcode' =>   $zip_Postal,
					'country' =>   $country,
				);
				$this->import_meta($field_key, $values, $import_post_id);
				$this->import_meta('company_website', $website, $import_post_id);

				$num_member_level   = isset($num_member_level_array[$member_level_check]) ? $num_member_level_array[$member_level_check] : 0;
				update_post_meta($import_post_id, 'member_level_num', $num_member_level);

				if (!empty($member_level)) {
					$this->import_meta('admin_can_add_product', 1, $import_post_id);
				}
				$this->import_meta('member_level', $member_level, $import_post_id);
				$this->import_meta('company_industary', $company_Tagline, $import_post_id);
				$this->import_meta('salesforce_id', $salesforce_ID, $import_post_id);
				$this->import_meta('company_website', $website_URl, $import_post_id);
				$this->import_meta('instagram_url', $instagram_URl, $import_post_id);
				$this->import_meta('linkedin_url', $linkedin_URl, $import_post_id);
				$this->import_meta('facebook_url', $facebook_URl, $import_post_id);
				$this->import_meta('twitter_url', $twitter_URl, $import_post_id);
				$this->import_meta('youtube_url', $youtube_URl, $import_post_id);

				$random_string = generate_add_admin_string();
				$this->import_meta('admin_add_string', $random_string, $import_post_id);
			} else {
				$error_code = array_key_first($import_post_id->errors);
				$error_message = $import_post_id->errors[$error_code][0];
				return new WP_Error(302, $error_message);
			}

			// Return true if the item processing is successful.
			return true;
		}

		/**
		 * Called when specific process is finished (all items were processed).
		 * This method can be overriden in the process class.
		 * @return void
		 */
		public function finish()
		{
			// Do something after process is finished.
			// You have $this->items, etc.
			delete_transient('nab_import_csv');
		}

		/* Common function for update custom fields */

		private function import_meta($key, $value, $post_id)
		{
			if (!empty($value)) {
				if (update_field($key, $value, $post_id)) {
					return true;
				} else {
					return new WP_Error(302, 'Error Importing meta' . $key . ' for ' . $post_id);
				}
			} else {
				return new WP_Error(302, 'Meta' . $key . 'not provided for ' . $post_id);
			}
		}
	}
}

// Ajax to show company admin added popup.
add_action("wp_ajax_nab_reset_csv_processed", "nab_reset_csv_processed");
add_action("wp_ajax_nopriv_nab_reset_csv_processed", "nab_reset_csv_processed");

/**
 * Ajax to show connection request popup.
 */
function nab_reset_csv_processed()
{
	delete_option('batch_nab_import_companies_ajax_processed');
	wp_send_json('success', 200);
}

// Ajax to show Error popup.
add_action("wp_ajax_nab_get_error_popup", "nab_get_error_popup");
add_action("wp_ajax_nopriv_nab_get_error_popup", "nab_get_error_popup");

function nab_get_error_popup(){
	$message      = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);
	$confirm      = filter_input(INPUT_POST, 'confirm', FILTER_SANITIZE_NUMBER_INT);
	$address_id   = filter_input(INPUT_POST, 'address_id', FILTER_SANITIZE_NUMBER_INT);
	ob_start();

	require_once get_template_directory() . '/inc/nab-error-popup.php';

	$popup_html = ob_get_clean();

	wp_send_json($popup_html, 200);

	wp_die();
}

// Ajax to show Add Address popup.
add_action("wp_ajax_nab_amplify_add_address", "nab_amplify_add_address");
add_action("wp_ajax_nopriv_nab_amplify_add_address", "nab_amplify_add_address");

/**
 * Ajax to show address popup.
 */
function nab_amplify_add_address()
{


	$company_id      = filter_input(INPUT_POST, 'company_id', FILTER_SANITIZE_NUMBER_INT);
	$address_id      = filter_input(INPUT_POST, 'address_id', FILTER_SANITIZE_NUMBER_INT);

	$address_number = array(
		'1' => 'one',
		'2' => 'two',
		'3' => 'three',
		'4' => 'four'
	);
	$address_data = get_field('regional_address_' . $address_number[$address_id], $company_id);
	$country_list = nab_get_countries();

	ob_start();

	require_once get_template_directory() . '/inc/nab-company-religion-addresses-popup.php';

	$popup_html = ob_get_clean();

	wp_send_json($popup_html, 200);

	wp_die();

}

/*Update regional addresses */
add_action('wp_ajax_nab_amplify_submit_address', 'nab_amplify_submit_address');
add_action('wp_ajax_nopriv_nab_amplify_submit_address', 'nab_amplify_submit_address');

function nab_amplify_submit_address()
{
	$company_id      = filter_input(INPUT_POST, 'company_id', FILTER_SANITIZE_NUMBER_INT);
	$address_id      = filter_input(INPUT_POST, 'address_id', FILTER_SANITIZE_NUMBER_INT);
	$street_line_1      = filter_input(INPUT_POST, 'street_line_1', FILTER_SANITIZE_STRING);
	$street_line_2      = filter_input(INPUT_POST, 'street_line_2', FILTER_SANITIZE_STRING);
	$city      = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
	$state      = filter_input(INPUT_POST, 'state', FILTER_SANITIZE_STRING);
	$country      = filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING);
	$zip      = filter_input(INPUT_POST, 'zip', FILTER_SANITIZE_STRING);

	switch ($address_id) {
		case "1":
			$field_key = 'regional_address_one';
			$values = array(
				'street_line_1'    =>   $street_line_1,
				'street_line_2_' =>   $street_line_2,
				'city' =>   $city,
				'state_province' =>   $state,
				'zip_postal' =>   $zip,
				'country' =>   $country,
			);
			update_field($field_key, $values, $company_id);
			$final_result['success'] = true;
			$final_result['content'] = '';
			break;
		case "2":
			$field_key = 'regional_address_two';
			$values = array(
				'street_line_1'    =>   $street_line_1,
				'street_line_2_' =>   $street_line_2,
				'city' =>   $city,
				'state_province' =>   $state,
				'zip_postal' =>   $zip,
				'country' =>   $country,
			);
			update_field($field_key, $values, $company_id);
			$final_result['success'] = true;
			$final_result['content'] = '';
			break;
		case "3":
			$field_key = 'regional_address_three';
			$values = array(
				'street_line_1'    =>   $street_line_1,
				'street_line_2_' =>   $street_line_2,
				'city' =>   $city,
				'state_province' =>   $state,
				'zip_postal' =>   $zip,
				'country' =>   $country,
			);
			update_field($field_key, $values, $company_id);
			$final_result['success'] = true;
			$final_result['content'] = '';
			break;
		case "4":
			$field_key = 'regional_address_four';
			$values = array(
				'street_line_1'    =>   $street_line_1,
				'street_line_2_' =>   $street_line_2,
				'city' =>   $city,
				'state_province' =>   $state,
				'zip_postal' =>   $zip,
				'country' =>   $country,
			);
			update_field($field_key, $values, $company_id);
			$final_result['success'] = true;
			$final_result['content'] = '';
			break;
		default:
			$final_result['success'] = false;
			$final_result['content'] = '';


	}

	echo wp_json_encode($final_result);
	wp_die();
}

/* Remove regional addresses */

add_action('wp_ajax_nab_amplify_remove_address', 'nab_amplify_remove_address');
add_action('wp_ajax_nopriv_nab_amplify_remove_address', 'nab_amplify_remove_address');

function nab_amplify_remove_address(){
	$company_id      = filter_input(INPUT_POST, 'company_id', FILTER_SANITIZE_NUMBER_INT);
	$address_id      = filter_input(INPUT_POST, 'address_id', FILTER_SANITIZE_NUMBER_INT);

	switch ($address_id) {
		case "1":
			$field_key = 'regional_address_one';
			$values = array(
				'street_line_1'    =>   '',
				'street_line_2_' =>   '',
				'city' =>   '',
				'state_province' =>  '',
				'zip_postal' =>  '',
				'country' =>   '',
			);
			update_field($field_key, $values, $company_id);
			$final_result['success'] = true;
			$final_result['content'] = '';
			break;
		case "2":
			$field_key = 'regional_address_two';
			$values = array(
				'street_line_1'    =>   '',
				'street_line_2_' =>   '',
				'city' =>   '',
				'state_province' =>   '',
				'zip_postal' =>   '',
				'country' =>   '',
			);
			update_field($field_key, $values, $company_id);
			$final_result['success'] = true;
			$final_result['content'] = '';
			break;
		case "3":
			$field_key = 'regional_address_three';
			$values = array(
				'street_line_1'    =>   '',
				'street_line_2_' =>   '',
				'city' =>   '',
				'state_province' =>   '',
				'zip_postal' =>   '',
				'country' =>   '',
			);
			update_field($field_key, $values, $company_id);
			$final_result['success'] = true;
			$final_result['content'] = '';
			break;
		case "4":
			$field_key = 'regional_address_four';
			$values = array(
				'street_line_1'    =>   '',
				'street_line_2_' =>   '',
				'city' =>   '',
				'state_province' =>   '',
				'zip_postal' =>   '',
				'country' =>   '',
			);
			update_field($field_key, $values, $company_id);
			$final_result['success'] = true;
			$final_result['content'] = '';
			break;
		default:
			$final_result['success'] = false;
			$final_result['content'] = '';


	}

	wp_send_json($final_result, 200);
	wp_die();
}



// Ajax to show Add Address popup.
add_action("wp_ajax_nab_amplify_state_filter", "nab_amplify_state_filter");
add_action("wp_ajax_nopriv_nab_amplify_state_filter", "nab_amplify_state_filter");

function nab_amplify_state_filter(){

	$company_id      = filter_input(INPUT_POST, 'company_id', FILTER_SANITIZE_NUMBER_INT);
	$address_id      = filter_input(INPUT_POST, 'address_id', FILTER_SANITIZE_NUMBER_INT);
    $country_code    = filter_input(INPUT_POST, 'country_code', FILTER_SANITIZE_STRING);
	$filtered_states = array();
	$states          = nab_get_states();


	foreach($states as $state){

		if($state['Country'] == $country_code){

			$filtered_states[] = $state;
		}
	}

	wp_send_json($filtered_states, 200);

}