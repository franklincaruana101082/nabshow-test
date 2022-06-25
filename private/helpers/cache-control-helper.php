<?php

/**
 * Hooks the wp action to insert some cache control
 * max-age headers.
 *
 * @param Object wp The WP object, passed by reference
 * @return void
 */

function wpcom_vip_cache_maxage( $wp ) {
    if ( is_feed() ) {
        // Set the max age for feeds to 5 minutes.
        if ( ! is_user_logged_in() ) {
            header( 'Cache-Control: max-age=' . (5 * MINUTE_IN_SECONDS) );
        }
    }
}

