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
<div class="mys-section-left history-page">
	<div class="mys-main-table res-cl ">
		<h2>History Detail</h2>
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
				<th class="data-type">Data Type</th>
				<th class="heading">Title</th>
				<th class="details">API Response</th>
				<th class="num">#</th>
				<th class="status-row">Status</th>
				<th class="assigned-to">Assigned To</th>
				<th class="start-row">Prepared At</th>
				<th class="end-row">Updated At</th>
			</tr>
			</thead>
			<tbody>
			<?php

			$session_wpdata = array();
			$allowed_tags   = array(
				'b'    => array(),
				'br'   => array(),
				'i'    => array( 'class' => array(), 'style' => array() ),
				'span' => array( 'class' => array() ),
				'a'    => array( 'href' => array(), 'target' => array() ),
				'img'  => array( 'src' => array(), 'title' => array() ),
			);

			$type_wise_data = $this->nab_mys_db_history_object->nab_mys_history_detail( $this->history_groupid );

			$test = filter_input( INPUT_GET, 'test', FILTER_SANITIZE_STRING );

			$force_cron_end_point = get_rest_url( null, 'mys/migrate-data' );
			$max_text_length      = 70;

			$count_total = 0;

			foreach ( $type_wise_data as $data_type => $type_rows ) {

				$count_items = 0;

				foreach ( $type_rows as $item_mys_id => $prepared_item ) {

					$count_items ++;
					$count_total ++;

					$row_filled = 0;

					//flush previous data
					$item_basic_data = $item_post_link = $item_image_attached = '';

					$item_array_data  = $prepared_item['item_array_data'];
					$item_mys_id_name = $prepared_item['item_mys_id_name'];
					$item_title_name  = $prepared_item['item_title_name'];
					$item_image_name  = $prepared_item['item_image_name'];
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

						$wp_id = $this->nab_mys_db_cron_object->nab_mys_cron_get_wpid_from_meta( 'tracks', 'trackid', $item_mys_id, 'taxonomy' );

						if ( ! empty( $wp_id ) ) {
							$term_data           = get_term( $wp_id, 'tracks' );
							$item_basic_data     = $term_data->name;
							$item_post_link      = esc_url( get_edit_term_link( $wp_id, 'tracks' ) );
							$item_image_attached = get_term_meta( $term_data->term_id, 'tax-image-id', true );
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

					$count_item_assignees = 0;

					foreach ( $assigned_to_rows as $assigned_id => $single_row ) {

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
						} else {
							if ( null !== $session_wpdata[ $assigned_id ] ) {
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

								} else {
									$session_post_title = "Session not created yet.";
								}
							}
							$session_post_title .= " (sessionid: $assigned_id)";
						}


						switch ( $status_int ) {

							case 1:
							case null:
								$h_status  = "<i class='fas fa-check-double' style='color:#008000'></i><br>Sync Success";
								$row_class = 'status-success sync-success';
								break;
							case 0:
							case 3:
								$h_status  = "<i class='fas fa-sync fa-spin'></i><br>Sync In Progress";
								$row_class = 'status-in-progress';
								break;
							case 4:
								$h_status  = "<i class='fas fa-times' style='color:#ff0000'></i><br>Sync Force Stopped";
								$row_class = 'status-force-failed';
								break;
						}

						$d = array();
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
									$v = strip_tags( $v );

									// truncate string
									$stringCut = substr( $v, 0, $max_text_length );
									$endPoint  = strrpos( $stringCut, ' ' );

									//if the string doesn't contain any space then it will cut without word basis.
									$v = $endPoint ? substr( $stringCut, 0, $endPoint ) : substr( $stringCut, 0 );
									$v .= '...';
								}
								$d[] = "$n : $v";
							}
						}
						$item_array_data = implode( '<br>', $d );

						$start_time = $single_row->DataStartTime;
						$start_time = date( 'g:i:s A F j, Y', strtotime( $start_time ) );
						$end_time   = $single_row->DataEndTime;
						$end_time   = 1 === (int) $status_int ? date( 'g:i:s A F j, Y', strtotime( $end_time ) ) : '-';

						?>
						<tr class="<?php echo esc_attr( $row_class ); ?>">

							<?php if ( 0 === $row_filled ) { ?>
								<td rowspan="<?php echo esc_attr( $row_span ); ?>" class="data-type"><?php echo wp_kses( "$data_type#$count_total-$count_items", $allowed_tags ); ?></td>
								<td rowspan="<?php echo esc_attr( $row_span ); ?>" class="heading-row"><?php echo wp_kses( $item_basic_data, $allowed_tags ); ?></td>
								<td rowspan="<?php echo esc_attr( $row_span ); ?>" class="details-row"><?php echo wp_kses( $item_array_data, $allowed_tags ); ?></td>
							<?php } ?>

							<td class="num"><?php echo wp_kses( "$data_id#$count_total-$count_items-$count_item_assignees", $allowed_tags ); ?></td>
							<td class="status-row"><?php echo wp_kses( $h_status, $allowed_tags ); ?></td>
							<td class="assigned-to"><?php echo wp_kses( $session_post_title, $allowed_tags ); ?></td>
							<td class="start-row"><?php echo esc_html( $start_time ); ?></td>
							<td class="end-row"><?php echo esc_html( $end_time ); ?></td>
						</tr>
						<?php

						$row_filled = 1;
					}

				}
			} ?>

			</tbody>
		</table>
		<!-- <div class="mys-dashboard">
			<img src="http://nabshow.md-staging.com/wp-content/uploads/2019/07/mys-History.png">
		</div> -->
	</div>
</div>
