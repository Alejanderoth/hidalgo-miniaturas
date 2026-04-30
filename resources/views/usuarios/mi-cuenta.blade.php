<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi cuenta</title>
</head>
<body>

<h1>Mi cuenta</h1>

<a href="/">Volver al inicio</a>
<br><br>
<a href="/catalogo">Ver catálogo</a>

<hr>

<h2>Datos del usuario</h2>

<p><strong>Nombre:</strong> {{ $user->name }}</p>
<p><strong>Email:</strong> {{ $user->email }}</p>

<a href="/profile">Editar datos de usuario</a>

<hr>

<h2>Mis pedidos</h2>

@if($pedidos->isEmpty())
    <p>No tienes pedidos todavía.</p>
@else
    @foreach($pedidos as $pedido)
        <div style="border:1px solid black; margin-bottom:20px; padding:10px;">
            <h3>Pedido #{{ $pedido->id }}</h3>
            <p><strong>Estado:</strong> {{ $pedido->estado }}</p>
            <p><strong>Total:</strong> {{ number_format($pedido->total, 2) }} €</p>
            <p><strong>Fecha:</strong> {{ $pedido->created_at }}</p>

            <h4>Productos</h4>
            <ul>
                @foreach($pedido->detalles as $detalle)
                    <li>
                        {{ $detalle->producto ? $detalle->producto->nombre : 'Producto eliminado' }}
                        — Cantidad: {{ $detalle->cantidad }}
                        — Precio: {{ number_format($detalle->precio_unitario, 2) }} €
                    </li>
                @endforeach
            </ul>
        </div>
    @endforeach
@endif

</body>
</html>