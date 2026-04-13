<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/productos', [ProductController::class, 'index']);

Route::get('/productos/{id}', [ProductController::class, 'show']);
