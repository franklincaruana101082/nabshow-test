( function ($) {

    function triggerEventRetrieveAnonymousId(segmentJST){
        $.ajax({
            url: segmentJS.ajaxurl,
            type: 'GET',
            data: {
                action: 'st_track_retrieve_anonymous_id_from_client_click',
                nabNonce: segmentJS.nabNonce,
                anonymous_id: segmentJST.anonymous_id,
                userId: segmentJST.userId,
            },
            success: function (response) {              
            }
        });
    }
    
    function getCookie(cname) {
        let name = cname + "=";
        let ca = document.cookie.split(';');
        for(let i = 0; i < ca.length; i++) {
          let c = ca[i];
          while (c.charAt(0) == ' ') {
            c = c.substring(1);
          }
          if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
          }
        }
        return "";
      }

    let segmentJST = { ajaxurl: segmentJS.ajaxurl, postID: getCookie('postID'), nabNonce: {}, anonymous_id: getCookie('ajs_anonymous_id'), userId: getCookie('userId'), userTraits: getCookie('userTraits'), groupProperties: getCookie('groupProperties'), groupId: getCookie('groupId')};
    
    // console.log("segmentJS.ajaxurl",segmentJS.ajaxurl);
    // console.log("segmentJST",segmentJST);
    
    $( document ).ready(function() {
        triggerEventRetrieveAnonymousId(segmentJST)
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