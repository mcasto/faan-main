<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Stichoza\GoogleTranslate\GoogleTranslate;
use DOMDocument;

class TranslateLanguageFiles extends Command
{
    protected $signature = 'translate:all {--force} {--skip-html} {--skip-php}';
    protected $description = 'Translate all language files from English to Spanish, including HTML blocks';

    public function handle()
    {
        $this->info('Starting translation process...');

        $translator = new GoogleTranslate('es');
        $translator->setSource('en');

        // Add a delay to avoid rate limiting (milliseconds)
        $translator->setOptions([
            'delay' => 1000,
        ]);

        $enBasePath = resource_path('lang/en');
        $esBasePath = resource_path('lang/es');

        if (!File::exists($esBasePath)) {
            File::makeDirectory($esBasePath, 0755, true);
            $this->info('Created Spanish language directory.');
        }

        $this->processLanguageDirectory($enBasePath, $esBasePath, $translator);

        $this->info('Translation completed successfully!');
        $this->info('Please review the translations for accuracy, especially proper names and technical terms.');
    }

    protected function processLanguageDirectory($enPath, $esPath, $translator)
    {
        $items = scandir($enPath);

        foreach ($items as $item) {
            if ($item === '.' || $item === '..') continue;

            $sourcePath = $enPath . '/' . $item;
            $targetPath = $esPath . '/' . $item;

            if (is_dir($sourcePath)) {
                // Create corresponding directory in Spanish if it doesn't exist
                if (!File::exists($targetPath)) {
                    File::makeDirectory($targetPath, 0755, true);
                }
                $this->processLanguageDirectory($sourcePath, $targetPath, $translator);
            } else {
                $this->processFile($sourcePath, $targetPath, $translator);
            }
        }
    }

    protected function processFile($sourceFile, $targetFile, $translator)
    {
        $extension = pathinfo($sourceFile, PATHINFO_EXTENSION);

        // Skip if target exists and --force not used
        if (File::exists($targetFile) && !$this->option('force')) {
            $this->line("Skipped (exists): " . str_replace(resource_path('lang/en/'), '', $sourceFile));
            return;
        }

        try {
            if ($extension === 'php' && !$this->option('skip-php')) {
                $this->translatePhpFile($sourceFile, $targetFile, $translator);
            } elseif ($extension === 'html' && !$this->option('skip-html')) {
                $this->translateHtmlFile($sourceFile, $targetFile, $translator);
            } else {
                $this->line("Skipped (unsupported): " . str_replace(resource_path('lang/en/'), '', $sourceFile));
            }
        } catch (\Exception $e) {
            $this->error("Failed to translate: " . str_replace(resource_path('lang/en/'), '', $sourceFile));
            $this->error("Error: " . $e->getMessage());
        }
    }

    protected function translatePhpFile($sourceFile, $targetFile, $translator)
    {
        $enData = require $sourceFile;

        if (!is_array($enData)) {
            $this->error("Invalid PHP array in: " . $sourceFile);
            return;
        }

        $esData = $this->translateArray($enData, $translator);

        $content = "<?php\n\nreturn " . var_export($esData, true) . ";\n";
        File::put($targetFile, $content);

        $this->info("Translated PHP: " . str_replace(resource_path('lang/en/'), '', $sourceFile));
    }

    protected function translateHtmlFile($sourceFile, $targetFile, $translator)
    {
        $content = File::get($sourceFile);

        // Skip empty files
        if (empty(trim($content))) {
            File::put($targetFile, $content);
            $this->line("Copied (empty): " . str_replace(resource_path('lang/en/'), '', $sourceFile));
            return;
        }

        // Use DOMDocument to parse HTML and only translate text content
        $dom = new DOMDocument();
        @$dom->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        // Translate text nodes while preserving HTML structure
        $this->translateDomNode($dom, $translator);

        // Save the translated HTML
        $translatedContent = $dom->saveHTML();
        File::put($targetFile, $translatedContent);

        $this->info("Translated HTML: " . str_replace(resource_path('lang/en/'), '', $sourceFile));
    }

    protected function translateDomNode($node, $translator)
    {
        if ($node->nodeType === XML_TEXT_NODE) {
            // Translate text content but preserve whitespace-only nodes
            $text = trim($node->nodeValue);
            if (!empty($text)) {
                try {
                    $translatedText = $translator->translate($text);
                    $node->nodeValue = $translatedText;
                    // Small delay to avoid rate limiting
                    usleep(500000); // 0.5 second delay
                } catch (\Exception $e) {
                    $this->error("Translation failed for text: " . substr($text, 0, 50) . "...");
                    // Keep original text on error
                }
            }
        } elseif ($node->nodeType === XML_ELEMENT_NODE) {
            // Skip translation for specific elements or attributes
            if ($node->nodeName === 'script' || $node->nodeName === 'style') {
                return; // Don't translate script or style content
            }

            // Recursively process child nodes
            foreach ($node->childNodes as $child) {
                $this->translateDomNode($child, $translator);
            }
        }
    }

    protected function translateArray($array, $translator)
    {
        $result = [];

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $result[$key] = $this->translateArray($value, $translator);
            } else {
                // Skip translation if value is empty or only whitespace
                if (trim($value) === '') {
                    $result[$key] = $value;
                    continue;
                }

                try {
                    // Check if value contains HTML
                    if ($this->containsHtml($value)) {
                        // Use DOMDocument to parse and translate only text content
                        $result[$key] = $this->translateHtmlContent($value, $translator);
                    } else {
                        // Regular text translation
                        $result[$key] = $translator->translate($value);
                    }

                    // Small delay to avoid rate limiting
                    usleep(500000); // 0.5 second delay
                } catch (\Exception $e) {
                    $this->error("Translation failed for key '{$key}': " . $e->getMessage());
                    $result[$key] = $value; // Keep original on error
                }
            }
        }

        return $result;
    }

    protected function containsHtml($string)
    {
        return $string !== strip_tags($string);
    }

    protected function translateHtmlContent($html, $translator)
    {
        // Use DOMDocument to parse HTML and only translate text content
        $dom = new DOMDocument();
        @$dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        // Translate text nodes while preserving HTML structure
        $this->translateDomNode($dom, $translator);

        // Save the translated HTML
        return $dom->saveHTML();
    }
}
