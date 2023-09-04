<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Requests\OrderRequest;

Route::controller(AuthController::class)->group(
    function () {
        Route::post('login', 'login');
        Route::post('register', 'register');
        Route::post('logout', 'logout');
        Route::post('refresh', 'refresh');
       // Route::get('discount', 'discount');
    }
);

Route::get('/discount/{id}',[OrderController::class, 'discount']);