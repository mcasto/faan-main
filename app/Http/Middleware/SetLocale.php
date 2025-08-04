<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $supportedLocales = ['en', 'es'];
        $locale = 'en'; // Default to English

        // 1. Check cookie for saved preference (highest priority)
        if ($request->hasCookie('locale') && in_array($request->cookie('locale'), $supportedLocales)) {
            $locale = $request->cookie('locale');
        }
        // 2. Fall back to Accept-Language header if no cookie is set
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

        App::setLocale($locale);

        return $next($request);
    }
}
