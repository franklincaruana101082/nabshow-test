<?php
/*
 * Template Name: Message Confirmation
 */

global $post;
$collective_speaking_event = get_post_meta( $post->ID, 'collective_speaking_event', true );
?>

<!DOCTYPE html>
<html class="premiere">
<head>
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/favicon.ico" type="image/x-icon">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="robots" content="noindex,follow">

    <title>NAB Amplify: Confirmation Page</title>
    <style>

        body {
            background-color: #404040!important;
            color: #fff;
            font-family: 'Open Sans', sans-serif;
            font-size: 16px;
            margin: 0;
            padding: 0;
            position: relative;
        }

        body * {
            box-sizing: border-box;
        }

        #screen {
            min-height: 100vh;
            position: relative;
            width: 100%;
        }

        .mktopagecontent{
            position:relative;
        }

        .site-content .container{
            width: 100%!important;
            max-width: 100%!important;
        }

        #content {
            display: table;
            height: 100%;
            padding: 50px;
            position: relative;
            width: 100%;
            z-index: 9;
        }

        #content > * {
            display: table-cell;
            vertical-align: middle;
        }


        #content > * > * {
            display: block;
            margin: 0 auto;
            max-width: 1200px;
            text-align: center;
        }

        #brand {
            margin: 30px auto;
        }


        #brand img {
            max-width: 300px;
        }

        #content h1 {
            color: #fdd80f;
            font-size: 600%;
            line-height: 1;
            margin: 20px 0 20px 0;
            z-index: 9;
        }

        #content p {
            margin: 0 0 10px 0;
            color: #fff;
        }

        a,
        a:visited {
            color: #fdd80f;
            transition: all 0.8s ease-in-out;
        }

        a:hover {
            color: #e5018b;
        }

        em {
            color: #fdd80f;
            font-style: normal;
        }

        sup {
            line-height: 0;
            position: relative;
            font-size: 20%;
        }

        sub {
            vertical-align: baseline;
        }

        sup {
            display: inline-block;
            margin-top: 20px;
            vertical-align: top;
        }

        p sup {
            margin-top: 7px;
            font-size: 40%;
        }

        #background,
        #transparency {
            position: absolute;
            height: 100%;
            left: 0;
            top: 0;
            width: 100%;
        }

        #transparency {
            background: rgba(0, 0, 0, 0.5);
            z-index: 8;
        }


        #background {
            position: absolute;
            z-index: 0;
        }

        #background img {
            height: 100%;
            object-fit: cover;
            -o-object-fit: cover;
            opacity: 0.4;
            top: 0;
            width: 100%;
        }

        #marketo-form {
            margin: 40px auto 40px auto;
        }

        .framing {
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        #screen form {
            width: 100% !important;
        }

        #screen .mktoForm .mktoOffset {
            width: 0 !important;
        }

        #screen form .mktoFormRow {
            display: inline-block;
            width: 50% !important;
        }


        #screen form .mktoFormRow:nth-of-type(3) {
            display: inline-block;
            margin: 0px auto;
            width: 100% !important;
        }

        #screen form .mktoFormRow:nth-of-type(3) > * {
            float: none;
            margin: 0 auto;
            width: 50% !important;
        }

        #screen .mktoButtonRow {
            margin: 0;
            text-align: center;
            width: 100% !important;
        }

        #screen form .mktoFormRow > * {
            padding: 0 5px;
            width: 100% !important;
        }

        #screen .mktoForm .mktoFieldWrap {
            width: 100% !important;
        }

        #screen form label {
            display: none;
        }

        #screen form .mktoGutter {
            width: 0 !important;
        }

        #screen form input {
            padding: 10px 17px;
            width: 100% !important;
        }

        #screen .mktoForm .mktoButtonWrap.mktoSimple .mktoButton {
            background-color: #e5018b;
            background-image: none;
            border: 0;
            border-radius: 8px;
            color: #fff;
            font-size: inherit;
            padding: 10px 30px;
        }


        #screen .mktoButtonWrap.mktoSimple {
            margin-left: 0 !important;
        }

        #showcase {
            display: flex;
            margin: 0 auto;
            max-width: 800px;
            width: 100%;
            justify-content: center;
        }

        #showcase > * {
            margin: 0 0 30px 0;
            padding: 40px 20px;
            width: 50%;
        }

        #showcase > * img {
            display: block;
            margin: 0 auto 30px auto;
            max-width: 230px;
            max-height: 90px;
        }

        @-webkit-keyframes rotating /* Safari and Chrome */
        {
            from {
                -webkit-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            to {
                -webkit-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @keyframes rotating {
            from {
                -ms-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -webkit-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            to {
                -ms-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -webkit-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        #brand img {
            -webkit-animation: rotating 75s linear infinite;
            -moz-animation: rotating 75s linear infinite;
            -ms-animation: rotating 75s linear infinite;
            -o-animation: rotating 75s linear infinite;
            animation: rotating 75s linear infinite;
        }


        @media screen and (max-width: 800px) {

            #content h1 {
                font-size: 500%;
            }

        }


        @media screen and (max-width: 700px) {

            #showcase {
                display: block;
                margin: 0 auto;
                max-width: 600px;
                width: 100%;
            }

            #showcase > * {
                margin: 0 auto 30px auto;
                width: 100%;
            }

            #showcase > * img {
				max-width: 250px;
				max-height: 110px;
			}

        }


        @media screen and (max-width: 630px) {

            #content h1 {
                font-size: 400%;
            }


            #screen form .mktoFormRow {
                display: block;
                width: 100% !important;
            }

            #screen form .mktoFormRow:nth-of-type(3) > * {
                width: 100% !important;
            }

        }

        @media screen and (max-width: 510px) {

            #content h1 {
                font-size: 350%;
            }


        }

        @media screen and (max-width: 410px) {

            #content h1 {
                font-size: 280%;
            }

            #brand img {
                max-width: 220px;
            }

        }

        @media(max-width:480px){
            #content{
                padding: 40px;
            }
        }
        @media(max-width:400px){
            #content{
                padding: 30px;
            }
        }
        @media(max-width:350px){
            #content{
                padding: 20px;
            }
        }
        @media(max-width:350px){
            #content{
                padding: 10px;
            }
        }

    </style>

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,700;1,400&amp;display=swap" rel="stylesheet">

    <style id='mktoDesktopStyle'>
        .lpeCElement {
            position: absolute;
        }

        .imageSpan img {
            width: 100%;
            height: auto;
        }

    </style>
    <script>
	!function(){var analytics=window.analytics=window.analytics||[];if(!analytics.initialize)if(analytics.invoked)window.console&&console.error&&console.error("Segment snippet included twice.");else{analytics.invoked=!0;analytics.methods=["trackSubmit","trackClick","trackLink","trackForm","pageview","identify","reset","group","track","ready","alias","debug","page","once","off","on","addSourceMiddleware","addIntegrationMiddleware","setAnonymousId","addDestinationMiddleware"];analytics.factory=function(e){return function(){var t=Array.prototype.slice.call(arguments);t.unshift(e);analytics.push(t);return analytics}};for(var e=0;e<analytics.methods.length;e++){var key=analytics.methods[e];analytics[key]=analytics.factory(key)}analytics.load=function(key,e){var t=document.createElement("script");t.type="text/javascript";t.async=!0;t.src="https://cdn.segment.com/analytics.js/v1/" + key + "/analytics.min.js";var n=document.getElementsByTagName("script")[0];n.parentNode.insertBefore(t,n);analytics._loadOptions=e};analytics.SNIPPET_VERSION="4.13.1";
	analytics.load("Dm2tDeNs4wHRhA1D0dDSuO82R8hGvCM6");
	analytics.page();
	}}();
	</script>
