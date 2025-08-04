<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\App;

class ContentService
{
    private $contentPath;

    public function __construct()
    {
        $this->contentPath = resource_path('content');
    }

    /**
     * Get page metadata (title, description, etc.)
     */
    public function getPageMeta($page, $locale = null)
    {
        $locale = $locale ?? App::getLocale();
        $metaFile = $this->contentPath . "/{$locale}/{$page}.json";

        if (File::exists($metaFile)) {
            return json_decode(File::get($metaFile), true);
        }

        // Return default meta info if file doesn't exist
        return $this->getDefaultMeta($page, $locale);
    }

    /**
     * Get page sections (header, footer, news, etc.)
     */
    public function getPageSections($page, $locale = null)
    {
        $locale = $locale ?? App::getLocale();
        $sectionsPath = $this->contentPath . "/{$locale}/{$page}/sections";

        if (!File::exists($sectionsPath)) {
            return [];
        }

        return $this->loadSections($sectionsPath);
    }

    /**
     * Load all sections from a directory
     */
    private function loadSections($sectionsPath)
    {
        $sections = [];

        // Get all HTML files in the sections directory
        $htmlFiles = File::glob($sectionsPath . '/*.html');

        foreach ($htmlFiles as $htmlFile) {
            $sectionName = pathinfo($htmlFile, PATHINFO_FILENAME);
            $jsonFile = $sectionsPath . '/' . $sectionName . '.json';

            $sections[$sectionName] = [
                'html' => File::get($htmlFile),
                'config' => File::exists($jsonFile) ? json_decode(File::get($jsonFile), true) : null
            ];
        }

        // Load subdirectories (like news/)
        $subdirs = File::directories($sectionsPath);
        foreach ($subdirs as $subdir) {
            $subdirName = basename($subdir);
            $sections[$subdirName] = $this->loadSections($subdir);
        }

        return $sections;
    }

    /**
     * Get default metadata for a page
     */
    private function getDefaultMeta($page, $locale)
    {
        $defaults = [
            'en' => [
                'title' => 'FAAN Foundation - Animal Rescue and Adoption in Ecuador',
                'description' => 'Save, adopt and Help Animals in Ecuador, an Organization for Animal Rescue, Donation and Adoption',
                'keywords' => 'Animal Rescue,Adoption,Fundación FAAN Ecuador,donate,save animals'
            ],
            'es' => [
                'title' => 'Fundación FAAN - Rescate y Adopción de Animales en Ecuador',
                'description' => 'Salvar, adoptar y ayudar animales en Ecuador, una organización para el rescate, donación y adopción de animales',
                'keywords' => 'Rescate de Animales,Adopción,Fundación FAAN Ecuador,donar,salvar animales'
            ]
        ];

        return $defaults[$locale] ?? $defaults['en'];
    }

    /**
     * Copy content from old site structure
     */
    public function migratePageContent($page)
    {
        $oldPath = base_path("faan-web-dev/public/api/page-sources/{$page}");

        if (!File::exists($oldPath)) {
            return false;
        }

        // Copy metadata files and transform them
        foreach (['en', 'es'] as $locale) {
            $oldMetaFile = "{$oldPath}/{$locale}.json";
            $newMetaFile = $this->contentPath . "/{$locale}/{$page}.json";

            if (File::exists($oldMetaFile)) {
                File::ensureDirectoryExists(dirname($newMetaFile));

                // Transform the old format to new format
                $oldMeta = json_decode(File::get($oldMetaFile), true);
                $newMeta = $this->transformMetadata($oldMeta);
                File::put($newMetaFile, json_encode($newMeta, JSON_PRETTY_PRINT));
            }

            // Copy sections
            $oldSectionsPath = "{$oldPath}/sections/{$locale}";
            $newSectionsPath = $this->contentPath . "/{$locale}/{$page}/sections";

            if (File::exists($oldSectionsPath)) {
                File::ensureDirectoryExists($newSectionsPath);
                File::copyDirectory($oldSectionsPath, $newSectionsPath);
            }
        }

        return true;
    }

    /**
     * Transform old metadata format to new Laravel-friendly format
     */
    private function transformMetadata($oldMeta)
    {
        $newMeta = [
            'title' => $oldMeta['title'] ?? 'FAAN Foundation',
            'description' => '',
            'keywords' => '',
            'og_title' => '',
            'og_description' => '',
            'og_image' => '/assets/img/faan-logo.png'
        ];

        // Extract data from meta array
        if (isset($oldMeta['meta'])) {
            foreach ($oldMeta['meta'] as $meta) {
                if (isset($meta['name'])) {
                    if ($meta['name'] === 'description') {
                        $newMeta['description'] = $meta['content'];
                    } elseif ($meta['name'] === 'keywords') {
                        $newMeta['keywords'] = $meta['content'];
                    }
                } elseif (isset($meta['property'])) {
                    if ($meta['property'] === 'og:title') {
                        $newMeta['og_title'] = $meta['content'];
                    } elseif ($meta['property'] === 'og:description') {
                        $newMeta['og_description'] = $meta['content'];
                    }
                }
            }
        }

        // Use description as og_description if not set
        if (empty($newMeta['og_description']) && !empty($newMeta['description'])) {
            $newMeta['og_description'] = $newMeta['description'];
        }

        // Use title as og_title if not set
        if (empty($newMeta['og_title']) && !empty($newMeta['title'])) {
            $newMeta['og_title'] = $newMeta['title'];
        }

        return $newMeta;
    }
}
