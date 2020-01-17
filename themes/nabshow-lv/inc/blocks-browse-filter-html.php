<?php
/**
 * This file contains block browse filter
 *
 * @package NABShow_LV
 */

/**
 * Related content block - on floor destination filter.
 *
 * @since 1.0.0
 */
function nabshow_lv_related_content_on_floor_destination_filter() {

	$get_featured   = filter_input( INPUT_GET, 'happening-key', FILTER_SANITIZE_STRING );

	$featured_class = 'featured-btn';

	if ( ! empty( $get_featured ) && 'featured' === strtolower( $get_featured ) ) {

		$featured_class .= ' active';
	}
    ?>
    <div class="browse-filter main-filter row browse-destinations-filter">
        <div class="left-side col-xl-5">
            <div class="search-box">
                <label for="browse-search">Keyword</label>
                <div class="search-item">
                    <input id="browse-search" class="search" name="browse-search" type="text" placeholder="Filter by keyword...">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <input type="button" class="<?php echo esc_attr( $featured_class ); ?>" value="Featured">
                </div>
            </div>
        </div>
        <div class="pass-type col-xl-7">
            <label>Name</label>
		    <?php
		    nabshow_lv_alphabets_list_filter();
		    ?>
        </div>
        <div class="col-lg-12 chechbox-main">
            <div class="custom-check-box">
                <input type="checkbox" name="new_this_year" value="Yes" class="new-this-year" id="new-this-year">
                <label for="new-this-year">New This Year</label>
            </div>
        </div>
        <div class="select-items col-lg-12">
            <div class="row">
                <div class="category col-lg-3">
                    <label for="page-location">Location</label>
                    <div class="browse-select">
                        <select id="page-location" class="select-opt">
                            <option>Select a Location</option>
                        </select>
                    </div>
                </div>
                <div class="category col-lg-3">
                    <label for="page-type">Types</label>
                    <div class="browse-select">
                        <select id="page-type" class="select-opt">
                            <option>Select a Type</option>
                        </select>
                    </div>
                </div>
	            <div class="category col-lg-3">
		            <label for="page-type">Open To</label>
		            <div class="browse-select">
			            <select id="open-to" class="select-opt">
				            <option>Select a Pass</option>
			            </select>
		            </div>
	            </div>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Related content block - plan your show layout filter.
 *
 * @since 1.0.0
 */
function nabshow_lv_related_content_plan_your_show_layout_filter() {
    ?>
    <div class="browse-filter main-filter row browse-learn-filter">
        <div class="col-xl-12 display-flex-box">
            <div class="category">
                <label for="page-date">Date</label>
                <select id="page-date" class="select-opt">
                    <option>Select a Date</option>
                </select>
            </div>
            <div class="category">
                <label for="open-to">Open To</label>
                <select id="open-to" class="select-opt">
                    <option>Select a Pass</option>
                </select>
            </div>
            <div class="category">
                <label for="page-location">Location</label>
                <select id="page-location" class="select-opt">
                    <option>Select a Location</option>
                </select>
            </div>
            <div class="category">
                <label for="page-type">Program Type</label>
                <select id="page-type" class="select-opt">
                    <option>Select a Type</option>
                </select>
            </div>
            <div class="search-box">
                <label for="browse-search">Keyword</label>
                <div class="search-item icon-right">
                    <input class="search" type="text" id="browse-search" placeholder="Filter by keyword...">
                </div>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Related content block - key contanct layout filter.
 *
 * @since 1.0.0
 */
function nabshow_lv_related_content_key_contacts_layout_filter() {
    ?>
    <div class="box-main-filter main-filter related-content-filter">
        <div class="search-box">
            <label for="box-main-search">Keyword</label>
            <div class="search-item icon-right">
                <input id="box-main-search" class="search" name="box-main-search" type="text" placeholder="Filter by keyword...">
            </div>
        </div>
    </div>
    <?php
}

/**
 * Related content with block - opportunities layout filter.
 *
 * @since 1.0.0
 */
function nabshow_lv_related_content_with_block_opportunities_layout_filter() {
    ?>
    <div class="box-main-filter main-filter opportunities-filter">
        <div class="category">
            <label for="main-category-type">Category</label>
            <div class="box-main-select">
                <select id="main-category-type" class="select-opt">
                    <option>Select a Type</option>
                </select>
            </div>
        </div>
        <div class="category">
            <label for="sub-category-type">Sub-Category</label>
            <div class="box-main-select">
                <select id="sub-category-type" class="select-opt">
                    <option>Select a Type</option>
                </select>
            </div>
        </div>
        <div class="category">
            <label for="price-range">Cost</label>
            <div class="box-main-select">
                <select id="price-range" class="select-opt">
                    <option>Select a Price Range</option>
                </select>
            </div>
        </div>
        <div class="category">
            <label for="exclusivity">Exclusivity</label>
            <div class="box-main-select">
                <select id="exclusivity" class="select-opt">
                    <option>Select Exclusivity</option>
                </select>
            </div>
        </div>
        <div class="category">
            <label for="availability">Availability</label>
            <div class="box-main-select">
                <select id="availability" class="select-opt">
                    <option>Select Availability</option>
                    <option class="available">Available</option>
                    <option class="unavailable">Unavailable</option>
                </select>
            </div>
        </div>
        <div class="search-box">
            <label for="box-main-search">Keyword</label>
            <div class="search-item icon-right">
                <input id="box-main-search" class="search" name="box-main-search" type="text" placeholder="Filter by keyword..." />
            </div>
        </div>
    </div>
    <?php
}

/**
 * Related content with block - resources layout filter.
 *
 * @since 1.0.0
 */
function nabshow_lv_related_content_with_block_resources_layout_filter() {
    ?>
    <div class="box-main-filter main-filter exhibitor-resources-main exhibitor-resources-filter">
        <div id="box-main-listing" class="badgeslist"></div>
        <div class="search-box">
            <label for="box-main-search">Keyword</label>
            <div class="search-item icon-right">
                <input id="box-main-search" class="search" name="box-main-search" type="text" placeholder="Filter by keyword..." />
            </div>
        </div>
    </div>
    <?php
}

/**
 * Alphabets list for browse pages filter.
 *
 * @since 1.0.0
 */
function nabshow_lv_alphabets_list_filter() {
	?>
    <ul class="alphabets-list">
        <li>A</li>
        <li>B</li>
        <li>C</li>
        <li>D</li>
        <li>E</li>
        <li>F</li>
        <li>G</li>
        <li>H</li>
        <li>I</li>
        <li>J</li>
        <li>K</li>
        <li>L</li>
        <li>M</li>
        <li>N</li>
        <li>O</li>
        <li>P</li>
        <li>Q</li>
        <li>R</li>
        <li>S</li>
        <li>T</li>
        <li>U</li>
        <li>V</li>
        <li>W</li>
        <li>X</li>
        <li>Y</li>
        <li>Z</li>
        <li class="clear">Clear</li>
    </ul>
	<?php
}
