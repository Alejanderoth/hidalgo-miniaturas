<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $productos = Product::all();

        return response()->json($productos);
    }

    public function show($id)
    {
        $producto = Product::find($id);

        if (!$producto) {
            return response()->json([
                'mensaje' => 'Producto no encontrado'
            ], 404);
        }

        return response()->json($producto);
    }

    public function listado()
    {
        $productos = Product::all();

        return view('productos.listado', compact('productos'));
    }
}
