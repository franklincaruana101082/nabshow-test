<?php
/**
 * @package Getwid Base Child Theme
 */


/****************************** THEME SETUP ******************************/

//Getwid Base Child Theme

add_action( 'wp_enqueue_scripts', 'load_child_theme_enqueue_scripts' );


function load_child_theme_enqueue_scripts(){


	//Getwid Base child theme stylesheet css file

	wp_enqueue_style('child-theme-css', get_stylesheet_uri());


	//Getwid Base child theme javascript js file

	wp_enqueue_script('child-theme-js', get_stylesheet_directory_uri() . '/script.js', array( 'jquery' ), '1.0', true );

}

/**
 * Sets up theme for translation
 *
 * @since Getwid Bae Child 1.0.0
 */
function buddyboss_theme_child_languages()
{
  /**
   * Makes child theme available for translation.
   * Translations can be added into the /languages/ directory.
   */

  // Translate text from the PARENT theme.
  load_theme_textdomain( 'getwid-base', get_stylesheet_directory() . '/languages' );

  // Translate text from the CHILD theme only.
  // Change 'getwid-base' instances in all child theme files to 'gatwid-base-child-theme'.
  // load_theme_textdomain( 'getwid-base-chile-theme, get_stylesheet_directory() . '/languages' );

}
add_action( 'after_setup_theme', 'getwid_base_child_theme', 9999 );

/**
 * Enqueues scripts and styles for child theme front-end.
 *
 * @since Boss Child Theme  1.0.0
 */

//add_action( 'wp_enqueue_scripts', 'getwid-base-child-theme_scripts_styles', 9999 );


/****************************** CUSTOM FUNCTIONS ******************************/


				/* CUSTOM PHP CODE GOES HERE */
?>
