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
	wp_die( esc_html(__( 'You do not have sufficient permissions to access this page.' )) );
}
update_option( 'nab_mys_wizard_step', 2 );

require_once( MYS_PLUGIN_DIR . '/includes/admin/settings/html-mys-header-page.php' );

	$pagetitle = ("1" === get_option( 'nab_mys_show_wizard' )) ? "Welcome Valerie, Its a Big Bang Moment!" : "MYS Sync";
?>


<div class="mys-process-bar">
    <span class="process"></span>
    <strong>Process (<span id="progress-percent">0%</span>)</strong>
</div>
<div class="mys-section-left">
    <div id="mys-sync-wrapper" class="mys-main-table res-cl">
        <div class="mys-head mys-message-container" style="display: none"></div>
        <div class="mys-head">
            <h2><?php echo esc_html($pagetitle); ?></h2>
            <p>There is no data synced from MYS yet, please click pull button to start syncing.</p>
            <p>Click pull button will pull Sessions, Tracks, Sponsors, Speakers from MYS Server and start syncing to out database.</p>
            <p>On a successful sync, you will get a notifying email about the status of Sync process.</p>
        </div>
        <table class="table-outer syn-table">
            <tbody>
            <tr>
                <td class="fr-1">
                    <strong>Sessions</strong>
                </td>
                <td>
                    <div>
                        <span>Fetch from MYS</span>
                        <input type="hidden" name="syncSessions" id="syncSessions" value="yes" />
                    </div>
                </td>
            </tr>
            <tr>
                <td class="pull-data" colspan="2">
                    <span class="button-primary button pull-sessions button-sync" data-sync="sessions">Pull</span>
                </td>
            </tr>
			<?php if ( "0" === get_option( 'nab_mys_show_wizard' ) ) { ?>
                <tr>
                    <td class="fr-1">
                        <strong>Exhibitors</strong>
                    </td>
                    <td>
                        <input type="file" name="">
                    </td>
                </tr>
                <tr>
                    <td class="import-data" colspan="2">
                        <span class="button-primary button import-exhibitors">Import</span>
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
        <a class="button-primary button" id="nextstep" href="<?php echo esc_url(admin_url( 'admin.php?page=mys-exhibitors' )); ?>">Next</a>
    </div>
<?php } ?>
