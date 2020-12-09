<?php
/**
 * All API facing functions
 */

namespace codexpert\Share_Logins_Pro;

/**
 * if accessed directly, exit.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @package Plugin
 * @subpackage API
 * @author Nazmul Ahsan <n.mukto@gmail.com>
 */
class API extends Hooks {


    /**
     * Constructor function
     */
    public function __construct( $plugin, $request ) {

        $this->version      = $plugin['Version'];
        $this->request      = $request;
        $this->namespace    = CXSL_API_NAMESPACE;
        $this->ncrypt       = ncrypt();
    }

    public function register_endpoints() {

        if( !cx_is_active() ) return;

        /**
         * @endpoint base /wp-json/share-logins/ (not in use)
         * @endpoint /?rest_route=/share-logins/
         */
        register_rest_route( $this->namespace, '/create-user', array(
            'methods'   => 'POST',
            'callback'  => array( $this, 'create_user' ),
        ) );
        register_rest_route( $this->namespace, '/reset-password', array(
            'methods'   => 'POST',
            'callback'  => array( $this, 'password_reset' ),
        ) );
        register_rest_route( $this->namespace, '/update-user', array(
            'methods'   => 'POST',
            'callback'  => array( $this, 'update_user' ),
        ) );
        register_rest_route( $this->namespace, '/delete-user', array(
            'methods'   => 'DELETE',
            'callback'  => array( $this, 'delete_user' ),
        ) );
    }

    public function create_user( $request ) {
        $parameters = json_decode( $this->ncrypt->decrypt( $request->get_param( 'token' ) ), true );

        if( $parameters['access_token'] != cx_get_access_token() ) return;
        if( !cx_config_is_enabled( 'incoming', $parameters['site_url'], 'create-user' ) ) return;

        remove_action( 'user_register', array( $this->request, 'create_user' ) );
        
        $user_login = $this->ncrypt->decrypt( $parameters['user_login'] );
        $user_pass = str_replace( '-', '=', $this->ncrypt->decrypt( $parameters['user_pass'] ) );
        $user_id = wp_create_user( $user_login, $user_pass, $parameters['user_email'] );

        if ( $user_id && ! is_wp_error( $user_id ) ) {
            
            $data = array(
                'ID'            => $user_id,
                'user_url'      => $parameters['user_url'],
                'first_name'    => $parameters['first_name'],
                'last_name'     => $parameters['last_name'],
                'display_name'  => $parameters['display_name'],
            );
            wp_update_user( $data );
    
            $user = new \WP_User( $user_id );
    
            /**
             * Assign user roles accordingly
             */
            $roles = cx_get_option( 'share-logins_basics', 'decide_roles', 'existing' );
            if( 'override' == $roles ) {
                $user->remove_role( get_option( 'default_role' ) );
                foreach( $parameters['roles'] as $role ) $user->add_role( $role );
    
            }
            elseif( 'both' == $roles ) {
                foreach( $parameters['roles'] as $role ) $user->add_role( $role );
            }
    
            /**
             * Update user meta data
             */
            if( isset( $parameters['meta'] ) && is_array( $parameters['meta'] ) && count( $parameters['meta'] ) > 0 ) :
            foreach ( $parameters['meta'] as $key => $value ) {
                update_user_meta( $user_id, $key, $value );
            }
            endif;
    
            cx_add_log( 'create', 'incoming', $user_login, $parameters['site_url'] );
        }        

        return $parameters;
    }

    public function password_reset( $request ) {
        $parameters = json_decode( $this->ncrypt->decrypt( $request->get_param( 'token' ) ), true );

        if( $parameters['access_token'] != cx_get_access_token() ) return;
        if( !cx_config_is_enabled( 'incoming', $parameters['site_url'], 'reset-password' ) ) return;

        remove_action( 'password_reset', array( $this->request, 'password_reset' ) );
        remove_action( 'profile_update', array( $this->request, 'update_user' ) );
        
        $user_login = $this->ncrypt->decrypt( $parameters['user_login'] );
        $user_pass = str_replace( '-', '=', $this->ncrypt->decrypt( $parameters['user_pass'] ) );
        
        if( $user = get_user_by( 'login', $user_login ) ) :

        wp_set_password( $user_pass, $user->ID );
        
        cx_add_log( 'reset', 'incoming', $user_login, $parameters['site_url'] );

        endif;

        return $parameters;
    }

    public function update_user( $request ) {
        $parameters = json_decode( $this->ncrypt->decrypt( $request->get_param( 'token' ) ), true );

        if( $parameters['access_token'] != cx_get_access_token() ) return;
        if( !cx_config_is_enabled( 'incoming', $parameters['site_url'], 'update-user' ) ) return;

        remove_action( 'profile_update', array( $this->request, 'update_user' ) );

        $user_login = $this->ncrypt->decrypt( $parameters['user_login'] );
        
        if( $user = get_user_by( 'login', $user_login ) ) :

        $data = array(
            'ID'            => $user->ID,
            'user_email'    => $parameters['user_email'],
            // 'user_pass'     => $parameters['user_pass'],
            'user_nicename' => $parameters['user_nicename'],
            'user_url'      => $parameters['user_url'],
            'first_name'    => $parameters['first_name'],
            'last_name'     => $parameters['last_name'],
            'display_name'  => $parameters['display_name'],
            'description'   => $parameters['description'],
        );
        
        if( isset( $parameters['user_pass'] ) ) $data['user_pass'] = str_replace( '-', '=', $this->ncrypt->decrypt( $parameters['user_pass'] ) );
        
        wp_update_user( $data );

        /**
         * Assign user roles accordingly
         */
        $roles = cx_get_option( 'share-logins_basics', 'decide_roles', 'existing' );
        if( 'override' == $roles ) {
            foreach( $user->roles as $role ) $user->remove_role( $role );
            foreach( $parameters['roles'] as $role ) $user->add_role( $role );

        }
        elseif( 'both' == $roles ) {
            foreach( $parameters['roles'] as $role ) $user->add_role( $role );
        }

        /**
         * Update user meta data
         */
        if( isset( $parameters['meta'] ) && is_array( $parameters['meta'] ) && count( $parameters['meta'] ) > 0 ) :
        foreach ( $parameters['meta'] as $key => $value ) {
            update_user_meta( $user->ID, $key, $value );
        }
        endif;

        cx_add_log( 'update', 'incoming', $user_login, $parameters['site_url'] );
        endif;

        return $parameters;
    }

    public function delete_user( $request ) {
        $parameters = json_decode( $this->ncrypt->decrypt( $request->get_param( 'token' ) ), true );

        if( $parameters['access_token'] != cx_get_access_token() ) return;
        if( !cx_config_is_enabled( 'incoming', $parameters['site_url'], 'delete-user' ) ) return;

        remove_action( 'delete_user', array( $this->request, 'delete_user' ) );
        
        $user_login = $this->ncrypt->decrypt( $parameters['user_login'] );
        
        if( $user = get_user_by( 'login', $user_login ) ) :

        if( !function_exists( 'wp_delete_user' ) ) require_once( ABSPATH . 'wp-admin/includes/user.php' );
        wp_delete_user( $user->ID );

        cx_add_log( 'delete', 'incoming', $user_login, $parameters['site_url'] );

        endif;

        return $parameters;
    }
}