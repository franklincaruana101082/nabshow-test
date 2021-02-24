<section class="row invoice" id="items">
	<div class="inner">
		
		<div class="row items">

			<?php do_action( 'si_document_line_items' ) ?>
			<?php foreach ( $line_items as $position => $item_data ) : ?>

				<?php if ( is_int( $position ) ) : // is not a child ?>

					<?php
						$children = si_line_item_get_children( $position, $line_items );
						$has_children = ( ! empty( $children ) ) ? true : false ;
						$prev_type = ( isset( $item_type ) && '' !== $item_type ) ? $item_type : '' ;
						$item_type = ( isset( $item_data['type'] ) && '' !== $item_data['type'] ) ? $item_data['type'] : SI_Line_Items::get_default_type(); ?>

					<?php do_action( 'si_get_front_end_line_item_pre_row', $item_data, $position, $item_type, $has_children ) ?>

					<div class="item item_type_<?php echo esc_attr( $item_type ) ?> <?php if ( $has_children ) { echo esc_attr( 'line_item_has_children' ); } ?>" data-id="<?php echo (float) $position ?>">

						<?php si_front_end_line_item_columns( $item_data, $position, $prev_type, $has_children ) ?>
					</div>
					
					<?php if ( $has_children ) : ?>

							<?php foreach ( $children as $child_position => $item_data ) : ?>

								<?php do_action( 'si_get_front_end_line_item_pre_row', $item_data, $position, $prev_type,false ) ?>

								<div class="item sub_item item_type_<?php echo esc_attr( $item_type ) ?>" data-id="<?php echo (float) $child_position ?>">
									
									<?php si_front_end_line_item_columns( $line_items[ $child_position ], $child_position, $prev_type, false ) ?>

								</div>
								
								<?php $prev_type = $item_type; ?>

								<?php do_action( 'si_get_front_end_line_item_post_row', $item_data, $position, $prev_type, false ) ?>

							<?php endforeach ?>

					<?php endif ?>

					<?php $prev_type = $item_type; ?>

					<?php do_action( 'si_get_front_end_line_item_post_row', $item_data, $position, $prev_type, $has_children ) ?>

				<?php endif ?>

			<?php endforeach ?>

		</div>

	</div>
</section>

<section class="row invoice" id="totals">
	<div class="inner">
		
		<div class="row title">

			<?php if ( 'write-off' === si_get_invoice_status() ) : ?>
				<h2><?php esc_html_e( 'Total Voided', 'sprout-invoices' ) ?></h2>
			<?php elseif ( ! si_get_invoice_balance() ) : ?>
				<h2><?php esc_html_e( 'Total Paid', 'sprout-invoices' ) ?></h2>
			<?php elseif ( 'temp' === si_get_invoice_status() ) : ?>
				<h2><?php esc_html_e( 'Not Yet Published', 'sprout-invoices' ) ?></h2>
			<?php else : ?>
				<h2><?php esc_html_e( 'Total Owed', 'sprout-invoices' ) ?></h2>
			<?php endif; ?>

		</div>

		<ul class="row items">

			<?php foreach ( $totals as $slug => $items_total ) : ?>

				<?php if ( isset( $items_total['hide'] ) && $items_total['hide'] ) : ?>
					<?php continue; ?>
				<?php endif ?>


				<li id="line_<?php echo esc_attr( $slug ) ?>" class="row item">
						
					<?php if ( isset( $items_total['helptip'] ) ) : ?>
						<h3 title="<?php echo esc_attr( $items_total['helptip'] ) ?>" class="helptip"><?php echo $items_total['label'] ?></h3>
					<?php else : ?>
						<h3><?php echo $items_total['label'] ?></h3>
					<?php endif ?>

					<span class="total"><?php echo $items_total['formatted'] ?></span>

				</li>

			<?php endforeach ?>

		</ul>
	</div>
</section>
