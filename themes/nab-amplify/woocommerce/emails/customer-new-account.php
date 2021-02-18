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
	
	<p>Congratulations on joining the beta launch of NAB Amplify, a new digital experience and community hub, brought to you by the creators of NAB Show®️.</p>
	<p>You completed step 1 – signing up! Now take full advantage of your elite access by building out your profile, connecting with others, searching events to RSVP for, reviewing companies and products and commenting on articles and videos.</p>
	<p>Since we are still in beta mode, we expect you’ll notice areas for improvement or the occasional bug. Please help us learn and grow by clicking on the lightbulb in the top right corner of the navigation bar and submitting notes on your experience.</p>
	<p>Thank you again for your support and collaboration in building the global hub for media, entertainment and technology.</p>

	<p>So, Let’s Get Started!<br>
	NAB Amplify Team</p>

<?php
/**
 * Show user-defined additional content - this is set in each email's settings.
 */
if ( $additional_content ) {
	echo wp_kses_post( wpautop( wptexturize( $additional_content ) ) );
}

do_action( 'woocommerce_email_footer', $email );
