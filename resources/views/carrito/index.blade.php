@extends('layouts.public')

@section('content')

<div class="container">

    <h2>Carrito de compra</h2>

    @if(empty($carrito))
        <div class="carrito-vacio">
            <p>No hay productos en el carrito.</p>
            <a class="boton" href="/catalogo">Ir al catálogo</a>
        </div>
    @else

        <div class="carrito-lista">

            @php $total = 0; @endphp

            @foreach($carrito as $id => $item)
                @php
                    $subtotal = $item['precio'] * $item['cantidad'];
                    $total += $subtotal;
                @endphp

                <div class="carrito-item">

                    <div class="carrito-img">
                        <img src="{{ asset('img/productos/' . $item['imagen']) }}">
                    </div>

                    <div class="carrito-info">
                        <h3>{{ $item['nombre'] }}</h3>

                        <p>Precio: {{ number_format($item['precio'], 2) }} €</p>
                        <p>Subtotal: {{ number_format($subtotal, 2) }} €</p>

                        <form action="/carrito/actualizar/{{ $id }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="number" name="cantidad" value="{{ $item['cantidad'] }}" min="1">
                            <button type="submit" class="boton">Actualizar</button>
                        </form>

                        <form action="/carrito/eliminar/{{ $id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="boton eliminar">Eliminar</button>
                        </form>
                    </div>

                </div>
            @endforeach

        </div>

        <div class="carrito-total">
            <h3>Total: {{ number_format($total, 2) }} €</h3>

            <form action="/pedido/confirmar" method="POST">
                @csrf
                <button class="boton">Confirmar pedido</button>
            </form>

            <form action="/carrito/vaciar" method="POST">
                @csrf
                @method('DELETE')
                <button class="boton eliminar">Vaciar carrito</button>
            </form>
        </div>

    @endif

</div>

@endsection