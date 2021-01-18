<?php

/**
 * Redirect after registration
 *
 * @return string
 */
function nab_registration_redirect()
{

	if (isset($_POST['checkout_redirect']) && !empty(isset($_POST['checkout_redirect']))) {

		$checkout_url = $_POST['checkout_redirect'];

		$args         = array(
			'nab_registration_complete' => 'true',
			'r'                         => $checkout_url,
		);
		$redirect_url = $checkout_url;
	} else {
		$args         = array(
			'nab_registration_complete' => 'true',
		);
		$redirect_url = wc_get_page_permalink('shop');
	}

	return $redirect_url;
}

/**
 * Remove WooCommerce privacy policy text on registration
 *
 * @param $text
 * @param $type
 *
 * @return string
 */
function nab_remove_privacy_policy_text($text, $type)
{
	if ('registration' === $type) {
		$text = '';
	}

	return $text;
}

/**
 * Remove mandatory fields validation
 *
 * @param $address_fields
 *
 * @return mixed
 */
function nab_customising_checkout_fields($address_fields)
{
	// Only on checkout page
	if (!is_checkout()) {
		return $address_fields;
	}

	// All field keys in this array
	$key_fields = array('company', 'address_2');

	// Loop through each address fields (billing and shipping)
	foreach ($key_fields as $key_field) {
		$address_fields[$key_field]['required'] = false;
	}

	$address_fields['address_1']['label']   = 'Billing Address';
	$address_fields['city']['label']        = 'City';
	$address_fields['country']['label']     = 'Country';
	$address_fields['country']['priority']  = 79;
	$address_fields['postcode']['label']    = 'Zip Code';
	$address_fields['postcode']['priority'] = 71;

	return $address_fields;
}

/**
 * Remove mandatory fields validation
 *
 * @param array $billing_fields Billing fields.
 *
 * @return mixed
 */
function nab_custom_billing_fields($billing_fields)
{

	// Only on checkout page
	if (!is_checkout()) {
		return $billing_fields;
	}

	$billing_fields['billing_phone']['required']     = false;
	$billing_fields['billing_postcode']['label']     = 'Zip Code';
	$billing_fields['billing_first_name']['label']   = 'First Name';
	$billing_fields['billing_first_name']['class'][] = 'bill-mandatory';

	$billing_fields['billing_last_name']['label']   = 'Last Name';
	$billing_fields['billing_last_name']['class'][] = 'bill-mandatory';

	$billing_fields['billing_email']['label']   = 'Email the confirmation:';
	$billing_fields['billing_email']['class'][] = 'text-transform-initial bill-mandatory';

	unset($billing_fields['billing_phone']);

	return $billing_fields;
}

/**
 * Orders page sorting
 *
 * @param array $args Orders query arguments.
 *
 * @return array
 */
function nab_my_account_orders_query_change_sorting($args)
{

	if (isset($_GET['orderby']) && ('order-total' === $_GET['orderby'] || 'order-date' === $_GET['orderby'])) {
		if ('order-date' === $_GET['orderby']) {
			$args['orderby'] = 'date';
		} else {
			$args = array_merge($args, array(
				'meta_key' => '_order_total',
				'orderby'  => 'meta_value_num',
			));
		}
	}

	if (isset($_GET['order']) && ('asc' === $_GET['order'] || 'desc' === $_GET['order'])) {
		$args['order'] = sanitize_text_field($_GET['order']);
	}

	return $args;
}

/**
 * Remove status column from order listing
 *
 * @param $columns
 *
 * @return mixed
 */
function nab_my_orders_columns($columns)
{
	unset($columns['order-status']);

	return $columns;
}

/**
 * Filter for Avatar HTML.
 *
 * @param string $avatar_html Avatar HTML.
 * @param mixed $id_or_email ID or email address.
 * @param $size
 * @param $default
 * @param $alt
 *
 * @return string Filtered Avatar HTML.
 */
function filter_nab_amplify_user_avtar($avatar_html, $id_or_email, $size, $default, $alt)
{

	if (!is_int($id_or_email)) {

		if (is_object($id_or_email) && isset($id_or_email->comment_author_email)) {
			$id_or_email = $id_or_email->comment_author_email;
		}

		$user        = get_user_by('email', $id_or_email);
		$id_or_email = $user->ID;
	}

	$user_image_id = get_user_meta($id_or_email, 'profile_picture', true);
	if ($user_image_id) {
		$avatar      = wp_get_attachment_image_src($user_image_id)[0];
		$avatar_html = "<img alt='{$alt}' src='{$avatar}' class='avatar avatar-{$size} photo' height='{$size}' width='{$size}' />";
	}

	return $avatar_html;
}

/**
 * Filter for Avatar URL.
 *
 * @param string $url Avatar URL.
 * @param mixed $id_or_email ID or email address.
 * @param $args
 *
 * @return mixed Filtered Avatar URL.
 */
