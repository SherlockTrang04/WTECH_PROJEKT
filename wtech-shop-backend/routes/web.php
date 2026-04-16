<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('index');
});

Route::resource('products', ProductController::class);
Route::get('/product/{id}', [ProductController::class, 'show']);
Route::get('/product_list', [ProductController::class, 'index']);
Route::get('/login', function () {
    return view('login');
});
Route::post('/login', [AuthController::class, 'login']);

Route::get('/registration', [AuthController::class, 'showForm']);
Route::post('/registration', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/user_info', function () {
    return view('user_info');
});

Route::get('/shipping', function () {
    return view('shipping');
});

Route::get('/orderstatus', function () {
    return view('orderstatus');
});

Route::get('/order-confirmation', function () {
    return view('index');
});

Route::get('/cart', function () {
    return view('cart');
});

Route::get('/rezervationstatus', function () {
    return view('index');
});
Route::get('/admin-login', function () {
    return view('admin-login');
});

Route::get('/admin', function () {
    return view('admin');
});



