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
  $(document).on('click', '.detail-list-modal-popup, .modal-detail-list-modal-popup', function () {
    var postType = $(this).attr('data-posttype');
    var postId = $(this).attr('data-postid');
    var userId = $(this).attr('data-userid');
    if ($(this).hasClass('modal-detail-list-modal-popup')) {
      $(this).parents('.modal').modal('hide');
    }
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

  // Header Search js
  jQuery('.super-menu-main .super-menu-icons li .fa-search').on('click', function () {
    jQuery(this).closest('.header-right').toggleClass('active');
  });

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
        scrollTop: $(section).offset().top
      });
    });

  // banner-navigation

  if (0 < $('#card_section').length) {
    window.onload = window.onresize = masonryGrids;
  }

  if (0 < $('.news-conference-schedule .box-main').length) {
    window.onload = window.onresize = CustomMasonryGrids;
  }

  $(document).on('change', '.plan-your-show-drp', function () {
    if ('' !== $(this).val()) {
      location.replace($(this).val());
    }
  });

  $(document).on('click', '.slider-card-filter .filter-list li', function () {
    var cardsDiv, cloneCardsDiv, innerH2Tag, innerImgTag, innerCategory, dataObj, innerATag,
      ajaxAction = 'nabshow_ntb_missed_load_more_category_click',
      _this = $(this),
      itemToFetch = $(this).parents('.slider-arrow-main').find('.nab-not-to-be-missed-slider').attr('data-item');

    $(this).parents('.slider-arrow-main').find('.nab-not-to-be-missed-slider').addClass('change-slide');
    $('#loader_container').show();
    $('.nab-not-to-be-missed-slider .cards').addClass('slideInUp');

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

            innerATag = cloneCardsDiv.querySelector('a');
            innerATag.setAttribute('href', value.post_permalink);

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

  // nab-videos
  if (0 < $('.nab-videos').length) {
    $(document).on('click', '.nab-videos .video-popup-btn', function () {

      // let videoWidth = jQuery(this).parent().parent().find('.media').attr('width');
      jQuery('.nab-videos .videos-popup .videos-popup-iframe').attr('src', jQuery(this).parent().parent().find('.media').attr('data-video-src'));

      // console.log(jQuery(this).parent().parent().find('.media').attr('data-video-src'));


      // jQuery('.nab-videos .videos-dialog').css('width', 1370 > videoWidth ? videoWidth : '1370px');
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
    if (0 < $('.box-main .box-item').length || 0 < $('.accordionParentWrapper').length || 0 < $('.schedule-glance-filter select#award-name').length || 0 < $('.schedule-glance-filter div select#date').length || 0 < $('.team-main .team-box').length || 0 < $('.products-winners').length || 0 < $('.news-conference-schedule').length || 0 < $('.opportunities').length || 0 < $('.related-content-rowbox').length) {

      $('.new-this-year .box-main .box-item').each(function () {
        if ('' !== $(this).find('.title').html()) {
          insertOptions($(this).find('.title').html(), 'box-main-category');
        }
      });

      $('.official-vendors .box-main .box-item').each(function () {
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
              insertOptions(val, 'box-main-category');
            }
          );
        }
      });

      $('.accordionParentWrapper').each(function () {
        if ('' !== $(this).find('.title').html()) {
          insertOptions($(this).find('.title').html(), 'faq-category-drp');
        }
      });

      $('.awards-main').each(function () {
        insertOptions($(this).find('.awards-winner-title').text(), 'award-name');
      });

      $('.schedule-main').each(function () {
        insertOptions($(this).find('h2').text(), 'date');

        $(this).find('.schedule-row').each(function () {
          insertOptions($(this).find('.date p').text(), 'pass-type');
          insertOptions($(this).find('.location p').text(), 'location');
          insertOptions($(this).find('.details p').text(), 'type');
        });
      });

      $('.meet-team-main.team-main  .team-box').each(function () {
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
      if (0 < $('.exhibitor-committee .box-main, .badge-discounts .box-main, .new-this-year-block .box-main, .official-vendors .box-main, .delegation .box-main, .opportunities .box-main').length) {
        selectedItem = '.box-item';
      }
      if (0 < $('.accordionParentWrapper').length) {
        selectedItem = '.accordionParentWrapper';
      }
      if (0 < $('.awards-main').length) {
        selectedItem = '.wp-block-nab-awards-item';
      }
      if (0 < $('.schedule-main').length) {
        selectedItem = '.schedule-row';
      }
      if (0 < $('.team-main').length) {
        selectedItem = '.team-box';
      }
      if (0 < $('.products-winners').length) {
        selectedItem = '.product-title';
      }
      if (0 < $('.box-main, #box-main-search').length) {
        searchKeyword = '.title';
        searchId = '#box-main-search';
      }
      if (0 < $('.news-conference-schedule').length) {
        selectedItem = '.box-item';
        searchKeyword = '.title';
      }
      if (0 < $('.rc-page-block').length) {
        selectedItem = '.rc-page-block .col-lg-4.col-md-6';
        searchKeyword = '.title';
      }

      $(document).on('click', 'ul.alphabets-list li', function () {
        selectedLetter = $(this).html();
        masterFilterFunc(selectedItem, searchId, searchKeyword, selectedLetter);
      });
      $(document).on('change', '#box-main-category, #box-main-category-booth, #box-main-category-vendor, #faq-category-drp, #award-name, .schedule-glance-filter .schedule-select #date, .schedule-glance-filter .schedule-select #pass-type, .schedule-glance-filter .schedule-select #location, .schedule-glance-filter .schedule-select #type, .meet-team-select #team-department, .meet-team-select .checkbox-list input, #products-category, #company-name, #date-filter, #location-filter, #main-category-type, #sub-category-type, #price-range, #exclusivity, #availability, #topic-type, #format-type, #location-type', function () {
        masterFilterFunc(selectedItem, searchId, searchKeyword, selectedLetter);
      });
      $(document).on('keyup', '#box-main-search, #box-main-search-bd', function () {
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

              masterFilterFunc(selectedItem, searchId, searchKeyword);

            }
            else {
              $('.badgeslist a').removeClass('active');
              $('.badgeslist a').removeClass('clicked');

              $this.addClass('clicked');
              $(this).addClass('active');

              masterFilterFunc(selectedItem, searchId, searchKeyword);

            }
          });
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
      sessionTrack = '',
      sessionLevel = '',
      sessionType = '',
      sessionDate = '',
      sessionLocation = '',
      featuredSession = $('.browse-sessions-filter .featured-btn').hasClass('active') ? 'featured' : '',
      sessionItem = $('#browse-session .item')[0],
      listingType = 0 < $('#browse-session .listing-date-group').length ? $('#browse-session .listing-date-group:first').attr('data-listing-type') : '';


    $(document).on('change', '.browse-sessions-filter #session-tracks', function () {
      let currentTrack = 0 === $(this)[0].selectedIndex ? '' : $(this).val();
      if (sessionTrack !== currentTrack) {
        pageNumber = 1;
        sessionTrack = currentTrack;
        nabAjaxForBrowseSession(sessionItem, 'browse-filter', pageNumber, postStartWith, sessionTrack, sessionLevel, sessionType, sessionLocation, listingType, sessionDate, featuredSession);
      }
    });

    $(document).on('change', '.browse-sessions-filter #session-level', function () {
      let currentLevel = 0 === $(this)[0].selectedIndex ? '' : $(this).val();
      if (sessionLevel !== currentLevel) {
        pageNumber = 1;
        sessionLevel = currentLevel;
        nabAjaxForBrowseSession(sessionItem, 'browse-filter', pageNumber, postStartWith, sessionTrack, sessionLevel, sessionType, sessionLocation, listingType, sessionDate, featuredSession);
      }
    });

    $(document).on('change', '.browse-sessions-filter #session-type', function () {
      let currentType = 0 === $(this)[0].selectedIndex ? '' : $(this).val();
      if (sessionType !== currentType) {
        pageNumber = 1;
        sessionType = currentType;
        nabAjaxForBrowseSession(sessionItem, 'browse-filter', pageNumber, postStartWith, sessionTrack, sessionLevel, sessionType, sessionLocation, listingType, sessionDate, featuredSession);
      }
    });

    $(document).on('change', '.browse-sessions-filter #session-location', function () {
      let currentLocation = 0 === $(this)[0].selectedIndex ? '' : $(this).val();
      if (sessionLocation !== currentLocation) {
        pageNumber = 1;
        sessionLocation = currentLocation;
        nabAjaxForBrowseSession(sessionItem, 'browse-filter', pageNumber, postStartWith, sessionTrack, sessionLevel, sessionType, sessionLocation, listingType, sessionDate, featuredSession);
      }
    });

    $(document).on('keypress', '.browse-sessions-filter .search-item .search, .browse-open-to-all-filter .search-item .search', function (e) {
      if (13 === e.which) {
        pageNumber = 1;
        nabAjaxForBrowseSession(sessionItem, 'browse-filter', pageNumber, postStartWith, sessionTrack, sessionLevel, sessionType, sessionLocation, listingType, sessionDate, featuredSession);
      }
    });

    $(document).on('click', '#load-more-sessions a', function () {
      pageNumber = parseInt($(this).attr('data-page-number'));
      nabAjaxForBrowseSession(sessionItem, 'load-more', pageNumber, postStartWith, sessionTrack, sessionLevel, sessionType, sessionLocation, listingType, sessionDate, featuredSession);
    });

    $(document).on('click', '.browse-sessions-filter .featured-btn', function () {
      $(this).toggleClass('active');
      featuredSession = $(this).hasClass('active') ? 'featured' : '';
      pageNumber = 1;
      nabAjaxForBrowseSession(sessionItem, 'browse-filter', pageNumber, postStartWith, sessionTrack, sessionLevel, sessionType, sessionLocation, listingType, sessionDate, featuredSession);
    });

    $(document).on('click', '.browse-sessions-filter .alphabets-list li:not(".clear")', function () {

      $(this).addClass('active').siblings().removeClass('active');
      if (0 < $(this).parent().find('li.active').length) {
        $(this).siblings('.clear').show();
      }

      if (postStartWith !== $(this).text()) {
        postStartWith = $(this).text();
        pageNumber = 1;
        nabAjaxForBrowseSession(sessionItem, 'browse-filter', pageNumber, postStartWith, sessionTrack, sessionLevel, sessionType, sessionLocation, listingType, sessionDate, featuredSession);
      }
    });

    $(document).on('click', '.browse-sessions-filter .alphabets-list li.clear', function () {
      $(this).hide().siblings().removeClass('active');
      postStartWith = '';
      pageNumber = 1;
      nabAjaxForBrowseSession(sessionItem, 'browse-filter', pageNumber, postStartWith, sessionTrack, sessionLevel, sessionType, sessionLocation, listingType, sessionDate, featuredSession);
    });
    if (0 < $('.browse-sessions-filter #session-date').length || 0 < $('.browse-open-to-all-filter #session-date').length) {
      $(window).load(function () {
        $('.browse-sessions-filter #session-date, .browse-open-to-all-filter #session-date').datepicker({ dateFormat: 'DD, MM d, yy' }).on('change', function () {
          pageNumber = 1;
          sessionDate = $(this).val();
          nabAjaxForBrowseSession(sessionItem, 'browse-filter', pageNumber, postStartWith, sessionTrack, sessionLevel, sessionType, sessionLocation, listingType, sessionDate, featuredSession);
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

    $(document).on('change', '.browse-exhibitors-filter .browse-select #exhibitor-category', function () {
      let currentCategory = 0 === $(this)[0].selectedIndex ? '' : $(this).val();
      if (exhibitorCategory !== currentCategory) {
        exhibitorPageNumber = 1;
        exhibitorCategory = currentCategory;
        nabAjaxForBrowseExhibitors(false, exhibitorPageNumber, exhibitorStartWith, exhibitorCategory, exhibitorHall, exhibitorPavilion, exhibitorTechnology);
      }
    });

    $(document).on('change', '.browse-exhibitors-filter .browse-select #exhibitor-hall', function () {
      let currentHall = 0 === $(this)[0].selectedIndex ? '' : $(this).val();
      if (exhibitorHall !== currentHall) {
        exhibitorPageNumber = 1;
        exhibitorHall = currentHall;
        nabAjaxForBrowseExhibitors(false, exhibitorPageNumber, exhibitorStartWith, exhibitorCategory, exhibitorHall, exhibitorPavilion, exhibitorTechnology);
      }
    });

    $(document).on('change', '.browse-exhibitors-filter .browse-select #exhibitor-pavilion', function () {
      let currentPavilion = 0 === $(this)[0].selectedIndex ? '' : $(this).val();
      if (exhibitorPavilion !== currentPavilion) {
        exhibitorPageNumber = 1;
        exhibitorPavilion = currentPavilion;
        nabAjaxForBrowseExhibitors(false, exhibitorPageNumber, exhibitorStartWith, exhibitorCategory, exhibitorHall, exhibitorPavilion, exhibitorTechnology);
      }
    });

    $(document).on('change', '.browse-exhibitors-filter .browse-select #exhibitor-technology', function () {
      let currentTechnology = 0 === $(this)[0].selectedIndex ? '' : $(this).val();
      if (exhibitorTechnology !== currentTechnology) {
        exhibitorPageNumber = 1;
        exhibitorTechnology = currentTechnology;
        nabAjaxForBrowseExhibitors(false, exhibitorPageNumber, exhibitorStartWith, exhibitorCategory, exhibitorHall, exhibitorPavilion, exhibitorTechnology);
      }
    });

    $(document).on('keypress', '.browse-exhibitors-filter .search-item .search', function (e) {
      if (13 === e.which) {
        exhibitorPageNumber = 1;
        nabAjaxForBrowseExhibitors(false, exhibitorPageNumber, exhibitorStartWith, exhibitorCategory, exhibitorHall, exhibitorPavilion, exhibitorTechnology);
      }
    });

    $(document).on('click', '#load-more-exhibitor a', function () {
      exhibitorPageNumber = parseInt($(this).attr('data-page-number'));
      nabAjaxForBrowseExhibitors(true, exhibitorPageNumber, exhibitorStartWith, exhibitorCategory, exhibitorHall, exhibitorPavilion, exhibitorTechnology);
    });

    $(document).on('click', '.browse-exhibitors-filter .featured-btn', function () {
      $(this).toggleClass('active');
      exhibitorPageNumber = 1;
      nabAjaxForBrowseExhibitors(false, exhibitorPageNumber, exhibitorStartWith, exhibitorCategory, exhibitorHall, exhibitorPavilion, exhibitorTechnology);
    });

    $(document).on('click', '.browse-exhibitors-filter .alphabets-list li:not(".clear")', function () {

      $(this).addClass('active').siblings().removeClass('active');
      if (0 < $(this).parent().find('li.active').length) {
        $(this).siblings('.clear').show();
      }

      if (exhibitorStartWith !== $(this).text()) {
        exhibitorStartWith = $(this).text();
        exhibitorPageNumber = 1;
        nabAjaxForBrowseExhibitors(false, exhibitorPageNumber, exhibitorStartWith, exhibitorCategory, exhibitorHall, exhibitorPavilion, exhibitorTechnology);
      }
    });

    $(document).on('click', '.browse-exhibitors-filter .alphabets-list li.clear', function () {
      $(this).hide().siblings().removeClass('active');
      exhibitorStartWith = '';
      exhibitorPageNumber = 1;
      nabAjaxForBrowseExhibitors(false, exhibitorPageNumber, exhibitorStartWith, exhibitorCategory, exhibitorHall, exhibitorPavilion, exhibitorTechnology);
    });

    $(document).on('change', '.browse-exhibitors-filter .exhibitor-keywords', function () {
      exhibitorPageNumber = 1;
      nabAjaxForBrowseExhibitors(false, exhibitorPageNumber, exhibitorStartWith, exhibitorCategory, exhibitorHall, exhibitorPavilion, exhibitorTechnology);
    });

    $(document).on('click', '.browse-exhibitors-filter .orderby', function () {
      $(this).toggleClass('active');
      exhibitorPageNumber = 1;
      nabAjaxForBrowseExhibitors(false, exhibitorPageNumber, exhibitorStartWith, exhibitorCategory, exhibitorHall, exhibitorPavilion, exhibitorTechnology);
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

    $(document).on('change', '.browse-speakers-filter #speaker-company', function () {
      let currentCompany = 0 === $(this)[0].selectedIndex ? '' : $(this).val();
      if (speakerCompany !== currentCompany) {
        speakerPageNumber = 1;
        speakerCompany = currentCompany;
        nabAjaxForBrowseSpeakers(false, speakerPageNumber, speakerStartWith, speakerCompany, featuredSpeaker);
      }
    });

    $(document).on('keypress', '.browse-speakers-filter .search-item .search', function (e) {
      if (13 === e.which) {
        speakerPageNumber = 1;
        nabAjaxForBrowseSpeakers(false, speakerPageNumber, speakerStartWith, speakerCompany, featuredSpeaker);
      }
    });

    $(document).on('keypress', '.browse-speakers-filter .speaker-title-search', function (e) {
      if (13 === e.which) {
        speakerPageNumber = 1;
        nabAjaxForBrowseSpeakers(false, speakerPageNumber, speakerStartWith, speakerCompany, featuredSpeaker);
      }
    });

    $(document).on('click', '#load-more-speaker a', function () {
      speakerPageNumber = parseInt($(this).attr('data-page-number'));
      nabAjaxForBrowseSpeakers(true, speakerPageNumber, speakerStartWith, speakerCompany, featuredSpeaker);
    });

    $(document).on('click', '.browse-speakers-filter .featured-btn', function () {
      $(this).toggleClass('active');
      speakerPageNumber = 1;
      featuredSpeaker = $(this).hasClass('active') ? 'featured' : '';
      nabAjaxForBrowseSpeakers(false, speakerPageNumber, speakerStartWith, speakerCompany, featuredSpeaker);
    });

    $(document).on('click', '.browse-speakers-filter .alphabets-list li:not(".clear")', function () {

      $(this).addClass('active').siblings().removeClass('active');
      if (0 < $(this).parent().find('li.active').length) {
        $(this).siblings('.clear').show();
      }

      if (speakerStartWith !== $(this).text()) {
        speakerStartWith = $(this).text();
        speakerPageNumber = 1;
        nabAjaxForBrowseSpeakers(false, speakerPageNumber, speakerStartWith, speakerCompany, featuredSpeaker);
      }
    });

    $(document).on('click', '.browse-speakers-filter .alphabets-list li.clear', function () {
      $(this).hide().siblings().removeClass('active');
      speakerStartWith = '';
      speakerPageNumber = 1;
      nabAjaxForBrowseSpeakers(false, speakerPageNumber, speakerStartWith, speakerCompany, featuredSpeaker);
    });

    $(document).on('click', '.browse-speakers-filter .orderby', function () {
      $(this).toggleClass('active');
      speakerPageNumber = 1;
      nabAjaxForBrowseSpeakers(false, speakerPageNumber, speakerStartWith, speakerCompany, featuredSpeaker);
    });
    if (0 < $('.browse-speakers-filter #speaker_date').length) {
      $(window).load(function () {
        $('.browse-speakers-filter #speaker_date').datepicker({ dateFormat: 'MM, dd yy' }).on('change', function () {
          speakerPageNumber = 1;
          nabAjaxForBrowseSpeakers(false, speakerPageNumber, speakerStartWith, speakerCompany, featuredSpeaker);
        });
      });
    }
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
      if ($('.browse-happenings-filter .featured-btn').hasClass('active')) {
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
      if ('' !== $(this).data('open') && 'select' !== $(this).data('open').toLowerCase() && 0 < $('.browse-learn-filter #open-to').length) {
        insertOptions($(this).data('open'), 'open-to');
      }
      if ('' !== $(this).find('.info-block .date_group').text() && 0 < $('.browse-learn-filter #page-date').length) {
        insertOptions($(this).find('.info-block .date_group').text(), 'page-date');
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

    $(document).on('change', '.browse-learn-filter #open-to', function () {
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
    jQuery('#related-content-list h2.title:visible').filter(function () { return (pageStartWith !== jQuery(this).text()[0].toUpperCase()); }).parents('.col-lg-4.col-md-6').hide();
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
    let happeningDate = 0 === jQuery('.browse-learn-filter #page-date')[0].selectedIndex ? '' : jQuery('.browse-learn-filter #page-date').val().toLowerCase();
    if ('' !== happeningDate) {
      jQuery('#related-content-list span.date_group').filter(function () { return (happeningDate !== jQuery(this).text().toLowerCase()); }).parents('.col-lg-4.col-md-6').hide();
    }
  }

  if (0 < jQuery('.browse-learn-filter #open-to').length && 0 !== jQuery('.browse-learn-filter #open-to')[0].selectedIndex) {
    let openTo = jQuery('.browse-learn-filter #open-to').val();
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

function nabAjaxForBrowseSpeakers(filterType, speakerPageNumber, speakerStartWith, speakerCompany, featuredSpeaker) {
  let postPerPage = jQuery('#load-more-speaker a').attr('data-post-limit') ? parseInt(jQuery('#load-more-speaker a').attr('data-post-limit')) : 10,
    jobTitleSearch = jQuery('.browse-speakers-filter .speaker-title-search').val(),
    postSearch = jQuery('.browse-speakers-filter .search-item .search').val(),
    speakerDate = 0 < jQuery('.browse-speakers-filter #speaker_date').length ? jQuery('.browse-speakers-filter #speaker_date').val() : '',
    orderBy = jQuery('.browse-speakers-filter .orderby').hasClass('active') ? 'title' : 'date';

  jQuery('body').addClass('popup-loader');


  jQuery.ajax({
    type: 'GET',
    data: 'action=speakers_browse_filter&page_number=' + speakerPageNumber + '&browse_filter_nonce=' + nabshowLvCustom.nabshow_lv_browse_filter_nonce + '&post_limit=' + postPerPage + '&post_start=' + speakerStartWith + '&post_search=' + postSearch + '&speaker_company=' + speakerCompany + '&speaker_order=' + orderBy + '&speaker_job=' + jobTitleSearch + '&speaker_date=' + speakerDate + '&featured_speaker=' + featuredSpeaker,
    url: nabshowLvCustom.ajax_url,
    success: function (speakerData) {

      let speakerObj = jQuery.parseJSON(speakerData);

      if (! filterType) {
        jQuery('#browse-speaker').empty();
      }

      jQuery.each(speakerObj.result_post, function (key, value) {

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

function nabAjaxForBrowseExhibitors(filterType, exhibitorPageNumber, exhibitorStartWith, exhibitorCategory, exhibitorHall, exhibitorPavilion, exhibitorTechnology) {

  let postPerPage = jQuery('#load-more-exhibitor a').attr('data-post-limit') ? parseInt(jQuery('#load-more-exhibitor a').attr('data-post-limit')) : 10;
  let postSearch = jQuery('.browse-exhibitors-filter .search-item .search').val();
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
    data: 'action=exhibitors_browse_filter&page_number=' + exhibitorPageNumber + '&browse_filter_nonce=' + nabshowLvCustom.nabshow_lv_browse_filter_nonce + '&post_limit=' + postPerPage + '&post_start=' + exhibitorStartWith + '&post_search=' + postSearch + '&exhibitor_category=' + exhibitorCategory + '&exhibitor_hall=' + exhibitorHall + '&exhibitor_pavilion=' + exhibitorPavilion + '&exhibitor_keywords=' + keywords + '&exhibitor_order=' + orderBy + '&exhibitor_technology=' + exhibitorTechnology,
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


function nabAjaxForBrowseSession(sessionItem, filterType, pageNumber, postStartWith, sessionTrack, sessionLevel, sessionType, sessionLocation, listingType, sessionDate, featuredSession) {
  let postPerPage = jQuery('#load-more-sessions a').attr('data-post-limit') ? parseInt(jQuery('#load-more-sessions a').attr('data-post-limit')) : 10;
  let postSearch = 0 < jQuery('.browse-open-to-all-filter .search-item .search').length ? jQuery('.browse-open-to-all-filter .search-item .search').val() : jQuery('.browse-sessions-filter .search-item .search').val();

  jQuery('body').addClass('popup-loader');

  if ('load-more' !== filterType) {
    jQuery('#browse-session').empty();
  }

  jQuery.ajax({
    type: 'GET',
    data: 'action=sessions_browse_filter&page_number=' + pageNumber + '&browse_filter_nonce=' + nabshowLvCustom.nabshow_lv_browse_filter_nonce + '&post_limit=' + postPerPage + '&post_start=' + postStartWith + '&post_search=' + postSearch + '&track=' + sessionTrack + '&level=' + sessionLevel + '&session_type=' + sessionType + '&location=' + sessionLocation + '&listing_type=' + listingType + '&session_date=' + sessionDate + '&featured_session=' + featuredSession,
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

function CustomMasonryGrids() {
  var colCount, colHeight, i, mainDiv, highest, order, divHeight;
  colHeight = [];
  mainDiv = document.getElementsByClassName('box-main');

  if (5 < mainDiv[0].children.length) {

    jQuery('.box-main .box-item').css({ opacity: '0', transform: 'scale(0.8, 0.8)' });
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
  if (0 != jQuery('.accordionParentWrapper').length) {
    jQuery(selectedItem).removeClass('slideInUp').show();
  }
  jQuery('.no-data').hide();
  if (0 != jQuery('.badge-discounts-box').length) {
    jQuery('.badge-discounts, .badge-discounts .badge-title').show();
  }
  if (0 != jQuery('.accordionParentWrapper').length) {
    jQuery('.accordionParentWrapper').show();
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
    jQuery(`.news-conference-schedule ${selectedItem}`).show();
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

  let filterSearch, comparedItem, filterMainData, filterBoothData, filterVendorData, filterFaqData, filterAwardData, filterDate, filterTime, filterLocation, filterType, filterDepartment, filterProduct, filterCName, filterCDate, filterCLocation, filterSubCat, filterCost, filterExclusive, filterAvailable, filterMainCat, filterMediaTopics, filterMediaFormats, filterMediaLocation;

  if (0 < jQuery('#box-main-category').length) {
    filterMainData = 0 < jQuery('#box-main-category')[0].selectedIndex ? jQuery('#box-main-category').val() : null;
  }
  if (0 < jQuery('#box-main-category-booth').length) {
    filterBoothData = 0 < jQuery('#box-main-category-booth')[0].selectedIndex ? jQuery('#box-main-category-booth').val() : null;
  }
  if (0 < jQuery('#box-main-category-vendor').length) {
    filterVendorData = 0 < jQuery('#box-main-category-vendor')[0].selectedIndex ? jQuery('#box-main-category-vendor').val() : null;
  }
  if (0 < jQuery('#faq-category-drp').length) {
    filterFaqData = 0 < jQuery('#faq-category-drp')[0].selectedIndex ? jQuery('#faq-category-drp').val() : null;
  }
  if (0 < jQuery('#award-name').length) {
    filterAwardData = 0 < jQuery('#award-name')[0].selectedIndex ? jQuery('#award-name').val() : null;
  }
  if (0 < jQuery('.schedule-main').length) {
    filterDate = 0 < jQuery('.schedule-glance-filter .schedule-select #date')[0].selectedIndex ? jQuery('.schedule-glance-filter .schedule-select #date').val() : null;
    filterTime = 0 < jQuery('.schedule-glance-filter .schedule-select #pass-type')[0].selectedIndex ? jQuery('.schedule-glance-filter .schedule-select #pass-type').val() : null;
    filterLocation = 0 < jQuery('.schedule-glance-filter .schedule-select #location')[0].selectedIndex ? jQuery('.schedule-glance-filter .schedule-select #location').val() : null;
    filterType = 0 < jQuery('.schedule-glance-filter .schedule-select #type')[0].selectedIndex ? jQuery('.schedule-glance-filter .schedule-select #type').val() : null;
  }
  if (0 < jQuery('.meet-team-main.team-main').length) {
    filterDepartment = 0 < jQuery('.meet-team-select #team-department')[0].selectedIndex ? jQuery('.meet-team-select #team-department').val() : null;

    jQuery('#team-checkbox .checkbox-list input').parent().removeClass('checked');
    jQuery('#team-checkbox .checkbox-list input:checked').parent().addClass('checked');

    if (0 < jQuery('#team-checkbox .checkbox-list input:checked').length) {

      jQuery(`${selectedItem}`).hide();

      jQuery('#team-checkbox .checkbox-list input:checked').each(function () {
        jQuery(`${selectedItem}[data-category*="${jQuery(this).val()}"]`).hide().show();
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

  // Dropdown Filter
  if (null !== filterMainData && undefined !== filterMainData) {
    if (0 != jQuery(`${selectedItem}`).closest('.exhibitor-committee').length) {
      comparedItem = '.areas';
    } if (0 != jQuery(`${selectedItem}`).closest('.official-vendors').length || 0 != jQuery(`${selectedItem}`).closest('.new-this-year-block').length) {
      comparedItem = '.title';
    } if (0 != jQuery(`${selectedItem}`).closest('.delegation').length) {
      comparedItem = '.country';
    }
    jQuery(`${selectedItem} ${comparedItem}:not(:contains("${filterMainData}"))`).parents(`${selectedItem}`).hide();
  }

  if (null !== filterBoothData && undefined !== filterBoothData) {
    comparedItem = '.boothSize';
    jQuery(`${selectedItem} ${comparedItem}:not(:contains("${filterBoothData}"))`).parents(`${selectedItem}`).hide();
  }

  if (null !== filterVendorData && undefined !== filterVendorData) {
    comparedItem = '.companyName';
    jQuery(`${selectedItem} ${comparedItem}:not(:contains("${filterVendorData}"))`).parents(`${selectedItem}`).hide();
  }

  if (null !== filterFaqData && undefined !== filterFaqData) {
    comparedItem = '.title';
    jQuery(`${selectedItem} ${comparedItem}:not(:contains("${filterFaqData}"))`).parent(`${selectedItem}`).hide();
  }

  if (null !== filterAwardData && undefined !== filterAwardData) {
    comparedItem = '.awards-winner-title';
    if (0 < jQuery('.awards-main').length) {
      selectedItem = '.awards-main';
    }
    jQuery(`${comparedItem}:not(:contains("${filterAwardData}"))`).parents(`${selectedItem}`).hide();
  }
  if (null !== filterDate && undefined !== filterDate) {
    if (0 < jQuery('.schedule-main').length) {
      comparedItem = '.schedule-main h2';
    }
    jQuery(`${comparedItem}:not(:contains("${filterDate}"))`).parent().hide();
  }
  if (null !== filterTime && undefined !== filterTime) {
    if (0 < jQuery('.schedule-main').length) {
      comparedItem = '.date';
    }
    jQuery(` ${selectedItem} ${comparedItem}:not(:contains("${filterTime}"))`).parent(`${selectedItem}`).hide();
  }
  if (null !== filterLocation && undefined !== filterLocation) {
    if (0 < jQuery('.schedule-main').length) {
      comparedItem = '.location';
    }
    jQuery(` ${selectedItem} ${comparedItem}:not(:contains("${filterLocation}"))`).parent(`${selectedItem}`).hide();
  }
  if (null !== filterType && undefined !== filterType) {
    if (0 < jQuery('.schedule-main').length) {
      comparedItem = '.details';
    }
    jQuery(` ${selectedItem} ${comparedItem}:not(:contains("${filterType}"))`).parent(`${selectedItem}`).hide();
  }
  if (null !== filterDepartment && undefined !== filterDepartment) {
    if (0 < jQuery('.meet-team-main').length) {
      jQuery(`.meet-team-main ${selectedItem}:not([data-department="${filterDepartment}"])`).hide();
    }
  }
  if (null !== filterProduct && undefined !== filterProduct) {
    jQuery(`${selectedItem}:not(:contains("${filterProduct}"))`).parent().hide();
  }
  if (null !== filterCName && undefined !== filterCName) {
    jQuery(`${selectedItem} .title:not(:contains("${filterCName}"))`).parents(`${selectedItem}`).hide();
  }
  if (null !== filterCDate && undefined !== filterCDate) {
    jQuery(`${selectedItem} .date-time:not(:contains("${filterCDate}"))`).parents(`${selectedItem}`).hide();
  }
  if (null !== filterCLocation && undefined !== filterCLocation) {
    jQuery(`${selectedItem} .location:not(:contains("${filterCLocation}"))`).parents(`${selectedItem}`).hide();
  }
  if (null !== filterMainCat && undefined !== filterMainCat) {
    if (0 < jQuery('#main-category-type').length) {
      selectedItem = '.related-main-wrapper';
    }
    jQuery(`.sponsorship-opportunities-page ${selectedItem} .parent-main-title:not(:contains("${filterMainCat}"))`).parents(`${selectedItem}`).addClass('Juhi').hide();
  }
  if (null !== filterSubCat && undefined !== filterSubCat) {
    if (0 < jQuery('#sub-category-type').length) {
      selectedItem = '.opportunities';
    } else {
      selectedItem = '.box-item';
    }
    jQuery(`${selectedItem} .main-title:not(:contains("${filterSubCat}"))`).parents(`${selectedItem}`).hide();
  }
  if (null !== filterCost && undefined !== filterCost) {
    if (0 < jQuery('.opportunities').length) {
      selectedItem = '.box-item';
    }
    jQuery(`${selectedItem} .cost:not(:contains("${filterCost}"))`).parents(`${selectedItem}`).hide();
  }
  if (null !== filterExclusive && undefined !== filterExclusive) {
    jQuery(`${selectedItem} .exclusivity:not(:contains("${filterExclusive}"))`).parents(`${selectedItem}`).hide();
  }
  if (null !== filterAvailable && undefined !== filterAvailable) {
    if (0 < jQuery('.opportunities').length) {
      selectedItem = '.box-item';
    }
    if ('Available' === filterAvailable) {
      jQuery(`${selectedItem}.visible`).hide();
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
    jQuery(`${selectedItem}:not([data-topics*="${filterMediaTopics}"])`).hide();
  }
  if (null !== filterMediaFormats && undefined !== filterMediaFormats) {
    jQuery(`${selectedItem}:not([data-formats*="${filterMediaFormats}"])`).hide();
  }
  if (null !== filterMediaLocation && undefined !== filterMediaLocation) {
    jQuery(`${selectedItem}:not([data-locations*="${filterMediaLocation}"])`).hide();
  }


  // Alphabet filter
  if (0 != jQuery('.alphabets-list li').length && null !== selectedLetter && undefined !== selectedLetter) {
    jQuery('ul.alphabets-list li:not(.clear)').removeClass('active');
    jQuery('ul.alphabets-list li:not(.clear):contains("' + selectedLetter + '")').addClass('active');
    jQuery('ul.alphabets-list li.clear').show();

    alphabetsFilter();

    if ('Clear' === selectedLetter) {
      jQuery('.products-winners .product-main .product-item').show();
      jQuery('ul.alphabets-list li.clear').hide();
      jQuery('ul.alphabets-list li:not(.clear)').removeClass('active');
    }

  }
  function alphabetsFilter() {
    jQuery('.products-winners .product-item')
      .filter(function () {
        return (
          jQuery('.alphabets-list li:not(.clear).active').text().toLowerCase() != jQuery('.subtitle', this).text().toLowerCase().charAt(0)
        );
      }).hide();
  }

  // Search Filter
  filterSearch = jQuery(searchId).val();
  if (0 != jQuery('.accordionParentWrapper').length) {
    searchKeyword = '.accordionHeader h3';
  }
  if (0 != jQuery('.badge-discounts-box').length) {
    selectedItem = '.badge-discounts:visible .box-item:visible';
  }
  if (0 < jQuery('.awards-main').length) {
    searchKeyword = '.winnerName h3';
    selectedItem = '.wp-block-nab-awards-item';
  }
  if (0 < jQuery('.schedule-main').length) {
    searchKeyword = '.name';
  }
  if (0 < jQuery('.products-winners').length) {
    selectedItem = '.product-item';
  }

  if ('' !== filterSearch && undefined !== filterSearch) {
    jQuery(`${selectedItem}`)
      .filter(function () {
        return (
          0 >
          jQuery(`${searchKeyword}`, this).text().toLowerCase().indexOf(filterSearch.toLowerCase())
        );
      })
      .hide();
  }


  // Square Select Filter
  if (jQuery('.committee-filter .badgeslist a').hasClass('active')) {
    jQuery(selectedItem).not('.International').hide();
  }
  if (jQuery('.official-vendors-filter .badgeslist a').hasClass('active')) {
    jQuery(`${selectedItem} .type:not(:contains("${jQuery('.ov-filter .badgeslist a.active').text()}"))`).parents(`${selectedItem}`).hide();
  }
  if (jQuery('.badge-discount-filter .badgeslist a').hasClass('active')) {
    jQuery(`.badge-discounts .badge-title:not(:contains("${jQuery('.badge-discount-filter .badgeslist a.active').text()}"))`).parent().hide();
  }
  if (jQuery('.exhibitor-resources-main .badgeslist a').hasClass('active')) {
    jQuery(`.related-main-wrapper .parent-main-title:not(:contains("${jQuery('.exhibitor-resources-main .badgeslist a.active').text()}"))`).parent().hide();
  }

  if (0 != jQuery('.badge-discounts').length) {
    selectedItem = '.badge-discounts';
    jQuery(`${selectedItem}`)
      .not(function () {
        return 0 < jQuery(this).find('.box-item:visible').length;
      })
      .hide();
  }
  if (0 != jQuery('.accordionParentWrapper').length) {
    selectedItem = '.accordionParentWrapper';
    jQuery(`${selectedItem}`)
      .not(function () {
        return 0 < jQuery(this).find('.accordionHeader h3:visible').length;
      })
      .hide();
  }
  if (0 != jQuery('.awards-main').length) {
    selectedItem = '.awards-main';
    jQuery(`${selectedItem}`)
      .not(function () {
        return 0 < jQuery(this).find('.wp-block-nab-awards-item:visible').length;
      })
      .hide();
  }
  if (0 != jQuery('.schedule-main').length) {
    selectedItem = '.schedule-main';
    jQuery(`${selectedItem}`)
      .not(function () {
        return 0 < jQuery(this).find('.schedule-row:visible').length;
      })
      .hide();
  }
  if (0 < jQuery('.products-winners').length) {
    selectedItem = '.products-winners';
    jQuery(`${selectedItem}`)
      .not(function () {
        return 0 < jQuery(this).find('.product-item:visible').length;
      })
      .hide();
  }
  if (0 != jQuery('.opportunities').length) {
    selectedItem = '.opportunities';
    jQuery(`${selectedItem}`)
      .not(function () {
        return 0 < jQuery(this).find('.box-item:visible').length;
      })
      .hide();
  }
  if (0 != jQuery('.main-exhibitor-block .related-main-wrapper').length) {
    selectedItem = '.main-exhibitor-block .related-main-wrapper';
    jQuery(`${selectedItem}`)
      .not(function () {
        return 0 < jQuery(this).find('.col-lg-4.col-md-6:visible').length;
      })
      .hide();
  }
  if (0 != jQuery('.sponsorship-opportunities-page .related-main-wrapper').length) {
    selectedItem = '.sponsorship-opportunities-page .related-main-wrapper';
    jQuery(`${selectedItem}`)
      .not(function () {
        return 0 < jQuery(this).find('.box-item:visible').length;
      })
      .hide();
  }

  if (0 === jQuery(`${selectedItem}:visible`).length) {
    if (0 === jQuery('.no-data').length) {
      createResultNotFoundNode(`${selectedItem}`);
    } else {
      jQuery('.no-data').show();
    }
  }
}