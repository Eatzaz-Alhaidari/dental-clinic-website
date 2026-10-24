<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Country
    |--------------------------------------------------------------------------
    | The default country key ('YE' for Yemen, 'SA' for Saudi Arabia).
    */
    'default_country' => env('CLINIC_DEFAULT_COUNTRY', 'YE'),

    /*
    |--------------------------------------------------------------------------
    | Allowed Countries for Booking & Phone Validation
    |--------------------------------------------------------------------------
    | List of country keys accepted by the system during validation.
    | You can add or remove countries easily (e.g. ['YE'] or ['YE', 'SA']).
    */
    'allowed_countries' => ['YE', 'SA'],

    /*
    |--------------------------------------------------------------------------
    | Supported Countries Configuration
    |--------------------------------------------------------------------------
    | Configuration for each country including dial code, validation regex,
    | international normalization pattern, and display examples.
    */
    'countries' => [
        'YE' => [
            'name' => [
                'ar' => 'اليمن',
                'en' => 'Yemen',
            ],
            'country_code' => '967',
            'dial_code' => '+967',
            // Matches Yemeni mobile numbers:
            // 77xxxxxxx (Yemen Mobile), 78xxxxxxx (Yemen Mobile CDMA/4G),
            // 73xxxxxxx (YOU / MTN), 71xxxxxxx (Sabafon), 70xxxxxxx (Y Telecom)
            // Accepts with: +967, 00967, 967, 0, or directly 7xxxxxxxx
            'regex' => '/^(?:(?:\+|00)?967|0)?(7[01378]\d{7})$/',
            'example' => '771234567',
            'placeholder' => '77xxxxxxx',
        ],

        'SA' => [
            'name' => [
                'ar' => 'المملكة العربية السعودية',
                'en' => 'Saudi Arabia',
            ],
            'country_code' => '966',
            'dial_code' => '+966',
            // Matches Saudi mobile numbers: 05xxxxxxxx or 5xxxxxxxx
            // Accepts with: +966, 00966, 966, 0, or directly 5xxxxxxxx
            'regex' => '/^(?:(?:\+|00)?966|0)?(5\d{8})$/',
            'example' => '0501234567',
            'placeholder' => '05xxxxxxxx',
        ],
    ],
];
