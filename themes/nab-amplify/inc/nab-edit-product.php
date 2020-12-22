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
									<label for="">Product Specs <i class="fa fa-info-circle" aria-hidden="true" data-bp-tooltip="Enter product information separated by commas. Items will display to users as a bulleted list."></i></label>
									<textarea name="nab_product_specs" id="nab_product_specs"><?php echo isset($post_data->product_specs) ? $post_data->product_specs : ''; ?></textarea>
									<span class="info-msg"><span class="character-count-specs">250</span> Characters Remaining</span>
								</div>
								<div class="form-col-6">
									<div class="form-row">
										<label for="">Add Point of Contact</label>
										<div class="select-dark-simple">
											<select class="poduct-point-of-contact" name="nab_product_contact" id="nab_product_contact">
												<?php
												if ( ! empty( $post_data->product_point_of_contact ) ) {

													$product_user = get_user_by( 'ID', $post_data->product_point_of_contact );

													if ( $product_user ) {
														
														$user_name		= $product_user->user_login;
														$user_full_name	= get_user_meta( $product_user->ID, 'first_name', true ) . ' ' . get_user_meta( $product_user->ID, 'last_name', true );

														if ( ! empty( trim( $user_full_name ) ) ) {
															$user_name .= ' (' . $user_full_name . ')';					
														}
														?>
														<option value="<?php echo esc_attr( $product_user->ID ); ?>" selected><?php echo esc_html( $user_name ); ?></option>
														<?php
													}
												}
												?>
											</select>
										</div>
									</div>
									<div class="form-row mb0">
										<label for="">Add Tag(s) <i class="fa fa-info-circle" aria-hidden="true" data-bp-tooltip="Enter keywords related to this product separated by commas. Tags will be searchable and will display to users as tabs."></i></label>
										<input type="text" class="input-text add-tags" name="nab_product_tags" id="nab_product_tags" value="<?php if ($post_data->tags) {
																																				echo implode(',', $post_data->tags);
																																			} ?>">
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
						<p>NAB Amplify reserves the right to remove any content that is deemed inappropriate. See the <a class="btn-link" href="<?php echo site_url();?>/nab-virtual-events-code-of-conduct/">Code of Conduct</a> for details.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>