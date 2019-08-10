jQuery(document).ready(function ($) {

    var requestedFor = '';
    var autoProgress = 0;
    var autoProgressLoop = '';
    var data = '';
    var pastItem = '';
    var pastItemName = '';
    var groupID = '';

    $('.mys-cred-edit').on('click', function () {
        $('.login-inner').toggleClass('show-labels');
        $(this).hide();
    });

    /*$('#mys-sync-form').on('submit', function (e) {
        e.preventDefault();

        var formData = $(this).serialize();

        if('yes' === $(this).find('#syncSessions').val() ) {
            var requestedFor = 'sessions';
            recurringAjax('', requestedFor, '');
        }
    });*/

    $('.button-sync').on('click', function () {

        $('.process').addClass('in-progress').width('35px');
        $('#progress-percent').text('0%');
        $('.mys-message-container').html('<p>Fetching the data from MYS Server..</p>');

        requestedFor = $(this).data('sync');

        /*autoProgress = 0;
        $('body').addClass('autoProgress');
        autoProgressLoop = setInterval(function () {
            autoProgress = autoProgress + 10;
            $('.process').addClass('in-progress').width(autoProgress + '%');
            $('#progress-percent').text(autoProgress + '%');
            if (50 <= autoProgress || ! $('body').hasClass('autoProgress')) {
                clearInterval(autoProgressLoop);
            }
        }, 3000);*/

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

                //$('.mys_message_container').html(response);

                pastItem = response.pastItem;
                requestedFor = response.requestedFor;
                groupID = response.groupID;

                //alert('result - ' + pastItem + ' // ' + requestedFor + ' // ' + groupID);
                //alert('all in one - ' + response);

                if ('' !== pastItem) {

                    pastItemName = pastItem.toLowerCase().replace(/\b[a-z]/g, function(txtVal) {
                        return txtVal.toUpperCase();
                    });

                    $('.mys-message-container').append('<p>' + pastItemName + ' fetched successfully..</p>');

                    //$('body').removeClass('autoProgress');

                    $('.mys-process-bar .process').width('50%');
                    $('#progress-percent').text('50%');
                    recurringAjax(pastItem, requestedFor, groupID);
                    return false;

                } else {

                    $('.mys-message-container').append('<p>Sessions data fetched successfully.</p>');

                    setTimeout(function () {
                        $('.mys-message-container').append(
                            '<p class="highlighted-para">The migration process is started now, please check your inbox soon.</p>');
                    },2000);


                    $('.process').removeClass('in-progress');
                    $('.mys-process-bar .process').width('100%');
                    $('#progress-percent').text('100%');
                }

            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('.mys_message_container').html(jqXHR + ' :: ' + textStatus + ' :: ' + errorThrown);
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
