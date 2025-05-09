
<?php

use App\Http\Controllers\ProductAdmin\ProductController;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



// Route::get('/brand/list', [BrandController::class, 'index'])->name('admin.brand.list');

Route::get('/product/create', [ProductController::class, 'create'])->name('admin.brand.create');

// Route::post('/brand/store', [BrandController::class, 'store'])->name('admin.brand.store');

// Route::get('/brand/{brandId}/edit', [BrandController::class, 'edit'])->name('admin.brand.edit');

// Route::put('/brand/{brandId}/update', [BrandController::class, 'update'])->name('admin.brand.update');

// Route::delete('/brand/{brand_id}/deleteBrand', [BrandController::class, 'destroy'])->name('admin.brand.deleteBrand');