<?php

namespace App\Http\Controllers;

use App\Models\Navigation;

class MeetFaantasticsController extends Controller
{
    public function index()
    {
        $content = [
            'header' => __('meet-faantastics.header'),
            'board' => __('meet-faantastics.board'),
            'shelter' => __('meet-faantastics.shelter'),
            'gala' => __('meet-faantastics.gala'),
        ];

        return response()->json($content);
    }
}
