<?php

    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    
    class Woo_MS_Search_interfaces
        {
         
            function __construct()
                {
                    global $woo_ms_search_query;
                         
                    $this->licence          =   $woo_ms_search_query->licence;
                    
                    if (isset($_GET['page']) && $_GET['page'] == 'woomssearch-options')
                        {
                            add_action( 'init', array($this, 'options_update'), 1 );
                        }

                    add_action( 'network_admin_menu', array($this, 'network_admin_menu') );
                    if(!$this->licence->licence_key_verify())
                        {
                            add_action('admin_notices', array($this, 'admin_no_key_notices'));
                            add_action('network_admin_notices', array($this, 'admin_no_key_notices'));
                        }
                    
                }

            
            function network_admin_menu()
                {
                    $parent_slug    =   'settings.php';
                        
                    $hookID   = add_submenu_page($parent_slug, 'WooCommerce MultiSIte Search', 'WooCommerce MultiSIte Search', 'manage_options', 'woomssearch-options', array($this, 'options_interface'));

                    add_action('load-' .                $hookID ,   array($this, 'admin_notices'));
                    add_action('admin_print_styles-' .  $hookID ,   array($this, 'admin_print_styles'));
                }
                

                
                
            function admin_print_styles()
                {
                    wp_register_style(  'WOOMSSEARCH-options', WOOMSSEARCH_URL . '/assets/css/options.css');
                    wp_enqueue_style(   'WOOMSSEARCH-options');
                }    
            
                              
            function options_interface()
                {
                    
                    if(!$this->licence->licence_key_verify())
                        {
                            $this->licence_form();
                            return;
                        }
                        
                    if($this->licence->licence_key_verify())
                        {
                            $this->licence_deactivate_form();
                        }
                    
                }
            
            function options_update()
                {
                    
                    if (isset($_POST['woomssearch_licence_form_submit']))
                        {
                            $this->licence_form_submit();
                            return;
                        }

                }
                  
            function admin_notices()
                {
                    global $woomssearch_interface_messages;
            
                    if(!is_array($woomssearch_interface_messages))
                        return;
                              
                    if(count($woomssearch_interface_messages) > 0)
                        {
                            foreach ($woomssearch_interface_messages  as  $message)
                                {
                                    echo "<div class='". $message['type'] ." fade'><p>". $message['text']  ."</p></div>";
                                }
                        }

                }
                  
                        
            
            function admin_no_key_notices()
                {
                    if ( !current_user_can('manage_options'))
                        return;
                    
                    $screen = get_current_screen();
                        
                    if(is_multisite())
                        {
                            if(isset($screen->id) && $screen->id    ==  'settings_page_woomssearch-options-network')
                                return;
                            ?><div class="error fade"><p><?php _e( "WooCommerce MultiSite Search plugin is inactive, please enter your", 'woo-ms-search' ) ?> <a href="<?php echo network_admin_url() ?>settings.php?page=woomssearch-options"><?php _e( "Licence Key", 'woo-ms-search' ) ?></a></p></div><?php
                        }
                }
            
            function licence_form_submit()
                {
                    global $woomssearch_interface_messages; 
                    
                    //check for de-activation
                    if (isset($_POST['woomssearch_licence_form_submit']) && isset($_POST['woomssearch_licence_deactivate']) && wp_verify_nonce($_POST['woomssearch_license_nonce'],'woomssearch_licence'))
                        {
                            
                            $licence_data = get_site_option('Woo_MS_Search_license');                        
                            $licence_key = $licence_data['key'];

                            //build the request query
                            $args = array(
                                                'woo_sl_action'         => 'deactivate',
                                                'licence_key'           => $licence_key,
                                                'product_unique_id'     => WOOMSSEARCH_PRODUCT_ID,
                                                'domain'                => WOOMSSEARCH_INSTANCE
                                            );
                            $request_uri    = WOOMSSEARCH_APP_API_URL . '?' . http_build_query( $args , '', '&');
                            $data           = wp_remote_get( $request_uri );
                            
                            if(is_wp_error( $data ) || $data['response']['code'] != 200)
                                {
                                    $woomssearch_interface_messages[] = array(
                                                                            'type'  =>  'error',
                                                                            'text'  =>  __('There was a problem connecting to ', 'woo-ms-search') . WOOMSSEARCH_APP_API_URL);
                                    return;  
                                }
                                
                            $response_block = json_decode($data['body']);
                            $response_block = $response_block[count($response_block) - 1];
                            $response = $response_block->message;
                            
                            if(isset($response_block->status))
                                {
                                    if($response_block->status == 'success' && $response_block->status_code == 's201')
                                        {
                                            //the license is active and the software is active
                                            $woomssearch_interface_messages[] = array(
                                                                                    'type'  =>  'updated',
                                                                                    'text'  =>  $response_block->message);
                                            
                                            $licence_data = get_site_option('Woo_MS_Search_license');
                                            
                                            //save the license
                                            $licence_data['key']          = '';
                                            $licence_data['last_check']   = time();
                                            
                                            update_site_option('Woo_MS_Search_license', $licence_data);
                                        }
                                        
                                    else //if message code is e104  force de-activation
                                            if ($response_block->status_code == 'e002' || $response_block->status_code == 'e104')
                                                {
                                                    $licence_data = get_site_option('Woo_MS_Search_license');
                                            
                                                    //save the license
                                                    $licence_data['key']          = '';
                                                    $licence_data['last_check']   = time();
                                                    
                                                    update_site_option('Woo_MS_Search_license', $licence_data);
                                                }
                                        else
                                        {
                                            $woomssearch_interface_messages[] =   array(  
                                                                                    'type'  =>  'error',
                                                                                    'text'  =>  __('There was a problem deactivating the licence: ', 'woo-ms-search') . $response_block->message);
                                     
                                            return;
                                        }   
                                }
                                else
                                {
                                    $woomssearch_interface_messages[] =   array(  
                                                                                    'type'  =>  'error',
                                                                                    'text'  => __('There was a problem with the data block received from ' . WOOMSSEARCH_APP_API_URL, 'woo-ms-search'));
                                    return;
                                }
                                
                            global $woo_ms_search_query;
                                
                            //redirect
                            $current_url    =   $woo_ms_search_query->functions->current_url();
                            
                            wp_redirect($current_url);
                            
                            die();
                            
                        }   
                    
                    
                    
                    if (isset($_POST['woomssearch_licence_form_submit']) && wp_verify_nonce($_POST['woomssearch_license_nonce'],'woomssearch_licence'))
                        {
                            
                            $licence_key = isset($_POST['licence_key'])? sanitize_key(trim($_POST['licence_key'])) : '';

                            if($licence_key == '')
                                {
                                    $woomssearch_interface_messages[] =   array(  
                                                                                    'type'  =>  'error',
                                                                                    'text'  =>  __("Licence Key can't be empty", 'woo-ms-search'));
                                    return;
                                }
                                
                            //build the request query
                            $args = array(
                                                'woo_sl_action'         => 'activate',
                                                'licence_key'           => $licence_key,
                                                'product_unique_id'     => WOOMSSEARCH_PRODUCT_ID,
                                                'domain'                => WOOMSSEARCH_INSTANCE
                                            );
                            $request_uri    = WOOMSSEARCH_APP_API_URL . '?' . http_build_query( $args , '', '&');
                            $data           = wp_remote_get( $request_uri );
                            
                            if(is_wp_error( $data ) || $data['response']['code'] != 200)
                                {
                                    $woomssearch_interface_messages[] =   array(  
                                                                                    'type'  =>  'error',
                                                                                    'text'  =>  __('There was a problem connecting to ', 'woo-ms-search') . WOOMSSEARCH_APP_API_URL);
                                    return;  
                                }
                                
                            $response_block = json_decode($data['body']);
                            //retrieve the last message within the $response_block
                            $response_block = $response_block[count($response_block) - 1];
                            $response = $response_block->message;
                            
                            if(isset($response_block->status))
                                {
                                    if( $response_block->status == 'success' && ( $response_block->status_code == 's100' || $response_block->status_code == 's101' ) )
                                        {
                                            //the license is active and the software is active
                                            $woomssearch_interface_messages[] =   array(  
                                                                                    'type'  =>  'error',
                                                                                    'text'  =>  $response_block->message);
                                            
                                            $licence_data = get_site_option('Woo_MS_Search_license');
                                            
                                            //save the license
                                            $licence_data['key']          = $licence_key;
                                            $licence_data['last_check']   = time();
                                            
                                            update_site_option('Woo_MS_Search_license', $licence_data);

                                        }
                                        else
                                        {
                                            $woomssearch_interface_messages[] =   array(  
                                                                                    'type'  =>  'error',
                                                                                    'text'  =>  __('There was a problem activating the licence: ', 'woo-ms-search') . $response_block->message);
                                            return;
                                        }   
                                }
                                else
                                {
                                    $woomssearch_interface_messages[] =   array(  
                                                                                    'type'  =>  'error',
                                                                                    'text'  =>  __('There was a problem with the data block received from ' . WOOMSSEARCH_APP_API_URL, 'woo-ms-search'));
                                    return;
                                }
                            
                            global $woo_ms_search_query;
                                
                            //redirect
                            $current_url    =   $woo_ms_search_query->functions->current_url();
                            
                            wp_redirect( $current_url );
                            
                            die();
                        }   
                    
                }
                
            function licence_form()
                {
                    ?>
                        <div class="wrap"> 
                            <h2><?php _e( "WooCommerce MultiSite Search", 'woo-ms-search' ) ?></h2>
                            
                            <h3><?php _e( "Licence", 'woo-ms-search' ) ?></h3>
                            <form id="form_data" name="form" method="post">
                                <?php wp_nonce_field('woomssearch_licence','woomssearch_license_nonce'); ?>
                                <input type="hidden" name="woomssearch_licence_form_submit" value="true" />
                                <div class="start-container licence-key">
                                    <div class="text">
                        
                                        <h2>Licence Key</h2>
                                        <div class="option">
                                            <div class="controls">
                                                <p><input type="text" value="" name="licence_key" class="text-input"></p>
                                            </div>
                                            <div class="explain"><?php _e( "Enter the Licence Key you received when purchased this product. If you lost the key, you can always retrieve it from", 'woo-ms-search' ) ?> <a href="https://wooglobalcart.com/" target="_blank"><?php _e( "My Account", 'woo-ms-search' ) ?></a></div>
                                        </div>
                                        <p class="submit">
                                            <input type="submit" name="Submit" class="button-primary" value="<?php _e('Save', 'woo-ms-search') ?>">
                                        </p> 
                                    </div>
                                </div>
                
                            </form> 
                        </div> 
                    <?php  
     
                }
            
            function licence_deactivate_form()
                {
                    
                    $licence_data = get_site_option('Woo_MS_Search_license');
                    
                    ?>
                        <div class="wrap"> 
                            <h2><?php _e( "WooCommerce MultiSite Search", 'woo-ms-search' ) ?></h2>
                            <div id="form_data">
                                <h3><?php _e( "Licence", 'woo-ms-search' ) ?></h3>
                                <div class="postbox">
                                    <form id="form_data" name="form" method="post">    
                                        <?php wp_nonce_field('woomssearch_licence','woomssearch_license_nonce'); ?>
                                        <input type="hidden" name="woomssearch_licence_form_submit" value="true" />
                                        <input type="hidden" name="woomssearch_licence_deactivate" value="true" />

                                        <div class="start-container licence-key">
                                            <div class="text">
                                
                                                <h2>Licence Key</h2>
                                                <div class="option">
                                                    <div class="controls">
                                                        <p><b><?php echo substr($licence_data['key'], 0, 20) ?>-xxxxxxxx-xxxxxxxx</b> &nbsp;&nbsp;&nbsp;<a class="button-secondary" title="Deactivate" href="javascript: void(0)" onclick="jQuery(this).closest('form').submit();"><?php _e( "Deactivate", 'woo-ms-search' ) ?></a></p>
                                                    </div>
                                                    <div class="explain"><?php _e( "You can generate more keys at ", 'woo-ms-search' ) ?> <a href="https://wooglobalcart.com/my-account/" target="_blank"><?php _e( "My Account", 'woo-ms-search' ) ?></a></div>
                                                </div>
                                       
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> 
                    <?php  
            
                }
                
            function licence_multisite_require_nottice()
                {
                    ?>
                        <div class="wrap"> 
                            <h2 class="subtitle"><?php _e( "WooCommerce MultiSite Search License", 'woo-ms-search' ) ?><br />&nbsp;</h2>
                            <div id="form_data">
                                <div class="postbox">
                                    <div class="section section-text ">
                                        <h4 class="heading"><?php _e( "License Key Required", 'woo-ms-search' ) ?>!</h4>
                                        <div class="option">
                                            <div class="explain"><?php _e( "Enter the Licence Key you received when purchased this product. If you lost the key, you can always retrieve it from", 'woo-ms-search' ) ?> <a href="https://wooglobalcart.com/my-account/" target="_blank"><?php _e( "My Account", 'woo-ms-search' ) ?></a>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div> 
                    <?php
                
                }    

                
        }


?>