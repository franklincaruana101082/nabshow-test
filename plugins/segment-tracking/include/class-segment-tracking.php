<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Segment_Tracking' ) ) {
    
    class Segment_Tracking extends Segment_Tracking_DB {
        
        /**
         * Construct to use add WP hooks.
         */
        public function __construct() {

            $this->segment_tracking_init_hooks();

        }

        /**
         * initialize wordpress hooks.
         */
        public function segment_tracking_init_hooks() {

            add_action( 'wp_login', array( $this, 'segment_track_logged_in' ), 10 , 2 );
            add_action( 'wp_logout', array( $this, 'segment_track_logged_out' ), 10 , 1 );
            add_action( 'user_register', array( $this, 'segment_track_account_created' ), 99, 1 );

        }

        public function segment_tracking_track_event( $data = array() ) {
            // Ensure we have a userId
            if ( empty( $data['userId'] ) || 0 === $data['userId'] ) {
                return;
            }

            // Ensure we have event and properties
            if ( empty( $data['event'] ) || empty( $data['properties'] ) ) {
                return;
            }

            $data['userId'] = strval( $data['userId'] );
            $json_data = wp_json_encode( $data );
            $this->segment_tracking_queue_event( 'track', $json_data );
        }

        public function segment_track_logged_in( $user_login, $user ) {
            $user_data = get_userdata( $user->ID );

            $data = array(
                'userId'     => $user->ID,
                'event'      => 'Logged In',
                'properties' => array(
                    'email'  => $user_data->user_email
                )
            );

            $this->segment_tracking_track_event( $data );
        }

        public function segment_track_logged_out( $user_id ) {
            $user_data = get_userdata( $user_id );

            $data = array(
                'userId'     => $user_id,
                'event'      => 'Logged Out',
                'properties' => array(
                    'email'  => $user_data->user_email
                )
            );

            $this->segment_tracking_track_event( $data );
        }

        public function segment_track_account_created( $user_id ) {
            $user_data = get_userdata( $user_id );

            $data = array(
                'userId'     => $user_id,
                'event'      => 'Account Created',
                'properties' => array(
                    'email'  => $user_data->user_email
                )
            );

            $this->segment_tracking_track_event( $data );
        }

    }

    new Segment_Tracking();
}