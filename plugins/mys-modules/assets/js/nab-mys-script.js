jQuery(document).ready(function ($) {

  var requestedFor = '';
  var currentProgress = 0;
  var progressJump = 20;
  var data = '';
  var action = '';
  var pastItemName = '';
  var para = document.createElement('p');
  var paraText = '';
  var apiError = '';
  var extraDetails = '';
  var totalModified = 0;
  var totalItemStatuses = [];
  var totalAdded = 0;
  var totalDeleted = 0;
  var totalUpdated = 0;
  var uptoDate = 0;
  var lastItemSessionLoop = '';
  var lastItemSessionLoopOriginal = 'Sponsors';
  var isValid = '';

  $('.mys-cred-edit').on('click', function () {
    $('.show-hide-fields').toggleClass('show-labels');
    $(this).hide();
  });

  $('.button-sync').on('click', function () {

    //ne_temp
    //$('.button-sync, .button-sync-exhibitors').addClass('disabled');

    $('.process').removeClass('remove-animation').addClass('in-progress').width('30px');
    $('#progress-percent').text('0%');
    $('.mys-process-bar').show();
    $('#progress-percent-outer').slideDown('500');
    $('.mys-message-container').slideDown('500', function () {
      $('.mys-message-container').addClass('show-log-text');
    });
    $('.mys-message-container').html('<p>- Fetching the data from MYS Server..</p>');

    requestedFor = $(this).data('sync');

    //Start Syncing
    recurringAjax('', requestedFor, '', 0, 0);

  });

  function recurringAjax(pastItem, requestedFor, groupID, totalCounts, finishedCounts) {

    if (-1 !== requestedFor.indexOf('exhibitor')) {
      action = 'nab_mys_exhibitor_data';
    } else {
      action = 'nab_mys_session_data';
    }
    data = {
      'action': action,
      'requested_for': requestedFor,
      'group_id': groupID,
      'total_counts': totalCounts,
      'finished_counts': finishedCounts,
      'past_request': pastItem,
      'security': mysHandler.security
    };

    jQuery.ajax({
      type: 'POST',
      dataType: 'json',
      url: mysHandler.ajaxurl,
      data: data,
      success: function (response) {

        pastItem = (undefined !== response.pastItem) ? response.pastItem : '';
        requestedFor = (undefined !== response.requestedFor) ? response.requestedFor : '';
        groupID = (undefined !== response.pastItem) ? response.groupID : '';
        totalCounts = (null !== response.totalCounts) ? response.totalCounts : '';
        finishedCounts = (null !== response.finishedCounts) ? response.finishedCounts : '';
        apiError = (undefined !== response.apiError) ? response.apiError : '';

        totalItemStatuses = (undefined !== response.totalItemStatuses) ? response.totalItemStatuses : '';
        totalAdded = undefined !== totalItemStatuses.Added ? totalItemStatuses.Added.length : 0;
        totalDeleted = undefined !== totalItemStatuses.Deleted ? totalItemStatuses.Deleted.length : 0;
        totalUpdated = undefined !== totalItemStatuses.Updated ? totalItemStatuses.Updated.length : 0;

        if ('' !== apiError) {

          $(apiError).appendTo('.mys-message-container');
          $('.process').addClass('remove-animation').removeClass('in-progress').width('30px');
          $('#progress-percent').text('0%');
          $('.button-sync, .button-sync-exhibitors').removeClass('disabled');

          currentProgress = 0;

          return false;
        }


        if ('finish' !== pastItem) {

          if ('' !== totalCounts) {

            if ('exhibitors' === requestedFor || 'single-exhibitor' === requestedFor) {

              totalModified = totalCounts;
              progressJump = (100 / totalModified);

              if (0 !== finishedCounts) {

                //single-exhibitor
                //This is previous sequence of single-exhibitors, so display the message.
                createDomPara('- The previous pull request (' + groupID + ') is pending. Total ' + (finishedCounts - 1) + ' out of ' + totalModified + ' items were finished. So fetching pending item\'s data from MYS API. New pull request can be started later.', '.mys-message-container', 'append');

              } else {

                //modified-exhibitors
                createDomPara('- Total ' + totalModified + ' exhibitors are modified at MYS server.', '.mys-message-container', 'append');
                finishedCounts = 0;

              }

              $('.mys-message-container').append('<p class="exh-counter"></p>');

            } else {

              progressJump = 20;

            }

          }

          if ('single-exhibitor' === requestedFor) {

            // then finishedCounts contains total number of successful single exhibitors. So display it.
            //$('.exh-counter').html('<p>- ' + finishedCounts + ' out of ' + totalModified + ' Exhibitors fetched successfully.</p>');
            createDomPara(finishedCounts + ' out of ' + totalModified + ' Exhibitors fetched successfully.', '.exh-counter');

            currentProgress = finishedCounts * progressJump;

          } else if ('exhibitors' !== requestedFor) {

            pastItemName = pastItem.toLowerCase().replace(/\b[a-z]/g, function (txtVal) {
              return txtVal.toUpperCase();
            });
            pastItemName = pastItemName.replace('-', ' ');

            if (1 === totalCounts) {
              pastItemName = pastItemName.slice(0, -1);
            }

            extraDetails = '';
            if ('modified-sessions' === pastItem) {
              extraDetails = ' (Total ' + totalAdded + ' to Add / ' + totalDeleted + ' to Delete / ' + totalUpdated + ' to Update)';
            }

            para = document.createElement('p');
            paraText = document.createTextNode('- ' + totalCounts + ' ' + pastItemName + ' fetched successfully.' + extraDetails);
            para.appendChild(paraText);

            $(para).appendTo('.mys-message-container');
          }

          currentProgress = currentProgress + progressJump;
          currentProgress = Math.round(currentProgress * 100) / 100;

          $('.mys-process-bar .process').width(currentProgress + '%');
          $('#progress-percent').text(currentProgress + '%');

          recurringAjax(pastItem, requestedFor, groupID, totalCounts, finishedCounts);

          return false;

        } else {

          lastItemSessionLoop = lastItemSessionLoopOriginal;

          // pastItem is empty, display success message.
          uptoDate = 0;

          if ('empty' === requestedFor) {
            createDomPara('- Everything is upto date.', '.mys-message-container', 'append', 'highlighted-para');
            uptoDate = 1;
          } else if ('single-exhibitor' === requestedFor) {
            createDomPara('- All ' + totalModified + ' Exhibitors fetched successfully.', '.exh-counter');
          } else {
            if (1 === totalCounts) {
              lastItemSessionLoop = lastItemSessionLoop.slice(0, -1);
            }
            createDomPara('- ' + totalCounts + ' ' + lastItemSessionLoop + ' fetched successfully.', '.mys-message-container', 'append');
          }

          if (0 === uptoDate) {
            setTimeout(function () {
              $('.mys-message-container').append(
                '<p class="highlighted-para">- The migration process is started now, please check your inbox soon.</p>');
            }, 2000);

            //Triggering CRON..
            triggerMasterCron();

          }

          currentProgress = 0;

          $('.process').removeClass('in-progress').addClass('remove-animation');
          $('.mys-process-bar .process').width('100%');
          $('#progress-percent').text('100%');
          $('#nextstep').fadeIn();
        }

      },
      error: function (jqXHR, textStatus, errorThrown) {
        $('.mys_message_container').text(jqXHR + ' :: ' + textStatus + ' :: ' + errorThrown);
      }

    });
  }

  function createDomPara(passedText, stuffingClass, method, paraClass) {
    para = document.createElement('p');
    if (undefined !== paraClass) {
      para.className = paraClass;
    }
    paraText = document.createTextNode(passedText);
    para.appendChild(paraText);
    if ('append' !== method) {
      $(stuffingClass).html('');
    }
    $(para).appendTo(stuffingClass);
  }

  function triggerMasterCron() {

    data = {
      'limit': 50
    };

    jQuery.ajax({
      type: 'GET',
      dataType: 'json',
      data: data,
      url: mysHandler.mastercron,
      beforeSend: function (xhr) {
        xhr.setRequestHeader('Authorization', 'Basic bXVsdGlkb3RzOnRoaW5rZXI5OQ==');
      },
      success: function (response) {
      }
    });
  }

  // mys-popup
  $('.popup-btn').on('click', function () {
    $(this).parent().find('.mys-popup').addClass('active');
  });

  $('.mys-popup .mys-popup-inner .dashicons.dashicons-no').on('click', function () {
    $(this).parent().parent().removeClass('active');
  });

  $('#datepicker, .enable_date').datepicker({dateFormat: 'yy-mm-dd', maxDate: 0});

  $('#test-mys-close').on('click', function () {
    $('#mys-test').hide();
  });

  $('.history-filter-button').on('click', function () {
    $('.current-page:not(.paged_changed)').val(1);
  });

  $('.current-page').keypress(function (event) {
    if (parseInt($('.total-pages').text()) < parseInt($(this).val())) {
      $('.current-page').val($('.total-pages').text());
    }
    $(this).addClass('paged_changed');
  });

  $('.toggle-response').on('click', function () {
    $('i', this).toggleClass('fa-toggle-on fa-toggle-off');
    $('.history-page').toggleClass('show-responses');
  });

  $('#time-hour-csv').on('change', function () {
    isValid = /^([0-1]?[0-9]|2[0-3]):([0-5][0-9])(:[0-5][0-9])?$/.test($(this).val());
    if (isValid) {
      $(this).css('border-color', '#ddd');
    } else {
      $(this).css('border-color', '#fba');
    }
  });

});
