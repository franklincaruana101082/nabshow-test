<?php

/**
 * Redirect after registration
 *
 * @return string
 */
function nab_registration_redirect() {

	$current_items = array();
	$items         = WC()->cart->get_cart();
	foreach ( $items as $item => $values ) {
		$product_id   = $values['product_id'];
		$quantity     = $values['quantity'];
		$variation_id = $values['variation_id'];

		$current_items[ $product_id ] = array(
			'product_id'   => $product_id,
			'quantity'     => $quantity,
			'variation_id' => $variation_id,
		);
	}

	WC()->cart->empty_cart();

	foreach ( $current_items as $item ) {
		WC()->cart->add_to_cart( $item['product_id'], $item['quantity'], $item['variation_id'] );
	}

	wp_logout();

	$checkout_url = wc_get_page_permalink( 'checkout' );
	if ( isset( $_POST['checkout_redirect'] ) && ! empty( isset( $_POST['checkout_redirect'] ) ) ) {
		$args = array(
			'nab_registration_complete' => 'true',
			'r'                         => $checkout_url,
		);
	} else {
		$args = array(
			'nab_registration_complete' => 'true',
		);
	}

	return add_query_arg( $args, wc_get_page_permalink( 'myaccount' ) );
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

	$billing_fields['billing_phone']['required']   = false;
	$billing_fields['billing_first_name']['label'] = 'First Name';
	$billing_fields['billing_last_name']['label']  = 'Last Name';

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
		/*+ array( 'my-purchases' => __( 'My Purchases', 'nab-amplify' ) )*/
		+ array( 'edit-account' => __( 'Edit My Account', 'nab-amplify' ) )
		+ array( 'edit-address' => __( 'Edit Address', 'nab-amplify' ) )
		+ array( 'orders' => __( 'Order History', 'nab-amplify' ) )
		+ array( 'customer-logout' => __( 'Logout', 'nab-amplify' ) );

	return $items;
}

/**
 * Added login link on checkout page if user is not logged in.
 */
function nab_add_login_link_on_checkout_page() {
	// If checkout registration is disabled and not logged in, the user cannot checkout.
	if ( ! is_user_logged_in() ) {
		$current_site_url = add_query_arg( 'r', wc_get_page_permalink( 'checkout' ), wc_get_page_permalink( 'myaccount' ) );

		$sign_up_page = get_page_by_path( NAB_SIGNUP_PAGE ); // @todo later replace this with VIP function
        if ( isset( $sign_up_page ) && ! empty( $sign_up_page ) ) {
	        $sign_up_page_url = add_query_arg( 'r', wc_get_page_permalink( 'checkout' ), get_permalink( $sign_up_page->ID ) );
		} else {
	        $sign_up_page_url = 'javascript:void(0)';
		}
		?>
        <a class="checkout-login-link button" href="<?php echo esc_url( $current_site_url ); ?>">Login</a> OR <a class="checkout-signup-link button" href="<?php echo esc_url( $sign_up_page_url ); ?>">create an account</a> to proceed with your registration.
	<?php }
}

/**
 * @param string $err message.
 *
 * @return string|string[] updated message.
 */
function filter_nab_amplify_woocommerce_coupon_to_promo( $err ) {
	$err = str_replace( 'coupon', 'promo', $err);
	$err = str_replace( 'Coupon', 'Promo', $err);
	return $err;
}

function filter_nab_amplify_woocommerce_cart_totals_coupon_html( $coupon_html, $coupon, $discount_amount_html ) {
    $discount_amount_html = str_replace( 'coupon', 'promo', $discount_amount_html);
	return $discount_amount_html;
}

/**
 * @param array $shop_query Products query array.
 *
 * @return array update query array.
 */
function filter_nab_amplify_hide_shop_categories( $shop_query ) {
	$hidden_categories = array( 'press-pass' );
	if (is_shop()) {
		$shop_query[] =
			array(
				'taxonomy' => 'product_cat',
				'terms'    => $hidden_categories,
				'field'    => 'slug',
				'operator' => 'NOT IN'
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
