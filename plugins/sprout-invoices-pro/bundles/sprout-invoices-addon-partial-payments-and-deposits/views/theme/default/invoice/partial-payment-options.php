<div id="si_pp_payment_amount" class="row description">
	
	<?php do_action( 'si_partial_payments_preheading' ) ?>

	<?php if ( $min_payment ) :  ?>
		<p><?php _e( 'Select or enter your payment amount below.', 'sprout-invoices' ) ?></p>
	<?php else : ?>
		<p><?php _e( 'Select your payment amount below.', 'sprout-invoices' ) ?></p>
	<?php endif; ?>

	<?php do_action( 'si_partial_payments_heading' ) ?>

	<?php if ( $unfiltered_deposit ) :  ?>
		<div id="si_deposit_payment_due" class="si_pp_option_wrap" data-option="si_deposit_payment_due">
			<span class="radiobtn selected"></span>
			<span class="payment_info">
				<span class="payment_desc"><?php _e( '
	Deposit due', 'sprout-invoices' ) ?></span>
				<span class="payment_amount"><?php sa_formatted_money( $unfiltered_deposit ) ?></span>
			</span>
			<?php do_action( 'si_partial_payments_deposit_info' ) ?>
			<input type="hidden" value="<?php echo $unfiltered_deposit ?>" />
		</div><!-- #si_deposit_payment_due -->
	<?php endif ?>
	<div id="si_remaining_balance" class="si_pp_option_wrap" data-option="si_remaining_balance">
		<span class="radiobtn"></span>
		<span class="payment_info">
			<span class="payment_desc"><?php _e( '
Current balance', 'sprout-invoices' ) ?></span>
			<span class="payment_amount"><?php sa_formatted_money( $balance ) ?></span>
		</span>
		<?php do_action( 'si_partial_payments_remainingpayment_info' ) ?>
		<input type="hidden" value="<?php echo $balance ?>" />
	</div><!-- #si_remaining_balance -->
	<?php if ( $min_payment ) :  ?>

		<?php if ( apply_filters( 'si_pp_show_min_selection', true ) ) :  ?>
			<div id="si_minimum_payment_due" class="si_pp_option_wrap" data-option="si_minimum_payment_due">
				<span class="radiobtn"></span>
				<span class="payment_info">
					<span class="payment_desc"><?php _e( '
		Minimum payment amount', 'sprout-invoices' ) ?></span>
					<span class="payment_amount"><?php sa_formatted_money( $min_payment ) ?></span>
				</span>
				<?php do_action( 'si_partial_payments_minpayment_info' ) ?>
				<input type="hidden" value="<?php echo $min_payment ?>" />
			</div><!-- #si_minimum_payment_due -->
		<?php endif ?>

		<?php if ( $min_payment < $balance ) :  ?>
			<div id="si_other_payment" class="si_pp_option_wrap" data-option="si_other_payment">
				<span class="radiobtn"></span>
				<span class="payment_info">
					<span class="payment_desc"><?php _e( 'Other amount', 'sprout-invoices' ) ?></span>
					<span class="payment_amount"><?php sa_currency_symbol() ?><input type="number" id="modify_deposit_amount_input" name="deposit_amount" value="<?php si_number_format( $unfiltered_deposit ) ?>" min="<?php echo $min_payment ?>" max="<?php echo $max_payment ?>"  /></span>
				</span>
				<span class="more_payment_desc"><?php printf( __( 'Minimum payment amount is %1$s.', 'sprout-invoices' ), sa_get_formatted_money( $min_payment ), sa_get_formatted_money( $max_payment ) ) ?></span>
			</div><!-- #si_other_payment -->
		<?php endif ?>
	<?php else : ?>
		<input type="hidden" id="modify_deposit_amount_input" value="<?php si_number_format( $unfiltered_deposit ) ?>" />
	<?php endif ?>

	<input type="hidden" name="si_pp_invoice_id" value="<?php the_ID() ?>" />
	<input type="hidden" name="si_pp_payment_amount" value="<?php echo $unfiltered_deposit ?>" />

	<?php do_action( 'si_partial_payments_presubmit' ) ?>

	<button id="modify_payment_amount_button" class="button"><?php _e( 'Continue', 'sprout-invoices' ) ?></button>

	<?php do_action( 'si_partial_payments_submit' ) ?>

</div>

<script type="text/javascript">
	//<![CDATA[
	jQuery(document).ready( function($) {

		// hide payment options
		$( '.row.toggles' ).hide();
		$( '.row.paytypes' ).hide();
		$( '.make_payment_desc' ).hide();

		$('#modify_deposit_amount_input').on('mouseup keyup change', function () {
			
			$("[name='si_pp_payment_amount']").val( $(this).val() );

		});

		$( '.si_pp_option_wrap' ).on('click', function(event) {

			var $wrap = $(this),
				selected_payment_amount = $(this).find('input').val();

			$( ".radiobtn" ).each(function( index ) {
				$( this ).removeClass('selected');
			});

			$wrap.find('.radiobtn').addClass('selected');

			$("[name='si_pp_payment_amount']").val( selected_payment_amount );
		});

		$( '#modify_payment_amount_button' ).on('click', function(event) {
			event.preventDefault();

			var $button = $(this),
				$payment_amount_input = $("[name='si_pp_payment_amount']"),
				$custom_input = $("#modify_deposit_amount_input"),
				invoice_id = $("[name='si_pp_invoice_id']").val(),
				payment_amount = parseFloat( $payment_amount_input.val()),
				min = parseFloat('<?php echo $min_payment ?>'),
				max = parseFloat('<?php echo $max_payment ?>');;

			if ( payment_amount < min ) {
				$custom_input.val( min );
				$payment_amount_input.val( min );
				payment_amount = min;
			}

			if ( payment_amount > max ) {
				$custom_input.val( max );
				$payment_amount_input.val( max );
				payment_amount = max;
			}


			// don't allow for multiple clicks to wreck havoc
			$button.prop( 'disabled', true );

			// add a spinner to show people things are working
			$button.after(si_js_object.inline_spinner);

			// ajax action
			$.post( si_js_object.ajax_url, { action: '<?php echo SI_Partial_Payments::AJAX_ACTION ?>', invoice_id: invoice_id, payment_amount: payment_amount, nonce: si_js_object.security },
				function( response ) {

					$button.prop( 'disabled', false );

					if ( response.success ) {
						$button.hide();
						$('#sa_checks_amount').val( payment_amount );
					}
					else {
						$button.after('<span class="inline_message inline_error_message">' + response.data.message + '</span>');
					};

					// redirect
					if ( response.data.redirect ) {
						window.location.href = response.data.redirect_url;
					}
					else {
						$('.spinner').hide();
						$( '#si_pp_payment_amount' ).fadeOut();

						$( '.make_payment_desc' ).fadeIn();
						$( '.row.toggles' ).fadeIn();
						$( '.row.paytypes' ).show();
					}
					
				}
			);

		});

	});
	//]]>
</script>

