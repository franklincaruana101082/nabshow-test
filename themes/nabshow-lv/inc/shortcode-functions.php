<?php
/**
 * This file contains all shortcodes functions located in this file.
 *
 *
 * @package NABShow_LV
 */

/**
 * Shortcode for yoast breadcrumb.
 *
 * @return string
 *
 * @since 1.0.0
 */
function nabshow_lv_yoast_breadcrumb_callback() {

    if ( function_exists('yoast_breadcrumb') ) {

        return yoast_breadcrumb('<div id="breadcrumbs">', '</div>', false);

    } else {

        return '';
    }
}

/**
 * Display date with page link according to date selected on page.
 *
 * @param $atts
 *
 * @return string
 *
 * @since 1.0.0
 */
function nabshow_lv_schedule_date_callback( $atts ) {

    $atts = shortcode_atts( array(
		'index' => 0,
	), $atts );

    $date_index       = isset( $atts[ 'index' ] ) && $atts[ 'index' ] > 0 ? $atts[ 'index' ] - 1 : 0;

    $date_field_group = get_field( 'date_group');
    $date_index_row   = isset( $date_field_group[ $date_index ] ) ? $date_field_group[ $date_index ] : array();
    $date             = isset( $date_index_row[ 'page_dates' ] ) ? $date_index_row[ 'page_dates' ] : '';

	ob_start();

    if ( ! empty( $date ) ) {

        $date_day  = strtolower( Date('l', strtotime( $date ) ) );
	    $day_link  = nabshow_lv_get_day_page_link( $date_day );

	    if ( ! empty( $day_link ) ) {

	        $day_link = site_url() . $day_link;
	        ?>
            <p class="selectedDate"><a href="<?php echo esc_url( $day_link ); ?>"><?php echo esc_html( $date ); ?></a></p>
            <?php

        } else {
	        ?>
            <p class="selectedDate"><?php echo esc_html( $date ); ?></p>
            <?php
        }
    }

    $html = ob_get_clean();

    return $html;

}

/**
 * Display hall according to hall selected on page.
 *
 * @return string
 *
 * @since 1.0.0
 */
function nabshow_lv_schedule_hall_callback() {

    $page_halls = get_field( 'page_hall');

    ob_start();

    if ( is_array( $page_halls ) && ! empty( $page_halls ) ) {

        $site_url = get_site_url();

	    foreach ( $page_halls as $hall ) {

            $hall_link = nabhsow_lv_get_hall_page_link( $hall );

            if ( ! empty( $hall_link ) ) {

                $hall_link = $site_url . $hall_link;
                ?>
                <p class="selectedHall"><a href="<?php echo esc_url( $hall_link ); ?>"><?php echo esc_html( $hall ); ?></a></p>
                <?php

            } else {
                ?>
                <p class="selectedHall"><?php echo esc_html( $hall ); ?></p>
                <?php
            }
        }
    }

	$html = ob_get_clean();

	return $html;
}