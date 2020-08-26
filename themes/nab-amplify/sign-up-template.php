<?php
/*
 * Template Name: Sign Up
 */

if ( is_user_logged_in() ) {
	wp_safe_redirect( wc_get_page_permalink( 'myaccount' ) );
	exit;
}

get_header();
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

									<p class="woocommerce-FormRow form-row">
										<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
										<button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit" name="register"
										        value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Register', 'woocommerce' ); ?></button>
									</p>

									<?php do_action( 'woocommerce_register_form_end' ); ?>

								</form>
							</div>
							<span><?php esc_html_e( 'Or', 'woocommerce' ); ?></span>
							<div class="nab-social-login">
								<?php echo do_shortcode( '[miniorange_social_login apps="linkin,google,fb"]' ); ?>
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