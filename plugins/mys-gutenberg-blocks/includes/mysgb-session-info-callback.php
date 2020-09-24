<?php

/**
 * Exit if accessed directly
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

$page_id    = isset( $attributes[ 'pageId' ] ) && ! empty( $attributes[ 'pageId' ] ) ? $attributes[ 'pageId' ] : get_the_ID();
$class_name = isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ? $attributes['className'] : '';
?>
<div class="nabny-session-block-outer <?php echo esc_attr( $class_name ); ?>">
    <?php
    
    if ( ! empty( $page_id ) ) {
        
        $session_img_url    = has_post_thumbnail( $page_id ) ? get_the_post_thumbnail_url( $page_id ) : plugins_url( 'assets/images/session-placeholder.png', dirname( __FILE__ ) );
        $location           = get_field( 'session_location',  $page_id );
        $is_open_to         = get_field( 'is_open_to',  $page_id );
        $is_open_to         = 'Select Open To' === $is_open_to ? '' : $is_open_to;
        $date               = get_post_meta( $page_id, 'session_date', true );
        $start_time         = get_post_meta( $page_id, 'start_time', true );
        $end_time           = get_post_meta( $page_id, 'end_time', true );

        if ( ! empty( $start_time ) ) {

            $start_time = str_replace( array( 'am','pm' ), array( 'a.m.','p.m.' ), date_format( date_create( $start_time ), 'g:i a' ) );
            $start_time = str_replace(':00', '', $start_time );

        }
        if ( ! empty( $end_time ) ) {

            $end_time   = str_replace( array( 'am','pm' ), array( 'a.m.','p.m.' ), date_format( date_create( $end_time ), 'g:i a' ) );
            $end_time   = str_replace(':00', '', $end_time );

        }
        
        if ( false !== strpos( $start_time, 'a.m.' ) && false !== strpos( $end_time, 'a.m.' ) ) {
            $start_time = str_replace(' a.m.', '', $start_time );
        }

        if ( false !== strpos( $start_time, 'p.m.' ) && false !== strpos( $end_time, 'p.m.' ) ) {
            $start_time = str_replace(' p.m.', '', $start_time );
        }
        
        $date_time      = date_format( date_create( $date ), 'l, F j, Y' ) . ' | ' . $start_time . ' - ' .$end_time . ' ET';
        $channel        = get_field( 'session_channel',  $page_id );
        $channel_title  = get_the_title( $channel );
        $channel_link   = get_the_permalink( $channel );
        ?>
        <div class="nabny-session-info">
            <div class="nabny-session-image">                
                <img src="<?php echo esc_url( $session_img_url ); ?>" alt="session-img">
            </div>
            <div class="nabny-session-info-wrap">
                <h4><?php echo esc_html( get_the_title( $page_id ) ); ?></h4>
            </div>
	    </div>
        <div class="nabny-session-desc-wrapper">
                <div class="session-meta">
                	<p><?php echo esc_html( $date_time ); ?></p>
                	<!--<p><?php echo esc_html( $location ); ?></p>-->
                	<p><?php echo esc_html( $is_open_to ); ?></p>
                	<p><a href="<?php echo esc_url( $channel_link ); ?>"><?php echo esc_html( $channel_title ); ?></a></p>
                </div>
            <p><?php echo esc_html( get_the_excerpt( $page_id ) ); ?></p>
        </div>
        <?php
    } else {
        ?>
        <p class="coming-soon">Coming soon.</p>
        <?php 
    }
    ?>
</div>