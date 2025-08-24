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
            'meta' => __('sanctuary-project.meta'),
            'header' => __('sanctuary-project.header'),
            'subtitle' => __('sanctuary-project.subtitle'),
            'overview' => __('sanctuary-project.overview'),
            'project_header' => __('sanctuary-project.project_header'),
            'phases' => __('sanctuary-project.phases'),
            'community' => __('sanctuary-project.community'),
            'preview' => __('sanctuary-project.preview'),
        ]);
    }
}
