(function ($) {

    $(document).on('click', '#news-release-archive #load-more-news a', function () {
        let pageNumber = $(this).attr('data-page-number');
        $.ajax({
            type: 'GET',
            data: 'action=nabshow_news_releases_load_more_post&page_number=' + pageNumber + '&load_more_nonce=' + nabshowLvNewsReleases.nabshow_lv_news_releases_nonce,
            url: nabshowLvNewsReleases.ajax_url,
            success: function ( newsData ) {

                let myObj = $.parseJSON( newsData );

                $.each(myObj.result_post, function (key, value) {

                    let cardsDiv = document.getElementsByClassName('col-lg-4 col-md-6');
                    let cloneCardsDiv = cardsDiv[0].cloneNode(true);
                    cloneCardsDiv.childNodes;
                });
            }
        });
    });

})(jQuery);