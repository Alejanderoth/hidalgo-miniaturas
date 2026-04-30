@extends('layouts.public')

@section('content')

<div class="container">

    <h2>Mi cuenta</h2>

    <div class="cuenta-grid">

        <section class="cuenta-card">
            <h3>Datos del usuario</h3>

            <p><strong>Nombre:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>

            <a class="boton" href="/profile">Editar datos</a>
        </section>

        <section class="cuenta-card">
            <h3>Resumen</h3>

            <p><strong>Pedidos realizados:</strong> {{ $pedidos->count() }}</p>

            @if($pedidos->isNotEmpty())
                <p><strong>Último pedido:</strong> #{{ $pedidos->last()->id }}</p>
                <p><strong>Estado:</strong> {{ $pedidos->last()->estado }}</p>
            @else
                <p>Aún no has realizado pedidos.</p>
            @endif
        </section>

    </div>

    <h3>Histórico de pedidos</h3>

    @if($pedidos->isEmpty())
        <div class="cuenta-card">
            <p>No tienes pedidos todavía.</p>
            <a class="boton" href="/catalogo">Ver catálogo</a>
        </div>
    @else
        <div class="pedidos-lista">
            @foreach($pedidos as $pedido)
                <div class="pedido-card">
                    <div class="pedido-cabecera">
                        <h4>Pedido #{{ $pedido->id }}</h4>
                        <span class="estado estado-{{ $pedido->estado }}">{{ $pedido->estado }}</span>
                    </div>

                    <p><strong>Total:</strong> {{ number_format($pedido->total, 2) }} €</p>
                    <p><strong>Fecha:</strong> {{ $pedido->created_at }}</p>

                    <h5>Productos</h5>

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
        </div>
    @endif

</div>

@endsection