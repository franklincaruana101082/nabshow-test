<?php
/**
 * The template for displaying search form 
 *
 * @package Amplify
 */


$placeholder = "Search";
?>

<div class="search__form long-placeholder">
    <input type="text" class="st-default-search-input search__field "
        placeholder="<?php echo esc_attr_x( $placeholder, 'placeholder' ) ?>"
        title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
    
</div>