<?php

use App\Http\Controllers\Api\NaturePartenaireController;
use App\Http\Controllers\Api\OptionsController;
use App\Http\Controllers\Api\PartenaireController;
use App\Http\Controllers\Api\StatutPartenaireController;
use App\Http\Controllers\Api\StructurePartenaireController;

use App\Http\Controllers\Api\Category;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Product;
use Illuminate\Support\Facades\Route;


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
    Route::apiResource('natures-partenaires', NaturePartenaireController::class);
    Route::apiResource('structures-partenaires', StructurePartenaireController::class);
    Route::apiResource('statuts-partenaires', StatutPartenaireController::class);
    Route::post('partenaires/bulk-delete', [PartenaireController::class, 'bulkDelete']);

    Route::apiResource('partenaires', PartenaireController::class);
});
