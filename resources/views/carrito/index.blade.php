<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito</title>
</head>
<body>

<h1>Carrito</h1>

<a href="/">Volver al inicio</a>
<br><br>
<a href="/catalogo">Volver al catálogo</a>

<hr>

@if(empty($carrito))
    <p>El carrito está vacío.</p>
@else
    <table border="1">
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Producto</th>
                <th>Precio unitario</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($carrito as $id => $producto)
                <tr>
                    <td>
                        @if($producto['imagen'])
                            <img src="{{ asset('img/productos/' . $producto['imagen']) }}" width="80">
                        @else
                            Sin imagen
                        @endif
                    </td>
                    <td>{{ $producto['nombre'] }}</td>
                    <td>{{ number_format($producto['precio'], 2) }} €</td>
                    <td>{{ $producto['cantidad'] }}</td>
                    <td>{{ number_format($producto['precio'] * $producto['cantidad'], 2) }} €</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Total: {{ number_format($total, 2) }} €</h3>
@endif

</body>
</html>