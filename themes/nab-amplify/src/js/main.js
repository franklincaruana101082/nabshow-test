// Your main script

jQuery(function() {
	jQuery('.js-mobile-toggle').on('click', function() {
		jQuery(this).closest('.header').toggleClass('_open');
	});
	jQuery('.js-toggle-feedchooser').on('click', function() {
		jQuery(this).parent().toggleClass('_open');
	});
	var closeFeedchooser;
	jQuery('.js-toggle-feedchooser').parent().on('mouseout', function() {
		var self = jQuery(this);
		closeFeedchooser = setTimeout(function() {
			jQuery(self).removeClass('_open');
		}, 500);
	}).on('mouseover', function() {
		clearTimeout(closeFeedchooser);
	});

	jQuery('.slides__list').slick({
		fade: true,
		cssEase: 'linear'
	});
	jQuery('.homeproducts__list').slick({
		infinite: true,
		slidesToShow: 3,
		slidesToScroll: 3,
		responsive: [
			{
				breakpoint: 1280,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2
				}
			},
			{
				breakpoint: 768,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
					dots: true,
					arrows: false, 
					autoplay: true
				}
			}
		]
	});
});
  