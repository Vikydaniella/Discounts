<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CustomersController;

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');

});

Route::group(['middleware' => ['api']],function () {
    Route::get('customer', [CustomersController::class, 'index']);
    Route::post('customer', [CustomersController::class, 'store']);
    Route::get('customer/{id}', [CustomersController::class, 'show']);
    Route::get('customers/{id}', [CustomersController::class, 'discount']);
    Route::put('customer/{id}', [CustomersController::class, 'update']);
    Route::delete('customer/{id}', [CustomersController::class, 'destroy']);
}); 

Route::group(['middleware' => ['api']],function () {
    Route::get('product', [ProductsController::class, 'index']);
    Route::post('product', [ProductsController::class, 'store']);
    Route::get('product/{id}', [ProductsController::class, 'show']);
    Route::get('products/{id}', [ProductsController::class, 'switchDiscount']);
    Route::get('productss/{id}', [ProductsController::class, 'toolDiscount']);
    Route::put('product/{id}', [ProductsController::class, 'update']);
    Route::delete('product/{id}', [ProductsController::class, 'destroy']);
});