<?php

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HandllerImage;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\SubCategoryController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;




Route::get('/', function () { return redirect()->route('admin.login'); })->name('login');

Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => 'guest:admin'], function () {
        Route::get('/login', [AdminLoginController::class, 'index'])->name('admin.login');
        Route::post('/authenticate', [AdminLoginController::class, 'authenticate'])->name('admin.authenticate');
    });



    Route::group(['middleware' => 'auth:admin'], function () {

        Route::get('/dashboard', [AdminLoginController::class, 'returnDashboard'])->name('admin.dashboard');
        
        
        require __DIR__ . '/category.php';

        Route::post('/category/uploadImage', [HandllerImage::class, 'store'])->name('admin.category.uploadImage');

        

        
        Route::post('logout', [AdminLoginController::class, 'destroy'])
            ->name('logout');
    });
});
