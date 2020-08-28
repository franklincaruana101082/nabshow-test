/**
 * Wonderwall Public front side javascripts codes are written in this file.
 *
 *  @package Nab
 */
(function ($) {

    $(document).ready(function () {
        HeaderResponsive();

        $(window).on('resize', function () {
            HeaderResponsive();
        });
    });

    // on load
    $(window).load(function () {

        $('.video_added').removeClass('woocommerce-product-gallery__image');

        /*$('.custom_thumb.video_added').fancybox({
            'width': 600,
            'height': 250,
            'transitionIn': 'elastic', // this option is for v1.3.4
            'transitionOut': 'elastic', // this option is for v1.3.4
            // if using v2.x AND set class fancybox.iframe, you may not need this
            'type': 'iframe',
            // if you want your iframe always will be 600x250 regardless the viewport size
            'fitToView' : false  // use autoScale for v1.3.4
        });*/
    });


    $(document).on('click', '.product-head .product-layout span', function () {

        $('.product-head .product-layout span').removeClass('active');
        $(this).addClass('active');

        if ($(this).hasClass('grid')) {
            $('.product-list').removeClass('layout-list');
            $('.product-list').addClass('layout-grid');
        } else {
            $('.product-list').addClass('layout-list');
            $('.product-list').removeClass('layout-grid');
        }

    });

    // Upload user images using ajax.
    $('#profile_picture_file, #banner_image_file').on('change', function (e) {

        e.preventDefault();
        $(this).parent().addClass('loading');

        var fd = new FormData();
        var file = $(this);
        var file_name = $(this).attr('name');
        var individual_file = file[0].files[0];
        fd.append(file_name, individual_file);
        fd.append('action', 'nab_amplify_upload_images');

        jQuery.ajax({
            type: 'POST',
            url: amplifyJS.ajaxurl,
            data: fd,
            contentType: false,
            processData: false,
            success: function () {
                location.reload();
            }
        });
    });

    // Remove user images using ajax.
    $('#profile_picture_remove, #banner_image_remove').on('change', function (e) {

        e.preventDefault();
        $(this).parents('.flex-box').find('.user-image-box').addClass('loading');

        jQuery.ajax({
            type: 'POST',
            url: amplifyJS.ajaxurl,
            data: {
                action: 'nab_amplify_remove_images',
                name: $(this).attr('name')
            },
            success: function (data) {
                location.reload();
            }
        });
    });

    $(window).on('resize', function () {
        console.log("resize");
    });

    // Related products
    if (4 < $('.related.products .product-list .product-item').length) {
        buildSliderConfiguration();

        $(window).on('resize', function () {
            buildSliderConfiguration();
        });
    }

    function buildSliderConfiguration() {
        $('.related.products .product-list').each(function () {
            var windowWidth = $(window).width();
            var numberOfVisibleSlides;
            if (windowWidth < 567) {
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
                responsive: true,
                pager: false,
                infiniteLoop: false,
                stopAutoOnClick: true,
                autoHover: true,
                slideWidth: 500,
                moveSlides: 1,
                minSlides: numberOfVisibleSlides,
                maxSlides: numberOfVisibleSlides
            });
        });
    }

    function HeaderResponsive() {
        if (1024 >= $(window).width()) {
            $(document).on('click', '.nab-avatar-wrp', function () {
                $(this).next('.nab-profile-dropdown').slideToggle();
            });
        }
    }

})(jQuery);
