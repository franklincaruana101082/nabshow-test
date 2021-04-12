(function ($) {

    // Ready.
    $(document).ready(function () {

        // Upload user images using ajax.
        $(document).on('change', '.cropper_img_file', function (e) {
            e.preventDefault();

            // Set activate class in the current file input to
            // get the required details when crop button is clicked.
            let cropper_input = $(this);
            cropper_input.addClass( 'crop-active' );

            // Set ratio.
            const requestedBy = $('#bm-tab-media').attr('bynder-request-by');
            let ratio = undefined !== requestedBy && -1 !== requestedBy.indexOf('banner') ? 4 : 1;

            // Create a white board for cropping if not exist already.
            if( 0 === $('#cropper-board').length ) {

                // If Custom Bynder Media plugin is active,
                // use its popup instead of adding a new one.
                let nabModalContentWrap = '';
                if( 'function' === typeof addBMpopup ) {
                    nabModalContentWrap = $('.bm-crop-upload');
                    nabModalContentWrap.attr('id', 'cropper-board');

                } else {
                    // Add a default popup.
                    nabAddPopup('cropper-board');

                    // Get added popup's inner div to add extra content.
                    nabModalContentWrap = $('#cropper-board .modal-content-wrap');
                }

                // Add a default image in wrapper.
                let cropperImage = document.createElement( 'img');
                cropperImage.setAttribute('id', 'cropper-image');
                nabModalContentWrap.append(cropperImage);


                let cropperActionWrap = document.createElement('div');
                cropperActionWrap.setAttribute('class', 'bm-btn-wrap');
                nabModalContentWrap.append(cropperActionWrap);

                // Add a crop button.
                let cropperButton = document.createElement( 'a');
                cropperButton.setAttribute('id', 'cropper-button');
                cropperButton.setAttribute('class', 'bm-btn-pink bm-get-metas');
                cropperButton.setAttribute('href', 'javascript:void(0)');
                cropperButton.innerText = 'Save';
                cropperActionWrap.append(cropperButton);

                // Add a crop cancel button.
                let cropperCancel = document.createElement( 'a');
                cropperCancel.setAttribute('id', 'confirmed-no');
                cropperCancel.setAttribute('class', 'cropper-cancel bm-btn nab-modal-remove');
                cropperCancel.setAttribute('href', 'javascript:void(0)');
                cropperCancel.innerText = 'Cancel';
                cropperActionWrap.append(cropperCancel);
            }

            // Display the selected image from file input.
            $('#cropper-board').addClass('nab-modal-active');
            let cropper_input_file = cropper_input[0];
            if (cropper_input_file.files && cropper_input_file.files[0]) {

                // Add a file's actual name as an attribute of the
                // file input to use it when crop button is clicked.
                cropper_input.attr('data-filename', cropper_input_file.files[0].name);

                let reader = new FileReader();
                reader.onload = function (e) {

                    // Update src of the default image.
                    $('#cropper-image').attr('src', e.target.result);

                    // Activate the cropper on the image.
                    const cropperImg = document.getElementById('cropper-image');
                    const cropperParam = { fillColor: '#fff', imageSmoothingEnabled: false, imageSmoothingQuality: 'high',}
                    
                    // Add aspectRatio for profile picture or banner image
                    if ( 'profile_picture' === requestedBy || 'banner_image' === requestedBy ) {
                        cropperParam['aspectRatio'] = ratio;
                    }

                    window.cropper = new Cropper(cropperImg, cropperParam);

                    // Hide input button to prevent user to change image.
                    $('.bm-drag-drop-buttons').hide();

                    // Add class that canvas is active.
                    $('#bm-upload-form').addClass('canvas-active');
                };
                reader.readAsDataURL(cropper_input_file.files[0]);
            }
        });

        // Destroy cropper canvas and remove active
        // class from input file when popup is closed.
        $(document).on('click', '.nab-modal-remove, .nab-modal-close', function () {
            removeCropCanvas();
        });

        $(document).on('click touchstart', function (e) {
            if ($(e.target).is('.nab-modal-inner')) {
                removeCropCanvas();
            }
        });

        // Crop the selected area and upload.
        $(document).on('click', '#cropper-button', function () {

            if( '' !== window.cropper && undefined !== window.cropper ) {

                // Show cropped image if Bynder Media plugin is active.
                if( 0 !== $('.bm-crop-upload').length ) {

                    const croppedImg = window.cropper.getCroppedCanvas().toDataURL("image/png");

                    $('.bm-show-cropped-thumb').html('<div id="cropped-view"><img src="'+ croppedImg +'" id="bm-copped-display" /><div class="bm-btn-wrap"><a href="javascript:void(0)" class="nab-modal-close bm-btn-pink">remove</a></div></div>');

                } else {
                    // Else upload cropped image.
                    fcUploadToWP();
                }

                // Hide the canvas and file input.
                $('.bm-show-cropping-area').addClass('bm-image-cropped');
                $('.bm-drag-drop-buttons').hide();

                // Remove class that canvas is not active, its hidden for user.
                $('#bm-upload-form').removeClass('canvas-active');
            }
        });
    });
})(jQuery);

