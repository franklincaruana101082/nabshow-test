<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Amplify
 */


?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="container">
	    <header class="intro">
			<?php
			the_title( '<h1 class="intro__title entry-title" data-swiftype-index="false">', '</h1>' );
			?>


			<div class="intro__reactions post-action-wrap">
				<div class="post-action-reaction">
					<?php echo do_shortcode( '[reaction_button]' ); ?>
				</div>
			</div>
	    </header><!-- .entry-header -->

	    
	</div>

	<div class="main _contentborder">
		<div class="container">
			<?php 
				$company =  get_field( 'nab_selected_company_id' );
				if ( ! empty( $company ) ) {
			?>
				<a href="<?php echo esc_url( get_the_permalink($company) ); ?>" class="event__host _company">
					<?php if(nab_amplify_get_featured_image( $company, false ) != '') { ?>
					<img src="<?php echo esc_url(nab_amplify_get_featured_image( $company, false )); ?>" class="event__host-photo"/>
					<?php } ?>
					<div class="event__host-name">Presented by<br><?php echo get_the_title($company);?></div>
				</a>
			<?php 
			}
			?>
			<div class="content">
			<?php
				the_field('description');
			
				$using_optin = (get_field('show_opt_inout_modal') ? "1" : "0");
				if($using_optin) {
					$optin_complete = '0';
				} else {
					//set as complete if we're not using an opt in
					//for setting up functionality in registration below
					$optin_complete = '1';
				}
				$content_protected = (int)get_field('make_opt_in_required');
				
				if ( ! is_user_logged_in() && $content_protected ) {
					?>
					<div class="session__notsignedin nabblock">

						<?php dynamic_sidebar('session-not-logged-in'); ?>
						
						<div class="intro__cta">
							<?php
							$referring_url = get_permalink( get_queried_object_id() );
							$sign_up_page = get_page_by_path( NAB_SIGNUP_PAGE ); // @todo later replace this with VIP function
							if ( isset( $sign_up_page ) && ! empty( $sign_up_page ) ) {
								$sign_up_page_url = get_permalink( $sign_up_page->ID );
							?>
							<a href="<?php echo( esc_url( $sign_up_page_url ) . '?r=' . $referring_url ); ?>" class="button _gradientpink"><?php esc_html_e( 'Sign Me Up', 'nab-amplify' ); ?></a>
							<?php } ?>

							
							<a class="" href="<?php echo( esc_url( wc_get_page_permalink( 'myaccount' ) ) . '?r=' . $referring_url ); ?>"><?php esc_html_e( 'Already on NAB Amplify? Sign In', 'nab-amplify' ); ?></a>
						</div> 
					</div>
					<?php
				} else {

				$show_content = true;
		
				$content_protected = (int)get_field('make_opt_in_required');
				
				$cookieName = 'nab_optin';
				if(isset($_COOKIE[$cookieName])) {
					if(stripos($_COOKIE[$cookieName], $company.':') !== false) { //check if opted in OR out
						$using_optin = '0';
						$optin_complete = '1';
					}
					if($content_protected) {
						$show_content = false;
						$optin_complete = '0';
						$using_optin = '1';
						if(stripos($_COOKIE[$cookieName], $company.':1') !== false) { //check if already opted IN
							$show_content = true;
							$optin_complete = '1';
							$using_optin = '0';
						}
					}
				} elseif ($content_protected) {
					$show_content = false;
				}
			
				if($show_content) {
					$download = get_field('pdf_file');
					if($download):
						$download_url = wp_get_attachment_url($download);
						$download_title = substr($download_url, strrpos($download_url, '/')+1, -4);
						$download_type = substr($download_url, strrpos($download_url, '.')+1);
					endif;
					if (get_field('show_opt_inout_modal')) {
				?>
					<div style="display: none;"><div class="optout__info js-optin_content nabblock"></div></div>
				<?php } ?>
					<div class="whitepaper__download nabblock">
						<?php if( get_the_post_thumbnail_url() ): ?>
						<div class="whitepaper__image">
							<?php the_post_thumbnail('full', array('class' => 'whitepaper__img')); ?>
						</div>
						<?php endif; ?>
						<div class="whitepaper__info">
							<h3><?php echo esc_html($download_title); ?></h3>
							<a class="whitepaper__link button _gradientpink" target="_blank" href="<?php echo esc_attr($download_url); ?>" title="<?php echo esc_attr($download_title); ?>">
						        Download <span class="whitepaper__ext"><?php echo esc_html($download_type); ?></span>
						    </a>
						</div>
					</div>
				<?php
				} else {

					
					?><div style="display: none;"><div class="optout__info js-optin_content nabblock"></div></div><?php
				}

				if (get_field('show_opt_inout_modal')) {
					//we need these defined here because they may change depending on the template we're adding this to
					$company_id = $company;
					$company_name = get_the_title( $company );
					$company_url = get_field('contact_preferences_url', $company);
					$opt_in_required = (int)get_field('make_opt_in_required');
					$registration_required = false;
					$registered = true;
					$displayInline = true;
					$user_id				= get_current_user_id();
					$user					= get_user_by( 'id', $user_id );
					$user_email				= $user->user_email;
					$user_firstname			= get_user_meta( $user_id, "first_name", true);
					$user_lastname			= get_user_meta( $user_id, "last_name", true);
					$user_city 		        = get_user_meta( $user_id, "user_city", true);
					$user_state 		    = get_user_meta( $user_id, "user_state", true);
					$user_country_code		= get_user_meta( $user_id, "user_country", true);
					$user_company			= get_user_meta( $user_id, "attendee_company", true);
					$user_title				= get_user_meta( $user_id, "attendee_title", true);
					$user_ip 				= $_SERVER['REMOTE_ADDR'];
					$occurred_at_type		= 'downloadable-pdf';
					//use this instead of get_template_part so the partial can access the above php vars from here
					include ( locate_template( 'template-parts/modal-opt-in.php', false, false ) );
				}
				?>
				
				
				
			</div>
		<?php } ?>
		</div>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php nab_amplify_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
