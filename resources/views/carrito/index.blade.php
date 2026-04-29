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
    @foreach($carrito as $id => $producto)
        <div style="border:1px solid black; margin-bottom:10px; padding:10px;">
            <p><strong>{{ $producto['nombre'] }}</strong></p>
            <p>Precio: {{ $producto['precio'] }} €</p>
            <p>Cantidad: {{ $producto['cantidad'] }}</p>
        </div>
    @endforeach
@endif

</body>
</html>