<?php

    class Woo_MS_Search 
        {

            private $pieces         =   array();
            
            private $hash           =   '';
                        
            private $blog_id;
            private $table_prefix   =   '';
            
            private $query;
            private $posts;
            private $found_posts;
            private $max_num_pages;
            private $posts_per_page;            
            
            public  $functions;
            public  $licence;
            
            private $in_loop_blog_switched  =   FALSE;
            
            
            
            /**
            * Constructor
            * 
            */
            function __construct()
                {
                    
                    $this->functions    =   new Woo_MS_Search_Functions();   
                    $this->licence      =   new Woo_MS_Search_licence();
                    
                }
                
                
            
            /**
            * Starter
            * 
            */
            function init()
                {
                    
                    add_action('posts_results',     array( $this, 'woomssearch_posts_results') , 99, 2);        
                    add_filter('posts_clauses',     array( $this, 'woomssearch_posts_clauses'), 99 , 2);
                    
                    add_action('woocommerce_shop_loop',             array( $this, 'woocommerce_shop_loop'), -999);
                    add_action('woocommerce_after_shop_loop',       array( $this, 'woocommerce_after_shop_loop'), -999);
                    
                }
                
                
                
            /**
            * Add the new set of posts to the query
            * 
            * @param mixed $posts
            * @param mixed $query
            */
            function woomssearch_posts_results( $posts, $query )
                {
                    
                    if  ( ! $this->apply_for_query( $query ) )
                        return $posts;
                    
                    $query_pieces   =   $this->get_pieces();
                    
                    /**
                    * Process the internal pieces
                    * 
                    * @var {Woo_MS_Search|Woo_MS_Search}
                    */
                    $this->process( $query);
                    
                    /**
                    * Add the results to default query
                    * 
                    * @var Woo_MS_Search
                    */
                    $this->set_data( $query );
                    
                    return $query->posts;

                }
                        
            
            /**
            * Retrieve the query clauses for later usage
            * 
            * @param mixed $pieces
            * @param mixed $query
            */
            function woomssearch_posts_clauses ($pieces, $query)
                {
                    
                    if  ( ! $this->apply_for_query( $query ) )
                        return $pieces;   
                    
                    $this->set_pieces( $pieces );
                    $this->set_posts_per_page_limit( $query );
                    
                    return $pieces;
                }
            
            
            /**
            * Save the pieces for later usage
            * 
            * @param mixed $pieces
            */
            public function set_pieces( $pieces )
                {
                    
                    $this->pieces       =   $pieces;
                    
                    global $blog_id, $wpdb;
                    
                    $this->blog_id      =   $blog_id;
                    $this->table_prefix =   $wpdb->prefix;
                    
                }
                
            
            /**
            * Set the limit value parsed from query
            *     
            * @param mixed $limit
            */
            public function set_posts_per_page_limit( $query )
                {
                    
                    $limit  =   isset( $query->query_vars['posts_per_page'] )   ?   $query->query_vars['posts_per_page']    :   '';
                    
                    if  ( $limit > 0 )
                        $this->posts_per_page    =     $limit;
                        else
                        $this->posts_per_page    =     get_option( 'posts_per_page' );
                       
                }
                
            
            
            /**
            * Check if the code should apply for a given query
            *             * 
            */
            public function apply_for_query( $query )
                {
                    
                    if ( ! $query->is_search() )
                        return FALSE;
                    
                    if ( ! isset($query->query_vars['post_type']))
                        return FALSE;
                        
                    if ( is_array($query->query_vars['post_type'])  &&  ( count ( $query->query_vars['post_type'] ) !== 1 ||  array_search('product', $query->query_vars['post_type'])  === FALSE ))
                        return FALSE;
                        else
                        if ( $query->query_vars['post_type'] != 'product' )
                        return FALSE;
                        
                    return TRUE;
                    
                }
                
                
            /**
            * Retrieve the pieces for post processing
            * 
            */
            public function get_pieces()
                {
                    
                    return $this->pieces;   
                }
                
                
            
            /**
            * Process the pieces
            * 
            */
            public function process( $wp_query )
                {
                    
                    $this->decode();
                    $this->add_table_hash();
                    $this->build_mysql_query( $wp_query );
                    
                    $this->run_query( $wp_query );
                       
                    
                }
                
            
            
            /**
            * decode the pieces
            *     
            */
            private function decode()
                {
                    
                    foreach ( $this->pieces as  $key    =>  $value )
                        {
                            $this->pieces[ $key ]   =   apply_filters( 'query', $value );
                        }   
                    
                }
                
            
            
            /**
            * Replace table prefix with a hash, on pieces
            *     
            */
            private function add_table_hash()
                {
                    
                    $hash   =   $this->get_hash();
                        
                    foreach ( $this->pieces as  $key    =>  $value )
                        {
                            $this->pieces[ $key ]   =   preg_replace("/([ (\'\"\`]+)?(". $this->table_prefix  .")/i", '$1'.$hash , $value );
                        }    
                    
                }
                
                
            
            /**
            * Return the hash
            * 
            */
            private function get_hash()
                {
                    
                    if ( empty ( $this->hash ) )
                        $this->generate_hash();
                                        
                    return $this->hash;
                
                }
                
            
            /**
            * Generate a hash
            * 
            */
            private function generate_hash()
                {
                    $this->hash =   '%' .   substr( md5( time() ), 0, 10)  .   '%';
                }
                
                
            
            /**
            * Generate the query to retrieve the results from all shops
            *     
            */
            private function build_mysql_query( $wp_query )
                {
                    
                    global $wpdb;
                    
                    $orderby_value = isset( $_GET['orderby'] ) ? wc_clean( (string) wp_unslash( $_GET['orderby'] ) ) : wc_clean( get_query_var( 'orderby' ) ); // WPCS: sanitization ok, input var ok, CSRF ok.

                    if ( ! $orderby_value ) 
                        {
                            if ( is_search() ) 
                                {
                                    $orderby_value = 'relevance';
                                } 
                            else 
                                {
                                    $orderby_value = apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby', 'menu_order' ) );
                                }
                        }

                    // Get order + orderby args from string.
                    $orderby_value  =   explode( '-', $orderby_value );
                    $orderby        =   esc_attr( $orderby_value[0] );
                    $order          =   ! empty( $orderby_value[1] ) ? $orderby_value[1] : 'ASC';
                    
                    $orderby        =   strtolower( $orderby );
                    $order          =   strtoupper( $order );
                    
                    $search_phrase  =   $wp_query->query['s'];
                                        
                    //check for meta
                    $meta_key   =   '';
                    if  ( count ( $wp_query->meta_query->queries ) > 0 )
                        {
                            
                            $meta_queries   =   $wp_query->meta_query->queries;
                            foreach  ( $meta_queries    as  $key    =>  $data ) 
                                {
                                    if ( ! is_int($key) )
                                        unset( $meta_queries[$key] );
                                }
                            
                            if ( count ( $meta_queries ) === 1 )
                                {
                                    reset($meta_queries);
                                    $meta_key       =   current($meta_queries)['key'];
                                }
                        }
                       
                    $this->query    =   'SELECT SQL_CALC_FOUND_ROWS *';
                    $this->query    .=  ' FROM (';
                        
                    $all_shops      =   $this->functions->get_woo_shops();
                    $first_union    =   TRUE;
                    
                    foreach ( $all_shops as  $shop )
                        {
                            switch_to_blog( $shop->blog_id );
                            
                            $shop_prefix =  $wpdb->prefix;
                            
                            $pieces =   $this->pieces;
                            
                            if  ( ! empty ( $meta_key ))
                                {
                                    $pieces['fields']   .=  ', meta_value AS ' . $meta_key;   
                                }
                                
                            if  (   $orderby    ==  'price'  )
                                {
                                    $pieces['fields']   .=  ', price_query.price as price';
                                }
                                                                                
                            foreach ( $pieces as  $key    =>  $value )
                                {
                                    $pieces[ $key ]   =   str_replace( $this->hash, $shop_prefix, $value);
                                }
                            
                            if  ( $first_union ) 
                                $first_union    =   FALSE;
                                else
                                $this->query    .=   ' UNION ALL ';
                            
                            $this->query    .=   ' (' .  $this->populate_query ( $pieces )  .   ')';
                            
                            restore_current_blog();
                        }
                        
                        
                    $this->query    .=   ' ) results'; 
                    
                    //add the order and limitation
                    if  ( ! empty ( $meta_key ))
                        {
                            switch  ( $orderby )
                                {
                                    case 'popularity':
                                            //allready filled through $meta_key above
                                            
                                            $order          =   ! empty( $orderby_value[1] ) ? $orderby_value[1] : 'DESC';
                                            $order          =   strtoupper( $order );
                                            
                                            break;
                                        case 'rating':
                                            //allready filled through $meta_key above
                                            
                                            $order          =   ! empty( $orderby_value[1] ) ? $orderby_value[1] : 'DESC';
                                            $order          =   strtoupper( $order );
                                            
                                            break;
                                }
                            
                            $this->query    .=   ' ORDER BY ' . $meta_key . ' ' . $order;
                        }
                        else
                            {
                                switch  ( $orderby )
                                    {
                                        case 'id':
                                            $this->query    .=   ' ORDER BY ID ' . $order;
                                            break;
                                        case 'menu_order':
                                            $this->query    .=   ' ORDER BY menu_order, post_title ' . $order;
                                            break;
                                        case 'title':
                                            $this->query    .=   ' ORDER BY title ' . $order;
                                            break;
                                        case 'rand':
                                            $this->query    .=   ' ORDER BY rand()';
                                            break;
                                        case 'date':
                                            $order          =   ! empty( $orderby_value[1] ) ? $orderby_value[1] : 'DESC';
                                            $order          =   strtoupper( $order );
                                            $this->query    .=   ' ORDER BY post_date ' . $order;
                                            break;
                                        case 'price':
                                            $this->query    .=   ' ORDER BY price ' . $order .', ID ' . $order;
                                            break;
                                        case 'popularity':
                                            //allready filled through $meta_key above                                            
                                            break;
                                        case 'rating':
                                            //allready filled through $meta_key above
                                            break;
                                            
                                        default:
                                            //this is the default
                                            $this->query    .=   " ORDER BY post_title LIKE '%".$search_phrase."%' " . $order .', post_date ' . $order;
                                            break;                                          
                                    }
                            }
                                            
                    $this->query    .=   ' ' . $this->pieces['limits'];
                    
                }
              
            /**
            * Popuate the query with pre-saved pieces
            *     
            * @param mixed $base_query
            */
            private function populate_query ( $pieces )
                {
                    global $wpdb, $blog_id;
                        
                    $where      = isset( $pieces[ 'where' ] )     ? $pieces[ 'where' ] : '';
                    $groupby    = isset( $pieces[ 'groupby' ] )   ? $pieces[ 'groupby' ] : '';
                    $join       = isset( $pieces[ 'join' ] )      ? $pieces[ 'join' ] : '';
                    $orderby    = isset( $pieces[ 'orderby' ] )   ? $pieces[ 'orderby' ] : '';
                    $distinct   = isset( $pieces[ 'distinct' ] )  ? $pieces[ 'distinct' ] : '';
                    $fields     = isset( $pieces[ 'fields' ] )    ? $pieces[ 'fields' ] : '';
                    $limits     = isset( $pieces[ 'limits' ] )    ? $pieces[ 'limits' ] : ''; 
                    
                    if ( ! empty( $pieces[ 'groupby' ] ) )
                        $groupby = 'GROUP BY ' . $pieces[ 'groupby' ];
                                 
                    $query      =   "SELECT $found_rows $distinct $fields, $blog_id AS blog_id FROM {$wpdb->posts} $join WHERE 1=1 $where $groupby";
                    
                    return  $query;  
                    
                    
                }
                
                
            /**
            * Run the query
            *     
            */
            private function run_query( $wp_query )
                {
                    
                    global $wpdb;
                    
                    $this->posts            =   $wpdb->get_results( $this->query );   
                    
                    $this->found_posts      =   $wpdb->get_var( apply_filters_ref_array( 'found_posts_query', array( 'SELECT FOUND_ROWS()', $wp_query ) ) );
                    $this->max_num_pages    =   ceil( $this->found_posts / $this->posts_per_page );
                    
                }
                
                
            /**
            * Set the procedded data to query
            * 
            */
            public function set_data( &$wp_query )
                {
                    
                    $wp_query->posts            =   $this->posts;
                    $wp_query->found_posts      =   $this->found_posts;
                    $wp_query->max_num_pages    =   $this->max_num_pages;
                      
                }
                
                
                
            function woocommerce_shop_loop()
                {
                    
                    global $post;
                    
                    if  ( isset( $post->blog_id ) ) 
                        { 
                            if ( $this->in_loop_blog_switched   === TRUE )
                                restore_current_blog();
                                
                            switch_to_blog ($post->blog_id);
                            $this->in_loop_blog_switched   =    TRUE;
                        }
                        else
                        {
                            if ( $this->in_loop_blog_switched   === TRUE )
                                {
                                    $this->in_loop_blog_switched   =    FALSE;
                                    restore_current_blog();
                                }
                        }
                        
                    
                }
                
                
            function woocommerce_after_shop_loop()
                {
                    
                    if ( $this->in_loop_blog_switched   === TRUE )
                        {
                            $this->in_loop_blog_switched   =    FALSE;
                            restore_current_blog();
                        }
                    
                }
            
            
        }


?>