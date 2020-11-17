<?php
/**
 * Orders
 *
 * Shows orders on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/orders.php.
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

do_action( 'woocommerce_before_account_orders', $has_orders ); ?>

<?php if ( $has_orders ) : ?>

	<table class="woocommerce-orders-table woocommerce-MyAccount-orders shop_table shop_table_responsive my_account_orders account-orders-table">
		<thead>
		<tr>
			<?php foreach ( wc_get_account_orders_columns() as $column_id => $column_name ) :
				if ( 'order-date' === $column_id || 'order-total' === $column_id ) {
					if ( isset( $_GET['order'] ) && ! empty( $_GET['order'] ) && isset( $_GET['orderby'] ) && $_GET['orderby'] === $column_id ) {
						$sort_order = ( 'asc' === $_GET['order'] ) ? 'desc' : 'asc';
					} else {
						$sort_order = 'asc';
					}
					$sort_url = add_query_arg( array( 'orderby' => $column_id, 'order' => $sort_order ) );
					?>
					<th class="woocommerce-orders-table__header woocommerce-orders-table__header-<?php echo esc_attr( $column_id ); ?>"><a
							href="<?php echo esc_url( $sort_url ); ?>"><span class="nobr"><?php echo esc_html( $column_name ); ?></span></a></th>
				<?php } else { ?>
					<th class="woocommerce-orders-table__header woocommerce-orders-table__header-<?php echo esc_attr( $column_id ); ?>"><span
							class="nobr"><?php echo esc_html( $column_name ); ?></span></th>
				<?php } ?>
			<?php endforeach; ?>
		</tr>
		</thead>

		<tbody>
		<?php
		foreach ( $customer_orders->orders as $customer_order ) {
			$order      = wc_get_order( $customer_order ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
			$item_count = $order->get_item_count() - $order->get_item_count_refunded();
			?>
			<tr class="woocommerce-orders-table__row woocommerce-orders-table__row--status-<?php echo esc_attr( $order->get_status() ); ?> order">
				<?php foreach ( wc_get_account_orders_columns() as $column_id => $column_name ) : ?>
					<td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-<?php echo esc_attr( $column_id ); ?>"
					    data-title="<?php echo esc_attr( $column_name ); ?>">
						<?php if ( has_action( 'woocommerce_my_account_my_orders_column_' . $column_id ) ) : ?>
							<?php do_action( 'woocommerce_my_account_my_orders_column_' . $column_id, $order ); ?>

						<?php elseif ( 'order-number' === $column_id ) : ?>
							<a href="<?php echo esc_url( $order->get_view_order_url() ); ?>">
								<?php echo esc_html( _x( '#', 'hash before order number', 'woocommerce' ) . $order->get_order_number() ); ?>
							</a>

						<?php elseif ( 'order-date' === $column_id ) : ?>
							<time datetime="<?php echo esc_attr( $order->get_date_created()
							                                           ->date( 'c' ) ); ?>"><?php echo esc_html( wc_format_datetime( $order->get_date_created() ) ); ?></time>

						<?php elseif ( 'order-status' === $column_id ) : ?>
							<?php echo esc_html( wc_get_order_status_name( $order->get_status() ) ); ?>

						<?php elseif ( 'order-total' === $column_id ) : ?>
							<?php
							/* translators: 1: formatted order total 2: total order items */
							echo wp_kses_post( sprintf( _n( '%1$s for %2$s item', '%1$s for %2$s items', $item_count, 'woocommerce' ), $order->get_formatted_order_total(), $item_count ) );
							?>

						<?php elseif ( 'order-actions' === $column_id ) : ?>
							<?php
							$actions = wc_get_account_orders_actions( $order );

							if ( ! empty( $actions ) ) {
								foreach ( $actions as $key => $action ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
									echo '<a href="' . esc_url( $action['url'] ) . '" class="woocommerce-button button ' . sanitize_html_class( $key ) . '">' . esc_html( $action['name'] ) . '</a>';
								}
							}
							$order_id      = $order->get_order_number();
							$is_bulk_order = get_post_meta( $order_id, '_nab_bulk_order', true );
							if ( isset( $is_bulk_order ) && 'yes' === $is_bulk_order && 'completed' === $order->get_status() && false === nab_is_all_attendee_added( $order_id ) ) {
								$bulk_qty = get_post_meta( $order_id, '_nab_bulk_qty', true ); ?>
								<a href="javascript:void(0)" class="nab-add-attendee woocommerce-button button" data-qty="<?php echo esc_attr( $bulk_qty ); ?>"
								   data-orderid="<?php echo esc_attr( $order_id ); ?>"><?php echo esc_html_e( 'Add Attendees', 'nab-amplify' ); ?></a>
							<?php }
							if ( isset( $is_bulk_order ) && 'yes' === $is_bulk_order && 'completed' === $order->get_status() && 0 < nab_get_attendee_count( $order_id ) ) {
								$bulk_qty = get_post_meta( $order_id, '_nab_bulk_qty', true ); ?>
								<a href="javascript:void(0)" class="nab-view-attendee woocommerce-button button"
								   data-orderid="<?php echo esc_attr( $order_id ); ?>"><?php echo esc_html_e( 'View Attendees', 'nab-amplify' ); ?></a>
							<?php }
							?>
						<?php endif; ?>
					</td>
				<?php endforeach; ?>
			</tr>
			<?php
		}
		?>
		</tbody>
	</table>

	<?php do_action( 'woocommerce_before_account_orders_pagination' ); ?>

	<?php if ( 1 < $customer_orders->max_num_pages ) : ?>
		<div class="woocommerce-pagination woocommerce-pagination--without-numbers woocommerce-Pagination">
			<?php if ( 1 !== $current_page ) : ?>
				<a class="woocommerce-button woocommerce-button--previous woocommerce-Button woocommerce-Button--previous button"
				   href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page - 1 ) ); ?>"><?php esc_html_e( 'Previous', 'woocommerce' ); ?></a>
			<?php endif; ?>

			<?php if ( intval( $customer_orders->max_num_pages ) !== $current_page ) : ?>
				<a class="woocommerce-button woocommerce-button--next woocommerce-Button woocommerce-Button--next button"
				   href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page + 1 ) ); ?>"><?php esc_html_e( 'Next', 'woocommerce' ); ?></a>
			<?php endif; ?>
		</div>
	<?php endif; ?>

