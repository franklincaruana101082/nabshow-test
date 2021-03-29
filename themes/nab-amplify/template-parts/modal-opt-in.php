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
				<p><?php echo $company_name;?> would like to communicate with you about this and other products. Please opt-in below.</p>
				<div class="optin__form">
					<label class="field__optinButtons">
						<button type="button" value="true" id="create_opt_in" name="create_opt_in" class="button _gradientpink">Opt In</button>
						<button type="button" value="false" id="create_opt_out" name="create_opt_out" class="button">No Thanks</button>
					</label>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
jQuery(function($) {
	//open opt in modal if no record of opt in/out exists
	jQuery.ajax({
		url: amplifyJS.ajaxurl,
		type: "POST",
		data: {
			action: "nab_check_for_opt_in",
			'company_id': '<?php echo $company_id;?>',
			'user_id': '<?php echo $user_id;?>'
		},
		success: function (data) {
			if (!data.data) {
				jQuery('#modal-opt-in').show();
			}
		},
	});

	//create opt-in post if user is opting in or out
	jQuery('#create_opt_in, #create_opt_out').on('click', function() {
		var opt = jQuery(this).val();
		
		jQuery.post(
			amplifyJS.ajaxurl,
			{
				"nabNonce": amplifyJS.nabNonce,
				action: "nab_create_opt_in_out",
				'post_title': opt.toString() + ' <?php echo($user_first_name . ' ' . $user_last_name . ' : ' . $company_name); ?>',
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
				jQuery('#modal-opt-in').hide();	
			}
		);
		
	});
});
</script>