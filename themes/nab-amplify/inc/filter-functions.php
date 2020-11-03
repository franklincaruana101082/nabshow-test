<?php

/**
 * Redirect after registration
 *
 * @return string
 */
function nab_registration_redirect() {

	if ( isset( $_POST['checkout_redirect'] ) && ! empty( isset( $_POST['checkout_redirect'] ) ) ) {

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
		$redirect_url = wc_get_page_permalink( 'shop' );
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
function nab_remove_privacy_policy_text( $text, $type ) {
	if ( 'registration' === $type ) {
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
function nab_customising_checkout_fields( $address_fields ) {
	// Only on checkout page
	if ( ! is_checkout() ) {
		return $address_fields;
	}

	// All field keys in this array
	$key_fields = array( 'company', 'address_2' );

	// Loop through each address fields (billing and shipping)
	foreach ( $key_fields as $key_field ) {
		$address_fields[ $key_field ]['required'] = false;
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
 * @param $billing_fields
 *
 * @return mixed
 */
function nab_custom_billing_fields( $billing_fields ) {

	// Only on checkout page
	if ( ! is_checkout() ) {
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

	unset( $billing_fields['billing_phone'] );

	return $billing_fields;
}

/**
 * Orders page sorting
 *
 * @param $args
 *
 * @return array
 */
function nab_my_account_orders_query_change_sorting( $args ) {

	if ( isset( $_GET['orderby'] ) && ( 'order-total' === $_GET['orderby'] || 'order-date' === $_GET['orderby'] ) ) {
		if ( 'order-date' === $_GET['orderby'] ) {
			$args['orderby'] = 'date';
		} else {
			$args = array_merge( $args, array(
				'meta_key' => '_order_total',
				'orderby'  => 'meta_value_num',
			) );
		}
	}

	if ( isset( $_GET['order'] ) && ( 'asc' === $_GET['order'] || 'desc' === $_GET['order'] ) ) {
		$args['order'] = sanitize_text_field( $_GET['order'] );
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
function nab_my_orders_columns( $columns ) {
	unset( $columns['order-status'] );

	return $columns;
}

/**
 * Filter for Avatar HTML.
 *
 * @param $avatar_html
 * @param $id_or_email
 * @param $size
 * @param $default
 * @param $alt
 *
 * @return string Filtered Avatar HTML.
 */
function filter_nab_amplify_user_avtar( $avatar_html, $id_or_email, $size, $default, $alt ) {
	$user_id = get_current_user_id();

	if ( $id_or_email === $user_id ) {
		$user_image_id = get_user_meta( $user_id, 'profile_picture', true );

		if ( $user_image_id ) {
			$avatar      = wp_get_attachment_image_src( $user_image_id )[0];
			$avatar_html = "<img alt='{$alt}' src='{$avatar}' class='avatar avatar-{$size} photo' height='{$size}' width='{$size}' />";
		}
	}

	return $avatar_html;
}

/**
 * Filter for Avatar URL.
 *
 * @param $url
 * @param $id_or_email
 * @param $args
 *
 * @return mixed Filtered Avatar URL.
 */
function filter_nab_amplify_get_avatar_url( $url, $id_or_email, $args ) {
	$user_id = get_current_user_id();

	if ( $id_or_email === $user_id ) {
		$user_image_id = get_user_meta( $user_id, 'profile_picture', true );

		if ( $user_image_id ) {
			$url = wp_get_attachment_image_src( $user_image_id )[0];
		}
	}

	return $url;
}

/**
 * @param array $vars List of vars.
 *
 * @return mixed Updated List of vars.
 */
function nab_amplify_custom_menu_query_vars( $vars ) {
		
	$vars[] = 'my-purchases';
	$vars[] = 'my-connections';
	$vars[] = 'my-events';
	$vars[] = 'my-bookmarks';

	return $vars;
}

/**
 * @param array $items My Account Menu items.
 *
 * @return array|string[] Updated My Account Menu items.
 */
function nab_amplify_update_my_account_menu_items( $items ) {

	// Remove items.
	if ( isset( $items['dashboard'] ) ) {
		unset( $items['dashboard'] );
	}
	if ( isset( $items['downloads'] ) ) {
		unset( $items['downloads'] );
	}

	$items =
		array( 'messages' => __( 'My inbox', 'nab-amplify' ) )
		+ array( 'my-connections' => __( 'My Connections', 'nab-amplify' ) )
		+ array( 'my-purchases' => __( 'My Purchases', 'nab-amplify' ) )
		+ array( 'orders' => __( 'My Orders', 'nab-amplify' ) )	
		+ array( 'edit-account' => __( 'Edit My Account', 'nab-amplify' ) )
		+ array( 'edit-address' => __( 'Edit Address', 'nab-amplify' ) );

	return $items;
}

/**
 * Used to set custom link in WooCommerce's My Account Menu's Item.
 *
 * @param $url
 * @param $endpoint
 * @param $value
 * @param $permalink
 *
 * @return string
 */
function nab_amplify_woocommerce_get_endpoint_url( $url, $endpoint, $value, $permalink ) {
    // Add Custom URL.
	if ( $endpoint === 'messages' ) {
		$url = bp_loggedin_user_domain() . bp_get_messages_slug();
	}
	return $url;
}

/**
 * Added login link on checkout page if user is not logged in.
 */
function nab_add_login_link_on_checkout_page() {
	// If checkout registration is disabled and not logged in, the user cannot checkout.
	if ( ! is_user_logged_in() ) {
		$sign_in_url = add_query_arg( 'r', wc_get_page_permalink( 'checkout' ), wc_get_page_permalink( 'myaccount' ) );

		$sign_up_page = get_page_by_path( NAB_SIGNUP_PAGE ); // @todo later replace this with VIP function
		if ( isset( $sign_up_page ) && ! empty( $sign_up_page ) ) {
			$sign_up_page_url = add_query_arg( 'r', wc_get_page_permalink( 'checkout' ), get_permalink( $sign_up_page->ID ) );
		} else {
			$sign_up_page_url = 'javascript:void(0)';
		}
		?>
        <p>You’ll need to have an NAB Amplify account to access content and register for NAB Show New York, Radio Show and SMTE.</p>
        <div class="nab_checkout_links">
            <p>Don't have an account? <strong><a class="checkout-signup-link" href="<?php echo esc_url( $sign_up_page_url ); ?>">Sign up</a></strong></p>
            <p>Already have an account? <strong><a class="checkout-signin-link" href="<?php echo esc_url( $sign_in_url ); ?>">Sign In</a></strong></p>
        </div>
	<?php }
}

/**
 * @param string $err message.
 *
 * @return string|string[] updated message.
 */
function filter_nab_amplify_woocommerce_coupon_to_promo( $err ) {
	$err = str_replace( 'coupon', 'promo', $err );
	$err = str_replace( 'Coupon', 'Promo', $err );

	return $err;
}

function filter_nab_amplify_woocommerce_cart_totals_coupon_html( $coupon_html ) {
	$coupon_html = str_replace( 'Coupon', 'Promo', $coupon_html );

	return $coupon_html;
}

function nab_amplify_woocommerce_cart_totals_coupon_label( $sprintf, $coupon ) {
	return str_replace( 'Coupon', 'Promo', $sprintf );
}

/**
 * @param array $shop_query Products query array.
 *
 * @return array update query array.
 */
function filter_nab_amplify_hide_shop_categories( $shop_query ) {
	$hidden_categories = array( 'press-pass' );
	if ( is_shop() ) {
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
 * @param string $output HTML of the password form.
 *
 * @return string updated HTML of the password form.
 */
function nab_apmlify_the_password_form( $output ) {

	global $post;
	$post   = get_post( $post );
	$label  = 'pwbox-' . ( empty( $post->ID ) ? rand() : $post->ID );
	$output = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" class="post-password-form" method="post">
	<p>' . __( 'This content is not open to all. To view or add it to your cart, please enter your supplied code below. If you do not have a code and believe you should have access to view or add this product, please email ' ) . '<a href="mailto:register@nab.org">register@nab.org</a></p>
	<p><label for="' . $label . '">' . __( 'Code:' ) . ' <input name="post_password" id="' . $label . '" type="password" size="20" /></label> <input type="submit" class="button" name="Submit" value="' . esc_attr_x( 'Enter', 'post password form' ) . '" /></p></form>
	';

	return $output;
}

/**
 * @param array $availability the availability of the product.
 *
 * @return string[] mixed Returns the availability of the product.
 */
function nab_amplify_woocommerce_get_availability( $availability ) {
	$availability['availability'] = str_ireplace( 'Out of stock', 'Sold Out', $availability['availability'] );

	return $availability;
}

/**
 * @return array Array of stock label options.
 */
function nab_amplify_woocommerce_product_stock_status_options() {
	return array(
		'instock'    => __( 'Available for Purchase', 'woocommerce' ),
		'outofstock' => __( 'Sold Out', 'woocommerce' ),
	);
}

/**
 * @param array $settings Settings array.
 *
 * @return mixed returns modified settings array.
 */
function nab_amplify_woocommerce_inventory_settings( $settings ) {

	foreach ( $settings as $key => $s ) {
		$settings[ $key ]['title'] = str_replace( 'Out of stock', 'Sold Out', $s['title'] );
		$settings[ $key ]['desc']  = str_replace( 'out of stock', 'sold out', $s['desc'] );
	}

	return $settings;
}

/**
 * @param array $reports Reports array.
 *
 * @return mixed returns modified reports array.
 */
function nab_amplify_woocommerce_admin_reports( $reports ) {
	$reports['stock']['reports']['out_of_stock']['title'] = __( 'Sold Out', 'nab-amplify' );

	return $reports;
}

/**
 * @param string $stock_html HTML of product availability label.
 *
 * @return string|string[] returns updated HTML of product availability label.
 */
function nab_amplify_woocommerce_admin_stock_html( $stock_html ) {
	$stock_html = str_replace( 'In stock', 'Available for Purchase', $stock_html );
	$stock_html = str_replace( 'Out of stock', 'Sold Out', $stock_html );

	return $stock_html;
}

/**
 * Ajax Cart Fragments
 *
 * @param $fragments
 *
 * @return mixed
 */
function nab_cart_count_fragments( $fragments ) {
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
function nab_pppf_custom_parameter( $customer_note, $order ) {
	if ( isset( $order ) && ! empty( $order ) ) {
		$order_id     = $order->get_order_number();
		$items        = $order->get_items();
		$product_name = '';

		foreach ( $items as $item ) {
			$product_id   = $item->get_product_id();
			$product      = wc_get_product( $product_id );
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
function nab_pppf_comment2_parameter( $customer_note, $order ) {
	if ( isset( $order ) && ! empty( $order ) ) {
		$user_id  = $order->get_customer_id();
		$order_id = $order->get_order_number();

		if ( isset( $user_id ) && ! empty( $user_id ) ) {
			$first_name = get_user_meta( $user_id, 'attendee_first_name', true );
			$last_name  = get_user_meta( $user_id, 'attendee_last_name', true );

			$customer_note = $first_name . ' ' . $last_name . ' (' . $user_id . ')';
		}
	}

	return $customer_note;
}

/**
 * Update the checkout page form fields.
 */
function nab_amplify_woocommerce_checkout_fields( $fields ) {

	if ( '0.00' === WC()->cart->total || '0' === WC()->cart->total ) {

		$keep_fields = array( 'billing_first_name', 'billing_last_name', 'billing_email', 'nab_additional_email' );

		foreach ( $fields['billing'] as $key => $val ) {
			if ( ! in_array( $key, $keep_fields, true ) ) {
				unset( $fields['billing'][ $key ] );
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
function nab_registration_receipt_mail( $email_classes ) {

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
function nab_bulk_order( $session_data, $values, $key ) {

	if ( isset( $_POST['nab_bulk_order'] ) && 'yes' === $_POST['nab_bulk_order'] ) {
		if ( isset( $_POST['nab_bulk_order_qty'] ) && ! empty( $_POST['nab_bulk_order_qty'] ) ) {
			$session_data['nab_bulk_order'] = 'yes';
			$session_data['nab_qty']        = $_POST['nab_bulk_order_qty'];
		} else {
			$session_data['nab_bulk_order'] = 'no';
			$session_data['nab_qty']        = 1;
		}
	} else if ( isset( $_POST['nab_bulk_order'] ) && 'no' === $_POST['nab_bulk_order'] ) {
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
function nab_stop_bulk_order_email( $enable, $order ) {

	if ( isset( $order ) && ! empty( $order ) ) {
		$order_id            = $order->get_order_number();
		$is_bulk_child_order = get_post_meta( $order_id, '_nab_bulk_child', true );

		// Stop email if it's a child order
		if ( isset( $is_bulk_child_order ) && 'yes' === $is_bulk_child_order ) {
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
function nab_2fa_rest_api_enable( $val, $user_id ) {
	$user = get_user_by( 'ID', $user_id );

	if ( ! empty( $user ) && ( is_super_admin( $user_id ) || in_array( 'administrator', $user->roles, true ) ) ) {
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
function nab_jwt_response( $data, $user ) {

	if ( ! empty( $data ) && ! empty( $user ) ) {
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
function nab_force_bulk_quanity( $cart_contents ) {

	$is_bulk = nab_is_bulk_order();

	if ( isset( $is_bulk ) && ! empty( $is_bulk ) ) {
		$get_qty = nab_bulk_order_quantity();

		if ( isset( $get_qty ) && ! empty( $get_qty ) && 1 < $get_qty ) {
			$temp_cart = [];
			foreach ( $cart_contents as $key => $values ) {
				if ( $get_qty !== $values['quantity'] ) {
					$values['quantity']       = $get_qty;
					$values['nab_bulk_order'] = 'yes';
					$values['nab_qty']        = $get_qty;

					// update cocart
					nab_update_cocart_item( $key, $get_qty );
				}
				$temp_cart[ $key ] = $values;
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
function nab_amplify_woocommerce_add_to_cart_validation( $passed, $product_id ) {

	foreach ( WC()->cart->get_cart() as $cart_item ) {
		$cart_product_id = $cart_item['product_id'];
		if ( $cart_product_id === $product_id ) {
			wc_add_notice( __( 'Maximum 1 quantity can be added in the cart.', 'woocommerce' ), 'error' );
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
function nab_title_order_received( $title, $id ) {

	if ( is_order_received_page() && get_the_ID() === $id ) {
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
function nab_token_expiry_time( $expire, $issuedAt ) {
	return $issuedAt + ( DAY_IN_SECONDS * 30 );
}

/**
 * Additional emails which will get invoice
 *
 * @param string $recipients
 * @param array $order
 *
 * @return string
 */
function nab_add_addition_email_recepient( $recipients, $order ) {

	if ( ! empty( $order ) ) {
		$order_id          = $order->get_order_number();
		$additional_emails = get_post_meta( $order_id, 'nab_additional_email', true );

		if ( isset( $additional_emails ) && ! empty( $additional_emails ) ) {
			$additional_emails = array_map( 'trim', explode( ',', $additional_emails ) );
			$existing_emails   = ( ! empty( $recipients ) ) ? array_map( 'trim', explode( ',', $recipients ) ) : [];
			$recipients        = array_merge( $existing_emails, $additional_emails );
			$recipients        = implode( ',', array_unique( $recipients ) );
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
function nab_amplify_filter_bp_template_include( $template ) {
	if ( function_exists( 'bp_current_component' ) && bp_current_component() ) {
		$template = get_theme_file_path( '/template-buddypress.php' );
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
function nab_add_customer_name_column( $columns ) {

	$manage_columns = array();

	foreach ( $columns as $key => $value ) {

		if ( 'order_number' === $key ) {

			$manage_columns[ $key ]     = $value;
			$manage_columns['customer'] = 'Customer';
		}

		$manage_columns[ $key ] = $value;
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
function nab_change_query_order_by( $orderby, $query ) {

	if ( ! is_admin() && ! $query->is_main_query() ) {

		if ( isset( $query->query['custom_order'] ) && 'relevance' === $query->query['custom_order'] ) {

			if ( isset( $query->query['s'] ) && ! empty( $query->query['s'] ) ) {

				global $wpdb;

				$search_terms = explode( ' ', $query->query['s'] );

				if ( count( $search_terms ) > 1 ) {

					$orderby = str_replace( ', ' . $wpdb->prefix . 'posts.post_date DESC', ' ASC', $orderby );


				} else {

					$orderby = str_replace( ', ' . $wpdb->prefix . 'posts.post_date DESC', '', $orderby );

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
function nab_bp_change_add_friend_button_text( $button ) {

	if ( 'not_friends' === $button['id'] ) {
		$button['link_text'] = 'Connect';
	}

	if ( 'pending' === $button['id'] ) {

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
function nab_modify_member_query( $sql, $query ) {


	if ( isset( $query->query_vars['type'] ) && in_array( strtolower( $query->query_vars['type'] ), array( 'alphabetical', 'newest', 'active' ), true ) ) {

		global $wpdb;

		$user_meta_cap = esc_sql( $wpdb->prefix . 'capabilities' );

		if ( 'alphabetical' === strtolower( $query->query_vars['type'] ) ) {

			$sql['select'] .= ' INNER JOIN wp_usermeta ON ( u.ID = wp_usermeta.user_id )';

		} else {

			$sql['select'] .= ' INNER JOIN wp_users ON u.user_id = wp_users.ID INNER JOIN wp_usermeta ON wp_users.ID = wp_usermeta.user_id';
		}


		$sql['where'][] = "wp_usermeta.meta_key = '" . $user_meta_cap . "'";

		if ( isset( $query->query_vars[ 'search_terms' ] ) && ! empty( $query->query_vars[ 'search_terms' ] ) ) {

			$search_term = '%' . $query->query_vars[ 'search_terms' ] . '%';

			$matched_user_ids = $wpdb->get_col( $wpdb->prepare(
				"SELECT DISTINCT ID FROM {$wpdb->users} INNER JOIN {$wpdb->usermeta} ON {$wpdb->users}.ID = {$wpdb->usermeta}.user_id
				WHERE {$wpdb->usermeta}.meta_key = %s AND ( user_login LIKE %s OR display_name LIKE %s OR user_nicename LIKE %s ) OR ( {$wpdb->usermeta}.meta_key='first_name' AND {$wpdb->usermeta}.meta_value LIKE %s ) OR ( {$wpdb->usermeta}.meta_key='last_name' AND {$wpdb->usermeta}.meta_value LIKE %s )",
				$user_meta_cap,
				$search_term,
				$search_term,
				$search_term,
				$search_term,
				$search_term
			) );

			$match_in_clause = empty( $matched_user_ids) ? 'NULL' : implode( ',', $matched_user_ids );

			if ( 'alphabetical' === strtolower( $query->query_vars['type'] ) ) {

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
 * @param  array $buttons
 * @param  int $user_id
 * @param  string $type
 * 
 * @return array
 */
function nab_change_friendship_request_button_in_loop( $buttons, $user_id, $type ) {

	if ( 'friendship_request' === $type && 2 === count( $buttons ) ) {
		return false;
	}

	return $buttons;
}

/**
 * Change friend request notification link.
 *
 * @param  mixed $link
 * 
 * @return mixed
 */
function nab_change_bp_friend_request_notification_link( $link ) {
	
	$pending_request_url = add_query_arg( array( 'connections' => 'pending' ), wc_get_account_endpoint_url( 'my-connections' ) );

	if ( is_array( $link ) ) {
		
		$link[ 'link' ] = $pending_request_url;

	} else {

		if ( preg_match('~>\K[^<>]*(?=<)~', $link, $match ) ) {
			
			$link = '<a href="' . $pending_request_url . '">' . $match[0] .'</a>';
		}
	}

	return $link;
}


/**
 * Change accepted friend request link in the notification.
 *
 * @param  mixed $link
 * @return mixed
 */
function nab_change_bp_accepted_friend_request_notification_link( $link ) {
	
	$my_connection_url = add_query_arg( array( 'connections' => 'friends', 'new' => 1 ), wc_get_account_endpoint_url( 'my-connections' ) );

	if ( is_array( $link ) ) {
		
		$link[ 'link' ] = $my_connection_url;

	} else {

		if ( preg_match('~>\K[^<>]*(?=<)~', $link, $match ) ) {
			
			$link = '<a href="' . $my_connection_url . '">' . $match[0] .'</a>';
		}
	}

	return $link;
}
  
/**
 * Remove edit-address menu from my account.
 *
 * @param  array $items
 * 
 * @return array
 */
function nab_remove_edit_address_from_my_account( $items ) {
	
	unset( $items[ 'edit-address' ] );

	return $items;
}

/**
 * Remove shipping address
 *
 * @param  array $adresses
 * 
 * @return array
 */
function nab_remove_shipping_address( $adresses ) { 
	
	if ( isset( $adresses[ 'shipping' ] ) ) {
		
		unset( $adresses[ 'shipping' ] );
	}
	
    return $adresses; 
}

/**
 * Added bookmark icon in the product detail page.
 *
 * @param  string $html
 * @param  int $post_thumbnail_id
 * 
 * @return string
 */
function nab_add_bookmark_icon_in_product( $html, $post_thumbnail_id ) {

    global $product;
    
    ob_start();
    
    nab_get_product_bookmark_html( $product->get_id(), 'user-bookmark-action' );
    
    $html .= ob_get_clean();

    return $html;
}