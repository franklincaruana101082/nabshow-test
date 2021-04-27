<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Segment_Event_Tracking' ) ) {
    
    class Segment_Event_Tracking {

        /**
         * @var string $success
         */
        public $success = false;

        /**
         * @var string $post_type
         */
        public $post_type = '';

        /**
         * @var int $post_id
         */
        public $post_id = 0;
        
        /**
         * Construct to use add WP hooks.
         */
        public function __construct() {
            
            add_action( 'wp_loaded', array( $this, 'st_setup_segment_tracking' ) );
            add_action( 'admin_menu', array( $this, 'st_add_setting_page_menu' ) );
        }

        /**
         * Initial setup segment tracking.
         */
        public function st_setup_segment_tracking() {

            $segment_api_key = get_option( 'segment_tracking_api_key' );

            if ( ! empty( $segment_api_key ) ) {
                
                require_once( dirname( plugin_dir_path(__FILE__) ) . '/lib/analytics-php/lib/Segment.php' );

                class_alias( 'Segment', 'Analytics' );
                Segment::init( $segment_api_key );

                $this->success = true;
                $this->st_init_hooks_for_segement_track();
            }
        }

        /**
         * initialize wordpress hooks.
         */
        public function st_init_hooks_for_segement_track() {

            if ( $this->success ) {

                add_action( 'wp_enqueue_scripts', array( $this, 'st_enqueue_script' ) );
                add_action( 'wp_login', array( $this, 'st_logged_in_event' ), 10 , 2 );
                add_action( 'wp_logout', array( $this, 'st_logout_event' ), 10 , 1 );
                add_action( 'user_register', array( $this, 'st_user_register_event' ), 99, 1 );
                add_action( 'woocommerce_save_account_details', array( $this, 'st_user_interest_event' ), 5, 1 );
                add_action( 'woocommerce_save_account_details', array( $this, 'st_user_profile_update' ), 11, 1);
                add_action( 'nab_user_profile_image_updated', array( $this, 'st_user_profile_image_updated' ) );
                add_action( 'nab_message_send', array( $this, 'st_company_rep_message_sent' ), 10, 3 );
                //add_action( 'nab_bookmark_added', array( $this, 'st_bookmark_added' ), 10, 2 );
                //add_action( 'nab_post_reacted', array( $this, 'st_post_reacted' ), 10, 2 );
                add_action( 'wp_insert_comment', array( $this, 'st_comment_posted' ), 10, 2 );
                add_action( 'friends_friendship_requested', array( $this, 'st_connection_request' ), 10, 3 );
                add_action( 'friends_friendship_accepted', array( $this, 'st_connection_accepted' ), 10, 3 );
                add_action( 'friends_friendship_rejected', array( $this, 'st_conection_request_rejected' ), 10, 2 );
                add_action( 'messages_message_sent', array( $this, 'st_message_sent' ), 10, 1 );
                add_action( 'woocommerce_customer_save_address', array( $this, 'st_user_billing_address_updated' ), 10, 2 );
                add_action( 'nab_company_profile_update', array( $this, 'st_company_profile_updated' ), 10, 1 );
                add_action( 'nab_company_profile_image_update', array( $this, 'st_company_profile_image_updated' ), 10, 1 );
                add_action( 'nab_company_product_action', array( $this, 'st_company_product_action' ), 10, 3 );
                add_action( 'nab_featured_block_added', array( $this, 'st_featured_block_added' ), 10, 3 );
                add_action( 'nab_company_admin_added_through_link', array( $this, 'st_company_admin_added_through_link' ), 10, 1 );
                add_action( 'nab_company_admin_add_remove', array( $this, 'st_company_admin_add_remove' ), 10, 2 );

                add_action( 'wp_ajax_st_track_site_feedback', array( $this, 'st_track_site_feedback_callback' ) );
                add_action( 'wp_ajax_nopriv_st_track_site_feedback', array( $this, 'st_track_site_feedback_callback' ) );
                add_action( 'wp_ajax_st_track_taxonomy_click', array( $this, 'st_track_taxonomy_click_callback' ) );
                add_action( 'wp_ajax_nopriv_st_track_taxonomy_click', array( $this, 'st_track_taxonomy_click_callback' ) );                
                add_action( 'wp_ajax_st_media_kit_download', array( $this, 'st_media_kit_download_callback' ) );
                add_action( 'wp_ajax_nopriv_st_media_kit_download', array( $this, 'st_media_kit_download_callback' ) );
                add_action( 'wp_ajax_st_external_link_click', array( $this, 'st_external_link_click_callback' ) );
                add_action( 'wp_ajax_nopriv_st_external_link_click', array( $this, 'st_external_link_click_callback' ) );
                add_action( 'wp_ajax_st_track_pdf_downloaded', array( $this, 'st_track_pdf_downloaded_callback' ) );
                add_action( 'wp_ajax_nopriv_st_track_pdf_downloaded', array( $this, 'st_track_pdf_downloaded_callback' ) );
                add_action( 'wp_ajax_st_track_session_registration', array( $this, 'st_track_session_registration' ) );
                add_action( 'wp_ajax_st_track_opt_in_out', array( $this, 'st_track_opt_in_out' ) );

                add_filter( 'woocommerce_segmentio_connector_event_data', array( $this, 'st_add_page_view_properties_to_wc_segmentio' ) );
                add_action( 'nab_content_submission', array( $this, 'st_track_content_submission' ), 10, 2 );
                add_action( 'nab_company_event_action', array( $this, 'st_track_company_event_action' ), 10, 3 );
                add_action( 'nab_downloadable_pdf_action', array( $this, 'st_track_downloadable_pdf_action' ), 10, 3 );
                add_action( 'wp_footer', array( $this, 'st_track_search_card_click_event' ) );
            }
        }

        public function st_enqueue_script() {
            global $post;
            
            $current_page   = '';
            $search_terms   = '';
            $content_type   = '';
            $is_pageview    = true;

            if ( is_search() ) {            
                $current_page   = 'search';
                $search_terms   = get_search_query();
                $content_type   = filter_input( INPUT_GET, 'v', FILTER_SANITIZE_STRING );
                $content_type   = isset( $content_type ) ? $content_type : '';
            }
            
            if ( is_admin() || ! isset( $post->ID ) || empty( $post->ID ) || is_post_type_archive() || is_tax() || is_search() ) {
                $is_pageview = false;
            }

            if ( $is_pageview ) {
                                                
                if ( isset( $post->ID ) && ! empty( $post->ID ) ) {
                    
                    if ( is_front_page() ) {
                        $current_page = 'home';
                    } else {
                        $current_page = 'other';
                    }                
                }
            }

            wp_enqueue_script( 'st-segement-event-js', plugin_dir_url( __DIR__ ) . 'js/st-segement-event-tracking.js' );
            wp_localize_script( 'st-segement-event-js', 'segmentJS', array(
                'ajaxurl'       => admin_url('admin-ajax.php'),
                'nabNonce'      => wp_create_nonce('nab-ajax-nonce'),
                'postID'        => $post->ID,
                'page'          => $current_page,
                'search_term'   => $search_terms,
                'is_pageview'   => $is_pageview,
                'content_type'  => $content_type,
            ));
        }        

        public function st_track_event( $tracking_details = array() ) {
            
            if ( ! isset( $tracking_details['userId'] ) || empty( $tracking_details['userId'] ) ) {

                if ( is_user_logged_in() ) {
                    $tracking_details['userId'] = get_current_user_id(); 
                } else {
                    $tracking_details['anonymousId'] = uniqid();
                }
            }
            Segment::track( $tracking_details );
        }

        public function st_identity_event( $identity_details = array() ) {

            Segment::identify( $identity_details );
        }

        public function st_logged_in_event( $user_login, $user ) {

            $track_event = array(
                'userId'    => $user->ID,
                'event'     => 'Logged_In',
            );

            $track_event['properties'] = $this->st_add_user_taxonomy_properties( $user->ID );

            $this->st_track_event( $track_event );
        }

        public function st_logout_event( $user_id ) {

            $track_event = array(
                'userId'    => $user_id,
                'event'     => 'Logged_Out',
            );

            $track_event['properties'] = $this->st_add_user_taxonomy_properties( $user_id );

            $this->st_track_event( $track_event );

        }

        public function st_user_register_event( $user_id ) {

            if ( empty( $user_id ) || 0 === $user_id ) {
                return;
            }
            
            $user_data = get_userdata( $user_id );

            $track_event = array(
                'userId'        => $user_id,
                'event'         => 'Account_Created',
                'properties'    => array(
                    'Email_Address' => $user_data->user_email,
                    'User_Name'     => $user_data->user_login,
                )
            );

            $track_identity = array(
                'userId'    => $user_id,
                'traits'    => array(
                    'email'         => $user_data->user_email,
                    'User_Name'     => $user_data->user_login,
                )
            );

            $first_name     = filter_input( INPUT_POST, 'first_name', FILTER_SANITIZE_STRING );
            $last_name      = filter_input( INPUT_POST, 'last_name', FILTER_SANITIZE_STRING );
            $user_interest  = filter_input( INPUT_POST, 'user_interest', FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY );

            if ( isset( $first_name ) && ! empty( $first_name ) ) {
                
                $track_event['properties']['First_Name']    = $first_name;
                $track_identity['traits']['First_Name']     = $first_name; 
            }

            if ( isset( $last_name ) && ! empty( $last_name ) ) {
                
                $track_event['properties']['Last_Name']    = $last_name;
                $track_identity['traits']['Last_Name']     = $last_name; 
            }
            
            if ( isset( $user_interest ) && ! empty( $user_interest ) ) {
                $user_interest = is_array( $user_interest ) ? implode( ', ', $user_interest ) : $user_interest;

                $track_event['properties']['Interest']    = $user_interest;
                $track_identity['traits']['Interest']     = $user_interest; 
            }

            $this->st_track_event( $track_event );
            $this->st_identity_event( $track_identity );

            if ( isset( $track_event['properties']['Interest'] ) && ! empty( $track_event['properties']['Interest'] ) ) {

                $track_event['event'] = 'Interest_Indicated';
                $this->st_track_event( $track_event );                
            }
        }

        public function st_user_interest_event( $user_id ) {

            $modified_interest  = filter_input( INPUT_POST, 'user_interest', FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY );
            $modified_interest  = isset( $modified_interest ) && ! empty( $modified_interest ) ? $modified_interest : array();
            $old_interest       = get_user_meta( $user_id, 'user_interest', true );
            $old_interest       = ! empty( $old_interest ) ? $old_interest : array();
            
            $remove = array_diff( $old_interest, $modified_interest );
            $added  = array_diff( $modified_interest, $old_interest );

            if ( is_array( $remove ) && count( $remove ) > 0 ) {
                
                $track_event = array(
                    'userId'    => $user_id,
                    'event'     => 'Interest_Removed',
                );
    
                $track_event['properties']                      = $this->st_add_user_taxonomy_properties( $user_id );
                $track_event['properties']['Interest_Removed']  = implode( ', ', $remove );
    
                $this->st_track_event( $track_event );

                $track_identity = array(
                    'userId'    => $user_id,
                    'traits'    => $track_event['properties'],
                );
    
                $track_identity['traits']['email'] = $track_identity['traits']['Email_Address'];
    
                unset( $track_identity['traits']['Email_Address'] );
    
                $this->st_identity_event( $track_identity );
            }

            if ( is_array( $added ) && count( $added ) > 0 ) {
                
                $track_event = array(
                    'userId'    => $user_id,
                    'event'     => 'Interest_Indicated',
                );
    
                $track_event['properties']                      = $this->st_add_user_taxonomy_properties( $user_id );
                $track_event['properties']['Interest_Added']    = implode( ', ', $added );
    
                $this->st_track_event( $track_event );

                $track_identity = array(
                    'userId'    => $user_id,
                    'traits'    => $track_event['properties'],
                );
    
                $track_identity['traits']['email'] = $track_identity['traits']['Email_Address'];
    
                unset( $track_identity['traits']['Email_Address'] );
    
                $this->st_identity_event( $track_identity );
            }
        }

        public function st_bookmark_added( $post_id, $current_user_id ) {

            $track_event = array(
                'userId'    => $current_user_id,
                'event'     => 'Content_Bookmarked',
            );

            $properties = array();

            $current_post_type          = get_post_type( $post_id );
            $post_type_taxonomy_func = array (                        
                'articles'          => 'st_add_article_taxonomy_properties',
                'page'              => 'st_add_page_taxonomy_properties',
                'company'           => 'st_add_company_taxonomy_properties',
                'company-products'  => 'st_add_company_products_taxonomy_properties',
                'product'           => 'st_add_product_taxonomy_properties',
            );
            
            if ( isset( $post_type_taxonomy_func[ $current_post_type ] ) ) {

                $properties = $this->{$post_type_taxonomy_func[ $current_post_type ]}( $properties, $post_id );
            }

            $post_type_obj                      = get_post_type_object( $current_post_type );
            $post_type_name                     = isset( $post_type_obj->labels->singular_name ) && ! empty( $post_type_obj->labels->singular_name ) ?  $post_type_obj->labels->singular_name : $current_post_type;
            $properties['Post_ID']              = $post_id;
            $properties['Post_Type']            = $post_type_name;
            $properties['URL']                  = get_the_permalink( $post_id );
            $properties['Post_Name']            = get_the_title( $post_id );            
            $track_event['properties']          = $properties;

            $this->st_track_event( $track_event );
        }

        public function st_post_reacted( $post_id, $current_user_id ) {
            
            $track_event = array(
                'userId'    => $current_user_id,
                'event'     => 'Content_Reacted_To',
            );

            $properties = array();

            $current_post_type          = get_post_type( $post_id );
            $post_type_taxonomy_func = array (                        
                'articles'          => 'st_add_article_taxonomy_properties',
                'page'              => 'st_add_page_taxonomy_properties',
                'company'           => 'st_add_company_taxonomy_properties',
                'company-products'  => 'st_add_company_products_taxonomy_properties',
                'product'           => 'st_add_product_taxonomy_properties',
            );
            
            if ( isset( $post_type_taxonomy_func[ $current_post_type ] ) ) {

                $properties = $this->{$post_type_taxonomy_func[ $current_post_type ]}( $properties, $post_id );
            }

            $post_type_obj                      = get_post_type_object( $current_post_type );
            $post_type_name                     = isset( $post_type_obj->labels->singular_name ) && ! empty( $post_type_obj->labels->singular_name ) ?  $post_type_obj->labels->singular_name : $current_post_type;
            $properties['Post_ID']              = $post_id;
            $properties['Post_Type']            = $post_type_name;
            $properties['URL']                  = get_the_permalink( $post_id );
            $properties['Post_Name']            = get_the_title( $post_id );            
            $track_event['properties']          = $properties;

            $this->st_track_event( $track_event );
        }

        public function st_company_profile_updated( $company_id, $img_updated = false ) {

            if ( $company_id && is_user_logged_in() ) {

                $track_event = array(
                    'userId'    => get_current_user_id(),
                    'event'     => $img_updated ? 'Company_Profile_Image_Updated' : 'Company_Profile_Updated',
                );
    
                $properties = array();
    
                $properties = $this->st_add_company_taxonomy_properties( $properties, $company_id );

                $properties['Post_ID']              = $company_id;                
                $properties['URL']                  = get_the_permalink( $company_id );
                $properties['Post_Name']            = get_the_title( $company_id );            
                $track_event['properties']          = $properties;
    
                $this->st_track_event( $track_event );
            }
        }

        public function st_featured_block_added( $company_id, $block_title, $action = 'update' ) {

            if ( ! empty( $block_title ) && $company_id ) {

                $event_name = 'Company_Feature_Updated';

                if ( 'add' === $action ) {
                    $event_name = 'Company_Feature_Added';
                }

                $track_event = array(
                    'userId'    => get_current_user_id(),
                    'event'     => $event_name,
                );
    
                $properties = array();
    
                $properties = $this->st_add_company_taxonomy_properties( $properties, $company_id );

                $properties['Company_Post_ID']          = $company_id;                
                $properties['URL']                      = get_the_permalink( $company_id );
                $properties['Company_Post_Name']        = get_the_title( $company_id );
                $properties['Featured_Content_Title']   = $block_title;
                $track_event['properties']              = $properties;
    
                $this->st_track_event( $track_event );
            }
        }

        public function st_company_admin_added_through_link( $company_id ) {

            if ( $company_id ) {                
                $this->st_track_company_admin_add_event( $company_id, 'Company_Admin_Added_Via_Link' );                
            }
        }

        public function st_company_admin_add_remove( $company_id, $action ) {

            if ( $company_id && ! empty( $action ) ) {

                if ( 'add' === $action ) {
                    $this->st_track_company_admin_add_event( $company_id, 'Company_Admin_Added' );
                } elseif ( 'remove' === $action ) {
                    $this->st_track_company_admin_add_event( $company_id, 'Company_Admin_Removed' );
                }
            }
        }

        public function st_track_company_admin_add_event( $company_id, $event ) {

            $track_event = array(
                'userId'    => get_current_user_id(),
                'event'     => $event,
            );

            $properties = array();

            $properties = $this->st_add_company_taxonomy_properties( $properties, $company_id );

            $properties['Post_ID']                  = $company_id;                
            $properties['URL']                      = get_the_permalink( $company_id );
            $properties['Post_Name']                = get_the_title( $company_id );                
            $track_event['properties']              = $properties;

            $this->st_track_event( $track_event );
        }

        public function st_track_content_submission( $company_id, $content_title ) {

            if ( ! empty( $company_id ) && ! empty( $content_title ) ) {

                $track_event = array(
                    'userId'    => get_current_user_id(),
                    'event'     => 'Company_Content_Submitted',
                );

                $properties = array();
    
                $properties = $this->st_add_company_taxonomy_properties( $properties, $company_id );

                $properties['Company_Post_ID']          = $company_id;
                $properties['Company_Post_Name']        = get_the_title( $company_id );
                $properties['Submitted_Content_Title']  = $content_title;
                $track_event['properties']              = $properties;
    
                $this->st_track_event( $track_event );
            }
        }

        public function st_track_pdf_downloaded_callback() {

            check_ajax_referer( 'nab-ajax-nonce', 'nabNonce' );            

            $pdf_id     = filter_input( INPUT_POST, 'pdf_id', FILTER_SANITIZE_NUMBER_INT );
            $company_id = filter_input( INPUT_POST, 'company_id', FILTER_SANITIZE_NUMBER_INT );

            if ( ! is_user_logged_in() || empty( $pdf_id ) || empty( $company_id ) ) {
                wp_send_json_error( array( 'feedback' => 'Rquired parameter is missing!' ) );
            }

            $user_id        = get_current_user_id();
            $track_event    = array(
                'event'     => 'Company_PDF_Downloaded',
                'userId'    => $user_id,
            );
            
            $company_properties = array();
            $company_properties = $this->st_add_company_taxonomy_properties( $company_properties, $company_id );
            $user_properties    = $this->st_add_user_taxonomy_properties( $user_id );

            if ( isset( $company_properties['Country'] ) ) {
                $company_properties['Company_Country'] = $company_properties['Country'];
                unset( $company_properties['Country'] );
            }

            if ( isset( $company_properties['State'] ) ) {
                $company_properties['Company_State'] = $company_properties['State'];
                unset( $company_properties['State'] );
            }

            if ( isset( $company_properties['City'] ) ) {
                $company_properties['Company_City'] = $company_properties['City'];
                unset( $company_properties['City'] );
            }

            if ( isset( $user_properties['Country'] ) ) {
                $user_properties['User_Country'] = $user_properties['Country'];
                unset( $user_properties['Country'] );
            }

            if ( isset( $user_properties['State'] ) ) {
                $user_properties['User_State'] = $user_properties['State'];
                unset( $user_properties['State'] );
            }

            if ( isset( $user_properties['City'] ) ) {
                $user_properties['User_City'] = $user_properties['City'];
                unset( $user_properties['City'] );
            }

            $company_properties['Company_Post_ID']      = $company_id;
            $company_properties['Company_Post_Name']    = html_entity_decode( get_the_title( $company_id ) );
            $company_properties['Document_Name']        = html_entity_decode( get_the_title( $pdf_id ) );

            $track_event['properties'] = array_merge( $company_properties, $user_properties );

            $this->st_track_event( $track_event );

            wp_send_json_success( array(
                    'feedback' => 'Event Track Successfully',
                    'type'     => 'success',
                )
            );
        }

        public function st_track_session_registration() {

            check_ajax_referer( 'nab-ajax-nonce', 'nabNonce' );

            $user_id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_NUMBER_INT);
            $session_id = filter_input( INPUT_POST, 'session_id', FILTER_SANITIZE_NUMBER_INT );
            $session_name = filter_input( INPUT_POST, 'session_name', FILTER_SANITIZE_STRING );
            $session_company_id = filter_input( INPUT_POST, 'session_company_id', FILTER_SANITIZE_NUMBER_INT );
            $session_company_name = filter_input( INPUT_POST, 'session_company_name', FILTER_SANITIZE_STRING );
            $user_email = filter_input( INPUT_POST, 'user_email', FILTER_SANITIZE_EMAIL );
            $user_firstname = filter_input( INPUT_POST, 'user_firstname', FILTER_SANITIZE_STRING );
            $user_lastname = filter_input( INPUT_POST, 'user_lastname', FILTER_SANITIZE_STRING );
            $user_city = filter_input( INPUT_POST, 'user_city', FILTER_SANITIZE_STRING );
            $user_state = filter_input( INPUT_POST, 'user_state', FILTER_SANITIZE_STRING );
            $user_country_code = filter_input( INPUT_POST, 'user_country_code', FILTER_SANITIZE_STRING );
            $user_company = filter_input( INPUT_POST, 'user_company', FILTER_SANITIZE_STRING );
            $user_title = filter_input( INPUT_POST, 'user_title', FILTER_SANITIZE_STRING );
            $user_ip = filter_input( INPUT_POST, 'user_ip', FILTER_SANITIZE_STRING );

            $track_event     = array(
                'event'      => 'Session_User_Registered',
                'userId'     => $user_id,
                'properties' => array(
                    'session_id'            => $session_id,
                    'session_name'          => $session_name,
                    'session_company_id'    => $session_company_id,
                    'session_company_name'  => $session_company_name,
                    'user_email'            => $user_email,
                    'user_first_name'       => $user_firstname,
                    'user_last_name'        => $user_lastname,
                    'user_city'             => $user_city,
                    'user_state'            => $user_state,
                    'user_country'          => $user_country_code,
                    'user_company'          => $user_company,
                    'user_title'            => $user_title,
                    'user_ip'               => $user_ip,
                ),
            );

            $this->st_track_event( $track_event );

            wp_send_json_success( array(
                    'feedback' => 'Event Track Successfully',
                    'type'     => 'success',
                )
            );
        }

        public function st_track_opt_in_out() {

            check_ajax_referer( 'nab-ajax-nonce', 'nabNonce' );

            $user_id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_NUMBER_INT);
            $company_id = filter_input(INPUT_POST, 'company_id', FILTER_SANITIZE_NUMBER_INT);
            $company_name = filter_input(INPUT_POST, 'company_name', FILTER_SANITIZE_STRING);
            $opted_in = filter_input(INPUT_POST, 'opted_in', FILTER_VALIDATE_BOOLEAN);
            $user_firstname = filter_input(INPUT_POST, 'user_firstname', FILTER_SANITIZE_STRING);
            $user_lastname = filter_input(INPUT_POST, 'user_lastname', FILTER_SANITIZE_STRING);
            $user_email = filter_input(INPUT_POST, 'user_email', FILTER_SANITIZE_EMAIL);
            $user_ip = filter_input(INPUT_POST, 'user_ip', FILTER_SANITIZE_STRING);
            $user_title = filter_input(INPUT_POST, 'user_title', FILTER_SANITIZE_STRING);
            $user_company = filter_input(INPUT_POST, 'user_company', FILTER_SANITIZE_STRING);
            $user_city = filter_input(INPUT_POST, 'user_city', FILTER_SANITIZE_STRING);
            $user_state = filter_input(INPUT_POST, 'user_state', FILTER_SANITIZE_STRING);
            $user_country_code = filter_input(INPUT_POST, 'user_country_code', FILTER_SANITIZE_STRING);
            $opt_in_occurred_at_id = filter_input(INPUT_POST, 'opt_in_occurred_at_id', FILTER_SANITIZE_NUMBER_INT);
            $opt_in_occurred_at_url = filter_input(INPUT_POST, 'opt_in_occurred_at_url', FILTER_SANITIZE_URL);

            if($opted_in) {
                $event_track = 'Company_User_Opted_In';
            } else {
                $event_track = 'Company_User_Opted_Out';
            }

            $track_event     = array(
                'event'      => $event_track,
                'userId'     => $user_id,
                'properties' => array(
                    'company_id'            => $company_id,
                    'company_name'          => $company_name,
                    'user_email'            => $user_email,
                    'user_first_name'       => $user_firstname,
                    'user_last_name'        => $user_lastname,
                    'user_city'             => $user_city,
                    'user_state'            => $user_state,
                    'user_country'          => $user_country_code,
                    'user_company'          => $user_company,
                    'user_title'            => $user_title,
                    'user_ip'               => $user_ip,
                    'occurred_at_id'        => $opt_in_occurred_at_id,
                    'occurred_at_url'       => $opt_in_occurred_at_url,
                ),
            );

            $this->st_track_event( $track_event );

            wp_send_json_success( array(
                    'feedback' => 'Event Track Successfully',
                    'type'     => 'success',
                )
            );
        }

        public function st_track_company_event_action( $company_id, $event_id, $action ) {

            if ( ! empty( $company_id ) && ! empty( $event_id ) && ! empty( $action ) ) {

                $event_name = '';

                if ( 'add' === $action ) {
                    $event_name = 'Company_Event_Added';
                } elseif ( 'delete' === $action ) {
                    $event_name = 'Company_Event_Removed';
                } else {
                    $event_name = 'Company_Event_Updated';
                }

                $track_event = array(
                    'userId'    => get_current_user_id(),
                    'event'     => $event_name,
                );

                $properties = array();
    
                $properties = $this->st_add_company_taxonomy_properties( $properties, $company_id );

                $properties['Company_Post_ID']      = $company_id;
                $properties['Company_Post_Name']    = get_the_title( $company_id );
                $properties['Event_ID']             = $event_id;
                $properties['Event_Title']          = get_the_title( $event_id );

                $event_category = get_the_terms( $event_id, 'tribe_events_cat' );

                if ( $event_category && ! is_wp_error( $event_category ) ) {

                    $event_category_name = wp_list_pluck( $event_category, 'name' );
                    
                    if ( is_array( $event_category_name ) && count( $event_category_name ) > 0 ) {
                        $properties['Event_Categories'] = implode( ', ', $event_category_name );
                    }                
                }

                $event_tag = get_the_terms( $event_id, 'post_tag' );

                if ( $event_tag && ! is_wp_error( $event_tag ) ) {

                    $event_tag_name = wp_list_pluck( $event_tag, 'name' );

                    if ( is_array( $event_tag_name ) && count( $event_tag_name ) > 0 ) {
                        $properties['Tags'] = implode( ', ', $event_tag_name );
                    }                
                }

                $track_event['properties'] = $properties;
    
                $this->st_track_event( $track_event );
            }
        }

        public function st_track_downloadable_pdf_action( $company_id, $pdf_title, $action ) {

            if ( ! empty( $company_id ) && ! empty( $pdf_title ) && ! empty( $action ) ) {
                
                $event_name = '';

                if ( 'add' === $action ) {
                    $event_name = 'Company_PDF_Added';
                } elseif ( 'delete' === $action ) {
                    $event_name = 'Company_PDF_Removed';
                } else {
                    $event_name = 'Company_PDF_Updated';
                }

                $track_event = array(
                    'userId'    => get_current_user_id(),
                    'event'     => $event_name,
                );

                $properties = array();
    
                $properties = $this->st_add_company_taxonomy_properties( $properties, $company_id );

                $properties['Company_Post_ID']      = $company_id;
                $properties['Company_Post_Name']    = get_the_title( $company_id );
                $properties['Document_Name']        = $pdf_title;                
                $track_event['properties']          = $properties;
    
                $this->st_track_event( $track_event );
            }
        }

        public function st_company_product_action( $status, $prodcut_id, $company_id ) {
            
            if ( ! empty( $status ) && $prodcut_id && $company_id ) {

                $event = '';

                if ( 'add' === $status ) {
                    $event = 'Company_Product_Added';
                } elseif ( 'delete' === $status ) {
                    $event = 'Company_Product_Removed';
                } else {
                    $event = 'Company_Product_Updated';
                }

                $track_event = array(
                    'userId'    => get_current_user_id(),
                    'event'     => $event,
                );
    
                $properties = array();
    
                $properties = $this->st_add_company_products_taxonomy_properties( $properties, $prodcut_id );

                $properties['Company_Post_ID']      = $company_id;            
                $properties['Company_Post_Name']    = get_the_title( $company_id );
                $properties['Product_Post_ID']      = $prodcut_id;                
                $properties['Product_Post_Name']    = get_the_title( $prodcut_id );

                $featured_terms = get_field( 'product_categories', $company_id );            

                if ( ! empty( $featured_terms ) && is_array( $featured_terms ) && count( $featured_terms ) > 0 ) {

                    $terms_name = get_terms( array(
                            'taxonomy'      => 'company-product-category',
                            'hide_empty'    => false,
                            'include'       => $featured_terms,
                            'fields'        => 'names'
                        )
                    );                

                    if ( $terms_name && ! is_wp_error( $terms_name ) && is_array( $terms_name ) ) {
                        
                        $properties['Featured_Product_Categories'] = implode( ', ', $terms_name );
                    }
                }

                $search_terms = get_field( 'search_product_categories', $company_id );            

                if ( ! empty( $search_terms ) && is_array( $search_terms ) && count( $search_terms ) > 0 ) {

                    $search_terms_name = get_terms( array(
                            'taxonomy'      => 'company-product-category',
                            'hide_empty'    => false,
                            'include'       => $search_terms,
                            'fields'        => 'names'
                        )
                    );

                    if ( $search_terms_name && ! is_wp_error( $search_terms_name ) && is_array( $search_terms_name ) ) {
                        
                        $properties['Additional_Search_Only_Categories'] = implode( ', ', $search_terms_name );
                    }
                }

                $track_event['properties']          = $properties;
    
                $this->st_track_event( $track_event );
            }
        }

        public function st_company_profile_image_updated( $company_id ) {

            $this->st_company_profile_updated( $company_id, true );
        }

        public function st_user_profile_update( $user_id ) {

            $track_event = array(
                'userId'    => $user_id,
                'event'     => 'User_Profile_Updated',
            );

            $track_event['properties'] = $this->st_add_user_taxonomy_properties( $user_id );

            $this->st_track_event( $track_event );

            $track_identity = array(
                'userId'    => $user_id,
                'traits'    => $track_event['properties'],
            );

            $track_identity['traits']['email'] = $track_identity['traits']['Email_Address'];

            unset( $track_identity['traits']['Email_Address'] );

            $this->st_identity_event( $track_identity );

        }

        public function st_user_profile_image_updated( $user_id ) {
            
            $track_event = array(
                'userId'    => $user_id,
                'event'     => 'User_Profile_Image_Updated',
            );

            $track_event['properties'] = $this->st_add_user_taxonomy_properties( $user_id );

            $this->st_track_event( $track_event );
        }

        public function st_connection_request( $friendship_id, $initiator_user_id, $friend_user_id ) {

            $track_event = array(
                'userId'    => $initiator_user_id,
                'event'     => 'Connection_Requested',
            );

            $track_event['properties']  = $this->st_add_user_taxonomy_properties( $initiator_user_id );

            $track_event['properties']['Submitter_User_ID'] = $initiator_user_id;
            $track_event['properties']['Recipient_User_ID'] = $friend_user_id;

            $this->st_track_event( $track_event );
        }

        public function st_connection_accepted( $friendship_id, $initiator_user_id, $friend_user_id ) {
            $track_event = array(
                'userId'    => $friend_user_id,
                'event'     => 'Connection_Accepted',
            );

            $track_event['properties']  = $this->st_add_user_taxonomy_properties( $friend_user_id );

            $track_event['properties']['Submitter_User_ID'] = $initiator_user_id;
            $track_event['properties']['Recipient_User_ID'] = $friend_user_id;

            $this->st_track_event( $track_event );
        }

        public function st_conection_request_rejected( $friendship_id, $friendship ) {

            $initiator_user_id  = $friendship->initiator_user_id;
            $friend_user_id     = $friendship->friend_user_id;

            if ( $initiator_user_id && $friend_user_id ) {

                $track_event = array(
                    'userId'    => $friend_user_id,
                    'event'     => 'Connection_Rejected',
                );
    
                $track_event['properties']  = $this->st_add_user_taxonomy_properties( $friend_user_id );
    
                $track_event['properties']['Submitter_User_ID'] = $initiator_user_id;
                $track_event['properties']['Recipient_User_ID'] = $friend_user_id;
    
                $this->st_track_event( $track_event );
            }
        }

        public function st_message_sent( $messages ) {
            
            $sender_id  = $messages->sender_id;
            $recipients = wp_list_pluck( $messages->recipients, 'user_id' );

            if ( $sender_id && $recipients ) {

                $track_event = array(
                    'userId'    => $sender_id,
                    'event'     => 'Message_Sent',
                );
    
                $track_event['properties']  = $this->st_add_user_taxonomy_properties( $sender_id );
    
                $track_event['properties']['Submitter_User_ID'] = $sender_id;
                $track_event['properties']['Recipient_User_ID'] = is_array( $recipients ) ? implode( ', ', $recipients ) : $recipients;

                if ( isset( $messages->message ) && ! empty( $messages->message ) ) {
                    $track_event['properties']['Message_Length'] = strlen( wp_strip_all_tags( $messages->message ) );
                }
    
                $this->st_track_event( $track_event );
            }
        }

        public function st_user_billing_address_updated( $user_id, $updated ) {
            
            if ( 'billing' === $updated && $user_id ) {
            
                $properties = array();
                $user_data = get_userdata( $user_id );

                $properties['User_Name']    = $user_data->user_login;
                $properties['email']        = $user_data->user_email; 

                $billing_fields = array(
                    array(
                        'key'   => 'billing_first_name',
                        'label' => 'Billing_First_Name',
                    ),
                    array(
                        'key'   => 'billing_last_name',
                        'label' => 'Billing_Last_Name',
                    ),
                    array(
                        'key'   => 'billing_company',
                        'label' => 'Company_Name',
                    ),
                    array(
                        'key'   => 'billing_country',
                        'label' => 'Country',
                    ),
                    array(
                        'key'   => 'billing_address_1',
                        'label' => 'Street_Address',
                    ),
                    array(
                        'key'   => 'billing_city',
                        'label' => 'City',
                    ),
                    array(
                        'key'   => 'billing_state',
                        'label' => 'State',
                    ),
                    array(
                        'key'   => 'billing_postcode',
                        'label' => 'ZIP',
                    ),
                    array(
                        'key'   => 'billing_phone',
                        'label' => 'Phone',
                    ),
                    array(
                        'key'   => 'billing_email',
                        'label' => 'Email',
                    ),
                );

                foreach ( $billing_fields as $fields ) {

                    $field_val = get_user_meta( $user_id, $fields['key'], true );
                    
                    if ( ! empty( $field_val ) ) {

                        $properties[ $fields['label'] ] = $field_val;
                    }
                }

                $track_identity = array(
                    'userId'    => $user_id,
                    'traits'    => $properties,
                );

                $this->st_identity_event( $track_identity );
            }
        }

        public function st_add_user_taxonomy_properties( $user_id = 0 ) {

            $properties = array();

            if ( empty( $user_id ) || 0 === $user_id ) {
                $user_id = get_current_user_id();
            }

            $user_data = get_userdata( $user_id );

            $properties['User_Name']        = $user_data->user_login;
            $properties['Email_Address']    = $user_data->user_email;            
            
            $user_meta_fields = array(
                array(
                    'key'   => 'first_name',
                    'type'  => 'single',
                    'label' => 'First_Name',
                ),
                array(
                    'key'   => 'last_name',
                    'type'  => 'single',
                    'label' => 'Last_Name',
                ),
                array(
                    'key'   => 'user_job_role',
                    'type'  => 'multi',
                    'label' => 'Job_Role',
                ),
                array(
                    'key'   => 'user_industry',
                    'type'  => 'multi',
                    'label' => 'Industry',
                ),
                array(
                    'key'   => 'user_city',
                    'type'  => 'single',
                    'label' => 'City',
                ),
                array(
                    'key'   => 'user_state',
                    'type'  => 'single',
                    'label' => 'State',
                ),
                array(
                    'key'   => 'user_country',
                    'type'  => 'single',
                    'label' => 'Country',
                ),
                array(
                    'key'   => 'attendee_title',
                    'type'  => 'single',
                    'label' => 'Title',
                ),
                array(
                    'key'   => 'attendee_company',
                    'type'  => 'single',
                    'label' => 'Company',
                ),
                array(
                    'key'   => 'social_twitter',
                    'type'  => 'single',
                    'label' => 'Social_Twitter',
                ),
                array(
                    'key'   => 'social_linkedin',
                    'type'  => 'single',
                    'label' => 'Social_Linkedin',
                ),
                array(
                    'key'   => 'social_facebook',
                    'type'  => 'single',
                    'label' => 'Social_Facebook',
                ),
                array(
                    'key'   => 'social_instagram',
                    'type'  => 'single',
                    'label' => 'Social_Instagram',
                ),
                array(
                    'key'   => 'social_youtube',
                    'type'  => 'single',
                    'label' => 'Youtube',
                ),
                array(
                    'key'   => 'social_website',
                    'type'  => 'single',
                    'label' => 'Website',
                ),
                array(
                    'key'   => 'user_interest',
                    'type'  => 'multi',
                    'label' => 'Interest',
                ),
            );

            foreach ( $user_meta_fields as $user_field ) {

                $field_val = get_user_meta( $user_id, $user_field['key'], true );

                if ( ! empty( $field_val ) ) {

                    $properties[ $user_field['label'] ] = 'multi' === $user_field['type'] && is_array( $field_val ) ? implode( ', ', $field_val ) : $field_val;
                }
            }

            return $properties;
        }

        public function st_comment_posted( $comment_id, $comment ) {

            $post_id = $comment->comment_post_ID;

            if ( $post_id ) {

                $track_event = array(                    
                    'event'     => 'Content_Commented_On',
                );
    
                $properties = array();
    
                $current_post_type          = get_post_type( $post_id );
                $post_type_taxonomy_func    = array (                        
                    'articles'          => 'st_add_article_taxonomy_properties',
                    'page'              => 'st_add_page_taxonomy_properties',
                    'company'           => 'st_add_company_taxonomy_properties',
                    'company-products'  => 'st_add_company_products_taxonomy_properties',
                    'product'           => 'st_add_product_taxonomy_properties',
                );
                
                if ( isset( $post_type_taxonomy_func[ $current_post_type ] ) ) {
    
                    $properties = $this->{$post_type_taxonomy_func[ $current_post_type ]}( $properties, $post_id );
                }
    
                $post_type_obj                      = get_post_type_object( $current_post_type );
                $post_type_name                     = isset( $post_type_obj->labels->singular_name ) && ! empty( $post_type_obj->labels->singular_name ) ?  $post_type_obj->labels->singular_name : $current_post_type;
                $properties['Post_ID']              = $post_id;
                $properties['Post_Type']            = $post_type_name;
                $properties['URL']                  = get_the_permalink( $post_id );
                $properties['Post_Name']            = get_the_title( $post_id );                
                $track_event['properties']          = $properties;
    
                $this->st_track_event( $track_event );
            }
        }

        public function st_track_site_feedback_callback() {

            check_ajax_referer( 'nab-ajax-nonce', 'nabNonce' );

            if ( is_user_logged_in() ) {

                $user_id = get_current_user_id();

                $track_event = array(
                    'userId'    => $user_id,
                    'event'     => 'Site_Feedback_Clicked',
                );
    
                $track_event['properties'] = $this->st_add_user_taxonomy_properties( $user_id );
    
                $this->st_track_event( $track_event );
            }

            wp_send_json_success(array(
                'feedback' => 'Event Track Successfully',
                'type'     => 'success',
            ));	

        }

        public function st_media_kit_download_callback() {
            
            check_ajax_referer( 'nab-ajax-nonce', 'nabNonce' );

            $track_event = array(
                'event' => 'Media_Kit_Downloaded',
            );

            if ( is_user_logged_in() ) {

                $user_id = get_current_user_id();                 
                
                $track_event['userId']      = $user_id;
                $track_event['properties']  = $this->st_add_user_taxonomy_properties( $user_id );
                    
            }

            $this->st_track_event( $track_event );

            wp_send_json_success(array(
                'feedback' => 'Event Track Successfully',
                'type'     => 'success',
            ));
        }

        public function st_track_search_card_click_event() {

            if ( isset( $_COOKIE['st_search_click'] ) ) {

                $track_event = array(
                    'event' => 'Clicked_Search_Results',
                );
    
                if ( is_user_logged_in() ) {
    
                    $user_id = get_current_user_id();                 
                    
                    $track_event['userId'] = $user_id;                
                        
                }

                $track_event['properties'] = array( 'Search_Terms' =>  $_COOKIE['st_search_click'] );
    
                $this->st_track_event( $track_event );

                unset( $_COOKIE['st_search_click'] );
                setcookie( 'st_search_click', null, -1, '/' );
            }
        }

        public function st_external_link_click_callback() {
            
            check_ajax_referer( 'nab-ajax-nonce', 'nabNonce' );

            $track_event = array(
                'event' => 'External_Link_Clicked',
            );

            if ( is_user_logged_in() ) {

                $user_id = get_current_user_id();                 
                
                $track_event['userId'] = $user_id;                
                    
            }

            $this->st_track_event( $track_event );

            wp_send_json_success(array(
                'feedback' => 'Event Track Successfully',
                'type'     => 'success',
            ));
        }

        public function st_track_taxonomy_click_callback() {
            
            check_ajax_referer( 'nab-ajax-nonce', 'nabNonce' );

            $post_id    = filter_input( INPUT_POST, 'postID', FILTER_SANITIZE_NUMBER_INT );
            $tag_text   = filter_input( INPUT_POST, 'tagText', FILTER_SANITIZE_STRING );

            if ( isset( $post_id ) && $post_id ) {

                $track_event = array(                    
                    'event'     => 'Content_Taxonomy_Clicked',
                );
    
                $properties = array();
    
                $current_post_type          = get_post_type( $post_id );
                $post_type_taxonomy_func    = array (                        
                    'articles'          => 'st_add_article_taxonomy_properties',
                    'page'              => 'st_add_page_taxonomy_properties',
                    'company'           => 'st_add_company_taxonomy_properties',
                    'company-products'  => 'st_add_company_products_taxonomy_properties',
                    'product'           => 'st_add_product_taxonomy_properties',
                );
                
                if ( isset( $post_type_taxonomy_func[ $current_post_type ] ) ) {
    
                    $properties = $this->{$post_type_taxonomy_func[ $current_post_type ]}( $properties, $post_id );
                }
    
                $post_type_obj                      = get_post_type_object( $current_post_type );
                $post_type_name                     = isset( $post_type_obj->labels->singular_name ) && ! empty( $post_type_obj->labels->singular_name ) ?  $post_type_obj->labels->singular_name : $current_post_type;
                $properties['Post_ID']              = $post_id;
                $properties['Post_Type']            = $post_type_name;
                $properties['URL']                  = get_the_permalink( $post_id );
                $properties['Post_Name']            = get_the_title( $post_id );
                $properties['Taxonomy_Label']       = $tag_text;
                $track_event['properties']          = $properties;
    
                $this->st_track_event( $track_event );
            }

            wp_send_json_success(array(
                'feedback' => 'Event Track Successfully',
                'type'     => 'success',
            ));
        }

        public function st_company_rep_message_sent( $recipient, $current_user_id, $post_id ) {
            
            if ( ! empty( $recipient ) && ! empty( $current_user_id ) && ! empty( $post_id ) ) {

                $track_event = array(
                    'userId'    => $current_user_id,
                    'event'     => 'Company_Rep_Message_Sent',
                );

                $properties = array();

                $current_post_type          = get_post_type( $post_id );
                $post_type_taxonomy_func    = array (                                            
                    'company'           => 'st_add_company_taxonomy_properties',
                    'company-products'  => 'st_add_company_products_taxonomy_properties',
                );

                if ( isset( $post_type_taxonomy_func[ $current_post_type ] ) ) {

                    $properties = $this->{$post_type_taxonomy_func[ $current_post_type ]}( $properties, $post_id );
                }

                $post_type_obj                      = get_post_type_object( $current_post_type );
                $post_type_name                     = isset( $post_type_obj->labels->singular_name ) && ! empty( $post_type_obj->labels->singular_name ) ?  $post_type_obj->labels->singular_name : $current_post_type;
                $properties['Post_ID']              = $post_id;
                $properties['Post_Type']            = $post_type_name;
                $properties['URL']                  = get_the_permalink( $post_id );
                $properties['Post_Name']            = get_the_title( $post_id );
                $properties['Submitter_User_ID']    = $current_user_id;
                $properties['Recipient_User_ID']    = $recipient;
                $track_event['properties']          = $properties;

                $this->st_track_event( $track_event );
            }
        }        

        public function st_add_page_view_properties_to_wc_segmentio( $event_data ) {
            
            global $post;

            if ( isset( $event_data['event'] ) && isset( $event_data['properties'] ) ) {
                
                $event_data['properties']   = (array) $event_data['properties'];
                $is_pageview                = true;

                if ( is_search() && 'Viewed Search Page' === $event_data['event'] ) {

                    $content_type = filter_input( INPUT_GET, 'v', FILTER_SANITIZE_STRING );
                    
                    if ( isset( $content_type ) && ! empty( $content_type ) ) {
                        $event_data['properties']['Content_Type'] = $content_type;
                    }
                }

                if ( is_admin() || ! isset( $post->ID ) || empty( $post->ID ) || is_post_type_archive() || is_tax() || is_search() ) {
                    $is_pageview = false;
                }

                if ( $is_pageview ) {
                                                
                    if ( is_single() && ! is_attachment() ) {
                        
                        $event  = 'Viewed ' . ucfirst( get_post_type() );
                        
                        if ( $event === $event_data['event'] ) {
                            
                            $properties = $this->st_get_tracking_properties( $post->ID, 'other' );

                            if ( is_array( $properties ) && count( $properties ) > 0 ) {
                                
                                $event_data['properties'] = array_merge( $event_data['properties'], $properties );
                            }
                        }
                    }

                    if ( is_front_page() || is_page() ) {
                        
                        $event = is_front_page() ? 'Viewed Home Page' : 'Viewed ' . single_post_title( '', false ) . ' Page';
                        
                        if ( $event === $event_data['event'] ) {
                            
                            $page_type  = is_front_page() ? 'home' : 'other';
                            $properties = $this->st_get_tracking_properties( $post->ID, $page_type );

                            if ( is_array( $properties ) && count( $properties ) > 0 ) {
                                
                                $event_data['properties'] = array_merge( $event_data['properties'], $properties );
                            }
                        }
                    }
                }

                $event_data['properties'] = (object) $event_data['properties'];

            }

            return $event_data;
        }

        public function st_get_tracking_properties( $post_id = 0, $current_page ) {

            $properties = array();            

            if ( ! empty( $post_id ) && ! empty( $current_page ) ) {

                $current_post_type          = get_post_type( $post_id );
                $post_type_obj              = get_post_type_object( $current_post_type );
                $post_type_name             = isset( $post_type_obj->labels->singular_name ) && ! empty( $post_type_obj->labels->singular_name ) ?  $post_type_obj->labels->singular_name : $current_post_type;
                $properties['Post_ID']      = $post_id;
                $properties['Post_Type']    = $post_type_name;

                if ( 'home' === $current_page ) {
                    $properties['URL'] = get_site_url();
                } else {
                    $properties['URL'] = get_the_permalink( $post_id );
                }
                
                $post_type_taxonomy_func = array (                        
                    'articles'          => 'st_add_article_taxonomy_properties',
                    'page'              => 'st_add_page_taxonomy_properties',
                    'company'           => 'st_add_company_taxonomy_properties',
                    'company-products'  => 'st_add_company_products_taxonomy_properties',
                    'product'           => 'st_add_product_taxonomy_properties',
                    'sessions'          => 'st_add_session_taxonomy_properties',
                );

                if ( isset( $post_type_taxonomy_func[ $current_post_type ] ) ) {

                    $properties = $this->{$post_type_taxonomy_func[ $current_post_type ]}( $properties, $post_id );
                }
            }

            return $properties;
        }
        
        /**
         * Get sponsored content advertieser.
         *
         * @param  int $post_id
         * @return string
         */
        public function st_get_sponsored_content_advertiser( $post_id ) {

            $advertiser = '';

            if ( empty( $post_id ) || 0 === $post_id ) {
                return $advertiser;
            }

            $advertiser_enable = get_post_meta( $post_id, 'bs_sponsor_is_sponsored', true );

            if ( $advertiser_enable && ! empty( $advertiser_enable ) ) {
                $advertiser = get_post_meta( $post_id, 'bs_sponsor_advertiser_id', true );
            }

            return $advertiser;
        }

        /**
         * Set article post type segment tracking properties.
         *
         * @param  array $properties
         * @return array
         */
        public function st_add_article_taxonomy_properties( $properties = array(), $post_id = 0 ) {
            global $post;
            
            $custom_taxonomy_fields = array(
                array(
                    'key'   => 'article_type',
                    'type'  => 'select',
                    'label' => 'Article_Type',
                ),
                array(
                    'key'   => 'community',
                    'type'  => 'checkbox',
                    'label' => 'Community',
                ),
                array(
                    'key'   => 'personas',
                    'type'  => 'checkbox',
                    'label' => 'Personas',
                ),
                array(
                    'key'   => 'content_scope',
                    'type'  => 'select',
                    'label' => 'Content_Scope',
                ),
                array(
                    'key'   => 'content_format',
                    'type'  => 'checkbox',
                    'label' => 'Content_Format',
                ),
                array(
                    'key'   => 'content_subject',
                    'type'  => 'checkbox',
                    'label' => 'Content_Subject',
                ),
                array(
                    'key'   => 'acquisition_sub',
                    'type'  => 'checkbox',
                    'label' => 'Acquisition_Sub',
                ),
                array(
                    'key'   => 'distribution_sub',
                    'type'  => 'checkbox',
                    'label' => 'Distribution_Sub',
                ),
                array(
                    'key'   => 'management_sub',
                    'type'  => 'checkbox',
                    'label' => 'Management_Sub',
                ),
                array(
                    'key'   => 'radio_sub',
                    'type'  => 'checkbox',
                    'label' => 'Radio_Sub',
                ),
                array(
                    'key'   => 'display_sub',
                    'type'  => 'checkbox',
                    'label' => 'Display_Sub',
                ),
                array(
                    'key'   => 'industry_sub',
                    'type'  => 'checkbox',
                    'label' => 'Industry_Sub',
                ),
                array(
                    'key'   => 'content_sub',
                    'type'  => 'checkbox',
                    'label' => 'Content_Sub',
                ),
                array(
                    'key'   => 'production_sub',
                    'type'  => 'checkbox',
                    'label' => 'Production_Sub',
                ),
            );

            if ( 0 === $post_id || empty( $post_id ) ) {
                $post_id = $post->ID;
            }

            $article_terms = get_the_terms( $post_id, 'content-category' );

            if ( $article_terms && ! is_wp_error( $article_terms ) ) {

                $article_terms_name = wp_list_pluck( $article_terms, 'name' );
                if ( is_array( $article_terms_name ) && count( $article_terms_name ) > 0 ) {
                    $properties['Category'] = implode( ', ', $article_terms_name );
                }                
            }

            foreach ( $custom_taxonomy_fields as $current_field ) {

                $field_val = get_field( $current_field['key'], $post_id );

                if ( ! empty( $field_val ) ) {

                    $properties[ $current_field['label'] ] = 'checkbox' === $current_field['type'] ? implode( ', ', (array) $field_val ) : $field_val;
                }
            }

            $company = get_field( 'nab_selected_company_id', $post_id );

            if ( ! empty( $company ) ) {
                $properties['Company'] = get_the_title( $company );
            }

            $author_id = get_post_field( 'post_author', $post_id );
            $author_name = get_user_meta( $author_id, 'first_name', true ) . ' ' . get_user_meta( $author_id, 'last_name', true );

            if ( empty( trim( $author_name ) ) ) {
                
                $user_data      = get_userdata( $author_id );
                $author_name    = $user_data->display_name;
            }

            $properties['Author'] = $author_name;

            $advertiser = $this->st_get_sponsored_content_advertiser( $post_id );

            if ( ! empty( $advertiser ) ) {
                $properties['Sponsored_Content_Advertiser'] = $advertiser;
            }

            return $properties;
        }
        
        /**
         * Set page post type segment tracking properties.
         *
         * @param  array $properties
         * @return array
         */
        public function st_add_page_taxonomy_properties( $properties = array(), $post_id = 0 ) {
            global $post;

            if ( 0 === $post_id || empty( $post_id ) ) {
                $post_id = $post->ID;
            }
            
            $parent_page = wp_get_post_parent_id( $post_id );

            if ( $parent_page ) {
                $properties['Parent_Page'] = get_the_title( $parent_page );
            }

            $advertiser = $this->st_get_sponsored_content_advertiser( $post_id );

            if ( ! empty( $advertiser ) ) {
                $properties['Sponsored_Content_Advertiser'] = $advertiser;
            }
            
            return $properties;
        }

        /**
         * Set session post type segment tracking properties.
         *
         * @param  array $properties
         * @return array
         */
        public function st_add_session_taxonomy_properties( $properties = array(), $post_id = 0 ) {
            global $post;            

            if ( 0 === $post_id || empty( $post_id ) ) {
                $post_id = $post->ID;
            }

            $session_terms = get_the_terms( $post_id, 'session_categories' );

            if ( $session_terms && ! is_wp_error( $session_terms ) ) {
                
                $session_category_name = wp_list_pluck( $session_terms, 'name' );
                
                if ( is_array( $session_category_name ) && count( $session_category_name ) > 0 ) {
                    $properties['Session_Category'] = implode( ', ', $session_category_name );
                }
            }

            $company_id = get_field( 'company', $post_id );

            if ( ! empty( $company_id ) ) {
                $properties['Company'] = get_the_title( $company_id );
            }

            $speakers = get_field( 'speakers', $post_id );

            if ( ! empty( $speakers ) && is_array( $speakers ) ) {
                
                $speakers_name = array();
                
                foreach ( $speakers as $speaker_id ) {
                    $speakers_name[] = get_the_title( $speaker_id );
                }

                if ( count( $speakers_name ) > 0 ) {
                    $properties['Speakers'] = implode( ', ', $speakers_name );
                }
            }

            $session_status = get_field( 'session_status', $post_id );

            if ( ! empty( $session_status ) && 'select' !== strtolower( $session_status ) ) {
                $properties['Session_Status'] = $session_status;
            }

            $session_date = get_field( 'session_date', $post_id );

            if ( ! empty( $session_date ) ) {
                $properties['Session_Date_Start_Time'] = date_format( date_create( $session_date ), 'F j, Y g:i a' );
            }

            $session_end_time = get_field( 'session_end_time', $post_id );

            if ( ! empty( $session_end_time ) ) {
                $properties['Session_Date_End_Time'] = date_format( date_create( $session_end_time ), 'F j, Y g:i a' );
            }

            return $properties;
        }

        /**
         * Set company post type segment tracking properties.
         *
         * @param  array $properties
         * @return array
         */
        public function st_add_company_taxonomy_properties( $properties = array(), $post_id = 0 ) {
            global $post;            

            if ( 0 === $post_id || empty( $post_id ) ) {
                $post_id = $post->ID;
            }

            $featured_terms = get_field( 'product_categories', $post_id );            

            if ( ! empty( $featured_terms ) && is_array( $featured_terms ) && count( $featured_terms ) > 0 ) {

                $terms_name = get_terms( array(
                        'taxonomy'      => 'company-product-category',
                        'hide_empty'    => false,
                        'include'       => $featured_terms,
                        'fields'        => 'names'
                    )
                );                

                if ( $terms_name && ! is_wp_error( $terms_name ) && is_array( $terms_name ) ) {
                    
                    $properties['Featured_Product_Categories'] = implode( ', ', $terms_name );
                }
            }

            $search_terms = get_field( 'search_product_categories', $post_id );            

            if ( ! empty( $search_terms ) && is_array( $search_terms ) && count( $search_terms ) > 0 ) {

                $search_terms_name = get_terms( array(
                        'taxonomy'      => 'company-product-category',
                        'hide_empty'    => false,
                        'include'       => $search_terms,
                        'fields'        => 'names'
                    )
                );                

                if ( $search_terms_name && ! is_wp_error( $search_terms_name ) && is_array( $search_terms_name ) ) {
                    
                    $properties['Additional_Search_Only_Categories'] = implode( ', ', $search_terms_name );
                }
            }

            $member_level = get_field( 'member_level', $post_id );

            if ( ! empty( $member_level ) && 'select' !== $member_level ) {
                $properties['Member_Level'] = $member_level;
            }

            $company_location = get_field( 'company_location', $post_id );

            if ( $company_location ) {
                
                if ( isset( $company_location['city'] ) && ! empty( $company_location['city'] ) ) {
                    $properties['City'] = $company_location['city'];
                }
                if ( isset( $company_location['state'] ) && ! empty( $company_location['state'] ) ) {
                    $properties['State'] = $company_location['state'];
                }
                if ( isset( $company_location['country'] ) && ! empty( $company_location['country'] ) ) {
                    $properties['Country'] = $company_location['country'];
                }
            }

            $advertiser = $this->st_get_sponsored_content_advertiser( $post_id );

            if ( ! empty( $advertiser ) ) {
                $properties['Sponsored_Content_Advertiser'] = $advertiser;
            }

            return $properties;
        }

        /**
         * Set compnay product post type segment tracking properties.
         *
         * @param  array $properties
         * @return array
         */
        public function st_add_company_products_taxonomy_properties( $properties = array(), $post_id = 0 ) {
            global $post;

            if ( 0 === $post_id || empty( $post_id ) ) {
                $post_id = $post->ID;
            }

            $product_category = get_the_terms( $post_id, 'company-product-category' );

            if ( $product_category && ! is_wp_error( $product_category ) ) {

                $product_category_name = wp_list_pluck( $product_category, 'name' );
                if ( is_array( $product_category_name ) && count( $product_category_name ) > 0 ) {
                    $properties['Product_Categories'] = implode( ', ', $product_category_name );
                }                
            }

            $company = get_field( 'nab_selected_company_id', $post_id );

            if ( ! empty( $company ) ) {
                $properties['Company'] = get_the_title( $company );
            }

            $is_featured = get_field( 'is_feature_product', $post_id );

            if ( ! empty( $is_featured ) ) {
                $properties['Is_Featured'] = is_array( $is_featured ) ? $is_featured[0] : $is_featured;
            }

            $advertiser = $this->st_get_sponsored_content_advertiser( $post_id );

            if ( ! empty( $advertiser ) ) {
                $properties['Sponsored_Content_Advertiser'] = $advertiser;
            }

            return $properties;
        }

        /**
         * Set compnay product post type segment tracking properties.
         *
         * @param  array $properties
         * @return array
         */
        public function st_add_product_taxonomy_properties( $properties = array(), $post_id = 0 ) {
            global $post;

            if ( 0 === $post_id || empty( $post_id ) ) {
                $post_id = $post->ID;
            }

            $product = wc_get_product( $post_id );

            $product_category = get_the_terms( $post_id, 'product_cat' );

            if ( $product_category && ! is_wp_error( $product_category ) ) {

                $product_category_name = wp_list_pluck( $product_category, 'name' );
                if ( is_array( $product_category_name ) && count( $product_category_name ) > 0 ) {
                    $properties['Product_Categories'] = implode( ', ', $product_category_name );
                }
            }

            $product_tags = get_the_terms( $post_id, 'product_tag' );

            if ( $product_tags && ! is_wp_error( $product_tags ) ) {

                $product_tags_name = wp_list_pluck( $product_tags, 'name' );
                if ( is_array( $product_tags_name ) && count( $product_tags_name ) > 0 ) {
                    $properties['Product_Tags'] = implode( ', ', $product_tags_name );
                }
            }
            
            $stock_status       = $product->get_stock_status();
            $stock_status_label = array(
                'instock'       => 'Available for Purchase',
                'outofstock'    => 'Sold Out',
            );

            $properties['Stock_Status'] = isset( $stock_status_label[ $stock_status ] ) ? $stock_status_label[ $stock_status ] : '';
            
            $properties['Regular_Price'] = $product->regular_price;

            if ( ! empty( $product->sale_price ) ) {
                $properties['Sales_Price'] = $product->sale_price;
            }

            return $properties;
        }

        /**
         * Added setting page under the wp admin settings.
         */
        public function st_add_setting_page_menu() {

            add_submenu_page(
                'options-general.php',
                __('Segment Settings', 'segment-events-tracking'),
                __('Segment Settings', 'segment-events-tracking'),
                'manage_options',
                'segment_event_settings',
                array( $this, 'st_segment_setting_page_callback' )
            );            
        }

        /**
         * Display setting page for segement event tracking.
         */
        public function st_segment_setting_page_callback() {
            
            $segment_api_key = filter_input( INPUT_POST, 'segment_api_key', FILTER_SANITIZE_STRING );

            if ( isset( $segment_api_key ) ) {
                update_option( 'segment_tracking_api_key', $segment_api_key );
                ?>
                <div class="notice notice-success is-dismissible"> 
                    <p><strong>Settings saved.</strong></p>
                </div>
                <?php                
            } else {
                $segment_api_key = get_option( 'segment_tracking_api_key' );
            }
            ?>
            <div class="search-settings">
                <h2>Segment Settings</h2>
                <form class="segment-tracking-form" method="post">
                    <table class="form-table" role="presentation">
                        <tr>
                            <th><label for="segment_api_key">API Key</label></th>
                            <td>
                                <input type="text" name="segment_api_key" id="segment_api_key" value="<?php echo esc_attr( $segment_api_key ); ?>">
                            </td>
                        </tr>                        
                    </table>
                    <?php submit_button("Save Changes"); ?>
                </form>
            </div>
            <?php
        }
    }

    new Segment_Event_Tracking();
}