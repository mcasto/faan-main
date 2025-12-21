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
        return response()->json(
            [
                'meta' => __('home.meta'),
                'banner' => __('home.banner'),
                'footer' => __('home.footer')
            ]
        );
    }
}
