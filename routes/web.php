<?php

use App\Livewire\Cart;
use App\Livewire\ProductShop;
use App\Livewire\SaleFinished;
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

Route::get('/compra-finalizada',SaleFinished::class)->name('compra-finalizada');

Route::get('/', ProductShop::class)->name('home');
Route::get('/carrinho', Cart::class)->name('carrinho');
