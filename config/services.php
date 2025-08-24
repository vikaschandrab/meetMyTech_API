<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'tawk' => [
        'enabled' => env('TAWK_ENABLED', true),
        'widget_id' => env('TAWK_WIDGET_ID', '63aecf8047425128790ad5e8'),
        'property_id' => env('TAWK_PROPERTY_ID', '1glhdl4dc'),
    ],

    'google_maps' => [
        'enabled' => env('GOOGLE_MAPS_ENABLED', false),
        'api_key' => env('GOOGLE_MAPS_API_KEY', 'AIzaSyCRP2E3BhaVKYs7BvNytBNumU0MBmjhhxc'),
    ],

];
