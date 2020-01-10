<?php
/**
 * Template part for displaying startup loft form
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package NABShow_LV
 */

$to_email = get_query_var('form_email' );
?>
<form class="nab-form startup-loft-form" method="post">
	<div class="form-items-wrapper">
		<div class="form-item">
			<label class="control-label" for="startup-first-name">First Name <span class="form-required" title="This field is required.">*</span></label>
			<input required="required" pattern=".*\S+.*" class="form-control form-text" type="text" id="startup-first-name" name="first_name" size="60" maxlength="128">
		</div>
		<div class="form-item">
			<label class="control-label" for="startup-last-name">Last Name <span class="form-required" title="This field is required.">*</span></label>
			<input required="required" pattern=".*\S+.*" class="form-control form-text" type="text" id="startup-last-name" name="last_name" size="60" maxlength="128">
		</div>
		<div class="form-item">
			<label class="control-label" for="startup-title">Title <span class="form-required" title="This field is required.">*</span></label>
			<input required="required" pattern=".*\S+.*" class="form-control form-text" type="text" id="startup-title" name="title" size="60" maxlength="128">
		</div>
		<div class="form-item">
			<label class="control-label" for="startup-email">Email <span class="form-required" title="This field is required.">*</span></label>
			<input required="required" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,5}$" class="form-control form-text" type="email" id="startup-email" name="email" size="60">
		</div>
		<div class="form-item">
			<label class="control-label" for="startup-phone">Phone <span class="form-required" title="This field is required.">*</span></label>
			<input required="required" pattern="[0-9]{1,128}" class="form-control form-text" type="text" id="startup-phone" name="phone" size="60" maxlength="128">
		</div>
		<div class="form-item">
			<label class="control-label" for="startup-company">Company <span class="form-required" title="This field is required.">*</span></label>
			<input required="required" pattern=".*\S+.*" class="form-control form-text" type="text" id="startup-company" name="company" size="60" maxlength="128">
		</div>
		<div class="form-item">
			<label class="control-label" for="startup-company-desc">Company Description (Your Company’s Pitch) <span class="form-required" title="This field is required.">*</span></label>
			<div class="form-textarea-wrapper resizable">
				<textarea required="required" class="form-control form-textarea" id="startup-company-desc" name="company_desc" cols="60" rows="5"></textarea>
				<p class="textarea-error" style="display: none; color: red;">This field is required.</p>
			</div>
		</div>
		<div class="form-item">
			<label class="control-label" for="startup-company-website">Company Website <span class="form-required" title="This field is required.">*</span></label>
			<input required="required" pattern=".*\S+.*" class="form-control form-text" type="text" id="startup-company-website" name="company_website" size="60" maxlength="128">
		</div>
		<div class="form-item">
			<label class="control-label" for="startup-date-founded">Date Founded <span class="form-required" title="This field is required.">*</span></label>
			<input type="text" name="date_founded" id="startup-date-founded" required="required" />
		</div>
		<div class="form-item">
			<label class="control-label" for="startup-number-of-employees">Number of Employees <span class="form-required" title="This field is required.">*</span></label>
			<div id="startup-number-of-employees" class="form-radios">
				<div class="form-type-radio">
					<label class="control-label" for="startup-number-of-employees-1"><input required="required" type="radio" id="startup-number-of-employees-1" name="number_of_employees" value="onetoten" class="form-radio"> 1 - 10</label>
				</div>
				<div class="form-type-radio">
					<label class="control-label" for="startup-number-of-employees-2"><input required="required" type="radio" id="startup-number-of-employees-2" name="number_of_employees" value="tentotwentyfive" class="form-radio"> 10 - 25</label>
				</div>
				<div class="form-type-radio">
					<label class="control-label" for="startup-number-of-employees-3"><input required="required" type="radio" id="startup-number-of-employees-3" name="number_of_employees" value="twentyfivetofifty" class="form-radio"> 25 - 50</label>
				</div>
				<div class="form-type-radio">
					<label class="control-label" for="startup-number-of-employees-4"><input required="required" type="radio" id="startup-number-of-employees-4" name="number_of_employees" value="fiftytoonehundred" class="form-radio"> 50 - 100</label>
				</div>
				<div class="form-type-radio">
					<label class="control-label" for="startup-number-of-employees-5"><input required="required" type="radio" id="startup-number-of-employees-5" name="number_of_employees" value="onehundredplus" class="form-radio"> 100+</label>
				</div>
			</div>
		</div>
		<div class="form-item">
			<label class="control-label" for="startup-companys-gross-annual-revenue">Company’s Gross Annual Revenue <span class="form-required" title="This field is required.">*</span></label>
			<div id="startup-companys-gross-annual-revenue" class="form-radios">
				<div class="form-type-radio">
					<label class="control-label" for="startup-companys-gross-annual-revenue-1"><input required="required" type="radio" id="startup-companys-gross-annual-revenue-1" name="companys_gross_annual_revenue" value="zero" class="form-radio"> $0 - $50,000</label>
				</div>
				<div class="form-type-radio">
					<label class="control-label" for="startup-companys-gross-annual-revenue-2"><input required="required" type="radio" id="startup-companys-gross-annual-revenue-2" name="companys_gross_annual_revenue" value="fiftyk" class="form-radio"> $50,000 - $100,000</label>
				</div>
				<div class="form-type-radio">
					<label class="control-label" for="startup-companys-gross-annual-revenue-3"><input required="required" type="radio" id="startup-companys-gross-annual-revenue-3" name="companys_gross_annual_revenue" value="onehun" class="form-radio"> $100,000 - $500,000</label>
				</div>
				<div class="form-type-radio">
					<label class="control-label" for="startup-companys-gross-annual-revenue-4"><input required="required" type="radio" id="startup-companys-gross-annual-revenue-4" name="companys_gross_annual_revenue" value="fivehun" class="form-radio"> $500,000 - $1,000,000</label>
				</div>
				<div class="form-type-radio">
					<label class="control-label" for="startup-companys-gross-annual-revenue-5"><input required="required" type="radio" id="startup-companys-gross-annual-revenue-5" name="companys_gross_annual_revenue" value="onemil" class="form-radio"> $1,000,000 - $5,000,000</label>
				</div>
				<div class="form-type-radio">
					<label class="control-label" for="startup-companys-gross-annual-revenue-6"><input required="required" type="radio" id="startup-companys-gross-annual-revenue-6" name="companys_gross_annual_revenue" value="fivemil" class="form-radio"> $5,000,000 +</label>
				</div>
			</div>
		</div>
		<div class="form-item">
			<label class="control-label" for="startup-company-challenge-solving">What challenge is your company solving? How is your company uniquely addressing this issue? <span class="form-required" title="This field is required.">*</span></label>
			<div class="form-textarea-wrapper resizable">
				<textarea required="required" pattern=".*\S+.*" class="form-control form-textarea" id="startup-company-challenge-solving" name="what_challenge_is_your_company_solving" cols="60" rows="5"></textarea>
				<p class="textarea-error" style="display: none; color: red;">This field is required.</p>
			</div>
		</div>
		<div class="form-item">
			<label class="control-label" for="startup-companys-competitors">Who are your company's competitors? How are you different from them? <span class="form-required" title="This field is required.">*</span></label>
			<div class="form-textarea-wrapper resizable">
				<textarea required="required" pattern=".*\S+.*" class="form-control form-textarea" id="startup-companys-competitors" name="companys_competitors" cols="60" rows="5"></textarea>
				<p class="textarea-error" style="display: none; color: red;">This field is required.</p>
			</div>
		</div>
		<div class="form-item">
			<label class="control-label" for="startup-companys-current-customers">Please provide the names of your company’s current customers. <span class="form-required" title="This field is required.">*</span></label>
			<div class="form-textarea-wrapper resizable">
				<textarea required="required" pattern=".*\S+.*" class="form-control form-textarea" id="startup-companys-current-customers" name="companys_current_customers" cols="60" rows="5"></textarea>
				<p class="textarea-error" style="display: none; color: red;">This field is required.</p>
			</div>
		</div>
		<div class="form-item">
			<label class="control-label" for="startup-additional-information">Please provide any additional information below you would like to share. <span class="form-required" title="This field is required.">*</span></label>
			<div class="form-textarea-wrapper resizable">
				<textarea required="required" pattern=".*\S+.*" class="form-control form-textarea" id="startup-additional-information" name="additional_information" cols="60" rows="5"></textarea>
				<p class="textarea-error" style="display: none; color: red;">This field is required.</p>
			</div>
		</div>
		<div class="captcha">
			<div class="g-recaptcha" data-sitekey="6LeD8MkUAAAAAOsXcI7-JQI4wf60LTRb2pu44bdW"></div>
			<p class="captcha-error" style="display: none; color:red;">Please check the recaptcha</p>
		</div>
		<?php wp_nonce_field( 'nabshow_forms', 'form_details_nonce' ); ?>
		<input type="hidden" name="form_type" value="startup-loft">
		<input type="hidden" name="to_email" value="<?php echo esc_attr( $to_email ); ?>" />
		<div class="form-actions">
			<button class="form-submit" type="submit" name="op" value="Submit">Submit</button>
		</div>
	</div>
</form>
<?php
nabshow_lv_enqueue_datepicker_script();
nabshow_lv_enqueue_google_recaptch_script();
