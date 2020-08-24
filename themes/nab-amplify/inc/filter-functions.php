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