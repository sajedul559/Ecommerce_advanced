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
    // 'google' => [
    //     'client_id'     => env('CLIENT_ID'),
    //     'client_secret' => env('CLIENT_SECRET'),
    //     'redirect' => 'localhost/Advanced_ecommerce/oauth/google/callback',
    //     //'redirect'      => env('APP_URL') . '/oauth/google/callback',

    //  ],
    'google' => [
        'client_id' => '330550095455-r3cpiu2dlhl5oaefog8lc73u5h34hb0o.apps.googleusercontent.com',
        'client_secret' => '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',
       // 'redirect' => 'http://localhost/Advanced_ecommerce/oauth/google/callback',
        'redirect' => 'http://127.0.0.1:8000/Advanced_ecommerce/login/google/callback',
    ],

];
