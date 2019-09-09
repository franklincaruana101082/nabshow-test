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
update_option( 'nab_mys_wizard_step', 3 );

$success   = filter_input( INPUT_GET, 'success', FILTER_SANITIZE_STRING );
$csvlink   = filter_input( INPUT_GET, 'csvlink', FILTER_SANITIZE_STRING );
$msg_style = "display:none";
$msg_html  = "";
if ( isset ( $success ) ) {
	$msg_style = "display:block";

	if ( 1 === (int) $success ) {
		$msg_class = "highlighted-para";
		$msg_html  = "The file is successfully uploaded <a href='$csvlink'>here</a> and the exhibitor's migration process is started now, please check your inbox soon.";

	} else {

		$msg_class = "red-notice mys-error-notice";

		if ( 2 === (int) $success ) {
			$msg_html = 'Sorry, form submit by robert';
		}
		if ( 3 === (int) $success ) {
			$msg_html = 'Sorry, there was an error uploading your file.';
		}
		if ( 4 === (int) $success ) {
			$msg_html = 'Sorry, the file content is not valid.';
		}

	}

	$allowed_tags = array(
		'a' => array(
			'href' => array()
		),
	);
}

require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/settings/html-mys-header-page.php' );

?>
<div class="mys-process-bar">
	<span class="process"></span>
</div>
<div id="progress-percent-outer">
	<strong>Process (<span id="progress-percent">0%</span>)</strong>
</div>
<div class="mys-section-left">
	<div class="mys-main-table res-cl">
		<div class="mys-head mys-message-container" style="<?php echo esc_attr( $msg_style ); ?>">
			<p class="<?php echo esc_attr( $msg_class ) ?>"><?php echo wp_kses( $msg_html , $allowed_tags ); ?></p>
		</div>
		<div class="mys-head">
			<h2>
				<?php esc_html_e( 'Sync Exhibitors', 'mys-modules' ); ?>
			</h2>
			<p>There is no exhibitor data on the website yet. Please upload the custom CSV report from MYS and click the pull button to pull in the latest Exhibitor and Exhibitor Category data from the API.</p>
		</div>
		<form method="post" name="sync_exhibitors" enctype="multipart/form-data" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<?php wp_nonce_field( 'sync_exhibitors_data', 'sync_exhibitors_nonce' ); ?>
			<input type="hidden" name="action" value="sync_exhibitors_request">
			<table class="table-outer syn-table">
				<tbody>
				<tr>
					<td class="fr-2">
						<strong>Exhibitors</strong>
					</td>
					<td>
						<input type="file" name="exhibitors-csv">
					</td>
				</tr>
				<tr>
					<td class="pull-data" colspan="2">
						<input type="submit" class="button-primary button import-exhibitors" vale="Import">
					</td>
				</tr>
				<tr>
					<td class="fr-2">
						<strong>Exhibitor Categories</strong>
					</td>
					<td>
						<p>Exhibitor Categories from MYS.</p>
					</td>
				</tr>
				<tr>
					<td class="pull-data" colspan="2">
						<span class="button-primary button">Pull</span>
					</td>
				</tr>
				</tbody>
			</table>
		</form>
	</div>
</div>
<?php if ( "1" === get_option( 'nab_mys_show_wizard' ) ) {
	?>
	<div class="next-bottom-btn">
		<a class="button-primary button" id="nextstep" href="<?php echo esc_url( admin_url( 'admin.php?page=mys-dashboard&setup-success=true' ) ); ?>">Finish</a>
	</div>
<?php } ?>
