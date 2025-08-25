<?php
use Illuminate\Support\Facades\Route;
use App\Models\Book;

use App\Http\Controllers\Api\BookController;

Route::get('/books', [BookController::class, 'index']);        // Lấy danh sách sách
Route::get('/books/{id}', [BookController::class, 'show']);   // Xem chi tiết sách
Route::post('/books', [BookController::class, 'store']);      // Thêm sách
Route::put('/books/{id}', [BookController::class, 'update']); // Sửa sách
Route::delete('/books/{id}', [BookController::class, 'destroy']); // Xoá sách
// Route::post('/books', [BookController::class, 'store']);

// Route::prefix('v1')->group(function () {
//     // Public
//     Route::post('register', [AuthController::class,'register']);
//     Route::post('login', [AuthController::class,'login']);

//     Route::get('categories', [CategoryController::class,'index']);
//     Route::get('categories/{category}', [CategoryController::class,'show']);
//     Route::get('products', [ProductController::class,'index']);
//     Route::get('products/{product}', [ProductController::class,'show']);

//     // Protected
//     Route::middleware('auth:sanctum')->group(function () {
//         Route::post('logout', [AuthController::class,'logout']);
//         Route::get('me', [AuthController::class,'me']);
//         Route::post('upload', [FileController::class,'upload']);
//         Route::apiResource('orders', OrderController::class)->only(['index','store','show']);

//         // Admin protected
//         Route::middleware('admin')->prefix('admin')->group(function () {
//             Route::apiResource('products', ProductController::class)->except(['index','show']);
//             Route::apiResource('categories', CategoryController::class)->only(['store','update','destroy']);
//             Route::apiResource('users', UserController::class);
//             Route::get('stats', [DashboardController::class,'stats']);



       


//         });
        
//     });
// });

