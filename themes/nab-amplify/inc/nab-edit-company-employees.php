<div id="addProductModal" class="nab-modal nab-modal-with-form theme-dark nab-modal-active">
	<div class="nab-modal-inner">
		<div class="modal-content">
			<span class="nab-modal-close fa fa-times"></span>
			<div class="modal-content-wrap">
				<div class="add-product-content-popup">
					<h2>Add Employee </h2>

					<div class="form-wrapper">
						<form method="post" id="nab-edit-company-profile-form" enctype="multipart/form-data">

							<div class="company-info-row">
								<?php
								$employee_count = is_array( $company_data['company_employees'] ) ? count( $company_data['company_employees'] ) : 0;
								?>								
								<div class="form-row">
									<label class="emp-label">Select Employee <span>( <?php echo esc_html( $employee_count . ' Results / ' . $limit_employees_str ); ?> )</span></label>
									<div class="select-dark-simple">
										<select class="company-employees" name="company_employees[]" multiple="true" id="company_employees">
											<?php

											foreach ($company_data['company_employees'] as $user) {
												$comp_admin = get_user_by('ID', $user);

												if ($comp_admin) {
													$user_name		= $comp_admin->user_login;
													$user_full_name	= get_user_meta($comp_admin->ID, 'first_name', true) . ' ' . get_user_meta($comp_admin->ID, 'last_name', true);

													if (!empty(trim($user_full_name))) {
														$user_name .= ' (' . $user_full_name . ')';
													} ?>
													<option value="<?php echo esc_attr($comp_admin->ID); ?>" selected><?php echo esc_html($user_name); ?></option>
											<?php
												}
											}

											?>
										</select>
									</div>

								</div>
								<div class="form-row">
									<p>NOTE: Only Amplify users can be added as employees for your company listing. Invite colleagues to join the platform <a href="https://nabshow-beta.go-vip.net/amplify/refer-a-friend-or-colleague/" target="_blank" class="btn-link">here</a>. Once they have profiles on Amplify, you can then add them to your listing.</p>
								</div>

							</div>

							<div class="form-row">
								<input type="button" id="nab-add-employee-submit" data-id="<?php echo isset($company_data['ID']) ? esc_attr( $company_data['ID'] ) : 0 ?>" class="btn btn-submit" value="<?php echo isset($company_data['ID']) ? "Update" : "Add"; ?>">
								<input type="hidden" name="nab_company_id" id="nab_company_id" value="<?php echo esc_attr( $company_data['ID'] ); ?>" />
							</div>
						</form>
						<p>NAB Amplify reserves the right to remove any content that is deemed inappropriate. See the <a class="btn-link" href="<?php echo esc_url( site_url() ); ?>/nab-virtual-events-code-of-conduct/">Code of Conduct</a> for details.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>