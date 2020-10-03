<?php
/*
 * Template Name: Testing
 */

get_header();

global $wpdb;

$order_id = 4051;


$d = $wpdb->query( $wpdb->prepare( "DELETE FROM {$wpdb->prefix}nab_attendee WHERE order_id = %d AND status = 0", $order_id ) );

$q = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}nab_attendee WHERE order_id = %d", $order_id ) , ARRAY_A);


echo '<pre>';
print_r( $q );
echo '</pre>';

get_footer(); 