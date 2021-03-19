<script type="text/javascript">
	//<![CDATA[
	jQuery(document).ready( function($) {

		$('.primary_button.payment_option').trigger('click');

	});
	//]]>
</script>

<p class="sa-message info"><?php printf( __( 'Your payment amount has been set to %s', 'sprout-invoices' ), sa_get_formatted_money( si_get_invoice_deposit() ) ) ?></p>
