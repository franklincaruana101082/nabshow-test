<?php

/**
 * Exit if accessed directly
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

$page_id        = isset( $attributes[ 'pageId' ] ) && ! empty( $attributes[ 'pageId' ] ) ? $attributes[ 'pageId' ] : get_the_ID();
$item_limit     = isset( $attributes[ 'itemToFetch' ] ) && ! empty( $attributes[ 'itemToFetch' ] ) ? $attributes[ 'itemToFetch' ] : 2;
$block_title    = isset( $attributes[ 'blockTitle' ] ) && ! empty( $attributes[ 'blockTitle' ] ) ? $attributes[ 'blockTitle' ] : 'Partners and Sponsors';
$class_name     = isset( $attributes[ 'className' ] ) && ! empty( $attributes[ 'className' ] ) ? $attributes[ 'className' ] : '';

if ( ! empty( $page_id ) ) {
        
    $rows = get_field( 'add_sponsor_logos', $page_id );
    
    if ( $rows ) {
        ?>
        <div class="nabny-sidebar-partners-block-outer <?php echo esc_attr( $class_name ); ?>">
            <h3><?php echo esc_html( $block_title ); ?></h3>
            <div class="nabny-sidebar-partners-logos">
                <ul>                
                    <?php
                    $cnt = 1;

                    foreach( $rows as $row ) {
                        
                        $image  = $row[ 'sponsor_logos' ];
                        $link   = $row[ 'sponsor_link' ];

                        if ( ! empty( $image ) ) {
                            
                            if ( ! empty( $link ) ) {
                                ?>
                                <li>
                                    <a href="<?php echo esc_url( $link ); ?>"><img src="<?php echo esc_url( $image['url'] ); ?>" alt="sponsors-logo"></a>
                                </li>
                                <?php
                            } else {
                                ?>
                                <li><img src="<?php echo esc_url( $image['url'] ); ?>" alt="sponsors-logo"></li>
                                <?php
                            }                        
                            
                            if ( $cnt >= $item_limit ) {
                                break;
                            }
                            
                            $cnt++;
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>    
        <?php            
    }
}