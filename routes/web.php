<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\StripePaymentController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [ProductController::class, 'index']);

Route::get('cart', [ProductController::class, 'cart'])->name('cart');

Route::get('add-to-cart/{id}', [ProductController::class, 'addToCart'])->name('add.to.cart');

Route::patch('update-cart', [ProductController::class, 'update'])->name('update.cart');

Route::delete('remove-from-cart', [ProductController::class, 'remove'])->name('remove.from.cart');

Route::get('checkout', [ProductController::class, 'checkout'])->name('checkout');
Route::post('order', [ProductController::class, 'order'])->name('order');


Route::controller(StripePaymentController::class)->group(function () {
    Route::get('stripe', 'stripe');
    Route::post('stripe', 'stripePost')->name('stripe.post');
});
