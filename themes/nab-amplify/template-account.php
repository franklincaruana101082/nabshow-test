<?php
/*
 * Template Name: popup
 */

get_header();

 ?>

 <div id="addProductModal" class="nab-modal theme-dark nab-modal-active">
	<div class="nab-modal-inner">
		<div class="modal-content">
			<div class="modal-content-wrap">
				<span class="nab-modal-close">Close</span>
				<div class="add-product-content-popup">
					<h2>Add Product</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore</p>
					<div class="form-wrapper">
						<form action="">
							<div class="form-row">
								<label for="">Add Product</label>
								<input type="text" class="input-text">
								<div class="nab-action">
									<div class="nab-action-row">
										<span class="check-label">Featured Product:</span>
										<label class="nab-check-btn">
										  <input type="checkbox">
										  <span class="checkmark-switch"></span>
										</label>
									</div>
									<div class="nab-action-row">
										<i class="action-edit fa fa-pencil"></i>
									</div>
								</div>
							</div>
							<div class="form-row">
								<label for="">Add Category</label>
								<div class="nab-custom-select select-dark-simple">
									<select name="" id="">
										<option value="">option 1</option>
										<option value="">option 2</option>
										<option value="">option 3</option>
										<option value="">option 4</option>
									</select>
								</div>
							</div>
							<div class="form-row">
								<label for="">Add Media</label>
								<input type="file">
								<div class="nab-action">
									<div class="nab-action-row">
										<i class="action-add fa fa-plus"></i>
									</div>
									<div class="nab-action-row">
										<span class="check-label">B-Stock:</span>
										<label class="nab-check-btn">
										  <input type="checkbox" checked="checked">
										  <span class="checkmark-switch"></span>
										</label>
									</div>
									<div class="nab-action-row">
										<span class="check-label">Sales Item:</span>
										<label class="nab-check-btn">
										  <input type="checkbox">
										  <span class="checkmark-switch"></span>
										</label>
									</div>
									<div class="nab-action-row">
										<i class="action-edit fa fa-pencil"></i>
									</div>
								</div>
							</div>
							<div class="form-row">
								<label for="">Product Copy</label>
								<textarea placeholder="Type Here..."></textarea>
							</div>
							<div class="form-row">
								<div class="form-col-6">
									<label for="">Product Specs</label>
									<textarea placeholder="Type Here..."></textarea>	
								</div>
								<div class="form-col-6">
									<div class="form-row">
										<label for="">Add Point of Contact</label>
										<input type="text" class="input-text">
										<div class="nab-action">
											<div class="nab-action-row">
												<i class="action-add fa fa-plus"></i>
											</div>
											<div class="nab-action-row">
												<i class="action-edit fa fa-pencil"></i>
											</div>
										</div>
									</div>
									<div class="form-row">
										<label for="">Add Tag(s)</label>
										<input type="text" class="input-text">
										<div class="nab-action">
											<div class="nab-action-row">
												<i class="action-add fa fa-plus"></i>
											</div>
											<div class="nab-action-row">
												<i class="action-edit fa fa-pencil"></i>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-row">
								<div class="form-col-6">
									<div class="form-row">
										<label for="">Add External Link / Text</label>
										<input type="url" class="input-text">
										<div class="nab-action">
											<div class="nab-action-row">
												<i class="action-edit fa fa-pencil"></i>
											</div>
										</div>
									</div>
								</div>
								<div class="form-col-6">
									<div class="form-row">
										<label for="">Add External Link / Text</label>
										<input type="text" class="input-text">
										<div class="nab-action">
											<div class="nab-action-row">
												<i class="action-edit fa fa-pencil"></i>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-row">
								<div class="nab-action">
									<div class="nab-action-row">
										<div class="toggle-wrap">
											<span class="toggle-label">Discussion</span>
											<label class="nab-toggle-btn">
												<input type="checkbox" checked="checked">
											 	<div class="toggle-switch"></div>
											</label>
											<span class="toggle-status">On</span>
										</div>
									</div>
								</div>
							</div>
							<div class="form-row">
								<input type="submit" class="btn btn-submit" value="Add/Update">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
get_footer();