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
 * Add new column channel in the session list.
 *
 * @param $columns
 *
 * @return array 
 */
function nabny_add_custom_channel_column( $columns ) {

  $manage_columns = array();

  foreach( $columns as $key => $value ) {
  
  if ( 'title' === $key ) {
    
    $manage_columns[ $key ] 		= $value;
    $manage_columns[ 'channel' ] 	= 'Channel';            
  }
  
      $manage_columns[$key] = $value;
  }

  return $manage_columns;
}

/**
 * Display channel name in the custom channel column.
 *
 * @param $column
 * @param $post_id 
 */
function nabny_channel_columns_data( $column, $post_id ) {

	switch ( $column ) {
		case 'channel':
			
			$channel = get_post_meta( $post_id, 'session_channel', true );
			
			if ( ! empty( $channel ) ) {
				echo esc_html( get_the_title( $channel ) );
			} else {
				?>
				<span aria-hidden="true">—</span>
				<?php
			}
			break;
	}
}

/**
 * Added channel filter drop-down in the session list table.
 *
 * @param string $post_type 
 */
function nabny_session_channel_filter_dropdown( $post_type ) {

	if ( 'sessions' === $post_type || 'speakers' === $post_type ) {
		
		$channel_args = array(
			'post_type'      => 'channels',
			'posts_per_page' => -1,            
			'orderby'        => 'title',
			'order'          => 'ASC'
		);
		
		$channel_query = new WP_Query( $channel_args );
		?>
		<select name="session_channel" id="session_channel">
			<option value="">Select a Channel</option>
			<?php
			if ( $channel_query->have_posts() ) {
							
				$current_channel = filter_input( INPUT_GET, 'session_channel', FILTER_SANITIZE_NUMBER_INT );
	
				while ( $channel_query->have_posts() ) {
	
				  $channel_query->the_post();
					
          $current_channel_id = get_the_ID();
					
					?>
					<option value="<?php echo esc_attr( $current_channel_id ); ?>" <?php selected( $current_channel, $current_channel_id ); ?>><?php echo esc_html( get_the_title() ); ?></option>
					<?php
				}			
			}
			wp_reset_postdata();
			?>
		</select>
		<?php
	}	
}

/**
 * Apply channel filter in the query.
 *
 * @param  mixed $query  
 */
function nabny_session_filter_by_channel( $query ) {
	
	global $pagenow;	

	$current_post_type 	= filter_input( INPUT_GET, 'post_type', FILTER_SANITIZE_STRING );
	$current_channel 	  = filter_input( INPUT_GET, 'session_channel', FILTER_SANITIZE_NUMBER_INT );
		
    if ( isset( $current_post_type ) && ( 'sessions' === $current_post_type || 'speakers' === $current_post_type ) && isset( $current_channel ) && ! empty( $current_channel ) && 'edit.php' === $pagenow && $query->is_main_query() ) {		
      
      $query->query_vars[ 'meta_key' ]	  = 'session_channel';
		  $query->query_vars[ 'meta_value' ]	= $current_channel;
	}
}

/**
 * Mobile only Registration Button in footer
 */
function mobile_reg_button_ny_inclusion(){ ?>
  <!-- Mobile Only Registration Button -->
  <a id="mobile_reg" href="https://nabshow.com/ny2020/register/" data-feathr-click-track="true">Register Now</a>
  <!-- /Mobile Only Registration Button --> <?php
}

/**
 * Set speaker lastname as meta from the title.
 *
 * @param  int $post_id
 * @param  mixed $post 
 */
function nabny_set_speaker_last_name_meta( $post_id, $post ) {

	if ( 'speakers' !== $post->post_type ) {
        return;
	}

	$lastname = $post->post_title;

	if ( ! empty( $lastname ) ) {
		
		$split_lastname	= explode(' ', $lastname );
		$last_index     = count( $split_lastname ) - 1;      
		$lastname       = $split_lastname[ $last_index ];
	}

	update_post_meta( $post_id, '_lastname', $lastname );
}