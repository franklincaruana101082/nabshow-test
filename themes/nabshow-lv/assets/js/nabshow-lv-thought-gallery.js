(function ($) {

    $(document).on('click', '#load-more-tg a', function () {

        var pageNumber = $(this).attr('data-page-number');
        var cardsDiv = '';
        var cloneCardsDiv = '';
        var list = '';
        var j = '';
        var divStatus = '';
        var children = '';
        var k = '';
        var innerImgTag = '';
        var innerExcerptTag = '';
        var ReadmoreTag = '';
        var innerAuthorTag = '';
        var innerH2Tag = '';
        var myObj = '';
        var innerATag = '';
        var i = '';
        var categoryElement = '';
        var titleAttr = '';
        var relAttr = '';
        var hrefAttr = '';
        var postHeader = '';
        var acat = '';
        var t = '';
        var elementParent = '';


        // ajax call to get the data
        $.ajax({
            type: 'GET',
            data: 'action=nabshow_thoughts_gallery_load_more&page_number=' + pageNumber + '&load_more_nonce=' + nabshowLvThoughtGallery.nabshow_lv_thought_gallery_nonce,
            url: nabshowLvThoughtGallery.ajax_url,
            success: function (getData) {

                myObj = $.parseJSON(getData);

                $.each(myObj.result_post, function (key, value) {

                    cardsDiv = document.getElementsByClassName('tg-cards');
                    cloneCardsDiv = cardsDiv[0].cloneNode(true);
                    cloneCardsDiv.childNodes;

                    list = cloneCardsDiv.getElementsByClassName('cat-info');
                    for (j = list.length - 1; 0 <= j; j--) {
                        if (list[j] && list[j].parentElement) {
                            list[j].parentElement.removeChild(list[j]);
                        }
                    }
                    divStatus = cloneCardsDiv.querySelector('.post-header');
                    children = [];
                    for (k = 0; k < divStatus.children.length; k++) {
                        children.push(divStatus.children[k]);
                    }

                    divStatus.innerHTML = '';
                    children.forEach(function (item) {
                        divStatus.appendChild(item);
                    });

                    innerATag = cloneCardsDiv.querySelector('a');
                    innerATag.setAttribute('href', value.post_permalink);

                    for (i = 0; i < value.category_lists.length; i++) {

                        categoryElement = document.createElement('a');
                        categoryElement.className = 'cat-info ' + value.category_slugs[i];
                        titleAttr = document.createAttribute('title');
                        titleAttr.value = value.category_lists[i];
                        categoryElement.setAttributeNode(titleAttr);
                        relAttr = document.createAttribute('rel');
                        relAttr.value = 'tag';
                        categoryElement.setAttributeNode(relAttr);
                        hrefAttr = document.createAttribute('href');
                        hrefAttr.value = value.category_links[i];
                        categoryElement.setAttributeNode(hrefAttr);
                        categoryElement.innerText = value.category_lists[i];

                        postHeader = cloneCardsDiv.querySelector('.post-header .cat-listing');
                        postHeader.insertBefore(categoryElement, postHeader.childNodes[0]);

                        if (i < value.category_lists.length - 1) {
                            acat = cloneCardsDiv.querySelector('.cat-info');
                            t = document.createTextNode(' , ');
                            elementParent = acat.parentNode;
                            elementParent.insertBefore(t, acat);
                        }
                    }

                    innerH2Tag = cloneCardsDiv.querySelector('h2 a');
                    innerH2Tag.setAttribute('href', value.post_permalink);
                    innerH2Tag.innerText = value.post_title;

                    innerAuthorTag = cloneCardsDiv.querySelector('.post-meta-info a');
                    innerAuthorTag.setAttribute('href', value.author_link);
                    innerAuthorTag.innerText = value.post_author;

                    ReadmoreTag = cloneCardsDiv.querySelector('.post-excerpt a');
                    ReadmoreTag.setAttribute('href', value.post_permalink);

                    innerExcerptTag = cloneCardsDiv.querySelector('.post-excerpt');
                    innerExcerptTag.textContent = value.excerpt + ' ';
                    innerExcerptTag.appendChild(ReadmoreTag);

                    innerImgTag = cloneCardsDiv.querySelector('img');
                    innerImgTag.setAttribute('src', value.post_thumbnail);

                    const mylist = document.getElementById('tg_wrapper');

                    mylist.appendChild(cloneCardsDiv);

                });


                $('#load-more-tg a').attr('data-page-number', myObj.next_page_number);

                if (myObj.next_page_number > myObj.total_page) {
                    $('#load-more-tg').hide();
                } else {
                    $('#load-more-tg').show();
                }
            }
        });

    });

    $(document).ready(function () {
        if (0 < $('.thought-gallery-slider').length) {
            $('.thought-gallery-slider').bxSlider({
                slideWidth: 830,
                slideMargin: 30,
                mode: 'horizontal',
                auto: 'true',
                minSlides: 1,
                maxSlides: 1,
                moveSlides: 1,
                speed: 500,
                controls: 'true',
                infiniteLoop: 'true',
                pager: false,
                stopAutoOnClick: true,
                autoHover: true,
                onSlideBefore: function ($slideElement) {
                    $('.thought-gallery-slider .item').removeClass('thought-active-slide thought-previous-slide thought-next-slide');
                    $slideElement.next().addClass('thought-active-slide');
                    $slideElement.addClass('thought-previous-slide');
                    $slideElement.next().next().addClass('thought-next-slide');
                },
                onSliderLoad: function () {
                    $('.thought-gallery-slider .item').eq(1 + $('.thought-gallery-slider .bx-clone').length / 2).addClass('thought-active-slide');
                    $('.thought-gallery-slider .item').eq(1 + $('.thought-gallery-slider .bx-clone').length / 2).next().addClass('thought-next-slide');
                    $('.thought-gallery-slider .item').eq(1 + $('.thought-gallery-slider .bx-clone').length / 2).prev().addClass('thought-previous-slide');
                }
            });
        }
    });

})(jQuery);
