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
jQuery(function($) {
	//open opt in modal if no record of opt in/out exists
	//if opted out, show opportunity to opt in
	var opt_id = 0;
	var opt_in_required = <?php echo(strval($opt_in_required)); ?>;
	jQuery.ajax({
		url: amplifyJS.ajaxurl,
		type: "POST",
		data: {
			action: "nab_check_for_opt_in",
			'company_id': '<?php echo $company_id;?>',
			'user_id': '<?php echo $user_id;?>'
		},
		success: function (result) {
			if (!result.data.length) {
				jQuery('#modal-opt-in').show();
			} else {
				if(opt_in_required && result.data[0].post_title.indexOf('false') != -1) {
					jQuery('#modal-opt-in').show();
				} else if(result.data[0].post_title.indexOf('false') != -1) {
					jQuery('.optout__info').show();
				}
				opt_id = result.data[0].ID;
			}
		},
	});

	jQuery('.js-optbtn').on('click', function() {
		var opt = jQuery(this).val();
		var self = jQuery(this);
		jQuery('.js-optbtn').css('opacity', '.25');
		jQuery(self).css('opacity', '1').text('Saving...');
		
		jQuery.post(
			amplifyJS.ajaxurl,
			{
				"nabNonce": amplifyJS.nabNonce,
				action: "nab_create_update_opt_in_out",
				'ID': opt_id,
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