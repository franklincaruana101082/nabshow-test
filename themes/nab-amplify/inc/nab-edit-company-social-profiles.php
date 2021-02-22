
<div id="addProductModal" class="nab-modal theme-dark nab-modal-active">
	<div class="nab-modal-inner">
		<div class="modal-content">
			<span class="nab-modal-close fa fa-times"></span>
			<div class="modal-content-wrap">
				<div class="add-product-content-popup">
					<h2>Update Social profiles</h2>
					<p>Update your social profiles here.</p>
					<div class="form-wrapper">
						<form method="post" id="nab-edit-company-profile-form" enctype="multipart/form-data">
						<div class="form-row">
							<label for="" class="tooltip-container large-label-tooltip">
											<div class="field-label">Instagram URL</div>
											<div class="tooltip-wrap">
												<i class="fa fa-info-circle" aria-hidden="true"></i>
												<div class="tooltip">
												Please enter your full URL, including https://
												</div>
											</div>
										</label>
								<input type="text" class="input-text" name="instagram_profile" value="<?php echo isset($company_data['instagram_profile']) ? $company_data['instagram_profile'] : ''; ?>" id="instagram_profile">
                            </div>
                            <div class="form-row">
							<label for="" class="tooltip-container large-label-tooltip">
											<div class="field-label">LinkedIn URL</div>
											<div class="tooltip-wrap">
												<i class="fa fa-info-circle" aria-hidden="true"></i>
												<div class="tooltip">
												Please enter your full URL, including https://
												</div>
											</div>
										</label>
								<input type="text" class="input-text" name="linkedin_profile" value="<?php echo isset($company_data['linkedin_profile']) ? $company_data['linkedin_profile'] : ''; ?>" id="linkedin_profile">
                            </div>
                            <div class="form-row">
							<label for="" class="tooltip-container large-label-tooltip">
											<div class="field-label">Facebook URL</div>
											<div class="tooltip-wrap">
												<i class="fa fa-info-circle" aria-hidden="true"></i>
												<div class="tooltip">
												Please enter your full URL, including https://
												</div>
											</div>
										</label>
								<input type="text" class="input-text" name="facebook_profile" value="<?php echo isset($company_data['facebook_profile']) ? $company_data['facebook_profile'] : ''; ?>" id="facebook_profile">
                            </div>
                            <div class="form-row">
							<label for="" class="tooltip-container large-label-tooltip">
											<div class="field-label">Twitter URL</div>
											<div class="tooltip-wrap">
												<i class="fa fa-info-circle" aria-hidden="true"></i>
												<div class="tooltip">
												Please enter your full URL, including https://
												</div>
											</div>
										</label>
								<input type="text" class="input-text" name="twitter_profile" value="<?php echo isset($company_data['twitter_profile']) ? $company_data['twitter_profile'] : ''; ?>" id="twitter_profile">
							</div>
							<div class="form-row">
							<label for="" class="tooltip-container large-label-tooltip">
											<div class="field-label">Youtube URL</div>
											<div class="tooltip-wrap">
												<i class="fa fa-info-circle" aria-hidden="true"></i>
												<div class="tooltip">
												Please enter your full URL, including https://
												</div>
											</div>
										</label>
									<input type="text" class="input-text" name="company_youtube" value="<?php echo isset($company_data['company_youtube']) ? $company_data['company_youtube'] : ''; ?>" id="company_youtube">
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
