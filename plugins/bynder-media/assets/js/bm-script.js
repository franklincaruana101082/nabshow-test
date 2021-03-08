(function ($) {

    // Ready.
    $(document).ready(function () {

        // On ready, add a initial BM popup.
        // Adds content from: /includes/partials/bm-init-popup.php
        if( 0 !== $('.bm-select-media').length ) {
            addBMpopup();
        }

        // Temporarily hiding the Upload sections as its still in development mode.
        $('body.wp-admin').append('<style>.bm-tab-list li:nth-child(2) {display: none;}body .bm-tab-list li:not(:last-child) {border: 0;</style>');
    });


    // Load.
    /*$(window).on('load', function(){

        // If its edit page, add a button for Bynder upload at top right side.
        if( 0 !== $('.editor-post-title .editor-post-title__input').length ) {
            const uploadAssetBtn = "<button type='button' class='bm-select-media bm-post-header-select components-button is-tertiary' bynder-for='upload_only'>Upload Asset</button>";
            $(".edit-post-header .edit-post-header__settings").prepend(uploadAssetBtn);
        }
    });*/

    // Clicking the cross icon at top right
    // side of the popup closes the popup.
    $(document).on('click', '.bm-modal-close', function(){
        if( ! $('.bm-select-media').hasClass('in-use') ) {
            $(this).parents('.bm-modal-main').removeClass('bm-modal-active');
            $('.bm-select-media').removeClass('active');
            $("body").removeClass('bm-modal-off-scroll');
        } else {
            alert('Please wait...');
        }
    });

    // Shows the popup and start fetching the assets.
    // Same applies for load more action.
    $(document).on('click', '.bm-select-media, #assets-load-more', function (e) {
        e.preventDefault();

        bmFetchAssets($(this));
    });

    // Trigger fetch process again on 'Try again' button click.
    $(document).on('click', '#bm-try-again-fetch', function (e) {
        $('.bm-select-media.active').trigger('click');
    });

    $(document).on('submit', '#bm-upload-form', function (e) {
        e.preventDefault();

        if( $('#bm-upload-form').hasClass('meta-creation') ) {
            alert('Pleas wait! Fetching required details to upload.');
            return false;
        }

        // Check if collection id is available.
        //const collectionID =  $('body').attr('bm-col-id');

        // Init upload now.
        $('#bm-main-outer .bm-modal-body').addClass('bm-upload-loader bm-loading');
        bmUploadToBynder();
    });

    // Select image.
    $(document).on('click', '#bm-tab-media .bm-btn', function() {

        // Get values.
        const assetCard = $(this).parents('.bm-item');
        const requestedBy = $('#bm-tab-media').attr('bynder-request-by');
        const assetName = assetCard.find('.bm-img-name').text();
        let assetSrc = assetCard.find('[data-name]:checked').val();

        // Check the Featured derivative if the request is for the featured image.
        // Applies for back end only.
        if( 'profile_picture' === requestedBy && $('body').hasClass('wp-admin') ) {
            assetCard.find('[data-name="Featured"]').prop('checked',true);
            assetSrc = assetCard.find('[data-name]:checked').val();
        }

        // Show msg if the derivative is not selected.
        if (undefined === assetSrc ) {
            alert('Please select derivative.');
            return false;
        }

        // Add the selected image src in hidden meta field. (Back end only)
        if( $('body').hasClass('wp-admin') ) {
            if ( 'bm-block-image' === requestedBy ) {

                // Replace the bynder block with default image div. (Back end only)
                const bynderReadyBlock = wp.blocks.createBlock('core/image', {
                    url: assetSrc,
                    alt: assetName
                });
                const blockID = $('.bynder-asset-btn.bm-select-media.active').closest('[data-block]').attr('data-block');
                wp.data.dispatch('core/block-editor').replaceBlocks( blockID, bynderReadyBlock );

            } else {
                // Add the selected image src in hidden meta field.
                $('.bm-select-media.active').parent().find('input').val(assetSrc);

                // Add the selected image src in hidden image.
                $('.bm-select-media.active').parent().find('img').attr('src', assetSrc);

                // Replace the select area into a link.
                $('.bm-select-media.active').parent().addClass('selected');

                // Change the label name.
                //$('.bm-select-media.active #bm-featured-image').text('Change Bynder Image');
                $('.bm-select-media.active').text('Change Image');

            }

        } else if ( 'product_media_bm' === requestedBy ) {
            // For both, back & front sides.

            var media_count = jQuery('.nab-product-media-item').length;
            if (media_count < 4) {
                let timestamp = Date.now();
                nabAddProdBlankImage(timestamp);
                $('#product_media_preview_' + timestamp + '').attr(
                    'src',
                    assetSrc
                ).attr(
                    'data-name',
                    assetName
                ).show();

                $('#product_media_wrapper').addClass('bynder-selection');
            } else {
                alert('Maximum 4 images are allowed!');
                return false;
            }

        } else {

            // Loader.
            $('body').addClass('is-loading');

            // For front side.
            const bmData = new FormData();
            bmData.append('action', 'bm_save_asset_url');
            bmData.append('requestedBy', requestedBy);
            bmData.append('postid', bmObj.postid);
            bmData.append('url', assetSrc);
            bmData.append('pageType', bmGetPageType());

            $.ajax({
                type: 'POST',
                url: bmObj.ajaxurl,
                data: bmData,
                contentType: false,
                processData: false,
                success() {
                    location.reload();
                },
                error() {
                    alert('Something went wrong! Please reload the page and try again.');
                    jQuery('body').removeClass('is-loading');
                },
            });
        }

        // Close the popup.
        $('.bm-modal-close').trigger('click');
    });

    // Get meta properties from Bynder and populate in
    // the form when crop button is clicked.
    $(document).on('click', '.bm-get-metas, #bm-try-again-meta', function(){
        bmGetMetas();
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
                $("body").removeClass('bm-modal-off-scroll');
            }
        }
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

    // Show the dependent meta on change.
    $(document).on('change', '.bm-meta-value select', function () {
        const dataName = $(this).parent().attr('data-name');
        const selectedVal = $(this).val();
        if( '' !== selectedVal ) {
            $('[data-show-when="'+ dataName +'"]').show();

            // Show only linked options.
            $('[data-show-when="'+ dataName +'"] [data-linked-options]').hide();
            $('[data-linked-options="'+ selectedVal +'"]').show();
        } else {
            // Hide and remove selection.
            $('[data-show-when="'+ dataName +'"]').hide();
            // if there are checkboxes.
            $('[data-show-when="'+ dataName +'"] [type="checkbox"]').prop('checked', false);
            // if its select tag.
            $('[data-show-when="'+ dataName +'"] select').val('');
        }
    });

})(jQuery);

