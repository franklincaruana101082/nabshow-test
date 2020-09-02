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

		<div class="nab_event_opt_in">
			<label for="attendee_partner_opt_in_field"><?php esc_html_e( 'Opt in for Partner Communications*', 'nab-amplify' ); ?></label>
			<select name="attendee_partner_opt_in" id="attendee_partner_opt_in_field" class="woocommerce-select">
				<option value="yes"><?php esc_html_e( 'Yes', 'nab-amplify' ); ?></option>
				<option value="no"><?php esc_html_e( 'No', 'nab-amplify' ); ?></option>
			</select>
		</div>

		<div class="nab_event_opt_in">
			<label for="attendee_exhibition_sponsors_opt_in_field"><?php esc_html_e( 'Opt in for Exhibitors/Sponsors Communications*', 'nab-amplify' ); ?></label>
			<select name="attendee_exhibition_sponsors_opt_in" id="attendee_exhibition_sponsors_opt_in_field" class="woocommerce-select">
				<option value="yes"><?php esc_html_e( 'Yes', 'nab-amplify' ); ?></option>
				<option value="no"><?php esc_html_e( 'No', 'nab-amplify' ); ?></option>
			</select>
		</div>

		<div class="checkbox-custom">
			<input type="checkbox" id="attendee_tos_agree" name="attendee_tos_agree" value="yes">
			<label for="attendee_tos_agree"><?php echo sprintf( __( '*I agree to the <a href="%s">Terms of Use and Privacy Policy</a>' ), 'javascript:void(0)' )
				?></label>
		</div>
	</div>
	<?php

	do_action( 'woocommerce_checkout_after_terms_and_conditions' );
}
