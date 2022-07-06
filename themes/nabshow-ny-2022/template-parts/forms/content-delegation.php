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
<form class="nab-form delegation-form" method="post">
	<div class="form-items-wrapper">
		<div class="form-item">
			<label class="control-label" for="delegation-first-name">First Name <span class="form-required" title="This field is required.">*</span></label>
			<input required="required" pattern=".*\S+.*" class="form-control form-text" type="text" id="delegation-first-name" name="first_name" size="60" maxlength="128">
		</div>
		<div class="form-item">
			<label class="control-label" for="delegation-last-name">Last Name <span class="form-required" title="This field is required.">*</span></label>
			<input required="required" pattern=".*\S+.*" class="form-control form-text" type="text" id="delegation-last-name" name="last_name" size="60" maxlength="128">
		</div>
		<div class="form-item">
			<label class="control-label" for="delegation-company">Company <span class="form-required" title="This field is required.">*</span></label>
			<input required="required" pattern=".*\S+.*" class="form-control form-text" type="text" id="delegation-company" name="company" size="60" maxlength="128">
		</div>
		<div class="form-item">
			<label class="control-label" for="delegation-address">Mailing Address <span class="form-required" title="This field is required.">*</span></label>
			<input required="required" pattern=".*\S+.*" class="form-control form-text" type="text" id="delegation-address" name="address" size="60" maxlength="128">
		</div>
		<div class="form-item">
			<label class="control-label" for="delegation-city">City <span class="form-required" title="This field is required.">*</span></label>
			<input required="required" pattern=".*\S+.*" class="form-control form-text" type="text" id="delegation-city" name="city" size="60" maxlength="128">
		</div>
		<div class="form-item">
			<label class="control-label" for="delegation-state-province">State/Province</label>
			<input class="form-control form-text" type="text" id="delegation-state-province" name="state_province" size="60" maxlength="128">
		</div>
		<div class="form-item">
			<label class="control-label" for="delegation-postal-code">Zip/Postal Code <span class="form-required" title="This field is required.">*</span></label>
			<input required="required" pattern=".*\S+.*" class="form-control form-text" type="text" id="delegation-postal-code" name="zip_postal_code" size="60" maxlength="128">
		</div>
		<div class="form-item">
			<label class="control-label" for="delegation-country">Country <span class="form-required" title="This field is required.">*</span></label>
			<select required="required" class="form-control form-select" id="delegation-country" name="country">
				<option value="" selected="selected">- Select -</option>
				<option value="AF">Afghanistan</option>
				<option value="AX">Aland Islands</option>
				<option value="AL">Albania</option>
				<option value="DZ">Algeria</option>
				<option value="AS">American Samoa</option>
				<option value="AD">Andorra</option>
				<option value="AO">Angola</option>
				<option value="AI">Anguilla</option>
				<option value="AQ">Antarctica</option>
				<option value="AG">Antigua and Barbuda</option>
				<option value="AR">Argentina</option>
				<option value="AM">Armenia</option>
				<option value="AW">Aruba</option>
				<option value="AU">Australia</option>
				<option value="AT">Austria</option>
				<option value="AZ">Azerbaijan</option>
				<option value="BS">Bahamas</option>
				<option value="BH">Bahrain</option>
				<option value="BD">Bangladesh</option>
				<option value="BB">Barbados</option>
				<option value="BY">Belarus</option>
				<option value="BE">Belgium</option>
				<option value="BZ">Belize</option>
				<option value="BJ">Benin</option>
				<option value="BM">Bermuda</option>
				<option value="BT">Bhutan</option>
				<option value="BO">Bolivia</option>
				<option value="BA">Bosnia and Herzegovina</option>
				<option value="BW">Botswana</option>
				<option value="BV">Bouvet Island</option>
				<option value="BR">Brazil</option>
				<option value="IO">British Indian Ocean Territory</option>
				<option value="VG">British Virgin Islands</option>
				<option value="BN">Brunei</option>
				<option value="BG">Bulgaria</option>
				<option value="BF">Burkina Faso</option>
				<option value="BI">Burundi</option>
				<option value="KH">Cambodia</option>
				<option value="CM">Cameroon</option>
				<option value="CA">Canada</option>
				<option value="CV">Cape Verde</option>
				<option value="BQ">Caribbean Netherlands</option>
				<option value="KY">Cayman Islands</option>
				<option value="CF">Central African Republic</option>
				<option value="TD">Chad</option>
				<option value="CL">Chile</option>
				<option value="CN">China</option>
				<option value="CX">Christmas Island</option>
				<option value="CC">Cocos (Keeling) Islands</option>
				<option value="CO">Colombia</option>
				<option value="KM">Comoros</option>
				<option value="CG">Congo (Brazzaville)</option>
				<option value="CD">Congo (Kinshasa)</option>
				<option value="CK">Cook Islands</option>
				<option value="CR">Costa Rica</option>
				<option value="HR">Croatia</option>
				<option value="CU">Cuba</option>
				<option value="CW">Curaçao</option>
				<option value="CY">Cyprus</option>
				<option value="CZ">Czech Republic</option>
				<option value="DK">Denmark</option>
				<option value="DJ">Djibouti</option>
				<option value="DM">Dominica</option>
				<option value="DO">Dominican Republic</option>
				<option value="EC">Ecuador</option>
				<option value="EG">Egypt</option>
				<option value="SV">El Salvador</option>
				<option value="GQ">Equatorial Guinea</option>
				<option value="ER">Eritrea</option>
				<option value="EE">Estonia</option>
				<option value="ET">Ethiopia</option>
				<option value="FK">Falkland Islands</option>
				<option value="FO">Faroe Islands</option>
				<option value="FJ">Fiji</option>
				<option value="FI">Finland</option>
				<option value="FR">France</option>
				<option value="GF">French Guiana</option>
				<option value="PF">French Polynesia</option>
				<option value="TF">French Southern Territories</option>
				<option value="GA">Gabon</option>
				<option value="GM">Gambia</option>
				<option value="GE">Georgia</option>
				<option value="DE">Germany</option>
				<option value="GH">Ghana</option>
				<option value="GI">Gibraltar</option>
				<option value="GR">Greece</option>
				<option value="GL">Greenland</option>
				<option value="GD">Grenada</option>
				<option value="GP">Guadeloupe</option>
				<option value="GU">Guam</option>
				<option value="GT">Guatemala</option>
				<option value="GG">Guernsey</option>
				<option value="GN">Guinea</option>
				<option value="GW">Guinea-Bissau</option>
				<option value="GY">Guyana</option>
				<option value="HT">Haiti</option>
				<option value="HM">Heard Island and McDonald Islands</option>
				<option value="HN">Honduras</option>
				<option value="HK">Hong Kong S.A.R., China</option>
				<option value="HU">Hungary</option>
				<option value="IS">Iceland</option>
				<option value="IN">India</option>
				<option value="ID">Indonesia</option>
				<option value="IR">Iran</option>
				<option value="IQ">Iraq</option>
				<option value="IE">Ireland</option>
				<option value="IM">Isle of Man</option>
				<option value="IL">Israel</option>
				<option value="IT">Italy</option>
				<option value="CI">Ivory Coast</option>
				<option value="JM">Jamaica</option>
				<option value="JP">Japan</option>
				<option value="JE">Jersey</option>
				<option value="JO">Jordan</option>
				<option value="KZ">Kazakhstan</option>
				<option value="KE">Kenya</option>
				<option value="KI">Kiribati</option>
				<option value="KW">Kuwait</option>
				<option value="KG">Kyrgyzstan</option>
				<option value="LA">Laos</option>
				<option value="LV">Latvia</option>
				<option value="LB">Lebanon</option>
				<option value="LS">Lesotho</option>
				<option value="LR">Liberia</option>
				<option value="LY">Libya</option>
				<option value="LI">Liechtenstein</option>
				<option value="LT">Lithuania</option>
				<option value="LU">Luxembourg</option>
				<option value="MO">Macao S.A.R., China</option>
				<option value="MK">Macedonia</option>
				<option value="MG">Madagascar</option>
				<option value="MW">Malawi</option>
				<option value="MY">Malaysia</option>
				<option value="MV">Maldives</option>
				<option value="ML">Mali</option>
				<option value="MT">Malta</option>
				<option value="MH">Marshall Islands</option>
				<option value="MQ">Martinique</option>
				<option value="MR">Mauritania</option>
				<option value="MU">Mauritius</option>
				<option value="YT">Mayotte</option>
				<option value="MX">Mexico</option>
				<option value="FM">Micronesia</option>
				<option value="MD">Moldova</option>
				<option value="MC">Monaco</option>
				<option value="MN">Mongolia</option>
				<option value="ME">Montenegro</option>
				<option value="MS">Montserrat</option>
				<option value="MA">Morocco</option>
				<option value="MZ">Mozambique</option>
				<option value="MM">Myanmar</option>
				<option value="NA">Namibia</option>
				<option value="NR">Nauru</option>
				<option value="NP">Nepal</option>
				<option value="NL">Netherlands</option>
				<option value="AN">Netherlands Antilles</option>
				<option value="NC">New Caledonia</option>
				<option value="NZ">New Zealand</option>
				<option value="NI">Nicaragua</option>
				<option value="NE">Niger</option>
				<option value="NG">Nigeria</option>
				<option value="NU">Niue</option>
				<option value="NF">Norfolk Island</option>
				<option value="MP">Northern Mariana Islands</option>
				<option value="KP">North Korea</option>
				<option value="NO">Norway</option>
				<option value="OM">Oman</option>
				<option value="PK">Pakistan</option>
				<option value="PW">Palau</option>
				<option value="PS">Palestinian Territory</option>
				<option value="PA">Panama</option>
				<option value="PG">Papua New Guinea</option>
				<option value="PY">Paraguay</option>
				<option value="PE">Peru</option>
				<option value="PH">Philippines</option>
				<option value="PN">Pitcairn</option>
				<option value="PL">Poland</option>
				<option value="PT">Portugal</option>
				<option value="PR">Puerto Rico</option>
				<option value="QA">Qatar</option>
				<option value="RE">Reunion</option>
				<option value="RO">Romania</option>
				<option value="RU">Russia</option>
				<option value="RW">Rwanda</option>
				<option value="BL">Saint Barthélemy</option>
				<option value="SH">Saint Helena</option>
				<option value="KN">Saint Kitts and Nevis</option>
				<option value="LC">Saint Lucia</option>
				<option value="MF">Saint Martin (French part)</option>
				<option value="PM">Saint Pierre and Miquelon</option>
				<option value="VC">Saint Vincent and the Grenadines</option>
				<option value="WS">Samoa</option>
				<option value="SM">San Marino</option>
				<option value="ST">Sao Tome and Principe</option>
				<option value="SA">Saudi Arabia</option>
				<option value="SN">Senegal</option>
				<option value="RS">Serbia</option>
				<option value="SC">Seychelles</option>
				<option value="SL">Sierra Leone</option>
				<option value="SG">Singapore</option>
				<option value="SX">Sint Maarten</option>
				<option value="SK">Slovakia</option>
				<option value="SI">Slovenia</option>
				<option value="SB">Solomon Islands</option>
				<option value="SO">Somalia</option>
				<option value="ZA">South Africa</option>
				<option value="GS">South Georgia and the South Sandwich Islands</option>
				<option value="KR">South Korea</option>
				<option value="SS">South Sudan</option>
				<option value="ES">Spain</option>
				<option value="LK">Sri Lanka</option>
				<option value="SD">Sudan</option>
				<option value="SR">Suriname</option>
				<option value="SJ">Svalbard and Jan Mayen</option>
				<option value="SZ">Swaziland</option>
				<option value="SE">Sweden</option>
				<option value="CH">Switzerland</option>
				<option value="SY">Syria</option>
				<option value="TW">Taiwan</option>
				<option value="TJ">Tajikistan</option>
				<option value="TZ">Tanzania</option>
				<option value="TH">Thailand</option>
				<option value="TL">Timor-Leste</option>
				<option value="TG">Togo</option>
				<option value="TK">Tokelau</option>
				<option value="TO">Tonga</option>
				<option value="TT">Trinidad and Tobago</option>
				<option value="TN">Tunisia</option>
				<option value="TR">Turkey</option>
				<option value="TM">Turkmenistan</option>
				<option value="TC">Turks and Caicos Islands</option>
				<option value="TV">Tuvalu</option>
				<option value="VI">U.S. Virgin Islands</option>
				<option value="UG">Uganda</option>
				<option value="UA">Ukraine</option>
				<option value="AE">United Arab Emirates</option>
				<option value="GB">United Kingdom</option>
				<option value="US">United States</option>
				<option value="UM">United States Minor Outlying Islands</option>
				<option value="UY">Uruguay</option>
				<option value="UZ">Uzbekistan</option>
				<option value="VU">Vanuatu</option>
				<option value="VA">Vatican</option>
				<option value="VE">Venezuela</option>
				<option value="VN">Vietnam</option>
				<option value="WF">Wallis and Futuna</option>
				<option value="EH">Western Sahara</option>
				<option value="YE">Yemen</option>
				<option value="ZM">Zambia</option>
				<option value="ZW">Zimbabwe</option>
			</select>
		</div>
		<div class="form-item">
			<label class="control-label" for="delegation-phone">Phone <span class="form-required" title="This field is required.">*</span></label>
			<input required="required" pattern=".*\S+.*" class="form-control form-text" data-toggle="tooltip" type="text" id="delegation-phone" name="phone" size="60" maxlength="128" data-original-title="Please include Country and City codes.">
		</div>
		<div class="form-item">
			<label class="control-label" for="delegation-email">Email <span class="form-required" title="This field is required.">*</span></label>
			<input required="required" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,5}$" class="form-control form-text" type="email" id="delegation-email" name="email" size="60">
		</div>
		<div class="form-item">
			<label class="control-label" for="delegation-country-represented">Country / Countries being represented <span class="form-required" title="This field is required.">*</span></label>
			<input required="required" pattern=".*\S+.*" class="form-control form-text" type="text" id="delegation-country-represented" name="country_represented" value="" size="60" maxlength="128">
		</div>
		<div class="form-item">
			<label class="control-label" for="delegation-associated-with-us-department">Associated with the U.S. Department of Commerce? <span class="form-required" title="This field is required.">*</span></label>
			<select required="required" class="form-control form-select" id="delegation-associated-with-us-department" name="associated_with_the_us_department">
				<option value="">- Select -</option>
				<option value="yes">Yes</option>
				<option value="no">No</option>
			</select>
		</div>
		<div class="form-item">
			<label class="control-label" for="delegation-number-of-delegates">Please provide an estimated number of delegates that will be joining your group.</label>
			<input class="form-control form-text" pattern="\d+(,\d{2,5})?" type="text" id="delegation-number-of-delegates" name="estimated_number_of_delegates" min="0" step="1">
		</div>
		<fieldset class="form-fieldset" id="bootstrap-panel--2">
			<legend class="panel-heading">
				<span class="panel-title fieldset-legend">Registration Information</span>
			</legend>
			<div class="panel-body" id="bootstrap-panel-2-body">
				<div class="form-item">
					<label class="control-label" for="delegation-reg-info-attending-nabshow-as-well">Will you be attending NAB Show as well?</label>
					<div id="delegation-reg-info-attending-nabshow-as-well" class="form-radios">
						<div class="form-type-radio">
							<label class="control-label" for="delegation-registration-information-attending-nabshow-as-well-1"><input type="radio" id="delegation-registration-information-attending-nabshow-as-well-1" name="registration_information_attending_nabshow_as_well" value="yes" class="form-radio">Yes</label>
						</div>
						<div class="form-type-radio">
							<label class="control-label" for="delegation-registration-information-attending-nabshow-as-well-2"><input type="radio" id="delegation-registration-information-attending-nabshow-as-well-2" name="registration_information_attending_nabshow_as_well" value="no" class="form-radio">No</label>
						</div>
					</div>
				</div>
				<div class="hidden-field-items">
					<div class="help-block">
						<p>If no, will someone else service your Delegation in Las Vegas, and what is that person's name and email?</p>
					</div>
					<div class="form-item">
						<label class="control-label" for="delegation-registration-information-proxy-name">Name</label>
						<input class="form-control form-text" type="text" id="delegation-registration-information-proxy-name" name="registration_information_proxy_name" size="60" maxlength="128">
					</div>
					<div class="form-item">
						<label class="control-label" for="delegation-registration-information-proxy-email">Email</label>
						<input class="form-control form-text" type="text" id="delegation-registration-information-proxy-email" name="registration_information_proxy_email" size="60" maxlength="128">
					</div>
					<div class="form-item">
						<label class="control-label" for="delegation-reg-info-registering-all-delegates-yourself">Will you be registering all Delegates yourself?</label>
						<div id="delegation-reg-info-registering-all-delegates-yourself" class="form-radios">
							<div class="form-type-radio">
								<label class="control-label" for="delegation-registration-information-registering-all-delegates-yourself-1"><input type="radio" id="delegation-registration-information-registering-all-delegates-yourself-1" name="registration_information_registering_all_delegates_yourself" value="yes" class="form-radio">Yes</label>
							</div>
							<div class="form-type-radio">
								<label class="control-label" for="delegation-registration-information-registering-all-delegates-yourself-2"><input type="radio" id="delegation-registration-information-registering-all-delegates-yourself-2" name="registration_information_registering_all_delegates_yourself" value="no" class="form-radio">No</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</fieldset>
		<div class="captcha">
			<div class="g-recaptcha" data-sitekey="6Lfwj9wSAAAAAGC50P7LPTXvapy4cdM6GuPJ5Zh3"></div>
			<p class="captcha-error" style="display: none; color:red;">Please check the recaptcha</p>
		</div>
		<?php wp_nonce_field( 'nabshow_forms', 'form_details_nonce' ); ?>
		<input type="hidden" name="form_type" value="delegation-leader-enrollment">
		<input type="hidden" name="to_email" value="<?php echo esc_attr( $to_email ); ?>" />
		<div class="form-actions">
			<button class="form-submit" type="submit" name="op" value="Submit">Submit</button>
		</div>
	</div>
</form>
<?php
nabshow_lv_enqueue_google_recaptch_script();
