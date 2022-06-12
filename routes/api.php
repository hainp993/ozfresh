<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WareHouseBillController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::resource('/contact', ContactController::class);

Route::prefix('/admin')->group(function () {
    Route::post('/login', [AdminController::class, 'login']);

        Route::resource('/author', AuthorController::class);
        Route::resource('/publisher', PublisherController::class);
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('/upload', [AdminController::class, 'upload']);

        Route::put('/profile', [UserController::class, 'updateProfile']);

        Route::resource('/category', CategoryController::class);

        Route::resource('/blog-category', BlogCategoryController::class);
        Route::resource('/blog-post', BlogPostController::class);

        Route::resource('/product', ProductController::class);

        Route::resource('/product-category', ProductCategoryController::class);

        Route::resource('/order', OrderController::class);

        Route::resource('/ware-house/bill', WareHouseBillController::class);

        // Quản lí khách hàng

        Route::resource('/customer', CustomerController::class);

        // BÁO CÁO TỔNG QUAN

        Route::get('/report/overview', [ReportController::class, 'overview']);

        // BÁO CÁO KHÁCH HÀNG
        Route::get('/report/customer', [ReportController::class, 'customer']);

        // BÁO CÁO DOANH THU
        Route::get('/report/revenue', [ReportController::class, 'revenue']);

    });
});
