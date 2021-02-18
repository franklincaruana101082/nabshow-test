<?php

/**
 * Template part for displaying content for my events page.
 *
 * @package Amplify
 */

$user_id        = filter_input( INPUT_GET, 'user_id', FILTER_SANITIZE_NUMBER_INT );
$profile_url    = bp_core_get_user_domain( $user_id );

if ( empty( $user_id ) || 0 === $user_id ) {
    
    $user_id = get_current_user_id();
}

$customer_products = nab_get_customer_purchased_product( $user_id );

if ( is_array( $customer_products ) && count( $customer_products ) > 0 ) {
    
    $product_ids_regex  = '"' . implode('"|"', $customer_products ) . '"';

    nab_get_member_event_list( $product_ids_regex, $user_id, false );
    nab_get_member_event_list( $product_ids_regex, $user_id, true );   
}