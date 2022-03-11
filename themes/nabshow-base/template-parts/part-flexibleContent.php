<?php
$flex_content_settings = array(
  'blocks'        => $flex_content_blocks
);
// error_log(print_r($flex_content_settings['blocks'], 1));
if ( is_array($flex_content_settings['blocks']) ) :
  $prev_row_settings = array(
    'anchor'   => '',
    'bg'       => '',
    'tb'       => '',
  );
  $block_count = count($flex_content_settings['blocks']);
  foreach ( $flex_content_settings['blocks'] as $block_key => $block ) :
    $row_settings = array(
      'anchor'   => $block['anchor'],
      'bg'       => $block['background_treatment'],
      'tb'       => $block['top_border'],

    );
    $next_block_key = $block_key + 1;
    if ( $next_block_key < $block_count ) :
      $next_block = $flex_content_settings['blocks'][$next_block_key];
      $next_row_settings = array(
        'anchor'   => $next_block['anchor'],
        'bg'       => $next_block['background_treatment'],
        'tb'       => $next_block['top_border'],
      );
    else:
      $next_row_settings = array(
        'anchor'   => '',
        'bg'       => '',
        'tb'       => '',
      );
    endif;
    $flex_row_class = 'section__row';

    if ( $row_settings['tb'] ) :
      $flex_row_class .= ' _lightlines-strip';
    endif;

    if ( $row_settings['bg'] ) :
      $flex_row_class .= ' _'.$row_settings['bg'];
    endif;

    $row_id = '';
    if ( $row_settings['anchor'] !== '' ) :
      $row_id = 'id="' . sanitize_title($row_settings['anchor']) . '"';
    endif;

    $prev_row_settings = $row_settings;
    ?>
    <section class="<?php echo $flex_row_class; ?>" <?php echo $row_id; ?>>
      <?php
      switch ( $block['acf_fc_layout'] ) :
        case 'hero_content' :
          $hero_settings = array(
            'icon'       => $block['icon'],
            'subhead'    => $block['subhead'],
            'headline'   => $block['headline'],
            'hero_image' => $block['hero_image'],
            'hero_copy'  => $block['hero_copy'],
            'ctas'       => $block['ctas'],
          );
          include ( locate_template( 'template-parts/part-heroContent.php', false, false ) );
          break;
        case 'feature_links' :
          $flinks_settings = array(
            'title'      => $block['title'],
            'intro_copy' => $block['intro_copy'],
            'links'      => $block['links'],
          );
          include ( locate_template( 'template-parts/part-featureLinks.php', false, false ) );
          break;
        case 'prominent_link' :
          $plink_settings = array(
            'title'   => $block['title'],
            'image'   => $block['image'],
            'caption' => $block['image_caption'],
            'copy'    => $block['copy'],
            'link'    => $block['link'],
          );
          include ( locate_template( 'template-parts/part-prominentLink.php', false, false ) );
          break;
        case 'session_links' :
          $slinks_settings = array(
            'sessions_links_title' => $block['sessions_links_title'],
            'session_tracks'       => $block['session_tracks'],
            'session_categories'   => $block['session_categories'],
            'manual_sessions'      => $block['manual_sessions'],
          );
          include ( locate_template( 'template-parts/part-sessionLinks.php', false, false ) );
          break;
        default:
          # code...
          break;

      endswitch;
      ?>
    </section><!-- end .section__row -->
    <?php
  endforeach;
endif;
?>