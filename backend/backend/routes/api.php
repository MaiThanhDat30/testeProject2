<?php
use Illuminate\Support\Facades\Route;
use App\Models\Book;

use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AdminController;

// Public routes

Route::get('/books', [BookController::class, 'index']);
Route::get('/books/{id}', [BookController::class, 'show']);

Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);

Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::post('/books', [BookController::class, 'store']);
    Route::put('/books/{id}', [BookController::class, 'update']);
    Route::delete('/books/{id}', [BookController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [UserController::class, 'profile']);
    Route::post('/update-profile', [UserController::class, 'updateProfile']);
    Route::post('/logout', [UserController::class, 'logout']);
});

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

