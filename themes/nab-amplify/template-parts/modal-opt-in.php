<?php
$newTZ = wp_timezone();
$now = new DateTime(gmdate('Y-m-d H:i:s'));
$now->setTimezone($newTZ);
$date_now = $now->format('Y-m-d H:i:s');


$company_name			= get_the_title($company_id);
$user					= get_user_by( 'id', $user_id );
$user_first_name 		= get_user_meta( $user_id, "first_name", true);
$user_last_name 		= get_user_meta( $user_id, "last_name", true);
$user_email 			= $user->user_email;;
$user_ip 				= $_SERVER['REMOTE_ADDR'];
$opt_in_occurred_at_id 	= get_queried_object_id();
$opt_in_occurred_at_url = get_permalink( get_queried_object_id() );


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
					<label class="field__optinButtons">
						<button type="button" value="true" class="button _gradientpink js-optbtn">Opt In</button>
						<?php if (!$opt_in_required) { ?>
						<button type="button" value="false" class="button js-optbtn">No Thanks</button>
						<?php } ?>
					</label>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container">
<div class="optout__info nabblock" style="display: none;">
	<p>You have previously opted-out of communication with <?php echo($company_name); if(strripos($company_name, ".") == strlen($company_name) - 1): echo(""); else: echo("."); endif;?> If you would like to opt-in you may do so below:</p>
	<p><button type="button" value="true" class="button js-optbtn">Opt In</button></p>

</div>
</div>
<script>
//open opt in modal if no record of opt in/out exists
//if opted out, show opportunity to opt in
var opt_id = 0;
var opt_in_required = <?php echo(strval($opt_in_required)); ?>;

var oneYearFromNow = new Date(new Date().setFullYear(new Date().getFullYear() + 1));
var cookieValue = '';
var optVal = '';
var cookieName = 'nab_optin';
var company_id = '<?php echo $company_id;?>';
jQuery(function($) {
	
	if(document.cookie.indexOf(cookieName) == -1) {	//optins cookie doesn't exist
		cookieValue = company_id+':2,';
		optVal = 2;
		jQuery('#modal-opt-in').show();
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
			if (optVal == 2) {
				jQuery('#modal-opt-in').show();	
			} else if(optVal == 0 && opt_in_required) {
				jQuery('#modal-opt-in').show();
			} else if(optVal == 0) {
				jQuery('.optout__info').show();	
			}
		} else { //if the company isn't in the cookieValue let's add it to the end
			cookieValue += company_id+':2,';
			optVal = 2;
			jQuery('#modal-opt-in').show();
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
				'user_first_name':'<?php echo($user_first_name);?>',
				'user_last_name':'<?php echo($user_last_name);?>',
				'user_email':'<?php echo($user_email);?>',
				'user_ip':'<?php echo($user_ip);?>',
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
				if(opt_in_required) {
					location.reload();
				}
			}
		);
		
	});

});
</script>