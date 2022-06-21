<?php
/**
 * NABShow 2022 functions and definitions
 *
 */


function nabshow_2022_enqueue_styles() {
    wp_enqueue_style( 'nabshow-2022', 
    	get_stylesheet_directory_uri().'/style.css'
    );
    wp_enqueue_style( 'nabshow-2022-theme', 
        get_stylesheet_directory_uri().'/assets/css/styles.min.css'
    );
    wp_enqueue_script( 'nabshow-2022-main', get_stylesheet_directory_uri() . '/assets/js/app.min.js', array(), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'nabshow_2022_enqueue_styles', 101 );

function nabshow_2022_swiftype_script() {
    $swiftype_key = 'xR-5CQfLTC5vmf-SyuiJ';
    ?>
    <script type="text/javascript">
      (function(w,d,t,u,n,s,e){w['SwiftypeObject']=n;w[n]=w[n]||function(){
      (w[n].q=w[n].q||[]).push(arguments);};s=d.createElement(t);
      e=d.getElementsByTagName(t)[0];s.async=1;s.src=u;e.parentNode.insertBefore(s,e);
      })(window,document,'script','//s.swiftypecdn.com/install/v2/st.js','_st');
      
      _st('install','<?php echo($swiftype_key); ?>','2.0.0');
    </script>
    <?php
}

add_action('wp_footer', 'nabshow_2022_swiftype_script');
