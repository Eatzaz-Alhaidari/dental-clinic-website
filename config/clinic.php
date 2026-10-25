<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Country
    |--------------------------------------------------------------------------
    | The default country key ('YE' for Yemen, 'SA' for Saudi Arabia).
    */
    'default_country' => env('CLINIC_DEFAULT_COUNTRY', 'SA'),

    /*
    |--------------------------------------------------------------------------
    | Allowed Countries for Booking & Phone Validation
    |--------------------------------------------------------------------------
    | List of country keys accepted by the system during validation.
    | You can add or remove countries easily (e.g. ['SA', 'YE']).
    */
    'allowed_countries' => ['SA', 'YE'],

    /*
    |--------------------------------------------------------------------------
    | Unified Clinic Contact
    |--------------------------------------------------------------------------
    | Unified customer service call & WhatsApp number.
    */
    'unified_phone' => '920066788',
    'unified_whatsapp' => '966920066788',

    /*
    |--------------------------------------------------------------------------
    | Supported Countries Configuration
    |--------------------------------------------------------------------------
    | Configuration for each country including dial code, validation regex,
    | international normalization pattern, and display examples.
    */
    'countries' => [
        'SA' => [
            'name' => [
                'ar' => 'المملكة العربية السعودية',
                'en' => 'Saudi Arabia',
            ],
            'country_code' => '966',
            'dial_code' => '+966',
            // Matches Saudi mobile numbers: 05xxxxxxxx or 5xxxxxxxx
            // Also supports unified 9200xxxxx and regional landlines 01xxxxxxxx
            'regex' => '/^(?:(?:\+|00)?966|0)?(5\d{8}|9200\d{5}|1[1-9]\d{7})$/',
            'example' => '0501234567',
            'placeholder' => '05xxxxxxxx',
        ],

        'YE' => [
            'name' => [
                'ar' => 'اليمن',
                'en' => 'Yemen',
            ],
            'country_code' => '967',
            'dial_code' => '+967',
            // Matches Yemeni mobile numbers:
            // 77xxxxxxx (Yemen Mobile), 78xxxxxxx, 73xxxxxxx (YOU), 71xxxxxxx (Sabafon), 70xxxxxxx
            'regex' => '/^(?:(?:\+|00)?967|0)?(7[01378]\d{7})$/',
            'example' => '771234567',
            'placeholder' => '77xxxxxxx',
        ],
    ],
];