let $ = jQuery;

function bmFetchAssets(_this) {

    // Add clicked element's ID in Media Tab's body (#bm-tab-media)
    // to auto select featured derivative when required.
    let requestedBy = _this.attr('bynder-for');
    if( _this.hasClass('bynder-asset-btn') ) {
        // If its backend, 'bynder-for' attr won't work,
        // so handling it conditionally.
        requestedBy = 'bm-block-image';
    }
    $('#bm-tab-media').attr('bynder-request-by', requestedBy);

    // Move to Media tab if not already there.
    $('[data-tab="bm-tab-assets"]').trigger('click');

    // Add popup if not available.
    if( 0 === $('#bm-main-outer').length ) {
        addBMpopup();
    }

    // Stop API call if popup closed and then opened.
    // Or if already one API call is in progress.
    // This is for a good user experience.
    let popupOpenedAgain = false;
    if( ! $("#bm-main-outer").hasClass('bm-modal-active')
        && ( undefined !== $('#assets-load-more').attr('data-fetched') || 0 !== $('.in-use').length )
    ) {

        // Update required meta options.
        bmUpdateMetaOptions();

        // If company products popup is opened
        if( 'product_media_bm' === requestedBy ) {

            // If new meta is not fetched,
            // create required meta options.
            if( 0 !== $('.bm-upload-meta-fields .single-meta').length ) {
                bmCreateMetaOptions();
            }

            // Show metas if hidden.
            $('.single-meta').show();
        } else {
            // Hide metas if company product popup is not opened.
            bmResetMetaOptions();
        }

        popupOpenedAgain = true;
    }

    // Show popup by adding a class.
    $("#bm-main-outer").addClass('bm-modal-active');
    $("body").addClass('bm-modal-off-scroll');

    if ( popupOpenedAgain ) {
        _this.addClass('active');
        return false;
    }

    // Prevent simultaneous requests.
    if( 0 !== $('.in-use').length) {
        alert('Loading... Please wait! Please contact administrator if you see this message repeatedly.');
        return false;
    }

    // Prevent further calls if the same page content requested.
    if( $('#assets-load-more').attr('data-page') === $('#assets-load-more').attr('data-fetched') ) {
        return false;
    }

    // Add active class to prevent further simultaneous requests.
    _this.addClass('active in-use');

    // Show loader by adding a class.
    $('#bm-main-outer .bm-modal-body').addClass('bm-loading');

    const bmData = new FormData();
    bmData.append('action', 'bm_fetch_assets');
    bmData.append('requestedBy', requestedBy);

    const isAdmin = $('body').hasClass('wp-admin');
    bmData.append('isAdmin', isAdmin);

    // Check if we have collection ID otherwise,
    // Add company name as a collection name to show assets specific to it.
    let collectionName = '';
    let collectionID = $('body').attr('bm-col-id');
    if( undefined !== collectionID && '' !== collectionID ) {
        bmData.append('collectionID', collectionID);
    } else {

        if( $('body').hasClass('wp-admin') ) {

            if( 0 !== $('.post-type-company .editor-post-title__input').length ) {
                collectionName = $('.post-type-company .editor-post-title__input').text();
            } else if ( 0 !== $('#select2-acf-field_5fc881bd20fa0-container').length ) {
                collectionName = $('#select2-acf-field_5fc881bd20fa0-container').text();
            }

        } else {
            collectionName = $('.amp-profile-info h2').attr('data-username');
        }

        if( undefined !== collectionName && '' !== collectionName ) {
            bmData.append('collectionName', collectionName);
        }
    }

    // Requested Page Number.
    let assetsPage = $('#assets-load-more').attr('data-page');
    bmData.append('assetsPage', assetsPage);

    // Remove previous msg div.
    $('#bm-msg').remove();

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
                $('#bm-main-outer .bm-media-main').append(result.bmHTML);

                // Save collection ID in body attr.
                if ( undefined !== result.bmCollectionID && '' !== result.bmCollectionID ) {
                    $('body').attr('bm-col-id', result.bmCollectionID);
                }

                // Hide load more.
                if( undefined !== result.hideLoadMore ) {
                    $('#assets-load-more').hide();

                } else if ( result.assetsPage ) {
                    $('#assets-load-more').show();
                }
                // Update the page number for next call,
                // and 'data-fetched' attr to prevent same call again.
                $('#assets-load-more').attr('data-page', parseInt(result.assetsPage) + 1).attr('data-fetched', result.assetsPage);

            } else if ( result.error ) {
                // Error!, show a button to try again.

                let bmTryAgain = document.createElement('p');
                bmTryAgain.setAttribute('id', 'bm-msg');

                let bmTryBtn = document.createElement('a');
                bmTryBtn.setAttribute('id', 'bm-try-again-fetch');
                bmTryBtn.setAttribute('href', 'javascript:void(0)');
                bmTryBtn.setAttribute('class', 'bm-btn-link');
                bmTryBtn.innerText = 'Try again';

                $('#bm-main-outer .bm-media-main').append(bmTryAgain);

                $('#bm-msg').html(result.error).append(bmTryBtn);

                $('#bm-main-outer .bm-modal-body').removeClass('bm-loading');
            }

            $(_this).removeClass('in-use');

            // If popup not opened for products,
            // hide & reset meta if fetched.
            let freshcheckRequestedBy = $('#bm-tab-media').attr('bynder-request-by'); // Checking again even if its already declared, to overcome popup change issues.
            if( 'product_media_bm' !== freshcheckRequestedBy ) {
                bmResetMetaOptions();
            }

            // Update & Create required meta options.
            bmUpdateMetaOptions();
            bmFillMetaValues();
            bmCreateMetaOptions();
        },
        error() {
            alert('Fetch error! Try again or contact Plugin Developer.');
            $('#bm-main-outer .bm-modal-body').removeClass('bm-loading');
            return false;
        },
    });
}

