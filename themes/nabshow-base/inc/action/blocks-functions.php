<?php
/**
 * This file contains all gutenberg blocks action functions.
 *
 *
 * @package NABShow_LV
 */

/*
 * Register dynamic blocks
 *
 * @since 1.0.0
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
					'default' => 'not-to-be-missed',
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
			'render_callback' => 'nabshow_lv_not_to_be_missed_slider_render_callback',
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
                'imgSources'  => array(
                    'type'    => 'object',
					'default' => [],
                ),
                'imgWidth'   => array(
                    'type'      => 'number'
                ),
                'imgHeight'  => array(
                    'type'      => 'number'
                ),
                'linkTarget' => array(
                    'type'      => 'boolean',
                    'default'   => true
                ),
                'scheduleAd' => array(
                    'type'      => 'boolean',
                    'default'   => false
                ),
                'startDate'  => array(
                    'type'      => 'string'
                ),
                'endDate'    => array(
                    'type'      => 'string'
                ),
                'addAlign'    => array(
                    'type'      => 'string',
                    'default'   => 'center'
                )
            ),
            'render_callback' => 'nabshow_lv_advertisement_render_callback',
        )
    );

	register_block_type( 'nab/related-content', array(
            'attributes' => array(
                'parentPageId'  => array(
                    'type' => 'string'
                ),
                'itemToFetch'  => array(
                    'type' => 'number',
                    'default' => 10
                ),
                'depthLevel' => array(
                    'type' => 'string',
                    'default' => 'grandchildren'
                ),
                'featuredPage' => array(
                    'type'    => 'boolean',
                    'default' => false
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
                'slideWidth'   => array(
                    'type'    => 'number',
                    'default' => 400
                ),
                'slideMargin'  => array(
                    'type'    => 'number',
                    'default' => 30
                ),
                'arrowIcons' => array(
                    'type' => 'string',
                    'default' => 'slider-arrow-1'
                ),
                'displayField' => array(
                    'type'    => 'array',
                    'default' => [],
                    'items'   => [
                        'type' => 'string'
                    ]
                ),
                'hallList' => array(
                    'type'    => 'array',
                    'default' => [],
                    'items'   => [
                        'type' => 'string'
                    ]
                ),
                'topicList' => array(
                    'type'    => 'array',
                    'default' => [],
                    'items'   => [
                        'type' => 'string'
                    ]
                ),
                'listingLayout'  => array(
                    'type' => 'string',
                    'default' => 'destination'
                ),
                'sliderLayout'  => array(
                    'type' => 'string',
                    'default' => 'img-only'
                ),
                'showFilter'    => array(
                    'type' => 'boolean',
                    'default' => false
                ),
                'dropdownTitle' => array(
                    'type' => 'string'
                ),
                'excludePages' => array(
                	'type' => 'string',
                	'default' => ''
                ),
                'orderBy' => array(
                	'type' => 'string',
                	'default' => ''
                ),
                'includePages' => array(
                	'type' => 'string',
                	'default' => ''
                ),
                'metaDate'    => array(
                    'type'    => 'boolean',
                    'default' => false
                ),
	            'pageMetaDate' => array(
                	'type' => 'string'
                )
            ),
            'render_callback' => 'nabshow_lv_related_content_render_callback',
        )
    );

	register_block_type( 'nab/contributors-authors', array(
            'attributes' => array(
                'postType'  => array(
                    'type' => 'string'
                ),
                'itemToFetch'  => array(
                    'type' => 'number',
                    'default' => 10
                ),
            ),
            'render_callback' => 'nabshow_lv_contributors_render_callback',
        )
    );

	register_block_type( 'nab/related-content-with-block', array(
            'attributes' => array(
                'pageId'  => array(
                    'type' => 'number'
                ),
                'showFilter'  => array(
                    'type' => 'boolean',
                    'default' => false
                ),
                'filterType'  => array(
                    'type' => 'string',
                    'default' => 'opportunities'
                )
            ),
            'render_callback' => 'nabshow_lv_related_content_with_block_render_callback',
        )
    );

	register_block_type( 'nab/page-featured-image', array(
            'attributes' => array(
                'pageSlug'  => array(
                    'type' => 'string'
                ),
            ),
            'render_callback' => 'nabshow_lv_page_featured_image_render_callback',
        )
    );

	register_block_type( 'nab/site-forms', array(
            'attributes' => array(
                'formType'  => array(
                    'type' => 'string',
                    'default' => 'startup-loft'
                ),
                'formEmail'  => array(
                    'type' => 'string',
                    'default' => ''
                )
            ),
            'render_callback' => 'nabshow_lv_site_forms_render_callback',
        )
    );
}

/**
 * Fetch dynamic Not to be Missed slider item/slide according to attributes.
 *
 * @param $attributes
 *
 * @return string
 *
 * @since 1.0.0
 */
