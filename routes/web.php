<?php

use App\Livewire\Cart;
use App\Livewire\ProductShop;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/products', function () {
        return view('products');
    })->name('products');
});

Route::get('/', ProductShop::class);
Route::get('/carrinho', Cart::class)->name('carrinho');
