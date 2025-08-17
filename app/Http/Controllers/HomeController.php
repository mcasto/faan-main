<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param string $language
     * @return JsonResponse
     */
    public function show(string $language): JsonResponse
    {
        return response()->json(
            [
                'footer' => __('home.footer')
            ]
        );
    }
}
