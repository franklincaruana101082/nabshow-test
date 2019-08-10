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
    wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
}
update_option('nab_mys_wizard_step', 3);

require_once( MYS_PLUGIN_DIR . '/includes/admin/settings/html-mys-header-page.php' );
?>
<div class="mys-section-left">
    <div class="mys-main-table res-cl">
        <div class="mys-head">
            <h2>
                <?php _e( 'Sync Exhibitors', 'mys-modules' ); ?>
            </h2>
            <p>There is no Exhibitors data in the website yet, please upload CSV and click Pull button to start importing.</p>
        </div>
        <table class="table-outer syn-table">
            <tbody>
                <tr>
                    <td class="fr-1">
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
            </tbody>
        </table>
    </div>
</div>
<?php if( "1" === get_option('nab_mys_show_wizard') ) {
	?>
    <div class="next-bottom-btn">
        <a class="button-primary button" id="nextstep" href="<?php echo admin_url( 'admin.php?page=mys-dashboard&setup-success=true' ); ?>">Finish</a>
        <br><a id="nextstep" class="skip" href="<?php echo admin_url( 'admin.php?page=mys-dashboard&setup-success=true' ); ?>">skip</a>
    </div>
<?php } ?>
