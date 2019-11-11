<?php
/**
 * This file contains all shortcodes functions located in this file.
 *
 *
 * @package NABShow_LV
 */

/**
 * Create dropdown box
 * @param $atts
 * @return string
 */
function nabshow_lv_dropdown_func( $atts ) {
    $atts = shortcode_atts( array(
        'first_option' => '',
        'is_faq'       => false,
        'parent_slug'  => '',
    ), $atts );
    ob_start();
    ?>
        <select id="<?php echo $atts['is_faq'] ? esc_attr('faq-category-drp') : ''; ?>" class="<?php echo ! $atts['is_faq'] ? esc_attr('plan-your-show-drp') : esc_attr('faq-category-drp'); ?>">
            <?php
            if ( isset( $atts['first_option'] ) && ! empty( $atts['first_option'] ) ) {
            ?>
                <option value=""><?php echo esc_html( $atts['first_option'] ); ?></option>
            <?php
            }
            if ( ! $atts['is_faq'] && ! empty( $atts['parent_slug'] ) ) {
                $page = get_page_by_path( $atts['parent_slug'] );
                if ( $page ){

                    $children = get_pages( array( 'child_of' => $page->ID, 'parent' => $page->ID ) );

                    if ( ! empty( $children ) ) {
                        foreach ( $children as $child ) {
                        ?>
                            <option value="<?php echo esc_url( get_permalink( $child->ID ) ); ?>"><?php echo esc_html( $child->post_title ); ?></option>
                        <?php
                        }
                    }
                }
            }
            ?>
        </select>
    <?php
    $html = ob_get_clean();
    return $html;
}

/**
 * Fetch latest instagram feed.
 * @param $atts
 * @return string
 */
function nabshow_lv_latest_instagram_post_func($atts){
$atts = shortcode_atts( array(
	'count' => 1,
    'access_token' => '2203194498.1d37e34.b17b7e141fac431fb4c0fda279d72cd6',
), $atts );

	$url = 'https://api.instagram.com/v1/users/self/media/recent/?access_token='.$atts['access_token'].'&count='.$atts['count'];
	$latest_image_url          = get_transient( 'nab-latest-instagram-post' . $atts['access_token'].$atts['count'] );

	if ( false === $latest_image_url ) {
		$response = wp_safe_remote_get($url);
		$body = wp_remote_retrieve_body( $response );
		$json = json_decode( $body );
		$latest_image_url = $json->data[0]->images->standard_resolution->url;

		set_transient( 'nab-latest-instagram-post' . $atts['access_token'].$atts['count'], $latest_image_url, 20 * MINUTE_IN_SECONDS + wp_rand( 1, 60 ) );
	}
ob_start();
?>
    <div><a href="https://www.instagram.com/nabshow/" target="_blank"><img src="<?php echo esc_url($latest_image_url); ?>" alt="instagram-img" class="insta-latest"/></a></div>
<?php
	$html = ob_get_clean();
    return $html;
}

/**
 * Create filter for schedule at a glance page
 * @return string
 */
function nabshow_lv_schedule_at_a_glance_filter() {
    ob_start();
    ?>
        <div class="schedule-glance-filter">
            <div class="date">
                <label>Date</label>
                <div class="schedule-select">
                    <select id="date">
                        <option>Select a Date</option>
                    </select>
                </div>
            </div>
            <div class="pass-type">
                <label>Is Open To</label>
                <div class="schedule-select">
                    <select id="pass-type">
                        <option>Select a Pass Time</option>
                    </select>
                </div>
            </div>
            <div class="location">
                <label>Location</label>
                <div class="schedule-select">
                    <select id="location">
                        <option>Select a Location</option>
                    </select>
                </div>
            </div>
            <div class="type">
                <label>Type</label>
                <div class="schedule-select">
                    <select id="type">
                        <option>Select a Type</option>
                    </select>
                </div>
            </div>
            <div>
                <label>Name</label>
                <div class="schedule-select">
                    <input type="text" placeholder="Start typing to filter by name..." name="">
                </div>
            </div>
        </div>
    <?php
    $html = ob_get_clean();
    return $html;
}

