<?php

/**
 * Exit if accessed directly
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

$page_id        = isset( $attributes[ 'pageId' ] ) && ! empty( $attributes[ 'pageId' ] ) ? $attributes[ 'pageId' ] : get_the_ID();
$item_limit     = isset( $attributes[ 'itemToFetch' ] ) && ! empty( $attributes[ 'itemToFetch' ] ) ? $attributes[ 'itemToFetch' ] : 4;
$block_title    = isset( $attributes[ 'blockTitle' ] ) && ! empty( $attributes[ 'blockTitle' ] ) ? $attributes[ 'blockTitle' ] : 'Related Exhibitors';
$class_name     = isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ? $attributes['className'] : '';
?>
<div class="nabny-sidebar-partners-block-outer <?php echo esc_attr( $class_name ); ?>">
    <h3><?php echo esc_html( $block_title ); ?></h3>
    <?php

    if ( ! empty( $page_id ) ) {

        $exhibitor_term_id = get_field( 'exhibitors_term', $page_id );

        if ( ! empty( $exhibitor_term_id ) ) {

            $cache_key  = 'related-exhibitors-' . $exhibitor_term_id . '-' . $page_id . '-' . $item_limit;
            $query      = get_transient( $cache_key );

            if ( false === $query || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {

                $query_args = array(
                    'post_type'         => 'exhibitors',
                    'posts_per_page'    => $item_limit,
                    'fields'            => 'ids',
                    'meta_key'          => '_thumbnail_id',
                    'tax_query'         => array(
                        array(
                            'taxonomy' => 'exhibitor-categories',
                            'field'    => 'term_id',
                            'terms'    => $exhibitor_term_id,
                        )
                    )
                );

                $query = new WP_Query( $query_args );

                if ( $query->have_posts() ) {
                    set_transient( $cache_key, $query, 20 * MINUTE_IN_SECONDS + wp_rand( 1, 60 ) );
                }
            }
            
            if ( $query->have_posts() ) {                
                ?>
                <div class="nabny-sidebar-partners-logos">
                    <ul>
                    <?php

                    while( $query->have_posts() ) {
                        
                        $query->the_post();
                                                
                        if ( has_post_thumbnail() ) {
                            
                            ?>
                            <li><img src="<?php echo esc_url( get_the_post_thumbnail_url() ); ?>" alt="exhibitor-logo"></li>
                            <?php
                        }                                                
                    }
                    ?>
                    </ul>
                </div>
                <?php
            }
            wp_reset_postdata();
        }
    }
    ?>
</div>
