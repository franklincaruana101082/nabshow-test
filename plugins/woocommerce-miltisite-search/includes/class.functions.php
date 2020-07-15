<?php

    class Woo_MS_Search_Functions 
        {
            
            var $cache  =   array();
            
                           
            /**
            * Return Options
            * 
            */
            static public function get_options()
                {
                    
                    $_options   =   get_site_option('woo_ms_search_options');
                    
                    $defaults = array (
                                             'version'                          =>  '1.0',
                                             
                                       );
                    
                    $options = wp_parse_args( $_options, $defaults );
                          
                    return $options;  
                    
                }
            
            /**
            * Update Options
            *     
            * @param mixed $options
            */
            static public function update_options($options)
                {
                    
                    update_site_option('woo_ms_search_options', $options);
                    
                    
                }
            
                    
            /**
            * Return a list of blogs to be used along with the plugin
            * 
            */
            function get_woo_shops()
                {
                    
                    $args   =   array(
                                        'number'    =>  9999
                                        );
                    $sites  =   get_sites( $args );
                                
                    foreach ($sites as  $key    =>  $site)
                        {
                            switch_to_blog($site->blog_id);
                            
                            if (! $this->is_plugin_active( 'woocommerce/woocommerce.php') )
                                {
                                    unset($sites[$key]);
                                }
                                
                            restore_current_blog();
                               
                        }
                        
                    $sites  =   array_values($sites);
                    
                    return $sites;   
                    
                }
                      
                
            function is_plugin_active( $plugin_slug )
                {
                    
                    include_once ( ABSPATH.'wp-admin/includes/plugin.php' );
                    
                    return ( is_plugin_active( $plugin_slug ) );
                    
                }
                
            
            /**
            * Return current url
            * 
            */
            function current_url()
                {
                    
                    $current_url    =   'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                    
                    return $current_url;
                    
                }
                
           
                
        }


?>