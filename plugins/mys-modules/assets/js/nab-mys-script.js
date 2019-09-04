jQuery(document).ready(function ($) {

    var requestedFor = '';
    var currentProgress = 0;
    var progressJump = 20;
    var data = '';
    var pastItemName = '';
    var para = document.createElement('p');
    var paraText = '';
    var apiError = '';

    $('.mys-cred-edit').on('click', function () {
        $('.show-hide-fields').toggleClass('show-labels');
        $(this).hide();
    });

    $('.button-sync').on('click', function () {

        $('.button-sync, .button-sync-exhibitors').addClass('disabled');
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
        recurringAjax('', requestedFor, '');

    });

    function recurringAjax(pastItem, requestedFor, groupID) {

        data = {
            'action': 'nab_mys_sync_data',
            'requested_for': requestedFor,
            'group_id': groupID,
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
                apiError = (undefined !== response.apiError) ? response.apiError : '';

                if ('' !== apiError) {

                    $(apiError).appendTo('.mys-message-container');
                    $('.process').addClass('remove-animation').removeClass('in-progress').width('30px');
                    $('#progress-percent').text('0%');
                    $('.button-sync, .button-sync-exhibitors').removeClass('disabled');

                    currentProgress = 0;

                    return false;
                }

                if ('' !== pastItem) {

                    currentProgress = currentProgress + progressJump;

                    pastItemName = pastItem.toLowerCase().replace(/\b[a-z]/g, function (txtVal) {
                        return txtVal.toUpperCase();
                    });
                    pastItemName = pastItemName.replace('-', ' ');

                    para = document.createElement('p');
                    paraText = document.createTextNode('- ' + pastItemName + ' data fetched successfully.');
                    para.appendChild(paraText);

                    $(para).appendTo('.mys-message-container');

                    $('.mys-process-bar .process').width(currentProgress + '%');
                    $('#progress-percent').text(currentProgress + '%');

                    recurringAjax(pastItem, requestedFor, groupID);

                    return false;

                } else {

                    $('.mys-message-container').append('<p>- Sponsors data fetched successfully.</p>');

                    setTimeout(function () {
                        $('.mys-message-container').append(
                            '<p class="highlighted-para">- The migration process is started now, please check your inbox soon.</p>');
                    }, 2000);

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

    //Not working - have to debug
    $('.mys-notice-dismiss').on('click', function () {
        jQuery('.notice').slideUp('fast');
    });

    // mys-popup
    $('.popup-btn').on('click', function () {
        $(this).parent().find('.mys-popup').addClass('active');
    });

    $('.mys-popup .mys-popup-inner .dashicons.dashicons-no').on('click', function () {
        $(this).parent().parent().removeClass('active');
    });

    $('#datepicker').datepicker({ dateFormat: 'mm-dd-yy' });

});
