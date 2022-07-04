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
			
			if ( ! empty( $channel ) && is_array( $channel ) ) {
				
				$channel_titles = array();

				foreach ( $channel as $ch ) {
					$channel_titles[] = get_the_title( $ch );
				}

				echo esc_html( implode( ', ', $channel_titles ) );
				
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
      
        $query->query_vars[ 'meta_key' ]	    = 'session_channel';
        $query->query_vars[ 'meta_value' ]		= '"' . $current_channel . '"';
		$query->query_vars[ 'meta_compare' ]	= 'LIKE';
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

/**
 * Set default layout/block in the new session
 */
function nabny_session_default_template() {
	
	global $pagenow;

	$current_post_type = filter_input( INPUT_GET, 'post_type', FILTER_SANITIZE_STRING );

	if ( 'post-new.php' === $pagenow && 'sessions' === $current_post_type ) {

		$block_template = array(
			array( 'nab/multipurpose-gutenberg-block', array(
					'elementID' => 'internal-banner',
					'backgroundImage' => 'https://nabshow.com/ny2020/wp-content/uploads/sites/5/2020/05/homepage-hero.jpg',
					'backgroundSize' => true,
					'layout' => 'full',
					'opacity' => 50,
					'marginTop' => '-40',
					'marginBottom' => '40',
					'ToggleInserter' => true
				),
				array(
					array( 'nab/multipurpose-gutenberg-block', array(
							'layout' => 'fixed',
							'paddingTop' => '40',
							'paddingBottom' => '20'
						),
						array(
							array( 'nab/nab-heading', array(
									'HeadingText' => 'Title',
									'HeadingLevel' => 'h1',
									'HeadingColor' => '#ffffff',
									'TextUppercase' => 'capitalize',
									'fontFamily' => 'Josefin Sans'
								)
							),
						)
					),
				)
			),
			array( 'core/block', array( 
					'ref' => 8681
				)
			),
			array( 'core/columns', array(), array(
				array( 'core/column', array( 'width' => 66.66 ), array(
					array( 'mys/session-info', array() ),
					array( 'core/spacer', array( 'height' => 30 ) ),
					array( 'mys/session-speaker-info', array( 'itemToFetch' => 95 ) ),
				) ),
				array( 'core/column', array( 'width' => 33.33 ), array(
					array( 'nab/multipurpose-gutenberg-block', array( 'className' => 'nabny-sidebar-calender-block-outer' ), array(
						array( 'mys/add-to-calendar', array() ),
					) ),
					array( 'core/spacer', array( 'height' => 20 ) ),
					array( 'mys/partners-sponsors-info', array() ),
				) ),
			) )

		);
		
		$page_type_object           = get_post_type_object( 'sessions' );
		$page_type_object->template = $block_template;		
	}	
}

/**
 * Register dynamic block.
 */
function nabny_register_dynamic_blocks() {
	
	register_block_type( 'nab/lead-gen-form', array(
			'attributes' => array(                
				'formEmail'  => array(
					'type' => 'string',
					'default' => ''
				)
			),
			'render_callback' => 'nabny_lead_gen_form_render_callback',
		)
	);
}


/**
 * Display only lead genration submission msg when form submitted.
 *
 * @param  string $content
 * 
 * @return string
 */
function nabny_display_lead_gen_submission_msg( $content ) {
    
    $form_nonce = filter_input( INPUT_POST, 'lead_details_nonce', FILTER_SANITIZE_STRING );

    if ( ! empty( $form_nonce ) && wp_verify_nonce( $form_nonce, 'lead_gen_form' ) ) {
        
        ob_start();
        
        ?>
        <div class="lead-form-confirmation">
            <p>Thank you for your submission. We'll be in touch shortly to schedule a conversation.</p>
            <a class="gobackbtn btn-primary" href="<?php echo esc_url( get_the_permalink() ); ?>">Go Back to Form</a>
        </div>
        <?php

        $content = ob_get_clean();
    }

    return $content;
}

/**
 * Lead genereation form block render callback.
 *
 * @param  array $attributes
 * 
 * @return string
 */
function nabny_lead_gen_form_render_callback( $attributes ) {

	$form_nonce = filter_input( INPUT_POST, 'lead_details_nonce', FILTER_SANITIZE_STRING );

    if ( ! empty( $form_nonce ) && wp_verify_nonce( $form_nonce, 'lead_gen_form' ) ) {
        
        $to_email       = filter_input( INPUT_POST, 'to_email', FILTER_SANITIZE_STRING );
        $full_name      = filter_input( INPUT_POST, 'full_name', FILTER_SANITIZE_STRING );                               
        $post_title     = trim( $full_name );
        $security_check = filter_input( INPUT_POST, 'security_check', FILTER_SANITIZE_STRING );
        $email          = filter_input( INPUT_POST, 'email', FILTER_SANITIZE_STRING );
        // $title          = filter_input( INPUT_POST, 'title', FILTER_SANITIZE_STRING );
        // $phone_number   = filter_input( INPUT_POST, 'phone_number', FILTER_SANITIZE_STRING );
        // $company        = filter_input( INPUT_POST, 'company', FILTER_SANITIZE_STRING );

        // Check Spam.
        $content['comment_author']       = $full_name;
        $content['comment_author_email'] = $email;
        // $content['comment_content']      = $title;
        // $content['comment_phone']        = $phone_number;
        // $content['comment_company']      = $company;
        $spam_detected                   = nabny_form_input_spam_check( $content );                

        $inserted_post_id   = wp_insert_post(
            array(
                'post_title'   => $post_title,
                'post_type'    => 'forms-data',
                'post_status'  => 'publish',
            )
        );

        if ( ! is_wp_error( $inserted_post_id ) ) {

            add_post_meta( $inserted_post_id, 'full_name', $full_name );
            // add_post_meta( $inserted_post_id, 'title', $title );
            // add_post_meta( $inserted_post_id, 'company', $company );
            add_post_meta( $inserted_post_id, 'email', $email );
            // add_post_meta( $inserted_post_id, 'phone_number', $phone_number );

            wp_set_object_terms( $inserted_post_id, 'lead-generation', 'forms-category' );

            if ( ! empty( $to_email ) ) {
                
                $message_body   = '<html><body>';
                $message_body   = '<table border="1" cellpadding="10"><tr><th>Fields</th><th>Details</th></tr>';
                $message_body   .= '<tr><td>Name</td><td>' . $full_name . '</td></tr>';
                //$message_body   .= '<tr><td>Title</td><td>' . $title . '</td></tr>';
                //$message_body   .= '<tr><td>Company</td><td>' . $company . '</td></tr>';
                $message_body   .= '<tr><td>Email</td><td>' . $email . '</td></tr>';
                //$message_body   .= '<tr><td>Phone Number</td><td>' . $phone_number . '</td></tr>';
                $message_body   .= '</table>';
                $message_body   .= '</body></html>';                    

                $headers = "From: NABShow <noreply@nabshow.com>\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

                $subject = 'Lead Generation Details';                    

                if ( empty( $security_check ) && false === $spam_detected ) {
                    wp_mail( $to_email, $subject, $message_body, $headers );
                }
            }
            add_filter( 'the_content', 'nabny_display_lead_gen_submission_msg' );            
        }

    }
    
    $form_email = isset( $attributes[ 'formEmail' ] ) && ! empty( $attributes[ 'formEmail' ] ) ? $attributes[ 'formEmail' ] : '';

    ob_start();
    ?>
    <form class="nab-form lead-gen-form" method="post">
        <div class="form-items-wrapper">
            <div class="form-item">
                <label class="control-label" for="lgf-full-name">Name <span class="form-required" title="This field is required.">*</span></label>
                <input required="required" pattern=".*\S+.*" class="form-control form-text" type="text" id="lgf-full-name" name="full_name" size="60" maxlength="128">
            </div>
           <!-- <div class="form-item">
                <label class="control-label" for="lgf-title">Title <span class="form-required" title="This field is required.">*</span></label>
                <input required="required" pattern=".*\S+.*" class="form-control form-text" type="text" id="lgf-title" name="title" size="60" maxlength="128">
            </div>-->
           <!-- <div class="form-item">
                <label class="control-label" for="lgf-company">Company <span class="form-required" title="This field is required.">*</span></label>
                <input required="required" pattern=".*\S+.*" class="form-control form-text" type="text" id="lgf-company" name="company" size="60" maxlength="128">
            </div>-->
            <div class="form-item">
                <label class="control-label" for="lgf-email">Email <span class="form-required" title="This field is required.">*</span></label>
                <input required="required" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,5}$" class="form-control form-text" type="email" id="lgf-email" name="email" size="60">
            </div>
            <!--<div class="form-item">                
                <label class="control-label" for="lgf-phone-number">Phone Number <span class="form-required" title="This field is required.">*</span></label>
                <input required="required" class="form-control form-text" pattern="[0-9]{1,50}" type="text" id="lgf-phone-number" name="phone_number" step="1">                
            </div>    -->        
            <div class="captcha">
                <div class="g-recaptcha" data-sitekey="6Lfwj9wSAAAAAGC50P7LPTXvapy4cdM6GuPJ5Zh3"></div>
                <p class="captcha-error" style="display: none; color:red;">Please check the recaptcha</p>
            </div>
            <?php wp_nonce_field( 'lead_gen_form', 'lead_details_nonce' ); ?>
            <input class="form-control form-text" type="text" id="contact-security-check" name="security_check" style="display: none">            
            <input type="hidden" name="to_email" value="<?php echo esc_attr( $form_email ); ?>" />
            <div class="form-actions">
                <button class="form-submit" type="submit" name="op" value="Submit">Submit</button>
            </div>
        </div>
    </form>
    <?php

    $html = ob_get_clean();

    wp_enqueue_script( 'google-recaptcha', 'https://www.google.com/recaptcha/api.js' );

    return $html;
}

