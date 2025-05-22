<?php

use App\Http\Controllers\Front\FrontController;
use Illuminate\Support\Facades\Route;

// Route::middleware('guest')->group(function () {

Route::prefix('home')->middleware('guest')->group(function () {
    Route::get('/', [FrontController::class, 'index'])->name('front.home');
    Route::get('/shop/{category_id?}/{sub_category_id?}/{brand_id?}', [FrontController::class, 'shop'])->name('front.shop');
});

Route::get('/', function () {
    return redirect()->route('front.home');
})->name('front');