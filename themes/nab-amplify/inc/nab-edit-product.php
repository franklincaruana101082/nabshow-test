<?php
global $post;
?>
<div id="addProductModal" class="nab-modal theme-dark nab-modal-active">
	<div class="nab-modal-inner">
		<div class="modal-content">
			<div class="modal-content-wrap">
				<span class="nab-modal-close">Close</span>
				<div class="add-product-content-popup">
					<h2><?php echo isset($post_data->ID) ? "Update" : "Add"; ?> Product</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore</p>
					<div class="form-wrapper">
						<form method="post" id="nab-edit-product-form" enctype="multipart/form-data">
							<div class="form-row">
								<label for=""><?php echo isset($post_data->ID) ? "Update" : "Add"; ?> Product</label>
								<input type="text" required="true" class="input-text add-product" name="nab_product_title" value="<?php echo isset($post_data->post_title) ? $post_data->post_title : ''; ?>" id="product_title">
								<div class="nab-action">
									<div class="nab-action-row">
										<span class="check-label">Featured Product:</span>
										<label class="nab-check-btn">
											<input type="checkbox" name="nab_feature_product" id="nab_feature_product" <?php if ($post_data->is_feature_product === '1') {
																															echo 'checked="checked"';
																														} ?>>
											<span class="checkmark-switch"></span>
										</label>
									</div>
									<div class="nab-action-row">
										<i class="action-edit fa fa-pencil"></i>
									</div>
								</div>
							</div>
							<div class="form-row">
								<label for="">Add Category</label>
								<div class="select-dark-simple select-multiple">
									<select name="product_categories[]" multiple="true" id="product_categories">
										<option value=""></option>
										<?php foreach ($terms as $term) {
										?>
											<option value="<?php echo $term->slug; ?>" <?php if (in_array($term->slug, $post_data->categories)) {
																							echo "selected";
																						} ?>><?php echo $term->name; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
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
							<div class="form-row preview_product_featured_image" id="product_featured_image_wrapper" style="<?php if ($post_data->product_thumbnail == '') {
																							echo 'display:none';
																						} ?>">

								
									<?php if ($post_data->product_thumbnail_id !== '0') {
									?>
									<div class="nab-product-media-item">
									<button type="button" class="nab-remove-attachment" data-attach-id="<?php echo $post_data->product_thumbnail_id;?>"><i class="fa fa-times" aria-hidden="true"></i></button>
										<img id="product_featured_preview" src="<?php echo $post_data->product_thumbnail; ?>" />
										</div>
									<?php
									} ?>
								


							</div>
							<div class="form-row">
								<label for="">Media <span>Acceptable File Types: .jpeg. .jpg, .png.</span></label>
								<div class="form-control">
									<div class="file-input"><input type="file" id="product_medias" class="button" name="product_medias[]" multiple="multiple">

									</div>
									<div class="nab-action left-action">
										<div class="nab-action-row">
											<i class="action-add fa fa-plus"></i>
										</div>
									</div>
									<div class="nab-action right-action">
										<div class="nab-action-row">
											<span class="check-label">B-Stock:</span>
											<label class="nab-check-btn">
												<input type="checkbox" checked="checked" name="nab_product_b_stock" id="nab_product_b_stock" <?php if ($post_data->is_product_b_stock === '1') {
																																					echo 'checked="checked"';
																																				} ?>>
												<span class="checkmark-switch"></span>
											</label>
										</div>
										<div class="nab-action-row">
											<span class="check-label">Sales Item:</span>
											<label class="nab-check-btn">
												<input type="checkbox" name="nab_product_sales_item" id="nab_product_sales_item" <?php if ($post_data->is_product_sales_item === '1') {
																																		echo 'checked="checked"';
																																	} ?>>
												<span class="checkmark-switch"></span>
											</label>
										</div>
										<div class="nab-action-row">
											<i class="action-edit fa fa-pencil"></i>
										</div>
									</div>
								</div>

							</div>
							<div class="form-row" id="product_media_wrapper">
								<?php if (isset($post_data->product_media)) {
									foreach ($post_data->product_media as $media) {
										if (!empty($media['product_media_file'])) {
								?>
											<div class="nab-product-media-item">
												<button type="button" class="nab-remove-attachment" data-attach-id="<?php echo $media['product_media_file']['ID']; ?>"><i class="fa fa-times" aria-hidden="true"></i></button>
												<?php if ($media['product_media_file']['type'] === 'image') { ?>
													<img src="<?php echo $media['product_media_file']['url']; ?>" />
												<?php }
												if ($media['product_media_file']['type'] !== 'image') {
												?>
													<span><?php echo $media['product_media_file']['title']; ?></span>
												<?php
												} ?>
											</div>
								<?php
										}
									}
								} ?>
							</div>
							<div class="form-row">
								<label for="">Product Copy</label>
								<textarea placeholder="Type Here..." name="nab_product_copy" id="nab_product_copy"><?php echo isset($post_data->product_copy) ? $post_data->product_copy : ''; ?></textarea>
								<span class="info-msg"><span class="character-count-copy">250</span> Characters Remaining</span>
							</div>
							<div class="form-row">
								<div class="form-col-6">
									<label for="">Product Specs <span>Enter specs seperated by ','</span></label>
									<textarea name="nab_product_specs" id="nab_product_specs"><?php echo isset($post_data->product_specs) ? $post_data->product_specs : ''; ?></textarea>
									<span class="info-msg"><span class="character-count-specs">250</span> Characters Remaining</span>
								</div>
								<div class="form-col-6">
									<div class="form-row">
										<label for="">Add Point of Contact</label>
										<input type="text" class="input-text point-of-contact" name="nab_product_contact" id="nab_product_contact" value="<?php echo isset($post_data->product_point_of_contact) ? $post_data->product_point_of_contact : ''; ?>">
										<div class="nab-action">
											<div class="nab-action-row">
												<i class="action-add fa fa-plus"></i>
											</div>
											<div class="nab-action-row">
												<i class="action-edit fa fa-pencil"></i>
											</div>
										</div>
									</div>
									<div class="form-row mb0">
										<label for="">Add Tag(s)</label>
										<input type="text" class="input-text add-tags" name="nab_product_tags" id="nab_product_tags" value="<?php if ($post_data->tags) {
																																				echo implode(',', $post_data->tags);
																																			} ?>">
										<div class="nab-action">
											<div class="nab-action-row">
												<i class="action-add fa fa-plus"></i>
											</div>
											<div class="nab-action-row">
												<i class="action-edit fa fa-pencil"></i>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-row">
								<div class="form-col-6">
									<div class="form-row mb0">
										<label for="">Add External Link</label>
										<input type="text" class="input-text external-link" name="nab_product_external_link" id="nab_product_external_link" class="input-text external-link" value="<?php echo isset($post_data->product_external_link) ? $post_data->product_external_link : ''; ?>">
										<div class="nab-action">
											<div class="nab-action-row">
												<i class="action-edit fa fa-pencil"></i>
											</div>
										</div>
									</div>
								</div>
								<div class="form-col-6 ">
									<div class="form-row mb0">
										<label for="">Add External Text</label>
										<input type="text" name="nab_product_external_text" id="nab_product_external_text" class="input-text external-link" value="<?php echo isset($post_data->product_external_link_text) ? $post_data->product_external_link_text : ''; ?>">
										<div class="nab-action">
											<div class="nab-action-row">
												<i class="action-edit fa fa-pencil"></i>
											</div>
										</div>
									</div>
								</div>

							</div>
							<div class="form-row toggle-button">
								<div class="nab-action">
									<div class="nab-action-row">
										<div class="toggle-wrap">
											<span class="toggle-label">Discussion</span>
											<label class="nab-toggle-btn">
												<input type="checkbox" <?php if ($post_data->comment_status === 'open') {
																			echo 'checked="checked"';
																		} ?> name="nab_product_discussion" id="nab_product_discussion">
												<div class="toggle-switch"></div>
											</label>
											<span class="toggle-status">On</span>
										</div>
									</div>
								</div>
							</div>
							<div class="form-row">
								<input type="button" id="nab-edit-product-submit" data-id="<?php echo isset($post_data->ID) ? $post_data->ID : 0 ?>" class="btn btn-submit" value="<?php echo isset($post_data->ID) ? "Update" : "Add"; ?>">
								<input type="hidden" name="nab_product_id" id="nab_product_id" value="<?php echo isset($post_data->ID) ? $post_data->ID : 0 ?>" />
								<input type="hidden" name="nab_company_id" id="nab_company_id" value="<?php echo $post_data->company_id; ?>" />
							</div>
						</form>
						<p>NAB Amplify reserves the right to remove any content that is deemed inappropriate. See the <a class="nab-code-of-conduct" href="<?php echo site_url();?>/nab-virtual-events-code-of-conduct/">Code of Conduct</a> for details.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>