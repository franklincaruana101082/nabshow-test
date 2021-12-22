<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package NABShow_LV
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 *
 * @since 1.0.0
 */
function nabshow_lv_body_classes( $classes ) {

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}

add_filter( 'body_class', 'nabshow_lv_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 *
 * @return string
 *
 * @since 1.0.0
 */
function nabshow_lv_pingback_header() {

	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}

add_action( 'wp_head', 'nabshow_lv_pingback_header' );


function nabshow_render_schedule($schedule_id) {
    if($schedule_id) {
?>
<div class="decorative _blur _blur-middle">
    <div class="schedule-table-container">
        <div class="schedule-table">
            <div class="schedule-table-intro">
                <h2 class="h-xl"><?php echo esc_html( get_field( 'schedule_table_title', $schedule_id ) );?></h2>
            </div>
            <div class="schedule-table-table">
                <?php
                $featured_event         = get_field( 'featured_event', $schedule_id );
                $schedule_event_details = get_field( 'schedule_event_details', $schedule_id );
                ?>
                <table>
                    <caption><?php echo esc_html( get_field( 'schedule_table_caption', $schedule_id ) );?></caption>
                    <thead>
                        <?php
                        if ( $featured_event && is_array( $featured_event ) ) {                                 
                            ?>
                            <tr>
                                <th scope="col" class="col-heading"><?php echo esc_html( $featured_event['title'] ); ?></th>
                                <?php
                                if ( is_array( $featured_event['featured_event_schedule'] ) && count( $featured_event['featured_event_schedule'] ) > 0 ) {
                                    
                                    foreach ( $featured_event['featured_event_schedule'] as $featured_event_date ) {

                                        if ( isset( $featured_event_date['event_date'] ) && ! empty( $featured_event_date['event_date'] ) ) {
                                            $featured_create_date   = date_create( $featured_event_date['event_date'] );                                                    
                                            $date_day               = date_format( $featured_create_date, 'l' );
                                            $day_part1              = substr( $date_day, 0, 3 );
                                            $day_part2              = substr( $date_day, 3 );
                                            $final_date             = date_format( $featured_create_date, 'd' );
                                            ?>
                                            <th scope="col" class="col-date"><?php echo esc_html( $day_part1 ); ?><span><?php echo esc_html( $day_part2 ); ?></span><b><?php echo esc_html( $final_date ); ?></b></th>
                                            <?php
                                        }
                                    }
                                }
                                ?>                                      
                            </tr>
                            <?php
                        }
                        ?>
                    </thead>
                    <?php
                    if ( $schedule_event_details && is_array( $schedule_event_details ) ) {
                        
                        foreach ( $schedule_event_details as $schedule_detail ) {
                            
                            $link           = '#';
                            $title_part1    = '';
                            $title_part2    = '';
                            $link_target    = '_self';

                            if ( isset( $schedule_detail['link'] ) && is_array( $schedule_detail['link'] ) ) {
                                
                                $link           = $schedule_detail['link']['url'];
                                $link_target    = ! empty( $schedule_detail['link']['target'] ) ? $schedule_detail['link']['target'] : $link_target;
                                
                                if ( ! empty( $schedule_detail['link']['title'] ) ) {

                                    $title_array    = explode( ' ', $schedule_detail['link']['title'] );
                                    $last_index     = count( $title_array ) - 1;
                                    
                                    if ( count( $title_array ) > 1 ) {
                                        $title_part2 = $title_array[ $last_index ];
                                        unset( $title_array[ $last_index ] );
                                        $title_part1 = implode( ' ', $title_array );
                                    } else {
                                        $title_part1 = $schedule_detail['link']['title'];
                                    }
                                }                                       
                            }
                            ?>
                            <tr>
                                <th scope="row" class="row-heading"><a href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $title_part1 ); ?> <b><?php echo esc_html( $title_part2 ); ?></b></a></th>
                                <?php
                                if ( isset( $schedule_detail['event_dates'] ) && is_array( $schedule_detail['event_dates'] ) ) {
                                    
                                    foreach ( $schedule_detail['event_dates'] as $current_event ) {
                                        
                                        if ( isset( $current_event['date'] ) && ! empty( $current_event['date'] ) )  {
                                            
                                            $schedule_create_date   = date_create( $current_event['date'] );
                                            $final_schedule_date    = date_format( $schedule_create_date, 'l, F d' );
                                            ?>
                                            <td class="row-date"><span><?php echo esc_html( $final_schedule_date ); ?></span></td>
                                            <?php
                                        } else {
                                            ?>
                                            <td class="row-date"></td>
                                            <?php
                                        }                                               
                                    }
                                }                                       
                                ?>                                      
                            </tr>
                            <?php
                        }                               
                    }
                    ?>                          
                </table>
            </div>
        </div>
    </div>
</div>
<?php }

}