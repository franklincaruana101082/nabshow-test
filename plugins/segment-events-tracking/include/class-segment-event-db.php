<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Segment_Event_DB' ) ) {
    
    class Segment_Event_DB {

        /**
		 * Class Constructor
		 */
		public function __construct() {

			//Create Custom DB Table
			$this->st_create_custom_event_tracking_table();

			//WP Cron's custom timings.
			add_filter( 'cron_schedules', array( $this, 'st_wpcron_custom_timings' ) );

            // setup cron job
			$this->st_setup_wpcron_job();

            // send segment event from the db
            add_action( 'nab_track_segment_event', array( $this, 'st_send_event_from_db_to_segment' ) );
		}

        /**
         * Create custom database table to store event
         */
        private function st_create_custom_event_tracking_table() {

            global $wpdb;
            
            if ( get_option( 'nab_segement_event_tracking' ) < 1 ) {

                include_once ABSPATH . 'wp-admin/includes/upgrade.php';
        
                $charset_collate    = $wpdb->get_charset_collate();
                $table_name         = $wpdb->prefix . 'nab_segment_event_tracking';
        
                $table_sql = "CREATE TABLE `$table_name` (
                        `id` bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                        `type` varchar(20) NOT NULL,
                        `eventData` text NOT NULL
                        ) {$charset_collate};";
        
                dbDelta( $table_sql );
        
                update_option( 'nab_segement_event_tracking', 1 );
            }
        }

        /**
		 * Custom timings for WPCron.
		 *
		 * @param array $schedules Default Scheduled time intervals.
		 *
		 * @return array Customized time intervals.
		 */
		public function st_wpcron_custom_timings( $schedules ) {

			$schedules['cron_every_three_min'] = array(
				'interval' => 180,
				'display'  => __( 'Every 3 min' )
            );

			return $schedules;
		}

        /**
         * scheduled cron job to fire every three min.
         */
        public function st_setup_wpcron_job() {
            
			if ( ! wp_next_scheduled( 'nab_track_segment_event' ) ) {
				wp_schedule_event( time(), 'cron_every_three_min', 'nab_track_segment_event' );
			}
        }

        /**
         * Send segment event data from the table to segment.
         */
        public function st_send_event_from_db_to_segment() {

            global $wpdb;

            $segment_api_key = get_option( 'segment_tracking_api_key' );

            if ( ! empty( $segment_api_key ) ) {
                
                require_once( dirname( plugin_dir_path(__FILE__) ) . '/lib/analytics-php/lib/Segment.php' );

                class_alias( 'Segment', 'Analytics' );
                Segment::init( $segment_api_key );

                $table_name     = $wpdb->prefix . 'nab_segment_event_tracking';
                $query_results  = $wpdb->get_results( "SELECT * FROM {$table_name} LIMIT 10" );

                if ( $query_results && ! empty( $query_results ) ) {

                    foreach ( $query_results as $result ) {

                        if ( ! empty( $result->eventData ) ) {

                            $data = json_decode( $result->eventData, true );

                            if ( 'identify' === $result->type ) {
                                Segment::identify( $data );
                            } else {
                                Segment::track( $data );
                            }
                            Segment::flush();
                            $this->st_remove_event( $result->id );
                        }
                    }
                }

            }
        }

        /**
         * Remove event from the table.
         * 
         * @param int $event_id
         */
        private function st_remove_event( $event_id ) {

            global $wpdb;
            
            if ( empty( $event_id ) ) {
                
                return false;
            }

            $table_name = $wpdb->prefix . 'nab_segment_event_tracking';

            $wpdb->delete(
                $table_name,
                array(                    
                    'id' => $event_id
                ),
                array(
                    '%d'
                )
            );
        }

        /**
         * Add new event into the database table.
         * 
         * @param string $type
         * @param string $data
         */
        public function st_insert_event( $type, $data ) {

            global $wpdb;

            if ( empty( $type ) || empty ( $data ) ) {
                
                return false;
            }

            $table_name = $wpdb->prefix . 'nab_segment_event_tracking';

            $wpdb->insert(
                $table_name,
                array(                    
                    'type'      => $type,
                    'eventData' => $data
                ),
                array(
                    '%s',
                    '%s'
                )
            );
        }
    }

    new Segment_Event_DB();
}