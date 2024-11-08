<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\{DashboardController, CartApiController, OrderHistoryController, AuthApiController};

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

Route::post('/checkout', [CartApiController::class, 'checkout'])->name('checkout');

Route::get('/order_history', [OrderHistoryController::class, 'list'])->name('order.list');


