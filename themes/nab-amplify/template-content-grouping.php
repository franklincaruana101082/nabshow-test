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
?>

<main id="primary" class="site-main grouping content-grouping_php">
<header class="intro grouping__intro <?php echo esc_attr($introClass); ?>">
    <?php if(get_field('above_content_lists_ad_shortcode')) { ?>
    <div class="nab-ad-block header_ad">
        <?php echo do_shortcode(get_field('header_ad_shortcode')); ?>
    </div>
    <?php } ?>
    <div class="container">
        <?php the_title( '<h1 class="intro__title">', '</h1>' ); ?>
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
                    $lede = get_the_excerpt($link_wp_id);
                }
                if(!empty($link_url)) {
            ?>
                <a href="<?php echo esc_url($link_url); ?>" class="relatedlink <?php if($count !== 0) { echo esc_attr('_minor'); } ?>">
                    <?php if(!empty($image)) { ?>
                    <div class="relatedlink__image" style="background-image: url('<?php echo esc_url($image['url']); ?>');">
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

                if($listTitle) {
            ?>
            <h2 class="grouping__listTitle"><?php echo esc_html($listTitle); ?></h2>
            <?php }
                if($listSubtitle) { 
            ?>
            <p class="grouping__listSubtitle"><?php echo esc_html($listSubtitle); ?></p>
            <?php 
                }
            if( have_rows('link_list')): 
        ?>
        <div class="nabcard">
            <div class="nabcard__content grouping__list">
                <?php while(have_rows('link_list')) : the_row(); 
                    $link_url = get_sub_field('link');
                    $link_wp_id = url_to_postid( $link_url );
                    $post_type = get_post_type($link_wp_id);
                    $author_id = get_post_field ('post_author', $link_wp_id);
                    $author_name = get_the_author_meta('first_name', $author_id) . ' ' . get_the_author_meta('last_name', $author_id);
                    $article_date = get_the_date('', $link_wp_id);
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
                    $lede = get_sub_field('lede');
                    if(empty($lede)) {
                        $lede = get_the_excerpt($link_wp_id);
                    }
                    if(!empty($link_url)) {
                ?>
                <a href="<?php echo esc_url($link_url); ?>" class="relatedlink _minor">
                    <?php if(!empty($image)) { ?>
                    <div class="relatedlink__image" style="background-image: url('<?php echo esc_url($image['url']); ?>');">
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
                endwhile; ?>
            </div>
        </div>
        <?php
            endif;
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