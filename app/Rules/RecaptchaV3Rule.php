<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Services\RecaptchaV3Service;
use Illuminate\Http\Request;

class RecaptchaV3Rule implements ValidationRule
{
    private $request;
    private $action;
    private $minScore;

    public function __construct(Request $request, string $action = 'submit', float $minScore = 0.5)
    {
        $this->request = $request;
        $this->action = $action;
        $this->minScore = $minScore;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $recaptchaService = app(RecaptchaV3Service::class);

        // Skip validation if reCAPTCHA is not enabled
        if (!$recaptchaService->isEnabled()) {
            return;
        }

        $result = $recaptchaService->verify($this->request, $this->action, $this->minScore);

        if (!$result['success']) {
            $error = $result['error'] ?? 'reCAPTCHA verification failed';
            $score = $result['score'] ?? 0.0;

            // More user-friendly error messages
            if ($error === 'Score too low') {
                $fail('Our security system detected unusual activity. Please try again.');
            } elseif ($error === 'Action mismatch') {
                $fail('Security verification failed. Please refresh the page and try again.');
            } else {
                $fail('Security verification failed. Please try again.');
            }
        }
    }
}
