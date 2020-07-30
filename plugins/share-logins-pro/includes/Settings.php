<?php
/**
 * All settings facing functions
 */

namespace codexpert\Share_Logins_Pro;
use codexpert\Product\License;

/**
 * @package Plugin
 * @subpackage Settings
 * @author Nazmul Ahsan <n.mukto@gmail.com>
 */
class Settings extends Hooks {

    public $plugin;

    /**
     * Constructor function
     */
    public function __construct( $plugin ) {
        $this->plugin   = $plugin;
        $this->slug     = $plugin['TextDomain'];
        $this->name     = $plugin['Name'];
        $this->version  = $plugin['Version'];
    }

    public function add_settings_section( $sections ) {

        if( !isset( $_GET['page'] ) || $_GET['page'] != 'share-logins' ) return $sections;

        unset( $sections['share-logins_upgrade'] );

        $sections['share-logins_license'] = array(
            'id'        => 'share-logins_license',
            'label'     => __( 'License', 'share-logins' ),
            'desc'      => sprintf( __( 'In order to enjoy pro features, you need to activate your license key. Plaese input the key and click Activate. Check your mailbox for the license key. You also can get this from the <a href="%1$s" target="_blank">Dashboard page</a> in our site. If you have any queries, plaese <a href="%2$s" target="_blank">open a ticket</a> here.', 'share-logins' ), 'https://codexpert.io/dashboard/', 'https://help.codexpert.io/' ),
            'icon'      => 'dashicons-admin-network',
            'hide_form' => true,
            'color'     => '#572e8d',
            'fields'    => array(),
        );

        return $sections;
    }

    public function license_form( $section ) {

        if( $section['id'] != 'share-logins_license' ) return;

        $license = new License( $this->plugin, 'admin.php?page=share-logins#share-logins_license' );
        echo $license->activator_form();
    }


    public function basics_section_fields( $fields, $section ) {

        if( $section['id'] != 'share-logins_basics' ) return $fields;

        $fields[] = array(
            'id'        => 'decide_roles',
            'label'     => __( 'Incoming Role Handling' ),
            'type'      => 'select',
            'desc'      => __( 'What to do with the user role when a new user is created by an API request from a remote site?' ),
            'options'   => array(
                'existing'  => __( 'Keep existing role(s)', 'share-logins' ),
                'override'  => __( 'Override with incoming role(s)', 'share-logins' ),
                'both'      => __( 'Keep both/all roles', 'share-logins' ),
            ),
            'default'   => 'both',
            'chosen'    => true,
        );

        $fields[] = array(
            'id'        => 'share-meta_keys',
            'type'      => 'select',
            'label'     => __( 'Custom meta', 'share-logins' ),
            'desc'      => __( 'Which meta fields should be sent to the remote sites when it creates or updates a user? Multiple items can be selected.', 'share-logins' ),
            'multiple'  => true,
            'chosen'    => true,
            'options'   => cx_user_meta_keys(),
        );

        $fields[] = array(
            'id'                => 'password_key',
            'type'              => 'text',
            'label'             => __( 'Password Field', 'share-logins' ),
            'desc'              => __( 'HTML <code>name</code> attribute value of the password field. Don\'t change unless you know what you are doing!', 'share-logins' ),
            'placeholder'       => __( 'password', 'share-logins' ),
        );
        return $fields;
    }
}