<?php
/*
 * Template Name: User Meta Script
 */

get_header();

global $wpdb;

$meta_query = $wpdb->get_results("SELECT * FROM `wp_usermeta` WHERE `meta_key` LIKE 'attendee_location'");

print_r($meta_query); exit;

$user_query = new WP_User_Query( array( 'meta_key' => 'attendee_location' ) );


$all_users 	= $user_query->get_results();

?>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Location</th>
        <th>Login</th>
        <th>First Name</th>
        <th>Last Name</th>
    </tr>
<?php

foreach ( $all_users as $current_user ) {
    
    $attendee_location  = get_user_meta( $current_user->ID, 'attendee_location', true );
    $first_name         = get_user_meta( $current_user->ID, 'first_name', true );
    $last_name          = get_user_meta( $current_user->ID, 'last_name', true );
    ?>
    <tr>
        <td><?php echo esc_html( $current_user->ID ); ?></td>
        <td><?php echo esc_html( $attendee_location ); ?></td>
        <td><?php echo esc_html( $current_user->user_login ); ?></td>
        <td><?php echo esc_html( $first_name ); ?></td>
        <td><?php echo esc_html( $last_name ); ?></td>
    </tr>
    <?php
}
?>
</table>
<?php
get_footer();
?>

