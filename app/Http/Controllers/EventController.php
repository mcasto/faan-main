<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Stichoza\GoogleTranslate\GoogleTranslate;

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
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'starts' => 'required|date',
            'expires' => 'required|date|after_or_equal:starts',
            'hide_dates' => 'boolean',
            'is_active' => 'boolean',
            'slug' => 'required|string|max:255|unique:events,slug,NULL,id,language,en',
            'body' => 'required|string',
        ]);

        // Create English event
        $enEvent = Event::create([
            'title' => $validated['title'],
            'subtitle' => $validated['subtitle'],
            'starts' => $validated['starts'],
            'expires' => $validated['expires'],
            'hide_dates' => $validated['hide_dates'] ?? false,
            'is_active' => $validated['is_active'] ?? true,
            'slug' => $validated['slug'],
            'language' => 'en',
        ]);

        // Save English HTML file
        $enHtmlPath = resource_path("lang/en/events/{$validated['slug']}.html");
        File::put($enHtmlPath, $validated['body']);

        // Add entry to English events.php
        $this->addEventToLangFile('en', $validated['slug']);

        // Translate to Spanish
        $translator = new GoogleTranslate('es');
        $translator->setSource('en');

        $esTitle = $this->translateText($translator, $validated['title']);
        $esSubtitle = $this->translateText($translator, $validated['subtitle']);
        $esBody = $this->translateHtmlContent($translator, $validated['body']);

        // Create Spanish event
        $esEvent = Event::create([
            'title' => $esTitle,
            'subtitle' => $esSubtitle,
            'starts' => $validated['starts'],
            'expires' => $validated['expires'],
            'hide_dates' => $validated['hide_dates'] ?? false,
            'is_active' => $validated['is_active'] ?? true,
            'slug' => $validated['slug'],
            'language' => 'es',
        ]);

        // Save Spanish HTML file
        $esHtmlPath = resource_path("lang/es/events/{$validated['slug']}.html");
        File::put($esHtmlPath, $esBody);

        // Add entry to Spanish events.php
        $this->addEventToLangFile('es', $validated['slug']);

        return response()->json([
            'status' => 'ok',
            'en' => $enEvent,
            'es' => $esEvent,
        ], 201);
    }

    private function translateText(GoogleTranslate $translator, string $text): string
    {
        try {
            $translated = $translator->translate($text);
            usleep(500000); // Rate limiting
            return $translated;
        } catch (\Exception $e) {
            return $text; // Fallback to original
        }
    }

    private function translateHtmlContent(GoogleTranslate $translator, string $content): string
    {
        // Translate text content while preserving HTML tags
        return preg_replace_callback(
            '/>([^<{]+)(<|{|$)/',
            function ($matches) use ($translator) {
                $text = trim($matches[1]);
                $nextChar = $matches[2];

                if (!empty($text) && preg_match('/[a-zA-Z]/', $text)) {
                    try {
                        $translated = $translator->translate($text);
                        usleep(500000);
                        return '>' . $translated . $nextChar;
                    } catch (\Exception $e) {
                        return $matches[0];
                    }
                }

                return $matches[0];
            },
            $content
        );
    }

    private function addEventToLangFile(string $language, string $slug): void
    {
        $langFilePath = resource_path("lang/{$language}/events.php");
        $content = File::get($langFilePath);

        // Check if entry already exists
        if (str_contains($content, "'{$slug}'")) {
            return;
        }

        // Ensure the last entry has a trailing comma before adding new entry
        $content = preg_replace('/\)\s*\n(\];)/', "),\n$1", $content);

        // Add new entry before the closing ];
        $newEntry = "    '{$slug}' => file_get_contents(__DIR__ . '/events/{$slug}.html'),\n";
        $content = preg_replace('/\];(\s*)$/', $newEntry . "];\n", $content);

        File::put($langFilePath, $content);
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
