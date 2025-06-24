<?php

use App\Http\Controllers\Api\NaturePartenaireController;
use App\Http\Controllers\Api\OptionsController;
use App\Http\Controllers\Api\PartenaireController;
use App\Http\Controllers\Api\StatutPartenaireController;
use App\Http\Controllers\Api\StructurePartenaireController;
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

     Route::get('options/natures-partenaires', [OptionsController::class, 'natures']);
    Route::get('options/structures-partenaires', [OptionsController::class, 'structures']);
    Route::get('options/statuts-partenaires', [OptionsController::class, 'statuts']);

     Route::apiResource('natures-partenaires', NaturePartenaireController::class);
    Route::apiResource('structures-partenaires', StructurePartenaireController::class);
    Route::apiResource('statuts-partenaires', StatutPartenaireController::class);
     Route::delete('partenaires', [PartenaireController::class, 'bulkDelete']);

    // Routes CRUD classiques pour les partenaires
});

 Route::get('options/natures-partenaires', [OptionsController::class, 'natures']);
    Route::get('options/structures-partenaires', [OptionsController::class, 'structures']);
    Route::get('options/statuts-partenaires', [OptionsController::class, 'statuts']);

     Route::apiResource('natures-partenaires', NaturePartenaireController::class);
    Route::apiResource('structures-partenaires', StructurePartenaireController::class);
    Route::apiResource('statuts-partenaires', StatutPartenaireController::class);
     Route::delete('partenaires', [PartenaireController::class, 'bulkDelete']);
    Route::apiResource('partenaires', PartenaireController::class);