function filter_nab_amplify_get_avatar_url($url, $id_or_email, $args)
{
	$user_id = get_current_user_id();

	if ($id_or_email === $user_id) {
		$user_image_id = get_user_meta($user_id, 'profile_picture', true);

		if ($user_image_id) {
			$url = wp_get_attachment_image_src($user_image_id)[0];
		}
	}

	return $url;
}

/**
 * Customize Menu Query variables.
 *
 * @param array $vars List of vars.
 *
 * @return mixed Updated List of vars.
 */
function nab_amplify_custom_menu_query_vars($vars)
{

	$vars[] = 'my-purchases';
	$vars[] = 'my-connections';
	$vars[] = 'my-events';
	$vars[] = 'my-bookmarks';

	return $vars;
}

/**
 * Update My Account Menu items.
 *
 * @param array $items My Account Menu items.
 *
 * @return array|string[] Updated My Account Menu items.
 */
function nab_amplify_update_my_account_menu_items($items)
{

	// Remove items.
	if (isset($items['dashboard'])) {
		unset($items['dashboard']);
	}
	if (isset($items['downloads'])) {
		unset($items['downloads']);
	}

	$items =
		array('view-profile' => __('View Profile', 'nab-amplify'))
		+ array('messages' => __('Inbox', 'nab-amplify'))
		+ array('my-connections' => __('Connections', 'nab-amplify'))
		+ array('my-purchases' => __('Access My Content', 'nab-amplify'))
		+ array('orders' => __('Order History', 'nab-amplify'))
		+ array('my-bookmarks' => __('Bookmarks', 'nab-amplify'))
		+ array('edit-account' => __('Edit Account', 'nab-amplify'))
		+ array('edit-address' => __('Edit Address', 'nab-amplify'));

	return $items;
}

/**
 * Used to set custom link in WooCommerce's My Account Menu's Item.
 *
 * @param string $url URL.
 * @param string $endpoint Endpoint.
 * @param string $value Value.
 * @param string $permalink Permalink.
 *
 * @return string Updated Endpoint URL.
 */
function nab_amplify_woocommerce_get_endpoint_url($url, $endpoint, $value, $permalink)
{
	// Add Custom URL.
	if ($endpoint === 'messages') {
		$url = bp_loggedin_user_domain() . bp_get_messages_slug();
	}
	if ( 'view-profile' === $endpoint ) {
		$url = bp_loggedin_user_domain();
	}

	return $url;
}

/**
 * Added login link on checkout page if user is not logged in.
 */
function nab_add_login_link_on_checkout_page()
{
	// If checkout registration is disabled and not logged in, the user cannot checkout.
	if (!is_user_logged_in()) {
		$sign_in_url = add_query_arg('r', wc_get_page_permalink('checkout'), wc_get_page_permalink('myaccount'));

		$sign_up_page = get_page_by_path(NAB_SIGNUP_PAGE); // @todo later replace this with VIP function
		if (isset($sign_up_page) && !empty($sign_up_page)) {
			$sign_up_page_url = add_query_arg('r', wc_get_page_permalink('checkout'), get_permalink($sign_up_page->ID));
		} else {
			$sign_up_page_url = 'javascript:void(0)';
		}
?>
		<p>You’ll need to have an NAB Amplify account to access content and register for NAB Show New York, Radio Show and SMTE.</p>
		<div class="nab_checkout_links">
			<p>Don't have an account? <strong><a class="checkout-signup-link" href="<?php echo esc_url($sign_up_page_url); ?>">Sign up</a></strong></p>
			<p>Already have an account? <strong><a class="checkout-signin-link" href="<?php echo esc_url($sign_in_url); ?>">Sign In</a></strong></p>
		</div>
<?php }
}

/**
 * Replace "coupon" with "promo".
 *
 * @param string $err message.
 *
 * @return string|string[] updated message.
 */
function filter_nab_amplify_woocommerce_coupon_to_promo($err)
{
	$err = str_replace('coupon', 'promo', $err);
	$err = str_replace('Coupon', 'Promo', $err);

	return $err;
}

/**
 * Replace "coupon" with "promo".
 *
 * @param string $coupon_html Coupon HTML.
 *
 * @return string|string[] Updated Coupon HTML.
 */
function filter_nab_amplify_woocommerce_cart_totals_coupon_html($coupon_html)
{
	$coupon_html = str_replace('Coupon', 'Promo', $coupon_html);

	return $coupon_html;
}

/**
 * Replace "coupon" with "promo".
 *
 * @param string $sprintf
 * @param string $coupon
 *
 * @return string|string[]
 */
function nab_amplify_woocommerce_cart_totals_coupon_label($sprintf, $coupon)
{
	return str_replace('Coupon', 'Promo', $sprintf);
}

