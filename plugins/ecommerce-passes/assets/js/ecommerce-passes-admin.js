(function ($) {
    'use strict';
    
    $(document).ready(function(){
        
        $('.product-parent-wrapper .all-product-list').select2();

        $('.product-parent-wrapper .product-selection').select2();

        $(document).on('click', '.product-parent-wrapper .add-to-product', function(){
            
            let selectedProduct = 0 === $('.product-parent-wrapper .product-selection')[0].selectedIndex ? '' : $('.product-parent-wrapper .product-selection').val();
            
            if ( '' !== selectedProduct ) {                
                $('.product-parent-wrapper .all-product-list option[value="' + selectedProduct + '"]').prop("selected", true);
                $('.product-parent-wrapper .all-product-list').trigger('change');
                $('.product-parent-wrapper .product-selection').val('').trigger('change');
            }

            return false;
        });

        $(document).on('change', '.product-parent-wrapper .category-box .product-category', function() {
            
            let _this = $(this);

            $.ajax({
                type: 'POST',
                data: 0 === $(this)[0].selectedIndex ? '' : 'term_id=' + _this.val(),
                url: ePassesObj.product_url,
                success: function ( newsData ) {
                    let selectData = [{ text: 'Select a Product', id: ''}];
                    $.map(newsData, function (item) {                    
                        selectData.push({ text: item.product_name, id: item.product_id });
                    })
                    $('.product-selection').select2('destroy').empty().select2({ data: selectData });                    
                }
            });
        });
    });
    
      
})(jQuery);