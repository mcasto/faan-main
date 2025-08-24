<?php

use App\Http\Controllers\AdoptionController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LegacyGivingController;
use App\Http\Controllers\MediaResourcesController;
use App\Http\Controllers\MeetFaantasticsController;
use App\Http\Controllers\ShelterProjectController;
use App\Http\Controllers\VolunteeringController;
use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '{language}'], function () {

    Route::get('home', [HomeController::class, 'show'])
        ->name('home');

    Route::get('sanctuary-project', [ShelterProjectController::class, 'show'])
        ->name('sanctuary-project.show');

    Route::get('event/{slug}', [EventController::class, 'show'])
        ->name('events.show');

    Route::get('events/{type}', [EventController::class, 'index'])
        ->name('events.index');

    Route::get('adoptions', [AdoptionController::class, 'show'])
        ->name('adoptions.show');

    Route::get('donations', [DonationController::class, 'show'])
        ->name('donations.show');

    Route::post('donations', [DonationController::class, 'process'])
        ->name('donations.process');

    Route::get('legacy-giving', [LegacyGivingController::class, 'index'])
        ->name('legacy-giving.index');

    Route::post('legacy-giving', [LegacyGivingController::class, 'store'])
        ->name('legacy-giving.store');

    Route::get('volunteering', [VolunteeringController::class, 'index'])
        ->name('volunteering.index');

    Route::get('meet-the-faan-tastics', [MeetFaantasticsController::class, 'index'])
        ->name('meet-the-faan-tastics.index');

    Route::get('media-resources', [MediaResourcesController::class, 'index'])
        ->name('media-resources.index');

    Route::get('contact', [ContactController::class, 'index'])
        ->name('contact.index');

    Route::post('contact', [ContactController::class, 'store'])
        ->name('contact.store');
})->middleware(SetLocale::class);
