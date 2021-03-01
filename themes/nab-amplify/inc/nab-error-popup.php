<?php

/**
 * Ajax to show Error message popup.
 */
?>

<div id="connection-message-popup" class="nab-modal theme-dark error-message-popup">
    <div class="nab-modal-inner">
        <div class="modal-content">
            <span class="nab-modal-close fa fa-times"></span>
            <div class="modal-content-wrap">
                
            <h4><?php echo $message; ?></h4>
                <?php if($confirm == '1'){
?>
<button class="btn confirm_address_remove_yes" data-id="<?php echo $address_id;?>">Yes</button>
<button class="btn confirm_address_remove_no" data-id="<?php echo $address_id;?>">No</button>
<?php
                }
                ?>
           
            </div>
        </div>
    </div>
</div>