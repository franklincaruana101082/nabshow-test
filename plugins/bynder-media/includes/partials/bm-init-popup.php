<?php
/**
 * Assets Popup HTML.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>
<div id="bm-main-outer" class="bm-modal-main">
    <div class="bm-modal-overlay">
        <div class="bm-modal-wrap">
            <div class="bm-modal-header">
                <div class="bm-tab-list">
                    <ul>
                        <li class="bm-tab-active">
                            <a href="javascript:void(0)" class="bm-tab-item" data-tab="bm-tab-assets">Assets</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" class="bm-tab-item" data-tab="bm-tab-upload">Upload Asset</a>
                        </li>
                    </ul>
                </div>
                <div class="bm-modal-action">
                    <span class="bm-modal-close dashicons dashicons-no-alt"></span>
                </div>
            </div>
            <div class="bm-modal-body">
                <div class="bm-tab-main">
                    <div id="bm-tab-assets" class="bm-tab-content bm-tab-active">
                        <div id="bm-tab-media">
                            <div class="bm-media-main"></div>
                        </div>
                        <div class="bm-load-more">
                            <a class="bm-load-more-btn" href="javascript:void(0)" id="assets-load-more" data-page="1">Load More</a>
                        </div>
                    </div>
                    <div id="bm-tab-upload" class="bm-tab-content">
                        <div id="bm-uploaded-media">
                        </div>
                        <form id="bm-upload-form" method="post" enctype="multipart/form-data" bynder-for="company_profile_pic">
                            <div class="bm-upload-main">
                                <div class="bm-drag-drop-area">
                                    <div class="bm-drag-drop-inside">
                                        <div class="bm-drag-drop-buttons">
                                            <label id="bm-browse-button" for="profile_picture_file">Select File</label>
                                            <input id="profile_picture_file" type="file" class="cropper_img_file" data-action="nab_amplify_upload_images" name="company_profile_picture"/>
                                        </div>
                                        <div class="bm-show-cropping-area">
                                            <div class="bm-adjust-crop-actions">
                                                <div class="bm-crop-adjust">
                                                    <a href="javascript:void(0)" class="bm-zoom-in fa fa-plus" onclick="fcZoomIn();"></a>
                                                </div>
                                                <div class="bm-crop-adjust">
                                                    <a href="javascript:void(0)" class="bm-zoom-out fa fa-minus" onclick="fcZoomOut();"></a>
                                                </div>
                                            </div>
                                            <div class="bm-show-cropped-thumb"></div>
                                            <div class="bm-show-cropped-canvas bm-crop-upload"></div> <!-- will act as a canvas -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bm-upload-meta-fields">
                                <input type="hidden" data-name="AssetType" name="metas[9C244856-6B94-4F0B-B99EAE34CA18BA70]" value="9A72A780-A9E6-40B1-BB63014424AE6BBF" data-value="Images" />
                                <input type="hidden" data-name="AssetSubtype" name="metas[69D94DC0-A8C9-41F9-805BF14AF3E55514]" value="1B38FAF6-C77D-44C1-B5191A3F0CB8DBCF" data-value="Headshot" />
                                <input type="hidden" data-name="UserType" name="metas[F84E5EC9-19A2-4588-8691FD385CBD0786]" value="9AF2B586-571D-4238-B4C1EBC65452FD13" data-value="Attendee / User" />
                                <input type="hidden" data-name="UserTypeName" name="metas[62BA8F9E-E03F-4636-8CC1784BAE7C738D]" value="" data-value="" />
                                <input type="hidden" data-name="EventType" name="metas[B3477514-13BD-4E88-ACBDDAC95395246B]" value="95570080-CAC4-4EEB-9303B724525AB514" data-value="NAB Amplify" />
                                <input type="hidden" data-name="Channel" name="metas[B3FD1CDB-9E2E-49B1-AC233CCA40C5257A]" value="86640051-742A-41BB-86D485534C13C1D5" data-value="Website" />
                            </div>
                            <div class="bm-submit-wrap">
                                <input type="submit" value="Upload" id="bm-upload-btn" class="bm-btn-pink" disabled/>
                            </div>
                            <div id="bm-precess-info">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
