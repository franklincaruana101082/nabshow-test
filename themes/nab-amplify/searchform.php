<?php
/**
 * The template for displaying search form 
 *
 * @package Amplify
 */


$placeholder    = "Find the Content, People, Companies or Products you're looking for...";
?>

<form role="search" method="get" class="search__form long-placeholder" action="<?php echo esc_url( home_url( '/' ) ); ?>">

    <input type="search" class="search__field "
        placeholder="<?php echo esc_attr_x( $placeholder, 'placeholder' ) ?>"
        value="<?php echo get_search_query() ?>" name="s"
        title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
    <button type="submit" class="search__submit"><img src="/wp-content/themes/nab-amplify/assets/images/icon-search.svg" alt="search icon" /></button>
    <!-- <input type="submit" class="search__submit" value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>" /> -->
</form>