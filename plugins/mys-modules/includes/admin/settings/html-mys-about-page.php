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

require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/settings/html-mys-header-page.php' );
?>
<div class="mys-section-left about-page">
    <div class="mys-main-table res-cl">
        <div class="about-plugin">
            <div class="mys-head">
                <h2>About This Plugin</h2>
            </div>
            <div class="datails">
                <p>This is a custom plugin built by MultiDots on behalf of NAB Show.</p>
                <p>It was designed to pull the API for Session, Speaker, Track, Sponsor/Partner, Exhibitor and Exhibitor Category data from MapYourShow (MYS), including the creation of associated Gutenberg Blocks and Custom Post Types.</p>
                <p>There are multiple crons set up to run on this site:</p>
                <ul>
                    <li>API to Custom Cron</li>
                    <li>Custom to Master Cron</li>
                    <li>Flush History</li>
                    <li>Reset Plugin</li>
                </ul>
                <hr />
                <i>Version 1.1.1: Initial Plugin Creation</i>
            </div>
        </div>
    </div>
</div>
