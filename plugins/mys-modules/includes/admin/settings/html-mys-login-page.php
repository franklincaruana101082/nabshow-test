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

$resetmys = filter_input( INPUT_GET, 'resetmys', FILTER_SANITIZE_STRING );

if ( isset( $resetmys ) && "1" === $resetmys ) {
	update_option( 'nab_mys_show_wizard', "1" );
	delete_transient( 'nab_mys_token' );
	delete_option( 'mys_login_form_success' );
}

//Prevent  unauthorized users
if ( ! current_user_can( 'manage_options' ) ) {
	wp_die( esc_html_e( 'You do not have sufficient permissions to access this page.' ) );
}

update_option( 'nab_mys_wizard_step', 1 );

$nab_mys_show_wizard = get_option( 'nab_mys_show_wizard' );

require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/settings/html-mys-header-page.php' );

$notice = '';

$mys_login_form_nonce = filter_input( INPUT_POST, 'mys_login_form_nonce', FILTER_SANITIZE_STRING );

if ( isset( $mys_login_form_nonce ) && wp_verify_nonce( $mys_login_form_nonce, 'mys_login_form_nonce' ) ) {

	$mys_username = filter_input( INPUT_POST, 'mys_username', FILTER_SANITIZE_STRING );
	$mys_password = filter_input( INPUT_POST, 'mys_password', FILTER_SANITIZE_STRING );


	$datepicker              = filter_input( INPUT_POST, 'datepicker', FILTER_SANITIZE_STRING );
	$show_code               = filter_input( INPUT_POST, 'show_code', FILTER_SANITIZE_STRING );
	$main_url                = filter_input( INPUT_POST, 'main_url', FILTER_SANITIZE_STRING );
	$modified_sessions_url   = filter_input( INPUT_POST, 'modified_sessions_url', FILTER_SANITIZE_STRING );
	$sessions_url            = filter_input( INPUT_POST, 'sessions_url', FILTER_SANITIZE_STRING );
	$tracks_url              = filter_input( INPUT_POST, 'tracks_url', FILTER_SANITIZE_STRING );
	$sponsors_url            = filter_input( INPUT_POST, 'sponsors_url', FILTER_SANITIZE_STRING );
	$speakers_url            = filter_input( INPUT_POST, 'speakers_url', FILTER_SANITIZE_STRING );
	$exhibitors_url          = filter_input( INPUT_POST, 'exhibitors_url', FILTER_SANITIZE_STRING );
	$exhibitors_category_url = filter_input( INPUT_POST, 'exhibitors_category_url', FILTER_SANITIZE_STRING );

	$nab_mys_urls                            = array();
	$nab_mys_urls['datepicker']              = $datepicker;
	$nab_mys_urls['show_code']               = $show_code;
	$nab_mys_urls['main_url']                = $main_url;
	$nab_mys_urls['modified_sessions_url']   = $modified_sessions_url;
	$nab_mys_urls['sessions_url']            = $sessions_url;
	$nab_mys_urls['tracks_url']              = $tracks_url;
	$nab_mys_urls['sponsors_url']            = $sponsors_url;
	$nab_mys_urls['speakers_url']            = $speakers_url;
	$nab_mys_urls['exhibitors_url']          = $exhibitors_url;
	$nab_mys_urls['exhibitors_category_url'] = $exhibitors_category_url;

	if (
		empty( $mys_username )
		|| empty( $mys_password )
		|| empty( $datepicker )
		|| empty( $show_code )
		|| empty( $main_url )
		|| empty( $modified_sessions_url )
		|| empty( $sessions_url )
		|| empty( $tracks_url )
		|| empty( $sponsors_url )
		|| empty( $exhibitors_url )
		|| empty( $exhibitors_category_url )

	) {

		$notice_class           = "notice-error";
		$notice                 = "All fields are mandatory.";
		$mys_login_form_success = 0;

	} else {

		update_option( 'nab_mys_credentials_u', $mys_username );
		update_option( 'nab_mys_credentials_p', $mys_password );
		$nab_mys_urls = update_option( 'nab_mys_urls', $nab_mys_urls );

		delete_transient( 'nab_mys_token' );
		$result = $this->nab_mys_sync_parent_object->nab_mys_api_token_from_cache();

		$token_status_code = $result['token_status_code'];
		$token_response    = $result['token_response'];

		if ( 200 === $token_status_code ) {
			$notice_class = "notice-success";
			$notice       = "Authentication Successful.";
			if ( "1" === $nab_mys_show_wizard ) {
				$notice .= ' Please click NEXT button to continue.';
			}
			update_option( 'mys_login_form_success', 1 );
			$mys_login_form_success = 1;
		} else {
			$notice_class = "notice-error";
			$notice       = $token_status_code . ": " . $token_response;
			update_option( 'mys_login_form_success', 0 );
			$mys_login_form_success = 0;
		}
	}


} else {
	$mys_username           = get_option( 'nab_mys_credentials_u' );
	$mys_password           = get_option( 'nab_mys_credentials_p' );
	$mys_login_form_success = (int) get_option( 'mys_login_form_success' );

	$nab_mys_urls = get_option( 'nab_mys_urls' );

	$datepicker              = isset ( $nab_mys_urls['datepicker'] ) ? $nab_mys_urls['datepicker'] : '';
	$show_code               = isset ( $nab_mys_urls['show_code'] ) ? $nab_mys_urls['show_code'] : 'nab19';
	$main_url                = isset ( $nab_mys_urls['main_url'] ) ? $nab_mys_urls['main_url'] : 'https://api.mapyourshow.com/mysRest/v2';
	$modified_sessions_url   = isset ( $nab_mys_urls['modified_sessions_url'] ) ? $nab_mys_urls['modified_sessions_url'] : '/Sessions/Modified';
	$sessions_url            = isset ( $nab_mys_urls['sessions_url'] ) ? $nab_mys_urls['sessions_url'] : '/Sessions/List';
	$tracks_url              = isset ( $nab_mys_urls['tracks_url'] ) ? $nab_mys_urls['tracks_url'] : '/Sessions/Tracks';
	$sponsors_url            = isset ( $nab_mys_urls['sponsors_url'] ) ? $nab_mys_urls['sponsors_url'] : '/Sessions/Sponsors';
	$speakers_url            = isset ( $nab_mys_urls['speakers_url'] ) ? $nab_mys_urls['speakers_url'] : '/Sessions/Speakers';
	$exhibitors_url          = isset ( $nab_mys_urls['exhibitors_url'] ) ? $nab_mys_urls['exhibitors_url'] : '/Exhibitors/Modified';
	$exhibitors_category_url = isset ( $nab_mys_urls['exhibitors_category_url'] ) ? $nab_mys_urls['exhibitors_category_url'] : '/Categories';
}
?>
<?php if ( ! empty( $notice ) ) { ?>
	<div class="notice <?php echo esc_attr( $notice_class ); ?> is-dismissible"><p><?php echo esc_html( $notice ); ?></p></div>
<?php } ?>

