<?php

/**
 * Exit if accessed directly
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

$block_post_type    = isset( $attributes['postType'] ) && ! empty( $attributes['postType'] ) ? $attributes['postType'] : 'post';
$taxonomies         = isset( $attributes['taxonomies'] ) && ! empty( $attributes['taxonomies'] ) ? $attributes['taxonomies'] : array();
$terms              = isset( $attributes['terms'] ) && ! empty( $attributes['terms'] ) ? json_decode( $attributes['terms'] ): array();
$posts_per_page     = isset( $attributes['itemToFetch'] ) && $attributes['itemToFetch'] > 0 ? $attributes['itemToFetch'] : 10;
$slider_active      = isset( $attributes['sliderActive'] ) ? $attributes['sliderActive'] : true;
$min_slides         = isset( $attributes['minSlides'] ) ? $attributes['minSlides'] : 4;
$slide_width        = isset( $attributes['slideWidth'] ) ? $attributes['slideWidth'] : 400;
$autoplay           = isset( $attributes['autoplay'] ) ? $attributes['autoplay'] : false;
$infinite_loop      = isset( $attributes['infiniteLoop'] ) ? $attributes['infiniteLoop'] : true;
$pager              = isset( $attributes['pager'] ) ? $attributes['pager'] : false;
$controls           = isset( $attributes['controls'] ) ? $attributes['controls'] : false;
$slider_speed       = isset( $attributes['sliderSpeed'] ) ? $attributes['sliderSpeed'] : 500;
$order_by           = isset( $attributes['orderBy'] ) ? $attributes['orderBy'] : 'date';
$slider_margin      = isset( $attributes['slideMargin'] ) ? $attributes['slideMargin'] : 30;
$block_order        = 'date' === $order_by ? 'DESC' : 'ASC';
$display_title      = isset( $attributes['displayTitle'] ) ? $attributes['displayTitle'] : false;
$arrow_icons        = isset( $attributes['arrowIcons'] ) ? $attributes['arrowIcons'] : 'slider-arrow-1';
$class_name         = isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ? $attributes['className'] : '';

$cache_key          = $this->mysgb_get_taxonomy_term_cache_key( $taxonomies, $terms );
$final_key          = mb_strimwidth( 'mysgb-dynamic-slider-' . $block_post_type . '-' . $order_by . '-' . $posts_per_page . '-' . $cache_key, 0, 170 );
$query              = get_transient( $final_key );

if ( false === $query || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {
    $query_args = array(
        'post_type'      => $block_post_type,
        'posts_per_page' => $posts_per_page,
        'orderby'        => $order_by,
        'order'          => $block_order,
        'meta_key'       => '_thumbnail_id',
    );

    $tax_query_args = $this->mysgb_get_tax_query_argument( $taxonomies, $terms );

    if ( count( $tax_query_args ) > 1 ) {
        $query_args[ 'tax_query' ] = $tax_query_args;
    }

    $query = new WP_Query( $query_args );

    set_transient( $final_key, $query, 20 * MINUTE_IN_SECONDS + wp_rand( 1, 60 ) );
}

if ( $query->have_posts() ) {
?>
    <div class="slider-arrow-main <?php echo esc_attr($arrow_icons); ?>">
<?php
        if ( $slider_active ) {
        ?>
            <div class="nab-dynamic-slider items-md nab-box-slider <?php echo esc_attr($class_name); ?>" data-minslides="<?php echo esc_attr($min_slides);?>" data-slidewidth="<?php echo esc_attr($slide_width);?>" data-auto="<?php echo esc_attr($autoplay);?>" data-infinite="<?php echo esc_attr($infinite_loop);?>" data-pager="<?php echo esc_attr($pager);?>" data-controls="<?php echo esc_attr($controls);?>" data-speed="<?php echo esc_attr($slider_speed);?>" data-slidemargin="<?php echo esc_attr($slider_margin);?>">
        <?php
        } else {
        ?>
            <div class="nab-dynamic-list nab-box-slider <?php echo esc_attr($class_name); ?>">
        <?php
        }

        while ( $query->have_posts() ) {
            $query->the_post();
            $thumbnail_url = get_the_post_thumbnail_url();
        ?>
            <div class="<?php echo $display_title ? esc_attr( 'item display-title' ) : esc_attr( 'item' ); ?>">
            <?php
            if ( $display_title ) {
            ?>
                <div class="flip-box">
                    <div class="flip-box-inner">
            <?php
            }
            if ( 'page' === $block_post_type ) {
            ?>
                <a href="<?php echo esc_url( get_the_permalink() ); ?>">
            <?php
            }

            the_post_thumbnail('dynamic-slide' );

            if ( 'page' === $block_post_type ) {
            ?>
                </a>
            <?php
            }
            if ( $display_title ) {
            ?>
                        <div class="flip-box-back rounded-circle">
                            <h6>
                            <?php
                            if ( 'page' === $block_post_type ) {
                            ?>
                                <a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo esc_html( get_the_title() ); ?></a>
                            <?php
                            } else {
                                echo esc_html( get_the_title() );
                            }
                            ?>
                            </h6>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
            </div>
        <?php
        }
        ?>
        </div>
    </div>
<?php
} else {
?>
    <p>No posts found.</p>
<?php
}

wp_reset_postdata();
