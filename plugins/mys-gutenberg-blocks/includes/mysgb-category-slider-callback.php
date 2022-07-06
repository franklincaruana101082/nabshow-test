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
$category_halls = isset( $attributes['categoryHalls'] ) && ! empty( $attributes['categoryHalls'] ) ? $attributes['categoryHalls'] : array();
$include_terms  = isset( $attributes['includeTerms'] ) && ! empty( $attributes['includeTerms'] ) ? $attributes['includeTerms'] : array();
$cache_key      = '';
$terms          = false;

if ( ( $featured_track && 'session-categories' !== $category_type ) || ( count( $category_halls ) > 0 && 'exhibitor-categories' === $category_type ) ) {

	$hall_key       = count( $category_halls ) > 0 && 'exhibitor-categories' === $category_type ? implode( '-', $category_halls ) : '';
	$include_list   = count ( $include_terms ) > 0 ? implode( '-', $include_terms ) : '';
	$cache_key      = 'mysgb-category-slider-' . $category_type . '-' . $posts_per_page . '-' . $category_order . '-' . $featured_track . '-' . $hall_key . '-' . $include_list;
    $terms          = get_transient( $cache_key );
}


if ( false === $terms || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {

    $args = array(
        'taxonomy'   => $category_type,
        'hide_empty' => false,
        'orderBy'    => 'name',
        'order'      => 'ASC',
    );

    if ( is_array( $include_terms ) && count( $include_terms ) > 0 ) {

    	$args[ 'include' ] = $include_terms;
    }

    if ( 'rand' === $category_order ) {
    	$args[ 'number' ] = 100;
    } else {
    	$args[ 'number' ] = $posts_per_page;
    }

    if ( ( $featured_track && 'session-categories' !== $category_type ) || ( count( $category_halls ) > 0 && 'exhibitor-categories' === $category_type ) ) {

    	$meta_query_args = array( 'relation' => 'AND' );

    	if ( count( $category_halls ) > 0 && 'exhibitor-categories' === $category_type ) {

    		$inner_meta_query_args = array( 'relation' => 'OR' );

    		foreach ( $category_halls as $hall ) {

				$inner_meta_query_args[] = array (
                            'key'       => 'category_halls',
                            'value'     => $hall,
                            'compare'   => 'LIKE',
                        );
			}

    		if ( count( $inner_meta_query_args ) > 1 ) {

    			$meta_query_args[] = $inner_meta_query_args;
    		}
    	}

    	if ( $featured_track ) {

    		$meta_query_args[] = array(
                        'key'       => 'featured_tag',
                        'value'     => 'on',
                        'compare'   => '='
                    );
    	}

    	if ( count( $meta_query_args ) > 1 ) {
    		$args[ 'meta_query' ] = $meta_query_args;
    	}
    }

    $terms = get_terms( $args );

    if ( ! empty( $cache_key ) ) {
        set_transient( $cache_key, $terms, 20 * MINUTE_IN_SECONDS + wp_rand( 1, 60 ) );
    }

}

if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {

	if ( 'rand' === $category_order ) {
		shuffle($terms);
		$terms = array_splice( $terms, 0, $posts_per_page );
	}

	$site_url   = get_site_url();

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

        $show_code = $this->mysgb_get_mys_show_code();

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
                        <?php
                    }
                    if ( 'exhibitor-categories' === $category_type ) {

                    	$mys_cat_link   = $site_url . '/explore/exhibits/browse-exhibitors/?exhibitor-cat='. $current_term->slug;
						?>
						<h2 class="track-title"><a href="<?php echo esc_url( $mys_cat_link ); ?>"><?php echo esc_html( $current_term->name ); ?></a></h2>
						<?php

					} elseif ( 'tracks' === $category_type ) {
                        $session_track_link = 'https://' . $show_code . '.mapyourshow.com/8_0/sessions/#/searchtype/sessiontrack/search/' . $current_term->name . '/show/all';
						?>
						<h2 class="track-title"><a href="<?php echo esc_url( $session_track_link ); ?>" target="_blank"><?php echo esc_html( $current_term->name ); ?></a></h2>
						<?php

					} elseif ( 'session-categories' === $category_type ) {

                    	$category_id    = get_term_meta( $current_term->term_id, 'categoryid', true );
                        $category_link  = 'https://' . $show_code . '.mapyourshow.com/8_0/sessions/#/searchtype/sessioncategory15/search/' . $category_id . '/show/all';
						?>
						<h2 class="track-title"><a href="<?php echo esc_url( $category_link ); ?>" target="_blank"><?php echo esc_html( $current_term->name ); ?></a></h2>
						<?php

                    } else {
                    	?>
                        <h2 class="track-title"><?php echo esc_html( $current_term->name ); ?></h2>
                    	<?php
                    }
                    ?>
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
    <p class="coming-soon">Coming soon.</p>
<?php
}

wp_reset_postdata();
