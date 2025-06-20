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
Route::get('/user/changePassword/create', [UserAuthenticateController::class, 'changePasswordCreate'])
->name('user.changePassword.create');
Route::post('/user/changePassword/store', [UserAuthenticateController::class, 'changePasswordStore'])
->name('user.changePassword.store');
        Route::post('/user/logout', [UserAuthenticateController::class, 'destroy'])->name('user.logout');
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
        Route::put('/user/update-information', [UserAuthenticateController::class, 'updateInformation'])->name('user.updateInformation');
        Route::get('/showOrder', [OrderController::class, 'showOrder'])->name('user.order');
        Route::get('/detailsOrder/{idOrder}', [OrderController::class, 'detailsOrder'])->name('user.detailsOrder');
        Route::get('/wishlist', [OrderController::class, 'wishlist'])->name('user.wishlist');
        Route::post('/wishListStore', [OrderController::class, 'wishListStore'])->name('user.wishList.store');
        Route::delete('/wishListDelete', [OrderController::class, 'deleteWishList'])->name('user.wishList.delete');
        #################################Profile routes############################################################
        
        #################################Profile routes############################################################
        #################################Profile routes############################################################
    });
});
#################################auth routes############################################################
