// var $ = require('jquery');

$(function() {

	// alert('It works! The Child!');
	$('.faderIn').css('opacity', 0);
		//set a waypoint for all the page parts on the page
		var ppWaypoint = $('.faderIn').waypoint(function(direction) {
			//check the direction
			if(direction == 'down') {
				//add the class to start the animation
				$(this.element).addClass('animated fadeIn');
				// $('.fader-sub').addClass('animated fadeInUp delay-1s');
				//then destroy this waypoint, we don't need it anymore
				this.destroy();
			}
		}, {
			//Set the offset
			offset: '70%'
	});


	$('.faderUp').css('opacity', 0);
		//set a waypoint for all the page parts on the page
		var ppWaypoint = $('.faderUp').waypoint(function(direction) {
			//check the direction
			if(direction == 'down') {
				//add the class to start the animation
				$(this.element).addClass('animated fadeInUp');
				// $('.fader-sub').addClass('animated fadeInUp delay-1s');
				//then destroy this waypoint, we don't need it anymore
				this.destroy();
			}
		}, {
			//Set the offset
			offset: '70%'
	});

	$('.faderLeft').css('opacity', 0);
		//set a waypoint for all the page parts on the page
		var ppWaypoint = $('.faderLeft').waypoint(function(direction) {
			//check the direction
			if(direction == 'down') {
				//add the class to start the animation
				$(this.element).addClass('animated fadeInLeft');
				// $('.fader-sub').addClass('animated fadeInUp delay-1s');
				//then destroy this waypoint, we don't need it anymore
				this.destroy();
			}
		}, {
			//Set the offset
			offset: '70%'
	});

	$('.faderRight').css('opacity', 0);
		//set a waypoint for all the page parts on the page
		var ppWaypoint = $('.faderRight').waypoint(function(direction) {
			//check the direction
			if(direction == 'down') {
				//add the class to start the animation
				$(this.element).addClass('animated fadeInRight');
				// $('.fader-sub').addClass('animated fadeInUp delay-1s');
				//then destroy this waypoint, we don't need it anymore
				this.destroy();
			}
		}, {
			//Set the offset
			offset: '70%'
	});

	if ($('.nab-header-secondary').length > 0 && $('body').hasClass('page-id-54656')) {
		var headerSecondary = $('.nab-header-secondary');
		var headerMain = $('.site-header');
		if ($('.admin-bar') > 0) {
			var totalHeight = headerSecondary.outerHeight() + headerMain.outerHeight();
			$('#page').css('padding-top', totalHeight + 32);
		} else {
			var totalHeight = headerSecondary.outerHeight() + headerMain.outerHeight();
			$('#page').css('padding-top', totalHeight);
		}
	}


});


/////



