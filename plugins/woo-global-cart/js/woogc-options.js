        
                
        jQuery( document ).ready(function() {
            
            jQuery( '.tips' ).tipTip({
                    'attribute': 'data-tip',
                    'fadeIn': 50,
                    'fadeOut': 50,
                    'delay': 200
                });
                
            jQuery('select[name="login_only_specific_roles_status"]').on('change', function() {
                    if(jQuery(this).val()   ==  'yes')
                        jQuery('#login_only_specific_roles').slideDown();
                        else
                        jQuery('#login_only_specific_roles').slideUp();
                })
            
        });