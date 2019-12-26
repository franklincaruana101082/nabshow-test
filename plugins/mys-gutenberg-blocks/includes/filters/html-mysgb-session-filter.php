<?php

/**
 * Exit if accessed directly
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

$get_featured = filter_input( INPUT_GET, 'session-key', FILTER_SANITIZE_STRING );

$featured_class = 'featured-btn';

if ( ! empty( $get_featured ) && 'featured' === strtolower( $get_featured ) ) {
	$featured_class .= ' active';
}
?>

<div class="browse-filter main-filter row browse-sessions-filter">
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
        <label>Session Name</label>
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
    <div class="select-items col-lg-12">
        <div class="row">
            <div class="category col-lg-3">
                <label for="session-tracks">Track</label>
                <div class="browse-select">
                    <select id="session-tracks" class="select-opt">
                        <option>Select a Track</option>
						<?php
						$this->mysgb_get_term_list_options( 'tracks' );
						?>
                    </select>
                </div>
            </div>
            <div class="category col-lg-3">
                <label for="session-level">Level</label>
                <div class="browse-select">
                    <select id="session-level" class="select-opt">
                        <option>Select a Level</option>
						<?php
						$this->mysgb_get_term_list_options( 'session-levels' );
						?>
                    </select>
                </div>
            </div>
            <div class="category col-lg-3">
                <label for="session-type">Types</label>
                <div class="browse-select">
                    <select id="session-type" class="select-opt">
                        <option>Select a Type</option>
						<?php
						$this->mysgb_get_term_list_options( 'session-types' );
						?>
                    </select>
                </div>
            </div>
            <div class="category col-lg-3">
                <label for="session-location">Location</label>
                <div class="browse-select">
                    <select id="session-location" class="select-opt">
                        <option>Select a Location</option>
						<?php
						$this->mysgb_get_term_list_options( 'session-locations' );
						?>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
