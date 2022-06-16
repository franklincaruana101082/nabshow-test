( function ($) {

    // function description for passing anonymous ID from client to server
    function triggerEventRetrieveAnonymousId(segmentJST){
        $.ajax({
            url: segmentJS.ajaxurl,
            type: 'POST',
            data: {
                action: 'st_track_retrieve_anonymous_id_from_client',
                ...segmentJST
            },
            success: function (response) {      
                console.log("response",response)
            }
        });
    }
    
    // function description for retreiving cookie by name/key
    function getAJSCookie(ajs_name) {
        const ajs_cookie = localStorage.getItem(ajs_name);
        if(ajs_cookie !== undefined) return JSON.parse(ajs_cookie);

        return "";
    }
          
    // Allow page to load completely
    $( document ).ready(function() {
        // Store some desired or needed cookie in variable
        let segmentJST = { 
                ...segmentJS, 
                anonymous_id: getAJSCookie('ajs_anonymous_id'), 
                user_id: getAJSCookie('ajs_user_id'), 
                user_traits: getAJSCookie('ajs_user_traits'), 
                group_properties: getAJSCookie('ajs_group_properties'), 
                group_id: getAJSCookie('ajs_group_id')
            };

        triggerEventRetrieveAnonymousId(segmentJST) // function call to send anonymous id, user id, etc. to server
    })

    $(document).on('click', '.nab-suggetion a, #custom_html-10 a.btn', function(){
        $.ajax({
            url: segmentJS.ajaxurl,
            type: 'POST',
            data: {
                action: 'st_track_site_feedback',
                nabNonce: segmentJS.nabNonce,
            },
            success: function (response) {              
            }
        });
    });
    $(document).on('click', '.amp-tag-list li a', function(){
        let tagText = $(this).text();
        let _this   = $(this);
        
        $.ajax({
            url: segmentJS.ajaxurl,
            type: 'POST',
            data: {
                action: 'st_track_taxonomy_click',
                nabNonce: segmentJS.nabNonce,
                postID: segmentJS.postID,
                tagText: tagText
            },
            success: function (response) {
                window.location.href = _this.attr('href');
            }
        });

        return false;
    });
    $(document).on('click', '.bynder-widget-media-item .bynder-widget-btn', function(){
        $.ajax({
            url: segmentJS.ajaxurl,
            type: 'POST',
            data: {
                action: 'st_media_kit_download',
                nabNonce: segmentJS.nabNonce,
            },
            success: function (response) {              
            }
        });
    });

    $(document).on('click', 'a[target="_blank"]', function(){
        $.ajax({
            url: segmentJS.ajaxurl,
            type: 'POST',
            data: {
                action: 'st_external_link_click',
                nabNonce: segmentJS.nabNonce,
            },
            success: function (response) {              
            }
        });
    });
    
    $(document).on('click', 'body.search-results .search-section a', function(){
        var d = new Date();
        d.setTime( d.getTime() + ( 300 * 1000 ) );
        var expires = "expires="+ d.toUTCString();
        document.cookie = "st_search_click=" + segmentJS.search_term + ";" + expires + ";path=/";
    });

    $(document).on('click', '#downloadable-pdfs-list .pdf_btn_wrap a.button', function(){
        
        if ( ! $(this).attr('disabled') ) {
            
            if ( ( undefined !== $(this).attr('data-pid') && undefined !== $(this).attr('data-cid') ) &&  ( '' !== $(this).attr('data-pid') && '' !== $(this).attr('data-cid') ) ) {
                
                $.ajax({
                    url: segmentJS.ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'st_track_pdf_downloaded',
                        nabNonce: segmentJS.nabNonce,
                        company_id: $(this).attr('data-cid'),
                        pdf_id: $(this).attr('data-pid'),
                    },
                    success: function (response) {              
                    }
                });
            }
        }
        
    });
})(jQuery)