<?php

/**
 * Exit if accessed directly
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

$get_featured = filter_input( INPUT_GET, 'exhibitor-key', FILTER_SANITIZE_STRING );

$featured_class = 'featured-btn';

if ( ! empty( $get_featured ) && 'featured' === strtolower( $get_featured ) ) {
	$featured_class .= ' active';
}
?>

<div class="browse-filter main-filter row browse-exhibitors-filter">
    <div class="left-side col-xl-5">
        <div class="search-box">
            <label for="browse-search">Keyword</label>
            <div class="search-item">
                <input id="browse-search" class="search" name="browse-search" type="text"
                       placeholder="Filter by keyword...">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <input type="button" class="<?php echo esc_attr( $featured_class ); ?>" value="Featured">
                <input type="button" class="orderby" value="A-Z">
            </div>
        </div>
    </div>
    <div class="pass-type col-xl-7">
        <label>Category</label>
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
    </div>
	<?php

	$all_terms = get_terms( array(
		'taxonomy'   => 'exhibitor-keywords',
		'hide_empty' => true,
	) );

	if ( is_array( $all_terms ) && ! is_wp_error( $all_terms ) ) {

		$get_exkey = filter_input( INPUT_GET, 'exhibitor-key', FILTER_SANITIZE_STRING );
		?>
        <div class="col-lg-12 chechbox-main">
			<?php
			foreach ( $all_terms as $term ) {
				if ( 'featured' !== $term->slug ) {
					?>
                    <div class="custom-check-box">
                        <input type="checkbox" name="keywords[]" value="<?php echo esc_attr( $term->slug ); ?>" class="exhibitor-keywords" id="<?php echo esc_attr( $term->slug ); ?>" <?php checked( $term->slug, $get_exkey ); ?>>
                        <label for="<?php echo esc_attr( $term->slug ); ?>"><?php echo esc_html( $term->name ); ?></label>
                    </div>
					<?php
				}
			}
			?>
        </div>
		<?php
	}
	?>
    <div class="select-items col-lg-12">
        <div class="row">
            <div class="category col-lg-3">
                <label for="exhibitor-category">Category</label>
                <div class="browse-select">
                    <select id="exhibitor-category" class="select-opt">
                        <option>Select a Category</option>
				        <?php
				        $this->mysgb_get_term_list_options( 'exhibitor-categories' );
				        ?>
                    </select>
                </div>
            </div>
            <div class="category col-lg-3">
                <label for="exhibitor-hall">Halls</label>
                <div class="browse-select">
                    <select id="exhibitor-hall" class="select-opt">
                        <option>Select a Location</option>
				        <?php
				        $this->mysgb_get_term_list_options( 'halls' );
				        ?>
                    </select>
                </div>
            </div>
            <div class="category col-lg-3">
                <label for="exhibitor-pavilion">Pavilions</label>
                <div class="browse-select">
                    <select id="exhibitor-pavilion" class="select-opt">
                        <option>Select a Pavilion</option>
				        <?php
				        $this->mysgb_get_term_list_options( 'pavilions' );
				        ?>
                    </select>
                </div>
            </div>
            <div class="category col-lg-3">
                <label for="exhibitor-technology">Technology</label>
                <div class="browse-select">
                    <select id="exhibitor-technology" class="select-opt">
                        <option>Select a Technology</option>
				        <?php
				        $this->mysgb_get_term_list_options( 'exhibitor-trends' );
				        ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>