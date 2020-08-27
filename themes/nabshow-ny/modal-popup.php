<?php
/**
 * Template Name: Modal Popup
 * @package  NABShow_NY
 *
 */

$speaker_id 	= filter_input( INPUT_GET, 'speakerid', FILTER_SANITIZE_NUMBER_INT );

if ( ! isset( $speaker_id ) && empty( $speaker_id ) ) {
	wp_safe_redirect( site_url() );
	exit();
}

wp_head();

if ( isset( $speaker_id ) && ! empty( $speaker_id ) ) {
	$thumbnail_url = has_post_thumbnail( $speaker_id ) ? get_the_post_thumbnail_url( $speaker_id ) : get_template_directory_uri() . '/images/speaker-placeholder.png';
	?>
	<div class="modal-popup-nab">
        <div class="modal-popup-nab-body">
            <div class="close-sec">
                <i class="fa fa-times" data-dismiss="modal"></i>
            </div>
            <div class="modal-popup-nab-inner">
				<div class="mb50">
					<div class="head">
						<div class="details">
							<h3 class="title">
								<?php echo esc_html( get_the_title( $speaker_id ) ); ?>
							</h3>
						</div>
						<div class="feature">
							<img class="round-img" src="<?php echo esc_url( $thumbnail_url ); ?>" alt="speaker">
						</div>
					</div>
					<p><?php echo esc_html( get_the_excerpt( $speaker_id ) ); ?></p>
				</div>						
				<div class="popup-bottom">
					<div class="close-btn">
						<a href="#" data-dismiss="modal" data-feathr-click-track="true">Close Window</a>
					</div>
				</div>
			</div>
        </div>
    </div>
	<?php
}