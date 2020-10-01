<?php
/*
 * Template Name: Testing
 */

get_header();

$order_id = 2210;

update_post_meta( $order_id, '_transaction_id', 'AC3A3A037902' );



$order_id = 2547;

update_post_meta( $order_id, '_transaction_id', 'AH3A2FE4D409' );


echo 'done';

get_footer(); 