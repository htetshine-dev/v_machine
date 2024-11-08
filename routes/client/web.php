<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\{
    AuthenticatedSessionController as AuthController,
    RegisteredUserController as RegisterController
};
use App\Http\Controllers\Client\{DashboardController, CartController, OrderHistoryController};

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

Route::get('/', function () {
    return view('welcome');
})->name('home')->withoutMiddleware(['role:client']);

Route::get('/register', [RegisterController::class, 'create'])->name('register.create')->withoutMiddleware(['role:client']);
Route::post('/register', [RegisterController::class, 'store'])->name('register.store')->withoutMiddleware(['role:client']);

Route::get('/login', [AuthController::class, 'create'])->name('login')->withoutMiddleware(['role:client']);
Route::post('/login', [AuthController::class, 'store'])->name('store')->withoutMiddleware(['role:client']);
Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::post('/add_to_cart/{productId}', [CartController::class, 'addToCart'])->name('addToCart');
Route::get('/cart', [CartController::class, 'viewCart'])->name('viewCart');
Route::delete('/remove_from_cart/{productId}', [CartController::class, 'removeFromCart'])->name('removeFromCart');
Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');
Route::get('/checkout_success/{order}', [CartController::class, 'success'])->name('checkout.success');

Route::get('/order_history', [OrderHistoryController::class, 'list'])->name('order.list');

