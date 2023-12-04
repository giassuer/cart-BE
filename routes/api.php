<?php

use App\Http\Controllers\CartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(ProductController::class)
    ->name('product.')
    ->as('product')
    ->group(function () {
        Route::post('products', 'index');
    });

Route::controller(CartController::class)
    ->name('product.')
    ->as('product')
    ->group(function () {
        Route::post('cart', 'store');
        Route::get('cart', 'index');
        Route::put('cart/{id}', 'edit');
    });
