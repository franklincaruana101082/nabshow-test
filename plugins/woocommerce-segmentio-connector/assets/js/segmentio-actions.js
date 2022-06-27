// Load analytics.js with your API key, which will automatically load all of the
// analytics integrations you've turned on for your account. Boosh!
function wooSegmentioSendData(data) {
  try {
    var segmentio = JSON.parse(data);
    // Load Analytics.js with your key, which will automatically
    // load the tools you've enabled for your account. Boosh!
    if (segmentio.async == "no") {
      analytics.load(segmentio.api_key);
    } else {
      jQuery(window).on('load',function () {
        analytics.load(segmentio.api_key);
      });
    }

    // Make the first page call to load the integrations. If
    // you'd like to manually name or tag the page, edit or
    // move this call however you'd like.
    analytics.page();

    // only for logged_in users.
    if (segmentio.logged_in != undefined && segmentio.logged_in == 1) {
      analytics.alias(segmentio.user_id);
      analytics.identify(
        segmentio.user_id,
        segmentio.traits,
        segmentio.options
      );
    }

    if (
      segmentio.event != "" &&
      segmentio.event != undefined &&
      segmentio.event != null
    ) {
      analytics.track(segmentio.event, segmentio.properties, segmentio.options);
    }
  } catch (e) {
    console.log("JavaScript Error: " + e.message);
  }
}
