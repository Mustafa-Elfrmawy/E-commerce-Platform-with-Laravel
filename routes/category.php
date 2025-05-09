<?php

use App\Models\Brand;
use App\Http\Controllers\CategoriesAdmin\Controller;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesAdmin\BrandController;
use App\Http\Controllers\CategoriesAdmin\CategoryController;
use App\Http\Controllers\admin\CategoriesAdmin\SubCategoryController;

Route::get('/category/slug', function (Request $request) {
        $slug = '';
        if (!empty($request->title)) {
                $slug = Str::slug($request->title);
                return response()->json([
                        'status' => true,
                        'slug' => $slug
                ]);
        }
})->name('admin.category.slug');

/* CategoryController ################################################################################## */
Route::get('/category/create', [CategoryController::class, 'create'])->name('admin.category.create');

Route::get('/category/list', [CategoryController::class, 'index'])->name('admin.category.list');

Route::get('/category/{categoryId}/edit', [CategoryController::class, 'edit'])->name('admin.category.edit');

Route::put('/category/{categoryId}/update', [CategoryController::class, 'update'])->name('admin.category.update');
Route::post('/category/store', [CategoryController::class, 'store'])->name('admin.category.store');

Route::delete('/category/{id}/deleteCategory', [CategoryController::class, 'destroy'])->name('admin.category.deleteCategory');

/* SubCategoryController ################################################################################## */
Route::get('/sub-category/list', [SubCategoryController::class, 'index'])->name('admin.sub-category.list');

Route::get('/sub-category/create', [SubCategoryController::class, 'create'])->name('admin.sub-category.create');

Route::get('/sub-category/{sub_categoryId}/edit', [SubCategoryController::class, 'edit'])->name('admin.sub-category.edit');

Route::put('/sub-category/{sub_categoryId}/update', [SubCategoryController::class, 'update'])->name('admin.sub-category.update');

Route::post('/sub-category/store', [SubCategoryController::class, 'store'])->name('admin.sub-category.store');

Route::delete('/sub-category/{id}/deleteCategory', [SubCategoryController::class, 'destroy'])->name('admin.sub-category.deleteCategory');

/* BrandController ################################################################################## */
Route::get('/brand/list', [BrandController::class, 'index'])->name('admin.brand.list');

Route::get('/brand/create', [BrandController::class, 'create'])->name('admin.brand.create');

Route::post('/brand/store', [BrandController::class, 'store'])->name('admin.brand.store');

Route::get('/brand/{brandId}/edit', [BrandController::class, 'edit'])->name('admin.brand.edit');

Route::put('/brand/{brandId}/update', [BrandController::class, 'update'])->name('admin.brand.update');

Route::delete('/brand/{brand_id}/deleteBrand', [BrandController::class, 'destroy'])->name('admin.brand.deleteBrand');



