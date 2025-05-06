<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\admin\SubCategoryController;
use App\Http\Middleware\Authenticate;

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


Route::get('/category/create', [CategoryController::class, 'create'])->name('admin.category.create');

Route::get('/category/list', [CategoryController::class, 'index'])->name('admin.category.list');

Route::get('/category/{categoryId}/edit', [CategoryController::class, 'edit'])->name('admin.category.edit');

Route::put('/category/{categoryId}/update', [CategoryController::class, 'update'])->name('admin.category.update');
Route::post('/category/store', [CategoryController::class, 'store'])->name('admin.category.store');

Route::delete('/category/{id}/deleteCategory', [CategoryController::class, 'destroy'])->name('admin.category.deleteCategory');

Route::get('/sub-category/list', [SubCategoryController::class, 'index'])->name('admin.sub-category.list');

Route::get('/sub-category/create', [SubCategoryController::class, 'create'])->name('admin.sub-category.create');

Route::get('/sub-category/{sub_categoryId}/edit', [SubCategoryController::class, 'edit'])->name('admin.sub-category.edit');

Route::put('/sub-category/{sub_categoryId}/update', [SubCategoryController::class, 'update'])->name('admin.sub-category.update');

Route::post('/sub-category/store', [SubCategoryController::class, 'store'])->name('admin.sub-category.store');

Route::delete('/sub-category/{id}/deleteCategory', [SubCategoryController::class, 'destroy'])->name('admin.sub-category.deleteCategory');

