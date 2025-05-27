<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\user\UserAuthenticateController;



Route::get('/', function () {
    return redirect()->route('front.home');
})->name('front');


#################################guestNonAuthenticateOnly routes######################################
Route::group(['middleware' => 'guest:user'], function () {
    Route::prefix('home')->group(function () {
        Route::get('/user/login', [UserAuthenticateController::class, 'index'])->name('user.login');
        Route::get('/user/register', [UserAuthenticateController::class, 'register'])->name('user.register');
        Route::post('/user/proccessRegister', [UserAuthenticateController::class, 'proccessRegister'])->name('user.proccessRegister');
        Route::post('/user/authenticate', [UserAuthenticateController::class, 'authenticate'])->name('user.authenticate');
    });
});
#################################guestNonAuthenticateOnly routes######################################

#################################guest routes#########################################################
Route::prefix('home')->middleware('guest')->group(function () {
    Route::get('/', [FrontController::class, 'index'])->name('front.home');
    Route::get('/product/{id}', [FrontController::class, 'indexProduct'])->name('front.product');
    Route::get('/shop/{category_id?}/{sub_category_id?}/{brand_id?}/{minPrice?}/{maxPrice?}', [FrontController::class, 'shop'])->name('front.shop');
});
#################################guest routes###########################################################

