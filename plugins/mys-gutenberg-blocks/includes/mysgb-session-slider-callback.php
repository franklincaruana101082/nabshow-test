<?php
/**
 * Exit if accessed directly
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

$listing_page      = isset( $attributes['listingPage'] ) ? $attributes['listingPage'] : false;
$with_content      = isset( $attributes['withContent'] ) ? $attributes['withContent'] : false;
$upcoming_session  = isset( $attributes['upcomingSession'] ) ? $attributes['upcomingSession'] : false;
$listing_type      = isset( $attributes['listingType'] ) && ! empty( $attributes['listingType'] )? $attributes['listingType'] : 'none';
$block_post_type   = isset( $attributes['postType'] ) && ! empty( $attributes['postType'] ) ? $attributes['postType'] : 'sessions';
$taxonomies        = isset( $attributes['taxonomies'] ) && ! empty( $attributes['taxonomies'] ) ? $attributes['taxonomies'] : array();
$terms             = isset( $attributes['terms'] ) && ! empty( $attributes['terms'] ) ? json_decode( $attributes['terms'] ): array();
$posts_per_page    = isset( $attributes['itemToFetch'] ) && $attributes['itemToFetch'] > 0 ? $attributes['itemToFetch'] : 10;
$slider_active     = isset( $attributes['sliderActive'] ) ? $attributes['sliderActive'] : true;
$min_slides        = isset( $attributes['minSlides'] ) ? $attributes['minSlides'] : 4;
$slide_width       = isset( $attributes['slideWidth'] ) ? $attributes['slideWidth'] : 400;
$autoplay          = isset( $attributes['autoplay'] ) ? $attributes['autoplay'] : false;
$infinite_loop     = isset( $attributes['infiniteLoop'] ) ? $attributes['infiniteLoop'] : true;
$pager             = isset( $attributes['pager'] ) ? $attributes['pager'] : false;
$controls          = isset( $attributes['controls'] ) ? $attributes['controls'] : false;
$slider_speed      = isset( $attributes['sliderSpeed'] ) ? $attributes['sliderSpeed'] : 500;
$order_by          = isset( $attributes['orderBy'] ) ? $attributes['orderBy'] : 'date';
$slider_margin     = isset( $attributes['slideMargin'] ) ? $attributes['slideMargin'] : 30;
$class_name        = isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ? $attributes['className'] : '';
$taxonomy_relation = isset( $attributes['taxonomyRelation'] ) && $attributes['taxonomyRelation'] ? 'AND' : 'OR';
$session_order     = 'date' === $order_by ? 'DESC' : 'ASC';
$layout            = isset( $attributes['layout'] ) && ! empty( $attributes['layout'] ) ? $attributes['layout'] : '';
$slider_layout     = isset( $attributes['sliderLayout'] ) && ! empty( $attributes['sliderLayout'] ) ? $attributes['sliderLayout'] : '';
$arrow_icons       = isset( $attributes['arrowIcons'] ) ? $attributes['arrowIcons'] : 'slider-arrow-1';
$display_name      = isset( $attributes['displayName'] ) ? $attributes['displayName'] : true;
$display_date      = isset( $attributes['displayDate'] ) ? $attributes['displayDate'] : true;
$display_time      = isset( $attributes['displayTime'] ) ? $attributes['displayTime'] : true;
$display_location  = isset( $attributes['displayLocation'] ) ? $attributes['displayLocation'] : true;
$display_summary   = isset( $attributes['displaySummary'] ) ? $attributes['displaySummary'] : true;
$display_speaker   = isset( $attributes['displaySpeaker'] ) ? $attributes['displaySpeaker'] : false;
$display_plink     = true === $attributes['displayPlannerLink'] ? 'true' : 'false';
$query             = false;
$listing_id        = '';
$final_key         = '';
$cache_key         = $this->mysgb_get_taxonomy_term_cache_key( $taxonomies, $terms );
$prepare_key       = 'mysgb-session-slider-' . $block_post_type . '-' . $order_by . '-' . $posts_per_page . '-' . $with_content . '-' . $upcoming_session . '-' . $taxonomy_relation;

$display_class  = '';

if ( ! $display_name ) {
	$display_class .= 'without-name ';
}
if ( ! $display_date ) {
	$display_class .= 'without-date ';
}
if ( ! $display_time ) {
	$display_class .= 'without-time ';
}
if ( ! $display_location ) {
	$display_class .= 'without-location ';
}
if ( ! $display_summary ) {
	$display_class .= 'without-summary ';
}

if ( ! empty( $display_class ) ) {
	$class_name .= rtrim( $display_class );
}


if ( ! $listing_page || 'none' !== $listing_type ) {

    if ( 'chronological' === $order_by || ( ( 'none' !== $listing_type || 'date-group' === $layout ) &&  ! $slider_active ) ) {

        $final_key  = mb_strimwidth( $prepare_key . '-' . $listing_type . '-' . $cache_key, 0, 170 );
        $query      = get_transient( $final_key );

    } elseif ( isset( $attributes['metaDate'] ) && $attributes['metaDate'] ) {

        $final_key  = mb_strimwidth( $prepare_key . '-' . $attributes['sessionDate'] . '-' . $cache_key, 0, 170 );
        $query      = get_transient( $final_key );

    } elseif ( ! empty( $cache_key ) ) {

        $final_key  = mb_strimwidth( $prepare_key . '-' . $cache_key, 0, 170 );
        $query      = get_transient( $final_key );

    }

} else {

    $listing_id  = 'browse-session';
    $session_key = filter_input( INPUT_GET, 'session-key', FILTER_SANITIZE_STRING );
    $get_track   = filter_input( INPUT_GET, 'session-track', FILTER_SANITIZE_STRING );

    if ( isset( $session_key ) && ! empty( $session_key ) ) {

        $final_key  = mb_strimwidth( $prepare_key . '-' . $session_key . '-' . $cache_key, 0, 170 );
        $query      = get_transient( $final_key );

    } elseif ( isset( $get_track ) && ! empty( $get_track ) ) {

        $final_key  = mb_strimwidth( $prepare_key . '-' . $get_track . '-' . $cache_key, 0, 170 );
        $query      = get_transient( $final_key );
    }
}

if ( false === $query || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {

    $query_args = array(
        'post_type'      => $block_post_type,
    );

    if ( 'chronological' === $order_by || ( ( 'none' !== $listing_type || 'date-group' === $layout ) &&  ! $slider_active ) ) {

        $query_args['posts_per_page']       = $posts_per_page;
        $query_args['meta_key']             = 'starttime';
        $query_args['orderby']              = 'meta_value';
        $query_args['order']                = 'ASC';

    } elseif ( 'rand' !== $order_by ) {

        $query_args['posts_per_page']       = $posts_per_page;
        $query_args['orderby']              = $order_by;
        $query_args['order']                = $session_order;

    } else {

        $query_args['posts_per_page']       = 100;
        $query_args['fields']               = 'ids';
        $query_args['no_found_rows']        = true;
        $query_args['ignore_sticky_posts']  = true;

    }

    if ( ! $listing_page ) {

        if ( $with_content ) {
            $query_args[ 'content_with' ] = true;
        }

        if ( isset( $attributes['metaDate'] ) && $attributes['metaDate'] ) {

            $session_date              = new DateTime( $attributes['sessionDate'] );
            $session_date              = $session_date->format( 'Y-m-d' );
            $query_args['meta_key']    = 'date';
            $query_args['meta_value']  = $session_date;

        }

        $tax_query_args = $this->mysgb_get_tax_query_argument( $taxonomies, $terms, $taxonomy_relation );

        if ( count( $tax_query_args ) > 1 ) {
            $query_args[ 'tax_query' ] = $tax_query_args;
        }

        if ( $upcoming_session ) {

            $current_date = date( 'Y-m-d', current_time( 'timestamp' ) );

            $query_args[ 'meta_query' ] = array(
                            array(
                                'key'     => 'date',
                                'value'   => $current_date,
                                'compare' => '>=',
                                'type'    => 'DATE'
                            )
                    );
        }


    } elseif ( ( $listing_page && 'none' !== $listing_type ) || ( isset( $session_key ) && ! empty( $session_key ) ) || ( isset( $get_track ) && ! empty( $get_track ) ) ) {

        if ( ( $listing_page && 'none' !== $listing_type ) || ( isset( $session_key ) && ! empty( $session_key ) ) ) {

            $session_term              = isset( $session_key ) && ! empty( $session_key ) ? strtolower( $session_key ) : $listing_type;
            $query_args[ 'tax_query' ] = array(
                    array(
                        'taxonomy' => 'session-categories',
                        'field'    => 'slug',
                        'terms'    => $session_term
                    )
            );
        } elseif ( isset( $get_track ) && ! empty( $get_track ) ) {

            $query_args[ 'tax_query' ] = array(
                    array(
                        'taxonomy' => 'tracks',
                        'field'    => 'slug',
                        'terms'    => $get_track
                    )
            );
        }

    }

    $query = new WP_Query( $query_args );

    if ( ! empty( $final_key ) && $query->have_posts() ) {
        set_transient( $final_key, $query, 20 * MINUTE_IN_SECONDS + wp_rand( 1, 60 ) );
    }

}
if ( 'date-group' === $layout &&  ! $slider_active ) {

    if ( $query->have_posts() ) {
    ?>

        <div class="session-data schedule-main <?php echo esc_attr( $class_name ); ?>">

        <?php

        $date_group = '';
        $counter    = 0;
        $row_count  = 1;

        while ( $query->have_posts() ) {

            $query->the_post();

            $session_id = get_the_ID();
            $date       = get_post_meta( $session_id, 'date', true );
            $start_time = get_post_meta( $session_id, 'starttime', true );
            $end_time   = get_post_meta( $session_id, 'endtime', true );

            if ( ! empty( $start_time ) ) {

                $start_time = str_replace( array( 'am','pm' ), array( 'a.m.','p.m.' ), date_format( date_create( $start_time ), 'g:i a' ) );
                $start_time = str_replace(':00', '', $start_time );

            }
            if ( ! empty( $end_time ) ) {

                $end_time   = str_replace( array( 'am','pm' ), array( 'a.m.','p.m.' ), date_format( date_create( $end_time ), 'g:i a' ) );
                $start_time = str_replace(':00', '', $end_time );

            }
            if ( $date_group !== $date ) {

                $date_group = $date;
                $row_count = 1;

            ?>

                <h2><?php echo esc_html( date_format( date_create( $date ), 'l, F j, Y' ) ); ?></h2>
                <div class="schedule-data">

            <?php } ?>

            <div class="schedule-row <?php echo $row_count > 10 ? esc_attr('hide-row') : ''; ?>">
                <div class="date">
                    <p><?php echo esc_html( $start_time ); ?> - <?php echo esc_html( $end_time ); ?></p>
                </div>
                <div class="name">
                <?php
                    $session_title = mb_strimwidth( get_the_title(), 0, 83, '...' );
                ?>
                    <strong><?php $this->mysgb_generate_popup_link( get_the_ID(), $block_post_type, $session_title, '', $display_plink ); ?> </strong>
                </div>
                <div class="details">
                <?php

                    $speakers       = get_post_meta( $session_id, 'speakers', true );
                    $speaker_ids    = explode(',', $speakers);
                    $total_speakers = count( $speaker_ids );

                    if ( ! empty( $speakers ) && $total_speakers > 0 ) {
                    ?>
                        <p>
                        <?php

                        $cnt = 1;

                        foreach ( $speaker_ids as $speaker_id ) {
                            $speaker_name = get_the_title( $speaker_id );
                            $speaker_name = explode(',', $speaker_name, 2);
                            $speaker_name = isset( $speaker_name[1] ) ? $speaker_name[1] . ' ' . $speaker_name[0] : $speaker_name[0];
                            if ( $total_speakers !== $cnt ) {
                                $speaker_name .= ', ';
                            }
                            echo esc_html( $speaker_name );
                            $cnt++;
                        }

                        ?>
                        </p>
                    <?php
                    } else {
                    ?>
                            <p>-</p>
                    <?php
                    }
                ?>
                </div>
            </div>

           <?php

           if ( $row_count === 10 && $posts_per_page > 10 ) {
           ?>
                <div class="row-expand">
                    <a href="javascript:void(0);" class="expand-btn">Expand</a>
                </div>

           <?php
           }

           $counter++;
           $next_post_date = isset( $query->posts[$counter]->ID ) ? get_post_meta( $query->posts[$counter]->ID, 'date', true ) : '';

           if ( $date_group !== $next_post_date ) {
           ?>
                </div>
           <?php
           }

           $row_count++;
        }
        ?>
        </div>
    <?php
    } else {
    ?>
        <p class="coming-soon">Coming soon.</p>
    <?php
    }
} else {

    if ( $listing_page && 'none' === $listing_type ) {

        include( plugin_dir_path( __FILE__ ) . 'filters/html-mysgb-session-filter.php' );

    } elseif ( $listing_page && 'open-to-all' === $listing_type ) {

        include( plugin_dir_path( __FILE__ ) . 'filters/html-mysgb-open-to-all-filter.php' );

        $this->date_picker = true;
        $this->mysgb_enqueue_front_script();
    }

    if ( 'rand' === $order_by && $query->have_posts() ) {

        $post_ids = $query->posts;
        shuffle( $post_ids );
        $post_ids = array_splice( $post_ids, 0, $posts_per_page );
        $query    = new WP_Query( array( 'post_type' => $block_post_type, 'post__in' => $post_ids, 'posts_per_page' =>  count( $post_ids ), 'orderby' => 'post__in' ) );
    }

    if ( $query->have_posts() || $listing_page ) {
        $show_code = $this->mysgb_get_mys_show_code();
    ?>
        <div class="slider-arrow-main <?php echo esc_attr( $arrow_icons ); ?> <?php echo esc_attr( $class_name ); ?>">
    <?php
    if ( $slider_active ) {
        $layout = '';
    ?>
        <div class="nab-dynamic-slider nab-box-slider session" data-minslides="<?php echo esc_attr($min_slides);?>" data-slidewidth="<?php echo esc_attr($slide_width);?>" data-auto="<?php echo esc_attr($autoplay);?>" data-infinite="<?php echo esc_attr($infinite_loop);?>" data-pager="<?php echo esc_attr($pager);?>" data-controls="<?php echo esc_attr($controls);?>" data-speed="<?php echo esc_attr($slider_speed);?>" data-slidemargin="<?php echo esc_attr($slider_margin);?>">
    <?php
    } else {

        if ( 'none' !== $listing_type ) {
            $listing_id = 'browse-session';
        } elseif ( 'with-masonry' === $layout ) {
            $listing_id = 'card_section';
        }
    ?>
        <div class="nab-dynamic-list session row <?php echo ! empty( $layout ) ? esc_attr( $layout ) : esc_attr('');?>" id="<?php echo esc_attr( $listing_id ); ?>">
            <input type="hidden" class="display_plink" value="<?php echo esc_attr( $display_plink ); ?>">
    <?php
    }
        $date_group = '';
        $counter    = 0;
        while ( $query->have_posts() ) {

            $query->the_post();

            $session_id          = get_the_ID();
            $date                = get_post_meta( $session_id, 'date', true );
            $start_time          = get_post_meta( $session_id, 'starttime', true );
            $end_time            = get_post_meta( $session_id, 'endtime', true );

            if ( ! empty( $date ) ) {
                $date       = date_format( date_create( $date ), 'l, F j, Y' );
            }
            if ( ! empty( $start_time ) ) {
                $start_time = str_replace( array('am','pm'), array('a.m.','p.m.'), date_format( date_create( $start_time ), 'g:i a' ) );
                $start_time = str_replace(':00', '', $start_time );
            }
            if ( ! empty( $end_time ) ) {
                $end_time   = str_replace( array('am','pm'), array('a.m.','p.m.'), date_format( date_create( $end_time ), 'g:i a' ) );
                $end_time   = str_replace(':00', '', $end_time );
            }

            $date_display_format = '';

            if ( ( 'layout-1' === $slider_layout || ! $slider_active ) && ! empty( $date ) ) {

            	if ( $display_date && $display_time ) {

            		$date_display_format = $date . ' | ' . $start_time . ' - ' . $end_time;

            	} elseif ( $display_date ) {

            		$date_display_format = $date;

            	} elseif ( $display_time ) {

            		$date_display_format = $start_time . ' - ' . $end_time;
            	}

            } elseif ( $display_time ) {

            	$date_display_format = $start_time . ' - ' . $end_time;
            }

            $date_display_format = trim( $date_display_format, ' - ');

            $all_tracks_string   = '';

            if ( ! $listing_page ) {
                $post_tracks         = get_the_terms( $session_id, 'tracks' );
                $all_tracks_string   = $this->mysgb_get_pipe_separated_term_list( $post_tracks, 'slug' );
			}

			$featured_post       = has_term( 'featured', 'session-categories' ) ? 'featured' : '';

            if ( 'none' !== $listing_type && $date_group !== $date ) {
                $date_group = $date;
            ?>
                <div class="listing-date-group" data-listing-type="<?php echo esc_attr( $listing_type ); ?>">
                    <h2 class="session-date"><?php echo esc_attr( $date ); ?></h2>
            <?php
            }
            ?>
                <div class="item <?php echo $listing_page && 'none' === $listing_type ? esc_attr( $featured_post ) : ''; ?>" data-featured="<?php echo esc_attr( $featured_post ); ?>" data-tracks="<?php echo esc_attr( $all_tracks_string ); ?>">
            <?php
                $session_has_thumbnail = has_post_thumbnail();

                if ( ( ! $listing_page && 'with-featured' === $layout && $session_has_thumbnail ) || ( 'none' !== $listing_type && $session_has_thumbnail ) ) {
                    ?>
                    <img src="<?php echo esc_url( get_the_post_thumbnail_url() ); ?>" alt="session-logo">
                    <?php
                }

                if ( $display_name ) {
                    $title_text =  mb_strimwidth( get_the_title(), 0, 83, '...' );
                    ?>
                    <h4><?php $this->mysgb_generate_popup_link( $session_id, $block_post_type, $title_text, '', $display_plink); ?></h4>
                    <?php
                }

                if ( $slider_active ) {

                	$sub_title = '';

                    if ( 'layout-1' === $slider_layout ) {

                    	if  ( $display_location ) {
							$session_tracks = $this->mysgb_get_pipe_separated_term_list( $post_tracks );
                            $sub_title      =  $session_tracks;
                    	}

                    } elseif ( $display_date ) {
                        $sub_title = $date;
                    }

                    ?>
                    <span class="caption"><?php echo esc_html( $sub_title ); ?></span>
                    <?php
                }

                if ( ! empty( $date_display_format ) ) {
                    ?>
                    <span class="date-time"><?php echo esc_html( $date_display_format );?></span>
                    <?php
                }

                if ( $slider_active && $display_speaker ) {
                	$this->mysgb_get_session_speakers( $session_id, 'bullet', $display_plink );
                }

                if ( 'with-featured' === $layout || 'with-masonry' === $layout ) {

                	$schedule_id         = get_post_meta( $session_id, 'scheduleid', true );
                    $session_planner_url = 'https://' . $show_code . '.mapyourshow.com/8_0/sessions/session-details.cfm?scheduleid=' . $schedule_id;

                    if ( $display_summary ) {
                        ?>
                        <p>
	                    <?php

	                        echo esc_html( get_the_excerpt() );
	                        $this->mysgb_generate_popup_link( $session_id, $block_post_type, 'Read More', 'read-more-popup', $display_plink );
	                    ?>
	                    </p>
	                    <?php
                    }
                    if ( 'with-masonry' === $layout && $display_speaker ) {

                    	$this->mysgb_get_session_speakers( $session_id, 'with-headshot' );

                    } elseif ( 'with-featured' === $layout ) {

                    	$this->mysgb_get_session_speakers( $session_id, 'comma-separated' );
                    }

                    if ( ! $slider_active && ! $listing_page && isset( $attributes['displayVideo'] ) && $attributes['displayVideo'] ) {

                    	$video = get_post_meta( $session_id, 'video', true );
                    	?>
                    	<div class="video-section"><?php echo $video; ?></div>
                    	<?php
                    }

                    if( 'true' === $display_plink ) { ?>
                        <a class="session-planner-url" href="<?php echo esc_url( $session_planner_url ); ?>" target="_blank">View in Planner</a>
                    <?php }
                }
                ?>
            </div>
        <?php
            $counter++;
            if ( 'none' !== $listing_type ) {
                $next_post_date = isset( $query->posts[$counter]->ID ) ? get_post_meta( $query->posts[$counter]->ID, 'date', true ) : '';
                if ( ! empty( $next_post_date ) ) {
                    $next_post_date = date_format( date_create( $next_post_date ), 'l, F j, Y' );
                }
                if ( $date_group !== $next_post_date ) {
                ?>
                    </div>
                <?php
                }
            }
        }
        ?>
        </div>
        <?php
        if ( $listing_page ) {
            $result_style = $query->have_posts() ? 'display: none;' : 'display: block;';
        ?>
            <p class="no-data" style="<?php echo esc_attr( $result_style ); ?>">Result not found.</p>
            <div class="load-more-sessions text-center <?php echo $query->max_num_pages > 1 ? '' : esc_attr( 'display-none' ); ?>" id="load-more-sessions">
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
}

wp_reset_postdata();
