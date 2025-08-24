<?php

namespace App\Http\Controllers;

use App\Models\Navigation;

class MeetFaantasticsController extends Controller
{
    public function index()
    {
        $content = [
            'meta' => __('meet-faantastics.meta'),
            'header' => __('meet-faantastics.header'),
            'board' => __('meet-faantastics.board'),
            'sanctuary' => __('meet-faantastics.sanctuary'),
            'gala' => __('meet-faantastics.gala'),
        ];

        return response()->json($content);
    }
}
