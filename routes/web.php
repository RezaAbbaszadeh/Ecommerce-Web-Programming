<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;

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
Route::get('/sellers', [HomeController::class, 'index'])->name('home.sellers')->middleware('seller');

Route::get('/category', function () {
    return view('category.index');
});

Route::get('/category', [CategoryController::class, 'index'])
    ->name('category');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/register/seller', [RegisterController::class, 'indexSeller'])->name('register.seller');
Route::post('/register/seller', [RegisterController::class, 'storeSeller']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);


Route::post('/logout', [LogoutController::class, 'store'])->name('logout');



