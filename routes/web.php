<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('inicio');
});

// Rutas públicas
Route::get('/productos', [ProductController::class, 'index']);

Route::get('/productos/{id}', [ProductController::class, 'show']);

// Rutas internas del panel
Route::get('/panel/productos', [ProductController::class, 'listado']);

Route::get('/panel/productos/crear', [ProductController::class, 'create']);

Route::post('/panel/productos', [ProductController::class, 'store']);

Route::get('/panel/productos/{id}/editar', [ProductController::class, 'edit']);

Route::put('/panel/productos/{id}', [ProductController::class, 'update']);

Route::delete('/panel/productos/{id}', [ProductController::class, 'destroy']);