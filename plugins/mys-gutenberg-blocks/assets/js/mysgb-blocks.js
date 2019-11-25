(function($) {
    'use strict';
    var bxSliderObj = [];

    $(window).load(function() {
        if ( 0 < $('.nab-dynamic-slider').length ) {
            configureSlider();
            $(window).on('orientationchange resize', configureSlider);
        }
    });

    // Slider popup
    $(document).on('click', '.detail-list-modal-popup, .modal-detail-list-modal-popup', function() {
        var postType = $(this).attr('data-posttype');
        var postId = $(this).attr('data-postid');
        var userId = $(this).attr('data-userid');
        if ($(this).hasClass('modal-detail-list-modal-popup')) {
            $(this).parents('.modal').modal('hide');
        }
        $('body').addClass('popup-loader');
        $('.modal .modal-body').load('/modal-popup?postid=' + postId + '&posttype=' + postType + '&userid=' + userId, function() {
            $('.modal').modal({
                show: true
            });
            $('body').removeClass('popup-loader');
        });
        return false;
    });

    $(document).on('click', '.modal .modal-header .close, .modal .modal-footer .btn-default', function() {
        $(this).parents('.modal').modal('hide');
    });

    if (0 < $('#card_section').length) {
        window.onload = window.onresize = masonryGrids;
    }

    /**
     * Initialize or reload slider
     */
    function configureSlider() {
        var numberOfVisibleSlides = bxNumberofVisibleSlide();
        if (0 < $('.nab-dynamic-slider').length) {
            $('.nab-dynamic-slider').each(function(index) {
                if ( 4 < $(this).children().length ) {
                    let config;
                    if ($(this).hasClass('items-md')) {
                        let lessNumberOfVisibleSlides = bxLessNumberofVisibleSlide();
                        config = bxDynamicSliderConfig($(this), lessNumberOfVisibleSlides);
                    } else {
                        config = bxDynamicSliderConfig($(this), numberOfVisibleSlides);
                    }
                    if (0 < bxSliderObj.length && undefined !== bxSliderObj[index]) {
                        bxSliderObj[index].destroySlider({});
                        let configWithInfiniteLoop = config;
                        configWithInfiniteLoop.infiniteLoop = false;
                        bxSliderObj[index].reloadSlider(configWithInfiniteLoop);
                    } else {
                        bxSliderObj[index] = $(this).bxSlider(config);
                    }
                }
            });
        }
    }

    /**
     * Remove Extra Space from filter
     */
    if (0 < $('.box-main-filter').length) {
        let emptyP = $('.box-main-filter p:contains(\u00a0)');
        emptyP.hide();
    }

    /**
     * Set visible slide according to width
     * @returns {number}
     */
    function bxNumberofVisibleSlide() {
        var numberOfVisibleSlides,
            windowWidth = $(window).width();

        if (600 > windowWidth) {
            numberOfVisibleSlides = 1;
        } else if (990 > windowWidth && 600 < windowWidth) {
            numberOfVisibleSlides = 2;
        } else if (1250 > windowWidth && 990 < windowWidth) {
            numberOfVisibleSlides = 3;
        }

        return numberOfVisibleSlides;
    }

    function bxLessNumberofVisibleSlide() {
        var numberOfVisibleSlides,
            windowWidth = $(window).width();

        if (355 > windowWidth) {
            numberOfVisibleSlides = 1;
        } else if (600 > windowWidth && 355 < windowWidth) {
            numberOfVisibleSlides = 2;
        } else if (990 > windowWidth && 600 < windowWidth) {
            numberOfVisibleSlides = 3;
        } else if (1250 > windowWidth && 990 < windowWidth) {
            numberOfVisibleSlides = 4;
        }


        return numberOfVisibleSlides;
    }

    /**
     *  Setup bxslider options
     * @param elementHandler
     * @param numberOfVisibleSlides
     * @returns {{maxSlides: *, mode: *, auto: *, infiniteLoop: *, controls: *, pager: *, minSlides: *, moveSlides: number, slideMargin: *, slideWidth: *, speed: *, mode: *}}
     */
    function bxDynamicSliderConfig(elementHandler, numberOfVisibleSlides) {
        let mysAuto = !! elementHandler.attr('data-auto'),
            mysInfinite = !! elementHandler.attr('data-infinite'),
            mysPager = !! elementHandler.attr('data-pager'),
            mysControls = !! elementHandler.attr('data-controls'),
            mysMinSlides =
                0 < numberOfVisibleSlides ?
                    numberOfVisibleSlides :
                    parseInt(elementHandler.attr('data-minslides'));

        return {
            minSlides: mysMinSlides,
            maxSlides: mysMinSlides,
            moveSlides: 1,
            slideMargin: parseInt(elementHandler.attr('data-slidemargin')),
            slideWidth: parseInt(elementHandler.attr('data-slidewidth')),
            auto: mysAuto,
            infiniteLoop: mysInfinite,
            pager: mysPager,
            controls: mysControls,
            speed: parseInt(elementHandler.attr('data-speed')),
            mode: 'horizontal',
            touchEnabled: false
        };
    }

    $(document).on('click', '.session-data.schedule-main .row-expand .expand-btn', function() {
        if ('Expand' === $(this).text()) {
            $(this).text('collapse');
        } else {
            $(this).text('Expand');
        }
        $(this).parent().nextAll('.schedule-row').toggleClass('hide-row');
    });

    if (0 < $('.filter-block.main-filter .session-category-drp').length && (0 < $('.nab-dynamic-list.session').length || 0 < $('.nab-dynamic-slider.session').length)) {
        $(document).on('change', '.filter-block.main-filter .session-category-drp', function() {
            sessionListFilter();
        });
        $(document).on('keyup', '.filter-block.main-filter .search-item .search', function() {
            sessionListFilter();
        });
        $(document).on('click', '.filter-block.main-filter .featured-btn', function() {
            $(this).toggleClass('active');
            $('.nab-dynamic-slider.session .item[data-featured="featured"], .nab-dynamic-list.session .item[data-featured="featured"]').toggleClass('featured');
        });
    }

    $(document).on('click', '.category-listing-main .accordion-list .category-head', function() {
        if ($(this).parents('.accordion-list').hasClass('open')) {
            $(this).parents('.accordion-list').removeClass('open').addClass('close');
        } else {
            $(this).parents('.accordion-list').removeClass('close').addClass('open');
        }
        $(this).parents('.accordion-list').siblings().removeClass('open').addClass('close');
    });

    function sessionListFilter() {

        let filterCategory = 0 < $('.filter-block.main-filter .session-category-drp')[0].selectedIndex ? $('.filter-block.main-filter .session-category-drp').val() : null;
        let filterSearch = $('.filter-block.main-filter .search-item .search').val();

        $('.nab-dynamic-list.session .item').show();
        $('.nab-dynamic-slider.session .item.bx-clone').remove();
        $('.nab-dynamic-slider.session .item').removeClass('d-none');

        if (null !== filterCategory) {
            $('.nab-dynamic-list.session .item:not([data-tracks*="' + filterCategory + '"])').hide();
            $('.nab-dynamic-slider.session .item:not([data-tracks*="' + filterCategory + '"]):not(.bx-clone)').addClass('d-none');
        }

        if ('' !== filterSearch) {
            $('.nab-dynamic-list.session .item:visible').filter(function() {
                return (0 > $('h4', this).text().toLowerCase().indexOf(filterSearch.toLowerCase()));
            }).hide();
            $('.nab-dynamic-slider.session .item:visible').filter(function() {
                return (0 > $('h4', this).text().toLowerCase().indexOf(filterSearch.toLowerCase()));
            }).addClass('d-none');
        }

        configureSlider();

    }

    /**
     *  Session browse filter data
     */
    if (0 < $('.browse-sessions-filter').length || 0 < $('.browse-open-to-all-filter').length) {
        let pageNumber,
            postStartWith = '',
            sessionTrack = '',
            sessionLevel = '',
            sessionType = '',
            sessionDate = '',
            sessionLocation = '',
            featuredSession = $('.browse-sessions-filter .featured-btn').hasClass('active') ? 'featured' : '',
            sessionItem = $('#browse-session .item')[0],
            listingType = 0 < $('#browse-session .listing-date-group').length ? $('#browse-session .listing-date-group:first').attr('data-listing-type') : '';


        $(document).on('change', '.browse-sessions-filter #session-tracks', function() {
            let currentTrack = 0 === $(this)[0].selectedIndex ? '' : $(this).val();
            if (sessionTrack !== currentTrack) {
                pageNumber = 1;
                sessionTrack = currentTrack;
                mysAjaxForBrowseSession(sessionItem, 'browse-filter', pageNumber, postStartWith, sessionTrack, sessionLevel, sessionType, sessionLocation, listingType, sessionDate, featuredSession);
            }
        });

        $(document).on('change', '.browse-sessions-filter #session-level', function() {
            let currentLevel = 0 === $(this)[0].selectedIndex ? '' : $(this).val();
            if (sessionLevel !== currentLevel) {
                pageNumber = 1;
                sessionLevel = currentLevel;
                mysAjaxForBrowseSession(sessionItem, 'browse-filter', pageNumber, postStartWith, sessionTrack, sessionLevel, sessionType, sessionLocation, listingType, sessionDate, featuredSession);
            }
        });

        $(document).on('change', '.browse-sessions-filter #session-type', function() {
            let currentType = 0 === $(this)[0].selectedIndex ? '' : $(this).val();
            if (sessionType !== currentType) {
                pageNumber = 1;
                sessionType = currentType;
                mysAjaxForBrowseSession(sessionItem, 'browse-filter', pageNumber, postStartWith, sessionTrack, sessionLevel, sessionType, sessionLocation, listingType, sessionDate, featuredSession);
            }
        });

        $(document).on('change', '.browse-sessions-filter #session-location', function() {
            let currentLocation = 0 === $(this)[0].selectedIndex ? '' : $(this).val();
            if (sessionLocation !== currentLocation) {
                pageNumber = 1;
                sessionLocation = currentLocation;
                mysAjaxForBrowseSession(sessionItem, 'browse-filter', pageNumber, postStartWith, sessionTrack, sessionLevel, sessionType, sessionLocation, listingType, sessionDate, featuredSession);
            }
        });

        $(document).on('keypress', '.browse-sessions-filter .search-item .search, .browse-open-to-all-filter .search-item .search', function(e) {
            if (13 === e.which) {
                pageNumber = 1;
                mysAjaxForBrowseSession(sessionItem, 'browse-filter', pageNumber, postStartWith, sessionTrack, sessionLevel, sessionType, sessionLocation, listingType, sessionDate, featuredSession);
            }
        });

        $(document).on('click', '#load-more-sessions a', function() {
            pageNumber = parseInt($(this).attr('data-page-number'));
            mysAjaxForBrowseSession(sessionItem, 'load-more', pageNumber, postStartWith, sessionTrack, sessionLevel, sessionType, sessionLocation, listingType, sessionDate, featuredSession);
        });

        $(document).on('click', '.browse-sessions-filter .featured-btn', function() {
            $(this).toggleClass('active');
            featuredSession = $(this).hasClass('active') ? 'featured' : '';
            pageNumber = 1;
            mysAjaxForBrowseSession(sessionItem, 'browse-filter', pageNumber, postStartWith, sessionTrack, sessionLevel, sessionType, sessionLocation, listingType, sessionDate, featuredSession);
        });

        $(document).on('click', '.browse-sessions-filter .alphabets-list li:not(".clear")', function() {

            $(this).addClass('active').siblings().removeClass('active');
            if (0 < $(this).parent().find('li.active').length) {
                $(this).siblings('.clear').show();
            }

            if (postStartWith !== $(this).text()) {
                postStartWith = $(this).text();
                pageNumber = 1;
                mysAjaxForBrowseSession(sessionItem, 'browse-filter', pageNumber, postStartWith, sessionTrack, sessionLevel, sessionType, sessionLocation, listingType, sessionDate, featuredSession);
            }
        });

        $(document).on('click', '.browse-sessions-filter .alphabets-list li.clear', function() {
            $(this).hide().siblings().removeClass('active');
            postStartWith = '';
            pageNumber = 1;
            mysAjaxForBrowseSession(sessionItem, 'browse-filter', pageNumber, postStartWith, sessionTrack, sessionLevel, sessionType, sessionLocation, listingType, sessionDate, featuredSession);
        });
        if (0 < $('.browse-sessions-filter #session-date').length || 0 < $('.browse-open-to-all-filter #session-date').length) {
            $(window).load(function() {
                $('.browse-sessions-filter #session-date, .browse-open-to-all-filter #session-date').datepicker({
                    dateFormat: 'DD, MM d, yy'
                }).on('change', function() {
                    pageNumber = 1;
                    sessionDate = $(this).val();
                    mysAjaxForBrowseSession(sessionItem, 'browse-filter', pageNumber, postStartWith, sessionTrack, sessionLevel, sessionType, sessionLocation, listingType, sessionDate, featuredSession);
                });
            });
        }
    }

    /**
     *  Exhibitors browse filter data
     */
    if (0 < $('.browse-exhibitors-filter').length) {
        let exhibitorPageNumber,
            exhibitorStartWith = '',
            exhibitorCategory = '',
            exhibitorHall = '',
            exhibitorPavilion = '',
            exhibitorTechnology = '';

        $(document).on('change', '.browse-exhibitors-filter .browse-select #exhibitor-category', function() {
            let currentCategory = 0 === $(this)[0].selectedIndex ? '' : $(this).val();
            if (exhibitorCategory !== currentCategory) {
                exhibitorPageNumber = 1;
                exhibitorCategory = currentCategory;
                mysAjaxForBrowseExhibitors(false, exhibitorPageNumber, exhibitorStartWith, exhibitorCategory, exhibitorHall, exhibitorPavilion, exhibitorTechnology);
            }
        });

        $(document).on('change', '.browse-exhibitors-filter .browse-select #exhibitor-hall', function() {
            let currentHall = 0 === $(this)[0].selectedIndex ? '' : $(this).val();
            if (exhibitorHall !== currentHall) {
                exhibitorPageNumber = 1;
                exhibitorHall = currentHall;
                mysAjaxForBrowseExhibitors(false, exhibitorPageNumber, exhibitorStartWith, exhibitorCategory, exhibitorHall, exhibitorPavilion, exhibitorTechnology);
            }
        });

        $(document).on('change', '.browse-exhibitors-filter .browse-select #exhibitor-pavilion', function() {
            let currentPavilion = 0 === $(this)[0].selectedIndex ? '' : $(this).val();
            if (exhibitorPavilion !== currentPavilion) {
                exhibitorPageNumber = 1;
                exhibitorPavilion = currentPavilion;
                mysAjaxForBrowseExhibitors(false, exhibitorPageNumber, exhibitorStartWith, exhibitorCategory, exhibitorHall, exhibitorPavilion, exhibitorTechnology);
            }
        });

        $(document).on('change', '.browse-exhibitors-filter .browse-select #exhibitor-technology', function() {
            let currentTechnology = 0 === $(this)[0].selectedIndex ? '' : $(this).val();
            if (exhibitorTechnology !== currentTechnology) {
                exhibitorPageNumber = 1;
                exhibitorTechnology = currentTechnology;
                mysAjaxForBrowseExhibitors(false, exhibitorPageNumber, exhibitorStartWith, exhibitorCategory, exhibitorHall, exhibitorPavilion, exhibitorTechnology);
            }
        });

        $(document).on('keypress', '.browse-exhibitors-filter .search-item .search', function(e) {
            if (13 === e.which) {
                exhibitorPageNumber = 1;
                mysAjaxForBrowseExhibitors(false, exhibitorPageNumber, exhibitorStartWith, exhibitorCategory, exhibitorHall, exhibitorPavilion, exhibitorTechnology);
            }
        });

        $(document).on('click', '#load-more-exhibitor a', function() {
            exhibitorPageNumber = parseInt($(this).attr('data-page-number'));
            mysAjaxForBrowseExhibitors(true, exhibitorPageNumber, exhibitorStartWith, exhibitorCategory, exhibitorHall, exhibitorPavilion, exhibitorTechnology);
        });

        $(document).on('click', '.browse-exhibitors-filter .featured-btn', function() {
            $(this).toggleClass('active');
            exhibitorPageNumber = 1;
            mysAjaxForBrowseExhibitors(false, exhibitorPageNumber, exhibitorStartWith, exhibitorCategory, exhibitorHall, exhibitorPavilion, exhibitorTechnology);
        });

        $(document).on('click', '.browse-exhibitors-filter .alphabets-list li:not(".clear")', function() {

            $(this).addClass('active').siblings().removeClass('active');
            if (0 < $(this).parent().find('li.active').length) {
                $(this).siblings('.clear').show();
            }

            if (exhibitorStartWith !== $(this).text()) {
                exhibitorStartWith = $(this).text();
                exhibitorPageNumber = 1;
                mysAjaxForBrowseExhibitors(false, exhibitorPageNumber, exhibitorStartWith, exhibitorCategory, exhibitorHall, exhibitorPavilion, exhibitorTechnology);
            }
        });

        $(document).on('click', '.browse-exhibitors-filter .alphabets-list li.clear', function() {
            $(this).hide().siblings().removeClass('active');
            exhibitorStartWith = '';
            exhibitorPageNumber = 1;
            mysAjaxForBrowseExhibitors(false, exhibitorPageNumber, exhibitorStartWith, exhibitorCategory, exhibitorHall, exhibitorPavilion, exhibitorTechnology);
        });

        $(document).on('change', '.browse-exhibitors-filter .exhibitor-keywords', function() {
            exhibitorPageNumber = 1;
            mysAjaxForBrowseExhibitors(false, exhibitorPageNumber, exhibitorStartWith, exhibitorCategory, exhibitorHall, exhibitorPavilion, exhibitorTechnology);
        });

        $(document).on('click', '.browse-exhibitors-filter .orderby', function() {
            $(this).toggleClass('active');
            exhibitorPageNumber = 1;
            mysAjaxForBrowseExhibitors(false, exhibitorPageNumber, exhibitorStartWith, exhibitorCategory, exhibitorHall, exhibitorPavilion, exhibitorTechnology);
        });

    }

    /**
     *  Speaker browse filter data
     */
    if (0 < $('.browse-speakers-filter').length) {
        let speakerPageNumber,
            speakerStartWith = '',
            speakerCompany = '',
            featuredSpeaker = 0 < $('.browse-speakers-filter .featured-btn').hasClass('active') ? 'featured' : '';

        $(document).on('change', '.browse-speakers-filter #speaker-company', function() {
            let currentCompany = 0 === $(this)[0].selectedIndex ? '' : $(this).val();
            if (speakerCompany !== currentCompany) {
                speakerPageNumber = 1;
                speakerCompany = currentCompany;
                mysAjaxForBrowseSpeakers(false, speakerPageNumber, speakerStartWith, speakerCompany, featuredSpeaker);
            }
        });

        $(document).on('keypress', '.browse-speakers-filter .search-item .search', function(e) {
            if (13 === e.which) {
                speakerPageNumber = 1;
                mysAjaxForBrowseSpeakers(false, speakerPageNumber, speakerStartWith, speakerCompany, featuredSpeaker);
            }
        });

        $(document).on('keypress', '.browse-speakers-filter .speaker-title-search', function(e) {
            if (13 === e.which) {
                speakerPageNumber = 1;
                mysAjaxForBrowseSpeakers(false, speakerPageNumber, speakerStartWith, speakerCompany, featuredSpeaker);
            }
        });

        $(document).on('click', '#load-more-speaker a', function() {
            speakerPageNumber = parseInt($(this).attr('data-page-number'));
            mysAjaxForBrowseSpeakers(true, speakerPageNumber, speakerStartWith, speakerCompany, featuredSpeaker);
        });

        $(document).on('click', '.browse-speakers-filter .featured-btn', function() {
            $(this).toggleClass('active');
            speakerPageNumber = 1;
            featuredSpeaker = $(this).hasClass('active') ? 'featured' : '';
            mysAjaxForBrowseSpeakers(false, speakerPageNumber, speakerStartWith, speakerCompany, featuredSpeaker);
        });

        $(document).on('click', '.browse-speakers-filter .alphabets-list li:not(".clear")', function() {

            $(this).addClass('active').siblings().removeClass('active');
            if (0 < $(this).parent().find('li.active').length) {
                $(this).siblings('.clear').show();
            }

            if (speakerStartWith !== $(this).text()) {
                speakerStartWith = $(this).text();
                speakerPageNumber = 1;
                mysAjaxForBrowseSpeakers(false, speakerPageNumber, speakerStartWith, speakerCompany, featuredSpeaker);
            }
        });

        $(document).on('click', '.browse-speakers-filter .alphabets-list li.clear', function() {
            $(this).hide().siblings().removeClass('active');
            speakerStartWith = '';
            speakerPageNumber = 1;
            mysAjaxForBrowseSpeakers(false, speakerPageNumber, speakerStartWith, speakerCompany, featuredSpeaker);
        });

        $(document).on('click', '.browse-speakers-filter .orderby', function() {
            $(this).toggleClass('active');
            speakerPageNumber = 1;
            mysAjaxForBrowseSpeakers(false, speakerPageNumber, speakerStartWith, speakerCompany, featuredSpeaker);
        });
        if (0 < $('.browse-speakers-filter #speaker_date').length) {
            $(window).load(function() {
                $('.browse-speakers-filter #speaker_date').datepicker({
                    dateFormat: 'MM, dd yy'
                }).on('change', function() {
                    speakerPageNumber = 1;
                    mysAjaxForBrowseSpeakers(false, speakerPageNumber, speakerStartWith, speakerCompany, featuredSpeaker);
                });
            });
        }
    }

    /**
     * Browse current sponsors filter
     */
    if (0 < $('.browse-sponsors-filter').length) {
        let featuredSponsor = '',
            sponsorTitle = '';

        $(document).on('click', '.browse-sponsors-filter .featured-btn', function() {
            $(this).toggleClass('active');
            featuredSponsor = $(this).hasClass('active') ? 'featured' : '';
            mysBrowseSponsorsFilterHandler(featuredSponsor, sponsorTitle);
        });

        $(document).on('keypress', '.browse-sponsors-filter .search-item .search', function(e) {
            if (13 === e.which) {
                sponsorTitle = $(this).val();
                mysBrowseSponsorsFilterHandler(featuredSponsor, sponsorTitle);
            }
        });

    }

    /**
     * Browse product categories filter
     */
    if (0 < $('.browse-product-categories-filter').length) {
        let productCategory = '',
            productTitle = '';

        if (0 < $('.category-listing-main .listing .category-head .category-title').length) {
            $('.category-listing-main .listing .category-head .category-title').each(function() {
                insertOptions($(this).text(), 'product-categories');
            });
        }

        $(document).on('change', '.browse-product-categories-filter #product-categories', function() {
            productCategory = 0 === $(this)[0].selectedIndex ? '' : $(this).val();
            mysBrowseProductCategoryFilterHandler(productCategory, productTitle);
        });

        $(document).on('keypress', '.browse-product-categories-filter .search-item .search', function(e) {
            if (13 === e.which) {
                productTitle = $(this).val();
                mysBrowseProductCategoryFilterHandler(productCategory, productTitle);
            }
        });
    }

    /*  main - bracket - end */
})(jQuery);

