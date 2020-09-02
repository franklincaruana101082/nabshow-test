=== WooCommerce Segment.com Connector ===
Contributors: niravmehta, ratnakar.dubey, Tarun.Parswani, Mansi Shah
Donate link: https://www.storeapps.org/
Tags: woocommerce, analytics, segment.com, connector
Requires at least: 3.5
Tested up to: 5.3.0
Stable tag: 1.9.2

Tracks Wordpress & WooCommerce's activity & send data to Segment.com

== Description ==

Integrate the power of Segment.com into your WooCommerce store. WooCommerce Segment.com Connector provides you easiest way to integrate analytics to your WooCommerce store.

This extension allows you to add any analytics service to your WooCommerce store. This extension does it automatically and you don't need any coding skills for that.

Segment.com lets you send your analytics data to AdRoll, BitDeli, BugHeard, bugsnag, Chartbeat, ClickTale, Clicky, Comscore, Countly, Crazyegg, Crtittercism, Customer.io, Errorception, Flurry, Foxmetricks, Guages, Google Analytics, GoSquared, Heap, Help Scout, HitTail, HubSpot, Improvely, Intercom, Keen.io, KISSmetrics, Klaviyo, Librato, LiveChat, Localytics, Lytics, Marketo, Mixpanel, Olark, Ominture, Optimizely, Outbound, Pardot, Perfect Audience, Pingdom, Preact, Qualaroo, Quantcast, Salesforce, Sentry, SnapEngage, Totango, USERcycle, Userfox, UserVoice, Vero, Visual Website Optimizer, Woopra, Webhooks, without having to integrate with each and every one, saving you time.

You can connect your store with all these service with just one API.

Segment.com has the power to store your analytics data for later use. You don't need to import your old data to services, Segment.com automatically pusshes your entire history to those services.

== Installation ==

1. Ensure you have latest version of [WooCommerce](https://wordpress.org/plugins/woocommerce/) plugin installed
2. Unzip and upload the folder 'woocommerce-segmentio-connector' to your `/wp-content/plugins/` directory
3. Activate 'WooCommerce Segment.com Connector' through the 'Plugins' menu in WordPress

== Usage ==

How to start tracking activities of WooCommerce store
1. You need to enter & save your Segment.com's API key in WooCommerce Integration settings, otherwise no event will be sent to Segment.com
2. Go to 'WooCommerce -> Settings' & look for 'Segment.com Connector' link under 'Integration' tab.
3. Put your Segment.com API key in field provided on that page & click 'Save changes'.
4. That's it! Now activities on your site will be tracked & these data will be sent to Segment.com

Note: By default these events will be tracked: Registration form, New user registered, Logged in, Logged out, Viewed account, Password changed, Address updated, Track post, Track page, Track archive, Track searche, Viewed product, Added to cart, Removed from cart, Viewed cart, Coupon applied, Checkout started, Calculated shipping, Payment started, Completed purchase, Viewed order, Tracked order, File downloaded, Re-ordered, Order cancelled, Commented, Reviewed product

== Developer Guide ==

= How to track events from third party plugin =

For tracking any event you need these 4 data:
Event name (required)
Event data (optional)
User id (optional)
Users data (optional)

Once have these data, you can use following code in any php file of that third party plugin.

<code>
<?php
	$event_name = 'sample event';
	$event_data = array( 'title' => 'product title' );
	$user_id = 5;
	$user_data = array( 'dob' => '01-01-1990' );

	do_action( 'woocommerce_segmentio_connector_log_activity', $event_name, $event_data, $user_id, $user_data );
?>
</code>

== Frequently Asked Questions ==

= Events are not being tracked. I can't see any data in Segment.com =

Please check whether you've enetered & saved your Segment.com API key.

= Can I track additional events (from third party extensions)? =

Yes, it is very easy to track additional events which are not included in this extension. You just need to call a function with some data. Please refer developer guide for details.
