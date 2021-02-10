
<div id="addProductModal" class="nab-modal theme-dark nab-modal-active">
	<div class="nab-modal-inner">
		<div class="modal-content">
			<div class="modal-content-wrap">
				<span class="nab-modal-close">Close</span>
				<div class="add-product-content-popup">
					<h2>Company Contact Details</h2>
					<p>Update your company contact details here.</p>
					<div class="form-wrapper">
						<form method="post" id="nab-edit-company-profile-form" enctype="multipart/form-data">
							
						<div class="form-row">
								<label for="">Industry</label>
								<input type="text" class="input-text add-product" name="company_industry" value="<?php echo isset($company_data['company_industry']) ? $company_data['company_industry'] : ''; ?>" id="company_industry">
							</div>
							<div class="form-row">
								<label for="">Location</label>
								<textarea  class="input-text add-product" name="company_location"  id="company_location"><?php echo isset($company_data['company_location']) ? $company_data['company_location'] : ''; ?></textarea>
                            </div>
                            <div class="form-row">
								<label for="">Website</label>
								<input type="text" class="input-text add-product" name="company_website" value="<?php echo isset($company_data['company_website']) ? $company_data['company_website'] : ''; ?>" id="company_website">
							</div>
							<div class="form-row">
								<label for="">Point Of Contact</label>
								<input type="text" class="input-text add-product" name="company_point_of_contact" value="<?php echo isset($company_data['company_point_of_contact']) ? $company_data['company_point_of_contact'] : ''; ?>" id="company_point_of_contact">
							</div>
							
							<div class="form-row">
								<input type="button" id="nab-edit-company-profile-submit" data-id="<?php echo isset($company_data['ID']) ? $company_data['ID'] : 0 ?>" class="btn btn-submit" value="<?php echo isset($company_data['ID']) ? "Update" : "Add"; ?>">
								<input type="hidden" name="nab_company_id" id="nab_company_id" value="<?php echo $company_data['ID']; ?>" />
							</div>
						</form>
						<p>NAB reserves the right to remove any content that they deem inappropriate.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
