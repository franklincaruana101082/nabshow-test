<?php
/**
 * HTML for Import Exhibitors Page.
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

$success      = filter_input( INPUT_GET, 'success', FILTER_SANITIZE_STRING );
$exh_inserted = filter_input( INPUT_GET, 'exh-inserted', FILTER_SANITIZE_STRING );
$csv_link     = filter_input( INPUT_GET, 'csv-link', FILTER_SANITIZE_STRING );
$msg_style    = "display:none";
$msg_class    = $msg_html = "";
if ( isset ( $success ) ) {
	$msg_style = "display:block";

	if ( 1 === (int) $success ) {
		$msg_class = "highlighted-para";
		$msg_html  = "The file is successfully uploaded <a href='$csv_link' title='Uploaded CSV'>here</a> and total $exh_inserted exhibitors are pulled from the file. The migration process is started now.";

	} else {

		$msg_class = "red-notice mys-error-notice";

		if ( 2 === (int) $success ) {
			$msg_html = 'Sorry, form submitted by robert';
		}
		if ( 3 === (int) $success ) {
			$msg_html = 'Sorry, there was an error uploading your file.';
		}
		if ( 4 === (int) $success ) {
			$msg_html = 'Sorry, the file content is not valid.';
		}

	}
}

$allowed_message_tags = array(
	'a' => array(
		'href'  => array(),
		'title' => array()
	),
);

require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/settings/html-mys-header-page.php' );

?>
<div class="mys-section-left">
	<div class="mys-main-table res-cl">
		<div class="mys-head mys-message-container" style="<?php esc_attr_e( $msg_style ); ?>">
			<p class="<?php esc_attr_e( $msg_class ) ?>"><?php echo wp_kses( $msg_html, $allowed_message_tags ); ?></p>
		</div>
		<div class="mys-head">
			<h2>
				<?php esc_html_e( 'Sync Exhibitors by IDs', 'mys-modules' ); ?>
			</h2>
			<p>Please upload the custom CSV to import Exhibitor by ID.</p>
		</div>
		<form method="post" name="sync_exhibitors" enctype="multipart/form-data" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<?php wp_nonce_field( 'sync_exhibitors_data', 'sync_exhibitors_nonce' ); ?>
			<input type="hidden" name="action" value="import_exhibitors_request">
			<table class="table-outer syn-table">
				<tbody>
				<tr>
					<td class="fr-2">
						<strong>Exhibitors(*)</strong>
					</td>
					<td>
						<input type="file" name="exhibitors-csv">
					</td>
				</tr>
				<tr>
					<td class="pull-data" colspan="2">
						<input type="submit" class="button-primary button import-exhibitors" value="Import">
					</td>
				</tr>
				</tbody>
			</table>
		</form>
	</div>
</div>
