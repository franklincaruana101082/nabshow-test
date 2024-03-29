<?php

/**
 * Exit if accessed directly
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

$get_featured   = filter_input( INPUT_GET, 'speaker-key', FILTER_SANITIZE_STRING );
$remove_filter  = isset( $attributes['removeFilters'] ) && ! empty( $attributes['removeFilters'] ) ? $attributes['removeFilters'] : array();

$featured_class = 'featured-btn';
$filter_class   = '';

if ( ! empty( $get_featured ) && 'featured' === strtolower( $get_featured ) ) {
	$featured_class .= ' active';
}
if ( ! $display_name ) {
	$filter_class .= ' without-name';
}
if ( ! $display_title ) {
	$filter_class .= ' without-title';
}

if ( ! $display_company ) {
	$filter_class .= ' without-company';
}

?>
<div class="browse-filter main-filter row browse-speakers-filter<?php echo esc_attr( $filter_class ); ?>">
	<div class="left-side col-xl-5">
		<?php
		if ( ! in_array( 'Keyword', $remove_filter, true ) ) {
			?>
			<div class="search-box">
				<label for="browse-search">Keyword</label>
				<div class="search-item">
					<input id="browse-search" class="search" name="browse-search" type="text" placeholder="Filter by keyword...">
				</div>
			</div>
			<?php
		}
		?>
		<div class="row">
			<div class="col-lg-12">
				<?php
				if ( ! in_array( 'Featured', $remove_filter, true ) ) {
					?>
					<input type="button" class="<?php echo esc_attr( $featured_class ); ?>" value="Featured">
					<?php
				}
				if ( ! in_array( 'Sort Alphabetically', $remove_filter, true ) && $display_name ) {
					?>
					<input type="button" class="orderby" value="Sort by Last Name">
					<?php
				}
				?>
			</div>
		</div>
	</div>
	<?php
	if ( ! in_array( 'Speaker Name', $remove_filter, true ) && $display_name ) {
		?>
		<div class="pass-type col-xl-7">
			<label>Speaker Last Name</label>
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
	}
	?>
	<div class="select-items col-lg-12">
		<div class="row">
			<?php
			if ( ! in_array( 'Job Title', $remove_filter, true ) && $display_title ) {
				?>
				<div class="search-box col-lg-5">
					<label for="speaker-title-search">Job Title</label>
					<div class="search-item">
						<input id="speaker-title-search" class="speaker-title-search" name="speaker-title-search" type="text" placeholder="Search by Job Title..">
					</div>
				</div>
				<?php
			}
			if ( ! in_array( 'Company', $remove_filter, true ) && $display_company ) {
				?>
				<div class="category col-lg-3">
					<label for="speaker-company">Company</label>
					<div class="browse-select">
						<select id="speaker-company" class="select-opt">
							<option>Select a Company</option>
							<?php
							$this->mysgb_get_term_list_options( 'speaker-companies' );
							?>
						</select>
					</div>
				</div>
				<?php
			}
			if ( ! in_array( 'Date Speaking', $remove_filter, true ) && isset( $attributes['filterDates']) && ! empty( $attributes['filterDates'] ) ) {

				$filter_dates = explode( '|' , $attributes['filterDates'] );

				?>
				<div class="category col-lg-3">
					<label for="speaker_date">Date Speaking</label>
					<div class="browse-select">
						<select id="speaker_date" class="select-opt">
							<option value="select">Select a Date</option>
							<?php
							if ( is_array( $filter_dates ) && count( $filter_dates ) > 0 ) {

								foreach ( $filter_dates as $speaking_date ) {

									$speaking_date_format = date_format( date_create( trim( $speaking_date ) ), 'F, j Y' );
									?>
									<option value="<?php echo esc_attr( $speaking_date_format ); ?>"><?php echo esc_html( trim( $speaking_date ) ); ?></option>
									<?php
								}
							}
							?>
						</select>
					</div>
				</div>
				<?php
			}
			?>
		</div>
	</div>
</div>
