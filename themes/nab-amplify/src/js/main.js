// Your main script

jQuery(function($) {
	jQuery('.js-mobile-toggle').on('click', function() {
		console.log('.js-mobile-toggle:click', this)
		jQuery(this).closest('.header').toggleClass('_open');
	});
	jQuery('.js-toggle-feedchooser').on('click', function() {
		console.log('.js-toggle-feedchooser:click', this)
		jQuery(this).parent().toggleClass('_open');
	});
	var closeFeedchooser;
	jQuery('.js-toggle-feedchooser').parent().on('mouseout', function() {
		console.log('.js-toggle-feedchooser:mouseout', this)
		var self = jQuery(this);
		closeFeedchooser = setTimeout(function() {
			jQuery(self).removeClass('_open');
		}, 500);
	}).on('mouseover', function() {
		console.log('.js-toggle-feedchooser:mouseover', this)
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
});
