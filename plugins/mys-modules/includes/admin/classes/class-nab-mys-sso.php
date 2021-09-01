<?php
/**
 * MYS Single Sign-On
 *
 * @package MYS Modules
 * @since   1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'NAB_MYS_SSO' ) ) {

	/**
	 * Class NAB_MYS_SSO
	 */
	class NAB_MYS_SSO extends NAB_MYS_Sync_Parent {

		/**
		 * Class Constructor
		 */
		public function __construct() {

			$this->init_hook();

            parent::__construct();
		}

        /**
		 * setup WP hooks
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
        private function init_hook() {

            // add mys url hidden field in the WC login and sign up page.
            add_action( 'woocommerce_register_form_end', array( $this, 'nab_mys_add_mys_url_hidden_field' ) );
            add_action( 'woocommerce_login_form_end', array( $this, 'nab_mys_add_mys_url_hidden_field' ) );

            // Redirect user to mys.
            add_filter( 'woocommerce_login_redirect', array( $this, 'nab_mys_login_redirect_to_mys' ), 999999, 2 );
            add_filter( 'woocommerce_registration_redirect', array( $this, 'nab_mys_register_redirect_to_mys' ), 9999, 1 );
            add_action( 'template_redirect', array( $this, 'nab_mys_template_redirect_to_mys' ), 999 );

        }

         /**
		 * add mysurl hidden field in the WC login and sign up page.
		 *
		 * @package MYS Modules
		 * @since 1.0.0
		 */
        public function nab_mys_add_mys_url_hidden_field() {

            $mys_url = filter_input( INPUT_GET, 'mysUrl', FILTER_SANITIZE_STRING );

            if ( isset( $mys_url ) && ! empty( $mys_url ) ) {
                ?>
                <input type="hidden" name="mysUrl" value="<?php echo esc_attr( $mys_url ); ?>" />
                <?php
            }
        }

        /**
         * Woocomerce login redirect.
         *
         * @param  string $redirect
         * @param  object $user
         *
         * @return string
         */
        public function nab_mys_login_redirect_to_mys( $redirect, $user ) {

            $mys_url = filter_input( INPUT_POST, 'mysUrl', FILTER_SANITIZE_STRING );

            if ( isset( $mys_url ) && ! empty( $mys_url ) ) {

                $this->nab_mys_redirect_user_to_mys( $mys_url, $user );
            }

            return $redirect;
        }

        /**
         * Woocomerce register redirect.
         *
         * @param  string $redirect         
         *
         * @return string
         */
        public function nab_mys_register_redirect_to_mys( $redirect_url ) {

            $mys_url = filter_input( INPUT_POST, 'mysUrl', FILTER_SANITIZE_STRING );

            if ( isset( $mys_url ) && ! empty( $mys_url ) ) {

                $current_user = wp_get_current_user();
            
                $this->nab_mys_redirect_user_to_mys( $mys_url, $current_user );
            }

            return $redirect_url;
        }

        /**
         * Redirect user to MYS if user logged in and contain mysUrl parameter in the URL.
         */
        public function nab_mys_template_redirect_to_mys() {

            $mys_url = filter_input( INPUT_GET, 'mysUrl', FILTER_SANITIZE_STRING );

            if ( isset( $mys_url ) && ! empty( $mys_url ) && is_user_logged_in() ) {

                $current_user = wp_get_current_user();
            
                $this->nab_mys_redirect_user_to_mys( $mys_url, $current_user );
            }
        }

        /**
         * Redirect user to MYS page.
         * 
         * @param string $mys_url
         * @param object $current_user
         */
        private function nab_mys_redirect_user_to_mys( $mys_url, $current_user ) {

            if ( isset( $mys_url ) && ! empty( $mys_url ) ) {
            
                $guid = $this->nab_mys_create_guid( $current_user->user_email );
                
                if ( ! $guid ) {
                    
                    $registrant_id  = $this->nab_mys_get_registrant_id( $current_user->user_email );
                    $user_data      = $this->nab_mys_user_data( $current_user );
                    
                    $user_data['altRegID'] = $registrant_id;

                    $success = $this->nab_mys_create_mys_user( $user_data );

                    if ( $success ) {

                        $guid = $this->nab_mys_create_guid( $current_user->user_email );
                    }
                }
                
                if ( $guid && ! empty( $guid ) ) {

                    $redirect_params    = array( 'userGuid' => $guid, 'emailAddress' => $current_user->user_email );
                    $redirect_url       = add_query_arg( $redirect_params, $mys_url );

                    wp_redirect( $redirect_url );
                    exit();
                }
            }
        }

        /**
		 * Create MYS GUID.
		 *
         * @param string $email_address
         * 
		 * @package MYS Modules
		 * @since 1.0.0
		 */
        private function nab_mys_create_guid( $email_address ) {

            $mys_token              = $this->nab_mys_api_token_from_cache();            
            $nab_mys_token_response = $mys_token['token_response'];
            $main_api_url           = isset( $this->nab_mys_urls['main_url'] ) && ! empty ( $this->nab_mys_urls['main_url'] ) ? $this->nab_mys_urls['main_url'] : '';
            $guid                   = false;

            if ( ! empty( $nab_mys_token_response ) && ! empty( $main_api_url ) && ! empty( $email_address ) ) {
                
                $guid_api_url       = $main_api_url . '/Users/CreateGUID';
                $authorization      = 'Bearer ' . $nab_mys_token_response;
                $args               = array( 'emailAddress' => $email_address );
                $headers            = array(
                    'Authorization' => $authorization
                );

                $request= array(
                    'headers'   => $headers,
                    'method'    => 'GET'                    
                );

                $guid_api_url   = add_query_arg( $args, $guid_api_url );
                $response       = vip_safe_wp_remote_get( $guid_api_url, false, 10, 15, 20, $request );
                
                if ( ! is_wp_error( $response ) ) {

                    $response_body  = json_decode( $response['body'] );
                    $guid           = isset( $response_body[0]->userguid ) && ! empty( $response_body[0]->userguid ) ? $response_body[0]->userguid : $guid;
                }

            }

            return $guid;
        }

        /**
		 * Get registrant ID from the API(maritz).
		 *
         * @param string $email_address
         * 
         * @return string
         * 
		 * @package MYS Modules
		 * @since 1.0.0
		 */
        private function nab_mys_get_registrant_id( $email_address ) {
            
            $registrant_id = 'DIGITAL';

            if ( empty( $email_address ) ) {
                return $registrant_id;
            }

            $registrant_api_url = 'https://amplify-api.nabops.com/experient-registrants/find-by-email';
            $args               = array( 'email' => $email_address );
			$headers            = array(
				'x-api-key'     => 'XAczEe4m0Z8V0RJGDZqzk7UIZrddtksK2Ehtowtv',
				'Content-Type'  => 'application/json'
			);

			$request    = array(
				'headers'   => $headers,
				'method'    => 'POST',
                'body'      => wp_json_encode( $args )
			);

            $response   = vip_safe_wp_remote_get( $registrant_api_url, false, 10, 5, 20, $request );

            if ( ! is_wp_error( $response ) ) {

                $response_body = json_decode( $response['body'] );
                $registrant_id = isset( $response_body->registrant_id ) && ! empty( $response_body->registrant_id ) ? $response_body->registrant_id : $registrant_id;
            }

            return $registrant_id;

        }

        /**
		 * Prepare user data.
		 *
         * @param object|false $current_user
         * 
         * @return array
         * 
		 * @package MYS Modules
		 * @since 1.0.0
		 */
        private function nab_mys_user_data( $current_user = false ) {

            $current_user       = false === $current_user ? wp_get_current_user() : $current_user;         
            $current_user_id    = $current_user->ID;
            $first_name         = get_user_meta( $current_user_id, 'first_name', true );
            $last_name          = get_user_meta( $current_user_id, 'last_name', true );
            $company            = get_user_meta( $current_user_id, 'attendee_company', true );
            $title              = get_user_meta( $current_user_id, 'attendee_title', true );
            $city               = get_user_meta( $current_user_id, 'user_city', true );
            $state              = get_user_meta( $current_user_id, 'user_state', true );
            $country            = get_user_meta( $current_user_id, 'user_country', true );

            $params = array( 
                'emailAddress'              => $current_user->user_email,
                'allowExhibitorsToContact'  => 0,
                'validated'                 => 0,
                'password'                  => uniqid(),
            );

            if ( ! empty( $first_name ) ) {
                $params['firstName'] = $first_name;
            }
            if ( ! empty( $last_name ) ) {
                $params['lastName'] = $last_name;
            }
            if ( ! empty( $company ) ) {
                $params['company'] = urlencode( $company );
            }
            if ( ! empty( $title ) ) {
                $params['title'] = urlencode( $title );
            }
            if ( ! empty( $city ) ) {
                $params['city'] = $city;
            }
            if ( ! empty( $state ) ) {
                $params['state'] = $state;
            }
            if ( ! empty( $country ) ) {
                $params['country'] = $country;
            }

            return $params;
        }

        /**
		 * Create new user on MYS.
		 *
         * @param array $params
         * 
         * @return boolean
         * 
		 * @package MYS Modules
		 * @since 1.0.0
		 */
        private function nab_mys_create_mys_user( $params = array() ) {

            $mys_token              = $this->nab_mys_api_token_from_cache();            
            $nab_mys_token_response = $mys_token['token_response'];
            $main_api_url           = isset( $this->nab_mys_urls['main_url'] ) && ! empty ( $this->nab_mys_urls['main_url'] ) ? $this->nab_mys_urls['main_url'] : '';
            $success                = false;

            if ( ! empty( $nab_mys_token_response ) && ! empty( $main_api_url ) && is_array( $params ) && count( $params ) > 0 ) {
                
                $user_api_url       = $main_api_url . '/Users';
                $authorization      = 'Bearer ' . $nab_mys_token_response;
                $headers            = array(
                    'Authorization' => $authorization
                );

                $request= array(
                    'headers'   => $headers,
                    'method'    => 'POST'                    
                );

                $user_api_url   = add_query_arg( $params, $user_api_url );
                $response       = vip_safe_wp_remote_get( $user_api_url, false, 10, 15, 20, $request );
                
                
                if ( ! is_wp_error( $response ) ) {

                    $response_body  = json_decode( $response['body'] );
                    $success        = isset( $response_body[0]->success ) && ! empty( $response_body[0]->success ) ? true : $success;
                }

            }

            return $success;
            
        }

	}
}
new NAB_MYS_SSO();
