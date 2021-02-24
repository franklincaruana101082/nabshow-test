<?php do_action( 'si_payment_terms_metabox_start', $doc_id ) ?>
<div id="payment_terms" data-doc-id="<?php echo (int) $doc_id ?>">
	<table class="table sa_table sa_table-hover">
		<thead>
			<tr>
				<th class="real_skinny_col">&nbsp;</th>
				<th class="skinny_col"><?php esc_html_e( 'Due In', 'sprout-invoices' ) ?></th>
				<th class="skinny_col"><?php esc_html_e( 'Payment Due', 'sprout-invoices' ) ?></th>
				<th class="skinny_col"><?php esc_html_e( 'Fee', 'sprout-invoices' ) ?></th>
				<th><?php esc_html_e( 'Description', 'sprout-invoices' ) ?></th>
			</tr>
		</thead>
		<tbody>
			<?php
			// no tallys because of percentages.
			if ( ! empty( $sorted_payment_terms ) ) :

				foreach ( $sorted_payment_terms as $data ) :

					if ( ! isset( $data['fee'] ) ) {
						continue;
					}

					$payment_term_id = $data['term_id'];
					$doc_id = get_the_id();
					?>
						<tr id="<?php echo (int) $payment_term_id ?>">
							
							<td><span class="payment_term_entry_deletion item_action item_delete" data-id="<?php echo esc_attr( $payment_term_id ); ?>" data-doc-id="<?php echo esc_attr( $doc_id ); ?>" data-nonce="<?php echo wp_create_nonce( SI_Controller::NONCE ) ?>"></span></td>
							
							<td><span class="payment_term_due_in"><?php printf( '%s days', si_get_number_format( $data['duein'], 0 ) ) ?></td>
							
							<td><span class="payment_term_payment_due"><?php printf( '%s', sa_get_formatted_money( (float) $data['balance'], $doc_id ) ) ?></span></td>

							<?php if ( isset( $data['percentage'] ) && 'true' == $data['percentage'] ) :  ?>
								<td><?php printf( '%s%%', si_get_number_format( (float) $data['fee'] ) ) ?></td>
							<?php else : ?>
								<td><?php printf( '%s', sa_get_formatted_money( (float) $data['fee'], $doc_id ) ) ?></td>
							<?php endif ?>

							<td><?php echo apply_filters( 'si_payment_term_description', $data['title'], $data ) ?></td>
						</tr>
				<?php endforeach ?>
			<?php else : ?>
				<tr><td colspan="7"><?php _e( 'No payment terms for this document.', 'sprout-invoices' ) ?></td></tr>
			<?php endif ?>
		</tbody>		
	</table>
</div><!-- #payment_terms -->
<?php do_action( 'si_payment_terms_metabox_end', $doc_id ) ?>
