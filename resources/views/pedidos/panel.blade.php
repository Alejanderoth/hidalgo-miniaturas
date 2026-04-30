@extends('layouts.panel')

@section('content')

<h2>Gestión de pedidos</h2>

<table class="tabla">

    <tr>
        <th>ID</th>
        <th>Usuario</th>
        <th>Total</th>
        <th>Estado</th>
        <th>Acción</th>
    </tr>

    @foreach($pedidos as $pedido)
        <tr>
            <td>{{ $pedido->id }}</td>
            <td>{{ $pedido->user->name }}</td>
            <td>{{ $pedido->total }} €</td>
            <td>{{ $pedido->estado }}</td>

            <td>
                <form method="POST" action="/panel/pedidos/{{ $pedido->id }}/estado">
                    @csrf
                    @method('PUT')

                    <select name="estado">
                        <option value="pendiente" {{ $pedido->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="preparacion" {{ $pedido->estado == 'preparacion' ? 'selected' : '' }}>Preparación</option>
                        <option value="enviado" {{ $pedido->estado == 'enviado' ? 'selected' : '' }}>Enviado</option>
                        <option value="completado" {{ $pedido->estado == 'completado' ? 'selected' : '' }}>Completado</option>
                        <option value="cancelado" {{ $pedido->estado == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                    </select>

    <button type="submit" class="boton">Actualizar</button>
</form>
            </td>
        </tr>
    @endforeach

</table>

@endsection