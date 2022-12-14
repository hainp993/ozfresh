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

        // Qu???n l?? kh??ch h??ng

        Route::resource('/customer', CustomerController::class);

        // B??O C??O T???NG QUAN

        Route::get('/report/overview', [ReportController::class, 'overview']);

        // B??O C??O KH??CH H??NG
        Route::get('/report/customer', [ReportController::class, 'customer']);

        // B??O C??O DOANH THU
        Route::get('/report/revenue', [ReportController::class, 'revenue']);

    });
});
