<?php

/**
 * Redirect after registration
 *
 * @return string
 */
function nab_registration_redirect() {
	wp_logout();
	wp_destroy_current_session();

	return add_query_arg( 'nab_registration_complete', 'true', wc_get_page_permalink( 'myaccount' ) );
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
	$key_fields = array( 'country', 'first_name', 'last_name', 'company', 'address_1', 'address_2', 'city', 'state', 'postcode' );

	// Loop through each address fields (billing and shipping)
	foreach ( $key_fields as $key_field ) {
		$address_fields[ $key_field ]['required'] = false;
	}

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

	$billing_fields['billing_phone']['required'] = false;

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

    $user_id       = get_current_user_id();
	$user_image_id = get_user_meta( $user_id, 'profile_picture', true );
	if ( $user_image_id ) {
		$avatar      = wp_get_attachment_image_src( $user_image_id )[0];
		$avatar_html = "<img alt='{$alt}' src='{$avatar}' class='avatar avatar-{$size} photo' height='{$size}' width='{$size}' />";
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
	$user_id       = get_current_user_id();
	$user_image_id = get_user_meta( $user_id, 'profile_picture', true );
	if ( $user_image_id ) {
		$url = wp_get_attachment_image_src( $user_image_id )[0];
	}

	return $url;
}

/**
 * @param array $vars List of vars.
 *
 * @return mixed Updated List of vars.
 */
function nab_amplify_custom_menu_query_vars( $vars ) {

	$vars[] = 'edit-my-profile';
	$vars[] = 'my-purchases';

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
		array( 'edit-my-profile' => __( 'Edit My Profile', 'nab-amplify' ) )
		+ array( 'my-purchases' => __( 'My Purchases', 'nab-amplify' ) )
		+ array( 'edit-account' => __( 'Edit My Account', 'nab-amplify' ) )
		+ array( 'edit-address' => __( 'Edit Addresses', 'nab-amplify' ) )
		+ array( 'orders' => __( 'Order History', 'nab-amplify' ) )
		+ array( 'customer-logout' => __( 'Logout', 'nab-amplify' ) );

	// Change labels.
	if ( isset( $items['edit-account'] ) ) {
		$items['edit-account'] = 'Edit My Account';
	}
	if ( isset( $items['orders'] ) ) {
		$items['orders'] = 'Order History';
	}

	return $items;
}

/**
 * Added login link on checkout page if user is not logged in.
 */
function nab_add_login_link_on_checkout_page() {
	// If checkout registration is disabled and not logged in, the user cannot checkout.
	if ( ! is_user_logged_in() ) {
		$current_site_url = add_query_arg( 'r', wc_get_page_permalink( 'checkout' ), wc_get_page_permalink( 'myaccount' ) );
		?>
		<a class="checkout-login-link" href="<?php echo esc_url( $current_site_url ); ?>">Login</a>
		<?php
	}
}
