// Your main script

jQuery(function($) {
	$('.events-list__event__add').each(function(){
		let el = $(this);
		var myCalendar = createCalendar({
			options: {
				class: 'my-calendar-generated-class',
			},
			data: {
				title: el.data("title"),     
				start: new Date(el.data("start")),				
				end: new Date(el.data("end")),
				address: el.data("address"),
				description: el.data("description")
			}
		});
		el.append(myCalendar);
	});
	
	jQuery('.js-mobile-toggle').on('click', function() {
		jQuery(this).closest('.header').toggleClass('_open');
	});
	jQuery('.js-toggle-feedchooser').on('click', function() {
		console.log('poop');
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

	jQuery('.radiolist li .option').on('click', function() {
		var self = jQuery(this);
		if(jQuery(this).hasClass('_selected')) {
			jQuery('.js-toggle-feedchooser').parent().removeClass('_open');
		} else {
			var panel = jQuery(self).attr('data-panel');
			var title = jQuery(self).text();
			jQuery(self).parents('.showlist').children('.js-toggle-feedchooser').html(title);
			panel = '.js-panel-'+panel;
			var panelSlider = panel + ' .slides__list';
			jQuery('.radiolist li .option').removeClass('_selected');
			jQuery(self).addClass('_selected');
			closeFeedchooser = setTimeout(function() {
				jQuery('.js-toggle-feedchooser').parent().removeClass('_open');
			}, 250);
			jQuery('.discover__panel').removeClass('_selected');
			jQuery(panel).addClass('_selected');
			jQuery(panelSlider).slick('setPosition');
		}

	});



	jQuery('.slides__list').not('.slick-initialized').slick({
		fade: true,
		cssEase: 'linear',
		adaptiveHeight: true
	});

	setTimeout(function() {
		jQuery('.discover__ad, .homeproducts__ad').each(function() {
			var self = jQuery(this);
			var adContainer = self.find('broadstreet-zone');
			var adContent = '';
			if(adContainer.length) {
		 		adContent = adContainer.children('div').html().trim();
		 	}
			if(adContent=='') {
				jQuery(self).addClass('_hidden');
			}
		});
	}, 10000);

	jQuery('.homeproducts__image').wrap('<div class="homeproducts__imageWrap"></div>');

	//set the url for this woocommerce error link because it's impossible to find where this is in the code/DB
	jQuery('.woocommerce-error a.showlogin').attr('href', jQuery('.signup__titles .js-signupLink').attr('href'));
	
});
