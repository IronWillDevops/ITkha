<?php

namespace App\Rules\Public;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class GitHubUrl implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!is_string($value) || !preg_match('/^https?:\/\/(www\.)?github\.com\/[A-Za-z0-9_.-]+\/?$/', $value)) {
            $fail(__('validation/common.github.github_url'));
        }
    }
}
