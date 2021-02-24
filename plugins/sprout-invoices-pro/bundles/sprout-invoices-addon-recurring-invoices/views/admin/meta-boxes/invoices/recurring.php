<div id="recurring_invoice_options_wrap" class="admin_fields clearfix">
	<?php sa_admin_fields( $fields, 'recurring_invoice' ); ?>
</div>


<?php if ( ! empty( $children ) ) :  ?>
	<b><?php _e( 'Generation History', 'sprout-invoices' ) ?></b>
	<ul>
		<?php foreach ( $children as $c_invoice_id ) :  ?>
			<li><?php printf( '%s &mdash; <a href="%s">%s</a>', get_post_time( get_option( 'date_format' ) . ' @ ' . get_option( 'time_format' ), false, $c_invoice_id ), get_edit_post_link( $c_invoice_id ), get_the_title( $c_invoice_id ) ); ?></li>
		<?php endforeach ?>
	</ul>
<?php elseif ( strtotime( $next_time ) > current_time( 'timestamp' ) ) : ?>
	<b><?php _e( 'Generation History', 'sprout-invoices' ) ?></b>
	<p><?php printf( 'The first invoice will be generated on <em>%s</em>.', date_i18n( get_option( 'date_format' ), strtotime( $next_time ) ) ) ?></p>
<?php endif ?>
<br/>
<p class="description">
	<?php printf( '<a class="recurring_invoice_gen button mute" title="%s" href="%s" style="opacity:0.5">%s</a>', __( 'Generate Missing Invoice', 'sprout-invoices' ), add_query_arg( array( 'manually_create_recurring_invoice' => get_the_ID() ) ), __( 'Generate Invoice', 'sprout-invoices' ) ); ?>
	<?php _e( 'This will manually create an invoice with the next scheduled date, and should only be used if the automated generation recently failed.', 'sprout-invoices' ) ?>
</p>
