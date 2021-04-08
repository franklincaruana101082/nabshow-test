<?php
global $post;

$company_id = filter_input( INPUT_POST, 'company_id', FILTER_SANITIZE_NUMBER_INT );
$address_id = filter_input( INPUT_POST, 'address_id', FILTER_SANITIZE_NUMBER_INT );

$address_number = array(
    '1' => 'one',
    '2' => 'two',
    '3' => 'three',
    '4' => 'four'
);
$address_data   = get_field( 'regional_address_' . $address_number[$address_id], $company_id );
$country_list   = nab_get_countries();
?>
<div id="addProductModal" class="nab-modal nab-modal-with-form theme-dark nab-modal-active add-address-popup">
    <div class="nab-modal-inner">
        <div class="modal-content">
            <span class="nab-modal-close fa fa-times"></span>
            <div class="modal-content-wrap">
                <div class="add-product-content-popup">

                    <h2 class="address-title">Add or update an additional regional address here. <i class="fa fa-info-circle large-label-tooltip" aria-hidden="true" data-bp-tooltip="Your primary location and company name are fields managed by the NAB team to be sure your company contact information is consistent and accurate across all of our systems. If you need to make a change to your primary address, please contact your sales rep."></i></h2>

                    <div class="form-wrapper">
                        <form method="post" id="nab-add-address-form" enctype="multipart/form-data">

                            <div class="form-row">
                                <div class="form-col-6">
                                    <div class="form-row">
                                        <label for="">Street (line 1)</label>
                                        <textarea placeholder="Type Here..." name="street_line_1" id="street_line_1"><?php echo isset( $address_data['street_line_1'] ) ? esc_html ( $address_data['street_line_1'] ) : ''; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-col-6">
                                    <div class="form-row">
                                        <label for="">Street (line 2)</label>
                                        <textarea placeholder="Type Here..." name="street_line_2" id="street_line_2"><?php echo isset( $address_data['street_line_2_'] ) ? esc_html ( $address_data['street_line_2_'] ) : ''; ?></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <label for="">Country</label>
                                <div class="select-dark-simple">
                                    <select name="country" id="country" data-address-id="<?php echo isset( $address_id ) ? esc_attr( $address_id ) : 1 ?>" data-state="<?php echo $address_data['state_province']; ?>">
                                        <option value=''>Select</option>
										<?php
										foreach ( $country_list as $country ) {
											?>
                                            <option data-country-code="<?php echo esc_attr( $country['CNCode'] ); ?>" value="<?php echo esc_attr( $country['Display'] ); ?>" <?php if ( $address_data['country'] === $country['Display'] ) {
												echo "selected";
											} ?>><?php echo esc_html ( $country['Display'] ); ?></option>
											<?php
										}
										?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-row" id="state_select_wrapper" style="display:none">
                                <label for="">State/Province</label>
                            </div>
                            <div class="form-row">
                                <label for="">City</label>
                                <input type="text" class="input-text nab-featured-block-button-link" name="city" id="city" value="<?php echo isset( $address_data['city'] ) ? esc_attr( $address_data['city'] ) : ''; ?>">
                            </div>

                            <div class="form-row">
                                <label for="">Zip/Postal</label>
                                <input type="text" class="input-text nab-featured-block-button-link" name="zip" id="zip" value="<?php echo isset( $address_data['zip_postal'] ) ? esc_attr( $address_data['zip_postal'] ) : ''; ?>">
                            </div>

                            <div class="form-row">
                                <input type="button" id="nab-add-address-submit" data-id="<?php echo isset( $address_id ) ? esc_attr( $address_id ) : 1 ?>" class="btn btn-submit" value="Update">
                                <input type="hidden" name="nab_company_id" id="nab_company_id" value="<?php echo esc_attr( $company_id ); ?>"/>
                            </div>
                        </form>
                        <p>NAB Amplify reserves the right to remove any content that is deemed inappropriate. See the <a class="btn-link" href="<?php echo esc_url ( site_url() ); ?>/nab-virtual-events-code-of-conduct/">Code of Conduct</a> for details.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>