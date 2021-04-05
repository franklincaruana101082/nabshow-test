<?php

/**
 * Template part for displaying content for my bookmarks page.
 *
 * @package Amplify
 */

$user_id            = filter_input( INPUT_GET, 'user_id', FILTER_SANITIZE_NUMBER_INT );
$profile_url        = bp_core_get_user_domain( $user_id );
$current_user_id    = get_current_user_id();

if ( empty( $user_id ) || 0 === $user_id ) {

    $user_id = $current_user_id;
}

$member_bookmarks = get_user_meta( $user_id, 'nab_customer_product_bookmark', true );

if ( ! empty( $member_bookmarks ) && is_array( $member_bookmarks ) && count( $member_bookmarks ) > 0 ) {

    $bookmark_query_args = array(
        'post_type'         => array( 'product', 'company-products', 'articles' ),
        'posts_per_page'    => 12,
        'post_status'       => 'publish',
        'post__in'          => $member_bookmarks
    );

    $bookmark_query = new WP_Query( $bookmark_query_args );

    if ( $bookmark_query->have_posts() ) {

        $total_bookmarks = $bookmark_query->found_posts;
        ?>
        <div class="member-bookmark">
            <div class="amp-item-main">
                <div class="amp-item-heading">
                    <h3>BOOKMARKS</h3>
                </div>
                <div class="amp-item-wrap" id="bookmark-list">
                    <?php

                    $bookmark_img   = nab_placeholder_img();
                    $cnt            = 0;

                    while ( $bookmark_query->have_posts() ) {

                        $bookmark_query->the_post();

                        $bookmark_id        = get_the_ID();
                        $bookmark_thumbnail = nab_amplify_get_featured_image( $bookmark_id, true, $bookmark_img );
                        $bookmark_link      = get_the_permalink();

                        ?>
                        <div class="amp-item-col">
                            <div class="amp-item-inner">
                                <div class="amp-item-cover">
                                    <img src="<?php echo esc_url( $bookmark_thumbnail ); ?>" alt="Bookmark Image">
                                    <span class="fa fa-bookmark-o amp-bookmark bookmark-fill"></span>
                                </div>
                                <div class="amp-item-info">
                                    <div class="amp-item-content">
                                        <h4>
                                            <a href="<?php echo esc_url( $bookmark_link ); ?>"><?php echo esc_html( get_the_title() ); ?></a>
                                        </h4>
                                        <div class="amp-actions">
                                            <div class="search-actions">
                                                <a href="<?php echo esc_url( $bookmark_link ); ?>" class="btn">Read More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php

                        $cnt++;

                        if ( 8 === $cnt ) {
                            echo wp_kses_post( nab_get_search_result_ad() );
                        }
                    }
                    if ( $cnt < 8 ) {
                        echo wp_kses_post( nab_get_search_result_ad() );
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
    } else {
        ?>
        <div id="message" class="info">
            <p>Sorry, no bookmarks were found.</p>
        </div>
        <?php
    }

    if ( $bookmark_query->max_num_pages > 1 ) {
        ?>
        <div class="load-more text-center"  id="load-more-bookmark">
            <a href="javascript:void(0);" class="btn-default" data-user="<?php echo esc_attr( $user_id ); ?>" data-page-number="2" data-post-limit="15" data-total-page="<?php echo absint( $bookmark_query->max_num_pages ); ?>">Load More</a>
        </div>
        <?php
    }

    wp_reset_postdata();

} else {
    ?>
    <div id="message" class="info">
        <p>Sorry, no bookmarks were found.</p>
    </div>
    <?php
}