/**
 * Hide Products on shop page having specific categories.
 *
 * @param array $shop_query Products query array.
 *
 * @return array update query array.
 */
function filter_nab_amplify_hide_shop_categories($shop_query)
{
	$hidden_categories = array('press-pass');
	if (is_shop()) {
		$shop_query[] =
			array(
				'taxonomy' => 'product_cat',
				'terms'    => $hidden_categories,
				'field'    => 'slug',
				'operator' => 'NOT IN',
			);
	}

	return $shop_query;
}

/**
 * Update HTML of NAB Amplify Password Form.
 *
 * @param string $output HTML of the password form.
 *
 * @return string updated HTML of the password form.
 */
function nab_apmlify_the_password_form($output)
{

	global $post;
	$post   = get_post($post);
	$label  = 'pwbox-' . (empty($post->ID) ? rand() : $post->ID);
	$output = '<form action="' . esc_url(site_url('wp-login.php?action=postpass', 'login_post')) . '" class="post-password-form" method="post">
	<p>' . __('This content is not open to all. To view or add it to your cart, please enter your supplied code below. If you do not have a code and believe you should have access to view or add this product, please email ') . '<a href="mailto:register@nab.org">register@nab.org</a></p>
	<p><label for="' . $label . '">' . __('Code:') . ' <input name="post_password" id="' . $label . '" type="password" size="20" /></label> <input type="submit" class="button" name="Submit" value="' . esc_attr_x('Enter', 'post password form') . '" /></p></form>
	';

	return $output;
}

/**
 * Get the availability of the product and replace the text.
 *
 * @param array $availability the availability of the product.
 *
 * @return string[] mixed Returns the availability of the product.
 */
function nab_amplify_woocommerce_get_availability($availability)
{
	$availability['availability'] = str_ireplace('Out of stock', 'Sold Out', $availability['availability']);

	return $availability;
}

/**
 * Change the availability status of the product.
 *
 * @return array Array of stock label options.
 */
function nab_amplify_woocommerce_product_stock_status_options()
{
	return array(
		'instock'    => __('Available for Purchase', 'woocommerce'),
		'outofstock' => __('Sold Out', 'woocommerce'),
	);
}

/**
 * Change the availability status of the product.
 *
 * @param array $settings Settings array.
 *
 * @return mixed returns modified settings array.
 */
function nab_amplify_woocommerce_inventory_settings($settings)
{

	foreach ($settings as $key => $s) {
		$settings[$key]['title'] = str_replace('Out of stock', 'Sold Out', $s['title']);
		$settings[$key]['desc']  = str_replace('out of stock', 'sold out', $s['desc']);
	}

	return $settings;
}

/**
 * Change the availability status of the product.
 *
 * @param array $reports Reports array.
 *
 * @return mixed returns modified reports array.
 */
function nab_amplify_woocommerce_admin_reports($reports)
{
	$reports['stock']['reports']['out_of_stock']['title'] = __('Sold Out', 'nab-amplify');

	return $reports;
}

/**
 * Change the availability status of the product.
 *
 * @param string $stock_html HTML of product availability label.
 *
 * @return string|string[] returns updated HTML of product availability label.
 */
function nab_amplify_woocommerce_admin_stock_html($stock_html)
{
	$stock_html = str_replace('In stock', 'Available for Purchase', $stock_html);
	$stock_html = str_replace('Out of stock', 'Sold Out', $stock_html);

	return $stock_html;
}

/**
 * Ajax Cart Fragments
 *
 * @param $fragments
 *
 * @return mixed
 */
function nab_cart_count_fragments($fragments)
{
	$header_cart_class                = WC()->cart->get_cart_contents_count() > 0 ? '' : 'has-no-product';
	$fragments['span.nab-cart-count'] = '<span class="nab-cart-count ' . $header_cart_class . '">' . WC()->cart->get_cart_contents_count() . '</span>';

	return $fragments;
}

/**
 * Paypal PayFlow comment field 1
 *
 * @param $customer_note
 * @param $order
 *
 * @return string
 */
function nab_pppf_custom_parameter($customer_note, $order)
{
	if (isset($order) && !empty($order)) {
		$order_id     = $order->get_order_number();
		$items        = $order->get_items();
		$product_name = '';

		foreach ($items as $item) {
			$product_id   = $item->get_product_id();
			$product      = wc_get_product($product_id);
			$product_name = $product->get_name();
		}
		$customer_note = $product_name . ' (' . $order_id . ')';
	}

	return $customer_note;
}

/**
 * Paypal Payflow comment field 2
 *
 * @param $customer_note
 * @param $order
 *
 * @return string
 */
function nab_pppf_comment2_parameter($customer_note, $order)
{
	if (isset($order) && !empty($order)) {
		$user_id  = $order->get_customer_id();
		$order_id = $order->get_order_number();

		if (isset($user_id) && !empty($user_id)) {
			$first_name = get_user_meta($user_id, 'attendee_first_name', true);
			$last_name  = get_user_meta($user_id, 'attendee_last_name', true);

			$customer_note = $first_name . ' ' . $last_name . ' (' . $user_id . ')';
		}
	}

	return $customer_note;
}