</head>

<body id="bodyId">
<?php get_header(); ?>

<div class="mktopagecontent">
    <!-- screen -->
    <div id="screen" class="mktoContent">

        <!-- content -->
        <div id="content">

            <div class="wrap">
                <div class="inner">
                    <?php
                    if ( have_posts() ) :

                        while ( have_posts() ) :

                            the_post();

                            the_content();

                        endwhile; // End of the loop.
                    endif;

                    $page_id    = get_the_ID();
                    $rows       = get_field( 'event_details', $page_id );

                    if ( $rows ) {

                        ?>
                        <div id="showcase">
                            <?php
                            foreach( $rows as $row ) {

                                $event_logo     = $row[ 'event_logo' ];
                                $event_date     = $row[ 'event_date' ];
                                $event_link     = $row[ 'event_link' ];
                                $link_text      = $row[ 'event_link_text' ];
                                $display_event  = $row[ 'event_display' ];

                                if ( $display_event && $event_logo ) {
                                    ?>
                                    <div class="future">
                                        <img src="<?php echo esc_url( $event_logo[ 'url' ] ); ?>" alt="event-logo">
                                        <p>
                                        <?php
                                        echo esc_html( $event_date );

                                        if ( ! empty( $event_link ) ) {
                                            ?>
                                            <br><a href="<?php echo esc_url( $event_link ); ?>"><?php echo esc_html( $link_text ); ?></a>
                                            <?php
                                        }
                                        ?>
                                        </p>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>


    </div>
    <!-- content -->

    <!-- transparency -->
    <div id="transparency">


    </div>
    <!-- transparency -->

    <!-- background -->
    <div id="background">
        <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/spectral.png">
    </div>
    <!-- background -->
    </div>

<!-- screen -->
<script type="text/javascript" src="//munchkin.marketo.net//munchkin.js"></script>
<script>Munchkin.init('927-ARO-980', {customName: 'NAB21OV-Confirmation', wsInfo: 'j1RR'});</script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() ?>/assets/js/stripmkttok.js"></script>

<?php
get_sidebar();
get_footer();
?>
</body>
</html>

