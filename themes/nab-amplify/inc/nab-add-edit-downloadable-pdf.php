<?php
check_ajax_referer( 'nab-ajax-nonce', 'nabNonce' );

$pdf_id				= filter_input( INPUT_POST, 'pdf_id', FILTER_SANITIZE_NUMBER_INT );
$company_id			= filter_input( INPUT_POST, 'company_id', FILTER_SANITIZE_NUMBER_INT );
$post_data 			= isset( $pdf_id ) && ! empty( $pdf_id ) ? get_post( $pdf_id ) : new stdClass();
$pdf_dsc			= isset( $post_data->ID ) ? get_field( 'description', $post_data->ID ) : '';
$pdf_attachment_id 	= isset( $post_data->ID ) ? get_field( 'pdf_file', $post_data->ID ) : '';
?>
<div id="addProductModal" class="nab-modal nab-modal-with-form theme-dark nab-modal-active">
	<div class="nab-modal-inner">
		<div class="modal-content">
			<span class="nab-modal-close fa fa-times"></span>
			<div class="modal-content-wrap">
				<div class="add-product-content-popup">
					<h2><?php echo esc_html( isset( $post_data->ID ) ? "Update" : "Add" ); ?> Downloadable PDF</h2>
					<div class="form-wrapper">
						<form method="post" id="nab-add-edit-pdf-form" enctype="multipart/form-data">
							<div class="form-row">
								<label for="pdf-document-name">Document Name</label>
								<input type="text" required maxlength="60" class="input-text" name="document_name" id="pdf-document-name" value="<?php echo esc_attr( isset( $post_data->post_title ) ? $post_data->post_title : ''); ?>">
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
								<?php
								if ( isset( $post_data->ID ) && has_post_thumbnail( $post_data->ID ) ) {
									?>
									<div class="nab-pdf-media-item">
										<i class="fa fa-times remove-featred-img" data-attachment-id="<?php echo esc_attr( get_post_thumbnail_id( $post_data->ID ) ); ?>" aria-hidden="true"></i>
										<img src="<?php echo esc_url( get_the_post_thumbnail_url( $post_data->ID ) ); ?>" class="preview-pdf-featured-img" />
									</div>
									<?php
								}
								?>
							</div>
							<div class="form-row">
								<label for="pdf-description">Description</label>
								<textarea name="pdf_desc" id="pdf-description" maxlength="200"><?php echo esc_html( $pdf_dsc ); ?></textarea>
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
								<?php
								if ( ! empty( $pdf_attachment_id ) ) {
									?>
									<div class="nab-pdf-media-item">
										<i class="fa fa-times remove-attached-pdf" data-attachment-id="<?php echo esc_attr( $pdf_attachment_id ); ?>" aria-hidden="true"></i>
										<span class="pdf-icon fa fa-file-pdf-o"></span>
									</div>
									<?php
								}
								?>
							</div>
							<p class="form-field-error global-notice" style="display: none;"></p>
							<div class="form-row">
								<?php
								$publish_button_text = isset( $post_data->ID ) ? "Update" : "Publish";
								?>
								<input type="button" id="nab-edit-pdf-submit" class="btn btn-submit" data-status="<?php echo esc_attr( strtolower( $publish_button_text ) ); ?>" value="<?php echo esc_attr( $publish_button_text ) ?>">
								<input type="hidden" name="pdf_id" id="pdf_id" value="<?php echo isset( $post_data->ID ) ? esc_attr( $post_data->ID ) : 0;?>" />
								<input type="hidden" name="nab_company_id" id="nab_company_id" value="<?php echo isset( $company_id ) ? esc_attr( $company_id ) : 0; ?>" />
							</div>
						</form>
						<p>NAB Amplify reserves the right to remove any content that is deemed inappropriate. See the <a class="btn-link" href="<?php echo esc_url( site_url() ); ?>/nab-virtual-events-code-of-conduct/">Code of Conduct</a> for details.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>