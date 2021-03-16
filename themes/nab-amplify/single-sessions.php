<?php
/**
 * The template for displaying all single sessions
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Amplify
 */

get_header();

if (isset($_GET['registered']) && $_GET['registered'] == 'true') {
	$preregistered = true;
} else {
	$preregistered = false;
}

?>

	<main id="primary" class="site-main single_php">
		
		<?php
		while ( have_posts() ) :
			the_post();

			$session_start = get_field( 'session_date' );
			$session_end   = get_field( 'session_end_time' );

			$start_m       = gmdate('A', strtotime($session_start));
			$end_m         = gmdate('A', strtotime($session_end));
			if($start_m !== $end_m) {
				$time_start    = str_replace(array(':00', 'am', 'pm'), array('', 'a.m.', 'p.m.'), gmdate('g:i a', strtotime($session_start)));
			} else {
				$time_start    = str_replace(':00', '', gmdate('g:i', strtotime($session_start)));	
			}

			$date_start    = gmdate('F j, Y', strtotime($session_start));
			$time_end      = str_replace(array(':00', 'am', 'pm'), array('', 'a.m.', 'p.m.'), gmdate('g:i a', strtotime($session_end)));

			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="intro">
					<div class="container">
					<?php
						the_title( '<h1 class="intro__title">', '</h1>' );
					?>
					<div class="intro__time introtext">
								<p>
									<?php echo esc_html($date_start); ?><br />
									<?php echo esc_html($time_start); ?> - <?php echo esc_html($time_end); ?> ET
								</p>
							</div>
							<?php
								$company =  get_field( 'company' );
								$speakers = get_field( 'speakers' );
								if (! empty( $speakers) || ! empty($company)) {
								?>
								<div class="event__hosts">
								<?php
								// list company host
								if ( ! empty( $company ) ) {
								?>
									<a href="<?php echo esc_url( get_the_permalink($company) ); ?>" class="event__host _company">
										<?php 
											echo get_the_post_thumbnail( $company, array(100, 100), array('class' => 'event__host-photo') );
										?>
										<div class="event__host-name">Hosted by<br><?php echo get_the_title($company);?></div>
									</a>
								<?php 
								}
								
								// list session speaker
								if ( ! empty( $speakers ) && is_array( $speakers ) && count( $speakers ) > 0 ) {
									// loop throught the speakers.
									foreach ( $speakers as $speaker_id ) {
										
										$first_name         = get_field( 'first_name', $speaker_id );
										$last_name          = get_field( 'last_name', $speaker_id );
										$title              = get_field( 'title', $speaker_id );
										$speaker_company    = get_field( 'company', $speaker_id );
										$headshot           = get_field( 'headshot', $speaker_id );
										$amplify_user       = get_field( 'amplify_user', $speaker_id );
										$user_profile_url   = '';
										
										if ( ! empty( $amplify_user ) ) {
											$user_profile_url = bp_core_get_user_domain( $amplify_user );
										}
										?>
										<div class="author event__host">
											<?php
											if ( ! empty( $headshot ) ) {
												
												?>
												<div class="author__photo event__host-photo-wrap">
													<?php
													if ( ! empty( $user_profile_url ) ) {
														?>
														<a href="<?php echo esc_url( $user_profile_url ); ?>">
															<img class="event__host-photo" src="<?php echo esc_url( $headshot['url'] ); ?>" alt="<?php echo esc_attr( $headshot['alt'] ); ?>" />
														</a>
														<?php
													} else {
														?>
														<img class="event__host-photo" src="<?php echo esc_url( $headshot['url'] ); ?>" alt="<?php echo esc_attr( $headshot['alt'] ); ?>" />
														<?php
													}
													?>
												</div>
												<?php
											}
											?>
											<div class="event__host-info">
												<h3 class="event__host-name">
													<?php
													if ( ! empty( $user_profile_url ) ) {
														?>
														<a href="<?php echo esc_url( $user_profile_url ); ?>"><?php echo esc_html( $first_name . ' ' . $last_name ); ?></a>
														<?php
													} else {
														echo esc_html( $first_name . ' ' . $last_name );
													}
													?>
												</h3>
												<span class="event__host-company"><?php echo esc_html( $speaker_company ); ?></span>
												<span class="event__host-title"><?php echo esc_html( $title ); ?></span>
											</div>
										</div>
										<?php
									}
								}
								?>
								</div>
							<?php } ?>
					</div><!-- .container -->
				</header><!-- .intro -->

				<div class="session__content">
					
					<?php

					if ( is_user_logged_in() ) {
					
					$session_status				= get_field( 'session_status' );
					$pre_event_registration_id	= get_field( 'pre_event_registration_id' );
					$pre_event_survey_id		= get_field( 'pre_event_survey_id' );
					$live_event_survey_id		= get_field( 'live_event_survey_id' );
					$post_event_survey_id		= get_field( 'post_event_survey_id' );
					$chat_room_id				= get_field( 'chat_room_id' );
					$video_embed				= get_field( 'video_embed' );

					$company_name				= get_the_title( $company );

					$terms						= get_the_terms( $post->ID, 'session_categories');
					$categories					= '';
					if ( $terms && ! is_wp_error( $terms ) ) : 
						$ti = 0;
						$tl = count($terms);
						foreach( $terms as $term ) {
							$categories .= $term->term_id;
							if($ti != $tl - 1) {
								$categories .= ",";
							}
							++$ti;
						}
					endif;

					//user should be logged in already
					$user_id				= get_current_user_id();
					$user					= get_user_by( 'id', $user_id );
					$user_email				= $user->user_email;
					$user_firstname			= get_user_meta( $user_id, "first_name", true);
					$user_lastname			= get_user_meta( $user_id, "last_name", true);

					if($session_status == "pre-event") {
					?>
						<div class="session__pre">
							<div class="intro-feature">
							<div class="intro-feature__media">
							<div class="container">
								<?php if($preregistered) { ?>
								<div
									class="involveme_embed"
									data-embed="<?php echo esc_html($pre_event_survey_id);?>"
									data-params="remote_id=<?php echo esc_html($user_id); ?>&email=<?php echo esc_html($user_email); ?>&first_name=<?php echo esc_html($user_firstname); ?>&last_name=<?php echo esc_html($user_lastname); ?>&session_id=<?php the_ID(); ?>&session_name=<?php the_title();?>&company_id=<?php echo esc_html($company);?>&company_name=<?php echo esc_html($company_name);?>&survey_type=survey&session_category=<?php echo esc_html($categories);?>"
								></div>
								<?php } else { ?>
									<div
									class="involveme_embed"
									data-embed="<?php echo esc_html($pre_event_registration_id);?>"
									data-params="remote_id=<?php echo esc_html($user_id); ?>&email=<?php echo esc_html($user_email); ?>&first_name=<?php echo esc_html($user_firstname); ?>&last_name=<?php echo esc_html($user_lastname); ?>&session_id=<?php the_ID(); ?>&session_name=<?php the_title();?>&company_id=<?php echo esc_html($company);?>&company_name=<?php echo esc_html($company_name);?>&survey_type=registration&session_category=<?php echo esc_html($categories);?>"
								></div>
								<?php } ?>
								<script src="https://app.involve.me/embed"></script>
							</div>
							</div>
							</div>
						</div>
					<?php } elseif($session_status == "live") { ?>
						<div class="session__live">
							<div class="intro-feature">
							<div class="intro-feature__media">
							<div class="container">
								<div class="embed-group _video_and_chat">
									<div class="embed-group__item _video">
										<div class="embed-wrapper _video">
											<?php echo $video_embed; ?>
										</div>
									</div>
									<div class="embed-wrapper _chat">
										<?php 
										if ( 'production' === VIP_GO_APP_ENVIRONMENT ) {
											// This code only runs on production, perhaps 
											// configuration for a live service
											$cometchat_shortcode = "[cometchat-pro default-id='" .$chat_room_id. "' default-type='group' widget-id='8865f1e8-c69e-42f0-ba2d-e4cfe85dfb50' widget-height='551px' widget-width='100%' widget-docked='false' widget-version='v2' rounded-corners='false']";
										} else {
											// This code runs everywhere except production
											$cometchat_shortcode = "[cometchat-pro default-id='" .$chat_room_id. "' default-type='group' widget-id='b1d623a8-693c-4b68-81ee-73afd1e4d43a' widget-height='551px' widget-width='100%' widget-docked='false' widget-version='v2' rounded-corners='false']";
										}
										echo do_shortcode($cometchat_shortcode); 
										?>
									</div>
								</div>

								<div 
								class="involveme_embed"
								data-embed="<?php echo esc_html( $live_event_survey_id ); ?>"
								data-params="remote_id=<?php echo esc_html($user_id); ?>&email=<?php echo esc_html($user_email); ?>&first_name=<?php echo esc_html($user_firstname); ?>&last_name=<?php echo esc_html($user_lastname); ?>&session_id=<?php the_ID(); ?>&session_name=<?php the_title();?>&company_id=<?php echo esc_html($company);?>&company_name=<?php echo esc_html($company_name);?>&survey_type=survey&session_category=<?php echo esc_html($categories);?>"></div>
								<script src="https://app.involve.me/embed"></script>
							</div>
							</div>
							</div>
						</div>
					<?php } elseif($session_status == "post-event") { ?>
						<div class="session__post">
							<div class="intro-feature">
							<div class="intro-feature__media">
							<div class="container">
								<div class="embed-group _post">
									<?php echo $video_embed; ?>
								</div>
								<div class="involveme_embed"
									data-embed="<?php echo esc_html( $post_event_survey_id ); ?>"
									data-params="remote_id=<?php echo esc_html($user_id); ?>&email=<?php echo esc_html($user_email); ?>&first_name=<?php echo esc_html($user_firstname); ?>&last_name=<?php echo esc_html($user_lastname); ?>&session_id=<?php the_ID(); ?>&session_name=<?php the_title();?>&company_id=<?php echo esc_html($company);?>&company_name=<?php echo esc_html($company_name);?>&survey_type=survey&session_category=<?php echo esc_html($categories);?>"></div>
								<script src="https://app.involve.me/embed"></script>
							</div>
							</div>
							</div>
						</div>
					<?php } //end session status if statement ?>
					
					<div class="session__desc">
						<div class="container">
							<div class="contentwrap">
							<?php
							the_content(
								sprintf(
									wp_kses(
										/* translators: %s: Name of current post. Only visible to screen readers */
										__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'nab-amplify' ),
										array(
											'span' => array(
												'class' => array(),
											),
										)
									),
									wp_kses_post( get_the_title() )
								)
							);

							wp_link_pages(
								array(
									'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'nab-amplify' ),
									'after'  => '</div>',
								)
							);
							
							if($session_status == 'pre-event') {
							?>
								<div class="session__prevideo">
									<div class="embed-wrapper _video">
										<?php echo $video_embed; ?>
									</div>
								</div>	
							<?php } ?>
							</div>
						</div>
					</div>

					<?php
					$related = get_field( 'related_sessions' );
					if ( ! empty( $related ) && is_array( $related ) && count( $related ) > 0 ) {
					?>
					<div class="container">
					<div class="nabcard">
						<div class="nabcard__content">
							<div class="related _events">
								<h2 class="related__title">Related Sessions</h2>
								<ul class="related__list _full">
									<?php foreach ($related as $event_id) {
										$session_start	= get_field( 'session_date', $event_id );
										$session_end	= get_field( 'session_end_time', $event_id );
										$month			= gmdate('F', strtotime($session_start));
										$day			= gmdate('d', strtotime($session_start));
										$time_start		= gmdate('g:i', strtotime($session_start));
										$time_end		= gmdate('g:i A', strtotime($session_end));
										$company		= get_field( 'company', $event_id );
									?>
									<li class="related__item">
										<a href="<?php echo esc_url( get_the_permalink($event_id) ); ?>" class="event">
											<div class="event__date">
												<div class="event__month"><?php echo esc_html($month); ?></div>
												<div class="event__day text-gradient _blue"><?php echo esc_html($day); ?></div>
											</div>
											<div class="event__photo">
												<div class="event__link link _plus">Learn More</div>
												<!-- <img class="event__image" src="square-image" /> -->
											</div>
											<div class="event__info">
												<h4 class="event__title"><?php echo esc_html( get_the_title($event_id) ); ?></h4>
												<div class="event__time"><?php echo esc_html($time_start); ?> - <?php echo esc_html($time_end); ?> ET</div>
												<?php
													if ( ! empty( $company ) ) {
													?>
													<div class="event__host _company" data-company="<?php echo $company ?>">
														<?php 
															echo get_the_post_thumbnail( $company, array(100, 100), array('class' => 'event__host-photo', 'style' => 'width: auto; height: auto;') );
														?>
														<div class="event__host-name">Hosted by <?php echo get_the_title($company);?></div>
													</div>
												<?php
												}
												?>
											</div>
											<div class="event__link link _plus">Learn More</div>
										</a>
									</li>
									<?php } //end foreach ?>
								</ul>
							</div>
						</div>
					</div>
					</div>
					<?php } //end related if ?>

					<?php 
					} else { //if user NOT logged in
					 ?>
					<div class="container">
						<div class="session__notsignedin nabblock">

							<?php dynamic_sidebar('session-not-logged-in'); ?>
							
							<div class="intro__cta">
								<?php
								$sign_up_page = get_page_by_path( NAB_SIGNUP_PAGE ); // @todo later replace this with VIP function
								if ( isset( $sign_up_page ) && ! empty( $sign_up_page ) ) {
									$sign_up_page_url = get_permalink( $sign_up_page->ID );
								?>
								<a href="<?php echo esc_url( $sign_up_page_url ); ?>" class="button _gradientpink"><?php esc_html_e( 'Sign Me Up', 'nab-amplify' ); ?></a>
								<?php } ?>

								
								<a class="" href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>"><?php esc_html_e( 'Already on NAB Amplify? Sign In', 'nab-amplify' ); ?></a>
							</div> 
						</div>
					</div>
					<?php } ?>

				</div><!-- .entry-content -->
			</article><!-- #post-<?php the_ID(); ?> -->
			<?php		

		endwhile; // End of the loop.
		?>        
	</main><!-- #main -->
<?php
get_footer();
