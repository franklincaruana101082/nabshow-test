jQuery(function($) {
	$('.topics__main').slick({
	  slidesToShow: 1,
	  slidesToScroll: 1,
	  arrows: true,
	  fade: true,
	  asNavFor: $('.topics__nav')
	});
	$('.topics__nav').slick({
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
});