function bmGetPageType() {
    let bmPageType = '';
    if( 0 !== $('.single-company .amp-profile-info h2').length ) {
        bmPageType = 'company';

        // For User profile.
    } else if ( 0 !== $('.amp-profile-info h2').length ) {
        bmPageType = 'user';
    }
    return bmPageType;
}

function bmUpdateMetaOptions() {

    const bmPageType = bmGetPageType();

    // Update 'AssetSubtype' (Media Subtype)
    const requestedBy = $('#bm-tab-media').attr('bynder-request-by');
    if( -1 !== requestedBy.indexOf('banner') ) {
        $('[data-name="AssetSubtype"]').val('EBE45F04-B19F-4A11-A1E491DD01C070B7');
        $('[data-name="AssetSubtype"]').attr('data-value', 'Cover Image');
    } else {
        $('[data-name="AssetSubtype"]').val('1B38FAF6-C77D-44C1-B5191A3F0CB8DBCF');
        $('[data-name="AssetSubtype"]').attr('data-value', 'Headshot');
    }

    // Update 'UserType' (Asset Subject)
    if( 'company' === bmPageType ) {
        $('[data-name="UserType"]').val('60E60C0B-71BE-4627-8044F23B0329DF75');
        $('[data-name="UserType"]').attr('data-value', 'Exhibitor / Vendor / Sponsor / Advertiser');
    } else {
        $('[data-name="UserType"]').val('9AF2B586-571D-4238-B4C1EBC65452FD13');
        $('[data-name="UserType"]').attr('data-value', 'Attendee / User');
    }

}

