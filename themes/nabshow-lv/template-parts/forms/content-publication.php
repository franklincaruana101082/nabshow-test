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
	<form class="nab-form publication-form" method="post">
		<div class="form-items-wrapper">
			<fieldset class="form-fieldset" id="bootstrap-panel">
				<legend class="panel-heading">
					<span class="panel-title fieldset-legend">Publication Information</span>
				</legend>
				<div class="panel-body" id="bootstrap-panel-body">
					<div class="form-item">
						<label class="control-label" for="publication-information-name-of-publication-as-it-appears-on-cover">Name of Publication as it appears on Cover <span class="form-required" title="This field is required.">*</span></label>
						<input required="required" pattern=".*\S+.*" class="form-control form-text" type="text" id="publication-information-name-of-publication-as-it-appears-on-cover" name="publication_information_name_of_publication_appears_on_cover" size="60" maxlength="128">
					</div>
					<div class="form-item">
						<label class="control-label" for="publication-information-issue-date-number">Issue Date/Number <span class="form-required" title="This field is required.">*</span></label>
						<input required="required" pattern=".*\S+.*" class="form-control form-text" type="text" id="publication-information-issue-date-number" name="publication_information_issue_date_number" size="60" maxlength="128">
					</div>
					<div class="form-item">
						<label class="control-label" for="publication-information-country-of-origin">Country of Origin <span class="form-required" title="This field is required.">*</span></label>
						<input required="required" pattern=".*\S+.*" class="form-control form-text" type="text" id="publication-information-country-of-origin" name="publication_information_country_of_origin" size="60" maxlength="128">
					</div>
					<div class="form-item">
						<label class="control-label" for="publication-information-total-number-of-copies">Total Number of Copies Being Sent for Distribution <span class="form-required" title="This field is required.">*</span></label>
						<input required="required" pattern="\d+(,\d{2,5})?" class="form-control form-text form-number" type="text" id="publication-information-total-number-of-copies" name="publication_information_total_number_of_copies" size="6" min="0" max="50000" step="1">
					</div>
				</div>
			</fieldset>
			<fieldset class="form-fieldset" id="bootstrap-panel-2">
				<legend class="panel-heading">
					<span class="panel-title fieldset-legend">Publisher Information</span>
				</legend>
				<div class="panel-body" id="bootstrap-panel-2-body">
					<div class="form-item">
						<label class="control-label" for="publisher-information-publishing-company-name">Publishing Company Name <span class="form-required" title="This field is required.">*</span></label>
						<input required="required" pattern=".*\S+.*" class="form-control form-text" type="text" id="publisher-information-publishing-company-name" name="publisher_information_publishing_company_name" size="60" maxlength="128">
					</div>
					<div class="form-item">
						<label class="control-label" for="publisher-information-name-of-contact">Name of Contact <span class="form-required" title="This field is required.">*</span></label>
						<input required="required" pattern=".*\S+.*" class="form-control form-text" type="text" id="publisher-information-name-of-contact" name="publisher_information_name_of_contact" size="60" maxlength="128">
					</div>
					<div class="form-item">
						<label class="control-label" for="publisher-information-preshow-contact-number">Pre-Show Contact Number <span class="form-required" title="This field is required.">*</span></label>
						<input required="required" pattern=".*\S+.*" class="form-control form-text" type="text" id="publisher-information-preshow-contact-number" name="publisher_information_preshow_contact_number" size="60" maxlength="128">
					</div>
					<div class="form-item">
						<label class="control-label" for="publisher-information-onsite-contact-number">Onsite Contact Number <span class="form-required" title="This field is required.">*</span></label>
						<input required="required" pattern=".*\S+.*" class="form-control form-text" type="text" id="publisher-information-onsite-contact-number" name="publisher_information_onsite_contact_number" size="60" maxlength="128">
					</div>
					<div class="form-item">
						<label class="control-label" for="publisher-information-email-address">Email Address <span class="form-required" title="This field is required.">*</span></label>
						<input required="required" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,5}$" class="form-control form-text" type="email" id="publisher-information-email-address" name="publisher_information_email_address" size="60">
					</div>
				</div>
			</fieldset>
			<div class="form-item">
				<label class="control-label" for="publication-distribution-type">Distribution Type <span class="form-required" title="This field is required.">*</span></label>
				<div id="publication-distribution-type" class="form-checkboxes">
					<div class="form-type-checkbox">
						<label class="control-label" for="publication-distribution-type-1"><input type="checkbox" id="publication-distribution-type-1" name="distribution_type_regular_publication_bin" value="regular_publication_bin" class="form-checkbox">Regular Publication Bin</label>
					</div>
					<div class="form-type-checkbox">
						<label class="control-label" for="publication-distribution-type-2"><input type="checkbox" id="publication-distribution-type-2" name="distribution_type_upgraded_publication_bin" value="upgraded_publication_bin" class="form-checkbox">Upgraded Publication Bin</label>
					</div>
					<p class="checkbox-error" style="display: none; color: red;">Distribution Type field is required.</p>
				</div>
			</div>
			<div class="form-item">
				<label class="control-label" for="publication-shipping-logistics">Shipping Logistics <span class="form-required" title="This field is required.">*</span></label>
				<div id="publication-shipping-logistics" class="form-checkboxes">
					<div class="form-type-checkbox">
						<label class="control-label" for="publication-shipping-logistics-1"><input type="checkbox" id="publication-shipping-logistics-1" name="shipping_logistics_warehouse" value="warehouse" class="form-checkbox">Warehouse in Advance of Show</label>
					</div>
					<div class="form-type-checkbox">
						<label class="control-label" for="publication-shipping-logistics-2"><input type="checkbox" id="publication-shipping-logistics-2" name="shipping_logistics_direct" value="direct" class="form-checkbox">Directly to Show Site</label>
					</div>
					<div class="form-type-checkbox">
						<label class="control-label" for="publication-shipping-logistics-3"><input type="checkbox" id="publication-shipping-logistics-3" name="shipping_logistics_hand_carry" value="hand_carry" class="form-checkbox">Publication are being hand-carried by contact to Show</label>
					</div>
					<p class="checkbox-error" style="display: none; color: red;">Shipping Logistics field is required.</p>
					<div class="help-block"><p>Choose one or more of the shipping options above for your publications.</p></div>
				</div>
			</div>
			<div class="form-item">
				<label class="control-label" for="publication-distribution-policies">Publication Distribution Policies <span class="form-required" title="This field is required.">*</span></label>
				<div class="form-textarea-wrapper resizable">
					<textarea required="required" class="form-control form-textarea" data-toggle="tooltip" id="publication-distribution-policies" name="publication_distribution_policies" cols="100%" rows="15%" data-original-title="Important Information about Publication Shipping...Please Read Carefully!" aria-describedby="tooltip680768">NAB Show is pleased to distribute hundreds of industry publications onsite as a service to both our Media Partners and our attendees. Because of the large volume of publications to be received, inventoried and distributed, we ask that you comply with all terms and conditions so that we can be as efficient as possible with our resources and also provide you with the best service possible.

