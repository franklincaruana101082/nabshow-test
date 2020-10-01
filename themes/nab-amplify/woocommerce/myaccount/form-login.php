<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 4.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$redirect_url = filter_input( INPUT_GET, 'r', FILTER_SANITIZE_STRING );
$referer_url  = $_SERVER[ 'HTTP_REFERER' ];

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
	$redirect_url = $_POST[ 'redirect' ];
}


do_action( 'woocommerce_before_customer_login_form' ); ?>

<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

<div class="u-columns col2-set" id="customer_login">

	<div class="u-column1 col-1">

		<?php endif; ?>

		<h2><?php esc_html_e( 'Sign in', 'woocommerce' ); ?></h2>


		<div class="yyy" style="display: none;">
		<?php 
		echo '<pre>';
		print_r($_SERVER);
		echo '</pre>';
		?>
		</div>


		<div class="nab-login-wrap" data-refrl="<?php echo wp_get_referer(); ?>" data-orefrl="<?php echo wp_get_original_referer(); ?>">
			<div class="nab-normal-login">
				<form class="woocommerce-form woocommerce-form-login login" method="post">

					<?php do_action( 'woocommerce_login_form_start' ); ?>

					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
						<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username"
						       placeholder="<?php esc_html_e( 'Username or email address', 'woocommerce' ); ?>"
						       value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>"/><?php // @codingStandardsIgnoreLine ?>
					</p>
					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
						<input class="woocommerce-Input woocommerce-Input--text input-text" placeholder="<?php esc_html_e( 'Password', 'woocommerce' ); ?>" type="password"
						       name="password"
						       id="password" autocomplete="current-password"/>
					</p>

					<?php do_action( 'woocommerce_login_form' ); ?>

					<p class="woocommerce-LostPassword lost_password">
						<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Forgot password?', 'woocommerce' ); ?></a>
					</p>

					<p class="form-row">
						<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever"
						       style="display: none"
						       checked/>
						<?php if ( isset( $redirect_url ) && ! empty( $redirect_url ) ) { ?>
							<input type="hidden" name="redirect" value="<?php echo esc_url( $redirect_url ); ?>">
						<?php } else { ?>
							<input type="hidden" name="redirect" value="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>">
						<?php } ?>
						<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
						<button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="login"
						        value="<?php esc_attr_e( 'Sign in', 'woocommerce' ); ?>"><?php esc_html_e( 'Sign in', 'woocommerce' ); ?></button>

					</p>


					<?php do_action( 'woocommerce_login_form_end' ); ?>

				</form>
			</div>
			<span><?php esc_html_e( 'Or', 'woocommerce' ); ?></span>
			<div class="nab-social-login">
				<?php echo do_shortcode( '[miniorange_social_login apps="google,fb"]' ); ?>
			</div>
		</div>
		<?php
		$sign_up_page = get_page_by_path( NAB_SIGNUP_PAGE ); // @todo later replace this with VIP function
		if ( isset( $sign_up_page ) && ! empty( $sign_up_page ) ) {
			$sign_up_page_url = get_permalink( $sign_up_page->ID );
			if ( isset( $redirect_url ) && ! empty( $redirect_url ) ) {
				$sign_up_page_url = add_query_arg( 'r', $redirect_url, $sign_up_page_url );
			}
		} else {
			$sign_up_page_url = 'javascript:void(0)';
		}
		?>
		<div class="nab-signup-now">
		<h4 class="text-transform-initial">Sign in to your NAB Amplify account to access content and register for NAB Show New York, Radio Show and SMTE.</h4>
			<h4 class="text-transform-initial">Don't have an account? <a href="<?php echo esc_url( $sign_up_page_url ); ?>">Sign up</a> now.</h4>
		</div>


		<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

	</div>

	<div class="u-column2 col-2">

	</div>

</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
