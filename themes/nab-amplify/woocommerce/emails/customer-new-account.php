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
<p>Thank you for registering for an account on  <?php esc_html_e( 'NAB Amplify.', 'nab-amplify' ); ?><sup>TM</sup>.</p>
	<p>Today this is your hub for event registration for NAB Show New York<sup>®</sup>, Radio Show and SMTE. But in 2021 this will be your destination to connect with the global media and entertainment community.  
</p><p>
NAB Amplify is building a dynamic platform with YOU at the center of the design. Through personal customization and unique networking opportunities, we want to connect you to people, products and information that is most meaningful to your success. Live shared learning, access to experts for Q&A, live demos and product unveilings and the ability to present your qualifications and interests to a curated community are just a sampling of the experiences you can expect in 2021.  
</p><p>
This is also an experience shaped by the community; therefore, we are looking for beta testers to provide input in the early stages of development starting this November. Your feedback is valuable to this process and if you would like to participate, we would appreciate your time and insights.   
</p><p><a href="https://amplify.nabshow.com/">Sign up here</a> to contribute as an NAB Amplify beta tester and we will be in touch soon with more details on how you can test new features.   
<p>We look forward to connecting with you virtually. If there is anything we can help with in the meantime, please let us know at <a href="mailto:support@nabamplify.zendesk.com">support@nabamplify.zendesk.com</a>.
	</p>	
	<p>To view and/or add items to your registration or make changes to your NAB Amplify account, simply <a
			href="<?php echo esc_url( wc_get_account_endpoint_url( 'edit-my-profile' ) ); ?>">Log In</a>.</p>

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
