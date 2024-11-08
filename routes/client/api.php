<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\{DashboardController, CartController, OrderHistoryController, AuthApiController};

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

Route::post('/register', [AuthApiController::class, 'register'])->name('register.store')->withoutMiddleware(['auth:api']);
Route::post('/login', [AuthApiController::class, 'login'])->name('store')->withoutMiddleware(['auth:api']);
Route::post('/logout', [AuthApiController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::post('/add_to_cart/{productId}', [CartController::class, 'addToCart'])->name('addToCart');
Route::get('/cart', [CartController::class, 'viewCart'])->name('viewCart');
Route::delete('/remove_from_cart/{productId}', [CartController::class, 'removeFromCart'])->name('removeFromCart');
Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');
Route::get('/checkout_success/{order}', [CartController::class, 'success'])->name('checkout.success');

Route::get('/order_history', [OrderHistoryController::class, 'list'])->name('order.list');


