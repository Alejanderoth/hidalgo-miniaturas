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

                    <select name="estado">
                        <option>Pendiente</option>
                        <option>Preparacion</option>
                        <option>Enviado</option>
                        <option>Completado</option>
                        <option>Cancelado</option>
                    </select>

                    <button class="boton">Actualizar</button>
                </form>
            </td>
        </tr>
    @endforeach

</table>

@endsection