<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Services\MondayService;
use App\Services\RecaptchaV3Service;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    protected $recaptchaService;

    public function __construct(RecaptchaV3Service $recaptchaService)
    {
        $this->recaptchaService = $recaptchaService;
    }

    public function index()
    {
        return response()->json([
            'header' => __('contact.header'),
            'image' => __('contact.image'),
            'phone' => __('contact.phone'),
            'paragraphs' => __('contact.paragraphs'),
            'form' => __('contact.form'),
        ]);
    }

    /**
     * Store a new contact message.
     */
    public function store(Request $request)
    {
        // 1. Validate basic form fields
        $valid = $request->validate([
            'contact_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|min:1',
            'subject' => 'required|string',
            'message' => 'required|string',
            'join_mailing_list' => 'boolean',
        ]);

        // 2. Verify reCAPTCHA
        $recaptchaResult = $this->recaptchaService->verify(
            $request,
            'contact_submit', // Custom action name
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

            $inserted = Contact::create($valid);
            $rec = Contact::find($inserted->id);

            $monday = new MondayService();
            $item = $rec->toArray();

            $response = $monday->addItem('Web Contacts', $item);

            if (isset($response->status) && $response->status == 'error') {
                // Error adding item to monday, return error information
                return response()->json(['status' => 'error', 'message' => $response['message'], 'monday_details' => $response['errors']]);
            }

            return response()->json([
                'status' => 'ok',
            ]);
        } catch (\Exception $e) {
            logger()->error('Contact submission failed', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
