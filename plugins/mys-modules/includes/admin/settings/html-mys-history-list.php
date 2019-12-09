<?php
/**
 * HTML for History List Page.
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

$request_data = $this->request_data;
$allowed_tags = $this->allowed_tags;
$sorting_data = $this->sorting_data;
$history_data = $this->history_data;
?>

<table class="wp-list-table widefat striped pages"> <!--table-outer syn-table history-table-->
	<thead>
	<tr>
		<th class="num">#</th>
		<th class="groupid">Group ID</th>
		<th class="heading <?php esc_attr_e( $sorting_data['datatype_row_class'] ); ?>">
			<?php echo wp_kses( $sorting_data['history_datatype_row_html'], $allowed_tags ) ?>
		</th>
		<th class="details-row">Details</th>
		<th class="user-row <?php esc_attr_e( $sorting_data['user_row_class'] ); ?>">
			<?php echo wp_kses( $sorting_data['user_row_html'], $allowed_tags ) ?>
		</th>
		<th class="start-row <?php esc_attr_e( $sorting_data['start_row_class'] ); ?>">
			<?php echo wp_kses( $sorting_data['start_row_html'], $allowed_tags ) ?>
		</th>
		<th class="end-row">End Time</th>
		<th class="status-row">Status</th>
	</tr>
	</thead>
	<tbody>
	<?php

	if ( 0 === count( $history_data ) ) {
		echo "<td colspan='8' class='nothing-found'>No history found.</td>";
	}

	$offset = $request_data['offset'];

	foreach ( $history_data as $groupid => $single_history_data ) {

		$offset ++;


		$single_history = $single_history_data['Details'];
		$item_totals    = $single_history_data['Totals'];

		$heading = $single_history->HistoryDataType;
		$heading = strpos( $heading, 'sessions' ) !== false ? 'Sessions' : 'Exhibitors';

		$start_date = $single_history->HistoryStartTime;
		$start_date = date( 'g:i:s A F j, Y', strtotime( $start_date ) );

		$end_date = $single_history->HistoryEndTime;
		$end_date = date( 'g:i:s A F j, Y', strtotime( $end_date ) );

		$h_status = $single_history->HistoryStatus;

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
			$item_name = ucwords( $item_name );

			if ( 1 === (int) $single_total ) {
				$item_name = rtrim( $item_name, 's' );
			}

			$string_of_totals[] = "$single_total $item_name";
		}

		$detail_history_url = admin_url( 'admin.php?page=mys-history&groupid=' . $groupid . '&timeorder=asc' );

		if ( 0 === count( $string_of_totals ) ) {

			$string_of_totals = 5 === (int) $h_status ? 'Everything was upto date.' : 'No items found.';

			$detail_history_url_groupid = $groupid;
			$detail_history_url_heading = $heading;
		} else {
			$string_of_totals = implode( ', ', $string_of_totals );

			$detail_history_url_groupid = "<a href='" . esc_url( $detail_history_url ) . "'>" . esc_html( $groupid ) . "</a>";
			$detail_history_url_heading = "<a href='" . esc_url( $detail_history_url ) . "'>" . esc_html( $heading ) . "</a>";
		}

		switch ( $h_status ) {

			case 5:
				$h_status  = "<i class='fas fa-check-double' style='color:#008000'></i> Sync Successful";
				$row_class = ' sync-success';
				break;

			case 1:
				$h_status  = "<i class='fas fa-check' style='color:#008000'></i> Pull Successful<br>";
				$h_status  .= "<i class='fas fa-sync fa-spin'></i> Sync In Progress";
				$row_class = 'status-success pull-success sync-in-progress';
				break;

			case 0:
				$h_status  = "<i class='fas fa-sync fa-spin'></i> Pull In Progress";
				$row_class = 'status-in-progress pull-in-progress';
				break;

			case 4:
				$h_status  = "<i class='fas fa-times' style='color:#ff0000'></i> Sync Stopped";
				$row_class = ' status-force-failed';
				break;

			case 3:
				$h_status  = "<i class='fas fa-times' style='color:#ff0000'></i> Pull Stopped";
				$row_class = 'status-force-failed pull-failed';
				break;

			case 2:
				$h_status  = "<i class='fas fa-times' style='color:#ff0000'></i> Pull Failed";
				$row_class = 'status-failed pull-failed';
				break;

		}
		?>
		<tr class="<?php esc_attr_e( $row_class ); ?>">
			<td class="num"><?php esc_html_e( $offset ); ?></td>
			<td class="groupid"><?php echo wp_kses( $detail_history_url_groupid, $allowed_tags ) ?></td>
			<td class="heading"><?php echo wp_kses( $detail_history_url_heading, $allowed_tags ) ?></td>
			<td class="details-row"><?php echo wp_kses( $string_of_totals, $allowed_tags ); ?></td>
			<td class="user-row"><?php esc_html_e( $user_name ); ?></td>
			<td class="start-row"><?php esc_html_e( $start_date ); ?></td>
			<td class="end-row"><?php esc_html_e( $end_date ); ?></td>
			<td class="status-row"><?php echo wp_kses( $h_status, $allowed_tags ); ?></td>
		</tr>
	<?php } ?>

	</tbody>
</table>

</div>
