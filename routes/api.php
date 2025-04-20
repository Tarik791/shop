<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware(['throttle:3,1'])->group(function () {
    Route::get('/products', [ProductController::class, 'apiProducts']);
});

