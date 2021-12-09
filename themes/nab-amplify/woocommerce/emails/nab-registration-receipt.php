<?php
defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_email_header', $email_heading, $email );

?>
	<p><?php printf( esc_html__( 'Dear %1s %2s,', 'woocommerce' ), esc_html( $order->get_billing_first_name() ), esc_html( $order->get_billing_last_name() ) ); ?></p>
	<p>You’re all set!</p>

<?php

if( 'yes' !== $is_bulk_child ) {

	/*
	* @hooked WC_Emails::order_details() Shows the order details table.
	* @hooked WC_Structured_Data::generate_order_data() Generates structured data.
	* @hooked WC_Structured_Data::output_structured_data() Outputs structured data.
	* @since 2.5.0
	*/
	do_action( 'woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email );

	/*
	* @hooked WC_Emails::order_meta() Shows order meta data.
	*/
	do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email );

	/*
	* @hooked WC_Emails::customer_details() Shows customer details
	* @hooked WC_Emails::email_address() Shows email address
	*/
	do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email );

}
?>

<p>To view and/or add items to your registration or make changes to your NAB Amplify account, simply <a
		href="<?php echo esc_url( wc_get_account_endpoint_url( 'edit-account' ) ); ?>">Log In</a>. Have questions? Contact us at <a href="mailto:support@nabamplify.zendesk.com">support@nabamplify.zendesk.com</a>.</p>

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
