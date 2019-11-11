(function ($) {
    'use strict';
    var bxSliderObj = [];

    if ( 0 < $('.nab-dynamic-slider').length ) {
        mysgbConfigureSlider();
        $(window).on('orientationchange resize', mysgbConfigureSlider);
    }

    if (0 < $('#card_section').length) {
        window.onload = window.onresize = mysMasonryGrids;
    }

    /**
     * Initialize or reload slider
     */
    function mysgbConfigureSlider() {
        var numberOfVisibleSlides = mysNumberofVisibleSlide();
        if (0 < $('.nab-dynamic-slider').length) {
            $('.nab-dynamic-slider').each(function (index) {

                let config = mysDynamicSliderConfig($(this), numberOfVisibleSlides);

                if (0 < bxSliderObj.length && undefined !== bxSliderObj[index]) {
                    bxSliderObj[index].reloadSlider(config);
                } else {
                    bxSliderObj[index] = $(this).bxSlider(config);
                }
            });
        }
    }


    /**
     * Set visible slide according to width
     * @returns {number}
     */
    function mysNumberofVisibleSlide() {
        var numberOfVisibleSlides,
            windowWidth = $(window).width();

        if (600 > windowWidth) {
            numberOfVisibleSlides = 1;
        } else if (990 > windowWidth && 600 < windowWidth) {
            numberOfVisibleSlides = 2;
        } else if (1300 > windowWidth && 990 < windowWidth) {
            numberOfVisibleSlides = 3;
        }

        return numberOfVisibleSlides;
    }


    /**
     *  Setup bxslider options
     * @param elementHandler
     * @param numberOfVisibleSlides
     * @returns {{maxSlides: *, mode: *, auto: *, infiniteLoop: *, controls: *, pager: *, minSlides: *, moveSlides: number, slideMargin: *, slideWidth: *, speed: *, mode: *}}
     */
    function mysDynamicSliderConfig(elementHandler, numberOfVisibleSlides) {

        let nabauto = !! elementHandler.attr('data-auto'),
            nabinfinite = !! elementHandler.attr('data-infinite'),
            nabpager = !! elementHandler.attr('data-pager'),
            nabcontrols = !! elementHandler.attr('data-controls'),
            nabMinSlides = 0 < numberOfVisibleSlides ? numberOfVisibleSlides : parseInt(elementHandler.attr('data-minslides'));

        let allImgs = Array.from(document.querySelectorAll('.nab-not-to-be-missed-slider .item img'));
        for (let i = 0; i < allImgs.length; i++) {
            let imgWidth = allImgs[i].parentNode;
            imgWidth.style.backgroundImage = `url('${allImgs[i].currentSrc}')`;
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


})(jQuery);


/* Masonry column */
function mysMasonryGrids() {
    var colCount, colHeight, i, mainDiv, highest, order, divHeight;
    colHeight = [];
    mainDiv = document.getElementById('card_section');
    jQuery('#card_section .item').css({ 'opacity': '0', 'transform': 'scale(0.8, 0.8)' });
    if (3 >= mainDiv.children.length) {
        document.getElementById('card_section').style.flexDirection = 'inherit';
        document.getElementById('card_section').style.alignItems = 'flex-start';
        document.getElementById('card_section').style.height = 'auto';
        for (i = 0; i < mainDiv.children.length; i++) {
            jQuery(mainDiv.children[i]).show('slow').css({ 'opacity': '1', 'transform': 'scale(1, 1)' });
            mainDiv.children[i].style.order = '';
            mainDiv.children[i].style.height = '';
        }
    } else {

        document.getElementById('card_section').style.flexDirection = '';
        document.getElementById('card_section').style.alignItems = '';
        document.getElementById('card_section').style.height = '';
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
            jQuery(mainDiv.children[i]).show('slow').css({ 'opacity': '1', 'transform': 'scale(1, 1)' });
            mainDiv.children[i].style.height = '';
            order = (i + 1) % colCount || colCount;
            mainDiv.children[i].style.order = order;
            divHeight = mainDiv.children[i].clientHeight;
            mainDiv.children[i].style.height = divHeight + 'px';
            colHeight[order] += parseInt(divHeight);
        }

        highest = Math.max.apply(Math, colHeight);

        mainDiv.style.height = highest + 'px';
    }
}