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
?>

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
										       placeholder="<?php esc_html_e( 'Email address*', 'woocommerce' ); ?>"
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

									<?php do_action( 'woocommerce_register_form' ); ?>

									<?php if ( isset( $redirect_url ) && ! empty( $redirect_url ) ) { ?>
										<input type="hidden" name="checkout_redirect" value="<?php echo esc_url( $redirect_url ); ?>">
									<?php } ?>

									<p class="woocommerce-FormRow form-row">
										<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
										<button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit" name="register"
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
						<h4 class="text-transform-initial">We’re launching a brand new, amplified NAB experience where events will take place and other content will be hosted. Event registration will take place through this new platform and your NAB Amplify account will allow you to access NAB Show New York, Radio Show and SMTE.</h4>

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

<?php

get_footer();