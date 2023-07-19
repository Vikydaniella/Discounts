<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CustomersController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['api']],function () {
    Route::get('tennis', [CustomersController::class, 'index']);
    Route::post('tennis', [CustomersController::class, 'store']);
    Route::get('tennis/{id}', [CustomersController::class, 'show']);
    Route::put('tennis/{id}', [CustomersController::class, 'update']);
    Route::delete('tennis/{id}', [CustomersController::class, 'destroy']);
}); 

Route::group(['middleware' => ['api']],function () {
    Route::get('tennis', [ProductsController::class, 'index']);
    Route::post('tennis', [ProductsController::class, 'store']);
    Route::get('tennis/{id}', [ProductsController::class, 'show']);
    Route::put('tennis/{id}', [ProductsController::class, 'update']);
    Route::delete('tennis/{id}', [ProductsController::class, 'destroy']);
}); 

Route::group(['middleware' => ['api']],function () {
    Route::get('tennis', [OrdersController::class, 'index']);
    Route::post('tennis', [OrdersController::class, 'store']);
    Route::get('tennis/{id}', [OrdersController::class, 'show']);
    Route::put('tennis/{id}', [OrdersController::class, 'update']);
    Route::delete('tennis/{id}', [OrdersController::class, 'destroy']);
}); 