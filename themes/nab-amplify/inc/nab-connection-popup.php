<?php
/**
 * Ajax to show connection request popup.
 */
?>

<div id="connection-message-popup" class="nab-modal">
    <div class="nab-modal-inner">
        <div class="modal-content">
            <span class="nab-modal-close fa fa-times"></span>
            <div class="modal-content-wrap">
                <form method="post" id="connection-message-form">
                    <h2>REQUEST TO CONNECT</h2>
                    <p>Tell me why you want to connect?</p>
                    <textarea name="connection-message" id="connection-message"></textarea>
                    <p style="display: none;" class="error">Please add message.</p>
                    <a id="submit-connection-request" href="javascript:void(0)">SEND REQUEST</a>
                </form>
            </div>
        </div>
    </div>
</div>
