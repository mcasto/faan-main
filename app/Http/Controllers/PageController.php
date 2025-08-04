<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Navigation;
use App\Models\Event;
use App\Models\SubmittedData;
use App\Services\ContentService;
use App\Rules\RecaptchaV3Rule;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class PageController extends Controller
{
    protected $contentService;

    public function __construct(ContentService $contentService)
    {
        $this->contentService = $contentService;
    }

    public function show(Request $request, $path = '/')
    {
        $locale = App::getLocale();

        // Ensure path starts with /
        if (!str_starts_with($path, '/')) {
            $path = '/' . $path;
        }

        // Find the navigation record for this path
        $navigation = Navigation::where('path', $path)->first();

        if (!$navigation) {
            abort(404);
        }

        // If this navigation item has no component but has children, redirect to first child
        if (!$navigation->component_name && $navigation->children()->visible()->exists()) {
            $firstChild = $navigation->children()->visible()->ordered()->first();
            if ($firstChild && $firstChild->path) {
                return redirect($firstChild->path);
            }
        }

        // Get content using ContentService
        $sourcePage = $navigation->source ?: 'home';
        $pageMeta = $this->contentService->getPageMeta($sourcePage, $locale);
        $sections = $this->contentService->getPageSections($sourcePage, $locale);

        // For homepage, inject latest news from events
        if ($sourcePage === 'home') {
            $sections = $this->injectLatestNews($sections, $locale);
        }

        // For events pages, inject events data
        $events = null;
        if ($navigation->component_name === 'EventsPage') {
            $events = $this->getEventsForPage($path);
        }

        // Replace dynamic placeholders for specific pages
        if ($sourcePage === 'adoptions') {
            $sections = $this->replaceDynamicPlaceholders($sections, $locale);
        }

        return view('pages.' . $navigation->component_name, [
            'navigation' => $navigation,
            'meta' => $pageMeta,
            'sections' => $sections,
            'events' => $events,
            'locale' => $locale,
            'navigationMenu' => $this->getNavigationMenu($locale)
        ]);
    }

    public function home()
    {
        return $this->show(request(), '/');
    }

    private function getNavigationMenu($locale)
    {
        return Navigation::visible()
            ->ordered()
            ->topLevel()
            ->with(['children' => function ($query) {
                $query->visible()->ordered();
            }])
            ->get()
            ->map(function ($item) use ($locale) {
                $item->display_name = $locale === 'es' ? $item->name_es : $item->name_en;

                // Replace language placeholder in external URLs
                if ($item->external && $item->path) {
                    $item->path = str_replace('{{language}}', $locale, $item->path);
                }

                // Also set display names and fix URLs for children
                if ($item->children) {
                    $item->children->transform(function ($child) use ($locale) {
                        $child->display_name = $locale === 'es' ? $child->name_es : $child->name_en;

                        // Replace language placeholder in external URLs for children
                        if ($child->external && $child->path) {
                            $child->path = str_replace('{{language}}', $locale, $child->path);
                        }

                        return $child;
                    });
                }

                return $item;
            });
    }

    public function submitContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'g-recaptcha-response' => [new RecaptchaV3Rule($request, 'contact_submit', 0.5)],
        ]);

        // Here you would typically:
        // 1. Save to database
        // 2. Send email notification
        // 3. Log the submission

        // For now, just log it
        Log::info('Contact form submission', [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        $locale = App::getLocale();
        $message = $locale === 'es'
            ? 'Gracias por tu mensaje. Te contactaremos pronto.'
            : 'Thank you for your message. We will contact you soon.';

        return redirect()->back()->with('success', $message);
    }

    public function submitDonation(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'donation_amount' => 'required|numeric|min:0.01',
            'donation_type' => 'required|in:credit,transfer,pickup',
            'consent' => 'accepted',
            'g-recaptcha-response' => [new RecaptchaV3Rule($request, 'donation_submit', 0.5)],
        ]);

        // Generate unique ID for tracking
        $uniqueId = uniqid();

        // Prepare donation data
        $donationData = [
            '_id' => $uniqueId,
            'name' => $request->name,
            'email' => $request->email,
            'donation_amount' => $request->donation_amount,
            'donation_type' => $request->donation_type,
            'date_received' => date('Y-m-d'),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ];

        // Save to database
        try {
            SubmittedData::create([
                'type' => 'donations',
                '_id' => $uniqueId,
                'rec' => json_encode($donationData), // Store as JSON like the old system
            ]);

            Log::info('Donation form submission', [
                '_id' => $uniqueId,
                'name' => $request->name,
                'email' => $request->email,
                'donation_amount' => $request->donation_amount,
                'donation_type' => $request->donation_type,
            ]);

            /* mc-todo: Email Notification System
             * The old system sends an email to info@FAANecuador.org with donation details
             * Implement the following:
             * 1. Configure SendGrid or similar email service
             * 2. Create email template for donation notifications
             * 3. Send confirmation email to donor
             * 4. Send notification email to FAAN administrators
             *
             * Example from old system:
             * - Subject: "Donation Information"
             * - Content: Name, Email, Donation Type, Amount, Tracking ID
             * - To: info@FAANecuador.org
             * - CC: Donor for confirmation
             */

            $locale = App::getLocale();
            $message = $locale === 'es'
                ? 'Gracias por tu donación. Te contactaremos pronto con los detalles de pago.'
                : 'Thank you for your donation. We will contact you soon with payment details.';

            return redirect()->back()
                ->with('success', $message)
                ->with('showDonationModal', $request->donation_type);
        } catch (\Exception $e) {
            Log::error('Failed to save donation', [
                'error' => $e->getMessage(),
                'donation_data' => $donationData
            ]);

            $locale = App::getLocale();
            $errorMessage = $locale === 'es'
                ? 'Hubo un error al procesar tu donación. Por favor intenta nuevamente.'
                : 'There was an error processing your donation. Please try again.';

            return redirect()->back()
                ->withErrors(['donation' => $errorMessage])
                ->withInput();
        }
    }

    /**
     * Replace dynamic placeholders in content sections
     */
    private function replaceDynamicPlaceholders($sections, $locale)
    {
        // Get current month name in the appropriate language
        $currentMonth = $locale === 'es'
            ? $this->getSpanishMonthName(date('n'))
            : date('F');

        // Count adoptees (or use a fixed number if needed)
        $numDogs = $this->countAdoptableDogs($sections);

        // Define replacements
        $replacements = [
            '{{ curMonth }}' => $currentMonth,
            '{{ numDogs }}' => $numDogs,
            '{{curMonth}}' => $currentMonth,
            '{{numDogs}}' => $numDogs,
        ];

        // Apply replacements recursively to all sections
        return $this->applySectionReplacements($sections, $replacements);
    }

    /**
     * Recursively apply replacements to sections
     */
    private function applySectionReplacements($sections, $replacements)
    {
        foreach ($sections as $key => &$section) {
            if (is_array($section)) {
                if (isset($section['html'])) {
                    // This is a section with HTML content
                    $section['html'] = str_replace(array_keys($replacements), array_values($replacements), $section['html']);
                } else {
                    // This is a nested array, recurse
                    $section = $this->applySectionReplacements($section, $replacements);
                }
            }
        }

        return $sections;
    }

    /**
     * Get Spanish month name
     */
    private function getSpanishMonthName($monthNumber)
    {
        $months = [
            1 => 'Enero',
            2 => 'Febrero',
            3 => 'Marzo',
            4 => 'Abril',
            5 => 'Mayo',
            6 => 'Junio',
            7 => 'Julio',
            8 => 'Agosto',
            9 => 'Septiembre',
            10 => 'Octubre',
            11 => 'Noviembre',
            12 => 'Diciembre'
        ];

        return $months[$monthNumber] ?? 'Agosto';
    }

    /**
     * Count number of adoptable dogs from sections
     */
    private function countAdoptableDogs($sections)
    {
        // If adoptees section exists, count them
        if (isset($sections['adoptees']) && is_array($sections['adoptees'])) {
            return count($sections['adoptees']);
        }

        // Default to a reasonable number
        return 12;
    }

    /**
     * Inject latest news events into homepage sections
     */
    private function injectLatestNews($sections, $locale)
    {
        // Get current events for latest news
        $events = Event::latestNews()->get();

        if ($events->isEmpty()) {
            return $sections;
        }

        // Convert events to the format expected by the template
        $newsSection = [];
        foreach ($events as $event) {
            $newsSection['event-' . $event->id] = [
                'html' => $this->formatEventForNews($event, $locale)
            ];
        }

        // Inject into sections
        $sections['news'] = $newsSection;

        // Add metadata for banner visibility logic
        $latestEventStart = $events->min('starts');
        $sections['news_metadata'] = [
            'latest_start_date' => $latestEventStart ? $latestEventStart->format('Y-m-d') : null,
            'count' => $events->count()
        ];

        return $sections;
    }

    /**
     * Get events data for events pages
     */
    private function getEventsForPage($path)
    {
        if ($path === '/events/upcoming-events') {
            // Get current and upcoming events
            return Event::current()->orderBy('starts', 'asc')->get();
        } elseif ($path === '/events/past-events') {
            // Get past events
            return Event::where('expires', '<', now())
                ->orderBy('starts', 'desc')
                ->get();
        } else {
            return collect(); // Empty collection for other event pages
        }
    }
    /**
     * Format an event for display in the news section
     */
    private function formatEventForNews($event, $locale)
    {
        $html = '<div class="event-news-item">';

        // Title
        $html .= '<h3 class="text-xl font-bold text-gray-800 mb-3">' . htmlspecialchars($event->title) . '</h3>';

        // Subtitle if exists
        if ($event->subtitle) {
            $html .= '<p class="text-sm text-gray-600 mb-3 font-medium">' . htmlspecialchars($event->subtitle) . '</p>';
        }

        // Event dates if not hidden
        if (!$event->hide_dates && $event->starts) {
            $startDate = $event->starts->format($locale === 'es' ? 'd/m/Y' : 'M j, Y');
            $dateLabel = $locale === 'es' ? 'Fecha:' : 'Date:';
            $html .= '<p class="text-sm text-blue-600 mb-3"><strong>' . $dateLabel . '</strong> ' . $startDate . '</p>';
        }

        // Content preview (first 200 characters)
        if ($event->content) {
            $plainContent = strip_tags($event->content);
            $preview = strlen($plainContent) > 200 ? substr($plainContent, 0, 200) . '...' : $plainContent;
            $html .= '<p class="text-gray-700 text-sm leading-relaxed">' . htmlspecialchars($preview) . '</p>';
        }

        $html .= '</div>';

        return $html;
    }
}
