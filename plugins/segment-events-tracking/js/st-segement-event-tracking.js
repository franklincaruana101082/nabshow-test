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
})(jQuery)

function stSegmentAnalyticsLoad() {
    try {
        analytics.SNIPPET_VERSION = '3.1.0';
        analytics.load( segmentJS.api_key );
    } catch ( e ) {
		console.log( "JavaScript Error: " + e.message );
	}
}

function stSendPageView( data ) {
    var finalData = JSON.parse( data );	
    analytics.page( finalData.name, finalData.properties );
}

function stSendTrackView( data ) {	
    var finalData = JSON.parse( data );
    analytics.track( finalData.event, finalData.properties );
}

function stSendIdentifyView( data ) {	
    var finalData = JSON.parse( data );
    analytics.identify( finalData.userId, finalData.traits );
}

if ( ! segmentJS.wc_active ) {
    stSegmentAnalyticsLoad();
}
