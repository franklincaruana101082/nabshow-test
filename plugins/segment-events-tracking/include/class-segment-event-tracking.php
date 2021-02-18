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
                add_action( 'user_profile_image_updated', array( $this, 'st_user_profile_image_updated' ) );
                add_action( 'nab_message_send', array( $this, 'st_company_rep_message_sent' ), 10, 3 );
                //add_action( 'nab_bookmark_added', array( $this, 'st_bookmark_added', 10, 2 ) );
                add_action( 'wp_head', array( $this, 'st_page_event' ) );

                add_action( 'wp_ajax_st_track_site_feedback', array( $this, 'st_track_site_feedback_callback' ) );
                add_action( 'wp_ajax_nopriv_st_track_site_feedback', array( $this, 'st_track_site_feedback_callback' ) );
            }
        }

        public function st_enqueue_script() {            
            wp_enqueue_script( 'st-segement-event-js', plugin_dir_url( __DIR__ ) . 'js/st-segement-event-tracking.js' );
            wp_localize_script( 'st-segement-event-js', 'segmentJS', array(
                'ajaxurl' => admin_url('admin-ajax.php'),
                'nabNonce' => wp_create_nonce('nab-ajax-nonce'),
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

        public function st_track_site_feedback_callback() {

            check_ajax_referer( 'nab-ajax-nonce', 'nabNonce' );

            if ( is_user_logged_in() ) {

                $user_id = get_current_user_id();

                $track_event = array(
                    'userId'    => $user_id,
                    'event'     => 'Site_feedback',
                );
    
                $track_event['properties'] = $this->st_add_user_taxonomy_properties( $user_id );
    
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

        /**
         * track page event.
         */
        public function st_page_event() {

            global $post;

            if ( is_search() ) {

                $search_track = array(
                    'event'         => 'Viewed_Search_Page',
                    'properties'    => array(
                        'Search_Term' => get_search_query()
                    )
                );                

                $this->st_track_event( $search_track );
            }
            
            if ( is_admin() || ! isset( $post->ID ) || empty( $post->ID ) || is_post_type_archive() || is_tax() ) {
                return;
            }
            
            $page_track = array();

            if ( is_user_logged_in() ) {
                $page_track['userId'] = get_current_user_id(); 
            } else {
                $page_track['anonymousId'] = uniqid();
            }

            if ( isset( $post->ID ) && ! empty( $post->ID ) ) {
                
                $is_wc = false;

                if ( function_exists( 'is_woocommerce' ) ) {
                    $is_wc = true;
                }

                if ( $is_wc && is_woocommerce() && is_shop() ) {
                    $page_track['name'] = 'Shop Page';
                } else {
                    if ( is_front_page() ) {
                        $page_track['name'] = 'Home Page';
                    } else {
                        $page_track['name'] = get_the_title();
                    }
                }                
            }

            $page_track['properties'] = $this->st_get_tracking_properties();            
            
            Segment::page( $page_track );
        }

        public function st_get_tracking_properties() {

            global $post;

            $properties = array();

            if ( isset( $post->ID ) && ! empty( $post->ID ) ) {

                $is_wc = false;

                if ( function_exists( 'is_woocommerce' ) ) {
                    $is_wc = true;
                }

                if ( $is_wc && is_woocommerce() && is_shop() ) {

                    $shop_page_id               = wc_get_page_id( 'shop' );
                    $properties['Post_ID']      = $shop_page_id;
                    $properties['Post_Type']    = 'Products';
                    $properties['URL']          = get_permalink( $shop_page_id );                    
                    
                } else {
                    
                    $current_post_type          = get_post_type( $post->ID );
                    $post_type_obj              = get_post_type_object( $current_post_type );
                    $post_type_name             = isset( $post_type_obj->labels->singular_name ) && ! empty( $post_type_obj->labels->singular_name ) ?  $post_type_obj->labels->singular_name : $current_post_type;
                    $properties['Post_ID']      = $post->ID;
                    $properties['Post_Type']    = $post_type_name;

                    if ( is_front_page() ) {
                        $properties['URL'] = get_site_url();
                    } else {
                        $properties['URL'] = get_the_permalink( $post->ID );
                    }
                    
                    $post_type_taxonomy_func = array (                        
                        'articles'          => 'st_add_article_taxonomy_properties',
                        'page'              => 'st_add_page_taxonomy_properties',
                        'company'           => 'st_add_company_taxonomy_properties',
                        'company-products'  => 'st_add_company_products_taxonomy_properties',
                        'product'           => 'st_add_product_taxonomy_properties',
                    );

                    if ( isset( $post_type_taxonomy_func[ $current_post_type ] ) ) {

                        $properties = $this->{$post_type_taxonomy_func[ $current_post_type ]}( $properties );
                    }
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
        public function st_add_product_taxonomy_properties( $properties = array() ) {
            global $product;            

            $product_category = get_the_terms( $product->id, 'product_cat' );

            if ( $product_category && ! is_wp_error( $product_category ) ) {

                $product_category_name = wp_list_pluck( $product_category, 'name' );
                if ( is_array( $product_category_name ) && count( $product_category_name ) > 0 ) {
                    $properties['Product_Categories'] = implode( ', ', $product_category_name );
                }
            }

            $product_tags = get_the_terms( $product->id, 'product_tag' );

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