<?php
/**
 * Template Name: Slider Popup
 * @package  NABShow_LV
 *
 */

$current_type   = filter_input( INPUT_GET, 'posttype', FILTER_SANITIZE_STRING );
$current_id     = filter_input( INPUT_GET, 'postid', FILTER_SANITIZE_NUMBER_INT );
$contributor_id = filter_input( INPUT_GET, 'userid', FILTER_SANITIZE_NUMBER_INT );

wp_head();

if ( ( isset( $current_type ) && ! empty( $current_type ) ) && ( isset( $current_id ) && ! empty( $current_id ) ) ) {

	$popup_query_args = array(
		'post_type'      => $current_type,
		'posts_per_page' => 1,
		'post__in'       => array( $current_id )
	);
	$popup_query      = new WP_Query( $popup_query_args );

	if ( $popup_query->have_posts() ) {
		$show_code  = nabshow_lv_get_mys_show_code();
    ?>
        <!-- person popup -->
        <div class="modal-popup-nab">
            <div class="modal-popup-nab-body">
                <div class="close-sec">
                    <i class="fa fa-times" data-dismiss="modal"></i>
                </div>
				<?php
				while ( $popup_query->have_posts() ) {

					$popup_query->the_post();

					$query_post_id = get_the_ID();

					if ( "speakers" === $current_type ) {

						$speaker_title       = get_post_meta( $query_post_id, 'title', true );
						$session_id          = get_post_meta( $query_post_id, 'sessionid', true );
						$speaker_id          = get_post_meta( $query_post_id, 'speakerid', true );
					    $company             = get_the_terms( $query_post_id, 'speaker-companies' );
					    $company             = nabshow_lv_get_pipe_separated_term_list( $company );
                        $speaker_planner_url = 'https://' . $show_code . '.mapyourshow.com/8_0/sessions/speaker-details.cfm?speakerid=' . $speaker_id;

						if ( has_post_thumbnail() ) {
							$speaker_thumbnail_url = get_the_post_thumbnail_url();
						} else {
							$speaker_thumbnail_url = nabshow_lv_get_speaker_thumbnail_url();
						}
						?>
                        <div class="modal-popup-nab-inner">
                            <div class="mb50">
                                <div class="head">
                                    <div class="details">
                                        <h3 class="title"><a href="<?php echo esc_url( $speaker_planner_url ); ?>" target="_blank"><?php echo esc_html( get_the_title() ); ?></a></h3>
										<?php
										if ( ! empty( $speaker_title ) ) {
											?>
                                            <span class="sub-title"><?php echo esc_html( $speaker_title ); ?></span>
											<?php
										}
										if ( ! empty( $company ) ) {
											?>
                                            <strong class="company"><?php echo esc_html( $company ); ?></strong>
											<?php
										}
										?>
                                    </div>
                                    <div class="feature">
                                        <img class="round-img" src="<?php echo esc_url( $speaker_thumbnail_url ); ?>"
                                             alt="speaker">
                                    </div>
                                </div>
                                <?php nabshow_lv_get_popup_content( $query_post_id, $speaker_planner_url ); ?>
                            </div>
							<?php
							if ( ! empty( $session_id ) ) {
								$session_query = get_transient( 'mys-get-speaker-sessions-post-cache-' . $session_id );
								if ( false === $session_query ) {
									$session_query_args = array(
										'post_type'      => 'sessions',
										'posts_per_page' => 10,
										'meta_query'     => array(
											array(
												'key'     => 'speakers',
												'value'   => $current_id,
												'compare' => 'LIKE'
											)
										)
									);
									$session_query      = new WP_Query( $session_query_args );
									set_transient( 'mys-get-speaker-sessions-post-cache-' . $session_id, $session_query, 20 * MINUTE_IN_SECONDS + wp_rand( 1, 60 ) );
								}
								if ( $session_query->have_posts() ) {
									?>
                                    <h3 class="section-title">Catch <?php echo esc_html( get_the_title() ); ?> at:</h3>
                                    <ul class="session-list">
										<?php
										while ( $session_query->have_posts() ) {

											$session_query->the_post();

											$speaker_session_id = get_the_ID();
											$session_tracks     = get_the_terms( $speaker_session_id, 'tracks' );
											$sub_title          = nabshow_lv_get_pipe_separated_term_list( $session_tracks );
											$date               = get_post_meta( $speaker_session_id, 'date', true );
											$start_time         = get_post_meta( $speaker_session_id, 'starttime', true );
											$end_time           = get_post_meta( $speaker_session_id, 'endtime', true );

											if ( ! empty( $date ) ) {
												$date = date_format( date_create( $date ), 'l, F j, Y' );
											}
											if ( ! empty( $start_time ) ) {
												$start_time = str_replace( array('am','pm'), array('a.m.','p.m.'), date_format( date_create( $start_time ), 'g:i a' ) );
												$start_time = str_replace(':00', '', $start_time );
											}
											if ( ! empty( $end_time ) ) {
												$end_time = str_replace( array('am','pm'), array('a.m.','p.m.'), date_format( date_create( $end_time ), 'g:i a' ) );
												$end_time = str_replace(':00', '', $end_time );
											}

											$session_schedule   = ! empty( $date ) ? $date . ' | ' . $start_time . ' - ' . $end_time : $start_time . ' - ' . $end_time;
											$date_display_format = trim( $session_schedule, ' - ');

											?>
                                            <li class="item">
                                                <div class="inner">
                                                    <h4 class="title"><a href="#" class="modal-detail-list-modal-popup" data-postid="<?php echo esc_attr( $speaker_session_id ); ?>" data-posttype="sessions"><?php echo esc_html( mb_strimwidth( get_the_title(), 0, 83, '...' ) ); ?></a></h4>
													<?php
                                                    if ( ! empty( $sub_title ) ) {
													?>
                                                        <span class="caption"><?php echo esc_html( $sub_title ); ?></span>
													<?php
													}
													?>
                                                    <span class="date-time"><?php echo esc_html( $session_schedule ); ?></span>
                                                </div>
                                            </li>
											<?php
										}
										?>
                                    </ul>
									<?php
								}
								wp_reset_postdata();
								?>
								<?php
							}
							?>
                            <div class="popup-bottom">
                                <div class="view-btn">
                                    <a href="<?php echo esc_url( $speaker_planner_url ); ?>" target="_blank">View In Planner</a>
                                </div>
                                <div class="close-btn">
                                    <a href="#" data-dismiss="modal">Close Window</a>
                                </div>
                            </div>
                        </div>
						<?php
					} elseif ( "sessions" === $current_type ) {

						$all_locations        = get_the_terms( $query_post_id, 'session-locations' );
                        $session_tracks      = get_the_terms( $query_post_id, 'tracks' );
                        $session_tracks      = nabshow_lv_get_pipe_separated_term_list( $session_tracks );
                        $schedule_id         = get_post_meta( $query_post_id, 'scheduleid', true );
						$date                = get_post_meta( $query_post_id, 'date', true );
						$start_time          = get_post_meta( $query_post_id, 'starttime', true );
						$end_time            = get_post_meta( $query_post_id, 'endtime', true );
					    $session_planner_url = 'https://' . $show_code . '.mapyourshow.com/8_0/sessions/session-details.cfm?scheduleid=' . $schedule_id;
					    $location_url        = 'https://' . $show_code . '.mapyourshow.com/8_0/floorplan/';

						$temp_locations = array();

						if ( $all_locations && ! is_wp_error( $all_locations ) ) {

							foreach ( $all_locations as $location ) {
								$temp_locations[] = '<a href="' . $location_url  . '" target="_blank">' . $location->name . '</a>';
							}
						}

						$display_location = implode( ' | ', $temp_locations );

						if ( ! empty( $date ) ) {
							$date      = date_format( date_create( $date ), 'l, F j, Y' );
							$date_day  = strtolower( Date('l', strtotime( $date ) ) );
							$day_link  = nabshow_lv_get_day_page_link( $date_day );

							if ( ! empty( $day_link ) ) {
							    $day_link = site_url() . $day_link;
							    $date = '<a href="'. $day_link .'">'. $date . '</a>';
                            }
						}
						if ( ! empty( $start_time ) ) {
							$start_time = str_replace( array('am','pm'), array('a.m.','p.m.'), date_format( date_create( $start_time ), 'g:i a' ) );
							$start_time = str_replace(':00', '', $start_time );
						}
						if ( ! empty( $end_time ) ) {
							$end_time = str_replace( array('am','pm'), array('a.m.','p.m.'), date_format( date_create( $end_time ), 'g:i a' ) );
							$end_time = str_replace(':00', '', $end_time );
						}

						$session_info = '';

						if ( ! empty( $display_location ) ) {
							$session_info .= $display_location . ' | ';
						}
						if ( ! empty( $date ) ) {
							$session_info .= $date . ' | ';
						}

						$session_info   .= $start_time . ' - ' . $end_time;
						$session_info   = trim( $session_info, ' | ' );
					    $element_array  = array( 'a' => array( 'href' => array(), 'target' => array() ) );
						?>
                        <div class="modal-popup-nab-inner session-popup">
                            <div class="mb50">
                                <div class="head">
                                    <div class="details">
                                        <span class="program-name"><?php echo esc_html( $session_tracks ); ?></span>
                                        <h3 class="title"><a href="<?php echo esc_url( $session_planner_url ); ?>" target="_blank"><?php echo esc_html( get_the_title() ); ?></a></h3>
                                        <strong class="company"><?php echo wp_kses( $session_info, $element_array ); ?></strong>
                                    </div>
									<?php
									if ( has_post_thumbnail() ) {
										?>
                                        <div class="feature">
                                            <img src="<?php echo esc_url( get_the_post_thumbnail_url() ); ?>" alt="session-logo">
                                        </div>
										<?php
									}
									?>
                                </div>
                                <?php nabshow_lv_get_popup_content( $query_post_id, $session_planner_url ); ?>
                            </div>
							<?php
							$speaker = get_post_meta( $query_post_id, 'speakers', true );

							if ( ! empty( $speaker ) ) {

								$speaker_ids        = explode( ',', $speaker );
								$speaker_query_args = array(
									'post_type'      => 'speakers',
									'posts_per_page' => count( $speaker_ids ),
									'post__in'       => $speaker_ids
								);

								$speaker_query = new WP_Query( $speaker_query_args );

								if ( $speaker_query->have_posts() ) {
									?>
                                    <ul class="speakers-list">
										<?php
										while ( $speaker_query->have_posts() ) {

											$speaker_query->the_post();
											$session_speaker_id = get_the_ID();

											if ( has_post_thumbnail() ) {
												$speaker_thumbnail_url = get_the_post_thumbnail_url();
											} else {
												$speaker_thumbnail_url = nabshow_lv_get_speaker_thumbnail_url();
											}

											$speaker_job_title = get_post_meta( $session_speaker_id, 'title', true );
											$speaker_company   = get_the_terms( $session_speaker_id, 'speaker-companies' );
											$speaker_company   = nabshow_lv_get_pipe_separated_term_list( $speaker_company );
											?>
                                            <li>
                                                <div class="media-sec">
                                                    <img src="<?php echo esc_url( $speaker_thumbnail_url ); ?>" alt="speaker-logo"/>
                                                </div>
                                                <div class="details">
                                                    <h4 class="title"><a href="#" class="modal-detail-list-modal-popup" data-postid="<?php echo esc_attr( $session_speaker_id ); ?>" data-posttype="speakers"><?php echo esc_html( get_the_title() ); ?></a></h4>
                                                    <span class="sub-title"><?php echo esc_html( $speaker_job_title ); ?></span>
                                                    <span class="company"><?php echo esc_html( $speaker_company ); ?></span>
                                                </div>
                                            </li>
											<?php
										}
										?>
                                    </ul>
									<?php
								}
								wp_reset_postdata();
							}

							$sponsors = get_post_meta( $current_id, 'sponsors', true );
							if ( ! empty( $sponsors ) ) {

								$sponsors_query = get_transient( 'mysgb-get-popup-sponsors-partners-post-cache-' . $sponsors );

								if ( false === $sponsors_query ) {

								    $sponsors_ids        = explode( ',', $sponsors );
									$sponsors_query_args = array(
										'post_type'      => 'sponsors',
										'posts_per_page' => count( $sponsors_ids ),
										'post__in'       => $sponsors_ids,
										'meta_key'       => '_thumbnail_id',
									);

									$sponsors_query = new WP_Query( $sponsors_query_args );

									set_transient( 'mysgb-get-popup-sponsors-partners-post-cache-' . $sponsors, $sponsors_query, 20 * MINUTE_IN_SECONDS + wp_rand( 1, 60 ) );
                                }


								if ( $sponsors_query->have_posts() ) {
									?>
                                    <h3 class="section-title">Partners and Sponsors</h3>
                                    <ul class="partners-list">
										<?php
										while ( $sponsors_query->have_posts() ) {

										    $sponsors_query->the_post();
                                            ?>
                                                <li>
                                                    <img src="<?php echo esc_url( get_the_post_thumbnail_url() ); ?>" alt="sponsor"/>
                                                </li>
                                            <?php
										}
										?>
                                    </ul>
									<?php
								}
								wp_reset_postdata();
							}
							?>
                            <div class="popup-bottom">
                                <div class="view-btn">
                                    <a href="<?php echo esc_url( $session_planner_url ); ?>" target="_blank">View In Planner</a>
                                </div>
                                <div class="close-btn modal-footer" data-dismiss="modal">
                                    <a href="javascript:void(0);" class="btn btn-default">Close Window</a>
                                </div>
                            </div>
                        </div>
						<?php
					} elseif ( "exhibitors" === $current_type ) {

						$booths_halls   = get_post_meta( $query_post_id, 'booths_halls', true );
						$exh_id         = get_post_meta( $query_post_id, 'exhid', true );
						$exh_url        = 'https://' . $show_code . '.mapyourshow.com/8_0/exhibitor/exhibitor-details.cfm?exhid=' . $exh_id;
						$hall_link      = 'https://' . $show_code . '.mapyourshow.com/8_0/floorplan/';
						?>

                        <ul class="modal-popup-nab-inner session-popup">
                            <div class="mb50">
                                <div class="head">
                                    <div class="details">
                                        <h3 class="title"><a href="<?php echo esc_url( $exh_url ); ?>" target="_blank"><?php echo esc_html( get_the_title() ); ?></a></h3>
                                        <?php
                                        if ( ! empty( $booths_halls ) ) {

	                                        $all_booths_halls = explode( '#', $booths_halls );

	                                        if ( is_array( $all_booths_halls ) ) {

		                                        $hall_param_map = array(
			                                        'North Hall & Central Lobby' => '/explore/campus/north-hall-and-central-lobby/',
			                                        'Central Hall' => '/explore/campus/central-hall/',
			                                        'South Hall (Upper)' => '/explore/campus/south-hall-upper/',
			                                        'South Hall (Lower)' => '/explore/campus/south-hall-lower/',
			                                        'Outdoor/Mobile Media' => '/explore/campus/outdoor-mobile-media/',
			                                        'Silver Lot' => '/explore/campus/silver-lot/',
			                                        'North Hall Meeting Rooms' => '/explore/campus/north-hall-meeting-rooms/',
			                                        'South Hall Meeting Rooms' => '/explore/campus/south-hall-meeting-rooms/',
			                                        'Westgate' => '/explore/campus/westgate/',
			                                        'Encore' => '/explore/campus/encore/',
			                                        'wynn' => '/explore/campus/wynn/',
			                                        'Renaissance Hospitality Suites' => '/explore/campus/renaissance/',
			                                        'West Hall' => '/explore/campus/west-hall/',
			                                        'Other' => '/explore/campus/other/'
		                                        );

		                                        $site_url = get_site_url();

		                                        foreach ( $all_booths_halls as $booth_hall ) {

			                                        $single_booth_hall  = explode( '@', $booth_hall );
			                                        $exhibitor_info     = '';

			                                        if ( isset( $single_booth_hall[1] ) ) {

			                                        	$current_hall   = $single_booth_hall[1];
				                                        $hall_url       = isset( $hall_param_map[ $current_hall ] ) ? $hall_param_map[ $current_hall ] : '';

				                                        if ( ! empty( $hall_url ) ) {

				                                        	$hall_url   = $site_url . $hall_url;
					                                        $exhibitor_info = '<a href="' . $hall_url .'">'. $single_booth_hall[1] . '</a>';

				                                        } else {
					                                        $exhibitor_info = $single_booth_hall[1];
				                                        }
			                                        }

			                                        $exhibitor_info     .= isset( $single_booth_hall[0] ) ?  ' | ' . $single_booth_hall[0] : '';
			                                        $exhibitor_info     = trim( $exhibitor_info, ' | ' );
			                                        $element_array      = array( 'a' => array( 'href' => array(), 'target' => array() ) );
                                                ?>
                                                    <strong class="company blue-color"> <?php echo wp_kses( $exhibitor_info, $element_array ); ?></strong>
                                                <?php
		                                        }
	                                        }
                                        }
                                        ?>
                                    </div>
                                    <?php
                                    if ( has_post_thumbnail() ) {
                                    ?>
                                        <div class="feature">
                                            <img src="<?php echo esc_url( get_the_post_thumbnail_url() ); ?>" alt="exhibitor-logo">
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <?php nabshow_lv_get_popup_content( $query_post_id, $exh_url ); ?>
                            </div>
                            <?php

                            $all_terms      = get_the_terms( $query_post_id, 'exhibitor-keywords' );
                            $all_pavilions  = get_the_terms( $query_post_id, 'pavilions' );
                            $site_url       = get_site_url();

                            if ( ( is_array( $all_terms ) && ! is_wp_error( $all_terms ) ) ||  ( is_array( $all_pavilions ) && ! is_wp_error( $all_pavilions ) ) ) {
                            ?>
                                <ul class="tag-list">
                                <?php
                                    if ( is_array( $all_terms ) && ! is_wp_error( $all_terms ) ) {

                                    	foreach ( $all_terms as $current_term ) {

                                    		if ( 'featured' !== $current_term->slug ) {

                                    			$term_tag_link = $site_url . '/explore/exhibits/browse-exhibitors/?exhibitor-key=' . $current_term->slug;
			                                    ?>
			                                    <li>
				                                    <a href="<?php echo esc_url( $term_tag_link ); ?>"><?php echo esc_html( $current_term->name ); ?></a>
			                                    </li>
			                                    <?php
		                                    }
	                                    }
                                    }

                                    if ( is_array( $all_pavilions ) && ! is_wp_error( $all_pavilions ) ) {

	                                    foreach ( $all_pavilions as $pavilion ) {

	                                    	$pavilion_tag_link = $site_url . '/explore/exhibits/browse-exhibitors/?exhibitor-pav=' . $pavilion->slug;
		                                    ?>
		                                    <li>
			                                    <a href="<?php echo esc_url( $pavilion_tag_link ); ?>"><?php echo esc_html( $pavilion->name ); ?></a>
		                                    </li>
		                                    <?php
	                                    }
                                    }
                                ?>
                                </ul>
                            <?php
                            }

							$categories = get_the_terms( $current_id, 'exhibitor-categories' );

							if ( $categories && ! is_wp_error( $categories ) ) {
								?>
                                <ul class="featured-post">
									<?php
									foreach ( $categories as $category ) {

										$image_id  = get_term_meta( $category->term_id, 'exhibitor-image-id', true );
										$image_url = '';

										if ( ! empty( $image_id ) ) {
											$image_url = wp_get_attachment_url( $image_id );
										}
										?>
                                        <li>
											<?php
											if ( $image_url && ! empty( $image_url ) ) {
												?>
                                                <img src="<?php echo esc_url( $image_url ); ?>" alt="exhibitor-category">
												<?php
											} else {
												echo esc_html( $category->name );
											}
											?>
                                        </li>
										<?php
									}
									?>
                                </ul>
								<?php
							}
							?>
                            <div class="popup-bottom">
                                <div class="view-btn">
                                    <a href="<?php echo esc_url( $exh_url ); ?>" target="_blank">View In Planner</a>
                                </div>
                                <div class="close-btn">
                                    <a href="#" data-dismiss="modal">Close Window</a>
                                </div>
                            </div>
                        </div>
						<?php
					}
				}
				?>
            </div>
        </div>
        <!-- person popup -->
		<?php
	}
	wp_reset_postdata();
} elseif ( ( isset( $current_type ) && ! empty( $current_type ) ) && ( isset( $contributor_id ) && ! empty( $contributor_id ) ) ) {

	$contributor_name  = get_the_author_meta( 'first_name', $contributor_id ) . ' ' . get_the_author_meta( 'last_name', $contributor_id );
	$contributor_email = get_the_author_meta( 'user_email', $contributor_id );
	$contributor_info  = get_field( 'bio',  'user_' . $contributor_id );
	$contributor_image = nabshow_lv_get_author_avatar_url( $contributor_id );
	$allowed_tags      = wp_kses_allowed_html( 'post' );

	if ( empty( rtrim( $contributor_name ) ) ) {

		$contributor_name  = get_the_author_meta( 'display_name', $contributor_id );
	}
	?>
    <div class="modal-popup-nab">
        <div class="modal-popup-nab-body">
            <div class="close-sec">
                <i class="fa fa-times" data-dismiss="modal"></i>
            </div>
            <div class="modal-popup-nab-inner">
                <div class="mb50">
                    <div class="head">
                        <div class="details">
                            <h3 class="title"><?php echo esc_html( $contributor_name ); ?></h3>
                            <span class="sub-title">Title</span>
                            <strong class="company">Company</strong>
                        </div>
                        <div class="feature">
                            <img class="round-img" src="<?php echo esc_url( $contributor_image ); ?>" alt="contributor">
                        </div>
                    </div>
	                <?php echo wp_kses( $contributor_info, $allowed_tags ); ?>
                </div>

				<?php
				$author_args  = array(
					'author'         => $contributor_id,
					'post_type'      => $current_type,
					'posts_per_page' => 3
				);
				$author_query = new WP_Query( $author_args );
				if ( $author_query->have_posts() ) {
					?>
                    <h3 class="section-title">Thought-Gallery Posts:</h3>
                    <div class="thought-gallery">
                        <ul>
							<?php
							while ( $author_query->have_posts() ) {
								$author_query->the_post();
								?>
                                <li>
									<?php

                                    $image_url = has_post_thumbnail() ? get_the_post_thumbnail_url() : nabshow_lv_get_empty_thumbnail_url();

                                    ?>
                                    <div class="feature-img">
                                        <img src="<?php echo esc_url( $image_url ); ?>" alt="thought-gallery">
                                    </div>
                                    <div class="details">
                                        <h4>
                                            <a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo esc_html( get_the_title() ); ?></a>
                                        </h4>
                                    </div>
                                </li>
								<?php
							}
							?>
                        </ul>
                    </div>
					<?php
				}
				?>

                <div class="popup-bottom">
                    <div class="close-btn">
                        <a href="#" data-dismiss="modal">Close Window</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<?php
} else {
	wp_safe_redirect( site_url() );
	exit();
}
