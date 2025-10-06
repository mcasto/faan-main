<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MediaResourcesController extends Controller
{
    public function index()
    {
        return response()->json([
            'meta' => __('media-resources.meta'),
            'top' => __('media-resources.top'),
            'images' => __('media-resources.images'),
            'benefits' => __('media-resources.benefits'),
            'supporter' => __('media-resources.supporter'),
            'linkSections' => __('media-resources.link-sections'),
            'linkHeader' => __('media-resources.linkHeader'),
            'mediaRelease' => __('media-resources.media-release')
        ]);
    }
}
