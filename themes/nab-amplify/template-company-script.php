<?php
/*
 * Template Name: Company Meta Script
 */

get_header();

$company_args = array(
    'post_type'			=> 'company',
    'post_status'		=> 'publish',
    'posts_per_page'	=> -1,
    'fields'			=> 'ids',
    'meta_key'          => 'member_level',
    'meta_value'        => 'Premium'
);

$company_query = new WP_Query($company_args);

echo '<pre>';
print_r( $company_query->posts);

wp_reset_postdata();

get_footer();
