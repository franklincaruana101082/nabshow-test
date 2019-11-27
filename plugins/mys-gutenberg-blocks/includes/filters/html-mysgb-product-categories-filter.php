<?php

/**
 * Exit if accessed directly
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

?>
<div class="browse-filter main-filter row browse-product-categories-filter">
	<div class="select-items col-lg-12">
		<div class="row">
			<div class="col-12 display-flex-box">
				<div class="browse-select category">
					<label for="product-categories">Category</label>
					<select id="product-categories" class="select-opt">
						<option>Select a Category</option>
					</select>
				</div>
				<div class="category">
					<div class="search-box">
						<label for="browse-search">Keyword</label>
						<div class="search-item">
							<input id="browse-search" class="search" name="browse-search" type="text" placeholder="Filter by keyword...">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
