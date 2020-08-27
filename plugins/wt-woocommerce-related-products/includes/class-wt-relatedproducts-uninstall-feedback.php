<?php
if (!class_exists('RelatedProducts_Uninstall_Feedback')) :

    /**
     * Class for catch Feedback on uninstall
     */
    class RelatedProducts_Uninstall_Feedback {

        public function __construct() {
            add_action('admin_footer', array($this, 'deactivate_scripts'));
            add_action('wp_ajax_relatedproducts_submit_uninstall_reason', array($this, "send_uninstall_reason"));
        }

        private function get_uninstall_reasons() {

            $reasons = array(
                array(
                    'id' => 'could-not-understand',
                    'text' => __('I couldn\'t understand how to make it work', 'wt-woocommerce-related-products'),
                    'type' => 'textarea',
                    'placeholder' => __('Would you like us to assist you?', 'wt-woocommerce-related-products')
                ),
                array(
                    'id' => 'found-better-plugin',
                    'text' => __('I found a better plugin', 'wt-woocommerce-related-products'),
                    'type' => 'text',
                    'placeholder' => __('Which plugin?', 'wt-woocommerce-related-products')
                ),
                array(
                    'id' => 'not-have-that-feature',
                    'text' => __('The plugin is great, but I need specific feature that you don\'t support', 'wt-woocommerce-related-products'),
                    'type' => 'textarea',
                    'placeholder' => __('Could you tell us more about that feature?', 'wt-woocommerce-related-products')
                ),
                array(
                    'id' => 'is-not-working',
                    'text' => __('The plugin is not working', 'wt-woocommerce-related-products'),
                    'type' => 'textarea',
                    'placeholder' => __('Could you tell us a bit more whats not working?', 'wt-woocommerce-related-products')
                ),
                array(
                    'id' => 'looking-for-other',
                    'text' => __('It\'s not what I was looking for', 'wt-woocommerce-related-products'),
                    'type' => 'textarea',
                    'placeholder' => 'Could you tell us a bit more?'
                ),
                array(
                    'id' => 'did-not-work-as-expected',
                    'text' => __('The plugin didn\'t work as expected', 'wt-woocommerce-related-products'),
                    'type' => 'textarea',
                    'placeholder' => __('What did you expect?', 'wt-woocommerce-related-products')
                ),
                array(
                    'id' => 'other',
                    'text' => __('Other', 'wt-woocommerce-related-products'),
                    'type' => 'textarea',
                    'placeholder' => __('Could you tell us a bit more?', 'wt-woocommerce-related-products')
                ),
            );

            return $reasons;
        }

        public function deactivate_scripts() {

            global $pagenow;
            if ('plugins.php' != $pagenow) {
                return;
            }
            $reasons = $this->get_uninstall_reasons();
            ?>
            <div class="relatedproducts-modal" id="relatedproducts-relatedproducts-modal">
                <div class="relatedproducts-modal-wrap">
                    <div class="relatedproducts-modal-header">
                        <h3><?php _e('If you have a moment, please let us know why you are deactivating:', 'wt-woocommerce-related-products'); ?></h3>
                    </div>
                    <div class="relatedproducts-modal-body">
                        <ul class="reasons">
                            <?php foreach ($reasons as $reason) { ?>
                                <li data-type="<?php echo esc_attr($reason['type']); ?>" data-placeholder="<?php echo esc_attr($reason['placeholder']); ?>">
                                    <label><input type="radio" name="selected-reason" value="<?php echo $reason['id']; ?>"> <?php echo $reason['text']; ?></label>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="relatedproducts-modal-footer">
                        <a href="#" class="dont-bother-me"><?php _e('I rather wouldn\'t say', 'wt-woocommerce-related-products'); ?></a>
                        <button class="button-primary relatedproducts-model-submit"><?php _e('Submit & Deactivate', 'wt-woocommerce-related-products'); ?></button>
                        <button class="button-secondary relatedproducts-model-cancel"><?php _e('Cancel', 'wt-woocommerce-related-products'); ?></button>
                    </div>
                </div>
            </div>

            <style type="text/css">
                .relatedproducts-modal {
                    position: fixed;
                    z-index: 99999;
                    top: 0;
                    right: 0;
                    bottom: 0;
                    left: 0;
                    background: rgba(0,0,0,0.5);
                    display: none;
                }
                .relatedproducts-modal.modal-active {display: block;}
                .relatedproducts-modal-wrap {
                    width: 50%;
                    position: relative;
                    margin: 10% auto;
                    background: #fff;
                }
                .relatedproducts-modal-header {
                    border-bottom: 1px solid #eee;
                    padding: 8px 20px;
                }
                .relatedproducts-modal-header h3 {
                    line-height: 150%;
                    margin: 0;
                }
                .relatedproducts-modal-body {padding: 5px 20px 20px 20px;}
                .relatedproducts-modal-body .input-text,.relatedproducts-modal-body textarea {width:75%;}
                .relatedproducts-modal-body .reason-input {
                    margin-top: 5px;
                    margin-left: 20px;
                }
                .relatedproducts-modal-footer {
                    border-top: 1px solid #eee;
                    padding: 12px 20px;
                    text-align: right;
                }
            </style>
            <script type="text/javascript">
                (function ($) {
                    $(function () {
                        var modal = $('#relatedproducts-relatedproducts-modal');
                        var deactivateLink = '';
                        $('#the-list').on('click', 'a.relatedproducts-deactivate-link', function (e) {
                            e.preventDefault();
                            modal.addClass('modal-active');
                            deactivateLink = $(this).attr('href');
                            modal.find('a.dont-bother-me').attr('href', deactivateLink).css('float', 'left');
                        });
                        modal.on('click', 'button.relatedproducts-model-cancel', function (e) {
                            e.preventDefault();
                            modal.removeClass('modal-active');
                        });
                        modal.on('click', 'input[type="radio"]', function () {
                            var parent = $(this).parents('li:first');
                            modal.find('.reason-input').remove();
                            var inputType = parent.data('type'),
                                    inputPlaceholder = parent.data('placeholder'),
                                    reasonInputHtml = '<div class="reason-input">' + (('text' === inputType) ? '<input type="text" class="input-text" size="40" />' : '<textarea rows="5" cols="45"></textarea>') + '</div>';

                            if (inputType !== '') {
                                parent.append($(reasonInputHtml));
                                parent.find('input, textarea').attr('placeholder', inputPlaceholder).focus();
                            }
                        });

                        modal.on('click', 'button.relatedproducts-model-submit', function (e) {
                            e.preventDefault();
                            var button = $(this);
                            if (button.hasClass('disabled')) {
                                return;
                            }
                            var $radio = $('input[type="radio"]:checked', modal);
                            var $selected_reason = $radio.parents('li:first'),
                                    $input = $selected_reason.find('textarea, input[type="text"]');

                            $.ajax({
                                url: ajaxurl,
                                type: 'POST',
                                data: {
                                    action: 'relatedproducts_submit_uninstall_reason',
                                    reason_id: (0 === $radio.length) ? 'none' : $radio.val(),
                                    reason_info: (0 !== $input.length) ? $input.val().trim() : ''
                                },
                                beforeSend: function () {
                                    button.addClass('disabled');
                                    button.text('Processing...');
                                },
                                complete: function () {
                                    window.location.href = deactivateLink;
                                }
                            });
                        });
                    });
                }(jQuery));
            </script>
            <?php
        }

        public function send_uninstall_reason() {

            global $wpdb;

            if (!isset($_POST['reason_id'])) {
                wp_send_json_error();
            }


            $data = array(
                'reason_id' => sanitize_text_field($_POST['reason_id']),
                'plugin' => "relatedproducts",
                'auth' => 'relatedproducts_uninstall_1234#',
                'date' => gmdate("M d, Y h:i:s A"),
                'url' => '',
                'user_email' => '',
                'reason_info' => isset($_REQUEST['reason_info']) ? trim(stripslashes($_REQUEST['reason_info'])) : '',
                'software' => $_SERVER['SERVER_SOFTWARE'],
                'php_version' => phpversion(),
                'mysql_version' => $wpdb->db_version(),
                'wp_version' => get_bloginfo('version'),
                'wc_version' => (!defined('WC_VERSION')) ? '' : WC_VERSION,
                'locale' => get_locale(),
                'multisite' => is_multisite() ? 'Yes' : 'No',
                'relatedproducts_version' => WT_RELATED_PRODUCTS_VERSION,
                
            );
            // Write an action/hook here in webtoffe to recieve the data
            $resp = wp_remote_post('https://feedback.webtoffee.com/wp-json/relatedproducts/v1/uninstall', array(
                'method' => 'POST',
                'timeout' => 45,
                'redirection' => 5,
                'httpversion' => '1.0',
                'blocking' => false,
                'body' => $data,
                'cookies' => array()
                    )
            );

            wp_send_json_success();
        }

    }
    new RelatedProducts_Uninstall_Feedback();

endif;