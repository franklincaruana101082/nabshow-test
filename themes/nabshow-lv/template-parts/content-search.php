<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package NABShow_LV
 */

$current_post_id        = get_the_ID();
$current_post_type      = get_post_type( $current_post_id );
$search_post_type_list  = nabshow_lv_get_search_result_post_types();
$content_type           = isset( $search_post_type_list[ $current_post_type ] ) ? $search_post_type_list[ $current_post_type ] : ucfirst( $current_post_type );

$search_view_count      = get_post_meta( $current_post_id, 'search_view_count', true );
$search_view_count      = empty( $search_view_count ) ? 1 : $search_view_count + 1;

update_post_meta( $current_post_id, 'search_view_count', $search_view_count );

?>
<!-- Tab content -->
<div class="tabcontent">
    <div class="featuredImg">

        <?php

        $logo_url = '';

        if ( has_post_thumbnail() ) {

            $logo_url = get_the_post_thumbnail_url();

        } else {

            switch ( $current_post_type ) {

                case 'page':
	                $logo_url = nabshow_lv_get_empty_thumbnail_url();
	                break;
	            case 'sessions':
		            $logo_url = nabshow_lv_get_session_thumbnail_url();
		            break;
	            case 'speakers':
		            $logo_url = nabshow_lv_get_speaker_thumbnail_url();
		            break;
                default:
                    $logo_url = nabshow_lv_get_empty_thumbnail_url();
            }
        }
        ?>

        <img src="<?php echo esc_url( $logo_url ); ?>" alt="search-logo" />
    </div>
    <div class="tabInfo">
        <h3><?php nabshow_lv_get_search_result_post_link( $current_post_type, $current_post_id, get_the_title() ); ?></h3>
        <h4><?php echo esc_html( $content_type ); ?></h4>
        <p><?php echo esc_html( nabshow_lv_excerpt() ); ?></p>
    </div>
</div>