/**
 * Update the checkout page form fields.
 *
 * @param array $fields Checkout page fields.
 *
 * @return mixed Updated fields.
 */
function nab_amplify_woocommerce_checkout_fields($fields)
{

	if ('0.00' === WC()->cart->total || '0' === WC()->cart->total) {

		$keep_fields = array('billing_first_name', 'billing_last_name', 'billing_email', 'nab_additional_email');

		foreach ($fields['billing'] as $key => $val) {
			if (!in_array($key, $keep_fields, true)) {
				unset($fields['billing'][$key]);
			}
		}
	}

	return $fields;
}

/**
 * Custom Email Template for order purchase
 *
 * @param $email_classes
 *
 * @return mixed
 */
function nab_registration_receipt_mail($email_classes)
{

	// include our custom email class
	require_once get_template_directory() . '/inc/nab-registration-receipt-mail.php';
	require_once get_template_directory() . '/inc/nab-bulk-registration-user-mail.php';

	// add the email class to the list of email classes that WooCommerce loads
	$email_classes['WC_Registration_Receipt_Email'] = new WC_Registration_Receipt_Email();

	$email_classes['WC_Bulk_Registration_User_Email'] = new WC_Bulk_Registration_User_Email();

	return $email_classes;
}

/**
 * Save bulk order details to cart session
 *
 * @param $session_data
 * @param $values
 * @param $key
 *
 * @return mixed
 */
function nab_bulk_order($session_data, $values, $key)
{

	if (isset($_POST['nab_bulk_order']) && 'yes' === $_POST['nab_bulk_order']) {
		if (isset($_POST['nab_bulk_order_qty']) && !empty($_POST['nab_bulk_order_qty'])) {
			$session_data['nab_bulk_order'] = 'yes';
			$session_data['nab_qty']        = $_POST['nab_bulk_order_qty'];
		} else {
			$session_data['nab_bulk_order'] = 'no';
			$session_data['nab_qty']        = 1;
		}
	} else if (isset($_POST['nab_bulk_order']) && 'no' === $_POST['nab_bulk_order']) {
		$session_data['nab_bulk_order'] = 'no';
		$session_data['nab_qty']        = 1;
	}

	return $session_data;
}

/**
 * Prevents order emails to customers in case of Attendees import
 *
 * @param $enable
 * @param $order
 *
 * @return bool
 */
function nab_stop_bulk_order_email($enable, $order)
{

	if (isset($order) && !empty($order)) {
		$order_id            = $order->get_order_number();
		$is_bulk_child_order = get_post_meta($order_id, '_nab_bulk_child', true);

		// Stop email if it's a child order
		if (isset($is_bulk_child_order) && 'yes' === $is_bulk_child_order) {
			return false;
		}
	}

	return $enable;
}

/**
 * Enables REST API for admins or superadmins
 *
 * @param bool $val
 * @param object $user_id
 *
 * @return bool
 */
function nab_2fa_rest_api_enable($val, $user_id)
{
	$user = get_user_by('ID', $user_id);

	if (!empty($user) && (is_super_admin($user_id) || in_array('administrator', $user->roles, true))) {
		$val = true;
	}

	return $val;
}

/**
 * Changes the JWT token response
 *
 * @param array $data
 * @param object $user
 *
 * @return array
 */
function nab_jwt_response($data, $user)
{

	if (!empty($data) && !empty($user)) {
		$token = $data['token'];
		$data  = array(
			'token'   => $token,
			'user_id' => $user->data->ID,
		);
	}

	return $data;
}

/**
 * Force bulk quantities to single products if bulk quantity option is selected
 *
 * @param array $cart_contents
 *
 * @return array
 */
function nab_force_bulk_quanity($cart_contents)
{

	$is_bulk = nab_is_bulk_order();

	if (isset($is_bulk) && !empty($is_bulk)) {
		$get_qty = nab_bulk_order_quantity();

		if (isset($get_qty) && !empty($get_qty) && 1 < $get_qty) {
			$temp_cart = [];
			foreach ($cart_contents as $key => $values) {
				if ($get_qty !== $values['quantity']) {
					$values['quantity']       = $get_qty;
					$values['nab_bulk_order'] = 'yes';
					$values['nab_qty']        = $get_qty;

					// update cocart
					nab_update_cocart_item($key, $get_qty);
				}
				$temp_cart[$key] = $values;
			}
			$cart_contents = $temp_cart;
		}
	}

	return $cart_contents;
}

/**
 * Maximum 1 quantity allowed.
 *
 * @param $passed
 * @param $product_id
 *
 * @return bool
 */
