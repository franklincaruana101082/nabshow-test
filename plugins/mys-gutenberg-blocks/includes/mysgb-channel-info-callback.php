<?php

/**
 * Exit if accessed directly
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

$page_id = isset( $attributes[ 'pageId' ] ) && ! empty( $attributes[ 'pageId' ] ) ? $attributes[ 'pageId' ] : get_the_ID();
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
        $date       = get_field( 'channel_date',  $page_id );
        $location   = get_field( 'session_location',  $page_id );
        $open_to    = get_field( 'is_open_to',  $page_id );
        ?>        
        <div class="nabny-sidebar-block-meta-wrapper">
            <span><?php echo esc_html( $date ); ?></span>
            <span><?php echo esc_html( $location ); ?></span>
            <?php
            if ( $open_to ) {
                ?>
                <span>Open To</span>
                <?php
            }
            ?>
            
        </div>
        <div class="nabny-sidebar-block-desc">
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