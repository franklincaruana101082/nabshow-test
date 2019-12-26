<?php

/**
 * Exit if accessed directly
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

$posts_per_page = isset( $attributes['itemToFetch'] ) && $attributes['itemToFetch'] > 0 ? $attributes['itemToFetch'] : 10;
$category_type  = isset( $attributes['categoryType'] ) && ! empty( $attributes['categoryType'] ) ? $attributes['categoryType'] : 'tracks';
$slider_active  = isset( $attributes['sliderActive'] ) ? $attributes['sliderActive'] : true;
$min_slides     = isset( $attributes['minSlides'] ) ? $attributes['minSlides'] : 4;
$slide_width    = isset( $attributes['slideWidth'] ) ? $attributes['slideWidth'] : 400;
$autoplay       = isset( $attributes['autoplay'] ) ? $attributes['autoplay'] : false;
$infinite_loop  = isset( $attributes['infiniteLoop'] ) ? $attributes['infiniteLoop'] : true;
$pager          = isset( $attributes['pager'] ) ? $attributes['pager'] : false;
$controls       = isset( $attributes['controls'] ) ? $attributes['controls'] : false;
$slider_speed   = isset( $attributes['sliderSpeed'] ) ? $attributes['sliderSpeed'] : 500;
$category_order = isset( $attributes['order'] ) ? $attributes['order'] : 'ASC';
$slider_margin  = isset( $attributes['slideMargin'] ) ? $attributes['slideMargin'] : 30;
$class_name     = isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ? $attributes['className'] : '';
$featured_track = isset( $attributes['featuredTag'] ) ? $attributes['featuredTag'] : false;
$arrow_icons    = isset( $attributes['arrowIcons'] ) ? $attributes['arrowIcons'] : 'slider-arrow-1';
$terms          = false;

if ( $featured_track ) {
    $terms = get_transient( 'mysgb-category-slider-' . $category_type . '-' . $posts_per_page . '-' . $category_order );
}


if ( false === $terms || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {

    $args = array(
        'taxonomy'   => $category_type,
        'hide_empty' => false,
        'number'     => $posts_per_page,
        'orderBy'    => 'name',
        'order'      => $category_order,
    );

    if ( $featured_track ) {
        $args[ 'meta_query' ] = array(
                    array(
                       'key'       => 'featured_tag',
                       'value'     => 'on',
                       'compare'   => '='
                    )
                );
    }

    $terms = get_terms( $args );

    if ( $featured_track ) {
        set_transient( 'mysgb-category-slider-' . $category_type . '-' . $posts_per_page . '-' . $category_order, $terms, 20 * MINUTE_IN_SECONDS + wp_rand( 1, 60 ) );
    }

}

if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
    ?>
        <div class="slider-arrow-main <?php echo esc_attr($arrow_icons); ?> <?php echo esc_attr( $class_name ); ?>">
    <?php

        if ( $slider_active ) {
        ?>
            <div class="nab-dynamic-slider nab-box-slider category-slider <?php echo esc_attr( $category_type ); ?>" data-minslides="<?php echo esc_attr($min_slides);?>" data-slidewidth="<?php echo esc_attr($slide_width);?>" data-auto="<?php echo esc_attr($autoplay);?>" data-infinite="<?php echo esc_attr($infinite_loop);?>" data-pager="<?php echo esc_attr($pager);?>" data-controls="<?php echo esc_attr($controls);?>" data-speed="<?php echo esc_attr($slider_speed);?>" data-slidemargin="<?php echo esc_attr($slider_margin);?>">
        <?php
        } else {
        ?>
            <div class="nab-dynamic-list category-slider <?php echo esc_attr( $category_type ); ?>">
        <?php
        }

        foreach ( $terms as $current_term ) {
             $image_id = get_term_meta( $current_term->term_id, 'tax-image-id', true );
        ?>
            <div class="item">
                <div class="item-inner">
                    <?php
                    if ( ! empty( $image_id ) ) {
                        $image_url = wp_get_attachment_url( $image_id );
                    ?>
                        <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $current_term->name ); ?>">
                    <?php } ?>
                    <h2 class="track-title"><?php echo esc_html( $current_term->name ); ?></h2>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>
<?php
} else {
?>
    <p>Record Not Found.</p>
<?php
}

wp_reset_postdata();