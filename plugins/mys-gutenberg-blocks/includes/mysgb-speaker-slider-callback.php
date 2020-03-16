<?php
/**
 * Exit if accessed directly
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

$listing_page           = isset( $attributes['listingPage'] ) ? $attributes['listingPage'] : false;
$with_thumbnail         = isset( $attributes['withThumbnail'] ) ? $attributes['withThumbnail'] : false;
$block_post_type        = isset( $attributes['postType'] ) && ! empty( $attributes['postType'] ) ? $attributes['postType'] : 'speakers';
$taxonomies             = isset( $attributes['taxonomies'] ) && ! empty( $attributes['taxonomies'] ) ? $attributes['taxonomies'] : array();
$terms                  = isset( $attributes['terms'] ) && ! empty( $attributes['terms'] ) ? json_decode( $attributes['terms'] ): array();
$posts_per_page         = isset( $attributes['itemToFetch'] ) && $attributes['itemToFetch'] > 0 ? $attributes['itemToFetch'] : 10;
$display_name           = isset( $attributes['displayName'] ) ? $attributes['displayName'] : true;
$display_title          = isset( $attributes['displayTitle'] ) ? $attributes['displayTitle'] : true;
$display_company        = isset( $attributes['displayCompany'] ) ? $attributes['displayCompany'] : true;
$grid_info_rollovers    = isset( $attributes['gridInfoRollovers'] ) ? $attributes['gridInfoRollovers'] : false;
$slide_info_rollovers   = isset( $attributes['slideInfoRollovers'] ) ? $attributes['slideInfoRollovers'] : false;
$slide_info_below       = isset( $attributes['slideInfoBelow'] ) ? $attributes['slideInfoBelow'] : false;
$slider_active          = isset( $attributes['sliderActive'] ) ? $attributes['sliderActive'] : true;
$min_slides             = isset( $attributes['minSlides'] ) ? $attributes['minSlides'] : 4;
$slide_width            = isset( $attributes['slideWidth'] ) ? $attributes['slideWidth'] : 400;
$autoplay               = isset( $attributes['autoplay'] ) ? $attributes['autoplay'] : false;
$infinite_loop          = isset( $attributes['infiniteLoop'] ) ? $attributes['infiniteLoop'] : true;
$pager                  = isset( $attributes['pager'] ) ? $attributes['pager'] : false;
$controls               = isset( $attributes['controls'] ) ? $attributes['controls'] : false;
$slider_speed           = isset( $attributes['sliderSpeed'] ) ? $attributes['sliderSpeed'] : 500;
$slider_shape           = isset( $attributes['slideShape'] ) ? $attributes['slideShape'] : 'rectangle';
$order_by               = isset( $attributes['orderBy'] ) ? $attributes['orderBy'] : 'date';
$slider_margin          = isset( $attributes['slideMargin'] ) ? $attributes['slideMargin'] : 30;
$speaker_order          = 'date' === $order_by ? 'DESC' : 'ASC';
$arrow_icons            = isset( $attributes['arrowIcons'] ) ? $attributes['arrowIcons'] : 'slider-arrow-1';
$class_name             = isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ? $attributes['className'] : '';
$exclude_speaker        = isset( $attributes['excludeSpeaker'] ) && ! empty( $attributes['excludeSpeaker'] ) ? $attributes['excludeSpeaker'] : '';
$include_tracks         = isset( $attributes['includeTracks'] ) && ! empty( $attributes['includeTracks'] ) ? $attributes['includeTracks'] : array();
$attach_session         = isset( $attributes['attachSession'] ) ? $attributes['attachSession'] : false;
$track_speakers         = '';

if ( ( is_array( $include_tracks ) && count( $include_tracks ) > 0 ) || $attach_session ) {

	if ( is_array( $include_tracks ) && count( $include_tracks ) > 0 ) {
		$session_cache_key  = 'mysgb-speaker-track-session-' . implode('-', $include_tracks );
		$session_ids        = get_transient( $session_cache_key );
	} else {
		$session_ids = false;
	}

    if ( false === $session_ids || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {

    	$session_args = array(
	        'post_type'      => 'sessions',
	        'posts_per_page' => 100,
	        'fields'         => 'ids',
	        'meta_key'       => 'speakers'
	    );

    	$session_args['posts_per_page'] = $listing_page ? -1 : 100;

    	if ( is_array( $include_tracks ) && count( $include_tracks ) > 0 ) {

    		$session_args['tax_query'] = array(
				'relation' => 'OR',
	            array(
					'taxonomy' => 'tracks',
	                'field'    => 'slug',
	                'terms'    => $include_tracks,
				)
	        );
    	}

		$session_query = new WP_Query( $session_args );

		if ( $session_query->have_posts() ) {

			$session_ids = $session_query->posts;

			if ( is_array( $include_tracks ) && count( $include_tracks ) > 0 ) {

				set_transient( $session_cache_key, $session_ids, 20 * MINUTE_IN_SECONDS + wp_rand( 1, 60 ) );
			}

		}
    }

    if ( is_array( $session_ids ) && count( $session_ids ) > 0 ) {

    	foreach ( $session_ids as $session_id ) {

    		$post_speaker = get_post_meta( $session_id, 'speakers', true );

    		if ( ! empty( $post_speaker ) ) {

    			if ( empty( $track_speakers ) ) {

    				$track_speakers = $post_speaker;

    			} else {

    				$track_speakers .= ',' . $post_speaker;
    			}
    		}
    	}

    	$track_speakers = trim( $track_speakers, ',' );
    }

}

if ( 'circle' === $slider_shape ) {

	if (  ( $slider_active && $display_name && ! $slide_info_below ) || ( ! $slider_active && $grid_info_rollovers ) || $slide_info_rollovers ) {

		$item_class = '';

	} else {

		$item_class = 'display-title';
	}

} else {

	$item_class = 'display-title';
}

$query              = false;
$final_key          = '';
$cache_key          = $this->mysgb_get_taxonomy_term_cache_key( $taxonomies, $terms );
$display_class      = '';

if ( ! $display_name ) {
	$display_class .= 'without-name ';
}
if ( ! $display_title ) {
	$display_class .= 'without-title ';
}
if ( ! $display_company ) {
	$display_class .= 'without-company ';
}
if ( $listing_page && $grid_info_rollovers ) {
	$display_class .= 'on-rollover ';
}

if ( ! empty( $display_class ) ) {
	$class_name .= rtrim( $display_class );
}

if ( ! empty( $cache_key ) || $with_thumbnail ) {

	if ( isset( $attributes['metaDate'] ) && $attributes['metaDate'] ) {
		$cache_key = $attributes['speakerDate'] . '-' . $cache_key;
	}

	if ( ! empty( $track_speakers ) && is_array( $include_tracks ) ) {
		$cache_key = implode( '-', $include_tracks ) . '-' . $cache_key;
	}

	if ( $attach_session && ! empty( $track_speakers ) ) {
		$cache_key = 'attachsession-' . $cache_key;
	}

	$final_key  = mb_strimwidth( 'mysgb-speaker-slider-' . $block_post_type . '-' . $order_by . '-' . $posts_per_page . '-' . $with_thumbnail .'-' . $cache_key, 0, 170 );
    $query      = get_transient( $final_key );

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
    );

    if ( ! empty( $track_speakers ) ) {

		$all_track_speakers = explode( ',', $track_speakers );

		if ( is_array( $all_track_speakers ) && count( $all_track_speakers ) > 0 ) {

			$all_track_speakers                 = array_unique( $all_track_speakers );
			$query_args['post__in']             = $all_track_speakers;
			$query_args['ignore_sticky_posts']  = true;
		}
	}

    if ( 'rand' === $order_by ) {
		$query_args['posts_per_page']       = 100;
		$query_args['fields']               = 'ids';
		$query_args['no_found_rows']        = true;
		$query_args['ignore_sticky_posts']  = true;
	} else {
		$query_args['posts_per_page']       = $posts_per_page;
		$query_args['orderby']              = $order_by;
		$query_args['order']                = $speaker_order;
	}

    if ( ! empty( $exclude_speaker ) ) {

    	$final_speakers = explode( ',' , str_replace( ' ', '', $exclude_speaker ) );

    	if ( is_array( $final_speakers ) && count( $final_speakers ) > 0 ) {

    		$query_args['post__not_in'] = $final_speakers;
    	}
    }


    if ( ! $listing_page ) {

        if ( $with_thumbnail ) {
            $query_args[ 'meta_key' ] = '_thumbnail_id';
        }

        $tax_query_args = $this->mysgb_get_tax_query_argument( $taxonomies, $terms );

        if ( count( $tax_query_args ) > 1 ) {
            $query_args[ 'tax_query' ] = $tax_query_args;
        }

        if ( isset( $attributes['metaDate'] ) && $attributes['metaDate'] ) {

        	$speaker_date  = new DateTime( $attributes['speakerDate'] );
            $speaker_date  = $speaker_date->format( 'F, j Y' );

        	$query_args[ 'meta_query' ] = array(
                            array(
                                'key'     => 'schedules',
                                'value'   => $speaker_date,
                                'compare' => 'LIKE'
                            )
                    );
        }

    } elseif ( isset( $speaker_key ) && ! empty( $speaker_key ) ) {
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

if ( 'rand' === $order_by && $query->have_posts() ) {

	$post_ids = $query->posts;
	shuffle( $post_ids );
	$post_ids = array_splice( $post_ids, 0, $posts_per_page );
	$query    = new WP_Query( array( 'post_type' => $block_post_type, 'post__in' => $post_ids, 'posts_per_page' =>  count( $post_ids ), 'orderby' => 'post__in' ) );
}

if ( $query->have_posts() || $listing_page ) {

    if ( $listing_page ) {
        include( plugin_dir_path( __FILE__ ) . 'filters/html-mysgb-speaker-filter.php' );
    }
?>
    <div class="slider-arrow-main <?php echo esc_attr( $arrow_icons ); ?> <?php echo esc_attr( $class_name ); ?>">
<?php
        if ( $slider_active ) {
        	$slider_class = 'circle' === $slider_shape && ! $display_name ? 'circle-without-name' : '';
        ?>
            <div class="nab-dynamic-slider items-md nab-box-slider speakers <?php echo esc_html( $slider_class ); ?>" data-minslides="<?php echo esc_attr( $min_slides );?>" data-slidewidth="<?php echo esc_attr( $slide_width );?>" data-auto="<?php echo esc_attr($autoplay);?>" data-infinite="<?php echo esc_attr($infinite_loop);?>" data-pager="<?php echo esc_attr($pager);?>" data-controls="<?php echo esc_attr($controls);?>" data-speed="<?php echo esc_attr($slider_speed);?>" data-slidemargin="<?php echo esc_attr($slider_margin);?>">
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
                <div class="item <?php echo esc_attr( $item_class ); echo ! empty( $featured_post ) ? esc_attr( ' featured' ) : ''; ?>" data-featured="<?php echo esc_attr( $featured_post ); ?>">
            <?php
            } else {
            ?>
                <div class="item <?php echo esc_attr( $item_class ); ?>">
            <?php
            }

            ?>
                <div class="flip-box">
                    <div class="flip-box-inner">
                        <?php

                        if ( 'rectangle' === $slider_shape || ( 'circle' === $slider_shape && ! $display_name ) || ( $slider_active && $slide_info_below && ! $slide_info_rollovers ) || ( ! $slider_active && ! $grid_info_rollovers ) ) {
                            ?>
                            <a href="#" class="detail-list-modal-popup" data-postid="<?php echo esc_attr( $speaker_id ); ?>" data-posttype="<?php echo esc_attr( $block_post_type ); ?>">
                        	    <img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="speaker-logo" class="<?php echo 'circle' === $slider_shape ? esc_attr('rounded-circle') : ''; ?>">
                        	</a>

                            <?php
                        } else {
                        	?>
                        	<img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="speaker-logo" class="<?php echo 'circle' === $slider_shape ? esc_attr('rounded-circle') : ''; ?>">
                        	<?php
                        }
                        ?>
                        <div class="flip-box-back rounded-circle">
							<?php
							if ( $display_name ) {
								$speaker_name = get_the_title();
								$speaker_name = explode(',', $speaker_name, 2);
                                $speaker_name = isset( $speaker_name[1] ) ? $speaker_name[1] . ' ' . $speaker_name[0] : $speaker_name[0];
	                            ?>
	                            <h6><?php $this->mysgb_generate_popup_link( $speaker_id, $block_post_type, $speaker_name ); ?></h6>
	                            <?php
	                        }
							if ( ! $slider_active || $slide_info_below || $slide_info_rollovers ) {

								if ( $display_title ) {

									$speaker_job_title = get_post_meta( $speaker_id, 'title', true );
									?>
									<p class="jobtilt"><?php echo esc_attr( $speaker_job_title ); ?></p>
									<?php
								}
								if ( $display_company ) {

									$speaker_company   = get_the_terms( $speaker_id, 'speaker-companies' );
									$speaker_company   = $this->mysgb_get_pipe_separated_term_list( $speaker_company );
									?>
									<span class="company"><?php echo esc_attr( $speaker_company ); ?></span>
									<?php
								}
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

            if( ! empty( trim( $exclude_speaker ) ) ) {
                ?>
                <input type="hidden" class="exclude-speaker" value="<?php echo esc_attr( $exclude_speaker ); ?>">
                <?php
            }

            if ( $attach_session && ! empty( $track_speakers ) ) {
            	?>
                <input type="hidden" class="session-speakers" value="<?php echo esc_attr( $track_speakers ); ?>">
                <?php
            }
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
    <p class="coming-soon">Coming soon.</p>
<?php
}

wp_reset_postdata();
