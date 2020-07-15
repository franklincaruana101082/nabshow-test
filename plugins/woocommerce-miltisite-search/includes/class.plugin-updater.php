<?php

    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

    /**
    * V 1.2
    */
    class Woo_MS_Search_Plugin_Update
         {

             public     $api_url;
             
             private    $slug;
             public     $plugin;

             private    $API_VERSION;
             
             public function __construct( $api_url, $slug, $plugin )
                 {
                     $this->api_url = $api_url;
                     
                     $this->slug    = $slug;
                     $this->plugin  = $plugin;
                     
                     //use laets available API 
                     $this->API_VERSION =   1.1;
                 
                 }
             
             
             public function check_for_plugin_update($checked_data)
                 {
                     if (empty($checked_data->checked) || !isset($checked_data->checked[$this->plugin]))
                        return $checked_data;
                     
                     $request_string = $this->prepare_request('plugin_update');
                     if($request_string === FALSE)
                        return $checked_data;
                     
                     global $wp_version;
                     
                     // Start checking for an update
                     $request_uri = $this->api_url . '?' . http_build_query( $request_string , '', '&');
                     $data = wp_remote_get( $request_uri, array(
                                                                        'timeout'     => 20,
                                                                        'user-agent'  => 'WordPress/' . $wp_version . '; WOOMSSEARCH/' . WOOMSSEARCH_VERSION .'; ' . get_bloginfo( 'url' ),
                                                                        ) );
                     
                     if(is_wp_error( $data ) || $data['response']['code'] != 200)
                        return $checked_data;
                     
                     $response_block = json_decode($data['body']);
                      
                     if(!is_array($response_block) || count($response_block) < 1)
                        return $checked_data;
                     
                     //retrieve the last message within the $response_block
                     $response_block = $response_block[count($response_block) - 1];
                     $response = isset($response_block->message) ? $response_block->message : '';
                     
                     if (is_object($response) && !empty($response)) // Feed the update data into WP updater
                         {
                             $response  =   $this->postprocess_response( $response );
                             
                             $checked_data->response[$this->plugin] = $response;
                         }
                     
                     return $checked_data;
                 }
             
             
             public function plugins_api_call($def, $action, $args)
                 {
                     if (!is_object($args) || !isset($args->slug) || $args->slug != $this->slug)
                        return $def;
    
                     $request_string = $this->prepare_request($action, $args);
                     if($request_string === FALSE)
                        return new WP_Error('plugins_api_failed', __('An error occour when try to identify the pluguin.' , 'woo-ms-search') . '&lt;/p> &lt;p>&lt;a href=&quot;?&quot; onclick=&quot;document.location.reload(); return false;&quot;>'. __( 'Try again', 'woo-ms-search' ) .'&lt;/a>');;
                     
                     global $wp_version;
                     
                     $request_uri = $this->api_url . '?' . http_build_query( $request_string , '', '&');
                     $data = wp_remote_get( $request_uri, array(
                                                                        'timeout'     => 20,
                                                                        'user-agent'  => 'WordPress/' . $wp_version . '; WOOMSSEARCH/' . WOOMSSEARCH_VERSION .'; ' . get_bloginfo( 'url' ),
                                                                        ) );
                     
                     if(is_wp_error( $data ) || $data['response']['code'] != 200)
                        return new WP_Error('plugins_api_failed', __('An Unexpected HTTP Error occurred during the API request.' , 'woo-ms-search') . '&lt;/p> &lt;p>&lt;a href=&quot;?&quot; onclick=&quot;document.location.reload(); return false;&quot;>'. __( 'Try again', 'woo-ms-search' ) .'&lt;/a>', $data->get_error_message());
                     
                     $response_block = json_decode($data['body']);
                     //retrieve the last message within the $response_block
                     $response_block = $response_block[count($response_block) - 1];
                     $response = $response_block->message;
                     
                     if (is_object($response) && !empty($response))
                         {
                             $response  =   $this->postprocess_response( $response );
                             
                             return $response;
                         }
                 }
             
             private function prepare_request($action, $args = array())
                 {
                     global $wp_version;
                     
                     $licence_data = get_site_option('Woo_MS_Search_license'); 
                     
                     return array(
                                     'woo_sl_action'        => $action,
                                     'version'              => WOOMSSEARCH_VERSION,
                                     'product_unique_id'    => WOOMSSEARCH_PRODUCT_ID,
                                     'licence_key'          => $licence_data['key'],
                                     'domain'               => WOOMSSEARCH_INSTANCE,
                                     
                                     'wp-version'           => $wp_version,
                                     'api_version'          => $this->API_VERSION
                                     
                     );
                 }
                 
                 
             private function postprocess_response( $response )
                 {
                     //include slug and plugin data
                     $response->slug    =   $this->slug;
                     $response->plugin  =   $this->plugin;
                     
                     //if sections are being set
                     if ( isset ( $response->sections ) )
                        $response->sections = (array)$response->sections;
                     
                     //if banners are being set
                     if ( isset ( $response->banners ) )
                        $response->banners = (array)$response->banners;
                       
                     //if icons being set, convert to array
                     if ( isset ( $response->icons ) )
                        $response->icons    =   (array)$response->icons;
                     
                     return $response;
                     
                 }
                 
         }
         
         
         function Woo_MS_Search_run_updater()
             {
             
                 $wp_plugin_auto_update = new Woo_MS_Search_Plugin_Update( WOOMSSEARCH_APP_API_URL, 'woocommerce-miltisite-search', 'woocommerce-miltisite-search/woocommerce-miltisite-search.php');
                 
                 add_filter('pre_set_site_transient_update_plugins',    array(  $wp_plugin_auto_update, 'check_for_plugin_update')  );
                 add_filter('plugins_api',                              array(  $wp_plugin_auto_update, 'plugins_api_call'), 10, 3  );
             
             }
         add_action( 'after_setup_theme', 'Woo_MS_Search_run_updater' );



?>