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
		$redirect_url = esc_url_raw($_POST[ 'checkout_redirect' ]);
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
<main id="primary" class="site-main">

<?php
while ( have_posts() ) :
	the_post();
	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="signup-wrapper">
			<div class="container">
				<?php
				do_action( 'woocommerce_before_customer_login_form' );
				?>
				<form method="post" class="signup" <?php do_action( 'woocommerce_register_form_tag' ); ?> >

					<?php do_action( 'woocommerce_register_form_start' ); ?>

					<div class="signup__titles">
						<h2><?php the_title(); ?></h2>
						<?php if ( isset( $redirect_url ) && ! empty( $redirect_url ) ) {
							$my_account_url = add_query_arg( 'r', $redirect_url, wc_get_page_permalink( 'myaccount' ) );
						} else {
							$my_account_url = wc_get_page_permalink( 'myaccount' );
						} ?>
						<a href="<?php echo esc_url( $my_account_url ); ?>"><b><?php esc_html_e( 'Already have an account?' ); ?> <?php esc_html_e( 'Sign In', 'woocommerce' ); ?></b></a>
					</div>
					<div class="signup__text">
						<div class="introtext"><?php the_content(); ?></div>
					</div>

					<div class="signup__fields">
						<div class="field">
							<label class="field__label" for="first_name"><?php esc_html_e( 'First Name', 'woocommerce' ); ?> <span class="field__required" aria-label="Required">*</span></label>
							<input type="text" class="field__input" name="first_name" id="first_name"
								value="<?php echo ( ! empty( $_POST['first_name'] ) ) ? esc_attr( wp_unslash( $_POST['first_name'] ) ) : ''; ?>"/>
							<p class="field__error" style="display: none;">First name is Required</p>
						</div>
						<div class="field">
							<label class="field__label" for="last_name"><?php esc_html_e( 'Last Name', 'woocommerce' ); ?> <span class="field__required" aria-label="Required">*</span></label>
							<input type="text" class="field__input" name="last_name" id="last_name"
								value="<?php echo ( ! empty( $_POST['last_name'] ) ) ? esc_attr( wp_unslash( $_POST['last_name'] ) ) : ''; ?>"/>
							<p class="field__error" style="display: none;">Last name is Required</p>
						</div>
						<div class="field">
							<label class="field__label" for="email"><?php esc_html_e( 'Email Address*', 'woocommerce' ); ?> <span class="field__required" aria-label="Required">*</span></label>
							<input type="email" class="field__input" name="email" id="reg_email" autocomplete="email"
								value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>"/>
							<p class="field__error" style="display: none;">Email is Required</p>
						</div>
						<div class="field">
							<label class="field__label" for="password"><?php esc_html_e( 'Password*', 'woocommerce' ); ?> <span class="field__required" aria-label="Required">*</span></label>
							<input type="password" class="field__input" name="password" id="reg_password" autocomplete="new-password"/>
							<p class="field__error" style="display: none;">Password is Required</p>
						</div>  
						<div class="field">
							<label class="field__label" for="password2"><?php esc_html_e( 'Confirm Password*', 'woocommerce' ); ?> <span class="field__required" aria-label="Required">*</span></label>
							<input type="password" class="field__input" name="password2" id="reg_password2" autocomplete="new-password"/>
							<p class="field__error" style="display: none;">Confirm Password is Required</p>
						</div>
					</div>					

					<div class="signup__separator"><span class="or-separator"><?php esc_html_e( 'Or', 'woocommerce' ); ?></span></div>

					<div class="signup__socials">
						<?php echo do_shortcode( '[miniorange_social_login apps="google,fb"]' ); ?>
					</div>

					<div class="signup__roles">
						<?php
						$interest_items			= array( 'Content Creation', 'Live Event Production', 'Broadcast', 'Streaming' );
						$selected_user_interest	= filter_input( INPUT_POST, 'user_interest', FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY );
						$selected_user_interest = isset( $selected_user_interest ) && ! empty( $selected_user_interest ) ? $selected_user_interest : array();
						?>
						<h2 class="field__title"><?php esc_html_e("I'm Interested In...");?></h2>
						<div class="field__subtitle"><?php esc_html_e('Select all that apply'); ?></div>
						<ul class="field__list">
							<?php
							foreach ( $interest_items as $item ) {
								
								$current_item = '';
								
								if ( is_array( $selected_user_interest ) && in_array( $item, $selected_user_interest, true ) ) {
									$current_item = $item;
								}
								?>
								<li>
									<label class="field__list-input" for="<?php echo esc_attr( $item ); ?>">
										<input type="checkbox" name="user_interest[]" class="field__input" value="<?php echo esc_attr( $item ); ?>" id="<?php echo esc_attr( $item ); ?>" <?php checked( $current_item, $item ); ?> /> <?php echo esc_html( $item ); ?>
									</label>
								</li>                                                            
								<?php
							}
							?>
						</ul>
					</div>

					<div class="signup__confirmation">
						<?php do_action( 'woocommerce_register_form' ); ?>

						<?php if ( isset( $redirect_url ) && ! empty( $redirect_url ) ) { ?>
							<input type="hidden" name="checkout_redirect" value="<?php echo $redirect_url; ?>">
						<?php } ?>
						<p>By creating this account, you are agreeing to share the information provided with any NAB Amplify exhibitor/sponsor/partner whose content you engage with. You accept that this exhibitor/sponsor/partner may contact you about their products or services under legitimate interest. If you opt out of the communications at checkout, we will disable tools that allow engagement on your account. For more information about our Privacy Policy and GDPR please see the links below.</p>
						<ul class="field__list">
							<li>
								<label class="field__list-input" for="list-a">
									<input class="field__input" value="1" type="checkbox" id="signup-press-member" name="press_member" /> 
									<?php esc_html_e('Are you a member of the press?');?>
								</label>
							</li>
						</ul>
					</div>

					
					<?php /*
					<div class="woocommerce-form-row woocommerce-form-row--wide form-row-wide">
						<div class="amp-check-container check-align-top">
							<div class="amp-check-wrp">
								<input type="checkbox" name="privacy_policy" class="signup-privacy-policy" id="signup-privacy-policy" value="1">
								<span class="amp-check"></span>
							</div>
							<label for="signup-privacy-policy">I agree to the NAB Amplify <a href="<?php echo site_url(); ?>/privacy-policy/">privacy policy</a>, <a href="<?php echo site_url(); ?>/terms-of-use/">terms of use</a> and <a href="<?php echo site_url(); ?>/nab-virtual-events-code-of-conduct/">code of conduct</a>.</label>
						</div>
					</div>
					*/?>

					<div class="signup__cta">
						<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
						<button disabled type="submit" name="register" class="button _gradientpink" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Sign Up', 'woocommerce' ); ?></button>
					</div>

					<?php do_action( 'woocommerce_register_form_end' ); ?>

				</form>

		</div><!-- .container -->
	</div><!-- .signup-wrapper -->

	</article><!-- #post-<?php the_ID(); ?> -->

