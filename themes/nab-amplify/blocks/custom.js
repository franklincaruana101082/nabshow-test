(function ($) {
  'use strict'

  // start front js here

  $('.community-curator .grid-list .item .inner .item-list-main .left').click(function () {
    let imageUrl = $(this).parents('.inner').find("img.main-image").attr("src");
    let title = $(this).parents('.inner').find(".title").html();
    let subTitle = $(this).parents('.inner').find(".sub-title").html();
    let description = $(this).parents('.inner').find(".description").html();
    let button = $(this).parents('.inner').find(".button-wrap").html();

    $('.community-curator .grid-list .item').removeClass('active');
    $(this).parents('.item').addClass('active');
    $('.community-curator .big-section').css('background-image', 'url(' + imageUrl + ')');
    $(".community-curator .big-section .title").html(title);
    $(".community-curator .big-section .sub-title").html(subTitle);
    $(".community-curator .big-section .description").html(description);
    
    if (button != 'undefined') {
      $(".community-curator .big-section .button-wrap").html(button);
    } else {
      $(".community-curator .big-section .button-wrap").hide();
    }
  })
})(jQuery);
