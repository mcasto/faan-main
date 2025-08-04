<?php

namespace App\Http\Controllers;

use App\Models\Navigation;
use App\Models\SubmittedData;
use App\Models\Analytics;
use Illuminate\Http\Request;

class FaanDataController extends Controller
{
    /**
     * Get the navigation menu structure.
     */
    public function getNavigation()
    {
        $navigation = Navigation::visible()
            ->ordered()
            ->topLevel()
            ->with('children')
            ->get();

        return response()->json($navigation);
    }

    /**
     * Get navigation items by language.
     */
    public function getNavigationByLanguage($language = 'en')
    {
        $navigation = Navigation::visible()
            ->ordered()
            ->topLevel()
            ->with('children')
            ->get()
            ->map(function ($item) use ($language) {
                $nameField = $language === 'es' ? 'name_es' : 'name_en';
                $item->name = $item->$nameField;

                if ($item->children) {
                    $item->children = $item->children->map(function ($child) use ($language, $nameField) {
                        $child->name = $child->$nameField;
                        return $child;
                    });
                }

                return $item;
            });

        return response()->json($navigation);
    }

    /**
     * Get submitted data statistics.
     */
    public function getSubmittedDataStats()
    {
        $stats = [
            'total' => SubmittedData::count(),
            'donations' => SubmittedData::donations()->count(),
            'contacts' => SubmittedData::contacts()->count(),
            'legacy_giving' => SubmittedData::legacyGiving()->count(),
            'successful_responses' => SubmittedData::whereNotNull('send_response')->count(),
        ];

        return response()->json($stats);
    }

    /**
     * Get recent submitted data (excluding sensitive encrypted content).
     */
    public function getRecentSubmissions($limit = 10)
    {
        $submissions = SubmittedData::select('id', 'type', '_id', 'created_at')
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get()
            ->map(function ($submission) {
                $submission->has_response = $submission->hasResponse();
                $submission->was_successful = $submission->wasSuccessful();
                return $submission;
            });

        return response()->json($submissions);
    }

    /**
     * Get analytics data count.
     */
    public function getAnalyticsCount()
    {
        $count = Analytics::count();
        return response()->json(['analytics_records' => $count]);
    }
}
