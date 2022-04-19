jQuery(function($) {
	$('.topics__main').slick({
	  autoplay: true,
	  slidesToShow: 1,
	  slidesToScroll: 1,
	  arrows: true,
	  fade: true,
	  asNavFor: $('.topics__nav')
	});
	$('.topics__nav').slick({
	  autoplay: true,
	  slidesToShow: 3,
	  slidesToScroll: 1,
	  asNavFor: $('.topics__main'),
	  arrows: false,
	  dots: false,
	  centerMode: true,
	  focusOnSelect: true,
	  infinite: true,
	  responsive: [
	  	{
	  		breakpoint: 768,
	  		settings: {
	  			slidesToShow: 2
	  		}
	  	}
	  ]
	});

	$('.js-schedule-day').on('click', function() {
		$('.js-schedule-day').removeClass('_shown');
		$('.js-schedule').removeClass('_shown');
		$(this).addClass('_shown').next('.js-schedule').addClass('_shown');
	});
});