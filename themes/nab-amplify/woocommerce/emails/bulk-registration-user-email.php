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
	<p>You've been registered for an account on <?php esc_html_e( 'NAB Amplify.', 'nab-amplify' ); ?><sup>TM</sup>.</p>
	<p>Today this is your hub for event registration for NAB Show New York<sup>®</sup>, Radio Show and SMTE. But in 2021 this will be your destination to connect with the global media and entertainment community.  
</p><p>
NAB Amplify<sup>TM</sup> is building a dynamic platform with YOU at the center of the design. Through personal customization and unique networking opportunities, we want to connect you to people, products and information that is most meaningful to your success. Live shared learning, access to experts for Q&A, live demos and product unveilings and the ability to present your qualifications and interests to a curated community are just a sampling of the experiences you can expect in 2021.  
</p><p>
This is also an experience shaped by the community; therefore, we are looking for beta testers to provide input in the early stages of development starting this November. Your feedback is valuable to this process and if you would like to participate, we would appreciate your time and insights.   
</p><p>Sign up here to contribute as an NAB Amplify<sup>TM</sup> beta tester and we will be in touch soon with more details on how you can test new features. https://amplify.nabshow.com/  
<p>We look forward to connecting with you virtually. If there is anything, we can help with in the meantime please let us know <a href="mailto:register@nab.org">register@nab.org</a>.
	</p>
	<p>Below are the credentials to access <a href="<?php echo esc_url( wc_get_account_endpoint_url( 'edit-my-profile' ) ); ?>">your account</a> :
	<br><strong>Email : </strong><?php echo esc_html( $email ); ?><br>
	<strong>Password : </strong><?php echo $user_pass; ?></p>
	<p>Stay Amped!<br>
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

}
