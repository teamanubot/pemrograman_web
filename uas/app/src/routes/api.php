<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ApiKeyAuth;

// Controller baru (terpisah)
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AkunController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\PenyewaBotController;
use App\Http\Controllers\Api\StatusController;

Route::get('/', fn() => redirect('/'));
Route::get('/everything', fn() => redirect('/'));

// Route-group untuk semua endpoint with API Key
Route::middleware([ApiKeyAuth::class])->prefix('everything')->group(function () {

    // Users
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);

    // Akuns
    Route::get('/akuns', [AkunController::class, 'index']);
    Route::post('/akuns', [AkunController::class, 'store']);
    Route::get('/akuns/{id}', [AkunController::class, 'show']);
    Route::put('/akuns/{id}', [AkunController::class, 'update']);
    Route::delete('/akuns/{id}', [AkunController::class, 'destroy']);

    // Products
    Route::get('/products', [ProductController::class, 'index']);
    Route::post('/products', [ProductController::class, 'store']);
    Route::get('/products/{id}', [ProductController::class, 'show']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);

    // Penyewa Bot
    Route::get('/data-penyewa-bots', [PenyewaBotController::class, 'index']);
    Route::post('/data-penyewa-bots', [PenyewaBotController::class, 'store']);
    Route::get('/data-penyewa-bots/{id}', [PenyewaBotController::class, 'show']);
    Route::put('/data-penyewa-bots/{id}', [PenyewaBotController::class, 'update']);
    Route::delete('/data-penyewa-bots/{id}', [PenyewaBotController::class, 'destroy']);

    // Status
    Route::get('/statuses', [StatusController::class, 'index']);
    Route::post('/statuses', [StatusController::class, 'store']);
    Route::get('/statuses/{id}', [StatusController::class, 'show']);
    Route::put('/statuses/{id}', [StatusController::class, 'update']);
    Route::delete('/statuses/{id}', [StatusController::class, 'destroy']);
});