<?php else : ?>
	<div class="woocommerce-message woocommerce-message--info woocommerce-Message woocommerce-Message--info woocommerce-info">
		<a class="woocommerce-Button button" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
			<?php esc_html_e( 'Browse products', 'woocommerce' ); ?>
		</a>
		<?php esc_html_e( 'No order has been made yet.', 'woocommerce' ); ?>
	</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_account_orders', $has_orders ); ?>

<div id="nabAddAttendeeModal" class="nab-modal">
	<div class="nab-modal-inner">
		<div class="modal-content">
			<span class="nab-modal-close fa fa-times"></span>
			<div class="modal-content-wrap">
				<div class="attendee-bulk-upload-form-wrap">
					<div class="attendee-bulk-upload-form-cnt">
						<div class="attendee-upload-message" style="display: none"></div>
						<span class="file-title">File Upload</span>
						<form class="attendee-bulk-upload-form">
							<div class="nab-attendee-upload-wrp">
								<span class="input-placeholder">Upload File...</span>
								<input type="file" id="bulk_upload_file" name="bulk_upload_file">
								<input type="hidden" id="attendeeOrderID" name="order_id" value="">
								<input type="hidden" id="attendeeOrderQty" name="order_qty" value="">
								<button type="button" class="attendee-browse-btn" id="browse_files">Browse</button>
							</div>
							<button type="button" class="attendee-import-btn" id="bulk_upload" name="bulk_upload">Upload</button>
						</form>
						<span class="nab-download-sample-data">In order to register your group, please upload the list of attendees via <a href="<?php echo get_template_directory_uri() . '/assets/Attendee Template.xlsx'; ?>" download>this template.</a></span>
						<span class="nab-download-sample-data">
						Need more assistance? <a href="<?php echo get_template_directory_uri() . '/assets/Attendee-Sample-File.xlsx'; ?>" download>Download a sample attendee file</a> or exit this popup and click "help" in the bottom right corner.</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="nabViewAttendeeModal" class="nab-modal">
	<div class="nab-modal-inner">
		<div class="modal-content">
			<span class="nab-modal-close fa fa-times"></span>
			<div class="modal-content-wrap">
				<div class="attendee-view-wrap">
					<div class="attendee-view-table-wrp">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="nabeditAttendeeModal" class="nab-modal">
	<div class="nab-modal-inner">
		<div class="modal-content">
			<span class="nab-modal-close fa fa-times"></span>
			<div class="modal-content-wrap">
				<div class="attendee-edit-wrap">
					<h3>Edit Attendee Details</h3>
					<table>
						<tr>
							<td>First Name:</td>
							<td><input type="text" class="attendee_first_name"></td>
						</tr>
						<tr>
							<td>Last Name:</td>
							<td><input type="text" class="attendee_last_name"></td>
						</tr>
						<tr>
							<td>Email:</td>
							<td><input type="text" class="attendee_email"></td>
						</tr>
						<tr>
							<td></td>
							<td>
								<div class="edit-att-buttons">
									<a href="javascript:void(0)" class="button btn-save">Save</a>
									<a href="javascript:void(0)" class="button btn-cancle">Cancel</a>
								</div>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
