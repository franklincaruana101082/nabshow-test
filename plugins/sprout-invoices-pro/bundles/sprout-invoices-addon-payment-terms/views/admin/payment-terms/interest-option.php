<hr/>
<div id="fees_interest_wrap">
	<div id="tt_body" class="admin_fields clearfix">
		<div id="sa_fees_interest_rate" class="form-group">
			<span class="label_wrap">
				<label for="sa_fees_interest_rate"><?php _e( 'Interest', 'sprout-invoices' ) ?></label>
			</span>
			<div class="input_wrap">
				<span class="sa-form-field sa-form-field-number">
					<input type="number" name="sa_fees_interest_rate" id="sa_fees_interest_rate" class="text-input" value="<?php echo $interest ?>" size="40" step=".01">
					<p class="description help_block"><?php _e( 'The interest rate that will be added every month (date set below) if the invoice still has a balance. Note: "1" is 1%.', 'sprout-invoices' ) ?></p>
				</span>
			</div>
		</div>

		<div id="sa_fees_interest_date" class="form-group">
			<span class="label_wrap">
				<label for="sa_fees_interest_date"><?php _e( 'Interest Day', 'sprout-invoices' ) ?></label>
			</span>
			<div class="input_wrap">
				<span class="sa-form-field sa-form-field-select">
					<select name="sa_fees_interest_date" id="sa_fees_interest_date">
						<?php foreach ( $day_selection as $key => $label ) : ?>
							<option value="<?php echo $key ?>"<?php selected( $key, $interest_date, true ); ?>><?php echo $label ?></option>
						<?php endforeach ?>
					</select>
					<p class="description help_block"><?php _e( 'This is the date the interest will be added if the invoice has a balance', 'sprout-invoices' ) ?></p>
				</span>
			</div>
		</div>

	</div><!-- #tt_body -->
</div><!-- #fees_interest_wrap -->
