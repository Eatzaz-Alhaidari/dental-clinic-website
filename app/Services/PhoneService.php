<?php

namespace App\Services;

class PhoneService
{
    /**
     * Check if the given phone number matches any of the allowed countries in config/clinic.php.
     */
    public static function isValid(string $phone, ?string $country = null): bool
    {
        $countries = self::getCountriesToCheck($country);

        foreach ($countries as $config) {
            if (isset($config['regex']) && preg_match($config['regex'], trim($phone))) {
                return true;
            }
        }

        return false;
    }

    /**
     * Normalize a phone number to standard international format WITHOUT '+' or leading zeros.
     * Example: '0771234567' -> '967771234567'
     * Example: '+967 77 123 4567' -> '967771234567'
     * Example: '0501234567' -> '966501234567'
     */
    public static function normalize(string $phone, ?string $country = null): string
    {
        $clean = preg_replace('/[^\d+]/', '', trim($phone));
        $countries = self::getCountriesToCheck($country);

        foreach ($countries as $config) {
            if (isset($config['regex']) && preg_match($config['regex'], $clean, $matches)) {
                // $matches[1] is the national mobile number (e.g. 771234567 or 501234567)
                return $config['country_code'] . $matches[1];
            }
        }

        // Fallback: strip leading +, 00, or single 0
        $stripped = ltrim(ltrim($clean, '+'), '0');
        $defaultCountry = config('clinic.default_country', 'YE');
        $defaultCode = config("clinic.countries.{$defaultCountry}.country_code", '967');

        if (! str_starts_with($stripped, $defaultCode) && ! str_starts_with($stripped, '966')) {
            return $defaultCode . $stripped;
        }

        return $stripped;
    }

    /**
     * Format number for WhatsApp links (wa.me/{number}) without '+'.
     */
    public static function toWhatsappFormat(string $phone): string
    {
        return self::normalize($phone);
    }

    /**
     * Get array of country configurations to test against.
     */
    protected static function getCountriesToCheck(?string $country = null): array
    {
        $all = config('clinic.countries', []);

        if ($country && isset($all[$country])) {
            return [$country => $all[$country]];
        }

        $allowed = config('clinic.allowed_countries', ['YE', 'SA']);
        $result = [];

        foreach ($allowed as $key) {
            if (isset($all[$key])) {
                $result[$key] = $all[$key];
            }
        }

        return $result;
    }
}
