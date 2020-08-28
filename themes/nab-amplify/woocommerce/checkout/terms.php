<?php
/**
 * Checkout terms and conditions area.
 *
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

if ( apply_filters( 'woocommerce_checkout_show_terms', true ) && function_exists( 'wc_terms_and_conditions_checkbox_enabled' ) ) {
	do_action( 'woocommerce_checkout_before_terms_and_conditions' );

	?>
	<div class="woocommerce-terms-and-conditions-wrapper">
		<div class="checkbox-custom">
			<input type="checkbox" id="attendee_tos_agree" name="attendee_tos_agree" value="yes">
			<label for="attendee_tos_agree"><?php echo sprintf( __( '*I agree to the <a href="%s">Terms of Use and Privacy Policy</a>' ), 'javascript:void(0)' )
				?></label>
		</div>
	</div>
	<?php

	do_action( 'woocommerce_checkout_after_terms_and_conditions' );
}
