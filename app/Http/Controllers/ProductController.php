<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Pedido;
use App\Models\DetallePedido;
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

    public function verCarrito()
    {
        $carrito = session()->get('carrito', []);
        $total = 0;

        foreach ($carrito as $producto) {
            $total += $producto['precio'] * $producto['cantidad'];
        }

        return view('carrito.index', compact('carrito', 'total'));
    }

    public function añadirCarrito($id)
    {
    $producto = Product::find($id);

        if (!$producto || !$producto->activo) {
            return redirect('/catalogo');
        }

        $carrito = session()->get('carrito', []);

        if (isset($carrito[$id])) {
            $carrito[$id]['cantidad']++;
        } else {
            $carrito[$id] = [
                'nombre' => $producto->nombre,
                'precio' => $producto->precio,
                'cantidad' => 1,
                'imagen' => $producto->imagen,
            ];
        }

        session()->put('carrito', $carrito);

        return redirect('/carrito');
    }

    public function actualizarCarrito(Request $request, $id)
    {
        $request->validate([
            'cantidad' => 'required|integer|min:1',
        ]);

        $carrito = session()->get('carrito', []);

        if (isset($carrito[$id])) {
            $carrito[$id]['cantidad'] = $request->cantidad;
            session()->put('carrito', $carrito);
        }

        return redirect('/carrito');
    }

    public function eliminarDelCarrito($id)
    {
        $carrito = session()->get('carrito', []);

        if (isset($carrito[$id])) {
            unset($carrito[$id]);
            session()->put('carrito', $carrito);
        }

        return redirect('/carrito');
    }

    public function vaciarCarrito()
    {
        session()->forget('carrito');

        return redirect('/carrito');
    }

    public function confirmarPedido()
    {
        $carrito = session()->get('carrito', []);

        if (empty($carrito)) {
            return redirect('/carrito');
        }

        $total = 0;

        foreach ($carrito as $producto) {
            $total += $producto['precio'] * $producto['cantidad'];
        }

        $pedido = Pedido::create([
            'user_id' => auth()->id(),
            'estado' => 'pendiente',
            'total' => $total,
        ]);

        foreach ($carrito as $id => $producto) {
            DetallePedido::create([
                'pedido_id' => $pedido->id,
                'producto_id' => $id,
                'cantidad' => $producto['cantidad'],
                'precio_unitario' => $producto['precio'],
                'subtotal' => $producto['precio'] * $producto['cantidad'],
            ]);
        }

        session()->forget('carrito');

        return redirect('/mis-pedidos');
    }

    public function misPedidos()
    {
        $pedidos = Pedido::where('user_id', auth()->id())
            ->with('detalles.producto')
            ->get();

        return view('pedidos.mis-pedidos', compact('pedidos'));
    }
}
