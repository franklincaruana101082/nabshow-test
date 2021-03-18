<?php
check_ajax_referer( 'nab-ajax-nonce', 'nabNonce' );

$company_id		= filter_input( INPUT_POST, 'company_id', FILTER_SANITIZE_NUMBER_INT );
$content_copy	= nab_get_wp_editor( '', 'nab_content_copy', array('media_buttons' => false, 'quicktags' => false, 'tinymce' => array('toolbar1' => 'bold,italic,strikethrough,bullist,numlist,blockquote,hr,alignleft,aligncenter,alignright,link,unlink', 'toolbar2' => '', 'content_css' => get_template_directory_uri() . '/assets/css/nab-front-tinymce.css')));
?>
<div id="addProductModal" class="nab-modal nab-modal-with-form theme-dark nab-modal-active">
	<div class="nab-modal-inner">
		<div class="modal-content">
			<span class="nab-modal-close fa fa-times"></span>
			<div class="modal-content-wrap">
				<div class="add-product-content-popup">
					<h2>Add Content</h2>
					<p class="content-info-msg">Please use the form below to submit up to 3 pieces of editorial content for NAB Amplify. Our content team will review and post this content on your behalf based on our editorial calendar, reaching out with any questions or concerns. NOTE: Once you submit, you will not be able to make edits, so please finalize your submission before you submit.</p>
					<div class="form-wrapper">
						<form method="post" id="nab-add-content-form" enctype="multipart/form-data">
							<div class="form-row">
								<label for="content-title">Title</label>
								<input type="text" required maxlength="60" class="input-text" name="content_title" id="content-title">								
							</div>														
							<div class="form-row">								
								<label for="content-featured-image">Featured Image <i class="fa fa-info-circle" aria-hidden="true" data-bp-tooltip="Acceptable File Types: .jpeg. .jpg, .png. Ideal photo size is 1200x630"></i></label>
								<div class="form-control">
									<div class="file-input">
										<input type="file" id="content-featured-image" class="button" name="featured_image">
									</div>
									<div class="nab-action left-action">
										<div class="nab-action-row">
											<i class="action-add fa fa-plus"></i>
										</div>
									</div>									
								</div>								
							</div>
							<div class="form-row common-img-wrapper" id="content_media_wrapper"></div>
							<div class="form-row">
								<label for="content-copy">Copy</label>
								<textarea name="content_copy" id="content-copy"><?php echo isset( $content_copy ) ? $content_copy : ''; ?></textarea>								
							</div>
							<p class="form-field-error global-notice" style="display: none;"></p>
							<div class="form-row">								
								<input type="button" id="nab-add-content-submit" class="btn btn-submit" value="Submit">
								<input type="hidden" name="nab_company_id" id="nab_company_id" value="<?php echo isset( $company_id ) ? $company_id : 0; ?>" />
							</div>
						</form>
						<p>NAB Amplify reserves the right to remove any content that is deemed inappropriate. See the <a class="btn-link" href="<?php echo site_url();?>/nab-virtual-events-code-of-conduct/">Code of Conduct</a> for details.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>