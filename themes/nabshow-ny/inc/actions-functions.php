<?php

/**
 * Register channel post type.
 */
function nabny_register_channel_post_type() {
  
  $labels = array(
      'name'               => __( 'Channels', 'nabshow' ),
      'singular_name'      => __( 'Channel', 'nabshow' ),
      'add_new'            => __( 'Add New', 'nabshow' ),
      'add_new_item'       => __( 'Add New Channel', 'nabshow' ),
      'edit_item'          => __( 'Edit', 'nabshow' ),
      'new_item'           => __( 'New Channel', 'nabshow' ),
      'all_items'          => __( 'All Channels', 'nabshow' ),
      'view_item'          => __( 'View Channels', 'nabshow' ),
      'search_items'       => __( 'Search Channels', 'nabshow' ),
      'not_found'          => __( 'No Channels found', 'nabshow' ),
      'not_found_in_trash' => __( 'No Channels found in Trash', 'nabshow' ),
      'parent_item_colon'  => __( '', 'nabshow' ),
      'menu_name'          => __( 'Channels', 'nabshow' )
  );        
      
  $args = array(
      'labels'             => $labels,
      'public'             => true,
      'publicly_queryable' => true,
      'show_ui'            => true,
      'show_in_menu'       => true,
      'show_in_rest'       => true,
      'query_var'          => true,
      'rewrite'            => true,
      'capability_type'    => 'post',
      'has_archive'        => true,
      'hierarchical'       => true,                
      'supports'           => array(
          'title',
          'editor',
          'revisions',
          'trackbacks',
          'author',
          'excerpt',                    
          'thumbnail',
          'custom-fields'
      ),
  );

  register_post_type( 'channels', $args );
}

/**
 * Enqueue required script and style.
 */
function nabny_enqueue_required_scripts() {
  
  wp_enqueue_style( 'nabny-custom-style', get_stylesheet_directory_uri() . '/assets/css/nabshow-ny.css' );  
}

/**
 * Display restricted message if user on session detail page and not purchased product.
 *
 * @param  mixed $content
 * @return string
 */
function nabny_restrict_session_content( $content ) {

	global $post;
	
	if ( is_singular( 'sessions' ) && ! is_user_logged_in() ) {
		
		$product_name 	= get_field( 'product_name', $post->ID );
		$product_name	  = empty( $product_name ) ? 'this' : $product_name;
		$content 		    = '<p class="restrict-msg">You must have purchase ' . $product_name . ' product in order to view.</p>';
	}
	
	return $content;	
}