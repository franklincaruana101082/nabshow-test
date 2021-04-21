
<div class="register">
<button class="button _gradientpink js-register">Register Now</button>

<script type="text/javascript">

var rOneYearFromNow = new Date(new Date().setFullYear(new Date().getFullYear() + 1));
var rCookieValue = '';
var rCookieName = 'nab_sr';
var session_id = '<?php echo $session_id;?>';
var optin_complete = <?php echo $optin_complete; ?>;
jQuery(function($) {
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
				'user_country_code': '<?php echo($user_country_code);?>',
				'user_company': '<?php echo($user_company);?>',
				'user_title': '<?php echo($user_title);?>',
			},
			function( data ) {
				//set registration cookie
				document.cookie = rCookieName+'='+rCookieValue+'; expires='+oneYearFromNow+';path=/';
				jQuery(self).text('Registered').delay(250).hide(250);
				registered = 1;
				if(optin_complete) {
					//reload to show the registered content
					location.reload();
				}
			}
		);
	});

});
</script>
</div>