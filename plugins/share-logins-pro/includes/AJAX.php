<?php
/**
 * All AJAX facing functions
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
 * @subpackage AJAX
 * @author Nazmul Ahsan <n.mukto@gmail.com>
 */
class AJAX extends Hooks {

    /**
     * Constructor function
     */
    public function __construct( $plugin ) {
        $this->slug     = $plugin['TextDomain'];
        $this->name     = $plugin['Name'];
        $this->version  = $plugin['Version'];
    }

    public function export_users() {
        if( !wp_verify_nonce( $_POST['_wpnonce'] ) ) {
            wp_send_json( array( 'status' => 0, 'message' => __( 'Unauthorized!', 'share-logins' ) ) );
        }

        if( !cx_is_active() ) {
            wp_send_json( array( 'status' => 0, 'message' => __( 'Please activate your license first!', 'share-logins' ) ) );
        }

        $response = array();

        $get_users = get_users( array(
            'exclude'       => explode( ',', $_POST['exclude'] ),
            'role__not_in'  => isset( $_POST['role__not_in'] ) ? $_POST['role__not_in'] : array(),
        ) );
        $meta_keys = $_POST['meta_keys'];

        $users = array();
        $users['site_title']	= get_bloginfo();
        $users['site_url']		= get_bloginfo( 'url' );
        $users['access_token']	= cx_get_access_token();
        $users['count']			= count( $get_users );

        foreach ( $get_users as $user ) {
            $users['users'][ $user->ID ]['data'] = array(
                'user_login'    => $user->data->user_login,
                'user_nicename' => $user->data->user_nicename,
                'user_email'    => $user->data->user_email,
                'user_url'      => $user->data->user_url,
                'display_name'  => $user->data->display_name,
            );

            $users['users'][ $user->ID ]['roles'] = $user->roles;

            $users['users'][ $user->ID ]['meta'] = array();
            foreach ( $meta_keys as $meta_key ) {
                $users['users'][ $user->ID ]['meta'][ $meta_key ] = get_user_meta( $user->ID, $meta_key, true );
            }
        }

        $file_name  = 'share-logins_export.cx';
        $file_dir   = trailingslashit( WP_CONTENT_DIR ) . 'share-logins-export/';

        if( !wp_mkdir_p( $file_dir ) ) wp_send_json( array( 'status' => 0, 'message' => __( 'Could\'t create directory!', 'share-logins' ) ) );

        $file_path  = $file_dir . $file_name;
        $file_url   = trailingslashit( content_url() ) . "share-logins-export/{$file_name}";

        $file = fopen( $file_path, 'w' ) or wp_send_json( array( 'status' => 0, 'message' => __( 'Unable to open file!', 'share-logins' ) ) );
        fwrite( $file, json_encode( $users ) );
        fclose( $file );

        $response['status']     = 1;
        $response['message']    = sprintf( _n( '%d user is exported!', '%d users are exported!', $users['count'], 'share-logins' ), $users['count'] );
        $response['url']        = $file_url;

        wp_send_json( $response );
    }

    public function import_users() {
        if( !wp_verify_nonce( $_POST['_wpnonce'] ) ) {
            wp_send_json( array( 'status' => 0, 'message' => __( 'Unauthorized!', 'share-logins' ) ) );
        }

        add_filter( 'cx_within_ajax_import', '__return_true' );


        if( !cx_is_active() ) {
            wp_send_json( array( 'status' => 0, 'message' => __( 'Please activate your license first!', 'share-logins' ) ) );
        }

        if( $_FILES['csv']['name'] == '' ) {
            wp_send_json( array( 'status' => 0, 'message' => __( 'Please upload a file!', 'share-logins' ) ) );
        }

        // get content of the uploaded file
        $json = $_FILES['csv'];
        $ext = pathinfo( $json['name'], PATHINFO_EXTENSION );

        if( $ext != 'cx' ) {
            wp_send_json( array( 'status' => 0, 'message' => __( 'Invalid File!', 'share-logins' ) ) );
        }
        
        $content = json_decode( file_get_contents( $json['tmp_name'] ), 1 );

        if( !is_array( $content ) || !is_array( $content['users'] ) ) {
            wp_send_json( array(
                'status'    => 0,
                'message'   => __( 'Somethins is wrong!', 'share-logins' ),
            ) );
        }

        // configure
        $replace = $_POST['replace'] == 'on';
        $remove_role = $_POST['remove_role'] == 'on';

        $users = $content['users'];
        $created = $updated = 0;
        foreach ( $users as $u ) {
            // email not found? let's create a new user
            if( !email_exists( $u['data']['user_email'] ) ) {
                // create the user
                $user_id = wp_insert_user( $u['data'] );
                $user = new \WP_User( $user_id );

                // assign roles
                foreach ( $u['roles'] as $role ) {
                    $user->add_role( $role );
                }

                // update user meta
                foreach ( $u['meta'] as $key => $value ) {
                    update_user_meta( $user_id, $key, $value );
                }

                // counter
                $created++;
            }
            // user found and it's allowed to replace existing data
            elseif( $replace ) {
                // find the user
                $user = get_user_by( 'email', $u['data']['user_email'] );
                $user_id = $user->ID;

                // should we remove existing role(s) of the user?
                if( $remove_role ) :
                foreach ( $user->roles as $role ) {
                    $user->remove_role( $role );
                }
                endif;

                // assign roles
                foreach ( $u['roles'] as $role ) {
                    $user->add_role( $role );
                }

                // update user meta
                foreach ( $u['meta'] as $key => $value ) {
                    update_user_meta( $user_id, $key, $value );
                }

                // counter
                $updated++;
            }

        }

        $response = array(
            'status'    => 1,
            'message'   => sprintf( __( '%d users are created & %d users are updated!', 'share-logins' ), $created, $updated ),
        );

        wp_send_json( $response );
    }

}