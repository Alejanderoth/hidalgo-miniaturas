<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de pedidos</title>
</head>
<body>

<h1>Panel de pedidos</h1>

<a href="/">Volver al inicio</a>
<br><br>
<a href="/panel/productos">Volver al panel de productos</a>

<hr>

@if($pedidos->isEmpty())
    <p>No hay pedidos registrados.</p>
@else
    @foreach($pedidos as $pedido)
        <div style="border:1px solid black; margin-bottom:20px; padding:10px;">
            <h3>Pedido #{{ $pedido->id }}</h3>

            <p><strong>Cliente:</strong> {{ $pedido->user ? $pedido->user->name : 'Usuario eliminado' }}</p>
            <p><strong>Email:</strong> {{ $pedido->user ? $pedido->user->email : 'Sin email' }}</p>
            <p><strong>Estado actual:</strong> {{ $pedido->estado }}</p>
            <p><strong>Total:</strong> {{ number_format($pedido->total, 2) }} €</p>
            <p><strong>Fecha:</strong> {{ $pedido->created_at }}</p>

            <h4>Productos</h4>
            <ul>
                @foreach($pedido->detalles as $detalle)
                    <li>
                        {{ $detalle->producto ? $detalle->producto->nombre : 'Producto eliminado' }}
                        — Cantidad: {{ $detalle->cantidad }}
                        — Precio unitario: {{ number_format($detalle->precio_unitario, 2) }} €
                        — Subtotal: {{ number_format($detalle->subtotal, 2) }} €
                    </li>
                @endforeach
            </ul>

            <form action="/panel/pedidos/{{ $pedido->id }}/estado" method="POST">
                @csrf
                @method('PUT')

                <label for="estado_{{ $pedido->id }}">Cambiar estado:</label>
                <select name="estado" id="estado_{{ $pedido->id }}">
                    <option value="pendiente" {{ $pedido->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                    <option value="preparacion" {{ $pedido->estado == 'preparacion' ? 'selected' : '' }}>Preparación</option>
                    <option value="enviado" {{ $pedido->estado == 'enviado' ? 'selected' : '' }}>Enviado</option>
                    <option value="completado" {{ $pedido->estado == 'completado' ? 'selected' : '' }}>Completado</option>
                    <option value="cancelado" {{ $pedido->estado == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                </select>

                <button type="submit">Actualizar estado</button>
            </form>
        </div>
    @endforeach
@endif

</body>
</html>