<?php
endwhile; // End of the loop.
?>


	</main><!-- #main -->
	<div id="modal-member-press" class="nab-modal">
	    <div class="nab-modal-inner">
	        <div class="modal-content">
	            <span class="nab-modal-close fa fa-times"></span>
	            <div class="modal-content-wrap">
	                <h4>Qualified Members of the Press Include:</h4>
					<strong>Print / Online Media</strong>
					<ul>
						<li>Masthead from a current publication listing you as an editorial contributor.</li>
						<li>A recent article (or link) with your by-line.</li>
					</ul>
					<strong>Broadcast Media</strong>
					<ul>
						<li>Letter from the editor/producer on station/network letterhead or from a company email address that states you are covering NAB Show on assignment.</li>
						<li>Government-issued or media outlet press ID.</li>
						<li>A news outlet webpage listing you as news staff (news director, editor, producer, reporter, anchor).</li>
						<li>Business card from your media outlet reflecting your editorial role.</li>
					</ul>
					<strong>Industry Analysts</strong>
					<ul>
						<li>Recent article with your byline.</li>
						<li>Recent/relevant article quoting you as an industry analyst.</li>
						<li>Cover of a recent market research report listing you as a contributor (report must not be solicited by an exhibiting company).</li>
					</ul>
					<p>Qualified members of the press should select “Press” when registering to ensure future access to Amplify’s original content, networking and engagement opportunities, and exclusive events. To qualify, all members must agree with Amplify’s privacy policy, terms of use and code of conduct. Contact information will not be shared unless press opt-in to share information.</p>
	            </div>
	        </div>
	    </div>
	</div>
	<!-- END legacy-template -->
<?php

get_footer();