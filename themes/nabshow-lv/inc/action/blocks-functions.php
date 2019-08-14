<?php
/**
 * This file contains all gutenberg blocks action functions.
 *
 *
 * @package NABShow_LV
 */

/*
 * Register dynamic blocks
 * @since 1.0
 */
function nabshow_lv_register_dynamic_blocks() {

	register_block_type( 'nab/not-to-be-missed-slider', array(
			'attributes'      => array(
				'blockTitle'  => array(
				    'type'    => 'string',
					'default' => 'Not-To-Be-Missed',
				),
			    'itemToFetch'  => array(
					'type'    => 'number',
					'default' => 10,
				),
				'postType'     => array(
					'type'    => 'string',
					'default' => 'ntb-missed',
				),
				'taxonomies'   => array(
					'type'    => 'array',
					'default' => [],
					'items'   => [
						'type' => 'string'
					]
				),
				'terms'        => array(
					'type' => 'string'
				),
				'sliderActive' => array(
					'type'    => 'boolean',
					'default' => true
				),
				'minSlides'    => array(
					'type'    => 'number',
					'default' => 4
				),
				'autoplay'     => array(
					'type'    => 'boolean',
					'default' => false
				),
				'infiniteLoop' => array(
					'type'    => 'boolean',
					'default' => true
				),
				'pager'        => array(
					'type'    => 'boolean',
					'default' => false
				),
				'controls'     => array(
					'type'    => 'boolean',
					'default' => true
				),
				'sliderSpeed'  => array(
					'type'    => 'number',
					'default' => 500
				),
				'sliderMode'   => array(
					'type'    => 'string',
					'default' => 'horizontal'
				),
				'slideWidth'   => array(
					'type'    => 'number',
					'default' => 400
				),
				'orderBy'      => array(
					'type'    => 'string',
					'default' => 'date'
				),
				'slideMargin'  => array(
					'type'    => 'number',
					'default' => 30
				),
				'arrowIcons' => array(
                    'type' => 'string',
                    'default' => 'slider-arrow-1'
                ),
                'clientId' => array(
                    'type' => 'string',
                    'default' => null
                )

			),
			'render_callback' => 'nabshow_lv_no_to_be_missed_slider_render_callback',
		)
	);

	register_block_type( 'nab/latest-show', array(
			'attributes'      => array(
				'itemToFetch'  => array(
					'type'    => 'number',
					'default' => 1,
				),
				'postType'     => array(
					'type'    => 'string',
					'default' => 'post',
				),
				'taxonomies'   => array(
					'type'    => 'array',
					'default' => [],
					'items'   => [
						'type' => 'string'
					]
				),
				'terms'        => array(
					'type' => 'string'
				),
				'orderBy'      => array(
					'type'    => 'string',
					'default' => 'date'
				),
				'postLayout' => array(
                    'type' => 'string',
                    'default' => 'default'
				),
			),
			'render_callback' => 'nabshow_lv_latest_show_news_render_callback',
		)
	);

	register_block_type( 'nab/advertisement', array(
            'attributes' => array(
                'imgSource'  => array(
                    'type' => 'string'
                ),
                'imgID'      => array(
                    'type'      => 'number'
                ),
                'imgWidth'   => array(
                    'type'      => 'number'
                ),
                'imgHeight'  => array(
                    'type'      => 'number'
                ),
                'linkURL'    => array(
                    'type'      => 'string'
                ),
                'linkTarget' => array(
                    'type'      => 'boolean',
                    'default'   => true
                ),
                'startDate'  => array(
                    'type'      => 'string'
                ),
                'endDate'    => array(
                    'type'      => 'string'
                ),
                'eventCategory'    => array(
                    'type'      => 'string'
                ),
                'eventAction'    => array(
                    'type'      => 'string'
                ),
                'eventLabel'    => array(
                    'type'      => 'string'
                )
            ),
            'render_callback' => 'nabshow_lv_advertisement_render_callback',
        )
    );
}

/**
 * Fetch dynamic Not to be Missed slider item/slide according to attributes
 * @param $attributes
 * @return string
 */