function nab_amplify_woocommerce_add_to_cart_validation($passed, $product_id)
{

	foreach (WC()->cart->get_cart() as $cart_item) {
		$cart_product_id = $cart_item['product_id'];
		if ($cart_product_id === $product_id) {
			wc_add_notice(__('Maximum 1 quantity can be added in the cart.', 'woocommerce'), 'error');
			$passed = false;
			break;
		}
	}

	return $passed;
}

/**
 * Thank You page title change
 *
 * @param $title
 * @param $id
 *
 * @return string
 */
function nab_title_order_received($title, $id)
{

	if (is_order_received_page() && get_the_ID() === $id) {
		$title = "Registration Confirmation";
	}

	return $title;
}

/**
 * Change JWT Token expiry time
 *
 * @param int $expire
 * @param int $issuedAt
 *
 * @return int
 */
function nab_token_expiry_time($expire, $issuedAt)
{
	return $issuedAt + (DAY_IN_SECONDS * 30);
}

/**
 * Additional emails which will get invoice
 *
 * @param string $recipients
 * @param array $order
 *
 * @return string
 */
function nab_add_addition_email_recepient($recipients, $order)
{

	if (!empty($order)) {
		$order_id          = $order->get_order_number();
		$additional_emails = get_post_meta($order_id, 'nab_additional_email', true);

		if (isset($additional_emails) && !empty($additional_emails)) {
			$additional_emails = array_map('trim', explode(',', $additional_emails));
			$existing_emails   = (!empty($recipients)) ? array_map('trim', explode(',', $recipients)) : [];
			$recipients        = array_merge($existing_emails, $additional_emails);
			$recipients        = implode(',', array_unique($recipients));
		}
	}

	return $recipients;
}

/**
 * Setting Default Template for Buddypress pages.
 *
 * @param string $template Template path.
 *
 * @return string
 */
function nab_amplify_filter_bp_template_include($template)
{
	if (function_exists('bp_current_component') && bp_current_component()) {
		$template = get_theme_file_path('/template-buddypress.php');
	}

	return $template;
}

/**
 * Add new column name in the order list.
 *
 * @param $columns
 *
 * @return array
 *
 */
function nab_add_customer_name_column($columns)
{

	$manage_columns = array();

	foreach ($columns as $key => $value) {

		if ('order_number' === $key) {

			$manage_columns[$key]     = $value;
			$manage_columns['customer'] = 'Customer';
		}

		$manage_columns[$key] = $value;
	}

	return $manage_columns;
}

//Phase 4 search
/**
 * Custom order by relevance order
 *
 * @param mixed $orderby
 * @param mixed $query
 *
 * @return string
 */
function nab_change_query_order_by($orderby, $query)
{

	if (!is_admin() && !$query->is_main_query()) {

		if (isset($query->query['custom_order']) && 'relevance' === $query->query['custom_order']) {

			if (isset($query->query['s']) && !empty($query->query['s'])) {

				global $wpdb;

				$search_terms = explode(' ', $query->query['s']);

				if (count($search_terms) > 1) {

					$orderby = str_replace(', ' . $wpdb->prefix . 'posts.post_date DESC', ' ASC', $orderby);
				} else {

					$orderby = str_replace(', ' . $wpdb->prefix . 'posts.post_date DESC', '', $orderby);
				}
			}
		}
	}

	return $orderby;
}


/**
 * Change buddypress default add friend and cancle friend request button text.
 *
 * @param array $button
 *
 * @return array
 */
function nab_bp_change_add_friend_button_text($button)
{

	if ('not_friends' === $button['id']) {
		$button['link_text'] = 'Connect';
	}

	if ('pending' === $button['id']) {

		$button['link_text'] = 'Cancel Request';
	}

	return $button;
}

/**
 * Modify buddypress member query for search result filter.
 *
 * @param array $sql
 * @param BP_User_Query $query
 *
 * @return array
 */
