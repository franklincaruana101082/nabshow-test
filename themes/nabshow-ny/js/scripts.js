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




},{}],2:[function(require,module,exports){
(function ($) {
  'use strict';
  $(document).ready(function() {
    /** Session Date wise listing filter and load more event */

    if (0 < $('.session-date-list-filter').length) {
      let pageNumber;

      $(document).on('change', '.session-date-list-filter #session-channel', function () {
        pageNumber = 1;
        nabAjaxForDateSession(false, pageNumber);
      });

      $(document).on('change', '.session-date-list-filter #session-date', function () {
        pageNumber = 1;
        nabAjaxForDateSession(false, pageNumber);
      });

      $(document).on('keypress', '.session-date-list-filter .search-item .search', function (e) {
        if (13 === e.which) {
          pageNumber = 1;
          nabAjaxForDateSession(false, pageNumber);
        }
      });

      $(document).on('click', '#load-more-date-sessions a', function () {
        pageNumber = parseInt($(this).attr('data-page-number'));
        nabAjaxForDateSession( true, pageNumber);
      });
    }

    $(document).on('click', '.session-date-list .schedule-row', function (event) {
      let target = $( event.target );
      if ( target.is( 'a' ) ) {
          return;
      }
      if ( $(this).hasClass('show_desc') ) {
        $(this).toggleClass('show_desc');
      } else {      
        $(this).parents('.session-date-list').find('.schedule-row').removeClass('show_desc');
        $(this).addClass('show_desc');
      }
    });

    $(document).on('click', '.speaker-detail-list-modal', function () {    
      var postId = $(this).attr('data-postid');    
      $('body').addClass('popup-loader');
      $('.modal .modal-body').load( nabshowNy.site_url + 'modal-popup?speakerid=' + postId, function () {
        $('.modal').modal({
          show: true
        });
        $('body').removeClass('popup-loader');
      });
      return false;
    });
  
    $(document).on('click', '.modal .modal-header .close, .modal .modal-footer .btn-default', function () {
      $(this).parents('.modal').modal('hide');
    });

  });
  /*  main - bracket - end */
})(jQuery);

/** Session Date wise listing filter ajax */
function nabAjaxForDateSession( loadMore, pageNumber ) {
  let postPerPage = jQuery('#load-more-date-sessions a').attr('data-post-limit') ? parseInt(jQuery('#load-more-date-sessions a').attr('data-post-limit')) : 10;
  let postSearch = 0 < jQuery('.session-date-list-filter .search-item .search').length ? jQuery('.session-date-list-filter .search-item .search').val() : '';
  let sessionDate =  0 === jQuery('.session-date-list-filter .date-box #session-date')[0].selectedIndex ? '' : jQuery('.session-date-list-filter .date-box #session-date').val();
  let channel = 0 === jQuery('.session-date-list-filter .channel-box #session-channel')[0].selectedIndex ? '' : jQuery('.session-date-list-filter .channel-box #session-channel').val();

  jQuery('.session-date-list').addClass('popup-loader');   

  jQuery.ajax({
    type: 'GET',
    data: 'action=sessions_date_list_filter&page_number=' + pageNumber + '&post_limit=' + postPerPage + '&post_search=' + postSearch + '&session_date=' + sessionDate + '&channel=' + channel,
    url: nabshowLvCustom.ajax_url,
    success: function (sessionData) {

      let sessionObj = jQuery.parseJSON(sessionData);

      let dateGroup = ! loadMore ? '' : jQuery('.session-date-list-wrapper .schedule-data h2:last').text();
      let parentItem = '';

      if ( ! loadMore ) {
        jQuery('.session-date-list-wrapper').empty();
      } 

      if ( '' !== sessionObj.result_post && 0 < sessionObj.result_post.length ) {
        jQuery.each(sessionObj.result_post, function (key, value) {
          if ( dateGroup !== value.session_date ) {
            parentItem = document.createElement('div');
            parentItem.setAttribute('class', 'schedule-data');
  
            let dateHeading = document.createElement('h2');
            dateHeading.innerText = value.session_date;
  
            parentItem.appendChild(dateHeading);

            dateGroup = value.session_date;
          }
  
          let scheduleDiv = document.createElement('div');
          let scheduleClass = '' === value.schedule_class ? 'schedule-row' : 'schedule-row ' + value.schedule_class;
          scheduleDiv.setAttribute('class', scheduleClass);
  
          let timeDiv = document.createElement('div');
          timeDiv.setAttribute('class', 'date');
  
          let timeP = document.createElement('div');
          timeP.innerText = value.time;
  
          timeDiv.appendChild(timeP);
          scheduleDiv.appendChild(timeDiv);
  
          let imgDiv = document.createElement('div');
          imgDiv.setAttribute('class', 'session-img');
  
          let innerImg = document.createElement('img');
          innerImg.setAttribute('src', value.thumbnail_url);
          innerImg.setAttribute('alt', 'session-img');
  
          imgDiv.appendChild(innerImg);
          scheduleDiv.appendChild(imgDiv);
  
          let infoDiv = document.createElement('div');
          infoDiv.setAttribute('class', 'info');
  
          let infoNameDiv = document.createElement('div');
          infoNameDiv.setAttribute('class', 'name');
  
          let sessionHeading = document.createElement('h3');    

          let sessionHeadingLink = document.createElement('a');
          sessionHeadingLink.setAttribute('href', value.post_link);
          sessionHeadingLink.innerText = value.post_title;

          sessionHeading.appendChild(sessionHeadingLink);
          
          infoNameDiv.appendChild(sessionHeading);
          infoDiv.appendChild(infoNameDiv);
  
          let channelPassDiv = document.createElement('div');
          channelPassDiv.setAttribute('class', 'channel-pass');
  
          let channelLink = document.createElement('a');
          channelLink.setAttribute('href', value.channel_link);

          let channelSpan = document.createElement('span');
          channelSpan.setAttribute('class', 'channel-name');
          channelSpan.innerText = value.channel;

          channelLink.appendChild(channelSpan);
                    
          let passSpan = document.createElement('span');
          passSpan.setAttribute('class', 'pass-name');
          passSpan.innerText = value.pass_name;
  
          channelPassDiv.appendChild(channelLink);
          channelPassDiv.appendChild(passSpan);
          infoDiv.appendChild(channelPassDiv);
  
          let moreDetailsDiv = document.createElement('div');
          moreDetailsDiv.setAttribute('class', 'info-more-details');

          let contentP = document.createElement('p');
          contentP.innerText = value.post_content;

          moreDetailsDiv.appendChild(contentP);          
  
          if ( value.speakers ) {
            let speakerSpan = document.createElement('span');
            speakerSpan.setAttribute('class', 'session-speaker');
            speakerSpan.innerText = value.speakers;
  
            moreDetailsDiv.appendChild(speakerSpan);
          }
          infoDiv.appendChild(moreDetailsDiv);
          scheduleDiv.appendChild(infoDiv);
  
          let detailLinkDiv = document.createElement('div');
          detailLinkDiv.setAttribute('class', 'more-details-link');
  
          let learnMoreLink = document.createElement('a');
          learnMoreLink.setAttribute('href', value.post_link);
          learnMoreLink.innerText = value.more_text;
  
          detailLinkDiv.appendChild(learnMoreLink);
          scheduleDiv.appendChild(detailLinkDiv);

          if ( '' === parentItem ) {
            parentItem = document.getElementsByClassName('schedule-data')[jQuery('.schedule-data').length - 1];
            parentItem.appendChild(scheduleDiv);
          } else {
            parentItem.appendChild(scheduleDiv);
            let wrapperMainDiv = document.getElementById('session-date-list-wrapper');
            wrapperMainDiv.appendChild(parentItem);
          }

        });
      }
      
      jQuery('.session-date-list').removeClass('popup-loader');      

      jQuery('#load-more-date-sessions a').attr('data-page-number', sessionObj.next_page_number);

      if (sessionObj.next_page_number > sessionObj.total_page) {
        jQuery('#load-more-date-sessions').hide();
      } else {
        jQuery('#load-more-date-sessions').show();
      }

      if (0 === sessionObj.total_page) {
        jQuery('.session-date-list-wrapper').empty().parent().find('p.no-data').show();
      } else {
        jQuery('.session-date-list-wrapper').parent().find('p.no-data').hide();
      }
      
    }
  });
}
},{}]},{},[1,2]);
