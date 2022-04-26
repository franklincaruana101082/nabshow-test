<?php
/*
 * Template Name: Content Grouping Page
 * Description: List Articles
*/

get_header();

$introClass = '';
if(get_field('header_lighting_effects')) {
    $introClass = '_lighting';
}
function standardListItem($item_id,$item_link) {
    $post_type = get_post_type($item_id);
    $author_id = get_post_field ('post_author', $item_id);
    $author_name = get_the_author_meta('first_name', $author_id) . ' ' . get_the_author_meta('last_name', $author_id);
    $article_date = get_the_date('', $item_id);
    $image_id = get_post_thumbnail_id($item_id);
    if($image_id){
        $image['url'] = get_the_post_thumbnail_url($item_id);
        $image['alt'] = get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);
    }
    
    $title = get_the_title($item_id);
    $lede = wp_trim_words( get_the_excerpt($item_id) );
    
    if(!empty($item_link)) {
?>
<a href="<?php echo esc_url($item_link); ?>" class="relatedlink _minor">
    <?php if(!empty($image)) { ?>
    <div class="relatedlink__image">
        <img class="" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
    </div>
    <?php } else { ?>
        <div class="relatedlink__image"></div>
    <?php } ?>
    <div class="relatedlink__copy">
    <?php if(!empty($article_date)) { ?>
        <div class="relatedlink__category"><?php echo esc_html($article_date); ?></div>
    <?php } ?>
    <?php if(!empty($title)) { ?>
        <h3 class="relatedlink__headline"><?php echo esc_html($title); ?></h3>
    <?php } ?>
    <?php if(!empty($lede)) { ?>
        <div class="relatedlink__lede"><?php echo esc_html($lede); ?></div>
    <?php } ?>
    <?php if(!empty($author_name) && $post_type == 'articles') { ?>
        <div class="relatedlink__author"><?php echo esc_html($author_name); ?></div>
    <?php } ?>
    </div>
</a>
<?php } 
}
?>

<main id="primary" class="site-main grouping content-grouping_php">
<header class="intro grouping__intro <?php echo esc_attr($introClass); ?>">
    <?php if(get_field('header_ad_shortcode')) { ?>
    <div class="nab-ad-block header_ad">
        <?php echo do_shortcode(get_field('header_ad_shortcode')); ?>
    </div>
    <?php } ?>
    <div class="container">
        <?php the_title( '<h1 class="intro__title" data-swiftype-index="false">', '</h1>' ); ?>
        <div class="introtext"><?php the_content(); ?></div>
        <?php
        if( have_rows('promo_lists')):  

            while(have_rows('promo_lists')) : the_row();
        
            if( have_rows('header_promo_section')): 
            $count = 0;
        ?>
        <section class="grouping__promo">
            <?php while(have_rows('header_promo_section')) : the_row(); 
                $link_url = get_sub_field('link');
                $link_wp_id = url_to_postid( $link_url );
                $post_type = get_post_type($link_wp_id);
                $author_id = get_post_field ('post_author', $link_wp_id);
                $author_name = get_the_author_meta('first_name', $author_id) . ' ' . get_the_author_meta('last_name', $author_id);
                $image = get_sub_field('image');
                if(empty($image)){
                    $image_id = get_post_thumbnail_id($link_wp_id);
                    if($image_id){
                        $image['url'] = get_the_post_thumbnail_url($link_wp_id);
                        $image['alt'] = get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);
                    }
                }
                $title = get_sub_field('title');
                if(empty($title)) {
                    $title = get_the_title($link_wp_id);
                }
                $category = get_sub_field('category');
                $lede = get_sub_field('lede');
                if(empty($lede)) {
                    $lede = wp_trim_words( get_the_excerpt($link_wp_id) );
                }
                if(!empty($link_url)) {
            ?>
                <a href="<?php echo esc_url($link_url); ?>" class="relatedlink <?php if($count !== 0) { echo esc_attr('_minor'); } ?>">
                    <?php if(!empty($image)) { ?>
                    <div class="relatedlink__image">
                        <img class="" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                    </div>
                    <?php } ?>
                    <div class="relatedlink__copy">
                    <?php if(!empty($category)) { ?>
                        <h5 class="relatedlink__category"><?php echo esc_html($category); ?></h5>
                    <?php } ?>
                    <?php if(!empty($title)) { ?>
                        <h3 class="relatedlink__headline"><?php echo esc_html($title); ?></h3>
                    <?php } ?>
                    <?php if($count == 0 && !empty($lede)) { ?>
                        <div class="relatedlink__lede"><?php echo esc_html($lede); ?></div>
                    <?php } ?>
                    <?php if(!empty($author_name) && $post_type == 'articles') { ?>
                        <div class="relatedlink__author"><?php echo esc_html($author_name); ?></div>
                    <?php } ?>
                    </div>
                </a>
            <?php } 
            $count++;
            endwhile; ?>
        </section>
        <?php
            endif;
            if(get_sub_field('promo_ad_shortcode')){
            ?>
            <div class="nab-ad-block grouping__promoad">
            <?php
                echo do_shortcode(get_sub_field('promo_ad_shortcode'));
            ?>
            </div>
            <?php
            }
            endwhile;
        endif;
        ?>
    </div>
