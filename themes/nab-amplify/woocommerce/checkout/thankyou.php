<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="woocommerce-order">

	<?php
	if ( $order ) :

		do_action( 'woocommerce_before_thankyou', $order->get_id() );
		?>

		<?php if ( $order->has_status( 'failed' ) ) : ?>

		<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></p>

		<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
			<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="btn pay"><?php esc_html_e( 'Pay', 'woocommerce' ); ?></a>
			<?php if ( is_user_logged_in() ) : ?>
				<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="btn pay"><?php esc_html_e( 'My account', 'woocommerce' ); ?></a>
			<?php endif; ?>
		</p>

	<?php else :

		$order_id = $order->get_order_number();
		$is_bulk_order = get_post_meta( $order_id, '_nab_bulk_order', true );
		$bulk_order_qty = get_post_meta( $order_id, '_nab_bulk_qty', true );

		if ( isset( $is_bulk_order ) && 'yes' === $is_bulk_order && isset( $bulk_order_qty ) && ! empty( $bulk_order_qty ) ) { ?>
			<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received">Thank you for your order! In order to register your group, please follow these 4 simple steps:</p>
			<ol>
				<li>Go into your profile’s <a href="<?php echo esc_url( wc_get_account_endpoint_url('orders') ); ?>">Order History</a> and click "Add Attendees".</li>
				<li>Download the file called "Attendee Template".</li>
				<li>Add attendee information in the spreadsheet under the appropriate columns.</li>
				<li>Upload the file under <a href="<?php echo esc_url( wc_get_account_endpoint_url('orders') ); ?>">Order History</a> "Add Attendees".</li>
			</ol>

			<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received">If you need to make changes to your list of attendees after uploading, please contact <a href="mailto:register@nab.org">register@nab.org</a></p>

		<?php } else { ?>
			<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received">You’re all set! Access to the online 75th annual Broadcast Engineering & IT (BEIT) Conference VOD presentations is now available <a href="https://amplify.nabshow.com/beit-online-2021/">here</a>. A link to the BEIT Conference Proceedings pdf will be emailed to you shortly. </p>
		<?php } ?>

		<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received">To view and/or add items to your registration or make changes to your NAB Amplify account, simply Log In. Have questions? Contact us at <a href="mailto:support@nabamplify.zendesk.com">support@nabamplify.zendesk.com</a>.</p>

		<!--<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received">
			Check your inbox, you should have received the following 2 emails from <a href="mailto:register@nab.org">register@nab.org</a>:
		</p>
		<ul class="text-bolder">
			<li><strong>NAB Amplify Account Created:</strong> Your login confirmation and information on how to access and edit your account and Show(s).</li>
			<li><strong>Registration Confirmation:</strong> A copy of your invoice.</li>
		</ul>

		<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received">
			Please check your spam filters to ensure these emails did not end up there, and if you do not receive one or both of these emails please contact <a
				href="mailto:register@nab.org">register@nab.org</a>.<br /><br />-->



		<ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">

			<li class="woocommerce-order-overview__order order">
				<?php esc_html_e( 'Order number:', 'woocommerce' ); ?>
				<strong><?php echo $order->get_order_number(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					?></strong>
			</li>

			<li class="woocommerce-order-overview__date date">
				<?php esc_html_e( 'Date:', 'woocommerce' ); ?>
				<strong><?php echo wc_format_datetime( $order->get_date_created() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					?></strong>
			</li>

			<?php if ( is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email() ) : ?>
				<li class="woocommerce-order-overview__email email">
					<?php esc_html_e( 'Email:', 'woocommerce' ); ?>
					<strong><?php echo $order->get_billing_email(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
				</li>
			<?php endif; ?>

			<li class="woocommerce-order-overview__total total">
				<?php esc_html_e( 'Total:', 'woocommerce' ); ?>
				<strong><?php echo $order->get_formatted_order_total(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					?></strong>
			</li>

			<?php if ( $order->get_payment_method_title() ) : ?>
				<li class="woocommerce-order-overview__payment-method method">
					<?php esc_html_e( 'Payment method:', 'woocommerce' ); ?>
					<strong><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></strong>
				</li>
			<?php endif; ?>

		</ul>

		<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received">	<span style="font-size:20px;"><b>How to Access Virtual Event Content</b></span><br />
			The account you created as a part of the registration process will be the same account that gives you access to the online content. To view which events you have access to and the passes you purchased please visit <a href="https://amplify.nabshow.com/my-account/my-purchases/">My Purchases</a>. To attend the digital event, simply click on the logos to access and browse to the sessions you wish to attend. Those videos available as VODs will be immediately availalbe. If a session is set to start at a specific time, beginning at the session start time, you will see a video or zoom link at the top of the page. For additional assistance regarding attending virtual or hybrid events, please <a href="https://amplify.nabshow.com/faqs/">view the FAQs</a>.<br />

	</p>

	<?php endif; ?>

		<?php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>
		<?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>

	<?php else : ?>

		<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'woocommerce' ), null ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>

	<?php endif; ?>



</div>
