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

<p>Welcome to NAB Amplify. You now have access to: </p>
	<ul>
		<li>Fresh <a href="https://amplify.nabshow.com/?s&v=content">content</a> online and delivered to your inbox via the weekly NAB Amplify Newsletter</li>
		<li>VOD for online events</li>
		<li>1,600+ <a href="https://amplify.nabshow.com/?s&v=company">companies</a> featuring hundreds of <a href="https://amplify.nabshow.com/?s=&v=product">products</a></li>
		<li>Thousands of people waiting to connect with you</li>
		<li>And you took the first step in registering for NAB Show [If you haven’t yet, <a href="https://amplify.nabshow.com/sign-up/?r=maritz">continue registering here</a>]</li>
	</ul>
	<p>To take full advantage of the community platform, we encourage you to <a href="https://amplify.nabshow.com/my-account/edit-account/">build out your profile</a>, connect with others, search upcoming events, review companies, discover new innovations and engage with articles and videos.</p>
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
