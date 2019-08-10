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

require_once( MYS_PLUGIN_DIR . '/includes/admin/settings/html-mys-header-page.php' );
?>
<div class="mys-section-left about-page">
    <div class="mys-main-table res-cl">
        <div class="about-plugin">
            <div class="mys-head">
                <h2>MYS Plugin Objective</h2>
            </div>
            <div class="datails">
                <p>The objective of MYS Plugin is to cover all the MYS API dependent sections (Modules) of the NABShow site in a single plugin. Using a plugin, it would be reusable in other instances of NAB site. The mobile app can also use the Rest Endpoints of this plugin to fetch the data and in cross platforms.</p>
                <p>If more scalable functionalities are announced, we can release as a new version of the plugin.</p>
            </div>
        </div>
    </div>
</div>