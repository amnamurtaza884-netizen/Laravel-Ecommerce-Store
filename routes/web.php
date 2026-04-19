<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| SHOP (FRONT PAGE)
|--------------------------------------------------------------------------
*/
Route::get('/shop', [ProductController::class, 'shop'])->name('shop');

/*
|--------------------------------------------------------------------------
| SINGLE PRODUCT PAGE
|--------------------------------------------------------------------------
*/
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

/*
|--------------------------------------------------------------------------
| CHECKOUT (NEW ADD)
|--------------------------------------------------------------------------
*/
Route::get('/checkout/{id}', [OrderController::class, 'checkout'])->middleware('auth')->name('checkout');

Route::post('/order/store', [OrderController::class, 'store'])->middleware('auth')->name('order.store');

/*
|--------------------------------------------------------------------------
| PRODUCTS (ADMIN PANEL)
|--------------------------------------------------------------------------
*/
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

/*
|--------------------------------------------------------------------------
| DASHBOARD (ADMIN)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', [AdminController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

/*
|--------------------------------------------------------------------------
| CONTACT (CUSTOMER)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/contact', [CustomerController::class, 'create'])->name('contact.create');
    Route::post('/contact', [CustomerController::class, 'store'])->name('contact.store');
    Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');

});

/*
|--------------------------------------------------------------------------
| ORDERS
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders/update/{id}', [OrderController::class, 'updateStatus'])->name('orders.update');
    Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');

});

/*
|--------------------------------------------------------------------------
| CART
|--------------------------------------------------------------------------
*/
Route::post('/cart/add/{product_id}', [\App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
Route::middleware('auth')->group(function () {
    Route::get('/cart', [\App\Http\Controllers\CartController::class, 'view'])->name('cart.view');
    Route::delete('/cart/remove/{cart_id}', [\App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/clear', [\App\Http\Controllers\CartController::class, 'clear'])->name('cart.clear');
});

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';