<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShelterProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(): JsonResponse
    {
        return response()->json([
            'meta' => __('shelter-project.meta'),
            'header' => __('shelter-project.header'),
            'subtitle' => __('shelter-project.subtitle'),
            'overview' => __('shelter-project.overview'),
            'project_header' => __('shelter-project.project_header'),
            'phases' => __('shelter-project.phases'),
            'community' => __('shelter-project.community'),
            'preview' => __('shelter-project.preview'),
        ]);
    }
}
