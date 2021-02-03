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
    						<a href="javascript:void(0)" class="bm-tab-item" data-tab="bm-tab-media">Media</a>
    					</li>
    					<li>
    						<a href="javascript:void(0)" class="bm-tab-item" data-tab="bm-tab-upload">Uploads</a>
    					</li>
    				</ul>
    			</div>
    			<div class="bm-modal-action">
    				<span class="bm-modal-close dashicons dashicons-no-alt"></span>
    			</div>
    		</div>
    		<div class="bm-modal-body">
    			<div class="bm-tab-main">
    				<div id="bm-tab-media" class="bm-tab-content bm-tab-active">
	    				
	    			</div>
	    			<div id="bm-tab-upload" class="bm-tab-content">
	    				<div class="bm-upload-main">
	    					<div class="bm-drag-drop-area">
								<div class="bm-drag-drop-inside">
									<p class="bm-drag-drop-info">Drop files to upload</p>
									<p>or</p>
									<div class="bm-drag-drop-buttons">
										<input id="bm-browse-button" type="button" value="Select Files" class="bm-btn">
									</div>
								</div>
							</div>
	    				</div>
	    			</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>