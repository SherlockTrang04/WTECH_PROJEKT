<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminProductController;


Route::get('/', function () {
    $categories = \App\Models\Category::all();
    $featured   = \App\Models\Product::where('is_active', true)->with('images')->inRandomOrder()->limit(6)->get();
    return view('index', compact('categories', 'featured'));
})->name('home');

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
    if (\Illuminate\Support\Facades\Auth::check()) {
        $cart = \App\Models\Cart::with('items.product')->where('user_id', \Illuminate\Support\Facades\Auth::id())->first();
    } else {
        $cart = \App\Models\Cart::with('items.product')->where('session_id', session()->getId())->first();
    }
    $subtotal = $cart ? $cart->items->sum(fn($i) => $i->product->price * $i->quantity) : 0;
    return view('shipping', compact('subtotal'));
});
Route::post('/order', [OrderController::class, 'store'])->name('order.store');
Route::get('/order-confirmation/{id}', [OrderController::class, 'confirmation'])->name('order.confirmation');

Route::get('/orderstatus', function () {
    return view('orderstatus');
});

Route::get('/cart', [CartController::class, 'show']);
Route::patch('/cart/{item}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{item}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');

Route::get('/rezervationstatus', function () {
    return view('index');
});
Route::get('/admin-login', [AuthController::class, 'showAdminLogin'])->name('admin-login');
Route::post('/admin-login', [AuthController::class, 'adminLogin'])->name('admin-login.post');

Route::middleware(['admin'])->group(function () {

    Route::get('/admin', [AdminProductController::class, 'index']);
    Route::post('/admin/products', [AdminProductController::class, 'store'])->name('admin.products.store');
    Route::put('/admin/products/{product}', [AdminProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/admin/products/{product}', [AdminProductController::class, 'destroy'])->name('admin.products.destroy');

});



