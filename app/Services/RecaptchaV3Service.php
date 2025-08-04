<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RecaptchaV3Service
{
    private $siteKey;
    private $secretKey;

    public function __construct()
    {
        $this->siteKey = config('services.recaptcha.site_key');
        $this->secretKey = config('services.recaptcha.secret_key');
    }

    /**
     * Verify reCAPTCHA v3 response
     *
     * @param Request $request
     * @param string $action - The action name for this reCAPTCHA
     * @param float $minScore - Minimum score required (0.0 to 1.0)
     * @return array
     */
    public function verify(Request $request, string $action = 'submit', float $minScore = 0.5): array
    {
        $token = $request->input('recaptcha_token');

        if (!$token) {
            Log::warning('reCAPTCHA v3 verification failed: No token provided');
            return [
                'success' => false,
                'error' => 'No reCAPTCHA token provided',
                'score' => 0.0
            ];
        }

        if (!$this->isEnabled()) {
            Log::info('reCAPTCHA v3 is disabled - skipping verification');
            return [
                'success' => true,
                'score' => 1.0,
                'action' => $action
            ];
        }

        try {
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => $this->secretKey,
                'response' => $token,
                'remoteip' => $request->ip()
            ]);

            $result = $response->json();

            if ($result['success'] ?? false) {
                $score = $result['score'] ?? 0.0;
                $returnedAction = $result['action'] ?? '';

                // Verify the action matches
                if ($returnedAction !== $action) {
                    Log::warning('reCAPTCHA v3 action mismatch', [
                        'expected' => $action,
                        'received' => $returnedAction,
                        'ip' => $request->ip()
                    ]);

                    return [
                        'success' => false,
                        'error' => 'Action mismatch',
                        'score' => $score
                    ];
                }

                // Check if score meets minimum threshold
                if ($score >= $minScore) {
                    Log::info('reCAPTCHA v3 verification successful', [
                        'action' => $action,
                        'score' => $score,
                        'ip' => $request->ip()
                    ]);

                    return [
                        'success' => true,
                        'score' => $score,
                        'action' => $action
                    ];
                } else {
                    Log::warning('reCAPTCHA v3 score too low', [
                        'action' => $action,
                        'score' => $score,
                        'required' => $minScore,
                        'ip' => $request->ip()
                    ]);

                    return [
                        'success' => false,
                        'error' => 'Score too low',
                        'score' => $score
                    ];
                }
            } else {
                Log::warning('reCAPTCHA v3 verification failed', [
                    'ip' => $request->ip(),
                    'errors' => $result['error-codes'] ?? []
                ]);

                return [
                    'success' => false,
                    'error' => 'Verification failed',
                    'errors' => $result['error-codes'] ?? []
                ];
            }
        } catch (\Exception $e) {
            Log::error('reCAPTCHA v3 verification error', [
                'ip' => $request->ip(),
                'error' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'error' => 'Verification error: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Get the site key for frontend
     *
     * @return string
     */
    public function getSiteKey(): string
    {
        return $this->siteKey ?? '';
    }

    /**
     * Check if reCAPTCHA is enabled
     *
     * @return bool
     */
    public function isEnabled(): bool
    {
        return !empty($this->siteKey) && !empty($this->secretKey);
    }

    /**
     * Get reCAPTCHA script URL
     *
     * @return string
     */
    public function getScriptUrl(): string
    {
        return "https://www.google.com/recaptcha/api.js?render=" . $this->getSiteKey();
    }
}
