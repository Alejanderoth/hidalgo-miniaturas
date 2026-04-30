@extends('layouts.public')

@section('content')

<div class="banner">
    <h2>Hidalgo Miniaturas</h2>
    <p>Miniaturas históricas para coleccionismo y modelismo</p>
</div>

<div class="container">

    <h2>Producto destacado</h2>

    @if($destacado)
        <div class="destacado">
            <div>
                <h3>{{ $destacado->nombre }}</h3>
                <p>{{ $destacado->descripcion }}</p>
                <p><strong>{{ number_format($destacado->precio, 2) }} €</strong></p>
                <a class="boton" href="/producto/{{ $destacado->id }}">Ver producto</a>
            </div>

            <div>
                @if($destacado->imagen)
                    <img src="{{ asset('img/productos/' . $destacado->imagen) }}" alt="{{ $destacado->nombre }}">
                @endif
            </div>
        </div>
    @endif

    <h2>Categorías</h2>

    <div class="grid">
        @foreach($categories as $category)
            @php
                $productoCategoria = $category->productos->first();
            @endphp

            <a class="categoria-card" href="/categoria/{{ $category->id }}">
                @if($productoCategoria && $productoCategoria->imagen)
                    <img src="{{ asset('img/productos/' . $productoCategoria->imagen) }}" alt="{{ $category->nombre }}">
                @endif

                <span>{{ $category->nombre }}</span>
            </a>
        @endforeach
    </div>

</div>

@endsection