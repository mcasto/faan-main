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
                    $hasHtml = $this->containsHtml($value);

                    if ($hasHtml) {
                        $result[$key] = $this->translateHtmlContent($value, $translator);
                    } else {
                        $result[$key] = $translator->translate($value);
                    }

                    // Small delay to avoid rate limiting
                    usleep(500000);
                } catch (\Exception $e) {
                    $this->error("Translation failed for key '{$key}': " . $e->getMessage());
                    $result[$key] = $value;
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
        // Pattern to match text outside of HTML tags, including at beginning and end
        $pattern = '/(?:^|>)([^<]+)(?:<|$)/';

        return preg_replace_callback($pattern, function ($matches) use ($translator) {
            $text = trim($matches[1]);

            if (!empty($text) && preg_match('/[a-zA-Z]/', $text)) {
                try {
                    $translated = $translator->translate($text);
                    usleep(500000);

                    // Preserve the original context (whether it was at beginning, middle, or end)
                    if (strpos($matches[0], '>') === 0) {
                        return '>' . $translated; // Text was after a >
                    } elseif (substr($matches[0], -1) === '<') {
                        return $translated . '<'; // Text was before a <
                    } else {
                        return $translated; // Text was at beginning or end
                    }
                } catch (\Exception $e) {
                    $this->error("Translation failed for: " . substr($text, 0, 50) . "...");
                    return $matches[1]; // Return original text
                }
            }

            return $matches[1]; // Return original if not translatable
        }, $html);
    }

    protected function translateDomNode($node, $translator)
    {
        if ($node->nodeType === XML_TEXT_NODE) {
            $text = $node->nodeValue;
            $trimmedText = trim($text);

            // Only translate if it contains letters (not just whitespace or special chars)
            if (!empty($trimmedText) && preg_match('/[a-zA-Z]/', $trimmedText)) {
                try {
                    $translatedText = $translator->translate($trimmedText);

                    // Preserve original whitespace around the text
                    $preservedText = $this->preserveWhitespace($text, $translatedText);
                    $node->nodeValue = $preservedText;

                    usleep(500000);
                } catch (\Exception $e) {
                    // Keep original text on error
                }
            }
        } elseif ($node->nodeType === XML_ELEMENT_NODE) {
            // Skip script, style, and other non-translatable elements
            if (in_array($node->nodeName, ['script', 'style', 'code', 'pre'])) {
                return;
            }

            // Recursively process all child nodes
            foreach ($node->childNodes as $child) {
                $this->translateDomNode($child, $translator);
            }
        }
    }

    protected function preserveWhitespace($original, $translated)
    {
        // Preserve leading and trailing whitespace from original text
        $leadingWhitespace = '';
        $trailingWhitespace = '';

        if (preg_match('/^(\s+)/', $original, $matches)) {
            $leadingWhitespace = $matches[1];
        }

        if (preg_match('/(\s+)$/', $original, $matches)) {
            $trailingWhitespace = $matches[1];
        }

        return $leadingWhitespace . $translated . $trailingWhitespace;
    }
}
