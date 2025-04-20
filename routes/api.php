<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::post('/login', [AuthController::class, 'login']);
Route::middleware(['auth:sanctum', 'throttle:api'])->group(function () {
    Route::get('/products', [ProductController::class, 'apiProducts'])->name('api.products');
});