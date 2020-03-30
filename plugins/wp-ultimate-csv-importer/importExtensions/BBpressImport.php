<?php

/******************************************************************************************
 * Copyright (C) Smackcoders. - All Rights Reserved under Smackcoders Proprietary License
 * You can contact Smackcoders at email address info@smackcoders.com.
 *******************************************************************************************/

namespace Smackcoders\FCSV;

if (!defined('ABSPATH'))
	exit; // Exit if accessed directly

class BBPressImport
{
	private static $bbpress_instance = null;

	public static function getInstance()
	{
		if (BBPressImport::$bbpress_instance == null) {
			BBPressImport::$bbpress_instance = new BBPressImport;
			return BBPressImport::$bbpress_instance;
		}
		return BBPressImport::$bbpress_instance;
    }
    
    public function set_bbpress_values($header_array, $value_array, $map, $post_id, $type){
        $post_values = [];
		$helpers_instance = ImportHelpers::getInstance();
		$post_values = $helpers_instance->get_header_values($map, $header_array, $value_array);

		$this->bbpress_values_import($post_values, $post_id, $type, $header_array ,$value_array);
    }

    public function bbpress_values_import($post_values, $post_id, $type, $header_array ,$value_array){
        global $wpdb;
       if($type== 'forum'){
        $forum_type = isset($post_values['_bbp_status']) ? $post_values['_bbp_status'] : 'open';
        $forum_status = isset($post_values['_bbp_forum_type']) ? $post_values['_bbp_forum_type'] : 'forum';
        update_post_meta($post_id, '_bbp_status', $forum_type);
            update_post_meta($post_id, '_bbp_forum_type', $forum_status);
        if(isset($post_values['post_parent']) ||isset($post_values['Visibility'])){
           	
            if(isset($post_values['post_parent'])){
                if(!is_numeric($post_values['post_parent'])){
                    $post_parent_title = $post_values['post_parent'];
                    $post_parent_id = $wpdb->get_var("SELECT ID FROM {$wpdb->prefix}posts WHERE post_title = '$post_parent_title' AND post_type = 'forum'");
                    $post_values['post_parent'] = $post_parent_id;
                }
            }
           
            $forum_parent = isset($post_values['post_parent']) ? $post_values['post_parent'] : '';
            $forum_visibility = isset($post_values['Visibility']) ? $post_values['Visibility'] : 'public';
            $forums = array(
                'ID'           => $post_id,
                'post_parent'   => $forum_parent,
                'post_status' => $forum_visibility,
            );
            wp_update_post($forums);
        }

       }
       if($type== 'topic'){
        if(isset($post_values['_bbp_forum_id']) ||isset($post_values['topic_status'])||isset($post_values['author'])){
            if(isset($post_values['_bbp_forum_id'])){
                if(!is_numeric($post_values['_bbp_forum_id'])){
                    $forum_title = $post_values['_bbp_forum_id'];
                    $forum_id = $wpdb->get_var("SELECT ID FROM {$wpdb->prefix}posts WHERE post_title = '$forum_title' AND post_type = 'forum'");
                    $post_values['_bbp_forum_id'] = $forum_id;
                }
            }
            $topic_status = isset($post_values['topic_status']) ? $post_values['topic_status'] : 'open';  
            $forum_id = isset($post_values['_bbp_forum_id']) ? $post_values['_bbp_forum_id'] : '';  
            $author = isset($post_values['author']) ? $post_values['author'] : ''; 
            $author_id = $wpdb->get_var("SELECT ID FROM {$wpdb->prefix}users WHERE user_login = '$author'");
            $topics = array(
                'ID'           => $post_id,
                'post_parent'   => $forum_id,
                'post_status' => $topic_status,
                'post_author' =>$author_id,
            );
            $topic[]=wp_update_post($topics);
        }
       if(isset($post_values['_bbp_author_ip'])){
        $author_ip = isset($post_values['_bbp_author_ip']) ? $post_values['_bbp_author_ip'] : '';
            update_post_meta($post_id, '_bbp_author_ip',$author_ip);
        }
        if(isset($post_values['topic_type'])){
            $type=$post_values['topic_type'];
            switch ($type) {
                case 'sticky':
                    update_post_meta($forum_id,'_bbp_sticky_topics',$topic);
                case 'super sticky':
                    update_option( '_bbp_super_sticky_topics',$topic);
        }

        }
       }
       if($type== 'reply'){
            if(isset($post_values['forum_name']) ||isset($post_values['status'])||isset($post_values['author'])){  
                if(isset($post_values['forum_name'])){
                    if(!is_numeric($post_values['forum_name'])){
                        $forum_title = $post_values['forum_name'];
                        $forum_id = $wpdb->get_var("SELECT ID FROM {$wpdb->prefix}posts WHERE post_title = '$forum_title' AND post_type = 'forum'");
                        $post_values['forum_name'] = $forum_id;
                    }
                }
                
                $topic_status = isset($post_values['reply_status']) ? $post_values['reply_status'] : 'open';  
                $forum_id = isset($post_values['_bbp_forum_id']) ? $post_values['_bbp_forum_id'] : '';
                $author = isset($post_values['reply_author']) ? $post_values['reply_author'] : ''; 
                $author_id = $wpdb->get_var("SELECT ID FROM {$wpdb->prefix}users WHERE user_login = '$author'");
                $topics = array(
                    'ID'           => $post_id,
                    'post_parent'   => $forum_id,
                    'post_status' => $topic_status,
                    'post_author' =>$author_id,
                );
                wp_update_post($topics); 
            }
            if(isset($post_values['_bbp_author_ip'])||isset($post_values['topic_name'])){
                if(isset($post_values['_bbp_topic_id'])){
                    if(!is_numeric($post_values['_bbp_topic_id'])){
                        $topic_title = $post_values['_bbp_topic_id'];
                        $topic_id = $wpdb->get_var("SELECT ID FROM {$wpdb->prefix}posts WHERE post_title = '$topic_title' AND post_type = 'topic'");
                        $post_values['_bbp_topic_id'] = $topic_id;
                    }
                }
                $topic_id = isset($post_values['_bbp_topic_id']) ? $post_values['_bbp_topic_id'] : '';  
                $author_ip = isset($post_values['_bbp_author_ip']) ? $post_values['_bbp_author_ip'] : '';
                    update_post_meta($post_id, '_bbp_author_ip',$author_ip);
                    update_post_meta($post_id, '_bbp_topic_id',$topic_id);
                    update_post_meta($post_id, '_bbp_forum_id',$forum_id);
                }
       }
    }
}