import './block/multipurpose-gutenberg-block/block';
import './block/slider/block';
import './block/button/block';
import './block/Heading/block';
import './block/image/block';
import './block/image-with-text/block';
//import './block/schedule-block/block';
import './block/quotes/block';
import './block/not-to-be-missed/block';
import './block/latest-show-news/block';
//import './block/accordion/block';
//import './block/meet-the-team/block';
//import './block/awards-block/block';
import './block/advertisement/block';
//import './block/custom-block/block';
import './block/related-content/block';
import './block/contributors/block';
import './block/new-this-year/block';
import './block/delegation/block';
import './block/products-winners-award/block';
import './block/photos/block';
import './block/badge-discounts/block';
import './block/registration-passes/block';
import './block/official-vendor/block';
import './block/news-conference-schedule/block';
import './block/opportunities/block';
import './block/exhibitor-advisory-committee/block';
import './block/related-content-with-block/block';
import './block/videos/block';
import './block/featured-image/block';
//import './block/media-partners/block';

wp.domReady( function() {
    wp.blocks.unregisterBlockType( 'yoast/how-to-block' );
    wp.blocks.unregisterBlockType( 'yoast/faq-block' );
} );

(function () {
    const nabShowIcon = (
        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="25px" height="25px" viewBox="0 0 72 72" enable-background="new 0 0 72 72" >
        <image id="image0" width="72" height="72" x="0" y="0" href="data:image/png;base64,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" />
    </svg>
    );
    wp.blocks.updateCategory('nabshow', { icon: nabShowIcon });
  })();