<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShelterProjectController;
use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '{language}'], function () {

    Route::get('home', [HomeController::class, 'show'])
        ->name('home');

    Route::get('shelter-project', [ShelterProjectController::class, 'show'])
        ->name('home');

    Route::get('events/{type}', [EventController::class, 'index'])
        ->name('events.index');
})->middleware(SetLocale::class);
