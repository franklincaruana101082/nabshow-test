<?php
/*
 * Template Name: Sign Up NAB Show
 */

if ( is_user_logged_in() ) {
	wp_safe_redirect( wc_get_page_permalink( 'myaccount' ) );
	exit;
}

get_header('nabshow');

$redirect_url = filter_input( INPUT_GET, 'r', FILTER_SANITIZE_STRING );
$marketing_code = filter_input( INPUT_GET, 'marketing_code', FILTER_SANITIZE_STRING );

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
				<img class="hero__logo" src="/wp-content/themes/nabshow-lv-child-2021/assets/images/NAB_Show_Logo_White.png" alt="NAB Show where content comes to life">
				<?php
				do_action( 'woocommerce_before_customer_login_form' );
				?>
				<form method="post" class="signup" <?php do_action( 'woocommerce_register_form_tag' ); ?> >

					<?php do_action( 'woocommerce_register_form_start' ); ?>

					<div class="signup__titles">
						<h2><?php the_title(); ?></h2>
						<?php if ( isset( $redirect_url ) && ! empty( $redirect_url ) ) {
							$my_account_url = add_query_arg( 'r', $redirect_url, wc_get_page_permalink( 'myaccount' ) );
							if ( isset( $marketing_code ) && ! empty( $marketing_code ) ) {
								$my_account_url = add_query_arg( 'marketing_code', $marketing_code, $my_account_url);
							}
						} else {
							$my_account_url = wc_get_page_permalink( 'myaccount' );
						} ?>
						<a class="js-signupLink" href="<?php echo esc_url( $my_account_url ); ?>"><b><?php esc_html_e( 'Already on NAB Amplify?' ); ?> <?php esc_html_e( 'Sign In', 'woocommerce' ); ?></b></a>
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
						<div class="field">
							<label class="field__label" for="user_title"><?php esc_html_e( 'Title', 'woocommerce' ); ?> <span class="field__required" aria-label="Required">*</span></label>
							<input type="text" class="field__input" name="user_title" id="user_title" value="<?php echo ( ! empty( $_POST['user_title'] ) ) ? esc_attr( wp_unslash( $_POST['user_title'] ) ) : ''; ?>"/>
							<p class="field__error" style="display: none;">Title is Required</p>
						</div>

						<div class="field">
							<label class="field__label" for="user_company"><?php esc_html_e( 'Company', 'woocommerce' ); ?> <span class="field__required" aria-label="Required">*</span></label>
							<input type="text" class="field__input" name="user_company" id="user_company" value="<?php echo ( ! empty( $_POST['user_company'] ) ) ? esc_attr( wp_unslash( $_POST['user_company'] ) ) : ''; ?>"/>
							<p class="field__error" style="display: none;">Company is Required</p>
						</div>
						
						<?php
						$countries_obj  		= new WC_Countries();
						$countries      		= $countries_obj->__get('countries');
						$default_country        = ! empty( $_POST['user_country'] ) ? $_POST['user_country'] : $countries_obj->get_base_country();
						$default_county_states  = $countries_obj->get_states($default_country);
						?>

						<div class="field select-dark">
							<label class="field__label" for="user_country"><?php esc_html_e( 'Country', 'woocommerce' ); ?> <span class="field__required" aria-label="Required">*</span></label>
							<select name="user_country" class="user-country-select" id="user_country">
								<option value="">Select a country</option>
								<?php
								foreach ( $countries as $abbr => $country ) {
									?>
									<option value="<?php echo esc_attr( $abbr ); ?>" <?php selected( $abbr, $_POST['user_country'] ); ?>><?php echo esc_html( $country ); ?></option>
									<?php
								}
								?>
							</select>
							<p class="field__error" style="display: none;">Country is Required</p>
						</div>

						<div class="field select-dark <?php if(is_array( $default_county_states )) {echo('');}else{echo('_hidden');}?>">
							<label class="field__label" for="user_state"><?php esc_html_e( 'State', 'woocommerce' ); ?> <span class="field__required" aria-label="Required">*</span></label>
							<?php
							if ( is_array( $default_county_states ) ) {
								?>
								<select name="user_state" class="user-state-select" id="user_state">
									<option value="">Select a state</option>
									<?php
									foreach ( $default_county_states as $abbr => $state) {
										?>
										<option value="<?php echo esc_attr( $abbr ); ?>" <?php selected( $abbr, $_POST['user_state'] ); ?>><?php echo esc_html( $state ); ?></option>
										<?php
									}
									?>
								</select>
								<?php
							} else {
								?>
								<input type="text" class="field__input" name="user_state" id="user_state" value="<?php echo ( ! empty( $_POST['user_state'] ) ) ? esc_attr( wp_unslash( $_POST['user_state'] ) ) : ''; ?>"/>
								<?php
							}
							?>
							<p class="field__error" style="display: none;">State is Required</p>
						</div>

						<div class="field">
							<label class="field__label" for="user_city"><?php esc_html_e( 'City', 'woocommerce' ); ?> <span class="field__required" aria-label="Required">*</span></label>
							<input type="text" class="field__input" name="user_city" id="user_city" value="<?php echo ( ! empty( $_POST['user_city'] ) ) ? esc_attr( wp_unslash( $_POST['user_city'] ) ) : ''; ?>"/>
							<p class="field__error" style="display: none;">City is Required</p>
						</div>
					</div>

					<?php if($redirect_url != 'maritz') { ?>
					<div class="signup__separator"><span class="or-separator"><?php esc_html_e( 'Or', 'woocommerce' ); ?></span></div>

					<div class="signup__socials">
						<?php echo do_shortcode( '[miniorange_social_login apps="google,fb"]' ); ?>
					</div>
					<?php } ?>

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

						<?php if ( isset( $redirect_url ) && ! empty( $redirect_url ) ) { ?>
							<input type="hidden" name="checkout_redirect" value="<?php echo $redirect_url; ?>">
						<?php } ?>
						<?php dynamic_sidebar('sign-up-terms'); ?>
						<ul class="field__list">
							<li>
								<?php do_action( 'woocommerce_register_form' ); ?>
							</li>
							<li>
								<label class="field__list-input" for="signup-amplify-communications">
									<input class="field__input" value="1" type="checkbox" id="signup-amplify-communications" name="amplify_communications" /> 
									<?php esc_html_e('I would like to receive Amplify communications.');?>
								</label>
							</li>
							<li>
								<label class="field__list-input" for="signup-press-member">
									<input class="field__input" value="1" type="checkbox" id="signup-press-member" name="press_member" /> 
									<?php esc_html_e('Are you a member of the press?');?>
								</label>
							</li>
						</ul>
					</div>
					<div class="signup__captcha">
						<div class="captcha">
							<div class="g-recaptcha" data-sitekey="6LdvDNIaAAAAAKV0Yr1FzY9c7oQLRkrr1qJ3yWH8"></div>
							<p class="captcha-error" style="display: none; color:red;">Please check the recaptcha</p>
						</div>
					</div>
					<div class="signup__cta">
						<input type="hidden" name="privacy_policy" class="signup-privacy-policy" id="signup-privacy-policy" value="1">
						<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
						<button type="submit" name="register" class="button _gradientpink" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Sign Up', 'woocommerce' ); ?></button>
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
	            	<?php dynamic_sidebar('member-press-modal'); ?>
	            </div>
	        </div>
	    </div>
	</div>
	<!-- END legacy-template -->
<?php

get_footer('nabshow');