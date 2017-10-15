<?php

return [
    'ses' => [
        'key'    => env('MAIL_SES_KEY'),
        'secret' => env('MAIL_SES_SECRET'),
        'region' => env('MAIL_SES_REGION'),  // e.g. us-east-1
    ],
];