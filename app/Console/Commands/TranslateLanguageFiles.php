<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslateLanguageFiles extends Command
{
    protected $signature = 'translate:all';
    protected $description = 'Translate language files from English to Spanish';

    public function handle()
    {
        $this->info('Starting translation process...');

        $translator = new GoogleTranslate('es');
        $translator->setSource('en');
        $translator->setOptions(['delay' => 1000]);

        $enBasePath = resource_path('lang/en');
        $esBasePath = resource_path('lang/es');

        // Clean and recreate Spanish directory
        if (File::exists($esBasePath)) {
            File::deleteDirectory($esBasePath);
        }
        File::makeDirectory($esBasePath, 0755, true);

        // Copy and translate files
        $this->copyAndTranslateDirectory($enBasePath, $esBasePath, $translator);

        $this->info('Translation completed successfully!');
        $this->warn('Check for erroneously translated filenames and the like.');
        $this->warn('Verify, verify, verify!');
    }

    protected function copyAndTranslateDirectory($sourcePath, $targetPath, $translator)
    {
        $items = scandir($sourcePath);

        foreach ($items as $item) {
            if (substr($item, 0, 1) == '.') continue;

            $currentSource = $sourcePath . '/' . $item;
            $currentTarget = $targetPath . '/' . $item;

            if (is_dir($currentSource)) {
                File::makeDirectory($currentTarget, 0755, true);
                $this->copyAndTranslateDirectory($currentSource, $currentTarget, $translator);
            } else {
                $this->translateFile($currentSource, $currentTarget, $translator);
            }
        }
    }

    protected function translateFile($sourceFile, $targetFile, $translator)
    {
        $extension = pathinfo($sourceFile, PATHINFO_EXTENSION);
        $content = File::get($sourceFile);

        try {
            if ($extension === 'php') {
                $translatedContent = $this->translatePhpFileContent($content, $translator);
            } elseif ($extension === 'html') {
                $translatedContent = $this->translateHtmlContent($content, $translator);
            } else {
                $translatedContent = $content; // Copy other files as-is
            }

            File::put($targetFile, $translatedContent);
            $this->info("Translated: " . basename($sourceFile));
        } catch (\Exception $e) {
            $this->error("Error with " . basename($sourceFile) . ": " . $e->getMessage());
            File::put($targetFile, $content); // Fallback to original
        }
    }

    protected function translatePhpFileContent($content, $translator)
    {
        // More robust regex to handle multi-line strings and various quote types
        return preg_replace_callback(
            '/=>\s*(([\'"])(.*?)\2)/s',
            function ($matches) use ($translator) {
                $fullMatch = $matches[1]; // The entire quoted string including quotes
                $quote = $matches[2]; // The quote character (' or ")
                $text = $matches[3]; // The text content

                // Skip file_get_contents and empty values
                if (
                    strpos($text, 'file_get_contents') === 0 ||
                    trim($text) === '' ||
                    !preg_match('/[a-zA-Z]/', $text)
                ) {
                    return "=> {$fullMatch}";
                }

                // Skip translation for known abbreviations and specific patterns
                if ($this->shouldSkipTranslation($text)) {
                    return "=> {$fullMatch}";
                }

                try {
                    $translated = $translator->translate($text);
                    usleep(500000);

                    // Preserve original capitalization for certain patterns
                    $translated = $this->preserveCapitalization($text, $translated);

                    return "=> {$quote}{$translated}{$quote}";
                } catch (\Exception $e) {
                    return "=> {$fullMatch}";
                }
            },
            $content
        );
    }

    protected function shouldSkipTranslation($text)
    {
        // List of patterns that should not be translated
        $skipPatterns = [
            '/^[a-zA-Z]{1,3}$/', // Short abbreviations (cc, CC, faq, FAQ, etc.)
            '/^[a-zA-Z]+\/[a-zA-Z]+$/', // Slash-separated abbreviations (A/B, x/y, etc.)
            '/^\$?\d+([.,]\d+)?$/', // Numbers and currency
            '/^https?:\/\//', // URLs
            '/^[\w.-]+@[\w.-]+\.\w+$/', // Email addresses
            '/^{{.*}}$/', // Template placeholders
        ];

        // List of specific words/abbreviations to skip (case-sensitive)
        $skipWords = ['cc', 'CC', 'paypal', 'PayPal', 'faq', 'FAQ'];

        foreach ($skipPatterns as $pattern) {
            if (preg_match($pattern, $text)) {
                return true;
            }
        }

        if (in_array($text, $skipWords)) {
            return true;
        }

        return false;
    }

    protected function preserveCapitalization($original, $translated)
    {
        // Preserve all-caps for abbreviations
        if (preg_match('/^[A-Z]{2,}$/', $original)) {
            return strtoupper($translated);
        }

        // Preserve title case for certain patterns
        if (preg_match('/^[A-Z][a-z]+([A-Z][a-z]+)*$/', $original)) {
            // Simple title case preservation (may need refinement for Spanish)
            return ucwords(strtolower($translated));
        }

        return $translated;
    }

    protected function translateHtmlContent($content, $translator)
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
}
