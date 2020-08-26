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
          scheduleDiv.setAttribute('class', 'schedule-row');
  
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
          sessionHeading.innerText = value.post_title;
  
          infoNameDiv.appendChild(sessionHeading);
          infoDiv.appendChild(infoNameDiv);
  
          let channelPassDiv = document.createElement('div');
          channelPassDiv.setAttribute('class', 'channel-pass');
  
          let channelSpan = document.createElement('span');
          channelSpan.setAttribute('class', 'channel-name');
          channelSpan.innerText = value.channel;
  
          let passSpan = document.createElement('span');
          passSpan.setAttribute('class', 'pass-name');
          passSpan.innerText = value.pass_name;
  
          channelPassDiv.appendChild(channelSpan);
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
          learnMoreLink.setAttribute('href', value.more_link);
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