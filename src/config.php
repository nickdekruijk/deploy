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

];
