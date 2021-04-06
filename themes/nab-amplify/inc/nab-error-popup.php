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
                
                <h3><?php echo esc_html( $message ); ?></h3>
                <?php if( '1' === $confirm || 1 === $confirm ){
                ?>
                    <div class="btn-group">
                        <button class="btn btn-confirm-yes confirm_address_remove_yes" data-id="<?php echo esc_attr( $address_id );?>">Yes</button>
                        <button class="btn btn-confirm-no confirm_address_remove_no" data-id="<?php echo esc_attr( $address_id );?>">No</button>
                    </div>
                <?php
                }
                ?>

                <?php if( 1 === $employee_confirm || '1' === $employee_confirm ) {
                ?>
                    <div class="btn-group">
                        <button class="btn btn-confirm-yes btn-confirm confirm_employee_remove_yes" data-id="<?php echo esc_attr( $employee_id );?>">Yes</button>
                        <button class="btn btn-confirm-no confirm_employee_remove_no" data-id="<?php echo esc_attr( $employee_id );?>">No</button>
                    </div>
                <?php
                }
                ?>
           
            </div>
        </div>
    </div>
</div>