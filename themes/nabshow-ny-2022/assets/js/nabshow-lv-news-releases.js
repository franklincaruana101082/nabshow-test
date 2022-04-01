(function ($) {

    $(document).on('click', '#news-release-archive + #load-more-news a', function () {
        let pageNumber = $(this).attr('data-page-number');
        $('#loader_container').show();
        $.ajax({
            type: 'GET',
            data: 'action=nabshow_news_releases_load_more_post&page_number=' + pageNumber + '&load_more_nonce=' + nabshowLvNewsReleases.nabshow_lv_news_releases_nonce,
            url: nabshowLvNewsReleases.ajax_url,
            success: function ( newsData ) {

                let newsObj = $.parseJSON( newsData );
                let cardsDiv = document.getElementsByClassName('col-lg-4 col-md-6');

                $.each(newsObj.result_post, function (key, value) {

                    if (value.post_title) {
                        let cloneItemDiv = cardsDiv[0].cloneNode(true);

                        let innerSpan = cloneItemDiv.querySelector('span.publish-date');
                        innerSpan.innerText = value.post_date;

                        let innerHeadingLink = cloneItemDiv.querySelector('h2 > a');
                        innerHeadingLink.innerText = value.post_title;
                        innerHeadingLink.setAttribute('href', value.post_permalink);

                        let innerParagraph = cloneItemDiv.querySelector('p');
                        innerParagraph.innerText = value.excerpt;

                        let innerLink = cloneItemDiv.querySelector('a.read-more');
                        innerLink.setAttribute('href', value.post_permalink);

                        let newsReleaseList = document.getElementById('news-release-archive');

                        newsReleaseList.appendChild(cloneItemDiv);

                    }

                });
                $('#loader_container').hide();
                $('#news-release-archive .col-lg-4.col-md-6').removeClass('slideInUp').hide();
                $('#news-release-archive .col-lg-4.col-md-6').addClass('slideInUp').show();

                $('#load-more-news a').attr('data-page-number', newsObj.next_page_number);

                $('#load-more-news + .news_bottom_ad').show();
                if ( newsObj.next_page_number > newsObj.total_page) {
                    $('#load-more-news').hide();
                } else {
                    $('#load-more-news').show();
                }
            }
        });
    });

})(jQuery);
