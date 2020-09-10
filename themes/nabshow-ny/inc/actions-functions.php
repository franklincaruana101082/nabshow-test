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
 * Added custom field to combine ACF date and start time.
 *
 * @param int $post_id 
 * 
 * @since 1.0.0
 */
function nabny_save_date_time_acf_meta( $post_id ) {
    
	$session_date 	= get_post_meta( $post_id, 'session_date', $post_id );
	$start_time 	  = get_post_meta( $post_id, 'start_time', $post_id );
	
	if ( ! empty( $session_date ) ) {
		
		$final_date = date_format( date_create( $session_date ), 'Y-m-d' );

		if ( ! empty( $start_time ) ) {
			$final_date .= ' ' . $start_time;
    }
    
		update_post_meta( $post_id, '_session_datetime', $final_date );
  }
}