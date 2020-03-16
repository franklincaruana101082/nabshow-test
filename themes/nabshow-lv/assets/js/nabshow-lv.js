(function ($) {
  'use strict';
  var bxSliderObj = [],
    ntbmBxSliderObj = [];

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
      let nabanimation = $(this).attr('data-animation');

      $(this).bxSlider({
        mode: $(this).attr('nabmode'),
        infiniteLoop: 'true' === $(this).attr('data-infiniteloop') ? true : false,
        auto: 'true' === $(this).attr('data-autoplay') ? true : false,
        stopAutoOnClick: true,
        pause: 5000,
        autoControls: false,
        pager: 'true' === $(this).attr('data-pager') ? true : false,
        controls: 'true' === $(this).attr('data-controls') ? true : false,
        speed: $(this).attr('data-speed'),
        captions: true,
        adaptiveHeight: 'true' === $(this).attr('data-adaptiveheight') ? true : false,
        touchEnabled: 'true' === $(this).attr('data-touchEnabled') ? true : false,
        autoHover: true,

        onSlideAfter: function (currentSlideNumber, totalSlideQty, currentSlideHtmlObject) {
          $('.nab-media-slider > .nab-media-slider-item').removeClass('active-slide ' + nabanimation);
          $('.nab-media-slider > .nab-media-slider-item').eq(currentSlideHtmlObject).addClass('active-slide ' + nabanimation);
        },
        onSliderLoad: function () {
          $('.nab-media-slider > .nab-media-slider-item').eq(0).addClass('active-slide ' + nabanimation);
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

  /* Set Cookie on Page Load */
  function createCookie(cookieName, cookieValue, daysToExpire) {
    let date = new Date();
    date.setTime(date.getTime() + (daysToExpire * 24 * 60 * 60 * 1000));
    document.cookie = cookieName + '=' + cookieValue + '; expires=' + date.toGMTString();
  }
  function accessCookie(cookieName) {
    let name = cookieName + '=';
    let allCookieArray = document.cookie.split(';');
    for (let i = 0; i < allCookieArray.length; i++) {
      let temp = allCookieArray[i].trim();
      if (0 == temp.indexOf(name))
        {return temp.substring(name.length, temp.length);}
    }
    return '';
  }
  function checkCookie() {
    let user = accessCookie('NABFirstVisit');
    if ('' != user)
    {
      $('.nab-interadv-block').hide().removeClass('nab_model_open');
    }
    else {
      user= 'nabuser';
      if ('' != user && null != user) {
        createCookie('NABFirstVisit', user, 2);
        $('.nab-interadv-block').show().addClass('nab_model_open');
      }
    }
  }

  /* Check Interstitial Ad & Set Cookies */
  if (0 < $('.nab-interadv-block').length) {
    checkCookie();
  }


  $(window).load(function () {

    /**
     * Startup Loft forms datepicker
     */
      if ( 0 < $('#startup-date-founded').length ) {
        $('#startup-date-founded').datepicker({
          changeMonth: true,
          changeYear: true,
          dateFormat: 'DD, MM d, yy',
          showOn: 'button',
          yearRange: '1900:2050'
        });
      }
  });

  if ( 0 < $('form.nab-form').length ) {
    $('form.nab-form').submit(function(event) {
      var recaptcha = $('#g-recaptcha-response').val();
      if ( '' === recaptcha) {
        event.preventDefault();
        $('.captcha-error').show();
      } else {
        $('.captcha-error').hide();
      }
    });

    $(document).on('change', '.nab-form.delegation-form #delegation-reg-info-attending-nabshow-as-well .form-radio', function(){
      if ( 'no' === $(this).val().toLowerCase() ) {
        $(this).parents('.panel-body').find('.hidden-field-items').show();
      } else {
        $(this).parents('.panel-body').find('.hidden-field-items').hide();
      }
    });

    $(document).on('click', '.startup-loft-form .form-actions .form-submit, .contact-us-form .form-actions .form-submit', function () {
        let validPattern = /\S/;
        $(' .nab-form textarea[required]').each(function () {
          if ( 0 < $(this).val().length && ! validPattern.test( $(this).val() ) ) {
            $(this).parents('.form-textarea-wrapper').find('.textarea-error').show();
            return false;
          } else {
            $(this).parents('.form-textarea-wrapper').find('.textarea-error').hide();
          }
        });

    });

    $(document).on('click', '.publication-form .form-actions .form-submit', function(){
        let formFlag = true;
        if ( 0 === $(this).parents('.publication-form').find('#publication-distribution-type :checkbox:checked').length ) {
          $(this).parents('.publication-form').find('#publication-distribution-type .checkbox-error').show();
          formFlag = false;
        }
        if ( 0 === $(this).parents('.publication-form').find('#publication-shipping-logistics :checkbox:checked').length ) {
          $(this).parents('.publication-form').find('#publication-shipping-logistics .checkbox-error').show();
          formFlag = false;
        }
        return formFlag;
    });
    $(document).on('change', '.publication-form #publication-distribution-type input.form-checkbox', function() {
      if ( 0 < $(this).parents('#publication-distribution-type').find(':checkbox:checked').length ) {
        $(this).parents('#publication-distribution-type').find('.checkbox-error').hide();
      }
    });
    $(document).on('change', '.publication-form #publication-shipping-logistics input.form-checkbox', function() {
      if ( 0 < $(this).parents('#publication-shipping-logistics').find(':checkbox:checked').length ) {
        $(this).parents('#publication-shipping-logistics').find('.checkbox-error').hide();
      }
    });

    $(document).on('click', '.special-event-form .form-actions .form-submit', function(){
      let formFlag = true;
      if ( 0 === $(this).parents('.special-event-form').find('#event-date :checkbox:checked').length ) {
        $(this).parents('.special-event-form').find('#event-date .checkbox-error').show();
        formFlag = false;
      }
      return formFlag;
    });
    $(document).on('change', '.special-event-form #event-date input.form-checkbox', function() {
      if ( 0 < $(this).parents('#event-date').find(':checkbox:checked').length ) {
        $(this).parents('#event-date').find('.checkbox-error').hide();
      }
    });
  }

  //google analytics event
  $(document).on('click', '.nab-banner-main .nab-banner-link, .wp-block-md-featured-boxes .nab-media-slider-link', function() {
    if ( '' !== $(this).data('category') && '' !== $(this).data('action') && '' !== $(this).data('label') ) {
      gtag('event', $(this).data('action'), {'event_category': $(this).data('category'), 'event_label': $(this).data('label') });
    }
  });

  //Header Marketo custom sign up box
  $(document).on('click', '.header-get-updates .get-updates-submit', function () {
    var inputEmail = $(this).parents('.header-get-updates').find('.get-updates-field').val();
    var emailExpression = /[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}/igm;
    if (emailExpression.test(inputEmail)) {
      $(this).parents('.header-get-updates').removeClass('sign-up-error');
      $('.mktoForm .mktoEmailField').val(inputEmail);
      $('.mktoForm .mktoButton').trigger('click');
    } else {
      $(this).parents('.header-get-updates').addClass('sign-up-error');
    }
  });

  // Slider popup
  $(document).on('click', '.detail-list-modal-popup, .modal-detail-list-modal-popup', function () {
    var postType = $(this).attr('data-posttype');
    var postId = $(this).attr('data-postid');
    var userId = $(this).attr('data-userid');
    var displayPlink = $(this).attr('data-plannerlink');
    if ($(this).hasClass('modal-detail-list-modal-popup')) {
      $(this).parents('.modal').modal('hide');
    }
    $('body').addClass('popup-loader');
    $('.modal .modal-body').load('/modal-popup?postid=' + postId + '&posttype=' + postType + '&userid=' + userId + '&plannerlink=' + displayPlink, function () {
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

  // Header Search & Get Updates js
  $('.super-menu-main .super-menu-icons li .fa-search').on('click', function () {
    $(this).closest('.header-right').toggleClass('active');
    $(this).closest('.header-right').removeClass('clicked');
    $(this).closest('.header-right').find('.get-updts').removeClass('clicked');
    $('.header-right .search-field').focus();
  });
  $('.super-menu-main .super-menu .get-updts').on('click', function () {
    $(this).toggleClass('clicked');
    $(this).closest('.header-right').removeClass('active');
    $(this).closest('.header-right').toggleClass('clicked');
    $('.header-right .get-updates-field').focus();
    return false;
  });
  $('.header-get-updates .remove').on('click', function () {
    $('.super-menu-main .super-menu .get-updts').removeClass('clicked');
    $('header .header-right').removeClass('clicked');
    return false;
  });

  // Award Section Popup Js
  $('.nab_popup_btn').on('click', function () {
    $(this).siblings('.nab_model_main').addClass('nab_model_open');
    $(this).closest('.slideInUp').removeClass('slideInUp');
  });
  $('.nab_close_btn, .nab_bg_overlay').on('click touch', function () {
    $('.nab_model_main').removeClass('nab_model_open');
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

  // related-content-custom-item
  if (0 < $('.related-content-custom-box').length) {
    $(window).resize(function () {
      $('.related-content-custom-box .related-content-custom-item .wp-block-nab-multipurpose-gutenberg-block').css('height', $('.related-content-custom-box .related-content-rowbox>.col-lg-4:nth-last-child(2)').height() - 20);
    });
    $('.related-content-custom-box .related-content-custom-item .wp-block-nab-multipurpose-gutenberg-block').css('height', $('.related-content-custom-box .related-content-rowbox>.col-lg-4:nth-last-child(2)').height() - 20);
  }

  // faq select js

  // banner-navigation
  $('ul.banner-navigation li')
    .find('a')
    .click(function (e) {
      e.preventDefault();
      let section = $(this).attr('href');
      $('html, body').animate({
        scrollTop: $(section).offset().top - 100
      });
    });

  // banner-navigation

  if (0 < $('#card_section').length) {
    window.onload = window.onresize = masonryGrids;
  }

  if (0 < $('.news-conference-schedule .box-main').length) {
    window.onload = window.onresize = conferenceMasonryGrids;
  }
  if (0 < $('.birds-of-a-feather .box-main').length) {
    window.onload = window.onresize = CustomMasonryGrids;
  }

  $(document).on('change', '.plan-your-show-drp', function () {
    if ('' !== $(this).val()) {
      window.location.assign($(this).val());
    }
  });

  $(document).on('click', '.slider-card-filter .filter-list li', function () {
    var cardsDiv, cloneCardsDiv, innerH2Tag, innerImgTag, innerCategory, dataObj, innerATag,
      ajaxAction = 'nabshow_ntb_missed_load_more_category_click',
      _this = $(this),
      itemToFetch = $(this).parents('.slider-arrow-main').find('.ntbm-parent').attr('data-item');

    if ( $(this).parents('.slider-arrow-main').find('.ntbm-parent').hasClass('nab-not-to-be-missed-slider') ) {
      $(this).parents('.slider-arrow-main').find('.nab-not-to-be-missed-slider').addClass('change-slide');
    }

    $(this).parents('.slider-arrow-main').find('.loader-container').show();
    $(this).parents('.slider-arrow-main').find('.ntbm-parent .cards').addClass('slideInUp');

    jQuery.ajax({
      type: 'GET',
      data: 'action=' + ajaxAction + '&fetch_item=' + itemToFetch + '&portfolio_category_term_slug=' + $(this).attr('data-term-slug') + '&term_data_nonce=' + nabshowNtbMissed.nabshow_lv_ntb_missed_nonce,
      url: nabshowNtbMissed.ajax_url,
      success: function (getData) {
        dataObj = jQuery.parseJSON(getData);

        if ( _this.parents('.slider-arrow-main').find('.ntbm-parent').hasClass('nab-not-to-be-missed-slider') ) {
          _this.parents('.slider-arrow-main').find('.ntbm-parent .cards').removeClass('bx-clone');
        }

        let currentFirstItem = _this.parents('.slider-arrow-main').find('.ntbm-parent .cards')[0];

        jQuery.each(dataObj.result_post, function (key, value) {
          if (value.post_thumbnail) {

            cloneCardsDiv = currentFirstItem.cloneNode(true);

            innerATag = cloneCardsDiv.querySelector('a');
            innerATag.setAttribute('href', value.post_permalink);

            innerH2Tag = cloneCardsDiv.querySelector('h2');
            innerH2Tag.innerText = value.post_title;

            innerImgTag = cloneCardsDiv.querySelector('img');
            innerImgTag.setAttribute('src', value.post_thumbnail);

            innerCategory = cloneCardsDiv.querySelector('span');
            innerCategory.innerText = value.post_category;

            let sliderElement = document.getElementById(
              _this.parents('.slider-arrow-main').find('.ntbm-parent').attr('id')
            );

            if (0 === key) {
              _this.parents('.slider-arrow-main').find('.ntbm-parent').empty();
            }

            sliderElement.appendChild(cloneCardsDiv);
          }
        });

        if ( _this.parents('.slider-arrow-main').find('.ntbm-parent').hasClass('nab-not-to-be-missed-slider') ) {
          $('.nab-not-to-be-missed-slider').each(function (index) {
            if ($(this).hasClass('change-slide') && undefined !== ntbmBxSliderObj[index] ) {
              let numberOfVisibleSlides = bxNumberofVisibleSlide();
              let config = bxDynamicSliderConfig($(this), numberOfVisibleSlides);
              ntbmBxSliderObj[index].reloadSlider(config);
              $(this).removeClass('change-slide');
            }
          });
        }
        _this.parents('.slider-arrow-main').find('.loader-container').hide();
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
        if (4 < $(this).children().length) {
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
        } else {
          $(this).addClass('less-items');
        }

      });
    }

    if (0 < $('.nab-not-to-be-missed-slider').length) {
      $('.nab-not-to-be-missed-slider').each(function (index) {
        if (4 < $(this).children().length) {
          let config = bxDynamicSliderConfig($(this), numberOfVisibleSlides);

          if (
            0 < ntbmBxSliderObj.length &&
            undefined !== ntbmBxSliderObj[index]
          ) {
            ntbmBxSliderObj[index].reloadSlider(config);
          } else {
            ntbmBxSliderObj[index] = $(this).bxSlider(config);
          }
        }
      });
    }
  }

  // nab-photos
  if (0 < $('.nab-photos').length) {
    $(document).on('click', '.nab-photos .popup-btn', function () {
      var imgWidth = jQuery(this).parent().parent().find('.media').attr('width');
      let imgCaption = jQuery(this).parents('.photo-item').find('.photo-caption p.caption').text();
      jQuery('.nab-photos .photos-popup .photos-popup-img').attr('src', jQuery(this).parents('.hover-items').find('a.download').attr('href'));
      jQuery('.nab-photos .photos-dialog').css('width', 1370 > imgWidth ? imgWidth : '70vw');
      jQuery('.nab-photos .photos-popup .popup-photo-cation').text(imgCaption);
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

    $(document).on('click', '.nab-photos .photos-load-more .load-more-btn', function () {
      let totalItems = $('.nab-photos .photo-item').size();
      let itemToLoad = parseInt( $(this).data('item') );
      let displayItems = $('.nab-photos .photo-item:visible').length;
      itemToLoad = ( displayItems + itemToLoad <= totalItems ) ? displayItems + itemToLoad : totalItems;
      $('.nab-photos .photo-item').removeClass('slideInUp');
      $('.nab-photos .photo-item').addClass('slideInUp');
      $('.nab-photos .photo-item:lt(' + itemToLoad + ')').removeClass('hide-item');
      if ( 0 === $('.nab-photos .photo-item.hide-item').length ) {
        $(this).hide();
      }
    });

  }

  // Opportunity Image Popup
  if (0 < $('.opportunities .box-main').length) {
    $(document).on('click', '.opportunities .media-img', function () {
      var imgWidth = jQuery(this).parent().find('.img').attr('width');
      jQuery('.opportunities .opportunities-popup .opportunities-popup-img').attr('src', jQuery(this).parent().find('.img').attr('src'));
      jQuery('.opportunities .opportunities-dialog').css('width', 1370 > imgWidth ? imgWidth : '70vw');
      jQuery('.opportunities .opportunities-popup').show();
      jQuery('body').addClass('overflow-hidden');
      jQuery('.opportunities .opportunities-backdrop').show();
    });

    $(document).on('click', '.opportunities .close, .opportunities .opportunities-backdrop', function () {
      jQuery('.opportunities .opportunities-popup').hide();
      jQuery('.opportunities .opportunities-backdrop').hide();
      jQuery('body').removeClass('overflow-hidden');
    });
  }

  // nab-videos
  if (0 < $('.nab-videos').length) {
    $(document).on('click', '.nab-videos .video-popup-btn', function () {
      jQuery('.nab-videos .videos-popup .videos-popup-iframe').attr('src', jQuery(this).parent().parent().find('.media').attr('data-video-src'));
      jQuery('.nab-videos .videos-popup').show();
      jQuery('body').addClass('overflow-hidden');
      jQuery('.nab-videos .videos-backdrop').show();
    });

    $(document).on('click', '.nab-videos .close, .nab-videos .videos-backdrop', function () {
      jQuery('.nab-videos .videos-popup').hide();
      jQuery('.nab-videos .videos-backdrop').hide();
      jQuery('body').removeClass('overflow-hidden');
    });

  }


  /**
   * Remove Extra Space from filter
   */
  if (0 < $('.box-main-filter').length) {
    let emptyP = $('.box-main-filter p:contains(\u00a0)');
    emptyP.hide();
  }

  /**
   * Filter - Related content details js box-main
   */
  if (0 < $('.box-main-filter, .schedule-glance-filter, .main-filter, .meet-team-select').length) {
    if (0 < $('.box-main .box-item').length || 0 < $('.accordionParentWrapper').length || 0 < $('.schedule-glance-filter').length  || 0 < $('.team-main .team-box').length || 0 < $('.products-winners').length || 0 < $('.news-conference-schedule').length || 0 < $('.opportunities').length || 0 < $('.related-content-rowbox').length || 0 < $('.birds-of-a-feather').length) {

      $('.new-this-year-block .box-main .box-item').each(function () {
        if ('' !== $(this).find('.title').html()) {
          insertOptions($(this).find('.title').html(), 'box-main-category-newyr');
        }
      });

      $('.official-vendors .box-main .box-item').each(function () {
        if ('' !== $(this).find('.title').html()) {
          insertOptions($(this).find('.title').html(), 'box-main-category-offven');
        }
        if ('' !== $(this).find('.companyName').html()) {
          insertOptions($(this).find('.companyName').html(), 'box-main-category-vendor');
        }
      });

      $('.exhibitor-committee .box-main .box-item').each(function () {
        if ('' !== $(this).find('.boothSize').html()) {
          insertOptions($(this).find('.boothSize').html(), 'box-main-category-booth');
        }
        if ('' !== $(this).find('.areas').html()) {
          insertOptions($(this).find('.areas').html(), 'box-main-category');
        }
      });

      $('.delegation .box-main .box-item').each(function () {
        if ('' !== $(this).find('.country').html().split(',')) {
          $.map(
            $(this).find('.country').html().split(','),
            function (val, i) {
              insertOptions(val.trim(), 'box-main-category-delegation');
            }
          );
        }
      });

      if (0 < $('.fab-filter').length) {
        $('.accordionParentWrapper').each(function () {
          if ('' !== $(this).find('.title').html()) {
            insertOptions($(this).find('.title').html(), 'faq-category-drp');
          }
        });
      }
      $('.awards-main').each(function () {
        insertOptions($(this).find('.awards-winner-title').text(), 'award-name');
      });

      $('.schedule-main').each(function () {
        if ($('.schedule-glance-filter #date').length){
          insertOptions($(this).find('h2').text(), 'date');
        }

        $(this).find('.schedule-row').each(function () {
          if ($('.schedule-glance-filter #time').length) {
            insertOptions($(this).find('.time p').text(), 'time');
          }
          if ($('.schedule-glance-filter #pass-type').length) {
            insertOptions($(this).find('.details p').text(), 'pass-type');
          }
          if ($('.schedule-glance-filter #location').length) {
            insertOptions($(this).find('.location p').text(), 'location');
          }
          if ($('.schedule-glance-filter #type').length) {
            insertOptions($(this).attr('data-type'), 'type');
          }
        });
      });

      $('.meet-team-main.team-main  .team-box').each(function () {
        if (null !== $(this).data('category').split(',')) {
          $.map(
            $(this).data('category').split(','),
            function (val, i) {
              insertCheckbox(val.trim(), 'team-checkbox');
            }
          );
        }
        if ('' !== $(this).attr('data-department')) {
          insertOptions($(this).attr('data-department'), 'team-department');
        }
      });

      $('.products-winners').each(function () {
        if ('' !== $(this).find('.product-title').html()) {
          insertOptions($(this).find('.product-title').html(), 'products-category');
        }
      });

      $('.news-conference-schedule .box-main .box-item').each(function () {
        if ('' !== $(this).find('.title').html()) {
          insertOptions($(this).find('.title').text(), 'company-name');
        }

        if ('' !== $(this).find('.location').html()) {
          insertOptions($(this).find('.location').text(), 'location-filter');
        }

        if ('' !== $(this).find('.date-time').html()) {
          insertOptions($(this).find('.date-time').text().split('|')[0], 'date-filter');
        }
      });

      $('.birds-of-a-feather .box-main .box-item').each(function () {
        if ('' !== $(this).find('.attend').html().split(',')) {
          $.map(
            $(this).find('.attend').text().split(','),
            function (val, i) {
              insertOptions(val.trim(), 'attend-filter');
            }
          );
        }
        if ('' !== $(this).find('.hosting').html().split(',')) {
          $.map(
            $(this).find('.hosting').text().split(','),
            function (val, i) {
              insertOptions(val.trim(), 'hosting-filter');
            }
          );
        }
        if ('' !== $(this).find('.organizer').html().split(',')) {
          $.map(
            $(this).find('.organizer').text().split(','),
            function (val, i) {
              insertOptions(val.trim(), 'organizer-filter');
            }
          );
        }
        if ('' !== $(this).find('.date-time').html()) {
          insertOptions($(this).find('.date-time').text().split('|')[0], 'birdDate-filter');
        }
      });


      $('.sponsorship-opportunities-page .related-main-wrapper').each(function () {
        if ('' !== $(this).find('.parent-main-title').html()) {
          insertOptions($(this).find('.parent-main-title').text(), 'main-category-type');
        }
      });
      $('.opportunities').each(function () {
        if ('' !== $(this).find('.main-title').html()) {
          insertOptions($(this).find('.main-title').text(), 'sub-category-type');
        }
        $('.opportunities .box-main .box-item').each(function () {
          if ('' !== $(this).find('.cost').html()) {
            insertOptions($(this).find('.cost').text(), 'price-range');
          }
          if ('' !== $(this).find('.exclusivity').html()) {
            insertOptions($(this).find('.exclusivity').text(), 'exclusivity');
          }
        });
      });


      let selectedItem, searchId, searchKeyword, selectedLetter;

      $(document).on('change', '#box-main-category, #box-main-category-booth, #box-main-category-vendor, #sub-category-type, #price-range, #exclusivity, #availability,  #box-main-category-delegation, #box-main-category-newyr, #box-main-category-offven', function () {
        if (0 < $('.exhibitor-committee .box-main, .badge-discounts .box-main, .new-this-year-block .box-main, .official-vendors .box-main, .delegation .box-main, .opportunities .box-main').length) {
          selectedItem = '.box-item';
        }
      });
      $(document).on('change', '#faq-category-drp', function () {
        if (0 < $('.accordionParentWrapper').length) {
          selectedItem = '.accordionParentWrapper';
        }
      });
      $(document).on('change', '#award-name', function () {
        if (0 < $('.awards-main').length) {
          selectedItem = '.awards-main';
        }
      });
      $(document).on('change', '.schedule-glance-filter .schedule-select #date, .schedule-glance-filter .schedule-select #pass-type, .schedule-glance-filter .schedule-select #location, .schedule-glance-filter .schedule-select #time, .schedule-glance-filter .schedule-select #type', function () {
        if (0 < $('.schedule-main').length) {
          selectedItem = '.schedule-main';
        }
      });
      $(document).on('change', '#topic-type, #format-type, #location-type, .meet-team-select #team-department, .meet-team-select .checkbox-list input', function () {
        if (0 < $('.team-main').length) {
          selectedItem = '.team-box';
        }
      });
      $(document).on('change', '#products-category', function () {
        if (0 < $('.products-winners').length) {
          selectedItem = '.product-title';
        }
      });

      if (0 < $('.box-main, #box-main-search').length) {
        searchKeyword = '.title';
        searchId = '#box-main-search';
      }

      $(document).on('change', ' #company-name, #date-filter, #location-filter, #attend-filter, #hosting-filter, #organizer-filter, #birdDate-filter', function () {
        if (0 < $('.news-conference-schedule, .birds-of-a-feather').length) {
          selectedItem = '.box-item';
          searchKeyword = '.title';
        }
      });
      if (0 < $('.rc-page-block, .related-content-rowbox').length) {
        selectedItem = '.col-lg-4.col-md-6';
        searchKeyword = '.title';
      }

      $(document).on('click', '.products-winners-filter ul.alphabets-list li', function () {
        selectedLetter = $(this).html();
        selectedItem = '.subtitle';
        masterFilterFunc(selectedItem, searchId, searchKeyword, selectedLetter);
      });
      $(document).on('change', '#box-main-category, #box-main-category-booth, #box-main-category-vendor, #faq-category-drp, #award-name, .schedule-glance-filter .schedule-select #date, .schedule-glance-filter .schedule-select #pass-type, .schedule-glance-filter .schedule-select #time, .schedule-glance-filter .schedule-select #location, .schedule-glance-filter .schedule-select #type, .meet-team-select #team-department, .meet-team-select .checkbox-list input, #products-category, #company-name, #date-filter, #location-filter, #main-category-type, #sub-category-type, #price-range, #exclusivity, #availability, #topic-type, #format-type, #location-type, #attend-filter, #hosting-filter, #organizer-filter, #birdDate-filter, #box-main-category-delegation, #box-main-category-newyr, #box-main-category-offven, .new-this-year-filter .checkbox-list input', function () {
        masterFilterFunc(selectedItem, searchId, searchKeyword, selectedLetter);
      });
      $(document).on('keyup', '#box-main-search, #box-main-search-bd', function () {
        if (0 < $('.box-main, #box-main-search').length) {
          searchKeyword = '.title';
          searchId = '#box-main-search';
        }
        if (0 < $('.exhibitor-committee .box-main, .badge-discounts .box-main, .new-this-year-block .box-main, .official-vendors .box-main, .delegation .box-main, .opportunities .box-main, .news-conference-schedule, .birds-of-a-feather').length) {
          selectedItem = '.box-item';
        }
        if (0 < $('.accordionParentWrapper').length && 0 < $('.fab-filter').length) {
          selectedItem = '.accordionParentWrapper';
        }
        if (0 < $('.awards-main').length) {
          selectedItem = '.wp-block-nab-awards-item';
        }
        if (0 < $('.schedule-main').length) {
          selectedItem = '.schedule-main';
        }
        if (0 < $('.team-main').length) {
          selectedItem = '.team-box';
        }
        if (0 < $('.products-winners').length) {
          selectedItem = '.product-title';
        }
        if (0 < $('.rc-page-block').length) {
          selectedItem = '.rc-page-block .col-lg-4.col-md-6';
          searchKeyword = '.title';
        }
        masterFilterFunc(selectedItem, searchId, searchKeyword, selectedLetter);
      });

      $('.badge-discounts').each(function () {
        if ('' !== $(this).find('.badge-title').html()) {
          insertList($(this).find('.badge-title').text(), 'box-main-listing');
        }
      });

      $('.exhibitor-resources-page .related-main-wrapper').each(function () {
        if ('' !== $(this).find('.parent-main-title').html()) {
          insertList($(this).find('.parent-main-title').text(), 'box-main-listing');
        }
      });

      if (0 < jQuery('.badgeslist a').length) {
        $('.badgeslist a').each(function () {
          let $this = $(this);
          $($this).on('click', function () {
            if ($this.hasClass('clicked')) {
              $this.removeClass('clicked');
              $('.badgeslist a').removeClass('active');
              $('.no-data').hide();

              $('.box-main .box-item').addClass('slideInUp').show();
              $('.badge-discounts, .badge-discounts .badge-title').show();
              $('.related-main-wrapper, .parent-main-title').show();

              if (0 < $('.exhibitor-committee .box-main').length) {
                selectedItem = '.box-item';
              }

              masterFilterFunc(selectedItem, searchId, searchKeyword);

            }
            else {
              $('.badgeslist a').removeClass('active');
              $('.badgeslist a').removeClass('clicked');

              $this.addClass('clicked');
              $(this).addClass('active');

              selectedItem = '.official-vendors .box-item';

              masterFilterFunc(selectedItem, searchId, searchKeyword);

            }
          });
        });

      }

      /* Location Redirection */
      let args = location.search;
      if (0 < args.length){
        let res = args.split('=');
        let str = res[1].split('-').join(' ');
        Array.from($('.badgeslist a')).forEach(function (item) {
          if (str.toLowerCase() === item.text.toLowerCase()) {
            $(item).addClass('clicked active');
            masterFilterFunc(selectedItem, searchId, searchKeyword);
          }
        });
      }

      /* Sponsorship Opp */
      if ($('.opportunities .box-main .box-item').has('span.sold')) {
        $(' .opportunities .box-main .box-item span.sold').each(function () {
          $(this).parents('.opportunities .box-main .box-item').addClass('visible');
        });
      }

      /* -- Media partner filter -- */
      $('.media-partner-filter .featured-btn').click(function () {
        $(this).toggleClass('active');
        $('.media-partners .team-box').removeClass('slideInUp').hide();
        if ($(this).hasClass('active')) {
          $('.media-partners .team-box.featured').addClass('slideInUp').show();
        }
        masterFilterFunc(selectedItem, searchId, searchKeyword, selectedLetter);
      });

      // Add Data in Dropdowns
      $('.media-partners .team-box').each(function () {
        if (null !== $(this).data('topics').split(',')) {
          $.map($(this).data('topics').split(','), function (val) {
            insertOptions(val, 'topic-type');
          });
        }
        if (null !== $(this).data('formats').split(',')) {
          $.map($(this).data('formats').split(','), function (val) {
            insertOptions(val, 'format-type');
          });
        }
        if (null !== $(this).data('locations').split(',')) {
          $.map($(this).data('locations').split(','), function (val) {
            insertOptions(val, 'location-type');
          });
        }
      });

      // Test

      $('.news-conference .category .select-opt').each(function () {
        $(document).on('change', '.news-conference .category .select-opt', function () {
          if ($('.news-conference-schedule .no-data').is(':visible')) {
            $('.news-conference-schedule .no-data').parent('.box-main').addClass('noDataFound');
          } else {
            $('.news-conference-schedule .no-data').parent('.box-main').removeClass('noDataFound');
          }
        });
      });
      $(document).on('keyup', '.news-conference #box-main-search', function () {
        if ($('.news-conference-schedule .no-data').is(':visible')) {
          $('.news-conference-schedule .no-data').parent('.box-main').addClass('noDataFound');
        } else {
          $('.news-conference-schedule .no-data').parent('.box-main').removeClass('noDataFound');
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

    let allImgList = document.querySelectorAll('.nab-not-to-be-missed-slider .item img');

    let allImgs = [],
      length = allImgList.length;

    for (let i = 0; i < length; i++) {
      allImgs.push(allImgList[i]);
    }

    for (let i = 0; i < allImgs.length; i++) {
      let imgWidth = allImgs[i].parentNode;
      imgWidth.style.backgroundImage = 'url('+ allImgs[i].attributes.src.nodeValue +')';
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
      mode: 'horizontal',
      touchEnabled: false
    };
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

  $(document).on('click', '.category-listing-main .accordion-list .category-head', function () {
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
  if (0 < $('.browse-sessions-filter').length || 0 < $('.browse-open-to-all-filter').length) {
    let pageNumber,
      postStartWith = '',
      sessionDate = '',
      sessionLocation = '',
      sessionTrack = 0 === $('.browse-sessions-filter .browse-select #session-tracks')[0].selectedIndex ? '' : $('.browse-sessions-filter .browse-select #session-tracks').val(),
      featuredSession = $('.browse-sessions-filter .featured-btn').hasClass('active') ? 'featured' : '',
      sessionItem = $('#browse-session .item')[0],
      listingType = 0 < $('#browse-session .listing-date-group').length ? $('#browse-session .listing-date-group:first').attr('data-listing-type') : '';


    $(document).on('change', '.browse-sessions-filter #session-tracks', function () {
      let currentTrack = 0 === $(this)[0].selectedIndex ? '' : $(this).val();
      if (sessionTrack !== currentTrack) {
        pageNumber = 1;
        sessionTrack = currentTrack;
        nabAjaxForBrowseSession(sessionItem, 'browse-filter', pageNumber, postStartWith, sessionTrack, sessionLocation, listingType, sessionDate, featuredSession);
      }
    });

    $(document).on('change', '.browse-sessions-filter #session-location', function () {
      let currentLocation = 0 === $(this)[0].selectedIndex ? '' : $(this).val();
      if (sessionLocation !== currentLocation) {
        pageNumber = 1;
        sessionLocation = currentLocation;
        nabAjaxForBrowseSession(sessionItem, 'browse-filter', pageNumber, postStartWith, sessionTrack, sessionLocation, listingType, sessionDate, featuredSession);
      }
    });

    $(document).on('keypress', '.browse-sessions-filter .search-item .search, .browse-open-to-all-filter .search-item .search', function (e) {
      if (13 === e.which) {
        pageNumber = 1;
        nabAjaxForBrowseSession(sessionItem, 'browse-filter', pageNumber, postStartWith, sessionTrack, sessionLocation, listingType, sessionDate, featuredSession);
      }
    });

    $(document).on('click', '#load-more-sessions a', function () {
      pageNumber = parseInt($(this).attr('data-page-number'));
      nabAjaxForBrowseSession(sessionItem, 'load-more', pageNumber, postStartWith, sessionTrack, sessionLocation, listingType, sessionDate, featuredSession);
    });

    $(document).on('click', '.browse-sessions-filter .featured-btn', function () {
      $(this).toggleClass('active');
      featuredSession = $(this).hasClass('active') ? 'featured' : '';
      pageNumber = 1;
      nabAjaxForBrowseSession(sessionItem, 'browse-filter', pageNumber, postStartWith, sessionTrack, sessionLocation, listingType, sessionDate, featuredSession);
    });

    $(document).on('click', '.browse-sessions-filter .alphabets-list li:not(".clear")', function () {

      $(this).addClass('active').siblings().removeClass('active');
      if (0 < $(this).parent().find('li.active').length) {
        $(this).siblings('.clear').show();
      }

      if (postStartWith !== $(this).text()) {
        postStartWith = $(this).text();
        pageNumber = 1;
        nabAjaxForBrowseSession(sessionItem, 'browse-filter', pageNumber, postStartWith, sessionTrack, sessionLocation, listingType, sessionDate, featuredSession);
      }
    });

    $(document).on('click', '.browse-sessions-filter .alphabets-list li.clear', function () {
      $(this).hide().siblings().removeClass('active');
      postStartWith = '';
      pageNumber = 1;
      nabAjaxForBrowseSession(sessionItem, 'browse-filter', pageNumber, postStartWith, sessionTrack, sessionLocation, listingType, sessionDate, featuredSession);
    });
    if (0 < $('.browse-sessions-filter #session-date').length || 0 < $('.browse-open-to-all-filter #session-date').length) {
      $(window).load(function () {
        $('.browse-sessions-filter #session-date, .browse-open-to-all-filter #session-date').datepicker({ dateFormat: 'DD, MM d, yy' }).on('change', function () {
          pageNumber = 1;
          sessionDate = $(this).val();
          nabAjaxForBrowseSession(sessionItem, 'browse-filter', pageNumber, postStartWith, sessionTrack, sessionLocation, listingType, sessionDate, featuredSession);
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
      exhibitorHall = '',
      exhibitorPavilion = 0 === $('.browse-exhibitors-filter .browse-select #exhibitor-pavilion')[0].selectedIndex ? '' : $('.browse-exhibitors-filter .browse-select #exhibitor-pavilion').val(),
      exhibitorCategory = 0 === $('.browse-exhibitors-filter .browse-select #exhibitor-category')[0].selectedIndex ? '' : $('.browse-exhibitors-filter .browse-select #exhibitor-category').val();

    $(document).on('change', '.browse-exhibitors-filter .browse-select #exhibitor-category', function () {
      let currentCategory = 0 === $(this)[0].selectedIndex ? '' : $(this).val();
      if (exhibitorCategory !== currentCategory) {
        exhibitorPageNumber = 1;
        exhibitorCategory = currentCategory;
        nabAjaxForBrowseExhibitors(false, exhibitorPageNumber, exhibitorStartWith, exhibitorCategory, exhibitorHall, exhibitorPavilion);
      }
    });

    $(document).on('change', '.browse-exhibitors-filter .browse-select #exhibitor-hall', function () {
      let currentHall = 0 === $(this)[0].selectedIndex ? '' : $(this).val();
      if (exhibitorHall !== currentHall) {
        exhibitorPageNumber = 1;
        exhibitorHall = currentHall;
        nabAjaxForBrowseExhibitors(false, exhibitorPageNumber, exhibitorStartWith, exhibitorCategory, exhibitorHall, exhibitorPavilion);
      }
    });

    $(document).on('change', '.browse-exhibitors-filter .browse-select #exhibitor-pavilion', function () {
      let currentPavilion = 0 === $(this)[0].selectedIndex ? '' : $(this).val();
      if (exhibitorPavilion !== currentPavilion) {
        exhibitorPageNumber = 1;
        exhibitorPavilion = currentPavilion;
        nabAjaxForBrowseExhibitors(false, exhibitorPageNumber, exhibitorStartWith, exhibitorCategory, exhibitorHall, exhibitorPavilion);
      }
    });

    $(document).on('keypress', '.browse-exhibitors-filter .search-item .search', function (e) {
      if (13 === e.which) {
        exhibitorPageNumber = 1;
        nabAjaxForBrowseExhibitors(false, exhibitorPageNumber, exhibitorStartWith, exhibitorCategory, exhibitorHall, exhibitorPavilion);
      }
    });

    $(document).on('click', '#load-more-exhibitor a', function () {
      exhibitorPageNumber = parseInt($(this).attr('data-page-number'));
      nabAjaxForBrowseExhibitors(true, exhibitorPageNumber, exhibitorStartWith, exhibitorCategory, exhibitorHall, exhibitorPavilion);
    });

    $(document).on('click', '.browse-exhibitors-filter .featured-btn', function () {
      $(this).toggleClass('active');
      exhibitorPageNumber = 1;
      nabAjaxForBrowseExhibitors(false, exhibitorPageNumber, exhibitorStartWith, exhibitorCategory, exhibitorHall, exhibitorPavilion);
    });

    $(document).on('click', '.browse-exhibitors-filter .alphabets-list li:not(".clear")', function () {

      $(this).addClass('active').siblings().removeClass('active');
      if (0 < $(this).parent().find('li.active').length) {
        $(this).siblings('.clear').show();
      }

      if (exhibitorStartWith !== $(this).text()) {
        exhibitorStartWith = $(this).text();
        exhibitorPageNumber = 1;
        nabAjaxForBrowseExhibitors(false, exhibitorPageNumber, exhibitorStartWith, exhibitorCategory, exhibitorHall, exhibitorPavilion);
      }
    });

    $(document).on('click', '.browse-exhibitors-filter .alphabets-list li.clear', function () {
      $(this).hide().siblings().removeClass('active');
      exhibitorStartWith = '';
      exhibitorPageNumber = 1;
      nabAjaxForBrowseExhibitors(false, exhibitorPageNumber, exhibitorStartWith, exhibitorCategory, exhibitorHall, exhibitorPavilion);
    });

    $(document).on('change', '.browse-exhibitors-filter .exhibitor-keywords', function () {
      exhibitorPageNumber = 1;
      nabAjaxForBrowseExhibitors(false, exhibitorPageNumber, exhibitorStartWith, exhibitorCategory, exhibitorHall, exhibitorPavilion);
    });

    $(document).on('click', '.browse-exhibitors-filter .orderby', function () {
      $(this).toggleClass('active');
      exhibitorPageNumber = 1;
      nabAjaxForBrowseExhibitors(false, exhibitorPageNumber, exhibitorStartWith, exhibitorCategory, exhibitorHall, exhibitorPavilion);
    });

  }

  /**
   *  Speaker browse filter data
   */
  if (0 < $('.browse-speakers-filter').length) {
    let speakerPageNumber,
      speakerStartWith = '',
      speakerCompany = '',
      speakerDate = '',
      featuredSpeaker = 0 < $('.browse-speakers-filter .featured-btn').hasClass('active') ? 'featured' : '';

    $(document).on('change', '.browse-speakers-filter #speaker-company', function () {
      let currentCompany = 0 === $(this)[0].selectedIndex ? '' : $(this).val();
      if (speakerCompany !== currentCompany) {
        speakerPageNumber = 1;
        speakerCompany = currentCompany;
        nabAjaxForBrowseSpeakers(false, speakerPageNumber, speakerStartWith, speakerCompany, featuredSpeaker, speakerDate);
      }
    });

    $(document).on('change', '.browse-speakers-filter #speaker_date', function () {
      let currentDate = 0 === $(this)[0].selectedIndex ? '' : $(this).val();
      if (speakerDate !== currentDate) {
        speakerPageNumber = 1;
        speakerDate = currentDate;
        nabAjaxForBrowseSpeakers(false, speakerPageNumber, speakerStartWith, speakerCompany, featuredSpeaker, speakerDate);
      }
    });

    $(document).on('keypress', '.browse-speakers-filter .search-item .search', function (e) {
      if (13 === e.which) {
        speakerPageNumber = 1;
        nabAjaxForBrowseSpeakers(false, speakerPageNumber, speakerStartWith, speakerCompany, featuredSpeaker, speakerDate);
      }
    });

    $(document).on('keypress', '.browse-speakers-filter .speaker-title-search', function (e) {
      if (13 === e.which) {
        speakerPageNumber = 1;
        nabAjaxForBrowseSpeakers(false, speakerPageNumber, speakerStartWith, speakerCompany, featuredSpeaker, speakerDate);
      }
    });

    $(document).on('click', '#load-more-speaker a', function () {
      speakerPageNumber = parseInt($(this).attr('data-page-number'));
      nabAjaxForBrowseSpeakers(true, speakerPageNumber, speakerStartWith, speakerCompany, featuredSpeaker, speakerDate);
    });

    $(document).on('click', '.browse-speakers-filter .featured-btn', function () {
      $(this).toggleClass('active');
      speakerPageNumber = 1;
      featuredSpeaker = $(this).hasClass('active') ? 'featured' : '';
      nabAjaxForBrowseSpeakers(false, speakerPageNumber, speakerStartWith, speakerCompany, featuredSpeaker, speakerDate);
    });

    $(document).on('click', '.browse-speakers-filter .alphabets-list li:not(".clear")', function () {

      $(this).addClass('active').siblings().removeClass('active');
      if (0 < $(this).parent().find('li.active').length) {
        $(this).siblings('.clear').show();
      }

      if (speakerStartWith !== $(this).text()) {
        speakerStartWith = $(this).text();
        speakerPageNumber = 1;
        nabAjaxForBrowseSpeakers(false, speakerPageNumber, speakerStartWith, speakerCompany, featuredSpeaker, speakerDate);
      }
    });

    $(document).on('click', '.browse-speakers-filter .alphabets-list li.clear', function () {
      $(this).hide().siblings().removeClass('active');
      speakerStartWith = '';
      speakerPageNumber = 1;
      nabAjaxForBrowseSpeakers(false, speakerPageNumber, speakerStartWith, speakerCompany, featuredSpeaker, speakerDate);
    });

    $(document).on('click', '.browse-speakers-filter .orderby', function () {
      $(this).toggleClass('active');
      speakerPageNumber = 1;
      nabAjaxForBrowseSpeakers(false, speakerPageNumber, speakerStartWith, speakerCompany, featuredSpeaker, speakerDate);
    });

  }

  /**
   * Destination or happenings page search
   */

  if (0 < $('.browse-destinations-filter').length || 0 < $('.browse-happenings-filter').length || 0 < $('.browse-learn-filter').length) {
    let pageLocation = '',
      pageType = '',
      newThisYear = '',
      pageSearchTitle = '',
      sortByDate = true,
      featuredPage = false,
      pageStartWith = '';

    if (0 < $('.featured-btn').length) {
      $('#related-content-list .col-lg-4.col-md-6[data-featured="featured"]').addClass('featured');
      if ($('.browse-destinations-filter .featured-btn').hasClass('active')) {
        featuredPage = true;
        nabFilterDestinationPagesHandler(pageLocation, pageType, newThisYear, pageStartWith, pageSearchTitle, featuredPage);
      }
    }

    $('#related-content-list .col-lg-4.col-md-6').each(function () {
      if (null !== $(this).data('hall').split(',')) {
        $.map($(this).data('hall').split(','), function (val) {
          insertOptions(val, 'page-location');
        });
      }
      if (null !== $(this).data('type').split(',')) {
        $.map($(this).data('type').split(','), function (val) {
          insertOptions(val, 'page-type');
        });
      }
      if ('' !== $(this).data('open') && 'select' !== $(this).data('open').toLowerCase() && ( 0 < $('.browse-learn-filter #open-to').length || 0 < $('.browse-destinations-filter #open-to').length ) ) {
        insertOptions($(this).data('open'), 'open-to');
      }
      if ('' !== $(this).find('.info-block .date_group').text() && 0 < $('.browse-learn-filter #page-date').length) {
        let cardDates = $(this).find('.info-block .date_group').text();
        let dateGroup = cardDates.split(' | ');
        if ( 0 < dateGroup.length ) {
          dateGroup.map(function (item) {
            return insertOptions(item, 'page-date');
          });
        }
      }
    });
    if (0 < $('#related-content-list .date-group-wrapper .happenings-date').length) {
      $('#related-content-list .date-group-wrapper .happenings-date').each(function () {
        insertOptions($(this).text(), 'page-date');
      });
    }

    $(document).on('click', '.browse-destinations-filter .featured-btn, .browse-happenings-filter .featured-btn', function () {
      $(this).toggleClass('active');
      featuredPage = $(this).hasClass('active');
      nabFilterDestinationPagesHandler(pageLocation, pageType, newThisYear, pageStartWith, pageSearchTitle, featuredPage);
    });

    $(document).on('change', '.browse-destinations-filter #page-location, .browse-happenings-filter #page-location, .browse-learn-filter #page-location', function () {
      pageLocation = 0 === $(this)[0].selectedIndex ? '' : $(this).val();
      nabFilterDestinationPagesHandler(pageLocation, pageType, newThisYear, pageStartWith, pageSearchTitle, featuredPage);
    });

    $(document).on('change', '.browse-destinations-filter #page-type, .browse-happenings-filter #page-type, .browse-learn-filter #page-type', function () {
      pageType = 0 === $(this)[0].selectedIndex ? '' : $(this).val();
      nabFilterDestinationPagesHandler(pageLocation, pageType, newThisYear, pageStartWith, pageSearchTitle, featuredPage);
    });

    $(document).on('change', '.browse-happenings-filter #page-date, .browse-learn-filter #page-date', function () {
      nabFilterDestinationPagesHandler(pageLocation, pageType, newThisYear, pageStartWith, pageSearchTitle, featuredPage);
    });

    $(document).on('change', '.browse-learn-filter #open-to, .browse-destinations-filter #open-to', function () {
      nabFilterDestinationPagesHandler(pageLocation, pageType, newThisYear, pageStartWith, pageSearchTitle, featuredPage);
    });

    $(document).on('change', '.browse-destinations-filter .new-this-year, .browse-happenings-filter .new-this-year', function () {
      newThisYear = $(this).is(':checked') ? $(this).val() : '';
      nabFilterDestinationPagesHandler(pageLocation, pageType, newThisYear, pageStartWith, pageSearchTitle, featuredPage);
    });

    $(document).on('click', '.browse-destinations-filter .alphabets-list li:not(".clear"), .browse-happenings-filter .alphabets-list li:not(".clear")', function () {
      $(this).addClass('active').siblings().removeClass('active');
      $(this).siblings('.clear').show();
      pageStartWith = $(this).text();
      nabFilterDestinationPagesHandler(pageLocation, pageType, newThisYear, pageStartWith, pageSearchTitle, featuredPage);
    });

    $(document).on('click', '.browse-destinations-filter .alphabets-list li.clear, .browse-happenings-filter .alphabets-list li.clear', function () {
      $(this).hide().siblings().removeClass('active');
      pageStartWith = '';
      nabFilterDestinationPagesHandler(pageLocation, pageType, newThisYear, pageStartWith, pageSearchTitle, featuredPage);
    });

    $(document).on('keypress', '.browse-destinations-filter .search-item .search, .browse-happenings-filter .search-item .search, .browse-learn-filter .search-item .search', function (e) {
      if (13 === e.which) {
        pageSearchTitle = $(this).val();
        nabFilterDestinationPagesHandler(pageLocation, pageType, newThisYear, pageStartWith, pageSearchTitle, featuredPage);
      }
    });

    $(document).on('change', '.browse-happenings-filter #happenings-order', function (e) {
      let container = document.getElementById('related-content-list');
      let items = $('.col-lg-4');

      jQuery('#related-content-list .col-lg-4.col-md-6').removeClass('slideInUp').hide();
      jQuery('#related-content-list .col-lg-4.col-md-6').addClass('slideInUp').show();

      if ('Chronologically' === $(this).val()) {
        if (sortByDate) {
          sortByDate = false;
          items.each(function () {
            if ('' !== $(this).attr('data-date')) {
              let currentDate = $(this).attr('data-date').split('-');
              let standardDate = currentDate[1] + ' ' + currentDate + ' ' + currentDate[2];
              standardDate = new Date(standardDate).getTime();
              $(this).attr('data-date', standardDate);
            }
          });
        }


      } else if ('A-Z' === $(this).val()) {
        items.sort(function (a, b) {
          return ($(b).find('h2.title').text().toLowerCase()) < ($(a).find('h2.title').text().toLowerCase()) ? 1 : -1;
        }).each(function () {
          container.appendChild(this);
        });
      }

      if ('Chronologically' === $(this).val() || 'default' === $(this).val()) {
        let currentSelector = 'Chronologically' === $(this).val() ? 'data-date' : 'data-default';
        items.sort(function (a, b) {
          if ('' === $(a).attr(currentSelector)) {
            return 1;
          }
          if ('' === $(b).attr(currentSelector)) {
            return -1;
          }
          a = parseFloat($(a).attr(currentSelector));
          b = parseFloat($(b).attr(currentSelector));
          return a < b ? -1 : a > b ? 1 : 0;
        }).each(function () {
          container.appendChild(this);
        });
      }
      nabFilterDestinationPagesHandler(pageLocation, pageType, newThisYear, pageStartWith, pageSearchTitle, featuredPage);
    });
    if (0 < $('.browse-happenings-filter #happenings_date').length) {
      $(window).load(function () {
        $('.browse-happenings-filter #happenings_date').datepicker({ dateFormat: 'DD, MM d, yy' }).on('change', function () {
          nabFilterDestinationPagesHandler(pageLocation, pageType, newThisYear, pageStartWith, pageSearchTitle, featuredPage);
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

    $(document).on('click', '.browse-sponsors-filter .featured-btn', function () {
      $(this).toggleClass('active');
      featuredSponsor = $(this).hasClass('active') ? 'featured' : '';
      nabBrowseSponsorsFilterHandler(featuredSponsor, sponsorTitle);
    });

    $(document).on('keypress', '.browse-sponsors-filter .search-item .search', function (e) {
      if (13 === e.which) {
        sponsorTitle = $(this).val();
        nabBrowseSponsorsFilterHandler(featuredSponsor, sponsorTitle);
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
      $('.category-listing-main .listing .category-head .category-title').each(function () {
        insertOptions($(this).text(), 'product-categories');
      });
    }

    $(document).on('change', '.browse-product-categories-filter #product-categories', function () {
      productCategory = 0 === $(this)[0].selectedIndex ? '' : $(this).val();
      nabBrowseProductCategoryFilterHandler(productCategory, productTitle);
    });

    $(document).on('keypress', '.browse-product-categories-filter .search-item .search', function (e) {
      if (13 === e.which) {
        productTitle = $(this).val();
        nabBrowseProductCategoryFilterHandler(productCategory, productTitle);
      }
    });
  }

  /* Sticky Header new */
  function closeMenu() {
    $('.site-header').removeClass('sticky');
    $('.site-header .header-center').removeClass('col-md-2').addClass('col-md-4');
    $('.site-header .header-right').removeClass('col-md-2').addClass('col-md-4');
    $('.site-header .headnavlight').removeClass('col-md-8').addClass('col-md-12');

    $('.site-header.dark-header .head-logo').removeClass('col-md-2').removeClass('col-md-4').addClass('col-md-3');
    $('.site-header.dark-header .headnav').removeClass('col-md-8').addClass('col-md-9');
  }
  $(window).scroll(function () {
    if (266 < $(this).scrollTop()) {
      $('.site-header').addClass('sticky');
      $('.site-header .header-center').removeClass('col-md-4').addClass('col-md-2');
      $('.site-header .header-right').removeClass('col-md-4').addClass('col-md-2');
      $('.site-header .headnavlight').removeClass('col-md-12').addClass('col-md-8');

      $('.site-header.dark-header .head-logo').removeClass('col-md-3').removeClass('col-md-4').addClass('col-md-2');
      $('.site-header.dark-header .headnav').removeClass('col-md-9').addClass('col-md-8');
    }
    else {
      closeMenu();
    }
    if (992 > $(window).width()) {
      closeMenu();
    }
  });

  /* Menu Js */

  $('body').on('click', function (e) {
    const $menu = $('header');
    if (! $menu.is(e.target) && 0 === $menu.has(e.target).length) { $('.main-navigation .menu .menu-item').removeClass('clicked'); }
  });

  if (0 < jQuery('.main-navigation .menu .menu-item>a').length) {
    $('.main-navigation .menu .menu-item>a').each(function () {
      let $this = $(this);
      $($this).on('click', function (e) {
        if ($this.parent().hasClass('clicked')) {
          $this.parent().removeClass('clicked');
          $('.main-navigation .menu .menu-item>a').parent().removeClass('clicked');
        }
        else {
          $('.main-navigation .menu .menu-item>a').parent().removeClass('clicked');
          $this.parent().removeClass('clicked');
          $this.parent().addClass('clicked');
        }
        if ('#' === $this.attr('href')) {
          e.preventDefault();
        }
      });
    });
  }

  $('input.menu-hamburger').on('click', function () {
    if ($('input.menu-hamburger').is(':checked')) {
      $('html').addClass('menu-open');
    } else {
      $('html').removeClass('menu-open');
    }
  });

  /*  back-to-top js  */
  $(window).scroll(function () {
    if (150 < $(this).scrollTop()) {
      $('.back-to-top').slideDown(500);
      $('body').addClass('show-back-to-top');
    } else {
      $('.back-to-top').slideUp(500);
      $('body').removeClass('show-back-to-top');
    }
  });

  // Click event to scroll to top.
  $('.back-to-top').click(function () {
    $('html, body').animate({ scrollTop: 0 }, 500);
    return false;
  });

  /* Show Tooltip for Publication form */
  let tooltip = $('.nab-form.publication-form .form-textarea-wrapper .form-textarea');
  tooltip.each(function () {
    let $this = $(this),
      tooltipText = $('.tooltip-text').text($this.data('original-title'));
    $this.on('mouseover', function () {
      tooltipText = $('.tooltip-text').text($this.data('original-title'));
      tooltipText.css('display', 'block');
    });
    $this.on('mouseout', function () {
      tooltipText.text('');
      tooltipText.css('display', 'none');
    });
    $this.on('mousemove', function (e) {
      tooltipText.css('top', (e.pageY + 20) + 'px');
      tooltipText.css('left', (e.pageX + 20) + 'px');
      tooltipText.css('display', 'block');
    });
  });


  /*  main - bracket - end */
})(jQuery);

function nabBrowseProductCategoryFilterHandler(productCategory, productTitle) {
  jQuery('.category-listing.listing .category-body li, .category-listing.listing').removeClass('slideInUp').hide();
  jQuery('.category-listing.listing .category-body li, .category-listing.listing').addClass('slideInUp').show();
  jQuery('.category-listing.listing').parents('.category-listing-main').find('.no-data.display-none').hide();
  jQuery('body').addClass('popup-loader');

  if ('' !== productCategory) {
    jQuery('.category-listing.listing .category-head .category-title').filter(function () { return (productCategory.toLowerCase() !== jQuery(this).text().toLowerCase()); }).parents('.category-listing.listing').hide();
  }

  if ('' !== productTitle) {
    jQuery('.category-listing.listing .category-body li img:not([data-title*="' + productTitle.toLowerCase() + '"]').parents('li').hide();
    jQuery('.category-listing.listing .category-body').filter(function () { return (0 === jQuery(this).find('li:visible').length); }).parents('.category-listing.listing').hide();
  }

  if (0 === jQuery('.category-listing.listing .category-body li:visible').length) {
    jQuery('.category-listing.listing').parents('.category-listing-main').find('.no-data.display-none').show();
  }
  jQuery('body').removeClass('popup-loader');
}

function nabBrowseSponsorsFilterHandler(featuredSponsor, sponsorTitle) {
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

function nabFilterDestinationPagesHandler(pageLocation, pageType, newThisYear, pageStartWith, pageSearchTitle, featuredPage) {

  jQuery('#related-content-list .col-lg-4.col-md-6').removeClass('slideInUp').hide();
  jQuery('#related-content-list .col-lg-4.col-md-6').addClass('slideInUp').show();
  jQuery('#related-content-list .no-data.display-none').hide();
  jQuery('#related-content-list .date-group-wrapper').show();
  jQuery('body').addClass('popup-loader');

  if ('' !== pageLocation) {
    jQuery('#related-content-list .col-lg-4.col-md-6:not([data-hall*="' + pageLocation + '"])').hide();
  }

  if ('' !== pageType) {
    jQuery('#related-content-list .col-lg-4.col-md-6:not([data-type*="' + pageType + '"])').hide();
  }

  if (featuredPage) {
    jQuery('#related-content-list .col-lg-4.col-md-6:not([data-featured="featured"])').hide();
  }

  if ('' !== newThisYear) {
    jQuery('#related-content-list .col-lg-4.col-md-6:not([data-new-this-year="' + newThisYear + '"])').hide();
  }

  if ('' !== pageStartWith) {
    jQuery('#related-content-list h2.title:visible').filter(function () { return (pageStartWith !== jQuery(this).text().trim()[0].toUpperCase()); }).parents('.col-lg-4.col-md-6').hide();
  }
  if ('' !== pageSearchTitle) {
    if (0 < jQuery('#related-content-list .date-group-wrapper .happenings-date').length) {
      jQuery('#related-content-list .col-lg-4.col-md-6:not([data-title*="' + pageSearchTitle.toLowerCase() + '"])').hide();
    } else {
      jQuery('#related-content-list h2.title:visible').filter(function () { return (0 > jQuery(this).text().toLowerCase().indexOf(pageSearchTitle.toLowerCase())); }).parents('.col-lg-4.col-md-6').hide();
    }

  }
  if (0 < jQuery('.browse-happenings-filter #happenings_date').length) {
    let happeningDate = jQuery('.browse-happenings-filter #happenings_date').val();
    if ('' !== happeningDate) {
      jQuery('#related-content-list span.date_group').filter(function () { return (happeningDate !== jQuery(this).text()); }).parents('.col-lg-4.col-md-6').hide();
    }
  }

  if (0 < jQuery('.browse-learn-filter #page-date').length) {
    let happeningDate = 0 === jQuery('.browse-learn-filter #page-date')[0].selectedIndex ? '' : jQuery('.browse-learn-filter #page-date').val();
    if ('' !== happeningDate) {
      jQuery('#related-content-list .info-block').filter(function () { return ( 0 === jQuery(this).find('.date_group').length); }).parents('.col-lg-4.col-md-6').hide();
      jQuery('#related-content-list span.date_group:not(:contains(' + happeningDate + '))').parents('.col-lg-4.col-md-6').hide();
    }
  }

  if ( ( 0 < jQuery('.browse-learn-filter #open-to').length && 0 !== jQuery('.browse-learn-filter #open-to')[0].selectedIndex ) || ( 0 < jQuery('.browse-destinations-filter #open-to').length && 0 !== jQuery('.browse-destinations-filter #open-to')[0].selectedIndex ) ) {
    let openTo = 0 < jQuery('.browse-learn-filter #open-to').length ? jQuery('.browse-learn-filter #open-to').val() : jQuery('.browse-destinations-filter #open-to').val();
    jQuery('#related-content-list .col-lg-4.col-md-6:not([data-open="' + openTo + '"])').hide();
  }

  if (0 < jQuery('.browse-happenings-filter #page-date').length) {
    let happeningDate = 0 === jQuery('.browse-happenings-filter #page-date')[0].selectedIndex ? '' : jQuery('.browse-happenings-filter #page-date').val().toLowerCase();
    if ('' !== happeningDate) {
      jQuery('#related-content-list .date-group-wrapper .happenings-date').filter(function () { return (happeningDate !== jQuery(this).text().toLowerCase()); }).parents('.date-group-wrapper').hide();
    }
  }

  if (0 < jQuery('#related-content-list .date-group-wrapper .happenings-date').length) {
    jQuery('#related-content-list .date-group-wrapper').each(function () {
      if (0 === jQuery(this).find('.col-lg-4.col-md-6:visible').length) {
        jQuery(this).hide();
      }
    });
  }

  if (0 === jQuery('#related-content-list .col-lg-4.col-md-6:visible').length) {
    jQuery('#related-content-list .no-data.display-none').show();
  }

  jQuery('body').removeClass('popup-loader');

}

function nabAjaxForBrowseSpeakers(filterType, speakerPageNumber, speakerStartWith, speakerCompany, featuredSpeaker, speakerDate) {
  let postPerPage = jQuery('#load-more-speaker a').attr('data-post-limit') ? parseInt(jQuery('#load-more-speaker a').attr('data-post-limit')) : 10,
    jobTitleSearch = 0 < jQuery('.browse-speakers-filter .speaker-title-search').length ? jQuery('.browse-speakers-filter .speaker-title-search').val() : '',
    postSearch = 0 < jQuery('.browse-speakers-filter .search-item .search').length ? jQuery('.browse-speakers-filter .search-item .search').val() : '',
    excludeSpeaker = 0 < jQuery('#browse-speaker').parents('.slider-arrow-main').find('.exclude-speaker').length ? jQuery('#browse-speaker').parents('.slider-arrow-main').find('.exclude-speaker').val() : '',
    displayPlink = jQuery('#browse-exhibitor').attr('data-plannerlink'),
    sessionSpeakers = 0 < jQuery('#browse-speaker').parents('.slider-arrow-main').find('.session-speakers').length ? jQuery('#browse-speaker').parents('.slider-arrow-main').find('.session-speakers').val() : '',
    orderBy = jQuery('.browse-speakers-filter .orderby').hasClass('active') ? 'title' : 'date';

  jQuery('body').addClass('popup-loader');

  jQuery.ajax({
    type: 'GET',
    data: 'action=speakers_browse_filter&page_number=' + speakerPageNumber + '&browse_filter_nonce=' + nabshowLvCustom.nabshow_lv_browse_filter_nonce + '&post_limit=' + postPerPage + '&post_start=' + speakerStartWith + '&post_search=' + postSearch + '&speaker_company=' + speakerCompany + '&speaker_order=' + orderBy + '&speaker_job=' + jobTitleSearch + '&speaker_date=' + speakerDate + '&featured_speaker=' + featuredSpeaker + '&exclude_speaker=' + excludeSpeaker + '&session_speakers=' + sessionSpeakers,
    url: nabshowLvCustom.ajax_url,
    success: function (speakerData) {

      let speakerObj = jQuery.parseJSON(speakerData);

      if (! filterType) {
        jQuery('#browse-speaker').empty();
      }

      jQuery.each(speakerObj.result_post, function (key, value) {

        if (value.post_title) {

          let createItemDiv = document.createElement('div');

          if ( jQuery('#browse-speaker').parents('.slider-arrow-main').hasClass('on-rollover') ) {
            createItemDiv.setAttribute('class', 'item');
          } else {
            createItemDiv.setAttribute('class', 'item display-title');
          }

          createItemDiv.setAttribute('data-featured', value.featured);

          let itemInnerDiv = document.createElement('div');
          itemInnerDiv.setAttribute('class', 'flip-box');

          let itemInnerFlipBox = document.createElement('div');
          itemInnerFlipBox.setAttribute('class', 'flip-box-inner');

          let innerImg = document.createElement('img');
          innerImg.setAttribute('src', value.thumbnail_url);
          innerImg.setAttribute('alt', 'speaker-logo');
          innerImg.setAttribute('class', 'rounded-circle');

          if ( ! jQuery('#browse-speaker').parents('.slider-arrow-main').hasClass('on-rollover') ) {

            let imgLink = document.createElement('a');
            imgLink.setAttribute('href', '#');
            imgLink.setAttribute('class', 'detail-list-modal-popup');
            imgLink.setAttribute('data-postid', value.post_id);
            imgLink.setAttribute('data-posttype', 'speakers');
            imgLink.setAttribute('data-plannerlink', displayPlink);

            imgLink.appendChild(innerImg);
            itemInnerFlipBox.appendChild(imgLink);

          } else {
            itemInnerFlipBox.appendChild(innerImg);
          }

          let innerFlipBoxBack = document.createElement('div');
          innerFlipBoxBack.setAttribute('class', 'flip-box-back rounded-circle');

          if ( ! jQuery('#browse-speaker').parents('.slider-arrow-main').hasClass('without-name') ) {
            let innerHeading = document.createElement('h6');

            let innerHeadingLink = document.createElement('a');
            innerHeadingLink.innerText = value.post_title;
            innerHeadingLink.setAttribute('href', '#');
            innerHeadingLink.setAttribute('class', 'detail-list-modal-popup');
            innerHeadingLink.setAttribute('data-postid', value.post_id);
            innerHeadingLink.setAttribute('data-posttype', 'speakers');
            innerHeadingLink.setAttribute('data-plannerlink', displayPlink);

            innerHeading.appendChild(innerHeadingLink);
            innerFlipBoxBack.appendChild(innerHeading);
          }

          if ( ! jQuery('#browse-speaker').parents('.slider-arrow-main').hasClass('without-title') ) {
            let innerParagraph = document.createElement('p');
            innerParagraph.innerText = value.job_title;
            innerParagraph.setAttribute('class', 'jobtilt');

            innerFlipBoxBack.appendChild(innerParagraph);
          }

          if ( ! jQuery('#browse-speaker').parents('.slider-arrow-main').hasClass('without-company') ) {
            let innerSpan = document.createElement('span');
            innerSpan.innerText = value.company;
            innerSpan.setAttribute('class', 'company');

            innerFlipBoxBack.appendChild(innerSpan);
          }

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

function nabAjaxForBrowseExhibitors(filterType, exhibitorPageNumber, exhibitorStartWith, exhibitorCategory, exhibitorHall, exhibitorPavilion) {

  let postPerPage = jQuery('#load-more-exhibitor a').attr('data-post-limit') ? parseInt(jQuery('#load-more-exhibitor a').attr('data-post-limit')) : 10;
  let postSearch = 0 < jQuery('.browse-exhibitors-filter .search-item .search').length ? jQuery('.browse-exhibitors-filter .search-item .search').val() : '';
  let displayPlink = jQuery('#browse-exhibitor').attr('data-plannerlink');
  let keywords = new Array();
  let orderBy = jQuery('.browse-exhibitors-filter .orderby').hasClass('active') ? 'title' : 'date';

  jQuery('body').addClass('popup-loader');
  jQuery('.browse-exhibitors-filter .exhibitor-keywords:checked').each(function () {
    keywords.push(jQuery(this).val());
  });
  if (jQuery('.browse-exhibitors-filter .featured-btn').hasClass('active')) {
    keywords.push('featured');
  }

  jQuery.ajax({
    type: 'GET',
    data: 'action=exhibitors_browse_filter&page_number=' + exhibitorPageNumber + '&browse_filter_nonce=' + nabshowLvCustom.nabshow_lv_browse_filter_nonce + '&post_limit=' + postPerPage + '&post_start=' + exhibitorStartWith + '&post_search=' + postSearch + '&exhibitor_category=' + exhibitorCategory + '&exhibitor_hall=' + exhibitorHall + '&exhibitor_pavilion=' + exhibitorPavilion + '&exhibitor_keywords=' + keywords + '&exhibitor_order=' + orderBy,
    url: nabshowLvCustom.ajax_url,
    success: function (exhibitorData) {

      let exhibitorObj = jQuery.parseJSON(exhibitorData);

      if (! filterType) {
        jQuery('#browse-exhibitor').empty();
      }

      jQuery.each(exhibitorObj.result_post, function (key, value) {

        if (value.post_title) {

          let createItemDiv = document.createElement('div');
          createItemDiv.setAttribute('class', 'item');
          createItemDiv.setAttribute('data-featured', value.featured);

          let itemInnerDiv = document.createElement('div');
          itemInnerDiv.setAttribute('class', 'item-inner');

          if ('' !== value.thumbnail_url && ! jQuery('#browse-exhibitor').parents('.slider-arrow-main').hasClass('without-logo') ) {

            let imgTag = document.createElement('img');
            imgTag.setAttribute('src', value.thumbnail_url);
            imgTag.setAttribute('alt', 'exhibitor-logo');

            itemInnerDiv.appendChild(imgTag);
          }

          if ( ! jQuery('#browse-exhibitor').parents('.slider-arrow-main').hasClass('without-name') ) {

            let innerHeading = document.createElement('h4');

            let innerHeadingLink = document.createElement('a');
            innerHeadingLink.innerText = value.post_title;
            innerHeadingLink.setAttribute('href', '#');
            innerHeadingLink.setAttribute('class', 'detail-list-modal-popup');
            innerHeadingLink.setAttribute('data-postid', value.post_id);
            innerHeadingLink.setAttribute('data-posttype', 'exhibitors');
            innerHeadingLink.setAttribute('data-plannerlink', displayPlink);

            innerHeading.appendChild(innerHeadingLink);
            itemInnerDiv.appendChild(innerHeading);
          }

          if ( ! jQuery('#browse-exhibitor').parents('.slider-arrow-main').hasClass('without-booth') ) {

            let innerSpan = document.createElement('span');
            innerSpan.innerText = value.boothnumber;

            itemInnerDiv.appendChild(innerSpan);
          }

          if ( ! jQuery('#browse-exhibitor').parents('.slider-arrow-main').hasClass('without-summary') ) {

            let innerParagraph = document.createElement('p');
            innerParagraph.innerText = value.post_excerpt;

            let innerParagraphLink = document.createElement('a');
            innerParagraphLink.innerText = ' Read More';
            innerParagraphLink.setAttribute('href', '#');
            innerParagraphLink.setAttribute('class', 'detail-list-modal-popup read-more-popup');
            innerParagraphLink.setAttribute('data-postid', value.post_id);
            innerParagraphLink.setAttribute('data-posttype', 'exhibitors');
            innerParagraphLink.setAttribute('data-plannerlink', displayPlink);

            innerParagraph.appendChild(innerParagraphLink);
            itemInnerDiv.appendChild(innerParagraph);
          }

          if ( '' !== value.crossreferences ) {
            let innerCrossreferences = document.createElement('span');
            innerCrossreferences.innerText = 'Also Known As: ' + value.crossreferences.split(',').join(', ');
            innerCrossreferences.setAttribute('class', 'crossreferences');
            itemInnerDiv.appendChild(innerCrossreferences);
          }

          if ('true' === displayPlink) {
            let innerPlannerLink = document.createElement('a');
            innerPlannerLink.innerText = 'View in Planner';
            innerPlannerLink.setAttribute('href', value.planner_link);
            innerPlannerLink.setAttribute('target', '_blank');

            itemInnerDiv.appendChild(innerPlannerLink);
          }
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

function nabAjaxForBrowseSession(sessionItem, filterType, pageNumber, postStartWith, sessionTrack, sessionLocation, listingType, sessionDate, featuredSession) {
  let postPerPage = jQuery('#load-more-sessions a').attr('data-post-limit') ? parseInt(jQuery('#load-more-sessions a').attr('data-post-limit')) : 10;
  let postSearch = 0 < jQuery('.browse-open-to-all-filter .search-item .search').length ? jQuery('.browse-open-to-all-filter .search-item .search').val() : jQuery('.browse-sessions-filter .search-item .search').val();
  let withoutDate = jQuery('#browse-session').parents('.slider-arrow-main').hasClass('without-date') ? 'yes' : 'no';
  let withoutTime = jQuery('#browse-session').parents('.slider-arrow-main').hasClass('without-time') ? 'yes' : 'no';
  let displayPlink = jQuery('#browse-session').attr(' data-plannerlink');

  jQuery('body').addClass('popup-loader');

  if ('load-more' !== filterType) {
    jQuery('#browse-session').empty();
  }

  jQuery.ajax({
    type: 'GET',
    data: 'action=sessions_browse_filter&page_number=' + pageNumber + '&browse_filter_nonce=' + nabshowLvCustom.nabshow_lv_browse_filter_nonce + '&post_limit=' + postPerPage + '&post_start=' + postStartWith + '&post_search=' + postSearch + '&track=' + sessionTrack + '&location=' + sessionLocation + '&listing_type=' + listingType + '&session_date=' + sessionDate + '&featured_session=' + featuredSession + '&without_date=' + withoutDate + '&without_time=' + withoutTime,
    url: nabshowLvCustom.ajax_url,
    success: function (sessionData) {

      let sessionObj = jQuery.parseJSON(sessionData);
      if ('' !== listingType) {
        let dateGroup = '';
        let itemDateGroup = [];
        let cnt = 0;
        let appendItem = false;
        jQuery.each(sessionObj.result_post, function (key, value) {

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

          if ( ! jQuery('#browse-session').parents('.slider-arrow-main').hasClass('without-name') ) {
            let innerHeadingLink = cloneItemDiv.querySelector('h4 > a');
            innerHeadingLink.innerText = value.post_title;
            innerHeadingLink.setAttribute('data-postid', value.post_id);
          }

          if ( 'no' === withoutDate || 'no' === withoutTime ) {
            let innerSpanTag = cloneItemDiv.querySelector('span');
            innerSpanTag.innerText = value.date_time;
          }

          if ( ! jQuery('#browse-session').parents('.slider-arrow-main').hasClass('without-summary') ) {

            let innerParagraphTag = cloneItemDiv.querySelector('p');
            innerParagraphTag.childNodes[0].nodeValue = value.post_excerpt;

            let innerParagraphATag = cloneItemDiv.querySelector('p > .detail-list-modal-popup');
            innerParagraphATag.setAttribute('data-postid', value.post_id);
          }

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

            itemDateGroup.forEach(function (element) {
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

        jQuery.each(sessionObj.result_post, function (key, value) {

          if (value.post_title) {

            let createItemDiv = document.createElement('div');
            createItemDiv.setAttribute('class', 'item');
            createItemDiv.setAttribute('data-featured', value.featured);

            if ( ! jQuery('#browse-session').parents('.slider-arrow-main').hasClass('without-name') ) {
              let innerHeading = document.createElement('h4');

              let innerHeadingLink = document.createElement('a');
              innerHeadingLink.innerText = value.post_title;
              innerHeadingLink.setAttribute('href', '#');
              innerHeadingLink.setAttribute('class', 'detail-list-modal-popup');
              innerHeadingLink.setAttribute('data-postid', value.post_id);
              innerHeadingLink.setAttribute('data-posttype', 'sessions');
              innerHeadingLink.setAttribute('data-plannerlink', displayPlink);

              innerHeading.appendChild(innerHeadingLink);
              createItemDiv.appendChild(innerHeading);
            }

            if ( 'no' === withoutDate || 'no' === withoutTime ) {
              let innerSpan = document.createElement('span');
              innerSpan.innerText = value.date_time;
              innerSpan.setAttribute('class', 'date-time');

              createItemDiv.appendChild(innerSpan);
            }

            if ( ! jQuery('#browse-session').parents('.slider-arrow-main').hasClass('without-summary') ) {
              let innerParagraph = document.createElement('p');
              innerParagraph.innerText = value.post_excerpt;

              let innerParagraphLink = document.createElement('a');
              innerParagraphLink.innerText = ' Read More';
              innerParagraphLink.setAttribute('href', '#');
              innerParagraphLink.setAttribute('class', 'detail-list-modal-popup read-more-popup');
              innerParagraphLink.setAttribute('data-postid', value.post_id);
              innerParagraphLink.setAttribute('data-posttype', 'sessions');
              innerParagraphLink.setAttribute('data-plannerlink', displayPlink);

              innerParagraph.appendChild(innerParagraphLink);
              createItemDiv.appendChild(innerParagraph);
            }

            if ( value.speakers !== undefined ) {

                let innerSpeakerDiv = document.createElement('div');
                innerSpeakerDiv.setAttribute('class', 'speaker-list-comma');

                let innerSpeakerSpan = document.createElement('span');
                innerSpeakerSpan.setAttribute('class', 'speakers-name');
                innerSpeakerSpan.innerText = value.speakers;

                innerSpeakerDiv.appendChild(innerSpeakerSpan);
                createItemDiv.appendChild(innerSpeakerDiv);
            }

            if ('true' === displayPlink) {
              let innerPlannerLink = document.createElement('a');
              innerPlannerLink.innerText = 'View in Planner';
              innerPlannerLink.setAttribute('href', value.planner_link);
              innerPlannerLink.setAttribute('class', 'session-planner-url');
              innerPlannerLink.setAttribute('target', '_blank');

              createItemDiv.appendChild(innerPlannerLink);
            }
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
    mainDiv.classList.add('custom-masonry');
  }
}

function CustomMasonryGrids() {
  var colCount, colHeight, i, mainDiv, highest, order, divHeight;
  colHeight = [];
  mainDiv = document.getElementsByClassName('box-main');

  if (5 < mainDiv[0].children.length) {

    jQuery('.news-conference-schedule .box-main .box-item, .birds-of-a-feather .box-main .box-item').css({ opacity: '0', transform: 'scale(0.8, 0.8)' });
    if (767 > window.innerWidth) {
      colCount = 1;
    } else if (992 > window.innerWidth) {
      colCount = 2;
    } else if (1200 > window.innerWidth) {
      colCount = 3;
    } else {
      colCount = 4;
    }

    for (i = 0; i <= colCount; i++) {
      colHeight.push(0);
    }

    for (i = 0; i < mainDiv[0].children.length; i++) {
      mainDiv[0].children[i].style.height = '';
      order = (i + 1) % colCount || colCount;
      mainDiv[0].children[i].style.order = order;
      divHeight = mainDiv[0].children[i].clientHeight;

      if (0 === divHeight) {
        divHeight = mainDiv[0].children[i].childNodes[1].childNodes[1].naturalHeight;
      }
      mainDiv[0].children[i].style.height = divHeight + 'px';
      colHeight[order] += parseInt(divHeight);

      jQuery(mainDiv[0].children[i])
        .show('slow')
        .css({ opacity: '1', transform: 'scale(1, 1)' });
    }
    highest = Math.max.apply(Math, colHeight);
    mainDiv[0].style.height = highest + 'px';
  } else {
    jQuery('.news-conference-schedule .box-main').addClass('without-masonry');
    jQuery('.birds-of-a-feather .box-main').addClass('without-masonry');
  }
}

// video player lightbox
jQuery(document).on('click', '.video-lightbox', function(){
  let iFrameUrl = jQuery(this).attr('data-iframeurl');

  // stampiamo i nostri dati nell'iframe
  jQuery(this).siblings('.video-popup').find('iframe').attr({'src': iFrameUrl});
  jQuery(this).siblings('.video-popup').addClass('video-popup-open');
  jQuery('body').addClass('popup-open');

});

jQuery(document).on('click', '.video-popup .close, .video-popup .overlay', function(){
  jQuery('.video-popup').removeClass('video-popup-open');
  jQuery('body').removeClass('popup-open');
  jQuery('.video-popup iframe').attr({'src': ''});
});

jQuery(document).keydown(function(e) {
  if (27 == e.keyCode) {
    jQuery('.video-popup').removeClass('video-popup-open');
    jQuery('body').removeClass('popup-open');
    jQuery('.video-popup iframe').attr({'src': ''});
  }
});

// video player lightbox

// news-conference filter MasonryGrids

jQuery(document).on('change', '.news-conference select', function(){
  conferenceMasonryGrids();
});

jQuery(document).on('keyup', '.news-conference .search', function () {
  conferenceMasonryGrids();
});

function conferenceMasonryGrids() {
  var colCount, colHeight, i, mainDiv, highest, order, divHeight;
  colHeight = [];
  mainDiv = document.getElementsByClassName('box-main');

  if (5 < jQuery('.box-item:visible').length) {
    jQuery('.news-conference-schedule .box-main').removeClass('without-masonry');
    jQuery('.news-conference-schedule .box-main .box-item').css({ opacity: '0', transform: 'scale(0.8, 0.8)' });
    if (767 > window.innerWidth) {
      colCount = 1;
    } else if (992 > window.innerWidth) {
      colCount = 2;
    } else if (1200 > window.innerWidth) {
      colCount = 3;
    } else {
      colCount = 4;
    }

    for (i = 0; i <= colCount; i++) {
      colHeight.push(0);
    }

    for (i = 0; i < jQuery('.box-item:visible').length; i++) {
      jQuery('.box-item:visible')[i].style.height = '';
      order = (i + 1) % colCount || colCount;
      jQuery('.box-item:visible')[i].style.order = order;
      divHeight = jQuery('.box-item:visible')[i].clientHeight;

      if (0 === divHeight) {
        divHeight = jQuery('.box-item:visible')[i].childNodes[1].childNodes[1].naturalHeight;
      }
      jQuery('.box-item:visible')[i].style.height = divHeight + 'px';
      colHeight[order] += parseInt(divHeight);

      jQuery(jQuery('.box-item:visible')[i])
        .show('slow')
        .css({ opacity: '1', transform: 'scale(1, 1)' });
    }
    highest = Math.max.apply(Math, colHeight);
    mainDiv[0].style.height = highest + 'px';
  } else {
    jQuery('.news-conference-schedule .box-main').addClass('without-masonry');
    mainDiv[0].style.height = 'auto';
  }
}

// news-conference filter MasonryGrids

/**
 * Schedule at a glance filter dropdown options append
 * @param data
 * @param id
 */
function insertOptions(data, id) {
  let dataValue = data.trim();
  if (0 === jQuery('#' + id + ' option[value="' + dataValue + '"]').length && undefined !== dataValue && '' !== dataValue) {
    let node = document.createElement('option');
    node.setAttribute('value', dataValue);
    let textnode = document.createTextNode(dataValue);
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

/**
  * Master Filter Function
**/
function masterFilterFunc(selectedItem, searchId, searchKeyword, selectedLetter) {

  jQuery(selectedItem).removeClass('slideInUp').hide();
  jQuery(selectedItem).addClass('slideInUp').show();
  jQuery('.no-data').hide();

  if (0 != jQuery('.accordionParentWrapper').length && 0 != jQuery('.fab-filter').length) {
    jQuery(selectedItem).removeClass('slideInUp').show();
    jQuery('.accordionParentWrapper, .accordionWrapper').show();
  }
  if (0 != jQuery('.badge-discounts-box').length) {
    jQuery('.badge-discounts, .badge-discounts .badge-title').show();
  }
  if (0 < jQuery('.awards-main').length) {
    jQuery('.awards-main').show();
  }
  if (0 < jQuery('.schedule-main').length) {
    jQuery('.schedule-main, .schedule-main .schedule-row').show();
  }
  if (0 < jQuery('.products-winners').length) {
    jQuery('.products-winners, .product-item').removeClass('slideInUp').hide();
    jQuery('.products-winners, .product-item').addClass('slideInUp').show();
  }
  if (0 < jQuery('.news-conference-schedule').length) {
    jQuery('.news-conference-schedule ' + selectedItem).show();
  }
  if (0 < jQuery('.opportunities').length) {
    jQuery('.opportunities').show();
  }
  if (0 < jQuery('.sponsorship-opportunities-page').length) {
    jQuery('.related-main-wrapper, .sponsorship-opportunities-page, .sponsorship-opportunities-page .parent-main-title').show();
  }
  if (0 != jQuery('.exhibitor-resources-page').length) {
    jQuery('.related-main-wrapper, .parent-main-title').show();
  }

  let filterSearch, comparedItem, filterMainData, filterBoothData, filterVendorData, filterFaqData, filterAwardData, filterDate, filterTime, filterLocation, filterType, filterDepartment, filterProduct, filterCName, filterCDate, filterCLocation, filterSubCat, filterCost, filterExclusive, filterAvailable, filterMainCat, filterMediaTopics, filterMediaFormats, filterMediaLocation, filterAttendee, filterHostingOrg, filterOrganizers, filterBirdDate, filterDelegation, filterNewThisYear, filterOffVen, filterSchTime;

  if (0 < jQuery('#box-main-category').length) {
    filterMainData = 0 < jQuery('#box-main-category')[0].selectedIndex ? jQuery('#box-main-category').val() : null;
  }
  if (0 < jQuery('#box-main-category-booth').length) {
    filterBoothData = 0 < jQuery('#box-main-category-booth')[0].selectedIndex ? jQuery('#box-main-category-booth').val() : null;
  }
  if (0 < jQuery('#box-main-category-vendor').length) {
    filterVendorData = 0 < jQuery('#box-main-category-vendor')[0].selectedIndex ? jQuery('#box-main-category-vendor').val() : null;
  }
  if (0 < jQuery('#box-main-category-delegation').length) {
    filterDelegation = 0 < jQuery('#box-main-category-delegation')[0].selectedIndex ? jQuery('#box-main-category-delegation').val() : null;
  }
  if (0 < jQuery('.new-this-year-inner').length) {
    filterNewThisYear = 0 < jQuery('#box-main-category-newyr')[0].selectedIndex ? jQuery('#box-main-category-newyr').val() : null;
  }
  if (0 < jQuery('#box-main-category-offven').length) {
    filterOffVen = 0 < jQuery('#box-main-category-offven')[0].selectedIndex ? jQuery('#box-main-category-offven').val() : null;
  }

  if (0 < jQuery('#faq-category-drp').length) {
    filterFaqData = 0 < jQuery('#faq-category-drp')[0].selectedIndex ? jQuery('#faq-category-drp').val() : null;
  }
  if (0 < jQuery('#award-name').length) {
    filterAwardData = 0 < jQuery('#award-name')[0].selectedIndex ? jQuery('#award-name').val() : null;
  }
  if (0 < jQuery('.schedule-main').length) {
    if (jQuery('.schedule-glance-filter #date').length){
      filterDate = 0 < jQuery('.schedule-glance-filter .schedule-select #date')[0].selectedIndex ? jQuery('.schedule-glance-filter .schedule-select #date').val() : null;
    }
    if (jQuery('.schedule-glance-filter #time').length) {
      filterSchTime = 0 < jQuery('.schedule-glance-filter .schedule-select #time')[0].selectedIndex ? jQuery('.schedule-glance-filter .schedule-select #time').val() : null;
    }
    if (jQuery('.schedule-glance-filter #pass-type').length) {
      filterTime = 0 < jQuery('.schedule-glance-filter .schedule-select #pass-type')[0].selectedIndex ? jQuery('.schedule-glance-filter .schedule-select #pass-type').val() : null;
    }
    if (jQuery('.schedule-glance-filter #location').length) {
      filterLocation = 0 < jQuery('.schedule-glance-filter .schedule-select #location')[0].selectedIndex ? jQuery('.schedule-glance-filter .schedule-select #location').val() : null;
    }
    if (jQuery('.schedule-glance-filter #type').length) {
      filterType = 0 < jQuery('.schedule-glance-filter .schedule-select #type')[0].selectedIndex ? jQuery('.schedule-glance-filter .schedule-select #type').val() : null;
    }
  }
  if (0 < jQuery('.meet-team-main.team-main').length) {
    filterDepartment = 0 < jQuery('.meet-team-select #team-department')[0].selectedIndex ? jQuery('.meet-team-select #team-department').val() : null;

    jQuery('#team-checkbox .checkbox-list input').parent().removeClass('checked');
    jQuery('#team-checkbox .checkbox-list input:checked').parent().addClass('checked');

    if (0 < jQuery('#team-checkbox .checkbox-list input:checked').length) {
      jQuery(selectedItem).hide();
      jQuery('#team-checkbox .checkbox-list input:checked').each(function () {
        jQuery(selectedItem + '[data-category*="' + jQuery(this).val() + '"]').hide().show();
      });
    }
  }
  if (0 < jQuery('.products-winners').length) {
    filterProduct = 0 < jQuery('#products-category')[0].selectedIndex ? jQuery('#products-category').val() : null;
  }
  if (0 < jQuery('.news-conference-schedule').length) {
    filterCName = 0 < jQuery('#company-name')[0].selectedIndex ? jQuery('#company-name').val() : null;
    filterCDate = 0 < jQuery('#date-filter')[0].selectedIndex ? jQuery('#date-filter').val() : null;
    filterCLocation = 0 < jQuery('#location-filter')[0].selectedIndex ? jQuery('#location-filter').val() : null;
  }
  if (0 < jQuery('.sponsorship-opportunities-page').length) {
    filterMainCat = 0 < jQuery('#main-category-type')[0].selectedIndex ? jQuery('#main-category-type').val() : null;
  }
  if (0 < jQuery('.opportunities').length) {
    filterSubCat = 0 < jQuery('#sub-category-type')[0].selectedIndex ? jQuery('#sub-category-type').val() : null;
    filterCost = 0 < jQuery('#price-range')[0].selectedIndex ? jQuery('#price-range').val() : null;
    filterExclusive = 0 < jQuery('#exclusivity')[0].selectedIndex ? jQuery('#exclusivity').val() : null;
    filterAvailable = 0 < jQuery('#availability')[0].selectedIndex ? jQuery('#availability').val() : null;
  }
  if (0 < jQuery('.media-partners').length) {
    filterMediaTopics = 0 < jQuery('#topic-type')[0].selectedIndex ? jQuery('#topic-type').val() : null;
    filterMediaFormats = 0 < jQuery('#format-type')[0].selectedIndex ? jQuery('#format-type').val() : null;
    filterMediaLocation = 0 < jQuery('#location-type')[0].selectedIndex ? jQuery('#location-type').val() : null;
  }

  if (0 < jQuery('.birds-of-a-feather').length) {
    filterAttendee = 0 < jQuery('#attend-filter')[0].selectedIndex ? jQuery('#attend-filter').val() : null;
    filterHostingOrg = 0 < jQuery('#hosting-filter')[0].selectedIndex ? jQuery('#hosting-filter').val() : null;
    filterOrganizers = 0 < jQuery('#organizer-filter')[0].selectedIndex ? jQuery('#organizer-filter').val() : null;
    filterBirdDate = 0 < jQuery('#birdDate-filter')[0].selectedIndex ? jQuery('#birdDate-filter').val() : null;
  }

  // Dropdown Filter
  if (null !== filterMainData && undefined !== filterMainData) {
    if (0 != jQuery(selectedItem).closest('.exhibitor-committee').length) {
      comparedItem = '.areas';
    }
    jQuery(selectedItem + ' ' + comparedItem + ':not(:contains("' + filterMainData + '"))').parents(selectedItem).hide();
  }

  if (null !== filterBoothData && undefined !== filterBoothData) {
    comparedItem = '.boothSize';
    jQuery(selectedItem + ' ' + comparedItem + ':not(:contains("' + filterBoothData + '"))').parents(selectedItem).hide();
  }

  if (null !== filterVendorData && undefined !== filterVendorData) {
    comparedItem = '.companyName';
    jQuery(selectedItem + ' ' + comparedItem + ':not(:contains("'+ filterVendorData + '"))').parents(selectedItem).hide();
  }

  if (null !== filterDelegation && undefined !== filterDelegation) {
    comparedItem = '.country';
    jQuery(selectedItem + ' ' + comparedItem + ':not(:contains("' + filterDelegation + '"))').parents(selectedItem).hide();

  }

  if (null !== filterNewThisYear && undefined !== filterNewThisYear) {
    comparedItem = '.new-this-year-block .title';
    jQuery(comparedItem + ':not(:contains("' + filterNewThisYear +'"))').parents(selectedItem).hide();
  }

  if (null !== filterOffVen && undefined !== filterOffVen) {
    comparedItem = '.official-vendors .title';
    jQuery(comparedItem + ':not(:contains("' + filterOffVen + '"))').parents(selectedItem).hide();
  }

  if (null !== filterFaqData && undefined !== filterFaqData) {
    comparedItem = '.title';
    jQuery(selectedItem + ' ' + comparedItem).filter(function () { return (filterFaqData.toLowerCase() !== jQuery(this).text().toLowerCase()); }).parents(selectedItem).hide();
  }

  if (null !== filterAwardData && undefined !== filterAwardData) {
    comparedItem = '.awards-winner-title';
    if (0 < jQuery('.awards-main').length) {
      selectedItem = '.awards-main';
    }
    jQuery(selectedItem + ' ' + comparedItem).filter(function () {
      return (filterAwardData.toLowerCase() !== jQuery(this).text().toLowerCase());
    }).parents(selectedItem).hide();
  }
  if (null !== filterDate && undefined !== filterDate) {
    if (0 < jQuery('.schedule-main').length) {
      comparedItem = '.schedule-main h2';
    }
    jQuery(comparedItem + ':not(:contains("' + filterDate + '"))').parent().hide();

  }
  if (null !== filterLocation && undefined !== filterLocation) {
    if (0 < jQuery('.schedule-main').length) {
      comparedItem = '.location';
    }
    jQuery(selectedItem + ' ' + comparedItem).filter(function () { return (filterLocation.toLowerCase() !== jQuery(this).text().toLowerCase()); }).parents('.schedule-row').hide();
  }
  if (null !== filterSchTime && undefined !== filterSchTime) {
    if (0 < jQuery('.schedule-main').length) {
      comparedItem = '.time';
    }
    jQuery(selectedItem + ' ' + comparedItem).filter(function () { return (filterSchTime.toLowerCase() !== jQuery(this).text().toLowerCase()); }).parents('.schedule-row').hide();
  }
  if (null !== filterTime && undefined !== filterTime) {
    if (0 < jQuery('.schedule-main').length) {
      comparedItem = '.details';
    }
    jQuery(selectedItem + ' ' + comparedItem).filter(function () { return (filterTime.toLowerCase() !== jQuery(this).text().toLowerCase()); }).parents('.schedule-row').hide();
  }
  if (null !== filterType && undefined !== filterType) {
    if (0 < jQuery('.schedule-main').length) {
      comparedItem = '.schedule-row';
    }
    jQuery(selectedItem + ' ' + comparedItem + ':not([data-type="' + filterType + '"])').hide();
  }
  if (null !== filterDepartment && undefined !== filterDepartment) {
    if (0 < jQuery('.meet-team-main').length) {
      jQuery('.meet-team-main' + ' ' + selectedItem + ':not([data-department="' + filterDepartment + '"])').hide();
    }
  }
  if (null !== filterProduct && undefined !== filterProduct) {
    jQuery(selectedItem + ':not(:contains("' + filterProduct + '"))').parent().hide();
  }
  if (null !== filterCName && undefined !== filterCName) {
    jQuery(selectedItem + ' ' + '.title:not(:contains("' + filterCName + '"))').parents(selectedItem).hide();
  }
  if (null !== filterCDate && undefined !== filterCDate) {
    jQuery(selectedItem + ' ' + '.date-time:not(:contains("' + filterCDate + '"))').parents(selectedItem).hide();
  }
  if (null !== filterCLocation && undefined !== filterCLocation) {
    jQuery(selectedItem + ' ' + '.location:not(:contains("' + filterCLocation + '"))').parents(selectedItem).hide();
  }
  if (null !== filterMainCat && undefined !== filterMainCat) {
    if (0 < jQuery('#main-category-type').length) {
      selectedItem = '.related-main-wrapper';
    }
    jQuery('.sponsorship-opportunities-page' + ' ' + selectedItem + ' ' + '.parent-main-title:not(:contains("' + filterMainCat + '"))').parents(selectedItem).hide();
  }
  if (null !== filterSubCat && undefined !== filterSubCat) {
    if (0 < jQuery('#sub-category-type').length) {
      selectedItem = '.opportunities';
    } else {
      selectedItem = '.box-item';
    }
    jQuery(selectedItem + ' ' + '.main-title:not(:contains("' + filterSubCat + '"))').parents(selectedItem).hide();
  }
  if (null !== filterCost && undefined !== filterCost) {
    if (0 < jQuery('.opportunities').length) {
      selectedItem = '.box-item';
    }
    jQuery(selectedItem + ' ' + '.cost:not(:contains("' + filterCost + '"))').parents(selectedItem).hide();
  }
  if (null !== filterExclusive && undefined !== filterExclusive) {
    jQuery(selectedItem + ' ' + '.exclusivity').filter(function () { return (filterExclusive.toLowerCase() !== jQuery(this).text().toLowerCase()); }).parents(selectedItem).hide();

  }
  if (null !== filterAvailable && undefined !== filterAvailable) {
    if (0 < jQuery('.opportunities').length) {
      selectedItem = '.box-item';
    }
    if ('Available' === filterAvailable) {
      jQuery(selectedItem + '.visible').hide();
    }
    if ('Unavailable' === filterAvailable) {
      jQuery(selectedItem).not('.visible').hide();
    }
  }
  if (jQuery('.media-partner-filter .featured-btn').hasClass('active')) {
    jQuery('.media-partners .team-box').hide();
    jQuery('.media-partners .team-box.featured').show();
  } else {
    jQuery('.media-partners .team-box').show();
  }
  if (null !== filterMediaTopics && undefined !== filterMediaTopics) {
    jQuery(selectedItem + ':not([data-topics*="' + filterMediaTopics + '"])').hide();
  }
  if (null !== filterMediaFormats && undefined !== filterMediaFormats) {
    jQuery(selectedItem + ':not([data-formats*="' + filterMediaFormats + '"])').hide();
  }
  if (null !== filterMediaLocation && undefined !== filterMediaLocation) {
    jQuery(selectedItem + ':not([data-locations*="' + filterMediaLocation + '"])').hide();
  }
  if (null !== filterAttendee && undefined !== filterAttendee) {
    jQuery(selectedItem + ' ' + '.attend:not(:contains("' + filterAttendee + '"))').parents(selectedItem).hide();
  }
  if (null !== filterHostingOrg && undefined !== filterHostingOrg) {
    jQuery(selectedItem + ' ' + '.hosting:not(:contains("' + filterHostingOrg + '"))').parents(selectedItem).hide();
  }
  if (null !== filterOrganizers && undefined !== filterOrganizers) {
    jQuery(selectedItem + ' ' + '.organizer:not(:contains("' + filterOrganizers + '"))').parents(selectedItem).hide();
  }
  if (null !== filterBirdDate && undefined !== filterBirdDate) {
    jQuery(selectedItem + ' ' + '.date-time:not(:contains("' + filterBirdDate + '"))').parents(selectedItem).hide();
  }


  // Alphabet filter
  if (0 != jQuery('.products-winners-filter .alphabets-list li').length && null !== selectedLetter && undefined !== selectedLetter) {
    jQuery('.products-winners-filter ul.alphabets-list li:not(.clear)').removeClass('active');
    jQuery('.products-winners-filter ul.alphabets-list li:not(.clear):contains("' + selectedLetter + '")').addClass('active');
    jQuery('.products-winners-filter ul.alphabets-list li.clear').show();

    alphabetsFilter();

    if ('Clear' === selectedLetter) {
      jQuery('.products-winners .product-main .product-item, .products-winners .product-main .product-item .product-inner').show();
      jQuery('.products-winners-filter ul.alphabets-list li.clear').hide();
      jQuery('.products-winners-filter ul.alphabets-list li:not(.clear)').removeClass('active');
    }

  }
  function alphabetsFilter() {
    jQuery('.products-winners .product-item')
      .filter(function () {
        return (
          jQuery('.products-winners-filter .alphabets-list li:not(.clear).active').text().toLowerCase() != jQuery('.subtitle', this).text().toLowerCase().charAt(0)
        );
      }).hide();
  }

  // Search Filter
  filterSearch = jQuery(searchId).val();
  if (0 != jQuery('.accordionParentWrapper').length && 0 != jQuery('.fab-filter').length) {
    selectedItem = '.accordionWrapper';
    searchKeyword = '.accordionHeader h3';
  }
  if (0 != jQuery('.badge-discounts-box').length) {
    selectedItem = '.badge-discounts:visible .box-item:visible';
  }
  if (0 < jQuery('.awards-main').length) {
    searchKeyword = '.winnerName h3';
    selectedItem = '.awards-main';
  }
  if (0 < jQuery('.schedule-main').length) {
    selectedItem = '.schedule-main .schedule-row';
    searchKeyword = '.name';
  }
  if (0 < jQuery('.products-winners').length) {
    selectedItem = '.product-item';
  }

  if ('' !== filterSearch && undefined !== filterSearch) {
    jQuery(selectedItem)
      .filter(function () {
        return (
          0 >
          jQuery(searchKeyword, this).text().toLowerCase().indexOf(filterSearch.toLowerCase())
        );
      })
      .hide();
  }


  // Square Select Filter
  if (jQuery('.committee-filter .badgeslist a').hasClass('active')) {
    selectedItem = '.exhibitor-committee .box-item';
    jQuery(selectedItem).not('.International').hide();
  }
  if (jQuery('.official-vendors-filter .badgeslist a').hasClass('active')) {
    selectedItem = '.official-vendors .box-item';
    jQuery(selectedItem + ' .type:not(:contains("' + jQuery('.ov-filter .badgeslist a.active').text() + '"))').parents(selectedItem).hide();
  }
  if (jQuery('.badge-discount-filter .badgeslist a').hasClass('active')) {
    jQuery('.badge-discounts .badge-title:not(:contains("' + jQuery('.badge-discount-filter .badgeslist a.active').text() + '"))').parent().hide();
  }
  if (jQuery('.exhibitor-resources-main .badgeslist a').hasClass('active')) {
    jQuery('.related-main-wrapper .parent-main-title:not(:contains("' + jQuery('.exhibitor-resources-main .badgeslist a.active').text() + '"))').parent().hide();
  }
  if (0 != jQuery('.badge-discounts').length) {
    selectedItem = '.badge-discounts';
    jQuery(selectedItem)
      .not(function () {
        return 0 < jQuery(this).find('.box-item:visible').length;
      })
      .hide();
  }
  if (0 != jQuery('.accordionParentWrapper').length && 0 != jQuery('.fab-filter').length) {
    selectedItem = '.accordionParentWrapper';
    jQuery(selectedItem)
      .not(function () {
        return 0 < jQuery(this).find('.accordionHeader h3:visible').length;
      })
      .hide();
  }
  if (0 != jQuery('.schedule-main').length) {
    selectedItem = '.schedule-main';
    jQuery(selectedItem)
      .not(function () {
        return 0 < jQuery(this).find('.schedule-row:visible').length;
      })
      .hide();
  }
  if (0 < jQuery('.products-winners').length) {
    selectedItem = '.products-winners';
    jQuery(selectedItem)
      .not(function () {
        return 0 < jQuery(this).find('.product-item:visible').length;
      })
      .hide();
  }
  if (0 != jQuery('.opportunities').length) {
    selectedItem = '.opportunities';
    jQuery(selectedItem)
      .not(function () {
        return 0 < jQuery(this).find('.box-item:visible').length;
      })
      .hide();
  }
  if (0 != jQuery('.main-exhibitor-block .related-main-wrapper').length) {
    selectedItem = '.main-exhibitor-block .related-main-wrapper';
    jQuery(selectedItem)
      .not(function () {
        return 0 < jQuery(this).find('.col-lg-4.col-md-6:visible').length;
      })
      .hide();
  }
  if (0 != jQuery('.sponsorship-opportunities-page .related-main-wrapper').length) {
    selectedItem = '.sponsorship-opportunities-page .related-main-wrapper';
    jQuery(selectedItem)
      .not(function () {
        return 0 < jQuery(this).find('.box-item:visible').length;
      })
      .hide();
  }

  if (0 === jQuery(selectedItem + ':visible').length) {
    if (0 === jQuery('.no-data').length) {
      createResultNotFoundNode(selectedItem);
    } else {
      jQuery('.no-data').show();
    }
  }
}
