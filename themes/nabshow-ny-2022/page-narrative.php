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
            <div class="story-steps">
                <?php
                if ( $story_steps ) {

                    while(have_rows('story_steps')) : the_row(); 
                        
                        $story_image = get_sub_field('image');//isset( $row['image']['ID'] ) && ! empty( $row['image']['ID'] ) ? wp_get_attachment_url( $row['image']['ID'] ) : '';
                        ?>
                        <div class="story-step-wrapper">
                            <div class="container">
                                <div class="story-step">
                                    <div class="story-step-body">
                                        <h3><?php echo esc_html( get_sub_field('title') ); ?></h3>
                                        <div class="wysiwyg-typography">
                                            <?php echo wp_kses_post( get_sub_field('body') ); ?>
                                        </div>
                                    </div>
                                    <div class="story-step-media">                                    
                                        <img src="<?php echo esc_url( $story_image['url'] ); ?>" alt="<?php echo esc_attr( $stroy_image['alt'] ); ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    endwhile;
                }
                ?>
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
    <div class="section--black">
        <div class="container">
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
    </div>
    <?php
}


    
$closing_cta      = get_field( 'closing_cta' );
$closing_cta_copy = get_field( 'closing_cta_copy' );
if ( $closing_cta || $closing_cta_copy ) {
    ?>
    <div class="section container">
        <div class="closing__content">
            <a href="<?php echo esc_url($closing_cta['url']); ?>" class="closing__button button _xxl _solid _white _border">
                <?php echo esc_html($closing_cta['title']); ?>
            </a>
            <?php echo wp_kses_post($closing_cta_copy); ?>
        </div>
    </div>
    <?php
}
?>

<?php if( get_the_content() ): ?>
<div class="section container generic">
    <?php the_content(); ?>
</div>
<?php endif; 

get_footer();