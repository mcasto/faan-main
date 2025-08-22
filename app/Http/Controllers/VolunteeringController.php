<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VolunteeringController extends Controller
{
    /**
     * Show the volunteering page.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json([
            'volunteer' => __('volunteering.volunteer'),
            'pawffice' => __('volunteering.pawffice'),
            'pawsForCoffee' => __('volunteering.paws-for-coffee'),
            'welfare' => __('volunteering.welfare'),
            'faanAtics' => __('volunteering.faan-atics'),
        ]);
    }
}
