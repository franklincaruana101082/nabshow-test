<?php
/*
 * Template Name: User Meta Script
 */

get_header();

$user_query = new WP_User_Query( array( 'role' => 'customer', 'fields' => 'ID', 'meta_key' => 'nab_purchased_product_2020', 'meta_compare' => 'NOT EXISTS' ) );


$all_users 	= $user_query->get_results();
echo '<pre>';
print_r( $all_users );
exit;

get_footer();
?>

