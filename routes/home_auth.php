<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\user\UserAuthenticateController;


#################################auth routes############################################################
Route::prefix('home')->group(function () {
    Route::group(['middleware' => 'auth:user'], function () {
        Route::get('/showCart', [CartController::class, 'cart'])->name('front.showCart');
        Route::get('/quantityCartIcon', [CartController::class, 'quantityCartIcon'])->name('front.quantityCartIcon');
        Route::post('/plusQuantity', [CartController::class, 'plusQuantity'])->name('front.plusQuantity');
        Route::post('/minusQuantity', [CartController::class, 'minusQuantity'])->name('front.minusQuantity');
        Route::post('/addToCart/{id}', [CartController::class, 'addToCart'])->name('front.addToCart');
        Route::delete('/deleteCart', [CartController::class, 'deleteCart'])->name('front.deleteCart');
        Route::get('/show-profile', [UserAuthenticateController::class, 'showProfile'])->name('front.profile');
        Route::put('/user/update-information', [UserAuthenticateController::class, 'updateInformation'])->name('user.updateInformation');
        Route::post('/user/logout', [UserAuthenticateController::class, 'destroy'])->name('user.logout');
    });
});
#################################auth routes############################################################
