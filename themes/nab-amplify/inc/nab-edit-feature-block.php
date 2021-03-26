<?php
global $post;
?>
<div id="addProductModal" class="nab-modal nab-modal-with-form theme-dark nab-modal-active">
	<div class="nab-modal-inner">
		<div class="modal-content">
			<span class="nab-modal-close fa fa-times"></span>
			<div class="modal-content-wrap">
				<div class="add-product-content-popup">
					<h2>Update Featured Block</h2>
					<div class="form-wrapper">
						<form method="post" id="nab-edit-product-form" enctype="multipart/form-data">
							<div class="form-row">
								<label for="">Add Featured Image <i class="fa fa-info-circle" aria-hidden="true" data-bp-tooltip="Acceptable File Types: .jpeg. .jpg, .png. Ideal photo size is 1200x400"></i></label>
								<div class="file-input">
									<input type="file" id="product_featured_image" class="button" name="product_featured_image">
								</div>
								<div class="nab-action left-action">
									<div class="nab-action-row">
										<i class="action-add fa fa-plus"></i>
									</div>
								</div>
								
							</div>
							<div class="form-row preview_product_featured_image" style="<?php if ($block_data['bg_image'] == '') {
																							echo 'display:none';
																						} ?>">

								<div class="nab-product-media-item">
									<?php if ($block_data['bg_image'] !== '') {
									?>
									<button type="button" class="nab-remove-featured-attachment" data-action="bg_image"><i class="fa fa-times" aria-hidden="true"></i></button>
										<img id="product_featured_preview" src="<?php echo $block_data['bg_image']; ?>" />
									<?php
									} ?>
								</div>


							</div>
							
							<div class="form-row">
								<label for="">Title</label>
								<input type="text" class="limited-char-field" placeholder="Type Here..." name="nab_featured_block_title" id="nab_featured_block_title" value="<?php echo isset($block_data['title']) ? $block_data['title'] : ''; ?>"/>
							</div>
							
							<div class="form-row">
								<label for="">Subtitle</label>
								<input type="text" class="input-text nab-featured-block-posted-by limited-char-field" name="nab_featured_block_posted_by" id="nab_featured_block_posted_by" value="<?php echo isset($block_data['author']) ? $block_data['author'] : ''; ?>">
								<span class="info-msg"><span id="character-count-featured-posyby">60 Characters Remaining</span></span>
							</div>
							
							<div class="form-row">
								<label for="">Description</label>
								<textarea class="limited-char-field" placeholder="Type Here..." name="nab_featured_block_description" id="nab_featured_block_description"><?php echo isset($block_data['description']) ? $block_data['description'] : ''; ?></textarea>
								<span class="info-msg"><span id="character-count-featured-desc">200 Characters Remaining</span></span>
							</div>
							<div class="form-row">
								<label for="">Button Text</label>
								<input type="text" class="input-text limited-char-field nab-featured-block-button-label" name="nab_featured_block_button_label" id="nab_featured_block_button_label" value="<?php echo isset($block_data['button_label']) ? $block_data['button_label'] : ''; ?>">
								<span class="info-msg"><span id="character-count-featured-btnlabel">60 Characters Remaining</span></span>
							</div>
							<div class="form-row">
								<label for="">Button Link </label>
								<input type="text" class="input-text nab-featured-block-button-link" name="nab_featured_block_button_link" id="nab_featured_block_button_link" value="<?php echo isset($block_data['button_link']) ? $block_data['button_link'] : ''; ?>">
							</div>
							
							<div class="form-row">
								<input type="button" id="nab-edit-featured-block-submit" data-id="<?php echo isset($post_data->ID) ? $post_data->ID : 0 ?>" class="btn btn-submit" value="Update">
								<input type="hidden" name="nab_company_id" id="nab_company_id" value="<?php echo $block_data['company_id']; ?>" />
							</div>
						</form>
						<p>NAB Amplify reserves the right to remove any content that is deemed inappropriate. See the <a class="btn-link" href="<?php echo site_url(); ?>/nab-virtual-events-code-of-conduct/">Code of Conduct</a> for details.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>