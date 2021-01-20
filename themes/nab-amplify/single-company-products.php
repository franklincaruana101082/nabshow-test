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
        $company_id      = get_field('nab_selected_company_id');
        $user_logged_in  = is_user_logged_in();
        $product_copy    = get_field('product_copy');
        $author_full_name = get_the_author_meta('first_name', $current_user_id[0]) . ' ' . get_the_author_meta('last_name', $current_user_id[0]);
        $product_point_of_contact = get_field('product_point_of_contact');
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
                <?php echo do_shortcode('[bookmark]'); ?>
            </header><!-- .entry-header -->



            <div class="post-action-wrap">
                <div class="post-action-author">
                    <?php echo do_shortcode('[nab_display_author]'); ?>
                </div>
                <div class="post-action-reaction">
                    <?php echo do_shortcode('[reaction_button]'); ?>
                </div>
            </div>

            <div class="nab-preview-slider-main">
                <div class="nab-preview-slider-inner">
                    <?php $product_medias = get_field('product_media');

                    if (!empty($product_medias)) {
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
                                        <li><a href="<?php echo site_url().'/?s='.$tag->name; ?>" class="btn"><?php echo $tag->name; ?></a></li>
                                    <?php } ?>

                                </ul>
                            </div>
                        <?php }
?>
                    </div>
                    <div class="single-product-col right-col">
                   
                        <div class="black-bg-box author-details-box">
                        <?php
                    
                    if ($product_point_of_contact !== '' && !empty($product_point_of_contact)) {
                        //get images
                        $user_images = nab_amplify_get_user_images($product_point_of_contact); ?>   
                        <div class="author-info">
                                <div class="author-image">
                                    <a href="<?php echo bp_core_get_user_domain($product_point_of_contact); ?>"><img src="<?php echo esc_url($user_images['profile_picture']) ?>" /></a>
                                </div>
                                <div class="author-details">
                                    <h3 class="author-title"><a href="<?php echo bp_core_get_user_domain($product_point_of_contact); ?>"><?php echo nab_get_author_fullname($product_point_of_contact); ?></a></h3>
                                    <span class="author-subtitle"><?php echo get_user_meta($product_point_of_contact, 'attendee_title', true); ?></span>
                                </div>
                            </div>
                    <?php
                    } ?>        
                            <div class="author-info-content">
                                <?php if ($product_point_of_contact !== '' && !empty($product_point_of_contact)) { ?>
                                <p><?php echo get_the_author_meta('description', $product_point_of_contact); ?></p>
                                <?php } ?>
                                <div class="action-wrap">
                                    <div><a href="<?php echo get_the_permalink(get_field('nab_selected_company_id')); ?>" class="button">View company profile</a></div>
                                    <?php if ($user_logged_in) { ?>
                                        <div>
                                            <div id="send-private-message" class="generic-button poc-msg-btn">
                                                <a href="javascript:void(0);" class="button add" data-feathr-click-track="true" data-comp-id="<?php echo get_field('nab_selected_company_id'); ?>">Message Company Rep</a></div>
                                        </div>
                                    <?php }else{
                                         $current_url = home_url( add_query_arg( NULL, NULL ) );
                                         $current_url = str_replace( 'amplify/amplify', 'amplify', $current_url );
                                        ?>
                                        <div>
                                            <div id="send-private-message" class="generic-button">
                                                <a href="<?php echo esc_url( add_query_arg( array( 'r' => $current_url ), wc_get_page_permalink( 'myaccount' ) ) ); ?>" class="button add" data-feathr-click-track="true" data-comp-id="<?php echo get_field('nab_selected_company_id'); ?>">Message Company Rep</a></div>
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
                                $product_read_more_url = get_field('product_learn_more_url');
                                if (!empty($product_read_more_url)) {
                            ?>
                                    <a class="btn blue-bg" href="<?php echo $product_read_more_url; ?>" target="_blank">Learn more</a>

                            <?php
                                }
                            } ?>
                        </div>
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
                                    $product_medias     = get_field('product_media');
                                ?>
                                    <div class="amp-item-col">
                                        <div class="amp-item-inner">
                                            <div class="amp-item-cover">
                                            <?php $thumbnail_url = '';

                                                if (!empty($product_medias[0]['product_media_file'])) {
                                                    $thumbnail_url = $product_medias[0]['product_media_file']['url'];
                                                } else {
                                                    $thumbnail_url =  !empty($thumbnail_url) ?  $thumbnail_url : nab_product_company_placeholder_img();
                                                } ?>
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
