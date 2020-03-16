<?php
/**
 * Exit if accessed directly
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

$listing_page      = isset( $attributes['listingPage'] ) ? $attributes['listingPage'] : false;
$with_thumbnail    = isset( $attributes['withThumbnail'] ) ? $attributes['withThumbnail'] : false;
$block_post_type   = isset( $attributes['postType'] ) && ! empty( $attributes['postType'] ) ? $attributes['postType'] : 'exhibitors';
$taxonomies        = isset( $attributes['taxonomies'] ) && ! empty( $attributes['taxonomies'] ) ? $attributes['taxonomies'] : array();
$terms             = isset( $attributes['terms'] ) && ! empty( $attributes['terms'] ) ? json_decode( $attributes['terms'] ): array();
$posts_per_page    = isset( $attributes['itemToFetch'] ) && $attributes['itemToFetch'] > 0 ? $attributes['itemToFetch'] : 10;
$taxonomy_relation = isset( $attributes['taxonomyRelation'] ) && $attributes['taxonomyRelation'] ? 'AND' : 'OR';
$slider_active     = isset( $attributes['sliderActive'] ) ? $attributes['sliderActive'] : true;
$min_slides        = isset( $attributes['minSlides'] ) ? $attributes['minSlides'] : 4;
$slide_width       = isset( $attributes['slideWidth'] ) ? $attributes['slideWidth'] : 400;
$img_width         = isset( $attributes['imgWidth'] ) ? $attributes['imgWidth'] : 135;
$autoplay          = isset( $attributes['autoplay'] ) ? $attributes['autoplay'] : false;
$infinite_loop     = isset( $attributes['infiniteLoop'] ) ? $attributes['infiniteLoop'] : true;
$pager             = isset( $attributes['pager'] ) ? $attributes['pager'] : false;
$controls          = isset( $attributes['controls'] ) ? $attributes['controls'] : false;
$slider_speed      = isset( $attributes['sliderSpeed'] ) ? $attributes['sliderSpeed'] : 500;
$order_by          = isset( $attributes['orderBy'] ) ? $attributes['orderBy'] : 'date';
$slider_margin     = isset( $attributes['slideMargin'] ) ? $attributes['slideMargin'] : 30;
$display_logo      = isset( $attributes['displayLogo'] ) ? $attributes['displayLogo'] : true;
$display_name      = isset( $attributes['displayName'] ) ? $attributes['displayName'] : true;
$display_booth     = isset( $attributes['displayBooth'] ) ? $attributes['displayBooth'] : true;
$display_summary   = isset( $attributes['displaySummary'] ) ? $attributes['displaySummary'] : true;
$display_plink     = true === $attributes['displayPlannerLink'] ? 'true' : 'false';
$class_name        = isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ? $attributes['className'] : '';
$exhibitor_order   = 'date' === $order_by ? 'DESC' : 'ASC';
$arrow_icons       = isset( $attributes['arrowIcons'] ) ? $attributes['arrowIcons'] : 'slider-arrow-1';

$final_key         = '';
$cache_key         = $this->mysgb_get_taxonomy_term_cache_key( $taxonomies, $terms );
$display_class     = '';

if ( ! $display_logo ) {
		$display_class .= 'without-logo ';
}
if ( ! $display_name ) {
	$display_class .= 'without-name ';
}
if ( ! $display_booth ) {
	$display_class .= 'without-booth ';
}
if ( ! $display_summary ) {
	$display_class .= 'without-summary ';
}

if ( ! empty( $display_class ) ) {
	$class_name .= rtrim( $display_class );
}

if ( ( ! $listing_page && ! empty( $cache_key ) ) || $with_thumbnail ) {

	$final_key  = mb_strimwidth( 'mysgb-exhibitor-slider-' . $block_post_type . '-' . $order_by . '-' . $posts_per_page . '-' . $taxonomy_relation . '-' . $with_thumbnail . $cache_key, 0, 170 );
    $query      = get_transient( $final_key );

} else {

    $get_exkey      = filter_input( INPUT_GET, 'exhibitor-key', FILTER_SANITIZE_STRING );
    $get_category   = filter_input( INPUT_GET, 'exhibitor-cat', FILTER_SANITIZE_STRING );
    $get_pavilion   = filter_input( INPUT_GET, 'exhibitor-pav', FILTER_SANITIZE_STRING );

    if ( isset( $get_exkey ) && ! empty( $get_exkey ) ) {

    	$final_key  = 'mysgb-exhibitors-browse-post-cache-' . $get_exkey . '-' . $posts_per_page;
        $query      = get_transient( $final_key );

    } elseif ( isset( $get_category ) && ! empty( $get_category ) ) {

    	$final_key  = 'mysgb-exhibitors-browse-post-cache-' . $get_category . '-' . $posts_per_page;
        $query      = get_transient( $final_key );

    } elseif ( isset( $get_pavilion ) && ! empty( $get_pavilion ) ) {

    	$final_key  = 'mysgb-exhibitors-browse-post-cache-' . $get_pavilion . '-' . $posts_per_page;
        $query      = get_transient( $final_key );

    } else {
    	$query = false;
    }
}

if ( false === $query || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {

    $query_args = array(
        'post_type'      => $block_post_type,
    );

    if ( 'rand' === $order_by ) {
    	$query_args['posts_per_page']       = 100;
		$query_args['fields']               = 'ids';
		$query_args['no_found_rows']        = true;
		$query_args['ignore_sticky_posts']  = true;
    } else {
    	$query_args['posts_per_page']       = $posts_per_page;
		$query_args['orderby']              = $order_by;
		$query_args['order']                = $exhibitor_order;
    }

    if ( ! $listing_page ) {

        if ( $with_thumbnail ) {
            $query_args[ 'meta_key' ] = '_thumbnail_id';
        }

        $tax_query_args = $this->mysgb_get_tax_query_argument( $taxonomies, $terms, $taxonomy_relation );

        if ( count( $tax_query_args ) > 1 ) {
            $query_args[ 'tax_query' ] = $tax_query_args;
        }

    } elseif ( isset( $get_exkey ) && ! empty( $get_exkey ) ) {

    	$query_args[ 'tax_query' ] = array(
                array(
                    'taxonomy' => 'exhibitor-keywords',
                    'field'    => 'slug',
                    'terms'    => array( $get_exkey )
                )
        );
    } elseif ( isset( $get_category ) && ! empty( $get_category ) ) {

    	$query_args[ 'tax_query' ] = array(
                array(
                    'taxonomy' => 'exhibitor-categories',
                    'field'    => 'slug',
                    'terms'    => array( $get_category )
                )
        );
    } elseif ( isset( $get_pavilion ) && ! empty( $get_pavilion ) ) {

    	$query_args[ 'tax_query' ] = array(
                array(
                    'taxonomy' => 'pavilions',
                    'field'    => 'slug',
                    'terms'    => array( $get_pavilion )
                )
        );
    }

    $query = new WP_Query( $query_args );

    if ( ! empty( $final_key ) && $query->have_posts() ) {
        set_transient( $final_key, $query, 20 * MINUTE_IN_SECONDS + wp_rand( 1, 60 ) );
    }
}

if ( 'rand' === $order_by && $query->have_posts() ) {
	$post_ids = $query->posts;
	shuffle( $post_ids );
	$post_ids = array_splice( $post_ids, 0, $posts_per_page );
	$query    = new WP_Query( array( 'post_type' => $block_post_type, 'post__in' => $post_ids, 'posts_per_page' =>  count( $post_ids ), 'orderby' => 'post__in' ) );
}

if ( $query->have_posts() || $listing_page ) {

    if ( $listing_page ) {

        include( plugin_dir_path( __FILE__ ) . 'filters/html-mysgb-exhibitor-filter.php' );
    }

    $show_code = $this->mysgb_get_mys_show_code();
?>
    <div class="slider-arrow-main <?php echo esc_attr($arrow_icons); ?> <?php echo esc_attr( $class_name ); ?>">

    <?php
    if ( $slider_active ) {
    ?>
        <div class="nab-dynamic-slider nab-box-slider exhibitors" data-minslides="<?php echo esc_attr($min_slides);?>" data-slidewidth="<?php echo esc_attr($slide_width);?>" data-auto="<?php echo esc_attr($autoplay);?>" data-infinite="<?php echo esc_attr($infinite_loop);?>" data-pager="<?php echo esc_attr($pager);?>" data-controls="<?php echo esc_attr($controls);?>" data-speed="<?php echo esc_attr($slider_speed);?>" data-slidemargin="<?php echo esc_attr($slider_margin);?>">
        <input type="hidden" class="display_plink" value="<?php echo esc_attr( $display_plink ); ?>">
    <?php
    } else {
    ?>
        <div class="nab-dynamic-list exhibitors" id="<?php echo $listing_page ? esc_attr('browse-exhibitor') : ''; ?>" data-plannerlink="<?php echo esc_attr( $display_plink ) ?>">
    <?php
    }

        while ( $query->have_posts() ) {

            $query->the_post();

            $exhibitor_id   = get_the_ID();
            $crossreferences = get_post_meta( $exhibitor_id, 'crossreferences', true );

            if ( $listing_page ) {

                $featured_post  = has_term( 'featured', 'exhibitor-keywords' ) ? 'featured' : '';
                ?>
                <div class="item <?php echo esc_attr( $featured_post ); ?>" data-featured="<?php echo esc_attr( $featured_post ); ?>">
                <?php
            } else {
                ?>
                <div class="item">
                <?php
            }
                ?>
                <div class="item-inner">
                    <?php
                    if ( has_post_thumbnail() && $display_logo ) {

                    	if ( $slider_active ) {
                            ?>
                            <a href="#" class="detail-list-modal-popup" data-postid="<?php echo esc_attr( $exhibitor_id ); ?>" data-posttype="<?php echo esc_attr( $block_post_type ); ?>" data-plannerlink="<?php echo esc_attr($display_plink) ?>">
                            <?php
                        }
                        ?>
                            <img src="<?php echo esc_url( get_the_post_thumbnail_url() . '?w=' . $img_width ); ?>" alt="exhibitor-logo">
                        <?php
                        if ( $slider_active ) {
                            ?>
                            </a>
                            <?php
                        }

                    } elseif ( $slider_active && $display_name ) {
                        ?>
                         <h4 class="exhibitor-title"><?php $this->mysgb_generate_popup_link( $exhibitor_id, $block_post_type, get_the_title(), '', $display_plink ); ?></h4>
                        <?php
                    }

                    if ( ! $slider_active ) {

                        $exh_id       = get_post_meta( $exhibitor_id, 'exhid', true );
                        $exh_url      = 'https://' . $show_code . '.mapyourshow.com/8_0/exhibitor/exhibitor-details.cfm?exhid=' . $exh_id;

                        if ( $display_name ) {
                            ?>
                            <h4><?php $this->mysgb_generate_popup_link( $exhibitor_id, $block_post_type, get_the_title(), '', $display_plink ); ?></h4>
                            <?php
                        }

                        if ( $display_booth ) {

                        	$booth_number = get_post_meta( $exhibitor_id, 'boothnumbers', true );
                        	?>
                        	<span><?php echo esc_html( $booth_number ); ?></span>
                        	<?php
                        }

                        if ( $display_summary ) {

                        	?>
                        	<p>
	                        <?php
	                            echo esc_html( get_the_excerpt() );
	                            $this->mysgb_generate_popup_link( $exhibitor_id, $block_post_type, 'Read More', 'read-more-popup', $display_plink);
	                        ?>
	                        </p>
                        	<?php
                        }

                        if ( !empty( $crossreferences ) ) {
                        	?> <span class="crossreferences"><?php echo "Also Known As: $crossreferences"; ?></span> <?php
                        }

                        if( 'true' === $display_plink ) { ?>
                            <a href="<?php echo esc_url( $exh_url ); ?>" target="_blank">View in Planner</a>
                        <?php }
                    }
                    ?>
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
        <div class="load-more-sessions text-center <?php echo $query->max_num_pages > 1 ? '' : esc_attr( 'display-none' ); ?>" id="load-more-exhibitor">
            <a href="javascript:void(0);" class="btn-default" data-page-number="2" data-post-limit="<?php echo esc_attr( $posts_per_page ); ?>" data-total-page="<?php echo absint( $query->max_num_pages ); ?>">Load More</a>
        </div>
    <?php
    }
    ?>
</div>
<?php
} else {
?>
    <p class="coming-soon">Coming soon.</p>
<?php
}

wp_reset_postdata();
