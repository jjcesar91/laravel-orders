<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;


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


Route::get('/register', [RegisterController::class, 'register']);

Route::middleware(['guest'])->group(function(){

    Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');

    Route::post('/login', [LoginController::class, 'processLogin'])->name('process.login');

});

Route::middleware(['auth'])->group(function(){

    Route::get('/home', [OrderController::class, 'orders']);

    Route::get('/orders', [OrderController::class, 'orders'])->name('orders');

    Route::post('/orders', [OrderController::class, 'orders']);

    Route::get('/order/{id}', [OrderController::class, 'order']);

    Route::get('/stock/update', [OrderController::class, 'update_stock']);

    Route::get('/orders/stock/update', [OrderController::class, 'update_orders_stock']);

    Route::get('/orders/details/update', [OrderController::class, 'update_details_status']);

    Route::get('/orders/status/update', [OrderController::class, 'update_orders_status']);

    Route::get('/products', [OrderController::class, 'products']);

    Route::get('/products/{id}', [OrderController::class, 'product_list']);

});
