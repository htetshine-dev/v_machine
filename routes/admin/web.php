<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{DashboardController, UserController, ProductController, OrderHistoryController};
use App\Http\Controllers\Auth\AuthenticatedSessionController as AuthController;


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

Route::get('/login', [AuthController::class, 'create'])->name('login')->withoutMiddleware(['role:admin']);
Route::post('/login', [AuthController::class, 'store'])->name('store')->withoutMiddleware(['role:admin']);
Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::prefix('/user')->name('user.')
    ->group(function() {
        Route::get('/list', [UserController::class, 'index'])->name('list');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/create', [UserController::class, 'store'])->name('store');
        Route::get('/edit/{user}', [UserController::class, 'edit'])->name('edit');
        Route::post('/edit/{user}', [UserController::class, 'update'])->name('update');
        Route::get('/detail/{user}', [UserController::class, 'detail'])->name('detail');
        Route::delete('/delete/{user}', [UserController::class, 'destroy'])->name('delete');
    });

Route::prefix('/product')->name('product.')
    ->group(function() {
        Route::get('/list', [ProductController::class, 'index'])->name('list');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/create', [ProductController::class, 'store'])->name('store');
        Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('edit');
        Route::post('/edit/{product}', [ProductController::class, 'update'])->name('update');
        Route::get('/detail/{product}', [ProductController::class, 'detail'])->name('detail');
        Route::delete('/delete/{product}', [ProductController::class, 'destroy'])->name('delete');
    });

Route::prefix('order')->name('order.')
    ->group(function() {
        Route::get('/list', [OrderHistoryController::class, 'index'])->name('list');
        Route::get('/detail/{order}', [OrderHistoryController::class, 'detail'])->name('detail');
    });

