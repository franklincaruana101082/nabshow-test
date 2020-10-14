<?php
defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_email_header', $email_heading, $email );

?>
	<p><?php printf( esc_html__( 'Dear %1s %2s,', 'woocommerce' ), esc_html( $order->get_billing_first_name() ), esc_html( $order->get_billing_last_name() ) ); ?></p>
<p>Thank you for registering!</p>
	<p>We look forward to hosting you and other professionals from the media and entertainment industry this October.</p>
	<p>To view and/or add items to your registration or make changes to your account, simply <a
			href="<?php echo esc_url( wc_get_account_endpoint_url( 'edit-my-profile' ) ); ?>">Log In</a>.</p>

	<p>Details on accessing your event(s) will hit your inbox at least a day prior to the event. (Please make sure to check your spam filters.) In the meantime, you can view a record of the events, products and passes purchased under <a href="https://amplify.nabshow.com/my-account/my-purchases/">My Purchases</a>. Have questions in the meantime? Contact us at <a
			href="mailto:support@nabamplify.zendesk.com">support@nabamplify.zendesk.com</a>.</p>

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

	<p>Stay tuned,<br>
		Team NAB</p>
	<p>Radio Show<br>Available On-Demand Through December 2020<br><a href="https://www.radioshowweb.com/">radioshowweb.com</a></p>

	<p>Sales and Management Television Exchange<br>October 14 - 15, 2020<br><a href="http://nabsmte.com/">nabsmte.com</a></p>

	<p>NAB Show New York<br>October 19 - 29, 2020<br><a href="https://nabshowny.com/">nabshowny.com</a></p>

<?php
/**
 * Show user-defined additional content - this is set in each email's settings.
 */
if ( $additional_content ) {
	echo wp_kses_post( wpautop( wptexturize( $additional_content ) ) );
}

do_action( 'woocommerce_email_footer', $email );