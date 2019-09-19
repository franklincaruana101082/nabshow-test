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

						$speaker_title = get_post_meta( $query_post_id, 'title', true );
						$company       = get_post_meta( $query_post_id, 'company', true );
						$session_id    = get_post_meta( $query_post_id, 'sessionid', true );

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
                                        <h3 class="title"><?php echo esc_html( get_the_title() ); ?></h3>
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
                                        <span class="year">Committee Category | Term Ending Year</span>
                                        <p><a href="#">Email</a> | Phone</p>
                                    </div>
                                    <div class="feature">
                                        <img class="round-img" src="<?php echo esc_url( $speaker_thumbnail_url ); ?>"
                                             alt="speaker">
                                    </div>
                                </div>
								<?php the_content(); ?>
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
											$session_types      = get_the_terms( $speaker_session_id, 'session-types' );
											$sub_title          = nabshow_lv_get_comma_separated_term_list( $session_types );
											$date               = get_post_meta( $speaker_session_id, 'date', true );
											$start_time         = get_post_meta( $speaker_session_id, 'starttime', true );
											$end_time           = get_post_meta( $speaker_session_id, 'endtime', true );
											$date               = date_format( date_create( $date ), 'M d' );
											$start_time         = str_replace( array( 'am', 'pm' ), array( 'a.m.', 'p.m.' ), date_format( date_create( $start_time ), 'g:i a' ) );
											$end_time           = str_replace( array( 'am', 'pm' ), array( 'a.m.', 'p.m.' ), date_format( date_create( $end_time ), 'g:i a' ) );
											$session_schedule   = $date . ' | ' . $start_time . ' - ' . $end_time;
											?>
                                            <li class="item">
                                                <div class="inner">
                                                    <h4 class="title"><?php echo esc_html( get_the_title() ); ?></h4>
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
                                    <a href="#">View In Planner</a>
                                </div>
                                <div class="close-btn">
                                    <a href="#" data-dismiss="modal">Close Window</a>
                                </div>
                            </div>
                        </div>
						<?php
					} elseif ( "sessions" === $current_type ) {

						$all_location = get_the_terms( $query_post_id, 'session-locations' );
                        $location     = nabshow_lv_get_comma_separated_term_list( $all_location );

						$date         = get_post_meta( $query_post_id, 'date', true );
						$start_time   = get_post_meta( $query_post_id, 'starttime', true );
						$end_time     = get_post_meta( $query_post_id, 'endtime', true );
						$date         = date_format( date_create( $date ), 'M d' );
						$start_time   = str_replace( array( 'am', 'pm' ), array( 'a.m.', 'p.m.' ), date_format( date_create( $start_time ), 'g:i a' ) );
						$end_time     = str_replace( array( 'am', 'pm' ), array( 'a.m.', 'p.m.' ), date_format( date_create( $end_time ), 'g:i a' ) );
						$session_info = '';

						if ( ! empty( $location ) ) {
							$session_info .= $location . ' | ';
						}
						if ( ! empty( $date ) ) {
							$session_info .= $date . ' | ';
						}

						$session_info .= $start_time . ' - ' . $end_time;
						$session_info = trim( $session_info, ' | ' );
						?>
                        <div class="modal-popup-nab-inner session-popup">
                            <div class="mb50">
                                <div class="head">
                                    <div class="details">
                                        <span class="program-name">Program Name</span>
                                        <h3 class="title"><?php echo esc_html( get_the_title() ); ?></h3>
                                        <strong class="company"><?php echo esc_html( $session_info ); ?></strong>
                                        <strong>Open to Registration Package | Session Length | Cost</strong>
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
								<?php the_content(); ?>
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
											$speaker_company   = get_post_meta( $session_speaker_id, 'company', true );
											?>
                                            <li>
                                                <div class="media-sec">
                                                    <img src="<?php echo esc_url( $speaker_thumbnail_url ); ?>" alt="speaker-logo"/>
                                                </div>
                                                <div class="details">
                                                    <h4 class="title"><?php echo esc_html( get_the_title() ); ?></h4>
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

								$sponsors_ids        = explode( ',', $sponsors );
								$sponsors_query_args = array(
									'post_type'      => 'sponsors',
									'posts_per_page' => count( $sponsors_ids ),
									'post__in'       => $sponsors_ids
								);

								$sponsors_query = new WP_Query( $sponsors_query_args );

								if ( $sponsors_query->have_posts() ) {
									?>
                                    <h3 class="section-title">Partners and Sponsors</h3>
                                    <ul class="partners-list">
										<?php
										while ( $sponsors_query->have_posts() ) {
											$sponsors_query->the_post();

											if ( has_post_thumbnail() ) {
                                            ?>
                                                <li>
                                                    <img src="<?php echo esc_url( get_the_post_thumbnail_url() ); ?>" alt="sponsor"/>
                                                </li>
                                            <?php
											}
										}
										?>
                                    </ul>
									<?php
								}
								wp_reset_postdata();
							}
							?>
                            <ul class="tag-list">
                                <li><a href="#">Tag</a></li>
                                <li><a href="#">Tag</a></li>
                                <li><a href="#">Tag</a></li>
                                <li><a href="#">Tag</a></li>
                            </ul>
                            <div class="popup-bottom">
                                <div class="view-btn">
                                    <a href="#">View In Planner</a>
                                </div>
                                <div class="close-btn modal-footer" data-dismiss="modal">
                                    <a href="javascript:void(0);" class="btn btn-default">Close Window</a>
                                </div>
                            </div>
                        </div>
						<?php
					} elseif ( "exhibitors" === $current_type ) {

						$booths_halls     = get_post_meta( $query_post_id, 'booths_halls', true );
						$exh_id           = get_post_meta( $query_post_id, 'exhid', true );
						$exh_url          = 'https://ces20.mapyourshow.com/8_0/exhibitor/exhibitor-details.cfm?exhid=' . $exh_id;
						$company_info     = array();

						if ( ! empty( $booths_halls ) ) {

						    $all_booths_halls = explode( '#', $booths_halls );

							if ( is_array( $all_booths_halls ) ) {

							    $cnt = 0;

							    foreach ( $all_booths_halls as $booth_hall ) {

								    $single_booth_hall  = explode( '@', $booth_hall );
                                    $exhibitor_info     = isset( $single_booth_hall[1] ) ?  $single_booth_hall[1] : '';
									$exhibitor_info     .= isset( $single_booth_hall[0] ) ?  ' | ' . $single_booth_hall[0] : '';
									$exhibitor_info     .= ' | Pavilion';
									$company_info[$cnt] = trim( $exhibitor_info, ' | ' );
									$cnt++;
								}
							}
                        }

						?>

                        <div class="modal-popup-nab-inner session-popup">
                            <div class="mb50">
                                <div class="head">
                                    <div class="details">
                                        <h3 class="title"><?php echo esc_html( get_the_title() ); ?></h3>
                                        <?php
                                        if ( count( $company_info ) > 0 ) {
                                            foreach ( $company_info as $info ) {
                                            ?>
                                                <strong class="company blue-color"><?php echo esc_html( $info ); ?></strong>
                                            <?php
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
								<?php the_content(); ?>
                            </div>
                            <ul class="tag-list">
                                <li><a href="#">Tag1</a></li>
                                <li><a href="#">Tag2</a></li>
                                <li><a href="#">Tag3</a></li>
                            </ul>
							<?php

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

	$contributor_name  = get_the_author_meta( 'display_name', $contributor_id );
	$contributor_email = get_the_author_meta( 'user_email', $contributor_id );
	$contributor_info  = get_the_author_meta( 'user_description', $contributor_id );
	$contributor_image = get_avatar_url( $contributor_id, array( 'size' => 160 ) );
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
                            <span class="sub-title">Title/Category</span>
                            <strong class="company">Company/NAB Show LIVE/Department/Country</strong>
                            <span class="year">Committee Category | Term Ending Year</span>
                            <p><a href="mailto:<?php echo esc_attr( $contributor_email ); ?>">Email</a> | Phone</p>
                        </div>
                        <div class="feature">
                            <img class="round-img" src="<?php echo esc_url( $contributor_image ); ?>" alt="contributor">
                        </div>
                    </div>
                    <p><?php echo esc_html( $contributor_info ); ?></p>
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
									if ( has_post_thumbnail() ) {
										?>
                                        <div class="feature-img">
                                            <img src="<?php echo esc_url( get_the_post_thumbnail_url() ); ?>"
                                                 alt="thought-gallery">
                                        </div>
										<?php
									}
									?>
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

                <ul class="tag-list">
                    <li><a href="#">Tag</a></li>
                    <li><a href="#">Tag</a></li>
                    <li><a href="#">Tag</a></li>
                    <li><a href="#">Tag</a></li>
                </ul>
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