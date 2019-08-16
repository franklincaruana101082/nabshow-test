(function ($) {

    $('loader_container').hide();

    // Load more click event
    $(document).on('click', '#load_more a', function () {

        var dataCategorySlug = $(this).attr('data-term-slug');
        var pageNumber = $(this).attr('data-page-number');

        $('#loader_container').show();

        nabAjaxForLoadMoreAndCategoryClickEvent('loadMore', pageNumber, dataCategorySlug);

    });


    // get the data on the category click
    $(document).on('click', '#filter_list li', function () {
        var pageNumber = 1;
        var dataCategorySlug = $(this).attr('data-term-slug');
        $('#load_more').hide();
        $('#loader_container').show();
        $('#card_section').fadeOut();
        $('#load_more a').attr('data-page-number', 1);

        nabAjaxForLoadMoreAndCategoryClickEvent('categoryClick', pageNumber, dataCategorySlug);

    });

})(jQuery);

function nabAjaxForLoadMoreAndCategoryClickEvent(eventName, pageNumber, dataCategorySlug) {
    var cardsDiv = '';
    var innerATag = '';
    var cloneCardsDiv = '';
    var innerH2Tag = '';
    var innerImgTag = '';
    var innerCategory = '';
    var dataObj = '';
    var ajaxAction = 'nabshow_ntb_missed_load_more_category_click';

    jQuery.ajax({
        type: 'GET',
        data: 'action=' + ajaxAction + '&page_number=' + pageNumber + '&portfolio_category_term_slug=' + dataCategorySlug +
            '&event_name=' + eventName + '&term_data_nonce=' + nabshowLvNtbMissed.nabshow_lv_ntb_missed_nonce,
        url: nabshowLvNtbMissed.ajax_url,
        success: function (getData) {

            jQuery('#loader_container').hide();

            if ('categoryClick' === eventName) {
                jQuery('#card_section').fadeIn();
            }

            dataObj = jQuery.parseJSON(getData);

            jQuery.each(dataObj.result_post, function (key, value) {

                cardsDiv = document.getElementsByClassName('cards');
                cloneCardsDiv = cardsDiv[0].cloneNode(true);

                innerATag = cloneCardsDiv.querySelector('a');
                innerATag.setAttribute('href', value.post_permalink);

                innerH2Tag = cloneCardsDiv.querySelector('h2');
                innerH2Tag.innerText = value.post_title;

                innerImgTag = cloneCardsDiv.querySelector('img');
                innerImgTag.setAttribute('src', value.post_thumbnail);

                innerCategory = cloneCardsDiv.querySelector('span');
                innerCategory.innerText = value.post_category;

                const mylist = document.getElementById('card_section');

                if ('categoryClick' === eventName && 0 === key) {
                    jQuery('#card_section').empty();
                }

                mylist.appendChild(cloneCardsDiv);

                if (key === (dataObj.result_post.length - 1)) {
                    masonryGrids();
                }

            });

            // masonary effect function.


            jQuery('#load_more a').attr('data-page-number', dataObj.next_page_number);

            if (dataObj.next_page_number > dataObj.total_page) {
                jQuery('#load_more').hide();
            } else {
                jQuery('#load_more').show();
            }

            if ('categoryClick' === eventName) {
                jQuery('#load_more a').attr({
                    'data-term-slug': dataCategorySlug,
                    'data-page-number': dataObj.next_page_number,
                    'data-total-page': dataObj.total_page
                });
            }
        }
    });

}


