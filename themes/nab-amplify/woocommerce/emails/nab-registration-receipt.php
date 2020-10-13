<?php
defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_email_header', $email_heading, $email );

?>
	<p><?php printf( esc_html__( 'Dear %1s %2s,', 'woocommerce' ), esc_html( $order->get_billing_first_name() ), esc_html( $order->get_billing_last_name() ) ); ?></p>
<p>Thank you for registering for an account on  <?php esc_html_e( 'NAB Amplify.', 'nab-amplify' ); ?><sup>TM</sup>.</p>
	<p>Today this is your hub for event registration for NAB Show New York<sup>®</sup>, Radio Show and SMTE. But in 2021 this will be your destination to connect with the global media and entertainment community.  
</p><p>
NAB Amplify<sup>TM</sup> is building a dynamic platform with YOU at the center of the design. Through personal customization and unique networking opportunities, we want to connect you to people, products and information that is most meaningful to your success. Live shared learning, access to experts for Q&A, live demos and product unveilings and the ability to present your qualifications and interests to a curated community are just a sampling of the experiences you can expect in 2021.  
</p><p>
This is also an experience shaped by the community; therefore, we are looking for beta testers to provide input in the early stages of development starting this November. Your feedback is valuable to this process and if you would like to participate, we would appreciate your time and insights.   
</p><p>Sign up here to contribute as an NAB Amplify<sup>TM</sup> beta tester and we will be in touch soon with more details on how you can test new features. https://amplify.nabshow.com/  
<p>We look forward to connecting with you virtually. If there is anything, we can help with in the meantime please let us know <a href="mailto:register@nab.org">register@nab.org</a>.
	</p>	
	<p>To view and/or add items to your registration or make changes to your NAB Amplify<sup>TM</sup> account, simply <a
			href="<?php echo esc_url( wc_get_account_endpoint_url( 'edit-my-profile' ) ); ?>">Log In</a>.</p>

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

	<p>Details on accessing your event(s) will hit your inbox shortly. In the meantime, you can view a record of the events, products and passes purchased under <a href="https://amplify.nabshow.com/my-account/my-purchases/">My Purchases</a>. Have questions in the meantime? Contact us at <a
			href="mailto:register@nab.org">register@nab.org</a>.</p>
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