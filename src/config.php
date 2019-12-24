<?php

return [

    /*
    |--------------------------------------------------------------------------
    | secret
    |--------------------------------------------------------------------------
    |
    | Deploy secret that the webhook adds to the POST for verification
    | Set APP_DEPLOY_SECRET in your .env file
    |
    */

    'secret' => env('APP_DEPLOY_SECRET'),

    /*
    |--------------------------------------------------------------------------
    | route
    |--------------------------------------------------------------------------
    |
    | The route to register for the webhook POST url
    |
    */

    'route' => 'deploy-webhook',

    /*
    |--------------------------------------------------------------------------
    | script
    |--------------------------------------------------------------------------
    |
    | The deploy shell script that will be executed
    |
    */

    'script' => './deploy.sh',

    /*
    |--------------------------------------------------------------------------
    | notify_mail
    |--------------------------------------------------------------------------
    |
    | After deployment send a notification to this emailaddress
    |
    */

    'notify_mail' => env('APP_DEPLOY_NOTIFY_MAIL'),

    /*
    |--------------------------------------------------------------------------
    | notify_success
    |--------------------------------------------------------------------------
    |
    | By default notifications will only be send on deployment failures
    | To send notification on success too change APP_DEPLOY_NOTIFY_SUCCESS
    |
    */

    'notify_success' => env('APP_DEPLOY_NOTIFY_SUCCESS', false),

];
