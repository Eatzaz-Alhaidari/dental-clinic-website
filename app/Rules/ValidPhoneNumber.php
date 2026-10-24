<?php

namespace App\Rules;

use App\Services\PhoneService;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidPhoneNumber implements ValidationRule
{
    protected ?string $country;

    public function __construct(?string $country = null)
    {
        $this->country = $country;
    }

    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value) || ! PhoneService::isValid($value, $this->country)) {
            $allowed = config('clinic.allowed_countries', ['YE']);
            $locale = app()->getLocale();

            if (count($allowed) === 1 && in_array('YE', $allowed)) {
                $msg = $locale === 'en'
                    ? 'Please enter a valid Yemeni mobile number (e.g., 77xxxxxxx, 73xxxxxxx, 71xxxxxxx).'
                    : 'يرجى إدخال رقم جوال يمني صحيح يبدأ بـ 77 أو 73 أو 71 أو 78 أو 70.';
            } else {
                $msg = $locale === 'en'
                    ? 'Please enter a valid mobile number (Yemeni 7xxxxxxxx or Saudi 05xxxxxxxx).'
                    : 'يرجى إدخال رقم جوال صحيح (يمني يبدأ بـ 7 أو سعودي يبدأ بـ 05).';
            }

            $fail($msg);
        }
    }
}
