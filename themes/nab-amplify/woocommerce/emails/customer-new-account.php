<?php
/**
 * Customer new account email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-new-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates/Emails
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_email_header', $email_heading, $email );

$user = get_user_by( 'login', $user_login );

if ( $user ) {
	$first_name = get_user_meta( $user->ID, 'billing_first_name', true );
	$last_name  = get_user_meta( $user->ID, 'billing_last_name', true );
	$full_name  = $first_name . ' ' . $last_name;
} else {
	$full_name = $user_login;
}

?>

<?php /* translators: %s: Customer username */ ?>
	<p><?php printf( esc_html__( 'Dear %s,', 'woocommerce' ), esc_html( $full_name ) ); ?></p>
<?php /* translators: %1$s: Site title, %2$s: Username, %3$s: My account link */ ?>
	
	<p>Congratulations on joining NAB Amplify. When you signed up, you activated these exclusive benefits of the Early Access Bundle:</p>
	<ul>	
		<li>Free <strong>NAB Amplify Newsletters</strong> highlighting fresh content</li>
		<li>Free <strong>Exhibits Pass to NAB Show in Las Vegas</strong> | October 10-13, 2021 ($159 value) details to come</li>
		<li>Free <strong>upgraded NAB Amplify subscription</strong> through 2021 ($100 value) which includes access to these special events:
			<ul>
				<li>Access to <strong>Demo Days</strong> (daily, expert-led product demonstrations) | March 15-26, 2021</li>
				<li>Access to <strong>NAB Show Premiere on NAB Amplify</strong> (reuniting the community to celebrate innovation) | April 12-23, 2021</li>
				<li>And more events and benefits throughout the year.</li>
			</ul>
		</li>
	</ul>
	<p>To take full advantage of the community platform, we encourage you to build out your profile, connect with others, search upcoming events, review companies, discover new innovations and engage with articles and videos.</p>
	<p>Plus, we want to hear your ideas and feedback on how we can improve NAB Amplify. Please help us learn and grow by clicking on the lightbulb in the top right corner of the navigation bar and submitting notes on your experience.</p>
	<p>Thank you again for your support and collaboration in building the global hub for media, entertainment and technology.</p>

	<p>Stay Amped,<br>
	The NAB Amplify Team</p>

<?php
/**
 * Show user-defined additional content - this is set in each email's settings.
 */
if ( $additional_content ) {
	echo wp_kses_post( wpautop( wptexturize( $additional_content ) ) );
}

do_action( 'woocommerce_email_footer', $email );
