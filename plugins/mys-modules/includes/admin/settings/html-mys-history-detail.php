<?php
/**
 * HTML for History Detail Page.
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
		<th class="total-count">#</th>
		<th class="data-type <?php esc_attr_e( $sorting_data['datatype_row_class'] ); ?>">
			<?php echo wp_kses( $sorting_data['datatype_row_html'], $allowed_tags ) ?>
		</th>
		<th class="heading">Title</th>
		<th class="details">API Response</th>
		<th class="total-assignees">#</th>
		<th class="num <?php esc_attr_e( $sorting_data['dataid_row_class'] ); ?>">
			<?php echo wp_kses( $sorting_data['dataid_row_html'], $allowed_tags ) ?>
		</th>
		<th class="status-row">Status</th>
		<th class="assigned-to">Assigned To</th>
		<th class="start-row">Prepared At</th>
		<th class="end-row">Migrated At</th>
	</tr>
	</thead>
	<tbody>
	<?php

	$session_wpdata = array();

	$test = filter_input( INPUT_GET, 'test', FILTER_SANITIZE_STRING );

	$force_cron_end_point = get_rest_url( null, 'mys/migrate-data' );
	$max_text_length      = 70;

	$count_total_data_items = 0;
	$count_total_assignees  = $request_data['offset'];

	if ( 0 === count( $history_data ) ) {
		echo "<td colspan='10' class='nothing-found'>No history found.</td>";
	}

	foreach ( $history_data as $groupid => $type_wise_data ) {

		$detail_group_url = admin_url( "admin.php?page=mys-history&groupid=$groupid&timeorder=asc" );

		echo "<td colspan='10' class='group-title'>Group ID: <a href='" . esc_url( $detail_group_url ) . "'> " . esc_html( $groupid ) . "</a></td>";

		$count_group_items = 0;

		foreach ( $type_wise_data as $data_type => $type_rows ) {

			$count_group_items = count( $type_rows );

			$count_datawise_items = 0;

			foreach ( $type_rows as $item_mys_id => $prepared_item ) {

				$count_datawise_items ++;
				$count_total_data_items ++;

				$row_filled = 0;

				//flush previous data
				$item_basic_data = $item_post_link = $item_image_attached = '';

				$item_array_data  = $prepared_item['item_array_data'];
				$item_mys_id_name = $prepared_item['item_mys_id_name'];
				$item_title_name  = $prepared_item['item_title_name'];
				$item_image_name  = isset( $prepared_item['item_image_name'] ) ? $prepared_item['item_image_name'] : '';
				$assigned_to_rows = $prepared_item['assigned_to_rows'];
				$row_span         = count( $assigned_to_rows );

				if ( isset( $item_array_data->{$item_title_name} ) ) {
					$item_basic_data = $item_array_data->{$item_title_name};
					if ( 'speakers' === $data_type ) {
						$item_basic_data .= ' ' . $item_array_data->lastname;
					}
				}

				if ( 'tracks' !== $data_type ) {

					$wp_id = $this->nab_mys_db_cron_object->nab_mys_cron_get_wpid_from_meta( $data_type, $item_mys_id_name, $item_mys_id );

					if ( ! empty( $wp_id ) ) {
						$item_basic_data     = isset( $item_basic_data ) ? $item_basic_data : get_the_title( $wp_id );
						$item_post_link      = get_edit_post_link( $wp_id );
						$item_image_attached = has_post_thumbnail( $wp_id );
					}

				} else {
					//tracks

					$term_data = $this->nab_mys_db_cron_object->nab_mys_cron_get_wpid_from_meta( 'tracks', 'trackid', $item_mys_id, 'taxonomy' );

					$wp_id = ! empty( $term_data->term_id ) ? $term_data->term_id : '';

					if ( ! empty( $wp_id ) ) {
						$term_data           = get_term( $wp_id, 'tracks' );
						$item_basic_data     = $term_data->name;
						$item_post_link      = esc_url( get_edit_term_link( $wp_id, 'tracks' ) );
						$item_image_attached = get_term_meta( $wp_id, 'tax-image-id', true );
					}
				}

				$item_basic_data = isset( $item_post_link ) && ! empty( $item_post_link ) ? "<a href='$item_post_link'>$item_basic_data</a>" : $item_basic_data;
				$item_basic_data .= " ($item_mys_id_name: $item_mys_id)";

				if ( isset( $item_array_data->{$item_image_name} ) ) {
					$item_image_url = $item_array_data->{$item_image_name};

					if ( ! empty( $item_image_url ) ) {
						$item_basic_data .= "<br><br><img src='$item_image_url' />";

						//Check if image attached to the wp post or not.
						$item_basic_data .= empty( $item_image_attached ) && ! empty( $wp_id ) ? "<br><br><span class='red-notice'>Image not attached</span>" : '';

					}
				}

				$itemwise_assignees_total = count( $assigned_to_rows );
				$count_item_assignees     = 0;

				foreach ( $assigned_to_rows as $assigned_id => $single_row ) {

					$count_total_assignees ++;
					$count_item_assignees ++;

					$data_id         = $single_row->DataID;
					$item_status_int = $single_row->ItemStatus;

					if ( isset( $test ) ) {
						$cron_data_id = $force_cron_end_point . '?dataids=' . $data_id;
						$data_id      = "<a target='_blank' href='$cron_data_id'>$data_id</a>";
					}

					switch ( $item_status_int ) {

						case 2:
							$item_status = "Update";
							break;

						case 1:
							$item_status = "New";
							break;

						case 0:
							$item_status = "Delete";
							break;
					}

					$data_id .= "<br>($item_status)<br>";

					$status_int = $single_row->AddedStatus;

					if ( 'sessions' === $data_type || 'exhibitors' === $data_type ) {
						$session_post_title = '<i>self</i>';
						$assignee_hash      = '';
					} else {
						$assignee_hash = "$count_item_assignees/$itemwise_assignees_total";
						if ( ! empty( $session_wpdata[ $assigned_id ] ) && null !== $session_wpdata[ $assigned_id ] ) {
							$session_post_title = $session_wpdata[ $assigned_id ]['title'];
							$session_post_link  = $session_wpdata[ $assigned_id ]['link'];
						} else {
							$session_post_id = $this->nab_mys_db_cron_object->nab_mys_cron_get_wpid_from_meta( 'sessions', 'sessionid', $assigned_id );

							if ( ! empty( $session_post_id ) ) {
								$session_post_title = get_the_title( $session_post_id );
								$session_post_link  = get_edit_post_link( $session_post_id );

								$session_post_title = isset( $session_post_link ) ? "<a href='$session_post_link'>$session_post_title</a>" : $session_post_title;

								$session_wpdata[ $assigned_id ]['title'] = $session_post_title;
								$session_wpdata[ $assigned_id ]['link']  = $session_post_link;

							} else if ( 0 === $assigned_id ) {
								$session_post_title = "Not assigned to any Session.";
							} else {
								$session_post_title = "Session not created yet.";
							}
						}
						if ( 0 !== $assigned_id ) {
							$session_post_title .= " (sessionid: $assigned_id)";
						}
					}


					switch ( $status_int ) {

						case 1:
						case null:
							$h_status  = "<i class='fas fa-check-double' style='color:#008000'></i><br>Sync Successful";
							$row_class = 'status-success sync-success';
							break;
						case 4:
							$h_status  = "<i class='fas fa-times' style='color:#ff0000'></i><br>Sync Stopped";
							$row_class = 'status-force-failed';
							break;
						case 0:
						case 10:
						case 3:
							$h_status  = "<i class='fas fa-sync fa-spin'></i><br>Sync In Progress";
							$row_class = 'status-in-progress';
							break;
					}

					$d = array();
					if ( is_array( $item_array_data ) || is_object( $item_array_data ) ) {
						foreach ( $item_array_data as $n => $v ) {

							if ( ( is_array( $v ) && 0 === count( $v ) ) || empty( $v ) ) {
								continue;
							}

							if ( is_array( $v ) ) {
								$array_string = array();
								$array_count  = 0;
								foreach ( $v as $min ) {
									$array_count ++;
									$array_string[] = "#$array_count";
									foreach ( $min as $min_n => $min_v ) {
										$array_string[] = "$min_n : $min_v";
									}
								}
								$d[] = "<b>$n</b> => [" . implode( '; ', $array_string ) . "]";
							} else {

								if ( 'photo' !== $n && 'logo' !== $n && 'icon' !== $n && strlen( $v ) > $max_text_length ) {
									$v = wp_strip_all_tags( $v );

									// truncate string
									$stringCut = substr( $v, 0, $max_text_length );
									$endPoint  = strrpos( $stringCut, ' ' );

									//if the string doesn't contain any space then it will cut without word basis.
									$v = $endPoint ? substr( $stringCut, 0, $endPoint ) : substr( $stringCut, 0 );
									$v .= '...';
								}
								if ( ! is_object( $v ) ) {
									$d[] = "$n : $v";
								}
							}
						}
					}
					$item_array_data = implode( '<br>', $d );

					$start_time = $single_row->DataStartTime;
					$start_time = date( 'g:i:s A F j, Y', strtotime( $start_time ) );
					$end_time   = $single_row->DataEndTime;
					$end_time   = 1 === (int) $status_int ? date( 'g:i:s A F j, Y', strtotime( $end_time ) ) : '-';

					?>
					<tr class="<?php esc_attr_e( $row_class ); ?>">

						<?php if ( 0 === $row_filled ) { ?>
							<td rowspan="<?php esc_attr_e( $row_span ); ?>" class="total-count"><?php esc_html_e( $count_total_data_items ); ?></td>
							<td rowspan="<?php esc_attr_e( $row_span ); ?>" class="data-type"><?php echo wp_kses( "$count_datawise_items/$count_group_items $data_type", $allowed_tags ); ?></td>
							<td rowspan="<?php esc_attr_e( $row_span ); ?>" class="heading-row"><?php echo wp_kses( $item_basic_data, $allowed_tags ); ?></td>
							<td rowspan="<?php esc_attr_e( $row_span ); ?>" class="details-row"><span class="details-row-inner"><i class="fa fa-info"></i><span class="mys-response"><?php echo wp_kses( $item_array_data, $allowed_tags ); ?></span></span></td>
						<?php } ?>

						<td class="total-assignees"><?php esc_html_e( $count_total_assignees ); ?></td>
						<td class="num"><?php echo wp_kses( "$data_id $assignee_hash", $allowed_tags ); ?></td>
						<td class="status-row"><?php echo wp_kses( $h_status, $allowed_tags ); ?></td>
						<td class="assigned-to"><?php echo wp_kses( $session_post_title, $allowed_tags ); ?></td>
						<td class="start-row"><?php esc_html_e( $start_time ); ?></td>
						<td class="end-row"><?php esc_html_e( $end_time ); ?></td>
					</tr>
					<?php

					$row_filled = 1;
				}

			}
		}
	}
	?>

	</tbody>
</table>
</div>
