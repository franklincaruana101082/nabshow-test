<?php
global $post;
?>
<div id="addProductModal" class="nab-modal theme-dark nab-modal-active">
	<div class="nab-modal-inner">
		<div class="modal-content">
			<div class="modal-content-wrap">
				<span class="nab-modal-close">Close</span>
				<div class="add-product-content-popup">
					<h2>Update Featured Block</h2>
					<div class="form-wrapper">
						<form method="post" id="nab-edit-product-form" enctype="multipart/form-data">



							<div class="form-row">
								<label for="">Add Featured Image</label>
								<div class="file-input"><input type="file" id="product_featured_image" class="button" name="product_featured_image">

								</div>
								<div class="nab-action left-action">
									<div class="nab-action-row">
										<i class="action-add fa fa-plus"></i>
									</div>
								</div>
								<div class="nab-action right-action">

									<div class="nab-action-row">
										<i class="action-edit fa fa-pencil"></i>
									</div>
								</div>

							</div>
							<div class="form-row preview_product_featured_image" style="<?php if ($block_data['bg_image'] == '') {
																							echo 'display:none';
																						} ?>">

								<div class="nab-product-media-item">
									<?php if ($block_data['bg_image'] !== '') {
									?>
										<img id="product_featured_preview" src="<?php echo $block_data['bg_image']; ?>" />
									<?php
									} ?>
								</div>


							</div>

							<div class="form-row">
								<label for="">Headline</label>
								<textarea placeholder="Type Here..." name="nab_featured_block_headline" id="nab_featured_block_headline"><?php echo isset($block_data['headline']) ? $block_data['headline'] : ''; ?></textarea>
								<span class="info-msg"><span class="character-count-copy">200</span> Characters Remaining</span>
							</div>
							<div class="form-row">

								<div class="form-row">
									<label for="">Posted By</label>
									<input type="text" class="input-text nab-featured-block-posted-by" name="nab_featured_block_posted_by" id="nab_featured_block_posted_by" value="<?php echo isset($block_data['author']) ? $block_data['author'] : ''; ?>">
								</div>


							</div>
							<div class="form-row">
								<label for="">Description</label>
								<textarea placeholder="Type Here..." name="nab_featured_block_description" id="nab_featured_block_description"><?php echo isset($block_data['description']) ? $block_data['description'] : ''; ?></textarea>
								<span class="info-msg"><span class="character-count-copy">200</span> Characters Remaining</span>
							</div>
							<div class="form-row">

								<div class="form-row">
									<label for="">Button Label </label>
									<input type="text" class="input-text nab-featured-block-button-label" name="nab_featured_block_button_label" id="nab_featured_block_button_label" value="<?php echo isset($block_data['button_label']) ? $block_data['button_label'] : ''; ?>">
								</div>


							</div>
							<div class="form-row">

								<div class="form-row">
									<label for="">Button Link </label>
									<input type="text" class="input-text nab-featured-block-button-link" name="nab_featured_block_button_link" id="nab_featured_block_button_link" value="<?php echo isset($block_data['button_link']) ? $block_data['button_link'] : ''; ?>">
								</div>


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