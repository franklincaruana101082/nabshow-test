<?php
/**
 * All admin facing functions
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
 * @subpackage Hooks
 * @author Nazmul Ahsan <n.mukto@gmail.com>
 */
class Hooks {

    /**
     * Constructor function
     */
    public function __construct( $plugin ) {
        $this->name     = $plugin['Name'];
        $this->slug     = $plugin['TextDomain'];
        $this->version  = $plugin['Version'];
    }
    
    /**
     * @see register_activation_hook
     * @uses codexpert\Share_Logins_Pro\Admin
     * @uses codexpert\Share_Logins_Pro\Front
     * @uses codexpert\Share_Logins_Pro\API
     */
    public function activate( $callback ) {
        register_activation_hook( CXSL_PRO, array( $this, $callback ) );
    }
    
    /**
     * @see register_activation_hook
     * @uses codexpert\Share_Logins_Pro\Admin
     * @uses codexpert\Share_Logins_Pro\Front
     * @uses codexpert\Share_Logins_Pro\API
     */
    public function deactivate( $callback ) {
        register_deactivation_hook( CXSL_PRO, array( $this, $callback ) );
    }
    
    /**
     * @see add_action
     * @uses codexpert\Share_Logins_Pro\Admin
     * @uses codexpert\Share_Logins_Pro\Front
     */
    public function action( $tag, $callback, $num_args = 1, $priority = 10 ) {
        add_action( $tag, array( $this, $callback ), $priority, $num_args );
    }

    /**
     * @see add_filter
     * @uses codexpert\Share_Logins_Pro\Admin
     * @uses codexpert\Share_Logins_Pro\Front
     */
    public function filter( $tag, $callback, $num_args = 1, $priority = 10 ) {
        add_filter( $tag, array( $this, $callback ), $priority, $num_args );
    }

    /**
     * @see add_shortcode
     * @uses codexpert\Share_Logins_Pro\Shortcode
     */
    public function register( $tag, $callback ) {
        add_shortcode( $tag, array( $this, $callback ) );
    }

    /**
     * @see add_action( 'wp_ajax_..' )
     * @uses codexpert\Share_Logins_Pro\AJAX
     */
    public function priv( $handle, $callback ) {
        $this->action( "wp_ajax_{$handle}", $callback );
    }

    /**
     * @see add_action( 'wp_ajax_nopriv_..' )
     * @uses codexpert\Share_Logins_Pro\AJAX
     */
    public function nopriv( $handle, $callback ) {
        $this->action( "wp_ajax_nopriv_{$handle}", $callback );
    }
}