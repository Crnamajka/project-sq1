<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Detail;
use App\Livewire\Cart;
use App\Livewire\Checkout;
use App\Livewire\Products;

Route::get('/',\App\Http\Controllers\HomeController::class)->name('home');
Route::get('/product',Products::class)->name('product');
Route::get('/products/{productId}', Detail::class)->name('products.show');
Route::get('/cart',Cart::class)->name('cart');
Route::get('/checkout',Checkout::class)->name('checkout');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
