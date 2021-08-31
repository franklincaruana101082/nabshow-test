// Your main script

jQuery(function($) {

	//set aria-expanded attrs to top level menu a tags
	$('.menu-item-has-children a').attr('aria-expanded', 'false');
	//add hidden attr to submenus
	$('.sub-menu').attr('hidden', 'hidden').css('display','block');

	$('.js-mobile-toggle').on('click', function() {
		$('html').toggleClass('_header-is-open');
	});

	// Function to open/close an aria-expanded dropdown
	function toggleAriaExpanded(el, action) {
		let target = $(el).next();
		el.attr('aria-expanded', action === 'open');
		target.attr('hidden', action === 'close');
	};

	// Function to close all aria-expanded dropdowns
	function closeAllAriaExpandeds() {
		$('.menu-item-has-children a[aria-expanded]').each(function(){
			let el = $(this);
			toggleAriaExpanded(el, 'close');
		});
	};

	// Aria Expanded for dropdowns etc
	$('.menu-item-has-children a[aria-expanded]').each(function(){
		let el = $(this);
		el.on('click', function(){
			let elExpanded = el.attr('aria-expanded');
			closeAllAriaExpandeds();
			toggleAriaExpanded(el, elExpanded === 'true' ? 'close' : 'open');		
		});
	});
 
	// Hide dropdown menu on click outside
	$(document).on("click", function(event){
		console.log("∆∆∆ Document on Click");
		if(!$(event.target).closest('.menu-item-has-children a[aria-expanded]').length){
			console.log("∆∆∆ Document on Click closing all");
			closeAllAriaExpandeds();
		}
	});

	// FAQs
	$(".faq").each(function(){
		var el = $(this);
		var toggle = el.find(".faq-toggle");
		var content = el.find(".faq-content");
		toggle.click(function(){
			// If its expanded
			if (toggle.attr("aria-expanded") === 'true') {
				console.log('IF TRUE: faq toggle is', toggle.attr("aria-expanded"));
				toggle.attr("aria-expanded", 'false');
				content.attr("hidden", true);
				console.log("content is now", content.attr("hidden"));
			// If its closed	
			} else {
				console.log('ELSE: faq toggle is', toggle.attr("aria-expanded"));
				toggle.attr("aria-expanded", 'true');
				content.attr("hidden", false);
				console.log("content is now", content.attr("hidden"));
			}
		});

	});



	//homepage testimonials
	$('.testimonials').slick({
		slidesToShow: 3,
		slidesToScroll: 1,
		dots: false,
		arrows: false,
		infinite: true,
		speed: 250,
		autoplay: true,
		autoplaySpeed: 4000,
		responsive: [
			{
				breakpoint: 1024,
				settings: {
					slidesToShow: 2,
				}
			},
			{
				breakpoint: 604,
				settings: {
					slidesToShow: 1,
				}
			},
		]
	});

	$('.cards').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		dots: true,
		arrows: false,
		infinite: false,
		centerMode: true,
		centerPadding: '20px',
	});

	$('.attending-panels').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		dots: true,
		arrows: false,
		infinite: false,
		fade: true,	
		speed: 1000,
		autoplay: true,
		autoplaySpeed: 5000,	
	});

  if ($('.conference-sessions-speakers').length > 0) {
		// each day
		$('.conference-sessions-speakers').slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: false,
			fade: true,	
			speed: 1000,
			autoplay: true,
			autoplaySpeed: 10000,		
			dots: true,
		});
	}

	

	if ($('.schedule__days').length > 0 || $('.schedule__sessions').length > 0) {
		// each day
		$('.schedule__days').slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: false,
			fade: true,
			asNavFor: '.schedule__menu',
			swipe: false,
			swipeToSlide: false,
			adaptiveHeight: true
		});
		// menu for days
		$('.schedule__menu').slick({
			slidesToShow: 5,
			slidesToScroll: 1,
			asNavFor: '.schedule__days',
			arrows: false,
			focusOnSelect: true,
			swipe: false,
			swipeToSlide: false,			
		});
		// sessions
		$('.schedule__sessions').slick({
			slidesToShow: 5,
			slidesToScroll: 1,
			arrows: true,
			centerMode: true,
			responsive: [	
				{
					breakpoint: 1440,
					settings: {
						arrows: true,
						slidesToShow: 4,
						slidesToScroll: 1,
					}
				},
				{
					breakpoint: 1024,
					settings: {
						arrows: true,
						slidesToShow: 3,
						slidesToScroll: 1,
					}
				},			
				{
					breakpoint: 768,
					settings: {
						arrows: true,
						slidesToShow: 2,
						slidesToScroll: 1,
					}
				},
				{
					breakpoint: 500,
					settings: {
						arrows: false,
						slidesToShow: 2,
						slidesToScroll: 1,
					}
				},						
			]
		});

	};

	
});
  
