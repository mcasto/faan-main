<?php

namespace App\Http\Controllers;

use App\Models\LegacyGiving;
use App\Services\MondayService;
use App\Services\RecaptchaV3Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LegacyGivingController extends Controller
{
    protected $recaptchaService;

    public function __construct(RecaptchaV3Service $recaptchaService)
    {
        $this->recaptchaService = $recaptchaService;
    }

    /**
     * Show the legacy giving page.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'headerArea' => __('legacy-giving.header-area'),
            'leftColumn' => __('legacy-giving.left-column'),
            'rightColumn' => __('legacy-giving.right-column'),
            'formConfig' => __('legacy-giving.form-config'),
            'recaptcha' => __('legacy-giving.recaptcha')
        ]);
    }

    /**
     * Store the legacy giving form submission.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $valid = $request->validate([
            'legal_name_of_donor' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'cedula_passport' => 'required|numeric',
            'email' => 'required|email|max:255',
            'address' => 'nullable|string|max:500',
            'special_instructions' => 'nullable|string|max:1000',
            'recognized' => 'nullable|boolean',
        ]);

        $valid['donation_type'] = $request->donation_type['value'];
        $valid['donation_details'] = $request->donation_type_followup;

        $recaptchaResult = $this->recaptchaService->verify(
            $request,
            'legacy_submit', // Custom action name
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

        $valid['recaptcha_score'] = $recaptchaResult['score'];

        logger()->info(['valid' => $valid]);

        $rec = LegacyGiving::create($valid);

        $item = $rec->toArray();
        $item['created_at'] = $rec->created_at->toDateString();
        unset($item['updated_at']);

        $monday = new MondayService();
        $response = $monday->addItem('Web Legacy Donations', $item);

        if (isset($response->status) && $response->status == 'error') {
            // Error adding item to monday, return error information
            return response()->json(['status' => 'error', 'message' => $response['message'], 'monday_details' => $response['errors']]);
        }

        return response()->json([
            'status' => 'ok',
        ]);
    }
}
