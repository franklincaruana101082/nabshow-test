<div class="sa-control-group billingtos_agreeeement ">
	<div class="sa-controls input_wrap">
		<label for="<?php echo $input_name ?>" class="sa-checkbox">
			<span class="sa-form-field sa-form-field-checkbox">
				<input type="checkbox" name="<?php echo $input_name ?>" id="<?php echo $input_name ?>" <?php if ( $default_tos ) { echo 'checked="checked"'; }  ?> value="1" class="checkbox">
			</span>
		<?php echo str_replace( array( '<p>', '</p>' ), '', $tos_text ) ?></label>
	</div>
</div>

<script type="text/javascript" charset="utf-8">
	jQuery(document).ready(function() {
		var $submit = jQuery( '#si_credit_card_form button[type="submit"]' );
		$submit.prop('disabled',true);
		jQuery('#<?php echo $input_name ?>').on( 'click', function() {
			$submit.prop('disabled',true);
			if ( $(this).is(':checked') ) {
				$submit.prop('disabled',false);
			};
		} );
	});
</script>
<style type="text/css">
	button[type="submit"]:disabled {
	  opacity: .5;
	}
</style>
