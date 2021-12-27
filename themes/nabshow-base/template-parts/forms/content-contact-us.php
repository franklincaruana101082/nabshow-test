<?php
/**
 * Template part for displaying contact us form
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package NABShow_LV
 */

$to_email = get_query_var('form_email' );
?>
<form class="nab-form contact-us-form" method="post">
	<div class="form-items-wrapper">
		<div class="form-item">
			<label class="control-label" for="contact-full-name">Full Name <span class="form-required" title="This field is required.">*</span></label>
			<input required="required" pattern=".*\S+.*" class="form-control form-text" type="text" id="contact-full-name" name="full_name" value="" size="60" maxlength="128">
		</div>
		<div class="form-item">
			<label class="control-label" for="contact-email">Email <span class="form-required" title="This field is required.">*</span></label>
			<input required="required" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,5}$" class="form-control form-text" type="email" id="contact-email" name="email" size="60">
		</div>
		<div class="form-item">
			<label class="control-label" for="contact-phone-number">Phone Number</label>
			<input class="form-control form-text" pattern="[0-9]{1,128}" type="text" id="contact-phone-number" name="phone_number" step="1">
		</div>
		<div class="form-item">
			<label class="control-label" for="contact-company">Company <span class="form-required" title="This field is required.">*</span></label>
			<input required="required" pattern=".*\S+.*" class="form-control form-text" type="text" id="contact-company" name="company" value="" size="60" maxlength="128">
		</div>
		<div class="form-item">
			<label class="control-label" for="contact-inquiry-type">Inquiry Type <span class="form-required" title="This field is required.">*</span></label>
			<select required="required" class="form-control form-select" id="contact-inquiry-type" name="inquiry_type">
				<option value="" selected="selected">- Select -</option>
				<option value="registration">Registration</option>
				<option value="housing">Housing and Travel</option>
				<option value="exhibit">Exhibit Sales</option>
				<option value="conference">Conference</option>
				<option value="speaker">Speaker Inquiry</option>
				<option value="sales">Sales Opportunities</option>
				<option value="services">Exhibit Services</option>
				<option value="sponsor">Advertising/Sponsorships</option>
			</select>
		</div>
		<div class="form-item">
			<label class="control-label" for="contact-help-you-with">What can we help you with? <span class="form-required" title="This field is required.">*</span></label>
			<div class="form-textarea-wrapper resizable">
				<textarea required="required" class="form-control form-textarea" id="contact-help-you-with" name="what_can_we_help_you_with" cols="60" rows="5"></textarea>
				<p class="textarea-error" style="display: none; color: red;">This field is required.</p>
			</div>
		</div>
		<div class="form-item">
			<label class="control-label" for="contact-send-copy"><input type="checkbox" value="yes" id="contact-send-copy" name="send_copy" class="form-control form-checkbox"/>Send me a copy.</label>
		</div>
		<div class="captcha">
			<div class="g-recaptcha" data-sitekey="6Lfwj9wSAAAAAGC50P7LPTXvapy4cdM6GuPJ5Zh3"></div>
			<p class="captcha-error" style="display: none; color:red;">Please check the recaptcha</p>
		</div>
		<?php wp_nonce_field( 'nabshow_forms', 'form_details_nonce' ); ?>
		<input class="form-control form-text" type="text" id="contact-security-check" name="security_check" style="display: none">
		<input type="hidden" name="form_type" value="contact-us">
		<input type="hidden" name="to_email" value="<?php echo esc_attr( $to_email ); ?>" />
		<div class="form-actions">
			<button class="form-submit" type="submit" name="op" value="Submit">Submit</button>
		</div>
	</div>
</form>
<?php
nabshow_lv_enqueue_google_recaptch_script();

