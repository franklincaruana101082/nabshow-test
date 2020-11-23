
<div id="nab-edit-product" class="nab-modal">
	<div class="nab-modal-inner">
		<div class="modal-content">
			<span class="nab-modal-close fa fa-times"></span>
			<div class="modal-content-wrap">
			<form method="post" id="nab-edit-product-form" enctype="multipart/form-data">
			<div>
			<label>Add product</label>
			<input name="nab_product_title" value="<?php echo isset($post_data->post_title)?$post_data->post_title:''; ?>" class="" id="produt_title"/>
			</div>
			<div>
			<label>Add Categoy</label>
			<select name="product_categories[]" multiple="true" id="product_categories">
				<option value=""></option>
				<?php foreach($terms as $term){
			 ?>
			 <option value="<?php echo $term->slug;?>" <?php if(in_array($term->slug,$post_data->categories)){ echo "selected"; } ?>><?php echo $term->name;?></option>
			 <?php } ?>
			</select>
			</div>
			<div>
			<label>Add Media</label>
			<input type="file" id="product_medias" class="button" name="product_medias[]"  multiple="multiple"/>
			</div>
			<div>
			<label>Product Copy</label>
			<textarea name="nab_product_copy"  class="" id="nab_product_copy"><?php echo isset($post_data->product_copy)?$post_data->product_copy:''; ?></textarea>
			</div>
			<div>
			<label>Product Specs</label>
			<textarea name="nab_product_specs"  class="" id="nab_product_specs"><?php echo isset($post_data->product_specs)?$post_data->product_specs:''; ?></textarea>
			</div>
			<div>
			<label>Add Point Of Contact</label>
			<textarea name="nab_product_contact"  class="" id="nab_product_contact"><?php echo isset($post_data->product_point_of_contact)?$post_data->product_point_of_contact:''; ?></textarea>
			</div>
			<div>
			<label>Add External link text</label>
			<textarea name="nab_product_external_text"  class="" id="nab_product_external_text"><?php echo isset($post_data->product_external_link_text)?$post_data->product_external_link_text:''; ?></textarea>
			</div>
			<div>
				<button type="button" id="nab-edit-product-submit">Add product</button>
			</div>
			</form>
			</div>
		</div>
	</div>
</div>
