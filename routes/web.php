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

Route::get('/productos/{id}/editar', [ProductController::class, 'edit']);

Route::put('/productos/{id}', [ProductController::class, 'update']);

Route::delete('/productos/{id}', [ProductController::class, 'destroy']);

Route::get('/productos/{id}', [ProductController::class, 'show']);
