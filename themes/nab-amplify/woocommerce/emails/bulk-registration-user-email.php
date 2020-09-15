<?php

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_email_header', $email_heading, $email );

$user = get_user_by( 'ID', $user_id );

if ( $user ) {
	$first_name = $user->first_name;
	$last_name  = $user->last_name;
	$full_name  = $first_name . ' ' . $last_name;
	$email      = $user->user_email;
	?>

	<?php /* translators: %s: Customer username */ ?>
	<p><?php printf( esc_html__( 'Dear %s,', 'woocommerce' ), esc_html( $full_name ) ); ?></p>
	<?php /* translators: %1$s: Site title, %2$s: Username, %3$s: My account link */ ?>
	<p><?php esc_html_e( 'We are so excited to have you join us!', 'nab-amplify' ); ?></p>
	<p>Below are the credentials to access your account at <a href="<?php echo esc_url( wc_get_account_endpoint_url( 'edit-my-profile' ) ); ?>">NAB Amplify</a> :
	<br><strong>Email : </strong><?php echo esc_html( $email ); ?><br>
	<strong>Password : </strong><?php echo $user_pass; ?></p>
	<p>We look forward to connecting with you virtually. If there is anything, we can help with in the meantime please let us know <a href="mailto:register@nab.org">register@nab.org</a>.
	</p>
	<p>Stay Amped!<br>
	Team NAB</p>

	<?php
	/**
	 * Show user-defined additional content - this is set in each email's settings.
	 */
	if ( $additional_content ) {
		echo wp_kses_post( wpautop( wptexturize( $additional_content ) ) );
	}

	do_action( 'woocommerce_email_footer', $email );

}
