<?php
/*
Plugin Name: WooCommerce MultiSite Search
Plugin URI: https://wooglobalcart.com/
Description: Add support for global search on WooCommerce MultiSite environment
Author: Nsp Code
Author URI: https://wooglobalcart.com/ 
Version: 1.0.5
Text Domain: woo-ms-search
Domain Path: /languages/
WC requires at least: 3.0
WC tested up to: 3.7.1
*/


    define('WOOMSSEARCH_PATH',             plugin_dir_path(__FILE__));
    define('WOOMSSEARCH_URL_PROTOCOL',     plugins_url('', __FILE__));
    define('WOOMSSEARCH_URL',              str_replace(array('https:', 'http:'), "", WOOMSSEARCH_URL_PROTOCOL));

    define('WOOMSSEARCH_VERSION',          '1.0.5');
    define('WOOMSSEARCH_APP_API_URL',      'https://wooglobalcart.com'); 
    
    define('WOOMSSEARCH_PRODUCT_ID',       'WOOMSSEARCH');
    define('WOOMSSEARCH_INSTANCE',         preg_replace('/:[0-9]+/', '', str_replace(array ("https://" , "http://"), "", get_site_option('siteurl'))));
    
    //load language files
    add_action( 'plugins_loaded', 'woomssearch_load_textdomain'); 
    function woomssearch_load_textdomain() 
        {
            load_plugin_textdomain('woo-ms-search', FALSE, dirname( plugin_basename( __FILE__ ) ) . '/languages');
        }
        
    
    add_action('plugins_loaded', 'woomssearch_plugins_loaded');
    function woomssearch_plugins_loaded()
        {
           
            include_once( WOOMSSEARCH_PATH . '/includes/class.woo-ms-search.php' );
            include_once( WOOMSSEARCH_PATH . '/includes/class.functions.php' );
            include_once( WOOMSSEARCH_PATH . '/includes/class.licence.php' );
            include_once( WOOMSSEARCH_PATH . '/includes/woo-functions.php' );
            
            //plugin updater
            include_once( WOOMSSEARCH_PATH . '/includes/class.plugin-updater.php');
            
            global $woo_ms_search_query;
            $woo_ms_search_query    =   new Woo_MS_Search();
            
            //Admin
            if(is_admin())
                {
                    //options interface
                    include_once(WOOMSSEARCH_PATH . '/includes/class.interfaces.php');
                    new Woo_MS_Search_interfaces();
                }

            if( !$woo_ms_search_query->licence->licence_key_verify())
                return FALSE;
                
            $woo_ms_search_query->init();
                        
        }
    

?>