By agreeing to the terms and conditions of onsite publication distribution, you acknowledge that you have read and understand all policies. Failure to abide by these policies may result in publications not being distributed at the 2018 NAB Show and a decline of distribution at future NAB Shows.

If you have any questions about the Terms and Conditions of onsite publication distribution, please contact Fahduma Majid, at fmajid@nab.org or by phone +1 (202) 429-5371.

Fahduma Majid will be available onsite at NAB Show starting Friday, April 6 and will be located in the Show Management Office.

• You must submit this form to receive official shipping labels for onsite publication distribution.

• If you have secured a publication bin, submitted this form and you decide NOT TO SEND any or all of your titled publications for distribution, you must notify Fahduma Majid via email of that decision by March 23.

• This form must be received by March 23 in order to be guaranteed onsite distribution.

• All publications being shipped for distribution must use the official labels provided by NAB Show, and shipped in advance to the warehouse or direct to Show site arriving in the timeframes specified on the label being used.

• All shipments must be delivered to the location as specified on the labels.

• Publications that are received without proper labels will not be distributed.

• You must submit this form even if you plan to hand-carry your publications to Show site and do not require shipping labels. Publications will not be distributed unless this form has been completed and submitted in advance.

• Publications must be shipped or hand-carried as confirmed on this form.  You must notify Fahduma Majid via email of any changes in delivery method or timeframe by March 23.

• Publications received will not be distributed unless the title and issue date appear exactly indicated on this form.

• If publications are to be hand-carried to Show site, you must arrange to deliver them specifically to Fahduma Majid at the Las Vegas Convention Center, who will be available starting April 6 in the Show Management Office. NAB Show will not be responsible for publications left with any other party, including Freeman directly. Please understand that we will not be able to search for publications if they are lost!

