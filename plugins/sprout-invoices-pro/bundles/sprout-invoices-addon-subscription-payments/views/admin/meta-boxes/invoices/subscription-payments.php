<?php if ( is_a( $recurring_payment, 'SI_Payment' ) ) :  ?>

	<?php do_action( 'recurring_payments_profile_info', $recurring_payment ) ?>

	<p>
		<?php printf( '<b>%1$s:</b> <a class="payments_link" title="%1$s" href="%2$s">#%3$s</a>', __( 'Recurring Payment', 'sprout-invoices' ), get_admin_url( '','/edit.php?post_type=sa_invoice&page=sprout-apps/invoice_payments' ), $recurring_payment->get_id() ); ?>
	</p>
	<input type="hidden" name="sa_recurring_payments_term" value="<?php echo $fields['term']['default'] ?>">
	<input type="hidden" name="sa_recurring_payments_duration" value="<?php echo $fields['duration']['default'] ?>">
	<input type="hidden" name="sa_recurring_payments_is_recurring_payment" value="1">
<?php else : ?>
	<div id="recurring_invoice_options_wrap" class="admin_fields clearfix">
		<?php sa_admin_fields( $fields, 'recurring_payments' ); ?>
	</div>
<?php endif ?>

<?php if ( ! empty( $children ) ) :  ?>
	<b><?php _e( 'Generation History', 'sprout-invoices' ) ?></b>
	<ul>
		<?php foreach ( $children as $c_invoice_id ) :  ?>
			<li><?php printf( '%s &mdash; <a href="%s">%s</a>', get_post_time( get_option( 'date_format' ) . ' @ ' . get_option( 'time_format' ), false, $c_invoice_id ), get_edit_post_link( $c_invoice_id ), get_the_title( $c_invoice_id ) ); ?></li>
		<?php endforeach ?>
	</ul>
<?php endif ?>

<hr />
<b><?php _e( 'Auto Payment Invoice', 'sprout-invoices' ) ?></b>
<p class="description"><?php printf( 'The next invoice reciept will be generated <em>%s</em>.', date_i18n( get_option( 'date_format' ), $next_timestamp ) ) ?></p>
<p>
	<div id="si_admin_field_metabox_sub_reset_gen_date" class="form-group admin_fields">
		<span class="label_wrap" style="">
			<label for="sa_metabox_sub_reset_gen_date"><?php _e( 'New Generation Date', 'sprout-invoices' ) ?></label>
		</span>
		<div class="input_wrap">
			<span class="sa-form-field sa-form-field-date">
				<input type="date" name="sa_metabox_sub_reset_gen_date" id="sa_metabox_sub_reset_gen_date" class="text-input" placeholder="<?php echo $next_time ?>" size="40" autocomplete="off">
			</span>
			<p class="description"><?php printf( 'Change the generation date for the next payment invoice from <em>%s</em>.', date_i18n( get_option( 'date_format' ), $next_timestamp ) ) ?></p>
		</div>
	</div>

	<div id="si_payment_reciept_gen" class="form-group admin_fields">
		<span class="label_wrap" style="">
			<label for="sa_metabox_sub_reset_gen_date"><?php _e( 'Manual Generation', 'sprout-invoices' ) ?></label>
		</span>
		<div class="input_wrap">
			<?php printf( '<a class="payment_reciept_gen button mute" title="%s" href="%s" style="opacity:0.5">%s</a>', __( 'Generate Missing Payment Invoice', 'sprout-invoices' ), add_query_arg( array( 'manually_create_paid_receipt' => get_the_ID() ) ), __( 'Generate Payment Invoice', 'sprout-invoices' ) ); ?>
			<p class="description"><?php _e( 'This will create a invoice payment receipt and should only be used if the automated generation recently failed.', 'sprout-invoices' ) ?></p>
		</div>
	</div>
</p>
