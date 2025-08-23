<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        if ($type != 'upcoming' && $type != 'past') {
            return response()->json(['error' => 'Invalid event type'], 400);
        }

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
            $events = Event::where('is_active', 1)
                ->where('expires', '<', $today)
                ->orderBy('expires', 'desc')
                ->get();
        }

        $events['header'] = __('events.headers.' . $type);
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
    public function show(string $language, string $slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        $event->html = __('events.' . $slug);
        return response()->json($event);
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
