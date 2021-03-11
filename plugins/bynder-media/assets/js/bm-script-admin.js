(function ($) {

    // Ready.
    $(document).ready(function () {
        addBMpopup();
    });

    $(document).on('click', '.bm-modal-close', function(){
        $(this).parents('.bm-modal-main').removeClass('bm-modal-active');
        $('.bm-select-media').removeClass('active');
    });

    $(document).on('click', '#bm-featured-remove', function(){
        // Remove the selected image src in hidden meta field.
        $(this).parent().find('input').val('');

        // Remove the selected image src in hidden image.
        $(this).parent().find('img').attr('src', '');

        // Replace the link into a select area.
        $(this).parent().removeClass('selected');

        // Change the label name.
        let bynderLabel = $(this).text();
        bynderLabel = bynderLabel.replace('Replace', 'Set');
        $(this).text(bynderLabel);
    });

    $(document).on('click', '.bm-select-media', function () {

        // Flush the popup.
        $('#bm-main-outer #bm-tab-media').html('');

        // Prevent simultaneous requests.
        if( 0 !== $('.bm-select-media.active').length ) {
            alert('Loading... Please wait! Please contact Plugin Developer if you see this message repeatedly.');
        }

        // Add active class to prevent simultaneous requests.
        $(this).addClass('active');

        // Add clicked element's ID in #bm-tab-media
        // to perform respective actions later.
        //const requestedBy = $(this).attr('id');
        const requestedBy = $(this).attr('bynder-for');
        $('#bm-tab-media').attr('bynder-request-by', requestedBy);

        $("#bm-main-outer").addClass('bm-modal-active');
        $("#bm-main-outer .bm-modal-body").addClass('bm-loading');

        const bmData = new FormData();
        bmData.append('action', 'bm_fetch_assets');
        bmData.append('requestedBy', requestedBy);

        $.ajax({
            type: 'POST',
            url: bmObj.ajaxurl,
            data: bmData,
            contentType: false,
            processData: false,
            success(result) {
                result = JSON.parse(result);
                if( result.bmHTML ) {
                    $('#bm-main-outer .bm-modal-body').removeClass('bm-loading');
                    if( 0 === $('#bm-main-outer').length ) {
                        addBMpopup();
                    }
                    $('#bm-main-outer #bm-tab-media').html(result.bmHTML);
                } else if ( result.error ) {
                    $('#bm-main-outer .bm-modal-body').removeClass('bm-loading');
                    $('#bm-main-outer #bm-tab-media').html(result.error);
                }
            },
            error() {
                alert('Fetch error! Try again or contact Plugin Developer.');
            },
        });
    });

    $(document).on('click', '#bm-tab-media .bm-btn', function() {

        // Get values.
        const assetCard = $(this).parents('.bm-item');
        const requestedBy = $('#bm-tab-media').attr('bynder-request-by');
        const assetName = assetCard.find('.bm-img-name').text();
        let assetSrc = assetCard.find('[data-name]:checked').val();

        // Check the Featured derivative if the request is for the featured image.
        if( 'profile_picture' === requestedBy ) {
            assetCard.find('[data-name="Featured"]').prop('checked',true);
            assetSrc = assetCard.find('[data-name]:checked').val();
        }

        // Check if the derivative is selected.
        if (undefined === assetSrc ) {
            alert('Please select derivative.');
            return false;
        }

        // Add the selected image src in hidden meta field.
        if( 'profile_picture' === requestedBy ) {
            // Add the selected image src in hidden meta field.
            $('.bm-select-media.active').parent().find('input').val(assetSrc);

            // Add the selected image src in hidden image.
            $('.bm-select-media.active').parent().find('img').attr('src', assetSrc);

            // Replace the select area into a link.
            $('.bm-select-media.active').parent().addClass('selected');

            // Change the label name.
            $('.bm-select-media.active').text('Change Image');

        } else if ( 'bm-block-image' === requestedBy ) {

            // Replace the bynder block with default image div.
            const bynderReadyBlock = wp.blocks.createBlock('core/image', {
                url: assetSrc,
                alt: assetName
            });
            const blockID = $('.bm-select-media.active').closest('[data-block]').attr('data-block');
            wp.data.dispatch('core/block-editor').replaceBlocks( blockID, bynderReadyBlock );
        }

        // Close the popup.
        $('.bm-modal-close').trigger('click');
    });

    $(document).on('click', '.bm-tab-list .bm-tab-item', function(){
        var tabID = $(this).attr('data-tab');
        $(this).parent().addClass('bm-tab-active').siblings().removeClass('bm-tab-active');
        $('#'+tabID).addClass('bm-tab-active').siblings().removeClass('bm-tab-active');
    });

    $(document).on('click touchstart', function (e) {
      if ($(e.target).is('.bm-modal-overlay')) {
        var checkPopup = $(e.target).parents('.bm-modal-main');
        if (checkPopup.hasClass('bm-modal-active')) {
          checkPopup.removeClass('bm-modal-active');
            $('.bm-select-media').removeClass('active');
        }
      }
    });

})(jQuery);


function addBMpopup() {

    if( 0 === jQuery('#bm-main-outer').length ) {

        jQuery('.bm-select-media').addClass('creating-popup');

        const bmData = new FormData();
        bmData.append('action', 'bm_init_popup');

        jQuery.ajax({
            type: 'POST',
            url: bmObj.ajaxurl,
            data: bmData,
            contentType: false,
            processData: false,
            success(result) {

                // Prevent multiple popup addition if there
                // were simultaneous requests to add a popup.
                if( 0 !== jQuery('#bm-main-outer').length ) {
                    return false;
                }

                result = JSON.parse(result);
                if( result.bmInitPop ) {
                    jQuery('body').append(result.bmInitPop);

                    // Remove class to enable popup.
                    jQuery('.bm-select-media').removeClass('creating-popup');
                }

            },
            error() {
                console.log('Fetch error! Try again or contact Plugin Developer.');
            },
        });
    }
}
