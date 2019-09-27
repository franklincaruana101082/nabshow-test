(function ($) {
  'use strict';
  var bxSliderObj = [],
    ntbmBxSliderObj = [];

  $(window).load(function () {

    if (
      0 < $('.nab-dynamic-slider').length ||
      0 < $('.nab-not-to-be-missed-slider').length
    ) {
      configureSlider();
      $(window).on('orientationchange resize', configureSlider);
    }

    // nab-media-slider start
    if (0 < $('.nab-media-slider').length) {
      $('.nab-media-slider').each(function () {
        let nabautoplay = 'true' === $(this).attr('data-autoplay') ? true : false;
        let nabinfiniteloop =
          'true' === $(this).attr('data-infiniteloop') ? true : false;
        let nabpager = 'true' === $(this).attr('data-pager') ? true : false;
        let nabcontrols = 'true' === $(this).attr('data-controls') ? true : false;
        let nabadaptiveheight =
          'true' === $(this).attr('data-adaptiveheight') ? true : false;
        let nabmode = $(this).attr('nabmode');
        let nabanimation = $(this).attr('data-animation');
        let touchEnabledStatus =
          0 === $(this).find('.nab-media-slider-link').length ? true : false;

        $(this).bxSlider({
          mode: nabmode,
          auto: nabautoplay,
          speed: $(this).attr('data-speed'),
          infiniteLoop: nabinfiniteloop,
          pager: nabpager,
          controls: nabcontrols,
          captions: true,
          adaptiveHeight: nabadaptiveheight,
          touchEnabled: touchEnabledStatus,
          stopAutoOnClick: true,
          autoHover: true,

          onSlideAfter: function (currentSlideNumber, totalSlideQty, currentSlideHtmlObject) {
            $('.nab-media-slider > .nab-media-slider-item').removeClass(`active-slide ${nabanimation}`);
            $('.nab-media-slider > .nab-media-slider-item').eq(currentSlideHtmlObject).addClass(`active-slide ${nabanimation}`);
          },
          onSliderLoad: function () {
            $('.nab-media-slider > .nab-media-slider-item').eq(0).addClass(`active-slide ${nabanimation}`);
            $('.nab-media-slider .nab-media-slider-item').css('opacity', '1');
          }
        });
      });
    }

    // quote-slider
    if (0 < $('.quote-slider .quote-inner').length) {
      $('.quote-slider .quote-inner').each(function () {
        $(this).bxSlider({
          mode: $(this).attr('data-mode'),
          auto: 'true' === $(this).attr('data-autoplay') ? true : false,
          speed: $(this).attr('data-speed'),
          controls: 'true' === $(this).attr('data-controls') ? true : false,
          infiniteLoop:
            'true' === $(this).attr('data-infiniteloop') ? true : false,
          pager: 'true' === $(this).attr('data-pager') ? true : false,
          stopAutoOnClick: true,
          autoHover: true,
          onSliderLoad: function () {
            $('.quote-slider .quote-item').css('opacity', '1');
          }
        });
      });
    }
  });

  // Slider popup
  $(document).on('click', '.detail-list-modal-popup', function () {
    var postType = $(this).attr('data-posttype');
    var postId = $(this).attr('data-postid');
    var userId = $(this).attr('data-userid');
    $('body').addClass('popup-loader');
    $('.modal .modal-body').load('/modal-popup?postid=' + postId + '&posttype=' + postType + '&userid=' + userId, function () {
      $('.modal').modal({
        show: true
      });
      $('body').removeClass('popup-loader');
    });
    return false;
  });

  $(document).on('click', '.modal .modal-header .close, .modal .modal-footer .btn-default', function () {
    $(this).parents('.modal').modal('hide');
  });

  // nab-media-slider End

  // Adding Row in Session Masonry Js
  jQuery('.session.with-masonry').parent('div').addClass('row');

  // Award Section Popup Js
  jQuery('.nab_popup_btn').on('click', function () {
    jQuery(this).siblings('.nab_model_main').addClass('nab_model_open');
    jQuery(this).closest('.slideInUp').removeClass('slideInUp');
  });
  jQuery('.nab_close_btn, .nab_bg_overlay').on('click touch', function () {
    jQuery('.nab_model_main').removeClass('nab_model_open');
  });

  // accordion
  $(document).on(
    'click',
    '.accordionParentWrapper .accordionWrapper .accordionHeader .dashicons',
    function (e) {
      e.stopImmediatePropagation();
      $(this).parent().parent().siblings().find('.accordionBody').slideUp();
      $(this).parent().next().slideToggle();
      if (
        $(this).parent().parent('.accordionWrapper').hasClass('tabClose')
      ) {
        $(this).parent().parent('.accordionWrapper').removeClass('tabClose').addClass('tabOpen');
        $(this).parent().parent('.accordionWrapper').siblings().removeClass('tabOpen').addClass('tabClose');
      } else {
        $(this).parent().parent('.accordionWrapper').removeClass('tabOpen').addClass('tabClose');
      }
    }
  );

  // faq select js
  if (0 < $('.accordionParentWrapper').length) {
    $('.accordionParentWrapper').each(function () {
      if ('' !== $(this).find('.title').html()) {
        insertOptions($(this).find('.title').html(), 'faq-category-drp');
      }
    });

    $(document).on('change', '#faq-category-drp', function () {
      filterFaq();
    });

    $(document).on('keyup', '#faq-search', function () {
      filterFaq();
    });
  }

  // faq select js

  // banner-navigation
  $('ul.banner-navigation li')
    .find('a')
    .click(function (e) {
      e.preventDefault();
      let section = $(this).attr('href');
      $('html, body').animate({
        scrollTop: $(section).offset().top
      });
    });

  // banner-navigation

  if (0 < $('#card_section').length) {
    window.onload = window.onresize = masonryGrids;
  }

  $(document).on('change', '.plan-your-show-drp', function () {
    if ('' !== $(this).val()) {
      location.replace($(this).val());
    }
  });

  $(document).on('click', '.slider-card-filter .filter-list li', function () {
    var cardsDiv, cloneCardsDiv, innerH2Tag, innerImgTag, innerCategory, dataObj,
      ajaxAction = 'nabshow_ntb_missed_load_more_category_click',
      _this = $(this),
      itemToFetch = $(this).parents('.slider-arrow-main').find('.nab-not-to-be-missed-slider').attr('data-item');

    $(this).parents('.slider-arrow-main').find('.nab-not-to-be-missed-slider').addClass('change-slide');
    $('#loader_container').show();

    jQuery.ajax({
      type: 'GET',
      data: 'action=' + ajaxAction + '&fetch_item=' + itemToFetch + '&portfolio_category_term_slug=' + $(this).attr('data-term-slug') + '&term_data_nonce=' + nabshowNtbMissed.nabshow_lv_ntb_missed_nonce,
      url: nabshowNtbMissed.ajax_url,
      success: function (getData) {
        dataObj = jQuery.parseJSON(getData);
        _this.parents('.slider-arrow-main').find('.nab-not-to-be-missed-slider .cards').removeClass('bx-clone');

        jQuery.each(dataObj.result_post, function (key, value) {
          if (value.post_thumbnail) {
            cardsDiv = document.getElementsByClassName('cards');
            cloneCardsDiv = cardsDiv[0].cloneNode(true);

            innerH2Tag = cloneCardsDiv.querySelector('h2');
            innerH2Tag.innerText = value.post_title;

            innerImgTag = cloneCardsDiv.querySelector('img');
            innerImgTag.setAttribute('src', value.post_thumbnail);

            innerCategory = cloneCardsDiv.querySelector('span');
            innerCategory.innerText = value.post_category;

            let sliderElement = document.getElementById(
              _this.parents('.slider-arrow-main').find('.nab-not-to-be-missed-slider').attr('id')
            );

            if (0 === key) {
              _this.parents('.slider-arrow-main').find('.nab-not-to-be-missed-slider').empty();
            }

            sliderElement.appendChild(cloneCardsDiv);
          }
        });

        $('.nab-not-to-be-missed-slider').each(function (index) {
          if ($(this).hasClass('change-slide')) {
            let numberOfVisibleSlides = bxNumberofVisibleSlide();
            let config = bxDynamicSliderConfig($(this), numberOfVisibleSlides);
            ntbmBxSliderObj[index].reloadSlider(config);
            $(this).removeClass('change-slide');
          }
        });

        $('#loader_container').hide();
      }
    });
  });

  /**
   * Initialize or reload slider
   */
  function configureSlider() {
    var numberOfVisibleSlides = bxNumberofVisibleSlide();
    if (0 < $('.nab-dynamic-slider').length) {
      $('.nab-dynamic-slider').each(function (index) {
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
      });
    }

    if (0 < $('.nab-not-to-be-missed-slider').length) {
      $('.nab-not-to-be-missed-slider').each(function (index) {
        let config = bxDynamicSliderConfig($(this), numberOfVisibleSlides);

        if (
          0 < ntbmBxSliderObj.length &&
          undefined !== ntbmBxSliderObj[index]
        ) {
          ntbmBxSliderObj[index].reloadSlider(config);
        } else {
          ntbmBxSliderObj[index] = $(this).bxSlider(config);
        }
      });
    }
  }

  // Schedule at a glance filter
  if (0 < $('.schedule-glance-filter div select#date').length) {
    $('.schedule-main').each(function () {
      insertOptions($(this).find('h2').text(), 'date');

      $(this).find('.schedule-row').each(function () {
        insertOptions($(this).find('.date p').text(), 'pass-type');
        insertOptions($(this).find('.location p').text(), 'location');
        insertOptions($(this).find('.details p').text(), 'type');
      });
    });

    $(document).on(
      'change',
      '.schedule-glance-filter .schedule-select #date, .schedule-glance-filter .schedule-select #pass-type, .schedule-glance-filter .schedule-select #location, .schedule-glance-filter .schedule-select #type',
      function () {
        filterScheduleData();
      }
    );

    $(document).on(
      'keyup',
      '.schedule-glance-filter .schedule-search',
      function () {
        filterScheduleData();
      }
    );
  }

  // meet the team filter
  if (0 < $('.team-main .team-box').length) {
    $('.team-main .team-box').each(function () {
      if (null !== $(this).data('category').split(',')) {
        $.map(
          $(this).data('category').split(','),
          function (val, i) {
            insertCheckbox(val, 'team-checkbox');
          }
        );
      }

      if ('' !== $(this).attr('data-department')) {
        insertOptions($(this).attr('data-department'), 'team-department');
      }
    });

    $(document).on('change', '.meet-team-select #team-department, .meet-team-select .checkbox-list input', function () {
      filterSelectTeam();
    }
    );
  }

  // Awards Filter
  if (0 < $('.schedule-glance-filter select#award-name').length) {
    $('.awards-main').each(function () {
      insertOptions($(this).find('.awards-winner-title').text(), 'award-name');
    });

    $(document).on('change', '.schedule-glance-filter .schedule-select #award-name', function () {
      filterAwards();
    });

    $(document).on('keyup', '.schedule-glance-filter .schedule-search', function () {
      filterAwards();
    });
  }

  // products-winners
  if (0 < $('.products-winners').length) {
    $('.products-winners').each(function () {
      if ('' !== $(this).find('.product-title').html()) {
        insertOptions($(this).find('.product-title').html(), 'products-category');
      }
    });

    $(document).on('change', '#products-category', function () {
      filterSelectProduct();
    });

    $(document).on('keyup', '#products-search', function () {
      filterSelectProduct();
    });

    $(document).on('click', 'ul.alphabets-list li', function () {
      const clickItem = $(this).html();
      filterSelectProduct(clickItem);
    });

  }

  // nab-photos
  if (0 < $('.nab-photos').length) {
    $(document).on('click', '.nab-photos .popup-btn', function () {
      var imgWidth = jQuery(this).parent().parent().find('.media').attr('width');
      jQuery('.nab-photos .photos-popup .photos-popup-img').attr('src', jQuery(this).parent().parent().find('.media').attr('src'));
      jQuery('.nab-photos .photos-dialog').css('width', 1370 > imgWidth ? imgWidth : '1370px');
      jQuery('.nab-photos .photos-popup').show();
      jQuery('body').addClass('overflow-hidden');
      jQuery('.nab-photos .photos-backdrop').show();
    });

    $(document).on('click', '.nab-photos .close', function () {
      jQuery('.nab-photos .photos-popup').hide();
      jQuery('.nab-photos .photos-backdrop').hide();
      jQuery('body').removeClass('overflow-hidden');
    });

    $(document).on('click', '.nab-photos .photos-backdrop', function () {
      jQuery('.nab-photos .photos-popup').hide();
      jQuery('.nab-photos .photos-backdrop').hide();
      jQuery('body').removeClass('overflow-hidden');
    });

  }

  // Related content details js box-main
  if (0 < $('.box-main .box-item').length) {

    $('.new-this-year .box-main .box-item').each(function () {
      if ('' !== $(this).find('.title').html()) {
        insertOptions($(this).find('.title').html(), 'box-main-category');
      }
    });

    $('.delegation .box-main .box-item').each(function () {
      if ('' !== $(this).find('.country').html().split(',')) {
        $.map(
          $(this).find('.country').html().split(','),
          function (val, i) {
            insertOptions(val, 'box-main-category');
          }
        );
      }
    });

    $(document).on('change', '#box-main-category', function () {
      boxMainFilter();
    });

    $(document).on('keyup', '#box-main-search', function () {
      boxMainFilter();
    });

    $(document).on('keyup', '#box-main-search-bd', function () {
      badgefilter();
    });

    $('.badge-discounts').each(function () {
      if ('' !== $(this).find('.badge-title').html()) {
        insertList($(this).find('.badge-title').text(), 'box-main-listing');
      }
    });

    if (0 < jQuery('#box-main-listing a').length) {
      jQuery('#box-main-listing a').on('click', function () {
        let listName = $(this).text();

        jQuery('.box-main .box-item').removeClass('slideInUp').hide();
        jQuery('.box-main .box-item').addClass('slideInUp').show();

        if (null !== listName) {
          jQuery('.badge-discounts').each(function () {
            jQuery(this).show();
            if (jQuery(this).find('.badge-title').text() !== listName) {
              jQuery(this).hide();
            }
          });
        }
      });

    }

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
    let nabauto = !! elementHandler.attr('data-auto'),
      nabinfinite = !! elementHandler.attr('data-infinite'),
      nabpager = !! elementHandler.attr('data-pager'),
      nabcontrols = !! elementHandler.attr('data-controls'),
      nabMinSlides =
        0 < numberOfVisibleSlides ?
          numberOfVisibleSlides :
          parseInt(elementHandler.attr('data-minslides'));

    let allImgs = Array.from(
      document.querySelectorAll('.nab-not-to-be-missed-slider .item img')
    );
    for (let i = 0; i < allImgs.length; i++) {
      let imgWidth = allImgs[i].parentNode;
      imgWidth.style.backgroundImage = `url('${
        allImgs[i].attributes.src.nodeValue
        }')`;
    }

    return {
      minSlides: nabMinSlides,
      maxSlides: nabMinSlides,
      moveSlides: 1,
      slideMargin: parseInt(elementHandler.attr('data-slidemargin')),
      slideWidth: parseInt(elementHandler.attr('data-slidewidth')),
      auto: nabauto,
      infiniteLoop: nabinfinite,
      pager: nabpager,
      controls: nabcontrols,
      speed: parseInt(elementHandler.attr('data-speed')),
      mode: elementHandler.attr('data-mode'),
      touchEnabled: false
    };
  }

  if (0 < $('.nab-banner-main .nab-banner-link').length) {
    let slug = window.location.pathname;
    jQuery.ajax({
      type: 'GET',
      data: 'action=nabshow_lv_custom_ads_view' + '&nabshow_lv_custom_ads_nonce=' + nabshowLvCustom.nabshow_lv_custom_ads_nonce + '&slug=' + slug,
      url: nabshowLvCustom.ajax_url,
      success: function (getData) {
      }
    });

    $(document).on('click', '.nab-banner-main .nab-banner-link', function () {
      if ('' !== $(this).attr('data-category') && '' !== $(this).attr('data-action')) {

        //ga('send', { hitType: 'event', eventCategory: $(this).attr( 'data-category' ), eventAction: $(this).attr('data-action' ), eventLabel: $(this).attr('data-label' ) });
      }
      jQuery.ajax({
        type: 'GET',
        data: 'action=nabshow_lv_custom_ads_click' + '&nabshow_lv_custom_ads_nonce=' + nabshowLvCustom.nabshow_lv_custom_ads_nonce + '&slug=' + slug,
        url: nabshowLvCustom.ajax_url,
        success: function (getData) {
        }
      });
    });
  }

  // Full Width Custom Block
  $('.wp-block-nab-nab-custom.custom-box .custom-box-container').each(function () {
    if ($(this).parent().hasClass('has-full')) {
      $(this).addClass('container');
    }
  });

  $(document).on('click', '.session-data.schedule-main .row-expand .expand-btn', function () {
    if ('Expand' === $(this).text()) {
      $(this).text('collapse');
    } else {
      $(this).text('Expand');
    }
    $(this).parent().nextAll('.schedule-row').toggleClass('hide-row');
  });

  // jQuery('.card-columns-box .cards').addClass('fadeInDown');
  if ($('#primary').hasClass('ltb-zoomin')) {
    jQuery('.ltb-zoomin .card-columns-box .cards').addClass('zoomIn');
  } else if ($('#primary').hasClass('ltb-fadein')) {
    jQuery('.ltb-fadein .card-columns-box .cards').addClass('zoomInUp');
  } else if ($('#primary').hasClass('ltb-slidein')) {
    jQuery('.ltb-slidein .card-columns-box .cards').addClass('slideInUp');
  } else if ($('#primary').hasClass('ltb-effect')) {
    jQuery('.ltb-effect .card-columns-box .cards').addClass('pulse');
  }

  if (0 < $('.filter-block.main-filter .session-category-drp').length && (0 < $('.nab-dynamic-list.session').length || 0 < $('.nab-dynamic-slider.session').length)) {
    $(document).on('change', '.filter-block.main-filter .session-category-drp', function () {
      sessionListFilter();
    });
    $(document).on('keyup', '.filter-block.main-filter .search-item .search', function () {
      sessionListFilter();
    });
    $(document).on('click', '.filter-block.main-filter .featured-btn', function () {
      $(this).toggleClass('active');
      $('.nab-dynamic-slider.session .item[data-featured="featured"], .nab-dynamic-list.session .item[data-featured="featured"]').toggleClass('featured');
    });
  }

  function sessionListFilter() {

    let filterCategory = 0 < $('.filter-block.main-filter .session-category-drp')[0].selectedIndex ? $('.filter-block.main-filter .session-category-drp').val() : null;
    let filterSearch = $('.filter-block.main-filter .search-item .search').val();

    jQuery('.nab-dynamic-list.session .item').show();
    jQuery('.nab-dynamic-slider.session .item.bx-clone').remove();
    jQuery('.nab-dynamic-slider.session .item').removeClass('d-none');

    if (null !== filterCategory) {
      jQuery('.nab-dynamic-list.session .item:not([data-tracks*="' + filterCategory + '"])').hide();
      jQuery('.nab-dynamic-slider.session .item:not([data-tracks*="' + filterCategory + '"]):not(.bx-clone)').addClass('d-none');
    }

    if ('' !== filterSearch) {
      $('.nab-dynamic-list.session .item:visible').filter(function () { return (0 > $('h4', this).text().toLowerCase().indexOf(filterSearch.toLowerCase())); }).hide();
      $('.nab-dynamic-slider.session .item:visible').filter(function () { return (0 > $('h4', this).text().toLowerCase().indexOf(filterSearch.toLowerCase())); }).addClass('d-none');
    }

    configureSlider();

  }

  /**
   *  Session browse filter data
   */
  if ( 0 < $('.browse-sessions-filter').length ) {
    let pageNumber, filterType,
        postStartWith = '',
        sessionTrack = '',
        sessionLevel = '',
        sessionType = '',
        sessionLocation = '',
        sessionItem = jQuery('#browse-session .item')[0];

    $(document).on('change', '.browse-sessions-filter .browse-select #session-tracks', function () {
      let currentTrack = 0 === $(this)[0].selectedIndex ? '': $(this).val();
      if ( sessionTrack !== currentTrack ) {
        pageNumber = 1;
        filterType = 'browse-filter';
        sessionTrack = currentTrack;
        nabAjaxForBrowseSession( sessionItem, filterType, pageNumber, postStartWith, sessionTrack, sessionLevel, sessionType, sessionLocation);
      }
    });

    $(document).on('change', '.browse-sessions-filter .browse-select #session-level', function () {
      let currentLevel = 0 === $(this)[0].selectedIndex ? '': $(this).val();
      if ( sessionLevel !== currentLevel ) {
        pageNumber = 1;
        filterType = 'browse-filter';
        sessionLevel = currentLevel;
        nabAjaxForBrowseSession( sessionItem, filterType, pageNumber, postStartWith, sessionTrack, sessionLevel, sessionType, sessionLocation);
      }
    });

    $(document).on('change', '.browse-sessions-filter .browse-select #session-type', function () {
      let currentType = 0 === $(this)[0].selectedIndex ? '': $(this).val();
      if ( sessionType !== currentType ) {
        pageNumber = 1;
        filterType = 'browse-filter';
        sessionType = currentType;
        nabAjaxForBrowseSession( sessionItem, filterType, pageNumber, postStartWith, sessionTrack, sessionLevel, sessionType, sessionLocation);
      }
    });

    $(document).on('change', '.browse-sessions-filter .browse-select #session-location', function () {
      let currentLocation = 0 === $(this)[0].selectedIndex ? '': $(this).val();
      if ( sessionLocation !== currentLocation ) {
        pageNumber = 1;
        filterType = 'browse-filter';
        sessionLocation = currentLocation;
        nabAjaxForBrowseSession( sessionItem, filterType, pageNumber, postStartWith, sessionTrack, sessionLevel, sessionType, sessionLocation);
      }
    });

    $(document).on('keypress', '.browse-sessions-filter .search-item .search', function (e) {
      if ( 13 === e.which ) {
        pageNumber = 1;
        filterType = 'browse-filter';
        nabAjaxForBrowseSession( sessionItem, filterType, pageNumber, postStartWith, sessionTrack, sessionLevel, sessionType, sessionLocation);
      }
    });

    $(document).on('click', '#load-more-sessions a', function () {
      pageNumber = $(this).attr('data-page-number');
      filterType = 'load-more';
      nabAjaxForBrowseSession( sessionItem, filterType, pageNumber, postStartWith, sessionTrack, sessionLevel, sessionType, sessionLocation);
    });

    $(document).on('click', '.browse-sessions-filter .featured-btn', function () {
      $(this).toggleClass('active');
      $('#browse-session .item[data-featured="featured"]').toggleClass('featured');
    });

    $(document).on('click', '.browse-sessions-filter .alphabets-list li:not(".clear")', function () {

      $(this).addClass('active').siblings().removeClass('active');
      if ( 0 < $(this).parent().find('li.active').length ) {
        $(this).siblings('.clear').show();
      }

      if ( postStartWith !== $(this).text() ) {
        postStartWith = $(this).text();
        pageNumber = 1;
        filterType = 'browse-filter';
        nabAjaxForBrowseSession( sessionItem, filterType, pageNumber, postStartWith, sessionTrack, sessionLevel, sessionType, sessionLocation);
      }
    });

    $(document).on('click', '.browse-sessions-filter .alphabets-list li.clear', function () {
      $(this).hide().siblings().removeClass('active');
      postStartWith = '';
      filterType = 'browse-filter';
      pageNumber = 1;
      nabAjaxForBrowseSession( sessionItem, filterType, pageNumber, postStartWith, sessionTrack, sessionLevel, sessionType, sessionLocation);
    });
  }

  /**
   *  Exhibitors browse filter data
   */
  if ( 0 < $('.browse-exhibitors-filter').length ) {
    let exhibitorPageNumber,
        exhibitorStartWith = '',
        exhibitorCategory = '',
        exhibitorHall = '',
        exhibitorPavilion = '',
        exhibitorItem = jQuery('#browse-exhibitor .item')[0];

    $(document).on('change', '.browse-exhibitors-filter .browse-select #exhibitor-category', function () {
      let currentCategory = 0 === $(this)[0].selectedIndex ? '': $(this).val();
      if ( exhibitorCategory !== currentCategory ) {
        exhibitorPageNumber = 1;
        exhibitorCategory = currentCategory;
        nabAjaxForBrowseExhibitors( exhibitorItem, false, exhibitorPageNumber, exhibitorStartWith, exhibitorCategory, exhibitorHall, exhibitorPavilion);
      }
    });

    $(document).on('change', '.browse-exhibitors-filter .browse-select #exhibitor-hall', function () {
      let currentHall = 0 === $(this)[0].selectedIndex ? '': $(this).val();
      if ( exhibitorHall !== currentHall ) {
        exhibitorPageNumber = 1;
        exhibitorHall = currentHall;
        nabAjaxForBrowseExhibitors( exhibitorItem, false, exhibitorPageNumber, exhibitorStartWith, exhibitorCategory, exhibitorHall, exhibitorPavilion);
      }
    });

    $(document).on('change', '.browse-exhibitors-filter .browse-select #exhibitor-pavilion', function () {
      let currentPavilion = 0 === $(this)[0].selectedIndex ? '': $(this).val();
      if ( exhibitorPavilion !== currentPavilion ) {
        exhibitorPageNumber = 1;
        exhibitorPavilion = currentPavilion;
        nabAjaxForBrowseExhibitors( exhibitorItem, false, exhibitorPageNumber, exhibitorStartWith, exhibitorCategory, exhibitorHall, exhibitorPavilion);
      }
    });

    $(document).on('keypress', '.browse-exhibitors-filter .search-item .search', function (e) {
      if ( 13 === e.which ) {
        exhibitorPageNumber = 1;
        nabAjaxForBrowseExhibitors( exhibitorItem, false, exhibitorPageNumber, exhibitorStartWith, exhibitorCategory, exhibitorHall, exhibitorPavilion);
      }
    });

    $(document).on('click', '#load-more-exhibitor a', function () {
      exhibitorPageNumber = $(this).attr('data-page-number');
      nabAjaxForBrowseExhibitors( exhibitorItem, true, exhibitorPageNumber, exhibitorStartWith, exhibitorCategory, exhibitorHall, exhibitorPavilion);
    });

    $(document).on('click', '.browse-exhibitors-filter .featured-btn', function () {
      $(this).toggleClass('active');
      $('#browse-exhibitor .item[data-featured="featured"]').toggleClass('featured');
    });

    $(document).on('click', '.browse-exhibitors-filter .alphabets-list li:not(".clear")', function () {

      $(this).addClass('active').siblings().removeClass('active');
      if ( 0 < $(this).parent().find('li.active').length ) {
        $(this).siblings('.clear').show();
      }

      if ( exhibitorStartWith !== $(this).text() ) {
        exhibitorStartWith = $(this).text();
        exhibitorPageNumber = 1;
        nabAjaxForBrowseExhibitors( exhibitorItem, false, exhibitorPageNumber, exhibitorStartWith, exhibitorCategory, exhibitorHall, exhibitorPavilion);
      }
    });

    $(document).on('click', '.browse-exhibitors-filter .alphabets-list li.clear', function () {
      $(this).hide().siblings().removeClass('active');
      exhibitorStartWith = '';
      exhibitorPageNumber = 1;
      nabAjaxForBrowseExhibitors( exhibitorItem, false, exhibitorPageNumber, exhibitorStartWith, exhibitorCategory, exhibitorHall, exhibitorPavilion);
    });

    $(document).on('change', '.browse-exhibitors-filter .exhibitor-keywords', function () {
      exhibitorPageNumber = 1;
      nabAjaxForBrowseExhibitors( exhibitorItem, false, exhibitorPageNumber, exhibitorStartWith, exhibitorCategory, exhibitorHall, exhibitorPavilion);
    });

    $(document).on('click', '.browse-exhibitors-filter .orderby', function () {
      $(this).toggleClass('active');
      exhibitorPageNumber = 1;
      nabAjaxForBrowseExhibitors( exhibitorItem, false, exhibitorPageNumber, exhibitorStartWith, exhibitorCategory, exhibitorHall, exhibitorPavilion);
    });

  }

  /**
   *  Speaker browse filter data
   */
  if ( 0 < $('.browse-speakers-filter').length ) {
    let speakerPageNumber,
        speakerStartWith = '',
        speakerCompany = '',
        speakerItem = $('#browse-speaker .item')[0],
        speakerPopup = 0 < $('#browse-speaker .item .detail-list-modal-popup').length;

    $(document).on('change', '.browse-speakers-filter .browse-select #speaker-company', function () {
      let currentCompany = 0 === $(this)[0].selectedIndex ? '': $(this).val();
      if ( speakerCompany !== currentCompany ) {
        speakerPageNumber = 1;
        speakerCompany = currentCompany;
        nabAjaxForBrowseSpeakers( speakerItem, false, speakerPageNumber, speakerStartWith, speakerCompany, speakerPopup);
      }
    });

    $(document).on('keypress', '.browse-speakers-filter .search-item .search', function (e) {
      if ( 13 === e.which ) {
        speakerPageNumber = 1;
        nabAjaxForBrowseSpeakers( speakerItem, false, speakerPageNumber, speakerStartWith, speakerCompany, speakerPopup);
      }
    });

    $(document).on('keypress', '.browse-speakers-filter .speaker-title-search', function (e) {
      if ( 13 === e.which ) {
        speakerPageNumber = 1;
        nabAjaxForBrowseSpeakers( speakerItem, false, speakerPageNumber, speakerStartWith, speakerCompany, speakerPopup);
      }
    });

    $(document).on('click', '#load-more-speaker a', function () {
      speakerPageNumber = $(this).attr('data-page-number');
      nabAjaxForBrowseSpeakers( speakerItem, true, speakerPageNumber, speakerStartWith, speakerCompany, speakerPopup);
    });

    $(document).on('click', '.browse-speakers-filter .featured-btn', function () {
      $(this).toggleClass('active');
      $('#browse-speaker .item[data-featured="featured"]').toggleClass('featured');
    });

    $(document).on('click', '.browse-speakers-filter .alphabets-list li:not(".clear")', function () {

      $(this).addClass('active').siblings().removeClass('active');
      if ( 0 < $(this).parent().find('li.active').length ) {
        $(this).siblings('.clear').show();
      }

      if ( speakerStartWith !== $(this).text() ) {
        speakerStartWith = $(this).text();
        speakerPageNumber = 1;
        nabAjaxForBrowseSpeakers( speakerItem, false, speakerPageNumber, speakerStartWith, speakerCompany, speakerPopup);
      }
    });

    $(document).on('click', '.browse-speakers-filter .alphabets-list li.clear', function () {
      $(this).hide().siblings().removeClass('active');
      speakerStartWith = '';
      speakerPageNumber = 1;
      nabAjaxForBrowseSpeakers( speakerItem, false, speakerPageNumber, speakerStartWith, speakerCompany, speakerPopup);
    });

    $(document).on('click', '.browse-speakers-filter .orderby', function () {
      $(this).toggleClass('active');
      speakerPageNumber = 1;
      nabAjaxForBrowseSpeakers( speakerItem, false, speakerPageNumber, speakerStartWith, speakerCompany, speakerPopup);
    });
    $(window).load(function () {
      $('.browse-speakers-filter #speaker_date').datepicker({ dateFormat: 'MM, dd yy' }).on('change', function() {
        speakerPageNumber = 1;
        nabAjaxForBrowseSpeakers( speakerItem, false, speakerPageNumber, speakerStartWith, speakerCompany, speakerPopup);
      });
    });


  }

})(jQuery);

