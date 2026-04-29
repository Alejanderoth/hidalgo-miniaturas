<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('inicio');
});

// Rutas públicas de productos
Route::get('/productos', [ProductController::class, 'index']);
Route::get('/productos/{id}', [ProductController::class, 'show']);
Route::get('/catalogo', [ProductController::class, 'catalogo']);
Route::get('/carrito', [ProductController::class, 'verCarrito']);

// Dashboard de Breeze
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas protegidas de perfil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas internas protegidas del panel
Route::middleware(['auth', 'role:empleado,administrador'])->group(function () {
    Route::get('/panel/productos', [ProductController::class, 'listado']);
    Route::get('/panel/productos/crear', [ProductController::class, 'create']);
    Route::post('/panel/productos', [ProductController::class, 'store']);
    Route::get('/panel/productos/{id}/editar', [ProductController::class, 'edit']);
    Route::put('/panel/productos/{id}', [ProductController::class, 'update']);
    Route::delete('/panel/productos/{id}', [ProductController::class, 'destroy']);
});

require __DIR__.'/auth.php';