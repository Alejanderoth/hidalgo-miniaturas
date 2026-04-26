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

    public function create()
    {
        return view('productos.crear');
    }

    public function store(Request $request)
    {
    $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'precio' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'imagen' => 'nullable|string|max:255',
    ]);

    Product::create([
        'nombre' => $request->nombre,
        'descripcion' => $request->descripcion,
        'precio' => $request->precio,
        'stock' => $request->stock,
        'imagen' => $request->imagen,
    ]);

    return redirect('/panel/productos');
    }

    public function edit($id)
    {
        $producto = Product::find($id);

        if (!$producto) {
            return redirect('/panel/productos');
        }

        return view('productos.editar', compact('producto'));
    }

    public function update(Request $request, $id)
    {
    $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'precio' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'imagen' => 'nullable|string|max:255',
    ]);

    $producto = Product::find($id);

    if (!$producto) {
        return redirect('/panel/productos');
    }

    $producto->update([
        'nombre' => $request->nombre,
        'descripcion' => $request->descripcion,
        'precio' => $request->precio,
        'stock' => $request->stock,
        'imagen' => $request->imagen,
    ]);

    return redirect('/panel/productos');
    }

    public function destroy($id)
    {
        $producto = Product::find($id);

        if (!$producto) {
            return redirect('/panel/productos');
        }

        $producto->delete();

        return redirect('/panel/productos');
    }
}
