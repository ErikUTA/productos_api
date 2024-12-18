<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('products',[ProductController::class, 'getProducts']);
Route::get('product',[ProductController::class, 'getProduct']);
Route::post('product',[ProductController::class, 'postProduct']);
Route::put('product',[ProductController::class, 'updateProduct']);
Route::delete('product',[ProductController::class, 'deleteProduct']);
