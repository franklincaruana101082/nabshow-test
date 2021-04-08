<?php
$company_id		= filter_input( INPUT_POST, 'company_id', FILTER_SANITIZE_NUMBER_INT );
$company_title	= get_the_title( $company_id );
$site_url		= get_site_url();
$site_url		= rtrim( $site_url, '/' ) . '/editing-your-company-profile/';
?>
<div id="addAdminModal" class="nab-modal theme-dark nab-modal-active">
	<div class="nab-modal-inner">
		<div class="modal-content">
			<span class="nab-modal-close fa fa-times"></span>
			<div class="modal-content-wrap">
				<div class="add-product-content-popup">
					<h3>You have now been added as a Company Admin for <?php echo esc_html ( $company_title ); ?>. </h3>
					<p>In the upper right corner of your company profile, you will now see an “Edit Profile” button, which will allow you to customize and add to your listing. </p><p>For more information on how to edit your company profile, <a class="btn-link" href="<?php echo esc_url( $site_url ); ?>" target="_blnak">click here</a></p>
					<div class="form-wrapper">
					<p>NOTE: Please be sure you don’t share your full addadmin URL with anyone you don’t wish to grant admin access to. Please contact your sales rep for help if you shared this access in error. </p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