function mysBrowseProductCategoryFilterHandler(productCategory, productTitle) {
    jQuery('.category-listing.listing .category-body li, .category-listing.listing').removeClass('slideInUp').hide();
    jQuery('.category-listing.listing .category-body li, .category-listing.listing').addClass('slideInUp').show();
    jQuery('.category-listing.listing').parents('.category-listing-main').find('.no-data.display-none').hide();
    jQuery('body').addClass('popup-loader');

    if ('' !== productCategory) {
        jQuery('.category-listing.listing .category-head .category-title').filter(function() {
            return (productCategory.toLowerCase() !== jQuery(this).text().toLowerCase());
        }).parents('.category-listing.listing').hide();
    }

    if ('' !== productTitle) {
        jQuery('.category-listing.listing .category-body li img:not([data-title*="' + productTitle.toLowerCase() + '"]').parents('li').hide();
        jQuery('.category-listing.listing .category-body').filter(function() {
            return (0 === jQuery(this).find('li:visible').length);
        }).parents('.category-listing.listing').hide();
    }

    if (0 === jQuery('.category-listing.listing .category-body li:visible').length) {
        jQuery('.category-listing.listing').parents('.category-listing-main').find('.no-data.display-none').show();
    }
    jQuery('body').removeClass('popup-loader');
}

