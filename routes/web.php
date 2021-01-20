<?php

use App\Http\Controllers\AddProductController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProductDetailsController;
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
Route::get('/sellers', [SellerHomeController::class, 'index'])->name('home.sellers')->middleware('seller');

Route::get('/category/{category:slug}', [CategoryController::class, 'index'])
    ->name('category');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/register/seller', [RegisterController::class, 'indexSeller'])->name('register.seller');
Route::post('/register/seller', [RegisterController::class, 'storeSeller']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/sellers/add', [AddProductController::class, 'index'])->name('seller.add');
Route::post('/sellers/add', [AddProductController::class, 'store']);

Route::get('/product/{product:id}/{name}', [ProductDetailsController::class, 'index'])->name('product');
