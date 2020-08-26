<?php

/**
 * Exit if accessed directly
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

$page_id    = isset( $attributes[ 'pageId' ] ) && ! empty( $attributes[ 'pageId' ] ) ? $attributes[ 'pageId' ] : get_the_ID();
$item_limit = isset( $attributes[ 'itemToFetch' ] ) && ! empty( $attributes[ 'itemToFetch' ] ) ? $attributes[ 'itemToFetch' ] : 2;
$class_name = isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ? $attributes['className'] : '';
?>
<div class="nabny-sidebar-partners-block-outer <?php echo esc_attr( $class_name ); ?>">
    <h3>Partners and Sponsors</h3>
    <?php
    
    if ( ! empty( $page_id ) ) {
        
        $rows = get_field('add_sponsor_logos');
        
        if ( $rows ) {
            ?>
            <div class="nabny-sidebar-partners-logos">
                <ul>
                <?php
                $cnt = 1;
                foreach( $rows as $row ) {
                    
                    $image = $row[ 'sponsor_logos' ];                
                    ?>
                    <li><img src="<?php echo esc_url( $image['url'] ); ?>" alt="sponsors-logo"></li>
                    <?php
                    if ( $cnt >= $item_limit ) {
                        break;
                    }
                    $cnt++;
                }
                ?>
                </ul>
            </div>
            <?php            
        }
    }
    ?>	
</div>