jQuery(document).ready(function ($) {

    var xml;
    var $response;

    function nabMediaPopup(buttonClass) {
        var _customMedia = true,
            _origSendAttachment = wp.media.editor.send.attachment;
        $('body').on('click', buttonClass, function (e) {
            var buttonID = '#' + $(this).attr('id');
            var sendAttachmentBkp = wp.media.editor.send.attachment;
            var button = $(buttonID);
            _customMedia = true;
            wp.media.editor.send.attachment = function (props, attachment) {
                if (_customMedia) {
                    $('#tax-image-id').val(attachment.id);
                    $('#tax-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
                    $('#tax-image-wrapper .custom_media_image').attr('src', attachment.url).css('display', 'block');
                } else {
                    return _origSendAttachment.apply(buttonID, [props, attachment]);
                }
            };
            wp.media.editor.open(button);
            return false;
        });
    }

    nabMediaPopup('.ct_tax_media_button.button');

    $('body').on('click', '.ct_tax_media_remove', function () {
        $('#tax-image-id').val('');
        $('#tax-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
    });

    $(document).ajaxComplete(function (event, xhr, settings) {
        var queryStringArr = settings.data.split('&');
        if (-1 !== $.inArray('action=add-tag', queryStringArr)) {
            xml = xhr.responseXML;
            $response = $(xml).find('term_id').text();
            if ('' !== $response) {

                //Clear the thumb image
                $('#tax-image-wrapper').html('');
            }
        }
    });
});
