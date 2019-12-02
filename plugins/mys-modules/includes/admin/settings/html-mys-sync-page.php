<?php
/**
 * HTML for Sync Page.
 *
 * @package MYS Modules
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

//Prevent  unauthorized users
if ( ! current_user_can( 'manage_options' ) ) {
	wp_die( esc_html__( 'You do not have sufficient permissions to access this page.' ) );
}

$reset_sequence = filter_input( INPUT_GET, 'reset_sequence', FILTER_SANITIZE_STRING );
if ( isset( $reset_sequence ) && "yes" === $reset_sequence ) {

	$this->nab_mys_db_cron_object->nab_mys_static_reset_sequence();

	echo "<p style='color:green;font-weight:700'>Resetting sequence is successful. (forced fail).</p>";

}

if ( "1" === get_option( 'mys_login_form_success' ) ) {
	$logged_in = 1;
	$msg_style = "display:none";
	$error_msg = "";
} else {
	$logged_in = 0;
	$msg_style = "display:block";
	$error_msg = "Please <a href='" . esc_url( admin_url( 'admin.php?page=mys-login' ) ) . "'>click here</a> to complete the login first.";
}

update_option( 'nab_mys_wizard_step', 2 );

require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/settings/html-mys-header-page.php' );
?>


<div class="mys-process-bar">
	<span class="process"></span>
</div>
<div id="progress-percent-outer">
	<strong>Process (<span id="progress-percent">0%</span>)</strong>
</div>
<div class="mys-section-left">
	<div id="mys-sync-wrapper" class="mys-main-table res-cl">
		<div class="mys-head mys-message-container" style="<?php esc_attr_e( $msg_style ); ?>">
			<p class="red-notice mys-error-notice"><?php echo wp_kses( $error_msg, array( 'a' => array( 'href' => array() ) ) ); ?></p>
		</div>
		<div class="mys-head">
			<?php
			if ( "1" === get_option( 'nab_mys_show_wizard' ) ) { ?>
				<h2>Sync Sessions</h2>
				<p>There is no session data from MYS on our website yet.</p>
				<p>Please click the pull button to pull in the latest Session, Speaker, Track and Sponsor/Partner data from the API.</p>
				<i>Note: This section can be skipped.</i>
			<?php } else { ?>
				<h2>Sync Sessions and Exhibitors</h2>
				<p>Use the buttons below to pull in the latest Session and Exhibitor data from the API.</p>
			<?php } ?>
		</div>
		<table class="table-outer syn-table">
			<tbody>
			<tr>
				<td class="fr-1">
					<strong>Sessions</strong>
				</td>
				<td>
					<div>
						<p>Fetch Sessions, Speakers, Tracks and Sponsors/Partners from MYS.</p>
					</div>
				</td>
			</tr>
			<tr>
				<td class="pull-data" colspan="2">
					<span class="button-primary button pull-sessions button-sync" data-sync="sponsors">Pull & Sync</span>
				</td>
			</tr>
			<?php if ( "0" === get_option( 'nab_mys_show_wizard' ) ) { ?>
				<tr>
					<td class="fr-1">
						<strong>Exhibitors</strong>
					</td>
					<td>
						<p>Fetch Exhibitors from MYS.</p>
					</td>
				</tr>
				<tr>
					<td class="pull-data" colspan="2">
						<span class="button-primary button button-sync-exhibitors button-sync" data-sync="exhibitors">Pull & Sync</span>
					</td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<?php if ( "1" === get_option( 'nab_mys_show_wizard' ) ) {
	?>
	<div class="next-bottom-btn">
		<a class="button-primary button" style="display:none" href="<?php echo esc_url( admin_url( 'admin.php?page=mys-exhibitors' ) ); ?>">Next</a>
		<br><a class="button-primary button" href="<?php echo esc_url( admin_url( 'admin.php?page=mys-exhibitors' ) ); ?>">skip</a>
	</div>
<?php } ?>
