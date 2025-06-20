<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\OrderAdminController;
use App\Http\Controllers\CategoriesAdmin\HandllerImage;
use App\Http\Controllers\ProductAdmin\ProductController;

Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => 'guest:admin'], function () {
        Route::get('/login', [AdminLoginController::class, 'index'])->name('login');
        Route::post('/authenticate', [AdminLoginController::class, 'authenticate'])->name('authenticate');
    });



    /* start admin =========================================================================================================*/
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get('/dashboard', [AdminLoginController::class, 'returnDashboard'])->name('admin.dashboard');
        Route::get('/order', [OrderAdminController::class, 'index'])->name('admin.order');
        Route::get('/orderDetails/{idOrder}', [OrderAdminController::class, 'indexDetails'])->name('admin.orderDetails');
        Route::post('logout', [AdminLoginController::class, 'destroy'])
        ->name('logout');
        
        
        Route::get('/discount/create', [OrderAdminController::class, 'discountCreate'])->name('admin.discountCreate');
        Route::get('/user/create', [OrderAdminController::class, 'userCreate'])->name('admin.userCreate');
        Route::get('/user/user', [OrderAdminController::class, 'userUser'])->name('admin.userUser');


        /* start category =========================================================================================================*/
        Route::post('/category/uploadImage', [HandllerImage::class, 'store'])->name('admin.category.uploadImage');
        require __DIR__ . '/category.php';
        require __DIR__ . '/pp.php';
        /* start category =========================================================================================================*/
    });
});
/* end admin =========================================================================================================*/


/* start product =========================================================================================================*/
require __DIR__ . '/front.php';
/* end product =====================================================================================================================*/


/* start product =========================================================================================================*/
require __DIR__ . '/home_auth.php';
/* end product =====================================================================================================================*/
