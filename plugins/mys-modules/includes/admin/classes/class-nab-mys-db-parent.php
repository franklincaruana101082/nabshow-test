<?php
/**
 * DataBase Queries Class
 *
 * @package MYS Modules
 * @since   1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'NAB_MYS_DB_Parent' ) ) {

	/**
	 * Class NAB_MYS_DB_Parent
	 */
	class NAB_MYS_DB_Parent {

		protected $wpdb = '';

		protected $data_json = "";

		protected $group_id = "";

		protected $current_request;

		/**
		 * Class Constructor
		 */
		public function __construct() {
			global $wpdb;
			$this->wpdb = $wpdb;
		}

		/**
		 * Bulk inserts records into a table using WPDB.  All rows must contain the same keys.
		 *
		 * @param string $table Table name
		 * @param array $rows Individual Full Data for Session/Speakers/etc.
		 *
		 * @return int Returns number of affected (inserted) rows.
		 */
		public function nab_mys_db_bulk_insert( $table, $rows ) {

			// Extract column list from first row of data
			if ( count( $rows ) > 0 ) {

				$columns = array_keys( $rows[0] );

				asort( $columns );
				$columnList = '`' . implode( '`, `', $columns ) . '`';
				// Start building SQL, initialise data and placeholder arrays
				$query = "INSERT INTO `$table` ($columnList) VALUES\n";

				$placeholders = array();
				$data         = array();
				// Build placeholders for each row, and add values to data array
				foreach ( $rows as $row ) {
					ksort( $row );
					$rowPlaceholders = array();
					foreach ( $row as $value ) {
						$data[]            = $value;
						$rowPlaceholders[] = is_numeric( $value ) ? '%d' : '%s';
					}
					$placeholders[] = '(' . implode( ', ', $rowPlaceholders ) . ')';
				}
				// Stitch all rows together
				$query .= implode( ",\n", $placeholders );

				$result = $this->wpdb->query( $this->wpdb->prepare( $query, $data ) );

				$result = false === $result ? 2 : 1;

				if ( false === $result ) {
					$result = 2;
					$this->nab_mys_db_fail_mail( $this->group_id, 'bulk Insert ' . $this->current_request );
				} else {
					$result = 1;
				}

				return $result;
			}
		}

		/**
		 * Insert/Update MYS History Table.
		 *
		 * @param string $current_request Session/Speakers/etc.
		 * @param string $query_type "insert" or "update"
		 * @param string $group_id a unique Group ID used in whole process.
		 * @param int $history_status Status of history
		 * @param int $items_affected Number of affected items
		 *
		 * @return false|int returns inserted ID or record update status
		 */
		public function nab_mys_db_history_data( $current_request, $query_type, $group_id, $history_status = 0, $items_affected = 0 ) {

			$current_user = get_current_user_id();

			//This will have same value in each cron.
			$this->group_id = $group_id;


			if ( "insert" === $query_type ) {

				$sql = $this->wpdb->insert(
					$this->wpdb->prefix . 'mys_history', array(
					'HistoryStatus'    => 0,
					'HistoryGroupID'   => $group_id,
					'HistoryUser'      => $current_user,
					'HistoryDataType'  => $current_request,
					'HistoryStartTime' => current_time( 'Y-m-d H:i:s' )
				), array( '%d', '%s', '%d', '%s', '%s' )
				);

				return $this->wpdb->insert_id;

			} else if ( "update" === $query_type ) {

				$sql_values = array(
					'HistoryEndTime'       => current_time( 'Y-m-d H:i:s' ),
					'HistoryStatus'        => $history_status,
					'HistoryData'          => $this->data_json,
					'HistoryItemsAffected' => $items_affected
				);

				if ( 'nochange' === $items_affected ) {
					unset( $sql_values['HistoryItemsAffected'] );
				}

				$sql = $this->wpdb->update(
					$this->wpdb->prefix . 'mys_history', $sql_values, array(
						'HistoryGroupID'  => $this->group_id,
						'HistoryDataType' => $current_request,
					)
				);

				return $sql;

			} else if ( "finish" === $query_type ) {

				$sql = $this->wpdb->update(
					$this->wpdb->prefix . 'mys_history', array(
					'HistoryEndTime' => current_time( 'Y-m-d H:i:s' ),
					'HistoryStatus'  => 1,
				), array(
						'HistoryGroupID'  => $this->group_id,
						'HistoryDataType' => $current_request,
					)
				);

				return $sql;
			}

		}


		/**
		 * Get previous requested date to make a call from it.
		 *
		 * @param string $data_type The type of data.
		 *
		 * @return string The previous date.
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_db_previous_date( $data_type ) {

			$wpdb = $this->wpdb;

			$previous_date = $wpdb->get_var(
				$wpdb->prepare( "SELECT HistoryStartTime FROM %1smys_history
					WHERE HistoryDataType LIKE %s
					AND HistoryStatus != 0 
					ORDER BY HistoryID DESC LIMIT 1",
					$wpdb->prefix, '%' . $data_type . '%' ) );

			return $previous_date;
		}


		/**
		 * Set Data Json to a class variable
		 *
		 * @param string $data_json Data Json
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_db_set_data_json( $data_json ) {
			$this->data_json = $data_json;
		}


		/**
		 * Get rows ready for migration.
		 *
		 * @param string $group_id A unique group id.
		 *
		 * @return int Number of ready items.
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_db_rows_ready_total_getter( $group_id ) {

			$wpdb = $this->wpdb;

			$ready_ids = $wpdb->get_results(
				$wpdb->prepare(
					"SELECT DataID FROM %1smys_data
						WHERE AddedStatus = 0
						AND DataGroupID = '%s'
						", $wpdb->prefix, $group_id )
			);

			return count( $ready_ids );
		}


		/**
		 * Get Data Rows needs to be fetched from API.
		 *
		 * @param string $group_id A unique group id.
		 *
		 * @return array|string Array of a data row or a text 'finished' if no pending rows left.
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_db_row_pending_id_getter( $group_id ) {

			$wpdb = $this->wpdb;

			$single_row = $wpdb->get_results(
				$wpdb->prepare(
					"SELECT DataID, ModifiedID FROM %1smys_data
						WHERE AddedStatus = 6
						AND DataGroupID = '%s'
						AND DataJson = ''
						ORDER BY DataID ASC
						LIMIT 1", $wpdb->prefix, $group_id )
			);

			if ( count( $single_row ) > 0 ) {

				return $single_row;

			} else {

				return "finished";

			}
		}


		/**
		 * Fill the Json data to a Data Row,
		 *
		 * @param int $dataid Data ID.
		 *
		 * @return int|bool Result of a query.
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_db_row_filler( $dataid ) {

			$sql = $this->wpdb->update(
				$this->wpdb->prefix . 'mys_data', array(
				'AddedStatus' => 0,
				'DataEndTime' => current_time( 'Y-m-d H:i:s' ),
				'DataJson'    => $this->data_json
			), array(
					'DataID' => $dataid,
				)
			);

			return $sql;

		}


		/**
		 * Get latest group id.
		 *
		 * @param string $requested_for Requested for sessions or exhibitors.
		 *
		 * @return int|array A result of a query
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_db_get_latest_groupid( $requested_for ) {

			$wpdb = $this->wpdb;

			$data_type = 'exhibitors' === $requested_for ? 'modified-exhibitors' : 'modified-sessions';

			$pending_data = $wpdb->get_results(
				$wpdb->prepare(
					"SELECT * FROM %1smys_history
						WHERE HistoryStatus = '0'
						AND HistoryDataType = %s
						ORDER BY HistoryID
						ASC LIMIT 1
						", $wpdb->prefix, $data_type )
			);

			if ( 0 === count( $pending_data ) ) {

				return 0;

			} else if ( 'exhibitors' === $requested_for ) {

				return $pending_data;

			}

			$group_id = $pending_data[0]->HistoryGroupID;

			$exist_data = $wpdb->get_results(
				$wpdb->prepare(
					"SELECT HistoryID FROM %1smys_history
						WHERE HistoryDataType = '%s'
						AND HistoryGroupID = '%s'",
					$wpdb->prefix, $requested_for, $group_id ) );

			if ( 0 === count( $exist_data ) ) {
				return $group_id;
			} else {
				return 1;
			}
		}


		/**
		 * Send Email on DB Failures.
		 *
		 * @param string $stuck_groupid A unique group id.
		 * @param string $failed_action A substring for Subject
		 * @param bool $force_reset Reset sequence or not.
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
		public function nab_mys_db_fail_mail( $stuck_groupid, $failed_action, $force_reset = false ) {

			if ( true === $force_reset ) {
				NAB_MYS_DB_CRON::nab_mys_static_reset_sequence( $stuck_groupid );
			}

			$history_detail_link = admin_url( 'admin.php?page=mys-history&groupid=' . $stuck_groupid . '&timeorder=asc' );

			$email_subject = "MYS/Wordpress Failure - Failed in trying $failed_action.";
			$email_body    = "There was an error with the custom MYS Module plugin. <a href='$history_detail_link'>Click here</a> to view details.";

			NAB_MYS_DB_CRON::nab_mys_static_email( $email_subject, $email_body );
		}

	}
}
