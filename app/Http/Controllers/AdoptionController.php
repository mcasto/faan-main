<?php

namespace App\Http\Controllers;

use App\Models\Adoptee;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdoptionController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return JsonResponse
     */
    public function show(): JsonResponse
    {
        $adoptees = Adoptee::orderBy('name')->get();
        $adopteeHeader = __('adoptions.adoptee-header');
        $adopteeHeader = str_replace("{{ numDogs }}", $adoptees->count(), $adopteeHeader);
        $adopteeHeader = str_replace("{{ curMonth }}", now()->format('F'), $adopteeHeader);

        return response()->json(
            [
                'meta' => __('adoptions.meta'),
                'bannerLeftHeader' => __('adoptions.banner-left-header'),
                'bannerLeftText' => __('adoptions.banner-left-text'),
                'bannerRightHeader' => __('adoptions.banner-right-header'),
                'bannerRightText' => __('adoptions.banner-right-text'),
                'bannerBottom' => __('adoptions.banner-bottom'),
                'adopteeHeader' => $adopteeHeader,
                'adoptees' => $adoptees
            ]
        );
    }
}