function mysBrowseSponsorsFilterHandler(featuredSponsor, sponsorTitle) {
    jQuery('#sponsors-partners-list li').removeClass('slideInUp').hide();
    jQuery('#sponsors-partners-list li').addClass('slideInUp').show();
    jQuery('#sponsors-partners-list').next('.no-data.display-none').hide();
    jQuery('body').addClass('popup-loader');

    if ('' !== sponsorTitle) {
        jQuery('#sponsors-partners-list li:not([data-title*="' + sponsorTitle.toLowerCase() + '"])').hide();
    }

    if ('' !== featuredSponsor) {
        jQuery('#sponsors-partners-list li:not([data-featured="' + featuredSponsor + '"])').hide();
    }


    if (0 === jQuery('#sponsors-partners-list li:visible').length) {
        jQuery('#sponsors-partners-list').next('.no-data.display-none').show();
    }
    jQuery('body').removeClass('popup-loader');
}

function mysAjaxForBrowseSpeakers(filterType, speakerPageNumber, speakerStartWith, speakerCompany, featuredSpeaker) {
    let postPerPage = jQuery('#load-more-speaker a').attr('data-post-limit') ? parseInt(jQuery('#load-more-speaker a').attr('data-post-limit')) : 10,
        jobTitleSearch = jQuery('.browse-speakers-filter .speaker-title-search').val(),
        postSearch = jQuery('.browse-speakers-filter .search-item .search').val(),
        speakerDate = 0 < jQuery('.browse-speakers-filter #speaker_date').length ? jQuery('.browse-speakers-filter #speaker_date').val() : '',
        orderBy = jQuery('.browse-speakers-filter .orderby').hasClass('active') ? 'title' : 'date';

    jQuery('body').addClass('popup-loader');


    jQuery.ajax({
        type: 'GET',
        data: 'action=speakers_browse_filter&page_number=' + speakerPageNumber + '&browse_filter_nonce=' + mysGbCustom.mysgb_browse_filter_nonce + '&post_limit=' + postPerPage + '&post_start=' + speakerStartWith + '&post_search=' + postSearch + '&speaker_company=' + speakerCompany + '&speaker_order=' + orderBy + '&speaker_job=' + jobTitleSearch + '&speaker_date=' + speakerDate + '&featured_speaker=' + featuredSpeaker,
        url: mysGbCustom.ajax_url,
        success: function(speakerData) {

            let speakerObj = jQuery.parseJSON(speakerData);

            if (! filterType) {
                jQuery('#browse-speaker').empty();
            }

            jQuery.each(speakerObj.result_post, function(key, value) {

                if (value.post_title) {

                    let createItemDiv = document.createElement('div');
                    createItemDiv.setAttribute('class', 'item display-title');
                    createItemDiv.setAttribute('data-featured', value.featured);

                    let itemInnerDiv = document.createElement('div');
                    itemInnerDiv.setAttribute('class', 'flip-box');

                    let itemInnerFlipBox = document.createElement('div');
                    itemInnerFlipBox.setAttribute('class', 'flip-box-inner');

                    let innerImg = document.createElement('img');
                    innerImg.setAttribute('src', value.thumbnail_url);
                    innerImg.setAttribute('alt', 'speaker-logo');
                    innerImg.setAttribute('class', 'rounded-circle');

                    itemInnerFlipBox.appendChild(innerImg);

                    let innerFlipBoxBack = document.createElement('div');
                    innerFlipBoxBack.setAttribute('class', 'flip-box-back rounded-circle');

                    let innerHeading = document.createElement('h6');

                    let innerHeadingLink = document.createElement('a');
                    innerHeadingLink.innerText = value.post_title;
                    innerHeadingLink.setAttribute('href', '#');
                    innerHeadingLink.setAttribute('class', 'detail-list-modal-popup');
                    innerHeadingLink.setAttribute('data-postid', value.post_id);
                    innerHeadingLink.setAttribute('data-posttype', 'speakers');

                    innerHeading.appendChild(innerHeadingLink);
                    innerFlipBoxBack.appendChild(innerHeading);

                    let innerParagraph = document.createElement('p');
                    innerParagraph.innerText = value.job_title;
                    innerParagraph.setAttribute('class', 'jobtilt');

                    innerFlipBoxBack.appendChild(innerParagraph);

                    let innerSpan = document.createElement('span');
                    innerSpan.innerText = value.company;
                    innerSpan.setAttribute('class', 'company');

                    innerFlipBoxBack.appendChild(innerSpan);
                    itemInnerFlipBox.appendChild(innerFlipBoxBack);
                    itemInnerDiv.appendChild(itemInnerFlipBox);
                    createItemDiv.appendChild(itemInnerDiv);

                    let speakersList = document.getElementById('browse-speaker');
                    speakersList.appendChild(createItemDiv);

                }

            });

            if (0 < jQuery('.browse-speakers-filter .featured-btn').length) {
                jQuery('#browse-speaker .item').removeClass('featured');
                jQuery('#browse-speaker .item[data-featured="featured"]').addClass('featured');
            }

            jQuery('body').removeClass('popup-loader');
            jQuery('#browse-speaker .item').removeClass('slideInUp').hide();
            jQuery('#browse-speaker .item').addClass('slideInUp').show();

            jQuery('#load-more-speaker a').attr('data-page-number', speakerObj.next_page_number);

            if (speakerObj.next_page_number > speakerObj.total_page) {
                jQuery('#load-more-speaker').hide();
            } else {
                jQuery('#load-more-speaker').show();
            }

            if (0 === speakerObj.total_page) {
                jQuery('#browse-speaker').empty().parent().find('p.no-data').show();
            } else {
                jQuery('#browse-speaker').parent().find('p.no-data').hide();
            }

        }
    });
}

