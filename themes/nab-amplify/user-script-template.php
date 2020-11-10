<?php
/*
 * Template Name: User Meta Script
 */

get_header();

// $user_query = new WP_User_Query( array( 'role' => 'customer', 'fields' => 'ID', 'meta_key' => 'nab_purchased_product_2020', 'meta_compare' => 'NOT EXISTS' ) );

// $all_users 	= $user_query->get_results();


global $wpdb;

$customer_ids = $wpdb->get_col("SELECT DISTINCT meta_value  FROM $wpdb->postmeta
    WHERE meta_key = '_customer_user' AND meta_value > 0");

$op = [];

$offset = ( isset( $_GET['off'] ) && ! empty( $_GET['off'] ) ) ? $_GET['off'] : 0;

$max = 500;

$customer_ids = array_slice( $customer_ids, $offset, $max );

foreach( $customer_ids as $customer_id ) {

    // Get orders of this customer
    $customer_orders = get_posts( array(
        'numberposts' => -1,
        'meta_key'    => '_customer_user',
        'meta_value'  => $customer_id,
        'post_type'   => wc_get_order_types(),
        'post_status' => array( 'wc-completed' ),
        'fields'      => 'ids'
    ) );

    $customer_order_products = [];

    foreach( $customer_orders as $customer_order ) {

        $order = wc_get_order( $customer_order );
        // Get order products
		foreach ( $order->get_items() as $product_item ) {
			$customer_order_products[] = $product_item->get_product_id();
		}
    }

    $customer_order_products = array_unique( $customer_order_products );

    $customer_meta_products = ( get_user_meta( $customer_id, 'nab_purchased_product_2020', true ) ) ? get_user_meta( $customer_id, 'nab_purchased_product_2020', true ) : [];

    echo '<pre>';
    print_r( 'User:' );
    echo '</pre>';

    echo '<pre>';
    print_r( $customer_id  );
    echo '</pre>';

    echo '<pre>';
    print_r( 'User Order Products:' );
    echo '</pre>';

    echo '<pre>';
    print_r( $customer_order_products );
    echo '</pre>';

    echo '<pre>';
    print_r( 'User Meta Products:' );
    echo '</pre>';

    echo '<pre>';
    print_r( $customer_meta_products );
    echo '</pre>';

    $contains_all_product =  ! array_diff( $customer_order_products, $customer_meta_products );

    if( false === $contains_all_product ) {
        $op[] = $customer_id;
    }

    echo '<pre>';
    print_r( '==========================================' );
    echo '</pre>';

}

echo '<pre>';
print_r( 'Missing Users:' );
echo '</pre>';

echo '<pre>';
print_r( $op );
echo '</pre>';

get_footer();
?>