• Hand-carried publications must be delivered by Monday, April 9.

• If you are also exhibiting, DO NOT ship publications to your booth if they are to be distributed via publication bins.

• We will not be checking booth locations for publication bin inventory.

• You will incur drayage charges for the movement of any publications shipped to your booth that are for publication bins.

• If you intend to ship publications to your booth and then bring them yourself to Fahduma Majid for distribution, we will consider those to be hand-carried, and you must deliver them as described above by Monday, April 9.

• If you intend to carry materials on or off the Show Floor at any time, you must comply with all rules and regulations established in your exhibitor agreement.

• NAB Show will not deliver inventory sent for publication bins to your booth location.  If this is requested, you will incur drayage charges.

• If you are shipping internationally, please allow ample time for materials to clear customs and be delivered in the requested time frames.  NAB Show will not be responsible for dealing with customs or freight forwarders on your behalf.  Please be sure to provide them with your complete contact information instead and also plan to be available after work hours to respond to their inquiries.

• You are responsible for tracking shipment of materials sent to NAB Show and for confirming delivery/receipt in advance of the Show starting with your shipper.  If materials are expected and cannot be located, you will be notified by email.

• You must provide complete contact information as requested for the person who will be responsible for ensuring delivery of materials and who will have all delivery confirmation information on hand.

• This contact should plan on checking the email address provided over the weekend prior to the Show starting (April 6 - 8) and be prepared to respond immediately to our inquiries on those days by email. Please be advised that Las Vegas, Nevada is in the Pacific Time Zone.

• This person should also be prepared to receive telephone calls over the weekend specified above or in the evenings depending on difference in time zone.

• This contact should be prepared to provide delivery confirmation including: number of cartons/skids delivered, date delivered, name of person who signed for delivery and tracking number if contacted.  This means you should have your shipment tracked/delivery confirmed ahead of time.

• Please do not email Fahduma Majid or Laura Riggs delivery tracking info unless requested.

• Please do not contact Laura Riggs or Fahduma Majid requesting them to confirm that your publications have been received.  Please know that if we are expecting your materials, you have provided complete information on this form, we will only be contacting you if an issue arises.  Otherwise, know that we have already ensured that the materials are in-hand.

• If for any reason you are aware of a delivery issue or find out that delivery of your publications will be delayed, you must notify Fahduma Majid via email with that information as soon as possible.

• All publications will be distributed in alphabetical order unless they are received late or if the quantity received for each distribution point is less than 1,000.

• NAB Show will restock the publication bins as needed while supply lasts. Once supply has been depleted, the bin will be removed from the show floor.

• We ask that you do not contact Freeman or any of their onsite staff about publication receipt or distribution.  If you have any questions or concerns while onsite, please contact Fahduma Majid.

• NAB Show will not be responsible for switching out inventory of daily publications or later issues supplied in the week unless otherwise arranged with Fahduma Majid.

• All publications received in a timely manner will be put out initially and restocked until inventory is gone.  Inventory is not 'rationed' over the four Show days.  Once your publications are gone, your bin will be removed from the bin bank.

• It is recommended that you send at least 1,500 copies. If you send less, do not be surprised if your publications run out by the end of the first day!

• You will only be provided with 1 (one) Publication Bin. Onsite distribution is bartered at a value of $5,575.00.  The maximum number of standard publication bins bartered for any unique media brand is 1 (one).  Only foreign language publications qualify for distribution in the International Trade Center.  All media sent for distribution must be listed as an official NAB Show Media Partner and be qualified as such.

• All materials that remain at the end of the Show will be recycled.</textarea>
				</div>
			</div>
			<div class="captcha">
				<div class="g-recaptcha" data-sitekey="6LeD8MkUAAAAAOsXcI7-JQI4wf60LTRb2pu44bdW"></div>
				<p class="captcha-error" style="display: none; color:red;">Please check the recaptcha</p>
			</div>
			<?php wp_nonce_field( 'nabshow_forms', 'form_details_nonce' ); ?>
			<input type="hidden" name="form_type" value="publication-shipping-information">
			<input type="hidden" name="to_email" value="<?php echo esc_attr( $to_email ); ?>" />
			<div class="form-actions">
				<button class="form-submit" type="submit" name="op" value="Submit">Submit</button>
			</div>
		</div>
	</form>
<?php
nabshow_lv_enqueue_google_recaptch_script();