function bmGetMetas() {

    // Fetch meta only if its a product popup.
    const requestedBy = $('#bm-tab-media').attr('bynder-request-by');
    if( 'product_media_bm' !== requestedBy ) {
        // Show the upload button.
        $('#bm-upload-btn').show().removeAttr('disabled');

        return false;
    }

    // Return if the form fields div does not exist.
    if( 0 === $('.bm-upload-meta-fields').length ) {
        alert('Form meta container is not available, Try again or contact administrator.');
        return false;
    }

    // Return if meta already fetched.
    if( 0 !== $('.bm-upload-meta-fields .single-meta').length ) {
        // Show if made hidden for other popups.
        $('.bm-upload-meta-fields .single-meta').show();

        // Show the upload button.
        $('#bm-upload-btn').show().removeAttr('disabled');

        return false;
    }

    // Fetch metas from Bynder.
    const bmData = new FormData();
    bmData.append('action', 'bm_get_metas');

    // Activate loader.
    $('#bm-main-outer .bm-modal-body').addClass('bm-loading');

    // Remove previous msg div.
    $('#bm-msg').remove();

    $.ajax({
        type: 'POST',
        url: bmObj.ajaxurl,
        data: bmData,
        contentType: false,
        processData: false,
        success(result) {
            result = JSON.parse(result);
            if( result.bmHTML ) {
                $('.bm-upload-meta-fields').append(result.bmHTML);

                // Show the upload button.
                $('#bm-upload-btn').show().removeAttr('disabled');

            } else if ( result.error ) {
                // Error!, show a button to try again.

                let bmTryAgain = document.createElement('p');
                bmTryAgain.setAttribute('id', 'bm-msg');
                $('.bm-upload-meta-fields').append(bmTryAgain);

                let bmTryBtn = document.createElement('a');
                bmTryBtn.setAttribute('id', 'bm-try-again-meta');
                bmTryBtn.setAttribute('href', 'javascript:void(0)');
                bmTryBtn.setAttribute('class', 'bm-btn-link');
                bmTryBtn.innerText = 'Try again';

                $('#bm-msg').html(result.error).append(bmTryBtn);
            }
            $('#bm-main-outer .bm-modal-body').removeClass('bm-loading');
        },
        error() {
            alert('Error occured! Try again or contact Plugin Developer.');
            $('#bm-main-outer .bm-modal-body').removeClass('bm-loading');
        },
    });
}

