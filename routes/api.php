<?php

use App\Http\Controllers\PublicSaleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('order/{order}', [PublicSaleController::class, 'getStatus']);
