<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

Route::get('/', function () {
    return view('index');
});

Route::resource('products', ProductController::class);
Route::get('/product/{id}', [ProductController::class, 'show']);
Route::get('/product_list', [ProductController::class, 'index']);
Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show');


//Route::get('/product_list', function () {
//    return view('product_list');
//});
Route::get('/login', function () {
    return view('login');
});
Route::post('/login', [AuthController::class, 'login']);

Route::get('/registration', [AuthController::class, 'showForm']);
Route::post('/registration', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/user_info', function () {
        return view('user_info');
    });
    Route::put('/user_info', [AuthController::class, 'updateUserInfo'])->name('user.update');
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

Route::get('/cart', [CartController::class, 'show']);
Route::patch('/cart/{item}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{item}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');

Route::get('/rezervationstatus', function () {
    return view('index');
});
Route::get('/admin-login', function () {
    return view('admin-login');
});

Route::get('/admin', function () {
    return view('admin');
});



