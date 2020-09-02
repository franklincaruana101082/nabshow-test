<?php
defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_email_header', $email_heading, $email );

?>
	<p><?php printf( esc_html__( 'Dear %1s %2s,', 'woocommerce' ), esc_html( $order->get_billing_first_name() ), esc_html( $order->get_billing_last_name() ) ); ?></p>
	<p>We are so excited to have you join us!</p>
	<p>To view your order history or make changes to your account at any time, <a href="<?php echo esc_url( wc_get_account_endpoint_url( 'edit-my-profile' ) ); ?>">Log in here</a>.
		During the fall events, simply visit the Show websites and log in to access all Show content!</p>
	<p>We look forward to connecting with you virtually. If there is anything we can help with in the meantime please let us know <a
				href="mailto:register@nab.org">register@nab.org</a>.</p>
	<p><strong>Your NAB Team<strong></p>
	<p>Radio Show<br>October 5 - 9, 2020<br><a href="https://www.radioshowweb.com/">https://www.radioshowweb.com/</a></p>

	<p>Sales and Management Television Exchange<br>October 14 - 15, 2020<br><a href="http://nabsmte.com/">http://nabsmte.com/</a></p>

	<p>NAB Show New York<br>October 19 - 29, 2020<br><a href="https://nabshowny.com/">https://nabshowny.com/</a></p>

<?php
/**
 * Show user-defined additional content - this is set in each email's settings.
 */
if ( $additional_content ) {
	echo wp_kses_post( wpautop( wptexturize( $additional_content ) ) );
}

do_action( 'woocommerce_email_footer', $email );
