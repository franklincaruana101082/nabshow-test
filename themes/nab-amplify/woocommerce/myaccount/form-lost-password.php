<?php
/**
 * Lost password form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-lost-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.2
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_lost_password_form' );
?>

<form method="post" class="signup _simple">
	<div class="signup__titles">
		<h2><?php esc_html_e( 'Lost password', 'woocommerce' ); ?></h2>
	</div>
	<div class="signup__text">
		<div class="introtext">
			<p><?php echo apply_filters( 'woocommerce_lost_password_message', esc_html__( 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'woocommerce' ) ); ?></p><?php // @codingStandardsIgnoreLine ?>
		</div>
	</div>

	<div class="signup__fields">
		<div class="field">
			<label class="field__label" for="user_login"><?php esc_html_e( 'Username or email', 'woocommerce' ); ?></label>
			<input class="field__input" type="text" name="user_login" id="user_login" autocomplete="username" />
		</div>
	</div>

	<?php do_action( 'woocommerce_lostpassword_form' ); ?>

	<div class="signup__cta">
		<input type="hidden" name="wc_reset_password" value="true" />
		<button type="submit" class="button _gradientpink" value="<?php esc_attr_e( 'Reset password', 'woocommerce' ); ?>"><?php esc_html_e( 'Reset password', 'woocommerce' ); ?></button>
	</div>

	<?php wp_nonce_field( 'lost_password', 'woocommerce-lost-password-nonce' ); ?>

</form>
<?php
do_action( 'woocommerce_after_lost_password_form' );
