<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Segment_Tracking_DB' ) ) {
    
    class Segment_Tracking_DB {

        /**
         * Class Constructor
         */
        public function __construct() {

            //Create Custom DB Table
            $this->segment_tracking_create_queue_table();

            //WP Cron's custom timings.
            add_filter( 'cron_schedules', array( $this, 'segment_tracking_schedule' ) );

            // setup cron job
            $this->segment_tracking_setup_wpcron_job();

            // send segment event from the db
            add_action( 'nab_segment_tracking_job', array( $this, 'segment_tracking_publish_events' ) );
        }

        /**
         * Create custom database table to store event
         */
        private function segment_tracking_create_queue_table() {

            global $wpdb;
            
            if ( get_option( 'nab_segment_tracking_table_created' ) < 1 ) {

                include_once ABSPATH . 'wp-admin/includes/upgrade.php';
        
                $charset_collate    = $wpdb->get_charset_collate();
                $table_name         = $wpdb->prefix . 'nab_segment_tracking_queue';
        
                $table_sql = "CREATE TABLE `$table_name` (
                        `id` bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                        `type` varchar(20) NOT NULL,
                        `eventData` text NOT NULL
                        ) {$charset_collate};";
        
                dbDelta( $table_sql );
        
                update_option( 'nab_segment_tracking_table_created', 1 );
            }
        }

        /**
         * Custom timings for WPCron.
         *
         * @param array $schedules Default Scheduled time intervals.
         *
         * @return array Customized time intervals.
         */
        public function segment_tracking_schedule( $schedules ) {

            $schedules['cron_every_three_min'] = array(
                'interval' => 180,
                'display'  => __( 'Every 3 min' )
            );

            return $schedules;
        }

        /**
         * scheduled cron job to fire every three min.
         */
        public function segment_tracking_setup_wpcron_job() {
            
            if ( ! wp_next_scheduled( 'nab_segment_tracking_job' ) ) {
                wp_schedule_event( time(), 'cron_every_three_min', 'nab_segment_tracking_job' );
            }
        }

        /**
         * Send segment event data from the table to segment.
         */
        public function segment_tracking_publish_events() {

            global $wpdb;

            $segment_write_key = vip_get_env_var( 'SEGMENT_AMPLIFY_WRITE_KEY' );

            if ( ! empty( $segment_write_key ) ) {
                
                require_once( dirname( plugin_dir_path(__FILE__) ) . '/lib/analytics-php/lib/Segment.php' );

                class_alias( 'Segment', 'Analytics' );
                Segment::init( $segment_write_key );

                $table_name     = $wpdb->prefix . 'nab_segment_tracking_queue';
                $query_results  = $wpdb->get_results( "SELECT * FROM {$table_name} LIMIT 50" );

                if ( $query_results && ! empty( $query_results ) ) {

                    foreach ( $query_results as $result ) {

                        if ( ! empty( $result->eventData ) ) {

                            $data = json_decode( $result->eventData, true );

                            // We are only handling track events in this plugin.
                            if ( 'track' === $result->type ) {
                                Segment::track( $data );
                            }

                            $this->segment_tracking_remove_event( $result->id );

                        }

                    }

                    Segment::flush();
                }

            }
        }

        /**
         * Remove event from the table.
         * 
         * @param int $event_id
         */
        private function segment_tracking_remove_event( $event_id ) {

            global $wpdb;
            
            if ( empty( $event_id ) ) {
                
                return false;
            }

            $table_name = $wpdb->prefix . 'nab_segment_tracking_queue';

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
        public function segment_tracking_queue_event( $type, $data ) {

            global $wpdb;

            if ( empty( $type ) || empty ( $data ) ) {
                
                return false;
            }

            $table_name = $wpdb->prefix . 'nab_segment_tracking_queue';

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

    new Segment_Tracking_DB();
}