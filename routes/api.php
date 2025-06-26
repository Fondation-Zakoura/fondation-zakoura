<?php

use App\Http\Controllers\Api\Category;
use App\Http\Controllers\Product;
use App\Http\Controllers\Api\ProjectController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Api\ProjectTypeController;
use App\Http\Controllers\Api\ProjectStatusController;
use App\Http\Controllers\Api\BankAccountController;



Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::prefix('categories')->group(function () {
        Route::get('/', [Category::class, 'index']);
        Route::post('/', [Category::class, 'store']);
        Route::get('{id}', [Category::class, 'show']);
        Route::put('{id}', [Category::class, 'update']);
        Route::delete('{id}', [Category::class, 'destroy']);
        Route::post('bulk-delete', [Category::class, 'bulkDestroy']);
    });
    Route::post('/forgot', [ForgotPasswordController::class, 'sendResetLinkEmail']);
    Route::post('/reset', [ResetPasswordController::class, 'reset']);
});

Route::apiResource('projects', ProjectController::class);
Route::apiResource('project-types', ProjectTypeController::class);
Route::apiResource('project-statuses', ProjectStatusController::class);
Route::apiResource('bank-accounts', BankAccountController::class);
Route::delete('projects/bulk-delete', [ProjectController::class, 'bulkDestroy']);
