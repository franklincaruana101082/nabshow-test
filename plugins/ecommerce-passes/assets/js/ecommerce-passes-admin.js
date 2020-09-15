(function ($) {
    'use strict';
    
    $(document).ready(function(){
        
        $('.all-product-list').select2();

        $(document).on('change', '.product-parent-wrapper .category-box .product-category', function() {
            
            let _this = $(this);

            $.ajax({
                type: 'POST',
                data: 0 === $(this)[0].selectedIndex ? '' : 'term_id=' + _this.val(),
                url: ePassesObj.product_url,
                success: function ( newsData ) {
                    let selectData = [];
                    $.map(newsData, function (item) {                    
                        selectData.push({ text: item.product_name, id: item.product_id });
                    })
                    $('.all-product-list').select2('destroy').empty().select2({ data: selectData });                    
                }
            });
        });
    });
    
      
})(jQuery);