function nabAjaxForBrowseSpeakers( speakerItem, filterType, speakerPageNumber, speakerStartWith, speakerCompany, speakerPopup ) {
  let postPerPage = jQuery('#load-more-speaker a').attr('data-post-limit') ? jQuery('#load-more-speaker a').attr('data-post-limit') : 10,
      jobTitleSearch = jQuery('.browse-speakers-filter .speaker-title-search').val(),
      postSearch  = jQuery('.browse-speakers-filter .search-item .search').val(),
      speakerDate = jQuery('.browse-speakers-filter #speaker_date').val(),
      orderBy     = jQuery('.browse-speakers-filter .orderby').hasClass('active') ? 'title' : 'date';

  jQuery('body').addClass('popup-loader');


  jQuery.ajax({
    type: 'GET',
    data: 'action=speakers_browse_filter&page_number=' + speakerPageNumber + '&browse_filter_nonce=' + nabshowLvCustom.nabshow_lv_browse_filter_nonce + '&post_limit=' + postPerPage + '&post_start=' + speakerStartWith + '&post_search=' + postSearch + '&speaker_company=' + speakerCompany + '&speaker_order=' + orderBy + '&speaker_job=' + jobTitleSearch +'&speaker_date=' + speakerDate,
    url: nabshowLvCustom.ajax_url,
    success: function ( speakerData ) {

      let speakerObj = jQuery.parseJSON( speakerData );

      jQuery.each( speakerObj.result_post, function (key, value) {

        if ( value.post_title ) {

          let cloneItemDiv = speakerItem.cloneNode(true);
          cloneItemDiv.setAttribute('data-featured', value.featured);

          if ( speakerPopup ) {
            let innerParagraphATag = cloneItemDiv.querySelector('.detail-list-modal-popup');
            innerParagraphATag.setAttribute('data-postid', value.post_id);
          }

          let innerImg = cloneItemDiv.querySelector('img');
          innerImg.setAttribute('src', value.thumbnail_url);

          let innerHeading = cloneItemDiv.querySelector('h6');
          innerHeading.innerText = value.post_title;

          let innerParagraphTag = cloneItemDiv.querySelector('p');
          innerParagraphTag.innerText = value.job_title;

          let innerSpanTag = cloneItemDiv.querySelector('span');
          innerSpanTag.innerText = value.company;

          let exhibitorList = document.getElementById('browse-speaker');

          if ( ! filterType && 0 === key ) {
            jQuery('#browse-speaker').empty();
          }
          exhibitorList.appendChild(cloneItemDiv);
        }

      });

      jQuery('body').removeClass('popup-loader');
      jQuery('#browse-speaker .item').removeClass('slideInUp').hide();
      jQuery('#browse-speaker .item').addClass('slideInUp').show();

      jQuery('#load-more-speaker a').attr('data-page-number', speakerObj.next_page_number);

      if ( speakerObj.next_page_number > speakerObj.total_page ) {
        jQuery('#load-more-speaker').hide();
      } else {
        jQuery('#load-more-speaker').show();
      }

      if ( 0 === speakerObj.total_page ) {
        jQuery('#browse-speaker').empty().parent().find('p.no-data').show();
      } else {
        jQuery('#browse-speaker').parent().find('p.no-data').hide();
      }

      if ( jQuery('.browse-speakers-filter .featured-btn').hasClass('active') ) {
        jQuery('#browse-speaker .item').removeClass('featured');
        jQuery('#browse-speaker .item[data-featured="featured"]').addClass('featured');
      }

    }
  });
}

