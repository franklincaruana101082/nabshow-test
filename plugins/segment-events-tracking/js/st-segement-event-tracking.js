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
})(jQuery)