function nabshow_lv_not_to_be_missed_slider_render_callback( $attributes ) {

    $block_title    = isset( $attributes['blockTitle'] ) && ! empty( $attributes['blockTitle'] ) ? $attributes['blockTitle'] : 'Not-To-Be-Missed';
    $post_type      = isset( $attributes['postType'] ) && ! empty( $attributes['postType'] ) ? $attributes['postType'] : 'not-to-be-missed';
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
	$class_name     = isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ? $attributes['className'] : '';
	$order          = 'date' === $order_by ? 'DESC' : 'ASC';

    $query          = get_transient( 'nab-ntb-missed-slider-' . $post_type . '-' . $order_by . '-' . $posts_per_page );

    if ( false === $query || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {
        $query_args = array(
            'post_type'      => $post_type,
            'posts_per_page' => $posts_per_page,
            'orderby'        => $order_by,
            'order'          => $order,
            'meta_key'       => '_thumbnail_id',
        );

        $query = new WP_Query($query_args);

        set_transient( 'nab-ntb-missed-slider-' . $post_type . '-' . $order_by . '-' . $posts_per_page . $post_type, $query, 20 * MINUTE_IN_SECONDS + wp_rand( 1, 60 ) );
    }

    ob_start();

    if ( $query->have_posts() ) {
		?>
		<div class="not-to-be-slider slider-arrow-main <?php echo esc_attr($arrow_icons); ?> <?php echo esc_attr( $class_name ); ?>">

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
                <div class="loader"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
            </div>
			<?php
			if ( $slider_active ) {
			?>
				<div class="nab-not-to-be-missed-slider nab-box-slider ntbm-parent" id="<?php echo esc_attr( $client_id ); ?>" data-item="<?php echo esc_attr( $posts_per_page ); ?>" data-minslides="<?php echo esc_attr($min_slides);?>" data-slidewidth="<?php echo esc_attr($slide_width);?>" data-auto="<?php echo esc_attr($autoplay);?>" data-infinite="<?php echo esc_attr($infinite_loop);?>" data-pager="<?php echo esc_attr($pager);?>" data-controls="<?php echo esc_attr($controls);?>" data-speed="<?php echo esc_attr($slider_speed);?>" data-mode="<?php echo esc_attr($slider_mode);?>" data-slidemargin="<?php echo esc_attr($slider_margin);?>">
			<?php
			} else {
			?>
				<div class="nab-not-to-be-missed-list ntbm-parent" id="<?php echo esc_attr( $client_id ); ?>" data-item="<?php echo esc_attr( $posts_per_page ); ?>">
			<?php
			}

			while ( $query->have_posts() ) {
				$query->the_post();

                $categories          = get_the_terms( get_the_ID(), 'featured-category' );
                $categories_list     = nabshow_lv_get_pipe_separated_term_list( $categories );
			?>

			<div class="cards item">
			    <a href="<?php echo esc_url( get_the_permalink() ); ?>">
                    <?php the_post_thumbnail(); ?>
                    <div class="card-details">
                        <h2 class="title"><?php the_title(); ?></h2>
                        <span class="sub-category">- <?php echo esc_html( $categories_list ) ?></span>
                    </div>
                </a>
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

    $html = ob_get_clean();

    return $html;
}

/**
 * Fetch dynamic latest show news according to attributes.
 *
 * @param $attributes
 *
 * @return string
 *
 * @since 1.0.0
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
	$query          = false;
	$cache_key      = nabshow_lv_get_taxonomy_term_cache_key( $taxonomies, $terms );
    $final_key      = '';

	if ( ! empty( $cache_key ) ) {
        $final_key      = mb_strimwidth( 'nab-get-latest-show-news-' . $post_type . '-' . $order_by . '-' . $posts_per_page . '-' . $cache_key, 0, 170 );
        $query          = get_transient( $final_key );
    }

    if ( false === $query || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {

        $query_args = array(
            'post_type'      => $post_type,
            'posts_per_page' => $posts_per_page,
            'orderby'        => $order_by,
            'order'          => $order,
        );

        $tax_query_args = nabshow_lv_get_tax_query_argument( $taxonomies, $terms );

        if ( count( $tax_query_args ) > 0 ) {
            $query_args[ 'tax_query' ] = $tax_query_args;
        }

        $query = new WP_Query( $query_args );

        if ( ! empty( $cache_key ) ) {
            set_transient( $final_key, $query, 20 * MINUTE_IN_SECONDS + wp_rand( 1, 60 ) );
        }
    }

    ob_start();

    if ( $query->have_posts() ) {

	?>
	<?php
			while ( $query->have_posts() ) {
				$query->the_post();
				$thumbnail_url = has_post_thumbnail() ? esc_url( get_the_post_thumbnail_url() ) : esc_url( nabshow_lv_get_empty_thumbnail_url() );
	            $excerpt = nabshow_lv_excerpt();
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
        <p class="coming-soon">Coming soon.</p>
    <?php
    }

    wp_reset_postdata();

    $html = ob_get_clean();
    return $html;

}

/**
 * Display ad on front side according to attribute.
 *
 * @param $attributes
 *
 * @return string
 *
 * @since 1.0.0
 */
function nabshow_lv_advertisement_render_callback( $attributes ) {

    $current_date = date( 'Y-m-d H:i:s', current_time( 'timestamp' ) );
    $class_name   = isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ? $attributes['className'] : '';
    $img_sources   = isset( $attributes['imgSources'] ) && ! empty( $attributes['imgSources'] ) ? $attributes['imgSources'] : array();
    $schedule_ad  = isset( $attributes['scheduleAd'] ) ? $attributes['scheduleAd'] : false;
    $img_style    = isset( $attributes['imgWidth'] ) && $attributes['imgWidth'] > 0 ? 'width: ' . $attributes['imgWidth'] . 'px;' : '';
    $img_style    .= isset( $attributes['imgHeight'] ) && $attributes['imgHeight'] > 0 ? 'height: ' . $attributes['imgHeight'] . 'px;' : '';
    $adv_align    = isset( $attributes['addAlign'] ) && ! empty( $attributes['addAlign']) ? 'text-align: ' . $attributes['addAlign'] : '';
    $start_date   = isset( $attributes['startDate'] ) && ! empty( $attributes['startDate'] ) ? $attributes['startDate'] : $current_date;
    $end_date     = isset( $attributes['endDate'] ) && ! empty( $attributes['endDate'] ) ? $attributes['endDate'] : $current_date;

    $start_date   = new DateTime( $start_date );
    $start_date   = $start_date->format( 'Y-m-d H:i:s' );
    $end_date     = new DateTime( $end_date );
    $end_date     = $end_date->format( 'Y-m-d H:i:s' );

    $img_url        = '';
    $link_url       = '';
    $event_category = '';
    $event_action   = '';
    $event_label    = '';

    if ( count( $img_sources ) > 0 ) {

        $random_key     = array_rand( $img_sources, 1 );
        $img_url        = isset( $img_sources[ $random_key ][ 'url' ] ) ? $img_sources[ $random_key ][ 'url' ] : $img_url;
        $link_url       = isset( $img_sources[ $random_key ][ 'bannerLink' ] ) ? $img_sources[ $random_key ][ 'bannerLink' ] : $link_url;
	    $event_category = isset( $img_sources[ $random_key ][ 'eventCategory' ] ) ? $img_sources[ $random_key ][ 'eventCategory' ] : $event_category;
	    $event_action   = isset( $img_sources[ $random_key ][ 'eventAction' ] ) ? $img_sources[ $random_key ][ 'eventAction' ] : $event_action;
	    $event_label    = isset( $img_sources[ $random_key ][ 'eventLabel' ] ) ? $img_sources[ $random_key ][ 'eventLabel' ] : $event_label;
    }

    ob_start();

    if ( ( ! $schedule_ad ) || ( $start_date <= $current_date && $current_date <= $end_date ) ) {
    ?>
        <div class="nab-banner-main <?php echo esc_attr( $class_name ); ?>" style="<?php echo esc_attr( $adv_align ); ?>">
            <div class="nab-banner-inner">
                <p class="banner-text">Advertisement</p>
                <?php

                if ( ! empty( $link_url ) ) {
                    $link_target       = isset( $attributes['linkTarget'] ) && $attributes['linkTarget'] ? '_blank' : '_self';
                ?>
                    <a class="nab-banner-link" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>" data-category="<?php echo esc_attr( $event_category ); ?>" data-action="<?php echo esc_attr( $event_action ); ?>" data-label="<?php echo esc_attr( $event_label ); ?>">
                        <img src="<?php echo esc_url( $img_url ); ?>" class="banner-img" alt="banner-image" style="<?php echo esc_attr( $img_style ); ?>"/>
                    </a>
                <?php
                } else {
                ?>
                    <img src="<?php echo esc_url( $img_url ); ?>" class="banner-img" alt="banner-image" style="<?php echo esc_attr( $img_style ); ?>"/>
                <?php
                }
                ?>
            </div>
        </div>
    <?php
    }

    $html = ob_get_clean();

    return $html;
}

/**
 * Get related/child page according to attributes.
 *
 * @param $attributes
 *
 * @return string
 *
 * @since 1.0.0
 */
function nabshow_lv_related_content_render_callback( $attributes ) {

    $parent_page_id   = isset( $attributes['parentPageId'] ) && ! empty( $attributes['parentPageId'] ) ? $attributes['parentPageId'] : '';
    $featured_page    = isset( $attributes['featuredPage'] ) ? $attributes['featuredPage'] : false;
    $post_limit       = isset( $attributes['itemToFetch'] ) && ! empty( $attributes['itemToFetch'] ) ? $attributes['itemToFetch'] : 10;
    $depth_level      = isset( $attributes['depthLevel'] ) && ! empty( $attributes['depthLevel'] ) ? $attributes['depthLevel'] : 'grandchildren';
    $listing_layout   = isset( $attributes['listingLayout'] ) && ! empty( $attributes['listingLayout'] ) ? $attributes['listingLayout'] : 'destination';
    $show_filter      = isset( $attributes['showFilter'] ) ? $attributes['showFilter'] : false;
    $slider_layout    = isset( $attributes['sliderLayout'] ) && ! empty( $attributes['sliderLayout'] ) ? $attributes['sliderLayout'] : 'img-only';
    $class_name       = isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ? $attributes['className'] : '';
    $slider_active    = isset( $attributes['sliderActive'] ) ? $attributes['sliderActive'] : true;
    $min_slides       = isset( $attributes['minSlides'] ) ? $attributes['minSlides'] : 4;
    $slide_width      = isset( $attributes['slideWidth'] ) ? $attributes['slideWidth'] : 400;
    $autoplay         = isset( $attributes['autoplay'] ) ? $attributes['autoplay'] : false;
    $infinite_loop    = isset( $attributes['infiniteLoop'] ) ? $attributes['infiniteLoop'] : true;
    $pager            = isset( $attributes['pager'] ) ? $attributes['pager'] : false;
    $controls         = isset( $attributes['controls'] ) ? $attributes['controls'] : false;
    $slider_speed     = isset( $attributes['sliderSpeed'] ) ? $attributes['sliderSpeed'] : 500;
    $slider_margin    = isset( $attributes['slideMargin'] ) ? $attributes['slideMargin'] : 30;
    $arrow_icons      = isset( $attributes['arrowIcons'] ) ? $attributes['arrowIcons'] : 'slider-arrow-1';
    $child_field      = 'grandchildren' === $depth_level ? 'child_of' : 'parent';
    $display_field    = isset( $attributes['displayField'] ) && ! empty( $attributes['displayField'] ) ? $attributes['displayField'] : array();
    $hall_list        = isset( $attributes['hallList'] ) && ! empty( $attributes['hallList'] ) ? $attributes['hallList'] : array();
    $topic_list       = isset( $attributes['topicList'] ) && ! empty( $attributes['topicList'] ) ? $attributes['topicList'] : array();
    $order_by         = isset( $attributes['orderBy'] ) && ! empty( $attributes['orderBy'] ) ? $attributes['orderBy'] : 'title';
    $exclude_pages    = isset( $attributes['excludePages'] ) && ! empty( $attributes['excludePages'] ) ? explode( ',' , str_replace( ' ', '', $attributes['excludePages'] ) ) : array();
    $include_pages    = isset( $attributes['includePages'] ) && ! empty( $attributes['includePages'] ) ? explode( ',' , str_replace( ' ', '', $attributes['includePages'] ) ) : array();

    ob_start();

    if ( ! empty( $parent_page_id ) ) {

        $args = array( $child_field => $parent_page_id );

        $children = get_pages( $args );

		if ( ( isset( $attributes['metaDate'] ) && $attributes['metaDate'] ) || 'grandchildren' === $depth_level || 'menu_order' === $order_by || 'rand' === $order_by || ( is_array( $hall_list ) && count( $hall_list ) > 0 ) || ( is_array( $topic_list ) && count( $topic_list ) > 0 ) || ( is_array( $include_pages ) && count( $include_pages ) > 0 ) ) {

			$children_ids   = wp_list_pluck( $children, 'ID' );
			$children_ids   = array_merge( $children_ids, $include_pages);
			$children       = false;
			$cache_key      = '';

			if ( ( is_array( $hall_list ) && count( $hall_list ) > 0 )  || ( is_array( $topic_list ) && count( $topic_list ) > 0 ) || ( isset( $attributes['metaDate'] ) && $attributes['metaDate'] ) ) {

	            $cache_key = 'related-content-meta-' . $depth_level . '-' . $parent_page_id . '-' . $post_limit . '-' . implode( '-', $hall_list ) . '-' . implode( '-', $topic_list );

	            if ( isset( $attributes['metaDate'] ) && $attributes['metaDate'] ) {
	            	$cache_key .= '-' . $attributes['pageMetaDate'];
	            }

	            $children = get_transient( $cache_key );
	        }

			if ( false === $children || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {

	            $query_args = array(
	                'post_type'         => 'page',
	                'suppress_filters'  => false
	            );

	            $query_args['include']  = $children_ids;

	            if ( isset( $attributes['metaDate'] ) && $attributes['metaDate'] ) {

		            $page_meta_date     = new DateTime( $attributes['pageMetaDate'] );
		            $page_meta_date     = $page_meta_date->format( 'Ymd' );
		            $query_args['meta_key']   = 'date_group_$_page_dates';
		            $query_args['meta_value'] = $page_meta_date;
		        }

	            if ( 'rand' === $order_by ) {

	            	shuffle( $children_ids );

			        $children_ids           = array_splice( $children_ids, 0, count( $children_ids ) );
			        $query_args['orderby']  = 'post__in';

			    } elseif ( 'menu_order' === $order_by ) {

	            	$query_args['orderby']  = $order_by;
			        $query_args['order']    = 'ASC';

	            } else {
			        $query_args['orderby']  = 'title';
			        $query_args['order']    = 'ASC';
	            }

	            $query_args['numberposts']  = count( $children_ids );

	            if ( ! empty( $cache_key ) ) {

	            	$hall_list_args     = array();
	            	$topic_list_args    = array();

					if ( is_array( $hall_list ) && count( $hall_list ) > 0 ) {

						foreach ( $hall_list as $hall_type ) {

							$hall_list_args[] = array (
			                            'key'       => 'page_hall',
			                            'value'     => $hall_type,
			                            'compare'   => 'LIKE',
			                        );
						}
					}

					if ( is_array( $topic_list ) && count( $topic_list ) > 0 ) {

						foreach ( $topic_list as $topic_type ) {

							$topic_list_args[] = array (
			                            'key'       => 'topics',
			                            'value'     => $topic_type,
			                            'compare'   => 'LIKE',
			                        );
						}
					}

					if ( count( $hall_list_args ) > 0 && count( $topic_list_args ) > 0 ) {

						$hall_list_args     = array_merge( array( 'relation' => 'OR' ), $hall_list_args );
						$topic_list_args    = array_merge( array( 'relation' => 'OR' ), $topic_list_args );

						$query_args[ 'meta_query' ] = array( 'relation' => 'AND', $hall_list_args, $topic_list_args );

					} elseif ( count( $hall_list_args ) > 0 ) {

						$query_args[ 'meta_query' ] = array_merge( array( 'relation' => 'OR' ), $hall_list_args );

					} elseif ( count( $topic_list_args ) > 0 ) {

						$query_args[ 'meta_query' ] = array_merge( array( 'relation' => 'OR' ), $topic_list_args );
					}

	            }

		        $children = get_posts( $query_args );

	            if ( ! empty( $cache_key ) && count( $children ) > 0 ) {
	                set_transient( $cache_key, $children, 20 * MINUTE_IN_SECONDS + wp_rand( 1, 60 ) );
	            }
            }
        }

        if ( ( 'side-img-info' === $listing_layout || 'side-info' === $listing_layout ) && ! $slider_active ) {
        ?>
            <div class="on-floor-destinations <?php echo esc_attr( $listing_layout ); ?>">
                <?php
                if ( 'side-img-info' === $listing_layout ) {
                    $parent_page_img = has_post_thumbnail( $parent_page_id ) ? get_the_post_thumbnail_url( $parent_page_id ) : nabshow_lv_get_empty_thumbnail_url();
                ?>
                    <div class="on-floor-imgbox">
                        <img src="<?php echo esc_url( $parent_page_img ); ?>" alt="page-img">
                    </div>
                <?php
                }
                ?>

                <div class="on-floor-infobox">
                    <h2 class="title nab-title"><a href="<?php echo esc_url( get_the_permalink( $parent_page_id ) ); ?>"><?php echo esc_html( get_the_title( $parent_page_id ) ); ?></a></h2>
                    <p><?php echo esc_html( nabshow_lv_excerpt( $parent_page_id ) ); ?></p>
                    <?php
                    if ( count( $children ) > 0 ) {
                    ?>
                        <ul class="child-page-list">
                        <?php
                            $page_count = 1;

                            foreach ( $children as $child ) {

                            	if ( in_array( strval( $child->ID ), $exclude_pages, true ) ) {
	                                continue;
	                            }

                                if ( $post_limit >= $page_count ) {
                                ?>
                                    <li><a href="<?php echo esc_url( get_the_permalink( $child->ID ) ); ?>"><?php echo esc_html( $child->post_title ); ?></a></li>
                                <?php
                                } else {
                                    break;
                                }
                                $page_count++;
                            }
                        ?>
                        </ul>
                    <?php
                    }
                    ?>
                </div>
            </div>
        <?php
        } elseif ( ! $slider_active && 'drop-down-list' === $listing_layout ) {

            $dropdown_title = isset( $attributes[ 'dropdownTitle' ] ) && ! empty( $attributes[ 'dropdownTitle' ] ) ? $attributes[ 'dropdownTitle' ] : '-- Select --';
            ?>
            <select class="plan-your-show-drp">
                <option><?php echo esc_html( $dropdown_title ); ?></option>
                <?php
                if ( count( $children ) > 0 ) {

                    $page_count = 1;

                    foreach ( $children as $child ) {

                    	if ( in_array( strval( $child->ID ), $exclude_pages, true ) ) {
                            continue;
                        }

                    	if ( $post_limit >= $page_count ) {
                            ?>
                            <option value="<?php echo esc_url( get_permalink( $child->ID ) ); ?>"><?php echo esc_html( $child->post_title ); ?></option>
                            <?php
                        } else {
                            break;
                        }
                        $page_count++;
                    }
                }
                ?>
            </select>
            <?php
        } else {

            if ( ! $slider_active && $show_filter ) {

                if ( 'plan-your-show' === $listing_layout ) {

                    nabshow_lv_related_content_plan_your_show_layout_filter();

                } elseif ( 'exhibitor-resources' === $listing_layout ) {

                    nabshow_lv_related_content_key_contacts_layout_filter();

                } elseif ( 'destination' === $listing_layout ) {

                    nabshow_lv_related_content_on_floor_destination_filter();
                }
            }

            if ( count( $children ) > 0 ) {
                if ( 'browse-happenings' === $listing_layout ) {

                    $temp_child = array();

                    foreach ( $children as $child ) {
                        $date_field_group = get_field( 'date_group',  $child->ID );
                        $first_row        = $date_field_group[0];
                        if ( isset( $first_row[ 'page_dates' ] ) && ! empty( $first_row[ 'page_dates' ] ) ) {

                            $date = date_format( date_create( $first_row[ 'page_dates' ] ), 'Ymd' );
                            $temp_child[ $date ][] = $child;
                        }
                    }

                    ksort($temp_child);
                    $children = array();

                    foreach ( $temp_child as $date_child ) {

                        foreach ( $date_child as $child ) {
                            $children[] = $child;
                        }
                    }
                }
            ?>
                <div class="slider-arrow-main <?php echo esc_attr( $arrow_icons ); ?> <?php echo esc_attr( $class_name ); ?>">

                <?php
                if ( $slider_active ) {
                ?>
                    <div class="nab-dynamic-slider nab-box-slider related-content-slider <?php echo esc_attr( $slider_layout ); ?>" data-minslides="<?php echo esc_attr($min_slides);?>" data-slidewidth="<?php echo esc_attr($slide_width);?>" data-auto="<?php echo esc_attr($autoplay);?>" data-infinite="<?php echo esc_attr($infinite_loop);?>" data-pager="<?php echo esc_attr($pager);?>" data-controls="<?php echo esc_attr($controls);?>" data-speed="<?php echo esc_attr($slider_speed);?>" data-slidemargin="<?php echo esc_attr($slider_margin);?>">
                <?php
                } else {
                ?>
                    <div class="row related-content-rowbox" id="related-content-list">
                    <?php
                    if ( 'title-list' === $listing_layout ) {
                    ?>
                        <ul class="title-list">
                    <?php
                    }
                }
                        $page_count = 1;
                        $date_group = '';
                        $cnt        = 0;
                        foreach ( $children as $child ) {

                            $cnt++;

                            if ( in_array( strval( $child->ID ), $exclude_pages, true ) ) {
                                continue;
                            }

                            if ( $featured_page ) {
                                if ( ! has_term('featured', 'page-category', $child->ID ) ) {
                                    continue;
                                }
                            }

                            if ( $post_limit >= $page_count ) {

                                $page_image = has_post_thumbnail( $child->ID ) ? get_the_post_thumbnail_url( $child->ID ) : nabshow_lv_get_empty_thumbnail_url();

                                if ( $slider_active ) {
                                ?>
                                   <div class="item">
                                        <div class="item-inner">
                                            <?php
                                            if ( 'img-only' === $slider_layout || 'related-content-slider-events' === $slider_layout ) {
                                            ?>
                                                <a href="<?php echo esc_url( get_the_permalink( $child->ID ) ); ?>">
                                            <?php
                                            }
                                            ?>
                                                    <img src="<?php echo esc_url( $page_image ); ?>" alt="page-logo" />
                                            <?php
                                            if ( 'img-only' === $slider_layout || 'related-content-slider-events' === $slider_layout ) {
                                            ?>
                                                </a>
                                            <?php
                                            }
                                            if ( 'related-content-slider-info' === $slider_layout || 'related-content-slider-events' === $slider_layout ) {
                                            ?>
                                                <div class="item-info">

                                                <?php
                                                if ( 'related-content-slider-events' !== $slider_layout ) {
                                                    ?>
                                                    <h2><a href="<?php echo esc_url( get_the_permalink( $child->ID ) ); ?>"><?php echo esc_html( $child->post_title ); ?></a></h2>
                                                    <?php
                                                }

                                                nabshow_lv_related_content_dynamic_field_display( $child->ID,  $display_field );

                                                if ( 'related-content-slider-events' === $slider_layout ) {
                                                    ?>
                                                    <p class="description"><?php echo esc_html( nabshow_lv_excerpt( $child->ID ) ); ?></p>
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
                                } elseif ( 'title-list' === $listing_layout && ! $slider_active ) {
                                    $coming_soon = get_field( 'coming_soon',  $child->ID );
                                ?>
                                    <li>
                                    <?php
                                        if ( ! empty( $coming_soon ) ) {
                                            $display_title =  $child->post_title . ' ('. $coming_soon .')';
                                        ?>
                                            <span class="coming-soon"><?php echo esc_html( $display_title ); ?></span>
                                        <?php
                                        } else {
                                        ?>
                                            <a href="<?php echo esc_url( get_permalink( $child->ID ) ); ?>"><?php echo esc_html( $child->post_title ); ?></a>
                                        <?php
                                        }
                                    ?>
                                    </li>
                                <?php
                                } else {

                                    if ( 'destination' === $listing_layout || 'featured-happenings' === $listing_layout || 'browse-happenings' === $listing_layout || 'plan-your-show' === $listing_layout ) {

                                        $date_field_group = get_field( 'date_group',  $child->ID );
                                        $first_row        = isset( $date_field_group[0] ) ? $date_field_group[0] : array();
                                        $date             = isset( $first_row[ 'page_dates' ] ) ? $first_row[ 'page_dates' ] : '';

                                        if ( 'browse-happenings' === $listing_layout && $date_group !== $date ) {
                                           if ( ! empty( $date_group ) ) {
                                           ?>
                                            </div>
                                           <?php
                                           }
                                            $date_group = $date;
                                           ?>
                                           <div class="date-group-wrapper">
                                                <h2 class="happenings-date"><?php echo esc_html( $date ); ?></h2>
                                           <?php
                                        }

                                        $is_featured    = has_term('featured', 'page-category', $child->ID ) ? 'featured' : '';
                                        $all_halls      = get_field( 'page_hall',  $child->ID );
                                        $new_this_year  = get_field( 'new_this_year',  $child->ID );
                                        $all_types      = get_field( 'page_type',  $child->ID );
                                        $is_open_to     = get_field( 'is_open_to',  $child->ID );
                                        $is_open_to     = 'Select Open To' === $is_open_to ? '' : $is_open_to;
                                        $page_hall      = ! empty( $all_halls ) ? implode( ',', $all_halls ) : '';
                                        $page_type      = ! empty( $all_types ) ? implode(',', $all_types ) : '';
                                        $date           = ! empty( $date ) ? date_format( date_create( $date ), 'd-M-Y' ) : '';
                                    ?>
                                        <div class="col-lg-4 col-md-6" data-open="<?php echo esc_attr( $is_open_to ); ?>" data-title="<?php echo esc_attr( strtolower( $child->post_title ) ); ?>" data-default="<?php echo esc_attr( $page_count ); ?>" data-date="<?php echo esc_attr( $date ); ?>" data-featured="<?php echo esc_attr( $is_featured ); ?>" data-hall="<?php echo esc_attr( $page_hall ); ?>" data-type="<?php echo esc_attr( $page_type ); ?>" data-new-this-year="<?php echo ! empty( $new_this_year ) ? esc_attr( $new_this_year[0] ) : ''; ?>">
                                    <?php
                                    } else {
                                    ?>
                                        <div class="col-lg-4 col-md-6">
                                    <?php
                                    }
                                    ?>
                                        <div class="related-content-box <?php echo esc_attr( $listing_layout ); ?>">
                                            <?php
                                            if ( 'key-contacts' !== $listing_layout ) {

                                                if ( 'product-categories' === $listing_layout || 'browse-happenings' === $listing_layout ) {
                                                ?>
                                                    <a href="<?php echo esc_url( get_the_permalink( $child->ID ) ); ?>">
                                                <?php
                                                }
                                                ?>

                                                    <img class="logo" src="<?php echo esc_url( $page_image ) ?>" alt="page-logo">

                                                <?php
                                                if ( 'product-categories' === $listing_layout || 'browse-happenings' === $listing_layout ) {
                                                ?>
                                                    </a>
                                                <?php
                                                }

                                            }
                                            if ( 'product-categories' !== $listing_layout && 'browse-happenings' !== $listing_layout ) {
                                            ?>
                                                <h2 class="title">
                                                    <a href="<?php echo esc_url( get_the_permalink( $child->ID ) ); ?>"><?php echo esc_html( $child->post_title ); ?></a>
                                                </h2>

                                                <?php
                                                if ( 'featured-happenings' === $listing_layout || 'destination' === $listing_layout || 'plan-your-show' === $listing_layout ) {

                                                    if ( is_array( $display_field ) && count( $display_field ) > 0 ) {
                                                    ?>
                                                        <div class="info-block">
                                                        <?php
                                                        nabshow_lv_related_content_dynamic_field_display( $child->ID,  $display_field );
                                                        ?>
                                                        </div>
                                                    <?php
                                                    }
                                                }

                                                $page_excerpt = nabshow_lv_excerpt( $child->ID );

                                                ?>
                                                <p><?php echo esc_html( $page_excerpt ); ?></p>
                                                <?php
                                                if ( 'plan-your-show' !== $listing_layout ) {

                                                    $coming_soon = get_field( 'coming_soon',  $child->ID );

                                                    if ( ! empty( $coming_soon ) ) {
                                                    ?>
                                                        <span class="coming-soon"><?php echo esc_html( $coming_soon ); ?></span>
                                                    <?php
                                                    } else {

                                                    	$link_text = 'Read More';

                                                    	if ( 'key-contacts' === $listing_layout || 'destination' === $listing_layout ) {
                                                    		$link_text = 'Learn More';
                                                    	}
                                                    ?>
                                                        <a href="<?php echo esc_url( get_permalink( $child->ID ) ); ?>" class="read-more btn-with-arrow"><?php echo esc_html( $link_text ); ?></a>
                                                    <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                <?php
                                }
                                if ( 'browse-happenings' === $listing_layout && ! isset( $children[ $cnt ] ) ) {
                                ?>
                                    </div>
                                <?php
                                }
                            } else {
                                break;
                            }
                            $page_count++;
                        }
                        if ( 'title-list' === $listing_layout ) {
                        ?>
                            </ul>
                        <?php
                        }
                        if ( 'destination' === $listing_layout || 'featured-happenings' === $listing_layout || 'browse-happenings' === $listing_layout || 'plan-your-show' === $listing_layout) {
                        ?>
                            <p class="no-data display-none">Result not found.</p>
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
        }
    } else {
        ?>
            <p class="coming-soon">Coming soon.</p>
        <?php
    }

    $html = ob_get_clean();
    return $html;
}

/**
 * Fetch contributors/authors according to selected post type.
 *
 * @param $attributes
 *
 * @return string
 *
 * @since 1.0.0
 */
function nabshow_lv_contributors_render_callback( $attributes ) {

    $post_type  = isset( $attributes['postType'] ) && ! empty( $attributes['postType'] ) ? $attributes['postType'] : '';
    $post_limit = isset( $attributes['itemToFetch'] ) && ! empty( $attributes['itemToFetch'] ) ? $attributes['itemToFetch'] : 10;
    $class_name = isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ? $attributes['className'] : '';

    $all_contributors = get_users( array( 'blog_id' => 0 ) );

    ob_start();
    if ( ! empty( $post_type ) && count( $all_contributors ) > 0 ) {
    ?>
        <div class="team-main contributors-team <?php echo esc_attr( $class_name ); ?>">
    <?php
        $limit_counter = 1;
        foreach ( $all_contributors as $contributor ) {

            $author_query = get_transient( 'nab-get-author-post-cache-' . $contributor->ID . '-' . $post_type );

            if ( false === $author_query || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {
                $args = array( 'author' => $contributor->ID, 'post_type' => $post_type, 'posts_per_page' => 1 );
                $author_query = new WP_Query( $args );
                set_transient( 'nab-get-author-post-cache-' . $contributor->ID . '-' . $post_type, $author_query, 20 * MINUTE_IN_SECONDS + wp_rand( 1, 60 ) );
            }

            if( $author_query->have_posts() && $post_limit >= $limit_counter ) {

            	$contributor_image  = nabshow_lv_get_author_avatar_url( $contributor->ID );
				$contributor_name   = $contributor->first_name . ' ' . $contributor->last_name;
				$author_company     = get_field( 'company',  'user_' . $contributor->ID );

				if ( empty( trim( $contributor_name ) ) ) {
					$contributor_name = $contributor->display_name;
				}

            ?>
                <div class="team-box">
                    <div class="team-box-inner">
                        <div class="feature-img">
                             <a href="#" class="detail-list-modal-popup" data-userid="<?php echo esc_attr( $contributor->ID ); ?>" data-posttype="<?php echo esc_attr( $post_type ); ?>">
                                <img src="<?php echo esc_url( $contributor_image ); ?>" alt="<?php echo esc_attr( $contributor->display_name ); ?>" class="main-img media">
                            </a>
                        </div>
                        <div class="team-details">
                            <h3 class="name">
                                <a href="#" class="detail-list-modal-popup" data-userid="<?php echo esc_attr( $contributor->ID ); ?>" data-posttype="<?php echo esc_attr( $post_type ); ?>"><?php echo esc_html( $contributor_name ); ?></a>
                            </h3>
                            <strong class="company"><?php echo esc_html( $author_company ); ?></strong>
                        </div>
                    </div>
                </div>
            <?php
                $limit_counter++;
                wp_reset_postdata();
            }
        }
        if ( 1 === $limit_counter ) {
        	?>
            <p>Contributors not found.</p>
            <?php
        }
    }

    $html = ob_get_clean();

    return $html;
}

/**
 * Fetch child pages with specific block content.
 *
 * @param $attributes
 *
 * @return string
 *
 * @since 1.0.0
 */
function nabshow_lv_related_content_with_block_render_callback( $attributes ) {

    $page_id     = isset( $attributes[ 'pageId' ] ) && ! empty( $attributes[ 'pageId' ] ) ? $attributes[ 'pageId' ] : get_the_ID();
    $show_filter = isset( $attributes[ 'showFilter' ] ) ? $attributes[ 'showFilter' ] : false;
    $filter_type = isset( $attributes[ 'filterType' ] ) && ! empty( $attributes[ 'filterType' ] ) ? $attributes[ 'filterType' ] : 'opportunities';

    $args = array(
        'post_type'      => 'page',
        'posts_per_page' => 99,
        'post_parent'    => $page_id,
        'order'          => 'ASC',
        'orderby'        => 'menu_order'
     );


    $child = new WP_Query( $args );

    ob_start();

    if ( $child->have_posts() ) :

        if ( $show_filter && 'opportunities' === $filter_type ) {

            nabshow_lv_related_content_with_block_opportunities_layout_filter();

        } elseif ( $show_filter && 'resources' === $filter_type ) {

            nabshow_lv_related_content_with_block_resources_layout_filter();
        }

        $allowed_tags = wp_kses_allowed_html( 'post' );

        while ( $child->have_posts() ) : $child->the_post();

            $nab_content = get_the_content();

            if ( has_blocks( $nab_content ) ) {

                $nab_blocks = parse_blocks( $nab_content );

                $nab_array_search = array_filter( $nab_blocks, 'nabshow_lv_search_block' );

                $nab_post_content = nabshow_lv_serialize_blocks( $nab_array_search );

                $content = apply_filters( 'the_content', $nab_post_content );

                ?>
                <div class="related-main-wrapper">
                    <h2 class="parent-main-title"><?php the_title(); ?></h2>
                    <?php echo wp_kses( $content, $allowed_tags ); ?>
                </div>
                <?php
            }

        endwhile;
    endif;
    wp_reset_postdata();

    $html = ob_get_clean();

    return $html;
}

/**
 * Fetch featured image according to given page slug.
 *
 * @param $attributes
 *
 * @return string
 *
 * @since 1.0.0
 */
function nabshow_lv_page_featured_image_render_callback( $attributes ) {

    $page_slug  = isset( $attributes['pageSlug'] ) && ! empty( $attributes['pageSlug'] ) ? $attributes['pageSlug'] : '';
    $class_name = isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ? $attributes['className'] : '';

    ob_start();

    if ( ! empty( $page_slug ) ) {

        $page  = get_page_by_path( $page_slug );

        if ( $page ) {
            $image_url = has_post_thumbnail( $page->ID ) ? get_the_post_thumbnail_url( $page->ID ) : nabshow_lv_get_empty_thumbnail_url();
            ?>
                <div class="page-featured-image <?php echo esc_attr( $class_name ); ?>">
                    <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $page_slug ); ?>" />
                </div>
            <?php
        } else {
        ?>
            <p class="coming-soon">Coming soon.</p>
        <?php
        }
    } else {
    ?>
        <p>Page slug can not be empty.</p>
    <?php
    }

    $html = ob_get_clean();
    return $html;
}

function nabshow_lv_site_forms_render_callback( $attributes ) {

	$form_type  = isset( $attributes[ 'formType' ] ) && ! empty( $attributes[ 'formType' ] ) ? $attributes[ 'formType' ] : 'startup-loft';
	$form_email = isset( $attributes[ 'formEmail' ] ) && ! empty( $attributes[ 'formEmail' ] ) ? $attributes[ 'formEmail' ] : '';

	set_query_var( 'form_email', $form_email );

	ob_start();

	if ( 'startup-loft' === $form_type ) {
		get_template_part( 'template-parts/forms/content', 'startup-loft' );
	} elseif ( 'contact-us' === $form_type ) {
		get_template_part( 'template-parts/forms/content', 'contact-us' );
	} elseif ( 'delegation-leader-enrollment' === $form_type ) {
		get_template_part( 'template-parts/forms/content', 'delegation' );
	} elseif ( 'publication-shipping-information' === $form_type ) {
		get_template_part( 'template-parts/forms/content', 'publication' );
	} elseif ( 'download-the-prospectus' === $form_type ) {
		get_template_part( 'template-parts/forms/content', 'prospectus' );
	} elseif ( 'special-event-order' === $form_type ) {
		get_template_part( 'template-parts/forms/content', 'special-event' );
	}

	$html = ob_get_clean();

	return $html;
}
