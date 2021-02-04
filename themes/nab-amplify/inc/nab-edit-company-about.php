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
									<label for="">Company Tagline</label>
									<input type="text" class="input-text" name="company_industry" value="<?php echo isset($company_data['company_industry']) ? $company_data['company_industry'] : ''; ?>" id="company_industry">
								</div>
								<div class="form-row">
									<label for="">Website</label>
									<input type="text" class="input-text" name="company_website" value="<?php echo isset($company_data['company_website']) ? $company_data['company_website'] : ''; ?>" id="company_website">
								</div>
								<div class="form-row">
									<label for="">Point of Contact</label>
									<div class="select-dark-simple">
										<select name="company_point_of_contact" id="company_point_of_contact">
											<option value=""></option>
											<?php foreach ($users as $user) {

											?>
												<option value="<?php echo $user->data->ID; ?>" <?php if ($user->data->ID == $company_data['company_point_of_contact']) {
																									echo "selected";
																								} ?>><?php echo $user->data->display_name; ?></option>
											<?php } ?>
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

												if (is_array($company_data['search_product_categories']) && in_array($user->data->ID, $company_data['search_product_categories'], true)) {
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
									<label for="">Company Admins</label>
									<div class="select-dark-simple">
										<select class="company-admins" name="company_admins[]" multiple="true" id="company_admins">
											<option value=""></option>
											<?php 
										
											foreach ($users as $user) {
													
												

												if (is_array($company_data['company_admins']) && in_array($user->data->ID, $company_data['company_admins'])) {
													$selected_user = $user->data->ID;
													$user_name		= $user->data->user_login;
													$user_full_name	= get_user_meta($selected_user, 'first_name', true) . ' ' . get_user_meta($selected_user, 'last_name', true);
													if (!empty(trim($user_full_name))) {
														$user_name .= ' (' . $user_full_name . ')';
													}
											?>
													<option value="<?php echo esc_attr($selected_user); ?>" selected><?php echo esc_html($user_name); ?></option>
												<?php
												}
												
											}
											?>
										</select>
									</div>
									<p class="company-admin-note">NOTE: Only Amplify users can be added as admins for your company listing. Invite colleagues to join the platform <a href="<?php echo site_url(); ?>/refer-a-friend-or-colleague/" class="btn-link">here</a>. Once they have profiles on Amplify, you can then add them as an admin for your listing.</p>
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