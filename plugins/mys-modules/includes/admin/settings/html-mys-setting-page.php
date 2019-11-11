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

//Prevent  unauthorized users
if ( ! current_user_can( 'manage_options' ) ) {
	wp_die( esc_html_e( 'You do not have sufficient permissions to access this page.' ) );
}

$notice = '';

$clear_history_form_nonce = filter_input( INPUT_POST, 'clear_history_form_nonce', FILTER_SANITIZE_STRING );
$reset_plugin_form_nonce  = filter_input( INPUT_POST, 'reset_plugin_form_nonce', FILTER_SANITIZE_STRING );

if ( isset( $clear_history_form_nonce ) && wp_verify_nonce( $clear_history_form_nonce, 'clear_history_form_nonce' ) ) {

	$days = filter_input( INPUT_POST, 'clear_days', FILTER_SANITIZE_STRING );

	if ( 30 < (int) $days ) {
		$notice       = "History can not be cleared within $days days. Please select 30 Days or earlier.";
		$notice_class = 'notice-error';
	} else {

		$history_clear          = $this->nab_mys_db_history_object->nab_mys_history_clear( $days );
		$date_before_given_days = $history_clear['date_before_given_days'];
		$history_clear_status   = $history_clear['history_clear_status'];

		if ( 1 === $history_clear_status ) {
			$notice       = "History cleared of and before $date_before_given_days. Only kept for past $days days.";
			$notice_class = 'notice-success';
		} else {
			$notice       = "No History found $days earlier days.";
			$notice_class = 'notice-warning';
		}
	}

} else if ( isset( $reset_plugin_form_nonce ) && wp_verify_nonce( $reset_plugin_form_nonce, 'reset_plugin_form_nonce' ) ) {

	$reset_plugin = filter_input( INPUT_POST, 'reset_plugin', FILTER_SANITIZE_STRING );

	if ( 'reset' !== $reset_plugin ) {
		$notice       = "Please type in <code>reset</code> correctly.";
		$notice_class = 'notice-error';

	} else {

		$history_reset = $this->nab_mys_db_history_object->nab_mys_history_reset();

		if ( true === $history_reset ) {

			self::nab_mys_plugin_activate();

		} else {

			$notice       = "Plugin can not be resetted now.";
			$notice_class = 'notice-error';
		}
	}
}

$allowed_tags = array( 'code' => array() );

function disallowed_admin_pages() {
	wp_redirect( esc_url( admin_url( 'admin.php?page=mys-login' ) ) );
	exit();
}

add_action( 'admin_init', 'disallowed_admin_pages' );

require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/settings/html-mys-header-page.php' );

?>
<div class="mys-section-left settings-page">
	<div class="mys-main-table res-cl">
		<?php if ( ! empty( $notice ) ) { ?>
			<div class="notice <?php echo esc_attr( $notice_class ); ?> is-dismissible"><p><?php echo wp_kses( $notice, $allowed_tags ); ?></p></div>
		<?php } ?>
		<form method="post" name="clear_history-update" class="clear_history-form">
			<input type="hidden" name="clear_history_form_nonce" value="<?php echo esc_attr( wp_create_nonce( 'clear_history_form_nonce' ) ) ?>"/>
			<h2>Clear history older than 30 days.</h2>
			<div class="clear-history-box">
				<span class="button-primary popup-btn">Clear History</span> <!--button danger-btn-->
				<div class="mys-popup">
					<div class="mys-popup-inner">
						<span class="dashicons dashicons-no"></span>
						<strong>Clear History except past</strong>
						<input name="clear_days" type="number" min="30" value="30">
						<strong>Days</strong>
						<input type="submit" class="button-primary" value="Clear Now"/> <!--button-->
					</div>
				</div>
			</div>
		</form>
		<form method="post" name="reset_plugin-update" class="reset_plugin-form">
			<input type="hidden" name="reset_plugin_form_nonce" value="<?php echo esc_attr( wp_create_nonce( 'reset_plugin_form_nonce' ) ) ?>"/>
			<h2>Danger Zone</h2>
			<div class="clear-history-box">
				<span class="button-primary popup-btn">Reset Plugin</span> <!--button danger-btn-->
				<div class="mys-popup">
					<div class="mys-popup-inner text-left">
						<span class="dashicons dashicons-no"></span>
						<h3>Are you absolutely sure?</h3>
						<p>This action cannot be undone. This will permanently reset all history data and the MYS API Credentials, and will display the setup wizard for this plugin.</p>
						<p>This will not effect any of the Session, Speaker, Track, Sponsor/Partner, Exhibitor and Exhibitor Category data published or unpublished on the site.</p>
						<p>Please type in <code>reset</code> to confirm.</p>
						<input type="text" class="form-control input-block" name="reset_plugin">
						<button type="submit" class="btn btn-block btn-danger">I understand the consequences. Reset this plugin.</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
