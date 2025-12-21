<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Services\MondayService;
use App\Services\RecaptchaV3Service;
use Dotenv\Validator;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    protected $recaptchaService;

    public function __construct(RecaptchaV3Service $recaptchaService)
    {
        $this->recaptchaService = $recaptchaService;
    }

    /**
     * Send language text for donation form
     */
    public function show()
    {
        return response()->json(
            [
                'meta' => __('donations.meta'),
                'header' => __('donations.header'),
                'subtitle' => __('donations.subtitle'),
                'contributionHeader' => __('donations.contribution-header'),
                'contributionInfo' => __('donations.contribution-info'),
                'joinHeader' => __('donations.join-header'),
                'joinBullets' => __('donations.join-bullets'),
                'matchingGrant' => __('donations.matching-grant'),
                'redCarpet' => __('donations.red-carpet'),
                'pawImages' => __('donations.paw-images'),
                'formHeader' => __('donations.form-header'),
                'formTitle' => __('donations.form-title'),
                'formDisclaimer' => __('donations.form-disclaimer'),
                'donationMethodHeader' => __('donations.donation-method-header'),
                'donationMethods' => __('donations.donation-methods'),
                'formFields' => __('donations.form-fields'),
                'formButtons' => __('donations.form-buttons'),
                'recaptchaDisclaimer' => __('donations.recaptcha-disclaimer'),
                'donationConfig' => [
                    'cc' =>  __('donations.credit-dialog'),
                    'pickup' => __('donations.pickup-dialog'),
                    'transfer' =>  __('donations.transfer-dialog'),
                ],
            ]
        );
    }

    /**
     * Process the donation form submission.
     */
    public function process(Request $request)
    {
        // 1. Validate basic form fields
        $valid = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'amount' => 'required|numeric|min:1',
            'donation_method' => 'required|string|in:cc,transfer,pickup',
            'comments' => 'nullable|string'
        ]);

        // 2. Verify reCAPTCHA
        $recaptchaResult = $this->recaptchaService->verify(
            $request,
            'donation_submit', // Custom action name
            0.5 // Minimum score threshold
        );

        if (!$recaptchaResult['success']) {
            return response()->json([
                'status' => 'error',
                'message' => 'reCAPTCHA verification failed',
                'recaptcha_errors' => $recaptchaResult['error'] ?? null,
                'score' => $recaptchaResult['score'] ?? 0
            ], 403);
        }

        // 3. Process the donation (only reaches here if reCAPTCHA passed)
        try {
            // insert into local db
            $valid['recaptcha_score'] = $recaptchaResult['score'];

            $rec = Donation::create($valid);


            $monday = new MondayService();
            $item = [
                'donor_name' => $rec->name,
                'donor_email' => $rec->email,
                'donation_date' => now()->toDateString(),
                'donation_amount' => $rec->amount,
                'donation_method' => $rec->donation_method,
                'donation_type' => $rec->type,
                'recaptcha_score' => $rec->recaptcha_score,
                'id' => $rec->id,
                'donor_comments' => $rec->comments
            ];

            $response = $monday->addItem('Web Donations', $item);

            if (isset($response->status) && $response->status == 'error') {
                // Error adding item to monday, return error information
                return response()->json(['status' => 'error', 'message' => $response['message'], 'monday_details' => $response['errors']]);
            }

            return response()->json([
                'status' => 'ok',
            ]);
        } catch (\Exception $e) {
            logger()->error('Donation processing failed', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