function nabshow_lv_no_to_be_missed_slider_render_callback( $attributes ) {
    $block_title    = isset( $attributes['blockTitle'] ) && ! empty( $attributes['blockTitle'] ) ? $attributes['blockTitle'] : 'Not-To-Be-Missed';
    $post_type      = isset( $attributes['postType'] ) && ! empty( $attributes['postType'] ) ? $attributes['postType'] : 'ntb-missed';
    $terms          = isset( $attributes['terms'] ) && ! empty( $attributes['terms'] ) ? json_decode( $attributes['terms'], true ): array();
    $posts_per_page = isset( $attributes['itemToFetch'] ) && $attributes['itemToFetch'] > 0 ? $attributes['itemToFetch'] : 10;
    $slider_active  = isset( $attributes['sliderActive'] ) ? $attributes['sliderActive'] : true;
    $min_slides     = isset( $attributes['minSlides'] ) ? $attributes['minSlides'] : 4;
    $slide_width    = isset( $attributes['slideWidth'] ) ? $attributes['slideWidth'] : 400;
    $autoplay       = isset( $attributes['autoplay'] ) ? $attributes['autoplay'] : false;
    $infinite_loop  = isset( $attributes['infiniteLoop'] ) ? $attributes['infiniteLoop'] : true;
    $pager          = isset( $attributes['pager'] ) ? $attributes['pager'] : false;
    $controls       = isset( $attributes['controls'] ) ? $attributes['controls'] : false;
    $slider_speed   = isset( $attributes['sliderSpeed'] ) ? $attributes['sliderSpeed'] : 500;
    $slider_mode    = isset( $attributes['sliderMode'] ) ? $attributes['sliderMode'] : 'horizontal';
	$order_by       = isset( $attributes['orderBy'] ) ? $attributes['orderBy'] : 'date';
	$slider_margin  = isset( $attributes['slideMargin'] ) ? $attributes['slideMargin'] : 30;
	$arrow_icons    = isset( $attributes['arrowIcons'] ) ? $attributes['arrowIcons'] : 'slider-arrow-1';
	$client_id      = isset( $attributes['clientId'] ) && ! empty( $attributes['clientId'] ) ? $attributes['clientId'] : '';
	$order          = 'date' === $order_by ? 'DESC' : 'ASC';

    $query          = get_transient( 'nab-not-to-be-missed-slider-post-cache' . $post_type );

    if ( false === $query || is_user_logged_in() ) {
        $query_args = array(
            'post_type'      => $post_type,
            'posts_per_page' => $posts_per_page,
            'orderby'        => $order_by,
            'order'          => $order,
            'meta_key'       => '_thumbnail_id',
        );

        $query = new WP_Query($query_args);

        set_transient( 'nab-not-to-be-missed-slider-post-cache' . $post_type, $query, 20 * MINUTE_IN_SECONDS + wp_rand( 1, 60 ) );
    }

    ob_start();

    if ( $query->have_posts() ) {
	?>
		<div class="not-to-be-slider slider-arrow-main <?php echo esc_attr($arrow_icons); ?>">

		    <div class="slider-card-filter">
                <h2><?php echo esc_html($block_title); ?></h2>
                <?php
                if ( count( array_filter( ( array_values( $terms ) ) ) ) > 0 ) {
                ?>
                    <ul class="filter-list" id="filter_list">
                        <li data-term-slug="">All</li>
                        <?php
                            foreach ( $terms as $term_arr ) {
                                foreach ( $term_arr as $term ) {
                                ?>
                                    <li data-term-slug="<?php echo esc_attr( $term['value'] ); ?>"><?php echo esc_html( $term['label'] ); ?></li>
                                <?php
                                }
                            }
                        ?>
                    </ul>
                <?php
                }
                ?>
            </div>
            <div class='container loader-container' id="loader_container" style="display: none">
                <div class='loader'>
                    <div class='loader--dot'></div>
                    <div class='loader--dot'></div>
                    <div class='loader--dot'></div>
                    <div class='loader--dot'></div>
                    <div class='loader--dot'></div>
                    <div class='loader--dot'></div>
                    <div class='loader--text'></div>
                </div>
            </div>
	<?php
			if ( $slider_active ) {
			?>
				<div class="nab-not-to-be-missed-slider nab-box-slider" id="<?php echo esc_attr( $client_id ); ?>" data-item="<?php echo esc_attr( $posts_per_page ); ?>" data-minslides="<?php echo esc_attr($min_slides);?>" data-slidewidth="<?php echo esc_attr($slide_width);?>" data-auto="<?php echo esc_attr($autoplay);?>" data-infinite="<?php echo esc_attr($infinite_loop);?>" data-pager="<?php echo esc_attr($pager);?>" data-controls="<?php echo esc_attr($controls);?>" data-speed="<?php echo esc_attr($slider_speed);?>" data-mode="<?php echo esc_attr($slider_mode);?>" data-slidemargin="<?php echo esc_attr($slider_margin);?>">
			<?php
			} else {
			?>
				<div class="nab-not-to-be-missed-list" id="<?php echo esc_attr( $client_id ); ?>">
			<?php
			}

			while ( $query->have_posts() ) {
				$query->the_post();

				$all_categories_name = array();
                $categories          = get_the_terms( get_the_ID(), 'portfolio-category' );

                if ( is_array( $categories ) ) {
                    foreach ( $categories as $category ) {
                        $all_categories_name[] = $category->name;
                    }
                }

                $categories_string = implode(', ',$all_categories_name );
			?>

			<div class="cards item">
                <?php the_post_thumbnail(); ?>
                <div class="card-details">
                    <h2 class="title"><?php the_title(); ?></h2>
                    <span class="sub-category">- <?php echo esc_html( $categories_string ) ?></span>
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
        <p>No posts found.</p>
    <?php
    }

    wp_reset_postdata();

    $html = ob_get_clean();
    return $html;
}

/**
 * Fetch dynamic latest show news according to attributes
 * @param $attributes
 * @return string
 */
function nabshow_lv_latest_show_news_render_callback($attributes){

    $post_type      = isset( $attributes['postType'] ) && ! empty( $attributes['postType'] ) ? $attributes['postType'] : 'post';
    $taxonomies     = isset( $attributes['taxonomies'] ) && ! empty( $attributes['taxonomies'] ) ? $attributes['taxonomies'] : array();
    $terms          = isset( $attributes['terms'] ) && ! empty( $attributes['terms'] ) ? json_decode( $attributes['terms'] ): array();
    $posts_per_page = isset( $attributes['itemToFetch'] ) && $attributes['itemToFetch'] > 0 ? $attributes['itemToFetch'] : 1;
    $post_layout    = isset( $attributes['postLayout'] ) && !empty ($attributes['postLayout'] ) ? $attributes['postLayout'] : 'default';
    $image_class    = 'left' === $post_layout ? 'news-side-img' : '';
    $order_by       = isset( $attributes['orderBy'] ) ? $attributes['orderBy'] : 'date';
	$order          = 'date' === $order_by ? 'DESC' : 'ASC';

    $query          = get_transient( 'nab-get-latest-show-news-cache' . $post_type );
    if ( false === $query ) {
        $query_args = array(
            'post_type'      => $post_type,
            'posts_per_page' => $posts_per_page,
            'orderby'        => $order_by,
            'order'          => $order,
        );

        $tax_query_args = array('relation' => 'OR');

        foreach ( $taxonomies as $taxonomy ) {
            if ( isset($terms->{$taxonomy}) && count($terms->{$taxonomy}) > 0 ) {
                $tax_query_args[] = array (
                    'taxonomy' => $taxonomy,
                    'field'    => 'slug',
                   'terms'    => $terms->{$taxonomy},
                );
            }
        }

        $count_query_args = count($tax_query_args);

       if ( $count_query_args > 0 ) {
            $query_args['tax_query'] = $tax_query_args;
        }

        $query = new WP_Query($query_args);

        set_transient( 'nab-get-latest-show-news-cache' . $post_type, $query, 20 * MINUTE_IN_SECONDS + wp_rand( 1, 60 ) );
    }

    ob_start();

    if ( $query->have_posts() ) {

	?>
	<?php
			while ( $query->have_posts() ) {
				$query->the_post();
				$thumbnail_url = has_post_thumbnail() ? esc_url( get_the_post_thumbnail_url() ) : esc_url( nabshow_lv_get_empty_thumbnail_url() );
	            $excerpt = get_the_excerpt();
			?>
			<div class="news-block <?php echo esc_attr($image_class); ?>">
			<?php if ( 'default' !== $post_layout ) { ?>
			    <div class="news-img-block">
                    <img src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                 </div>
              <?php
                }
			?>
              <div class="news-datas">
			    <h4><?php echo esc_html( get_the_title() ); ?></h4>
			    <p> <?php echo esc_html( $excerpt ) ?> </p>
                    <a href="<?php echo esc_url(get_the_permalink()); ?>" class="read-more">Read More</a>

			  </div>
			<?php
			}
			?>
			</div>
    <?php
    } else {
    ?>
        <p> No posts found.</p>
    <?php
    }

    wp_reset_postdata();

    $html = ob_get_clean();
    return $html;

}

/**
 * Display ad on front side according to attribute
 * @param $attributes
 * @return string
 */
function nabshow_lv_advertisement_render_callback( $attributes ) {
    ob_start();
    if ( defined( 'REST_REQUEST' ) && REST_REQUEST ) {
    ?>
        <p style="display:none">Advertisement</p>
    <?php
    } else {
        if( isset( $attributes['startDate'] ) && isset( $attributes['endDate'] ) ) {
            $class_name           = isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ? $attributes['className'] : '';
            $img_source           = isset( $attributes['imgSource'] ) && ! empty( $attributes['imgSource'] ) ? $attributes['imgSource'] : '';
            $img_width            = isset( $attributes['imgWidth'] ) && $attributes['imgWidth'] > 0 ? $attributes['imgWidth'] . 'px' : '';
            $img_height           = isset( $attributes['imgHeight'] ) && $attributes['imgHeight'] > 0 ? $attributes['imgHeight'] . 'px' : '';

            $start_date           = new DateTime( $attributes['startDate'] );
            $start_date           = $start_date->format( 'Y-m-d H:i:s' );
            $end_date             = new DateTime( $attributes['endDate'] );
            $end_date             = $end_date->format( 'Y-m-d H:i:s' );
	        $current_date         = date( 'Y-m-d H:i:s', current_time( 'timestamp' ) );

            if ( $start_date <= $current_date && $current_date <= $end_date ) {
            ?>
                <div class="nab-banner-main <?php echo esc_attr( $class_name ); ?>">
                    <?php
                    if ( isset( $attributes['linkURL'] ) && ! empty( $attributes['linkURL'] ) ) {
                        $link_target       = isset( $attributes['linkTarget'] ) && $attributes['linkTarget'] ? '_blank' : '_self';
                        $event_category    = isset( $attributes['eventCategory'] ) && ! empty( $attributes['eventCategory'] ) ? $attributes['eventCategory'] : '';
                        $event_action      = isset( $attributes['eventAction'] ) && ! empty( $attributes['eventAction'] ) ? $attributes['eventAction'] : '';
                        $event_label       = isset( $attributes['eventLabel'] ) && ! empty( $attributes['eventLabel'] ) ? $attributes['eventLabel'] : '';
                    ?>
                        <a href="<?php echo esc_url( $attributes['linkURL'] ); ?>" target="<?php echo esc_attr( $link_target ); ?>" data-category="<?php echo esc_attr( $event_category ); ?>" data-action="<?php echo esc_attr( $event_action ); ?>" data-label="<?php echo esc_attr( $event_label ); ?>">
                            <img src="<?php echo esc_url( $img_source ); ?>" class="banner-img" alt="image" width="<?php echo esc_attr( $img_width ); ?>" height="<?php echo esc_attr( $img_height ); ?>" />
                        </a>
                    <?php
                    } else {
                    ?>
                        <img src="<?php echo esc_url( $img_source ); ?>" class="banner-img" alt="image" width="<?php echo esc_attr( $img_width ); ?>" height="<?php echo esc_attr( $img_height ); ?>" />
                    <?php
                    }
                    ?>
                </div>
            <?php
            }
        }
    }

    $html = ob_get_clean();
    return $html;
}