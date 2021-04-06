( function ($) {
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
})(jQuery)