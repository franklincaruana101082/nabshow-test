<?php

/**
 * Ajax to show message request popup.
 */
?>

<div id="connection-message-popup" class="nab-modal theme-dark" data-comp-admin-id="<?php echo $point_of_contact; ?>">
    <div class="nab-modal-inner">
        <div class="modal-content">
            <span class="nab-modal-close fa fa-times"></span>
            <div class="modal-content-wrap">
                <?php if(!empty($point_of_contact)){ ?>
                <form method="post" id="connection-message-form">
                <?php if($action === 'poc'){?>
                    <h3>Message <?php echo get_the_title($company_id); ?> Rep</h3>
                    <div class="author-info">
                        <div class="author-image">
                            <a href="<?php echo bp_core_get_user_domain($point_of_contact); ?>"><img src="<?php echo esc_url($user_images['profile_picture']) ?>" /></a>
                        </div>
                        <div class="author-details">
                            <h3 class="author-title"><a href="<?php echo bp_core_get_user_domain($point_of_contact); ?>"><?php echo $user_fullname; ?></a></h3>
                            <span class="author-subtitle"><?php echo isset($user_job_title) ? $user_job_title : '';?></span>
                        </div>
                    </div>
                    <?php }else{ ?>
                    <h3>Message <?php echo $user_fullname; ?></h3>
                    <?php } ?>
                    
                    

                    <p>Enter your message below.</p>
                    <?php if($action === 'poc'){?>
                    <textarea name="connection-message" id="connection-message"></textarea>
                    <?php }else{ ?>
                        <textarea name="nab-connection-message" id="nab-connection-message"></textarea>
                     <?php } ?>
                    <p style="display: none;" class="error">Please enter message.</p>

                    <a id="submit-message-request" href="javascript:void(0)" class="btn">SEND MESSAGE</a>
                    <p class="message-leggal-notice">By submitting this message, I agree to receive additional information and communications from <?php echo get_the_title($company_id); ?>.</p>
                </form>
                <?php }else{
                    ?>
                    <h3>There is no representative assigned for this company.</h3>
                    <?php
                } ?>
            </div>
        </div>
    </div>
</div>