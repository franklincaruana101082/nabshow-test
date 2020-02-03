<?php
/**
 * Template part for displaying Publication Shipping Information form
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package NABShow_LV
 */

$to_email = get_query_var('form_email' );
?>
	<form class="nab-form special-event-form" method="post">
		<div class="form-items-wrapper">
			<div class="form-item">
				<label class="control-label" for="special-event-company-name">Company Name <span class="form-required" title="This field is required.">*</span></label>
				<input required="required" pattern=".*\S+.*" class="form-control form-text" type="text" id="special-event-company-name" name="company_name" size="60" maxlength="200">
			</div>
			<div class="form-item">
				<label class="control-label" for="special-event-booth-number">Booth Number <span class="form-required" title="This field is required.">*</span></label>
				<input required="required" pattern=".*\S+.*" class="form-control form-text" type="text" id="special-event-booth-number" name="booth_number" size="20" maxlength="15">
			</div>
			<div class="form-item sqr-ft">
				<label class="control-label" for="special-event-booth-square-feet">Booth Square Footage <span class="form-required" title="This field is required.">*</span></label>
				<div class="input-group">
					<input required="required" pattern=".*\S+.*" class="form-control form-text" type="text" id="special-event-booth-square-feet" name="booth_square_feet" size="20" maxlength="50">
					<span class="input-group-addon">Net Square Feet</span>
				</div>
			</div>
			<fieldset class="form-fieldset" id="bootstrap-panel">
				<legend class="panel-heading">
					<span class="panel-title fieldset-legend">Special Event Contact Information:</span>
				</legend>
				<div class="panel-body" id="bootstrap-panel-body">
					<div class="form-item">
						<label class="control-label" for="special-event-contact-information-name">Name <span class="form-required" title="This field is required.">*</span></label>
						<input required="required" pattern=".*\S+.*" class="form-control form-text" type="text" id="special-event-contact-information-name" name="special_event_contact_information_name" size="50" maxlength="200">
					</div>
					<div class="form-item">
						<label class="control-label" for="special-event-contact-information-phone-number">Phone Number <span class="form-required" title="This field is required.">*</span></label>
						<input required="required" pattern="[0-9]{1,128}" class="form-control form-text" type="text" id="special-event-contact-information-phone-number" name="special_event_contact_information_phone_number" size="50" maxlength="75">
					</div>
					<div class="form-item">
						<label class="control-label" for="special-event-contact-information-email">Email Address <span class="form-required" title="This field is required.">*</span></label>
						<input required="required" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,5}$" class="form-control form-text" type="email" id="special-event-contact-information-email" name="special_event_contact_information_email_address" size="50">
					</div>
				</div>
			</fieldset>
			<div class="form-item">
				<label class="control-label" for="event-date">Event Date <span class="form-required" title="This field is required.">*</span></label>
				<div id="event-date" class="form-checkboxes">
					<div class="form-type-checkbox">
						<label class="control-label" for="event-date-1"><input id="event-date-1" class="form-checkbox" name="event_date_1" type="checkbox" value="monday_april_8">Sunday, April 19, 2020</label>
					</div>
					<div class="form-type-checkbox">
						<label class="control-label" for="event-date-2"><input id="event-date-2" class="form-checkbox" name="event_date_2" type="checkbox" value="tuesday_april_9">Monday, April 20, 2020</label>
					</div>
					<div class="form-type-checkbox">
						<label class="control-label" for="event-date-3"><input id="event-date-3" class="form-checkbox" name="event_date_3" type="checkbox" value="wednesday_april_10">Tuesday, April 21, 2020</label>
					</div>
					<div class="form-type-checkbox">
						<label class="control-label" for="event-date-4"><input id="event-date-4" class="form-checkbox" name="event_date_4" type="checkbox" value="thursday_april_11">Wednesday, April 22, 2020 (before Show hours only)</label>
					</div>
					<p class="checkbox-error" style="display: none; color: red;">Event Date field is required.</p>
					<div class="help-block"><p>Please choose your event date. If you have more than one event, you can pick multiple dates.</p></div>
				</div>
			</div>
			<fieldset class="form-fieldset timelogs" id="bootstrap-panel-2">
				<legend class="panel-heading">
					<span class="panel-title fieldset-legend">Event Hours</span>
				</legend>
				<div class="panel-body" id="bootstrap-panel-2-body">
					<div class="form-item">
						<label class="control-label" for="event-hours-start">Start <span class="form-required" title="This field is required.">*</span></label>
						<div class="form-container-inline">
							<div class="form-type-select start-hour">
								<select class="hour form-control form-select" required="required" id="event-hours-start" name="event_hours_start_hour">
									<option value="" selected="selected">Hour</option>
									<?php
										nabshow_lv_get_special_event_hours_options();
									?>
								</select>
							</div>
							<span>:</span>
							<div class="form-type-select start-minute">
								<select class="minute form-control form-select" required="required" id="event-hours-start-minute" name="event_hours_start_minute">
									<option value="" selected="selected">Minute</option>
									<?php
										nabshow_lv_get_special_event_minutes_options();
									?>
								</select>
							</div>
							<div class="form-radios">
								<div class="form-type-radio">
									<label class="control-label" for="event-hours-start-am"><input required="required" type="radio" id="event-hours-start-am" name="event_hours_start_ampm" value="am" checked="checked" class="form-radio">am</label>
								</div>
								<div class="form-type-radio">
									<label class="control-label" for="event-hours-start-pm"><input required="required" type="radio" id="event-hours-start-pm" name="event_hours_start_ampm" value="pm" class="form-radio">pm</label>
								</div>
							</div>
						</div>
					</div>					
					<div class="form-item">
						<label class="control-label" for="event-hours-end">End <span class="form-required" title="This field is required.">*</span></label>
						<div class="form-container-inline">
							<div class="form-type-select end-hour">
								<select class="hour form-control form-select" required="required" id="event-hours-end" name="event_hours_end_hour">
									<option value="" selected="selected">Hour</option>
									<?php
									nabshow_lv_get_special_event_hours_options();
									?>
								</select>
							</div>
							<span>:</span>
							<div class="form-type-select end-minute">
								<select class="minute form-control form-select" required="required" id="event-hours-end-minute" name="event_hours_end_minute">
									<option value="" selected="selected">Minute</option>
									<?php
									nabshow_lv_get_special_event_minutes_options();
									?>
								</select>
							</div>
							<div class="form-radios">
								<div class="form-type-radio">
									<label class="control-label" for="event-hours-end-am"><input required="required" type="radio" id="event-hours-end-am" name="event_hours_end_ampm" value="am" checked="checked" class="form-radio">am</label>
								</div>
								<div class="form-type-radio">
									<label class="control-label" for="event-hours-end-pm"><input required="required" type="radio" id="event-hours-end-pm" name="event_hours_end_ampm" value="pm" class="form-radio">pm</label>
								</div>
							</div>
						</div>
					</div>
				</div>
			</fieldset>
			<div class="form-item">
				<label class="control-label" for="nature-of-event-select">Nature of Event <span class="form-required" title="This field is required.">*</span></label>
				<div id="nature-of-event-select" class="form-radios">
					<div class="form-type-radio">
						<label class="control-label" for="nature-of-event-select-1"><input required="required" class="form-radio" type="radio" id="nature-of-event-select-1" name="nature_of_event_select" value="dealer_meeting">Dealer Meeting</label>
					</div>
					<div class="form-type-radio">
						<label class="control-label" for="nature-of-event-select-2"><input required="required" class="form-radio" type="radio" id="nature-of-event-select-2" name="nature_of_event_select" value="meet_and_greet">Meet and Greet</label>
					</div>
					<div class="form-type-radio">
						<label class="control-label" for="nature-of-event-select-3"><input required="required" class="form-radio" type="radio" id="nature-of-event-select-3" name="nature_of_event_select" value="press_briefing">Press Briefing</label>
					</div>
					<div class="form-type-radio">
						<label class="control-label" for="nature-of-event-select-4"><input required="required" class="form-radio" type="radio" id="nature-of-event-select-4" name="nature_of_event_select" value="product_demonstration">Product Demonstration</label>
					</div>
					<div class="form-type-radio">
						<label class="control-label" for="nature-of-event-select-5"><input required="required" class="form-radio" type="radio" id="nature-of-event-select-5" name="nature_of_event_select" value="reception">Reception</label>
					</div>
					<div class="form-type-radio">
						<label class="control-label" for="nature-of-event-select-6"><input required="required" class="form-radio" type="radio" id="nature-of-event-select-6" name="nature_of_event_select" value="select_or_other">Other, Describe</label>
					</div>
				</div>
			</div>
			<div class="form-item">
				<label class="control-label" for="number-of-attendees">Number of Attendees <span class="form-required" title="This field is required.">*</span></label>
				<input required="required" pattern="\d+(,\d{2,5})?" class="form-control form-text" type="text" id="number-of-attendees" name="number_of_attendees" size="4" min="0" max="999" step="1">
			</div>
			<div class="form-item">
				<p><strong>By submitting this form, you are agreeing to the <a href="<?php echo esc_url( site_url() . '/partner/exhibitors/exhibitor-services/promote-and-enhance/exhibitor-special-events/' ); ?>" title="Exhibitor Special Events">Special Event Terms and Conditions</a>.</strong></p>
				<p>Submit confirmed security order <a href="mailto:exhibitservices@nab.org?subject=2020 NAB Show Special Event Form Submission - Security Information">via email</a> or by fax at (202) 517-1617.</p>
			</div>
			<div class="captcha">
				<div class="g-recaptcha" data-sitekey="6Lfwj9wSAAAAAGC50P7LPTXvapy4cdM6GuPJ5Zh3"></div>
				<p class="captcha-error" style="display: none; color:red;">Please check the recaptcha</p>
			</div>
			<?php wp_nonce_field( 'nabshow_forms', 'form_details_nonce' ); ?>
			<input type="hidden" name="form_type" value="special-event-order">
			<input type="hidden" name="to_email" value="<?php echo esc_attr( $to_email ); ?>" />
			<div class="form-actions">
				<button class="form-submit" type="submit" name="op" value="Submit">Submit</button>
			</div>
		</div>
	</form>
<?php
nabshow_lv_enqueue_google_recaptch_script();
