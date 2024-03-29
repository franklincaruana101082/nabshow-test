<?php
check_ajax_referer( 'nab-ajax-nonce', 'nabNonce' );

$event_id			= filter_input( INPUT_POST, 'event_id', FILTER_SANITIZE_NUMBER_INT );
$company_id			= filter_input( INPUT_POST, 'company_id', FILTER_SANITIZE_NUMBER_INT );
$post_data 			= isset( $event_id ) && ! empty( $event_id ) ? get_post( $event_id ) : new stdClass();
$event_desc			= isset( $post_data->ID ) ? get_the_content( '', false, $post_data->ID ) : '';
$event_start_date	= isset( $post_data->ID ) ? get_post_meta( $post_data->ID, '_EventStartDate', true ) : '';
$event_end_date		= isset( $post_data->ID ) ? get_post_meta( $post_data->ID, '_EventEndDate', true ) : '';
$event_url			= isset( $post_data->ID ) ? get_post_meta( $post_data->ID, '_EventURL', true ) : '';
$event_date			= '';
$event_start_time	= '';
$event_end_time		= '';

if ( ! empty( $event_start_date ) ) {

	$event_date			= date_format( date_create( $event_start_date ), "F j, Y" );
	$event_start_time	= date_format( date_create( $event_start_date ), "H:i:s" );
}
if ( ! empty( $event_end_date ) ) {
	$event_end_time = date_format( date_create( $event_end_date ), "H:i:s" );
}

?>
<div id="addProductModal" class="nab-modal nab-modal-with-form theme-dark nab-modal-active">
	<div class="nab-modal-inner">
		<div class="modal-content">
			<span class="nab-modal-close fa fa-times"></span>
			<div class="modal-content-wrap">
				<div class="add-product-content-popup">
					<h2><?php echo esc_html( isset( $post_data->ID ) ? "Update" : "Add" ); ?> Event</h2>
					<div class="form-wrapper">
						<form method="post" id="nab-add-edit-event-form" enctype="multipart/form-data">
							<div class="form-row">
								<label for="event-name">Event Name</label>
								<input type="text" required maxlength="60" class="input-text" name="event_name" id="event-name" value="<?php echo esc_attr( isset( $post_data->post_title ) ? $post_data->post_title : ''); ?>">
							</div>
                            <div class="form-row">
								<label for="event-description">Description</label>
								<textarea name="event_desc" id="event-description" maxlength="200"><?php echo esc_html( wp_strip_all_tags( $event_desc ) ); ?></textarea>
								<span class="info-msg"><span id="event-desc-count">200 Characters Remaining</span></span>
							</div>
							<div class="form-row">
								<label for="event-featured-image">Featured Image <i class="fa fa-info-circle" aria-hidden="true" data-bp-tooltip="Acceptable File Types: .jpeg. .jpg, .png. Ideal photo size is 1200x630"></i></label>
								<div class="form-control">
									<div class="file-input">
										<input type="file" id="event-featured-image" class="button bm-select-media" bynder-for="event_featured_image" name="featured_image"> <!--Bynder_Featured_Event-->
									</div>
									<div class="nab-action left-action">
										<div class="nab-action-row">
											<i class="action-add fa fa-plus"></i>
										</div>
									</div>
								</div>
							</div>
							<div class="form-row common-img-wrapper" id="event_media_wrapper">
								<?php
								// Bynder_Featured_Event
								if ( isset( $post_data->ID ) ) {
                                    $eventImg = nab_amplify_get_featured_image( $post_data->ID, false );
									if( $eventImg ) {
									?>
									<div class="nab-event-media-item common-media-item">
										<i class="fa fa-times remove-featred-img" data-attachment-id="<?php echo esc_attr( get_post_thumbnail_id( $post_data->ID ) ); ?>" aria-hidden="true"></i>
										<img src="<?php echo esc_url( $eventImg ); ?>" class="preview-event-featured-img common-preview-img" />
									</div>
									<?php
								}
								}
								?>
							</div>
                            <div class="form-row">
                                <div class="form-col-3">
                                    <div class="form-row">
                                        <label for="event-date">Date</label>
								        <input type="text" name="event_date" id="event-date" value="<?php echo esc_attr( $event_date ); ?>"/>
                                    </div>
                                </div>
                                <div class="form-col-3">
                                    <div class="form-row">
                                        <label for="event-start-time">Start Time (ET)</label>
                                        <div class="select-dark-simple">
                                        	<select name="event_start_time" id="event-start-time">
	                                            <?php
	                                            nab_event_time_dropdown_options( $event_start_time );
	                                            ?>
	                                        </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-col-3">
                                    <div class="form-row">
                                        <label for="event-end-time">End Time (ET)</label>
                                        <div class="select-dark-simple">
	                                        <select name="event_end_time" id="event-end-time">
	                                            <?php
	                                            nab_event_time_dropdown_options( $event_end_time );
	                                            ?>
	                                        </select>
	                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
								<label for="event-url">Event URL</label>
								<input type="text" name="event_url" id="event-url" value="<?php echo esc_url( $event_url ); ?>" />
							</div>
							<p class="form-field-error global-notice" style="display: none;"></p>
							<div class="form-row">
								<?php
								$publish_button_text = isset( $post_data->ID ) ? "Update" : "Publish";
								?>
								<input type="button" id="nab-edit-event-submit" class="btn btn-submit" value="<?php echo esc_attr( $publish_button_text ) ?>">
								<input type="hidden" name="event_id" id="event_id" value="<?php echo isset( $post_data->ID ) ? $post_data->ID : 0;?>" />
								<input type="hidden" name="nab_company_id" id="nab_company_id" value="<?php echo isset( $company_id ) ? $company_id : 0; ?>" />
							</div>
						</form>
						<p>NAB Amplify reserves the right to remove any content that is deemed inappropriate. See the <a class="btn-link" href="<?php echo site_url();?>/nab-virtual-events-code-of-conduct/">Code of Conduct</a> for details.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
