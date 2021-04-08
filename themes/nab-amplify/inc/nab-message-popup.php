<?php

/**
 * Ajax to show message request popup.
 */

?>

<?php
$company_id = filter_input(INPUT_POST, 'company_id', FILTER_SANITIZE_NUMBER_INT);
$post_type = filter_input(INPUT_POST, 'post_type', FILTER_SANITIZE_STRING);
$post_id = filter_input(INPUT_POST, 'post_id', FILTER_SANITIZE_NUMBER_INT);
$member_id = filter_input(INPUT_POST, 'member_id', FILTER_SANITIZE_NUMBER_INT);
$action = 'poc';
$message_html = nab_get_wp_editor('', 'nab-xconnection-message', array('media_buttons' => true,'teeny' => true, 'quicktags' => false, 'tinymce' => array('toolbar1' => 'bold,italic,strikethrough,bullist,numlist,blockquote,hr,alignleft,aligncenter,alignright,link,unlink', 'content_css' => get_template_directory_uri() . '/assets/css/nab-front-tinymce.css')));

if ($post_type === 'company-products') {
    $point_of_contact   = get_field('product_point_of_contact', $post_id);
} else {
    $point_of_contact   = get_field('point_of_contact', $company_id);
}

if ($member_id) {
    $point_of_contact = $member_id;
    $action = 'mmu';
}

$user_fullname = nab_get_author_fullname($point_of_contact);


$user_images = nab_amplify_get_user_images($point_of_contact);

$user_job_title = get_user_meta($point_of_contact, 'attendee_title', true);
?>

<div id="connection-message-popup" class="nab-modal theme-dark" data-comp-admin-id="<?php echo esc_attr( $point_of_contact ); ?>">
    <div class="nab-modal-inner">
        <div class="modal-content">
            <span class="nab-modal-close fa fa-times"></span>
            <div class="modal-content-wrap">
				<?php if ( ! empty( $point_of_contact ) ) { ?>
                    <form method="post" id="connection-message-form">
						<?php if ( 'poc' === $action ) { ?>
                            <h3>Message <?php echo esc_html( get_the_title( $company_id ) ); ?> Rep</h3>
                            <div class="author-info">
                                <div class="author-image">
                                    <a href="<?php echo esc_url( bp_core_get_user_domain( $point_of_contact ) ); ?>"><img src="<?php echo esc_url( $user_images['profile_picture'] ) ?>"/></a>
                                </div>
                                <div class="author-details">
                                    <h3 class="author-title"><a href="<?php echo esc_url( bp_core_get_user_domain( $point_of_contact ) ); ?>"><?php echo esc_html( $user_fullname ); ?></a></h3>
                                    <span class="author-subtitle"><?php echo isset( $user_job_title ) ? esc_html( $user_job_title ) : ''; ?></span>
                                </div>
                            </div>
						<?php } else { ?>
                            <h3>Message <?php echo esc_html( $user_fullname ); ?></h3>
						<?php } ?>

                        <p>Enter your message below.</p>
						<?php if ( 'poc' === $action ) { ?>
                            <textarea name="connection-message" id="connection-message"></textarea>
						<?php } else { ?>
                            <textarea name="nab-connection-message" id="nab-connection-message"></textarea>
						<?php } ?>
                        <p style="display: none;" class="error">Please enter message.</p>
                        <a id="submit-message-request" href="javascript:void(0)" class="btn">SEND MESSAGE</a>
                        <p class="message-leggal-notice"><i class="small">By submitting this message, I agree to receive additional information and communications from <?php echo esc_html( get_the_title( $company_id ) ); ?>.</i></p>
                    </form>
				<?php } else {
					?>
                    <h3>There is no representative assigned for this company.</h3>
					<?php
				} ?>
            </div>
        </div>
    </div>
</div>