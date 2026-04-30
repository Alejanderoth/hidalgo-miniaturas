<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Catálogo de productos</title>
</head>
<body>

<h1>Catálogo de productos</h1>

<a href="/">Volver al inicio</a>

<hr>

@if($productos->isEmpty())
    <p>No hay productos disponibles.</p>
@else

    @if(isset($categoria))
        <h2>Categoría: {{ $categoria->nombre }}</h2>
    @else
        <h2>Catálogo completo</h2>
    @endif

    @foreach($productos as $producto)
        <div style="border:1px solid black; margin-bottom:20px; padding:10px; width:300px;">
            
            <h3>
                <a href="/producto/{{ $producto->id }}">{{ $producto->nombre }}</a>
            </h3>

            <!-- IMAGEN -->
            @if($producto->imagen)
                <a href="/producto/{{ $producto->id }}">
                    <img src="{{ asset('img/productos/' . $producto->imagen) }}" width="150">
                </a>
            @else
                <p>Sin imagen</p>
            @endif

            <!-- CATEGORÍA -->
            <p><strong>Categoría:</strong> 
                {{ $producto->category ? $producto->category->nombre : 'Sin categoría' }}
            </p>

            <!-- DATOS -->
            <p><strong>Descripción:</strong> {{ $producto->descripcion }}</p>
            <p><strong>Precio:</strong> {{ $producto->precio }} €</p>
            <form action="/carrito/agregar/{{ $producto->id }}" method="POST">
                @csrf
                <button type="submit">Añadir al carrito</button>
            </form>

        </div>
    @endforeach

@endif

</body>
</html>