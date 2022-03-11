<?php
// $slinks_settings = array(
//	'sessions_links_title' => $block['sessions_links_title'],
//	'session_tracks'       => $block['session_tracks'],
//	'session_categories'   => $block['session_categories'],
//	'manual_sessions'      => $block['manual_sessions'],
// );


$speakers_and_sessions_heading = $slinks_settings['sessions_links_title'];

?>    
<div class="section">
	<div class="decorative _blur">
		<div class="container">
			<div class="conference-sessions">
				<h3 class="conference-sessions-title"><?php echo($speakers_and_sessions_heading); ?></h3>
			</div>
			<div class="conference-sessions-content">
				<?php 

				$session_tracks     = $slinks_settings['session_tracks'];
				$session_categories = $slinks_settings['session_categories'];
				$manual_sessions    = $slinks_settings['manual_sessions'];

				echo('<h1>POO'.$session_tracks.'</h1>');
				echo('<h1>EAT'.$session_categories.'</h1>');

				if ( ( $session_tracks && count( $session_tracks ) > 0 ) || ( $session_categories && count( $session_categories ) > 0 ) || ( $manual_sessions && count( $manual_sessions ) > 0 ) ) {
					
					$session_query_args = array(
						'post_type'      => 'sessions',
						'posts_per_page' => 100,
						'post_status'    => 'publish',
						'meta_key'       => 'starttime',
						'orderby'        => 'meta_value',
						'order'          => 'ASC',
					);

					$tax_query_args = array( 'relation' => 'AND' );

					if ( $session_tracks && count( $session_tracks ) > 0 ) {
						echo('<h1>TRACKS should not show up</h1>');
						$tax_query_args[] = array(
							'taxonomy' => 'tracks',
							'field'    => 'term_id',
							'terms'    => $session_tracks,
						);
					}

					if ( $session_categories && count( $session_categories ) > 0 ) {
						echo('<h1>CATEGORIES should not show up</h1>');
						$tax_query_args[] = array(
							'taxonomy' => 'session-categories',
							'field'    => 'term_id',
							'terms'    => $session_categories,
						);
					}

					$session_query_args['tax_query'] = $tax_query_args;

					$session_query = new WP_Query( $session_query_args );

					if ( $session_query->have_posts() || count( $manual_sessions ) > 0) {
						?>
						<div class="conference-sessions-sessions">
							<?php
							while ( $session_query->have_posts() ) :
								echo('<h1>this should not show up</h1>');
								$session_query->the_post();

								$mys_session_id         = get_the_ID();
								$session_schedule_id    = get_post_meta( $mys_session_id, 'scheduleid', true );
								$mys_session_start_date = get_post_meta( $mys_session_id, 'starttime', true );
								$mys_session_summary    = get_post_meta( $mys_session_id, 'summarysummary', true );
								$formatted_session_date = '';

								if ( ! empty( $mys_session_start_date ) ) {
									
									if ( false !== strpos( $mys_session_start_date, '-' ) ) {
										$formatted_session_date = date_format( date_create( $mys_session_start_date ), 'F j, Y g:i a' );
									} else {
										$dt                     = DateTime::createFromFormat( 'F, j Y H:i:s', $mys_session_start_date );
										$formatted_session_date = $dt->format( 'F j, Y g:i a' );
									}
								}

								$mys_session_link = 'https://nab22.mapyourshow.com/8_0/sessions/session-details.cfm?scheduleid=' . $session_schedule_id;
								?>
								<a href="<?php echo esc_url( $mys_session_link );?>" target="_blank" class="conference-sessions-session _link">
									<p class="conference-sessions-session-title"><?php echo esc_html( get_the_title() ); ?></p>
									<h6 class="datetime-small icon-calendar"><?php echo esc_html( $formatted_session_date ); ?></h6>
									<div class="conference-sessions-session-desc"><p><?php echo esc_html( $mys_session_summary ); ?></p></div>
								</a>
								<?php

							endwhile;
							foreach ( $manual_sessions as $row ) {
							?>                        
								<a href="<?php echo esc_url( $row['link']['url'] );?>" target="_blank" class="conference-sessions-session _link">
									<p class="conference-sessions-session-title"><?php echo esc_html( $row['title'] ); ?></p>
									<h6 class="datetime-small icon-calendar"><?php echo esc_html( $row['dates'] ); ?></h6>
									<div class="conference-sessions-session-desc"><p><?php echo wp_kses_post( $row['description'] ); ?></p></div>
								</a>
							<?php } ?>
						</div>
						<?php
						wp_reset_postdata();
					}
				}
				?>
			</div>        
		</div>
	</div>
</div>
<?php /*
<div class="section container">
	<?php dynamic_sidebar('broadstreet-ros-middle'); ?>
</div>*/
