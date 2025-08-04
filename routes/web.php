<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\FaanDataController;

// Language switcher routes
Route::get('/set-language/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'es'])) {
        // Set cookie and redirect back to where they came from
        return redirect()->back()->withCookie(cookie('locale', $locale, 525600)); // 1 year
    }
    return redirect()->back();
})->name('set-language');

// API Routes (keep existing API functionality)
Route::prefix('api')->group(function () {
    Route::get('/navigation', [FaanDataController::class, 'getNavigation']);
    Route::get('/navigation/{language}', [FaanDataController::class, 'getNavigationByLanguage']);
    Route::get('/submitted-data/stats', [FaanDataController::class, 'getSubmittedDataStats']);
    Route::get('/submitted-data/recent/{limit?}', [FaanDataController::class, 'getRecentSubmissions']);
    Route::get('/analytics/count', [FaanDataController::class, 'getAnalyticsCount']);
});

// Main routes (all use cookie-based language detection)
Route::middleware(\App\Http\Middleware\SetLocale::class)->group(function () {
    Route::get('/', [PageController::class, 'home'])->name('home');
    Route::post('/contact', [PageController::class, 'submitContact'])->name('contact.submit');
    Route::post('/donations', [PageController::class, 'submitDonation'])->name('donations.submit');

    // Test route for reCAPTCHA v3 implementation
    Route::get('/recaptcha-test', function () {
        return view('recaptcha-test');
    })->name('recaptcha.test');

    Route::get('/{path}', [PageController::class, 'show'])
        ->where('path', '.*')
        ->name('page');
});
