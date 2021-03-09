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
                
                <h3><?php echo $message; ?></h3>
                <?php if($confirm == '1'){
                ?>
                    <div class="btn-group">
                        <button class="btn btn-confirm-yes confirm_address_remove_yes" data-id="<?php echo $address_id;?>">Yes</button>
                        <button class="btn btn-confirm-no confirm_address_remove_no" data-id="<?php echo $address_id;?>">No</button>
                    </div>
                <?php
                }
                ?>

                <?php if($employee_confirm == '1'){
                ?>
                    <div class="btn-group">
                        <button class="btn btn-confirm-yes btn-confirm confirm_employee_remove_yes" data-id="<?php echo $employee_id;?>">Yes</button>
                        <button class="btn btn-confirm-no confirm_employee_remove_no" data-id="<?php echo $employee_id;?>">No</button>
                    </div>
                <?php
                }
                ?>
           
            </div>
        </div>
    </div>
</div>