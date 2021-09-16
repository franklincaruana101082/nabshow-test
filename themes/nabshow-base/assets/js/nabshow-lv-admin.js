(function ($) {
    var ajaxUrl = nabshowLvAdmin.ajax_url;
    var adminNonce = nabshowLvAdmin.nabshow_lv_admin_nonce;

    $(document).on('click', '#help-support .submit #send-mail', function () {

        var mailSubject = $(this).parents('.help-support').find('#support-subject').val();
        var mailMessage = $(this).parents('.help-support').find('#support-content').val();
        var _this = $(this);

        if ( '' !== mailSubject && '' !== mailMessage ) {
            $(this).attr('disabled', true);
            $.ajax({
                type: 'GET',
                data: 'action=help_support_widget&mail_nonce=' + adminNonce + '&mail_subject=' + mailSubject + '&mail_message=' + mailMessage,
                url: ajaxUrl,
                success: function ( response ) {

                    let finalResult = jQuery.parseJSON(response);

                    _this.parents('#help-support').find('.display-msg').text(finalResult.result.display_msg);

                    if ( finalResult.result.success ) {
                        _this.parents('#help-support').find('.display-msg').removeClass('error').addClass('success');
                    } else {
                        _this.parents('#help-support').find('.display-msg').removeClass('success').addClass('error');
                    }

                    _this.parents('#help-support').find('.display-msg').show();

                    _this.parents('.help-support').find('#support-subject').val('');
                    _this.parents('.help-support').find('#support-content').val('');

                    _this.attr('disabled', false);
                }
            });
        }

        return false;
    });
})(jQuery);