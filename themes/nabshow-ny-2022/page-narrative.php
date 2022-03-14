<?php
/**
* Template Name: Narrative
 */

get_header();

$page_subtitle              = get_field( 'page_subtitle' );
$display_feature_text_block = get_field( 'display_feature_text_block' );
$display_story_steps        = get_field( 'display_story_steps' );
$display_logo_banner        = get_field( 'display_logo_banner' );
$display_faq_section        = get_field( 'display_faq_section' );
$display_ad_section         = get_field( 'display_ad_section' );
?>
<div class="intro _lightlines-strip">
    <div class="container intro__container">
        <h1 class="intro__label"><?php echo esc_html( get_the_title() ); ?></h1>
        <h2 class="intro__title"><?php echo esc_html( $page_subtitle ); ?></h2>
    </div>
</div>
<div class="section container">
    <?php dynamic_sidebar('broadstreet-internal-top'); ?>
</div>
<?php
if ( $display_feature_text_block ) {
    
    $feature_text_title = get_field( 'feature_text_title' );
    $feature_text_body  = get_field( 'feature_text_body' );
    ?>
    <div class="section container feature-text__wrap">
        <div class="feature-text wysiwyg-typography">
            <h2><?php echo esc_html( $feature_text_title ); ?></h2>
            <?php echo wp_kses_post( $feature_text_body ); ?>
        </div>
        <div class="feature-text__ad">
            <?php dynamic_sidebar('broadstreet-ros-middle-square'); ?>
        </div>
    </div>
    <?php
}

if ( $display_story_steps ) {
    
    $story_steps = get_field( 'story_steps' );
    ?>
    <div class="section">
        <div class="story-steps-wrapper">
            <div class="container">
                <div class="story-steps">
                    <?php
                    if ( $story_steps ) {

                        foreach ( $story_steps as $row ) {
                            
                            $story_image = isset( $row['image']['ID'] ) && ! empty( $row['image']['ID'] ) ? wp_get_attachment_url( $row['image']['ID'] ) : '';
                            ?>
                            <div class="story-step">
                                <div class="story-step-body">
                                    <span class="story-step-counter"><?php echo esc_html( $row['counter'] ); ?></span>
                                    <h3><?php echo esc_html( $row['title'] ); ?></h3>
                                    <div class="wysiwyg-typography">
                                        <?php echo wp_kses_post( $row['body'] ); ?>
                                    </div>
                                </div>
                                <div class="story-step-media">                                    
                                    <img src="<?php echo esc_url( $story_image ); ?>" alt="<?php echo esc_attr( $row['image_alt'] ); ?>" />
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>    
            </div>
            <div class="section container">
                <?php dynamic_sidebar('broadstreet-ros-middle'); ?>
            </div>
        </div>
    </div>
    <?php
}

if ( $display_logo_banner ) {
    
    $logo_banner_image      = get_field( 'logo_banner_image' );
    $logo_banner_image_alt  = get_field( 'logo_banner_image_alt' );
    $logo_banner_body       = get_field( 'logo_banner_body' );
    $logo_banner_url        = isset( $logo_banner_image['ID'] ) && ! empty( $logo_banner_image['ID'] ) ? wp_get_attachment_url( $logo_banner_image['ID'] ) : '';
    ?>
    <div class="section container">
        <div class="logo-banner">
            <div class="logo-banner-media">
                <img src="<?php echo esc_url( $logo_banner_url ); ?>" alt="<?php echo esc_attr( $logo_banner_image_alt ); ?>" />
                <div class="logo-banner-ad">
                    <?php dynamic_sidebar('broadstreet-ros-middle-square'); ?>
                </div>
            </div>
            <div class="logo-banner-body wysiwyg-typography">
                <?php echo wp_kses_post( $logo_banner_body ); ?>
            </div>
        </div>
    </div>
    <?php
}

if ( $display_faq_section ) {
    
    $faq_section_title  = get_field( 'faq_section_title' );
    $faq_section_body   = get_field( 'faq_section_body' );
    $faqs               = get_field( 'faqs' );
    ?>
    <div class="section container">
        <div class="faq-section">
            <div class="faq-section-body wysiwyg-typography">
                <h3><?php echo esc_html( $faq_section_title ); ?></h3>
                <?php echo wp_kses_post( $faq_section_body ); ?>
            </div>
            <div class="faq-section-faqs">
                <?php
                if ( $faqs ) {
                    ?>
                    <ul class="faqs">
                        <?php
                        foreach ( $faqs as $row ) {
                            
                            ?>
                            <li class="faq">
                                <h4><button class="faq-toggle" aria-expanded="false"><?php echo esc_html( $row['title'] ); ?></button></h4>
                                <div class="faq-content" hidden>
                                    <?php echo wp_kses_post( $row['body'] ); ?>
                                    <a class="button _arrow _alt _full _small" href="<?php echo esc_url( $row['cta_url'] ); ?>"><?php echo esc_html( $row['cta_text'] ); ?></a>
                                </div>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                    <?php
                }
                ?>                
            </div>
        </div>
    </div>
    <?php
}

if ( $display_ad_section ) {
    
    $ad_section_title           = get_field( 'ad_section_title' );
    $ad_section_body            = get_field( 'ad_section_body' );
    $ad_section_ad_embed_code   = get_field( 'ad_section_ad_embed_code' );
    ?>
    <div class="section container">
        <div class="ad-section">
            <div class="ad-section-body wysiwyg-typography">
                <h2 class="h-xl"><?php echo esc_html( $ad_section_title ); ?></h2>
                <?php echo $ad_section_body; ?>
            </div>
            <div class="ad-section-ad">
                <?php echo do_shortcode( $ad_section_ad_embed_code ); ?>
            </div>
        </div>
    </div>
    <?php
}
?>

<?php if( get_the_content() ): ?>
<div class="section container generic">
    <?php the_content(); ?>
</div>
<?php endif; ?>

<div class="section container">
    <?php dynamic_sidebar('broadstreet-ros-bottom'); ?>
</div>
<?php

get_footer();