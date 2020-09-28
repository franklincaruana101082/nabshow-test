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

// testing
/*$order->update_status( "on-hold" );
$order->update_status( "completed" );*/

if( $_GET['test']) {

    $user_id = $order->get_user_id();
    $user_data['id'] = $user_id;

    $user_info = get_userdata($user_id);
    $user_data['email'] = $user_info->user_email;

    $user_meta = get_user_meta($user_id);
    $user_data['first_name'] = $user_meta['first_name'][0];
    $user_data['last_name'] = $user_meta['last_name'][0];

    $current_blog_id = get_current_blog_id();
    $blog_id = $_GET['blog_id'];
    if( empty( $blog_id ) ) {
        die('please pass blog_id paramter');
    }
    $key = 'zoom_' . $blog_id;

    // Get user meta for zoom.
    $generated_zoom_urls = maybe_unserialize( get_user_meta( $user_id, $key ) );



    echo '<pre>';
    $items = $order->get_items();

    $product_ids = array();
    foreach ( $items as $item ) {
        $product_ids[] = $item['product_id'];
        $associated_content = maybe_unserialize( get_post_meta( $item['product_id'], '_associated_content', true ) );
        print_r($item['product_id'] . ' prodid => associated_content = ');
        print_r($associated_content);

        if( $associated_content ) {
            $meeting_ids = array();
            foreach ( $associated_content as $blog_id => $ac ) {

                // Connect to new multisite
                switch_to_blog( $blog_id );

                foreach ( $ac as $current_post_id => $val ) {
                    $meeting_ids[$blog_id][$product_id . '_' .$current_post_id ] = get_post_meta( $current_post_id, 'zoom_id', true );
                }

                print_r('meeting_ids = blog=>prodct_post = zoom_id ');
                print_r($meeting_ids);
            }
        }

        wp_reset_query();
        // Quit multisite connection
        restore_current_blog();

    }


    print_r("user data = ");
    print_r($user_data);
    print_r("generated_zoom_urls => zoom_blogid = zoom_id => ['urls'] = ");
    print_r($generated_zoom_urls);
    die('diednow');
}





?>

<div class="woocommerce-order">

    <?php
    if ( $order ) :

        do_action( 'woocommerce_before_thankyou', $order->get_id() );
        ?>

        <?php if ( $order->has_status( 'failed' ) ) : ?>

        <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></p>

        <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
            <a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php esc_html_e( 'Pay', 'woocommerce' ); ?></a>
            <?php if ( is_user_logged_in() ) : ?>
                <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php esc_html_e( 'My account', 'woocommerce' ); ?></a>
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
            <p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received">You’re registered! We look forward to hosting you and other professionals from the media and entertainment industry this October.</p>
        <?php } ?>

        <p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received">If you have any questions about your registration or NAB Amplify account, contact us at <a href="mailto:register@nab.org">register@nab.org</a>.</p>

        <p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received">
            Check your inbox, you should have received the following 2 emails from <a href="mailto:register@nab.org">register@nab.org</a>:
        </p>
        <ul class="text-bolder">
            <li><strong>NAB Amplify Account Created:</strong> Your login confirmation and information on how to access and edit your account and Show(s).</li>
            <li><strong>Registration Confirmation:</strong> A copy of your invoice.</li>
        </ul>

        <p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received">
            Please check your spam filters to ensure these emails did not end up there, and if you do not receive one or both of these emails please contact <a
                    href="mailto:register@nab.org">register@nab.org</a>.
        </p>

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

    <?php endif; ?>

        <?php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>
        <?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>

    <?php else : ?>

        <p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'woocommerce' ), null ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>

    <?php endif; ?>

</div>
