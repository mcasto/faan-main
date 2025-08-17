<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param string $language [en | es]
     * @param string $type [upcoming | past]
     * @return JsonResponse
     */
    public function index(string $language, string $type): JsonResponse
    {
        $today = Carbon::today()->toDateString();

        if ($type == 'upcoming') {
            // Fetch current & upcoming events
            $events = Event::where('is_active', 1)
                ->where('starts', '<=', $today)
                ->where('expires', '>=', $today)
                ->orderBy('starts', 'asc')
                ->get();
        }

        if ($type == 'past') {
            // Fetch past events
            $events = Event::where('expires', '<', $today)
                ->orderBy('expires', 'desc')
                ->get();
        }

        return response()->json($events);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