function nab_modify_member_query($sql, $query)
{	

	if (isset($query->query_vars['type']) && in_array(strtolower($query->query_vars['type']), array('alphabetical', 'newest', 'active'), true)) {

		global $wpdb;

		$user_meta_cap = esc_sql($wpdb->prefix . 'capabilities');

		if ('alphabetical' === strtolower($query->query_vars['type'])) {

			$sql['select'] .= ' INNER JOIN wp_usermeta ON ( u.ID = wp_usermeta.user_id )';
		} else {

			$sql['select'] .= ' INNER JOIN wp_users ON u.user_id = wp_users.ID INNER JOIN wp_usermeta ON wp_users.ID = wp_usermeta.user_id';
		}


		$sql['where'][] = "wp_usermeta.meta_key = '" . $user_meta_cap . "'";

		if (isset($query->query_vars['search_terms']) && !empty($query->query_vars['search_terms'])) {

			$search_term = '%' . $query->query_vars['search_terms'] . '%';

			$matched_user_ids = $wpdb->get_col($wpdb->prepare(
				"SELECT DISTINCT ID FROM {$wpdb->users} INNER JOIN {$wpdb->usermeta} ON {$wpdb->users}.ID = {$wpdb->usermeta}.user_id
				WHERE {$wpdb->usermeta}.meta_key = %s AND ( user_login LIKE %s OR display_name LIKE %s OR user_nicename LIKE %s ) OR ( {$wpdb->usermeta}.meta_key='first_name' AND {$wpdb->usermeta}.meta_value LIKE %s ) OR ( {$wpdb->usermeta}.meta_key='last_name' AND {$wpdb->usermeta}.meta_value LIKE %s ) OR ( {$wpdb->usermeta}.meta_key='attendee_company' AND {$wpdb->usermeta}.meta_value LIKE %s ) OR ( {$wpdb->usermeta}.meta_key='attendee_title' AND {$wpdb->usermeta}.meta_value LIKE %s )",
				$user_meta_cap,
				$search_term,
				$search_term,
				$search_term,
				$search_term,
				$search_term,
				$search_term,
				$search_term
			));

			$match_in_clause = empty($matched_user_ids) ? 'NULL' : implode(',', $matched_user_ids);

			if ('alphabetical' === strtolower($query->query_vars['type'])) {

				$sql['where']['search'] = " ( u.ID IN ({$match_in_clause}) )";
			} else {

				$sql['where']['search'] = " ( u.user_id IN ({$match_in_clause}) )";
			}
		}
	}

	return $sql;
}

/**
 * Change friendship button in the member loop.
 *
 * @param array $buttons
 * @param int $user_id
 * @param string $type
 *
 * @return array
 */
function nab_change_friendship_request_button_in_loop($buttons, $user_id, $type)
{

	if ('friendship_request' === $type && 2 === count($buttons)) {
		return false;
	}

	return $buttons;
}

/**
 * Change friend request notification link.
 *
 * @param mixed $link
 *
 * @return mixed
 */
function nab_change_bp_friend_request_notification_link($link)
{

	$pending_request_url = add_query_arg(array('connections' => 'pending'), wc_get_account_endpoint_url('my-connections'));

	if (is_array($link)) {

		$link['link'] = $pending_request_url;
	} else {

		if (preg_match('~>\K[^<>]*(?=<)~', $link, $match)) {

			$link = '<a href="' . $pending_request_url . '">' . $match[0] . '</a>';
		}
	}

	return $link;
}


/**
 * Change accepted friend request link in the notification.
 *
 * @param mixed $link
 *
 * @return mixed
 */
function nab_change_bp_accepted_friend_request_notification_link($link)
{

	$my_connection_url = add_query_arg(array('connections' => 'friends', 'new' => 1), wc_get_account_endpoint_url('my-connections'));

	if (is_array($link)) {

		$link['link'] = $my_connection_url;
	} else {

		if (preg_match('~>\K[^<>]*(?=<)~', $link, $match)) {

			$link = '<a href="' . $my_connection_url . '">' . $match[0] . '</a>';
		}
	}

	return $link;
}

/**
 * Remove edit-address menu from my account.
 *
 * @param array $items
 *
 * @return array
 */
function nab_remove_edit_address_from_my_account($items)
{

	unset($items['edit-address']);

	return $items;
}

/**
 * Remove shipping address
 *
 * @param array $adresses
 *
 * @return array
 */
function nab_remove_shipping_address($adresses)
{

	if (isset($adresses['shipping'])) {

		unset($adresses['shipping']);
	}

	return $adresses;
}

/**
 * Change the size of product image.
 *
 * @param string $size
 *
 * @return string
 */
function nab_single_product_archive_thumbnail_size($size)
{
	return 'full';
}

/**
 * Added bookmark icon in the product detail page.
 *
 * @param string $html
 * @param int $post_thumbnail_id
 *
 * @return string
 */
function nab_add_bookmark_icon_in_product($html, $post_thumbnail_id)
{

	global $product;

	ob_start();

	nab_get_product_bookmark_html($product->get_id(), 'user-bookmark-action');

	$html .= ob_get_clean();

	return $html;
}


/**
 * Modified search query to include meta search if _meta_search in the query object
 *
 * @param  string $search
 * @param  mixed $wp_query
 * 
 * @return string
 */
