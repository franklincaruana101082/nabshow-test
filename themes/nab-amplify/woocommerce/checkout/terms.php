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

	// @todo later user wpcom_vip_get_page_by_path()
	$privacy_policy     = get_page_by_path( NAB_PRIVACY_POLICY_PAGE );
	$privacy_policy_url = isset( $privacy_policy ) ? get_permalink( $privacy_policy->ID ) : '#';

	$terms_of_use     = get_page_by_path( NAB_TERMS_OF_USE_PAGE );
	$terms_of_use_url = isset( $terms_of_use ) ? get_permalink( $terms_of_use->ID ) : '#';

	$code_of_conduct     = get_page_by_path( NAB_CODE_OF_CONDUCT_PAGE );
	$code_of_conduct_url = isset( $code_of_conduct ) ? get_permalink( $code_of_conduct->ID ) : '#';
	?>
	<div class="woocommerce-terms-and-conditions-wrapper">

		<div class="nab_event_opt_in">
			<label for="attendee_partner_opt_in_field"><?php esc_html_e( 'Opt in for Partner Communications*', 'nab-amplify' ); ?></label>
			<select name="attendee_partner_opt_in" id="attendee_partner_opt_in_field" class="woocommerce-select">
				<option value="">---</option>
				<option value="yes"><?php esc_html_e( 'Yes', 'nab-amplify' ); ?></option>
				<option value="no"><?php esc_html_e( 'No', 'nab-amplify' ); ?></option>
			</select>
		</div>

		<div class="nab_event_opt_in">
			<label for="attendee_exhibition_sponsors_opt_in_field"><?php esc_html_e( 'Opt in for Exhibitor/Sponsor Communications*', 'nab-amplify' ); ?></label>
			<select name="attendee_exhibition_sponsors_opt_in" id="attendee_exhibition_sponsors_opt_in_field" class="woocommerce-select">
				<option value="">---</option>
				<option value="yes"><?php esc_html_e( 'Yes', 'nab-amplify' ); ?></option>
				<option value="no"><?php esc_html_e( 'No', 'nab-amplify' ); ?></option>
			</select>
		</div>

		<div class="checkbox-custom">
			<input type="checkbox" id="attendee_tos_agree" name="attendee_tos_agree" value="yes">
			<label for="attendee_tos_agree"><?php echo sprintf( __( '*I agree to the <a href="%1s">Code of Conduct</a>, <a href="%2s">Terms of Use</a> and <a href="%3s">Privacy Policy</a>.' ),
					$code_of_conduct_url, $terms_of_use_url, $privacy_policy_url )
				?></label>
		</div>
	</div>
	<?php

	do_action( 'woocommerce_checkout_after_terms_and_conditions' );
}
