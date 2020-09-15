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

$is_bulk_order = nab_is_bulk_order();

if ( true === $is_bulk_order && is_user_logged_in() ) { ?>
	<div class="nab-bulk-purchase-checkout-info">
		To register multiple attendees at once, you'll proceed through the usual registration check out. Make sure to input the quantity of registrations you want to pay for and
		pay for your order. Once complete, you'll be guided through the process to submit the attendees you wish to register.
	</div>
<?php }

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	return;
}

$user_id    = get_current_user_id();
$event_data = array_map( function ( $a ) {
	return $a[0];
}, get_user_meta( $user_id ) );

$billing_phone = get_user_meta( $user_id, 'billing_phone', true );

$checkout_class = ( true === $is_bulk_order ) ? 'is-bulk' : '';

?>

<form name="checkout" method="post" class="checkout woocommerce-checkout <?php echo $checkout_class; ?>" action="<?php echo esc_url( wc_get_checkout_url() ); ?>"
      enctype="multipart/form-data">

	<?php if ( $checkout->get_checkout_fields() ) : ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

		<div class="col2-set" id="customer_details">
			<div class="col-1">
				<?php if ( false === $is_bulk_order ) { ?>
					<h2><?php esc_html_e( 'Event Registration', 'nab-amplify' ); ?></h2>
					<div class="nab-event-reg-wrap">
						<h3><?php esc_html_e( 'Attendee Information', 'nab-amplify' ); ?></h3>

						<p class="form-row form-row-first" id="attendee_first_name_field">
							<label for="attendee_first_name" class=""><?php esc_html_e( "First Name*" ); ?></label>
							<span class="woocommerce-input-wrapper">
							<input type="text" class="input-text" name="attendee_first_name" id="attendee_first_name" placeholder=""
							       value="<?php echo ( isset( $event_data['attendee_first_name'] ) ) ? esc_attr( $event_data['attendee_first_name'] ) : '' ?>">
						</span>
						</p>
						<p class="form-row form-row-last" id="attendee_last_name_field">
							<label for="attendee_last_name" class=""><?php esc_html_e( "Last Name*" ); ?></label>
							<span class="woocommerce-input-wrapper">
							<input type="text" class="input-text" name="attendee_last_name" id="attendee_last_name" placeholder=""
							       value="<?php echo ( isset( $event_data['attendee_last_name'] ) ) ? esc_attr( $event_data['attendee_last_name'] ) : '' ?>">
						</span>
						</p>

						<p class="form-row form-row-first" id="attendee_email_field">
							<label for="attendee_email" class=""><?php esc_html_e( "Email*" ); ?></label>
							<span class="woocommerce-input-wrapper">
							<input type="email" class="input-text" name="attendee_email" id="attendee_email" placeholder=""
							       value="<?php echo ( isset( $event_data['attendee_email'] ) ) ? esc_attr( $event_data['attendee_email'] ) : '' ?>">
						</span>
						</p>
						<p class="form-row form-row-last" id="attendee_company_field">
							<label for="attendee_company" class=""><?php esc_html_e( "Company*" ); ?></label>
							<span class="woocommerce-input-wrapper">
							<input type="text" class="input-text" name="attendee_company" id="attendee_company" placeholder=""
							       value="<?php echo ( isset( $event_data['attendee_company'] ) ) ? esc_attr( $event_data['attendee_company'] ) : '' ?>">
						</span>
						</p>

						<p class="form-row form-row-first" id="attendee_title_field">
							<label for="attendee_title" class=""><?php esc_html_e( "Title*" ); ?></label>
							<span class="woocommerce-input-wrapper">
							<input type="text" class="input-text" name="attendee_title" id="attendee_title" placeholder=""
							       value="<?php echo ( isset( $event_data['attendee_title'] ) ) ? esc_attr( $event_data['attendee_title'] ) : '' ?>">
						</span>
						</p>
						<p class="form-row form-row-last" id="attendee_affiliation_field">
							<label for="attendee_affiliation" class=""><?php esc_html_e( "Affiliation, if applicable" ); ?></label>
							<span class="woocommerce-input-wrapper">
							<input type="text" class="input-text" name="attendee_affiliation" id="attendee_affiliation" placeholder=""
							       value="<?php echo ( isset( $event_data['attendee_affiliation'] ) ) ? esc_attr( $event_data['attendee_affiliation'] ) : '' ?>">
						</span>
						</p>

						<p class="form-row form-row-first" id="attendee_city_field">
							<label for="attendee_city" class=""><?php esc_html_e( "City" ); ?></label>
							<span class="woocommerce-input-wrapper">
							<input type="text" class="input-text" name="attendee_city" id="attendee_city" placeholder=""
							       value="<?php echo ( isset( $event_data['attendee_city'] ) ) ? esc_attr( $event_data['attendee_city'] ) : '' ?>">
						</span>
						</p>


						<p class="form-row form-row-last" id="attendee_zip_field">
							<label for="attendee_zip" class=""><?php esc_html_e( "Zip Code" ); ?></label>
							<span class="woocommerce-input-wrapper">
							<input type="text" class="input-text" name="attendee_zip" id="attendee_zip" placeholder=""
							       value="<?php echo ( isset( $event_data['attendee_zip'] ) ) ? esc_attr( $event_data['attendee_zip'] ) : '' ?>">
						</span>
						</p>

						<?php
						$att_country = ( isset( $event_data['attendee_country'] ) && ! empty( $event_data['attendee_country'] ) ) ? $event_data['attendee_country'] : '';
						woocommerce_form_field( 'attendee_country', array(
							'type'     => 'country',
							'class'    => array( 'form-row-first', 'attendee-country' ),
							'label'    => __( 'Country' ),
							'required' => true,
						), $att_country );

						$att_state = ( isset( $event_data['attendee_state'] ) && ! empty( $event_data['attendee_state'] ) ) ? $event_data['attendee_state'] : '';
						$state_arg = array(
							'type'  => 'state',
							'label' => __( 'State/Province', 'woocommerce' ),
							'class' => array( 'form-row-last', 'attendee-state' ),
						);
						if ( isset( $att_country ) && ! empty( $att_country ) ) {
							$state_arg['country'] = $att_country;
						}

						woocommerce_form_field( 'attendee_state', $state_arg, $att_state );
						?>

						<p class="form-row form-row-first validate-phone" id="billing_phone_field">
							<label for="billing_phone" class=""><?php esc_html_e( "Phone" ); ?></label>
							<span class="woocommerce-input-wrapper">
							<input type="tel" class="input-text" name="billing_phone" id="billing_phone" placeholder=""
							       value="<?php echo ( isset( $billing_phone ) ) ? esc_attr( $billing_phone ) : '' ?>">
						</span>
						</p>

						<?php
						$interests = ( isset( $event_data['attendee_interest'] ) && ! empty( $event_data['attendee_interest'] ) ) ? maybe_unserialize( $event_data['attendee_interest'] ) : [];
						?>
						<h4 class="text-transform-initial"><?php esc_html_e( 'I see myself in the following community(ies):' ); ?></h4>
						<p class="form-row form-row-wide" id="attendee_interest_field">
						<div class="checkbox-custom">
							<input type="checkbox" id="interest_broadcast" name="attendee_interest[]"
							       value="Broadcast" <?php echo in_array( 'Broadcast', $interests, true ) ? 'checked' : '' ?>>
							<label for="interest_broadcast"><?php esc_html_e( 'Broadcast', 'nab-amplify' ); ?></label>
						</div>
						<div class="checkbox-custom">
							<input type="checkbox" id="interest_cine_creative" name="attendee_interest[]"
							       value="Creative/Cinema" <?php echo in_array( 'Creative/Cinema', $interests, true ) ? 'checked' : '' ?>>
							<label for="interest_cine_creative"><?php esc_html_e( 'Creative/Cinema', 'nab-amplify' ); ?></label>
						</div>
						<div class="checkbox-custom">
							<input type="checkbox" id="interest_live" name="attendee_interest[]"
							       value="Live Production" <?php echo in_array( 'Live Production', $interests, true ) ? 'checked' : '' ?>>
							<label for="interest_live"><?php esc_html_e( 'Live Production', 'nab-amplify' ); ?></label>
						</div>
						<div class="checkbox-custom">
							<input type="checkbox" id="interest_streaming" name="attendee_interest[]"
							       value="Streaming" <?php echo in_array( 'Streaming', $interests, true ) ? 'checked' : '' ?>>
							<label for="interest_streaming"><?php esc_html_e( 'Streaming', 'nab-amplify' ); ?></label>
						</div>
						<div class="checkbox-custom">
							<input type="checkbox" id="other_interest" name="other_interest"
							       value="yes" <?php echo ( isset( $event_data['other_interest'] ) && ! empty( $event_data['other_interest'] ) ) ? 'checked' : '' ?>>
							<input type="text" placeholder="Other - Please Specify" name="attendee_other_interest" class="full"
							       value="<?php echo ( isset( $event_data['other_interest'] ) && ! empty( $event_data['other_interest'] ) && isset( $event_data['attendee_other_interest'] ) & ! empty( $event_data['attendee_other_interest'] ) ) ? esc_attr( $event_data['attendee_other_interest'] ) : '' ?>">
						</div>
						</p>

						<?php
						$discover = ( isset( $event_data['attendee_discover'] ) && ! empty( $event_data['attendee_discover'] ) ) ? maybe_unserialize( $event_data['attendee_discover'] ) : [];
						?>
						<h4 class="text-transform-initial"><?php esc_html_e( 'What do you want to discover?' ); ?></h4>
						<p class="form-row form-row-wide" id="attendee_discover_field">
						<div class="checkbox-custom">
							<input type="checkbox" id="discover_trends" name="attendee_discover[]"
							       value="New Trends" <?php echo in_array( 'New Trends', $discover, true ) ? 'checked' : '' ?>><label
								for="discover_trends"><?php esc_html_e( 'New Trends', 'nab-amplify' ); ?></label>
						</div>
						<div class="checkbox-custom">
							<input type="checkbox" id="discover_tech" name="attendee_discover[]"
							       value="Latest Tech" <?php echo in_array( 'Latest Tech', $discover, true ) ? 'checked' : '' ?>><label
								for="discover_tech"><?php esc_html_e( 'Latest Tech', 'nab-amplify' ); ?></label>
						</div>
						<div class="checkbox-custom">
							<input type="checkbox" id="discover_tools" name="attendee_discover[]"
							       value="New Tools" <?php echo in_array( 'New Tools', $discover, true ) ? 'checked' : '' ?>><label
								for="discover_tools"><?php esc_html_e( 'New Tools', 'nab-amplify' ); ?></label>
						</div>
						<div class="checkbox-custom">
							<input type="checkbox" id="discover_solutions" name="attendee_discover[]"
							       value="Practical Solutions" <?php echo in_array( 'Practical Solutions', $discover, true ) ? 'checked' : '' ?>><label
								for="discover_solutions"><?php esc_html_e( 'Practical Solutions', 'nab-amplify' ); ?></label>
						</div>
						<div class="checkbox-custom">
							<input type="checkbox" id="discover_all" name="attendee_discover[]"
							       value="All of it!" <?php echo in_array( 'All of it!', $discover, true ) ? 'checked' : '' ?>><label
								for="discover_all"><?php esc_html_e( 'All of it!', 'nab-amplify' ); ?></label>
						</div>
						</p>

						<?php
						$meet = ( isset( $event_data['attendee_meet'] ) && ! empty( $event_data['attendee_meet'] ) ) ? maybe_unserialize( $event_data['attendee_meet'] ) : [];
						?>
						<h4 class="text-transform-initial"><?php esc_html_e( 'Who do you want to meet?' ); ?></h4>
						<p class="form-row form-row-wide" id="attendee_meet_field">
						<div class="checkbox-custom">
							<input type="checkbox" id="meet_others" name="attendee_meet[]"
							       value="Others in my community" <?php echo in_array( 'Others in my community', $meet, true ) ? 'checked' : '' ?>><label
								for="meet_others"><?php esc_html_e( 'Others In My Community', 'nab-amplify' ); ?></label>
						</div>
						<div class="checkbox-custom">
							<input type="checkbox" id="meet_perspective" name="attendee_meet[]"
							       value="Someone with a new perspective" <?php echo in_array( 'Someone with a new perspective', $meet, true ) ? 'checked' : '' ?>><label
								for="meet_perspective"><?php esc_html_e( 'Someone With a New Perspective', 'nab-amplify' ); ?></label>
						</div>
						<div class="checkbox-custom">
							<input type="checkbox" id="meet_partnership" name="attendee_meet[]"
							       value="My next partnership" <?php echo in_array( 'My next partnership', $meet, true ) ? 'checked' : '' ?>><label
								for="meet_partnership"><?php esc_html_e( 'My Next Partnership', 'nab-amplify' ); ?></label>
						</div>
						<div class="checkbox-custom">
							<input type="checkbox" id="meet_leaders" name="attendee_meet[]"
							       value="High profile leaders" <?php echo in_array( 'High profile leaders', $meet, true ) ? 'checked' : '' ?>><label
								for="meet_leaders"><?php esc_html_e( 'High Profile Leaders', 'nab-amplify' ); ?></label>
						</div>
						<div class="checkbox-custom">
							<input type="checkbox" id="meet_inspire" name="attendee_meet[]"
							       value="Anyone who will inspire me!" <?php echo in_array( 'Anyone who will inspire me!', $meet, true ) ? 'checked' : '' ?>><label
								for="meet_inspire"><?php esc_html_e( 'Anyone who will inspire me!', 'nab-amplify' ); ?></label>
						</div>
						</p>

					</div>
				<?php } ?>

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
