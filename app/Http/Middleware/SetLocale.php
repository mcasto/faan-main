<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $supportedLocales = ['en', 'es'];
        $locale = 'en'; // Default to English

        // Read cookie first
        if ($request->hasCookie('locale') && in_array($request->cookie('locale'), $supportedLocales)) {
            $locale = $request->cookie('locale');
        }
        // Or from Accept-Language header
        elseif ($request->hasHeader('Accept-Language')) {
            $acceptedLanguages = $request->getLanguages();
            foreach ($acceptedLanguages as $language) {
                $languageCode = substr($language, 0, 2);
                if (in_array($languageCode, $supportedLocales)) {
                    $locale = $languageCode;
                    break;
                }
            }
        }

        // Set app locale before proceeding
        App::setLocale($locale);

        // Let the rest of the middleware (including CSRF) run first
        $response = $next($request);

        // Now write the cookie (after CSRF check has passed)
        if (!$request->hasCookie('locale') || $request->cookie('locale') !== $locale) {
            $response->headers->setCookie(
                cookie()->forever('locale', $locale)
            );
        }

        return $response;
    }
}
