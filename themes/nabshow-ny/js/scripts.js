(function(){function r(e,n,t){function o(i,f){if(!n[i]){if(!e[i]){var c="function"==typeof require&&require;if(!f&&c)return c(i,!0);if(u)return u(i,!0);var a=new Error("Cannot find module '"+i+"'");throw a.code="MODULE_NOT_FOUND",a}var p=n[i]={exports:{}};e[i][0].call(p.exports,function(r){var n=e[i][1][r];return o(n||r)},p,p.exports,r,e,n,t)}return n[i].exports}for(var u="function"==typeof require&&require,i=0;i<t.length;i++)o(t[i]);return o}return r})()({1:[function(require,module,exports){
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


});


/////




},{}]},{},[1]);
