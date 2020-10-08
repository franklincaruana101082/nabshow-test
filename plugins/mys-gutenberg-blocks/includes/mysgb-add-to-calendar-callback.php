<?php

/**
 * Exit if accessed directly
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

$page_id        = isset( $attributes[ 'pageId' ] ) && ! empty( $attributes[ 'pageId' ] ) ? $attributes[ 'pageId' ] : get_the_ID();
$class_name     = isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ? $attributes['className'] : '';
$session_date   = get_field( 'session_date', $page_id );
$start_time     = get_field( 'start_time', $page_id );
$end_time       = get_field( 'end_time', $page_id );

if ( ! empty( $session_date ) && ! empty( $start_time ) && ! empty( $end_time ) ) {
    $session_date   = date_format( date_create( $session_date ), 'Ymd' );
    $start_time     = date_format( date_create( $start_time ), 'His' );
    $end_time       = date_format( date_create( $end_time ), 'His' );
    $final_time     = $session_date . 'T' . $start_time . '/' . $session_date . 'T' . $end_time;
    $calendar_title = get_the_title( $page_id );
    $location       = get_field( 'session_location', $page_id );
    $calendar_link  = 'https://calendar.google.com/calendar/r/eventedit?text=' . $calendar_title . '&dates=' . $final_time . '&details=' . get_the_permalink( $page_id );
    $calendar_link  = ! empty( $location ) ? $calendar_link . '&location=' . $location : $calendar_link;
    ?>
    <p class="calender-block-title"><a href="<?php echo esc_url( $calendar_link ); ?>" target="_blank">Add to Calendar</a></p>
    <?php
} else {
    ?>
    <p class="calender-block-title">Add to Calendar</p>
    <?php
}