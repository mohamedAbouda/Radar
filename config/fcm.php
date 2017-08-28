<?php

return [
    'driver' => env('FCM_PROTOCOL', 'http'),
    'log_enabled' => true,

    'http' => [
        'server_key' => env('FCM_SERVER_KEY', 'AAAAjdemf8s:APA91bHGtAdDkABCgAfzkfR2IZrrUeZwGyxtxzF2lVyzCWXREccMDK5H6M0m6qtu9CDjlINdTAijdOrQ1pA6on5HRdKHvA8wWXKszpBKHnp4lA7ySVFfcAWMoZzNcy-NwvuZsw8FV4E8'),
        'sender_id' => env('FCM_SENDER_ID', '609208401867'),
        'server_send_url' => 'https://fcm.googleapis.com/fcm/send',
        'server_group_url' => 'https://android.googleapis.com/gcm/notification',
        'timeout' => 30.0, // in second
    ],
];
