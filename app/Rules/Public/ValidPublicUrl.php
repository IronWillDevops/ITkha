<?php

namespace App\Rules\Public;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidPublicUrl implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!is_string($value) || !filter_var($value, FILTER_VALIDATE_URL)) {
            $fail(__('validation/common.website.public_url'));
            return;
        }
    }
}
