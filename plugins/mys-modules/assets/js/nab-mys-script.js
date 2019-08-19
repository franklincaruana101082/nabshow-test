jQuery(document).ready(function ($) {

    var requestedFor = '';
    var currentProgress = 0;
    var progressJump = 50;
    var data = '';
    var pastItemName = '';
    var para = document.createElement('p');
    var adsText = '';

    $('.mys-cred-edit').on('click', function () {
        $('.login-inner').toggleClass('show-labels');
        $(this).hide();
    });

    $('.button-sync').on('click', function () {

        $('.process').addClass('in-progress').width('35px');
        $('#progress-percent').text('0%');
        $('.mys-message-container').slideDown();
        $('.mys-message-container').html('<p>Fetching the data from MYS Server..</p>');

        requestedFor = $(this).data('sync');

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

                pastItem = response.pastItem;
                requestedFor = response.requestedFor;
                groupID = response.groupID;

                if ('' !== pastItem) {

                    currentProgress = currentProgress + progressJump;

                    pastItemName = pastItem.toLowerCase().replace(/\b[a-z]/g, function (txtVal) {
                        return txtVal.toUpperCase();
                    });

                    para = document.createElement('p');
                    adsText = document.createTextNode(pastItemName + ' fetched successfully.');
                    para.appendChild(adsText);

                    $(para).appendTo('.mys-message-container');

                    $('.mys-process-bar .process').width(currentProgress + '%');
                    $('#progress-percent').text(currentProgress + '%');

                    recurringAjax(pastItem, requestedFor, groupID);

                    return false;

                } else {

                    $('.mys-message-container').append('<p>Sessions data fetched successfully.</p>');

                    setTimeout(function () {
                        $('.mys-message-container').append(
                            '<p class="highlighted-para">The migration process is started now, please check your inbox soon.</p>');
                    }, 2000);


                    $('.process').removeClass('in-progress');
                    $('.mys-process-bar .process').width('100%');
                    $('#progress-percent').text('100%');
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

});
