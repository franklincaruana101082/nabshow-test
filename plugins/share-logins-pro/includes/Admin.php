<?php
/**
 * All admin facing functions
 */

namespace codexpert\Share_Logins_Pro;
use codexpert\Product\License;

/**
 * if accessed directly, exit.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * @package Plugin
 * @subpackage Admin
 * @author Nazmul Ahsan <n.mukto@gmail.com>
 */
class Admin extends Hooks {

    /**
     * Constructor function
     */
    public function __construct( $plugin ) {
        $this->slug     = $plugin['TextDomain'];
        $this->name     = $plugin['Name'];
        $this->version  = $plugin['Version'];
    }

    /**
     * Add some script to head
     */
    public function head() {

    }
    
    /**
     * Enqueue JavaScripts and stylesheets
     */
    public function enqueue_scripts( $hook ) {

        if ( $hook == 'toplevel_page_share-logins' ) {

            $min = defined( 'CXSL_PRO_DEBUG' ) && CXSL_PRO_DEBUG ? '' : '.min';
            
            wp_enqueue_style( $this->slug . '-pro', plugins_url( "/assets/css/admin{$min}.css", CXSL_PRO ), '', $this->version, 'all' );

            wp_enqueue_script( $this->slug . '-pro', plugins_url( "/assets/js/admin{$min}.js", CXSL_PRO ), array( 'jquery' ), $this->version, true );
        }
    }

    public function admin_notices() {
        // Free version is not installed
        if( !cx_is_lite_installed() ) {

            $installation_url = wp_nonce_url( admin_url( 'update.php?action=install-plugin&plugin=share-logins' ), 'install-plugin_share-logins' );
            printf( "
                <div class='notice notice-error notice-required' id='license-notice-%s' style=''>
                    <p><strong>Share Logins</strong> needs to be installed and activated! <a href='%s'>Click here</a> to install now.</p>
                </div>
            ", $this->name, $installation_url );
        }

        // Free version is not activated
        if( cx_is_lite_installed() && !cx_is_lite_active() ) {
            $activation_url = wp_nonce_url( admin_url( 'plugins.php?action=activate&plugin=share-logins/share-logins.php&plugin_status=all&paged=1&s' ), 'activate-plugin_share-logins/share-logins.php' );
            printf( "
                <div class='notice notice-error notice-required' id='license-notice-%s' style=''>
                    <p><strong>Awesome!</strong> Looks like you already have <strong>Share Logins</strong> installed. Please <a href='%s'>activate it</a> now.</p>
                </div>
            ", $this->name, $activation_url );
        }

        // Hide pro license div
        if( !cx_is_lite_active() || !cx_is_lite_installed() ) {
            echo "<style>#license-notice-share-logins.notice.notice-error:not(.notice-required){display:none}</style>";
        }
    }

    public function cx_is_pro( $status ) {
        return true;
    }
}