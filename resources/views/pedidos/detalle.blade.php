@extends('layouts.panel')

@section('content')

<h2>Detalle del pedido #{{ $pedido->id }}</h2>

<div class="form-card">

    <h3>Información del pedido</h3>

    <p><strong>Cliente:</strong> {{ $pedido->user ? $pedido->user->name : 'Usuario eliminado' }}</p>
    <p><strong>Email:</strong> {{ $pedido->user ? $pedido->user->email : 'Sin email' }}</p>
    <p><strong>Estado:</strong> {{ $pedido->estado }}</p>
    <p><strong>Total:</strong> {{ number_format($pedido->total, 2) }} €</p>
    <p><strong>Fecha:</strong> {{ $pedido->created_at }}</p>

</div>

<h3>Artículos del pedido</h3>

<table class="tabla">
    <tr>
        <th>Producto</th>
        <th>Cantidad</th>
        <th>Precio unitario</th>
        <th>Subtotal</th>
    </tr>

    @foreach($pedido->detalles as $detalle)
        <tr>
            <td>{{ $detalle->producto ? $detalle->producto->nombre : 'Producto eliminado' }}</td>
            <td>{{ $detalle->cantidad }}</td>
            <td class="precio">{{ number_format($detalle->precio_unitario, 2) }} €</td>
            <td class="precio">{{ number_format($detalle->subtotal, 2) }} €</td>
        </tr>
    @endforeach
</table>

<br>

<a href="/panel/pedidos" class="boton-secundario">Volver a pedidos</a>

@endsection