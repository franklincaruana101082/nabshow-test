<?php
/**
 * The template for displaying all single sessions
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Amplify
 */

get_header();
?>

	<main id="primary" class="site-main single_php">
		
		<?php
		while ( have_posts() ) :
			the_post();

			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="intro">
					<div class="container">
					<?php
					the_title( '<h1 class="intro__title">', '</h1>' );
					?>
					
					<?php
						$speakers = get_field( 'speakers' );
						// list session speaker
						if ( ! empty( $speakers ) && is_array( $speakers ) && count( $speakers ) > 0 ) {
							?>
							<div class="event__hosts">
								<?php
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
								?>
							</div>
							<?php
						}
					?>
				</div><!-- .container -->
				</header><!-- .intro -->    

				<div class="entry-content">
					<div class="container">
					<?php                    
					
					$company                    = get_field( 'company' );
					$session_status             = get_field( 'session_status' );
					$pre_event_registration_id  = get_field( 'pre_event_registration_id' );
					$pre_event_survey_id        = get_field( 'pre_event_survey_id' );
					$live_event_survey_id       = get_field( 'live_event_survey_id' );
					$post_event_survey_id       = get_field( 'post_event_survey_id' );
					$chat_room_id               = get_field( 'chat_room_id' );
					$video_embed                = get_field( 'video_embed' );

					$company_id 								= $company->post_id;
					$company_name								= $company->post_title;

					if ( is_user_logged_in() ) {
						$user											= get_current_user();
						$user_id									= get_current_user_id();
						$user_email								= $user->user_email;
						$user_firstname						= get_user_meta( $user_id, "first_name", true);
						$user_lastname						= get_user_meta( $user_id, "last_name", true);
					}else {
						$user_id									= 0;
						$user_email								= "";
						$user_firstname						= "";
						$user_lastname						= "";
					}

					if($session_status == "pre-event") {
					?>
						<div class="pre-event">
							
							<div
								class="involveme_embed"
								data-embed="<?php=$pre_event_registration_id;?>"
								data-params="
								remote_id=<?php echo esc_html($user_id); ?>
								&email=<?php echo esc_html($user_email); ?>
								&first_name=<?php echo esc_html($user_firstname); ?>
								&last_name=<?php echo esc_html($user_lastname); ?>
								&session_id=<?php the_ID(); ?>
								&session_name=<?php the_title();?>
								&company_id=<?php echo esc_html($company_id);?>
								&company_name=<?php echo esc_html($company_name);?>
								"
							></div>
							<script src="https://app.involve.me/embed"></script>
							
						</div>
					<?php } elseif($session_status == "live") { ?>
						<div class="live-event">
							<div class="embed-group _video_and_chat">
								<div class="embed-group__item _video">
									<div class="embed-wrapper _video">
										<?php echo $video_embed; ?>
									</div>
								</div>
								<div class="embed-wrapper _chat">
									[cometchat-pro widget-id='<?php echo esc_html($chat_room_id);?>' widget-version='v2']
								</div>
								</div>

								<div 
								class="involveme_embed"
								data-embed="<?php echo esc_html( $live_event_survey_id ); ?>"
								data-params="
									remote_id=<?php echo esc_html($user_id); ?>
									&email=<?php echo esc_html($user_email); ?>
									&first_name=<?php echo esc_html($user_firstname); ?>
									&last_name=<?php echo esc_html($user_lastname); ?>
									&session_id=<?php the_ID(); ?>
									&session_name=<?php the_title();?>
									&company_id=<?php echo esc_html($company_id);?>
									&company_name=<?php echo esc_html($company_name);?>
									"></div>
								<script src="https://app.involve.me/embed"></script>
						</div>
					<?php } elseif($session_status == "post_event") { ?>
						<div class="post-event">
							<div class="involveme_embed"
								data-embed="<?php echo esc_html( $post_event_survey_id ); ?>"
								data-params="
									remote_id=<?php echo esc_html($user_id); ?>
									&email=<?php echo esc_html($user_email); ?>
									&first_name=<?php echo esc_html($user_firstname); ?>
									&last_name=<?php echo esc_html($user_lastname); ?>
									&session_id=<?php the_ID(); ?>
									&session_name=<?php the_title();?>
									&company_id=<?php echo esc_html($company_id);?>
									&company_name=<?php echo esc_html($company_name);?>
									"></div>
							<script src="https://app.involve.me/embed"></script>
						</div>
					<?php } ?>

					<div class="intro-feature">
						<div class="container">
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
						?>
						</div>
					</div>
					</div>
				</div><!-- .entry-content -->
			</article><!-- #post-<?php the_ID(); ?> -->
			<?php		

		endwhile; // End of the loop.
		?>        
	</main><!-- #main -->
<?php
get_footer();
