
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
						<div class="company-about-row" >	
						<div class="form-row">
								<label for="">About</label>
								<textarea  class="input-text add-product" name="company_about"  id="company_about"><?php echo isset($company_data['company_about']) ? $company_data['company_about'] : ''; ?></textarea>
							</div></div>
							<div class="company-info-row" >
							<div class="form-row">
								<label for="">Industry</label>
								<input type="text" class="input-text add-product" name="company_industry" value="<?php echo isset($company_data['company_industry']) ? $company_data['company_industry'] : ''; ?>" id="company_industry">
							</div>
							<div class="form-row">
								<div class="location-field-wrap">
									<label for="">Location</label>
									<!-- <textarea  class="input-text add-product" name="company_location"  id="company_location"><?php echo isset($company_data['company_location']) ? $company_data['company_location'] : ''; ?></textarea> -->
									<input name="company_location_street_one" id="company_location_street_one" type="text" placeholder="Street Line 1" value="<?php echo isset($company_data['company_location']['_street_line_1']) ? $company_data['company_location']['_street_line_1'] : ''; ?>">
									<input name="company_location_street_two" id="company_location_street_two" type="text" placeholder="Street Line 2" value="<?php echo isset($company_data['company_location']['street_line_2']) ? $company_data['company_location']['street_line_2'] : ''; ?>">
									<input name="company_location_street_three" id="company_location_street_three" type="text" placeholder="Street Line 3" value="<?php echo isset($company_data['company_location']['street_line_3']) ? $company_data['company_location']['street_line_3'] : ''; ?>">
									<input name="company_location_city" id="company_location_city" type="text" placeholder="City" value="<?php echo isset($company_data['company_location']['city']) ? $company_data['company_location']['city'] : ''; ?>">
									<input name="company_location_state" id="company_location_state" type="text" placeholder="State" value="<?php echo isset($company_data['company_location']['state']) ? $company_data['company_location']['state'] : ''; ?>">
									<input name="company_location_zip" id="company_location_zip" type="text" placeholder="Zip/Postal Code" value="<?php echo isset($company_data['company_location']['zipcode']) ? $company_data['company_location']['zipcode'] : ''; ?>">
									<input name="company_location_country" id="company_location_country" type="text" placeholder="Country" value="<?php echo isset($company_data['company_location']['country']) ? $company_data['company_location']['country'] : ''; ?>">
								</div>
                            </div>
                            <div class="form-row">
								<label for="">Website</label>
								<input type="text" class="input-text add-product" name="company_website" value="<?php echo isset($company_data['company_website']) ? $company_data['company_website'] : ''; ?>" id="company_website">
							</div>
							<div class="form-row">
								<label for="">Point Of Contact</label>
								<input type="text" class="input-text add-product" name="company_point_of_contact" value="<?php echo isset($company_data['company_point_of_contact']) ? $company_data['company_point_of_contact'] : ''; ?>" id="company_point_of_contact">
							</div>
</div>
							
							<div class="form-row">
								<input type="button" id="nab-edit-company-profile-submit" data-id="<?php echo isset($company_data['ID']) ? $company_data['ID'] : 0 ?>" class="btn btn-submit" value="<?php echo isset($company_data['ID']) ? "Update" : "Add"; ?>">
								<input type="hidden" name="nab_company_id" id="nab_company_id" value="<?php echo $company_data['ID']; ?>" />
							</div>
						</form>
						<p>NAB Amplify reserves the right to remove any content that is deemed inappropriate. See the <a href="<?php echo site_url();?>/nab-virtual-events-code-of-conduct/">Code of Conduct</a> for details.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
