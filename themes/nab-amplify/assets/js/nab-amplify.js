/**
 * Wonderwall Public front side javascripts codes are written in this file.
 *
 *  @package Nab
 */
(function ($) {
  // Start code here

  $(document).on( 'click', '.product-head .product-layout span', function() {
    
    $('.product-head .product-layout span').removeClass('active');
    $(this).addClass('active');

    if( $(this).hasClass('grid') ) {
      $('.product-list').removeClass('layout-list');
      $('.product-list').addClass('layout-grid');
    } else {
      $('.product-list').addClass('layout-list');
      $('.product-list').removeClass('layout-grid');
    }

  });

  // Related products

  if (3 < $('.related.products .product-list .product-item').length) {
    buildSliderConfiguration();
    $(window).on('resize', function(){
     buildSliderConfiguration();
    });
  }
  

  function buildSliderConfiguration() {
   $('.related.products .product-list').each(function () {
      var windowWidth = $(window).width();
      var numberOfVisibleSlides;
      if (windowWidth < 420) {
          numberOfVisibleSlides = 1;
      } else if (windowWidth < 768) {
          numberOfVisibleSlides = 2;
      } else if (windowWidth < 1200) {
          numberOfVisibleSlides = 3;
      } else {
          numberOfVisibleSlides = 4;
      }
      $(this).bxSlider({
        mode: 'horizontal',
        auto: false,
        speed: 500,
        controls: true,
        infiniteLoop: true,
        pager: false,
        stopAutoOnClick: true,
        autoHover: true,
        slideWidth: 500,
        minSlides: numberOfVisibleSlides,
        maxSlides: numberOfVisibleSlides,
        slideMargin: 10

      });
    });
  }

})(jQuery);
