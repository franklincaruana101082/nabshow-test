<?php

/**
 * Exit if accessed directly
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

?>
<div class="browse-filter main-filter row browse-open-to-all-filter">
    <div class="col-xl-12 display-flex-box">
        <div class="category">
            <label for="session-date">Date</label>
            <div class="browse-select">
                <input type="text" name="speaker_date" id="session-date" placeholder="MM, DD 20XX"/>
            </div>
        </div>
        <div class="category">
            <label for="session-program">Program</label>
            <select id="session-program" class="select-opt">
                <option>Select a Category</option>
            </select>
        </div>
        <div class="category">
            <label for="session-topic">Topic</label>
            <select id="session-topic" class="select-opt">
                <option>Select a Category</option>
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
