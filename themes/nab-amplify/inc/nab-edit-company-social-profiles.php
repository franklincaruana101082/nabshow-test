
<div id="addProductModal" class="nab-modal theme-dark nab-modal-active">
	<div class="nab-modal-inner">
		<div class="modal-content">
			<div class="modal-content-wrap">
				<span class="nab-modal-close">Close</span>
				<div class="add-product-content-popup">
					<h2>Update Social profiles</h2>
					<p>Update your social profiles here.</p>
					<div class="form-wrapper">
						<form method="post" id="nab-edit-company-profile-form" enctype="multipart/form-data">
							<div class="form-row">
								<label for="">Instagram</label>
								<input type="text" class="input-text" name="instagram_profile" value="<?php echo isset($company_data['instagram_profile']) ? $company_data['instagram_profile'] : ''; ?>" id="instagram_profile">
                            </div>
                            <div class="form-row">
								<label for="">LinkedIn</label>
								<input type="text" class="input-text" name="linkedin_profile" value="<?php echo isset($company_data['linkedin_profile']) ? $company_data['linkedin_profile'] : ''; ?>" id="linkedin_profile">
                            </div>
                            <div class="form-row">
								<label for="">Facebook</label>
								<input type="text" class="input-text" name="facebook_profile" value="<?php echo isset($company_data['facebook_profile']) ? $company_data['facebook_profile'] : ''; ?>" id="facebook_profile">
                            </div>
                            <div class="form-row">
								<label for="">Twitter</label>
								<input type="text" class="input-text" name="twitter_profile" value="<?php echo isset($company_data['twitter_profile']) ? $company_data['twitter_profile'] : ''; ?>" id="twitter_profile">
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
