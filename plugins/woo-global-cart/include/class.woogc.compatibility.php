<?php



    class WooGC_Compatibility 
        {
            var $functions;
            
            function __construct()   
                {
                    $this->functions    =   new WooGC_Functions();
                           
                    add_action( 'plugins_loaded',                       array( $this, 'add_3rd_compatibility_early'), -1 );
                    add_action( 'plugins_loaded',                       array( $this, 'add_3rd_compatibility') );
                    add_action( 'plugins_loaded',                       array( $this, 'add_3rd_compatibility_late'), 999 );
                    
                    add_action( 'woocommerce_loaded',                   array( $this, 'add_3rd_compatibility_woocommerce_loaded'), 1 );
                    add_action( 'woocommerce_loaded',                   array( $this, 'add_3rd_compatibility_woocommerce_loaded_late'), 999 ); 
                    
                    add_action( 'after_setup_theme',                    array( $this, 'after_setup_theme' ));       
                    
                }
                
                
            function add_3rd_compatibility_early()
                {
                    if ( $this->functions->is_plugin_active( 'formidable-woocommerce/formidable-woocommerce.php') === TRUE )
                        {
                            include_once ( WOOGC_PATH . '/compatibility/formidable-woocommerce/formidable-woocommerce.php');
                        }    
                }
            
    
            function add_3rd_compatibility()
                {
                    
                    if ( $this->functions->is_plugin_active( 'woocommerce-dynamic-pricing/woocommerce-dynamic-pricing.php') === TRUE )
                        {
                            include_once ( WOOGC_PATH . '/compatibility/woocommerce-dynamic-pricing/woocommerce-dynamic-pricing.php');
                        }   
                    
                    if ( $this->functions->is_plugin_active( 'woocommerce-subscriptions/woocommerce-subscriptions.php') === TRUE )
                        {
                            include_once ( WOOGC_PATH . '/compatibility/woocommerce-subscriptions/woocommerce-subscriptions.php');
                        }
                        
                    if ( $this->functions->is_plugin_active( 'woocommerce-wholesale-prices/woocommerce-wholesale-prices.bootstrap.php') === TRUE )
                        {
                            include_once ( WOOGC_PATH . '/compatibility/woocommerce-wholesale-prices/woocommerce-wholesale-prices.php');
                        }
                    
                    if ( $this->functions->is_plugin_active( 'woocommerce-advanced-fees/woocommerce-advanced-fees.php') === TRUE )
                        {
                            include_once ( WOOGC_PATH . '/compatibility/woocommerce-advanced-fees/woocommerce-advanced-fees.php');
                        }
                    
                    if ( $this->functions->is_plugin_active( 'aelia-currencyswitcher-bundles-integration/aelia-currencyswitcher-bundles-integration.php') === TRUE )
                        {
                            include_once ( WOOGC_PATH . '/compatibility/woocommerce-aelia-currencyswitcher/woocommerce-aelia-currencyswitcher.php');
                        }
                        
                    if ( $this->functions->is_plugin_active( 'wc-dynamic-pricing-and-discounts/wc-dynamic-pricing-and-discounts.php') === TRUE )
                        {
                            include_once ( WOOGC_PATH . '/compatibility/wc-dynamic-pricing-and-discounts/wc-dynamic-pricing-and-discounts.php');
                        }
                        
                    if ( $this->functions->is_plugin_active( 'woocommerce-pdf-invoices-packing-slips/woocommerce-pdf-invoices-packingslips.php') === TRUE )
                        {
                            include_once ( WOOGC_PATH . '/compatibility/woocommerce-pdf-invoices-packing-slips/woocommerce-pdf-invoices-packingslips.php');
                        }
                        
                    if ( $this->functions->is_plugin_active( 'woocommerce-advanced-shipping/woocommerce-advanced-shipping.php') === TRUE )
                        {
                            include_once ( WOOGC_PATH . '/compatibility/woocommerce-advanced-shipping/woocommerce-advanced-shipping.php');
                        }
                        
                    if ( $this->functions->is_plugin_active( 'nextgen-gallery/nggallery.php') === TRUE )
                        {
                            include_once ( WOOGC_PATH . '/compatibility/nextgen-gallery/nggallery.php');
                        }
                        
                    if ( $this->functions->is_plugin_active( 'woo-advanced-discounts/wad.php') === TRUE )
                        {
                            include_once ( WOOGC_PATH . '/compatibility/woo-advanced-discounts/woo-advanced-discounts.php');
                        }
                        
                    if ( $this->functions->is_plugin_active( 'yith-woocommerce-points-and-rewards-premium/init.php') === TRUE )
                        {
                            include_once ( WOOGC_PATH . '/compatibility/yith-woocommerce-points-and-rewards-premium/yith-woocommerce-points-and-rewards-premium.php');
                        }
                        
                    if ( $this->functions->is_plugin_active( 'mollie-payments-for-woocommerce/mollie-payments-for-woocommerce.php') === TRUE )
                        {
                            include_once ( WOOGC_PATH . '/compatibility/mollie-payments-for-woocommerce/mollie-payments-for-woocommerce.php');
                        }
                   
                    if ( $this->functions->is_plugin_active( 'duracelltomi-google-tag-manager/duracelltomi-google-tag-manager-for-wordpress.php') === TRUE )
                        {
                            include_once ( WOOGC_PATH . '/compatibility/duracelltomi-google-tag-manager/duracelltomi-google-tag-manager-for-wordpress.php');
                        }
                        
                    if ( $this->functions->is_plugin_active( 'woocommerce-google-analytics-pro/woocommerce-google-analytics-pro.php') === TRUE )
                        {
                            include_once ( WOOGC_PATH . '/compatibility/woocommerce-google-analytics-pro/woocommerce-google-analytics-pro.php');
                        }
                    
                    if ( $this->functions->is_plugin_active( 'sitepress-multilingual-cms/sitepress.php') === TRUE )
                        {
                            include_once ( WOOGC_PATH . '/compatibility/sitepress-multilingual-cms/sitepress.php');
                        }
                        
                    if ( $this->functions->is_plugin_active( 'woocommerce-multilingual/wpml-woocommerce.php') === TRUE )
                        {
                            include_once ( WOOGC_PATH . '/compatibility/woocommerce-multilingual/wpml-woocommerce.php');
                        }
                        
                    
                    if ( $this->functions->is_plugin_active( 'bookly-responsive-appointment-booking-tool/main.php') === TRUE )
                        {
                            include_once ( WOOGC_PATH . '/compatibility/bookly-responsive-appointment-booking-tool/main.php');
                        }
                        
                    if ( $this->functions->is_plugin_active( 'woocommerce-product-bundles/woocommerce-product-bundles.php') === TRUE )
                        {
                            include_once ( WOOGC_PATH . '/compatibility/woocommerce-product-bundles/woocommerce-product-bundles.php');
                        }
                        
                        
                    if ( $this->functions->is_plugin_active( 'fooevents/fooevents.php') === TRUE )
                        {
                            include_once ( WOOGC_PATH . '/compatibility/fooevents/fooevents.php');
                        }
                        
                    if ( $this->functions->is_plugin_active( 'rfqtk/rfqtk.php') === TRUE )
                        {
                            include_once ( WOOGC_PATH . '/compatibility/rfqtk/rfqtk.php');
                        }
                        
                    if ( $this->functions->is_plugin_active( 'wp-hide-security-enhancer-pro/wp-hide.php') === TRUE  ||  $this->functions->is_plugin_active( 'wp-hide-security-enhancer/wp-hide.php') === TRUE)
                        {
                            include_once ( WOOGC_PATH . '/compatibility/wp-hide/wp-hide.php');
                        }
                        
                    if ( $this->functions->is_plugin_active( 'woocommerce-germanized/woocommerce-germanized.php') === TRUE )
                        {
                            include_once ( WOOGC_PATH . '/compatibility/woocommerce-germanized/woocommerce-germanized.php');
                        }
                            
                }
                
                
            
            function add_3rd_compatibility_late()
                {
                    if ( $this->functions->is_plugin_active( 'yith-woocommerce-minimum-maximum-quantity-premium/init.php') === TRUE )
                        {
                            include_once ( WOOGC_PATH . '/compatibility/yith-woocommerce-minimum-maximum-quantity-premium/yith-woocommerce-minimum-maximum-quantity-premium.php');
                        }    
                    
                }
                
                
            function add_3rd_compatibility_woocommerce_loaded()
                {
                    
                    if ( $this->functions->is_plugin_active( 'woocommerce-bulk-discount/woocommerce-bulk-discount.php') === TRUE )
                        {
                            include_once ( WOOGC_PATH . '/compatibility/woocommerce-bulk-discount/woocommerce-bulk-discount.php');
                        }
                    
                }
                
            function add_3rd_compatibility_woocommerce_loaded_late()
                {
                    
                    if ( $this->functions->is_plugin_active( 'woocommerce-smart-coupons/woocommerce-smart-coupons.php') === TRUE )
                        {
                            include_once ( WOOGC_PATH . '/compatibility/woocommerce-smart-coupons/woocommerce-smart-coupons.php');
                        }
                        
                    if ( $this->functions->is_plugin_active( 'cartflows/cartflows.php') === TRUE )
                        {
                            include_once ( WOOGC_PATH . '/compatibility/cartflows/cartflows.php');
                        }
                    
                }
                
                
            function after_setup_theme()
                {
                    
                    if ( class_exists( 'Astra_Woocommerce' ) )
                        include_once ( WOOGC_PATH . '/compatibility/theme-astra/loader.php');
                    
                }
                
            
        }


    new WooGC_Compatibility();
        
?>