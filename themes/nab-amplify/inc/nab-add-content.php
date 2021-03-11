<?php
check_ajax_referer( 'nab-ajax-nonce', 'nabNonce' );

$company_id = filter_input( INPUT_POST, 'company_id', FILTER_SANITIZE_NUMBER_INT );
?>
<div id="addProductModal" class="nab-modal nab-modal-with-form theme-dark nab-modal-active">
	<div class="nab-modal-inner">
		<div class="modal-content">
			<span class="nab-modal-close fa fa-times"></span>
			<div class="modal-content-wrap">
				<div class="add-product-content-popup">
					<h2>Add Content</h2>
					<div class="form-wrapper">
						<form method="post" id="nab-add-edit-pdf-form" enctype="multipart/form-data">
							<div class="form-row">
								<label for="pdf-document-name">Document Name</label>
								<input type="text" required maxlength="60" class="input-text" name="document_name" id="pdf-document-name">								
							</div>														
							<div class="form-row">								
								<label for="pdf-featured-image">Featured Image <i class="fa fa-info-circle" aria-hidden="true" data-bp-tooltip="Acceptable File Types: .jpeg. .jpg, .png. Ideal photo size is 1200x630"></i></label>
								<div class="form-control">
									<div class="file-input">
										<input type="file" id="pdf-featured-image" class="button" name="featured_image">
									</div>
									<div class="nab-action left-action">
										<div class="nab-action-row">
											<i class="action-add fa fa-plus"></i>
										</div>
									</div>									
								</div>								
							</div>
							<div class="form-row" id="pdf_media_wrapper">								
							</div>
							<div class="form-row">
								<label for="pdf-description">Description</label>
								<textarea name="pdf_desc" id="pdf-description" maxlength="200"></textarea>
								<span class="info-msg"><span id="pdf-desc-count">200 Characters Remaining</span></span>
							</div>
							<div class="form-row">								
								<label for="pdf-document">Document Upload <i class="fa fa-info-circle" aria-hidden="true" data-bp-tooltip="Acceptable Document Type: .pdf."></i></label>
								<div class="form-control">
									<div class="file-input">
										<input type="file" id="pdf-document" class="button" name="pdf_document">
									</div>
									<div class="nab-action left-action">
										<div class="nab-action-row">
											<i class="action-add fa fa-plus"></i>
										</div>
									</div>									
								</div>								
							</div>
							<div class="form-row" id="pdf_document_wrapper">								
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