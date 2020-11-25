(function ($) {
  'use strict'

  // start front js here

  $('.community-curator .grid-list .item .inner .item-list-main .left').click(function () {
    let imageUrl = $(this).parents('.inner').find("img.main-image").attr("src");
    let title = $(this).parents('.inner').find(".title").html();
    let subTitle = $(this).parents('.inner').find(".sub-title").html();
    let description = $(this).parents('.inner').find(".description").html();
    let button = $(this).parents('.inner').find(".button-wrap").html();

    $(this).parents('.item').addClass('active').siblings().removeClass('active');
    if (imageUrl != 'undefined') {
      $(this).parents('.community-curator').find('.big-section').css('background-image', 'url(' + imageUrl + ')');
    }
    $(this).parents('.community-curator').find(".big-section .title").html(title);
    $(this).parents('.community-curator').find(".big-section .sub-title").html(subTitle);
    $(this).parents('.community-curator').find(".big-section .description").html(description);
    
    if (button != 'undefined') {
      $(this).parents('.community-curator').find(".big-section .button-wrap").html(button);
    } else {
      $(this).parents('.community-curator').find(".big-section .button-wrap").hide();
    }
  })
})(jQuery);