<div class="mys-login-outer">
	<form method="post" name="mys-url-update" class="login-inner-form">
		<input type="hidden" name="mys_login_form_nonce" value="<?php echo esc_attr( wp_create_nonce( 'mys_login_form_nonce' ) ) ?>"/>
		<div class="dashboard-box">
			<div class="mys-head">
				<h2>MYS API URLs</h2>
			</div>
			<div class="inside">
				<div class="main">
					<div class="mys-urls-inner">
						<div class="mys-url">
							<label for="main_url">Main URL</label>
							<input type="text" name="main_url" value="<?php echo esc_url( $main_url ); ?>" placeholder="https://api.mapyourshow.com/mysRest/v2"/>
						</div>
						<div class="mys-url">
							<label for="show_code">Show Code</label>
							<input type="text" name="show_code" value="<?php echo esc_attr( $show_code ); ?>" placeholder="nabny19"/>
						</div>
						<div class="mys-url">
							<label for="datepicker">Start Syncing Data from</label>
							<input type="text" name="datepicker" id="datepicker" placeholder="MM-DD-20XX" value="<?php echo esc_attr( $datepicker ); ?>"/>
						</div>
						<div class=" mys-url">
							<label for="modified_sessions_url">Modified Sessions</label>
							<input type="text" name="modified_sessions_url" value="<?php echo esc_attr( $modified_sessions_url ); ?>" placeholder=""/>
						</div>
						<div class="mys-url">
							<label for="sessions_url">Sessions</label>
							<input type="text" name="sessions_url" value="<?php echo esc_attr( $sessions_url ); ?>"/>
						</div>
						<div class="mys-url">
							<label for="tracks_url">Tracks</label>
							<input type="text" name="tracks_url" value="<?php echo esc_attr( $tracks_url ); ?>"/>
						</div>
						<div class="mys-url">
							<label for="speakers_url">Speakers</label>
							<input type="text" name="speakers_url" value="<?php echo esc_attr( $speakers_url ); ?>"/>
						</div>
						<div class="mys-url">
							<label for="sponsors_url">Sponsors</label>
							<input type="text" name="sponsors_url" value="<?php echo esc_attr( $sponsors_url ); ?>"/>
						</div>
						<div class="mys-url">
							<label for="exhibitors_url">Modified Exhibitors</label>
							<input type="text" name="exhibitors_url" value="<?php echo esc_attr( $exhibitors_url ); ?>"/>
						</div>
						<div class="mys-url">
							<label for="exhibitors_category_url">Exhibitors Category</label>
							<input type="text" name="exhibitors_category_url" value="<?php echo esc_attr( $exhibitors_category_url ); ?>"/>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="login-page">
			<?php if ( 1 === $mys_login_form_success ) { ?>
				<span class="dashicons mys-cred-edit dashicons-edit"></span>
			<?php } ?>
			<div class="mastersettings-title">
				<h2>Provide MYS API Credentials</h2>
			</div>
			<div class="wrap highlight-text">
				<p>MapYourShow (MYS) credentials are required to create the bearer token to pull data from the MYS Server to our website. Please enter the details below. If you don't know these credentials, please open a MYS ZenDesk ticket.</p>
				<p>Please enter the MYS API URLs in the right side form. This is required to submit MYS Credentials.</p>
			</div>
			<div class="show-hide-fields login-inner <?php echo ( 1 === $mys_login_form_success ) ? 'show-labels' : ''; ?>">
				<div class="login-row">
					<strong>User Name</strong>
					<div class="input-div">
						<label><?php echo esc_html( $mys_username ); ?></label>
						<input name="mys_username" type="text" value="<?php echo esc_attr( $mys_username ); ?>" class="regular-text">
					</div>
				</div>
				<div class="login-row">
					<strong>Password</strong>
					<div class="input-div">
						<label><?php if ( $mys_password ) {
								echo "********";
							} ?></label>
						<input name="mys_password" type="password" value="<?php echo esc_attr( $mys_password ); ?>" class="regular-text">
					</div>
				</div>
			</div>
		</div>
		<div class="next-bottom-btn">
			<input type="submit" class="button button-primary" id="nextstep" value="Submit"/> <!--class='submit-mys-login'-->
			<?php if ( "1" === $nab_mys_show_wizard && 1 === $mys_login_form_success ) { ?>
				<a class="button-primary button" href="<?php echo esc_url( admin_url( 'admin.php?page=mys-sync' ) ); ?>">Next</a> <!--id="nextstep"-->
			<?php } ?>
		</div>
	</form>
</div>
