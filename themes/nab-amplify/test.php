<?php
/*
 * Template Name: Testing
 */

get_header();

$order_id = 2259;

update_post_meta( $order_id, '_transaction_id', 'AM0A2E8ECA67' );

$meta = get_post_meta( $order_id );

echo '<pre>';
print_r( $meta );
echo '</pre>';

get_footer();