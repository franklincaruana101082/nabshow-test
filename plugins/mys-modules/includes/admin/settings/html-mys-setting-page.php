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
require_once( MYS_PLUGIN_DIR . '/includes/admin/settings/html-mys-header-page.php' );
?>
<div class="mys-section-left settings-page">
    <div class="mys-main-table res-cl">
        <h2>Clear history older than 30 days.</h2>
        <div class="clear-history-box">
            <span class="button-primary button danger-btn popup-btn">Clear History</span>
            <div class="mys-popup">
                <div class="mys-popup-inner">
                    <span class="dashicons dashicons-no"></span>
                    <strong>Clear History except past</strong>
                    <input type="number" min="30" value="30">
                    <strong>Days</strong>
                    <span class="button-primary button">Save</span>
                    <span class="button-primary button reset">Reset</span>
                </div>
            </div>
        </div>
        <h2>Danger Zone</h2>
        <div class="clear-history-box">
            <span class="button-primary button danger-btn popup-btn">Reset Plugin</span>
            <div class="mys-popup">
                <div class="mys-popup-inner text-left">
                    <span class="dashicons dashicons-no"></span>
                    <h3>Are you absolutely sure?</h3>
                    <p>This action cannot be undone. This will permanently reset all history data and the MYS API Credentials, and will display the setup wizard for this plugin.</p>
                    <p>This will not effect any of the Session, Speaker, Track, Sponsor/Partner, Exhibitor and Exhibitor Category data published or unpublished on the site.</p>
                    <p>Please type in <code>reset</code> to confirm.</p>
                    <input type="text" class="form-control input-block" autofocus="" required="" name="verify">
                    <button type="submit" class="btn btn-block btn-danger" data-disable-invalid="" disabled="">I understand the consequences. Reset this plugin.</button>
                </div>
            </div>
        </div>
    </div>
</div>