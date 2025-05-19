<?php

use App\Http\Controllers\Api\ProductApiController;
use Illuminate\Support\Facades\Route;

Route::middleware('client.auth')->group(function() {
    Route::get('/products', [ProductApiController::class, 'index']);
}); 