function nabAjaxForBrowseExhibitors( exhibitorItem, filterType, exhibitorPageNumber, exhibitorStartWith, exhibitorCategory, exhibitorHall, exhibitorPavilion ) {

  let postPerPage = jQuery('#load-more-exhibitor a').attr('data-post-limit') ? jQuery('#load-more-exhibitor a').attr('data-post-limit') : 10;
  let postSearch  = jQuery('.browse-exhibitors-filter .search-item .search').val();
  let keywords = new Array();
  let orderBy = jQuery('.browse-exhibitors-filter .orderby').hasClass('active') ? 'title' : 'date';

  jQuery('body').addClass('popup-loader');
  jQuery('.browse-exhibitors-filter .exhibitor-keywords:checked').each(function() {
    keywords.push( jQuery(this).val() );
  });

  jQuery.ajax({
    type: 'GET',
    data: 'action=exhibitors_browse_filter&page_number=' + exhibitorPageNumber + '&browse_filter_nonce=' + nabshowLvCustom.nabshow_lv_browse_filter_nonce + '&post_limit=' + postPerPage + '&post_start=' + exhibitorStartWith + '&post_search=' + postSearch + '&exhibitor_category=' + exhibitorCategory + '&exhibitor_hall='+ exhibitorHall + '&exhibitor_pavilion='+ exhibitorPavilion + '&exhibitor_keywords=' + keywords + '&exhibitor_order=' + orderBy,
    url: nabshowLvCustom.ajax_url,
    success: function ( exhibitorData ) {

      let exhibitorObj = jQuery.parseJSON( exhibitorData );

      jQuery.each( exhibitorObj.result_post, function (key, value) {

        if ( value.post_title ) {
          let cloneItemDiv = exhibitorItem.cloneNode(true);
          cloneItemDiv.setAttribute('data-featured', value.featured);

          let innerImg = cloneItemDiv.querySelector('img');

          if ( null === innerImg && '' !== value.thumbnail_url ) {
            let imgTag = document.createElement('img');
            imgTag.setAttribute('src', value.thumbnail_url);
            imgTag.setAttribute('alt', 'exhibitor-logo');

            let innerDiv = cloneItemDiv.querySelector('.item-inner');
            innerDiv.insertBefore(imgTag, innerDiv.childNodes[0]);
          } else if ( null != innerImg && '' !== value.thumbnail_url ) {
            innerImg.setAttribute('src', value.thumbnail_url);
          } else if ( null !== innerImg ) {
            innerImg.remove();
          }


          let innerHeading = cloneItemDiv.querySelector('h4');
          innerHeading.innerText = value.post_title;

          let innerSpanTag = cloneItemDiv.querySelector('span');
          innerSpanTag.innerText = value.boothnumber;

          let innerParagraphTag = cloneItemDiv.querySelector('p');
          innerParagraphTag.childNodes[0].nodeValue = value.post_excerpt;

          let innerParagraphATag = cloneItemDiv.querySelector('.detail-list-modal-popup');
          innerParagraphATag.setAttribute('data-postid', value.post_id);

          let innerATag = cloneItemDiv.querySelector('.item-inner > a');
          innerATag.setAttribute('href', value.planner_link);

          let exhibitorList = document.getElementById('browse-exhibitor');

          if ( ! filterType && 0 === key ) {
            jQuery('#browse-exhibitor').empty();
          }
          exhibitorList.appendChild(cloneItemDiv);
        }

      });

      jQuery('body').removeClass('popup-loader');
      jQuery('#browse-exhibitor .item').removeClass('slideInUp').hide();
      jQuery('#browse-exhibitor .item').addClass('slideInUp').show();

      jQuery('#load-more-exhibitor a').attr('data-page-number', exhibitorObj.next_page_number);

      if ( exhibitorObj.next_page_number > exhibitorObj.total_page ) {
        jQuery('#load-more-exhibitor').hide();
      } else {
        jQuery('#load-more-exhibitor').show();
      }

      if ( 0 === exhibitorObj.total_page ) {
        jQuery('#browse-exhibitor').empty().parent().find('p.no-data').show();
      } else {
        jQuery('#browse-exhibitor').parent().find('p.no-data').hide();
      }

      if ( jQuery('.browse-sessions-filter .featured-btn').hasClass('active') ) {
        jQuery('#browse-exhibitor .item').removeClass('featured');
        jQuery('#browse-exhibitor .item[data-featured="featured"]').addClass('featured');
      }

    }
  });
}


