<?php
/**
 * Admin Class
 *
 * @package MYS Modules
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( isset( $_GET['resetmys'] ) && "1" === $_GET['resetmys'] ) {
	update_option( 'nab_mys_show_wizard', "1" );
	delete_transient( 'nab_mys_token' );
	delete_option( 'nab_mys_credentials_valid' );
}

//Prevent  unauthorized users
if ( ! current_user_can( 'manage_options' ) ) {
	wp_die( esc_html_e( 'You do not have sufficient permissions to access this page.' ) );
}

update_option( 'nab_mys_wizard_step', 1 );

require_once( MYS_PLUGIN_DIR . '/includes/admin/settings/html-mys-header-page.php' );

//

$mys_username = get_option( 'nab_mys_credentials_u' );
$mys_password = get_option( 'nab_mys_credentials_p' );
$notice       = '';

if ( $_POST && wp_verify_nonce( $_POST['mys-cred-nonce'], 'mys-cred-nonce' ) ) {

	$mys_username = filter_input( INPUT_POST, 'mys_username', FILTER_SANITIZE_STRING );
	$mys_password = filter_input( INPUT_POST, 'mys_password', FILTER_SANITIZE_STRING );

	update_option( 'nab_mys_credentials_u', $mys_username );
	update_option( 'nab_mys_credentials_p', $mys_password );
	$result = ( new NAB_MYS_Endpoints() )->nab_mys_get_token_from_cache();

	$token_status_code = $result['token_status_code'];
	$token_response    = $result['token_response'];

	if ( 200 === $token_status_code ) {
		$notice_class = "notice-success";
		$notice       = "Authentication Successful";
		update_option( 'nab_mys_credentials_valid', 'yes' );
	} else {
		$notice_class = "notice-error";
		$notice       = $token_status_code . ": " . $token_response;
		update_option( 'nab_mys_credentials_valid', 'no' );
	}
}
$nab_mys_credentials_valid = get_option( 'nab_mys_credentials_valid' );

?>
<!-- <div class="notice notice-error is-dismissible"><p>Hi there, I am a Tempo!</p></div> -->
<?php if ( "" !== $notice ) { ?>
    <div class="notice <?php echo esc_attr( $notice_class ); ?> is-dismissible"><p><?php echo esc_html( $notice ); ?></p></div>
<?php } ?>

<div class="mys-section-left">
    <div class="login-page">
		<?php if ( "yes" === $nab_mys_credentials_valid ) { ?>
            <span class="dashicons mys-cred-edit dashicons-edit"></span>
		<?php } ?>
        <div class="mastersettings-title">
            <h2>Provide MYS API Credential</h2>
        </div>
        <div class="wrap highlight-text">
            <p>MapYourShow (MYS) credentials are required to create the bearer token to pull data from the MYS Server to our website. Please enter the details below. If you don't know these credentials, please open a MYS ZenDesk ticket.</p>
        </div>
        <form method="post" action="">
            <input type="hidden" name="mys-cred-nonce" value="<?php echo wp_create_nonce( 'mys-cred-nonce' ) ?>"/>
            <div class="login-inner <?php echo ( "yes" === $nab_mys_credentials_valid ) ? 'show-labels' : ''; ?>">
                <div class="login-row">
                    <strong>User Name</strong>
                    <div class="input-div">
                        <label><?php echo esc_html( $mys_username ); ?></label>
                        <input name="mys_username" type="text" id="blogname" value="<?php echo esc_attr( $mys_username ); ?>" class="regular-text">
                    </div>
                </div>
                <div class="login-row">
                    <strong>Password</strong>
                    <div class="input-div">
                        <label><?php echo "********"; ?></label>
                        <input name="mys_password" type="password" id="blogname" value="<?php echo esc_attr( $mys_password ); ?>" class="regular-text">
                    </div>
                </div>
                <div class="login-row login-sec">
                    <strong></strong>
                    <div class="input-div">
                        <input type="submit" class="button-primary button" id="save_master_settings" value="Submit"/>
                    </div>
                </div>
        </form>
    </div>
</div>

<?php
if ( "1" === get_option( 'nab_mys_show_wizard' ) && "yes" === $nab_mys_credentials_valid ) {
	?>
    <div class="next-bottom-btn">
        <a class="button-primary button" id="nextstep" href="<?php echo esc_url( admin_url( 'admin.php?page=mys-syn' ) ); ?>">Next</a>
    </div>
<?php } ?>