function mysAjaxForBrowseExhibitors(filterType, exhibitorPageNumber, exhibitorStartWith, exhibitorCategory, exhibitorHall, exhibitorPavilion, exhibitorTechnology) {

    let postPerPage = jQuery('#load-more-exhibitor a').attr('data-post-limit') ? parseInt(jQuery('#load-more-exhibitor a').attr('data-post-limit')) : 10;
    let postSearch = jQuery('.browse-exhibitors-filter .search-item .search').val();
    let keywords = new Array();
    let orderBy = jQuery('.browse-exhibitors-filter .orderby').hasClass('active') ? 'title' : 'date';

    jQuery('body').addClass('popup-loader');
    jQuery('.browse-exhibitors-filter .exhibitor-keywords:checked').each(function() {
        keywords.push(jQuery(this).val());
    });
    if (jQuery('.browse-exhibitors-filter .featured-btn').hasClass('active')) {
        keywords.push('featured');
    }

    jQuery.ajax({
        type: 'GET',
        data: 'action=exhibitors_browse_filter&page_number=' + exhibitorPageNumber + '&browse_filter_nonce=' + mysGbCustom.mysgb_browse_filter_nonce + '&post_limit=' + postPerPage + '&post_start=' + exhibitorStartWith + '&post_search=' + postSearch + '&exhibitor_category=' + exhibitorCategory + '&exhibitor_hall=' + exhibitorHall + '&exhibitor_pavilion=' + exhibitorPavilion + '&exhibitor_keywords=' + keywords + '&exhibitor_order=' + orderBy + '&exhibitor_technology=' + exhibitorTechnology,
        url: mysGbCustom.ajax_url,
        success: function(exhibitorData) {

            let exhibitorObj = jQuery.parseJSON(exhibitorData);

            if (! filterType) {
                jQuery('#browse-exhibitor').empty();
            }

            jQuery.each(exhibitorObj.result_post, function(key, value) {

                if (value.post_title) {

                    let createItemDiv = document.createElement('div');
                    createItemDiv.setAttribute('class', 'item');
                    createItemDiv.setAttribute('data-featured', value.featured);

                    let itemInnerDiv = document.createElement('div');
                    itemInnerDiv.setAttribute('class', 'item-inner');

                    if ('' !== value.thumbnail_url) {

                        let imgTag = document.createElement('img');
                        imgTag.setAttribute('src', value.thumbnail_url);
                        imgTag.setAttribute('alt', 'exhibitor-logo');

                        itemInnerDiv.appendChild(imgTag);
                    }

                    let innerHeading = document.createElement('h4');

                    let innerHeadingLink = document.createElement('a');
                    innerHeadingLink.innerText = value.post_title;
                    innerHeadingLink.setAttribute('href', '#');
                    innerHeadingLink.setAttribute('class', 'detail-list-modal-popup');
                    innerHeadingLink.setAttribute('data-postid', value.post_id);
                    innerHeadingLink.setAttribute('data-posttype', 'exhibitors');

                    innerHeading.appendChild(innerHeadingLink);
                    itemInnerDiv.appendChild(innerHeading);

                    let innerSpan = document.createElement('span');
                    innerSpan.innerText = value.boothnumber;

                    itemInnerDiv.appendChild(innerSpan);

                    let innerParagraph = document.createElement('p');
                    innerParagraph.innerText = value.post_excerpt;

                    let innerParagraphLink = document.createElement('a');
                    innerParagraphLink.innerText = ' Read More';
                    innerParagraphLink.setAttribute('href', '#');
                    innerParagraphLink.setAttribute('class', 'detail-list-modal-popup read-more-popup');
                    innerParagraphLink.setAttribute('data-postid', value.post_id);
                    innerParagraphLink.setAttribute('data-posttype', 'exhibitors');

                    innerParagraph.appendChild(innerParagraphLink);
                    itemInnerDiv.appendChild(innerParagraph);

                    let innerPlannerLink = document.createElement('a');
                    innerPlannerLink.innerText = 'View in Planner';
                    innerPlannerLink.setAttribute('href', value.planner_link);
                    innerPlannerLink.setAttribute('target', '_blank');

                    itemInnerDiv.appendChild(innerPlannerLink);
                    createItemDiv.appendChild(itemInnerDiv);

                    let exhibitorList = document.getElementById('browse-exhibitor');
                    exhibitorList.appendChild(createItemDiv);
                }

            });
            jQuery('#browse-exhibitor .item').removeClass('featured');
            jQuery('#browse-exhibitor .item[data-featured="featured"]').addClass('featured');

            jQuery('body').removeClass('popup-loader');
            jQuery('#browse-exhibitor .item').removeClass('slideInUp').hide();
            jQuery('#browse-exhibitor .item').addClass('slideInUp').show();

            jQuery('#load-more-exhibitor a').attr('data-page-number', exhibitorObj.next_page_number);

            if (exhibitorObj.next_page_number > exhibitorObj.total_page) {
                jQuery('#load-more-exhibitor').hide();
            } else {
                jQuery('#load-more-exhibitor').show();
            }

            if (0 === exhibitorObj.total_page) {
                jQuery('#browse-exhibitor').empty().parent().find('p.no-data').show();
            } else {
                jQuery('#browse-exhibitor').parent().find('p.no-data').hide();
            }

        }
    });
}


