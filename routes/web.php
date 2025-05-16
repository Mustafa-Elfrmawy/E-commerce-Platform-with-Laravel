<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\CategoriesAdmin\HandllerImage;
use App\Http\Controllers\ProductAdmin\ProductController;




// Route::get('/', function () {
//     return redirect()->route('admin.login');
// })->name('login');
        require __DIR__ . '/front.php';


Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => 'guest:admin'], function () {
        Route::get('/login', [AdminLoginController::class, 'index'])->name('admin.login');
        Route::post('/authenticate', [AdminLoginController::class, 'authenticate'])->name('admin.authenticate');
    });



    Route::group(['middleware' => 'auth:admin'], function () {

        /* start admin =========================================================================================================*/
        Route::get('/dashboard', [AdminLoginController::class, 'returnDashboard'])->name('admin.dashboard');
        Route::post('logout', [AdminLoginController::class, 'destroy'])
        ->name('logout');
        Route::post('/category/uploadImage', [HandllerImage::class, 'store'])->name('admin.category.uploadImage');
        /* start admin =========================================================================================================*/

        /* start category =========================================================================================================*/
        require __DIR__ . '/category.php';
        require __DIR__ . '/auth.php';
        require __DIR__ . '/pp.php';
        /* start category =========================================================================================================*/


        /* start product =========================================================================================================*/
       
/* end product =====================================================================================================================*/





    });
});
