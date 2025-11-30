<?php

namespace App\Rules\Public;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class LinkedInUrl implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!is_string($value) || !preg_match('/^https?:\/\/(www\.)?linkedin\.com\/in\/[a-zA-Z0-9\-_%]+\/?$/', $value)) {
            $fail(__('validation.custom.linkedin.incorrect'));
        }
    }
}