/**
 * Create shortcode for yoast breadcrumb
 * @return string
 */
function nabshow_lv_yoast_breadcrumb_callback() {
    if ( function_exists('yoast_breadcrumb') ) {
        return yoast_breadcrumb('<div id="breadcrumbs">', '</div>', false);
    } else {
        return '';
    }
}

/**
 * Filter options for browse pages
 * @param $atts
 * @return string
 */
function nabshow_lv_browse_filter_callback( $atts ) {

    $atts = shortcode_atts( array(
		'type'     => '',
	    'featured' => '',
	), $atts );

    $filter_class = 'browse-' . $atts[ 'type' ] . '-filter';
    $date_picker = false;
    ob_start();
    ?>
    <div class="browse-filter main-filter row <?php echo esc_attr( $filter_class ); ?>">
        <?php
        if ( 'open-to-all' === $atts[ 'type' ] || 'learn' === $atts[ 'type' ]  || ( ! empty( $atts[ 'featured' ] ) && 'yes' === strtolower( $atts[ 'featured' ] ) ) ) {
            if ( 'happenings' === $atts[ 'type' ] ||  'learn' === $atts[ 'type' ] ) {
                $page_type_title = 'Type';
            ?>
                <div class="col-xl-12 display-flex-box">
                    <div class="category">
                        <label for="page-date">Date</label>
                        <select id="page-date" class="select-opt">
                            <option>Select a Date</option>
                        </select>
                    </div>
                    <?php
                    if ( 'learn' === $atts[ 'type' ] ) {
	                    $page_type_title = 'Program Type'
                    ?>
                        <div class="category">
                            <label for="open-to">Open To</label>
                            <select id="open-to" class="select-opt">
                                <option>Select a Pass</option>
                            </select>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="category">
                        <label for="page-location">Location</label>
                        <select id="page-location" class="select-opt">
                            <option>Select a Location</option>
                        </select>
                    </div>
                    <div class="category">
                        <label for="page-type"><?php echo esc_html( $page_type_title ); ?></label>
                        <select id="page-type" class="select-opt">
                            <option>Select a Type</option>
                        </select>
                    </div>
                    <div class="search-box">
                        <label for="browse-search">Keyword</label>
                        <div class="search-item icon-right">
                            <input class="search" type="text" id="browse-search" placeholder="Filter by keyword...">
                        </div>
                    </div>
                </div>
            <?php
            } elseif ( 'sessions' === $atts[ 'type' ] || 'open-to-all' === $atts[ 'type' ] ) {
	            $date_picker = true;
            ?>
                <div class="col-xl-12 display-flex-box">
                    <div class="category">
                        <label for="session-date">Date</label>
                        <div class="browse-select">
                            <input type="text" name="speaker_date" id="session-date" placeholder="MM, DD 20XX"/>
                        </div>
                    </div>
                    <?php
                    if ( 'sessions' === $atts[ 'type' ] ) {
                    ?>
                        <div class="category">
                            <label for="is-open-to">Is Open To</label>
                            <select id="is-open-to" class="select-opt">
                                <option>Select a Category</option>
                            </select>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="category">
                        <label for="session-program">Program</label>
                        <select id="session-program" class="select-opt">
                            <option>Select a Category</option>
                        </select>
                    </div>
                    <div class="category">
                        <label for="session-topic">Topic</label>
                        <select id="session-topic" class="select-opt">
                            <option>Select a Category</option>
                        </select>
                    </div>
                    <div class="search-box">
                        <label for="browse-search">Keyword</label>
                        <div class="search-item icon-right">
                            <input class="search" type="text" id="browse-search" placeholder="Filter by keyword...">
                        </div>
                    </div>
                </div>
            <?php
            } elseif ( 'speakers' === $atts[ 'type' ] ) {
            ?>
                <div class="left-side col-xl-2 featured-filter">
                    <div class="search-box">
                        <label for="speaker-title-search">Job Title</label>
                        <div class="search-item">
                            <input id="speaker-title-search" class="speaker-title-search" name="speaker-title-search" type="text" placeholder="Search by Job Title..">
                        </div>
                    </div>
                    <div class="category">
                        <label for="speaker-company">Company</label>
                        <select id="speaker-company" class="select-opt">
                            <option>Select a Company</option>
	                        <?php
	                        nabshow_lv_get_term_list_options( 'speaker-companies' );
	                        ?>
                        </select>
                    </div>
                </div>
                <div class="pass-type col-xl-7">
                    <label>Name</label>
                    <?php
                    nabshow_lv_alphabets_list_filter();
                    ?>
                </div>
                <div class="col-xl-3">
                    <div class="search-box">
                        <label for="browse-search">Keyword</label>
                        <div class="search-item icon-right">
                            <input id="browse-search" class="search" type="text" placeholder="Filter by keyword...">
                        </div>
                    </div>
                </div>
            <?php
            }
        } else {
	        if ( 'sponsors' !== $atts[ 'type' ] && 'product-categories' !== $atts[ 'type' ] ) {

		        if ( 'exhibitors' === $atts[ 'type' ] ) {
			        $get_featured   = filter_input( INPUT_GET, 'exhibitor-key', FILTER_SANITIZE_STRING );
		        } elseif ( 'sessions' === $atts[ 'type' ] ) {
			        $get_featured   = filter_input( INPUT_GET, 'session-key', FILTER_SANITIZE_STRING );
                } elseif ( 'speakers' === $atts[ 'type' ] ) {
			        $get_featured   = filter_input( INPUT_GET, 'speaker-key', FILTER_SANITIZE_STRING );
                } elseif ( 'happenings' === $atts[ 'type' ] ) {
			        $get_featured   = filter_input( INPUT_GET, 'happening-key', FILTER_SANITIZE_STRING );
                }

		        $featured_class = 'featured-btn';

		        if ( isset( $get_featured ) && 'featured' === strtolower( $get_featured ) ) {
			        $featured_class .= ' active';
                }

		        ?>
                <div class="left-side col-xl-5">
                    <div class="search-box">
                        <label for="browse-search">Keyword</label>
                        <div class="search-item">
                            <input id="browse-search" class="search" name="browse-search" type="text" placeholder="Filter by keyword...">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <input type="button" class="<?php echo esc_attr( $featured_class ); ?>" value="Featured">
					        <?php
					        if ( 'speakers' === $atts[ 'type' ] || 'exhibitors' === $atts[ 'type' ] ) {
						        ?>
                                <input type="button" class="orderby" value="A-Z">
						        <?php
					        }
					        ?>
                        </div>
                    </div>
			        <?php
			        if ( 'speakers' === $atts[ 'type' ] ) {
				        ?>
                        <div class="search-box">
                            <label for="speaker-title-search">Job Title</label>
                            <div class="search-item">
                                <input id="speaker-title-search" class="speaker-title-search" name="speaker-title-search" type="text" placeholder="Search by Job Title..">
                            </div>
                        </div>
				        <?php
			        }
			        ?>
                </div>
                <div class="pass-type col-xl-7">
                    <label>Category</label>
                    <?php
                    nabshow_lv_alphabets_list_filter();
                    ?>
                    </ul>
                </div>
		        <?php
	        }
	        ?>

	        <?php
	        if ( 'exhibitors' === $atts[ 'type' ] ) {

		        $all_terms = get_terms( array(
			        'taxonomy'   => 'exhibitor-keywords',
			        'hide_empty' => true,
		        ) );

		        if ( is_array( $all_terms ) && ! is_wp_error( $all_terms ) ) {

			        $get_exkey = filter_input( INPUT_GET, 'exhibitor-key', FILTER_SANITIZE_STRING );
			        ?>
                    <div class="col-lg-12 chechbox-main">
				        <?php
				        foreach ( $all_terms as $term ) {
					        if ( 'featured' !== $term->slug ) {
						        ?>
                                <div class="custom-check-box">
                                    <input type="checkbox" name="keywords[]" value="<?php echo esc_attr( $term->slug ); ?>" class="exhibitor-keywords" id="<?php echo esc_attr( $term->slug ); ?>" <?php checked( $term->slug, $get_exkey); ?>>
                                    <label for="<?php echo esc_attr( $term->slug ); ?>"><?php echo esc_html( $term->name ); ?></label>
                                </div>
						        <?php
					        }
				        }
				        ?>
                    </div>
			        <?php
		        }
	        }
	        if ( 'destinations' === $atts[ 'type' ] || 'happenings' === $atts[ 'type' ] ) {
		        ?>
                <div class="col-lg-12 chechbox-main">
                    <div class="custom-check-box">
                        <input type="checkbox" name="new_this_year" value="Yes" class="new-this-year" id="new-this-year">
                        <label for="new-this-year">New This Year</label>
                    </div>
                </div>
		        <?php
	        }
	        ?>
            <div class="select-items col-lg-12">
                <div class="row">
			        <?php
			        if ( 'sessions' === $atts[ 'type' ] ) {
				        ?>
                        <div class="category col-lg-3">
                            <label for="session-tracks">Track</label>
                            <div class="browse-select">
                                <select id="session-tracks" class="select-opt">
                                    <option>Select a Track</option>
							        <?php
							        nabshow_lv_get_term_list_options( 'tracks' );
							        ?>
                                </select>
                            </div>
                        </div>
                        <div class="category col-lg-3">
                            <label for="session-level">Level</label>
                            <div class="browse-select">
                                <select id="session-level" class="select-opt">
                                    <option>Select a Level</option>
							        <?php
							        nabshow_lv_get_term_list_options( 'session-levels' );
							        ?>
                                </select>
                            </div>
                        </div>
                        <div class="category col-lg-3">
                            <label for="session-type">Types</label>
                            <div class="browse-select">
                                <select id="session-type" class="select-opt">
                                    <option>Select a Type</option>
							        <?php
							        nabshow_lv_get_term_list_options( 'session-types' );
							        ?>
                                </select>
                            </div>
                        </div>
                        <div class="category col-lg-3">
                            <label for="session-location">Location</label>
                            <div class="browse-select">
                                <select id="session-location" class="select-opt">
                                    <option>Select a Location</option>
							        <?php
							        nabshow_lv_get_term_list_options( 'session-locations' );
							        ?>
                                </select>
                            </div>
                        </div>
				        <?php
			        } elseif ( 'exhibitors' === $atts[ 'type' ] ) {
				        ?>
                        <div class="category col-lg-3">
                            <label for="exhibitor-category">Category</label>
                            <div class="browse-select">
                                <select id="exhibitor-category" class="select-opt">
                                    <option>Select a Category</option>
							        <?php
							        nabshow_lv_get_term_list_options( 'exhibitor-categories' );
							        ?>
                                </select>
                            </div>
                        </div>
                        <div class="category col-lg-3">
                            <label for="exhibitor-hall">Halls</label>
                            <div class="browse-select">
                                <select id="exhibitor-hall" class="select-opt">
                                    <option>Select a Location</option>
							        <?php
							        nabshow_lv_get_term_list_options( 'halls' );
							        ?>
                                </select>
                            </div>
                        </div>
                        <div class="category col-lg-3">
                            <label for="exhibitor-pavilion">Pavilions</label>
                            <div class="browse-select">
                                <select id="exhibitor-pavilion" class="select-opt">
                                    <option>Select a Pavilion</option>
							        <?php
							        nabshow_lv_get_term_list_options( 'pavilions' );
							        ?>
                                </select>
                            </div>
                        </div>
                        <div class="category col-lg-3">
                            <label for="exhibitor-technology">Technology</label>
                            <div class="browse-select">
                                <select id="exhibitor-technology" class="select-opt">
                                    <option>Select a Technology</option>
							        <?php
							        nabshow_lv_get_term_list_options( 'exhibitor-trends' );
							        ?>
                                </select>
                            </div>
                        </div>
				        <?php
			        } elseif ( 'speakers' === $atts[ 'type' ] ) {
				        $date_picker = true;
                    ?>
                        <div class="category col-lg-3">
                            <label for="speaker-company">Company</label>
                            <div class="browse-select">
                                <select id="speaker-company" class="select-opt">
                                    <option>Select a Company</option>
							        <?php
							        nabshow_lv_get_term_list_options( 'speaker-companies' );
							        ?>
                                </select>
                            </div>
                        </div>
                        <div class="category col-lg-3">
                            <label for="speaker_date">Date</label>
                            <div class="browse-select">
                                <input type="text" name="speaker_date" id="speaker_date" placeholder="MM, DD 20XX"/>
                            </div>
                        </div>
				        <?php
			        } elseif ( 'destinations' === $atts[ 'type' ] || 'happenings' === $atts[ 'type' ] ) {
                    ?>
                        <div class="category col-lg-3">
                            <label for="page-location">Location</label>
                            <div class="browse-select">
                                <select id="page-location" class="select-opt">
                                    <option>Select a Location</option>
                                </select>
                            </div>
                        </div>
                        <div class="category col-lg-3">
                            <label for="page-type">Types</label>
                            <div class="browse-select">
                                <select id="page-type" class="select-opt">
                                    <option>Select a Type</option>
                                </select>
                            </div>
                        </div>

				        <?php
				        if ( 'happenings' === $atts[ 'type' ] ) {
					        $date_picker = true;
                        ?>
                            <div class="category col-lg-3">
                                <label for="happenings_date">Date</label>
                                <div class="browse-select">
                                    <input type="text" name="happenings_date" id="happenings_date" placeholder="MM, DD 20XX"/>
                                </div>
                            </div>
                            <div class="category col-lg-3">
                                <label for="happenings-order">Order</label>
                                <div class="browse-select">
                                    <select id="happenings-order" class="select-opt">
                                        <option value="default">Select a Order</option>
                                        <option value="Chronologically">Chronologically</option>
                                        <option value="A-Z">A-Z</option>
                                    </select>
                                </div>
                            </div>
                        <?php
				        }
                } elseif ( 'sponsors' === $atts[ 'type' ] ) {
                ?>
                    <div class="col-12 display-flex-box">
                        <div class="featured-main">
                            <input type="button" class="featured-btn" value="Featured">
                        </div>
                        <div class="category">
                            <div class="search-box">
                                <label for="browse-search">Keyword</label>
                                <div class="search-item">
                                    <input id="browse-search" class="search" name="browse-search" type="text" placeholder="Filter by keyword...">
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                } elseif ( 'product-categories' === $atts[ 'type'] ) {
			    ?>
                    <div class="col-12 display-flex-box">
                        <div class="browse-select category">
                            <label for="product-categories">Category</label>
                            <select id="product-categories" class="select-opt">
                                <option>Select a Category</option>
                            </select>
                        </div>
                        <div class="category">
                            <div class="search-box">
                                <label for="browse-search">Keyword</label>
                                <div class="search-item">
                                    <input id="browse-search" class="search" name="browse-search" type="text" placeholder="Filter by keyword...">
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
    <?php

    $html = ob_get_clean();

    if ( $date_picker ) {
	    wp_enqueue_script( 'jquery-ui-datepicker' );
	    wp_enqueue_style( 'jquery-ui', get_template_directory_uri() . '/assets/css/jquery-ui.min.css' );
    }

    return $html;
}

/**
 * Display date with page link
 * @param $atts
 * @return string
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