function fcZoomIn() {
    window.cropper.zoom(0.1);
}

function fcZoomOut() {
    window.cropper.zoom(-0.1);
}

function fcUploadToWP() {

    const $ = jQuery;

    // Get the details of crop active file input.
    const cropInputName = $('.crop-active').attr('name');
    const cropAction = $('.crop-active').attr('data-action');
    const cropFileName = $('.crop-active').attr('data-filename');

    // The default value for the second parameter of `toBlob` is 'image/png', change it if necessary.
    window.cropper.getCroppedCanvas().toBlob((blob) => {

        const formData = new FormData();
        // Pass the image file name as the third parameter if necessary.
        formData.append(cropInputName, blob, cropFileName);
        formData.append('action', cropAction)
        formData.append('company_id', fcObj.postID)

        jQuery.ajax({
            type: 'POST',
            url: fcObj.ajaxurl,
            data: formData,
            contentType: false,
            processData: false,
            success() {
                console.log('Upload success');
                location.reload();
            },
            error() {
                alert('Upload error! Try again or contact administrator.');
            },
        });
    }/*, 'image/png' */);
}

function removeCropCanvas() {

    const cropper = window.cropper;

    if( '' !== cropper && undefined !== cropper ) {
        cropper.destroy();
        window.cropper = '';
    }
    jQuery('.crop-active').removeClass('crop-active');
    jQuery('#cropper-image').removeAttr('src');

    // Clear file from input.
    jQuery('.cropper_img_file').val('');

    // Remove the thumbnail image from Bynder popup.
    if( 0 !== jQuery('.bm-show-cropped-thumb').length ) {
        jQuery('.bm-show-cropped-thumb').html('');
    }

    // Show the canvas and file input.
    jQuery('.bm-show-cropping-area').removeClass('bm-image-cropped');
    jQuery('.bm-drag-drop-buttons').show();

    // Remove class that canvas is not active.
    jQuery('#bm-upload-form').removeClass('canvas-active');

    // Hide the upload button and message div.
    jQuery('#bm-upload-btn, #bm-precess-info, .single-meta').hide();

    // Show input button.
    jQuery('.bm-drag-drop-buttons').show();
}

// Add a popup function if not exists.
if( 'function' !== typeof nabAddPopup ) {

    /**
     * Add a blank popup.
     *
     * @param ID Main modal ID.
     */
    function nabAddPopup(ID) {
        let nabModal = document.createElement('div')
        nabModal.setAttribute('class', 'nab-modal')
        nabModal.setAttribute('id', ID)

        let nabModalInner = document.createElement('div')
        nabModalInner.setAttribute('class', 'nab-modal-inner')
        nabModal.appendChild(nabModalInner)

        let nabModalContent = document.createElement('div')
        nabModalContent.setAttribute('class', 'modal-content')
        nabModalInner.appendChild(nabModalContent)

        let nabModalClose = document.createElement('span')
        nabModalClose.setAttribute(
            'class',
            'nab-modal-close fa fa-times confirmed-answer'
        )
        nabModalClose.setAttribute('id', 'confirmed-no')
        nabModalContent.appendChild(nabModalClose)

        let nabModalContentWrap = document.createElement('div')
        nabModalContentWrap.setAttribute('class', 'modal-content-wrap')
        nabModalContent.appendChild(nabModalContentWrap)

        jQuery('body').append(nabModal);
    }
}
