<?php

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesAdmin\BrandController;
use App\Http\Controllers\CategoriesAdmin\CategoryController;
use App\Http\Controllers\CategoriesAdmin\SubCategoryController;

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

Route::prefix('category')->group(function () {
        Route::get('/create', [CategoryController::class, 'create'])->name('admin.category.create');
        Route::get('/list', [CategoryController::class, 'index'])->name('admin.category.list');
        Route::get('/{categoryId}/edit', [CategoryController::class, 'edit'])->name('admin.category.edit');
        Route::put('/{categoryId}/update', [CategoryController::class, 'update'])->name('admin.category.update');
        Route::post('/store', [CategoryController::class, 'store'])->name('admin.category.store');
        Route::delete('/{id}/deleteCategory', [CategoryController::class, 'destroy'])->name('admin.category.deleteCategory');
});
/* SubCategoryController ################################################################################## */
Route::prefix('sub-category')->group(function () {
        Route::get('/list', [SubCategoryController::class, 'index'])->name('admin.sub-category.list');
        Route::get('/create', [SubCategoryController::class, 'create'])->name('admin.sub-category.create');
        Route::get('/{sub_categoryId}/edit', [SubCategoryController::class, 'edit'])->name('admin.sub-category.edit');
        Route::put('/{sub_categoryId}/update', [SubCategoryController::class, 'update'])->name('admin.sub-category.update');
        Route::post('/store', [SubCategoryController::class, 'store'])->name('admin.sub-category.store');
        Route::delete('/{id}/deleteCategory', [SubCategoryController::class, 'destroy'])->name('admin.sub-category.deleteCategory');
});

/* BrandController ################################################################################## */
Route::prefix('brand')->group(function () {
        Route::get('/list', [BrandController::class, 'index'])->name('admin.brand.list');
        Route::get('/create', [BrandController::class, 'create'])->name('admin.brand.create');
        Route::post('/store', [BrandController::class, 'store'])->name('admin.brand.store');
        Route::get('/{brandId}/edit', [BrandController::class, 'edit'])->name('admin.brand.edit');
        Route::put('/{brandId}/update', [BrandController::class, 'update'])->name('admin.brand.update');
        Route::delete('/{brand_id}/deleteBrand', [BrandController::class, 'destroy'])->name('admin.brand.deleteBrand');

        
});

// require __DIR__ . '/Product.php';