function mysAjaxForBrowseSession(sessionItem, filterType, pageNumber, postStartWith, sessionTrack, sessionLevel, sessionType, sessionLocation, listingType, sessionDate, featuredSession) {
    let postPerPage = jQuery('#load-more-sessions a').attr('data-post-limit') ? parseInt(jQuery('#load-more-sessions a').attr('data-post-limit')) : 10;
    let postSearch = 0 < jQuery('.browse-open-to-all-filter .search-item .search').length ? jQuery('.browse-open-to-all-filter .search-item .search').val() : jQuery('.browse-sessions-filter .search-item .search').val();

    jQuery('body').addClass('popup-loader');

    if ('load-more' !== filterType) {
        jQuery('#browse-session').empty();
    }

    jQuery.ajax({
        type: 'GET',
        data: 'action=sessions_browse_filter&page_number=' + pageNumber + '&browse_filter_nonce=' + mysGbCustom.mysgb_browse_filter_nonce + '&post_limit=' + postPerPage + '&post_start=' + postStartWith + '&post_search=' + postSearch + '&track=' + sessionTrack + '&level=' + sessionLevel + '&session_type=' + sessionType + '&location=' + sessionLocation + '&listing_type=' + listingType + '&session_date=' + sessionDate + '&featured_session=' + featuredSession,
        url: mysGbCustom.ajax_url,
        success: function(sessionData) {

            let sessionObj = jQuery.parseJSON(sessionData);
            if ('' !== listingType) {
                let dateGroup = '';
                let itemDateGroup = [];
                let cnt = 0;
                let appendItem = false;
                jQuery.each(sessionObj.result_post, function(key, value) {

                    if (dateGroup !== value.session_date) {
                        dateGroup = value.session_date;
                    }
                    let cloneItemDiv = sessionItem.cloneNode(true);
                    let innerImg = cloneItemDiv.querySelector('img');

                    if (null === innerImg && '' !== value.thumbnail_url) {

                        let imgTag = document.createElement('img');
                        imgTag.setAttribute('src', value.thumbnail_url);
                        imgTag.setAttribute('alt', 'session-logo');
                        cloneItemDiv.insertBefore(imgTag, cloneItemDiv.childNodes[0]);

                    } else if (null != innerImg && '' !== value.thumbnail_url) {
                        innerImg.setAttribute('src', value.thumbnail_url);
                    } else if (null !== innerImg) {
                        innerImg.remove();
                    }

                    let innerHeadingLink = cloneItemDiv.querySelector('h4 > a');
                    innerHeadingLink.innerText = value.post_title;
                    innerHeadingLink.setAttribute('data-postid', value.post_id);

                    let innerSpanTag = cloneItemDiv.querySelector('span');
                    innerSpanTag.innerText = value.date_time;

                    let innerParagraphTag = cloneItemDiv.querySelector('p');
                    innerParagraphTag.childNodes[0].nodeValue = value.post_excerpt;

                    let innerParagraphATag = cloneItemDiv.querySelector('p > .detail-list-modal-popup');
                    innerParagraphATag.setAttribute('data-postid', value.post_id);

                    let innerATag = cloneItemDiv.querySelector('.session-planner-url');
                    innerATag.setAttribute('href', value.planner_link);

                    itemDateGroup[cnt] = cloneItemDiv;

                    if ('load-more' === filterType && jQuery('#browse-session .listing-date-group h2.session-date:last').text() === value.session_date) {
                        appendItem = true;
                    }

                    cnt++;

                    if (((key + 1) === sessionObj.result_post.length) || (sessionObj.result_post[(key + 1)] !== undefined && dateGroup !== sessionObj.result_post[(key + 1)].session_date)) {
                        let parentDiv;
                        if (! appendItem) {
                            parentDiv = document.createElement('div');
                            parentDiv.setAttribute('class', 'listing-date-group');

                            let childHeading = document.createElement('h2');
                            childHeading.setAttribute('class', 'session-date');
                            childHeading.innerText = dateGroup;
                            parentDiv.appendChild(childHeading);

                        } else {
                            let lastDivindex = (jQuery('#browse-session .listing-date-group').length - 1);
                            parentDiv = document.getElementsByClassName('listing-date-group')[lastDivindex];
                        }

                        itemDateGroup.forEach(function(element) {
                            parentDiv.appendChild(element);
                        });

                        if (! appendItem) {
                            let sessionList = document.getElementById('browse-session');
                            sessionList.appendChild(parentDiv);
                        }

                        appendItem = false;
                        itemDateGroup = [];
                        cnt = 0;
                    }

                });
            } else {

                if ('load-more' !== filterType) {
                    jQuery('#browse-session').empty();
                }

                jQuery.each(sessionObj.result_post, function(key, value) {

                    if (value.post_title) {

                        let createItemDiv = document.createElement('div');
                        createItemDiv.setAttribute('class', 'item');
                        createItemDiv.setAttribute('data-featured', value.featured);

                        let innerHeading = document.createElement('h4');

                        let innerHeadingLink = document.createElement('a');
                        innerHeadingLink.innerText = value.post_title;
                        innerHeadingLink.setAttribute('href', '#');
                        innerHeadingLink.setAttribute('class', 'detail-list-modal-popup');
                        innerHeadingLink.setAttribute('data-postid', value.post_id);
                        innerHeadingLink.setAttribute('data-posttype', 'sessions');

                        innerHeading.appendChild(innerHeadingLink);
                        createItemDiv.appendChild(innerHeading);

                        let innerSpan = document.createElement('span');
                        innerSpan.innerText = value.date_time;
                        innerSpan.setAttribute('class', 'date-time');

                        createItemDiv.appendChild(innerSpan);

                        let innerParagraph = document.createElement('p');
                        innerParagraph.innerText = value.post_excerpt;

                        let innerParagraphLink = document.createElement('a');
                        innerParagraphLink.innerText = ' Read More';
                        innerParagraphLink.setAttribute('href', '#');
                        innerParagraphLink.setAttribute('class', 'detail-list-modal-popup read-more-popup');
                        innerParagraphLink.setAttribute('data-postid', value.post_id);
                        innerParagraphLink.setAttribute('data-posttype', 'sessions');

                        innerParagraph.appendChild(innerParagraphLink);
                        createItemDiv.appendChild(innerParagraph);

                        let innerPlannerLink = document.createElement('a');
                        innerPlannerLink.innerText = 'View in Planner';
                        innerPlannerLink.setAttribute('href', value.planner_link);
                        innerPlannerLink.setAttribute('class', 'session-planner-url');
                        innerPlannerLink.setAttribute('target', '_blank');

                        createItemDiv.appendChild(innerPlannerLink);

                        let sessionList = document.getElementById('browse-session');
                        sessionList.appendChild(createItemDiv);
                    }

                });
            }

            if (0 < jQuery('.browse-sessions-filter .featured-btn').length) {
                jQuery('#browse-session .item').removeClass('featured');
                jQuery('#browse-session .item[data-featured="featured"]').addClass('featured');
            }

            jQuery('body').removeClass('popup-loader');
            jQuery('#browse-session .item').removeClass('slideInUp').hide();
            jQuery('#browse-session .item').addClass('slideInUp').show();

            jQuery('#load-more-sessions a').attr('data-page-number', sessionObj.next_page_number);

            if (sessionObj.next_page_number > sessionObj.total_page) {
                jQuery('#load-more-sessions').hide();
            } else {
                jQuery('#load-more-sessions').show();
            }

            if (0 === sessionObj.total_page) {
                jQuery('#browse-session').empty().parent().find('p.no-data').show();
            } else {
                jQuery('#browse-session').parent().find('p.no-data').hide();
            }

        }
    });
}

