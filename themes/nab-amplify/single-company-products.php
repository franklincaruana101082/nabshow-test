<?php

/**
 * The template for displaying all single company product
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Amplify
 */

get_header();

?>

<main id="primary" class="site-main single_php">
    <?php
    while (have_posts()) :
        the_post();
        $current_user_id = get_field('company_user_id', get_field('nab_selected_company_id'));
        $user_logged_in  = is_user_logged_in();
        $product_copy    = get_field('product_copy');
        $author_full_name = get_the_author_meta('first_name', $current_user_id[0]) . ' ' . get_the_author_meta('last_name', $current_user_id[0]);
        if (empty(trim($author_full_name))) {

            $author_full_name = get_the_author();
        }
        $preview_main_src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
    ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <?php
                the_title('<h1 class="entry-title">', '</h1>');
                ?>
                <h4 class="entry-subtitle">Posted by <a href="<?php echo bp_core_get_user_domain($current_user_id[0]); ?>"><?php echo esc_html($author_full_name); ?></a></h4>
                <?php echo do_shortcode( '[bookmark]' ); ?>
            </header><!-- .entry-header -->

            <?php
                // if (bp_members()) {

                //     bp_the_member();

                //     $member_user_id = bp_get_member_user_id();
                //     $user_full_name = bp_get_member_name();
                //     if (empty(trim($user_full_name))) {
                //         $user_full_name = get_the_author_meta('first_name', $member_user_id) . ' ' . get_the_author_meta('last_name', $member_user_id);
                //     }

                //     $company = get_user_meta($member_user_id, 'attendee_company', true);
                //     $ctitle = get_user_meta($member_user_id, 'attendee_title', true);
                //     $company = $ctitle ? $ctitle . ' | ' . $company : $company;

                //     $user_images        = nab_amplify_get_user_images($member_user_id);
                //     $member_profile_url = bp_get_member_permalink();
                // }
            ?>

            <div class="post-action-wrap">
                <div class="post-action-author">
                    <?php echo do_shortcode( '[nab_display_author]' ); ?>
                </div>
                <div class="post-action-reaction">
                    <?php echo do_shortcode( '[reaction_button]' ); ?>
                </div>
            </div>

            <div class="nab-preview-slider-main">
                <div class="nab-preview-slider-inner">
                    <?php $product_medias = get_field('product_media');
                    
                    if (!empty($product_medias)){
                        foreach ($product_medias as $key => $product_media) {
                            if (!empty($product_media['product_media_file'])) {

                                if ($key == 0) {
?>
                    <div class="nab-preview-main">
                    <img src="<?php echo $product_media['product_media_file']['url']; ?>" alt="">
                </div>
                <?php
                                }
                            }
                        }  
                    }
                    ?>

              
            <?php
            

                    if (!empty($product_medias) &&  count($product_medias) >= 2) { ?>

                        <div class="nab-preview-items-main">
                            <?php
                            foreach ($product_medias as $key => $product_media) {
                                if (!empty($product_media['product_media_file'])) {
                             ?>

                                    <div class="nab-preview-item">
                                        <img src="<?php echo $product_media['product_media_file']['url']; ?>" alt="">
                                    </div>

                        <?php

                                }
                            }
                         ?>
                        </div>
                        <?php
                    }
                        $tags = get_the_terms(get_the_ID(), 'company-product-tag');

                        ?>


                </div>
            </div>

            <div class="single-product-content">
                <div class="single-product-main">
                    <div class="single-product-col left-col">
                        <?php echo $product_copy ? the_field('product_copy') : '';
                        if (!empty($tags)) {
                        ?>
                            <div class="amp-tag-main">
                                <ul class="amp-tag-list">
                                    <?php foreach ($tags as $tag) { ?>
                                        <li><a href="<?php echo get_term_link($tag->term_id); ?>" class="btn"><?php echo $tag->name; ?></a></li>
                                    <?php } ?>

                                </ul>
                            </div>
                        <?php }



                        // Get images.
                        $user_images = nab_amplify_get_user_images($current_user_id[0]);
                        ?>
                    </div>
                    <div class="single-product-col right-col">
                        <div class="black-bg-box author-details-box">
                            <div class="author-info">
                                <div class="author-image">
                                    <a href="<?php echo bp_core_get_user_domain($current_user_id[0]); ?>"><img src="<?php echo esc_url($user_images['profile_picture']) ?>" /></a>
                                </div>
                                <div class="author-details">
                                    <h3 class="author-title"><a href="<?php echo bp_core_get_user_domain($current_user_id[0]); ?>"><?php echo nab_get_author_fullname($current_user_id[0]); ?></a></h3>
                                    <span class="author-subtitle"><?php echo get_user_meta($current_user_id[0], 'attendee_title', true); ?></span>
                                </div>
                            </div>
                            <div class="author-info-content">
                                <p><?php echo get_the_author_meta('description', $current_user_id[0]); ?></p>
                                <div class="action-wrap">
                                    <div><a href="<?php echo get_the_permalink(get_field('nab_selected_company_id')); ?>" class="button">View company profile</a></div>
                                    <?php if ($user_logged_in) { ?>
                                        <div>
                                            <div id="send-private-message" class="generic-button">
                                                <a href="javascript:void(0);" class="button add" data-feathr-click-track="true" data-comp-id="<?php echo get_field('nab_selected_company_id'); ?>">Message Company Rep</a></div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="black-bg-box product-specs-box">
                            <h2>Product Specs</h2>
                            <?php $product_specs = get_field('product_specs');
                            if (!empty($product_specs)) {
                                echo $product_specs;
                            } ?>
                        </div>

                        <?php
                        $product_read_more_url = get_field('product_learn_more_url');
                        if (!empty($product_read_more_url)) {
                        ?>
                            <div class="black-bg-box product-specs-box">
                                <a class="btn blue-bg" href="<?php echo $product_read_more_url; ?>">Learn more</a>
                            </div>
                        <?php
                        } ?>

                        <div class="ad-wrapper">

                        </div>
                    </div>


                </div>
            </div>
            <div class="company-products related-content">

                <?php

                if ($tags) {
                ?>

                    <?php
                    $first_tag = $tags[0]->term_id;
                    $args      = array(
                        'post_type'      => 'company-products',
                        'post__not_in'   => array(get_the_ID()),
                        'tax_query'      => array(
                            array(
                                'taxonomy' => 'company-product-tag',
                                'field'    => 'id',
                                'terms'    => $first_tag,
                            ),
                        ),
                        'posts_per_page' => '3',
                    );
                    $my_query = new WP_Query($args);
                    if ($my_query->have_posts()) { ?>
                        <div class="amp-item-main">
                            <div class="amp-item-heading">
                                <h3>Related Products</h3>
                            </div>
                            <div class="amp-item-wrap" id="company-products-list">
                                <?php
                                while ($my_query->have_posts()) : $my_query->the_post();
                                    $thumbnail_url    = has_post_thumbnail() ? get_the_post_thumbnail_url() : nab_placeholder_img();
                                    $product_link     = get_the_permalink();
                                    $product_category = get_the_terms(get_the_ID(), 'company-product-category');
                                ?>
                                    <div class="amp-item-col">
                                        <div class="amp-item-inner">
                                            <div class="amp-item-cover">
                                                <img src="<?php echo esc_url($thumbnail_url); ?>" alt="Product Image">
                                            </div>
                                            <div class="amp-item-info">
                                                <div class="amp-item-content">
                                                    <h4>
                                                        <a href="<?php echo esc_url($product_link); ?>"><?php echo esc_html(get_the_title()); ?></a>
                                                    </h4>
                                                    <?php
                                                    if (!empty($product_category) && !is_wp_error($product_category)) {

                                                    ?>
                                                        <span class="product-company"><?php echo esc_html($product_category[0]->name); ?></span>
                                                    <?php
                                                    }
                                                    ?>
                                                    <div class="amp-actions">
                                                        <div class="search-actions nab-action">
                                                            <a href="<?php echo esc_url($product_link); ?>" class="button">View Product</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                endwhile; ?>
                            </div>
                        </div>
            </div>
        <?php
                    }
                    wp_reset_query();
        ?>

    <?php
                } ?>

    <footer class="entry-footer">
        <?php nab_amplify_entry_footer(); ?>
    </footer><!-- .entry-footer -->
        </article><!-- #post-<?php the_ID(); ?> -->
    <?php
        // If comments are open or we have at least one comment, load up the comment template.
        if (comments_open() || get_comments_number()) :
            comments_template();
        endif;

    endwhile; // End of the loop.
    ?>

</main><!-- #main -->

<?php
get_footer();
