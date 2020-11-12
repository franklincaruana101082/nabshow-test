(function ($) {
  'use strict'

  // start front js here

  $('.community-curator .grid-list .item .inner').click(function () {
    let imageUrl = $(this).find("img.main-image").attr("src");
    let title = $(this).find(".title").html();
    let subTitle = $(this).find(".sub-title").html();
    let description = $(this).find(".description").html();

    $('.community-curator .grid-list .item').removeClass('active');
    $(this).parent('.item').addClass('active');
    $('.community-curator .big-section').css('background-image', 'url(' + imageUrl + ')');
    $(".community-curator .big-section .title").html(title);
    $(".community-curator .big-section .sub-title").html(subTitle);
    $(".community-curator .big-section .description").html(description);
  })
})(jQuery)
