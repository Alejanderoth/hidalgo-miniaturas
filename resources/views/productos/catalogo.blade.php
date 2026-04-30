@extends('layouts.public')

@section('content')

<div class="container">

    @if(isset($categoria))
        <h2>Catálogo - {{ $categoria->nombre }}</h2>
    @else
        <h2>Catálogo de productos</h2>
    @endif

    @if($productos->isEmpty())
        <p>No hay productos disponibles.</p>
    @else

        <div class="catalogo-grid">

            @foreach($productos as $producto)
                <div class="producto-card">

                    <a href="/producto/{{ $producto->id }}" class="producto-imagen">
                        @if($producto->imagen)
                            <img src="{{ asset('img/productos/' . $producto->imagen) }}" alt="{{ $producto->nombre }}">
                        @else
                            <div class="sin-imagen">Sin imagen</div>
                        @endif
                    </a>

                    <div class="producto-info">
                        <p class="producto-categoria">
                            {{ $producto->category ? $producto->category->nombre : 'Sin categoría' }}
                        </p>

                        <h3>
                            <a href="/producto/{{ $producto->id }}">
                                {{ $producto->nombre }}
                            </a>
                        </h3>

                        <p class="producto-descripcion">
                            {{ $producto->descripcion }}
                        </p>

                        <p class="producto-precio">
                            {{ number_format($producto->precio, 2) }} €
                        </p>

                        <form action="/carrito/agregar/{{ $producto->id }}" method="POST">
                            @csrf
                            <button type="submit" class="boton">Añadir a la cesta</button>
                        </form>
                    </div>

                </div>
            @endforeach

        </div>

    @endif

</div>

@endsection