<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => Laravel\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'facebook' => [
        'client_id' => '516970072086566',
        'client_secret' => '0133fed2aeed1b6fd1d8c38e99eb2dcc',
        'redirect' => 'https://laravel.org/socialite/facebook/callback',
    ],

    'google' => [
        'client_id' => '645312008163-1qtfeaqeqgct7r64c9802ps5hbv5gv84.apps.googleusercontent.com',
        'client_secret' => '8918ZwzZlRk36vLY-r21kG_e',
        'redirect' => 'https://laravel.org/socialite/google/callback',
    ],

];
