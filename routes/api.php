<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('login',[UserController::class,'login']);


// brand 
Route::post('brandStore', [BrandController::class, 'store'])->name('brands.store');
Route::post('brandUpdate/{brand}', [BrandController::class, 'update'])->name('brands.update');
Route::post('brandDelete/{brand}', [BrandController::class, 'destroy'])->name('brands.destroy');


// category 
Route::post('categoryStore', [CategoryController::class, 'store'])->name('categories.store');
Route::post('categoryUpdate/{category}', [CategoryController::class, 'update'])->name('categories.update');
Route::post('categoryDelete/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

// product
Route::post('productStore', [ProductController::class, 'store'])->name('product.store');
Route::post('productUpdate/{product}', [ProductController::class, 'update'])->name('product.update');
Route::post('productDelete/{product}', [ProductController::class, 'destroy'])->name('product.destroy');