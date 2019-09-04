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

          onSlideAfter: function (
            currentSlideNumber,
            totalSlideQty,
            currentSlideHtmlObject
          ) {
            $('.nab-media-slider > .nab-media-slider-item').removeClass(
              `active-slide ${nabanimation}`
            );
            $('.nab-media-slider > .nab-media-slider-item')
              .eq(currentSlideHtmlObject)
              .addClass(`active-slide ${nabanimation}`);
          },
          onSliderLoad: function () {
            $('.nab-media-slider > .nab-media-slider-item')
              .eq(0)
              .addClass(`active-slide ${nabanimation}`);
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

  // nab-media-slider End

  // Adding Row in Session Masonry Js
  jQuery('.session.with-masonry').parent('div').addClass('row');

  // Award Section Popup Js
  jQuery('.nab_popup_btn').on('click', function () {
    jQuery(this).siblings('.nab_model_main').addClass('nab_model_open');
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
      $(this)
        .parent()
        .parent()
        .siblings()
        .find('.accordionBody')
        .slideUp();
      $(this)
        .parent()
        .next()
        .slideToggle();
      if (
        $(this)
          .parent()
          .parent('.accordionWrapper')
          .hasClass('tabClose')
      ) {
        $(this)
          .parent()
          .parent('.accordionWrapper')
          .removeClass('tabClose')
          .addClass('tabOpen');
        $(this)
          .parent()
          .parent('.accordionWrapper')
          .siblings()
          .removeClass('tabOpen')
          .addClass('tabClose');
      } else {
        $(this)
          .parent()
          .parent('.accordionWrapper')
          .removeClass('tabOpen')
          .addClass('tabClose');
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
    var cardsDiv,
      cloneCardsDiv,
      innerH2Tag,
      innerImgTag,
      innerCategory,
      dataObj,
      ajaxAction = 'nabshow_ntb_missed_load_more_category_click',
      _this = $(this),
      itemToFetch = $(this)
        .parents('.slider-arrow-main')
        .find('.nab-not-to-be-missed-slider')
        .attr('data-item');

    $(this)
      .parents('.slider-arrow-main')
      .find('.nab-not-to-be-missed-slider')
      .addClass('change-slide');
    $('#loader_container').show();

    jQuery.ajax({
      type: 'GET',
      data:
        'action=' +
        ajaxAction +
        '&fetch_item=' +
        itemToFetch +
        '&portfolio_category_term_slug=' +
        $(this).attr('data-term-slug') +
        '&term_data_nonce=' +
        nabshowNtbMissed.nabshow_lv_ntb_missed_nonce,
      url: nabshowNtbMissed.ajax_url,
      success: function (getData) {
        dataObj = jQuery.parseJSON(getData);
        _this
          .parents('.slider-arrow-main')
          .find('.nab-not-to-be-missed-slider .cards')
          .removeClass('bx-clone');
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
              _this
                .parents('.slider-arrow-main')
                .find('.nab-not-to-be-missed-slider')
                .attr('id')
            );

            if (0 === key) {
              _this
                .parents('.slider-arrow-main')
                .find('.nab-not-to-be-missed-slider')
                .empty();
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
          bxSliderObj[index].reloadSlider(config);
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
      insertOptions(
        $(this)
          .find('h2')
          .text(),
        'date'
      );

      $(this)
        .find('.schedule-row')
        .each(function () {
          insertOptions(
            $(this)
              .find('.date p')
              .text(),
            'pass-type'
          );
          insertOptions(
            $(this)
              .find('.location p')
              .text(),
            'location'
          );
          insertOptions(
            $(this)
              .find('.details p')
              .text(),
            'type'
          );
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
      if (
        null !==
        $(this)
          .data('category')
          .split(',')
      ) {
        $.map(
          $(this)
            .data('category')
            .split(','),
          function (val, i) {
            insertCheckbox(val, 'team-checkbox');
          }
        );
      }

      if ('' !== $(this).attr('data-department')) {
        insertOptions($(this).attr('data-department'), 'team-department');
      }
    });

    $(document).on(
      'change',
      '.meet-team-select #team-department, .meet-team-select .checkbox-list input',
      function () {
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
      mode: elementHandler.attr('data-mode')
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

  $(document).on('click', '.session-data.schedule-main .row-expand .expand-btn', function(){
    if ( 'Expand' === $(this).text() ) {
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

})(jQuery);

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

      // console.log(mainDiv.children[i], divHeight, mainDiv.children[i].childNodes[1].childNodes[1].naturalHeight);

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

/**
 * Schedule at a glance Search functionality
 */
function filterScheduleData() {
  jQuery('.schedule-main, .schedule-main .schedule-row').show();
  jQuery('.no-data').hide();

  let filterDate =
    0 <
      jQuery('.schedule-glance-filter .schedule-select #date')[0].selectedIndex ?
      jQuery('.schedule-glance-filter .schedule-select #date').val() :
      null;
  let filterTime =
    0 <
      jQuery('.schedule-glance-filter .schedule-select #pass-type')[0]
        .selectedIndex ?
      jQuery('.schedule-glance-filter .schedule-select #pass-type').val() :
      null;
  let filterLocation =
    0 <
      jQuery('.schedule-glance-filter .schedule-select #location')[0]
        .selectedIndex ?
      jQuery('.schedule-glance-filter .schedule-select #location').val() :
      null;
  let filterType =
    0 <
      jQuery('.schedule-glance-filter .schedule-select #type')[0].selectedIndex ?
      jQuery('.schedule-glance-filter .schedule-select #type').val() :
      null;
  let filterSearch = jQuery('.schedule-glance-filter .schedule-search').val();

  if (null !== filterDate) {
    jQuery('.schedule-main h2:not(:contains("' + filterDate + '"))')
      .parents('.schedule-main')
      .hide();
  }
  if (null !== filterTime) {
    jQuery(
      '.schedule-main .schedule-row .date:not(:contains("' + filterTime + '"))'
    )
      .parents('.schedule-row')
      .hide();
  }
  if (null !== filterLocation) {
    jQuery(
      '.schedule-main .schedule-row .location:not(:contains("' +
      filterLocation +
      '"))'
    )
      .parents('.schedule-row')
      .hide();
  }
  if (null !== filterType) {
    jQuery(
      '.schedule-main .schedule-row .details:not(:contains("' +
      filterType +
      '"))'
    )
      .parents('.schedule-row')
      .hide();
  }
  if ('' !== filterSearch) {
    jQuery('.schedule-row:visible')
      .filter(function () {
        return (
          0 >
          jQuery('.name', this)
            .text()
            .toLowerCase()
            .indexOf(filterSearch.toLowerCase())
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
  jQuery('.team-main .team-box').show();
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
      jQuery('.team-main .team-box[data-category*="' + jQuery(this).val() + '"]').show();
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
  jQuery('.awards-main, .wp-block-nab-awards-item').show();
  jQuery('.no-data').hide();

  let filterAwardName =
    0 <
      jQuery('#award-name')[0].selectedIndex ?
      jQuery('#award-name').val() :
      null;

  if (null !== filterAwardName) {
    jQuery('.awards-header').each(function () {
      if (jQuery(this).has('.awards-winner-title').length) {
        jQuery('.awards-header .awards-winner-title:not(:contains("' + filterAwardName + '"))')
          .parents('.awards-main')
          .hide();
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
          0 >
          jQuery('.winnerName', this)
            .text()
            .toLowerCase()
            .indexOf(filterSearch.toLowerCase())
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
  jQuery('.product-main .product-item, .products-winners').show();
  jQuery('.no-data').hide();

  let filterAwardName = 0 < jQuery('#products-category')[0].selectedIndex ? jQuery('#products-category').val() : null;

  if (null !== filterAwardName) {
    jQuery('.products-winners:visible .product-title:not(:contains("' + filterAwardName + '"))').parents('.products-winners').hide();
    if (jQuery('.alphabets-list li:not(.clear)').hasClass('active')) {
      alphabetsFilter();
    }
  }

  let filterSearch = jQuery('#products-search').val();

  if ('' !== filterSearch) {
    jQuery('.product-item:visible')
      .filter(function () {
        return (
          0 > jQuery('.title a', this).text().toLowerCase().indexOf(filterSearch.toLowerCase())
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
          jQuery('.alphabets-list li:not(.clear).active').text().toLowerCase() != jQuery('.title a', this).text().toLowerCase().charAt(0)
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
    jQuery('.accordionParentWrapper:visible h2.title:not(:contains("' + filterAwardName + '"))').parents('.accordionParentWrapper').hide();
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
