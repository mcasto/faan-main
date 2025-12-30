<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return JsonResponse
     */
    public function show(): JsonResponse
    {
        $response = [
            'meta' => __('home.meta'),
            'footer' => __('home.footer')
        ];

        // only display banner through Dec 31, 2025
        if (now()->lte('2025-12-31')) {
            $response['banner'] = __('home.banner');
        }

        return response()->json(
            $response
        );
    }
}
