<?php
/*
 * Template Name: Testing
 */

get_header();

$order_id = 479;

$meta = get_post_meta( $order_id );

echo '<pre>';
print_r( $meta );
echo '</pre>';

get_footer();
