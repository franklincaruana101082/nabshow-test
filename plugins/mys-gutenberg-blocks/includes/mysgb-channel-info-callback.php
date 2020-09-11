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
<div class="nabny-sidebar-block-outer <?php echo esc_attr( $class_name ); ?>">
    <?php
    
    if ( ! empty( $page_id ) ) {
        
        if ( has_post_thumbnail( $page_id ) ) {
            ?>
            <img src="<?php echo esc_url( get_the_post_thumbnail_url( $page_id ) ); ?>" alt="ppeb">
            <?php
        }
        $date               = get_field( 'channel_date',  $page_id );
        $date_separator     = get_field( 'date_separator',  $page_id );
        $end_date           = get_field( 'end_date',  $page_id );
        $registration_url   = get_field( 'registration_url',  $page_id );
        $location           = get_field( 'session_location',  $page_id );        
        $is_open_to         = get_field( 'is_open_to',  $page_id );
        $is_open_to         = 'Select Open To' === $is_open_to ? '' : $is_open_to;
        $final_date         = ! empty( $end_date ) ? $date . ' ' . $date_separator . ' ' . $end_date : $date;
        ?>        
        <div class="nabny-sidebar-block-meta-wrapper">
            <span><?php echo esc_html( $final_date ); ?></span>
            <span><?php echo esc_html( $location ); ?></span>
            <?php
            if ( ! empty( $is_open_to ) ) {
                ?>
                <span><?php echo esc_html( $is_open_to ); ?></span>
                <?php
            }
            ?>
            
        </div>
        <div class="nabny-sidebar-block-desc">
            <p><?php echo esc_html( get_the_excerpt( $page_id ) ); ?></p>
        </div>        
        <?php
        if ( ! empty( $registration_url ) ) {
            ?>
            <div class="nabny-sidebar-block-link">
                <a href="<?php echo esc_url( $registration_url ); ?>">Register Now</a>
            </div>
            <?php
        }
    } else {
        ?>
        <p class="coming-soon">Coming soon.</p>
        <?php
    }
    ?>	
</div>