function nab_modified_search_query_to_include_meta_search($search, $wp_query)
{

	$meta_search		= $wp_query->get('_meta_search');
	$tax_search			= $wp_query->get('_tax_search');
	$meta_company_term	= $wp_query->get('_meta_company_term');

	if ($meta_search && !empty($wp_query->query_vars['search_terms'])) {

		global $wpdb;

		$q = $wp_query->query_vars;
		$n = !empty($q['exact']) ? '' : '%';

		$search = array();

		foreach ((array) $q['search_terms'] as $term) {

			$like		= $n . $wpdb->esc_like($term) . $n;
			$search[]	= $wpdb->prepare("(({$wpdb->posts}.post_title LIKE %s) OR ({$wpdb->posts}.post_excerpt LIKE %s) OR ({$wpdb->posts}.post_content LIKE %s) OR ({$wpdb->postmeta}.meta_key IN ('article_type','community','personas','content_scope','content_format','content_subject','acquisition_sub','distribution_sub','management_sub','radio_sub','display_sub','industry_sub','content_sub') AND {$wpdb->postmeta}.meta_value LIKE %s))", $like, $like, $like, $like);
		}

		if (!empty($search)) {

			$search = ' AND (' . implode(' AND ', $search) . ')';

			if (!is_user_logged_in()) {

				$search .= " AND ({$wpdb->posts}.post_password = '') ";
			}
		}
	} else if (isset($tax_search) && !empty($tax_search) && is_array($tax_search)) {

		global $wpdb;

		$q = $wp_query->query_vars;
		$n = !empty($q['exact']) ? '' : '%';

		$tax_search	= implode(',', $tax_search);
		$search		= array();

		foreach ((array) $q['search_terms'] as $term) {

			$like		= $n . $wpdb->esc_like($term) . $n;
			$search[]	= $wpdb->prepare("(({$wpdb->posts}.post_title LIKE %s) OR ({$wpdb->posts}.post_excerpt LIKE %s) OR ({$wpdb->posts}.post_content LIKE %s) OR ({$wpdb->term_relationships}.term_taxonomy_id IN(%s) ))", $like, $like, $like, $tax_search);
		}

		if (!empty($search)) {

			$search = ' AND (' . implode(' AND ', $search) . ')';

			if (!is_user_logged_in()) {

				$search .= " AND ({$wpdb->posts}.post_password = '') ";
			}
		}
	} else if (isset($meta_company_term) && !empty($meta_company_term)) {

		global $wpdb;

		$q = $wp_query->query_vars;
		$n = !empty($q['exact']) ? '' : '%';

		$search 	= array();
		$meta_like	= $n . '"' . $wpdb->esc_like($meta_company_term) . '"' . $n;

		foreach ((array) $q['search_terms'] as $term) {

			$like		= $n . $wpdb->esc_like($term) . $n;
			$search[]	= $wpdb->prepare("(({$wpdb->posts}.post_title LIKE %s) OR ({$wpdb->posts}.post_excerpt LIKE %s) OR ({$wpdb->posts}.post_content LIKE %s) OR ({$wpdb->postmeta}.meta_key = 'product_categories' AND {$wpdb->postmeta}.meta_value LIKE %s))", $like, $like, $like, $meta_like);
		}

		if (!empty($search)) {

			$search = ' AND (' . implode(' AND ', $search) . ')';

			if (!is_user_logged_in()) {

				$search .= " AND ({$wpdb->posts}.post_password = '') ";
			}
		}
	}

	return $search;
}

/**
 * Added meta table in the join and groupby by post id for meta search.
 *
 * @param  array $clauses
 * @param  mixed $query_object
 * 
 * @return array
 */
function nab_moified_join_groupby_for_meta_search($clauses, $query_object)
{

	$meta_search 		= $query_object->get('_meta_search');
	$tax_search			= $query_object->get('_tax_search');
	$meta_company_term	= $query_object->get('_meta_company_term');

	if ($meta_search && !empty($query_object->query_vars['search_terms'])) {

		global $wpdb;

		$clauses['join'] 		= " INNER JOIN {$wpdb->postmeta} ON ( {$wpdb->posts}.ID = {$wpdb->postmeta}.post_id )";
		$clauses['groupby']		= " {$wpdb->posts}.ID";
	} else if (isset($tax_search) && !empty($tax_search) && is_array($tax_search)) {

		global $wpdb;

		$clauses['join'] 		= " LEFT JOIN {$wpdb->term_relationships} ON ( {$wpdb->posts}.ID = {$wpdb->term_relationships}.object_id )";
		$clauses['groupby']		= " {$wpdb->posts}.ID";
	} else if (isset($meta_company_term) && !empty($meta_company_term)) {

		global $wpdb;

		$clauses['join'] 		= " INNER JOIN {$wpdb->postmeta} ON ( {$wpdb->posts}.ID = {$wpdb->postmeta}.post_id )";
		$clauses['groupby']		= " {$wpdb->posts}.ID";
	}

	return $clauses;
}

