# Segment Tracking Plugin

This plugin serves a couple purposes:

1. Creates a database table for queuing events that need to be sent to Segment. We want this so that we don't have to send data to Segment within the request/response lifecycle of a page.
2. Creates a cron job that periodically sends events in the database table to Segment.
3. Defines track events and the hooks they should be fired after.

## Notes

1. This plugin only supports sending track events to Segment currently.
2. This plugin uses the Segment write key via: `$segment_write_key = vip_get_env_var( 'SEGMENT_AMPLIFY_WRITE_KEY' );`. It could be extended to make what environment variable it uses configurable in the future.

# Defining a track event

In `class-segment-tracking.php` add a function to the `Segment_Tracking` class like this:

```php
public function segment_track_logged_in( $user_login, $user ) {
    $user_data = get_userdata( $user->ID );

    $data = array(
        'userId'     => $user->ID,
        'event'      => 'Logged In',
        'properties' => array(
            'email'  => $user_data->user_email
        )
    );

    $this->segment_tracking_track_event( $data );
}
```

Base the name of the function on the track event, e.g. `segment_track_registration_created`. The name of the track event should be dictated by the Protocols Tracking Plan in Segment and should not just be "made up."

The `$this->segment_tracking_track_event( $data );` inside your track function is what puts the event data on the queue for sending to Segment.

Once your track function is defined, add it to a hook inside `segment_tracking_init_hooks` and deploy.

The event queue is emptied via a cron job once every three minutes.
