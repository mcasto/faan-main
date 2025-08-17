<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        if ($language = $request->route('language')) {
            // Validate it's a supported language
            if (in_array($language, ['en', 'es', 'fr'])) { // Add your supported languages
                app()->setLocale($language);
            }
        }

        return $next($request);
    }
}
