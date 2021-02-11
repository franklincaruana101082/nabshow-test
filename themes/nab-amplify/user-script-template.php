<?php
/*
 * Template Name: User Meta Script
 */

get_header();

global $wpdb;

$user_query = new WP_User_Query(  array('orderby' => 'login') );

$all_users 	= $user_query->get_results();
$cnt = 0;

foreach ( $all_users as $current_user ) {
    bp_update_user_last_activity( $current_user->ID );
    $cnt++;
}
echo "Total user update = " . $cnt;
get_footer();
?>