<?php

use App\Http\Controllers\Category;
use App\Http\Controllers\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/products', [Product::class, 'store']);
    Route::get('/products', [Product::class, 'index']);
    Route::get('/categories', [Category::class, 'index']);
    Route::post('/categories', [Category::class, 'store']);
    Route::post('/forgot', [ForgotPasswordController::class, 'sendResetLinkEmail']);
    Route::post('/reset', [ResetPasswordController::class, 'reset']);
});
