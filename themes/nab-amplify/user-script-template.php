<?php
/*
 * Template Name: User Meta Script
 */

get_header();

$user_query = new WP_User_Query( array( 'fields' => 'ID' ) );


$all_users 	= $user_query->get_results();

$cnt = 0;
foreach ( $all_users as $user_id ) {
    bp_update_user_last_activity( $user_id );
    $cnt++;
}
?>
<h1>Total user updated: <?php echo esc_html( $cnt ); ?></h1>
<?php

get_footer();
?>

