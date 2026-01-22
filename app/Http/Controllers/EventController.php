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
                ->where('language', $language)
                ->where('starts', '<=', $today)
                ->where('expires', '>=', $today)
                ->orderBy('starts', 'asc')
                ->get();
        }

        if ($type == 'past') {
            // Fetch past events
            $events = Event::where('is_active', 1)
                ->where('language', $language)
                ->where('expires', '<', $today)
                ->orderBy('expires', 'desc')
                ->get();
        }

        $events['header'] = __('events.headers.' . $type);
        $events['meta'] = __('events.meta');
        return response()->json($events);
    }

    public function store(Request $request)
    {
        logger()->info($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $language, string $slug)
    {
        $event = Event::where('language', $language)
            ->where('slug', $slug)
            ->firstOrFail();

        $event->html = __('events.' . $slug);

        return response()->json($event);
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
