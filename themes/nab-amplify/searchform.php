<?php
/**
 * The template for displaying search form 
 *
 * @package Amplify
 */

$site_url       = get_site_url();
$placeholder    = "Find the Content or People you're looking for...";
$search_class   = 'search-form';

if ( strpos( $site_url, 'nabshow-com-develop' ) > 0 ) {
    
    $placeholder    = "Find the Content, People, Companies or Products you're looking for...";
    $search_class   .= ' long-placeholder';
}
?>

<form role="search" method="get" class="<?php echo esc_attr( $search_class ); ?>" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label>
        <span class="screen-reader-text"><?php echo _x( 'Search for:', 'label' ) ?></span>
        <input type="search" class="search-field"
            placeholder="<?php echo esc_attr_x( $placeholder, 'placeholder' ) ?>"
            value="<?php echo get_search_query() ?>" name="s"
            title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
    </label>
    <input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>" />
</form>