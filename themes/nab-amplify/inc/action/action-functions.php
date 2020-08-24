<?php

/**
 * Checks if password matches confirm password
 *
 * @param $posted
 *
 * @return \WP_Error
 */
function nab_confirm_password_matches_checkout( $errors, $username, $email ) {

	global $woocommerce;
	extract( $_POST );

	if ( empty( $password2 ) ) {
		return new WP_Error( 'registration-error', __( 'Please enter confirm password.', 'woocommerce' ) );
	}

	if ( ! empty( $password ) && 8 > strlen( $password ) ) {
		return new WP_Error( 'registration-error', __( 'Password must be 8 characters long.', 'woocommerce' ) );
	}

	if ( ! is_user_logged_in() && 0 !== strcmp( $password, $password2 ) ) {
		return new WP_Error( 'registration-error', __( 'Passwords do not match.', 'woocommerce' ) );
	}

	return $errors;
}

/**
 * Sync users across multisite
 *
 * @param $username
 * @param $user
 */
function nab_sync_login( $username, $user ) {
	// $sites = get_sites(); // for all sites

	$sites = [ 5 ]; // for NY site @todo Make in dynamic later

	foreach ( $sites as $site ) {
		if ( isset( $user->ID ) && !empty( $user->ID ) && false === is_user_member_of_blog( $user->ID, $site ) ) {
			add_user_to_blog( $site, $user->ID, 'customer' );
		}
	}
}

/**
 * Registration Success Message
 */
function nab_reg_message() {
	if ( ! is_user_logged_in() && is_account_page() && isset( $_GET['nab_registration_complete'] ) && 'true' === $_GET['nab_registration_complete'] ) {
		wc_add_notice( 'Registration has been completed successfully. Please login to continue!' );
	}
}