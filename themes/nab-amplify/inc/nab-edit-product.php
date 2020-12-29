<?php
global $post;
?>
<div id="addProductModal" class="nab-modal theme-dark nab-modal-active">
	<div class="nab-modal-inner">
		<div class="modal-content">
			<span class="nab-modal-close fa fa-times"></span>
			<div class="modal-content-wrap">
				<div class="add-product-content-popup">
					<h2><?php echo isset($post_data->ID) ? "Update" : "Add"; ?> Product</h2>
					<div class="form-wrapper">
						<form method="post" id="nab-edit-product-form" enctype="multipart/form-data">
							<div class="form-row">
								<label for=""> Product Name</label>
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
								<label for="">Product Categories</label>
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
								<?php $existing_media_count =  count($post_data->product_media); ?>
								<label for="">Media <i class="fa fa-info-circle" aria-hidden="true" data-bp-tooltip="Acceptable File Types: .jpeg. .jpg, .png. Ideal photo size is 1200x400"></i></label>
								<div class="form-control">
									<div class="file-input"><input type="file" data-media-count="<?php echo $existing_media_count;?>" id="product_medias" class="button" name="product_medias[]" multiple="multiple">

									</div>
									<div class="nab-action left-action">
										<div class="nab-action-row">
											<i class="action-add fa fa-plus"></i>
										</div>
									</div>
									
								</div>

							</div>
							<div class="form-row" id="product_media_wrapper">
								<?php 
								
								if (isset($post_data->product_media)) {
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
								
								
							<?php
							
							echo $post_data->product_copy_html;
							?>
							<span class="info-msg"><span id="character-count-copy">2000 Characters Remaining</span></span>
							</div>
							<div class="form-row">
								<div class="form-col-6">
									<div class="form-row">
										<label for="">Product Specs <i class="fa fa-info-circle" aria-hidden="true" data-bp-tooltip="Enter detailed product information, including sizing, weight, etc., as appropriate."></i></label>
										
										<?php
							
							echo $post_data->product_specs_html;
							?>
							<span class="info-msg"><span id="character-count-specs">2000 Characters Remaining</span></span>
									</div>
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
									<div class="form-row">
										<label for="">Add Tag(s) <i class="fa fa-info-circle" aria-hidden="true" data-bp-tooltip="Enter keywords related to this product separated by commas. Tags will be searchable and will display to users as tabs."></i></label>
										<input type="text" class="input-text add-tags" name="nab_product_tags" id="nab_product_tags" value="<?php if ($post_data->tags) {
																																				echo implode(',', $post_data->tags);
																																			} ?>">
									</div>
								</div>
							</div>	
							<div class="form-row">
										<label for="">Learn More Button URL</label>
										<input type="text" class="input-text learn-more-url" name="nab_product_learn_more_url" id="nab_product_learn_more_url" value="<?php echo isset($post_data->nab_product_learn_more_url) ? $post_data->nab_product_learn_more_url : ''; ?>">
									</div>						
							<div class="form-row">
								<div class="toggle-wrap">
									<span class="toggle-label">Discussion <i class="fa fa-info-circle tooltip-wrap" aria-hidden="true">
										<span class="tooltip">Would you like to allow users to comment and ask questions on this product listing? If you turn this on, NAB Show recommends that company admins monitor this page frequently to respond to leads and customers. Please review our <a href="<?php echo esc_url(get_site_url()); ?>/terms-of-use/">terms of use</a> and <a href="<?php echo esc_url(get_site_url()); ?>/nab-virtual-events-code-of-conduct/">code of conduct</a> for additional information regarding content on this site.</span>
									</i></span>
									<label class="nab-toggle-btn">
										<input type="checkbox" <?php if ($post_data->comment_status === 'open') {
																	echo 'checked="checked"';
																} ?> name="nab_product_discussion" id="nab_product_discussion">
										<div class="toggle-switch"></div>
									</label>
									<span class="toggle-status">On</span>
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