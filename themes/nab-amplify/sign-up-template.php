<?php
/*
 * Template Name: Sign Up
 */

if ( is_user_logged_in() ) {
	wp_safe_redirect( wc_get_page_permalink( 'myaccount' ) );
	exit;
}

get_header();

$redirect_url = filter_input( INPUT_GET, 'r', FILTER_SANITIZE_STRING );

if ( empty( $redirect_url ) ) {

	if ( isset( $_POST[ 'checkout_redirect' ] ) && ! empty( $_POST[ 'checkout_redirect' ] ) ) {
		$redirect_url = $_POST[ 'checkout_redirect' ];
	} else {
		
		$referer_url  = $_SERVER[ 'HTTP_REFERER' ];

		if ( ! empty( $referer_url ) ) {
			
			$site_url = get_site_url();	
		
			if ( false === strpos( $referer_url , $site_url ) ) {

				$url_parse 	= wp_parse_url( $referer_url );
				$url_host	= isset( $url_parse[ 'host' ] ) && ! empty( $url_parse[ 'host' ] ) ? $url_parse[ 'host' ] : '';

				if ( preg_match( '/md-develop.com/i', $url_host ) || preg_match( '/nabshow-com-develop/i', $url_host ) || preg_match('/nabshow.com/i', $url_host ) ) {
										
					$redirect_url = wc_get_page_permalink( 'myaccount' );
					
					// setcookie( 'nab_login_redirect', $referer_url, ( time() + 3600 ), '/' );
				}
			}
		}
	}
}
if ( empty( $redirect_url ) ) {

	$redirect_url = rtrim( get_site_url(), '/' ) . '/welcome/';
}
?>

	<!-- START legacy-template: sign-up-template -->
	<div class="container">
	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="entry-content">
					<div class="woocommerce">
						<?php
						do_action( 'woocommerce_before_customer_login_form' );
						?>
						<h2><?php the_title(); ?></h2>
						<div class="nab-login-wrap">
							<div class="nab-normal-signup">
								<form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?> >

									<?php do_action( 'woocommerce_register_form_start' ); ?>

									<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
										<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="first_name" id="first_name"
										       placeholder="<?php esc_html_e( 'First Name*', 'woocommerce' ); ?>"
										       value="<?php echo ( ! empty( $_POST['first_name'] ) ) ? esc_attr( wp_unslash( $_POST['first_name'] ) ) : ''; ?>"/>
									</p>

									<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
										<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="last_name" id="last_name"
										       placeholder="<?php esc_html_e( 'Last Name*', 'woocommerce' ); ?>"
										       value="<?php echo ( ! empty( $_POST['last_name'] ) ) ? esc_attr( wp_unslash( $_POST['last_name'] ) ) : ''; ?>"/>
									</p>


									<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
										<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email"
										       placeholder="<?php esc_html_e( 'Email Address*', 'woocommerce' ); ?>"
										       value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>"/><?php // @codingStandardsIgnoreLine
										?>
									</p>

									<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
										<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password"
										       placeholder="<?php esc_html_e( 'Password*', 'woocommerce' ); ?>"
										       autocomplete="new-password"/>
									</p>

									<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
										<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password2" id="reg_password2"
										       placeholder="<?php esc_html_e( 'Confirm Password*', 'woocommerce' ); ?>"
										       autocomplete="new-password"/>
									</p>

									<div class="woocommerce-form-row woocommerce-form-row--wide form-row-wide">
										<?php
										$interest_items			= array( 'Content Creation', 'Live Event Production', 'Broadcast', 'Streaming' );
										$selected_user_interest	= filter_input( INPUT_POST, 'user_interest', FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY );
										$selected_user_interest = isset( $selected_user_interest ) && ! empty( $selected_user_interest ) ? $selected_user_interest : array();
										?>										
										<div class="nab-section section-user-interest-signup">
											<h3>I'm Interested In...</h3>
											<i class="dropdown-message">Select all that apply</i>
											<div class="user-interest-details-form">
												<div class="checkbox-item-list">
													<?php
													foreach ( $interest_items as $item ) {
														
														$current_item = '';
														
														if ( is_array( $selected_user_interest ) && in_array( $item, $selected_user_interest, true ) ) {
															$current_item = $item;
														}
														?>
														<div class="checkbox-item amp-check-container">
															<div class="amp-check-wrp">
																<input type="checkbox" name="user_interest[]" class="sign-up-user-interest" value="<?php echo esc_attr( $item ); ?>" id="<?php echo esc_attr( $item ); ?>" <?php checked( $current_item, $item ); ?> />
																<span class="amp-check"></span>
															</div>
															<label for="<?php echo esc_attr( $item ); ?>"><?php echo esc_html( $item ); ?></label>
														</div>                                                            
														<?php
													}
													?>                            
												</div>                        
											</div>
										</div>
									</div>
									<hr>

									<?php do_action( 'woocommerce_register_form' ); ?>

									<?php if ( isset( $redirect_url ) && ! empty( $redirect_url ) ) { ?>
										<input type="hidden" name="checkout_redirect" value="<?php echo $redirect_url; ?>">
									<?php } ?>

									<div class="woocommerce-form-row woocommerce-form-row--wide form-row-wide">
										<div class="amp-check-container check-align-top">
											<div class="amp-check-wrp">
												<input type="checkbox" name="press_member" class="signup-press-member" id="signup-press-member" value="1">
												<span class="amp-check"></span>
											</div>
											<label for="signup-press-member" class="tooltip-container">
												<div class="member-tooltip">
													<div class="tooltip-label">I am a qualified member of the press.</div>
													<div class="tooltip-wrap">
														<i class="fa fa-info-circle" aria-hidden="true"></i>
														<div class="tooltip">
															Qualified members of the <a href="https://nabshow.com/2021/partner/press/">press</a> should select “Press” when registering to ensure future access to Amplify’s original content, networking and engagement opportunities, and exclusive events. To qualify, all members must agree with Amplify’s <a href="<?php echo site_url(); ?>/privacy-policy/">privacy policy</a>, <a href="<?php echo site_url(); ?>/terms-of-use/">terms of use</a> and <a href="<?php echo site_url(); ?>/nab-virtual-events-code-of-conduct/">code of conduct</a>. Contact information will not be shared unless press opt-in to share information.
														</div>
													</div>
												</div>
											</label>
										</div>
									</div>

									<div class="woocommerce-form-row woocommerce-form-row--wide form-row-wide">
										<div class="amp-check-container check-align-top">
											<div class="amp-check-wrp">
												<input type="checkbox" name="privacy_policy" class="signup-privacy-policy" id="signup-privacy-policy" value="1">
												<span class="amp-check"></span>
											</div>
											<label for="signup-privacy-policy">I agree to the NAB Amplify <a href="<?php echo site_url(); ?>/privacy-policy/">privacy policy</a>, <a href="<?php echo site_url(); ?>/terms-of-use/">terms of use</a> and <a href="<?php echo site_url(); ?>/nab-virtual-events-code-of-conduct/">code of conduct</a>.</label>
										</div>
									</div>

									<p class="woocommerce-FormRow form-row">
										<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
										<button disabled type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit" name="register"
										        value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Sign Up', 'woocommerce' ); ?></button>
									</p>

									<?php do_action( 'woocommerce_register_form_end' ); ?>

								</form>
							</div>
							<span><?php esc_html_e( 'Or', 'woocommerce' ); ?></span>
							<div class="nab-social-login">
								<?php echo do_shortcode( '[miniorange_social_login apps="google,fb"]' ); ?>
							</div>
						</div>
						<div class="nab-signup-now">

							<?php if ( isset( $redirect_url ) && ! empty( $redirect_url ) ) {
								$my_account_url = add_query_arg( 'r', $redirect_url, wc_get_page_permalink( 'myaccount' ) );
							} else {
								$my_account_url = wc_get_page_permalink( 'myaccount' );
							} ?>

							<h4 class="text-transform-initial"><?php esc_html_e( 'Already have an account?' ); ?> <a
										href="<?php echo esc_url( $my_account_url ); ?>"><?php esc_html_e( 'Sign In', 'woocommerce' ); ?></a></h4>
							<br /><br />
							<p class="small">By creating this account, you are agreeing to share the information provided with any NAB Amplify exhibitor/sponsor/partner whose content you engage with. You accept that this exhibitor/sponsor/partner may contact you about their products or services under legitimate interest. If you opt out of the communications at checkout, we will disable tools that allow engagement on your account. For more information about our Privacy Policy and GDPR please see the links below.</p>

						</div>
					</div>

				</div><!-- .entry-content -->


			</article><!-- #post-<?php the_ID(); ?> -->

		<?php
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->
	</div><!-- .container -->
	<!-- END legacy-template -->

<?php

get_footer();