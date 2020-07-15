<?php

    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    
    class WooGC_on_update
        {
            var $WooGC;
                                  
            function __construct()
                {
                    global $WooGC;
                    $this->WooGC    =   $WooGC;
                    
                    $this->_run();
                }
                
                
            private function _run()
                {                    
                    
                    $options    =   $this->WooGC->functions->get_options();
                    
                    $version        =   $options['version'];
                    if(empty($version))
                        $version    =   1;
                        
                    if (version_compare($version, WOOGC_VERSION, '>=')) 
                        return;            
              
                    //update from the free version                                                  
                    if(version_compare($version, '1.1.4.2', '<'))
                        {
                            
                            $this->WooGC->functions->copy_mu_files( TRUE );
                            
                            $version =   '1.1.4.2';
                        }
                        
                    if(version_compare($version, '1.1.6', '<'))
                        {
                            
                            $this->WooGC->functions->copy_mu_files( TRUE );
                            
                            $version =   '1.1.6';
                        }
                        
                    if(version_compare($version, '1.1.8.3', '<'))
                        {
                            
                            $this->WooGC->functions->copy_mu_files( TRUE );
                            
                            $version =   '1.1.8.3';
                        }
                                 
                    //save the last code version
                    $options['version'] =   WOOGC_VERSION;
                    $this->WooGC->functions->update_options($options);
                     
                }
                           
        }
        
 
 
    new WooGC_on_update();
        
        
?>