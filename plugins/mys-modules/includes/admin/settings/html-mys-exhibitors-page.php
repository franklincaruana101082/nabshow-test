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
update_option('nab_mys_wizard_step', 3);

require_once( MYS_PLUGIN_DIR . '/includes/admin/settings/html-mys-header-page.php' );
?>
<div class="mys-process-bar">
    <span class="process"></span>
    <strong>Process (<span id="progress-percent">0%</span>)</strong>
</div>
<div class="mys-section-left">
    <div class="mys-main-table res-cl">
        <div class="mys-head">
            <h2>
                <?php esc_html_e( 'Sync Exhibitors', 'mys-modules' ); ?>
            </h2>
            <p>There is no exhibitor data on the website yet. Please upload the custom CSV report from MYS and click the pull button to pull in the latest Exhibitor and Exhibitor Category data from the API.</p>
        </div>
        <table class="table-outer syn-table">
            <tbody>
                <tr>
                    <td class="fr-2">
                        <strong>Exhibitors</strong>
                    </td>
                    <td>
                        <input type="file" name="">
                    </td>
                </tr>
                <tr>
                    <td class="pull-data" colspan="2">
                        <span class="button-primary button">Import</span>
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
    </div>
</div>
<?php if( "1" === get_option('nab_mys_show_wizard') ) {
	?>
    <div class="next-bottom-btn">
        <a class="button-primary button" id="nextstep" href="<?php echo esc_url(admin_url( 'admin.php?page=mys-dashboard&setup-success=true' )); ?>">Finish</a>
    </div>
<?php } ?>
