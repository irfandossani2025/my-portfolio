<?php

use App\Http\Controllers\JarvisController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'portfolio')->name('home');
Route::post('/jarvis/respond', JarvisController::class)->middleware('throttle:20,1')->name('jarvis.respond');
