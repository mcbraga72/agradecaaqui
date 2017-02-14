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
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\Models\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'facebook' => [
        'client_id' => '752484724908381',
        'client_secret' => '6b7ce7175f6cb452e816ede8c117e091',
        'redirect' => 'http://stark-wildwood-60445.herokuapp.com/callback/facebook',
    ],

    'google' => [
        'client_id' => '30447960984-nvemu4fjpm86f0jkkpfpudat393ctj55.apps.googleusercontent.com',
        'client_secret' => 'yMRtskRzKlrsVFDMWPcwR8HW',
        'redirect' => 'http://stark-wildwood-60445.herokuapp.com/callback/google',
    ],

];
