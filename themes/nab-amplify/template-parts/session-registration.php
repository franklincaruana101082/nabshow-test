<?php 
	wp_enqueue_script('nab-ouical', get_template_directory_uri().'/assets/js/ouical.js', array(), '1.0', true); 
	$cal_start    = new DateTime($session_start);
	$cal_end      = new DateTime($session_end);

	$invite_location = get_field('calendar_invite_location') ? get_field('calendar_invite_location') : get_the_permalink();
	$invite_desc = get_field('calendar_invite_description') ? get_field('calendar_invite_description') : get_the_content(null, false, $post->ID);

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
<div class="register">
<button class="button <?php echo($registered ? '' : '_gradientpink'); ?> js-register" <?php echo($registered ? 'disabled="true"' : ''); ?>><?php echo($registered ? 'Registered' : 'Register Now'); ?></button>
	<div class="register__calendar <?php echo($registered ? '_display' : ''); ?>">
		<div 
			class="events-list__event__add"
			data-title="<?php the_title(); ?>"
			data-start="<?php echo $cal_start->format('F d, Y H:i'); ?>"
			data-end="<?php echo $cal_end->format('F d, Y H:i'); ?>"
			data-address="<?php echo $invite_location; ?>"
			data-description="<?php echo wp_strip_all_tags($invite_desc); ?>"
			></div>
	</div>

	<?php if(!$optin_complete && $opt_in_required) : ?>
	<div class="register__message">
		<p>By registering, you consent to receive communications from <?php echo $company_name;?>. Per our agreement, <?php echo $company_name;?> is not permitted to share your data with anyone else. You can stop communications or revise your communication settings at any time by visiting the <?php echo $company_name;?> website.</p>
	</div>
	<?php endif; ?>

<script type="text/javascript">

var rOneYearFromNow = '<?php echo(date('D, d M Y G:i:s e',strtotime(date('D, d M Y G:i:s e', time()) . ' + 365 day'))); ?>';
var rCookieValue = '';
var rCookieName = 'nab_sr';
var session_id = '<?php echo $session_id;?>';
var optin_complete = <?php echo $optin_complete; ?>;
var optin_required = <?php echo(strval($opt_in_required)); ?>;

var opt_id = 0;

var cookieValue = '';
var optVal = '';
var cookieName = 'nab_optin';
var company_id = '<?php echo $company_id;?>';
var registration_required = <?php echo ($registration_required ? "1" : "0"); ?>;
var registered = <?php echo ($registered ? "1" : "0"); ?>;
var displayInline = <?php echo ($displayInline ? "1" : "0"); ?>;
jQuery(function($) {

if(optin_required){
	if(document.cookie.indexOf(cookieName) == -1) {	//optins cookie doesn't exist
		cookieValue = company_id+':2,';
		optVal = 2;

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
		} else { //if the company isn't in the cookieValue let's add it to the end
			cookieValue += company_id+':2,';
			optVal = 2;
		}

	}
}


	$('.js-register').on('click', function() {
		var self = jQuery(this);
		jQuery(self).addClass('_loading').text('Registering...');
		//set registration to cookie
		if(document.cookie.indexOf(rCookieName) == -1) {	//registration cookie doesn't exist
			rCookieValue = session_id+',';
		} else { //registration cookie does exist, add registration to cookie
			var rCookiePart = document.cookie.substr(document.cookie.indexOf(rCookieName));
			var rEndOfCookie = (rCookiePart.indexOf(';') == -1 ? false : rCookiePart.indexOf(';'));
			rCookieValue = rEndOfCookie ? rCookiePart.substring(rCookiePart.indexOf('=')+1,rEndOfCookie) : rCookiePart.substring(rCookiePart.indexOf('=')+1);
			//rCookieValue should be a string of comma seperated session_ids
			//find if this session_id is in the rCookieValue
			if(rCookieValue.indexOf(session_id+',') != -1) {
				//if it's in there this stuff shouldn't even be loaded
				console.log('user is already registered for session, something is broken');
			} else { //if the company isn't in the rCookieValue let's add it to the end
				rCookieValue += session_id+',';
			}
		}

		
		//call ajax function to make new registration entry in DB
		jQuery.post(
			amplifyJS.ajaxurl,
			{
				"nabNonce": amplifyJS.nabNonce,
				action: "nab_register_session",
				'post_title': '<?php echo($user_id . ' : ' . $session_name); ?>',
				'post_status': 'publish',
				'post_author': '<?php echo($user_id);?>',
				'post_type': 'session-registration',
				'session_id': '<?php echo($session_id);?>',
				'session_name': '<?php echo($session_name);?>',
				'session_company_id':'<?php echo($session_company_id);?>',
				'session_company_name':'<?php echo($session_company_name);?>',
				'user_email':'<?php echo($user_email);?>',
				'user_firstname':'<?php echo($user_firstname);?>',
				'user_lastname':'<?php echo($user_lastname);?>',
				'user_city':'<?php echo($user_city);?>',
				'user_state':'<?php echo($user_state);?>',
				'user_country_code': '<?php echo($user_country_code);?>',
				'user_company': '<?php echo($user_company);?>',
				'user_title': '<?php echo($user_title);?>',
				'user_ip': '<?php echo($user_ip);?>',
			},
			function( data ) {
				//set registration cookie
				document.cookie = rCookieName+'='+rCookieValue+'; expires='+rOneYearFromNow+';path=/';
				jQuery(self).text('Registered').attr('disabled', 'true').removeClass('_gradientpink');
				registered = 1;
				if(optin_complete) {
					//reload to show the registered content
					location.reload();
				} else {
					jQuery('.register__calendar').addClass('_display');
				}
				//send tracking info to Segment
				jQuery.ajax({
					url: segmentJS.ajaxurl,
					type: 'POST',
					data: {
						action: 'st_track_session_registration',
						nabNonce: segmentJS.nabNonce,
						user_id: '<?php echo($user_id);?>',
						session_id: '<?php echo($session_id);?>',
						session_name: '<?php echo($session_name);?>',
						session_company_id: '<?php echo($session_company_id);?>',
						session_company_name: '<?php echo($session_company_name);?>',
						user_email: '<?php echo($user_email);?>',
						user_firstname: '<?php echo($user_firstname);?>',
						user_lastname: '<?php echo($user_lastname);?>',
						user_city: '<?php echo($user_city);?>',
						user_state: '<?php echo($user_state);?>',
						user_country_code: '<?php echo($user_country_code);?>',
						user_company: '<?php echo($user_company);?>',
						user_title: '<?php echo($user_title);?>',
						user_ip: '<?php echo($user_ip);?>',
					},
					success: function (response) {

						if(optin_required && !optin_complete){
						//call ajax to opt-in
						var opt = 'true';
						//jQuery(self).addClass('_loading').css('opacity', '1').text('Opting In...');
						
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
								document.cookie = cookieName+'='+cookieValue+'; expires='+rOneYearFromNow+';path=/';
								// jQuery(self).text('Saved');
								// document.setTimeout(function() {
								// 	jQuery(self).text('Registered');
								// },1000);
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
										//reload page to display preview content
										location.reload();
									}
								});

								

							}
						);
						} else if(!optin_complete) {
							jQuery('#modal-opt-in').show();
						}
					}
				});
			}
		);
	});
});

jQuery('.js-optbtn').on('click', function() {
		
		
	});
</script>
</div>