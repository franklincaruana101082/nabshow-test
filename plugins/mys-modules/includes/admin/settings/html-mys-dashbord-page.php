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

$setup_success = filter_input( INPUT_GET, 'setup-success', FILTER_SANITIZE_STRING );

if ( isset( $setup_success ) && 'true' === $setup_success ) {
	$pagetitle = "Your Wizard Setup Completed Successfully! Welcome to Dashboard.";
	update_option( 'nab_mys_show_wizard', 0 );
}

//Prevent  unauthorized users
if ( ! current_user_can( 'manage_options' ) ) {
	wp_die( esc_html_e( 'You do not have sufficient permissions to access this page.' ) );
}
require_once( WP_PLUGIN_DIR . '/mys-modules/includes/admin/settings/html-mys-header-page.php' );
?>
<div class="mys-section-left dashboard-page">
    <div class="mys-main-table res-cl">
		<?php if ( isset( $pagetitle ) ) { ?>
            <h1 style='margin-bottom:30px'><?php echo esc_html( $pagetitle ); ?></h1>
		<?php } ?>
        <div class="dashboard-main">
            <div class="dashboard-box">
                <div class="title">
                    <h2>At a Glance</h2>
                </div>
                <div class="inside">
                    <div class="main">
                        <ul>
                            <li class="post-count"><a href="#">7 Speakers</a></li>
                            <li class="page-count"><a href="edit.php?post_type=page">266 Pages</a></li>
                            <li class="page-count"><a href="edit.php?post_type=page">266 Pages</a></li>
                        </ul>
                        <p id="wp-version-message"><span id="wp-version">MYS 5.2.2 running</p>
                        <p><a href="options-reading.php">Search Engines Discouraged</a></p>
                    </div>
                </div>
            </div>
            <div class="dashboard-box">
                <div class="title">
                    <h2>Activity</h2>
                </div>
                <div class="inside">
                    <div id="activity-widget">
                        <div id="published-posts" class="activity-block">
                            <h3>Recently Published</h3>
                            <ul>
                                <li><span>Jul 29th, 7:20 am</span> <a href="#">Group 1</a></li>
                                <li><span>Jul 18th, 6:06 am</span> <a href="#">Group 2</a></li>
                                <li><span>Jul 15th, 6:50 am</span> <a href="#">Group 3</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