function nabamplify_tiny_mce_before_init($initArray)
{

	$initArray['setup'] = <<<JS
[function( ed ) {

	var count = 0;
	ed.on( 'keyup', function(e,evt) {
		if ( tinyMCE.activeEditor.id == 'nab_product_copy' || tinyMCE.activeEditor.id == 'nab_product_specs' ) {
    var content = ed.getContent().replace(/(<[a-zA-Z\/][^<>]*>|\[([^\]]+)\])|(\s+)/ig,'');
    var max = 2000;
    var len = content.length;
	var diff = max - len;  
	 count++;     

    if (diff < 1) {
		if(tinyMCE.activeEditor.id == 'nab_product_copy'){
			document.getElementById("character-count-copy").innerHTML =  "Maximum Characters Limit exeeds!";
		}
		if(tinyMCE.activeEditor.id == 'nab_product_specs'){
			document.getElementById("character-count-specs").innerHTML =  "Maximum Characters Limit exeeds!";  
		}
		
		 
		return false
		
    }else{
		if(tinyMCE.activeEditor.id == 'nab_product_copy'){
		document.getElementById("character-count-copy").innerHTML = diff+ " Characters Remaining";
		}
		if(tinyMCE.activeEditor.id == 'nab_product_specs'){
		document.getElementById("character-count-specs").innerHTML = diff+ " Characters Remaining";
		}
	}

	
	}
} );


}][0]
JS;

	return $initArray;
}


/**
 * Apply html entity decode function in the message thread to avoid html entity code.
 *
 * @param  string $message_excerpt
 * 
 * @return string
 */
function nab_filter_message_to_avoid_html_entity($message_excerpt)
{

	return html_entity_decode($message_excerpt);
}


/**
 * Reorder the comment form above related content block
 */
/*
function nab_reorder_comment_form($content)
{
	// if no related content block used then show default content.
	$new_content = $content;

	//fetch comment form template from shortcode
	$comment_template = do_shortcode('[nab_comment_form]');
	
	// Check if we're inside the main loop in a single Post.
	if (get_post_type() === 'articles') {
		$blocks = parse_blocks($content);

		foreach ($blocks as $block) {
            if ('rg/related-content-2' === $block['blockName']) {
			
            if (strpos($content, '<h2 class="has-text-color" style="color:#fdd80f">Related Content</h2>')) {
                $new_content = str_replace('<h2 class="has-text-color" style="color:#fdd80f">Related Content</h2>', $comment_template.' <h2 class="has-text-color" style="color:#fdd80f">Related Content</h2>', $content);
            }else{
				$new_content = str_replace('<!-- wp:rg/related-content-2',$comment_template.' <!-- wp:rg/related-content-2',$content);
			}
                
            }
		}
		
		return $new_content;
	}

	return $content;
}*/
add_filter( 'bp_activity_maybe_load_mentions_scripts', 'buddydev_enable_mention_autosuggestions', 10, 2 );
 
function buddydev_enable_mention_autosuggestions( $load, $mentions_enabled ) {
    
    if( ! $mentions_enabled ) {
        return $load;//activity mention is  not enabled, so no need to bother
    }
    //modify this condition to suit yours
    if( is_user_logged_in() && bp_is_current_component( 'mediapress' ) ) {
        $load = true;
    }
    
    return $load;
}


/**
 * Update wordpress comment count.
 *
 * @param  array $count
 * @param  int $post_id
 * 
 * @return stdClass
 */
function nab_update_wp_admin_comments_count( $count, $post_id ) {
		
    if ( is_admin() && 0 === (int) $post_id ) {

		echo "in condition"; exit;

        global $wpdb;      

        $where = ' WHERE comment_type = "comment"';        

        $totals = (array) $wpdb->get_results(
            "
            SELECT comment_approved, COUNT( * ) AS total
            FROM {$wpdb->comments}
            {$where}
            GROUP BY comment_approved
        ",
            ARRAY_A
        );

        $comment_count = array(
            'approved'            => 0,
            'awaiting_moderation' => 0,
            'spam'                => 0,
            'trash'               => 0,
            'post-trashed'        => 0,
            'total_comments'      => 0,
            'all'                 => 0,
        );

        foreach ( $totals as $row ) {
            switch ( $row['comment_approved'] ) {
                case 'trash':
                    $comment_count['trash'] = $row['total'];
                    break;
                case 'post-trashed':
                    $comment_count['post-trashed'] = $row['total'];
                    break;
                case 'spam':
                    $comment_count['spam']            = $row['total'];
                    $comment_count['total_comments'] += $row['total'];
                    break;
                case '1':
                    $comment_count['approved']        = $row['total'];
                    $comment_count['total_comments'] += $row['total'];
                    $comment_count['all']            += $row['total'];
                    break;
                case '0':
                    $comment_count['awaiting_moderation'] = $row['total'];
                    $comment_count['total_comments']     += $row['total'];
                    $comment_count['all']                += $row['total'];
                    break;
                default:
                    break;
            }
        }
        $stats              = array_map( 'intval', $comment_count );
        $stats['moderated'] = $stats['awaiting_moderation'];
        unset( $stats['awaiting_moderation'] );

        $count = (object) $stats;
    }

    return $count;
}