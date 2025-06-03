<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\OrderController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\user\UserAuthenticateController;


#################################auth routes############################################################
Route::prefix('home')->group(function () {
    Route::group(['middleware' => 'auth:user'], function () {
        #################################Cart routes############################################################
        Route::get('/showCart', [CartController::class, 'cart'])->name('front.showCart');
        Route::get('/quantityCartIcon', [CartController::class, 'quantityCartIcon'])->name('front.quantityCartIcon');
        Route::post('/plusQuantity', [CartController::class, 'plusQuantity'])->name('front.plusQuantity');
        Route::post('/minusQuantity', [CartController::class, 'minusQuantity'])->name('front.minusQuantity');
        Route::post('/addToCart/{id}', [CartController::class, 'addToCart'])->name('front.addToCart');
        Route::delete('/deleteCart', [CartController::class, 'deleteCart'])->name('front.deleteCart');
        Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('front.checkout');
        Route::post('/checkout/store', [CheckoutController::class, 'store'])->name('front.checkout.store');
        Route::post('/applyCoupon', [CheckoutController::class, 'applyCoupon'])->name('front.applyCoupon');
        #################################Cart routes############################################################
        
        #################################Profile routes############################################################
        Route::get('/show-profile', [UserAuthenticateController::class, 'showProfile'])->name('front.profile');
        Route::post('/user/logout', [UserAuthenticateController::class, 'destroy'])->name('user.logout');
        Route::put('/user/update-information', [UserAuthenticateController::class, 'updateInformation'])->name('user.updateInformation');
        Route::get('/showOrder', [OrderController::class, 'showOrder'])->name('front.order');
        Route::get('/detailsOrder', [OrderController::class, 'detailsOrder'])->name('front.detailsOrder');
        #################################Profile routes############################################################
        
        #################################Profile routes############################################################
        #################################Profile routes############################################################
    });
});
#################################auth routes############################################################
