<?php

use App\Http\Controllers\ProductPageController;
use App\Http\Controllers\BlogPageController;
use App\Http\Controllers\CartPageController;
use App\Http\Controllers\VnpayController;


use App\Http\Controllers\AdminController;
use App\Http\Controllers\SinglePageController;
use App\Http\Controllers\ShopPageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


Auth::routes();

Route::get('/product/{slug}', [ProductPageController::class, 'index'])->where('path', '[a-zA-Z0-9-/]+');


Route::get('/cart', [CartPageController::class, 'index'])->where('path', '[a-zA-Z0-9-/]+');


Route::get('/add-cart', [CartPageController::class, 'addCart'])->where('path', '[a-zA-Z0-9-/]+');
Route::get('/cart/remove-item', [CartPageController::class, 'removeProduct'])->where('path', '[a-zA-Z0-9-/]+');
Route::post('/cart/checkout', [CartPageController::class, 'checkout'])->where('path', '[a-zA-Z0-9-/]+');
Route::get('/cart/success', [CartPageController::class, 'success'])->where('path', '[a-zA-Z0-9-/]+');
Route::get('/vnpay/checkout', [VnpayController::class, 'payment'])->where('path', '[a-zA-Z0-9-/]+');
Route::get('/vnpay/success', [VnpayController::class, 'success'])->where('path', '[a-zA-Z0-9-/]+');
Route::get('/search', [ShopPageController::class, 'index'])->where('path', '[a-zA-Z0-9-/]+');

Route::get('/blog', [BlogPageController::class, 'index'])->where('path', '[a-zA-Z0-9-/]+');
Route::get('/blog/{slug}', [BlogPageController::class, 'detail'])->where('path', '[a-zA-Z0-9-/]+');
Route::get('/admin/{path?}', [AdminController::class, 'index'])->where('path', '[a-zA-Z0-9-/]+');


Route::get('/{path?}', [SinglePageController::class, 'index'])->where('path', '[a-zA-Z0-9-/]+')->name('home');

