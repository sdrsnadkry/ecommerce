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
    'google' => [
        'client_id' => '354267128955-ph93krpunehlfa2nr2v2haek3tajvjj5.apps.googleusercontent.com',
        'client_secret' => 'b8D-0vB5NF8AVrC0v9jQAi3B',
        'redirect' => 'http://127.0.0.1/callback',
    ],
    'facebook' => [
        'client_id' => '237141400891894',
        'client_secret' => '5bd4a51f75d50199e4534411b4900e66',
        'redirect' => 'http://127.0.0.1/callback',
      ],

];
