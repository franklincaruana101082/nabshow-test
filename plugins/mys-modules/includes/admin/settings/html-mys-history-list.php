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

if ( 0 === MYS_PLUGIN_DUMMY_HISTORY ) {
	?>
	<div class="mys-section-left history-page">
		<div class="mys-main-table res-cl ">
			<h2>History</h2>
			<div class="tablenav top history-tablenav">
				<div class="alignleft actions">
					<input type="date">
					<input type="date">
					<select>
						<option value="">In Progress</option>
						<option value="">Success</option>
						<option value="">Failed</option>
					</select>
					<input type="submit" name="filter_action" class="button" value="Filter">
				</div>
				<h2 class="screen-reader-text">Pages list navigation</h2>
				<div class="tablenav-pages"><span class="displaying-num"><?php echo esc_html( $history_total ); ?> items</span>
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
					<th class="num">#</th>
					<th class="groupid">Group ID</th>
					<th class="heading">Title</th>
					<th class="details-row">Details</th>
					<th class="user-row">User</th>
					<th class="start-row">Start Time</th>
					<th class="end-row">End Time</th>
					<th class="status-row">Status</th>
				</tr>
				</thead>
				<tbody>
				<?php

				$history_result = $this->nab_mys_db_history_object->nab_mys_history_list( 10 );

				$history_data  = $history_result['history_data'];
				$history_total = $history_result['history_total'];

				$allowed_tags = array(
					'br'   => array(),
					'a' => array( 'href' => array() ),
					'i'    => array( 'class' => array(), 'style' => array() ),
				);

				foreach ( $history_data as $groupid => $single_history_data ) {

					$count ++;

					$detail_history_url = admin_url( 'admin.php?page=mys-history&groupid=' . $groupid );

					$single_history = $single_history_data['Details'];
					$item_totals    = $single_history_data['Totals'];

					$heading = $single_history->HistoryDataType;
					$heading = strpos( $heading, 'sessions' ) !== false ? 'Sessions' : 'Exhibitors';

					$start_date = $single_history->HistoryStartTime;
					$start_date = date( 'g:i:s A F j, Y', strtotime( $start_date ) );

					$end_date = $single_history->HistoryEndTime;
					$end_date = date( 'g:i:s A F j, Y', strtotime( $end_date ) );

					$h_status = $single_history->HistoryStatus;
					$d_status = $single_history->AddedStatus;

					$userid = (int) $single_history->HistoryUser;
					if ( 0 === $userid ) {
						$user_name = 'CRON';
					} else {
						$user_info = get_userdata( $userid );
						$user_name = $user_info->display_name;
					}

					$string_of_totals = array();
					foreach ( $item_totals as $item_name => $single_total ) {

						if ( 'modified-exhibitors' === $item_name ) {
							$item_name = 'Exhibitors';
							if ( 0 === (int) $single_total ) {
								continue;
							}
						} else if ( 'modified-sessions' === $item_name ) {
							continue;
						} else if ( 'modified-exhibitors-csv' === $item_name ) {

							$csv_link = get_option( "exhibitors-csv-$groupid" );

							$item_name = "Exhibitors (via <a href='$csv_link'>CSV file</a>)";
						}
						$item_name               = ucwords( $item_name );

						if ( 1 === (int) $single_total ) {
							$item_name = rtrim( $item_name, 's' );
						}

						$string_of_totals[] = "$single_total $item_name";
					}
					if ( 0 === count( $string_of_totals ) ) {

						$string_of_totals = 1 === (int) $h_status ? 'Everything was upto date.' : 'No items found.';

					} else {
						$string_of_totals = implode(', ', $string_of_totals);
					}

					switch ( $h_status ) {

						case 1:
							$h_status  = "<i class='fas fa-check' style='color:#008000'></i> Pull Success<br>";
							$row_class = 'status-success pull-success';

							switch ( $d_status ) {

								case 1:
								case null:
									$h_status  .= "<i class='fas fa-check-double' style='color:#008000'></i> Sync Success";
									$row_class .= ' sync-success';
									break;
								case 0:
								case 3:
									$h_status  .= "<i class='fas fa-sync fa-spin'></i> Sync In Progress";
									$row_class .= ' sync-in-progress';
									break;
								case 4:
									$h_status  .= "<i class='fas fa-times' style='color:#ff0000'></i> Sync Force Stopped";
									$row_class .= ' status-force-failed';
									break;
							}
							break;

						case 0:
							$h_status  = "<i class='fas fa-sync fa-spin'></i><br>Pull In Progress";
							$row_class = 'status-in-progress pull-in-progress';
							break;

						case 2:
							$h_status  = "<i class='fas fa-times' style='color:#ff0000'></i>Pull Failed";
							$row_class = 'status-failed pull-failed';
							break;

						case 4:
							$h_status  = "<i class='fas fa-times' style='color:#ff0000'></i><br>Pull Force Failed";
							$row_class = 'status-force-failed pull-failed';
							break;
					}
					?>
					<tr class="<?php echo esc_attr( $row_class ); ?>">
						<td class="num"><?php echo esc_html( $count ); ?></td>
						<td class="groupid"><a href="<?php echo esc_url($detail_history_url) ?>"><?php echo esc_html( $groupid ); ?></a></td>
						<td class="heading"><a href="<?php echo esc_url($detail_history_url) ?>"><?php echo esc_html( $heading ); ?></a></td>
						<td class="details-row"><?php echo wp_kses( $string_of_totals, $allowed_tags ); ?></td>
						<td class="user-row"><?php echo esc_html( $user_name ); ?></td>
						<td class="start-row"><?php echo esc_html( $start_date ); ?></td>
						<td class="end-row"><?php echo esc_html( $end_date ); ?></td>
						<td class="status-row"><?php echo wp_kses( $h_status, $allowed_tags ); ?></td>
					</tr>
				<?php } ?>

				</tbody>
			</table>
			<!-- <div class="mys-dashboard">
				<img src="http://nabshow.md-staging.com/wp-content/uploads/2019/07/mys-History.png">
			</div> -->
		</div>
	</div>

<?php } else { ?>

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

<?php } ?>
