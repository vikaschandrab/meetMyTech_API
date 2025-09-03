<?php

return [
    /*
    |--------------------------------------------------------------------------
    | No-Captcha Secret
    |--------------------------------------------------------------------------
    |
    | Secret key for No-Captcha reCAPTCHA v2/v3.
    | https://www.google.com/recaptcha/admin
    |
    */
    'secret' => env('NOCAPTCHA_SECRET'),

    /*
    |--------------------------------------------------------------------------
    | No-Captcha Site Key
    |--------------------------------------------------------------------------
    |
    | Site key for No-Captcha reCAPTCHA v2/v3.
    | https://www.google.com/recaptcha/admin
    |
    */
    'sitekey' => env('NOCAPTCHA_SITEKEY'),

    /*
    |--------------------------------------------------------------------------
    | Disable Captcha in Local Environment
    |--------------------------------------------------------------------------
    |
    | When set to true, captcha will be disabled in local environment
    | This should NEVER be true in production
    |
    */
    'disable_in_local' => env('DISABLE_CAPTCHA_LOCAL', true),

    /*
    |--------------------------------------------------------------------------
    | No-Captcha Options
    |--------------------------------------------------------------------------
    |
    | Various options for No-Captcha reCAPTCHA v2/v3.
    |
    */
    'options' => [
        'timeout' => 30,
    ],
];
