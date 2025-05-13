<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductAdmin\ProductController;
use App\Http\Controllers\ProductAdmin\UploadImage;

Route::prefix('product')->group(function () {

    Route::get('/list', [ProductController::class, 'index'])->name('admin.product.list');
    
    Route::get('/create', [ProductController::class, 'create'])->name('admin.product.create');
    
    Route::post('/store', [ProductController::class, 'store'])->name('admin.product.store');
    
    Route::post('/uploadImage', [UploadImage::class, 'store'])->name('admin.product.uploadImage');
    
    Route::delete('/delete-image/{id}', [UploadImage::class, 'deleteImage'])->name('admin.product.deleteImage');

    Route::get('/{product_id}/edit', [ProductController::class, 'edit'])->name('admin.product.edit');

    Route::put('/{product_id}/update', [ProductController::class, 'update'])->name('admin.product.update');

});