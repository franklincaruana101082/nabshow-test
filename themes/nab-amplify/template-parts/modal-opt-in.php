<?php
$newTZ = wp_timezone();
$now = new DateTime(gmdate('Y-m-d H:i:s'));
$now->setTimezone($newTZ);
$date_now = $now->format('Y-m-d H:i:s');


$opt_in_occurred_at_id 	= get_queried_object_id();
$opt_in_occurred_at_url = get_permalink( get_queried_object_id() );

if(empty($user_country_code)) {
	$user_country_code = nab_get_geolocation('country');
}
if(empty($user_city)) {
	$user_city = nab_get_geolocation('city');
}
if(empty($user_state)) {
	$user_state = nab_get_geolocation('state');
}


?>
<div id="modal-opt-in" class="nab-modal">
	<div class="nab-modal-inner">
		<div class="modal-content">
			<span class="nab-modal-close fa fa-times"></span>
			<div class="modal-content-wrap">
				<h3>Opt In To Communications</h3>
				<p>Would you like to opt-in to communications from <?php echo $company_name;?>? By opting in, you are indicating that you would like to stay informed of this and other <?php echo $company_name;?> product innovations and allow them to contact you directly. Per our agreement, <?php echo $company_name;?> is not permitted to share your data with anyone else. You can stop communications from <?php echo $company_name;?> or revise your communication settings at any time by directly visiting the <?php echo $company_name;?> website.</p>
				<?php if ($opt_in_required) { ?>
					<p>Opt in is required to access this content.</p>
				<?php } ?>
				
				<div class="optin__form">
					<div class="field__optinButtons">
						<button type="button" value="true" class="button _gradientpink js-optbtn">Opt In</button>
						<?php if (!$opt_in_required) { ?>
						<button type="button" value="false" class="button js-optbtn">No Thanks</button>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container">
<div class="optout__info nabblock js-optout_content" style="display: none;">
	<p>You have previously opted-out of communication with <?php echo($company_name); if(strripos($company_name, ".") == strlen($company_name) - 1): echo(""); else: echo("."); endif;?> If you would like to opt-in you may do so below:</p>
	<p><button type="button" value="true" class="button js-optbtn">Opt In</button></p>

</div>
</div>
<script type="text/javascript">
//open opt in modal if no record of opt in/out exists
//if opted out, show opportunity to opt in
var opt_id = 0;
var opt_in_required = <?php echo(strval($opt_in_required)); ?>;

var oneYearFromNow = '<?php echo(date('D, d M Y G:i:s e',strtotime(date('D, d M Y G:i:s e', time()) . ' + 365 day'))); ?>';
var cookieValue = '';
var optVal = '';
var cookieName = 'nab_optin';
var company_id = '<?php echo $company_id;?>';
var registration_required = <?php echo ($registration_required ? "1" : "0"); ?>;
var registered = <?php echo ($registered ? "1" : "0"); ?>;
var displayInline = <?php echo ($displayInline ? "1" : "0"); ?>;
jQuery(function($) {
	
	if(document.cookie.indexOf(cookieName) == -1) {	//optins cookie doesn't exist
		cookieValue = company_id+':2,';
		optVal = 2;
		if(registered && !displayInline) {
			jQuery('#modal-opt-in').show();
		} else {
			var optin_content = jQuery('#modal-opt-in .modal-content-wrap').html();
			jQuery('.js-optin_content').html(optin_content);
			jQuery('.js-optin_content').parent().show();
		}
	} else { //optins cookie does exist
		var cookiePart = document.cookie.substr(document.cookie.indexOf(cookieName));
		var endOfCookie = (cookiePart.indexOf(';') == -1 ? false : cookiePart.indexOf(';'));
		var cookieValue = endOfCookie ? cookiePart.substring(cookiePart.indexOf('=')+1,endOfCookie) : cookiePart.substring(cookiePart.indexOf('=')+1);
		//cookieValue should be a string of comma seperated: {company_id}:{0,1,2}
		//0 = opted out, 1 = opted in, 2 = not opted in or out (rare)
		
		//find if this company ID is in the cookieValue
		if(cookieValue.indexOf(company_id+':') != -1) {
			//get opt in value for company_id
			optVal = cookieValue.substr(cookieValue.indexOf(company_id+':')+company_id.length+1, 1);
			if (optVal == 2) { //this might be impossible now
				if(registered && !displayInline) {
					jQuery('#modal-opt-in').show();	
				} else {
					var optin_content = jQuery('#modal-opt-in .modal-content-wrap').html();
					jQuery('.js-optin_content').html(optin_content);
					jQuery('.js-optin_content').parent().show();
				}
			} else if(optVal == '0' && opt_in_required) {
				if(registered && !displayInline) {
					jQuery('#modal-opt-in').show();
				} else {
					var optin_content = jQuery('#modal-opt-in .modal-content-wrap').html();
					jQuery('.js-optin_content').html(optin_content);
					jQuery('.js-optin_content').parent().show();
				}
			} else if(optVal == '0') {
				jQuery('.js-optout_content').show();	
			}
		} else { //if the company isn't in the cookieValue let's add it to the end
			cookieValue += company_id+':2,';
			optVal = 2;
			if(registered && !displayInline) {
				jQuery('#modal-opt-in').show();
			} else {
				var optin_content = jQuery('#modal-opt-in .modal-content-wrap').html();
				jQuery('.js-optin_content').html(optin_content);
				jQuery('.js-optin_content').parent().show();
			}
		}

	}
	

	jQuery('.js-optbtn').on('click', function() {
		var opt = jQuery(this).val();
		console.log(opt);
		var self = jQuery(this);
		jQuery(self).closest('#modal-opt-in, .optout__info').addClass('_loading');
		jQuery('.js-optbtn').css('opacity', '.25');
		jQuery(self).css('opacity', '1').text('Saving...');
		
		jQuery.post(
			amplifyJS.ajaxurl,
			{
				"nabNonce": amplifyJS.nabNonce,
				action: "nab_create_update_opt_in_out",
				'ID': opt_id,
				'post_title': opt.toString() + ' <?php echo($user_id . ' : ' . $company_name); ?>',
				'post_status': 'publish',
				'post_date': '<?php echo($date_now);?>',
				'post_author': '<?php echo($user_id);?>',
				'post_type': 'opt-in',
				'company_id':'<?php echo($company_id);?>',
				'company_name':'<?php echo($company_name);?>',
				'opted_in':opt,
				'user_first_name':'<?php echo($user_firstname);?>',
				'user_last_name':'<?php echo($user_lastname);?>',
				'user_email':'<?php echo($user_email);?>',
				'user_ip':'<?php echo($user_ip);?>',
				'user_company':'<?php echo($user_company);?>',
				'user_title':'<?php echo($user_title);?>',
				'user_city':'<?php echo($user_city);?>',
				'user_state':'<?php echo($user_state);?>',
				'user_country':'<?php echo($user_country_code);?>',
				'opt_in_occurred_at_id':'<?php echo($opt_in_occurred_at_id);?>',
				'opt_in_occurred_at_url':'<?php echo($opt_in_occurred_at_url);?>'
			},
			function( data ) {
				var optNum = opt == 'true' ? 1 : 0;
				//update cookieValue and set to cookie
				cookieValue = cookieValue.replace(company_id+':'+optVal, company_id+':'+optNum);
				document.cookie = cookieName+'='+cookieValue+'; expires='+oneYearFromNow+';path=/';
				jQuery(self).text('Saved');
				jQuery(self).closest('#modal-opt-in, .optout__info').delay(250).hide(250);
				optin_complete = 1;
				//send tracking info to Segment
				jQuery.ajax({
					url: segmentJS.ajaxurl,
					type: 'POST',
					data: {
						action: 'st_track_opt_in_out',
						nabNonce: segmentJS.nabNonce,
						opted_in: opt,
						user_id: '<?php echo($user_id);?>',
						company_id: '<?php echo($company_id);?>',
						company_name: '<?php echo($company_name);?>',
						user_firstname: '<?php echo($user_firstname);?>',
						user_lastname: '<?php echo($user_lastname);?>',
						user_email: '<?php echo($user_email);?>',
						user_ip: '<?php echo($user_ip);?>',
						user_title: '<?php echo($user_title);?>',
						user_company: '<?php echo($user_company);?>',
						user_city: '<?php echo($user_city);?>',
						user_state: '<?php echo($user_state);?>',
						user_country_code: '<?php echo($user_country_code);?>',
						opt_in_occurred_at_id: '<?php echo($opt_in_occurred_at_id);?>',
            			opt_in_occurred_at_url: '<?php echo($opt_in_occurred_at_url);?>',
            			occurred_at_type: '<?php echo($occurred_at_type);?>'
					},
					success: function (response) {
					}
				});

				if((opt_in_required && !registration_required) 
					|| (opt_in_required && registration_required && registered)
					|| (!opt_in_required && registration_required && registered)) {
					location.reload();
				}
			}
		);
		
	});

});
</script>
