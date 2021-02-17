(function ($) {

    // Ready.
    $(document).ready(function () {

        // Initiate cropper.
        let cropper;

        // Upload user images using ajax.
        $('.cropper_img_file').on('change', function (e) {
            e.preventDefault();

            // Set activate class in the current file input to
            // get the required details when crop button is clicked.
            let cropper_input = $(this);
            cropper_input.addClass( 'crop-active' );

            let ratio = 'profile_picture_file' === cropper_input.attr( 'id' ) ? 1 : 4;

            // Create a white board for cropping if not exist already.
            if( 0 === $('#cropper-board').length ) {

                // Add a default popup.
                nabAddPopup('cropper-board');

                // Get added popup's inner div to add extra content.
                let nabModalContentWrap = $('#cropper-board .modal-content-wrap');

                // Default image.
                let cropperImage = document.createElement( 'img');
                cropperImage.setAttribute('id', 'cropper-image');
                nabModalContentWrap.append(cropperImage);

                // Crop button
                let cropperButton = document.createElement( 'a');
                cropperButton.setAttribute('id', 'cropper-button');
                cropperButton.setAttribute('class', 'button');
                cropperButton.setAttribute('href', 'javascript:void(0)');
                cropperButton.innerText = 'Crop';
                nabModalContentWrap.append(cropperButton);

                // Crop cancel button
                let cropperCancel = document.createElement( 'a');
                cropperCancel.setAttribute('id', 'confirmed-no');
                cropperCancel.setAttribute('class', 'cropper-cancel button nab-modal-remove');
                cropperCancel.setAttribute('href', 'javascript:void(0)');
                cropperCancel.innerText = 'Cancel';
                nabModalContentWrap.append(cropperCancel);

                let bmAdjustCropAction = document.createElement('div');
                bmAdjustCropAction.setAttribute('class', 'bm-adjust-crop-actions');
                nabModalContentWrap.append(bmAdjustCropAction);

                let bmCropZoomAdjust = document.createElement('div');
                bmCropZoomAdjust.setAttribute('class', 'bm-crop-adjust bm-zoom-ad');
                bmAdjustCropAction.append(bmCropZoomAdjust);

                let bmCropZoomOutAdjust = document.createElement('div');
                bmCropZoomOutAdjust.setAttribute('class', 'bm-crop-adjust bm-zoom-out');
                bmAdjustCropAction.append(bmCropZoomOutAdjust);

                let bmZoomIn = document.createElement('a');
                bmZoomIn.setAttribute('class', 'bm-zoom-in fa fa-plus');
                bmZoomIn.setAttribute('href', 'javascript:void(0)');
                bmCropZoomAdjust.append(bmZoomIn);

                let bmZoomOut = document.createElement('a');
                bmZoomOut.setAttribute('class', 'bm-zoom-out fa fa-minus');
                bmZoomOut.setAttribute('href', 'javascript:void(0)');
                bmCropZoomOutAdjust.append(bmZoomOut);
            }

            // Display the selected image.
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
                    cropper = new Cropper(cropperImg, {
                        aspectRatio: ratio,
                        fillColor: '#fff',
                        imageSmoothingEnabled: false,
                        imageSmoothingQuality: 'high',
                    });
                };
                reader.readAsDataURL(cropper_input_file.files[0]);
            }
        });

        // Destroy cropper canvas and remove active
        // class from input file when popup is closed.
        $(document).on('click', '#cropper-board .nab-modal-remove, #cropper-board .nab-modal-close', function () {
            removeCropCanvas(cropper);
        });

        $(document).on('click touchstart', function (e) {
            if ($(e.target).is('.nab-modal-inner')) {
                removeCropCanvas(cropper);
            }
        });

        // Crop the selected area and upload.
        $(document).on('click', '#cropper-button', function () {

            if( '' !== cropper && undefined !== cropper ) {

                // Add a loader.
                $('body').addClass('is-loading');

                // Get the details of crop active file input.
                const cropInputName = $('.crop-active').attr('name');
                const cropAction = $('.crop-active').attr('data-action');
                const cropFileName = $('.crop-active').attr('data-filename');

                // The default value for the second parameter of `toBlob` is 'image/png', change it if necessary.
                cropper.getCroppedCanvas().toBlob((blob) => {

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
                            location.reload()
                        },
                        error() {
                            alert('Upload error! Try again or contact Front Cropper Plugin Developer.');
                        },
                    });
                }/*, 'image/png' */);
            }
        });
    });
})(jQuery);

function removeCropCanvas(cropper) {
    if( '' !== cropper && undefined !== cropper ) {
        cropper.destroy();
    }
    jQuery('.crop-active').removeClass('crop-active');
    jQuery('#cropper-image').removeAttr('src');
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
