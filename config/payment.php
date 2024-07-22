<?php

return [

    'default' => 'paymob',

    'stripe' => [
        'secret_key'    => env('STRIPE_SECRET_KEY'),
        'webhook'       => env('STRIPE_WEBHOOK'),
        'public_key'    => env('STRIPE_PUBLIC_KEY'),
    ],

    'paymob' => [
        'api_key'       => env('PAYMOB_API_KEY'),
        'iframe_id'     => env('PAYMOB_IFRAME_ID', '385698'),
        'currency'      => 'EGP',
        'expiration'    => 3600,
        'api_url'       => 'https://accept.paymob.com/api/',
        'integration_id'=> env('PAYMOB_INTEGRATION_ID', '2089339'),
    ],

];