function bmFillMetaValues() {

    const userTypeName = $('.amp-profile-info h2').text();
    if( undefined !== userTypeName && '' !== userTypeName ) {
        $('[data-name="UserTypeName"]').attr('data-value', userTypeName);
    }

    const bmTags = $('.amp-profile-info h2').attr('data-tags');
    if( undefined !== bmTags && '' !== bmTags ) {
        $('#bmTags').val(bmTags);
    }
}

function bmCreateMetaOptions() {
    $('.bm-upload-meta-fields input').each(function () {
        if ('' === $(this).val()) {
            let key = $(this).attr('data-name');
            let val = $(this).attr('data-value');
            if( '' !== key && '' !== val ) {
                bmCreateMetaAJAX(key, val);
            }
        }
    });
}

function bmCreateMetaAJAX(key, val) {

    $('#bm-upload-form').addClass('meta-creation');

    const bmData = new FormData();
    bmData.append('action', 'bm_create_meta_options');

    bmData.append(key, val);

    $.ajax({
        type: 'POST',
        url: bmObj.ajaxurl,
        data: bmData,
        contentType: false,
        processData: false,
        success(result) {
            result = JSON.parse(result);
            if( result.bmHTML ) {
                // Meta option created successfully.
                //$('.bm-upload-meta-fields').attr('data-UserTypeName', result.bmHTML);
                $('[data-name="' + key + '"]').val(result.bmHTML);
                $('[data-name="' + key + '"]').attr('data-value', val);

                $('#bm-upload-form').removeClass('meta-creation');
            }
        },
        error() {
            $('#bm-upload-form').removeClass('meta-creation');
            return true;
        },
    });
}

/**
 * Hide & Reset meta options if popup not opened for company products.
 */
function bmResetMetaOptions() {
    $('.single-meta').hide();
    // Reset checkboxes.
    $('.single-meta [type="checkbox"]').prop('checked', false);
    // Reset select tags.
    $('.single-meta select').val('');
}

