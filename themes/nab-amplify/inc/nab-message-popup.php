<?php

/**
 * Ajax to show message request popup.
 */
?>

<div id="connection-message-popup" class="nab-modal" data-comp-admin-id="<?php echo $point_of_contact; ?>">
    <div class="nab-modal-inner">
        <div class="modal-content">
            <span class="nab-modal-close fa fa-times"></span>
            <div class="modal-content-wrap">
                <form method="post" id="connection-message-form">
                    <h3>MESSAGE <?php echo get_the_title($company_id); ?> REP</h3>
                    <div class="author-info">
                        <div class="author-image">
                            <a href="<?php echo bp_core_get_user_domain($point_of_contact); ?>"><img src="<?php echo esc_url($user_images['profile_picture']) ?>" /></a>
                        </div>
                        <div class="author-details">
                            <h3 class="author-title"><a href="<?php echo bp_core_get_user_domain($point_of_contact); ?>"><?php echo get_the_author_meta('user_nicename', $point_of_contact); ?></a></h3>
                            <span class="author-subtitle"><?php echo isset($user_job_title) ? $user_job_title : '';?></span>
                        </div>
                    </div>

                    <p>Enter your message below.</p>
                    <textarea name="connection-message" id="connection-message"></textarea>
                    <p style="display: none;" class="error">Please enter message.</p>

                    <a id="submit-message-request" href="javascript:void(0)" class="btn">SEND MESSAGE</a>
                </form>
            </div>
        </div>
    </div>
</div>