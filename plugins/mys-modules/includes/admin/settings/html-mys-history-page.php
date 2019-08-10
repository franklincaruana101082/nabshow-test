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
<div class="mys-section-left history-page">
    <div class="mys-main-table res-cl ">
    	<h2>History</h2>
        <div class="tablenav top history-tablenav">
            <div class="alignleft actions">
                <input type="date">
                <input type="date">
                <select>
                    <option value="">Status</option>
                    <option value="">Status 2</option>
                    <option value="">Status 3</option>
                </select>
                <input type="submit" name="filter_action" class="button" value="Filter">
            </div>
            <h2 class="screen-reader-text">Pages list navigation</h2>
            <div class="tablenav-pages"><span class="displaying-num">272 items</span>
                <span class="pagination-links"><span class="tablenav-pages-navspan button disabled" aria-hidden="true">«</span>
                    <span class="tablenav-pages-navspan button disabled" aria-hidden="true">‹</span>
                    <span class="paging-input"><label for="current-page-selector" class="screen-reader-text">Current Page</label><input class="current-page" id="current-page-selector" type="text" name="paged" value="1" size="2" aria-describedby="table-paging"><span class="tablenav-paging-text"> of <span class="total-pages">14</span></span></span>
                    <a class="next-page button" href="#"><span class="screen-reader-text">Next page</span><span aria-hidden="true">›</span></a>
                    <a class="last-page button" href="#"><span class="screen-reader-text">Last page</span><span aria-hidden="true">»</span></a></span></div>
            <br class="clear">
        </div>
        <table class="table-outer syn-table history-table">
            <thead>
                <tr>
                    <th class="checkbox-row"><input type="checkbox"></th>
                    <th class="heading">Title</th>
                    <th class="details-row">Details</th>
                    <th class="user-row">User</th>
                    <th class="start-row">Start Time</th>
                    <th class="end-row">End Time</th>
                    <th class="status-row">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="checkbox-row"><input type="checkbox"></td>
                    <td class="heading"><a href="#">Group 1</a></td>
                    <td class="details-row">22 Session, 18 Exhibitors, 33 Speakers</td>
                    <td class="user-row">Admin</td>
                    <td class="start-row">01:15:30 05 July 2019</td>
                    <td class="end-row">01:16:45 05 July 2019</td>
                    <td class="status-row">Success</td>
                </tr>
                <tr>
                    <td class="checkbox-row"><input type="checkbox"></td>
                    <td class="heading"><a href="#">Group 2</a></td>
                    <td class="details-row">22 Session, 18 Exhibitors, 33 Speakers</td>
                    <td class="user-row">Mayur</td>
                    <td class="start-row">01:15:30 05 July 2019</td>
                    <td class="end-row">01:16:45 05 July 2019</td>
                    <td class="status-row">Fail</td>
                </tr>
                <tr>
                    <td class="checkbox-row"><input type="checkbox"></td>
                    <td class="heading"><a href="#">Group 3</a></td>
                    <td class="details-row">22 Session, 18 Exhibitors, 33 Speakers</td>
                    <td class="user-row">Admin</td>
                    <td class="start-row">01:15:30 05 July 2019</td>
                    <td class="end-row">01:16:45 05 July 2019</td>
                    <td class="status-row">Success</td>
                </tr>
                <tr>
                    <td class="checkbox-row"><input type="checkbox"></td>
                    <td class="heading"><a href="#">Group 4</a></td>
                    <td class="details-row">22 Session, 18 Exhibitors, 33 Speakers</td>
                    <td class="user-row">Faizal</td>
                    <td class="start-row">01:15:30 05 July 2019</td>
                    <td class="end-row">01:16:45 05 July 2019</td>
                    <td class="status-row">Success</td>
                </tr>
            </tbody>
        </table>
        <!-- <div class="mys-dashboard">
            <img src="http://nabshow.md-staging.com/wp-content/uploads/2019/07/mys-History.png">
        </div> -->
    </div>
</div>