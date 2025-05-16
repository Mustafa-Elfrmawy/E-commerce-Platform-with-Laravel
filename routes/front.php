<?php

use App\Http\Controllers\Front\Frontntroller;
use Illuminate\Support\Facades\Route;

// Route::middleware('guest')->group(function () {

Route::prefix('home')->middleware('guest')->group(function () {
    Route::get('/', [Frontntroller::class, 'index'])->name('front.home');
});

Route::get('/', function () {
    return redirect()->route('front.home');
})->name('front');