function bmUploadToBynder() {

    // Variables and constants.
    const cropFileName = $('.crop-active').attr('data-filename');

    const formData = new FormData();
    formData.append('action', 'bm_upload_asset');

    // Pass the image file name as the third parameter if necessary.
    const collectionID = $('body').attr('bm-col-id');
    if( undefined !== collectionID && '' !== collectionID ) {
        formData.append('collectionID', collectionID);
    }

    // Send required details to delete transient after upload.
    const requestedBy = $('#bm-tab-media').attr('bynder-request-by');
    formData.append('requestedBy', requestedBy);

    window.cropper.getCroppedCanvas().toBlob((blob) => {

        if( null === blob ) {
            alert('Error! Please select image again.');
            $('#bm-main-outer .bm-modal-body').removeClass('bm-upload-loader bm-loading');
            removeCropCanvas();
            return false;
        }

        formData.append('croppedImage', blob, cropFileName);

        // Form fields.
        formData.append('formFields', $('#bm-upload-form').serialize());

        $.ajax({
            type: 'POST',
            url: fcObj.ajaxurl,
            data: formData,
            contentType: false,
            processData: false,
            success(result) {
                result = JSON.parse(result);
                if( 'success' === result.status ) {

                    $('#bm-main-outer .bm-modal-body').removeClass('bm-upload-loader bm-loading');

                    // Jump to media tab and re-fetch.

                    // Remove the existing HTML from media tab.
                    //$('.bm-media-main').html('');

                    // Add class to remove canvas after new assets fetched.
                    $('.bm-modal-main').addClass('just-uploaded');
                    //$('#assets-load-more').attr('data-page', 1).hide();
                    //$('#assets-load-more').removeAttr('data-fetched');

                } else if ( result.error ) {
                    console.log( result.error );
                    $('#bm-main-outer .bm-modal-body').removeClass('bm-upload-loader bm-loading');
                    $('#bm-precess-info').append('<p>Something went wrong! Try again!</p>').show();
                }

                // Remove the canvas.
                if( $('.bm-modal-main').hasClass('just-uploaded') ) {

                    removeCropCanvas();

                    /*$('#bm-precess-info').html('<p>Congratulations! Image uploaded successfully! Auto fetch will start in 3 seconds...</p>').show();

                    setTimeout(function (){
                        $('[data-tab="bm-tab-assets"], .bm-select-media.active').trigger('click');
                        // Reset messsage div.
                        $('#bm-precess-info').html('').hide();
                    }, 3000);*/

                    // Trigger Auto Select recently uploaded image.
                    $('[data-tab="bm-tab-assets"]').trigger('click');
                    $('#bm-tab-assets').prepend('<p id="bm-msg" style="color:#1a841a;font-weight: 700;">Congratulations! Image uploaded successfully!</p>').show();

                    $('.bm-modal-main').removeClass('just-uploaded');

                    // Hide & Reset Meta.
                    bmResetMetaOptions();

                    addUploadedAsset(result);
                }

            },
            error() {
                alert('Upload error! Try again or contact administrator.');
                $('#bm-main-outer .bm-modal-body').removeClass('bm-upload-loader bm-loading');
            },
        });
    });
}

function addUploadedAsset(result) {

    if ('' !== result.bmHTML) {

        $('#bm-msg').remove();

        // Add latest image at first position.
        $('#bm-main-outer .bm-media-main').prepend(result.bmHTML);

        // If load more is visible, remove the last item.
        if ($('#assets-load-more').is(':visible')) {
            $('.bm-media-main .bm-item:last-child').remove();
        }

        $('.bm-media-main .bm-item:first-child [data-name="Original"]').prop('checked', true);
        $('.bm-media-main .bm-item:first-child .bm-btn').trigger('click');


    } else if (undefined !== result.mediaid && '' !== result.mediaid) {

        if( 0 !== $('#bm-uploaded-request').length ) {
            let tryCount = parseInt( $('#bm-uploaded-request span').attr('data-try') );
            tryCount = tryCount + 1;
            $('#bm-uploaded-request span').html('Trying again.. (attempt '+ tryCount +')').attr('data-try', tryCount);
        } else {
            $('#bm-msg').append('<p id="bm-uploaded-request">Getting the uploaded image.. <span data-try="1"></span></p>').show();
        }

        // Re-trying to get uploaded image.
        const assetData = new FormData();
        assetData.append('action', 'bm_get_single_asset');

        // Form fields.
        assetData.append('mediaid', result.mediaid);

        $.ajax({
            type: 'POST',
            url: fcObj.ajaxurl,
            data: assetData,
            contentType: false,
            processData: false,
            success(result2) {
                result2 = JSON.parse(result2);
                result2.mediaid = result.mediaid;
                addUploadedAsset(result2);
            }
        });

    }
}

function addBMpopup() {

    if( 0 === jQuery('#bm-main-outer').length ) {

        jQuery('.bm-select-media').addClass('creating-popup');
        //jQuery('.bm-select-media').addClass('disabled').text('Loading...');

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
                    //jQuery('.bm-select-media').removeClass('disabled').text('Select Bynder Image');

                    // Remove class to enable popup.
                    jQuery('.bm-select-media').removeClass('creating-popup');
                }
            },
            error() {
                alert('Fetch error! Try again or contact Plugin Developer.');
            },
        });
    }
}
