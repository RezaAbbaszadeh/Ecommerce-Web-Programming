<?php

use App\Http\Controllers\AddProductController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\EditProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductDetailsController;
use App\Http\Controllers\SearchProductController;
use App\Http\Controllers\SellerHomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/sellers', [SellerHomeController::class, 'index'])->name('home.sellers')
    ->middleware('seller', 'throttle:5,1');

Route::get('/category/{category:slug}', [CategoryController::class, 'index'])
    ->name('category')->middleware('throttle:15,1');
// Route::get('/category/{category:slug}/{min}/{max}', [CategoryController::class, 'filter'])
//     ->name('category.filter');
// Route::post('/category', [CategoryController::class, 'filter'])->name('category.filter');

Route::get('/register', [RegisterController::class, 'index'])->name('register')->middleware(['guest', 'throttle:50,1']);;
Route::post('/register', [RegisterController::class, 'store'])->middleware(['guest', 'throttle:6,1']);;

Route::get('/register/seller', [RegisterController::class, 'indexSeller'])->name('register.seller')->middleware(['guest', 'throttle:50,1']);
Route::post('/register/seller', [RegisterController::class, 'storeSeller'])->middleware(['guest', 'throttle:6,1']);;

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware(['guest', 'throttle:50,1']);
Route::post('/login', [LoginController::class, 'store'])->middleware(['guest', 'throttle:6,1']);

Route::get('/profile/edit', [EditProfileController::class, 'index'])->name('profile.edit')->middleware('auth', 'throttle:10,1');
Route::post('/profile/edit', [EditProfileController::class, 'store'])->middleware('auth', 'throttle:10,1');

Route::post('/logout', [LogoutController::class, 'store'])->name('logout')->middleware('auth', 'throttle:5,1');

Route::get('/sellers/add', [AddProductController::class, 'index'])->name('seller.add')->middleware('seller', 'throttle:20,1');
Route::post('/sellers/add', [AddProductController::class, 'store'])->middleware('seller', 'throttle:20,1');

Route::get('/product/{product:id}/{name}', [ProductDetailsController::class, 'index'])->name('product','throttle:30,1');
Route::post('/product/add_cart', [ProductDetailsController::class, 'store'])->name('product.store')->middleware('customer','throttle:20,1');

Route::get('/user/cart/{id}', [CartController::class, 'index'])->name('cart')->middleware('customer','throttle:20,1');
Route::post('/user/cart', [CartController::class, 'store'])->middleware('customer','throttle:20,1');
Route::post('/user/cart/delete', [CartController::class, 'delete'])->name('cart.delete')->middleware('customer','throttle:20,1');
Route::post('/user/cart/update', [CartController::class, 'update'])->name('cart.update')->middleware('customer','throttle:40,1');

Route::get('/customer/orders', [OrdersController::class, 'index'])->name('orders')->middleware('customer','throttle:20,1');
Route::get('/seller/orders', [OrdersController::class, 'indexSellers'])->name('orders.sellers')->middleware('seller','throttle:20,1');

Route::post('/products/search', [SearchProductController::class, 'searchProduct'])->name('products.search')->middleware('seller','throttle:60,1');
Route::post('/search', [SearchProductController::class, 'search'])->name('search')->middleware('throttle:60,1');
