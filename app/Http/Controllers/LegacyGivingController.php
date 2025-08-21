<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LegacyGivingController extends Controller
{
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
        return response()->json();
    }
}
