<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ContentService;

class MigrateContent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'content:migrate {page?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate content from old site structure to Laravel';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $contentService = new ContentService();
        $page = $this->argument('page');

        if ($page) {
            // Migrate specific page
            $this->info("Migrating content for page: {$page}");
            $result = $contentService->migratePageContent($page);

            if ($result) {
                $this->info("✅ Successfully migrated {$page} page content");
            } else {
                $this->error("❌ Failed to migrate {$page} page content");
            }
        } else {
            // Migrate all pages
            $pages = [
                'home',
                'adoptions',
                'contact-us',
                'donations',
                'faan-atics-slide-show',
                'faan-events',
                'legacy-giving',
                'media-resources',
                'shelter-project',
                'volunteering'
            ];

            $this->info("Migrating content for all pages...");

            foreach ($pages as $pageName) {
                $this->info("Migrating: {$pageName}");
                $result = $contentService->migratePageContent($pageName);

                if ($result) {
                    $this->info("✅ {$pageName}");
                } else {
                    $this->warn("⚠️  {$pageName} - no content found or failed");
                }
            }

            $this->info("Content migration completed!");
        }
    }
}
