@extends('layouts.public')

@section('content')

<div class="container">

    <div class="detalle-producto">

        <div class="detalle-imagen">
            @if($producto->imagen)
                <img src="{{ asset('img/productos/' . $producto->imagen) }}" alt="{{ $producto->nombre }}">
            @else
                <p>Sin imagen</p>
            @endif
        </div>

        <div class="detalle-info">
            <h2>{{ $producto->nombre }}</h2>

            <p><strong>Categoría:</strong> {{ $producto->category ? $producto->category->nombre : 'Sin categoría' }}</p>

            <p><strong>Descripción:</strong></p>
            <p>{{ $producto->descripcion }}</p>

            <p><strong>Precio:</strong> {{ number_format($producto->precio, 2) }} €</p>

            <p><strong>Stock disponible:</strong> {{ $producto->stock }}</p>

            @if($producto->stock > 0)
                <form action="/carrito/agregar/{{ $producto->id }}" method="POST">
                    @csrf
                    <button type="submit" class="boton">Añadir al carrito</button>
                </form>
            @else
                <p>Producto sin stock disponible.</p>
            @endif
        </div>

    </div>

    <div class="info-producto">
        <h2>Información del producto</h2>

        <p>
            Figura histórica perteneciente a la categoría {{ $producto->category ? $producto->category->nombre : 'sin categoría' }}.
            Producto orientado a coleccionismo y modelismo histórico.
        </p>

        <p><strong>Nota:</strong> Las figuras se entregan sin montar ni pintar.</p>
    </div>

</div>

@endsection