<?php
/**
 * Exit if accessed directly
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

$listing_page       = isset( $attributes['listingPage'] ) ? $attributes['listingPage'] : false;
$featured_listing   = isset( $attributes['featuredListing'] ) ? $attributes['featuredListing'] : false;
$with_thumbnail     = isset( $attributes['withThumbnail'] ) ? $attributes['withThumbnail'] : false;
$block_post_type    = isset( $attributes['postType'] ) && ! empty( $attributes['postType'] ) ? $attributes['postType'] : 'speakers';
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
$slider_shape       = isset( $attributes['slideShape'] ) ? $attributes['slideShape'] : 'rectangle';
$order_by           = isset( $attributes['orderBy'] ) ? $attributes['orderBy'] : 'date';
$slider_margin      = isset( $attributes['slideMargin'] ) ? $attributes['slideMargin'] : 30;
$speaker_order      = 'date' === $order_by ? 'DESC' : 'ASC';
$arrow_icons        = isset( $attributes['arrowIcons'] ) ? $attributes['arrowIcons'] : 'slider-arrow-1';
$class_name         = isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ? $attributes['className'] : '';
$item_class         = 'circle' === $slider_shape && $slider_active ? '' : 'display-title';

$query              = false;
$final_key          = '';
$cache_key          = $this->mysgb_get_taxonomy_term_cache_key( $taxonomies, $terms );

if ( $featured_listing || ! empty( $cache_key ) || $with_thumbnail ) {
    $final_key  = mb_strimwidth( 'mysgb-speaker-slider-' . $block_post_type . '-' . $order_by . '-' . $posts_per_page . '-' . $featured_listing . '-' . $with_thumbnail .'-' . $cache_key, 0, 170 );
    $query = get_transient( $final_key );
} else {
    $speaker_key = filter_input( INPUT_GET, 'speaker-key', FILTER_SANITIZE_STRING );
    if ( isset( $speaker_key ) && ! empty( $speaker_key ) ) {
        $final_key  = 'mysgb-speaker-slider-' . $block_post_type . '-' . $order_by . '-' . $posts_per_page . '-' .$speaker_key;
        $query      = get_transient( $final_key );
    }
}


if ( false === $query || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {

    $query_args = array(
        'post_type'      => $block_post_type,
        'posts_per_page' => $posts_per_page,
        'orderby'        => $order_by,
        'order'          => $speaker_order,
    );

    if ( ! $listing_page ) {

        if ( $with_thumbnail ) {
            $query_args[ 'meta_key' ] = '_thumbnail_id';
        }

        $tax_query_args = $this->mysgb_get_tax_query_argument( $taxonomies, $terms );

        if ( count( $tax_query_args ) > 1 ) {
            $query_args[ 'tax_query' ] = $tax_query_args;
        }

    } elseif ( ( $listing_page && $featured_listing ) || ( isset( $speaker_key ) && ! empty( $speaker_key ) ) ) {
        $query_args[ 'tax_query' ] = array(
                array(
                    'taxonomy' => 'speaker-categories',
                    'field'    => 'slug',
                    'terms'    => array( 'featured' )
                )
        );
    }

    $query = new WP_Query( $query_args );

    if ( ! empty( $final_key ) && $query->have_posts() ) {
        set_transient( $final_key, $query, 20 * MINUTE_IN_SECONDS + wp_rand( 1, 60 ) );
    }
}

if ( $query->have_posts() || $listing_page ) {

    if ( $listing_page ) {

        require_once( plugin_dir_path( __FILE__ ) . 'filters/html-mysgb-speaker-filter.php' );

        $this->date_picker = true;
        $this->mysgb_enqueue_front_script();
    }
?>
    <div class="slider-arrow-main <?php echo esc_attr( $arrow_icons ); ?> <?php echo esc_attr( $class_name ); ?>">
<?php
        if ( $slider_active ) {
        ?>
            <div class="nab-dynamic-slider items-md nab-box-slider speakers" data-minslides="<?php echo esc_attr( $min_slides );?>" data-slidewidth="<?php echo esc_attr( $slide_width );?>" data-auto="<?php echo esc_attr($autoplay);?>" data-infinite="<?php echo esc_attr($infinite_loop);?>" data-pager="<?php echo esc_attr($pager);?>" data-controls="<?php echo esc_attr($controls);?>" data-speed="<?php echo esc_attr($slider_speed);?>" data-slidemargin="<?php echo esc_attr($slider_margin);?>">
        <?php
        } else {
        ?>
            <div class="nab-dynamic-list nab-box-slider speakers" id="<?php echo $listing_page ? esc_attr('browse-speaker') : ''; ?>">
        <?php
        }

        while ( $query->have_posts() ) {

            $query->the_post();

            $speaker_id = get_the_ID();

            if ( has_post_thumbnail() ) {
                $thumbnail_url = get_the_post_thumbnail_url();
            } else {
                $thumbnail_url = $this->mysgb_get_speaker_thumbnail_url();
            }

            if ( $listing_page ) {
                $featured_post  = has_term( 'featured', 'speaker-categories' ) ? 'featured' : '';
            ?>
                <div class="item <?php echo esc_attr( $item_class ); echo ! $featured_listing && ! empty( $featured_post ) ? esc_attr( ' featured' ) : ''; ?>" data-featured="<?php echo esc_attr( $featured_post ); ?>">
            <?php
            } else {
            ?>
                <div class="item <?php echo esc_attr( $item_class ); ?>">
            <?php
            }

            ?>
                <div class="flip-box">
                    <div class="flip-box-inner">

                        <img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="speaker-logo" class="<?php echo 'circle' === $slider_shape ? esc_attr('rounded-circle') : ''; ?>">

                        <div class="flip-box-back rounded-circle">

                            <h6><?php $this->mysgb_generate_popup_link( $speaker_id, $block_post_type, get_the_title() ); ?></h6>

                            <?php
                             if ( ! $slider_active ) {

                                 $speaker_job_title = get_post_meta( $speaker_id, 'title', true );
                                 $speaker_company   = get_the_terms( $speaker_id, 'speaker-companies' );
                                 $speaker_company   = $this->mysgb_get_pipe_separated_term_list( $speaker_company );
                                ?>

                                <p class="jobtilt"><?php echo esc_attr( $speaker_job_title ); ?></p>
                                <span class="company"><?php echo esc_attr( $speaker_company ); ?></span>

                                <?php
                             }
                             ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
        </div>
        <?php
        if ( $listing_page ) {
            $result_style = $query->have_posts() ? 'display: none;' : 'display: block;';
        ?>
            <p class="no-data" style="<?php echo esc_attr( $result_style ); ?>">Result not found.</p>
            <div class="load-more-sessions text-center <?php echo $query->max_num_pages > 1 ? '' : esc_attr( 'display-none' ); ?>" id="load-more-speaker">
                <a href="javascript:void(0);" class="btn-default" data-page-number="2" data-post-limit="<?php echo esc_attr( $posts_per_page ); ?>" data-total-page="<?php echo absint( $query->max_num_pages ); ?>">Load More</a>
            </div>
        <?php
        }
        ?>
    </div>
<?php
} else {
?>
    <p>No posts found.</p>
<?php
}

wp_reset_postdata();