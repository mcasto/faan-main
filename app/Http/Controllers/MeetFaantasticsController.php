<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Navigation;

class MeetFaantasticsController extends Controller
{
    public function show()
    {
        $locale = app()->getLocale();

        $content = [
            'header' => __('meet-faantastics.header'),
            'boardSection' => __('meet-faantastics.boardSection'),
            'teamSection' => __('meet-faantastics.teamSection'),
            'committeeSection' => __('meet-faantastics.committeeSection'),
            'navigationMenu' => $this->getNavigationMenu($locale),
        ];

        return view('meet-faantastics', $content);
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
}
