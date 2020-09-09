<?php

/**
 * Exit if accessed directly
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

$posts_per_page     = isset( $attributes['itemToFetch'] ) && $attributes['itemToFetch'] > 0 ? $attributes['itemToFetch'] : 10;
$channels           = isset( $attributes['channels'] ) && ! empty( $attributes['channels'] ) ? $attributes['channels'] : array();
$display_order      = isset( $attributes['displayOrder'] ) && ! empty( $attributes['displayOrder'] ) ? $attributes['displayOrder'] : 'ASC';
$filter_type        = isset( $attributes['filterType'] ) ? $attributes['filterType'] : true;
$keyword_filter     = isset( $attributes['keywordFilter'] ) ? $attributes['keywordFilter'] : true;
$channel_filter     = isset( $attributes['channelFilter'] ) ? $attributes['channelFilter'] : true;
$date_filter        = isset( $attributes['dateFilter'] ) ? $attributes['dateFilter'] : true;
$display_open_to    = isset( $attributes['isOpenTo'] ) ? $attributes['isOpenTo'] : true;
$session_details    = isset( $attributes['sessionDetails'] ) ? $attributes['sessionDetails'] : true;
$session_date       = isset( $attributes['sessionDate'] ) ? $attributes['sessionDate'] : true;
$channel_selector   = isset( $attributes['channelSelector'] ) ? $attributes['channelSelector'] : false;
$class_name         = isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ? $attributes['className'] : '';
$class_name         .= $filter_type ? 'with-filter' : 'without-filter';
$session_class      = 'session-date-list-wrapper';

$query_args = array(
    'post_type'      => 'sessions',
    'posts_per_page' => $posts_per_page,
    'meta_key'       => 'session_date',
    'orderby'        => 'meta_value',
    'order'          => $display_order
);    

if ( $channel_selector && is_array( $channels ) && count( $channels ) > 0 ) {
    $query_args[ 'meta_query' ] = array(
        array(
            'key'     => 'session_channel',
            'value'   => $channels,
            'compare' => 'IN'
        )
    );
}

$query = new WP_Query( $query_args );

if ( $filter_type ) {
    
    if ( ! $session_details ) {
        $session_class .= ' without-details';
    }
    if ( ! $session_date ) {
        $session_class .= ' without-date';
    }
    if ( ! $display_open_to ) {
        $session_class .= ' without-open-to';
    }
}

if ( $query->have_posts() ) {
?>

    <div class="session-date-list <?php echo esc_attr( $class_name ); ?>">

        <?php
        if ( $filter_type ) {
            ?>
            <div class="session-date-list-filter">
                <?php
                if ( $keyword_filter ) {
                    ?>
                    <div class="search-box">
                        <label>Keyword</label>
                        <div class="search-item">
                            <input class="search" type="text" placeholder="Filter by keyword...">
                        </div>
                    </div>
                    <?php
                }
                if ( $channel_filter ) {
                    ?>
                    <div class="channel-box">
                        <label>Channel</label>
                        <div>
                            <?php
                            
                            $channel_query = get_transient( 'sessions-date-filter-channels' );
                            
                            if ( false === $channel_query || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {
                                
                                $channel_args = array(
                                    'post_type'      => 'channels',
                                    'posts_per_page' => -1,            
                                    'orderby'        => 'title',
                                    'order'          => 'ASC'
                                );
                                
                                $channel_query = new WP_Query( $channel_args );

                                if ( $channel_query->have_posts() ) {
                                    set_transient( 'sessions-date-filter-channels', $channel_query, 100 * MINUTE_IN_SECONDS + wp_rand( 1, 60 ) );
                                }
                            }
                            
                            ?>
                            <select id="session-channel" class="session-channel">
                                <option value="">Select a Channel</option>
                            <?php
                
                            if ( $channel_query->have_posts() ) {
                                
                                while ( $channel_query->have_posts() ) {
                
                                    $channel_query->the_post();
                                    ?>
                                    <option value="<?php echo esc_attr( get_the_ID() ); ?>"><?php echo esc_html( get_the_title() ); ?></option>
                                    <?php
                                }
                
                                wp_reset_postdata();
                            }
                            ?>                    
                            </select>
                        </div>
                    </div>
                    <?php
                }
                if ( $date_filter ) {
                    ?>
                    <div class="date-box">
                        <label>Date</label>
                        <div>
                            <?php
                            $date_array = array();

                            $date_query = get_transient( 'sessions-date-filter-date-list' );

                            ?>
                            <select id="session-date" class="session-date">
                                <option value="">Select a Date</option>
                                <?php
                                if ( false === $date_query || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {
                                    $date_args = array(
                                        'post_type'      => 'sessions',
                                        'posts_per_page' => -1,
                                        'fields'         => 'ids',
                                        'meta_key'       => 'session_date',
                                        'orderby'        => 'meta_value',
                                        'order'          => 'ASC'
                                    );
                                    
                                    $date_query = new WP_Query( $date_args );

                                    if ( $date_query->have_posts() ) {
                                        
                                        $session_ids    = $date_query->posts;                                

                                        foreach( $session_ids as $date_session_id ) {
                                            
                                            $session_date = get_post_meta( $date_session_id, 'session_date', true );
                                            
                                            if ( ! in_array( $session_date, $date_array, true ) ) {
                                                $date_array[] = $session_date;
                                            }
                                        }
                                        if ( count( $date_array ) > 0 ) {
                                            set_transient( 'sessions-date-filter-date-list', $date_array, 100 * MINUTE_IN_SECONDS + wp_rand( 1, 60 ) ); 
                                        }
                                        wp_reset_postdata();
                                    }
                                } else {
                                    $date_array = $date_query;
                                }
                                if ( count( $date_array ) > 0 ) {
                                    foreach( $date_array as $dt ) {
                                        ?>
                                        <option value="<?php echo esc_attr( $dt ); ?>"><?php echo esc_html( date_format( date_create( $dt ), 'l, F j' ) ); ?></option>
                                        <?php    
                                    }
                                }                            
                                ?>
                            </select>
                        </div>
                    </div>
                    <?php
                }
                ?>                
            </div>
            <?php
        }    
        ?>
        <div class="<?php echo esc_attr( $session_class ); ?>" id="session-date-list-wrapper">
        <?php

            $date_group = '';
            $counter    = 0;

            while ( $query->have_posts() ) {

                $query->the_post();

                $session_id     = get_the_ID();
                $date           = get_field( 'session_date',  $session_id );
                $start_time     = get_field( 'start_time',  $session_id );
                $end_time       = get_field( 'end_time',  $session_id );
                $is_open_to     = get_field( 'is_open_to',  $session_id );
                $is_open_to     = 'Select Open To' === $is_open_to ? '' : $is_open_to;
                $session_img    = has_post_thumbnail() ? get_the_post_thumbnail_url() : plugins_url( 'assets/images/session-placeholder.png', dirname( __FILE__ ) );
                $schedule_class = 'white_bg';
                $button_text    = 'Learn More';
                $session_link   = get_the_permalink();

                if ( ! empty( $date ) ) {
                    $current_date   = current_time('Ymd');
                    $session_date   = date_format( date_create( $date ), 'Ymd' );
                    $date1          = new DateTime( $session_date );
                    $now            = new DateTime( $current_date );

                    if ( $date1 < $now )  {
                        $schedule_class = 'gray_bg';
                        $button_text    = 'Watch On Demand';
                    } elseif ( $date1 > $now ) {
                        $schedule_class = 'white_bg';
                        $button_text    = 'Learn More';
                    } else if ( $session_date === $current_date ) {
                        
                        $current_time   = current_time('g:i a');                    
                        $time1          = DateTime::createFromFormat('H:i a', $current_time);
                        $time2          = DateTime::createFromFormat('H:i a', $start_time);
                        $time3          = DateTime::createFromFormat('H:i a', $end_time);
                                                         
                        if ( $time1 > $time2 && $time1 < $time3 ) {
                            $schedule_class = 'green_bg show_desc';
                            $button_text    = 'Tune in Now';
                        } elseif ( $time1 <= $time2) {
                            $schedule_class = 'white_bg';
                            $button_text    = 'Learn More';
                        } elseif ( $time1 >= $time3 ) {
                            $schedule_class = 'gray_bg';
                            $button_text    = 'Watch On Demand';
                        }
                    }                
                }

                if ( ! empty( $start_time ) ) {

                    $start_time = str_replace( array( 'am','pm' ), array( 'a.m.','p.m.' ), date_format( date_create( $start_time ), 'g:i a' ) );
                    $start_time = str_replace(':00', '', $start_time );

                }
                if ( ! empty( $end_time ) ) {

                    $end_time   = str_replace( array( 'am','pm' ), array( 'a.m.','p.m.' ), date_format( date_create( $end_time ), 'g:i a' ) );
                    $end_time   = str_replace(':00', '', $end_time );

                }
                
                if ( false !== strpos( $start_time, 'a.m.' ) && false !== strpos( $end_time, 'a.m.' ) ) {
                    $start_time = str_replace(' a.m.', '', $start_time );
                }

                if ( false !== strpos( $start_time, 'p.m.' ) && false !== strpos( $end_time, 'p.m.' ) ) {
                    $start_time = str_replace(' p.m.', '', $start_time );
                }

                if ( $date_group !== $date && $session_date) {

                    $date_group = $date;                    

                    ?>
                    <div class="schedule-data">
                    <h2><?php echo esc_html( date_format( date_create( $date ), 'l, F j' ) ); ?></h2>
                    <?php 
                } ?>

                <div class="schedule-row <?php echo esc_attr( $schedule_class ); ?>">
                    <div class="date">
                        <p><?php echo esc_html( $start_time ); ?> - <?php echo esc_html( $end_time ); ?> ET</p>
                    </div>
                    <div class="session-img">                
                        <img src="<?php echo esc_url( $session_img ); ?>" alt="session-img" />
                    </div>
                    <div class="info">
                        <div class="name">
                            <h3><a href="<?php echo esc_url( $session_link ); ?>"><?php echo esc_html( get_the_title() ); ?></a></h3>
                        </div>
                        <?php
                        if ( $filter_type ) {
                            ?>
                            <div class="channel-pass">
                                <?php
                                
                                $channel = get_field( 'session_channel',  $session_id );
                                
                                if ( ! empty( $channel ) ) {
                                    ?>
                                    <a href="<?php echo esc_url( get_the_permalink( $channel ) ); ?>"><span class="channel-name"><?php echo esc_html( get_the_title( $channel ) ); ?></span></a>
                                    <?php
                                }
                                if ( $display_open_to && ! empty( $is_open_to ) ) {
                                    ?>
                                    <span class="pass-name"><?php echo esc_html( $is_open_to ); ?></span>
                                    <?php
                                }
                                ?>
                                
                            </div>
                            <?php
                        }
                        if ( $session_details ) {
                            ?>
                            <div class="info-more-details">
                                <p><?php echo esc_html( get_the_excerpt( $session_id ) ); ?></p>
                                <?php
                                $rows = get_field( 'speaker_list' );
                                
                                if ( $rows ) {
                                    ?>
                                    <div class="session-speaker">Featuring: 
                                        <ul>
                                        <?php                                    
                                        foreach( $rows as $row ) {
                                            $speaker_id     = $row['session_speaker'];
                                            $speaker_name   = get_the_title( $speaker_id );
                                            $speaker_name   = explode(',', $speaker_name, 2);
                                            $speaker_name   = isset( $speaker_name[1] ) ? $speaker_name[1] . ' ' . $speaker_name[0] : $speaker_name[0];
                                            ?>
                                            <li><a href="#" class="speaker-detail-list-modal" data-postid="<?php echo esc_attr( $speaker_id ); ?>"><?php echo esc_html( $speaker_name ); ?></a></li>
                                            <?php
                                        }
                                        ?>
                                        </ul>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <?php
                        }
                        ?>                        
                    </div>
                    <div class="more-details-link">                        
                        <a href="<?php echo esc_url( $session_link ); ?>"><?php echo esc_html( $button_text ); ?></a>
                    </div>
                </div>
                <?php
                $counter++;
                $next_post_date = isset( $query->posts[$counter]->ID ) ? get_field( 'session_date', $query->posts[$counter]->ID ) : '';

                if ( $date_group !== $next_post_date && $session_date ) {
                ?>
                    </div>
                <?php
                }
            }
            ?>
        </div>
        <?php
        if ( $filter_type ) {
            
            if ( $channel_selector && is_array( $channels ) && count( $channels ) > 0 ) {
                ?>
                <input type="hidden" class="filter-channels" name="filter-channel" value="<?php echo esc_attr( implode(',', $channels ) ); ?>" />
                <?php
            }
            ?>  
            <input type="hidden" class="order-type" name="order-type" value="<?php echo esc_attr( $display_order ); ?>" />
            <?php
            if ( $query->max_num_pages > 1 ) {                
                $result_style = $query->have_posts() ? 'display: none;' : 'display: block;';
                ?>
                <p class="no-data" style="<?php echo esc_attr( $result_style ); ?>">Result not found.</p>
                <div class="load-more-date-sessions text-center <?php echo $query->max_num_pages > 1 ? '' : esc_attr( 'display-none' ); ?>" id="load-more-date-sessions">
                    <a href="javascript:void(0);" class="btn-default" data-page-number="2" data-post-limit="<?php echo esc_attr( $posts_per_page ); ?>" data-total-page="<?php echo absint( $query->max_num_pages ); ?>">Load More</a>
                </div>
                <?php
            }                    
        }
        ?>
    </div>
<?php
    wp_reset_postdata();
} else {
?>
    <p class="coming-soon">Coming soon.</p>
<?php
    }
?>