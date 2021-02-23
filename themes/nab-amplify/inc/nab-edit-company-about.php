<div id="addProductModal" class="nab-modal theme-dark nab-modal-active">
	<div class="nab-modal-inner">
		<div class="modal-content">
			<span class="nab-modal-close fa fa-times"></span>
			<div class="modal-content-wrap">
				<div class="add-product-content-popup">
					<h2>Company Details</h2>
					<p>Update your company details here.</p>
					<div class="form-wrapper">
						<form method="post" id="nab-edit-company-profile-form" enctype="multipart/form-data">
							<div class="company-about-row">
								<div class="form-row">
									<label for="">About</label>
									<textarea class="input-text limited-char-field" name="company_about" id="company_about"><?php echo isset($company_data['company_about']) ? $company_data['company_about'] : ''; ?></textarea>
									<span class="info-msg"><span id="character-count-comp-about">2000 Characters Remaining</span></span>
								</div>
							</div>
							<div class="company-info-row">
								<div class="form-row">
									<label for="">Impact Statement</label>
									<input type="text" class="input-text" name="company_industry" value="<?php echo isset($company_data['company_industry']) ? $company_data['company_industry'] : ''; ?>" id="company_industry">
								</div>
								<div class="form-row">
									<label for="">Website</label>
									<input type="text" class="input-text" name="company_website" value="<?php echo isset($company_data['company_website']) ? $company_data['company_website'] : ''; ?>" id="company_website">
								</div>
								<div class="form-row">
										<label for="" class="tooltip-container large-label-tooltip">
											<div class="field-label">Point of Contact</div>
											<div class="tooltip-wrap">
												<i class="fa fa-info-circle" aria-hidden="true"></i>
												<div class="tooltip">
													Only NAB Amplify users can be added as the point of contact for your company listing. This user will receive messages in their NAB Amplify inbox from users interested in learning more. Invite colleagues to join the platform <a target="_blank" href="<?php echo site_url(); ?>/refer-a-friend-or-colleague/">here</a>. Once they have profiles on Amplify, you can then add them as the POC for your listing. NOTE: You can only add one Point of Contact for your company at this time. A NAB Amplify user does not need to be a company admin to be a POC.
												</div>
											</div>
										</label>
									<div class="select-dark-simple">
										<select name="company_point_of_contact"  id="company_point_of_contact">
										<?php
												if ( ! empty( $company_data['company_point_of_contact'] ) ) {

													$comp_poc = get_user_by( 'ID', $company_data['company_point_of_contact'] );

													if ( $comp_poc ) {
														
														$user_name		= $comp_poc->user_login;
														$user_full_name	= get_user_meta( $comp_poc->ID, 'first_name', true ) . ' ' . get_user_meta( $comp_poc->ID, 'last_name', true );

														if ( ! empty( trim( $user_full_name ) ) ) {
															$user_name .= ' (' . $user_full_name . ')';					
														}
														?>
														<option value="<?php echo esc_attr( $comp_poc->ID ); ?>" selected><?php echo esc_html( $user_name ); ?></option>
														<?php
													}
												}
												?>
										</select>
									</div>
								</div>
								<?php
								$category_limit = nab_get_company_member_category_limit($company_data['ID']);
								?>
								<div class="form-row">
									<label for="" class="tooltip-container large-label-tooltip">
										<div class="field-label">Featured Product Categories</div>
										<div class="tooltip-wrap">
											<i class="fa fa-info-circle" aria-hidden="true"></i>
											<div class="tooltip">
												<p>The number of Featured Categories allowed varies by Partner Package level:</p>
												<ul>
													<li>Standard: 2</li>
													<li>Plus: 5</li>
													<li>Premium: 5</li>
												</ul>
											</div>
										</div>
									</label>
									<div class="select-dark-simple select-multiple">
										<select name="product_categories[]" multiple="true" id="product_categories" data-limit="<?php esc_attr_e($category_limit['featured']); ?>">
											<option value=""></option>
											<?php foreach ($terms as $term) {
											?>
												<option value="<?php echo $term->term_id; ?>" <?php if (in_array($term->term_id, $company_data['product_categories'])) {
																									echo "selected";
																								} ?>><?php echo $term->name; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="form-row">
									<label for="" class="tooltip-container large-label-tooltip">
										<div class="field-label">Additional Search-Only Categories</div>
										<div class="tooltip-wrap">
											<i class="fa fa-info-circle" aria-hidden="true"></i>
											<div class="tooltip">
												<p>The number of Search-Only Categories allowed varies by Partner Package level:</p>
												<ul>
													<li>Standard: 0</li>
													<li>Plus: 5</li>
													<li>Premium: Unlimited</li>
												</ul>
											</div>
										</div>
									</label>
									<div class="select-dark-simple select-multiple">
										<select name="search_product_categories[]" multiple="true" id="search_product_categories" data-limit="<?php esc_attr_e($category_limit['search']); ?>">
											<option value=""></option>
											<?php
											foreach ($terms as $current_term) {

												$selected_term = '';

												if (is_array($company_data['search_product_categories']) && in_array($current_term->term_id, $company_data['search_product_categories'], true)) {
													$selected_term = $current_term->term_id;
												}
											?>
												<option value="<?php echo esc_attr($current_term->term_id); ?>" <?php selected($selected_term, $current_term->term_id); ?>><?php echo esc_html($current_term->name); ?></option>
											<?php
											}
											?>
										</select>
									</div>
								</div>
								<div class="form-row">
									<label>Updates to Company Name & Primary Address</label>
									<p>NAB must approve and update any changes to Company Name and Company Address. Please submit updates <a href="https://app.smartsheet.com/b/form/8096b895f54546258e4b42efed40cc2a" target="_blank">via this form</a> and our team will update these on your behalf.</p>
								</div>
							</div>

							<div class="form-row">
								<input type="button" id="nab-edit-company-profile-submit" data-id="<?php echo isset($company_data['ID']) ? $company_data['ID'] : 0 ?>" class="btn btn-submit" value="<?php echo isset($company_data['ID']) ? "Update" : "Add"; ?>">
								<input type="hidden" name="nab_company_id" id="nab_company_id" value="<?php echo $company_data['ID']; ?>" />
							</div>
						</form>
						<p>NAB Amplify reserves the right to remove any content that is deemed inappropriate. See the <a class="btn-link" href="<?php echo site_url(); ?>/nab-virtual-events-code-of-conduct/">Code of Conduct</a> for details.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>