<?php
/*
 * Template Name: Testing
 */

 get_header();

 global $wpdb;

 $t = $wpdb->get_results( "SHOW TABLES LIKE '%cocart_carts%'". ARRAY_A );

 echo '<pre>';
 print_r( $t );
 echo '</pre>';

 get_footer();