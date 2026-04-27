<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
        $productos = Product::with('category')->get();

        return view('productos.listado', compact('productos'));
    }

    public function create()
    {
    $categories = Category::all();

    return view('productos.crear', compact('categories'));
    }

    public function store(Request $request)
    {
    $request->validate([
        'categoria_id' => 'required|exists:categories,id',
        'nombre' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'precio' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'imagen' => 'nullable|string|max:255',
        'activo' => 'required|boolean',
    ]);

    Product::create([
        'categoria_id' => $request->categoria_id,
        'nombre' => $request->nombre,
        'descripcion' => $request->descripcion,
        'precio' => $request->precio,
        'stock' => $request->stock,
        'imagen' => $request->imagen,
        'activo' => $request->activo,
    ]);

    return redirect('/panel/productos');
    }

    public function edit($id)
    {
    $producto = Product::find($id);
    $categories = Category::all();

    return view('productos.editar', compact('producto', 'categories'));
    }

    public function update(Request $request, $id)
    {
    $request->validate([
        'categoria_id' => 'required|exists:categories,id',
        'nombre' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'precio' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'imagen' => 'nullable|string|max:255',
        'activo' => 'required|boolean',
    ]);

    $producto = Product::find($id);

    if (!$producto) {
        return redirect('/panel/productos');
    }

    $producto->update([
        'categoria_id' => $request->categoria_id,
        'nombre' => $request->nombre,
        'descripcion' => $request->descripcion,
        'precio' => $request->precio,
        'stock' => $request->stock,
        'imagen' => $request->imagen,
        'activo' => $request->activo,
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

    public function catalogo()
    {
    $productos = Product::with('category')
        ->where('activo', 1)
        ->get();

    return view('productos.catalogo', compact('productos'));
    }
}