function nabAjaxForBrowseSession( sessionItem, filterType, pageNumber, postStartWith, sessionTrack, sessionLevel, sessionType, sessionLocation ) {
  let postPerPage = jQuery('#load-more-sessions a').attr('data-post-limit') ? jQuery('#load-more-sessions a').attr('data-post-limit') : 10;
  let postSearch  = jQuery('.browse-sessions-filter .search-item .search').val();
  jQuery('body').addClass('popup-loader');

  jQuery.ajax({
    type: 'GET',
    data: 'action=sessions_browse_filter&page_number=' + pageNumber + '&browse_filter_nonce=' + nabshowLvCustom.nabshow_lv_browse_filter_nonce + '&post_limit=' + postPerPage + '&post_start=' + postStartWith + '&post_search=' + postSearch + '&track=' + sessionTrack + '&level=' + sessionLevel + '&session_type=' + sessionType + '&location=' + sessionLocation,
    url: nabshowLvCustom.ajax_url,
    success: function (sessionData) {

      let sessionObj = jQuery.parseJSON(sessionData);

      jQuery.each(sessionObj.result_post, function (key, value) {
        if (value.post_title) {
          let cloneItemDiv = sessionItem.cloneNode(true);
          cloneItemDiv.setAttribute('data-featured', value.featured);

          let innerHeading = cloneItemDiv.querySelector('h4');
          innerHeading.innerText = value.post_title;

          let innerSpanTag = cloneItemDiv.querySelector('span');
          innerSpanTag.innerText = value.date_time;

          let innerParagraphTag = cloneItemDiv.querySelector('p');
          innerParagraphTag.childNodes[0].nodeValue = value.post_excerpt;

          let innerParagraphATag = cloneItemDiv.querySelector('.detail-list-modal-popup');
          innerParagraphATag.setAttribute('data-postid', value.post_id);

          let innerATag = cloneItemDiv.querySelector('a');
          innerATag.setAttribute('href', value.planner_link);

          let sessionList = document.getElementById('browse-session');

          if ( 'load-more' !== filterType && 0 === key) {
            jQuery('#browse-session').empty();
          }
          sessionList.appendChild(cloneItemDiv);
        }

      });

      jQuery('body').removeClass('popup-loader');
      jQuery('#browse-session .item').removeClass('slideInUp').hide();
      jQuery('#browse-session .item').addClass('slideInUp').show();

      jQuery('#load-more-sessions a').attr('data-page-number', sessionObj.next_page_number);

      if ( sessionObj.next_page_number > sessionObj.total_page ) {
        jQuery('#load-more-sessions').hide();
      } else {
        jQuery('#load-more-sessions').show();
      }

      if ( 0 === sessionObj.total_page ) {
        jQuery('#browse-session').empty().parent().find('p.no-data').show();
      } else {
        jQuery('#browse-session').parent().find('p.no-data').hide();
      }

      if ( jQuery('.browse-sessions-filter .featured-btn').hasClass('active') ) {
        jQuery('#browse-session .item').removeClass('featured');
        jQuery('#browse-session .item[data-featured="featured"]').addClass('featured');
      }

    }
  });
}

