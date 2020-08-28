<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) ) . '<br><br>';

	return;
}

?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

	<?php if ( $checkout->get_checkout_fields() ) : ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

		<div class="col2-set" id="customer_details">
			<div class="col-1">

				<h2><?php esc_html_e( 'Event Registration', 'nab-amplify' ); ?></h2>
				<div class="nab-event-reg-wrap">
					<h3><?php esc_html_e( 'Attendee Information', 'nab-amplify' ); ?></h3>

					<p class="form-row form-row-first" id="attendee_first_name_field">
						<label for="attendee_first_name" class=""><?php esc_html_e( "First name*" ); ?></label>
						<span class="woocommerce-input-wrapper">
							<input type="text" class="input-text" name="attendee_first_name" id="attendee_first_name" placeholder="" value="">
						</span>
					</p>
					<p class="form-row form-row-last" id="attendee_last_name_field">
						<label for="attendee_last_name" class=""><?php esc_html_e( "Last name*" ); ?></label>
						<span class="woocommerce-input-wrapper">
							<input type="text" class="input-text" name="attendee_last_name" id="attendee_last_name" placeholder="" value="">
						</span>
					</p>

					<p class="form-row form-row-first" id="attendee_email_field">
						<label for="attendee_email" class=""><?php esc_html_e( "Email*" ); ?></label>
						<span class="woocommerce-input-wrapper">
							<input type="email" class="input-text" name="attendee_email" id="attendee_email" placeholder="" value="">
						</span>
					</p>
					<p class="form-row form-row-last" id="attendee_company_field">
						<label for="attendee_company" class=""><?php esc_html_e( "Company*" ); ?></label>
						<span class="woocommerce-input-wrapper">
							<input type="text" class="input-text" name="attendee_company" id="attendee_company" placeholder="" value="">
						</span>
					</p>

					<p class="form-row form-row-first" id="attendee_title_field">
						<label for="attendee_title" class=""><?php esc_html_e( "Title*" ); ?></label>
						<span class="woocommerce-input-wrapper">
							<input type="text" class="input-text" name="attendee_title" id="attendee_title" placeholder="" value="">
						</span>
					</p>
					<?php
					woocommerce_form_field( 'attendee_country', array(
							'type'     => 'country',
							'class'    => array( 'form-row-last', 'attendee-country' ),
							'label'    => __( 'Country' ),
							'required' => true,
						)
					);
					?>

					<p class="form-row form-row-first" id="attendee_city_field">
						<label for="attendee_city" class=""><?php esc_html_e( "City" ); ?></label>
						<span class="woocommerce-input-wrapper">
							<input type="text" class="input-text" name="attendee_city" id="attendee_city" placeholder="" value="">
						</span>
					</p>
					<?php
					woocommerce_form_field( 'attendee_state', array(
							'type'  => 'state',
							'label' => __( 'State/Province', 'woocommerce' ),
							'class' => array( 'form-row-last', 'attendee-state' ),
						)
					);
					?>

					<p class="form-row form-row-first" id="attendee_zip_field">
						<label for="attendee_zip" class=""><?php esc_html_e( "Zip Code" ); ?></label>
						<span class="woocommerce-input-wrapper">
							<input type="text" class="input-text" name="attendee_zip" id="attendee_zip" placeholder="" value="">
						</span>
					</p>
					<p class="form-row form-row-last" id="attendee_affiliation_field">
						<label for="attendee_affiliation" class=""><?php esc_html_e( "Affiliation" ); ?></label>
						<select name="attendee_affiliation" id="attendee_affiliation" class="woocommerce-select">
							<option><?php esc_html_e( 'Select Affiliation', 'nab-amplify' ); ?></option>
							<option value="option_1"><?php esc_html_e( 'Option 1', 'nab-amplify' ); ?></option>
							<option value="option_2"><?php esc_html_e( 'Option 2', 'nab-amplify' ); ?></option>
						</select>
					</p>

					<h4><?php esc_html_e( 'Choose Applicable Area(s) of Interest' ); ?></h4>
					<p class="form-row form-row-wide" id="attendee_interest_field">
						<div class="checkbox-custom">
							<input type="checkbox" id="interest_cine_creative" name="attendee_interest[]" value="Cine/Creative"><label
								for="interest_cine_creative"><?php esc_html_e( 'Cine/Creative', 'nab-amplify' ); ?></label>
						</div>
						<div class="checkbox-custom">
							<input type="checkbox" id="interest_streaming" name="attendee_interest[]" value="Streaming"><label
								for="interest_streaming"><?php esc_html_e( 'Streaming', 'nab-amplify' ); ?></label>
						</div>
						<div class="checkbox-custom">
							<input type="checkbox" id="interest_live" name="attendee_interest[]" value="Live"><label
								for="interest_live"><?php esc_html_e( 'Live', 'nab-amplify' ); ?></label>
						</div>
						<div class="checkbox-custom">
							<input type="checkbox" id="interest_broadcast" name="attendee_interest[]" value="Broadcast"><label
								for="interest_broadcast"><?php esc_html_e( 'Broadcast', 'nab-amplify' ); ?></label>
						</div>
						<div class="checkbox-custom">
							<input type="checkbox" id="other_interest" name="other_interest" value="other_interest">
							<input type="text" placeholder="Other - please specify" value="" name="attendee_other_interest" class="full">
						</div>
					</p>

					<p class="form-row form-row-wide" id="nab_event_optin">
						<div class="checkbox-custom">
							<input type="checkbox" id="partner_comm_field" name="attendee_partner_communication" value="yes" checked>
							<label for="partner_comm_field"><?php esc_html_e( 'Opt in for Partner Communications', 'nab-amplify' ); ?></label>
						</div>
						<div class="checkbox-custom">
							<input type="checkbox" id="exhibitor_comm_field" name="attendee_exhibitor_communication" value="yes" checked>
							<label for="exhibitor_comm_field"><?php esc_html_e( 'Opt in for Exhibitor Communications', 'nab-amplify' ); ?></label>
						</div>
						<div class="checkbox-custom">
							<input type="checkbox" id="sponsor_comm_field" name="attendee_sponsor_communication" value="yes" checked>
							<label for="sponsor_comm_field"><?php esc_html_e( 'Opt in for Sponsor Communications', 'nab-amplify' ); ?></label>
						</div>
					</p>

				</div>

				<?php do_action( 'woocommerce_checkout_billing' ); ?>
			</div>

			<div class="col-2">
				<?php do_action( 'woocommerce_checkout_shipping' ); ?>
			</div>
		</div>

		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

	<?php endif; ?>

	<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>

	<h3 id="order_review_heading"><?php esc_html_e( 'Your order', 'woocommerce' ); ?></h3>

	<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

	<div id="order_review" class="woocommerce-checkout-review-order">
		<?php do_action( 'woocommerce_checkout_order_review' ); ?>
	</div>

	<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
