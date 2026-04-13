<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('inicio');
});

Route::get('/productos', [ProductController::class, 'index']);

Route::get('/productos/listado', [ProductController::class, 'listado']);

Route::get('/productos/crear', [ProductController::class, 'create']);

Route::post('/productos', [ProductController::class, 'store']);

Route::get('/productos/{id}', [ProductController::class, 'show']);