/* Masonry column */
function masonryGrids() {
  var colCount, colHeight, i, mainDiv, highest, order, divHeight;
  colHeight = [];
  mainDiv = document.getElementById('card_section');
  jQuery('#card_section .item').css({ opacity: '0', transform: 'scale(0.8, 0.8)' });
  if (3 >= mainDiv.children.length) {
    document.getElementById('card_section').style.flexDirection = 'inherit';
    document.getElementById('card_section').style.alignItems = 'flex-start';
    document.getElementById('card_section').style.height = 'auto';
    document.getElementById('card_section').classList.add('col-countbox');
    for (i = 0; i < mainDiv.children.length; i++) {
      jQuery(mainDiv.children[i]).show('slow').css({ opacity: '1', transform: 'scale(1, 1)' });
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
      }
      else {
        divHeight = mainDiv.children[i].clientHeight;
      }
      if (0 === divHeight) {
        divHeight = mainDiv.children[i].childNodes[1].childNodes[1].naturalHeight;
      }
      mainDiv.children[i].style.height = divHeight + 'px';
      colHeight[order] += parseInt(divHeight);

      jQuery(mainDiv.children[i])
        .show('slow')
        .css({ opacity: '1', transform: 'scale(1, 1)' });
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

function insertList(data, id) {
  let node = document.createElement('a');
  let textnode = document.createTextNode(data);
  node.appendChild(textnode);
  let optionData = document.getElementById(id);
  optionData.appendChild(node);
}

/**
 * Schedule at a glance Search functionality
 */
function filterScheduleData() {
  jQuery('.schedule-main, .schedule-main .schedule-row').show();
  jQuery('.no-data').hide();

  let filterDate = 0 < jQuery('.schedule-glance-filter .schedule-select #date')[0].selectedIndex ? jQuery('.schedule-glance-filter .schedule-select #date').val() : null;
  let filterTime = 0 < jQuery('.schedule-glance-filter .schedule-select #pass-type')[0].selectedIndex ? jQuery('.schedule-glance-filter .schedule-select #pass-type').val() : null;
  let filterLocation = 0 < jQuery('.schedule-glance-filter .schedule-select #location')[0].selectedIndex ? jQuery('.schedule-glance-filter .schedule-select #location').val() : null;
  let filterType = 0 < jQuery('.schedule-glance-filter .schedule-select #type')[0].selectedIndex ? jQuery('.schedule-glance-filter .schedule-select #type').val() : null;
  let filterSearch = jQuery('.schedule-glance-filter .schedule-search').val();

  if (null !== filterDate) {
    jQuery('.schedule-main h2:not(:contains("' + filterDate + '"))').parents('.schedule-main').hide();
  }
  if (null !== filterTime) {
    jQuery('.schedule-main .schedule-row .date:not(:contains("' + filterTime + '"))').parents('.schedule-row').hide();
  }
  if (null !== filterLocation) {
    jQuery('.schedule-main .schedule-row .location:not(:contains("' + filterLocation + '"))').parents('.schedule-row').hide();
  }
  if (null !== filterType) {
    jQuery('.schedule-main .schedule-row .details:not(:contains("' + filterType + '"))').parents('.schedule-row').hide();
  }
  if ('' !== filterSearch) {
    jQuery('.schedule-row:visible')
      .filter(function () {
        return (
          0 >
          jQuery('.name', this).text().toLowerCase().indexOf(filterSearch.toLowerCase())
        );
      })
      .hide();
  }

  jQuery('.schedule-main')
    .not(function () {
      return 0 < jQuery(this).find('.schedule-row:visible').length;
    })
    .hide();

  if (0 === jQuery('.schedule-main:visible').length) {
    if (0 === jQuery('.no-data').length) {
      createResultNotFoundNode('.schedule-main');
    } else {
      jQuery('.no-data').show();
    }
  }
}

/**
 * Create result not found node
 * @param selector
 */
function createResultNotFoundNode(selector) {
  let parentNode = document.createElement('div'),
    childNode = document.createElement('p'),
    childTextNode = document.createTextNode('Result Not Found'),
    mainNode = document.querySelector(selector);

  parentNode.setAttribute('class', 'no-data');
  childNode.appendChild(childTextNode);
  parentNode.appendChild(childNode);
  mainNode.parentNode.insertBefore(parentNode, mainNode);
}

function insertCheckbox(data, id) {
  if (0 === jQuery('#' + id + ' input[value="' + data + '"]').length && '' !== data) {
    let parentNode = document.createElement('div'),
      childNode = document.createElement('INPUT'),
      childTextNode = document.createTextNode(data),
      mainNode = document.getElementById(id);
    childNode.setAttribute('type', 'checkbox');
    childNode.setAttribute('value', data);
    parentNode.setAttribute('class', 'checkbox-list');
    parentNode.appendChild(childNode);
    parentNode.appendChild(childTextNode);
    mainNode.appendChild(parentNode);
  }
}

function filterSelectTeam() {
  jQuery('.team-main .team-box').removeClass('slideInUp').hide();
  jQuery('.team-main .team-box').addClass('slideInUp').show();
  jQuery('.no-data').hide();

  let filterDepartment =
    0 < jQuery('.meet-team-select #team-department')[0].selectedIndex ?
      jQuery('.meet-team-select #team-department').val() :
      null;

  jQuery('#team-checkbox .checkbox-list input').parent().removeClass('checked');
  jQuery('#team-checkbox .checkbox-list input:checked').parent().addClass('checked');

  if (0 < jQuery('#team-checkbox .checkbox-list input:checked').length) {
    jQuery('.team-main .team-box').hide();

    jQuery('#team-checkbox .checkbox-list input:checked').each(function () {
      jQuery('.team-main .team-box[data-category*="' + jQuery(this).val() + '"]').hide().show();
    });
  }

  if (null !== filterDepartment) {
    jQuery('.team-main .team-box:not([data-department="' + filterDepartment + '"])').hide();
  }

  if (0 === jQuery('.team-main .team-box:visible').length) {
    if (0 === jQuery('.no-data').length) {
      createResultNotFoundNode('.team-box');
    } else {
      jQuery('.no-data').show();
    }
  }
}

function filterAwards() {
  jQuery('.wp-block-nab-awards-item').removeClass('slideInUp').hide();
  jQuery('.wp-block-nab-awards-item').addClass('slideInUp').show();
  jQuery('.awards-main').show();
  jQuery('.no-data').hide();

  let filterAwardName = 0 < jQuery('#award-name')[0].selectedIndex ? jQuery('#award-name').val() : null;

  if (null !== filterAwardName) {
    jQuery('.awards-header').each(function () {
      if (jQuery(this).has('.awards-winner-title').length) {
        jQuery('.awards-header .awards-winner-title:not(:contains("' + filterAwardName + '"))').parents('.awards-main').hide();
      } else {
        jQuery(this).parents('.awards-main').hide();
      }
    });
  }

  let filterSearch = jQuery('.awards-filtering .awards-search').val();

  if ('' !== filterSearch) {
    jQuery('.wp-block-nab-awards-item:visible')
      .filter(function () {
        return (
          0 > jQuery('.winnerName', this).text().toLowerCase().indexOf(filterSearch.toLowerCase())
        );
      })
      .hide();
  }

  jQuery('.awards-main')
    .not(function () {
      return 0 < jQuery(this).find('.wp-block-nab-awards-item:visible').length;
    })
    .hide();

  if (0 === jQuery('.awards-main:visible').length) {
    if (0 === jQuery('.no-data').length) {
      createResultNotFoundNode('.awards-main');
    } else {
      jQuery('.no-data').show();
    }
  }
}

// products-winners filter function
function filterSelectProduct(clickItem) {
  jQuery('.products-winners').show();
  jQuery('.product-main .product-item').removeClass('slideInUp').hide();
  jQuery('.product-main .product-item').addClass('slideInUp').show();
  jQuery('.no-data').hide();

  let filterAwardName = 0 < jQuery('#products-category')[0].selectedIndex ? jQuery('#products-category').val() : null;

  if (null !== filterAwardName) {
    jQuery('.products-winners:visible .product-title:not(:contains("' + filterAwardName + '"))').parents('.products-winners').hide();
  }

  if (jQuery('.alphabets-list li:not(.clear)').hasClass('active')) {
    alphabetsFilter();
  }

  let filterSearch = jQuery('#products-search').val();

  if ('' !== filterSearch) {
    jQuery('.product-item:visible')
      .filter(function () {
        return (
          0 > jQuery('.title', this).text().toLowerCase().indexOf(filterSearch.toLowerCase())
        );
      }).hide();
  }

  if ('' !== clickItem && undefined !== clickItem) {
    jQuery('ul.alphabets-list li:not(.clear)').removeClass('active');
    jQuery('ul.alphabets-list li:not(.clear):contains("' + clickItem + '")').addClass('active');
    jQuery('ul.alphabets-list li.clear').show();

    alphabetsFilter();

    if ('Clear' === clickItem) {
      jQuery('.products-winners:visible .product-main .product-item').show();
      jQuery('ul.alphabets-list li.clear').hide();
      jQuery('ul.alphabets-list li:not(.clear)').removeClass('active');
    }
  }

  function alphabetsFilter() {
    jQuery('.products-winners:visible .product-item:visible')
      .filter(function () {
        return (
          jQuery('.alphabets-list li:not(.clear).active').text().toLowerCase() != jQuery('.subtitle', this).text().toLowerCase().charAt(0)
        );
      }).hide();
  }

  jQuery('.products-winners')
    .not(function () {
      return 0 < jQuery(this).find('.product-item:visible').length;
    }).hide();

  if (0 === jQuery('.products-winners:visible').length) {
    if (0 === jQuery('.no-data').length) {
      createResultNotFoundNode('.products-winners');
    } else {
      jQuery('.no-data').show();
    }
  }
}


// Faq filter function
function filterFaq(clickItem) {
  jQuery('.accordionParentWrapper, .accordionWrapper').show();
  jQuery('.no-data').hide();

  let filterAwardName = 0 < jQuery('#faq-category-drp')[0].selectedIndex ? jQuery('#faq-category-drp').val() : null;

  if (null !== filterAwardName) {
    jQuery('.accordionParentWrapper:visible').each(function () {
      if (jQuery(this).find('h2.title').html() == undefined) {
        jQuery(this).hide();
      }
      if (jQuery(this).find('h2.title:contains("' + filterAwardName + '")').html() !== filterAwardName) {
        jQuery(this).hide();
      }
    });
  }

  let filterSearch = jQuery('#faq-search').val();

  if ('' !== filterSearch) {
    jQuery('.accordionWrapper:visible')
      .filter(function () {
        return (
          0 > jQuery('.accordionHeader h3', this).text().toLowerCase().indexOf(filterSearch.toLowerCase())
        );
      }).hide();
  }

  jQuery('.accordionParentWrapper')
    .not(function () {
      return 0 < jQuery(this).find('.accordionWrapper:visible').length;
    }).hide();

  if (0 === jQuery('.accordionParentWrapper:visible').length) {
    if (0 === jQuery('.no-data').length) {
      createResultNotFoundNode('.accordionParentWrapper');
    } else {
      jQuery('.no-data').show();
    }
  }
}


// Related content details js box-main function
function boxMainFilter(clickItem) {
  jQuery('.box-main .box-item').removeClass('slideInUp').hide();
  jQuery('.box-main .box-item').addClass('slideInUp').show();
  jQuery('.no-data').hide();

  let filterAwardName = 0 < jQuery('#box-main-category')[0].selectedIndex ? jQuery('#box-main-category').val() : null;
  if (null !== filterAwardName) {
    jQuery('.new-this-year .box-main .box-item').each(function () {
      if ( jQuery(this).find('.title').html() !== filterAwardName ){
        jQuery(this).hide();
      }
    });
    jQuery('.delegation .box-main .box-item').each(function () {
      jQuery('.country:not(:contains("' + filterAwardName + '"))').closest('.box-item').hide();
    });
  }

  let filterSearch = jQuery('#box-main-search').val();
  if ('' !== filterSearch) {
    jQuery('.box-main .box-item:visible')
        .filter(function () {
          return (
              0 > jQuery('.title', this).text().toLowerCase().indexOf(filterSearch.toLowerCase())
          );
        }).hide();
  }
  jQuery('.box-item')
      .not(function () {
        return 0 < jQuery('.box-item:visible').length;
      }).hide();

  if (0 === jQuery('.box-item:visible').length) {
    if (0 === jQuery('.no-data').length) {
      createResultNotFoundNode('.box-item');
    } else {
      jQuery('.no-data').show();
    }
  }
}

// badge filter js
function badgefilter(clickItem) {
  jQuery('.box-main .box-item').removeClass('slideInUp').hide();
  jQuery('.box-main .box-item').addClass('slideInUp').show();
  jQuery('.no-data').hide();

  // filter using search
  let filterSearch = jQuery('#box-main-search-bd').val();

  if ('' !== filterSearch) {
    jQuery('.badge-discounts:visible .box-item:visible')
      .filter(function () {
        return (
          0 > jQuery('.title', this).text().toLowerCase().indexOf(filterSearch.toLowerCase())
        );
      })
      .hide();
  } else {
    jQuery('.badge-discounts').show();
  }

  jQuery('.badge-discounts:visible')
    .not(function () {
      return 0 < jQuery(this).find('.box-item:visible').length;
    })
    .hide();

  if (0 === jQuery('.badge-discounts:visible').length) {
    if (0 === jQuery('.no-data').length) {
      createResultNotFoundNode('.badge-discounts');
    } else {
      jQuery('.no-data').show();
    }
  }

}