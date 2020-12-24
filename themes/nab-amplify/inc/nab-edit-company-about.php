<div id="addProductModal" class="nab-modal theme-dark nab-modal-active">
	<div class="nab-modal-inner">
		<div class="modal-content">
			<div class="modal-content-wrap">
				<span class="nab-modal-close">Close</span>
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
										<select name="company_point_of_contact"  id="company_point_of_contact">
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
								<div class="form-row">
									<label for="">Product Categories</label>
									<div class="select-dark-simple select-multiple">
										<select name="product_categories[]" multiple="true" id="product_categories">
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