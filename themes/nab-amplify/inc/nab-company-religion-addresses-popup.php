<?php
global $post;
?>
<div id="addProductModal" class="nab-modal theme-dark nab-modal-active">
	<div class="nab-modal-inner">
		<div class="modal-content">
			<span class="nab-modal-close fa fa-times"></span>
			<div class="modal-content-wrap">
				<div class="add-product-content-popup">
					<h2>Address</h2>
					<div class="form-wrapper">
						<form method="post" id="nab-add-address-form" enctype="multipart/form-data">
							
							<div class="form-row">
								<label for="">Street line 1</label>
								<textarea  class="limited-char-field" placeholder="Type Here..." name="street_line_1" id="street_line_1"><?php echo isset($address_data['street_line_1'])?$address_data['street_line_1']:'';?></textarea>
							</div>
							
							<div class="form-row">
								<label for="">Street line 2</label>
								<textarea  class="limited-char-field" placeholder="Type Here..." name="street_line_2" id="street_line_2"><?php echo isset($address_data['street_line_2_'])?$address_data['street_line_2_']:'';?></textarea>
							</div>
							
							
							<div class="form-row">
								<label for="">Country</label>
								<div class="select-dark-simple">
								<select name="country" id="country"  data-address-id="<?php echo isset($address_id) ? $address_id : 1 ?>" data-state="<?php echo $address_data['state_province'];?>">
								<option value=''>Select</option>
								<?php
								foreach( $country_list as $country){
								?>
								<option data-country-code="<?php echo $country['CNCode'];?>" value="<?php echo $country['Display'];?>" <?php if($address_data['country'] === $country['Display']){ echo "selected";}?>><?php echo $country['Display']; ?></option>
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
								<input type="text" class="input-text nab-featured-block-button-link" name="city" id="city" value="<?php echo isset($address_data['city'])?$address_data['city']:'';?>">
							</div>
							
							<div class="form-row">
								<label for="">Zip/Postal</label>
								<input type="text" class="input-text nab-featured-block-button-link" name="zip" id="zip" value="<?php echo isset($address_data['zip_postal'])?$address_data['zip_postal']:'';?>">
							</div>
							
							<div class="form-row">
								<input type="button" id="nab-add-address-submit" data-id="<?php echo isset($address_id) ? $address_id : 1 ?>" class="btn btn-submit" value="Update">
								<input type="hidden" name="nab_company_id" id="nab_company_id" value="<?php echo $company_id; ?>" />
							</div>
						</form>
						<p>NAB Amplify reserves the right to remove any content that is deemed inappropriate. See the <a class="btn-link" href="<?php echo site_url(); ?>/nab-virtual-events-code-of-conduct/">Code of Conduct</a> for details.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>