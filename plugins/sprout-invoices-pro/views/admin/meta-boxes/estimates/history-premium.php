<dl id="history_list">

	<dt>
		<span class="history_status creation_event"><?php _e( 'Created', 'sprout-invoices' ) ?></span><br/>
		<span class="history_date"><?php echo date_i18n( get_option( 'date_format' ).' @ '.get_option( 'time_format' ), strtotime( $post->post_date ), true ) ?></span>
	</dt>

	<dd><p>
		<?php if ( ! empty( $submission_fields ) ) :  ?>
			<?php if ( $estimate->get_client_id() ) :  ?>
				<?php printf( __( 'Submitted by <a href="%s">%s</a>', 'sprout-invoices' ), get_edit_post_link( $estimate->get_client_id() ), get_the_title( $estimate->get_client_id() ) ) ?>
			<?php else : ?>
				<?php _e( 'Submitted', 'sprout-invoices' ) ?>
			<?php endif ?>
		<?php elseif ( is_a( $post, 'WP_Post' ) ) : ?>
			<?php $user = get_userdata( $post->post_author ) ?>
			<?php if ( is_a( $user, 'WP_User' ) ) : ?>
				<?php printf( __( 'Added by %s', 'sprout-invoices' ), $user->display_name )  ?>
			<?php endif ?>
		<?php else : ?>
			<?php _e( 'Added by SI', 'sprout-invoices' )  ?>
		<?php endif ?>
	</p></dd>
	
	<?php foreach ( $history as $item_id => $data ) :  ?>
		<dt class="record record-<?php echo $item_id ?>">
			<span class="history_deletion"><button data-id="<?php echo $item_id ?>" class="delete_record del_button">X</button></span>
			<span class="history_status <?php echo esc_attr( $data['status_type'] ); ?>"><?php echo esc_html( $data['type'] ) ?></span><br/>
			<span class="history_date"><?php echo date_i18n( get_option( 'date_format' ).' @ '.get_option( 'time_format' ), strtotime( $data['post_date'] ), true ) ?></span>
		</dt>

		<dd class="record record-<?php echo $item_id ?>">
			<?php if ( $data['status_type'] == SI_Notifications::RECORD ) :  ?>
				<p>
					<?php echo esc_html( $data['update_title'] ) ?>
					<br/><a href="#TB_inline?width=600&height=380&inlineId=notification_message_<?php echo (int) $item_id ?>" id="show_notification_tb_link_<?php echo (int) $item_id ?>" class="thickbox si_tooltip notification_message" title="<?php _e( 'View Message', 'sprout-invoices' ) ?>"><?php _e( 'View Message', 'sprout-invoices' ) ?></a>
				</p>
				<div id="notification_message_<?php echo (int) $item_id ?>" class="cloak">
					<?php echo wpautop( stripslashes_from_strings_only( $data['content'] ) ) ?>
				</div>
			<?php elseif ( function_exists( 'GetSignatureImage' ) && $data['status_type'] == 'si_esignature' ) :  ?>
				<p>
					<?php echo esc_html( $data['update_title'] ) ?>
					<br/>
					<?php echo stripslashes_from_strings_only( $data['content'] ) ?>
				</p>
			<?php elseif ( $data['status_type'] == SI_Importer::RECORD ) :  ?>
				<p>
					<?php echo esc_html( $data['update_title'] ); ?>
					<br/><a href="#TB_inline?width=600&height=380&inlineId=notification_message_<?php echo (int) $item_id ?>" id="show_notification_tb_link_<?php echo (int) $item_id ?>" class="thickbox si_tooltip notification_message" title="<?php _e( 'View Data', 'sprout-invoices' ) ?>"><?php _e( 'View Data', 'sprout-invoices' ) ?></a>
				</p>
				<div id="notification_message_<?php echo (int) $item_id ?>" class="cloak">
					<?php prp( json_decode( stripslashes_from_strings_only( $data['content'] ) ) ); ?>
				</div>
			<?php elseif ( $data['status_type'] == SI_Invoices::VIEWED_STATUS_UPDATE ) : ?>
				<p>
					<?php echo esc_html( $data['update_title'] ); ?>
				</p>
			<?php elseif ( SI_Controller::PRIVATE_NOTES_TYPE === $data['status_type'] ) :  ?>
				<?php echo wpautop( stripslashes_from_strings_only( $data['content'] ) ) ?>
				<p>
					<a class="thickbox si_tooltip edit_private_note" href="<?php echo admin_url( 'admin-ajax.php?action=si_edit_private_note_view&width=600&height=350&note_id=' . $item_id ) ?>" id="show_edit_private_note_tb_link_<?php echo (int) $item_id ?>" title="<?php _e( 'Edit Note', 'sprout-invoices' ) ?>"><?php _e( 'Edit', 'sprout-invoices' ) ?></a>
			<?php else : ?>
				<?php echo wpautop( stripslashes_from_strings_only( $data['content'] ) ) ?>
			<?php endif ?>
			
		</dd>
	<?php endforeach ?>
</dl>

<div id="private_note_wrap">
	<p>
		<textarea id="private_note" name="private_note" class="clearfix"></textarea>
		<a href="javascript:void(0)" id="save_private_note" class="button" data-post-id="<?php the_ID() ?>" data-nonce="<?php echo wp_create_nonce( SI_Internal_Records::NONCE ) ?>"><?php _e( 'Save', 'sprout-invoices' ) ?></a> <span class="helptip" title="<?php _e( 'These private notes will be added to the history.', 'sprout-invoices' ) ?>"></span>
	</p>
</div>


<?php if ( ! empty( $submission_fields ) ) :  ?>
	<div id="submission_fields_wrap">
		<h3><?php _e( 'Form Submission', 'sprout-invoices' ) ?></h3>
		<dl>
			<?php foreach ( $submission_fields as $key => $value ) :  ?>
				<?php if ( isset( $value['data'] ) ) :  ?>
					<?php if ( isset( $value['data']['label'] ) && $value['data']['type'] != 'hidden' ) :  ?>
						<dt><?php echo esc_html( $value['data']['label'] ); ?></dt>
						<?php if ( is_numeric( $value['value'] ) && strpos( $value['data']['label'], __( 'Type', 'sprout-invoices' ) ) !== false ) :  ?>
							<dd><p><?php
									$term = get_term_by( 'id', $value['value'], SI_Estimate::PROJECT_TAXONOMY );
							if ( ! is_wp_error( $term ) && is_object( $term ) ) {
								_e( $term->name, 'sprout-invoices' );
							}
									?></p></dd>
						<?php else : ?>
							<dd><?php echo wpautop( $value['value'] ) ?></dd>
						<?php endif ?>
					<?php endif ?>
				<?php endif ?>
			<?php endforeach ?>
		</dl>
	</div>

	<?php $media = get_attached_media( '' ); ?>
	<?php if ( ! empty( $media ) ) :  ?>
		<p>
			<h3><?php _e( 'Attachments', 'sprout-invoices' ) ?></h3>
			<ul>
				<?php foreach ( $media as $id => $mpost ) :  ?>
					<?php  $img = wp_get_attachment_image_src( $id, 'thumbnail', true ); ?>
					<li><a href="<?php echo wp_get_attachment_url( $id ) ?>" target="_blank" class="attachment_url"><img src="<?php echo esc_url( $img[0] ); ?>" alt="<?php esc_attr( $mpost->post_name ) ?>"></a></li>
				<?php endforeach ?>
			</ul>
		</p>
	<?php endif ?>

<?php endif ?>
