<?php
/*
 * Template Name: Testing
 */

get_header();

$order_id = 2211;

update_post_meta( $order_id, '_transaction_id', 'AI3A9DEF3E5C' );

$meta = get_post_meta( $order_id );

echo '<pre>';
print_r( $meta );
echo '</pre>';

get_footer();