/**
 * Enqueue gutenberg custom block script. 
 */
function nabny_add_block_editor_assets() {

	wp_enqueue_script( 'nabny-custom-gutenberg-block',
		get_stylesheet_directory_uri() . '/blocks/block.build.js',
		array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor', 'wp-components' ),
		'1.0'
    );
    
    wp_enqueue_style( 'nabny-block-style', get_stylesheet_directory_uri() . '/blocks/css/block.css' );
}

/**
 * Integrate Akismet to custom Form
 *
 * @param array $content Submitted Data.
 *
 * @return bool Spam or not.
 */
function nabny_form_input_spam_check( $content ) {

	// innocent until proven guilty
	$isSpam = false;

	$content = (array) $content;

	if ( function_exists( 'akismet_init' ) ) {

		$wpcom_api_key = get_option( 'wordpress_api_key' );

		if ( ! empty( $wpcom_api_key ) ) {

			global $akismet_api_host, $akismet_api_port;

			// set remaining required values for akismet api
			$content['user_ip']    = preg_replace( '/[^0-9., ]/', '', $_SERVER['REMOTE_ADDR'] );
			$content['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
			$content['referrer']   = $_SERVER['HTTP_REFERER'];
			$content['blog']       = get_option( 'home' );

			if ( empty( $content['referrer'] ) ) {
				$content['referrer'] = get_permalink();
			}

			$queryString = '';

			foreach ( $content as $key => $data ) {
				if ( ! empty( $data ) ) {
					$queryString .= $key . '=' . urlencode( stripslashes( $data ) ) . '&';
				}
			}

			$response = akismet_http_post( $queryString, $akismet_api_host, '/1.1/comment-check', $akismet_api_port );

			if ( $response[1] == 'true' ) {
				update_option( 'akismet_spam_count', get_option( 'akismet_spam_count' ) + 1 );
				$isSpam = true;
			}

		}

	}

	return $isSpam;

}

/**
 * Add group block to new pages.
 *
 * @link https://developer.wordpress.org/block-editor/developers/block-api/block-templates/
 */
function nabny_page_type_template() {

	global $pagenow;

	$current_post_type = filter_input( INPUT_GET, 'post_type', FILTER_SANITIZE_STRING );

	if ( 'post-new.php' === $pagenow && 'page' === $current_post_type ) {

		$block_ids = array( 10377, 8681, 8679 );

		$query_args = array(
			'post_type' => 'wp_block',
			'fields'    => 'ids',
			'post__in'  => $block_ids,
			'orderby'   => 'post__in'
		);

		$block_query = new WP_Query( $query_args );

		if ( $block_query->have_posts() ) {

			$block_ids = $block_query->posts;

			if ( is_array( $block_ids ) && count( $block_ids ) > 0 ) {

				$block_template = array();

				foreach ( $block_ids as $block_id ) {
					$block_template[] = [ 'core/block', ['ref' => $block_id ] ];
				}

				$page_type_object           = get_post_type_object( 'page' );
				$page_type_object->template = $block_template;
			}

		}
	}

}