/* Masonry column */
function masonryGrids() {
    var colCount, colHeight, i, mainDiv, highest, order, divHeight;
    colHeight = [];
    mainDiv = document.getElementById('card_section');
    jQuery('#card_section .item').css({
        opacity: '0',
        transform: 'scale(0.8, 0.8)'
    });
    if (3 >= mainDiv.children.length) {
        document.getElementById('card_section').style.flexDirection = 'inherit';
        document.getElementById('card_section').style.alignItems = 'flex-start';
        document.getElementById('card_section').style.height = 'auto';
        document.getElementById('card_section').classList.add('col-countbox');
        for (i = 0; i < mainDiv.children.length; i++) {
            jQuery(mainDiv.children[i]).show('slow').css({
                opacity: '1',
                transform: 'scale(1, 1)'
            });
            mainDiv.children[i].style.order = '';
            mainDiv.children[i].style.height = 'auto';
        }
    } else {
        document.getElementById('card_section').style.flexDirection = '';
        document.getElementById('card_section').style.alignItems = '';
        document.getElementById('card_section').style.height = '';
        document.getElementById('card_section').style.display = 'flex';
        document.getElementById('card_section').classList.add('col-countbox');
        document.getElementById('card_section').classList.remove('col-countbox');
        if (767 > window.innerWidth) {
            colCount = 1;
        } else if (992 > window.innerWidth) {
            colCount = 2;
        } else {
            colCount = 3;
        }

        for (i = 0; i <= colCount; i++) {
            colHeight.push(0);
        }

        for (i = 0; i < mainDiv.children.length; i++) {
            mainDiv.children[i].style.height = '';
            order = (i + 1) % colCount || colCount;
            mainDiv.children[i].style.order = order;

            if (jQuery(mainDiv).hasClass('card-columns-box')) {
                divHeight = mainDiv.children[i].childNodes[1].childNodes[1].height;
            } else {
                divHeight = mainDiv.children[i].clientHeight;
            }
            if (0 === divHeight) {
                divHeight = mainDiv.children[i].childNodes[1].childNodes[1].naturalHeight;
            }
            mainDiv.children[i].style.height = divHeight + 'px';
            colHeight[order] += parseInt(divHeight);

            jQuery(mainDiv.children[i])
                .show('slow')
                .css({
                    opacity: '1',
                    transform: 'scale(1, 1)'
                });
        }

        highest = Math.max.apply(Math, colHeight);

        mainDiv.style.height = highest + 'px';
    }
}

/**
 * Schedule at a glance filter dropdown options append
 * @param data
 * @param id
 */
function insertOptions(data, id) {
    if (0 === jQuery('#' + id + ' option[value="' + data + '"]').length && undefined !== data && '' !== data) {
        let node = document.createElement('option');
        node.setAttribute('value', data);
        let textnode = document.createTextNode(data);
        let optionData = document.getElementById(id);
        node.appendChild(textnode);
        optionData.appendChild(node);
    }
}