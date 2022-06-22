<?php

require(WPCOM_VIP_PRIVATE_DIR . '/helpers/cache-control-helper.php');

// Load the VIP Vary_Cache class
require_once WP_MU_PLUGIN_DIR . '/cache/class-vary-cache.php';

use Automattic\VIP\Cache\Vary_Cache;

add_action( 'wp', 'wpcom_vip_cache_maxage' );

// Register the `nabshow` group
Vary_Cache::register_group( 'nabshow' );


add_action( 'wp_footer', function () {
	// If the user is already in the beta group, don't show the opt-in.
	$is_user_in_beta = Vary_Cache::is_user_in_group_segment( 'nabshow', 'yes' );
	if ( $is_user_in_beta ) {
		return;
	}

	// If the user isn't in the nabshow group
	// Codes Here
	?>
	<?php
} );

// Handle the opt-in request.
add_action( 'init', function() {
	// phpcs:ignore WordPress.Security.NonceVerification.Missing
	// phpcs:ignore WordPress.Security.NonceVerification.Missing
	$is_user_in_beta = Vary_Cache::is_user_in_group_segment( 'nabshow', 'yes' );
	if ( !$is_user_in_beta ) {
		Vary_Cache::set_group_for_user( 'nabshow', 'yes' );
		// Redirect back to the same page (per the POST-REDIRECT-GET pattern).
		// Please note the use of the `vip_vary_cache_did_send_headers` action.
		add_action( 'vip_vary_cache_did_send_headers', function() {
			// wp_safe_redirect( UrlVerifier::AppendTimeToUrl(add_query_arg( '' )) );
			wp_safe_redirect( add_query_arg( '' ) );
			exit;
		} );
	}
} );

add_filter( 'the_content', function( $content ) {
	$is_user_in_beta = Vary_Cache::is_user_in_group_segment( 'nabshow', 'yes' );
	if ( $is_user_in_beta ) {
		// Codes Here
	}
	return $content;
} );
