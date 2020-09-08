<?php
/**
 * Bulk quantity on cart
 */
$is_bulk_val = '';
$nab_qty     = '';

$is_bulk = nab_is_bulk_order();
if ( isset( $is_bulk ) && ! empty( $is_bulk ) ) {
	$is_bulk_val = 'yes';
}
$get_qty = nab_bulk_order_quantity();

if ( isset( $get_qty ) && ! empty( $get_qty ) ) {
	$nab_qty = $get_qty;
}

?>

<div class="nab-bulk-quantity-wrapper">
	<div class="nab_bulk_head">
		<h2></h2>
	</div>
	<div class="nab_bulk_body">
		<div class="nab_bulk_passes">
			<label for="nab_is_bulk"><?php esc_html_e( 'Do you want to purchase passes in bulk?', 'nab-amplify' ); ?></label>
			<div class="nab_bulk_select">
				<select id="nab_is_bulk">
					<option value=""><?php esc_html_e( 'Select Option', 'nab-amplify' ); ?></option>
					<option value="yes" <?php selected( 'yes', $is_bulk_val ); ?>><?php esc_html_e( 'Yes', 'nab-amplify' ); ?></option>
					<option value="no" <?php selected( 'no', $is_bulk_val ); ?>><?php esc_html_e( 'No', 'nab-amplify' ); ?></option>
				</select>
			</div>
		</div>
		<div class="nab-quantity-selector" style="display: ">
			<label for="nab_bulk_quantity" class="">Select Quantity to purchase</label>
			<div class="nab_bulk_select">
				<select id="nab_bulk_quantity">
					<option value=""><?php esc_html_e( 'Select Option', 'nab-amplify' ); ?></option>
					<?php
					for ( $i = 1; $i <= 50; $i ++ ) { ?>
						<option value="<?php echo esc_attr( $i ); ?>" <?php selected( $i, $nab_qty ); ?>><?php echo $i; ?></option>
					<?php } ?>
				</select>
			</div>
		</div>
	</div>
</div>