</header><!-- .page-header -->
<div class="main">
    <div class="container">
        <?php if(get_field('above_content_lists_ad_shortcode')) { ?>
        <div class="nab-ad-block">
            <?php echo do_shortcode(get_field('above_content_lists_ad_shortcode')); ?>
        </div>
        <?php } ?>
        <?php if(have_rows('content_lists')): 
            while(have_rows('content_lists')) : the_row(); 
                $listTitle = get_sub_field('list_title');
                $listSubtitle = get_sub_field('list_subtitle');
                $listAd = get_sub_field('list_ad_shortcode');
                $content_subject = get_sub_field('content_subject');

                if($listTitle) {
            ?>
            <h2 class="grouping__listTitle"><?php echo esc_html($listTitle); ?></h2>
            <?php }
                if($listSubtitle) { 
            ?>
            <p class="grouping__listSubtitle"><?php echo esc_html($listSubtitle); ?></p>
            <?php 
                }

                if(!empty($content_subject) || have_rows('link_list')) {
            ?>
        <div class="nabcard">
            <div class="nabcard__content grouping__list">
            <?php

                if(!empty($content_subject)) {
                    $meta_query = array(
                        'relation' => 'OR'
                    );
                    foreach($content_subject as $subject) {
                        $meta_query[] = array(
                            'key' => 'content_subject',
                            'value' => $subject,
                            'compare' => 'LIKE'
                        );
                    }
                    $args = array(
                        'posts_per_page' => -1,
                        'post_type' => 'articles',
                        'meta_query' => $meta_query,
                    );
                    $content_subject_list = new WP_Query( $args );
                    if( $content_subject_list->have_posts() ) {

                        while ( $content_subject_list->have_posts() ) : $content_subject_list->the_post(); 
                            $link_wp_id = $post->ID;
                            $link_url = get_permalink();

                            standardListItem($link_wp_id,$link_url);

                        endwhile; 
                    }
                    wp_reset_query();
                }

            if( have_rows('link_list')): 
            
                while(have_rows('link_list')) : the_row(); 
                    $link_url = get_sub_field('link');
                    $link_wp_id = url_to_postid( $link_url );

                    standardListItem($link_wp_id, $link_url);

                endwhile; 
            endif;
            ?>
            </div>
        </div>
        <?php
        }
            if($listAd) {
        ?>
        <div class="nab-ad-inner">
            <div class="nab-ad-block body_ad"><?php echo do_shortcode($listAd); ?></div>
        </div>
        <?php }
            endwhile;
        endif;
        ?>
    </div><!--.container -->
</div><!--.main-->
</main>

<?php get_footer(); ?>