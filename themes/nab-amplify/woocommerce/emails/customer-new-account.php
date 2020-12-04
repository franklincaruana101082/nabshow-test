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
	<p><?php esc_html_e( 'Welcome to NAB Amplify!', 'nab-amplify' ); ?></p>
	<p>This all-new, year-round digital platform is designed to provide you with opportunities for networking, discovery and education. It is also your registration destination for NAB Show New York, Radio Show and SMTE.</p>
	<p>You completed step 1 – signing up! Finish building out your profile to optimize your experience, connections and event suggestions.</p>

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
