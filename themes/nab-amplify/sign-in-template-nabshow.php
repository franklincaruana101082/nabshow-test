<?php
/*
 * Template Name: Sign In NAB Show
 */

if ( is_user_logged_in() ) {
	wp_safe_redirect( wc_get_page_permalink( 'myaccount' ) );
	exit;
}

get_header('nabshow');

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$redirect_url = filter_input( INPUT_GET, 'r', FILTER_SANITIZE_STRING );
$referer_url  = $_SERVER[ 'HTTP_REFERER' ];
$marketing_code = filter_input( INPUT_GET, 'marketing_code', FILTER_SANITIZE_STRING );

// Note: Turning this off because it's creating multiple query strings and it's not apparent why this is in place.
// if ( ! empty( $redirect_url ) ) {
// 	$queries = array();
// 	parse_str( $_SERVER[ 'QUERY_STRING' ], $queries );
// 	if ( isset( $queries[ 'r' ] ) && is_array( $queries ) && count( $queries ) > 1 ) {
// 		unset( $queries[ 'r' ] );
// 		$redirect_url = add_query_arg( $queries, $redirect_url );		
// 	}
// }

if ( empty( $redirect_url ) && isset( $referer_url ) && wc_get_page_permalink( 'checkout' ) === $referer_url ) {
	$redirect_url = $_SERVER[ 'HTTP_REFERER' ];
}

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

if ( empty( $redirect_url ) && isset( $_POST[ 'redirect' ] ) && ! empty( $_POST[ 'redirect' ] ) ) {
	$redirect_url = esc_url_raw($_POST[ 'redirect' ]);
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
				<div class="signup-logos">
					<div class="signup-logo-amplify">
						<img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-login-amplify.png" alt="NAB Amplify Logo">
					</div>
					<div class="signup-logo-show">
						<img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-login-nab-show.png" alt="NAB Show Logo">
					</div>
					<div class="signup-logo-radio">
						<img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-login-radio-show.png" alt="Radio Show Logo">
					</div>
					<div class="signup-logo-smte">
						<img src="/wp-content/themes/nabshow-lv-child-2021/assets/images/logo-login-nab-smte.png" alt="NAB SMTE Logo">
					</div>
				</div>
				<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

				<div class="signup _signin">
					<div class="signup__titles">
						<h2><?php esc_html_e( 'Sign in', 'woocommerce' ); ?></h2>
						<?php
						$sign_up_page = get_page_by_path( NAB_SHOW_SIGNUP_PAGE ); // @todo later replace this with VIP function
						if ( isset( $sign_up_page ) && ! empty( $sign_up_page ) ) {
							$sign_up_page_url = get_permalink( $sign_up_page->ID );

							if ( isset( $redirect_url ) && ! empty( $redirect_url ) ) {
								$sign_up_page_url = add_query_arg( 'r', $redirect_url, $sign_up_page_url );
								if ( isset( $marketing_code ) && ! empty( $marketing_code ) ) {
									$sign_up_page_url = add_query_arg( 'marketing_code', $marketing_code, $sign_up_page_url);
								}
							}
						} else {
							$sign_up_page_url = 'javascript:void(0)';
						}
						?>
						<a href="<?php echo esc_url( $sign_up_page_url ); ?>"><b><?php esc_html_e( "Don't have an account? Sign Up", 'nab-amplify');?></b></a>
					</div>
					<div class="signup__text">
						
					</div>

					<form class="signup__fields" method="post">

						<?php do_action( 'woocommerce_login_form_start' ); ?>

						<div class="field">
							<label class="field__label" for="username"><?php esc_html_e( 'Username or Email Address', 'woocommerce' ); ?></label>
							<input type="text" class="field__input" name="username" id="username" autocomplete="username"
							       value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>"/>
						</div>
						<div class="field">
							<label class="field__label" for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?></label>
							<input class="field__input" type="password" name="password"
							       id="password" autocomplete="current-password"/>
						</div>

						<?php do_action( 'woocommerce_login_form' ); ?>

						<div class="field">
							<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Forgot password?', 'woocommerce' ); ?></a>
						</div>

						<div class="signup__cta">
							<input class="woocommerce-form__input woocommerce-form__input-checkbox" 
									name="rememberme" type="checkbox" id="rememberme" value="forever"
							    	style="display: none" checked/>
							<?php if ( isset( $redirect_url ) && ! empty( $redirect_url ) ) { ?>
								<input type="hidden" name="redirect" value="<?php echo $redirect_url; ?>">
							<?php } else { ?>
								<input type="hidden" name="redirect" value="<?php echo esc_url( home_url() ); ?>">
							<?php } ?>
							<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
							<button type="submit" class="button _gradientpink" name="login"
							        value="<?php esc_attr_e( 'Sign in', 'woocommerce' ); ?>"><?php esc_html_e( 'Sign in', 'woocommerce' ); ?></button>
						</div>


						<?php do_action( 'woocommerce_login_form_end' ); ?>

					</form>

					<div class="signup__separator"><span class="or-separator"><?php esc_html_e( 'Or', 'woocommerce' ); ?></span></div>

					<div class="signup__socials">
						<?php echo do_shortcode( '[miniorange_social_login apps="google,fb"]' ); ?>
					</div>
				</div>

				<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
			</div><!-- .container -->
		</div><!-- .signup-wrapper -->

	</article><!-- #post-<?php the_ID(); ?> -->

<?php
endwhile; // End of the loop.
?>

</main><!-- #main -->

<?php

get_footer('nabshow');
