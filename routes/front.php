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
    Route::get('/user/login', [UserAuthenticateController::class, 'index'])->name('user.login');
    Route::post('/user/authenticate', [UserAuthenticateController::class, 'authenticate'])->name('user.authenticate');
});
#################################guestNonAuthenticateOnly routes######################################
#################################guest routes#########################################################
Route::prefix('home')->middleware('guest')->group(function () {
    Route::get('/', [FrontController::class, 'index'])->name('front.home');
    Route::get('/product/{id}', [FrontController::class, 'indexProduct'])->name('front.product');
    Route::get('/shop/{category_id?}/{sub_category_id?}/{brand_id?}/{minPrice?}/{maxPrice?}', [FrontController::class, 'shop'])->name('front.shop');
});
#################################guest routes###########################################################

#################################auth routes############################################################
Route::prefix('home')->group(function () {
    Route::group(['middleware' => 'auth:user'], function () {
        Route::get('/showCart', [CartController::class, 'cart'])->name('front.showCart');
        Route::get('/quantityCartIcon', [CartController::class, 'quantityCartIcon'])->name('front.quantityCartIcon');
        Route::post('/plusQuantity', [CartController::class, 'plusQuantity'])->name('front.plusQuantity');
        Route::post('/minusQuantity', [CartController::class, 'minusQuantity'])->name('front.minusQuantity');
        Route::post('/addToCart/{id}', [CartController::class, 'addToCart'])->name('front.addToCart');
        Route::post('/user/logout', [UserAuthenticateController::class, 'destroy'])->name('user.logout');
        Route::delete('/deleteCart', [CartController::class, 'deleteCart'])->name('front.deleteCart');
    });
});
#################################auth routes############################################################
