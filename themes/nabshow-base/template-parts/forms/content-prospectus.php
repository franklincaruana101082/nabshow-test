<?php
/**
 * Template part for displaying 'Download the Prospectus' form
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package NABShow_LV
 */

$to_email = get_query_var('form_email' );
?>
	<form class="nab-form prospectus-form" method="post">
		<div class="form-items-wrapper">
			<fieldset class="form-fieldset" id="bootstrap-panel">
				<div class="panel-body" id="bootstrap-panel-body">
					<div class="form-item">
						<label class="control-label" for="uname">Name <span class="form-required" title="This field is required.">*</span></label>
						<input required="required" pattern=".*\S+.*" class="form-control form-text" type="text" id="uname" name="uname" size="60" maxlength="128">
					</div>
					<div class="form-item">
						<label class="control-label" for="utitle">Title <span class="form-required" title="This field is required.">*</span></label>
						<input required="required" pattern=".*\S+.*" class="form-control form-text" type="text" id="utitle" name="utitle" size="60" maxlength="128">
					</div>
					<div class="form-item">
						<label class="control-label" for="ucompany">Company <span class="form-required" title="This field is required.">*</span></label>
						<input required="required" pattern=".*\S+.*" class="form-control form-text" type="text" id="ucompany" name="ucompany" size="60" maxlength="128">
					</div>
                    <div class="form-item">
                        <label class="control-label" for="uemail">Email <span class="form-required" title="This field is required.">*</span></label>
                        <input required="required" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,5}$" class="form-control form-text" type="email" id="uemail" name="uemail" size="60">
                    </div>
                    <div class="form-item">
                        <label class="control-label" for="uphone">Phone <span class="form-required" title="This field is required.">*</span></label>
                        <input required="required" pattern=".*\S+.*" class="form-control form-text" type="text" id="uphone" name="uphone" size="60" maxlength="128">
                    </div>
				</div>
			</fieldset>
			<div class="captcha">
				<div class="g-recaptcha" data-sitekey="6Lfwj9wSAAAAAGC50P7LPTXvapy4cdM6GuPJ5Zh3"></div>
				<p class="captcha-error" style="display: none; color:red;">Please check the recaptcha</p>
			</div>
			<?php wp_nonce_field( 'nabshow_forms', 'form_details_nonce' ); ?>
            <input type="hidden" name="form_type" value="download-the-prospectus">
			<input type="hidden" name="to_email" value="<?php echo esc_attr( $to_email ); ?>" />
			<div class="form-actions">
				<button class="form-submit" type="submit" name="op" value="Submit">Submit</button>
			</div>
		</div>
	</form>
<?php
nabshow_lv_enqueue_google_recaptch_script();
